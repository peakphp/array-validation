<?php

declare(strict_types=1);

use Peak\ArrayValidation\Exception\InvalidStructureException;
use Peak\ArrayValidation\Exception\InvalidTypeException;
use Peak\ArrayValidation\StrictValidation;
use PHPUnit\Framework\TestCase;

class StrictArrayValidatorTest extends TestCase
{
    private $data1 = [
        'title' => 'foo',
        'content' => 'foobar',
    ];

    private $data2 = [
        'id' => 1,
        'title' => 'foo',
        'isPrivate' => true,
        'tags' => ['tag1', ''],
        'money' => 15.55
    ];

    private $data3 = [
        'title' => null,
        'views' => 45,
        'comments' => []
    ];

    /**
     * @throws InvalidStructureException
     * @throws InvalidTypeException
     */
    public function testNoException1()
    {
        $strictValidator = new StrictValidation($this->data1);

        $strictValidator
            ->expectAtLeastKeys(['title', 'content'])
            ->expectExactlyKeys(['title', 'content'])
            ->expectOnlyKeys(['title', 'content'])
            ->expectKeysToBeString(['title', 'content']);

        $this->assertTrue(true);
    }

    /**
     * @throws InvalidStructureException
     * @throws InvalidTypeException
     */
    public function testNoException2()
    {
        $strictValidator = new StrictValidation($this->data2);

        $strictValidator
            ->expectOnlyKeys(['id', 'title', 'isPrivate', 'tags', 'money'])
            ->expectKeysToBeInteger(['id'])
            ->expectKeysToBeString(['title'])
            ->expectKeysToBeBoolean(['isPrivate'])
            ->expectKeysToBeArray(['tags'])
            ->expectKeysToBeFloat(['money']);

        $this->assertTrue(true);
    }

    /**
     * @throws InvalidStructureException
     */
    public function testOnlyKeysException()
    {
        $this->expectException(InvalidStructureException::class);
        $strictValidator = new StrictValidation(['title' => 1]);
        $strictValidator->expectOnlyKeys(['name']);
    }

    /**
     * @throws InvalidStructureException
     */
    public function testNKeysException()
    {
        $this->expectException(InvalidStructureException::class);
        $strictValidator = new StrictValidation(['title' => 1, 'description' => 'foo']);
        $strictValidator->expectNKeys(1);
    }

    /**
     * @throws InvalidStructureException
     */
    public function testNKeysNoException()
    {
        $strictValidator = new StrictValidation(['title' => 1]);
        $strictValidator->expectNKeys(1);
        $this->assertTrue(true);
    }

    /**
     * @throws InvalidStructureException
     */
    public function testOnlyOneFromKeysException()
    {
        $this->expectException(InvalidStructureException::class);
        $strictValidator = new StrictValidation(['title' => 'x', 'description' => 'foo']);
        $strictValidator->expectOnlyOneFromKeys(['title', 'description']);
    }

    /**
     * @throws InvalidStructureException
     */
    public function testExactlyKeysException()
    {
        $this->expectException(InvalidStructureException::class);
        $strictValidator = new StrictValidation(['title' => 1]);
        $strictValidator->expectExactlyKeys(['name']);
    }

    /**
     * @throws InvalidStructureException
     */
    public function testOnlyOneFromKeysNoException()
    {
        $strictValidator = new StrictValidation(['title' => 1]);
        $strictValidator->expectOnlyOneFromKeys(['name', 'title']);
        $this->assertTrue(true);
    }

    /**
     * @throws InvalidTypeException
     */
    public function testInvalidStringException()
    {
        $this->expectException(InvalidTypeException::class);
        $strictValidator = new StrictValidation(['title' => 1]);
        $strictValidator->expectKeyToBeString('title');
    }

    /**
     * @throws InvalidTypeException
     */
    public function testInvalidArrayException()
    {
        $this->expectException(InvalidTypeException::class);
        $strictValidator = new StrictValidation(['tags' => 1]);
        $strictValidator->expectKeyToBeArray('tags');
    }
    /**
     * @throws InvalidTypeException
     */
    public function testInvalidBooleanException()
    {
        $this->expectException(InvalidTypeException::class);
        $strictValidator = new StrictValidation(['isPrivate' => 1]);
        $strictValidator->expectKeyToBeBoolean('isPrivate');
    }

    /**
     * @throws InvalidTypeException
     */
    public function testInvalidFloatException()
    {
        $this->expectException(InvalidTypeException::class);
        $strictValidator = new StrictValidation(['money' => 1]);
        $strictValidator->expectKeyToBeFloat('money');
    }

    /**
     * @throws InvalidStructureException
     * @throws InvalidTypeException
     */
    public function testWithInvalidTypeException()
    {
        $this->expectException(InvalidTypeException::class);

        $strictValidator = new StrictValidation($this->data1);

        $strictValidator
            ->expectAtLeastKeys(['title', 'content'])
            ->expectExactlyKeys(['title', 'content'])
            ->expectOnlyKeys(['title', 'content'])
            ->expectKeysToBeInteger(['title', 'content']);

        $this->assertTrue(true);
    }

    /**
     * @throws InvalidStructureException
     * @throws InvalidTypeException
     */
    public function testWithInvalidStructureException()
    {
        $this->expectException(InvalidStructureException::class);

        $strictValidator = new StrictValidation($this->data3, 'my data');

        $strictValidator
            ->expectAtLeastKeys(['title', 'content'])
            ->expectExactlyKeys(['title', 'content'])
            ->expectOnlyKeys(['title', 'content'])
            ->expectKeysToBeInteger(['title', 'content']);

        $this->assertTrue(true);
    }
}