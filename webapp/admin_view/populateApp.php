<?php
require_once(dirname(__FILE__) . '/../load.php');
/**
 * Created by IntelliJ IDEA.
 * User: josh
 * Date: 7/21/16
 * Time: 1:17 PM
 *
 * This file is part of an AJAX request.  This file takes a code given through ajax handler.
 * The ajax code at the time being will be title or body.
 *
 * This will determine what information is pulled from the database to populate the modals.
 * A custom filter will be created in order to allow the user to specify what information they want to see
 * in the application.
 *
 * Admin_view/index.php -> ajax.js -> populateApp.php -> prints to modal on index.
 */
echo "<style>td{ padding: 10px;}</style>";
$db = new DB();
$popCode = $_GET["code"];

//Will import FILTER from user preference
$filter = ["appID","umbcStanding", "notes", "comments"];

switch($popCode){
    case "title":
        $name = $db->getName($_GET["umbcID"]);
        if($name != null){
            echo $name;
        }
        else{
            echo "No name found.";
        }
        break;

    case "body":
        $body = "";
        $id = $_GET["umbcID"];
        $res = $db->getAppData($_GET["umbcID"]);
        echo "<div id='campusID' style='visibility: hidden;'>$id</div>";
        foreach($res as $b=>$v){
            if(!in_array($b, $filter, true) && !is_null($v)) {
                echo $b . " = " . $v . "<br>";
            }
        }
        echo "<hr>";
        //Everything from Work_App DB
        $res = $db->getWorkAppData($_GET["umbcID"]);
        echo "Academic status: " . $res["academicStatus"] . "<br>";
        echo "Anticipated graduation: " . $res["anticipatedGrad"] . "<br>";
        echo "Major: " . $res["major"] . "<br>";
        echo "Semester applied: " . $res["semesterApplied"] . "<br><br>";
        echo "<i><u>Hour preferences:</i></u> <br>";
        //Make this a table

        echo "<table border='1' cellpadding='10'>";
        echo "<tr><td>Monday Priority: </td><td>" . $res["mondayOne"] .
             "</td><td> Monday secondary: </td><td>" . $res["mondayTwo"] . "</td></tr>";
        echo "<tr><td>Tuesday Priority: </td><td>" . $res["tuesdayOne"] .
             "</td><td> Tuesday secondary: </td><td>" . $res["tuesdayTwo"] . "</td></tr>";
        echo "<tr><td>Wednesday Priority: </td><td>" . $res["wednesdayOne"] .
             "</td><td> Wednesday secondary: </td><td>" . $res["wednesdayTwo"] . "</td></tr>";
        echo "<tr><td>Thursday Priority: </td><td>" . $res["thursdayOne"] .
             "</td><td> Thursday secondary: </td><td>" . $res["thursdayTwo"] . "</td></tr>";
        echo "<tr><td>Friday Priority: </td><td>" . $res["fridayOne"] .
             "</td><td> Friday secondary: </td><td>" . $res["fridayTwo"] . "</td></tr>";
        echo "<tr><td>Saturday Priority: </td><td>" . $res["saturdayOne"] .
             "</td><td> Saturday secondary: </td><td>" . $res["saturdayTwo"] . "</td></tr>";
        echo "<tr><td>Sunday Priority: </td><td>" . $res["sundayOne"] .
             "</td><td> Sunday secondary: </td><td>" . $res["sundayTwo"] . "</td></tr>";
        echo "</table>";

        echo "<br>";
        echo "<i><u>Work experience:</i></u> <br>";

        if(!$res["workedBefore"]){
            echo "No prior work experience <br>";
        }
        else{
            echo "Worked at: " . $res["workedBeforeWhere"] . "<br>";
        }

        if(!$res["currentlyWorking"]){
            echo "Not currently working. <br>";
        }
        else{
            echo "Currently working at " . $res["currentlyWhere"] . "<br>";
        }

        echo "<br><u><i>Computer experience:</i></u> <br>";
        if(strlen($res["computerExp"]) > 0) {
            echo $res["computerExp"] . "<br><br>";
        }
        else{
            echo "Not available. <br><br>";
        }
        echo "<i><u>Office equipment experience:</i></u><br>";
        echo $res["officeEquipment"] . "<br><br>";

        echo "<i><u>Public experience:</i></u><br>";
        echo $res["publicExp"] . "<br><br>";

        echo "<i><u>Known languages:</i></u><br>";
        echo $res["foreignLang"] . "<br><br>";

        echo "<i><u>Special skills:</i></u><br>";
        echo $res["specialSkills"] . "<br><br>";


        echo "<u><i>Recent employer information:</i></u> <br>";
        if(strlen($res["recentEmployer"]) > 0){
            echo "Recent employer: " . $res["recentEmployer"] . "<br>";
            echo "Employer address: " . $res["employerAddress"] . "<br>";
            echo "Supervisor name: " . $res["supervisorName"] . "<br>";
            echo "Position: " . $res["position"] . "<br>";
            echo "Employed from: " . $res["employedFrom"] . " to " . $res["employedTo"] . "<br>";
            echo "Reason for leaving: " . $res["reasonForLeaving"] . "<br>";
        }
        else{
            echo "No recent employer.<br>";
        }
        echo "<br>";
        if(strlen($res["recentEmployerTwo"]) > 0){
            echo "Recent employer: " . $res["recentEmployerTwo"] . "<br>";
            echo "Employer address: " . $res["employerAddressTwo"] . "<br>";
            echo "Supervisor name: " . $res["supervisorNameTwo"] . "<br>";
            echo "Position: " . $res["positionTwo"] . "<br>";
            echo "Employed from: " . $res["employedFromTwo"] . " to " . $res["employedToTwo"] . "<br>";
            echo "Reason for leaving: " . $res["reasonForLeavingTwo"] . "<br>";
        }
        else{
            echo "No recent secondary employer.<br>";
        }


        foreach($res as $b=>$v){
            if(!in_array($b, $filter, true)) {
                //echo $b . " = " . $v . "<br>";
            }
        }
        break;

    default;
        echo "No found case";
        break;
}


