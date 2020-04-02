<?php

declare(strict_types=1);

namespace Tests;

use Peak\ArrayValidation\Exception\ArrayValidationExceptionInterface;
use Peak\ArrayValidation\ValidationBuilder;
use \PHPUnit\Framework\TestCase;

class ValidationBuilderTest extends TestCase
{
    public function testValidate()
    {
        $validation = new ValidationBuilder();
        $validation
            ->expectNKeys(2)
            ->expectAtLeastKeys(['title', 'content'])
            ->expectExactlyKeys(['title', 'content'])
            ->expectOnlyKeys(['title', 'content'])
            ->expectKeysToBeString(['title', 'content'], true);

        $data = [
            'title' => 'test',
            'content' => 'test',
        ];

        $validationPass = $validation->validate($data);
        $this->assertTrue($validationPass);
        $this->assertTrue($validation->getErrors() === []);
        $this->assertTrue($validation->getLastError() === null);
    }

    public function testStrictValidate()
    {
        $validation = new ValidationBuilder();
        $validation
            ->expectNKeys(2)
            ->expectAtLeastKeys(['title', 'content'])
            ->expectExactlyKeys(['title', 'content'])
            ->expectOnlyKeys(['title', 'content'])
            ->expectKeysToBeString(['title', 'content'], true);

        $data = [
            'title' => 'test',
            'content' => 'test',
        ];

        $validation->strictValidate($data);
        $this->assertTrue(true);
    }

    public function testStrictValidateException()
    {
        $validation = new ValidationBuilder();
        $validation
            ->expectNKeys(2)
            ->expectAtLeastKeys(['title', 'content'])
            ->expectExactlyKeys(['title', 'content'])
            ->expectOnlyKeys(['title', 'content'])
            ->expectKeysToBeString(['title', 'content'], true);

        $data = [
            'title' => 1,
            'content' => 'test',
        ];

        $this->expectException(ArrayValidationExceptionInterface::class);
        $validation->strictValidate($data);
    }

}
