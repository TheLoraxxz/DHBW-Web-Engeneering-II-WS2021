function CreateInvite(button, projektID)
{
    var rowId = button.parentElement.parentElement.firstElementChild.innerHTML;
    console.log(rowId);
    //window.location.href = "php/home.php";
    //$db => createInvite(projektID,rowId);
}

function EndInvite(button, accepted, userId)
{
    var rowId = button.parentElement.parentElement.firstElementChild.innerHTML;
    console.log(userId);
    window.location.href = "./user/project/AcceptInvite.php?action=lock&Group_ID=" +rowId+"&accepted="+accepted+"&user_id="+userId;
    //$db => AddToGroup(userId, rowId);
}