<?php
/**
 * @package	    Joomla.UnitTest
 * @subpackage  Schema
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license	    GNU General Public License version 2 or later; see LICENSE
 */

/**
 * Test class for JSchemaChangeset.
 * Generated by PHPUnit on 2012-07-26 at 20:43:07.
 */
class JSchemaChangesetTest extends TestCase
{
	/**
	 * The mock database object
	 *
	 * @var  JDatabaseDriver
	 */
	protected $db;

	/**
	 * @var  JSchemaChangeset
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		// Store the factory state so we can mock the necessary objects
		$this->saveFactoryState();

		JFactory::$database = $this->getMockDatabase();

		// Set up our mock database
		$this->db = JFactory::getDbo();
		$this->db->name = 'mysqli';

		// Register the object
		$this->object = JSchemaChangeset::getInstance($this->db, null);
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{
		// Restore the factory state
		$this->restoreFactoryState();
	}

	/**
	 * Tests the __construct method
	 *
	 * @return  void
	 *
	 * @since   3.0
	 *
	 * @covers  JSchemaChangeset::__construct
	 */
	public function test__construct()
	{
		$this->assertThat(
			new JSchemaChangeset($this->db, null),
			$this->isInstanceOf('JSchemaChangeset')
		);
	}

	/**
	 * Tests the getInstance method
	 *
	 * @return  void
	 *
	 * @since   3.0
	 *
	 * @covers  JSchemaChangeset::getInstance
	 */
	public function testGetInstance()
	{
		$this->assertThat(
			JSchemaChangeset::getInstance($this->db, null),
			$this->isInstanceOf('JSchemaChangeset')
		);
	}

	/**
	 * @covers JSchemaChangeset::check
	 * @todo   Implement testCheck().
	 */
	public function testCheck()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete('This test has not been implemented yet.'
		);
	}

	/**
	 * @covers JSchemaChangeset::fix
	 * @todo   Implement testFix().
	 */
	public function testFix()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete('This test has not been implemented yet.'
		);
	}

	/**
	 * @covers JSchemaChangeset::getStatus
	 * @todo   Implement testGetStatus().
	 */
	public function testGetStatus()
	{
		$this->assertThat(
			$this->object->getStatus(),
			$this->isType('array')
		);
	}

	/**
	 * Tests the getSchema method
	 *
	 * @return  void
	 *
	 * @since   3.0
	 *
	 * @covers  JSchemaChangeset::getSchema
	 */
	public function testGetSchema()
	{
		$this->assertThat(
			$this->object->getSchema(),
			$this->isType('string')
		);
	}
}
