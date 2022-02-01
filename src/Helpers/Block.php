<?php

namespace KBNT\Framework\Helpers;

class Block {

	/**
	 * Display block from content
	 * @param string $post_content
	 * @param string $block_name
	 * @return void
	 */
	public static function displayBlockFromContent($post_content, $block_name) {

		$blocks = parse_blocks($post_content);

		if ($blocks) {
			foreach ($blocks as $block) {
				if ($block['blockName'] == $block_name) {
					return \render_block($block);
				}
			}
		}

	}

	/**
	 * Retrieve chosen post's data from the post content block
	 *
	 * Note - works just with the very first occurence and not nested content yet.
	 *
	 * @param string $post_content
	 * @param string $block_name
	 */
	public static function getBlockDataFromContent($post_content, $block_name)
	{

		$blocks = parse_blocks($post_content);

		if ($blocks) {
			foreach ($blocks as $block) {
				if ($block['blockName'] === $block_name) {
					return $block['attrs']['data'];
				}
			}
		}

	}

    /**
     * Check the heading level
     *
     * @param array $block The full block, including name and attributes.
     */
    public static function hasHeadingLevel($block, $level = 1)
    {

        if (isset($block['blockName']) && $block['blockName'] === 'core/heading' && isset($block['attrs']['level']) && $block['attrs']['level'] === $level) {
            return true;
        }

        return false;
    }

    /**
     * Check if block has selected class
     *
     * Useful for add_filter('render_block') checks.
     *
     * @param array $block The full block, including name and attributes.
     * @param string $class Class name to search for.
     * @return void
     */
    public static function hasClass($block, $class)
    {
        if (isset($block['attrs']['className']) && strpos($block['attrs']['className'], $class) !== false) {
            return true;
        }
        return false;
    }

}
