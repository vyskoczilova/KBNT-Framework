<?php

namespace KBNT\Framework\Helpers;

class ConstructBlock
{

    /**
     * Construct block group class
     * @param string $content Inner content.
     * @param string|null $textAlign Text align.
     * @param string|null $bgColor Background Color
     * @return string
     */
    public static function coreGroup(string $content, string $textAlign = null, string $bgColor = null): string
    {

        $prepared = new ConstructBlockPrepare();
        $prepared->setTextAlign($textAlign);
        $prepared->setBgColor($bgColor);
        $prepared->setClassNames(['wp-block-group']);

        return '<!-- wp:group '. $prepared->getParams() .' --><div'.$prepared->getClasses().'>' . $content . '</div><!-- /wp:group -->';

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

        $prepared = new ConstructBlockPrepare();
        $prepared->setTextAlign($textAlign);
        $prepared->setColor($color);
        $prepared->setClassNames($classNames);

        if (intval($level) !== 2) {
            $prepared->setLevel(intval($level));
        }

        return '<!-- wp:heading '. $prepared->getParams() .' --><h'.$level.''.$prepared->getClasses() .'>' . $content . '</h' . $level . '><!-- /wp:heading -->';

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

        $prepared = new ConstructBlockPrepare();
        $prepared->setTextAlign($textAlign);
        $prepared->setClassNames($classNames);

        return '<!-- wp:paragraph '. $prepared->getParams() .' --><p'.$prepared->getClasses().'>' . $content . '</p><!-- /wp:paragraph -->';

    }

    /* Construct core/buttons block */
    public static function coreButtons($content = "", $layoutType = "flex", $justifyContent = "left", $classNames = []) {

        $prepared = new ConstructBlockPrepare();
        $prepared->setClassNames($classNames);
        $prepared->setLayoutType($layoutType);
        $prepared->setLayoutJustifyContent($justifyContent);

        return '<!-- wp:buttons '. $prepared->getParams() .' -->
        <div class="wp-block-buttons'.$prepared->getClasses().'">' . $content . '</div><!-- /wp:buttons -->';
    }

    /* Construct core/button block */
    public static function coreButton($link, $label, $style = "", $classNames = []) {

        $prepared = new ConstructBlockPrepare();
        $prepared->setClassNames($classNames);
        $prepared->setStyle($style);

        return '<!-- wp:button ' . $prepared->getParams() .' -->
        <div class="wp-block-button ' . $prepared->getClasses() . '"><a class="wp-block-button__link wp-element-button" href="' . $link . '">' . $label . '</a></div>
        <!-- /wp:button -->';
    }

}
