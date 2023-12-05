<?php

namespace Otis22\BeerMeetup;

use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    public function testFactorialZero(): void
    {
        $this->assertEquals(
            Math::factorial(0),
            1
        );
    }

    public function testFactorialFirst(): void
    {
        $this->assertEquals(
            Math::factorial(1),
            1
        );
    }

    public function testFactorialFifth(): void
    {
        $this->assertEquals(
            Math::factorial(5),
            120
        );
    }
}
