<?php
/**
 * Created by IntelliJ IDEA.
 * User: Josh
 * Date: 12/4/2016
 * Time: 5:39 PM
 */
require_once(dirname(__FILE__) . '/../load.php');
session_start();
$db = new DB();

$id =  $_SESSION["campusID"];
$entries =  sizeof($db->getActiveListings($_SESSION["email"])) . "<br>";

$_POST["nextIt"] = ($entries += 1);
$_POST["campusID"] = $id;
$_POST["imgref"] = $id . $entries;
$db->addItem($_POST);

header("Location:home.php");