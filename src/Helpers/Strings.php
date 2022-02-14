<?php

namespace KBNT\Framework\Helpers;

class Strings {

    /**
     * Check if string starts with selected substring
     * @param string $string String.
     * @param string $substring String.
     * @return bool
     */
    public static function startsWith($string, $substring) {
        if (substr($string, 0, strlen($substring))) {
            return true;
        }
        return false;
    }

    /**
     * Check if string endfs with selected substring
     * @param string $string String.
     * @param string $substring String.
     * @return bool
     */
    public static function endsWith($string, $substring) {
        if (substr($string, strlen($substring) * -1 )) {
            return true;
        }
        return false;
    }

}
