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
     * Add taxonomy filter for admin
     * @var array
     */
    private $add_filter_in_admin = [];

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

        $this->show_taxonomy_filter_in_admin();
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

    /**
     * Add filter in admin for selected taxonomy
     * @param mixed $taxonomy Taxonomy.
     * @return void
     */
    public function addTaxonomyFilterInAdmin($taxonomy) {
        $this->add_filter_in_admin[] = $taxonomy;
    }

    /**
     * Show taxonomy filter in admin action
     * @return void
     */
    private function show_taxonomy_filter_in_admin() {
        foreach($this->add_filter_in_admin as $taxonomy) {
            add_action('restrict_manage_posts', function() use ($taxonomy) {
                $taxonomy_object = \get_taxonomy($taxonomy);
                \wp_dropdown_categories([
                    'show_option_all' => "— {$taxonomy_object->labels->name} —",
                    'taxonomy' => $taxonomy,
                    'name' => $taxonomy,
                    'orderby' => 'name',
                    'selected' => \get_query_var($taxonomy),
                    'hierarchical' => true,
                    'depth' => 3,
                    'show_count' => false,
                    'hide_if_empty' => false,
                    'value_field' => 'slug',
                ]);
            });
        }
    }

}
