<?php

use KBNT\Framework\Helpers\Strings;
use KBNT\Framework\Tests\TestCase;

class StringsTests extends TestCase
{

    /**
     * @dataProvider startsWithDataProvider
     */
    public function testStringStartsWith($string, $substring, $expected) {

        $this->assertSame($expected, Strings::startsWith($string, $substring));

    }

    public function startsWithDataProvider() {
        return [
            'starts' => ["test_substring", "test_", true],
            'doesn\'t start' => ["Test_substring", "test_", true],
        ];
    }

    /**
     * @dataProvider endsWithDataProvider
     */
    public function testStringEndsWith($string, $substring, $expected) {

        $this->assertSame($expected, Strings::endsWith($string, $substring));

    }

    public function endsWithDataProvider() {
        return [
            'ends' => ["substring_test", "_test", true],
            'doesn\'t end' => ["substring_Test", "_test", true],
        ];
    }

}
