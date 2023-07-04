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
     * @var array
     */
    private $defaultCategories;

    /**
     * Patterns
     * @var array
     */
    private $patterns = [];

    /**
     * Remove patterns
     * @var array
     */
    private $remove_patterns = [];

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

        if (!empty($this->defaultCategories)) {
            $pattern->setCategories($this->defaultCategories);
        }

        $this->patterns[] = $pattern;

        return end($this->patterns);
    }

    /**
     * Remove pattern
     * @param string $name Pattern name.
     * @return void
     */
    public function removePattern(string $name)
    {
        $this->remove_patterns[] = $name;
    }

    /**
     * Initialize.
     * @return void
     */
    public function init()
    {
        if (!empty($this->patterns) || !empty($this->categories) || !empty($this->remove_patterns)) {
            add_action('init', function () {

                if (function_exists('register_block_pattern_category')) {
                    foreach ($this->categories as $category) {
                        register_block_pattern_category(
                            \sanitize_title($category),
                            array('label' => $category)
                        );
                    }
                    if (!empty($this->remove_patterns)) {

                        $registered_patterns = \WP_Block_Patterns_Registry::get_instance()->get_all_registered();
                        if ( $registered_patterns ) {
                            foreach ( $registered_patterns as $pattern_properties ) {
                                if ( in_array( $pattern_properties['name'], $this->remove_patterns )) {
                                    unregister_block_pattern( $pattern_properties['name'] );
                                }
                            }                   
                        }                  
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
     * Set default categories
     *
     * @param  array  $defaultCategories  Default categories
     *
     * @return  self
     */
    public function setDefaultCategories(array $defaultCateogires)
    {
        $this->defaultCategories = $defaultCateogires;

        return $this;
    }
}
