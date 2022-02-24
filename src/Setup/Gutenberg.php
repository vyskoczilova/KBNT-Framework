<?php

namespace KBNT\Framework\Setup;

use KBNT\Framework\Interfaces\SetupInterface;

class Gutenberg implements SetupInterface {


    /**
     * Fix quotes
     * @var bool
     */
    private $fix_quotes;

    /**
     * Show reusable blocks in menu
     * @var bool
     */
    private $show_reusable_blocks_in_menu;

    /**
     * Disable directory search
     * @var bool
     */
    private $disable_directory_search;

    /**
     * Remove FSE ID class
     * @var bool
     */
    private $disable_render_layout_support;

    /**
     * Disable global styles
     * @var bool
     */
    private $disable_global_styles;

    /**
     * Don't render empty paragraphs
     * @var bool
     */
    private $disable_empty_paragraph_blocks;

    /**
     * Set KBNT theme defaults
     * @return void
     */
    public function setThemeDefaults()
    {

        $this->fixQuotes();
        $this->showReusableBlocksInMenu();
        $this->disableDirectorySearch();
        $this->disableRenderLayoutSupport();
        $this->disableGlobalStyles();
        $this->disableEmptyParagraphs();

    }

    /**
     * Initialize.
     * @return void
     */
    public function init() {

        if ($this->fix_quotes) {
            add_filter('render_block', [$this, 'wp_fix_quotes'], 999, 2);
        }

        if ($this->show_reusable_blocks_in_menu) {
            add_action('admin_menu', function () {
                $reusable_blocks = get_post_type_object('wp_block');
                add_menu_page($reusable_blocks->labels->name, $reusable_blocks->labels->name, 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-block-default', 22);
            });
        }

        if ($this->disable_directory_search) {
            /**
             * Source: https://github.com/WordPress/gutenberg/issues/23961.
             */
            add_action(
                'after_setup_theme',
                function () {
                    \remove_action('enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets');
                    \remove_action('enqueue_block_editor_assets', 'gutenberg_enqueue_block_editor_assets_block_directory');
                }
            );
        }

        if ($this->disable_render_layout_support) {
            remove_filter('render_block', 'wp_render_layout_support_flag', 10, 2);
            remove_filter('render_block', 'gutenberg_render_layout_support_flag', 10, 2);
        }

        if ($this->disable_global_styles) {
            // https://core.trac.wordpress.org/ticket/54941#comment:6
            add_action('after_setup_theme', function () {
                remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
                remove_action('wp_footer', 'wp_enqueue_global_styles', 1);
            }, 10, 0);
        }

        if ($this->disable_empty_paragraph_blocks) {
            add_filter('render_block_core/paragraph', function ($block_content, $block) {
                $cleaned_content = preg_replace('/\s+/', '', $block_content);
                if (trim($cleaned_content) !== '<p></p>') {
                    return $block_content;
                }
            }, 10, 2);
        }

    }

    /**
     * Fix wrong quotes
     *
     * @param string $block_content Rendered block
     * @param array $block Array of current block params
     * @return string
     */
    public function wp_fix_quotes($block_content, $block)
    {
        if ("core/code" === $block['blockName']) {
            //https://codex.wordpress.org/Writing_Code_in_Your_Posts
            $wrong_single_quotes = array(
                '/&lsquo;/i',
                '/&#8216;/i',
                '/&rsquo;/i',
                '/&#8217;/i',
                '/‘/i',
                '/’/i',
            );
            $wrong_double_quotes = array(
                '/&ldquo;/i',
                '/&#8220;/i',
                '/&rdquo;/i',
                '/&#8221;/i',
                '/”/i',
                '/“/i',
                '/&#x22;/i',
                '/&#x201D;/i',
            );
            $block_content = preg_replace($wrong_double_quotes, '&#34;', $block_content);
            $block_content = preg_replace($wrong_single_quotes, '&#39;', $block_content);
        }

        return $block_content;
    }


    /**
     * Fix wrong quotes in WP code block
     *
     * @param  bool  $fix_quotes  Fix quotes
     *
     * @return  self
     */
    public function fixQuotes( $fix_quotes = true)
    {
        $this->fix_quotes = $fix_quotes;

        return $this;
    }

    /**
     * Add reusable blocks in menu
     *
     * @param  bool  $show_reusable_blocks_in_menu  Show reusable blocks in menu
     *
     * @return  self
     */
    public function showReusableBlocksInMenu(bool $show_reusable_blocks_in_menu = true)
    {
        $this->show_reusable_blocks_in_menu = $show_reusable_blocks_in_menu;

        return $this;
    }

    /**
     * Set disable directory search
     *
     * @param  bool  $disable_directory_search  Disable directory search
     *
     * @return  self
     */
    public function disableDirectorySearch(bool $disable_directory_search = true)
    {
        $this->disable_directory_search = $disable_directory_search;

        return $this;
    }

    /**
     * Set remove FSE ID class
     *
     * @param  bool  $disable_render_layout_support  Remove FSE ID class
     *
     * @return  self
     */
    public function disableRenderLayoutSupport(bool $disable_render_layout_support = true)
    {
        $this->disable_render_layout_support = $disable_render_layout_support;

        return $this;
    }

    /**
     * Set disable global styles
     *
     * @param  bool  $disable_global_styles  Disable global styles
     *
     * @return  self
     */
    public function disableGlobalStyles(bool $disable_global_styles = true)
    {
        $this->disable_global_styles = $disable_global_styles;

        return $this;
    }

    /**
     * Set don't render empty paragraphs
     *
     * @param  bool  $disable_empty_pragraphs  Don't render empty paragraphs
     *
     * @return  self
     */
    public function disableEmptyParagraphs(bool $disable_empty_pragraphs = true)
    {
        $this->disable_empty_paragraph_blocks = $disable_empty_pragraphs;

        return $this;
    }
}
