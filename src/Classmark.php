<?php
/**
 * Classmark helper methods.
 *
 * @copyright  2016 Skylar Kelty <S.Kelty@kent.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace unikent\Classmark;

/**
 * Classmark representation.
 */
class Classmark
{
    /**
     * Classmark subject.
     *
     * @var string
     */
    private $subject;

    /**
     * Classmark subdivision.
     *
     * @var string
     */
    private $subdivision;

    /**
     * Classmark author.
     *
     * @var string
     */
    private $author;

    /**
     * Classmark prefix.
     *
     * @var string
     */
    private $prefix;

    /**
     * Construct a new classmark object.
     */
    public function __construct($subject, $subdivision = '', $author = '', $prefix = '')
    {
        $this->subject = $subject;
        $this->subdivision = $subdivision;
        $this->author = $author;
        $this->prefix = $prefix;
    }

    /**
     * Parse a classmark object.
     */
    public static function parse($classmark)
    {
        // Validate the classmark.
        if (!is_string($classmark) || !preg_match('/^([a-z\ ]*[A-Z]{1,2}[A-Za-z0-9\.\ ]*)$/', $classmark)) {
            throw new \InvalidArgumentException('Invalid classmark provided for parse.');
        }

        // Setup our variables.
        $author = '';
        $prefix = '';
        $subject = '';
        $subdivision = '';
        $classmark = trim($classmark);

        // Strip any lower-case characters from the start of the string.
        if (preg_match('/^([a-z]*)/', $classmark, $matches)) {
            $prefix = $matches[1];
            $classmark = trim(substr($classmark, strlen($prefix)));
        }

        // Strip any 3 lower case characters from the end of the string
        // if separated by a space.
        if (preg_match('/\ ([a-z]{3})$/', $classmark, $matches)) {
            $author = $matches[1];
            $classmark = trim(substr($classmark, 0, strpos($classmark, $author)));
        }

        // Strip off the first set of uppercase alpha characters.
        if (preg_match('/(^[A-Z]{1,2})/', $classmark, $matches)) {
            $subject = $matches[1];
            $classmark = trim(substr($classmark, strlen($subject)));
        }

        // Subdivision is whatever is left.
        $subdivision = $classmark;

        return new static($subject, $subdivision, $author, $prefix);
    }

    /**
     * Return the author.
     */
    public function get_author()
    {
        return $this->author;
    }

    /**
     * Return the prefix.
     */
    public function get_prefix()
    {
        return $this->prefix;
    }

    /**
     * Return the subject.
     */
    public function get_subject()
    {
        return $this->subject;
    }

    /**
     * Return the subdivision.
     */
    public function get_subdivision()
    {
        return $this->subdivision;
    }

    /**
     * Comparison.
     * Returns 0 if we match, 1 is we are greater than $classmark or -1 if we are less than $classmark.
     */
    public function compareTo($classmark)
    {
        if (!($classmark instanceof self)) {
            throw new \InvalidArgumentException('Invalid classmark provided for comparison.');
        }

        // If subjects are equal we base it on subdivision.
        if ($this->subject == $classmark->subject) {
            return $this->subdivision == $classmark->subdivision ? 0 : ($this->subdivision > $classmark->subdivision ? 1 : -1);
        }

        return $this->subject == $classmark->subject ? 0 : ($this->subject > $classmark->subject ? 1 : -1);
    }

    /**
     * String representation.
     */
    public function __toString()
    {
        return trim("{$this->prefix}{$this->subject}{$this->subdivision}{$this->author}");
    }
}
