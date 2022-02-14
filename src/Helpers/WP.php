<?php

namespace KBNT\Framework\Helpers;

class WP {

    /**
     * Get blog page archive ID
     * @return string
     */
    public static function getBlogArchiveID() {
        return \get_option('page_for_posts', true);
    }

    /**
     * Get blog page archive title
     * @return string
     */
    public static function getBlogArchiveTitle() {
        return \get_the_title(self::getBlogArchiveID());
    }

}
