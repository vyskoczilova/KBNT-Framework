<?php

namespace KBNT\Framework\Setup;

use KBNT\Framework\Interfaces\SetupInterface;

class BlockPatterns implements SetupInterface
{


    /**
     * Namespace
     * @var string
     */
    private $namespace;

    /**
     * Default category
     * @var string
     */
    private $defaultCategory;

    /**
     * Patterns
     * @var array
     */
    private $patterns = [];

    /**
     * Categories
     * @var array
     */
    private $categories = [];

    /**
     * Construct class
     * @param string $namespace Namespace.
     * @return void
     */
    public function __construct($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * Register block pattern
     * @param string $title A human-readable title for the pattern.
     * @param string $content Block HTML markup for the pattern.
     * @return BlockPattern
     */
    public function addPattern(string $title, string $content)
    {

        $pattern = new BlockPattern();
        $pattern->setNamespace($this->namespace);
        $pattern->setTitle($title);
        $pattern->setContent($content);

        if ($this->defaultCategory) {
            $pattern->setCategories([$this->defaultCategory]);
        }

        $this->patterns[] = $pattern;

        return end($this->patterns);
    }


    /**
     * Initialize.
     * @return void
     */
    public function init()
    {
        if (!empty($this->patterns) || !empty($this->categories)) {
            add_action('init', function () {

                if (function_exists('register_block_pattern_category')) {
                    foreach ($this->categories as $category) {
                        register_block_pattern_category(
                            \sanitize_title($category),
                            array('label' => $category)
                        );
                    }
                }

                foreach ($this->patterns as $pattern) {
                    $pattern->registerBlockPattern();
                }
            });
        }
    }


    /**
     * Set categories
     *
     * @param  string  $category  Category
     *
     * @return  self
     */
    public function addCategory(string $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Set default category
     *
     * @param  string  $defaultCategory  Default category
     *
     * @return  self
     */
    public function setDefaultCategory(string $defaultCategory)
    {
        $this->defaultCategory = sanitize_title($defaultCategory);

        return $this;
    }
}
