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

        $prepared = self::prepare($align, ['wp-block-group'], $bgColor);

        return '<!-- wp:group '. $prepared->params .' --><div'.$prepared->classes.'>' . $content . '</div><!-- /wp:group -->';

    }

    /**
     * Construct core/heading block
     * @param string $content Heading text.
     * @param int $level Heading level.
     * @param string $textAlign Text align.
     * @param array $classNames Classes.
     * @param string $color Color.
     * @return string
     */
    public static function coreHeading(string $content = "", int $level = 2, string $textAlign = '', array $classNames = [], string $color = ''): string
    {

        $prepared = self::prepare($textAlign, $classNames, '', $color);

        if (intval($level) !== 2) {
            $params['level'] = intval($level);
        }

        return '<!-- wp:heading '. $prepared->params .' --><h'.$level.''.$prepared->classes.'>' . $content . '</h' . $level . '><!-- /wp:heading -->';

    }

    /**
     * Construct core/paragraph block
     * @param string $content Content.
     * @param string|null $textAlign Align.
     * @param array $classNames Classes.
     * @return string
     */
    public static function coreParagraph(string $content = "", string $textAlign = '', array $classNames = []): string
    {

        $prepared = self::prepare($textAlign, $classNames);

        return '<!-- wp:paragraph '. $prepared->params .' --><p'.$prepared->classes.'>' . $content . '</p><!-- /wp:paragraph -->';

    }

    /* Construct core/buttons block */
    public static function coreButtons($content = "", $layoutType = "flex", $justifyContent = "left", $classNames = []) {

        $prepared = self::prepare("", $classNames, "", "", $layoutType, $justifyContent);

        return '<!-- wp:buttons '. $prepared->params .' -->
        <div class="wp-block-buttons'.$prepared->classes.'">' . $content . '</div><!-- /wp:buttons -->';
    }

    /* Construct core/button block */
    public static function coreButton($link, $label, $style = "", $classNames = []) {
        $prepared = self::prepare("", $classNames, "", "", "", "", "", $style);

        return '<!-- wp:button ' . $prepared->params .' {"className":"is-style-primary"} -->
        <div class="wp-block-button ' . $prepared->classes . '"><a class="wp-block-button__link wp-element-button" href="' . $link . '">' . $label . '</a></div>
        <!-- /wp:button -->';
    }


    /**
     * Prepare params and classes for block
     *
     * @param string $textAlign Text align.
     * @param array $classNames Classes.
     * @param string $bgColor Background color.
     * @param string $color Color.
     * @return \stdClass
     */
    private static function prepare(string $textAlign = '', array $classNames = [], string $bgColor = "", string $color = "", $layoutType = "", $layoutJustifyContent = "", $style = ""): \stdClass
    {

        // TODO napsat jako novou třídu a lepší getter / setter.

        $params = [];
        $classes = [];

        if ($textAlign) {
            $params['align'] = $textAlign;
            $classes[] = "has-text-align-$textAlign";
            $classes[] = "align$textAlign";
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
        if ($color) {
            $params['color'] = $color;
            $classes[] = "has-$color-color";
        }
        if ($layoutType) {
            $params['layout']['type'] = $layoutType;
        }
        if ($layoutType) {
            $params['layout']['justifyContent'] = $layoutJustifyContent;
        }
        if ($style) {
            $params['className'] = "is-style-$style";
            $classes[] = "is-style-$style";
        }

        $return = new \stdClass();
        $return->params = '';
        $return->classes = '';

        if ($params) {
            $return->params = \wp_json_encode($params);
        }

        if ($classes) {
            $return->classes = ' class="' . \implode(' ', $classes) . '"';
        }

        return $return;
    }

}
