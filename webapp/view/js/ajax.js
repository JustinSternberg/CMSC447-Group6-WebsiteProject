/**
 * Created by Josh on 10/6/2016.
 */

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

    new Ajax.Request( "register.php",
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
    console.log(ajax.responseText);
}

/**
 * Print failure to console
 * @param ajax
 */
function failed(ajax){
    console.log(ajax.responseText);
}