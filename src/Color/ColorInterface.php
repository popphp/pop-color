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
 * Image color interface
 *
 * @category   Pop
 * @package    Pop\Image
 * @author     Nick Sagona, III <dev@noladev.com>
 * @copyright  Copyright (c) 2009-2023 NOLA Interactive, LLC.
 * @license    https://www.popphp.org/license     New BSD License
 * @version    1.0.3
 */
interface ColorInterface
{

    /**
     * Convert to readable string
     *
     * @param  ?string $format
     * @return string
     */
    public function render(?string $format = null): string;

    /**
     * Method to print the color object
     *
     * @return string
     */
    public function __toString();

}
