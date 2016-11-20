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
    console.log(val);
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

function checkSuccess(ajax){
    
    console.log("Success : " + ajax.responseText);
}

function checkFailure(){
    console.log("Failure");
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