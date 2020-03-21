<?php

declare(strict_types=1);

namespace Tests;

use Peak\ArrayValidation\Validation;
use \PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{

    public function testValidationPass()
    {
        $data = [ // data
            'field1' => [],
            'field2' => 'strong'
        ];
        $validation = new Validation($data);

        $this->assertFalse($validation->hasErrors());

        $validation->expectKeyToBeArray('field1');
        $validation->expectKeyToBeString('field2');

        $this->assertFalse($validation->hasErrors());
        $this->assertTrue($validation->getLastError() === null);

        $validation->expectKeyToBeString('field1');

        $this->assertTrue($validation->hasErrors());
        $this->assertTrue($validation->getLastError() === 'invalid type for key [field1], type string is expected');
        $this->assertTrue(is_array($validation->getErrors()));
        $this->assertTrue(count($validation->getErrors()) == 1);
    }
}
