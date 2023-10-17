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
 * Image CMYK color class
 *
 * @category   Pop
 * @package    Pop\Image
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2023 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 * @version    1.0.0
 */
class Cmyk extends AbstractColor implements \ArrayAccess
{

    /**
     * Cyan
     * @var float
     */
    protected float $c = 0;

    /**
     * Magenta
     * @var float
     */
    protected float $m = 0;

    /**
     * Yellow
     * @var float
     */
    protected float $y = 0;

    /**
     * Black
     * @var float
     */
    protected float $k = 0;

    /**
     * Constructor
     *
     * Instantiate a PERCENT CMYK Color object
     *
     * @param  mixed $c   0 - 100
     * @param  mixed $m   0 - 100
     * @param  mixed $y   0 - 100
     * @param  mixed $k   0 - 100
     */
    public function __construct(mixed $c, mixed $m, mixed $y, mixed $k)
    {
        $this->setC($c);
        $this->setM($m);
        $this->setY($y);
        $this->setK($k);
    }

    /**
     * Set the cyan value
     *
     * @param  mixed $c
     * @throws OutOfRangeException
     * @return Cmyk
     */
    public function setC(mixed $c): Cmyk
    {
        $c = (float)$c;
        if (($c < 0) || ($c > 100)) {
            throw new OutOfRangeException('Error: The value must be between 0 and 100');
        } else if ($c < 1) {
            $c = (float)($c * 100);
        }
        $this->c = $c;
        return $this;
    }

    /**
     * Set the magenta value
     *
     * @param  mixed $m
     * @throws OutOfRangeException
     * @return Cmyk
     */
    public function setM(mixed $m): Cmyk
    {
        $m = (float)$m;
        if (($m < 0) || ($m > 100)) {
            throw new OutOfRangeException('Error: The value must be between 0 and 100');
        } else if ($m < 1) {
            $m = (float)($m * 100);
        }
        $this->m = $m;
        return $this;
    }

    /**
     * Set the yellow value
     *
     * @param  mixed $y
     * @throws OutOfRangeException
     * @return Cmyk
     */
    public function setY(mixed $y): Cmyk
    {
        $y = (float)$y;
        if (((int)$y < 0) || ((int)$y > 100)) {
            throw new OutOfRangeException('Error: The value must be between 0 and 100');
        } else if ($y < 1) {
            $y = (float)($y * 100);
        }
        $this->y = $y;
        return $this;
    }

    /**
     * Set the black value
     *
     * @param  mixed $k
     * @throws OutOfRangeException
     * @return Cmyk
     */
    public function setK(mixed $k): Cmyk
    {
        if (((int)$k < 0) || ((int)$k > 100)) {
            throw new OutOfRangeException('Error: The value must be between 0 and 100');
        } else if ($k < 1) {
            $k = (float)($k * 100);
        }
        $this->k = $k;
        return $this;
    }

    /**
     * Get the cyan value
     *
     * @return float
     */
    public function getC(): float
    {
        return $this->c;
    }

    /**
     * Get the magenta value
     *
     * @return float
     */
    public function getM(): float
    {
        return $this->m;
    }

    /**
     * Get the yellow value
     *
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }

    /**
     * Get the black value
     *
     * @return float
     */
    public function getK(): float
    {
        return $this->k;
    }

    /**
     * Convert to RGB
     *
     * @return Rgb
     */
    public function toRgb(): Rgb
    {
        // Calculate CMY.
        $c = $this->c / 100;
        $m = $this->m / 100;
        $y = $this->y / 100;
        $k = $this->k / 100;

        $cyan    = (($c * (1 - $k)) + $k);
        $magenta = (($m * (1 - $k)) + $k);
        $yellow  = (($y * (1 - $k)) + $k);

        // Calculate RGB.
        $r = round((1 - $cyan) * 255);
        $g = round((1 - $magenta) * 255);
        $b = round((1 - $yellow) * 255);

        return new Rgb($r, $g, $b);
    }

    /**
     * Convert to Gray
     *
     * @return Grayscale
     */
    public function toGray(): Grayscale
    {
        return new Grayscale($this->k);
    }

    /**
     * Convert to array
     *
     * @param  bool $assoc
     * @return array
     */
    public function toArray(bool $assoc = true): array
    {
        $cmyk = [];

        if ($assoc) {
            $cmyk['c'] = $this->c;
            $cmyk['m'] = $this->m;
            $cmyk['y'] = $this->y;
            $cmyk['k'] = $this->k;
        } else {
            $cmyk[] = $this->c;
            $cmyk[] = $this->m;
            $cmyk[] = $this->y;
            $cmyk[] = $this->k;
        }

        return $cmyk;
    }

    /**
     * Convert to readable string
     *
     * @param  ?string $format
     * @return string
     */
    public function render(?string $format = null): string
    {
        if ($format == self::COMMA) {
            return $this->c . ', ' . $this->m . ', ' . $this->y . ', ' . $this->k;
        } else if ($format == self::CSS) {
            $rgb = $this->toRgb();
            return $rgb->render($format);
        } else if ($format == self::PERCENT) {
            return round(($this->c / 100), 2) . ' ' . round(($this->m / 100), 2) . ' ' .
                round(($this->y / 100), 2) . ' ' . round(($this->k / 100), 2);
        } else {
            return $this->c . ' ' . $this->m . ' ' . $this->y . ' ' . $this->k;
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
        return (($offset == 'c') || ($offset == 'm') || ($offset == 'y') || ($offset == 'm'));
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
            case 'c':
                return $this->getC();
                break;
            case 'm':
                return $this->getM();
                break;
            case 'y':
                return $this->getY();
                break;
            case 'k':
                return $this->getK();
                break;
            default:
                throw new Exception("Error: You can only use 'c', 'm', 'y' or 'k'.");
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
            case 'c':
                $this->setC($value);
                break;
            case 'm':
                $this->setM($value);
                break;
            case 'y':
                $this->setY($value);
                break;
            case 'k':
                $this->setK($value);
                break;
            default:
                throw new Exception("Error: You can only use 'c', 'm', 'y' or 'k'.");
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