function CreateInvite(button, projektID)
{
    var rowId = button.parentElement.parentElement.firstElementChild.innerHTML;
    console.log(rowId);
    //window.location.href = "php/home.php";
    $db => createInvite(projektID,rowId);
}