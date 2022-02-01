<?php

namespace Tests;

use App\Engine;
use App\Games\Calc;
use App\Games\Even;
use App\Games\Gcd;
use App\Games\Prime;
use App\Games\Progression;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use ReflectionMethod;

class GameTest extends TestCase
{
    protected Engine $engine;

    protected function setUp(): void
    {
        $this->engine = new Engine();
    }

    /**
     * @throws ReflectionException
     */
    protected static function getMethod(string $class, string $method): ReflectionMethod
    {
        $game = new \ReflectionClass($class);
        $method = $game->getMethod($method);
        $method->setAccessible(true);
        return $method;
    }

    /**
     * @dataProvider evenAndOddProvider
     */
    public function testEven($number, $expected): void
    {
        $game = new Even($this->engine);
        $actual = self::getMethod(Even::class, 'isEven')->invokeArgs($game, [$number]);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider calcProvider
     */
    public function testCalc($operand1, $operand2, $operator, $expected): void
    {
        $game = new Calc($this->engine);
        $actual = self::getMethod(Calc::class, 'getExpressionResult')
                      ->invokeArgs($game, [$operand1, $operand2, $operator]);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider gcdProvider
     */
    public function testGcd($number1, $number2, $expected): void
    {
        $game = new Gcd($this->engine);
        $actual = self::getMethod(Gcd::class, 'getGcd')->invokeArgs($game, [$number1, $number2]);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider primeProvider
     */
    public function testPrime($number, $expected): void
    {
        $divisor = 2;
        $game = new Prime($this->engine);
        $actual = self::getMethod(Prime::class, 'isPrime')->invokeArgs($game, [$number, $divisor]);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider progressionProvider
     */
    public function testProgression($fistNum, $length, $step, $expected): void
    {
        $game = new Progression($this->engine);
        $actual = self::getMethod(Progression::class, 'buildProgression')
                      ->invokeArgs($game, [$fistNum, $length, $step]);

        $this->assertEquals($expected, $actual, 'Boop');
    }

    public function evenAndOddProvider(): array
    {
        return [
            [1, false], [2, true],
            [3, false], [9, false],
            [15, false], [20, true],
        ];
    }

    public function calcProvider(): array
    {
        return [
            [2, 2, '+', 4],
            [3, 10, '*', 30],
            [5, 10, '-', -5],
        ];
    }

    public function primeProvider(): array
    {
        return [
            [1, false], [2, true],
            [3, true], [7, true],
            [8, false], [53, true],
            [51, false], [97, true],
        ];
    }

    public function gcdProvider(): array
    {
        return [
            [4, 44, 4], [22, 8, 2],
            [1, 17, 1], [18, 4, 2],
            [18, 8, 2], [54, 16, 2],
        ];
    }

    public function progressionProvider(): array
    {
        return [
            [
                4, 12, 4,
                [4, 8, 12, 16, 20, 24, 28, 32, 36, 40, 44, 48],
            ],
            [
                2, 8, 2,
                [2, 4, 6, 8, 10, 12, 14, 16]
            ]
        ];
    }
}
