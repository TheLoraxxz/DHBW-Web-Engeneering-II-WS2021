var shown_course = false;
var save = false;
//shows institute if it is shown and if it is saved you can open and close it every time
function hideShowInstitute() {
    if (!save) {
        shown_course = !shown_course;
        if (shown_course) {
            document.getElementById("btns").setAttribute("style","display:block;");
            document.getElementById("institute_input").setAttribute("style","display:block;");
        } else {
            document.getElementById("btns").setAttribute("style","display:none;");
            document.getElementById("institute_input").setAttribute("style","display:none;");
        }
    }
}
//if the course is saved the inputs are saved so it is used to determine everything also the fields go disabled to prevent  more inüut
function saveCourse() {
    if (document.getElementById("course_input").value.length >0 && document.getElementById("institute").value.length>0) {
        document.getElementById("course_input").setAttribute("disabled","true")
        document.getElementById("institute").setAttribute("disabled","true")
        save = true;
    }
}
//copies all the files to the shadow form and then submits this form
function submit() {
    let course_name = document.getElementById("course_input").value;
    let action = document.getElementById("action").value;
    let login = document.getElementById("login").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let surename = document.getElementById("surename").value;
    let name = document.getElementById("name").value;
    let institute = "";

    if(!(document.getElementById("instutute").value == null)) {
        institute = document.getElementById("instutute").value;
    }

    let role_input = document.querySelector('input[name="role"]:checked').value;

    console.log(course_name + action + login + email + password + surename + name + institute);

    document.getElementById("action_form").value = action;
    document.getElementById("course_form").value = course_name;
    document.getElementById("institue_form").value = name;
    document.getElementById("login_form").value = institute;
    document.getElementById("email_form").value = email;
    document.getElementById("password_form").value = password;
    document.getElementById("surename_form").value = surename;
    document.getElementById("name_form").value = name;
    document.getElementById("role_input_form").value = role_input;



    document.getElementById("submitform").submit();
}


