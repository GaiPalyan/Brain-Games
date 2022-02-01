<?php

namespace App\Games;

class Prime extends Game
{
    private const DESCRIPTION = "Answer 'yes' if given number is prime. Otherwise answer 'no'.";
    private int $divisor = 2;

    public function isPrime(int $num, int $divisor): bool
    {
        if ($num <= 2) {
            return $num === 2;
        }
        if ($num % $divisor === 0) {
            return false;
        }
        if ($divisor <= $num / 2) {
            return $this->isPrime($num, $divisor + 1);
        }
        return true;
    }

    protected function getGameData(): array
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
