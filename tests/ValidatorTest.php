<?php

declare(strict_types=1);

use \PHPUnit\Framework\TestCase;
use \Peak\ArrayValidation\Validator;

class ValidatorTest extends TestCase
{
    private $data1 = [
        'title' => 'foo',
        'content' => 'foobar',
    ];

    private $data2 = [
        'title' => 'foo'
    ];

    private $data3 = [
        'title' => null,
        'views' => 45,
        'comments' => []
    ];

    public function testExpectExactlyKeys()
    {
        $validation = new Validator();
        $this->assertTrue($validation->expectExactlyKeys($this->data1, ['title', 'content']));
        $this->assertFalse($validation->expectExactlyKeys($this->data1, ['title', 'content', 'extra']));
        $this->assertFalse($validation->expectExactlyKeys($this->data1, ['title']));
        $this->assertFalse($validation->expectExactlyKeys($this->data1, ['extra']));
        $this->assertFalse($validation->expectExactlyKeys($this->data1, []));
    }

    public function testExpectOnlyOneFromKeys()
    {
        $validation = new Validator();
        $this->assertTrue($validation->expectOnlyOneFromKeys($this->data2, ['title', 'extra']));
        $this->assertTrue($validation->expectOnlyOneFromKeys($this->data2, ['title']));
        $this->assertFalse($validation->expectOnlyOneFromKeys($this->data2, ['extra']));
    }

    public function testExpectAtLeastKeys()
    {
        $validation = new Validator();
        $this->assertTrue($validation->expectAtLeastKeys($this->data1, ['title']));
        $this->assertTrue($validation->expectAtLeastKeys($this->data1, ['content']));
        $this->assertTrue($validation->expectAtLeastKeys($this->data1, ['title', 'content']));
        $this->assertFalse($validation->expectAtLeastKeys($this->data1, ['extra']));
        $this->assertFalse($validation->expectAtLeastKeys($this->data1, ['title', 'content', 'extra']));
    }

    public function testExpectOnlyKeys()
    {
        $validation = new Validator();
        $this->assertTrue($validation->expectOnlyKeys($this->data1, ['title', 'content']));
        $this->assertTrue($validation->expectOnlyKeys($this->data1, ['title', 'content', 'extra']));
        $this->assertFalse($validation->expectOnlyKeys($this->data1, ['title']));
    }

    public function testExpectNElement()
    {
        $validation = new Validator();
        $this->assertTrue($validation->expectNKeys($this->data1, 2));
        $this->assertFalse($validation->expectNKeys($this->data1, 1));
    }

    public function testIsArray()
    {
        $validation = new Validator();
        $this->assertTrue($validation->expectKeyToBeArray($this->data3, 'comments', false));
        $this->assertFalse($validation->expectKeyToBeArray($this->data3, 'title', false));
        $this->assertTrue($validation->expectKeyToBeArray($this->data3, 'title', true));

        $data = [
            'item1' => 45,
            'item2' => [],
            'item3' => [],
            'item4' => null,
        ];
        $this->assertTrue($validation->expectKeysToBeArray($data, ['item2'], false));
        $this->assertTrue($validation->expectKeysToBeArray($data, ['item2', 'item3'], false));
        $this->assertFalse($validation->expectKeysToBeArray($data, ['item2', 'item3', 'item4'], false));
        $this->assertTrue($validation->expectKeysToBeArray($data, ['item2', 'item3', 'item4'], true));
    }

    public function testIsInt()
    {
        $data = [
            'item1' => 45,
            'item2' => 36,
            'item3' => [],
            'item4' => null,
            'item5' => '',
        ];
        $validation = new Validator();
        $this->assertTrue($validation->expectKeyToBeInteger($data, 'item1', false));
        $this->assertFalse($validation->expectKeyToBeInteger($data, 'item3', false));
        $this->assertFalse($validation->expectKeyToBeInteger($data, 'item4', false));
        $this->assertTrue($validation->expectKeyToBeInteger($data, 'item4', true));


        $this->assertTrue($validation->expectKeysToBeInteger($data, ['item1', 'item2'], false));
        $this->assertFalse($validation->expectKeysToBeInteger($data, ['item1', 'item2', 'item4'], false));
        $this->assertTrue($validation->expectKeysToBeInteger($data, ['item1', 'item2', 'item4'], true));
        $this->assertFalse($validation->expectKeysToBeInteger($data, ['item1', 'item2', 'item3', 'item4'], true));
    }

    public function testIsFloat()
    {
        $data = [
            'item1' => 45.1,
            'item2' => 36.5,
            'item3' => [],
            'item4' => null,
            'item5' => 99,
        ];
        $validation = new Validator();
        $this->assertTrue($validation->expectKeyToBeFloat($data, 'item1', false));
        $this->assertFalse($validation->expectKeyToBeFloat($data, 'item3', false));
        $this->assertFalse($validation->expectKeyToBeFloat($data, 'item4', false));
        $this->assertTrue($validation->expectKeyToBeFloat($data, 'item4', true));


        $this->assertTrue($validation->expectKeysToBeFloat($data, ['item1', 'item2'], false));
        $this->assertFalse($validation->expectKeysToBeFloat($data, ['item1', 'item2', 'item4'], false));
        $this->assertTrue($validation->expectKeysToBeFloat($data, ['item1', 'item2', 'item4'], true));
        $this->assertFalse($validation->expectKeysToBeFloat($data, ['item1', 'item2', 'item3', 'item4'], true));
        $this->assertFalse($validation->expectKeysToBeFloat($data, ['item1', 'item2', 'item5'], false));
    }

    public function testIsBool()
    {
        $data = [
            'item1' => true,
            'item2' => false,
            'item3' => [],
            'item4' => null,
            'item5' => 1,
        ];
        $validation = new Validator();
        $this->assertTrue($validation->expectKeyToBeBoolean($data, 'item1', false));
        $this->assertFalse($validation->expectKeyToBeBoolean($data, 'item3', false));
        $this->assertFalse($validation->expectKeyToBeBoolean($data, 'item5', false));
        $this->assertFalse($validation->expectKeyToBeBoolean($data, 'item4', false));
        $this->assertTrue($validation->expectKeyToBeBoolean($data, 'item4', true));


        $this->assertTrue($validation->expectKeysToBeBoolean($data, ['item1', 'item2'], false));
        $this->assertFalse($validation->expectKeysToBeBoolean($data, ['item1', 'item2', 'item4'], false));
        $this->assertTrue($validation->expectKeysToBeBoolean($data, ['item1', 'item2', 'item4'], true));
        $this->assertFalse($validation->expectKeysToBeBoolean($data, ['item1', 'item2', 'item3', 'item4'], true));
    }

    public function testIsString()
    {
        $data = [
            'item1' => 'string',
            'item2' => 'string',
            'item3' => [],
            'item4' => null,
            'item5' => 2,
        ];
        $validation = new Validator();
        $this->assertTrue($validation->expectKeyToBeString($data, 'item1', false));
        $this->assertFalse($validation->expectKeyToBeString($data, 'item3', false));
        $this->assertFalse($validation->expectKeyToBeString($data, 'item4', false));
        $this->assertTrue($validation->expectKeyToBeString($data, 'item4', true));


        $this->assertTrue($validation->expectKeysToBeString($data, ['item1', 'item2'], false));
        $this->assertFalse($validation->expectKeysToBeString($data, ['item1', 'item2', 'item4'], false));
        $this->assertTrue($validation->expectKeysToBeString($data, ['item1', 'item2', 'item4'], true));
        $this->assertFalse($validation->expectKeysToBeString($data, ['item1', 'item2', 'item3', 'item4'], true));
    }
}
