<?php namespace App;

class Book implements BookInterface {

    public function open() {
        var_dump("Open the paper book page.");
    }

    public function turnPage() {
        var_dump("Turn on the paper book page.");
    }
}
