<?php

namespace KBNT\Framework\Setup;

class BlockPattern {

    /**
     * Namespace
     * @var string
     */
    private $namespace;

    /**
     * Title
     * @var string
     */
    private $title;

    /**
     * Description
     * @var string
     */
    private $description;

    /**
     * Content
     * @var string
     */
    private $content;

    /**
     * Categories
     * @var array
     */
    private $categories = [];

    /**
     * Keywords
     * @var array
     */
    private $keywords = [];

    /**
     * Viewport Width
     * @var int
     */
    private $viewportWidth;

    /**
     * Set namespace
     *
     * @param  string  $namespace  Namespace.
     *
     * @return  self
     */
    public function setNamespace(string $namespace)
    {
        $this->namespace = "$namespace-patterns";

        return $this;
    }

    /**
     * Set title
     *
     * @param  string  $title  Required. A human-readable title for the pattern.
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set description
     *
     * @param  string  $description   Visually hidden text used to describe the pattern in the inserter. A description is optional, but is strongly encouraged when the title does not fully describe what the pattern does. The description will help users discover the pattern while searching.
     *
     * @return  self
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Set content
     *
     * @param  string  $content  Block HTML markup for the pattern.
     *
     * @return  self
     */
    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Set keywords
     *
     * @param  array  $keywords  Keywords
     *
     * @return  self
     */
    public function setKeywords(array $keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Set viewport Width
     *
     * @param  int  $viewportWidth  Optional. The intended width of the pattern to allow for a scaled preview within the pattern inserter.
     *
     * @return  self
     */
    public function setViewportWidth(int $viewportWidth)
    {
        $this->viewportWidth = $viewportWidth;

        return $this;
    }

    /**
     * Set categories
     *
     * @param  array  $categories  Optional. A list of registered pattern categories used to group block patterns. Block patterns can be shown on multiple categories. A category must be registered separately in order to be used here.
     *
     * @return  self
     */
    public function setCategories(array $categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Register block Pattern.
     * @return void
     */
    public function registerBlockPattern() {

        if (class_exists('WP_Block_Patterns_Registry')) {

            $pattern = [
                'title'         => $this->title,
                'content'       => $this->cleanPattern($this->content), // Escape.
            ];

            if ($this->description) {
                $pattern['description'] = $this->description;
            }
            if ($this->categories) {
                $pattern['categories'] = $this->categories;
            }
            if ($this->keywords) {
                $pattern['keywords'] = $this->keywords;
            }
            if ($this->viewportWidth) {
                $pattern['viewportWidth'] = $this->viewportWidth;
            }

            register_block_pattern(
                $this->namespace . '/' . \sanitize_title($this->title),
                $pattern
            );
        }

    }

    /**
     * Clean pattern
     * @param string $pattern_content Pattern content from Gutenberg.
     * @return string
     */
    private function cleanPattern($pattern_content) {

        $pattern_content = str_replace(["\n", "\r", "\t"], '', $pattern_content); // https://github.com/WordPress/gutenberg/issues/32139#issuecomment-849906816

        return $pattern_content;
    }
}
