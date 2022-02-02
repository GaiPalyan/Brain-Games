<?php

declare(strict_types=1);

namespace App;

use Exception;

use function cli\prompt;

class GameController
{
    private string $command;
    private Engine $engine;
    private const MENU = [
        'even' => 'Even',
        'calc' => 'Calc',
        'gcd' => 'Gcd',
        'prime' => 'Prime',
        'progression' => 'Progression'
    ];
    private const DOCK = PHP_EOL . <<<DOC
        1) Even
        2) Calc
        3) Gcd
        4) Prime
        5) Progression
        DOC . PHP_EOL;

    private function __construct(string $command, Engine $engine)
    {
        $this->command = $command;
        $this->engine = $engine;
    }

    private function getGame()
    {
        $game = implode("\\", [__NAMESPACE__, 'Games', $this->command]);
        return new $game($this->engine);
    }

    /**
     * @throws Exception
     */
    public function play(): void
    {
        $this->getGame()->execute();
    }

    public static function make(array $argv): GameController
    {
        $command = isset($argv[1])
            ? strtolower($argv[1])
            : strtolower(prompt('You do not select any game, please choose and type title from this list'
                                            . PHP_EOL
                                            . self::DOCK . PHP_EOL));

        if (!array_key_exists($command, self::MENU)) {
            throw new Exception('Selected game dose not exist =( try some from this list: ' . self::DOCK);
        }

        return new self(self::MENU[strtolower($command)], new Engine());
    }
}
