<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * StringList Class
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 
 * This class has a simple function - takes a list as a 
 * string and outputs an Array
 * 
 * The values in the string must be separated by commna ','.
 * String is exploded, filtered for empty values and trimmed.
 * 
 * Usage:
 * 1. $stringList = new StringList('a,b,c');
 *    $stringList->toArray();
 * 
 * 2. StringList::createArray('a,b,c'); - static interface
 *    to (1).
 * 
 * 3. StringList::create('a,b,c')->toArray() - static 
 *    interface to return instance and then convert to 
 *    Array; 
 */

namespace Techtell\LaravelGuardPass\Helpers;

class StringList
{
    public $string;
    public $array = [];

    /**
     * Constructor
     */
    public function __construct(string $string)
    {
        $this->string = $string;
        return $this;
    }

    /**
     * Static interface to initialize class
     */
    public static function create(string $string): StringList
    {
        return new self($string);
    }

    /**
     * Static interface to create Array
     */
    public static function createArray($string): array
    {
        return self::create($string)->toArray();
    }

    /**
     * Convert to Array and normalize
     */
    public function toArray(): array
    {
        return $this->explode()->trim()->filter()->array;
    }

    /**
     * Convert String list to Array
     */
    public function explode(): StringList
    {
        $this->array = explode(',', $this->string);
        return $this;
    }

    /**
     * Filter Array for empty values
     */
    public function filter(): StringList
    {
        $this->array = array_filter($this->array);
        return $this;
    }

    /**
     * Trim all values
     */
    public function trim(): StringList
    {
        $this->array = array_map('trim', $this->array);
        return $this;
    }
}
