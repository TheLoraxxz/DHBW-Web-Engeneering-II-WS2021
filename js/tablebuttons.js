

function seeDetails(button) {
    var rowId = button.parentElement.parentElement.getAttribute("id");
    var project_id =document.getElementById(rowId).firstElementChild.innerHTML;
    window.location.href = "./project/project.php?projectId="+project_id;
}
