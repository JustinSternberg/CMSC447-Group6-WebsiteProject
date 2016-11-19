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