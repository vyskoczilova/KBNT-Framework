<?php

namespace KBNT\Framework\Taxonomy;

use KBNT\Framework\Abstracts\PostTaxonomy;

/**
 * https://developer.wordpress.org/reference/functions/register_taxonomy/
 * @package KBNT\Framework\Taxonomy
 */
class CustomTaxonomy extends PostTaxonomy {

	/**
	 * Labels
	 * @var Labels
	 */
	protected $labels;

	/**
	 * Name
	 * @var string
	 */
	private $name;

	/**
	 * Singular name
	 * @var string
	 */
	private $singular_name;

	/**
	 * Menu name
	 * @var string
	 */
	private $menu_name;

	/**
	 * Show Tag Cloud
	 * @var bool
	 */
	private $show_tagcloud;

	/**
	 * Show admin column
	 * @var bool
	 */
	private $show_admin_column;

	/**
	 * Meta box callback
	 * @var string
	 */
	private $meta_box_cb;

	/**
	 * Meta box sanitize callback
	 * @var string
	 */
	private $meta_box_sanitize_cb;

	/**
	 * Capabilities
	 * @var array
	 */
	private $capabilites;

	/**
	 * Update count callback
	 * @var string
	 */
	private $update_count_callback;

	/**
	 * Default term
	 * @var array|string
	 */
	private $default_term;

	/**
	 * Sort
	 * @var bool
	 */
	private $sort;

	/**
	 * Args
	 * @var array
	 */
	private $args;

	/**
	 * Show in quick edit
	 * @var bool
	 */
	private $show_in_quick_edit;

	/**
	 * Set show Tag Cloud
	 *
	 * @param  bool  $show_tagcloud   Whether to list the taxonomy in the Tag Cloud Widget controls. If not set, the default is inherited from $show_ui (default true).
	 *
	 * @return  self
	 */
	public function setShowTagcloud(bool $show_tagcloud)
	{
		$this->show_tagcloud = $show_tagcloud;

		return $this;
	}

	/**
	 * Set show admin column
	 *
	 * @param  bool  $show_admin_column  Whether to display a column for the taxonomy on its post type listing screens. Default false.
	 *
	 * @return  self
	 */
	public function setShowAdminColumn(bool $show_admin_column)
	{
		$this->show_admin_column = $show_admin_column;

		return $this;
	}

	/**
	 * Set meta box callback
	 *
	 * @param  string  $meta_box_cb   Provide a callback function for the meta box display. If not set, post_categories_meta_box() is used for hierarchical taxonomies, and post_tags_meta_box() is used for non-hierarchical. If false, no meta box is shown.
	 *
	 * @return  self
	 */
	public function setMetaBoxCb(string $meta_box_cb)
	{
		$this->meta_box_cb = $meta_box_cb;

		return $this;
	}

	/**
	 * Set capabilities
	 *
	 * @param  array  $capabilites  Array of capabilities for this taxonomy.
	 *
	 * @return  self
	 */
	public function setCapabilites(array $capabilites)
	{
		$this->capabilites = $capabilites;

		return $this;
	}

	/**
	 * Set update count callback
	 *
	 * @param  string  $update_count_callback  Works much like a hook, in that it will be called when the count is updated. Default _update_post_term_count() for taxonomies attached to post types, which confirms that the objects are published before counting them. Default _update_generic_term_count() for taxonomies attached to other object types, such as users.
	 *
	 * @return  self
	 */
	public function setUpdateCountCallback(string $update_count_callback)
	{
		$this->update_count_callback = $update_count_callback;

		return $this;
	}

	/**
	 * Set default term
	 *
	 * @param  array|string  $default_term   Default term to be used for the taxonomy.
	 *
	 * @return  self
	 */
	public function setDefaultTerm($default_term)
	{
		$this->default_term = $default_term;

		return $this;
	}

	/**
	 * Set sort
	 *
	 * @param  bool  $sort  Whether terms in this taxonomy should be sorted in the order they are provided to wp_set_object_terms(). Default null which equates to false.
	 *
	 * @return  self
	 */
	public function setSort(bool $sort)
	{
		$this->sort = $sort;

		return $this;
	}

	/**
	 * Set args
	 *
	 * @param  array  $args  Array of arguments to automatically use inside wp_get_object_terms() for this taxonomy.
	 *
	 * @return  self
	 */
	public function setArgs(array $args)
	{
		$this->args = $args;

		return $this;
	}

	/**
	 * Set meta box sanitize callback
	 *
	 * @param  string  $meta_box_sanitize_cb  Callback function for sanitizing taxonomy data saved from a meta box. If no callback is defined, an appropriate one is determined based on the value of $meta_box_cb.
	 *
	 * @return  self
	 */
	public function setMetaBoxSanitizeCb(string $meta_box_sanitize_cb)
	{
		$this->meta_box_sanitize_cb = $meta_box_sanitize_cb;

		return $this;
	}

	/**
	 * Set show in quick edit
	 *
	 * @param  bool  $show_in_quick_edit  Whether to show the taxonomy in the quick/bulk edit panel. It not set, the default is inherited from $show_ui (default true).
	 *
	 * @return  self
	 */
	public function setShowInQuickEdit(bool $show_in_quick_edit)
	{
		$this->show_in_quick_edit = $show_in_quick_edit;

		return $this;
	}

	/**
	 * Set labels
	 *
	 * @param  Labels  $labels  Labels
	 *
	 * @return  Labels
	 */
	public function setLabels()
	{
		$this->labels = new Labels();

		return $this->labels;
	}

	/**
	 * Set name
	 *
	 * @param  string  $name  Name
	 *
	 * @return  self
	 */
	public function setName(string $name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Set singular name
	 *
	 * @param  string  $singular_name  Singular name
	 *
	 * @return  self
	 */
	public function setSingularName(string $singular_name)
	{
		$this->singular_name = $singular_name;

		return $this;
	}

	/**
	 * Set menu name
	 *
	 * @param  string  $menu_name  Menu name
	 *
	 * @return  self
	 */
	public function setMenuName(string $menu_name)
	{
		$this->menu_name = $menu_name;

		return $this;
	}

	/**
	 * Construct array from class properties
	 * @return array
	 */
	public function getParameters()
	{

		$default = [
			'label' => $this->name,
			'labels' => [
				'name' => $this->name,
				'singular_name' => $this->name,
				'menu_name' => $this->name,
			]
		];
		$parameters = [];

		foreach ($this as $key => $value) {
			if ($value) {
				if ($key === 'labels') {
					$parameters[$key] = \wp_parse_args($value->getParameters(), $default['labels']);
				} else {
					$parameters[$key] = $value;
				}
			}
		}

		$parameters = \wp_parse_args($parameters, $default);

		return $parameters;
	}
}
