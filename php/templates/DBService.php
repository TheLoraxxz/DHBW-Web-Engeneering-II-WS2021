<?php

class DBService {
    private $host = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $conn = null;
    function __construct() {
        $this->conn = new mysqli($this->host,$this->username,$this->password);
        $res = $this->conn->multi_query("USE db_pain;");
        if (!$res) {
            $res = $this->conn->multi_query("
            CREATE DATABASE db_pain;
            CREATE TABLE institution(instution_id int,name varchar(255) null);
            CREATE unique index institution_instution_id_uindex
	            on institution (instution_id);
            alter table institution add constraint institution_pk
		        primary key (instution_id);
            alter table institution modify instution_id int auto_increment;
            

            ");
        }
        $this->conn->multi_query("
            USE db_pain;
        ");
    }

}