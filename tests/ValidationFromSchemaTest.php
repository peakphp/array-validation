<?php

declare(strict_types=1);

namespace Tests;

use Peak\ArrayValidation\Schema;
use Peak\ArrayValidation\SchemaCompiler;
use Peak\ArrayValidation\ValidationFromSchema;
use \PHPUnit\Framework\TestCase;

class ValidationFromSchemaTest extends TestCase
{
    public function testValidate()
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

        // this should not pass
        $validation = new ValidationFromSchema($schema, [
            'title' => '',
            'content' => 1,
        ]);

        $this->assertTrue($validation->hasErrors());
        $this->assertTrue(count($validation->getErrors()) == 1);
    }

}
