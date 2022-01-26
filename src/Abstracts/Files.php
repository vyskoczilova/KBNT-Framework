<?php

namespace KBNT\Framework\Abstracts;

abstract class Files {

    /**
     * Check if its extarnal URL or normal path.
     * @param string $path Path.
     * @return bool
     */
	protected function isExternalLink( $path ) {
        if ('http' === substr($path, 0, 4) || '://' === substr($path, 0, 3)) {
            return true;
        }
        return false;
    }

    /**
     * Check if string ends with file extension
     * @param string $path URL or Path to check.
     * @return bool
     */
    protected function hasFileExtension($path) {

        $extensions = ['css', 'js'];
        $exploded = \explode('.', $path);

        if (\in_array(end($exploded), $extensions)) {
            return true;
        }

        return false;
    }

}
