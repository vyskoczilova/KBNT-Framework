<?php

namespace KBNT\Framework\Setup;

use KBNT\Framework\Abstracts\StyleScript;

/**
 * Register style
 * https://developer.wordpress.org/reference/functions/wp_register_style/
 * @package KBNT\Framework\Setup
 */
class Style extends StyleScript {

    /**
     * Media
     * @var string
     */
    private $media = 'all';

    /**
     * Set media
     *
     * @param  string  $media  The media for which this stylesheet has been defined. Accepts media types like 'all', 'print' and 'screen', or media queries like '(orientation: portrait)' and '(max-width: 640px)'.
     *
     * @return  self
     */
    public function setMedia(string $media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get WP friendly array of parameters
     * @return array
     */
    public function getParameters()
    {
        return [$this->getHandle(), $this->getSrc(), $this->deps, $this->getVersion(), $this->media];
    }

    /**
     * Enqueue/register
     * @return void
     */
    public function enqueue()
    {
        if ($this->canExecute()) {
            if ($this->register_only) {
                \wp_register_style(...$this->getParameters());
            } else {
                \wp_enqueue_style(...$this->getParameters());
            }
        }
    }

}
