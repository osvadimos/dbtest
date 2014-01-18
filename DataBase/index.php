<?php
include_once './Dbase.php';
include_once './Check.php';
include_once './Add.php';
include_once './Field.php';


function autoload(){
    $db = new \DataBase\Dbase;
    $db->connectToDb();
    switch ($_POST['command']){
        case 'check':
            $check = $db->get_checkObject();
            $check->checkTables();
            break;
        case 'connect':
            echo 'succeeded';
            break;
        case 'add':
            $add = $db->get_addObject();
            $add->addRows();
            break;
    }
}

autoload();

