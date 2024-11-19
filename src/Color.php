<?php
/**
 * Pop PHP Framework (https://www.popphp.org/)
 *
 * @link       https://github.com/popphp/popphp-framework
 * @author     Nick Sagona, III <dev@noladev.com>
 * @copyright  Copyright (c) 2009-2025 NOLA Interactive, LLC.
 * @license    https://www.popphp.org/license     New BSD License
 */

/**
 * @namespace
 */
namespace Pop\Color;

use ReflectionException;

/**
 * Pop color class
 *
 * @category   Pop
 * @package    Pop\Color
 * @author     Nick Sagona, III <dev@noladev.com>
 * @copyright  Copyright (c) 2009-2025 NOLA Interactive, LLC.
 * @license    https://www.popphp.org/license     New BSD License
 * @version    1.0.0
 */
class Color
{

    /**
     * Instantiate an RGB color object
     *
     * @param  int    $r
     * @param  int    $g
     * @param  int    $b
     * @param  ?float $a
     * @return Color\Rgb
     */
    public static function rgb(int $r, int $g, int $b, ?float $a = null): Color\Rgb
    {
        return new Color\Rgb($r, $g, $b, $a);
    }

    /**
     * Instantiate an HSL color object
     *
     * @param  int    $h
     * @param  int    $s
     * @param  int    $l
     * @param  ?float $a
     * @return Color\Hsl
     */
    public static function hsl(int $h, int $s, int $l, ?float $a = null): Color\Hsl
    {
        return new Color\Hsl($h, $s, $l, $a);
    }

    /**
     * Instantiate a Hex color object
     *
     * @param  string $hex
     * @return Color\Hex
     */
    public static function hex(string $hex): Color\Hex
    {
        return new Color\Hex($hex);
    }

    /**
     * Instantiate a CMYK color object
     *
     * @param  int $c
     * @param  int $m
     * @param  int $y
     * @param  int $k
     * @return Color\Cmyk
     */
    public static function cmyk(int $c, int $m, int $y, int $k): Color\Cmyk
    {
        return new Color\Cmyk($c, $m, $y, $k);
    }

    /**
     * Instantiate a grayscale color object
     *
     * @param  int $gray
     * @return Color\Grayscale
     */
    public static function grayscale(int $gray): Color\Grayscale
    {
        return new Color\Grayscale($gray);
    }

    /**
     * Parse color from string
     *
     * @param  string $colorString
     * @throws Color\Exception|ReflectionException
     * @return Color\ColorInterface
     */
    public static function parse(string $colorString): Color\ColorInterface
    {
        $colorString = strtolower($colorString);

        if (str_starts_with($colorString, 'rgb')) {
            $params = self::parseColorValues($colorString);
            return (new \ReflectionClass('Pop\Color\Color\Rgb'))->newInstanceArgs($params);
        } else if (str_starts_with($colorString, 'hsl')) {
            $params = self::parseColorValues($colorString);
            return (new \ReflectionClass('Pop\Color\Color\Hsl'))->newInstanceArgs($params);
        } else if (str_starts_with($colorString, '#')) {
            return new Color\Hex($colorString);
        } else if (substr_count($colorString, ' ') == 3) {
            $params = self::parseColorValues($colorString, false);
            return (new \ReflectionClass('Pop\Color\Color\Cmyk'))->newInstanceArgs($params);
        } else if (is_numeric($colorString)) {
            return new Color\Grayscale($colorString);
        }
        else {
            throw new Color\Exception('Error: The string was not in the correct color format.');
        }
    }

    /**
     * Parse color values from string
     *
     * @param  string $colorString
     * @param  bool   $comma
     * @return array
     */
    public static function parseColorValues(string $colorString, $comma = true): array
    {
        if ((str_contains($colorString, '(')) && (str_contains($colorString, ')'))) {
            $colorString = substr($colorString, (strpos($colorString, '(') + 1));
            $colorString = substr($colorString, 0, strpos($colorString, ')'));
        }

        $values = ($comma) ? explode(',' , $colorString) : explode(' ', $colorString);
        return array_map('trim', $values);
    }

}
