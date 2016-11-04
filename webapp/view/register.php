<?php
/**
 * Created by IntelliJ IDEA.
 * User: Josh
 * Date: 10/6/2016
 * Time: 6:40 PM
 */
    require_once(dirname(__FILE__) . '/../load.php');
    session_start();
	$db = new DB();

    echo $_GET["code"] . "\n";