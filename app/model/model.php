<?php

require_once '../db/db_utils.php';

class DB_Model extends DB_Utils {
    /**
    This class is to be used to declare and define the model
    that the application will use. Use the API defined in DB_Utils.php
    to perform DB operations
    */
    public function getUserInfo($user_name) {
        $query = "SELECT * FROM users WHERE user_name = '%s'";
        $vals = Array();
        $vals[] = $user_name;
        $user_info = $this->read_one($query, $vals);
        return $user_info;
    }


}

