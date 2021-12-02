<?php

declare(strict_types=1);

namespace App\Games;

class Calc
{
    private const DESCRIPTION = 'What is the result of the expression?';
    private const OPERATORS = ['+', '-', '*'];
    private const RANGE_MIN = 1;
    private const RANGE_MAX = 15;
    private EngineInterface $engine;

    public function __construct(EngineInterface $engine)
    {
        $this->engine = $engine;
    }

    public function getExpressionResult(int $operand1, int $operand2, string $operator): int
    {
        return match ($operator) {
            '+' =>  $operand1 + $operand2,
            '-' =>  $operand1 - $operand2,
            '*' =>  $operand1 * $operand2,
            default => throw new \Error("Unknown operator '$operator'"),
        };
    }

    private function getGameData(): array
    {
        $operand1 = random_int(self::RANGE_MIN, self::RANGE_MAX);
        $operand2 = random_int(self::RANGE_MIN, self::RANGE_MAX);
        $operator = self::OPERATORS[array_rand(self::OPERATORS)];
        $mathExpression = "$operand1 $operator $operand2";
        $expressionResult = $this->getExpressionResult($operand1, $operand2, $operator);
        return [$mathExpression, (string) $expressionResult];
    }

    public function execute(): void
    {
        $this->engine->run(self::DESCRIPTION, fn() => $this->getGameData());
    }
}
