<?php

namespace DataBase;

class Check extends Dbase {

    private $_db;

    public function __construct($db) {
        $this->_db = $db;
    }

    public function checkTables() {
        $res = mysql_query("SHOW TABLES FROM " . $this->_db);
        while ($row = mysql_fetch_array($res, MYSQL_NUM)) {
            echo "table name : $row[0]\n";
            $query = "DESCRIBE  " . $this->_db . "." . $row[0];
            $result = mysql_query($query);
            while ($row = mysql_fetch_array($result)) {
                echo "{$row['Field']} | type  {$row['Type']} | Null {$row['Null']} | key {$row['Key']} |Extra {$row['Extra']}\n";
            }
        }
    }

}
