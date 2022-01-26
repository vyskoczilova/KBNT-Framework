<?php

namespace KBNT\Framework\Taxonomy;

use KBNT\Framework\Abstracts\PostTaxonomyLabels;

/**
 * Taxonomy Labels
 *
 * @see https://developer.wordpress.org/reference/functions/get_taxonomy_labels/
 * @package KBNT\Framework\CPT
 */
class Labels extends PostTaxonomyLabels
{
	/**
	 * All items
	 * @var string
	 */
	private $all_items;

	/**
	 * Update item
	 * @var string
	 */
	private $update_item;

	/**
	 * New item name
	 * @var string
	 */
	private $new_item_name;

	/**
	 * Parent name
	 * @var string
	 */
	private $parent_item;

	/**
	 * Paren item colon
	 * @var string
	 */
	private $parent_item_colon;

	/**
	 * Search items
	 * @var string
	 */
	private $search_items;

	/**
	 * Popular items
	 * @var string
	 */
	private $popular_items;

	/**
	 * Separate items with commas
	 * @var string
	 */
	private $separate_items_with_commas;

	/**
	 * Add or remove items
	 * @var string
	 */
	private $add_or_remove_items;

	/**
	 * Choose from most used
	 * @var string
	 */
	private $choose_from_most_used;

	/**
	 * Not found
	 * @var string
	 */
	private $not_found;

	/**
	 * Back to items
	 * @var string
	 */
	private $back_to_items;



	/**
	 * Set all items
	 *
	 * @param  string  $all_items  All items
	 *
	 * @return  self
	 */
	public function setAll_items(string $all_items)
	{
		$this->all_items = $all_items;

		return $this;
	}

	/**
	 * Set update item
	 *
	 * @param  string  $update_item  Update item
	 *
	 * @return  self
	 */
	public function setUpdate_item(string $update_item)
	{
		$this->update_item = $update_item;

		return $this;
	}

	/**
	 * Set new item name
	 *
	 * @param  string  $new_item_name  New item name
	 *
	 * @return  self
	 */
	public function setNew_item_name(string $new_item_name)
	{
		$this->new_item_name = $new_item_name;

		return $this;
	}

	/**
	 * Set parent name
	 *
	 * @param  string  $parent_item  Parent name
	 *
	 * @return  self
	 */
	public function setParent_item(string $parent_item)
	{
		$this->parent_item = $parent_item;

		return $this;
	}

	/**
	 * Set paren item colon
	 *
	 * @param  string  $parent_item_colon  Paren item colon
	 *
	 * @return  self
	 */
	public function setParent_item_colon(string $parent_item_colon)
	{
		$this->parent_item_colon = $parent_item_colon;

		return $this;
	}

	/**
	 * Set search items
	 *
	 * @param  string  $search_items  Search items
	 *
	 * @return  self
	 */
	public function setSearch_items(string $search_items)
	{
		$this->search_items = $search_items;

		return $this;
	}

	/**
	 * Set popular items
	 *
	 * @param  string  $popular_items  Popular items
	 *
	 * @return  self
	 */
	public function setPopular_items(string $popular_items)
	{
		$this->popular_items = $popular_items;

		return $this;
	}

	/**
	 * Set separate items with commas
	 *
	 * @param  string  $separate_items_with_commas  Separate items with commas
	 *
	 * @return  self
	 */
	public function setSeparate_items_with_commas(string $separate_items_with_commas)
	{
		$this->separate_items_with_commas = $separate_items_with_commas;

		return $this;
	}

	/**
	 * Set add or remove items
	 *
	 * @param  string  $add_or_remove_items  Add or remove items
	 *
	 * @return  self
	 */
	public function setAdd_or_remove_items(string $add_or_remove_items)
	{
		$this->add_or_remove_items = $add_or_remove_items;

		return $this;
	}


	/**
	 * Set choose from most used
	 *
	 * @param  string  $choose_from_most_used  Choose from most used
	 *
	 * @return  self
	 */
	public function setChoose_from_most_used(string $choose_from_most_used)
	{
		$this->choose_from_most_used = $choose_from_most_used;

		return $this;
	}

	/**
	 * Set not found
	 *
	 * @param  string  $not_found  Not found
	 *
	 * @return  self
	 */
	public function setNot_found(string $not_found)
	{
		$this->not_found = $not_found;

		return $this;
	}

	/**
	 * Set back to items
	 *
	 * @param  string  $back_to_items  Back to items
	 *
	 * @return  self
	 */
	public function setBack_to_items(string $back_to_items)
	{
		$this->back_to_items = $back_to_items;

		return $this;
	}


	/**
	 * Construct array from class properties
	 * @return array
	 */
	public function getParameters()
	{

		$parameters = [];

		foreach ($this as $key => $value) {
			if ($value) {
				$parameters[$key] = $value;
			}
		}

		return $parameters;
	}
}
