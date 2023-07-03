<?php

namespace KBNT\Framework\Setup;

use KBNT\Framework\Helpers\DisableEmojis;
use KBNT\Framework\Interfaces\SetupInterface;

class Theme implements SetupInterface
{


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
     * Disable password change emails
     * @var bool
     */
    private $disable_password_reset_emails;

    /*
    * Sanitize filenames
    * @var bool
    */
    private $sanitize_file_names;

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
     * Disable editor full screen mode
     * @var bool
     */
    private $disable_editor_fullscreen_mode;

    /**
     * Show thumnail in admin columns
     * @var array
     */
    private $admin_show_thumbnail = [];

    /**
     * Disable XML-RPC
     * @var bool
     */
    private $disable_xmlrpc;

    /**
     * Image quality
     * @var int
     */
    private $image_quality;

    /**
     * Bug fix decoding=async
     * @var bool
     */
    private $bug_fix_decoding_async = true;

    /**
     * Login logo
     * @var array
     */
    private $login_logo;

    /**
     * Default image size
     * @var string
     */
    private $default_image_size;

    /**
     * Remove theme support
     * @var array
     */
    private $remove_theme_support = [];

    /**
     * Disable Bug fix decoding=async
     */
    public function disableBugFixDecodingAsync()
    {
        $this->bug_fix_decoding_async = false;
    }

    /**
     * Disable XML-RPC
     */
    public function disableXmlrpc()
    {
        $this->disable_xmlrpc = true;
    }

    /**
     * Disable editor fullscreen mode
     * @return void
     */
    public function disableTemplateEditor()
    {
        _doing_it_wrong('disableTemplateEditor', 'Call removeThemeSupport("block-templates") directly.', '0.5.5');
        // https://gutenbergtimes.com/how-to-disable-theme-features-and-lock-block-templates-for-full-site-editing-in-wordpress/
        $this->removeThemeSupport('block-templates');
    }

    /**
     * Disable editor fullscreen mode
     * @return void
     */
    public function disableEditorFullscreenMode()
    {
        $this->disable_editor_fullscreen_mode = true;
    }

    /**
     * Disable auto update emails.
     * @param bool $disable Disable auto update emails.
     * @return void
     */
    public function disableAutoUpdateEmails($disable = true)
    {
        $this->disable_auto_update_emails = $disable;
    }

    /**
     * Disable password reset emails.
     * @param bool $disable Disable password reset emails.
     * @return void
     */
    public function disablePasswordResetEmails($disable = true)
    {
        $this->disable_password_reset_emails = $disable;
    }

    /**
     * Sanitize filenames
     * @param bool $sanitize Sanitize filenames.
     * @return void
     */
    public function sanitizeFileNames($sanitize = true)
    {
        $this->sanitize_file_names = $sanitize;
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

    public function allowSvg()
    {

        $svg = new Svg();
        $svg->init();
    }

    /**
     * Set KBNT theme defaults
     * @return void
     */
    public function setThemeDefaults()
    {

        $this->disableAutoUpdateEmails();
        $this->disablePasswordResetEmails();
        $this->disableEditorFullscreenMode();
        $this->disableEmojis();
        $this->disableJqueryMigrate();
        $this->disableXmlrpc();
        $this->removeImageSize('1536x1536');
        $this->removeImageSize('2048x2048');
        $this->sanitizeFileNames();
        $this->theme_defaults = true;
        $this->setImageQuality(100);
        $this->removeThemeSupport('core-block-patterns');
        $this->removeThemeSupport('block-templates');
    }

    /**
     * Set image quality
     * 
     * @param int $quality Image quality.
     */
    public function setImageQuality(int $quality)
    {
        $this->image_quality = $quality;
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
    public function addImageSize(string $slug, int $width, $height = 0, $crop = false, string $menu_name = null)
    {
        if ($menu_name) {
            $this->image_sizes_add[$menu_name] = [$slug, $width, $height, $crop];
        }
        $this->image_sizes_add[] = [$slug, $width, $height, $crop];
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
     * Set default image size
     * @param string $name Size name/slug.
     * @return void
     */
    public function setDefaultImageSize(string $name)
    {
        $this->default_image_size = $name;
    }

    /**
     * Disable WP Emojis on frontend.
     * @return self
     */
    public function disableEmojis()
    {
        $this->disable_emojis = true;
        return $this;
    }

    /**
     * Show thumbnail in admin columns for selected post type
     *
     * @param string $post_type Post type.
     * @return void
     */
    public function adminColumnsShowThumbnail(string $post_type)
    {
        $this->admin_show_thumbnail[] = $post_type;
    }

    /**
     * Set login logo
     * @param string $url URL to logo.
     * @param int $width Width in px.
     * @param int $height Height in px.
     * @return void 
     */
    public function setLoginLogo(string $url, int $width, int $height)
    {
        $this->login_logo = ["url" => $url, "width" => $width . "px", "height" => $height . "px"];
    }

    /**
     * Remove theme support
     * @param string $feature Feature name.
     * @return self
     */
    public function removeThemeSupport(string $feature)
    {
        if (!in_array($feature, $this->remove_theme_support)) {
            $this->remove_theme_support[] = $feature;
        }
        return $this;
    }

    /**
     * Initilize
     * @return void
     */
    public function init()
    {

        if ($this->disable_auto_update_emails) {
            add_filter('auto_plugin_update_send_email', '__return_false');
            add_filter('auto_theme_update_send_email', '__return_false');
        }

        if ($this->disable_password_reset_emails) {
            add_filter( 'send_password_change_email', '__return_false' );
        }

        if ($this->disable_xmlrpc) {
            add_filter('xmlrpc_enabled', '__return_false');
        }

        if ($this->sanitize_file_names) {
            // Sanitize uploaded filenames.
            add_action('sanitize_file_name', function ($filename) {
                return preg_replace("/\s+/", "-", strtolower(remove_accents($filename)));
            });
        }

        if ($this->disable_emojis) {
            new DisableEmojis();
        }

        if ($this->disable_editor_fullscreen_mode && is_admin()) {
            /**
             * Source: https://www.alektra.net/how-to-automatically-disable-fullscreen-mode-in-wordpress/
             */
            add_action('enqueue_block_editor_assets', function () {
                wp_add_inline_script('wp-blocks', "jQuery( window ).load(function() { const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ); if ( isFullscreenMode ) { wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); } });");
            });
        }

        if (!empty($this->image_sizes_modify) || $this->default_image_size) {
            add_action('after_switch_theme', function () {
                
                // Set default image size.
                if ($this->default_image_size) {
                    update_option('image_default_size', $this->default_image_size);
                }

                // Default sizes.
                foreach ($this->image_sizes_modify as $name => $args) {
                    update_option($name . '_size_w', $args[0]);
                    update_option($name . '_size_h', $args[1]);
                    update_option($name . '_crop', $args[2]);
                }

            });
        }

        // Disable jQuery migrate.
        if ($this->disable_jquery_migrate) {
            add_action('wp_default_scripts', function ($scripts) {
                if (!empty($scripts->registered['jquery']) && !is_admin()) {
                    $scripts->registered['jquery']->deps = array_diff($scripts->registered['jquery']->deps, ['jquery-migrate']);
                }
            });
        }

        // Theme supports.
        if (!empty($this->menus) || $this->theme_defaults || $this->textdomain || $this->image_sizes_add || $this->image_sizes_remove || !empty($this->remove_theme_support)) {
            add_action('after_setup_theme', function () {

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

                    // Don't load unnecessary CSS for WPML.
                    if (!defined('ICL_DONT_LOAD_NAVIGATION_CSS')) {
                        define('ICL_DONT_LOAD_NAVIGATION_CSS', true);
                    }
                    if (!defined('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS')) {
                        define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
                    }

                }

                // Remove theme support.
                if (!empty($this->remove_theme_support)) {
                    foreach ($this->remove_theme_support as $feature) {
                        remove_theme_support($feature);
                    }
                }

                // Load theme textdomain.
                if ($this->textdomain) {
                    load_theme_textdomain($this->textdomain, get_template_directory() . '/languages');
                }

                // Register menus.
                if (!empty($this->menus)) {
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

                // Show thumbnail admin column.
                // Source: https://wpcustoms.net/snippets/show-post-thumbnails-in-your-admin-panel/
                if (!empty($this->admin_show_thumbnail)) {
                    foreach ($this->admin_show_thumbnail as $post_type) {
                        add_filter('manage_' . $post_type . '_posts_columns', function ($columns) {
                            $columns['thumbnail'] = __('Thumbnail');
                            return $columns;
                        });
                        add_action('manage_' . $post_type . '_posts_custom_column', function ($column_name, $post_id) {

                            $width = (int) 75;
                            $height = (int) 75;

                            if ('thumbnail' == $column_name) {
                                // thumbnail of WP 2.9
                                $thumbnail_id = get_post_meta($post_id, '_thumbnail_id', true);
                                // image from gallery
                                $attachments = get_children(array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image'));
                                if ($thumbnail_id)
                                    $thumb = wp_get_attachment_image($thumbnail_id, array($width, $height), true);
                                elseif ($attachments) {
                                    foreach ($attachments as $attachment_id => $attachment) {
                                        $thumb = wp_get_attachment_image($attachment_id, array($width, $height), true);
                                    }
                                }
                                if (isset($thumb) && $thumb) {
                                    echo $thumb;
                                } else {
                                    echo "-";
                                }
                            }
                        }, 10, 2);
                    }
                }
            });

            if ($this->image_sizes_add) {

                // Add Custom image sizes name to the admin dropdown.
                add_filter('image_size_names_choose', function ($sizes) {

                    $additional_sizes = [
                        'medium_large' => __( 'Medium Large' ),
                    ];

                    foreach ($this->image_sizes_add as $name => $atts) {
                        if (\is_string($name)) {
                            $additional_sizes[$atts[0]] = $name;
                        }
                    }
                    return array_merge($sizes, $additional_sizes);
                });
            }
        }

        // Image quality
        if ($this->image_quality) {
            /**
             * Set JPEG quality
             * https://developer.wordpress.org/reference/hooks/jpeg_quality/
             */
            add_filter('jpeg_quality', function ($quality, $context) {
                return $this->image_quality;
            }, 10, 2);

            /**
             * Set Image  quality
             * https://developer.wordpress.org/reference/hooks/wp_editor_set_quality/
             */
            add_filter('wp_editor_set_quality', function ($quality, $mime_type) {
                return $this->image_quality;
            }, 10, 2);
        }

        // Bug fix for 6.1+ decoding=async
        if ($this->bug_fix_decoding_async) {
            add_filter( 'wp_content_img_tag', function( $filtered_image, $context, $attachment_id ) {
                if ( false !== strpos( $filtered_image, 'loading="eager"' ) || false !== stripos( $filtered_image, 'fetchpriority="high"' ) ) {
                    $filtered_image = str_replace( ' decoding="async"', '', $filtered_image );
                }
                return $filtered_image;
            }, 10, 3 );
        }

        // Load custom logo at login screen.
        if ($this->login_logo) {

            // Change URL to homepage.
    		add_filter( 'login_headerurl', function () {
                return home_url(); 
            });

            add_action('login_enqueue_scripts', function () {
                echo '<style type="text/css">
                #login h1 a, .login h1 a {
                    background-image: url(' . $this->login_logo['url'] .');
                    width: ' . $this->login_logo['width'] .';
                    height: ' . $this->login_logo['height'] .';
                    background-size: ' . $this->login_logo['width'] .' ' . $this->login_logo['height'] .';
                    background-repeat: no-repeat;
                    padding-bottom: 10px;
                    outline: 0!important;
			    }
                </style>';
            });
        }
    }


    /**
     * Set load jQuery migrate
     *
     * @return  self
     */
    public function disableJqueryMigrate(bool $disable = true)
    {
        $this->disable_jquery_migrate = $disable;

        return $this;
    }
}


// TODO image sizes add remove
