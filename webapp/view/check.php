<?php
    require_once(dirname(__FILE__) . '/../load.php');
    session_start();
    $db = new DB();



    $id = $_GET["ID"];

    $db->entryExists($id);

   	

