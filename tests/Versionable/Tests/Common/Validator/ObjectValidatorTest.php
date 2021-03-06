<?php

namespace Versionable\Tests\Common\Validator;

use Versionable\Common\Validator\ObjectValidator;
use Versionable\Common\Collection\MockComparableItem;

/**
 * Test class for ObjectValidator.
 * Generated by PHPUnit on 2012-07-18 at 17:41:28.
 */
class ObjectValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ObjectValidator
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new ObjectValidator;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    public function isValidProvider()
    {
        return array(
            array(new \stdClass(), true),
            array(new MockComparableItem('test'), true),
            array('a', false),
            array(1234, false),
        );
    }

    /**
     * @covers Versionable\Common\Validator\ObjectValidator::isValid
     * @dataProvider isValidProvider
     */
    public function testIsValid($value, $expected)
    {
        $this->assertEquals($expected, $this->object->isValid($value));
    }

}
