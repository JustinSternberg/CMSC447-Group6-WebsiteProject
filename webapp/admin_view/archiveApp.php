<?php
require_once(dirname(__FILE__) . '/../load.php');
/**
 * Created by IntelliJ IDEA.
 * User: josh
 * Date: 9/28/16
 * Time: 2:08 PM
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

$db = new DB();
$code = $_GET["code"];
$id = $_GET["umbcID"];

$db->archive($id, $code);