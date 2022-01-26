<?php

namespace KBNT\Framework\CPT;

use KBNT\Framework\Abstracts\PostTaxonomy;

class CustomPost extends PostTaxonomy
{

	/**
	 * Labels
	 * @var Labels
	 */
	private $labels;

	/**
	 * Label
	 * @var string
	 */
	private $label;

	/**
	 * Exclude form public
	 * @var bool
	 */
	private $exclude_from_search;

	/**
	 * Show in admin bar
	 * @var bool
	 */
	private $show_in_admin_bar;

	/**
	 * Icon
	 * @var string
	 */
	private $menu_icon;

	/**
	 * Capability type
	 * @var string|array
	 */
	private $capability_type;

	/**
	 * Capabilities
	 * @var array
	 */
	private $capabilities;

	/**
	 * Map Meta Cap
	 * @var bool
	 */
	private $map_meta_cap;

	/**
	 * Register meta box callback
	 * @var callback
	 */
	private $register_meta_box_cb;

	/**
	 * Taxonomies
	 * @var array
	 */
	private $taxonomies;

	/**
	 * Has Archive
	 * @var bool|string
	 */
	private $has_archive;

	/**
	 * Cam export
	 * @var bool
	 */
	private $can_export;

	/**
	 * Delete with user
	 * @var bool
	 */
	private $delete_with_user;

	/**
	 * Menu position
	 * @var int
	 */
	private $menu_position;

	/**
	 * Supports
	 * @var array
	 */
	private $supports = ['title', 'editor', 'revisions', 'thumbnail', 'excerpt'];

	/**
	 * Template
	 * @var array
	 */
	private $template;

	/**
	 * Set label
	 *
	 * @param  string  $label  Name of the post type shown in the menu. Usually plural. Default is value of $labels['name'].
	 *
	 * @return  self
	 */
	public function setLabel(string $label)
	{
		$this->label = $label;

		return $this;
	}

	/**
	 * Set icon
	 *
	 * @param  string  $icon  The url to the icon to be used for this menu or the name of the icon from the iconfont.
	 * @see https://developer.wordpress.org/reference/functions/register_post_type/#menu_icon
	 * @return  self
	 */
	public function setMenuIcon(string $icon)
	{
		$this->menu_icon = $icon;

		return $this;
	}

	/**
	 * Set menu position
	 *
	 * @param  int  $menu_position   The position in the menu order the post type should appear. show_in_menu must be true.
	 * @see https://developer.wordpress.org/reference/functions/register_post_type/#menu_position
	 * @return  self
	 */
	public function setMenuPosition(int $menu_position)
	{
		$this->menu_position = $menu_position;

		return $this;
	}

	/**
	 * Set supports
	 *
	 * @param  array  $supports  Supports
	 * @see https://developer.wordpress.org/reference/functions/register_post_type/#supports
	 * @return  self
	 */
	public function setSupports(array $supports)
	{

		$allowed = ['title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'];
		$this->supports = $this->arrayOnlyAllowedValues($supports, $allowed);

		return $this;
	}

	/**
	 * Set exclude form public
	 *
	 * @param  bool  $exclude_from_search  Whether to exclude posts with this post type from front end search results. Default is the opposite value of $public.
	 *
	 * @return  self
	 */
	public function setExcludeFromSearch(bool $exclude_from_search)
	{
		$this->exclude_from_search = $exclude_from_search;

		return $this;
	}

	/**
	 * Set show in admin bar
	 *
	 * @param  bool  $show_in_admin_bar  Whether to make this post type available in the WordPress admin bar. Default: value of the show_in_menu argument.
	 *
	 * @return  self
	 */
	public function setShowInAdminBar(bool $show_in_admin_bar)
	{
		$this->show_in_admin_bar = $show_in_admin_bar;

		return $this;
	}

	/**
	 * Set capability type
	 *
	 * @param  string|array  $capability_type  The string to use to build the read, edit, and delete capabilities.
	 * @see https://developer.wordpress.org/reference/functions/register_post_type/#capability_type
	 * @return  self
	 */
	public function setCapabilityType($capability_type)
	{
		$this->capability_type = $capability_type;

		return $this;
	}

	/**
	 * Set capabilities
	 *
	 * @param  array  $capabilities  An array of the capabilities for this post type.
	 * @see https://developer.wordpress.org/reference/functions/register_post_type/#capabilities
	 * @return  self
	 */
	public function setCapabilities(array $capabilities)
	{
		$this->capabilities = $capabilities;

		return $this;
	}

	/**
	 * Set map Meta Cap
	 *
	 * @param  bool  $map_meta_cap  Whether to use the internal default meta capability handling.
	 *
	 * @return  self
	 */
	public function setMapMetaCap(bool $map_meta_cap)
	{
		$this->map_meta_cap = $map_meta_cap;

		return $this;
	}

	/**
	 * Set register meta box callback
	 *
	 * @param  callback  $register_meta_box_cb   Provide a callback function that will be called when setting up the meta boxes for the edit form.
	 * @see https://developer.wordpress.org/reference/functions/register_post_type/#register_meta_box_cb
	 * @return  self
	 */
	public function setRegisterMetaBoxCallback($register_meta_box_cb)
	{
		$this->register_meta_box_cb = $register_meta_box_cb;

		return $this;
	}

	/**
	 * Set taxonomies
	 *
	 * @param  array  $taxonomies  An array of registered taxonomies like category or post_tag that will be used with this post type.
	 *
	 * @return  self
	 */
	public function setTaxonomies(array $taxonomies)
	{
		$this->taxonomies = $taxonomies;

		return $this;
	}

	/**
	 * Set has Archive
	 *
	 * @param  bool|string  $has_archive  Enables post type archives. Will use $post_type as archive slug by default. Default false.
	 *
	 * @return  self
	 */
	public function setHasArchive($has_archive)
	{
		$this->has_archive = $has_archive;

		return $this;
	}

	/**
	 * Set can export
	 *
	 * @param  bool  $can_export  Can this post_type be exported.
	 *
	 * @return  self
	 */
	public function setCanExport(bool $can_export)
	{
		$this->can_export = $can_export;

		return $this;
	}

	/**
	 * Set delete with user
	 *
	 * @param  bool  $delete_with_user  Whether to delete posts of this type when deleting a user. If true, posts of this type belonging to the user will be moved to trash when then user is deleted. If false, posts of this type belonging to the user will not be trashed or deleted. If not set (the default), posts are trashed if post_type_supports('author'). Otherwise posts are not trashed or deleted.
	 *
	 * @return  self
	 */
	public function setDeleteWithUser(bool $delete_with_user)
	{
		$this->delete_with_user = $delete_with_user;

		return $this;
	}

	/**
	 * Template
	 * @param array $template Block template layout.
	 * @return $this
	 */
	public function setTemplate(array $template) {
		$this->template = $template;

		return $this;
	}

    /**
     * Set labels
     *
     * @return  Labels
     */
	public function setLabels()
	{
		$this->labels = new Labels();

		return $this->labels;
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
				if ($key === 'labels') {
                    $parameters[$key] = $value->getParameters();
				} else {
                    $parameters[$key] = $value;
				}
			}
		}

		return $parameters;
	}
}
