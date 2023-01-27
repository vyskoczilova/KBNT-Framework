<?php

namespace KBNT\Framework\Helpers;

class ConstructBlock
{

    /**
     * Construct block group class
     * @param string $content Inner content.
     * @param string|null $align Align.
     * @param string|null $bgColor Background Color
     * @return string
     */
    public static function coreGroup(string $content, string $align = null, string $bgColor = null): string
    {

        $prepared = self::prepare($align, [], $bgColor);

        return '<!-- wp:group '. $prepared->params .' --><div class="'. $prepared->classes .'">' . $content . '</div><!-- /wp:group -->';

    }

    /**
     * Construct core/heading block
     * @param string $content Heading text.
     * @param int $level Heading level.
     * @param string|null $textAlign Text align.
     * @param array $classNames Classes.
     * @return string
     */
    public static function coreHeading(string $content = "", int $level = 2, string $textAlign = null, array $classNames = []): string
    {

        $prepared = self::prepare($textAlign, $classNames);

        if (intval($level) !== 2) {
            $params['level'] = intval($level);
        }

        return '<!-- wp:heading '. $prepared->params .' --><h'.$level.' class="'. $prepared->classes .'">' . $content . '</h' . $level . '><!-- /wp:heading -->';

    }

    /**
     * Construct core/paragraph block
     * @param string $content Content.
     * @param string|null $textAlign Align.
     * @param array $classNames Classes.
     * @return string
     */
    public static function coreParagraph(string $content = "", string $textAlign = null, array $classNames = []): string
    {

        $prepared = self::prepare($textAlign, $classNames);

        return '<!-- wp:paragraph '. $prepared->params .' --><p class="'. $prepared->classes .'">' . $content . '</p><!-- /wp:paragraph -->';

    }


    /**
     * Prepare params and classes for block
     *
     * @param string $textAlign Text align.
     * @param array $classNames Classes.
     * @param string|null $bgColor Background color.
     * @return \stdClass
     */
    private static function prepare(string $textAlign = '', array $classNames = [], string $bgColor = ""): \stdClass
    {
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
        if ($bgColor) {
            $params['backgroundColor'] = $bgColor;
            $classes[] = "has-background";
            $classes[] = "has-$bgColor-background-color";
        }

        $return = new \stdClass();
        $return->params = \wp_json_encode($params);
        $return->classes = \implode(' ', $classes);

        return $return;
    }

}
