<?php

abstract class Game
{
    abstract protected function initialize();
    abstract protected function startPlay();
    abstract protected function endPlay();

    public final function play()
    {
        $this->initialize();
        $this->startPlay();
        $this->endPlay();
    }
}

class Mario extends Game
{
    protected function initialize()
    {
        var_dump("Mario Game Initialized! Start playing.");
    }

    protected function startPlay()
    {
        var_dump("Mario Game Started. Enjoy the game!");
    }

    protected function endPlay()
    {
        var_dump("Mario Game Finished!");
    }

}

class Tankfight extends Game
{
    protected function initialize()
    {
        var_dump("Tankfight Game Initialized! Start playing.");
    }

    protected function startPlay()
    {
        var_dump("Tankfight Game Started. Enjoy the game!");
    }

    protected function endPlay()
    {
        var_dump("Tankfight Game Finished!");
    }

}

$game = new Tankfight();
$game->play();

$game = new Mario();
$game->play();
