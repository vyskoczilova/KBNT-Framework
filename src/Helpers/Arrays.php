<?php

namespace KBNT\Framework\Helpers;

class Arrays {

    /**
     * Implode array with last separator different
     * @param array $array Array to implode.
     * @param string $separator Standard separator
     * @param string $last Last separator
     * @return array
     */
	public static function implodeWithLast($array, $separator = "", $last = "") {
        return join($last, array_filter(array_merge(array(join($separator, array_slice($array, 0, -1))), array_slice($array, -1)), 'strlen'));
    }

    /**
     * Replace value in array
     * @param array $array Array.
     * @param mixed $old_value Old value.
     * @param mixed $new_value New value.
     * @return array
     */
    public static function replaceValue($array, $old_value, $new_value) {
        $key = \array_search($old_value, $array, true);
        if ($key) {
            $array = \array_replace($array, [$key => $new_value]);
        }
        return $array;
    }

    /**
     * Remove value in array
     * @param array $array Array.
     * @param mixed $value Value to remove.
     * @return array
     */
    public static function removeValue($array, $value) {
        if (($key = array_search($value, $array)) !== false) {
            unset($array[$key]);
        }
        return $array;
    }

    /**
     * Append value after key
     * @param array $array Array.
     * @param mixed $key Key after which append.
     * @param mixed $additional_key Key to append.
     * @param mixed $additional_value Value to append.
     * @return array
     */
    public static function appendValueAfterKey($array, $key, $additional_key, $additional_value) {
        $new_array = [];
        foreach ($array as $k => $v) {
            $new_array[$k] = $v;
            if ($k === $key) {
                $new_array[$additional_key] = $additional_value;
            }
        }
        return $new_array;
    }

}
