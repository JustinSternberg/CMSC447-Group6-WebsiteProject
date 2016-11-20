/**
 * Created by Josh on 11/3/2016.
 */

/**
 * This function checks user input to validate and clean
 * @returns {boolean} True if user input passes, false otherwise.
 */
function validate(){

    if(document.getElementById("password").value != document.getElementById("passwordRetype").value){
        console.log("Incorrect passwords");
        return false;
    }


    return false;
}