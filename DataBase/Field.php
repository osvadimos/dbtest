<?php

namespace DataBase;

class Field extends Dbase {
    
    private $_type;
    private $_isNull;
    private $_isAutoIncrement;
    private $_name;
    private $_length;
    private $_isPrimary;



    public function __construct() {
        
    }
    
    public function get_type() {
        return $this->_type;
    }

    public function get_isNull() {
        return $this->_isNull;
    }

    public function get_isAutoIncrement() {
        return $this->_isAutoIncrement;
    }

    public function get_name() {
        return $this->_name;
    }

    public function get_length() {
        return $this->_length;
    }

    public function set_type($_type) {
        $this->_type = $_type;
    }

    public function set_isNull($_isNull) {
        $this->_isNull = $_isNull;
    }

    public function set_isAutoIncrement($_isAutoIncrement) {
        $this->_isAutoIncrement = $_isAutoIncrement;
    }

    public function set_name($_name) {
        $this->_name = $_name;
    }

    public function set_length($_length) {
        $this->_length = $_length;
    }

    public function get_isPrimary() {
        return ($this->_isPrimary == 'PRI');
    }

    public function set_isPrimary($_isPrimary) {
        $this->_isPrimary = $_isPrimary;
    }



    
    
    
}