function CreateInvite(button,projektID, userId)
{
    var rowId = button.parentElement.parentElement.firstElementChild.innerHTML;
    console.log(rowId);
    window.location.href = "?action=lock&invitedUser="+rowId+"&invitedProjekt="+projektID+"&userId="+userId;
    //$db => createInvite(projektID,rowId);
}

function EndInvite(button, accepted, userId)
{
    var rowId = button.parentElement.parentElement.firstElementChild.innerHTML;
    console.log(userId);
    window.location.href = "?action=lock&Group_ID=" +rowId+"&accepted="+false+"&user_id="+userId;
}