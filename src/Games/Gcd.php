<?php

declare(strict_types=1);

namespace App\Games;

class Gcd
{
    private const DESCRIPTION = "Find the greatest common divisor of given numbers.";
    private const RANGE_MIN = 1;
    private const RANGE_MAX = 50;
    private EngineInterface $engine;

    public function __construct(EngineInterface $engine)
    {
        $this->engine = $engine;
    }

    public function getGCD(int $num1, int $num2): int
    {
        return $num2 ? $this->getGCD($num2, $num1 % $num2) : $num1;
    }

    private function getGameData(): array
    {
        $num1 = random_int(self::RANGE_MIN, self::RANGE_MAX);
        $num2 = random_int(self::RANGE_MIN, self::RANGE_MAX);
        $correctAnswer = $this->getGCD($num1, $num2);
        return ["$num1 $num2", (string) $correctAnswer];
    }

    public function execute(): void
    {
        $this->engine->run(self::DESCRIPTION, fn() => $this->getGameData());
    }
}
