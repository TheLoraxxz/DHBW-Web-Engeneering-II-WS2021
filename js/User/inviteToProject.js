/*
/ Erstellt eine Einladung für den angegebenen nutzer
 */
function CreateInvite(button,projektID, userId)
{
    var rowId = button.parentElement.parentElement.firstElementChild.innerHTML;
    console.log(rowId);
    window.location.href = "?action=lock&invitedUser="+rowId+"&invitedProjekt="+projektID+"&userId="+userId;
    //$db => createInvite(projektID,rowId);
}
/*
löscht die angegebene Einladung
 */
function EndInvite(button, accepted, userId)
{
    var rowId = button.parentElement.parentElement.firstElementChild.innerHTML;
    if(accepted)
    {
        window.location.href = "?action=lock&Group_ID=" +rowId+"&accepted="+true+"&user_id="+userId;
        console.log("1");
    }
    else
    {
        window.location.href = "?action=lock&Group_ID=" +rowId+"&accepted="+false+"&user_id="+userId;
        console.log("4");
    }
}