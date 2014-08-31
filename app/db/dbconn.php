<?php

require_once 'dbconfig.php';

class DB_Connect {
    function __construct() {}

    function __destruct() {}

    public function connect() {
        $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
        mysqli_select_db($con, DB_NAME);
        return $con;
    }

    public function close() {
        mysqli_close();
    }
}