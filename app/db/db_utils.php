<?php

class DB_Utils {

    private $db;
    private $con;

    function __construct($dbconn_instance) {
        $this->db = $dbconn_instance;
        $this->con = $this->db->connect();
    }

    function __destruct() {}

    public function do_read_query($query, $vals) {
        /**
        Returns an array of table rows; each table row is an
        associative array of column name => value pairs.
        */
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

    public function do_write_query($query, $vals) {
        /**
        Returns a boolean with true denoting success and false denoting error.
        */
        foreach ($vals as $val) {
            $val = mysqli_real_escape_string($this->con, $val);
        }
        $prepared_query = vsprintf($query, $vals);
        $success = mysqli_query($this->con, $prepared_query);
        return $success;
    }

    public function read_one($query, $vals) {
        /**
        Reads the whole row when queried against a table super key
        Returns the associative array of column_name => value pairs.
        Basically a thin wrapper on top of dp_read_query.
        */
        $rows = $this->do_read_query($query, $vals);
        if (count($rows) == 1) {
            return $rows[0];
        }
    }

    public function get_record_value($query, $vals) {
        /**
        Useful when the query is against a super key and only the value of one column is needed.
        Again only a thin wrapper on read_one_row
        */
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
        $res = $this->do_write_query($updates, $vals);
        return $res;
    }

    public function delete_rows($query, $vals) {
        $res = $this->do_write_query($query, $vals);
        return $res;
    }
}
