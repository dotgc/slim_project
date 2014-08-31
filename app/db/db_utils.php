<?php

class DB_Utils {

    private $db;
    private $con;

    function __construct($dbconn_instance) {
        $this->db = $dbconn_instance;
        $this->con = $this->db->connect();
    }

    function __destruct() {}

    public function exec_read_query($query, $vals) {
        foreach ($vals as $val) {
            $val = mysqli_real_escape_string($this->con, $val);
        }
        $prepared_query = vsprintf($query, $vals);
        $resource_id = mysqli_query($this->con, $prepared_query);
        $result = Array();
        if ($resource_id) {
            while ($row = mysqli_fetch_array($resource_id, MYSQL_ASSOC)) {
                $result[] = $row;
            }
        }
        return $result;
    }

    public function exec_write_query($query, $vals) {
        foreach ($vals as $val) {
            $val = mysqli_real_escape_string($this->con, $val);
        }
        $prepared_query = vsprintf($query, $vals);
        $success = mysqli_query($this->con, $prepared_query);
        return $success;
    }

    public function read_one($query, $vals) {
        $rows = $this->exec_read_query($query, $vals);
        if (count($rows) == 1) {
            return $rows[0];
        }
    }

    public function get_single_value($query, $vals) {
        $row = $this->read_one($query, $vals);
        $single_value = null;
        foreach ($row as $key => $value) {
            $single_value = $value;
        }
        return $single_value;
    }

    public function update_table_entry($table_name, $key_name, $key_val, $vals) {
        $query = sprintf("UPDATE %s ", $table_name);
        $updates = "SET ";
        foreach ($vals as $key => $val) {
            $updates += "%s='%s' ";
        }
        $updates += sprintf("WHERE %s = '%s' ", $key_name, $key_val);
        $res = $this->exec_write_query($updates, $vals);
        return $res;
    }

    public function delete_rows($query, $vals) {
        $res = $this->exec_write_query($query, $vals);
        return $res;
    }
}
