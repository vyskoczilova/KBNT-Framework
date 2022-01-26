<?php

namespace KBNT\Framework\Abstracts;

use KBNT\Framework\Interfaces\ArrayInterface;

/**
 * CPT Labels
 *
 * @see https://developer.wordpress.org/reference/functions/get_post_type_labels/
 * @package KBNT\Framework\CPT
 */
abstract class PostTaxonomyLabels implements ArrayInterface
{

	/**
	 * Name
	 * @var string
	 */
	protected $name;

	/**
	 * Singular name
	 * @var string
	 */
	protected $singular_name;

	/**
	 * Add new Item
	 * @var string
	 */
	protected $add_new_item;

	/**
	 * Edit item
	 * @var string
	 */
	protected $edit_item;

	/**
	 * View item
	 * @var string
	 */
	protected $view_item;

	/**
	 * Set Name
	 *
	 * @param  string  $name  General name for the post type, usually plural. The same and overridden by $post_type_object->label. Default is ‘Posts’ / ‘Pages’.
	 *
	 * @return  self
	 */
	public function setName(string $name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Set Singular name
	 *
	 * @param  string  $singular_name  Name for one object of this post type. Default is ‘Post’ / ‘Page’.
	 *
	 * @return  self
	 */
	public function setSingularName(string $singular_name)
	{
		$this->singular_name = $singular_name;

		return $this;
	}

	/**
	 * Set Add new Item
	 *
	 * @param  string  $add_new_item  Label for adding a new singular item. Default is ‘Add New Post’ / ‘Add New Page’.
	 *
	 * @return  self
	 */
	public function setAddNewItem(string $add_new_item)
	{
		$this->add_new_item = $add_new_item;

		return $this;
	}

	/**
	 * Set Edit item
	 *
	 * @param  string  $edit_item  Label for editing a singular item. Default is ‘Edit Post’ / ‘Edit Page’.
	 *
	 * @return  self
	 */
	public function setEditItem(string $edit_item)
	{
		$this->edit_item = $edit_item;

		return $this;
	}

	/**
	 * Set View item
	 *
	 * @param  string  $view_item  Label for viewing a singular item. Default is ‘View Post’ / ‘View Page’.
	 *
	 * @return  self
	 */
	public function setViewItem(string $view_item)
	{
		$this->view_item = $view_item;

		return $this;
	}

}
