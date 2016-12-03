<?php
/**
 * Created by IntelliJ IDEA.
 * User: Josh
 * Date: 12/3/2016
 * Time: 1:06 PM
 */
require_once(dirname(__FILE__) . '/../load.php');
session_start();
$db = new DB();

echo "Success " . $_GET["pageNo"];
