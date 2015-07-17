<?php

class ArrayGroupTest extends PHPUnit_Framework_TestCase
{

	protected $states;

	protected $numbers;

	public function setUp()
	{
		$this->states = array(
			array(
				'state'  => 'IN',
				'city'   => 'Indianapolis',
				'object' => 'School bus',
			),
			array(
				'state'  => 'IN',
				'city'   => 'Indianapolis',
				'object' => 'Manhole',
			),
			array(
				'state'  => 'IN',
				'city'   => 'Plainfield',
				'object' => 'Basketball',
			),
			array(
				'state'  => 'CA',
				'city'   => 'San Diego',
				'object' => 'Light bulb',
			),
			array(
				'state'  => 'CA',
				'city'   => 'Mountain View',
				'object' => 'Space pen',
			),
		);

		$this->numbers = array(
			array(1, 'Only a cat of a different coat'),
			array(1, 'That\'s all the truth I know'),
			array(2, 'That I must bow so low'),
		);
	}

	public function testGroupStringFirstLevel()
	{
		$expected = array('IN', 'CA');
		$this->assertEquals($expected, array_keys(array_group_by($this->states, 'state')));
	}

	public function testGroupByState()
	{
		$expected = array(
			'IN' => array(
				array(
					'state'  => 'IN',
					'city'   => 'Indianapolis',
					'object' => 'School bus',
				),
				array(
					'state'  => 'IN',
					'city'   => 'Indianapolis',
					'object' => 'Manhole',
				),
				array(
					'state'  => 'IN',
					'city'   => 'Plainfield',
					'object' => 'Basketball',
				),
			),
			'CA' => array(
				array(
					'state'  => 'CA',
					'city'   => 'San Diego',
					'object' => 'Light bulb',
				),
				array(
					'state'  => 'CA',
					'city'   => 'Mountain View',
					'object' => 'Space pen',
				),
			)
		);
		$this->assertEquals($expected, array_group_by($this->states, 'state'));
	}

	public function testGroupByStateCity()
	{
		$expected = array(
			'IN' => array(
				'Indianapolis' => array(
					array(
						'state'  => 'IN',
						'city'   => 'Indianapolis',
						'object' => 'School bus',
					),
					array(
						'state'  => 'IN',
						'city'   => 'Indianapolis',
						'object' => 'Manhole',
					),
				),
				'Plainfield'   => array(
					array(
						'state'  => 'IN',
						'city'   => 'Plainfield',
						'object' => 'Basketball',
					),
				),
			),
			'CA' => array(
				'San Diego'     => array(
					array(
						'state'  => 'CA',
						'city'   => 'San Diego',
						'object' => 'Light bulb',
					),
				),
				'Mountain View' => array(
					array(
						'state'  => 'CA',
						'city'   => 'Mountain View',
						'object' => 'Space pen',
					),
				),
			)
		);
		$this->assertEquals($expected, array_group_by($this->states, 'state', 'city'));

	}

	public function testGroupByInt()
	{
		$expected = array(
			1 => array(
				array(1, 'Only a cat of a different coat'),
				array(1, 'That\'s all the truth I know'),
			),
			2 => array(
				array(2, 'That I must bow so low')
			)
		);
		$this->assertEquals($expected, array_group_by($this->numbers, 0));
	}

	public function testGroupTwoLevels()
	{
		$expected = array(
			'IN' => array(
				'Indianapolis' => array(
					array(
						'state'  => 'IN',
						'city'   => 'Indianapolis',
						'object' => 'School bus',
					),
					array(
						'state'  => 'IN',
						'city'   => 'Indianapolis',
						'object' => 'Manhole',
					),
				),
				'Plainfield'   => array(
					array(
						'state'  => 'IN',
						'city'   => 'Plainfield',
						'object' => 'Basketball',
					),
				),
			),
			'CA' => array(
				'San Diego'     => array(
					array(
						'state'  => 'CA',
						'city'   => 'San Diego',
						'object' => 'Light bulb',
					),
				),
				'Mountain View' => array(
					array(
						'state'  => 'CA',
						'city'   => 'Mountain View',
						'object' => 'Space pen',
					),
				),
			),
		);
	}

	/**
	 * @expectedException PHPUnit_Framework_Error
	 * @expectedExceptionMessage array_group_by(): The first argument should be an array
	 */
	public function testArrayError()
	{
		array_group_by(null, null);
	}

	/**
	 * @expectedException PHPUnit_Framework_Error
	 * @expectedExceptionMessage array_group_by(): The key should be a string or an integer
	 */
	public function testKeyError()
	{
		array_group_by(array(), null);
	}

}
