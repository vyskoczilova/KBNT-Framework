<?php

namespace KBNT\Framework\ACF;

use KBNT\Framework\Interfaces\SetupInterface;

class Blocks implements SetupInterface{


    /**
     * Blocks to register
     * @var array
     */
    private $blocks = [];

    /**
     * Block default settings
     * @var mixed
     */
    private $blocksDefaults;

    /**
     * Initialize.
     * @return bool
     */
    public function init() {

        // Bail out if ACF doesn’t exist.
        if (!function_exists('acf_register_block')) {
            return;
        }

        // Register blocks.
        add_action('acf/init', [$this, 'wpRegisterBlocks']);

    }

    /**
     * Set default block parameters.
     * @return Block
     */
    public function blocksDefaults() {
        $this->blocksDefaults = new Block();
        return $this->blocksDefaults;
    }

    /**
     * New block to register
     * @return Block
     */
    public function registerBlock() {
        $this->blocks[] = new Block;
        return end($this->blocks);
    }

    /**
     * Register blocks on init
     * @return void
     */
    public function wpRegisterBlocks() {

        // Prepare defaults.
        $defaults = $this->blocksDefaults ? $this->blocksDefaults->getParameters() : [];
        $defaults_supports = isset($defaults['supports']) ? $defaults['supports'] : [];

        // Order block by title.
        $ordered = [];
        foreach ($this->blocks as $block) {
            $ordered[sanitize_title($block->getTitle())] = $block;
        }
        ksort($ordered);

        foreach ($ordered as $rb) {

            // Parse with default values.
            $register = $rb->getParameters();
            $register_supports = isset($register['supports'])? $register['supports'] : [];

            if ( $this->blocksDefaults) {
                $register = \wp_parse_args($register, $defaults);;
                $register_supports = \wp_parse_args($register_supports, $defaults_supports);
            }

            $register['supports'] = $register_supports;

            \acf_register_block($register);

        }

    }

}
