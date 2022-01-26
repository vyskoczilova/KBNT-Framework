<?php

namespace KBNT\Framework\Setup;

use KBNT\Framework\Helpers\DisableEmojis;
use KBNT\Framework\Interfaces\SetupInterface;

class Theme implements SetupInterface {


    /**
     * Register menus
     * @var array
     */
    private $menus = [];

    /**
     * Set theme defaults
     * @var bool
     */
    private $theme_defaults;

    /**
     * Disable automatic update emails
     * @var bool
     */
    private $disable_auto_update_emails;

    /**
     * Text domain
     * @var string
     */
    private $textdomain;

    /**
     * Image sizes to add
     * @var array
     */
    private $image_sizes_add = [];

    /**
     * Image sizes to remove
     * @var array
     */
    private $image_sizes_remove = [];

    /**
     * Image sizes to modify
     * @var array
     */
    private $image_sizes_modify = [];

    /**
     * Load jQuery migrate
     * @var bool
     */
    private $disable_jquery_migrate;

    /**
     * WP Emojis
     * @var true
     */
    private $disable_emojis;

    /**
     * Disable auto update emails.
     * @return void
     */
    public function disableAutoUpdateEmails() {
        $this->disable_auto_update_emails = true;
    }

    /**
     * Add menu support
     * @param string $slug Menu ID.
     * @param string $name Menu name.
     * @return void
     */
    public function addMenu(string $slug, string $name)
    {
        $this->menus[$slug] = \esc_html($name);
    }

    public function allowSvg() {

        $svg = new Svg();
        $svg->init();

    }

    /**
     * Set KBNT theme defaults
     * @return void
     */
    public function setThemeDefaults() {

        $this->disableAutoUpdateEmails();
        $this->disableEmojis();
        $this->disableJqueryMigrate();
        $this->removeImageSize('1536x1536');
        $this->removeImageSize('2048x2048');
        $this->theme_defaults = true;

    }

    /**
     * Set textdomain
     * @param string $textdomain
     * @return void
     */
    public function setTextdomain(string $textdomain)
    {
        $this->textdomain = $textdomain;
    }

    /**
     * Register new image size
     * @param string $name Name used in WP dropdown menus.
     * @param string $slug size's slug.
     * @param int $width Width in px.
     * @param int $height Height in px.
     * @param bool $crop Crop in px.
     * @return void
     */
    public function addImageSize(string $menu_name, string $slug, int $width, $height = 0, $crop = false)
    {
        $this->image_sizes_add[$menu_name] = [$slug, $width, $height, $crop];
    }

    /**
     * Modify default thumbnail, medium, medium_large, and large size
     * @param string $name image size name
     * @param int $width Width in px.
     * @param int $height Height in px.
     * @param bool $crop Crop in px.
     * @return void
     */
    public function modifyImageSize(string $name, int $width, $height = 0, $crop = false)
    {
        $this->image_sizes_modify[$name] = [$width, $height, $crop];
    }

    /**
     * Remove unused image size
     * @param string $name Size name/slug.
     * @return void
     */
    public function removeImageSize(string $name)
    {
        $this->image_sizes_remove[] = $name;
    }

    /**
     * Disable WP Emojis on frontend.
     * @return self
     */
    public function disableEmojis() {
        $this->disable_emojis = true;
        return $this;
    }

    /**
     * Initilize
     * @return void
     */
    public function init() {

        if ($this->disable_auto_update_emails) {
            add_filter('auto_plugin_update_send_email', '__return_false');
            add_filter('auto_theme_update_send_email', '__return_false');
        }

        if ($this->theme_defaults) {

            // Sanitize uploaded filenames.
            add_action('sanitize_file_name', function($filename) {
                return preg_replace("/\s+/", "-", strtolower(remove_accents($filename)));
            });

        }

        if ($this->disable_emojis) {
            new DisableEmojis();
        }

        // Modify default sizes.
        if (!empty($this->image_sizes_modify)) {
            add_action('after_switch_theme', function(){

                foreach( $this->image_sizes_modify as $name => $args ) {
                    update_option($name . '_size_w', $args[0]);
                    update_option($name . '_size_h', $args[1]);
                    update_option($name . '_crop', $args[2]);
                }

            });
        }

        // Disable jQuery migrate.
        if ($this->disable_jquery_migrate) {
            add_action('wp_default_scripts', function ($scripts) {
                if (!empty($scripts->registered['jquery'])) {
                    $scripts->registered['jquery']->deps = array_diff($scripts->registered['jquery']->deps, ['jquery-migrate']);
                }
            });
        }

        // Theme supports.
        if (!empty($this->menus) || $this->theme_defaults || $this->textdomain || $this->image_sizes_add || $this->image_sizes_remove ) {
            add_action('after_setup_theme', function() {

                if ($this->theme_defaults) {

                    // Add default posts and comments RSS feed links to head.
                    add_theme_support('automatic-feed-links');

                    // Add excerpt for pages.
                    add_post_type_support('page', 'excerpt');

                    // This feature enables plugins and themes to manage the document title tag. This should be used in place of wp_title() function.
                    add_theme_support('title-tag');

                    // Enable support for Post Thumbnails on posts and pages.
                    add_theme_support('post-thumbnails');

                    // Support HTML5
                    add_theme_support(
                        'html5',
                        ['comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script']
                    );

                    // Remove core block patterns.
                    \remove_theme_support('core-block-patterns');

                    // Don't load unnecessary CSS for WPML.
                    if (!defined('ICL_DONT_LOAD_NAVIGATION_CSS')) {
                        define('ICL_DONT_LOAD_NAVIGATION_CSS', true);
                    }
                    if (!defined('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS')) {
                        define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
                    }

                }

                // Load theme textdomain.
                if ($this->textdomain) {
                    load_theme_textdomain($this->textdomain, get_template_directory() . '/languages');
                }

                // Register menus.
                if (!empty( $this->menus)) {
                    register_nav_menus(
                        $this->menus
                    );
                    add_theme_support('menus');
                }

                // Add new image sizes.
                if ($this->image_sizes_add) {
                    foreach ($this->image_sizes_add as $size) {
                        add_image_size(...$size); // 'w540', 540, 0, false
                    }
                }

                // Remove image sizes.
                if ($this->image_sizes_remove) {
                    foreach ($this->image_sizes_remove as $size) {
                        remove_image_size($size); // '2048x2048'
                    }
                }

            });

            if ($this->image_sizes_add) {

                // Add Custom image sizes name to the admin dropdown.
                add_filter('image_size_names_choose', function($sizes) {

                    $additional_sizes = [];
                    foreach($this->image_sizes_add as $name => $atts) {
                        $additional_sizes[$atts[0]] = $name;
                    }
                    return array_merge($sizes, $additional_sizes);

                });

            }
        }

    }


    /**
     * Set load jQuery migrate
     *
     * @return  self
     */
    public function disableJqueryMigrate()
    {
        $this->disable_jquery_migrate = true;

        return $this;
    }
}


// TODO image sizes add remove
