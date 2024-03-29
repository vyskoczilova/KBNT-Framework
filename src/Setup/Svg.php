<?php

namespace KBNT\Framework\Setup;

use enshrined\svgSanitize;

/**
 * Template Class Doc Comment
 *
 * Template Class
 *
 * @category NasWP
 * @package  NasWP_SVG
 * @author   Karolína Vyskočilová <karolina@kybernaut.cz>
 */
class Svg
{

    /**
     * The sanitizer
     *
     * @var \enshrined\svgSanitize\Sanitizer
     */
    protected $sanitizer;

    /**
     * Hook into WordPress
     *
     * @return void
     */
    public function init()
    {
        $this->sanitizer = new svgSanitize\Sanitizer();
        $this->sanitizer->minify(true);

        add_filter('upload_mimes', array($this, 'svg_upload_mimes'));
        add_filter('wp_prepare_attachment_for_js', array($this, 'add_svg_sizes'), 10, 3);
        add_filter('wp_check_filetype_and_ext', array($this, 'fix_mime_type_svg'), 75, 4);
        add_filter('wp_handle_upload_prefilter', array($this, 'check_for_svg'));
        add_filter( 'wp_generate_attachment_metadata', array( $this, 'attachment_meta' ), 10, 2 );
    }

    /**
     * Fixes the issue in WordPress 4.7.1 being unable to correctly identify SVGs
     *
     * @param array $data Data associated to the file.
     * @param string $file Full path to the file.
     * @param string $filename The name of the file (may differ from $file due to $file being in a tmp directory).
     * @param array $mimes Array of mime types keyed by their file extension regex.
     *
     * @return array
     */
    public function fix_mime_type_svg($data, $file, $filename, $mimes = null)
    {
        $ext = isset($data['ext']) ? $data['ext'] : '';
        if (strlen($ext) < 1) {
            $exploded = explode('.', $filename);
            $ext      = strtolower(end($exploded));
        }
        if ($ext === 'svg') {
            $data['type'] = 'image/svg+xml';
            $data['ext']  = 'svg';
        } elseif ($ext === 'svgz') {
            $data['type'] = 'image/svg+xml';
            $data['ext']  = 'svgz';
        }

        return $data;
    }

    /**
     * Check if the file is an SVG, if so handle appropriately
     *
     * @param string $file File.
     *
     * @return string
     */
    public function check_for_svg($file)
    {

        if ($file['type'] === 'image/svg+xml') {
            if (!$this->sanitize($file['tmp_name'])) {
                $file['error'] = __("Sorry, this file couldn't be sanitized so for security reasons wasn't uploaded", 'kbnt');
            }
        }

        return $file;
    }

    /**
     * Sanitize the SVG
     *
     * @param string $file SVG file.
     *
     * @return bool|int
     */
    protected function sanitize($file)
    {
        $dirty     = file_get_contents($file);
        $is_zipped = $this->is_gzipped($dirty);

        // Is the SVG gzipped? If so we try and decode the string.
        if ($is_zipped) {
            $dirty = gzdecode($dirty);

            // If decoding fails, bail as we're not secure.
            if (false === $dirty) {
                return false;
            }
        }

        $clean = $this->sanitizer->sanitize($dirty);

        if (false === $clean) {
            return false;
        }

        // If we were gzipped, we need to re-zip.
        if ($is_zipped) {
            $clean = gzencode($clean);
        }

        file_put_contents($file, $clean);

        return true;
    }

    /**
     * Check if the contents are gzipped
     *
     * @see http://www.gzip.org/zlib/rfc-gzip.html#member-format
     *
     * @param string $contents Contents of SVG file.
     *
     * @return bool
     */
    protected function is_gzipped($contents)
    {
        if (function_exists('mb_strpos')) {
            return 0 === mb_strpos($contents, "\x1f" . "\x8b" . "\x08");
        } else {
            return 0 === strpos($contents, "\x1f" . "\x8b" . "\x08");
        }
    }

    /**
     * Filters list of allowed mime types and file extensions.
     *
     * @param array $mimes Mime types keyed by the file extension regex corresponding to those types. 'swf' and 'exe' removed from full list. 'htm|html' also removed depending on '$user' capabilities.
     *
     * @return array $mimes
     */
    public function svg_upload_mimes($mimes = array())
    {
        $mimes['svg']  = 'image/svg+xml';
        $mimes['svgz'] = 'image/svg+xml';
        return $mimes;
    }

    /**
     * Filters the attachment data prepared for JavaScript.
     * Base on /wp-includes/media.php
     *
     * @param array          $response   Array of prepared attachment data.
     * @param integer|object $attachment Attachment ID or object.
     * @param array          $meta       Array of attachment meta data.
     *
     * @return mixed $response
     */
    public function add_svg_sizes($response, $attachment, $meta)
    {

        if ((isset($response['mime']) && 'image/svg+xml' === $response['mime']) || isset($response['mime_type']) && 'image/svg+xml' === $response['mime_type']) {
            $svg_path = get_attached_file($attachment->ID);
            if (!file_exists($svg_path)) {
                // If SVG is external, use the URL instead of the path.
                $svg_path = $response['url'];
            }
            $dimensions        = $this->svgs_get_dimensions($svg_path);
            $response['sizes'] = array(
                'full' => array(
                    'url'         => $response['url'],
                    'width'       => $dimensions->width,
                    'height'      => $dimensions->height,
                    'orientation' => $dimensions->width > $dimensions->height ? 'landscape' : 'portrait',
                ),
            );
        }

        return $response;
    }

    /**
     * Get dimension svg file
     *
     * @param string $svg Path of svg.
     * @return object width and height.
     */
    private function svgs_get_dimensions($svg)
    {
        $svg = simplexml_load_file($svg);
        $width  = '0';
        $height = '0';

        if (false !== $svg) {
            $attributes = $svg->attributes();
            if (isset($attributes->viewBox)) {
                $viewbox = explode(' ', $attributes->viewBox);
                $width = $viewbox[2];
                $height = $viewbox[3];
            } elseif ($attributes->width && $attributes->height) {
                $width      = (string) $attributes->width;
                $height     = (string) $attributes->height;
            }
        }

        return (object) array(
            'width'  => intval($width),
            'height' => intval($height),
        );
    }

    /**
     * Create Attachment meta for svg files.
     *
     * @param int $attachment_id Attachment Id to process.
     * @param string $file Filepath of the Attached image.
     *
     * @return mixed Metadata for attachment.
     */
    function attachment_meta( $metadata, $attachment_id ) {
        $mime = get_post_mime_type( $attachment_id );
        if ( 'image/svg+xml' === $mime ) {
            $additional_image_sizes = wp_get_additional_image_sizes();
            $svg_path               = get_attached_file( $attachment_id );
            $upload_dir             = wp_upload_dir();
            // get the path relative to /uploads/ - found no better way:
            $relative_path = str_replace( trailingslashit( $upload_dir['basedir'] ), '', $svg_path );
            $filename      = basename( $svg_path );

            $dimensions = $this->get_dimensions( $svg_path );

            if ( ! $dimensions ) {
                return $metadata;
            }

            $metadata = array(
                'width'  => intval( $dimensions->width),
                'height' => intval( $dimensions->height ),
                'file'   => $relative_path
            );

            // Might come handy to create the sizes array too - But it's not needed for this workaround! Always links to original svg-file => Hey, it's a vector graphic! ;)
            $sizes = array();
            foreach ( get_intermediate_image_sizes() as $s ) {
                $sizes[ $s ] = array( 'width' => '', 'height' => '', 'crop' => false );

                if ( isset( $additional_image_sizes[ $s ]['width'] ) ) {
                    // For theme-added sizes
                    $sizes[ $s ]['width'] = intval( $additional_image_sizes[ $s ]['width'] );
                } else {
                    // For default sizes set in options
                    $sizes[ $s ]['width'] = get_option( "{$s}_size_w" );
                }

                if ( isset( $additional_image_sizes[ $s ]['height'] ) ) {
                    // For theme-added sizes
                    $sizes[ $s ]['height'] = intval( $additional_image_sizes[ $s ]['height'] );
                } else {
                    // For default sizes set in options
                    $sizes[ $s ]['height'] = get_option( "{$s}_size_h" );
                }

                if ( isset( $additional_image_sizes[ $s ]['crop'] ) ) {
                    // For theme-added sizes
                    $sizes[ $s ]['crop'] = intval( $additional_image_sizes[ $s ]['crop'] );
                } else {
                    // For default sizes set in options
                    $sizes[ $s ]['crop'] = get_option( "{$s}_crop" );
                }

                $sizes[ $s ]['file']      = $filename;
                $sizes[ $s ]['mime-type'] = $mime;
            }
            $metadata['sizes'] = $sizes;
        }

        return $metadata;
    }
}
