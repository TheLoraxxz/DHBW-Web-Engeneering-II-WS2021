
//go to grade overview in the table project overview
function grade(button) {
    var id = button.parentElement.parentElement.firstElementChild.innerHTML;
    window.location.href = "./../Bewertung/groupDetails_and_Rating.php?disGruppe="+id;
}
