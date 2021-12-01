<?php

declare(strict_types=1);

namespace App\Games;

interface EngineInterface
{
    public function run(string $description, $gameData);
}
