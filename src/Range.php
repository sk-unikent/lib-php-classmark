<?php
/**
 * Classmark helper methods.
 *
 * @copyright  2016 Skylar Kelty <S.Kelty@kent.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace unikent\Classmark;

/**
 * Classmark range class.
 */
class Range
{
    /**
     * Start of the range.
     * @var Classmark
     */
    private $start;

    /**
     * End of the range.
     * @var Classmark
     */
    private $end;

    /**
     * Constructor.
     */
    public function __construct($start, $end) {
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * Does this range contain the given classmark?
     */
    public function contains($classmark) {
        return !$this->start->compareTo($classmark) && $this->end->compareTo($classmark);
    }
}
