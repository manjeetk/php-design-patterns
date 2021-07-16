<?php namespace App;

class Kindle implements eReaderInterface {

    public function turnOn() {
        var_dump("Turn on the kindle");
    }

    public function pressButton() {
        var_dump("press the next button");
    }
}