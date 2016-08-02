<?php
/**
 * Classmark helper methods.
 *
 * @copyright  2016 Skylar Kelty <S.Kelty@kent.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class RangeTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test simple ranges.
     */
    public function testException()
    {
        $classmarka = new \unikent\Classmark\Classmark('A');
        $classmarkb = new \unikent\Classmark\Classmark('B');
        $this->expectException(InvalidArgumentException::class);
        $range = new \unikent\Classmark\Range($classmarkb, $classmarka);
    }

    /**
     * Test simple ranges.
     */
    public function testSimple()
    {
        $classmarka = new \unikent\Classmark\Classmark('A');
        $classmarkb = new \unikent\Classmark\Classmark('M');
        $range = new \unikent\Classmark\Range($classmarka, $classmarkb);
        $this->assertTrue($range->contains(new \unikent\Classmark\Classmark('B')));
        $this->assertTrue($range->contains(new \unikent\Classmark\Classmark('J')));
        $this->assertFalse($range->contains(new \unikent\Classmark\Classmark('O')));
        $this->assertFalse($range->contains(new \unikent\Classmark\Classmark('Z')));
    }

    /**
     * Test simple ranges.
     */
    public function testSubrange()
    {
        $classmarka = new \unikent\Classmark\Classmark('AC');
        $classmarkb = new \unikent\Classmark\Classmark('M');
        $range = new \unikent\Classmark\Range($classmarka, $classmarkb);
        $this->assertTrue($range->contains(new \unikent\Classmark\Classmark('AD')));
        $this->assertTrue($range->contains(new \unikent\Classmark\Classmark('FG')));
        $this->assertFalse($range->contains(new \unikent\Classmark\Classmark('A')));
        $this->assertFalse($range->contains(new \unikent\Classmark\Classmark('AA')));
        $this->assertFalse($range->contains(new \unikent\Classmark\Classmark('MK')));
        $this->assertFalse($range->contains(new \unikent\Classmark\Classmark('NL')));
    }

    /**
     * Test simple ranges.
     */
    public function testSubdivision()
    {
        $classmarka = new \unikent\Classmark\Classmark('A', 'GREL');
        $classmarkb = new \unikent\Classmark\Classmark('B', 'GREL');
        $range = new \unikent\Classmark\Range($classmarka, $classmarkb);
        $this->assertTrue($range->contains(new \unikent\Classmark\Classmark('A', 'GREL')));
        $this->assertTrue($range->contains(new \unikent\Classmark\Classmark('AG', 'GREL')));
        $this->assertTrue($range->contains(new \unikent\Classmark\Classmark('B', 'GREL')));
        $this->assertFalse($range->contains(new \unikent\Classmark\Classmark('A', 'AASH')));
        $this->assertFalse($range->contains(new \unikent\Classmark\Classmark('B', 'ROAR')));
    }
}
