<?php

namespace KBNT\Framework\ACF;

use KBNT\Framework\Helpers\Strings;

class Setup
{

    /**
     * Hide "Custom fileds" admin menu for all but
     * @param array $allow_for Allow for selected user names.
     * @return void
     */
    public function hideCustomFieldMenu($allow_for = []) {
        $current_user = wp_get_current_user();
        if (!in_array($current_user->user_login, $allow_for, true)) {
            add_filter('acf/settings/show_admin', '__return_false');
        }
    }

    /**
     * Store data in JSON and save to theme
     * @param string $path Relative theme path where to store the JSON.
     * @return void
     */
    public function useJson($path) {
        $path = \get_stylesheet_directory() . (! Strings::startsWith($path, '/') ? '/' : '') . $path;

        add_filter('acf/settings/save_json',function() use ($path) {
            return $path;
        });
        add_filter('acf/settings/load_json',function() use ($path) {
            return [$path];
        });
    }

    /**
     * Add Reusable blocks to the dropdown Posty type
     * @return void
     */
    public function supportReusableBlocksPostType() {
        add_filter('acf/get_post_types', function($post_types) {
            $post_types[] = 'wp_block';
            return $post_types;
        }, 10, 1);
    }

    /**
     * Add options page
     * @param string $menu_title Menu title.
     * @param string $page_title Page title.
     * @param string $slug Slug.
     * @return void
     */
    public function addOptionsPage($menu_title, $slug, $page_title = null) {
        if (function_exists('acf_add_options_page')) {

            if ($page_title === null) {
                $page_title = $menu_title;
            }

            \acf_add_options_page(
                [
                    'menu_title' => $menu_title,
                    'page_title' => $page_title,
                    'menu_slug'  => $slug,
                    'capability' => 'edit_posts',
                    'redirect'   => false,
                ]
            );
        }
    }

    /**
     * Add options sub page
     * @param string $menu_title Menu title.
     * @param string $page_title Page title.
     * @param string $úaremt_slug Parent slug or link.
     * @return void
     */
    public function addOptionsSubPage($menu_title, $parent_slug, $page_title = null) {
        if (function_exists('acf_add_options_sub_page')) {

            if ($page_title === null) {
                $page_title = $menu_title;
            }

            \acf_add_options_sub_page(
                [
                    'menu_title' => $menu_title,
                    'page_title' => $page_title,
                    'parent_slug'  => $parent_slug,
                ]
            );
        }
    }

}
