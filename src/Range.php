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
     *
     * @var Classmark
     */
    private $start;

    /**
     * End of the range.
     *
     * @var Classmark
     */
    private $end;

    /**
     * Constructor.
     */
    public function __construct($start, $end)
    {
        if ($start->compareTo($end) === 1) {
            throw new \InvalidArgumentException('Start must be less than than end.');
        }

        $this->start = $start;
        $this->end = $end;
    }

    /**
     * Does this range contain the given classmark?
     */
    public function contains($classmark)
    {
        $start = $this->start->compareTo($classmark);
        $end = $this->end->compareTo($classmark);

        return ($start === 0 || $start === -1) && ($end === 0 || $end === 1);
    }

    /**
     * String representation.
     */
    public function __toString()
    {
        return $this->start.'-'.$this->end;
    }
}
