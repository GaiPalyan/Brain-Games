<?php

declare(strict_types=1);

namespace App\Games;

class Even extends Game
{
    private const DESCRIPTION = "Answer 'yes' if the number is even, otherwise answer 'no'.";

    private function isEven(int $number): bool
    {
        return $number % 2 === 0;
    }

    protected function getGameData(): array
    {
        $question = random_int(self::RANGE_MIN, self::RANGE_MAX);
        $answer = $this->isEven($question) ? "yes" : "no";
        return [$question, $answer];
    }

    public function execute(): void
    {
        $this->engine->run(self::DESCRIPTION, fn() => $this->getGameData());
    }
}
