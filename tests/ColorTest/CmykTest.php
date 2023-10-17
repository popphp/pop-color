<?php

namespace Pop\Color\Test\ColorTest;

use Pop\Color\Color;
use PHPUnit\Framework\TestCase;

class CmykTest extends TestCase
{

    public function testCmyk()
    {
        $cmyk = new Color\Cmyk(65, 25, 35, 10);
        $cmyk->c = 65.0;
        $cmyk->m = 25.0;
        $cmyk->y = 35.0;
        $cmyk->k = 10.0;
        $this->assertTrue(isset($cmyk->c));
        $this->assertEquals(65.0, $cmyk['c']);
        $this->assertEquals(25.0, $cmyk['m']);
        $this->assertEquals(35.0, $cmyk['y']);
        $this->assertEquals(10.0, $cmyk['k']);
        $this->assertEquals(65.0, $cmyk->c);
        $this->assertEquals(25.0, $cmyk->m);
        $this->assertEquals(35.0, $cmyk->y);
        $this->assertEquals(10.0, $cmyk->k);
        $this->assertEquals('0.65 0.25 0.35 0.1', (string)$cmyk);
        $this->assertEquals(4, count($cmyk->toArray(false)));
    }

    public function testCmykSetException()
    {
        $this->expectException('Pop\Color\Color\Exception');
        $cmyk = new Color\Cmyk(65, 25, 35, 10);
        $cmyk->q = 255;
    }

    public function testCmykGetException()
    {
        $this->expectException('Pop\Color\Color\Exception');
        $cmyk = new Color\Cmyk(65, 25, 35, 10);
        $var = $cmyk->q;
    }

    public function testCmykUnsetException()
    {
        $this->expectException('Pop\Color\Color\Exception');
        $cmyk = new Color\Cmyk(65, 25, 35, 10);
        unset($cmyk->c);
    }

    public function testCmykOffsetUnsetException()
    {
        $this->expectException('Pop\Color\Color\Exception');
        $cmyk = new Color\Cmyk(65, 25, 35, 10);
        unset($cmyk['c']);
    }

    public function testCmykSetCException()
    {
        $this->expectException('OutOfRangeException');
        $cmyk = new Color\Cmyk(150, 25, 35, 10);
    }

    public function testCmykSetMException()
    {
        $this->expectException('OutOfRangeException');
        $cmyk = new Color\Cmyk(65, 150, 35, 10);
    }

    public function testCmykSetYException()
    {
        $this->expectException('OutOfRangeException');
        $cmyk = new Color\Cmyk(65, 25, 150, 10);
    }

    public function testCmykSetKException()
    {
        $this->expectException('OutOfRangeException');
        $cmyk = new Color\Cmyk(65, 25, 35, 150);
    }

    public function testCmykToArray()
    {
        $cmyk = new Color\Cmyk(65, 25, 35, 10);
        $cmykArray = $cmyk->toArray(true);
        $this->assertEquals(65.0, $cmykArray['c']);
        $this->assertEquals(25.0, $cmykArray['m']);
        $this->assertEquals(35.0, $cmykArray['y']);
        $this->assertEquals(10.0, $cmykArray['k']);
    }

    public function testCmykToRgb()
    {
        $cmyk = new Color\Cmyk(65, 25, 35, 10);
        $rgb = $cmyk->toRgb();
        $this->assertEquals(80, $rgb['r']);
        $this->assertEquals(172, $rgb['g']);
        $this->assertEquals(149, $rgb['b']);
        $this->assertEquals(80, $rgb->r);
        $this->assertEquals(172, $rgb->g);
        $this->assertEquals(149, $rgb->b);
        $this->assertEquals('rgb(80, 172, 149)', (string)$rgb);
    }

    public function testCmykToGray()
    {
        $cmyk = new Color\Cmyk(65, 25, 35, 10);
        $gray = $cmyk->toGray();
        $this->assertEquals(10.0, $gray['gray']);
        $this->assertEquals(10.0, $gray->gray);
        $this->assertEquals('0.1', (string)$gray);
    }

    public function testCmykRender1()
    {
        $cmyk = new Color\Cmyk(65, 25, 35, 10);
        $this->assertEquals('65, 25, 35, 10', $cmyk->render(Color\Cmyk::COMMA));
    }

    public function testCmykRender2()
    {
        $cmyk = new Color\Cmyk(65, 25, 35, 10);
        $this->assertEquals('rgb(80, 172, 149)', $cmyk->render(Color\Cmyk::CSS));
    }

    public function testCmykRender3()
    {
        $cmyk = new Color\Cmyk(65, 25, 35, 10);
        $this->assertEquals('65 25 35 10', $cmyk->render());
    }


}