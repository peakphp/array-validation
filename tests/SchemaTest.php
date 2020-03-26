<?php

declare(strict_types=1);

namespace Tests;

use Peak\ArrayValidation\Exception\InvalidStructureException;
use Peak\ArrayValidation\Exception\InvalidTypeException;
use Peak\ArrayValidation\Schema;
use Peak\ArrayValidation\StrictValidationFromDefinition;
use Peak\ArrayValidation\SchemaCompiler;
use Peak\ArrayValidation\ValidationInterface;
use \PHPUnit\Framework\TestCase;

class SchemaTest extends TestCase
{

    public function dataProvider()
    {
        return [
            [
                [ // schema
                    'field1' => [
                        'type' => 'array',
                        'required' => true
                    ],
                    'field2' => [
                        'type' => 'string',
                        'required' => true
                    ],
                ],
                [ // data
                    'field1' => [],
                    'field2' => 'strong'
                ]
            ],
            [
                [ // schema
                    'field1' => [
                        'type' => 'array',
                        'required' => true
                    ],
                    'field2' => [
                        'type' => 'string',
                        'required' => false,
                        'nullable' => true,
                    ],
                ],
                [ // data
                    'field1' => [],
                    'field2' => null
                ]
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param $schema
     * @param $data
     * @throws InvalidStructureException
     * @throws InvalidTypeException
     */
    public function testExpectExactlyKeys($schema, $data)
    {
        $compiler = new SchemaCompiler();
        $schema = new Schema($compiler, $schema, 'myName');
        $validationDefinition = $schema->compile();
        $this->assertInstanceOf(ValidationInterface::class, $validationDefinition);
        $this->assertTrue($schema->getName() === 'myName');
        new StrictValidationFromDefinition($validationDefinition, $data);
    }

    public function testJsonSerialize()
    {
        $compiler = new SchemaCompiler();
        $schema = new Schema($compiler, ['schema'], 'myName');
        $this->assertTrue(json_encode($schema) === '["schema"]');
    }
}
