<?php

namespace KBNT\Framework\ACF;

use KBNT\Framework\Abstracts\Data;
use KBNT\Framework\Interfaces\ArrayInterface;

/**
 * Block properties
 *
 * See https://www.advancedcustomfields.com/resources/acf_register_block_type/.
 * @package KBNT\Framework\ACF
 */
class Block extends Data implements ArrayInterface {

    /**
     * Name (slug) without namespace
     * @var string
     */
    private $name;

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
     * Category
     * @var string
     */
    private $category;

    /**
     * Icon
     * @var string|array
     */
    private $icon;

    /**
     * Keywords
     * @var array
     */
    private $keywords;

    /**
     * Post tpes
     * @var array
     */
    private $post_types;

    /**
     * Display mode of the block
     * @var string
     */
    private $mode;

    /**
     * Default block alignment
     * @var string
     */
    private $align;

    /**
     * The default block text alignment
     * @var string
     */
    private $align_text;

    /**
     * Default block content alignment
     * @var string
     */
    private $align_content;

    /**
     * Path to a template file used to render the block HTML.
     * @var mixed
     */
    private $render_template;

    /**
     * Callback function
     * @var callable
     */
    private $render_callback;

    /**
     * The url to a .css file to be enqueued whenever your block is displayed (front-end and back-end).
     * @var string
     */
    private $enqueue_style;

    /**
     * The url to a .js file to be enqueued whenever your block is displayed (front-end and back-end).
     * @var string
     */
    private $enqueue_script;

    /**
     * A callback function that runs whenever your block is displayed (front-end and back-end) and enqueues scripts and/or styles.
     * @var callable
     */
    private $enqueue_assets;

    /**
     * An array of features to support
     * @var array
     */
    private $supports;

    /**
     * Parent blocks
     * @var array
     */
    private $parent;

	/**
	 * Example
	 * @var array
	 */
	private $example;

    /**
     * Set name
     *
     * @param  string  $name  Name (slug) without namespace.
     *
     * @return  self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set title
     *
     * @param  string  $title  Title
     *
     * @return  self
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set description
     *
     * @param  string  $description  Description
     *
     * @return  self
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Set category
     *
     * @param  string  $category  Category
     *
     * @return  self
     */
    public function setCategory(string $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Set icon
     *
     * @param  string|array  $icon  Icon
     *
     * @return  self
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

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
     * Set post tpes
     *
     * @param  array  $post_types  Post tpes
     *
     * @return  self
     */
    public function setPostTypes(array $post_types)
    {
        $this->post_types = $post_types;

        return $this;
    }

    /**
     * Set display mode of the block
     *
     * @param  string  $mode  Display mode of the block. Available settings are “auto”, “preview” and “edit”. Defaults to “preview”.
     *
     * @return  self
     */
    public function setMode(string $mode)
    {

        $allowed = ["auto", "preview", "edit"];
        $this->mode = $this->allowedValue($mode, $allowed);

        return $this;
    }


    /**
     * Set default block alignment
     *
     * @param  string  $align  Default block alignment. Available settings are “left”, “center”, “right”, “wide” and “full”. Defaults to an empty string.
     *
     * @return  self
     */
    public function setAlign(string $align)
    {

        $allowed = ["left", "center", "right", "wide", "full", ""];
        $this->align = $this->allowedValue($align, $allowed);

        return $this;
    }

    /**
     * Set the default block text alignment
     *
     * @param  string  $align_text  The default block text alignment. Available settings are “left”, “center” and “right”. Defaults to the current language’s text alignment.
     *
     * @return  self
     */
    public function setAlignText(string $align_text)
    {

        $allowed = ["left", "center", "right"];
        $this->align_text = $this->allowedValue($align_text, $allowed);

        return $this;
    }

    /**
     * Set default block content alignment
     *
     * @param  string  $align_content  Default block content alignment. Available settings are “top”, “center” and “bottom”. When utilising the “Matrix” control type, additional settings are available to specify all 9 positions from “top left” to “bottom right”. Defaults to “top”.
     *
     * @return  self
     */
    public function setAlignContent(string $align_content)
    {
        $allowed = ["top", "center", "bottom","top left", "center left", "bottom left","top center", "center center", "bottom center","top right", "center right", "bottom right" ];
        $this->align_content = $this->allowedValue($align_content, $allowed);

        return $this;
    }

    /**
     * Set path to a template file used to render the block HTML.
     *
     * @param  mixed  $render_template  Path to a template file used to render the block HTML.
     *
     * @return  self
     */
    public function setRenderTemplate($render_template)
    {
        $this->render_template = $render_template;

        return $this;
    }

    /**
     * Set callback function
     *
     * @param  callable  $render_callback  Callback function
     *
     * @return  self
     */
    public function setRenderCallback(callable $render_callback)
    {
        $this->render_callback = $render_callback;

        return $this;
    }

    /**
     * Set the url to a .css file to be enqueued whenever your block is displayed (front-end and back-end).
     *
     * @param  string  $enqueue_style  The url to a .css file to be enqueued whenever your block is displayed (front-end and back-end).
     *
     * @return  self
     */
    public function setEnqueueStyle(string $enqueue_style)
    {
        $this->enqueue_style = $enqueue_style;

        return $this;
    }

    /**
     * Set the url to a .js file to be enqueued whenever your block is displayed (front-end and back-end).
     *
     * @param  string  $enqueue_script  The url to a .js file to be enqueued whenever your block is displayed (front-end and back-end).
     *
     * @return  self
     */
    public function setEnqueueScript(string $enqueue_script)
    {
        $this->enqueue_script = $enqueue_script;

        return $this;
    }

    /**
     * Set a callback function that runs whenever your block is displayed (front-end and back-end) and enqueues scripts and/or styles.
     *
     * @param  callable  $enqueue_assets  A callback function that runs whenever your block is displayed (front-end and back-end) and enqueues scripts and/or styles.
     *
     * @return  self
     */
    public function setEnqueueAssets(callable $enqueue_assets)
    {
        $this->enqueue_assets = $enqueue_assets;

        return $this;
    }

    /**
     * Set features to support
     * @return BlockSupports
     */
    public function setSupports()
    {
        $this->supports = new BlockSupports();

        return $this->supports;
    }

    /**
     * Set parent blocks
     *
     * @param  array  $parent  Parent blocks
     *
     * @return  self
     */
    public function setParent(array $parent)
    {
        $this->parent = $parent;

        return $this;
    }

	/**
	 * Example
	 * @param array $example
	 * @return $this
	 */
	public function setExample(array $example) {
		$this->example = $example;

		return $this;
	}

    /**
     * Construct array from class properties
     * @return array
     */
    public function getParameters()
    {

        $array = [];

        foreach ($this as $key => $value) {
            if ($value) {
                if ($key === 'supports') {
                    $array[$key] = $value->getParameters();
                } else {
                    $array[$key] = $value;
                }
            }
        }

        return $array;
    }
}
