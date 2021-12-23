/*
reloads site with the Details view enabled
 */

function seeDetails(button) {
    var rowId = button.parentElement.parentElement.getAttribute("id");
    var project_id =document.getElementById(rowId).firstElementChild.innerHTML;
    window.location.href = "./admin/project_overview.php?project_id="+project_id;
}
/*
reloads site with the Edit view enabled
 */

function editProject(button) {
    var rowId = button.parentElement.parentElement.getAttribute("id");
    var project_id =document.getElementById(rowId).firstElementChild.innerHTML;
    window.location.href = "./project/project.php?action=edit&projectId="+project_id;
}
/*
reloads site and blocks invites for a group
 */
function lockData(button) {
    var rowId = button.parentElement.parentElement.getAttribute("id");
    var project_id =document.getElementById(rowId).firstElementChild.innerHTML;
    window.location.href = "./project/project.php?action=lock&projectId="+project_id;
}
/*
opens invite view
 */

function changeViewToInvite(button)
{
    var rowId = button.parentElement.parentElement.firstElementChild.innerHTML;
    console.log(rowId);
    window.location.href = "./user/project/InviteToProject.php?action=lock&userId=" +rowId;
}
/*
opens invite accept view
 */
function changeViewToAcceptInvites(button)
{
    var rowId = button.parentElement.parentElement.firstElementChild.innerHTML;
    console.log(rowId);
    window.location.href = "./user/project/InviteToProject.php?action=lock&userId=" +rowId;
}
/*
submits the Project and safes the time
 */
function SubmitProject(button)
{
    var rowId = button.parentElement.parentElement.firstElementChild.innerHTML;
    window.location.href = "?action=lock&ProjektId=" +rowId;
}
/*
deletes the Project
 */
function deleteProject(button)
{
    var rowId = button.parentElement.parentElement.firstElementChild.innerHTML;
    window.location.href = "?action=lock&ProjectId=" +rowId;
}