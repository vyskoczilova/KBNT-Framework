<?php

namespace KBNT\Framework\Setup;

use KBNT\Framework\Interfaces\SetupInterface;

class Archive implements SetupInterface {

    /**
	 * Remove archive title
	 * @var bool
	 */
	private $remove_archive_title;

    /**
     * Archive only CPTS
     * @var array
     */
    private $archive_only = [];

    /**
     * Archive show all CPTS
     * @var array
     */
    private $display_all = [];

    /**
     * Archive ordered by
     * @var array
     */
    private $order_by = [];

    /**
     * Initialize
     * @return void
     */
    public function init() {

        if ($this->archive_only) {
            add_action('template_redirect', [$this, 'wp_archive_only']);
        }

        if ($this->remove_archive_title) {
            add_filter('get_the_archive_title', function ($title) {
                if (is_category()) {
                    $title = single_cat_title('', false);
                } elseif (is_tag()) {
                    $title = single_tag_title('', false);
                } elseif (is_author()) {
                    $title = '<span class="vcard">' . get_the_author() . '</span>';
                } elseif (is_tax()) {
                    $title = sprintf(__('%1$s'), single_term_title('', false));
                } elseif (is_post_type_archive()) {
                    $title = post_type_archive_title('', false);
                }
                return $title;
            });
        }

        if (!empty($this->display_all) || !empty($this->order_by) ) {
            add_action('pre_get_posts', function ($query) {
                if (!is_admin() && $query->is_main_query()) {
                    if ($this->display_all && is_post_type_archive($this->display_all)) {
                        $query->set('posts_per_page', -1);
                    }
                    foreach ($this->order_by as $ab) {
                        if (is_post_type_archive($ab['post_type'])) {
                            $query->set('orderby', [$ab['by'] => $ab['how']]);
                        }
                    }
                    // foreach ($this->tax_by as $tb) {
                    //     if (is_tax($tb['taxonomy'])) {
                    //         $query->set('orderby', [$tb['by'] => $tb['how']]);
                    //     }
                    // }
                }
            });
        }

    }


	/**
	 * Set remove archive title
	 *
	 * @return  self
	 */
	public function setRemoveArchiveTitle()
	{
		$this->remove_archive_title = true;

		return $this;
	}

    /**
     * Set archive only CPTS
     *
     * @param  string  $cpt  Custom post type with archive only.
     *
     * @return  self
     */
    public function setArchiveOnly(string $cpt)
    {
        $this->archive_only[] = $cpt;

        return $this;
    }

    /**
     * Redirect page to the archive CPT
     * @source https://themeitems.com/how-to-create-a-archive-only-custom-post-type-in-wordpress/
     * @return void
     */
    public function wp_archive_only()
    {
        foreach ($this->archive_only as $cpt) {
            global $post;
            if (is_singular($cpt)) {
                $redirect_link = get_post_type_archive_link($cpt) . "#" . sanitize_title($post->post_title);
                wp_safe_redirect($redirect_link, 302);
                exit;
            }
        }
    }

    /**
     * Set archive show all CPTS
     *
     * @param  string  $cpt  Custom post type with archive only.
     *
     * @return  self
     */
    public function setDisplayAll(string $cpt)
    {
        $this->display_all[] = $cpt;

        return $this;
    }

    /**
     * Order archive by custom parameters
     * @param mixed $cpt Post type slug.
     * @param string $by By parameter.
     * @param string $how Select order of parameters.
     * @return void
     */
    public function setOrderBy(string $cpt, string $by = 'title', string $how = 'ASC')
    {
        $this->order_by[] = [
            'post_type' => $cpt,
            'by' => $by,
            'how' => $how
        ];
    }

}
