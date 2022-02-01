<?php

declare(strict_types=1);

namespace App\Games;

class Progression extends Game
{
    private const DESCRIPTION = "What number is missing in the progression?";
    private const ELEMENT_HIDER = "..";
    private const LENGTH_MIN = 10;
    private const LENGTH_MAX = 15;
    private const STEP_MIN = 3;
    private const STEP_MAX = 10;

    public function buildProgression(int $firstNum, int $length, int $step): array
    {
        $progression = [];
        for ($n = 0; $n < $length; $n++) {
            $progression[] = $firstNum + $n * $step;
        }
        return $progression;
    }

    private function hideElement(array $progression): array
    {
        $randomPosition = array_rand($progression);
        $progression[$randomPosition] = self::ELEMENT_HIDER;
        $hiddenProgression = implode(' ', $progression);
        return [$hiddenProgression, $randomPosition];
    }

    protected function getGameData(): array
    {
        $startRange = random_int(self::RANGE_MIN, self::RANGE_MAX);
        $length = random_int(self::LENGTH_MIN, self::LENGTH_MAX);
        $step = random_int(self::STEP_MIN, self::STEP_MAX);
        $progression = $this->buildProgression($startRange, $length, $step);

        [$hiddenProgression, $randomPosition] = $this->hideElement($progression);
        $correctAnswer = (string) $progression[$randomPosition];

        return [$hiddenProgression, $correctAnswer];
    }

    public function execute(): void
    {
        $this->engine->run(self::DESCRIPTION, fn() => $this->getGameData());
    }
}
