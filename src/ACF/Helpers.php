<?php

namespace KBNT\Framework\ACF;

class Helpers
{

    /**
     * Prepare classes for block rendering
     *
     * @param array $block Block info passed from ACF.
     * @param array $blacklist Classes to blacklist if any.
     * @return string
     */
    public static function prepareBlockClasses($block, $blacklist = []) {

        // Get classes.
        $classes = isset($block['className']) ? $block['className'] : '';

        // Add current blocks class name to blacklist.
        $blacklist[] = 'wp-block-' . \str_replace('/', '-', $block['name']);

        // Add text align settings.
        if ($block['align']) {
            $classes = $classes . ($classes === '' ? '' : ' ')  . 'has-text-align-' . $block['align'];
        }

        // Blacklist classes.
        if (!empty($blacklist)) {
            $array = \explode(' ', $classes);
            $new_classes = [];
            foreach ($array as $a) {
                if (!\in_array($a, $blacklist, true)) {
                    $new_classes[] = $a;
                }
            }
            if (count($new_classes) > 0) {
                $classes = \implode(' ', $new_classes);
            }
        }

        // Return classes string.
        return $classes;
    }

}
