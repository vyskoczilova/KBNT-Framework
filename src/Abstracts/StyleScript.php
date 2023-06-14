<?php

namespace KBNT\Framework\Abstracts;

use KBNT\Framework\Abstracts\Files;
use KBNT\Framework\Interfaces\ArrayInterface;

/**
 * Register style
 * https://developer.wordpress.org/reference/functions/wp_register_style/
 * @package KBNT\Framework\Setup
 */
abstract class StyleScript extends Files implements ArrayInterface {

    /**
     * Handle
     * @var string
     */
    protected $handle;

    /**
     * Handle prefix
     * @var string
     */
    protected $handle_prefix;

    /**
     * Src
     * @var string|bool
     */
    protected $src;

    /**
     * Dependencies
     * @var array
     */
    protected $deps = [];

    /**
     * Version
     * @var string|bool|null
     */
    protected $version = null; // No version per default.

    /**
     * Template/Stylesheet Directory
     * @var string
     */
    protected $directory;

    /**
     * Template/Stylesheet Directory URI
     * @var string
     */
    protected $directory_uri;

    /**
     * Set conditions
     * @var array
     */
    protected $conditions;

    /**
     * Register only
     * @var bool
     */
    protected $register_only = false;

    /**
     * Construct
     * @return void
     */
    public function __construct() {
        $this->directory = get_template_directory();
        $this->directory_uri = get_template_directory_uri();
    }

    /**
     * Set conditions to enqueue
     * @param callable $conditions Array of callbacks
     * @return $this
     */
    public function setCondition($condition)
    {
        $this->conditions[] = is_string($condition) ? [$condition] : $condition;
        return $this;
    }

    /**
     * Set handle
     *
     * @param  string  $handle  Name of the stylesheet. Should be unique.
     *
     * @return  self
     */
    public function setHandle(string $handle)
    {
        $this->handle = $handle;

        return $this;
    }

    /**
     * Set handle prefix
     *
     * @param  string  $handle_prefix  Handle prefix
     *
     * @return  self
     */
    public function setHandlePrefix(string $handle_prefix)
    {
        $this->handle_prefix = $handle_prefix;

        return $this;
    }

    /**
     * Set path
     *
     * @param  string  $src   Full URL of the stylesheet, or path of the stylesheet relative to the WordPress root directory. If source is set to false, stylesheet is an alias of other stylesheets it depends on.
     *
     * @return  self
     */
    public function setSrc(string $src)
    {
        $this->src = $src;

        return $this;
    }

    /**
     * Set Dependencies
     *
     * @param  array  $deps  An array of registered stylesheet handles this stylesheet depends on.
     *
     * @return  self
     */
    public function setDeps(array $deps)
    {
        $this->deps = $deps;

        return $this;
    }

    /**
     * Set version
     *
     * @param  string|bool|null  $version   String specifying stylesheet version number, if it has one, which is added to the URL as a query string for cache busting purposes. If version is set to false, a version number is automatically added equal to current installed WordPress version. If set to null, no version is added.
     *
     * @return  self
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Set register only
     * @param bool $register_only Register instead of enqueue.
     * @return $this
     */
    public function setRegisterOnly(bool $register_only = true)
    {
        $this->register_only = $register_only;

        return $this;
    }

    /**
     * Get WP friendly array of parameters
     * @return array
     */
    abstract public function getParameters();

    /**
     * Finalize handle
     * @return string
     */
    public function getHandle() {
        return ($this->handle_prefix ? $this->handle_prefix . '-' : '') . $this->handle;
    }

    /**
     * Finilize src
     * @return string
     */
    protected function getSrc() {
        return ($this->isExternalLink($this->src) ? '' : $this->directory_uri) . $this->src;

    }

    /**
     * Finalize version
     * @return mixed
     */
    protected function getVersion() {

        // If true - load file modified time and set it as version.
        if ($this->version === true) {
            if ($this->isExternalLink($this->src) === false) {
                return filemtime($this->directory . $this->src);
            }
        }

        return $this->version;
    }


    /**
     * Test conditions if can load.
     * @return bool
     */
    protected function canLoad()
    {
        if (empty($this->conditions)) {
            return true;
        }

        foreach ($this->conditions as $c) {
            if (\is_callable($c[0])) {
                if (call_user_func(...$c)) {
                    return true;
                }
            }
        }

        return false;
    }

}
