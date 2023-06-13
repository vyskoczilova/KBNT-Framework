<?php

namespace KBNT\Framework\Helpers;

/**
 * Prepare params and classes for block
 * @package KBNT\Framework\Helpers
 */
class ConstructBlockPrepare
{

    /**
     * Text align
     * @var string
     */
    private $textAlign;

    /**
     * Classes
     * @var array
     */
    private $classNames = [];

    /**
     * Background color
     * @var string
     */
    private $bgColor;

    /**
     * Color
     * @var string
     */
    private $color;

    /**
     * Layout type
     * @var string
     */
    private $layoutType;

    /**
     * Layout justify content
     * @var string
     */
    private $layoutJustifyContent;

    /**
     * Style
     * @var string
     */
    private $style;

    /**
     * Level
     * @var int
     */
    private $level;

    /**
     * Params
     * @var array
     */
    private $blockParams;

    /**
     * Classes
     * @var array
     */
    private $blockClasses;

    /**
     * Set text align
     * @param string $textAlign 
     * @return ConstructBlockPrepare 
     */
    public function setTextAlign(string $textAlign): self
    {
        $this->textAlign = $textAlign;
        return $this;
    }

    /**
     * Set class names
     * @param array $classNames 
     * @return ConstructBlockPrepare 
     */
    public function setClassNames(array $classNames): self
    {
        $this->classNames = $classNames;
        return $this;
    }

    /**
     * Set background color
     * @param string $bgColor 
     * @return ConstructBlockPrepare 
     */
    public function setBgColor(string $bgColor): self
    {
        $this->bgColor = $bgColor;
        return $this;
    }

    /**
     * Set color
     * @param string $color 
     * @return ConstructBlockPrepare 
     */
    public function setColor(string $color): self
    {
        $this->color = $color;
        return $this;
    }

    /**
     * Set layout type
     * @param string $layoutType 
     * @return ConstructBlockPrepare 
     */
    public function setLayoutType(string $layoutType): self
    {
        $this->layoutType = $layoutType;
        return $this;
    }

    /**
     * Set layout justify content
     * @param string $layoutJustifyContent 
     * @return ConstructBlockPrepare 
     */
    public function setLayoutJustifyContent(string $layoutJustifyContent): self
    {
        $this->layoutJustifyContent = $layoutJustifyContent;
        return $this;
    }

    /**
     * Set style
     * @param string $style 
     * @return ConstructBlockPrepare 
     */
    public function setStyle(string $style): self
    {
        $this->style = $style;
        return $this;
    }

    /**
     * Set level
     * @param int $level 
     * @return ConstructBlockPrepare 
     */
    public function setLevel(int $level): self
    {
        $this->level = $level;
        return $this;
    }

    /**
     * Prepare params and classes for block
     * @return void
     */
    private function prepare() {

        $params = [];
        $classes = [];

        if ($this->textAlign) {
            $params['align'] = $this->textAlign;
            $classes[] = "has-text-align-$this->textAlign";
            $classes[] = "align$this->textAlign";
        }
        if ($this->classNames) {
            $params['className'] = \implode(' ', $this->classNames);
            $classes = \array_merge($classes, $this->classNames);
        }
        if ($this->bgColor) {
            $params['backgroundColor'] = $this->bgColor;
            $classes[] = "has-background";
            $classes[] = "has-$this->bgColor-background-color";
        }
        if ($this->color) {
            $params['color'] = $this->color;
            $classes[] = "has-$this->color-color";
        }
        if ($this->layoutType) {
            $params['layout']['type'] = $this->layoutType;
        }
        if ($this->layoutJustifyContent) {
            $params['layout']['justifyContent'] = $this->layoutJustifyContent;
        }
        if ($this->style) {
            $params['className'] = "is-style-$this->style";
            $classes[] = "is-style-$this->style";
        }
        if ($this->level) {
            $params['level'] = $this->level;
        }

        $this->blockParams = $params;
        $this->blockClasses = $classes;

    }

    /**
     * Get params
     * @return string
     */
    public function getParams(): string
    {
        if (!$this->blockParams) {
            $this->prepare();
        }
        return \wp_json_encode($this->blockParams);
    }

    /**
     * Get classes
     * @return string
     */
    public function getClasses(): string
    {
        if (!$this->blockClasses) {
            $this->prepare();
        }
        return ' class="' . \implode(' ', $this->blockClasses) . '"';
    }

}
