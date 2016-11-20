<?php
    require_once(dirname(__FILE__) . '/../load.php');
    session_start();
    $db = new DB();
/**
 * Created by IntelliJ IDEA.
 * User: Josh
 * Date: 10/6/2016
 * Time: 6:40 PM
 */

$db->submit();
    //check if any account information exists, if it does kick it back.
    //$db->getName("");

    //sanitize post and send it through
    /*if($db->submit($_POST)){
        header("Location:home.php");
    }
    else{
        //Kick back with updated webpage displaying detail problems
        header("Location:index.php");
    }