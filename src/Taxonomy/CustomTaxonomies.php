<?php

namespace KBNT\Framework\Taxonomy;

use KBNT\Framework\Interfaces\SetupInterface;

class CustomTaxonomies implements SetupInterface {

	/**
	 * CPTs to register
	 * @var array
	 */
	private $taxonomies = [];

	/**
	 * Initialize.
	 * @return bool
	 */
	public function init()
	{
		// Register post types.
		add_action('init', function() {
			foreach ($this->taxonomies as $slug => $tax) {
				$info = $tax['args']->getParameters();
				\register_taxonomy($slug, $tax['post_types'], $tax['args']->getParameters());
			}
		}, 10, 1);
	}

	/**
	 * New taxonomy to register
	 * @param string $slug Slug.
	 * @param array $post_types Post types.
	 * @return CustomTaxonomy
	 */
	public function registerCustomTaxonomy(string $slug, array $post_types)
	{
		$this->taxonomies[$slug] = [
			'post_types' => $post_types,
			'args' => new CustomTaxonomy()
		];
		$last = end($this->taxonomies);

		return $last['args'];
	}

}
