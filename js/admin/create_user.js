var shown_course = false;
var save = false;

function hideShowCourse() {
    if (!save) {
        shown_course = !shown_course;
        if (shown_course) {
            document.getElementById("kurs").setAttribute("style","display:block;");
            document.getElementById("course_input").setAttribute("disabled","true");

        } else {
            document.getElementById("kurs").setAttribute("style","display:none;");
            document.getElementById("course_input").removeAttribute("disabled");
            document.getElementById("course_name").value = "";
            document.getElementById("institut").value = "";
        }
    }

}
function saveCourse() {

    if (document.getElementById("course_name").value.length >0 && document.getElementById("institut_input").value.length>0) {
        document.getElementById("course_name").setAttribute("disabled","true")
        document.getElementById("institut_input").setAttribute("disabled","true")
        save = true;
    }

}
function submit() {
    var number  = document.getElementById("number_of_accounts_input").value
    if (!(number.length == 0)) {
        document.getElementById("number_of_accounts").value = number
        let course_name;
        let action
        if (save) {
            if (document.getElementById("course_name").value.length>0) {
                course_name = document.getElementById("course_name").value;
                action ="create_kurs";
                document.getElementById("institut").value = document.getElementById("institut_input").value
            }
        } else {
            course_name = document.getElementById("course_input").value;
            action = "create";
        }
        if(course_name.length>0) {
            document.getElementById("action").value = action
            document.getElementById("number_of_accounts").value = number
            document.getElementById("course").value = course_name
            document.getElementById("submitform").submit();

        }
    }

}
function resetPasswordButton(button) {
    row=button.parentElement.parentElement.parentElement
    id = row.firstChild.innerHTML;
    window.location.href = './create_user.php?action=reset_password&id='+id;


}
