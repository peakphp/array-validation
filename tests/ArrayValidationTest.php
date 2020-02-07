<?php

declare(strict_types=1);

use \PHPUnit\Framework\TestCase;
use \Peak\ArrayValidation\ArrayValidation;

class ArrayValidationTest extends TestCase
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
        $validation = new ArrayValidation();
        $this->assertTrue($validation->expectExactlyKeys($this->data1, ['title', 'content']));
        $this->assertFalse($validation->expectExactlyKeys($this->data1, ['title', 'content', 'extra']));
        $this->assertFalse($validation->expectExactlyKeys($this->data1, ['title']));
        $this->assertFalse($validation->expectExactlyKeys($this->data1, ['extra']));
        $this->assertFalse($validation->expectExactlyKeys($this->data1, []));
    }

    public function testExpectOnlyOneFromKeys()
    {
        $validation = new ArrayValidation();
        $this->assertTrue($validation->expectOnlyOneFromKeys($this->data2, ['title', 'extra']));
        $this->assertTrue($validation->expectOnlyOneFromKeys($this->data2, ['title']));
        $this->assertFalse($validation->expectOnlyOneFromKeys($this->data2, ['extra']));
    }

    public function testExpectAtLeastKeys()
    {
        $validation = new ArrayValidation();
        $this->assertTrue($validation->expectAtLeastKeys($this->data1, ['title']));
        $this->assertTrue($validation->expectAtLeastKeys($this->data1, ['content']));
        $this->assertTrue($validation->expectAtLeastKeys($this->data1, ['title', 'content']));
        $this->assertFalse($validation->expectAtLeastKeys($this->data1, ['extra']));
        $this->assertFalse($validation->expectAtLeastKeys($this->data1, ['title', 'content', 'extra']));
    }

    public function testExpectOnlyKeys()
    {
        $validation = new ArrayValidation();
        $this->assertTrue($validation->expectOnlyKeys($this->data1, ['title', 'content']));
        $this->assertTrue($validation->expectOnlyKeys($this->data1, ['title', 'content', 'extra']));
        $this->assertFalse($validation->expectOnlyKeys($this->data1, ['title']));
    }

    public function testExpectXElement()
    {
        $validation = new ArrayValidation();
        $this->assertTrue($validation->expectXElement($this->data1, 2));
        $this->assertFalse($validation->expectXElement($this->data1, 1));
    }

    public function testIsArray()
    {
        $validation = new ArrayValidation();
        $this->assertTrue($validation->expectKeyToBeArray($this->data3, 'comments', false));
        $this->assertFalse($validation->expectKeyToBeArray($this->data3, 'title', false));
        $this->assertTrue($validation->expectKeyToBeArray($this->data3, 'title', true));
    }
}
