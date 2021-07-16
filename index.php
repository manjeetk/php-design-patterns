<?php

use App\Book;
use App\BookInterface;
use App\Kindle;


class Person {

    public function read(BookInterface $book) {
        $book->read();
        $book->turnPage();
    } 
}

(new Person)->read(new Book());
(new Person)->read(new kindleAdapter(new Kindle));
