<?php

namespace Otis22\BeerMeetup\unit;

use Otis22\BeerMeetup\Math;
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    public function testFactorialZero(): void
    {
        $this->assertEquals(Math::factorial(0), 1);
    }

    public function testFactorialFirst(): void
    {
        $this->assertEquals(Math::factorial(1), 1);
    }

    public function testFactorialFifth(): void
    {
        $this->assertEquals(Math::factorial(5), 120);
    }

    public function testTrueIsTrue(): void
    {
        $this->assertTrue(true);
    }
}
