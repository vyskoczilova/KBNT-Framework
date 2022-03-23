<?php

namespace KBNT\Framework\Abstracts;

use KBNT\Framework\Interfaces\ArrayInterface;

abstract class PostTaxonomy extends Data implements ArrayInterface {

	/**
	 * Description
	 * @var string
	 */
	protected $description;

	/**
	 * Public
	 * @var bool
	 */
	protected $public;

	/**
	 * Hierarchical
	 * @var bool
	 */
	protected $hierarchical;

	/**
	 * Publicly queryable
	 * @var bool
	 */
	protected $publicly_queryable;

	/**
	 * Show in menu
	 * @var bool
	 */
	protected $show_in_menu;

	/**
	 * Show in navigation menus
	 * @var bool
	 */
	protected $show_in_nav_menus;

	/**
	 * Show in rest
	 * @var bool
	 */
	protected $show_in_rest = true; // Enable Gutenberg.

	/**
	 * Rest base
	 * @var string
	 */
	protected $rest_base;

	/**
	 * Custom controller for REST
	 * @var string
	 */
	protected $rest_controller_class;

	/**
	 * Show ui
	 * @var bool
	 */
	protected $show_ui;

	/**
	 * Rewrite
	 * @var array
	 */
	protected $rewrite;

	/**
	 * Query var
	 * @var bool|string
	 */
	protected $query_var;

	/**
	 * Public
	 *
	 * @param  mixed  $public  Whether a post type is intended for use publicly either via the admin interface or by front-end users.
	 *
	 * @return  self
	 */
	public function setPublic($public)
	{
		$this->public = $public;

		return $this;
	}


	/**
	 * Set description
	 *
	 * @param  string  $description  A short descriptive summary of what the post type / taxonomy is.
	 *
	 * @return  self
	 */
	public function setDescription(string $description)
	{
		$this->description = $description;

		return $this;
	}

	/**
	 * Set hierarchical
	 *
	 * @param  bool  $hierarchical  Whether the post type / taxonomy is hierarchical (e.g. page, category).
	 *
	 * @return  self
	 */
	public function setHierarchical(bool $hierarchical)
	{
		$this->hierarchical = $hierarchical;

		return $this;
	}

	/**
	 * Set publicly queryable
	 *
	 * @param  bool  $publicly_queryable  Whether queries can be performed on the front end for the post type as part of parse_request(). Endpoints would include: ?post_type={post_type_key}, ?{post_type_key}={single_post_slug}, ?{post_type_query_var}={single_post_slug} If not set, the default is inherited from $public.
	 *
	 * @return  self
	 */
	public function setPubliclyQueryable(bool $publicly_queryable)
	{
		$this->publicly_queryable = $publicly_queryable;

		return $this;
	}

	/**
	 * Set show ui
	 *
	 * @param  bool  $show_ui  Whether to generate and allow a UI for managing this post type in the admin. Default is value of $public.
	 *
	 * @return  self
	 */
	public function setShowUi(bool $show_ui)
	{
		$this->show_ui = $show_ui;

		return $this;
	}

	/**
	 * Set show in menu
	 *
	 * @param  bool|string  $show_in_menu  Where to show the post type in the admin menu. show_ui must be true.
	 * @see https://developer.wordpress.org/reference/functions/register_post_type/#show_in_menu
	 * @return  self
	 */
	public function setShowInMenu($show_in_menu)
	{
		$this->show_in_menu = $show_in_menu;

		return $this;
	}

	/**
	 * Set show in navigation menus
	 *
	 * @param  bool  $show_in_nav_menus  Whether post_type is available for selection in navigation menus.
	 *
	 * @return  self
	 */
	public function setShowInNavMenus(bool $show_in_nav_menus)
	{
		$this->show_in_nav_menus = $show_in_nav_menus;

		return $this;
	}

	/**
	 * Set show in rest
	 *
	 * @param  bool  $show_in_rest  Whether to expose this post type in the REST API. Must be true to enable the Gutenberg editor.
	 *
	 * @return  self
	 */
	public function setShowInRest(bool $show_in_rest)
	{
		$this->show_in_rest = $show_in_rest;

		return $this;
	}

	/**
	 * Set rest base
	 *
	 * @param  string  $rest_base  The base slug that this post type will use when accessed using the REST API.
	 *
	 * @return  self
	 */
	public function setRestBase(string $rest_base)
	{
		$this->rest_base = $rest_base;

		return $this;
	}

	/**
	 * Set custom controller for REST
	 *
	 * @param  string  $rest_controller_class  An optional custom controller to use instead of WP_REST_Posts_Controller. Must be a subclass of WP_REST_Controller.
	 *
	 * @return  self
	 */
	public function setRestControllerClass(string $rest_controller_class)
	{
		$this->rest_controller_class = $rest_controller_class;

		return $this;
	}

	/**
	 * Set rewrite
	 *
	 * @param  array  $rewrite  Rewrite
	 * @see https://developer.wordpress.org/reference/functions/register_post_type/#rewrite
	 * @return  self
	 */
	public function setRewrite($rewrite)
	{

		$this->rewrite = $rewrite;

		return $this;
	}

	/**
	 * Set query var
	 *
	 * @param  bool|string  $query_var  Sets the query_var key for this post type. Default: true – set to $post_type
	 * @see https://developer.wordpress.org/reference/functions/register_post_type/#query_var
	 * @return  self
	 */
	public function setQueryVar($query_var)
	{
		$this->query_var = $query_var;

		return $this;
	}

}
