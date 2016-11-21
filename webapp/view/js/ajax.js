/**
 * Created by Josh on 10/6/2016.
 */
var id;
/**
 * Ajax test method
 * Delete this -- Unit test
 * @param code
 */
function submitApp(code){

    new Ajax.Request( "archiveApp.php",
        {
            method: "get",
            parameters: {umbcID:ID,
                code : code},
            onSuccess: worked,
            onFailure: failed
        }
    );
}

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