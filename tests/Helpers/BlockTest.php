<?php

use KBNT\Framework\Helpers\Block;
use KBNT\Framework\Tests\TestCase;

class BlockTest extends TestCase
{

    /**
     * @dataProvider displayBlockFromContenttDataProvider
     */
    public function testItCanDisplayBlockFromContent($parse_blocks_return, $block_name, $expected)
    {

        \WP_Mock::userFunction('parse_blocks', [
            'times' => 1, // Call just once if you want to replace the value with the data provider.
            'args' => [''],
            'return' => $parse_blocks_return,
        ]);

        if ($expected !== null) {
            \WP_Mock::userFunction('render_block', [
                'times' => 1, // Call just once if you want to replace the value with the data provider.
                'args' => [$expected],
                'return' => $expected,
            ]);
        }

        $this->assertSame($expected, Block::displayBlockFromContent('', $block_name));

    }

    public function displayBlockFromContenttDataProvider()
    {

        return [
            'no blocks' => [
                null,
                'core/heading',
                null
            ],
            'other blocks' => [
                [['blockName' => 'core/paragraph']],
                'core/heading',
                null
            ],
            'other and selected block' => [
                [['blockName' => 'core/paragraph'], ['blockName' => 'core/heading']],
                'core/heading',
                ['blockName' => 'core/heading']
            ],
        ];
    }

    /**
     * @dataProvider getBlockDataFromContentDataProvider
     */
    public function testItCanGetBlockDataFromContent($parse_blocks_return, $block_name, $expected)
    {

        \WP_Mock::userFunction('parse_blocks', [
            'times' => 1, // Call just once if you want to replace the value with the data provider.
            'args' => [''],
            'return' => $parse_blocks_return,
        ]);

        $this->assertSame($expected, Block::getBlockDataFromContent('', $block_name));

    }

    public function getBlockDataFromContentDataProvider()
    {

        return [
            'no blocks' => [
                null,
                'acf/custom',
                null
            ],
            'other blocks' => [
                [['blockName' => 'core/paragraph']],
                'acf/custom',
                null
            ],
            'other and selected block' => [
                [['blockName' => 'core/paragraph'], ['blockName' => 'acf/custom', 'attrs' => ['data' => ['key' => 'value']]]],
                'acf/custom',
                ['key' => 'value']
            ],
        ];
    }

    /**
     * @dataProvider hasHeadingLevelDataProvider
     */
    public function testhasHeadingLevel($block, $level, $expected) {
        $this->assertSame($expected, Block::hasHeadingLevel($block, $level));
    }

    public function hasHeadingLevelDataProvider() {
        return [
            'no blockName attribute' => [
                [],
                1,
                false
            ],
            'not level attribute' => [
                ['blockName' => 'core/heading'],
                1,
                false
            ],
            'different level attribute' => [
                ['blockName' => 'core/heading', 'attrs' => ['level' => 2]],
                1,
                false
            ],
            'has expected level attribute' => [
                ['blockName' => 'core/heading', 'attrs' => ['level' => 2]],
                2,
                true
            ],
        ];
    }

    /**
     * @dataProvider hasClassDataProvider
     */
    public function testHasClass($block, $class, $expected) {
        $this->assertSame($expected, Block::hasClass($block, $class));
    }

    public function hasClassDataProvider() {
        return [
            'no attrs attribute' => [
                [],
                'my-class',
                false
            ],
            'no className attribute' => [
                ['attrs' => []],
                'my-class',
                false
            ],
            'not matching class' => [
                ['attrs' => ['className' => 'pokus dalsi-trida']],
                'my-class',
                false
            ],
            'matching class' => [
                ['attrs' => ['className' => 'pokus dalsi-trida my-class']],
                'my-class',
                true
            ],
        ];
    }

}
