/**
 * Created by josh on 6/9/16.
 */

function testPop(){

    new Ajax.Request( "populateTable.php",
        {
            method: "get",
            parameters: {},
            onSuccess: displayResult
        }
    );
}

function displayResult(ajax){
    var res = ajax.responseText;
    $('#table').html(res);
}


/**
 * This is the AJAX that handles the concurrent locks on application revision
 *
 *
 */

/**
 *
 *This is the AJAX that handles populating the web form application
 *
 */
function showApp(ID){

    //Makes Ajax call to get title
    new Ajax.Request( "populateApp.php",
        {
            method: "get",
            parameters: {umbcID:ID,
                        code : "title"},
            onSuccess: popTitle
        }
    );
    //Makes Ajax call to get the application data
    new Ajax.Request( "populateApp.php",
        {
            method: "get",
            parameters: {umbcID:ID,
                         code : "body"},
            onSuccess: popBody
        }
    );
}


function submitApp(code){
    var ID = document.getElementById("campusID").innerHTML;

    new Ajax.Request( "archiveApp.php",
        {
            method: "get",
            parameters: {umbcID:ID,
                code : code},
            onSuccess: worked
        }
    );
}

function worked(){
    //setTimeout(reload, 3000);
    //location.reload();
}

function reload(){
    location.reload();
}
/**
 * This populates the title of the popout modal
 * @param ajax
 */
function popTitle(ajax){
    var res = ajax.responseText;
    document.getElementById("appTitle").innerHTML = res + " - Application";

}

/**
 * This populates the body of the popout modal
 * @param ajax
 */
function popBody(ajax){
    var res = ajax.responseText;
    document.getElementById("writeID").innerHTML = res;
}