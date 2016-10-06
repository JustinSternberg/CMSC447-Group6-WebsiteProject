<?php
require_once(dirname(__FILE__) . '/../load.php');
session_start();
if(!$_SESSION["auth"]){
    header("Location:logout.php");
}
/**
 * Created by IntelliJ IDEA.
 * User: Josh
 * Date: 10/6/2016
 * Time: 5:57 PM
 */
?>
<html>
<head></head>
<body>
Home page
</body>
</html>
