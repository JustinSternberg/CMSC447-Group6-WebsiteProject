<?php
require_once(dirname(__FILE__) . '/../load.php');
session_start();
$db = new DB();
$_SESSION["auth"] = $db->authorize($_POST["campusID"], $_POST["password"]);
/**
 * Created by IntelliJ IDEA.
 * User: Josh
 * Date: 10/6/2016
 * Time: 5:40 PM
 */
if($_SESSION["auth"]){
    header("Location:home.php");
}
else{
    header("Location:index.php");
}

