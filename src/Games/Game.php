<?php

namespace App\Games;

abstract class Game
{
    /**
     * Beginning and end of a range of random numbers
     */
    protected const RANGE_MIN = 1;
    protected const RANGE_MAX = 15;

    /**
     * @var EngineInterface
     */
    protected EngineInterface $engine;

    public function __construct(EngineInterface $engine)
    {
        $this->engine = $engine;
    }

    /**
     * Sending generated data to the engine
     * @return array
     */
    abstract protected function getGameData(): array;
}
