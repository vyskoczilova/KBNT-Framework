<?php

namespace KBNT\Framework\Setup;

use KBNT\Framework\Abstracts\StyleScript;

/**
 * Register style
 * https://developer.wordpress.org/reference/functions/wp_register_style/
 * @package KBNT\Framework\Setup
 */
class Script extends StyleScript {

    /**
     * In footer
     * @var bool
     */
    private $in_footer = true; // My custom.

    /**
     * Localize
     * @var array
     */
    private $localize;

    /**
     * Set in footer
     *
     * @param  bool  $in_footer  In footer
     *
     * @return  self
     */
    public function setInFooter(bool $in_footer)
    {
        $this->in_footer = $in_footer;

        return $this;
    }

    /**
     * Set localize
     *
     * @param  array  $localize  Localize
     *
     * @return  self
     */
    public function setLocalize(array $localize)
    {
        $this->localize = $localize;

        return $this;
    }

    /**
     * Get WP friendly array of parameters
     * @return array
     */
    public function getParameters()
    {
        return [$this->getHandle(), $this->getSrc(), $this->deps, $this->getVersion(), $this->in_footer];
    }

    /**
     * Enqueue/register & localize
     * @return void
     */
    public function enqueueScript() {
        if ($this->canExecute()) {
            if ($this->register_only) {
                \wp_register_script(...$this->getParameters());
            } else {
                \wp_enqueue_script(...$this->getParameters());
            }
            if ($this->localize) {
                wp_localize_script($this->getHandle(), 'props', $this->localize);
            }
        }
    }

}
