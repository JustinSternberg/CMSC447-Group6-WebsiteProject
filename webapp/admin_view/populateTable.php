<?php
require_once(dirname(__FILE__) . '/../load.php');
/**
 * Created by IntelliJ IDEA.
 * User: josh
 * Date: 7/8/16
 * Time: 12:08 PM
 */

echo "<tr><td>test</td></tr>";


$db = new DB();
$result = $db->selectAll();

//echo"<tr><th>First Name</th><th>Last Name</th><th>Campus ID</th><th>Department</th><th>Date Applied</th>";
$table = "";
foreach($result as $k=>$v) {
    $table .= "<tr><td>" . $v["firstName"] . "</td><td>" .  $v["lastName"] . " </td><td>" . $v["campusID"] . "</td><td>" . $v["dept"] . "</td><td>" . $v["dateApplied"] . "</td></tr>";

    foreach ($v as $item){
        //echo "<td> $item </td> ";
    }

}

echo $table;

