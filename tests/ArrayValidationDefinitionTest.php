<?php

declare(strict_types=1);

use Peak\ArrayValidation\Exception\InvalidTypeException;
use Peak\ArrayValidation\StrictValidationFromDefinition;
use Peak\ArrayValidation\ValidationDefinition;
use \PHPUnit\Framework\TestCase;

class ArrayValidationDefinitionTest extends TestCase
{
    public function testGetDefinition()
    {
        $arrayDefinition = new ValidationDefinition();

        $arrayDefinition
            ->expectAtLeastKeys(['title', 'content'])
            ->expectExactlyKeys(['title', 'content'])
            ->expectOnlyKeys(['title', 'content'])
            ->expectKeysToBeString(['title', 'content'], true);

        $validations = $arrayDefinition->getValidations();
        $this->assertTrue(is_array($validations));
        $this->assertTrue(count($validations) === 4);
    }

    public function testStrictArrayValidatorFromDefinition()
    {
        $arrayDefinition = new ValidationDefinition();
        $arrayDefinition
            ->expectAtLeastKeys(['title', 'content'])
            ->expectExactlyKeys(['title', 'content'])
            ->expectOnlyKeys(['title', 'content'])
            ->expectKeysToBeString(['title', 'content'], true);

        $strictValidator = new StrictValidationFromDefinition($arrayDefinition, [
            'title' => '',
            'content' => '',
        ]);

        $this->assertTrue(true);

        $this->expectException(InvalidTypeException::class);
        $strictValidator = new StrictValidationFromDefinition($arrayDefinition, [
            'title' => '',
            'content' => 1,
        ]);
    }
}
