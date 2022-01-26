<?php

namespace KBNT\Framework\CPT;

use KBNT\Framework\Interfaces\SetupInterface;

class CustomPosts implements SetupInterface {

	/**
	 * CPTs to register
	 * @var array
	 */
	private $cpts = [];

	/**
	 * Initialize.
	 * @return bool
	 */
	public function init()
	{
		// Register post types.
		add_action('init', function() {
			foreach ($this->cpts as $slug => $cpt) {
				\register_post_type($slug, $cpt->getParameters());
			}
		}, 10, 1);
	}

	/**
	 * New CPT to register
	 * @param string $slug Slug.
	 * @return CustomPost
	 */
	public function registerCustomPostType(string $slug)
	{
		$this->cpts[$slug] = new CustomPost();
		return end($this->cpts);
	}

}
