<?php

class DBService {
    private $host = "127.0.0.1";
    private $username = "root";
    private $password = "";
    function __construct() {
        $conn = new mysqli($host,$username,$password);
    }

}