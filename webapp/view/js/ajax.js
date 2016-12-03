/**
 * Created by Josh on 10/6/2016.
 */
var id;



/*page(var int);
 *Parameters(pageNo), number, which will determine which page to load
 *Desc: Used to paginate the active listings on the profile screen
 *
 */
function page(pageNo){
    console.log(pageNo);
    if(pageNo < 0)return false;
    new Ajax.Request( "paginate.php",
        {
            method: "get",
            parameters: {pageNo : pageNo},
            onSuccess: pageSuccess,
            onFailure: pageFailure
        }
    );
}

/* pageSuccess(var Ajax)
 * Desc: pageSuccess will be used to populate the
 *       homepage with active items
 */
function pageSuccess(ajax){
    $("#activeListing1").remove();
    console.log(ajax.responseText + " : SUCCESS");
}

/** pageFailure(var Ajax)
 * Desc: will be used as a test-function only
 * @param ajax
 */
function pageFailure(ajax){
    console.log(ajax.responseText + " : FAILURE");
}

/**
 * check(var ID)
 * Desc: will be used to check if pre-existing values
 * already exist in the database and alert user on registration
 * @param ID
 */
function check(ID){
    var val = document.getElementById(ID).value;
    console.log(ID);
    if(ID == "emailIn"){
        //Test regex for email
        new Ajax.Request( "check.php",
            {
                method: "get",
                parameters: {ID : ID,
                    val : val},
                onSuccess: checkSuccess,
                onFailure: checkFailure
            }
        );
    }
    else if(ID == "campusID"){
        //Sanitize before
        new Ajax.Request( "check.php",
            {
                method: "get",
                parameters: {ID : ID,
                    val : val},
                onSuccess: campusSuccess,
                onFailure: checkFailure
            }
        );
    }
}

/*
 * Update glyphicon image @ id
 */
function checkSuccess(ajax){

        document.getElementById("emailCheck").className = "";
        if(ajax.responseText == 1){
            document.getElementById("emailCheck").className = "glyphicon glyphicon-remove-circle";
            document.getElementById("emailCheck").style.color = "red";

        }
        else{
            document.getElementById("emailCheck").className = "glyphicon glyphicon-ok-circle";
            document.getElementById("emailCheck").style.color = "green";
        }
}

function checkFailure(){
    console.log("Failure @ __LINE__");
}

function campusSuccess(ajax){
    document.getElementById("campusIDCheck").className = "";
    if(ajax.responseText == 1){
        document.getElementById("campusIDCheck").className = "glyphicon glyphicon-remove-circle";
        document.getElementById("campusIDCheck").style.color = "red";

    }
    else{
        document.getElementById("campusIDCheck").className = "glyphicon glyphicon-ok-circle";
        document.getElementById("campusIDCheck").style.color = "green";
    }
}

/*Used to gather active goods in their respective categories*/
function populate(code){
    id = code;
    new Ajax.Request( "populate.php",
        {
            method: "get",
            parameters: {code : code},
            onSuccess: worked,
            onFailure: failed
        }
    );
}

/**
 * Ajax on Success function
 */
function worked(ajax){
    var res = ajax.responseText;

    console.log(res);

}

/**
 * Print failure to console
 * @param ajax
 */
function failed(ajax){
    console.log("AJAX FAILED");
    console.log(ajax.responseText);
}