pop-color
=========
Pop Color Component

[![Build Status](https://github.com/popphp/pop-color/workflows/phpunit/badge.svg)](https://github.com/popphp/pop-color/actions)
[![Coverage Status](http://cc.popphp.org/coverage.php?comp=pop-color)](http://cc.popphp.org/pop-color/)

OVERVIEW
--------
Pop Color is a helpful component to manage different types of color values and conversions.
Supported color formats include:

- RGB
- HEX
- HSL
- CMYK
- Grayscale

NSTALL
-------

Install `pop-color` using Composer.

    composer require popphp/pop-color

Or, require it in your composer.json file

    "require": {
        "popphp/pop-color" : "^1.0.0"
    }


BASIC USAGE
-----------

**Create a Color Object**

```php
$rgb = Color::rgb(120, 60, 30, 0.5);
echo $rgb . PHP_EOL;
```

The above command will print the default CSS format:

```text
rgba(120, 60, 30, 0.5)
```

Convert to another color format:

```php
$hex = $rgb->toHex();
echo $hex . PHP_EOL;
```

```text
#783c1e
```

```php
$hsl = $hex->toHsl();
echo $hsl . PHP_EOL;
```

```text
hsl(20, 75%, 47%)
```

```php
$cmyk = $rgb->toCmyk();
echo $cmyk . PHP_EOL; // Will print a string of space-separated percentages, common to a PDF color format
```

```text
0 0.5 0.75 0.53
```

**Accessing Color Properties**

```php
$rgb = Color::rgb(120, 60, 30, 0.5);
echo $rgb->getR() . PHP_EOL;
echo $rgb->getG() . PHP_EOL;
echo $rgb->getB() . PHP_EOL;
echo $rgb->getA() . PHP_EOL;
```

```text
120
60
30
0.5
```

```php
$cmyk = Color::cmyk(60, 30, 20, 50);
echo $cmyk->getC() . PHP_EOL;
echo $cmyk->getM() . PHP_EOL;
echo $cmyk->getY() . PHP_EOL;
echo $cmyk->getK() . PHP_EOL;
```

```text
60
30
20
50
```

**Parse Color Strings**

```php
$rgb = Color::parse('rgba(120, 60, 30, 0.5)');
echo $rgb->getR() . PHP_EOL;
echo $rgb->getG() . PHP_EOL;
echo $rgb->getB() . PHP_EOL;
echo $rgb->getA() . PHP_EOL;
echo $rgb . PHP_EOL;
```

```text
120
60
30
0.5
rgba(120, 60, 30, 0.5)
```
 