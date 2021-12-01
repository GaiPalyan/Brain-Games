<?php

declare(strict_types=1);

namespace App;

use function cli\line;

class GameController
{
    private string $gameRequest;
    private string $doc;


    public function __construct(string $gameRequest)
    {
        $this->gameRequest = strtolower($gameRequest);
        $this->doc = <<<DOC
        1) make game=Even
        2) make game=Calc
        3) make game=Gcd
        4) make game=Prime
        5) make game=Progression
        DOC;
    }

    public function factory(Engine $engine)
    {
        $game = implode("\\", [__NAMESPACE__, 'Games', ucfirst($this->gameRequest)]);
        if (!class_exists($game)) {
            throw new \Exception('That game is not exist =( try some command from this list');
        }
        return new $game($engine);
    }

    public function play(): void
    {
        try {
            $this->factory(new Engine())->execute();
        } catch (\Exception $exception) {
            line($exception->getMessage());
            line($this->doc);
        }
    }
}
