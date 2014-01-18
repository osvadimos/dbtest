<?php

namespace DataBase;

class Dbase {

    private $_db;
    private $_user;
    private $_host;
    private $_password;
    private $_addObject;
    private $_checkObject;
    private $_mysqli;

    public function __construct() {
        $this->_db = $_POST['db'];
        $this->_user = $_POST['user'];
        $this->_host = $_POST['host'];
        $this->_password = $_POST['pass'];
    }

    public function get_db() {
        return $this->_db;
    }

    public function get_user() {
        return $this->_user;
    }

    public function get_host() {
        return $this->_host;
    }

    public function get_password() {
        return $this->_password;
    }

    public function set_db($_db) {
        $this->_db = $_db;
    }

    public function set_user($_user) {
        $this->_user = $_user;
    }

    public function set_host($_host) {
        $this->_host = $_host;
    }

    public function set_password($_password) {
        $this->_password = $_password;
    }
    
    public function get_addObject() {
        return ($this->_addObject == null) ? new Add($this->_db, $this->_mysqli) : $this->_addObject;
    }

    public function get_checkObject() {
        return ($this->_checkObject == null) ? new Check($this->_db) : $this->_checkObject;
    }

    public function set_addObject() {
        $this->_addObject = new Add($this->_db, $this->_mysqli);
    }

    public function set_checkObject() {
        $this->_checkObject = new Check($this->_db);
    }

    public function get_mysqli() {
        return $this->_mysqli;
    }

   

        
    public function connectToDb() {
        // Create connection
        $this->_mysqli = mysqli_connect($this->_host, $this->_user, $this->_password, $this->_db);
        if ($this->_mysqli->connect_error) {
            
        }
    }

}
