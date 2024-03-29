<?php

namespace KBNT\Framework\Setup;

use KBNT\Framework\Interfaces\SetupInterface;

class Archive implements SetupInterface
{

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
     * Add one more post to is_home page
     * @var int
     * @see https://sridharkatakam.com/changing-posts-per-page-first-page-without-breaking-pagination-wordpress/
     */
    private $is_home_load_more_posts;

    /**
     * Don't duplicate sticky posts
     * @var bool
     */
    private $dont_duplicate_sticky_posts;

    /**
     * Initialize
     * @return void
     */
    public function init()
    {

        if ($this->archive_only || $this->remove_archive_title || !empty($this->display_all) || !empty($this->order_by) || $this->is_home_load_more_posts !== null || $this->is_home_load_more_posts !== null) {

            add_action('after_setup_theme', function () {

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

                if (!empty($this->display_all) || !empty($this->order_by) || $this->is_home_load_more_posts !== null) {
                    add_action('pre_get_posts', function ($query) {
                        // Don't modify the admin and only modify main query
                        if (is_admin() || !$query->is_main_query()) {
                            return;
                        }
                        if ($this->display_all && (is_post_type_archive($this->display_all) || is_tax($this->display_all))) {
                            $query->set('posts_per_page', -1);
                        }
                        foreach ($this->order_by as $ab) {
                            if (is_post_type_archive($ab['post_type']) || is_tax($ab['post_type'])) {
                                $query->set('orderby', [$ab['by'] => $ab['how']]);
                            }
                        }

                        if ($this->is_home_load_more_posts !== null) {

                            // Only on blog home
                            if (!$query->is_home()) {
                                return;
                            }
                            $posts_per_page = get_option('posts_per_page');

                            // Handle pagination
                            if ($query->is_paged) {

                                // Manually determine page query offset (offset + current page (minus one) x posts per page)

                                // TODO, is this magic?
                                $page_offset = $this->is_home_load_more_posts + (($query->query_vars['paged'] - 1) * $posts_per_page);

                                // Apply adjust page offset
                                $query->set('offset', $page_offset);

                                // Don't duplicate sticky posts
                                if ($this->dont_duplicate_sticky_posts) {
                                    $query->set('post__not_in', get_option('sticky_posts'));
                                }


                            } else {
                                // This is the first page. Set a different number for posts per page
                                $query->set('posts_per_page', $this->is_home_load_more_posts + $posts_per_page);
                            }

                        }
                    });
                }

                if ($this->is_home_load_more_posts !== null) {
                    // Adujust offset pagination.
                    add_filter('found_posts', function ($found_posts, $query) {
                        if ($query->is_home() && is_main_query()) {
                            if ($query->is_paged) {
                                return $found_posts - $this->is_home_load_more_posts;
                            } else {
                                $posts_per_page = get_option('posts_per_page');
                                $first_page = $posts_per_page + $this->is_home_load_more_posts;
                                return ceil(($found_posts - $first_page) / $posts_per_page) * $first_page + 1;
                            }
                        }
                        return $found_posts;
                    }, 1, 2);
                }

            });

        }

    }


    /**
     * Set remove archive title
     *
     * @return  self
     */
    public
    function setRemoveArchiveTitle()
    {
        $this->remove_archive_title = true;

        return $this;
    }

    /**
     * Set archive only CPTS
     *
     * @param string $cpt Custom post type with archive only.
     *
     * @return  self
     */
    public
    function setArchiveOnly(string $cpt)
    {
        $this->archive_only[] = $cpt;

        return $this;
    }

    /**
     * Redirect page to the archive CPT
     * @source https://themeitems.com/how-to-create-a-archive-only-custom-post-type-in-wordpress/
     * @return void
     */
    public
    function wp_archive_only()
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
     * Set archive show all CPTs or Taxonomy
     *
     * @param string $cpt_or_tax Custom post type with archive only.
     *
     * @return  self
     */
    public
    function setDisplayAll(string $cpt_or_tax)
    {
        $this->display_all[] = $cpt_or_tax;

        return $this;
    }

    /**
     * Order archive by custom parameters
     * @param mixed $cpt_or_tax Post type or Taxonomy slug.
     * @param string $by By parameter.
     * @param string $how Select order of parameters.
     * @return void
     */
    public
    function setOrderBy(string $cpt_or_tax, string $by = 'title', string $how = 'ASC')
    {
        $this->order_by[] = [
            'post_type' => $cpt_or_tax,
            'by' => $by,
            'how' => $how
        ];
    }

    /**
     * Do not increase posts_per_page number because of sticky posts.
     * @param bool $dont_duplicate_sticky_posts Do not duplicate sticky posts (default WP behavior is to duplicate sticky posts)
     * @return void
     */
    public function setStickyPostsWithinPostsPerPageCount($dont_duplicate_sticky_posts = false) {
        $sticky_posts_count = get_option('sticky_posts') ? count(get_option('sticky_posts')) * -1 : 0;
        $this->loadMorePostOnIsHome($sticky_posts_count);
        $this->dont_duplicate_sticky_posts = $dont_duplicate_sticky_posts;
    }

    /**
     * Load one more post on first page of is_home()
     * @param bool $one_more_post Load one more post?
     * @return $this
     */
    /**
     * Load  more post on first page of is_home()
     * @param int $number_of_posts_to_add Number of posts to add
     * @return $this
     */
    public
    function loadMorePostOnIsHome(int $number_of_posts_to_add = 1)
    {
        $this->is_home_load_more_posts = $number_of_posts_to_add;
        return $this;
    }

}
