<?php

class Database {
    private $connection;
    function __construct(private string $hostname='localhost', private string $user='root', private string $password='', private string $database='phpcrud') {
        $this->hostname  = $hostname;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
        try {
            $this->connection = new mysqli($this->hostname, $this->user, $this->password, $this->database);

        }catch(Exception $exception) {
            die("Error connecting to database".$exception->getMessage());
        }
}

public function getconnection() { 
    return  $this->connection;
}
}
