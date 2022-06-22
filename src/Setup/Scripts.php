<?php

namespace KBNT\Framework\Setup;

use KBNT\Framework\Interfaces\SetupInterface;

class Scripts implements SetupInterface {

    /**
     * Prefix
     * @var mixed
     */
    private $prefix; // TODO check name

    /**
     * Styles to register
     * @var array
     */
    private $styles = [];

    /**
     * Styles for Block editor to register
     * @var array
     */
    private $editor_styles = [];

    /**
     * Styles to dequeue
     * @var array
     */
    private $dequeue_styles = [];

    /**
     * Scripts to register
     * @var array
     */
    private $scripts = [];

    /**
     * Scripts for Block editor to register
     * @var array
     */
    private $editor_scripts = [];

    /**
     * Scripts to dequeue
     * @var array
     */
    private $dequeue_scripts = [];

    /**
     * Construct
     * @param string $prefix Prefix for all script.
     * @return void
     */
    public function __construct(string $prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * Register Style
     * @param string $handle Name of the stylesheet. Should be unique.
     * @param string $src Full URL of the stylesheet, or path of the stylesheet relative to the WordPress root directory. If source is set to false, stylesheet is an alias of other stylesheets it depends on.
     * @return Style
     */
    public function registerStyle(string $handle, string $src)
    {

        $this->styles[] = $this->helperPrepareStyle($handle, $src);

        return end($this->styles);
    }

    /**
     * Register Editor Style
     * @param string $handle Name of the stylesheet. Should be unique.
     * @param string $src Full URL of the stylesheet, or path of the stylesheet relative to the WordPress root directory. If source is set to false, stylesheet is an alias of other stylesheets it depends on.
     * @return Style
     */
    public function registerEditorStyle(string $handle, string $src)
    {

        $this->editor_styles[] = $this->helperPrepareStyle($handle, $src);

        return end($this->editor_styles);
    }

    /**
     * Helper for style registration
     * @param string $handle Name of the stylesheet. Should be unique.
     * @param string $src Full URL of the stylesheet, or path of the stylesheet relative to the WordPress root directory. If source is set to false, stylesheet is an alias of other stylesheets it depends on.
     * @return Style
     */
    private function helperPrepareStyle(string $handle, string $src) {

        // Setup required parameters.
        $style = new Style();
        $style->setHandlePrefix($this->prefix);
        $style->setHandle($handle);
        $style->setSrc($src);
        return $style;

    }

    /**
     * Dequeue style
     * @param string $handle style handle.
     * @return void
     */
    public function dequeueStyle(string $handle)
    {
        $this->dequeue_styles[] = $handle;
    }

    /**
     * Register Script
     * @param string $handle Name of the script. Should be unique.
     * @param string $src Full URL of the script, or path of the script relative to the WordPress root directory. If source is set to false, script is an alias of other scripts it depends on.
     * @return Script
     */
    public function registerScript(string $handle, string $src)
    {

        $this->scripts[] = $this->helperPrepareScript($handle, $src);

        return end($this->scripts);
    }

    /**
     * Register Block editor Script
     * @param string $handle Name of the script. Should be unique.
     * @param string $src Full URL of the script, or path of the script relative to the WordPress root directory. If source is set to false, script is an alias of other scripts it depends on.
     * @return Script
     */
    public function registerEditorScript(string $handle, string $src)
    {

        $this->editor_scripts[] = $this->helperPrepareScript($handle, $src);

        return end($this->editor_scripts);
    }


    /**
     * Helper for script registration
     * @param string $handle Name of the script. Should be unique.
     * @param string $src Full URL of the script, or path of the script relative to the WordPress root directory. If source is set to false, script is an alias of other scripts it depends on.
     * @return Script
     */
    private function helperPrepareScript(string $handle, string $src)
    {

        // Setup required parameters.
        $script = new Script();
        $script->setHandlePrefix($this->prefix);
        $script->setHandle($handle);
        $script->setSrc($src);
        return $script;
    }

    /**
     * Dequeue script
     * @param string $handle script handle.
     * @return void
     */
    public function dequeueScript(string $handle)
    {
        $this->dequeue_scripts[] = $handle;
    }

    /**
     * Initialize WP
     * @return void
     */
    public function init() {

        // Dequeue style.
        if (!empty($this->dequeue_styles)) {
            add_action('wp_print_styles', function() {
                foreach ($this->dequeue_styles as $handle) {
                    \wp_dequeue_style($handle);
                }
            }, 100);
        }

        // Register Block editor styles.
        if (!empty($this->editor_styles) || !empty($this->editor_scripts)) {
            add_action('enqueue_block_editor_assets', function(){
                $this->helperRegisterStylesScripts($this->editor_styles, $this->editor_scripts);
            });
        }

        // Enqueue styles & scripts, remove scripts.
        add_action('wp_enqueue_scripts', function() {

            // Remove scripts
            if ($this->dequeue_scripts) {
                foreach ($this->dequeue_scripts as $handle) {
                    \wp_deregister_script($handle);
                    \wp_dequeue_script($handle);
                }
            }

            $this->helperRegisterStylesScripts($this->styles, $this->scripts);

        }, 100);

    }

    /**
     * Enqueue style & scripts
     * @param array $styles Styles.
     * @param array $scripts Scripts.
     * @return void
     */
    private function helperRegisterStylesScripts($styles, $scripts) {

        // Styles.
        foreach ($styles as $style) {
            $style->enqueue();
        }

        // Scripts.
        foreach ($scripts as $script) {
            $script->enqueueScript();
        }
    }

}
