<?php

interface Subject {
    public function attach($observable);
    public function detach($index);
    public function notify();
}

interface Observer {
    public function handle();
}

class Login implements Subject {

    protected $observers = [];

    public function attach($observable) {
        if(is_array($observable)) {
            return $this->attachObservers($observable);
        }
        $this->observers[] = $observable;
        return $this;
    }

    public function detach($index) {
        unset($this->observer[$index]);
    }

    public function notify() {
        foreach($this->observers as $observer) {
            $observer->handle();
        }
    }

    private function attachObservers($observable) {
        foreach($observable as $observer) {
            if(!$observer instanceof Observer) {
                throw new Exception;
            }
            $this->attach($observer);
        }    
    }
    
    public function fire() {
        $this->notify();
    }
}


class LoginHandler implements Observer {

    public function handle() {
        var_dump('Logged in!!');
    }

}

class EmailHandler implements Observer {

    public function handle() {
        var_dump('Email sent!!');
    }
    
}

class RepoerHandler implements Observer {

    public function handle() {
        var_dump('Report generated!!');
    }
    
}

$login = new Login;
$login->attach([
    new LoginHandler,
    new EmailHandler,
    new RepoerHandler
]);

$login->fire();
