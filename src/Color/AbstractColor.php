<?php
/**
 * Pop PHP Framework (https://www.popphp.org/)
 *
 * @link       https://github.com/popphp/popphp-framework
 * @author     Nick Sagona, III <dev@noladev.com>
 * @copyright  Copyright (c) 2009-2023 NOLA Interactive, LLC.
 * @license    https://www.popphp.org/license     New BSD License
 */

/**
 * @namespace
 */
namespace Pop\Color\Color;

/**
 * Abstract image color class
 *
 * @category   Pop
 * @package    Pop\Image
 * @author     Nick Sagona, III <dev@noladev.com>
 * @copyright  Copyright (c) 2009-2023 NOLA Interactive, LLC.
 * @license    https://www.popphp.org/license     New BSD License
 * @version    1.0.2
 */
abstract class AbstractColor implements ColorInterface
{

    /**
     * String formats
     */
    const COMMA   = 'COMMA';
    const CSS     = 'CSS';
    const PERCENT = 'PERCENT';

    /**
     * Convert to readable string
     *
     * @param  ?string $format
     * @return string
     */
    abstract public function render(?string $format = null): string;

    /**
     * Method to print the color object
     *
     * @return string
     */
    abstract public function __toString();

}
