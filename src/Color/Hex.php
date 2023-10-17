<?php
/**
 * Pop PHP Framework (http://www.popphp.org/)
 *
 * @link       https://github.com/popphp/popphp-framework
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2024 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 */

/**
 * @namespace
 */
namespace Pop\Color\Color;

use OutOfRangeException;

/**
 * Pop Color Hex color class
 *
 * @category   Pop
 * @package    Pop\Color
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2024 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 * @version    1.0.0
 */
class Hex extends AbstractColor implements \ArrayAccess
{

    /**
     * R value
     * @var ?string
     */
    protected ?string $r = null;

    /**
     * G value
     * @var ?string
     */
    protected ?string $g = null;

    /**
     * B value
     * @var ?string
     */
    protected ?string $b = null;

    /**
     * Hex value
     * @var ?string
     */
    protected ?string $hex = null;

    /**
     * Constructor
     *
     * Instantiate the CSS hex color object
     *
     * @param string $hex
     */
    public function __construct(string $hex)
    {
        $this->setHex($hex);
    }

    /**
     * Set hex value
     *
     * @param  string $hex
     * @throws OutOfRangeException
     * @return self
     */
    public function setHex(string $hex): self
    {
        $hex = strtolower($hex);
        $hex = (str_starts_with($hex, '#')) ? substr($hex, 1) : $hex;

        if ((strlen($hex) != 3) && (strlen($hex) != 6)) {
            throw new OutOfRangeException('Error: The hex string was not the correct length.');
        }
        if (!$this->isValid($hex)) {
            throw new OutOfRangeException('Error: The hex string was out of range.');
        }

        if (strlen($hex) == 3) {
            $this->setR(substr($hex, 0, 1));
            $this->setG(substr($hex, 1, 1));
            $this->setB(substr($hex, 2, 1));
        } else {
            $this->setR(substr($hex, 0, 2));
            $this->setG(substr($hex, 2, 2));
            $this->setB(substr($hex, 4, 2));
        }

        $this->hex = $hex;

        return $this;
    }

    /**
     * Set R value
     *
     * @param  string $r
     * @throws OutOfRangeException
     * @return self
     */
    public function setR(string $r): self
    {
        if (!$this->isValid($r)) {
            throw new OutOfRangeException('Error: The $r hex string was out of range.');
        }
        $this->r = $r;
        return $this;
    }

    /**
     * Set G value
     *
     * @param  string $g
     * @throws OutOfRangeException
     * @return self
     */
    public function setG(string $g): self
    {
        if (!$this->isValid($g)) {
            throw new OutOfRangeException('Error: The $g hex string was out of range.');
        }
        $this->g = $g;
        return $this;
    }

    /**
     * Set B value
     *
     * @param  string $b
     * @throws OutOfRangeException
     * @return self
     */
    public function setB(string $b): self
    {
        if (!$this->isValid($b)) {
            throw new OutOfRangeException('Error: The $b hex string was out of range.');
        }
        $this->b = $b;
        return $this;
    }

    /**
     * Get hex value
     *
     * @return string
     */
    public function getHex(): string
    {
        return $this->hex;
    }

    /**
     * Get R value
     *
     * @return string|null
     */
    public function getR(): string|null
    {
        return $this->r;
    }

    /**
     * Get G value
     *
     * @return string|null
     */
    public function getG(): string|null
    {
        return $this->g;
    }

    /**
     * Get B value
     *
     * @return string|null
     */
    public function getB(): string|null
    {
        return $this->b;
    }

    /**
     * Method to determine if the hex value is valid
     *
     * @param  string $hex
     * @return bool
     */
    public function isValid(string $hex): bool
    {
        $valid     = true;
        $hexValues = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f'];
        $hexAry    = str_split($hex);

        foreach ($hexAry as $h) {
            if (!in_array($h, $hexValues)) {
                $valid = false;
                break;
            }
        }

        return $valid;
    }

    /**
     * Convert to RGB
     *
     * @return Rgb
     */
    public function toRgb(): Rgb
    {
        $hexR  = $this->r;
        $hexG  = $this->g;
        $hexB  = $this->b;

        if (strlen($hexR) == 1) {
            $hexR .= $hexR;
        }
        if (strlen($hexG) == 1) {
            $hexG .= $hexG;
        }
        if (strlen($hexB) == 1) {
            $hexB .= $hexB;
        }

        $r = base_convert($hexR, 16, 10);
        $g = base_convert($hexG, 16, 10);
        $b = base_convert($hexB, 16, 10);

        return new Rgb($r, $g, $b);
    }

    /**
     * Convert to HSL
     *
     * @return Hsl
     */
    public function toHsl(): Hsl
    {
        return $this->toRgb()->toHsl();
    }

    /**
     * Convert to array
     *
     * @param  bool $assoc
     * @return array
     */
    public function toArray(bool $assoc = true): array
    {
        $hex = [];

        if ($assoc) {
            $hex['hex'] = '#' . $this->hex;
            $hex['r']   = $this->r;
            $hex['g']   = $this->g;
            $hex['b']   = $this->b;
        } else {
            $hex[] = '#' . $this->hex;
            $hex[] = $this->r;
            $hex[] = $this->g;
            $hex[] = $this->b;
        }

        return $hex;
    }

    /**
     * Convert to readable string
     *
     * @param  ?string $format
     * @return string
     */
    public function render(?string $format = null): string
    {
        if (($format == self::COMMA) || ($format == self::PERCENT)) {
            $rgb = $this->toRgb();
            return $rgb->render($format);
        } else {
            return '#' . $this->hex;
        }
    }

    /**
     * Return CSS-formatted string
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->render(self::CSS);
    }

    /**
     * Magic method to set the color value
     *
     * @param  string $name
     * @param  mixed $value
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
        return (($offset == 'r') || ($offset == 'g') || ($offset == 'b') || ($offset == 'hex'));
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
            case 'r':
                return $this->getR();
                break;
            case 'g':
                return $this->getG();
                break;
            case 'b':
                return $this->getB();
                break;
            case 'hex':
                return $this->getHex();
                break;
            default:
                throw new Exception("Error: You can only use 'r', 'g', 'b' or 'hex'.");
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
            case 'r':
                $this->setR($value);
                break;
            case 'g':
                $this->setG($value);
                break;
            case 'b':
                $this->setB($value);
                break;
            case 'hex':
                $this->setHex($value);
                break;
            default:
                throw new Exception("Error: You can only use 'r', 'g', 'b' or 'hex'.");
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