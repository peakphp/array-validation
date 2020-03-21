<?php

declare(strict_types=1);

namespace Tests;

use Peak\ArrayValidation\Exception\InvalidStructureException;
use Peak\ArrayValidation\Exception\InvalidTypeException;
use Peak\ArrayValidation\StrictValidationFromDefinition;
use Peak\ArrayValidation\SchemaCompiler;
use Peak\ArrayValidation\ValidationInterface;
use \PHPUnit\Framework\TestCase;


class SchemaCompilerTest extends TestCase
{

    public function dataProvider()
    {
        return [
            [
                [ // schema
                    'name' => 'category.schema',
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
                    'name' => 'post.schema',
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
        $def = new SchemaCompiler();
        $validationDefinition = $def->compileSchema($schema);
        $this->assertInstanceOf(ValidationInterface::class, $validationDefinition);
        new StrictValidationFromDefinition($validationDefinition, $data);
    }
}
