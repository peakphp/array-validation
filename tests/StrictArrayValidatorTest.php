<?php

declare(strict_types=1);

use Peak\ArrayValidation\Exception\ArrayValidationException;
use Peak\ArrayValidation\StrictArrayValidator;
use Peak\ArrayValidation\ArrayValidation;
use PHPUnit\Framework\TestCase;

class StrictArrayValidatorTest extends TestCase
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

    /**
     * @throws ArrayValidationException
     */
    public function testNoException()
    {
        $strictValidator = new StrictArrayValidator(new ArrayValidation(), $this->data1);

        $strictValidator
            ->expectAtLeastKeys(['title', 'content'])
            ->expectExactlyKeys(['title', 'content'])
            ->expectOnlyKeys(['title', 'content'])
            ->expectKeysToBeString(['title', 'content']);

        $this->assertTrue(true);
    }

    /**
     * @throws ArrayValidationException
     */
    public function testWithException()
    {
        $this->expectException(ArrayValidationException::class);

        $strictValidator = new StrictArrayValidator(new ArrayValidation(), $this->data1, 'my data');

        $strictValidator
            ->expectAtLeastKeys(['title', 'content'])
            ->expectExactlyKeys(['title', 'content'])
            ->expectOnlyKeys(['title', 'content'])
            ->expectKeysToBeInteger(['title', 'content']);

        $this->assertTrue(true);
    }
}