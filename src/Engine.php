<?php

declare(strict_types=1);

namespace App;

use App\Games\EngineInterface;

use function cli\line;
use function cli\prompt;

class Engine implements EngineInterface
{
    private const ROUNDS_COUNT = 3;

    public function run(string $description, $gameData)
    {
        line("Welcome to the Brain Games!");
        $userName = prompt("May I have your name?");
        line("Hello, $userName");
        line($description);
        for ($i = 0; $i < self::ROUNDS_COUNT; $i++) {
            [$gameQuestion, $correctAnswer] = $gameData();
            line("Question: $gameQuestion");
            $userAnswer = strtolower(prompt("Your answer"));
            if (strtolower($userAnswer) === $correctAnswer) {
                line("Correct!");
            } else {
                line("'$userAnswer' is wrong answer ;(. Correct answer was '$correctAnswer'");
                line("Let's try again, $userName!");
                return;
            }
        }
        line("Congratulations, $userName!");
    }
}
