<?php

namespace KBNT\Framework\Helpers;

class CustomTheme {

    /**
     * Get path to assets folder.
     * @return string
     */
	public static function getAssetsPath() {
        return get_template_directory_uri() . '/assets';
    }

    /**
     * Get Assets manifest if exists.Cu
     * @return array
     */
    public static function getAssetsManifest() {
        $manifest_path = get_template_directory() . '/assets/rev-manifest.json';

        if (file_exists($manifest_path)) {
            return json_decode(file_get_contents($manifest_path), true);
        }

        return [];
    }

    /**
     * Get path to icons SVG sprite including versions.
     * @return string
     */
    public static function getIconsSprite() {
        $sprite_path = get_template_directory() . '/assets/img/sprite.svg';

        if (file_exists($sprite_path)) {
            return get_template_directory_uri() . '/assets/img/sprite.svg?ver=' . filemtime(get_template_directory() . '/assets/img/sprite.svg');
        }

        return '';
    }

}
