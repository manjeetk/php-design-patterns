<?php

interface Logger {
    
    public function log($data);

}

class LogToFile implements Logger {

    public function log($data) {
        var_dump("Log the data to the File");
    }

}

class LogToDatabase implements Logger {
    
   public function log($data) {
        var_dump("Log the data to the DB");
    }
    
}

class LogToWebService implements Logger {

    public function log($data) {
        var_dump("Log the data to the Web Service");
    }
}

class App {

    public function log($data, Logger $logger) {         
        $logger = $logger ?: new LogToFile;
        $logger->log($data);
    }

}

$app = new App();
$app->log("Log", new LogToFile);
$app->log("Log", new LogToDatabase);
$app->log("Log", new LogToWebService);