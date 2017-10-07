<?php

use PHPUnit\Framework\TestCase;

class ArrayGroupTest extends TestCase
{
    protected $states;

    protected $statesObject;

    protected $numbers;

    public function setUp()
    {
        $this->states = [
            [
                'state'  => 'IN',
                'city'   => 'Indianapolis',
                'object' => 'School bus',
            ],
            [
                'state'  => 'IN',
                'city'   => 'Indianapolis',
                'object' => 'Manhole',
            ],
            [
                'state'  => 'IN',
                'city'   => 'Plainfield',
                'object' => 'Basketball',
            ],
            [
                'state'  => 'CA',
                'city'   => 'San Diego',
                'object' => 'Light bulb',
            ],
            [
                'state'  => 'CA',
                'city'   => 'Mountain View',
                'object' => 'Space pen',
            ],
        ];

        $this->statesObject = [
            (object) [
                'state'  => 'IN',
                'city'   => 'Indianapolis',
                'object' => 'School bus',
            ],
            (object) [
                'state'  => 'IN',
                'city'   => 'Indianapolis',
                'object' => 'Manhole',
            ],
            (object) [
                'state'  => 'IN',
                'city'   => 'Plainfield',
                'object' => 'Basketball',
            ],
            (object) [
                'state'  => 'CA',
                'city'   => 'San Diego',
                'object' => 'Light bulb',
            ],
            (object) [
                'state'  => 'CA',
                'city'   => 'Mountain View',
                'object' => 'Space pen',
            ],
        ];

        $this->numbers = [
            [1, 'Only a cat of a different coat'],
            [1, 'That\'s all the truth I know'],
            [2, 'That I must bow so low'],
        ];
    }

    public function testGroupStringFirstLevel()
    {
        $expected = ['IN', 'CA'];

        $this->assertEquals($expected, array_keys(array_group_by($this->states, 'state')));
    }

    public function testGroupByState()
    {
        $expected = [
            'IN' => [
                [
                    'state'  => 'IN',
                    'city'   => 'Indianapolis',
                    'object' => 'School bus',
                ],
                [
                    'state'  => 'IN',
                    'city'   => 'Indianapolis',
                    'object' => 'Manhole',
                ],
                [
                    'state'  => 'IN',
                    'city'   => 'Plainfield',
                    'object' => 'Basketball',
                ],
            ],
            'CA' => [
                [
                    'state'  => 'CA',
                    'city'   => 'San Diego',
                    'object' => 'Light bulb',
                ],
                [
                    'state'  => 'CA',
                    'city'   => 'Mountain View',
                    'object' => 'Space pen',
                ],
            ],
        ];

        $this->assertEquals($expected, array_group_by($this->states, 'state'));
    }

    public function testGroupByStateCity()
    {
        $expected = [
            'IN' => [
                'Indianapolis' => [
                    [
                        'state'  => 'IN',
                        'city'   => 'Indianapolis',
                        'object' => 'School bus',
                    ],
                    [
                        'state'  => 'IN',
                        'city'   => 'Indianapolis',
                        'object' => 'Manhole',
                    ],
                ],
                'Plainfield'   => [
                    [
                        'state'  => 'IN',
                        'city'   => 'Plainfield',
                        'object' => 'Basketball',
                    ],
                ],
            ],
            'CA' => [
                'San Diego'     => [
                    [
                        'state'  => 'CA',
                        'city'   => 'San Diego',
                        'object' => 'Light bulb',
                    ],
                ],
                'Mountain View' => [
                    [
                        'state'  => 'CA',
                        'city'   => 'Mountain View',
                        'object' => 'Space pen',
                    ],
                ],
            ],
        ];

        $this->assertEquals($expected, array_group_by($this->states, 'state', 'city'));
    }

    public function testGroupByInt()
    {
        $expected = [
            1 => [
                [1, 'Only a cat of a different coat'],
                [1, 'That\'s all the truth I know'],
            ],
            2 => [
                [2, 'That I must bow so low'],
            ],
        ];

        $this->assertEquals($expected, array_group_by($this->numbers, 0));
    }

    public function testGroupByFunction()
    {
        $expected = [
            'Indianapolis' => [
                [
                    'state'  => 'IN',
                    'city'   => 'Indianapolis',
                    'object' => 'School bus',
                ],
                [
                    'state'  => 'IN',
                    'city'   => 'Indianapolis',
                    'object' => 'Manhole',
                ],
            ],
            'Plainfield' =>[
                [
                    'state'  => 'IN',
                    'city'   => 'Plainfield',
                    'object' => 'Basketball',
                ],
            ],
            'San Diego' => [
                [
                    'state'  => 'CA',
                    'city'   => 'San Diego',
                    'object' => 'Light bulb',
                ],
            ],
            'Mountain View' => [
                [
                    'state'  => 'CA',
                    'city'   => 'Mountain View',
                    'object' => 'Space pen',
                ],
            ],
        ];

        $this->assertEquals($expected, array_group_by($this->states, function ($record) {
            return $record['city'];
        }));
    }

    public function testGroupWithObjects()
    {
        $expected = [
            'Indianapolis' => [
                (object) [
                    'state'  => 'IN',
                    'city'   => 'Indianapolis',
                    'object' => 'School bus',
                ],
                (object) [
                    'state'  => 'IN',
                    'city'   => 'Indianapolis',
                    'object' => 'Manhole',
                ],
            ],
            'Plainfield' =>[
                (object) [
                    'state'  => 'IN',
                    'city'   => 'Plainfield',
                    'object' => 'Basketball',
                ],
            ],
            'San Diego' => [
                (object) [
                    'state'  => 'CA',
                    'city'   => 'San Diego',
                    'object' => 'Light bulb',
                ],
            ],
            'Mountain View' => [
                (object) [
                    'state'  => 'CA',
                    'city'   => 'Mountain View',
                    'object' => 'Space pen',
                ],
            ],
        ];

        $this->assertEquals($expected, array_group_by($this->statesObject, 'city'));
    }

    public function testGroupTwoLevels()
    {
        $expected = [
            'IN' => [
                'Indianapolis' => [
                    [
                        'state'  => 'IN',
                        'city'   => 'Indianapolis',
                        'object' => 'School bus',
                    ],
                    [
                        'state'  => 'IN',
                        'city'   => 'Indianapolis',
                        'object' => 'Manhole',
                    ],
                ],
                'Plainfield'   => [
                    [
                        'state'  => 'IN',
                        'city'   => 'Plainfield',
                        'object' => 'Basketball',
                    ],
                ],
            ],
            'CA' => [
                'San Diego'     => [
                    [
                        'state'  => 'CA',
                        'city'   => 'San Diego',
                        'object' => 'Light bulb',
                    ],
                ],
                'Mountain View' => [
                    [
                        'state'  => 'CA',
                        'city'   => 'Mountain View',
                        'object' => 'Space pen',
                    ],
                ],
            ],
        ];

        $this->assertEquals($expected, array_group_by($this->states, 'state', 'city'));
    }

    /**
     * @expectedException \TypeError
     * @expectedExceptionMessage Argument 1 passed to array_group_by() must be of the type array
     */
    public function testArrayError()
    {
        array_group_by(null, null);
    }

    /**
     * @expectedException \PHPUnit\Framework\Error\Error
     * @expectedExceptionMessage array_group_by(): The key should be a string, an integer, a float, or a function
     */
    public function testKeyError()
    {
        array_group_by([], null);
    }
}
