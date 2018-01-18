<?php

final class DB {

    // DB keeps the instance himself to ensure there is only one
    private static $instance = null;

    // Login credentials:
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "examentraining";

    private $c;

    // Constructor is private to make sure no one can call it
    private function __construct() {
        $this->c = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
        $this->c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Call this function if you need the instance for some reason
    public static function getInstance() {
        // This is not the instance you are looking for
        if(self::$instance == null){
            self::$instance = new DB();
        }
        return self::$instance;
    }

    // If you need to perform a custom select query
    public function select($query) {
        $result = $this->c->query($query);
        return $result;
    }

    // Prefered route
    // Call this function to prepare any query
    public static function prepare($query) {
        return self::getInstance()->c->prepare($query);
    }

    // Retrieve the last inserted ID of an object
    // You probably don't need this
    public static function lastId() {
        return self::getInstance()->c->lastInsertId();
    }

    // Fetch object by value.
    // Try not to use this. Instead use <Classname>::findBy()
    public static function getBy($class, $field, $value) {
        $c = self::getInstance()->c;

        $qry = "SELECT * FROM `" . strtolower($class) . "` WHERE ($field = :$field)";

        $stmt = $c->prepare($qry);
        $stmt->execute(array("$field" => $value));

        $result = $stmt->fetchAll(PDO::FETCH_CLASS, $class);
        return $result;
    }
}