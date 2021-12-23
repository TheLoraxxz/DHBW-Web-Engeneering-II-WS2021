var shown_course = false;
var save = false;
//shows and hides the course so you dont need to always add users
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
//saves course
function saveCourse() {

    if (document.getElementById("course_name").value.length >0 && document.getElementById("institut_input").value.length>0) {
        document.getElementById("course_name").setAttribute("disabled","true")
        document.getElementById("institut_input").setAttribute("disabled","true")
        save = true;
    }

}
//on submit the numbers are shown and it doesnt need to be zero and submitting the item
function submit() {
    var number  = document.getElementById("number_of_accounts_input").value
    if (!(number.length === 0)) {
        document.getElementById("number_of_accounts").value = number
        let course_name;
        let action
        //if save = true the course name and isntitute name are gotten
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
        //if the name is set it seets all to the shadow form and submits this
        if(course_name.length>0) {
            document.getElementById("action").value = action
            document.getElementById("number_of_accounts").value = number
            document.getElementById("course").value = course_name
            document.getElementById("submitform").submit();

        }
    }

}
function resetPasswordButton(button) {
    cells=button.parentElement.parentElement.parentElement.children
    console.log(cells[0].innerHTML)
    window.location.href = './create_user.php?action=reset_password&id='+cells[0].innerHTML+"&login="+cells[1].innerHTML;
}

function editUser(button) {
    var user_id = button.parentElement.parentElement.parentElement.firstElementChild.innerHTML;
    window.location.href = "./create_edit_user.php?action=edit&user_id="+user_id;
}
