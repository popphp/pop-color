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
 * Pop Color RGB color class
 *
 * @category   Pop
 * @package    Pop\Color
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2024 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 * @version    1.0.0
 */
class Rgb extends AbstractColor implements \ArrayAccess
{

    /**
     * R value
     * @var int
     */
    protected int $r = 0;

    /**
     * G value
     * @var int
     */
    protected int $g = 0;

    /**
     * B value
     * @var int
     */
    protected int $b = 0;

    /**
     * Alpha value
     * @var ?float
     */
    protected ?float $a = null;

    /**
     * Constructor
     *
     * Instantiate the CSS RGB color object
     *
     * @param int|string        $r
     * @param int|string        $g
     * @param int|string        $b
     * @param float|string|null $a
     */
    public function __construct(int|string $r, int|string $g, int|string $b, float|string|null $a = null)
    {
        $this->setR($r);
        $this->setG($g);
        $this->setB($b);
        if ($a !== null) {
            $this->setA($a);
        }
    }

    /**
     * Set R value
     *
     * @param  int|string $r
     * @throws OutOfRangeException
     * @return self
     */
    public function setR(int|string $r): self
    {
        $r = (int)$r;
        if (($r > 255) || ($r < 0)) {
            throw new OutOfRangeException('Error: The value of $r must be between 0 and 255.');
        }
        $this->r = $r;
        return $this;
    }

    /**
     * Set G value
     *
     * @param  int|string $g
     * @throws OutOfRangeException
     * @return self
     */
    public function setG(int|string $g): self
    {
        $g = (int)$g;
        if (($g > 255) || ($g < 0)) {
            throw new OutOfRangeException('Error: The value of $g must be between 0 and 255.');
        }
        $this->g = $g;
        return $this;
    }

    /**
     * Set B value
     *
     * @param  int|string $b
     * @throws OutOfRangeException
     * @return self
     */
    public function setB(int|string $b): self
    {
        $b = (int)$b;
        if (($b > 255) || ($b < 0)) {
            throw new OutOfRangeException('Error: The value of $b must be between 0 and 255.');
        }
        $this->b = $b;
        return $this;
    }

    /**
     * Set A value
     *
     * @param  float|string $a
     * @throws OutOfRangeException
     * @return self
     */
    public function setA(float|string $a): self
    {
        $a = (float)$a;
        if (($a > 1) || ($a < 0)) {
            throw new OutOfRangeException('Error: The value of $l must be between 0 and 1.');
        }
        $this->a = $a;
        return $this;
    }

    /**
     * Get R value
     *
     * @return int
     */
    public function getR(): int
    {
        return $this->r;
    }

    /**
     * Get G value
     *
     * @return int
     */
    public function getG(): int
    {
        return $this->g;
    }

    /**
     * Get B value
     *
     * @return int
     */
    public function getB(): int
    {
        return $this->b;
    }

    /**
     * Get A value
     *
     * @return float|null
     */
    public function getA(): float|null
    {
        return $this->a;
    }

    /**
     * Determine if the color object has an alpha value
     *
     * @return bool
     */
    public function hasA(): bool
    {
        return ($this->a !== null);
    }

    /**
     * Determine if the color object has an alpha value (alias)
     *
     * @return bool
     */
    public function hasAlpha(): bool
    {
        return ($this->a !== null);
    }

    /**
     * Convert to CMYK
     *
     * @return Cmyk
     */
    public function toCmyk(): Cmyk
    {
        $K = 1;

        // Calculate CMY.
        $cyan    = 1 - ($this->r / 255);
        $magenta = 1 - ($this->g / 255);
        $yellow  = 1 - ($this->b / 255);

        // Calculate K.
        if ($cyan < $K) {
            $K = $cyan;
        }
        if ($magenta < $K) {
            $K = $magenta;
        }
        if ($yellow < $K) {
            $K = $yellow;
        }

        if ($K == 1) {
            $cyan    = 0;
            $magenta = 0;
            $yellow  = 0;
        } else {
            $cyan    = round((($cyan - $K) / (1 - $K)) * 100);
            $magenta = round((($magenta - $K) / (1 - $K)) * 100);
            $yellow  = round((($yellow - $K) / (1 - $K)) * 100);
        }

        $black = round($K * 100);

        return new Cmyk($cyan, $magenta, $yellow, $black);
    }

    /**
     * Convert to Gray
     *
     * @return Grayscale
     */
    public function toGray(): Grayscale
    {
        return new Grayscale(floor(((floor(($this->r + $this->g + $this->b) / 3) / 255) * 100)));
    }

    /**
     * Convert to HSL
     *
     * @return Hsl
     */
    public function toHsl(): Hsl
    {
        $r = $this->getR();
        $g = $this->getG();
        $b = $this->getB();

        $min = min($r, min($g, $b));
        $max = max($r, max($g, $b));
        $delta = $max - $min;
        $h = 0;

        if ($delta > 0) {
            if ($max == $r && $max != $g) $h += ($g - $b) / $delta;
            if ($max == $g && $max != $b) $h += (2 + ($b - $r) / $delta);
            if ($max == $b && $max != $r) $h += (4 + ($r - $g) / $delta);
            $h /= 6;
        }

        // Calculate the saturation and brightness.
        $r = $this->getR() / 255;
        $g = $this->getG() / 255;
        $b = $this->getB() / 255;

        $max = max($r, $g, $b);
        $min = min($r, $g, $b);

        $l = $max;
        $d = $max - $min;
        $s = ($d == 0) ? 0 : $d / $max;

        return new Hsl(round($h * 360), round($s * 100), round($l * 100), $this->a);
    }

    /**
     * Convert to hex
     *
     * @return Hex
     */
    public function toHex(): Hex
    {
        $hex = str_pad(dechex($this->r), 2, '0', STR_PAD_LEFT) . str_pad(dechex($this->g), 2, '0', STR_PAD_LEFT) . str_pad(dechex($this->b), 2, '0', STR_PAD_LEFT);
        return new Hex($hex);
    }

    /**
     * Convert to array
     *
     * @param  bool $assoc
     * @return array
     */
    public function toArray(bool $assoc = true): array
    {
        $rgb = [];

        if ($assoc) {
            $rgb['r'] = $this->r;
            $rgb['g'] = $this->g;
            $rgb['b'] = $this->b;
            if ($this->a !== null) {
                $rgb['a'] = $this->a;
            }
        } else {
            $rgb[] = $this->r;
            $rgb[] = $this->g;
            $rgb[] = $this->b;
            if ($this->a !== null) {
                $rgb[] = $this->a;
            }
        }

        return $rgb;
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
            return $this->r . ', ' . $this->g . ', ' . $this->b . (!empty($this->a) ? ', ' . $this->a : '');
        } else if ($format == self::CSS) {
            return (($this->a !== null) ? 'rgba(' : 'rgb(') . implode(', ', $this->toArray()) . ')';
        } else if ($format == self::PERCENT) {
            return round(($this->r / 255), 2) . ' ' . round(($this->g / 255), 2) . ' ' . round(($this->b / 255), 2);
        } else {
            return $this->r . ' ' . $this->g . ' ' . $this->b . (!empty($this->a) ? ' ' . $this->a : '');
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
        return (($offset == 'r') || ($offset == 'g') || ($offset == 'b') || ($offset == 'a'));
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
            case 'a':
                return $this->getA();
                break;
            default:
                throw new Exception("Error: You can only use 'r', 'g', 'b' or 'a'.");
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
            case 'a':
                $this->setA($value);
                break;
            default:
                throw new Exception("Error: You can only use 'r', 'g', 'b' or 'a'.");
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