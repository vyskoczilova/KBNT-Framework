<?php

namespace KBNT\Framework\Helpers;

class Blocks {

    /**
     * Parsed blocks
     * @var null|false|array
     */
    private $blocks;

    /**
     * Check if h1 is present in the post content
     *
     * Doesn't work (yet with reusable data)
     *
     * @param string $block
     */
    public static function hasH1($blocks)
    {
        // Parse block if not parsed yet
        if (!\is_array($blocks)) {
            $blocks = \parse_blocks($blocks);
        }

        if ($blocks) {
            foreach ($blocks as $block) {
                if (isset($block['innerBlocks']) && !empty($block['innerBlocks'])) {
                    if (self::hasH1($block['innerBlocks'])) {
                        return true;
                    }
                } elseif (Block::hasHeadingLevel($block)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Return all registered blocks by namespace aka all core blocks etc.
     * @param string $namespace
     * @return array
     *
     * @see https://github.com/WordPress/gutenberg/issues/12219
     */
    public static function getByNamespace($namespace)
    {
        $all_blocks = \WP_Block_Type_Registry::get_instance()->get_all_registered();
        $allowed_from_namespace = [];
        foreach ($all_blocks as $slug => $value) {
            if (substr($slug, 0, \strlen($namespace . '/')) === $namespace . '/') {
                $allowed_from_namespace[] = $slug;
            }
        }
        return $allowed_from_namespace;
    }

    /**
     * Return all blocks but blacklisted
     * @param array $blacklisted List of block names to blacklist (aka core/paragraph)
     * @return array
     */
    public static function getAllButBlacklisted($blacklisted)
    {
        $all_blocks = \WP_Block_Type_Registry::get_instance()->get_all_registered();
        $filtered = [];
        foreach ($all_blocks as $slug => $value) {
            if (!\in_array($slug, $blacklisted, true)) {
                $filtered[] = $slug;
            }
        }
        return $filtered;
    }

    /**
     * Has_block() implementation counting with reusable blocks
     *
     * @see https://github.com/WordPress/gutenberg/issues/18272
     * @param string $block_name Block name.
     * @return bool
     */
    public function hasBlock($block_name)
    {

        if (\has_block($block_name)) {
            return true;
        }

        $this->parseReusableBlocks();

        if (empty($this->blocks)) {
            return false;
        }

        return $this->recursiveSearchWithinInnerblocks($this->blocks, $block_name);
    }

    /**
     * Search for a reusable block inside innerblocks
     *
     * @param array $blocks Blocks to loop through.
     * @param string $block_name BFull Block type to look for.
     * @return true|void
     */
    private function recursiveSearchWithinInnerblocks($blocks, $block_name)
    {
        foreach ($blocks as $block) {
            if (isset($block['innerBlocks']) && !empty($block['innerBlocks'])) {
                $this->recursiveSearchWithinInnerblocks($block['innerBlocks'], $block_name);
            } elseif ($block['blockName'] === 'core/block' && !empty($block['attrs']['ref']) && \has_block($block_name, $block['attrs']['ref'])) {
                return true;
            }
        }
        return false;
    }

    /**
     * Parse blocks if at leat one reusable block is presnt.
     *
     * @return void
     */
    private function parseReusableBlocks()
    {

        if ($this->blocks !== null) {
            return;
        }

        if (\has_block('core/block')) {
            $content = \get_post_field('post_content');
            $this->blocks = \parse_blocks($content);
            return;
        }

        $this->blocks = false;
    }

}
