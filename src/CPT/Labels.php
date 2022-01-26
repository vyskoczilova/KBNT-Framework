<?php

namespace KBNT\Framework\CPT;

use KBNT\Framework\Abstracts\PostTaxonomyLabels;

/**
 * CPT Labels
 *
 * @see https://developer.wordpress.org/reference/functions/get_post_type_labels/
 * @package KBNT\Framework\CPT
 */
class Labels extends PostTaxonomyLabels
{


	/**
	 * Add new post
	 * @var string
	 */
	private $add_new;

	/**
	 * New item
	 * @var string
	 */
	private $new_item;

	/**
	 * View items
	 * @var string
	 */
	private $view_items;

	/**
	 * Search items
	 * @var string
	 */
	private $search_items;

	/**
	 * Not found
	 * @var string
	 */
	private $not_found;

	/**
	 * Not found in trash
	 * @var string
	 */
	private $not_found_in_trash;

	/**
	 * Parent item colin
	 * @var string
	 */
	private $parent_item_colon;

	/**
	 * All items
	 * @var string
	 */
	private $all_items;

	/**
	 * Archives
	 * @var string
	 */
	private $archives;

	/**
	 * Attributes
	 * @var string
	 */
	private $attributes;

	/**
	 * Insert into item
	 * @var string
	 */
	private $insert_into_item;

	/**
	 * Uploaded to this item
	 * @var string
	 */
	private $uploaded_to_this_item;

	/**
	 * Featured image
	 * @var string
	 */
	private $featured_image;

	/**
	 * Set feature mage
	 * @var string
	 */
	private $set_featured_image;

	/**
	 * Remove featured image
	 * @var string
	 */
	private $remove_featured_image;

	/**
	 * Used feature image
	 * @var string
	 */
	private $use_featured_image;

	/**
	 * Menu name
	 * @var string
	 */
	private $menu_name;

	/**
	 * Filter items list
	 * @var string
	 */
	private $filter_items_list;

	/**
	 * Filter by date
	 * @var string
	 */
	private $filter_by_date;

	/**
	 * Items list navigation
	 * @var string
	 */
	private $items_list_navigation;

	/**
	 * Items list
	 * @var string
	 */
	private $items_list;

	/**
	 * Item published
	 * @var string
	 */
	private $item_published;

	/**
	 * Item published privately
	 * @var string
	 */
	private $item_published_privately;

	/**
	 * Item reverted to draft
	 * @var string
	 */
	private $item_reverted_to_draft;

	/**
	 * Item scheduled
	 * @var string
	 */
	private $item_scheduled;

	/**
	 * Item updated
	 * @var string
	 */
	private $item_updated;

	/**
	 * Item link
	 * @var string
	 */
	private $item_link;

	/**
	 * Item link description
	 * @var string
	 */
	private $item_link_description;

	/**
	 * Set Add new post
	 *
	 * @param  string  $add_newpost  Default is ‘Add New’ for both hierarchical and non-hierarchical types. When internationalizing this string, please use a gettext context matching your type. Example: _x( 'Add New', 'product', 'textdomain' );
	 *
	 * @return  self
	 */
	public function setAddNew(string $add_newpost)
	{
		$this->add_new = $add_newpost;

		return $this;
	}

	/**
	 * Set New item
	 *
	 * @param  string  $new_item  Label for the new item page title. Default is ‘New Post’ / ‘New Page’.
	 *
	 * @return  self
	 */
	public function setNewItem(string $new_item)
	{
		$this->new_item = $new_item;

		return $this;
	}

	/**
	 * Set View items
	 *
	 * @param  string  $view_items  Label for viewing post type archives. Default is ‘View Posts’ / ‘View Pages’.
	 *
	 * @return  self
	 */
	public function setViewItems(string $view_items)
	{
		$this->view_items = $view_items;

		return $this;
	}

	/**
	 * Set Search items
	 *
	 * @param  string  $search_items  Label for searching plural items. Default is ‘Search Posts’ / ‘Search Pages’.
	 *
	 * @return  self
	 */
	public function setSearchItems(string $search_items)
	{
		$this->search_items = $search_items;

		return $this;
	}

	/**
	 * Set Not found
	 *
	 * @param  string  $not_found  Label used when no items are found. Default is ‘No posts found’ / ‘No pages found’.
	 *
	 * @return  self
	 */
	public function setNotFound(string $not_found)
	{
		$this->not_found = $not_found;

		return $this;
	}

	/**
	 * Set Not found in trash
	 *
	 * @param  string  $not_found_in_trash  Label used when no items are in the Trash. Default is ‘No posts found in Trash’ / ‘No pages found in Trash’.
	 *
	 * @return  self
	 */
	public function setNotFoundInTrash(string $not_found_in_trash)
	{
		$this->not_found_in_trash = $not_found_in_trash;

		return $this;
	}

	/**
	 * Set Parent item colin
	 *
	 * @param  string  $parent_item_colon  Label used to prefix parents of hierarchical items. Not used on non-hierarchical post types. Default is ‘Parent Page:’.
	 *
	 * @return  self
	 */
	public function setParenItemColon(string $parent_item_colon)
	{
		$this->parent_item_colon = $parent_item_colon;

		return $this;
	}




	/**
	 * Set All items
	 *
	 * @param  string  $all_items  Label to signify all items in a submenu link. Default is ‘All Posts’ / ‘All Pages’.
	 *
	 * @return  self
	 */
	public function setAllItems(string $all_items)
	{
		$this->all_items = $all_items;

		return $this;
	}

	/**
	 * Set Archives
	 *
	 * @param  string  $archives  Label for archives in nav menus. Default is ‘Post Archives’ / ‘Page Archives’.
	 *
	 * @return  self
	 */
	public function setArchives(string $archives)
	{
		$this->archives = $archives;

		return $this;
	}

	/**
	 * Set Attributes
	 *
	 * @param  string  $attributes  Label for the attributes meta box. Default is ‘Post Attributes’ / ‘Page Attributes’.
	 *
	 * @return  self
	 */
	public function setAttributes(string $attributes)
	{
		$this->attributes = $attributes;

		return $this;
	}

	/**
	 * Set Insert into item
	 *
	 * @param  string  $insert_into_item  Label for the media frame button. Default is ‘Insert into post’ / ‘Insert into page’.
	 *
	 * @return  self
	 */
	public function setInsertIntoItem(string $insert_into_item)
	{
		$this->insert_into_item = $insert_into_item;

		return $this;
	}

	/**
	 * Set Uploaded to this item
	 *
	 * @param  string  $uploaded_to_this_item  Label for the media frame filter. Default is ‘Uploaded to this post’ / ‘Uploaded to this page’.
	 *
	 * @return  self
	 */
	public function setUploadedToThisItem(string $uploaded_to_this_item)
	{
		$this->uploaded_to_this_item = $uploaded_to_this_item;

		return $this;
	}

	/**
	 * Set Featured image
	 *
	 * @param  string  $featured_image  Label for the featured image meta box title. Default is ‘Featured image’.
	 *
	 * @return  self
	 */
	public function setFeaturedImage(string $featured_image)
	{
		$this->featured_image = $featured_image;

		return $this;
	}

	/**
	 * Set Set feature mage
	 *
	 * @param  string  $set_featured_image  Label for setting the featured image. Default is ‘Set featured image’.
	 *
	 * @return  self
	 */
	public function setSetFeaturedImage(string $set_featured_image)
	{
		$this->set_featured_image = $set_featured_image;

		return $this;
	}

	/**
	 * Set Remove featured image
	 *
	 * @param  string  $remove_featured_image  Label for removing the featured image. Default is ‘Remove featured image’.
	 *
	 * @return  self
	 */
	public function setRemoveFeaturedImage(string $remove_featured_image)
	{
		$this->remove_featured_image = $remove_featured_image;

		return $this;
	}

	/**
	 * Set Used feature image
	 *
	 * @param  string  $use_featured_image  Label in the media frame for using a featured image. Default is ‘Use as featured image’.
	 *
	 * @return  self
	 */
	public function setUseFeaturedImage(string $use_featured_image)
	{
		$this->use_featured_image = $use_featured_image;

		return $this;
	}

	/**
	 * Set Menu name
	 *
	 * @param  string  $menu_name  Label for the menu name. Default is the same as name.
	 *
	 * @return  self
	 */
	public function setMenuName(string $menu_name)
	{
		$this->menu_name = $menu_name;

		return $this;
	}

	/**
	 * Set Filter items list
	 *
	 * @param  string  $filter_items_list  Label for the table views hidden heading. Default is ‘Filter posts list’ / ‘Filter pages list’.
	 *
	 * @return  self
	 */
	public function setFilterItemsList(string $filter_items_list)
	{
		$this->filter_items_list = $filter_items_list;

		return $this;
	}



	/**
	 * Set Filter by date
	 *
	 * @param  string  $filter_by_date  Label for the date filter in list tables. Default is ‘Filter by date’.
	 *
	 * @return  self
	 */
	public function setFilterByDate(string $filter_by_date)
	{
		$this->filter_by_date = $filter_by_date;

		return $this;
	}

	/**
	 * Set Items list navigation
	 *
	 * @param  string  $items_list_navigation  Label for the table pagination hidden heading. Default is ‘Posts list navigation’ / ‘Pages list navigation’.
	 *
	 * @return  self
	 */
	public function setItemsListNavigation(string $items_list_navigation)
	{
		$this->items_list_navigation = $items_list_navigation;

		return $this;
	}

	/**
	 * Set Items list
	 *
	 * @param  string  $items_list  Label for the table hidden heading. Default is ‘Posts list’ / ‘Pages list’.
	 *
	 * @return  self
	 */
	public function setItemsList(string $items_list)
	{
		$this->items_list = $items_list;

		return $this;
	}

	/**
	 * Set Item published
	 *
	 * @param  string  $item_published  Label used when an item is published. Default is ‘Post published.’ / ‘Page published.’
	 *
	 * @return  self
	 */
	public function setItemPublished(string $item_published)
	{
		$this->item_published = $item_published;

		return $this;
	}

	/**
	 * Set Item published privately
	 *
	 * @param  string  $item_published_privately  Label used when an item is published with private visibility. Default is ‘Post published privately.’ / ‘Page published privately.’
	 *
	 * @return  self
	 */
	public function setItemPublishedPrivately(string $item_published_privately)
	{
		$this->item_published_privately = $item_published_privately;

		return $this;
	}

	/**
	 * Set Item reverted to draft
	 *
	 * @param  string  $item_reverted_to_draft  Label used when an item is switched to a draft. Default is ‘Post reverted to draft.’ / ‘Page reverted to draft.’
	 *
	 * @return  self
	 */
	public function setItemRevertedToDraft(string $item_reverted_to_draft)
	{
		$this->item_reverted_to_draft = $item_reverted_to_draft;

		return $this;
	}

	/**
	 * Set Item scheduled
	 *
	 * @param  string  $item_scheduled  Label used when an item is scheduled for publishing. Default is ‘Post scheduled.’ / ‘Page scheduled.’
	 *
	 * @return  self
	 */
	public function setItemScheduled(string $item_scheduled)
	{
		$this->item_scheduled = $item_scheduled;

		return $this;
	}

	/**
	 * Set Item updated
	 *
	 * @param  string  $item_updated  Label used when an item is updated. Default is ‘Post updated.’ / ‘Page updated.’
	 *
	 * @return  self
	 */
	public function setItemUpdated(string $item_updated)
	{
		$this->item_updated = $item_updated;

		return $this;
	}


	/**
	 * Set Item link
	 *
	 * @param  string  $item_link  Title for a navigation link block variation. Default is ‘Post Link’ / ‘Page Link’.
	 *
	 * @return  self
	 */
	public function setItemLink(string $item_link)
	{
		$this->item_link = $item_link;

		return $this;
	}

	/**
	 * Set Item link description
	 *
	 * @param  string  $item_link_description  Description for a navigation link block variation. Default is ‘A link to a post.’ / ‘A link to a page.’
	 *
	 * @return  self
	 */
	public function setItemLinkDescription(string $item_link_description)
	{
		$this->item_link_description = $item_link_description;

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
