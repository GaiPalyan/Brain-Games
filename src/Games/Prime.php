<?php

namespace App\Games;

class Prime
{
    private const DESCRIPTION = "Answer 'yes' if given number is prime. Otherwise answer 'no'.";
    private const RANGE_MIN = 1;
    private const RANGE_MAX = 50;
    private int $divisor = 2;
    private EngineInterface $engine;

    public function __construct(EngineInterface $engine)
    {
        $this->engine = $engine;
    }

    public function isPrime(int $num, int $divisor): bool
    {
        if ($num < 2 || $num % $divisor === 0) {
            return false;
        }
        if ($divisor <= $num / 2) {
            return $this->isPrime($num, $divisor + 1);
        }
        return true;
    }

    private function getGameData(): array
    {
        $number = random_int(self::RANGE_MIN, self::RANGE_MAX);
        $correctAnswer = $this->isPrime($number, $this->divisor) ? "yes" : "no";
        return [$number, $correctAnswer];
    }

    public function execute(): void
    {
        $this->engine->run(self::DESCRIPTION, fn() => $this->getGameData());
    }
}
