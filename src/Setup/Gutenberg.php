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
     * Set KBNT theme defaults
     * @return void
     */
    public function setThemeDefaults()
    {

        $this->fixQuotes();
        $this->showReusableBlocksInMenu();

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
}
