<?php

namespace KBNT\Framework\Helpers;

class SaveBlockHTML
{

    /**
     * Construct block group class
     * @param string $content Inner content.
     * @param string $align Align.
     * @param string $bgColor Background Color
     * @return string
     */
    public static function coreGroup($content, $align = null, $bgColor = null) {

        $params = [];
        $classes = [
            'wp-block-group'
        ];

        if ($align) {
            $params['align'] = $align;
            $classes[] = "align$align";
        }
        if ($bgColor) {
            $params['backgroundColor'] = $bgColor;
            $classes[] = "has-background";
            $classes[] = "has-$bgColor-background-color";
        }

        return '<!-- wp:group '.\wp_json_encode($params).' --><div class="'.\implode(' ', $classes).'">' . $content . '</div><!-- /wp:group -->';

    }

    /**
     * Construct block group class
     * @param string $content Heading text.
     * @param string $textAlign Text align.
     * @param string $bgColor Background Color
     * @return string
     */
    public static function coreHeading($content, $level = 2, $textAlign = null, $classNames = []) {

        $params = [];
        $classes = [];

        if ($textAlign) {
            $params['align'] = $textAlign;
            $classes[] = "has-text-align-$textAlign";
        }
        if ($classNames) {
            $params['className'] = \implode(' ', $classNames);
            $classes = \array_merge($classes, $classNames);
        }
        if (intval($level) !== 2) {
            $params['level'] = intval($level);
        }

        return '<!-- wp:heading '.\wp_json_encode($params).' --><h'.$level.' class="'.\implode(' ', $classes).'">' . $content . '</h' . $level . '><!-- /wp:heading -->';

    }

}
