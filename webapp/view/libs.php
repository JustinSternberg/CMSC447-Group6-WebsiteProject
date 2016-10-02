<?php
/*Written by Josh Standiford*/ 
session_start();

/* 
** Desc: Connects user to database, with static credentials
*/
function connect(){

	$db ="jstand1";
	$conn = mysql_connect("studentdb-maria.gl.umbc.edu", "jstand1", "jstand1");
	if(!$conn){
		echo("Could not connect to MySQL");
	}

	$er = mysql_select_db("jstand1");
	if(!$er){
		echo("Could not find table name");
	}
	return $conn;
}
/* 
** Desc: Disconnects MYSQL object 
*/
function disconnect($conn){
	mysql_close($conn);
}

/*
** Desc:
**	Checks the users credentials, and if they're not valid. Redirect them to specified page.
**  Credentials are tracked through session variables and obtained via verifyUser.php
**
*/
function credCheck(){
	session_start();
	if(!$_SESSION["auth"]){
		header("Location:indexed.html");
	}
}

