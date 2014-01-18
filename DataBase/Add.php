<?php

namespace DataBase;

class Add extends Dbase {

    private $_table;
    private $_numberOfRows;
    private $_fieldsArray;
    private $_db;
    private $_mysqli;

    public function __construct($db, $mysqli) {
        $this->_db = $db;
        $this->_mysqli = $mysqli;
        $this->_table = $_POST['table'];
        $this->_numberOfRows = $_POST['rows'];
    }

    public function addRows() {
        $query = "DESCRIBE  " . $this->_db . "." . $this->_table;
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result)) {
            $field = new Field();
            $field->set_name($row['Field']);
            $field->set_type($row['Type']);
            $field->set_isAutoIncrement($row['Extra']);
            $field->set_isPrimary($row['Key']);
            $this->_fieldsArray[] = $field;
        }

        foreach ($this->_fieldsArray as $key => $f) {
            echo $f->get_name();
            echo (count($this->_fieldsArray) != ($key + 1)) ? " | " : "\n";
        }

        for ($i = 0; $i < $this->_numberOfRows; $i++) {
            $this->insertRow();
        }
    }

    private function insertRow() {
        $query = "INSERT INTO " . $this->_db .".". $this->_table . " (";
        $values = "VALUES ( ";
        $display = "";
        foreach ($this->_fieldsArray as $key => $f) {
            if (!$f->get_isPrimary()) {
                $query .= '`'.$f->get_name(). '`';
                $value = $this->createValue($f->get_type());
                $values .= "'". $value. "'";
                $display .= $value;
                if (count($this->_fieldsArray) != ($key + 1)) {
                    $query .= ",";
                    $values .= ",";
                    $display.= " | ";
                }
            }else{
                $display .= " auto ";
            }
        }
        
        
        $query .= ")";
        $values .= ")";
        $query = $query . $values;
        echo $display . "\n";
        $result = mysqli_query($this->_mysqli, $query);
    }

    private function createValue($type) {
        if ($type == "text") {
            return $this->getRandomString(10);
        } else {
            return rand(100, 99999);
        }
    }

    private function getRandomString($length = 12) {
        $quan = substr(str_shuffle(str_repeat("456789", 15)), 0, 1);
        $s = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 15)), 0, $quan);
        $string = (strlen($s) > $length) ? substr($s, 0, $length) : $s;
        return strtolower($string);
    }

}
