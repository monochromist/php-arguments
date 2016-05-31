<?php

namespace monochromist;

use monochromist\Arguments;

class ArgumentsTest extends \PHPUnit_Framework_TestCase
{
    public function testValidInput()
    {
        $this->assertTrue(Arguments::validate("123", ["string"]));
        $this->assertTrue(Arguments::validate([123], ['string', 'array']));
        $this->assertTrue(Arguments::validate("123", ['string', 'array']));
    }

    /**
     * Complains if argument is not array
     * @expectedException InvalidArgumentException
     */
    public function testInvalidInput()
    {
        $this->assertTrue(Arguments::validate(123, ["array"]));
    }

    /**
     * Complains if argument is not one of expected types
     * @expectedException InvalidArgumentException
     */
    public function testInvalidInputAnyOf()
    {
        $this->assertTrue(Arguments::validate(false, ["array", "string"]));
    }

    /**
     * Must pass if associative array is given
     */
    public function testValidateAssociativeArray()
    {
        $this->assertTrue(Arguments::validateAssociativeArray(["a" => 1, "b" => 2]));
    }

    /**
     * Complains if array is not strictly associative
     * @expectedException InvalidArgumentException
     */
    public function testValidateAssociativeArrayInvalid()
    {
        $this->assertTrue(Arguments::validateAssociativeArray(["a", "b"]));
    }

    /**
     * Must return the first non-empty value
     */
    public function testPrioritize()
    {
        $value = Arguments::prioritize([null, "", [], 1, 2, null]);
        $this->assertEquals($value, 1);
    }

    /**
     * Complains if element is null
     * @expectedException InvalidArgumentException
     */
    public function testNotNull()
    {
        Arguments::notNull(null);
    }

    /**
     * Must pass without complaining
     */
    public function testNotNullOk()
    {
        $this->assertTrue(Arguments::notNull(1));
    }
}
