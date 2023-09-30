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
     * @return string
     */
    public static function getAssetsManifest() {
        $manifest_path = get_template_directory() . '/assets/rev-manifest.json';

        if (file_exists($manifest_path)) {
            return json_decode(file_get_contents($manifest_path), true);
        }

        return [];
    }

}
