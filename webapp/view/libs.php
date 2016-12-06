<?php
/*Written by Josh Standiford*/
require_once(dirname(__FILE__) . '/../load.php');
session_start();



/*
** Desc:
**	Checks the users credentials, and if they're not valid. Redirect them to specified page.
**  Credentials are tracked through session variables and obtained via verifyUser.php
**
*/
function credCheck(){
	session_start();
	if(!$_SESSION["auth"]){
		header("Location:indexed.php");
	}
}

/**
 * This function is used to populate the listings
 * on the market pages
 * @param $page
 */
function popListings($page){
    $db = new DB();
    setlocale(LC_MONETARY, 'en_US');

    $result = $db->getAllListings($page);

    if($result) {
        foreach ($result as $v) {
            $img = $db->getImage($v["unique"]);
            $src = '<img class="group list-group-image"   src="data:image/' . $img[0]["type"] . ';base64,' . base64_encode($img[0]["image"]) . '"/>';
            echo "<div class=\"item  col-xs-4 col-lg-4\">  
             <div class=\"thumbnail\" style='padding:20px;'>  
              $src
             
              
                 <div class=\"caption\">
                 <h4 class=\"group inner list-group-item-heading\">" . $v["good"] . "</h4>
                 <p class=\"group inner list-group-item-text\">
                 " . $v["desc"] . "   
                 </p>
                     <div class=\"row\">
                         <div class=\"col-xs-12 col-md-6\">
                         <p class=\"lead\">$" . money_format('%i', $v["price"]) . "</p>
                         </div>
                         <div class=\"col-xs-12 col-md-6\">
                         <!-- Finish linking this pls-->
                          <a class=\"btn btn-success\" onclick='updateCart();' >Add to cart</a>
                         </div>
                     </div>
                 </div>
             </div>
        </div>";
        }
    }
    else{
        echo "There appears to be nothing here.<br/> " .
        "<ahref='home.php'>Create Listing?</a>";
    }
}