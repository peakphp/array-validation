<?php

declare(strict_types=1);

namespace Tests;

use Peak\ArrayValidation\Validation;
use \PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{

    public function dataProvider()
    {
        return [
            [

                ['field1' => [], 'field2' => 'text', 'field3' => 1, 'field4'=> true, 'field5' => 1.2, 'field6' => new \StdClass()], // data
                null, // dataName
                [ // validation rules
                    'expectOnlyKeys' => [ ['field1', 'field2', 'field3', 'field4', 'field5', 'field6'] ],
                    'expectExactlyKeys' => [ ['field1', 'field2', 'field3', 'field4', 'field5', 'field6'] ],
                    'expectKeyToBeArray' => ['field1'],
                    'expectKeyToBeString' => ['field2'],
                    'expectKeyToBeInteger' => ['field3'],
                    'expectKeyToBeBoolean' => ['field4'],
                    'expectKeyToBeFloat' => ['field5'],
                    'expectKeyToBeObject' => ['field6'],

                    'expectKeysToBeArray' => [['field1']],
                    'expectKeysToBeString' => [['field2']],
                    'expectKeysToBeInteger' => [['field3']],
                    'expectKeysToBeBoolean' => [['field4']],
                    'expectKeysToBeFloat' => [['field5']],
                    'expectKeysToBeObject' => [['field6']],
                ],
                false, // has error(s)
                0, // number of error(s)
                [] // error(s) messages
            ],

            // this one will test types errors
            [
                ['field6' => [], 'field5' => 'text', 'field4' => 1, 'field3'=> true, 'field2' => 1.2, 'field1' => new \StdClass()], // data
                'myValidation', // dataName
                [ // validation rules
                    'expectKeyToBeArray' => ['field1'],
                    'expectKeyToBeString' => ['field2'],
                    'expectKeyToBeInteger' => ['field3'],
                    'expectKeyToBeBoolean' => ['field4'],
                    'expectKeyToBeFloat' => ['field5'],
                    'expectKeyToBeObject' => ['field6'],
                ],
                true, // has error(s)
                6, // number of error(s)
                [
                    '[myValidation] invalid type for key [field1], type array is expected',
                    '[myValidation] invalid type for key [field2], type string is expected',
                    '[myValidation] invalid type for key [field3], type integer is expected',
                    '[myValidation] invalid type for key [field4], type boolean is expected',
                    '[myValidation] invalid type for key [field5], type float is expected',
                    '[myValidation] invalid type for key [field6], type object is expected',
                ] // error(s) messages
            ],

            //this one will tests structure errors
            [
                ['field6' => 'im here!', 'field7' => 'foo'], // data
                null, // dataName
                [ // validation rules
                    'expectOnlyKeys' => [ ['field1', 'field2', 'field3', 'field4', 'field5', 'field6'] ],
                    'expectExactlyKeys' => [ ['field1', 'field2', 'field3', 'field4', 'field5', 'field6'] ],
                    'expectAtLeastKeys' => [ ['field1'] ],
                    'expectOnlyOneFromKeys' => [ ['field1'] ],
                    'expectNKeys' => [1]
                ],
                true, // has error(s)
                5, // number of error(s)
                [
                    'invalid data, expected only keys [field1, field2, field3, field4, field5, field6], received [field6, field7]',
                    'invalid data, expected exactly keys [field1, field2, field3, field4, field5, field6], received [field6, field7]',
                    'invalid data, expected at least keys [field1], received [field6, field7]',
                    'invalid data, expected only one of keys [field1], received [field6, field7]',
                    'invalid data, expected 1 element, received 2 elements'
                ] // error(s) messages
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param array $data
     * @param string|null $dataName
     * @param array $validationMethods
     * @param bool $hasErrors
     * @param int $errorsCount
     * @param array $errorsMsg
     */
    public function testScenarios(array $data, ?string $dataName, array $validationMethods, bool $hasErrors, int $errorsCount, array $errorsMsg)
    {
        $validation = new Validation($data, $dataName);

        foreach ($validationMethods as $methodName => $methodArgs) {
            call_user_func_array([$validation, $methodName], $methodArgs);
        }

        $this->assertTrue($validation->hasErrors() === $hasErrors);
        $this->assertTrue(count($validation->getErrors()) === $errorsCount);
        $this->assertTrue($validation->getErrors() === $errorsMsg);

        if ($errorsCount > 0) {
            $errors = $validation->getErrors();
            $this->assertTrue($validation->getLastError() === $errors[array_key_last($errors)]);
        } else {
            $this->assertTrue($validation->getLastError() === null);
        }
    }
}
