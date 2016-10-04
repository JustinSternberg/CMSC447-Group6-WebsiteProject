/**
 * Created by josh on 7/12/16.
 */

/**
 * This function gets the campus ID of the row clicked on.
 * @param x - <tr> is returned
 * @returns Campus ID of row clicked on
 */
function getName(x){
    var campusID = 2;
    var studentID = x.cells[campusID].innerHTML;
}

function alertUser(e){
    var alert = document.getElementById("alert");
    alert.className += "alert";
    switch(e){
        case "success":
            alert.className += " alert-success";
            var x = confirm("Are you sure you want to Approve Applicant?");
            if(x){console.log("Approved");}
            alert.innerHTML = "Application Approved!";
            break;
        case "danger":
            alert.className += " alert-success";
            var x = confirm("Are you sure you want to Deny Applicant?");
            if(x){console.log("Deleted");}
            alert.innerHTML = "Application Denied";
            break;
        default:
            console.log("Message not found");
            alert.className += " alert-danger";
            alert.innerHTML = "Unknown Event.  Please try again";
            break;
    }
}

/**
 * --------------------JQUERY LIBS-----------------------
 * For JQuery functions, Noconflict disables $ from use
 * This creates $ as a function to be used as long as its in the scope
 */
jQuery(function ($) {
    /**
     * This fades out the alert from the top of the page in admin/index
     */
     $(document).ready(function () {

         $('.alerter').click(function () {
             
             $("<div id='alertFade' class='alerts alert alert-info'></div>").insertBefore('#alert');
             $("#alertFade").empty().append($(this).data('target'));
                window.setTimeout(function () {

                    $(".alert").fadeTo(1500, 0).slideUp(500, function () {
                        $(this).remove();
                    });
                }, 4000);
            });
        });
});