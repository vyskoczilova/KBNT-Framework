<?php

namespace KBNT\Framework\Setup;

use KBNT\Framework\Interfaces\SetupInterface;

class Excerpt implements SetupInterface {

    /**
     * Keep linebreaks tag in excerpt
     * @var false
     */
    private $allow_br = false;

    /**
     * Keep linebreaks in Excerpt.
     * @return void
     */
    public function allowBr() {
        $this->allow_br = true;
    }

    /**
     * Initialize.
     * @return void
     */
    public function init() {
        if ($this->allow_br) {
            remove_filter('get_the_excerpt', 'wp_trim_excerpt');
            add_filter('get_the_excerpt', [$this, 'wp_trim_excerpt_custom']);
        }
    }

    /**
     * Allow BRs
     * @see https://wordpress.stackexchange.com/questions/67498/how-to-include-line-breaks-in-the-excerpt
     * @param string $text Text.
     * @return string
     */
    public function wp_trim_excerpt_custom( $text = ''){

        add_filter('the_content', [$this, 'wp_trim_excerpt_custom_mark'], 6);

        // get through origin filter
        $text = wp_trim_excerpt($text);

        remove_filter('the_content', [$this, 'wp_trim_excerpt_custom_mark'], 6);

        return $this->wp_trim_excerpt_custom_restore($text);

    }

    /**
     * Replace line break and keep it
     * @param string $text Text.
     * @return string
     */
    public function wp_trim_excerpt_custom_mark($text)
    {
        $text = nl2br($text);
        return str_replace(nl2br(PHP_EOL), '__BR__', $text);
    }

    /**
     * Replace line breaks back
     * @param string $text Text.
     * @return mixed
     */
    public function wp_trim_excerpt_custom_restore($text)
    {
        return str_replace('__BR__', nl2br(PHP_EOL), $text);
    }

}
