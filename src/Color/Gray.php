<?php
/**
 * Pop PHP Framework (http://www.popphp.org/)
 *
 * @link       https://github.com/popphp/popphp-framework
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2023 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 */

/**
 * @namespace
 */
namespace Pop\Color\Color;

use OutOfRangeException;

/**
 * Image gray color class
 *
 * @category   Pop
 * @package    Pop\Image
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2023 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 * @version    3.4.0
 */
class Gray extends AbstractColor implements \ArrayAccess
{

    /**
     * Gray
     * @var float
     */
    protected float $gray = 0;

    /**
     * Constructor
     *
     * Instantiate a PERCENT Gray Color object
     *
     * @param  mixed $gray   0 - 100
     */
    public function __construct(mixed $gray)
    {
        $this->setGray($gray);
    }

    /**
     * Set the gray value
     *
     * @param  mixed $gray
     * @throws OutOfRangeException
     * @return Gray
     */
    public function setGray(mixed $gray): Gray
    {
        $gray = (float)$gray;
        if (($gray < 0) || ($gray > 100)) {
            throw new OutOfRangeException('Error: The value must be between 0 and 100');
        }
        $this->gray = $gray;
        return $this;
    }

    /**
     * Get the gray value
     *
     * @return float
     */
    public function getGray(): float
    {
        return $this->gray;
    }

    /**
     * Convert to CMYK
     *
     * @return Cmyk
     */
    public function toCmyk(): Cmyk
    {
        return new Cmyk(0, 0, 0, $this->gray);
    }

    /**
     * Convert to RGB
     *
     * @return Rgb
     */
    public function toRgb(): Rgb
    {
        return new Rgb($this->gray, $this->gray, $this->gray);
    }

    /**
     * Convert to array
     *
     * @param  bool $assoc
     * @return array
     */
    public function toArray(bool $assoc = true): array
    {
        $gray = [];

        if ($assoc) {
            $gray['gray'] = $this->gray;
        } else {
            $gray[] = $this->gray;
        }

        return $gray;
    }

    /**
     * Convert to readable string
     *
     * @param  ?string $format
     * @return string
     */
    public function render(?string $format = null): string
    {
        if (($format == self::CSS) || ($format == self::COMMA)) {
            $rgb = $this->toRgb();
            return $rgb->render($format);
        } else if ($format == self::PERCENT) {
            return (string)round(($this->gray / 100), 2);
        } else {
            return (string)$this->gray;
        }
    }

    /**
     * Method to print the color object
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render(self::PERCENT);
    }

    /**
     * Magic method to set the color value
     *
     * @param  string $name
     * @param  mixed  $value
     * @throws Exception
     * @return void
     */
    public function __set(string $name, mixed $value): void
    {
        $this->offsetSet($name, $value);
    }

    /**
     * Magic method to return the color value
     *
     * @param  string $name
     * @throws Exception
     * @return mixed
     */
    public function __get(string $name): mixed
    {
        return $this->offsetGet($name);
    }

    /**
     * Magic method to return whether the color value exists
     *
     * @param  string $name
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return $this->offsetExists($name);
    }

    /**
     * Magic method to unset color value
     *
     * @param  string $name
     * @throws Exception
     * @return void
     */
    public function __unset(string $name): void
    {
        throw new Exception('You cannot unset the properties of this color object.');
    }

    /**
     * ArrayAccess offsetExists
     *
     * @param  mixed $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return ($offset == 'gray');
    }

    /**
     * ArrayAccess offsetGet
     *
     * @param  mixed $offset
     * @throws Exception
     * @return mixed
     */
    public function offsetGet(mixed $offset): mixed
    {
        switch ($offset) {
            case 'gray':
                return $this->getGray();
                break;
            default:
                throw new Exception("Error: You can only use 'gray'.");
        }
    }

    /**
     * ArrayAccess offsetSet
     *
     * @param  mixed $offset
     * @param  mixed $value
     * @throws Exception
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        switch ($offset) {
            case 'gray':
                $this->setGray($value);
                break;
            default:
                throw new Exception("Error: You can only use 'gray'.");
        }
    }

    /**
     * ArrayAccess offsetUnset
     *
     * @param  mixed $offset
     * @throws Exception
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        throw new Exception('You cannot unset the properties of this color object.');
    }

}