<?php

use KBNT\Framework\Helpers\Arrays;
use KBNT\Framework\Tests\TestCase;

class ArraysTest extends TestCase
{

    /**
     * @dataProvider implodeWithLastDataProvider
     */
    public function testItCanImplodeWithLastElement($separator, $last) {

        $array = ["First", "Second", "Third"];
        $expected = "First{$separator}Second{$last}Third";
        $this->assertSame($expected, Arrays::implodeWithLast($array, $separator, $last));

    }

    public function implodeWithLastDataProvider() {
        return [
            'default' => ["",""],
            'comma and &' => [', ', ' & ' ]
        ];
    }

    public function testReplaceValue() {

        $array = ["First", "Second", "Third"];
        $expected = ["First", "Second", "Last"];

        $this->assertSame($expected, Arrays::replaceValue($array, "Third", "Last"));

    }


}
