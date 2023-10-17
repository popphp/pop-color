<?php

namespace Pop\Color\Test\ColorTest;

use Pop\Color\Color;
use PHPUnit\Framework\TestCase;

class GrayTest extends TestCase
{

    public function testGray()
    {
        $gray = new Color\Gray(50);
        $gray->gray = 50;
        $this->assertTrue(isset($gray->gray));
        $this->assertEquals(50, $gray['gray']);
        $this->assertEquals(50, $gray->gray);
        $this->assertEquals('0.5', (string)$gray);
        $this->assertEquals(1, count($gray->toArray(false)));
        $this->assertEquals(1, count($gray->toArray(true)));
    }

    public function testRgbSetException()
    {
        $this->expectException('Pop\Color\Color\Exception');
        $gray = new Color\Gray(50);
        $gray->q = 50;
    }

    public function testRgbGetException()
    {
        $this->expectException('Pop\Color\Color\Exception');
        $gray = new Color\Gray(50);
        $var = $gray->q;
    }

    public function testRgbUnsetException()
    {
        $this->expectException('Pop\Color\Color\Exception');
        $gray = new Color\Gray(50);
        unset($gray->gray);
    }

    public function testRgbOffsetUnsetException()
    {
        $this->expectException('Pop\Color\Color\Exception');
        $gray = new Color\Gray(50);
        unset($gray['gray']);
    }

    public function testRgbSetGrayException()
    {
        $this->expectException('OutOfRangeException');
        $gray = new Color\Gray(200);
    }

    public function testGrayToCmyk()
    {
        $gray = new Color\Gray(50);
        $this->assertEquals('50', $gray->toCmyk()->getK());
    }

    public function testGrayRender1()
    {
        $gray = new Color\Gray(50);
        $this->assertEquals('rgb(50, 50, 50)', $gray->render(Color\Rgb::CSS));
    }

    public function testGrayRender2()
    {
        $gray = new Color\Gray(50);
        $this->assertEquals('50', $gray->render());
    }

}