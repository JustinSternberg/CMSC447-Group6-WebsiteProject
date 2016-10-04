<?php
session_start();
require_once(dirname(__FILE__) . '/../load.php');

/**
 * Created by IntelliJ IDEA.
 * User: josh
 * Date: 6/15/16
 * Time: 2:51 PM
 */


/**
 * This function grabs the table info from the database
 * and sets the information into a table
 *
 * To add columns to table, simply add a TH row
 */
function formatDataTable(){
    $db = new DB();
    $result = $db->selectAll();

    //Add upper columns here
    echo"<thead><tr>" .
        "<th>First Name</th>" .
        "<th>Last Name</th>" .
        "<th>Campus ID</th>" .
        "<th>Department</th>" .
        "<th>Date Applied</th>" .
        "<th>Actions</th>" .
        "</tr></thead><tbody>";

    //Add data column from respective DB location
    foreach($result as $k=>$v) {
        $id = $v["campusID"];
        if(is_null($v["archived"])) {
            echo "<tr onclick='getName(this);'>" .
                "<td>" . $v["firstName"] . "</td>" .
                "<td>" . $v["lastName"] . "</td>" .
                "<td>" . $v["campusID"] . "</td>" .
                "<td>" . $v["dept"] . "</td>" .
                "<td>" . $v["dateApplied"] . "</td>" .
                "<td style='text-align:center;'> <button type=\"button\" data-toggle=\"modal\" data-target=\"#myModal\" class=\"btn btn-primary\" onclick=\"showApp('$id');\">View</button></td>" .
                "</tr>";
        }
    }
    echo "</tbody>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin view</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">jQuery.noConflict();</script>
    <script src="https://ajax.googleapis.com/ajax/libs/prototype/1.7.3.0/prototype.js"></script>

    <!-- Import datatables -->
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />

    <!--Bootstrap CSS & JS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <!--  Custom CSS & JS -->
    <link rel="stylesheet" type="text/css" href="public/styles/styles.css">
    <script src="public/js/ajax.js"></script>
    <script src="public/js/libs.js"></script>
    <script src="public/js/bootbox.min.js"></script>
    <script type="text/javascript">
        //var JQ = $.noConflict(); //Need JQUERY.NOCONFLICT();  Otherwise prototypes methods will be overwritten
        jQuery(function ($) {
            // The dollar sign will equal jQuery in this scope
            
            /**
             * Creates and initializes the data tables
             */
            $(document).ready(function () {
                $('#applicants').DataTable({
                    //Optional plugins initialization go here.
                    //sDom for specific positioning
                    select: true

                }).select.info(false);
            });
        });
        
    </script>
</head>
<body>
<span id="alert"></span>

<!-- Container -->
<div class="container">
    <table align="center" id="applicants" class="border display" cellspacing="0">
        <?php formatDataTable(); ?>
    </table>
  
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="appTitle"></h4>
                </div>
                <div class="modal-body">
                    <div id="writeID"><!-- Application content goes here --></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success alerter" id="approve" data-target="Application Approved!" onclick="submitApp('approve')" data-dismiss="modal">Approve</button>
                    <button type="button" class="btn btn-danger alerter" id="deny" data-target="Application Denied!" onclick="submitApp('denied')" data-dismiss="modal">Deny</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- !Container -->

<button type="button" class="btn btn-info" onclick="location.reload();">Update <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span></button>
<div id="footer">
    <div id="legal">2016 University of Maryland, Baltimore County.</div>
</div>
<div id="mentions" style="display:none;">Created by: Joshua Standiford</div>
</body>
</html>