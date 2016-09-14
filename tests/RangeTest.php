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

    /**
     * Test simple ranges.
     */
    public function testDottedSubdivision()
    {
        $classmarka = new \unikent\Classmark\Classmark('A', '5.GREL');
        $classmarkb = new \unikent\Classmark\Classmark('B', '8.BLAH');
        $range = new \unikent\Classmark\Range($classmarka, $classmarkb);
        $this->assertTrue($range->contains(new \unikent\Classmark\Classmark('A', '6.GREL')));
        $this->assertTrue($range->contains(new \unikent\Classmark\Classmark('A', '5.GREL')));
        $this->assertTrue($range->contains(new \unikent\Classmark\Classmark('A', '9.GREL')));
        $this->assertTrue($range->contains(new \unikent\Classmark\Classmark('AG', '5.GREL')));
        $this->assertTrue($range->contains(new \unikent\Classmark\Classmark('B', '5.GREL')));
        $this->assertTrue($range->contains(new \unikent\Classmark\Classmark('B', '3')));
        $this->assertFalse($range->contains(new \unikent\Classmark\Classmark('A', '4.GREL')));
        $this->assertFalse($range->contains(new \unikent\Classmark\Classmark('B', '9.BLAH')));
    }

    /**
     * Test simple ranges.
     */
    public function testAdvancedDottedSubdivision()
    {
        $classmarka = new \unikent\Classmark\Classmark('BR', '4.T54');
        $classmarkb = new \unikent\Classmark\Classmark('BR', '20.E7');
        $range = new \unikent\Classmark\Range($classmarka, $classmarkb);
        $this->assertTrue($range->contains(new \unikent\Classmark\Classmark('BR', '6')));
        $this->assertTrue($range->contains(new \unikent\Classmark\Classmark('BR', '6.Tc')));
        $this->assertTrue($range->contains(new \unikent\Classmark\Classmark('BR', '4.T55')));

        $classmarka = new \unikent\Classmark\Classmark('K', '600.Z9');
        $classmarkb = new \unikent\Classmark\Classmark('K', '3240.4');
        $range = new \unikent\Classmark\Range($classmarka, $classmarkb);

        $classmarka = new \unikent\Classmark\Classmark('BS', '476.R45');
        $classmarkb = new \unikent\Classmark\Classmark('BS', '2560');
        $range = new \unikent\Classmark\Range($classmarka, $classmarkb);

        $classmarka = new \unikent\Classmark\Classmark('BR', '1.S3');
        $classmarkb = new \unikent\Classmark\Classmark('BR', '.481.R3');
        $range = new \unikent\Classmark\Range($classmarka, $classmarkb);

        $classmarka = new \unikent\Classmark\Classmark("PN", "513");
        $classmarkb = new \unikent\Classmark\Classmark("PN", "1993.5.G7.H552");
        $range = new \unikent\Classmark\Range($classmarka, $classmarkb);
    }
}
