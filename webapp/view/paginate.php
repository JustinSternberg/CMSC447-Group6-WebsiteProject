<?php
/**
 * Created by IntelliJ IDEA.
 * User: Josh
 * Date: 12/3/2016
 * Time: 1:06 PM
 * Desc:
 * This file is used for Ajax pagination for home.php
 * The user will click on a page that is dynamically generated.
 * This will then send a page number to paginate.php and will
 * echo the @MAX_LIST_SIZE entries to the home table.
 *
 * Update:
 * Will most likely be expanded to accommodate generic pagination
 */
require_once(dirname(__FILE__) . '/../load.php');
session_start();
$db = new DB();

//Constants
$MAX_LIST_SIZE = 5;
$PAGE_NO = $_GET["pageNo"];


$result = $db->getActiveListings($_SESSION["email"]);
//$result[index][mySQL att]
for($i = (($PAGE_NO - 1) * $MAX_LIST_SIZE); $i < ($PAGE_NO * $MAX_LIST_SIZE); $i++){
   if(isset($result[$i])){
       echo $result[$i]["good"] . "\n";
   }
}
