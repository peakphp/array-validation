<?php

declare(strict_types=1);

namespace Tests;

use Peak\ArrayValidation\Exception\InvalidStructureException;
use Peak\ArrayValidation\Exception\InvalidTypeException;
use Peak\ArrayValidation\Schema;
use Peak\ArrayValidation\SchemaCompiler;
use Peak\ArrayValidation\StrictValidationFromDefinition;
use Peak\ArrayValidation\StrictValidationFromSchema;
use Peak\ArrayValidation\ValidationDefinition;
use \PHPUnit\Framework\TestCase;

class ValidationDefinitionTest extends TestCase
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

    public function testGetDefinition2()
    {
        $arrayDefinition = new ValidationDefinition();

        $arrayDefinition
            ->expectOnlyKeys(['title', 'content', 'description', 'id', 'number', 'amount', 'fields', 'isPrivate'])
            ->expectKeysToBeInteger(['id'])
            ->expectKeyToBeInteger('number')
            ->expectKeyToBeFloat('amount')
            ->expectKeysToBeFloat(['amount'])
            ->expectKeysToBeArray(['fields'])
            ->expectKeyToBeArray('fields')
            ->expectKeyToBeBoolean('isPrivate')
            ->expectKeysToBeBoolean(['isPrivate'])
            ->expectKeysToBeString(['title', 'content'], true)
            ->expectKeyToBeString('title', true)
            ->expectKeyToBeString('content', true)
            ->expectKeyToBeString('description', false);

        $validations = $arrayDefinition->getValidations();
//        print_r($validations);
        $this->assertTrue(is_array($validations));
        $this->assertTrue(isset($validations['expectKeyToBeString'][0][0]));
        $this->assertTrue($validations['expectKeyToBeString'][0][0] === 'title');
        $this->assertTrue($validations['expectKeyToBeString'][0][1]);

        $this->assertTrue(isset($validations['expectKeyToBeString'][1][0]));
        $this->assertTrue($validations['expectKeyToBeString'][1][0] === 'content');
        $this->assertTrue($validations['expectKeyToBeString'][1][1]);

        $this->assertTrue(isset($validations['expectKeyToBeString'][2][0]));
        $this->assertTrue($validations['expectKeyToBeString'][2][0] === 'description');
        $this->assertFalse($validations['expectKeyToBeString'][2][1]);
    }

    public function testStrictArrayValidatorFromDefinition()
    {
        $arrayDefinition = new ValidationDefinition();
        $arrayDefinition
            ->expectNKeys(2)
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

    /**
     * @throws InvalidTypeException
     * @throws InvalidStructureException
     */
    public function testStrictArrayValidatorFromSchema()
    {
        $schemaArray = [
            'title' => [
                'type' => 'string',
                'required' => true
            ],
            'content' => [
                'type' => 'string',
                'nullable' => true,
            ],
        ];

        $schema = new Schema(
            new SchemaCompiler(),
            $schemaArray,
            'mySchemaName'
        );

        $arrayToValidate = [
            'title' => '',
            'content' => null,
        ];

        // will throw an exception if any of tests failed,
        // this should pass
        new StrictValidationFromSchema($schema, $arrayToValidate);
        $this->assertTrue(true);

        // this should not pass
        $this->expectException(InvalidTypeException::class);
        new StrictValidationFromSchema($schema, [
            'title' => '',
            'content' => 1,
        ]);

    }
}
