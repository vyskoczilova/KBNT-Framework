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
	 * taxonomies to unregister
	 * @var array
	 */
	private $unregister_taxonomies_for_object_type = [];

	/**
	 * Initialize.
	 * @return bool
	 */
	public function init()
	{
		// Register post types.
		add_action('init', function() {
			foreach ($this->taxonomies as $slug => $tax) {
				\register_taxonomy($slug, $tax['post_types'], $tax['args']->getParameters());
			}
            foreach($this->unregister_taxonomies_for_object_type as $ut) {
                \unregister_taxonomy_for_object_type(...$ut);
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

    /**
     * Remove Taxonomy from Post Type
     * @param string $taxonomy Taxonomy to unregister.
     * @param string $post_type Post type.
     * @return self
     */
    public function removeTaxonomyFromPostType($taxonomy, $post_type)
    {
        $this->unregister_taxonomies_for_object_type[] = [$taxonomy, $post_type];

        return $this;
    }

}
