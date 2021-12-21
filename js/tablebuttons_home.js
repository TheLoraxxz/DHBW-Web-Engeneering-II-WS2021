function seeDetails(button) {
    var rowId = button.parentElement.parentElement.getAttribute("id");
    var project_id =document.getElementById(rowId).firstElementChild.innerHTML;
    window.location.href = "./admin/project_overview.php?project_id="+project_id;
}

function editProject(button) {
    var rowId = button.parentElement.parentElement.getAttribute("id");
    var project_id =document.getElementById(rowId).firstElementChild.innerHTML;
    window.location.href = "./project/project.php?action=edit&projectId="+project_id;
}

function lockData(button) {
    var rowId = button.parentElement.parentElement.getAttribute("id");
    var project_id =document.getElementById(rowId).firstElementChild.innerHTML;
    window.location.href = "./project/project.php?action=lock&projectId="+project_id;
}

function changeViewToInvite(button)
{
    var rowId = button.parentElement.parentElement.firstElementChild.innerHTML;
    console.log(rowId);
    window.location.href = "./user/project/InviteToProject.php?action=lock&userId=" +rowId;
}

function changeViewToAcceptInvites(button)
{
    var rowId = button.parentElement.parentElement.firstElementChild.innerHTML;
    console.log(rowId);
    window.location.href = "./user/project/InviteToProject.php?action=lock&userId=" +rowId;
}

function SubmitProject(button)
{
    var rowId = button.parentElement.parentElement.firstElementChild.innerHTML;
    window.location.href = "?action=lock&ProjektId=" +rowId;
}

function deleteProject(button)
{
    var rowId = button.parentElement.parentElement.firstElementChild.innerHTML;
    window.location.href = "?action=lock&ProjectId=" +rowId;
}