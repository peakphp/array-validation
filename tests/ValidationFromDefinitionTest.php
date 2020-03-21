<?php

declare(strict_types=1);

namespace Tests;

use Peak\ArrayValidation\ValidationDefinition;
use Peak\ArrayValidation\ValidationFromDefinition;
use \PHPUnit\Framework\TestCase;

class ValidationFromDefinitionTest extends TestCase
{
    public function testValidate()
    {
        $validationDefinition = new ValidationDefinition();

        $validationDefinition
            ->expectAtLeastKeys(['title', 'content'])
            ->expectExactlyKeys(['title', 'content'])
            ->expectOnlyKeys(['title', 'content'])
            ->expectKeysToBeString(['title', 'content'], true);

        $data = [
            'item1' => 45.1,
            'item2' => 36.5,
            'item3' => [],
            'item4' => null,
            'item5' => 99,
        ];

        $validation = new ValidationFromDefinition($validationDefinition, $data);

        $this->assertTrue($validation->hasErrors());
        $this->assertTrue(count($validation->getErrors()) === 3);
    }

}
