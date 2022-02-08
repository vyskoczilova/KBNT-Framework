<?php

namespace KBNT\Framework\ACF;

class Options
{
    /**
     * Return ALL ACF options values
     *
     * Better performance than get_fields('options') native function. Same format. But better to test carefully.
     *
     *
     * @return array
     */
    public function getByPrefix($prefix = 'options_')
    {

        global $wpdb;
        $options = [];
        $image_ids = [];

        // WPML compatibility.
        $check_language_prefix = false;
        if (defined('ICL_LANGUAGE_CODE')) {
            global $sitepress;
            $check_language_prefix = \ICL_LANGUAGE_CODE === $sitepress->get_default_language() ? false : \ICL_LANGUAGE_CODE;
            if ($check_language_prefix) {
                $prefix = str_replace('options_', 'options_' . $check_language_prefix . '_', $prefix);
            }
        }
        $sql_results = $wpdb->get_results("SELECT option_name, option_value FROM $wpdb->options WHERE option_name LIKE '{$prefix}_%'");


        if ($sql_results) {

            // Parse values
            foreach ($sql_results as $r) {

                // Unserilize the value.
                $value = \maybe_unserialize($r->option_value);

                if ($check_language_prefix) {
                    $options[substr($r->option_name, strlen($prefix) + 4)] = $value;
                } else {
                    $options[substr($r->option_name, strlen($prefix) + 1)] = $value;
                }
            }

            // Retrieve attachment IDS.
            foreach ($options as $o) {
                $image_ids = array_merge($image_ids, $this->parse_attachment_ids($o));
            }

            // Get attachment meta from WP.
            if (!empty($image_ids)) {

                // See https://developer.wordpress.org/reference/classes/wpdb/prepare/#user-contributed-notes.
                $image_ids_placeholders = implode(', ', array_fill(0, count($image_ids), '%s'));

                // Retrieve image's metadata.
                $attachment_results = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->posts.ID =  $wpdb->postmeta.post_id WHERE $wpdb->posts.ID IN ($image_ids_placeholders) AND $wpdb->postmeta.meta_key LIKE '_wp_attachment_metadata' OR $wpdb->postmeta.meta_key LIKE '_wp_attachment_image_alt' ORDER BY $wpdb->postmeta.meta_key ASC", $image_ids));

                // SELECT * FROM wp_posts LEFT JOIN wp_postmeta ON wp_posts.ID = wp_postmeta.post_id WHERE wp_posts.ID IN ('383', '370', '368', '367', '369', '373', '371', '372') AND wp_postmeta.meta_key LIKE '_wp_attachment_metadata' OR wp_postmeta.meta_key LIKE '_wp_attachment_image_alt' ORDER BY wp_postmeta.meta_key ASC

                if ($attachment_results) {

                    // Prepare images and it'v values.
                    $images = [];
                    $image_alts = [];

                    // Get alternative texts
                    foreach ($attachment_results as $arv) {
                        if ('_wp_attachment_image_alt' === $arv->meta_key) {
                            $image_alts[$arv->post_id] = $arv->meta_value;
                        }
                    }

                    // Get image values
                    foreach ($attachment_results as $ar) {
                        $alt = isset($image_alts[$ar->ID]) ? $image_alts[$ar->ID] : '';
                        $images[$ar->ID] = $this->prepare_attachment_for_js($ar, \maybe_unserialize($ar->meta_value), $alt);
                    }

                    if (!empty($images)) {
                        // Parse the real ACF option values with new data.
                        foreach ($options as $key => $value) {

                            if (is_array($value)) {
                                $new_value = [];
                                foreach ($value as $k => $v) {
                                    if (isset($images[$v])) {
                                        $new_value[$k] = $images[$v];
                                    } else {
                                        $new_value[$k] = $v;
                                    }
                                }
                                $options[$key] = $new_value;
                            } else
							if (!is_array($value) && isset($images[$value])) {
                                $options[$key] = $images[$value];
                            }
                        }
                    }
                }
            }
        }

        return $options;
    }

    /**
     * Retrieve potential attachment IDs from values
     *
     * @param string $value ACF option_value.
     */
    private function parse_attachment_ids($value)
    {

        $attachment_ids = [];

        if (is_numeric($value)) {
            $attachment_ids[] = $value;
        } elseif (is_array($value)) {
            // This solves another query when gallery is used. But not same as ACF function.
            foreach ($value as $v) {
                if (is_numeric($v)) {
                    $attachment_ids[] = $v;
                }
            }
        }

        return $attachment_ids;
    }

    /**
     * Modified implelementation of WP's wp_prepare_attachment_for_js() function
     *
     * See https://developer.wordpress.org/reference/functions/wp_prepare_attachment_for_js/.
     * Modified just few topmost lines - the data is loaded by single query not multiple WP functions.
     * @param object $attachment
     * @param array $meta Meta data of attachment
     * @param string $alt Alternative text of image.
     *
     * @return void
     * @since: 1.2.3
     */
    private function prepare_attachment_for_js($attachment, $meta, $alt)
    {


        if (!$attachment) {
            return;
        }

        if ('attachment' !== $attachment->post_type) {
            return;
        }

        if (false !== strpos($attachment->post_mime_type, '/')) {
            list($type, $subtype) = explode('/', $attachment->post_mime_type);
        } else {
            list($type, $subtype) = array($attachment->post_mime_type, '');
        }

        $attachment_url = $attachment->guid; // One less query.
        $base_url       = str_replace(wp_basename($attachment_url), '', $attachment_url);

        $response = array(
            'ID'            => $attachment->ID,
            'id'            => $attachment->ID,
            'title'         => $attachment->post_title,
            'filename'      => wp_basename($attachment->guid),
            'filesize'      => 0, // In the WP's original code there is how to get it, but one more query.
            'url'           => $attachment_url,
            'link'          => '', // In the WP's original code there is how to get, it but one more query.
            'alt'           => $alt,
            'author'        => $attachment->post_author,
            'description'   => $attachment->post_content,
            'caption'       => $attachment->post_excerpt,
            'name'          => $attachment->post_name,
            'status'        => $attachment->post_status,
            'uploadedTo'    => $attachment->post_parent,
            'date'          => $attachment->post_date_gmt,
            'modified'      => $attachment->post_modified_gmt,
            'menu_order'    => $attachment->menu_order,
            'mime_type'          => $attachment->post_mime_type,
            'type'          => $type,
            'subtype'       => $subtype,
            'icon'          => '', // In the WP's original code there is how to get, it but one more query, but it's useless.
        );

        if ($meta && ('image' === $type || !empty($meta['sizes']))) {
            $sizes = array();

            /** This filter is documented in wp-admin/includes/media.php */
            $possible_sizes = apply_filters(
                'image_size_names_choose',
                array(
                    'thumbnail' => __('Thumbnail'),
                    'medium'    => __('Medium'),
                    'large'     => __('Large'),
                    'full'      => __('Full Size'),
                )
            );
            unset($possible_sizes['full']);

            // Loop through all potential sizes that may be chosen. Try to do this with some efficiency.
            // First: run the image_downsize filter. If it returns something, we can use its data.
            // If the filter does not return something, then image_downsize() is just an expensive
            // way to check the image metadata, which we do second.
            foreach ($possible_sizes as $size => $label) {

                /** This filter is documented in wp-includes/media.php */
                $downsize = apply_filters('image_downsize', false, $attachment->ID, $size);

                if ($downsize) {
                    if (empty($downsize[3])) {
                        continue;
                    }

                    $sizes[$size] = $downsize[0]; // URL.
                    $sizes[$size . '-width'] = $downsize[1];
                    $sizes[$size . '-height'] = $downsize[2];
                } elseif (isset($meta['sizes'][$size])) {
                    // Nothing from the filter, so consult image metadata if we have it.
                    $size_meta = $meta['sizes'][$size];

                    // We have the actual image size, but might need to further constrain it if content_width is narrower.
                    // Thumbnail, medium, and full sizes are also checked against the site's height/width options.
                    list($width, $height) = image_constrain_size_for_editor($size_meta['width'], $size_meta['height'], $size, 'edit');

                    $sizes[$size] = $base_url . $size_meta['file']; // URL.
                    $sizes[$size . '-width'] = $width;
                    $sizes[$size . '-height'] = $height;
                }
            }

            if ('image' === $type) {

                $sizes['full'] = $attachment_url; // URL.

                if (isset($meta['height'], $meta['width'])) {
                    $response['width'] = $meta['width'];
                    $response['height'] = $meta['height'];
                    $sizes['full-width'] = $meta['width'];
                    $sizes['full-height'] = $meta['height'];
                }
            } elseif ($meta['sizes']['full']['file']) {

                $sizes['full'] = $base_url . $meta['sizes']['full']['file']; // URL.
                $sizes['full-width'] = $meta['sizes']['full']['width'];
                $sizes['full-height'] = $meta['sizes']['full']['height'];
                $response['width'] = $meta['sizes']['full']['width'];
                $response['height'] = $meta['sizes']['full']['height'];
            }

            // Add additional sizes available.
            if (isset($meta['sizes'])) {
                foreach ($meta['sizes'] as $mkey => $mvalue) {
                    foreach ($mvalue as $mk => $mv) {
                        if ('height' === $mk || 'width' === $mk) {
                            $sizes[$mkey . '-' . $mk] = $mv;
                        } elseif ('file' === $mk) {
                            $sizes[$mkey] = $base_url . $mv;
                        }
                    }
                }
            }

            $response = array_merge($response, array('sizes' => $sizes));
        }

        return apply_filters('wp_prepare_attachment_for_js', $response, $attachment, $meta);
    }
}
