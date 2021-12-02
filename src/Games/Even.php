<?php

declare(strict_types=1);

namespace App\Games;

class Even
{
    private const DESCRIPTION = "Answer 'yes' if the number is even, otherwise answer 'no'.";
    private const RANGE_MIN = 1;
    private const RANGE_MAX = 50;
    public EngineInterface $engine;

    public function __construct(EngineInterface $engine)
    {
        $this->engine = $engine;
    }

    public function isEven(int $number): bool
    {
        return $number % 2 === 0;
    }

    private function getGameData(): array
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
