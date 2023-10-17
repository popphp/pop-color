<?php

namespace Pop\Color\Test;

use Pop\Color\Color;
use PHPUnit\Framework\TestCase;

class ColorTest extends TestCase
{

    public function testCreateRgb()
    {
        $rgb = Color::rgb(255, 255, 255, 0.5);
        $this->assertInstanceOf('Pop\Color\Color\Rgb', $rgb);
    }

    public function testCreateHsl()
    {
        $hsl = Color::hsl(240, 100, 100, 0.5);
        $this->assertInstanceOf('Pop\Color\Color\Hsl', $hsl);
    }

    public function testCreateHex()
    {
        $hex = Color::hex('#fff');
        $this->assertInstanceOf('Pop\Color\Color\Hex', $hex);
    }

    public function testCreateCmyk()
    {
        $cmyk = Color::cmyk(65, 20, 30, 50);
        $this->assertInstanceOf('Pop\Color\Color\Cmyk', $cmyk);
    }

    public function testCreateGrayscale()
    {
        $grayscale = Color::grayscale(50);
        $this->assertInstanceOf('Pop\Color\Color\Grayscale', $grayscale);
    }

    public function testParseRgb()
    {
        $rgb = Color::parse('rgba(255, 255, 255, 0.5)');
        $this->assertInstanceOf('Pop\Color\Color\Rgb', $rgb);
    }

    public function testParseHsl()
    {
        $hsl = Color::parse('hsla(240, 100%, 100%, 0.5)');
        $this->assertInstanceOf('Pop\Color\Color\Hsl', $hsl);
    }

    public function testParseHex()
    {
        $hex = Color::parse('#fff');
        $this->assertInstanceOf('Pop\Color\Color\Hex', $hex);
    }

    public function testParseCmyk()
    {
        $cmyk = Color::parse('60 20 30 50');
        $this->assertInstanceOf('Pop\Color\Color\Cmyk', $cmyk);
    }

    public function testParseGray()
    {
        $gray = Color::parse('60');
        $this->assertInstanceOf('Pop\Color\Color\Grayscale', $gray);
    }

    public function testParseException1()
    {
        $this->expectException('Pop\Color\Color\Exception');
        $rgb = Color::parse('bad color');
    }

}