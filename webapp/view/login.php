<?php
require_once(dirname(__FILE__) . '/../load.php');
session_start();
$db = new DB();
//Parse and flush $_POST !!!!!
$_SESSION["auth"] = $db->authorize($_POST["email"], $_POST["password"]);
$_SESSION["name"] = $db->getName($_POST["email"]);
/**
 * Created by IntelliJ IDEA.
 * User: Josh
 * Date: 10/6/2016
 * Time: 5:40 PM
 */
if($_SESSION["auth"]){
    $_SESSION["wrongPass"] = false;
    header("Location:home.php");
}
else{
    $_SESSION["wrongPass"] = true;
    header("Location:index.php");
}

