<?php

namespace Pop\Color\Test\ColorTest;

use Pop\Color\Color;
use PHPUnit\Framework\TestCase;

class HslTest extends TestCase
{

    public function testHsl()
    {
        $hsl = new Color\Hsl(260, 100, 100, 1);
        $hsl->h = 240;
        $hsl->s = 60;
        $hsl->l = 40;
        $hsl->a = 0.5;
        $this->assertTrue(isset($hsl->h));
        $this->assertEquals(240, $hsl['h']);
        $this->assertEquals(60, $hsl['s']);
        $this->assertEquals(40, $hsl['l']);
        $this->assertEquals(0.5, $hsl['a']);
        $this->assertEquals(240, $hsl->h);
        $this->assertEquals(60, $hsl->s);
        $this->assertEquals(40, $hsl->l);
        $this->assertEquals(0.5, $hsl->a);
        $this->assertEquals('hsla(240, 60%, 40%, 0.5)', (string)$hsl);
        $this->assertTrue($hsl->hasA());
        $this->assertTrue($hsl->hasAlpha());
        $this->assertEquals(4, count($hsl->toArray(false)));
    }

    public function testRgbSetException()
    {
        $this->expectException('Pop\Color\Color\Exception');
        $hsl = new Color\Hsl(260, 100, 100, 1);
        $hsl->q = 255;
    }

    public function testRgbGetException()
    {
        $this->expectException('Pop\Color\Color\Exception');
        $hsl = new Color\Hsl(260, 100, 100, 1);
        $var = $hsl->q;
    }

    public function testRgbUnsetException()
    {
        $this->expectException('Pop\Color\Color\Exception');
        $hsl = new Color\Hsl(260, 100, 100, 1);
        unset($hsl->h);
    }

    public function testRgbOffsetUnsetException()
    {
        $this->expectException('Pop\Color\Color\Exception');
        $hsl = new Color\Hsl(260, 100, 100, 1);
        unset($hsl['h']);
    }

    public function testRgbSetRException()
    {
        $this->expectException('OutOfRangeException');
        $hsl = new Color\Hsl(460, 100, 100, 1);
    }

    public function testRgbSetGException()
    {
        $this->expectException('OutOfRangeException');
        $hsl = new Color\Hsl(260, 150, 100, 1);
    }

    public function testRgbSetBException()
    {
        $this->expectException('OutOfRangeException');
        $hsl = new Color\Hsl(260, 100, 150, 1);
    }

    public function testRgbSetAException()
    {
        $this->expectException('OutOfRangeException');
        $hsl = new Color\Hsl(260, 100, 100, 2);
    }

    public function testHslToRgb1()
    {
        $hsl = new Color\Hsl(40, 75, 94, 0.5);
        $rgb = $hsl->toRgb();
        $this->assertEquals(240, $rgb['r']);
        $this->assertEquals(180, $rgb['g']);
        $this->assertEquals(60, $rgb['b']);
        $this->assertEquals(0.5, $rgb['a']);
        $this->assertEquals(240, $rgb->r);
        $this->assertEquals(180, $rgb->g);
        $this->assertEquals(60, $rgb->b);
        $this->assertEquals(0.5, $rgb->a);
        $this->assertEquals('rgba(240, 180, 60, 0.5)', (string)$rgb);
    }

    public function testHslToRgb2()
    {
        $hsl = new Color\Hsl(40, 0, 94, 0.5);
        $rgb = $hsl->toRgb();
        $this->assertEquals(240, $rgb['r']);
        $this->assertEquals(240, $rgb['g']);
        $this->assertEquals(240, $rgb['b']);
        $this->assertEquals(0.5, $rgb['a']);
        $this->assertEquals(240, $rgb->r);
        $this->assertEquals(240, $rgb->g);
        $this->assertEquals(240, $rgb->b);
        $this->assertEquals(0.5, $rgb->a);
        $this->assertEquals('rgba(240, 240, 240, 0.5)', (string)$rgb);
    }

    public function testHslToRgb3()
    {
        $hsl = new Color\Hsl(360, 24, 94, 0.5);
        $rgb = $hsl->toRgb();
        $this->assertEquals(240, $rgb['r']);
        $this->assertEquals(182, $rgb['g']);
        $this->assertEquals(182, $rgb['b']);
        $this->assertEquals(0.5, $rgb['a']);
        $this->assertEquals(240, $rgb->r);
        $this->assertEquals(182, $rgb->g);
        $this->assertEquals(182, $rgb->b);
        $this->assertEquals(0.5, $rgb->a);
        $this->assertEquals('rgba(240, 182, 182, 0.5)', (string)$rgb);
    }

    public function testHslToRgb4()
    {
        $hsl = new Color\Hsl(270, 24, 94, 0.5);
        $rgb = $hsl->toRgb();
        $this->assertEquals(211, $rgb['r']);
        $this->assertEquals(182, $rgb['g']);
        $this->assertEquals(240, $rgb['b']);
        $this->assertEquals(0.5, $rgb['a']);
        $this->assertEquals(211, $rgb->r);
        $this->assertEquals(182, $rgb->g);
        $this->assertEquals(240, $rgb->b);
        $this->assertEquals(0.5, $rgb->a);
        $this->assertEquals('rgba(211, 182, 240, 0.5)', (string)$rgb);
    }

    public function testHslToRgb5()
    {
        $hsl = new Color\Hsl(180, 24, 94, 0.5);
        $rgb = $hsl->toRgb();
        $this->assertEquals(182, $rgb['r']);
        $this->assertEquals(240, $rgb['g']);
        $this->assertEquals(182, $rgb['b']);
        $this->assertEquals(0.5, $rgb['a']);
        $this->assertEquals(182, $rgb->r);
        $this->assertEquals(240, $rgb->g);
        $this->assertEquals(182, $rgb->b);
        $this->assertEquals(0.5, $rgb->a);
        $this->assertEquals('rgba(182, 240, 182, 0.5)', (string)$rgb);
    }

    public function testHslToRgb6()
    {
        $hsl = new Color\Hsl(130, 24, 94, 0.5);
        $rgb = $hsl->toRgb();
        $this->assertEquals(182, $rgb['r']);
        $this->assertEquals(240, $rgb['g']);
        $this->assertEquals(192, $rgb['b']);
        $this->assertEquals(0.5, $rgb['a']);
        $this->assertEquals(182, $rgb->r);
        $this->assertEquals(240, $rgb->g);
        $this->assertEquals(192, $rgb->b);
        $this->assertEquals(0.5, $rgb->a);
        $this->assertEquals('rgba(182, 240, 192, 0.5)', (string)$rgb);
    }

    public function testHslToRgb7()
    {
        $hsl = new Color\Hsl(90, 24, 94, 0.5);
        $rgb = $hsl->toRgb();
        $this->assertEquals(211, $rgb['r']);
        $this->assertEquals(240, $rgb['g']);
        $this->assertEquals(182, $rgb['b']);
        $this->assertEquals(0.5, $rgb['a']);
        $this->assertEquals(211, $rgb->r);
        $this->assertEquals(240, $rgb->g);
        $this->assertEquals(182, $rgb->b);
        $this->assertEquals(0.5, $rgb->a);
        $this->assertEquals('rgba(211, 240, 182, 0.5)', (string)$rgb);
    }

    public function testHslToRgb8()
    {
        $hsl = new Color\Hsl(320, 24, 94, 0.5);
        $rgb = $hsl->toRgb();
        $this->assertEquals(240, $rgb['r']);
        $this->assertEquals(182, $rgb['g']);
        $this->assertEquals(221, $rgb['b']);
        $this->assertEquals(0.5, $rgb['a']);
        $this->assertEquals(240, $rgb->r);
        $this->assertEquals(182, $rgb->g);
        $this->assertEquals(221, $rgb->b);
        $this->assertEquals(0.5, $rgb->a);
        $this->assertEquals('rgba(240, 182, 221, 0.5)', (string)$rgb);
    }

    public function testHslToHex()
    {
        $hsl = new Color\Hsl(40, 75, 94, 0.5);
        $hex = $hsl->toHex();
        $this->assertEquals('f0b43c', $hex['hex']);
        $this->assertEquals('f0', $hex['r']);
        $this->assertEquals('b4', $hex['g']);
        $this->assertEquals('3c', $hex['b']);
        $this->assertEquals('f0b43c', $hex->hex);
        $this->assertEquals('f0', $hex->r);
        $this->assertEquals('b4', $hex->g);
        $this->assertEquals('3c', $hex->b);
    }

    public function testHslRender1()
    {
        $hsl = new Color\Hsl(40, 75, 94, 0.5);
        $this->assertEquals('40, 75, 94, 0.5', $hsl->render(Color\Hsl::COMMA));
    }

    public function testHslRender2()
    {
        $hsl = new Color\Hsl(40, 75, 94, 0.5);
        $this->assertEquals('0.94 0.71 0.24', $hsl->render(Color\Hsl::PERCENT));
    }

    public function testHslRender3()
    {
        $hsl = new Color\Hsl(40, 75, 94, 0.5);
        $this->assertEquals('40 75 94 0.5', $hsl->render());
    }

}