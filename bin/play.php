#!/usr/bin/env php
<?php

use App\GameController;

$autoloadPath1 = __DIR__ . '/../../../autoload.php';
$autoloadPath2 = __DIR__ . '/../vendor/autoload.php';

if (file_exists($autoloadPath1)) {
    include_once $autoloadPath1;
} else {
    include_once $autoloadPath2;
}



try {
    $game = GameController::make($argv);
    $game->play();
} catch (\Exception $e) {
    echo $e->getMessage();
}
