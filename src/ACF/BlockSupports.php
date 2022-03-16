<?php

namespace KBNT\Framework\ACF;

use KBNT\Framework\Interfaces\ArrayInterface;

/**
 * Block Supports
 * https://www.advancedcustomfields.com/resources/acf_register_block_type/
 * https://developer.wordpress.org/block-editor/reference-guides/block-api/block-supports/
 * @package KBNT\Framework\ACF
 */
class BlockSupports implements ArrayInterface {

    /**
     * Toolbar button for control the block alignment.
     * @var string|bool
     */
    private $align;

	/**
	 * Anchor
	 * @var bool
	 */
	private $anchor;

    /**
     * Enables block to be added multiple times.
     * @var bool
     */
    private $multiple;

    /**
     * Enables JSX support.
     * @var bool
     */
    private $__experimental_jsx;

    /**
     * Set default block alignment
     *
     * @param  mixed  $align  This property enables a toolbar button to control the block’s alignment. Defaults to true. Set to false to hide the alignment toolbar. Set to an array of specific alignment names to customize the toolbar.
     *
     * @return  self
     */
    public function setAlign($align)
    {
        $this->align = $align;

        return $this;
    }

    /**
     * This property allows the user to toggle between edit and preview modes via a button. Defaults to true.
     *
     * @param  bool  $multiple  True|False
     *
     * @return  self
     */
    public function setMultiple(bool $multiple = true)
    {

        $this->multiple = $multiple;

        return $this;
    }

    /**
     * Set enables JSX support.
     *
     * @param  bool  $__experimental_jsx  Enables JSX support.
     *
     * @return  self
     */
    public function setExperimentalJSX(bool $__experimental_jsx = true)
    {
        $this->__experimental_jsx = $__experimental_jsx;

        return $this;
    }

	/**
	 * Anchor
	 * @param bool $anchor Anchors let you link directly to a specific block on a page. This property adds a field to define an id for the block and a button to copy the direct link.
	 * @return $this
	 */
	public function setAnchor(bool $anchor = true) {
		$this->anchor = $anchor;
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
                $array[$key] = $value;
            }
        }

        return $array;
    }
}
