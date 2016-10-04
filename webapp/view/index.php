<?php
	require_once(dirname(__FILE__) . '/../load.php');
	$db = new DB();
	$res = $db->selectAll();
	//$db = new DB();
	echo "test";
?>