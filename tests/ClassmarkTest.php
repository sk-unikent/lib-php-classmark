<?php
/**
 * Classmark helper methods.
 *
 * @copyright  2016 Skylar Kelty <S.Kelty@kent.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class ClassmarkTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test we can parse simple classmarks.
     */
    public function testSimple() {
        $classmark = \unikent\Classmark\Classmark::parse("PQ 3980 .R44");
        $this->assertEquals("PQ", $classmark->get_subject());
        $this->assertEquals("3980 .R44", $classmark->get_subdivision());

        $classmark = \unikent\Classmark\Classmark::parse("PQ3980.R44");
        $this->assertEquals("PQ", $classmark->get_subject());
        $this->assertEquals("3980.R44", $classmark->get_subdivision());
    }

    /**
     * Test we can parse authored classmarks.
     */
    public function testAuthor() {
        $classmark = \unikent\Classmark\Classmark::parse("PQ 3980 .R44 dur");
        $this->assertEquals("PQ", $classmark->get_subject());
        $this->assertEquals("3980 .R44", $classmark->get_subdivision());
        $this->assertEquals("dur", $classmark->get_author());

        $classmark = \unikent\Classmark\Classmark::parse("PQ3980.R44           dur");
        $this->assertEquals("PQ", $classmark->get_subject());
        $this->assertEquals("3980.R44", $classmark->get_subdivision());
        $this->assertEquals("dur", $classmark->get_author());
    }

    /**
     * Test we can parse prefixed classmarks.
     */
    public function testPrefix() {
        $classmark = \unikent\Classmark\Classmark::parse("lrg PQ 3980 .R44");
        $this->assertEquals("PQ", $classmark->get_subject());
        $this->assertEquals("3980 .R44", $classmark->get_subdivision());
        $this->assertEquals("lrg", $classmark->get_prefix());

        $classmark = \unikent\Classmark\Classmark::parse("lrgPQ3980.R44");
        $this->assertEquals("PQ", $classmark->get_subject());
        $this->assertEquals("3980.R44", $classmark->get_subdivision());
        $this->assertEquals("lrg", $classmark->get_prefix());
    }

    /**
     * Test we can parse complex classmarks.
     */
    public function testComplex() {
        $classmark = \unikent\Classmark\Classmark::parse("lrg PQ 3980 .R44 dur");
        $this->assertEquals("PQ", $classmark->get_subject());
        $this->assertEquals("3980 .R44", $classmark->get_subdivision());
        $this->assertEquals("lrg", $classmark->get_prefix());
        $this->assertEquals("dur", $classmark->get_author());

        $classmark = \unikent\Classmark\Classmark::parse("lrgPQ3980.R44  dur");
        $this->assertEquals("PQ", $classmark->get_subject());
        $this->assertEquals("3980.R44", $classmark->get_subdivision());
        $this->assertEquals("lrg", $classmark->get_prefix());
        $this->assertEquals("dur", $classmark->get_author());

        $classmark = \unikent\Classmark\Classmark::parse("lrgPQ 3980.R44 dur");
        $this->assertEquals("PQ", $classmark->get_subject());
        $this->assertEquals("3980.R44", $classmark->get_subdivision());
        $this->assertEquals("lrg", $classmark->get_prefix());
        $this->assertEquals("dur", $classmark->get_author());

        $classmark = \unikent\Classmark\Classmark::parse("lrgPQ 3980.R44 dur");
        $this->assertEquals("PQ", $classmark->get_subject());
        $this->assertEquals("3980.R44", $classmark->get_subdivision());
        $this->assertEquals("lrg", $classmark->get_prefix());
        $this->assertEquals("dur", $classmark->get_author());

        $classmark = \unikent\Classmark\Classmark::parse("lrg PQ3980.R44   dur");
        $this->assertEquals("PQ", $classmark->get_subject());
        $this->assertEquals("3980.R44", $classmark->get_subdivision());
        $this->assertEquals("lrg", $classmark->get_prefix());
        $this->assertEquals("dur", $classmark->get_author());

        $classmark = \unikent\Classmark\Classmark::parse("lrgPQ3980.R44 dur");
        $this->assertEquals("PQ", $classmark->get_subject());
        $this->assertEquals("3980.R44", $classmark->get_subdivision());
        $this->assertEquals("lrg", $classmark->get_prefix());
        $this->assertEquals("dur", $classmark->get_author());
    }

    /**
     * Test we can compare classmarks.
     */
    public function testCompare() {
        $classmarka = new \unikent\Classmark\Classmark("A");
        $classmarkb = new \unikent\Classmark\Classmark("M");
        $this->assertEquals(-1, $classmarka->compareTo($classmarkb));
        $this->assertEquals(0, $classmarka->compareTo($classmarka));
        $this->assertEquals(1, $classmarkb->compareTo($classmarka));
    }
}
