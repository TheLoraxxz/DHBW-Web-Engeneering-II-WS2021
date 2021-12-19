var listShown = false;
var people_selected = [];
function openList() {
    var select = document.getElementById("projects_input")
    var val_proj = select.options[select.selectedIndex].value
    if (val_proj.length>0) {
        if (listShown) {
            document.getElementById("listing").setAttribute("style","display:none")
            listShown = !listShown
            var listPeople = document.getElementsByClassName("list_of_people")[0]
            for (var i =0;i<listPeople.children.length;++i) {
                listPeople.children[i].setAttribute("style","display:block")
            }

        } else {
            document.getElementById("listing").setAttribute("style","display:block")
            sort()
            listShown = !listShown
        }

    } else {
        alert("Kein Kurs selektiert.")
    }
}

function sort() {
    var listPeople = document.getElementsByClassName("list_of_people")[0]
    var select = document.getElementById("projects_input")
    var val_proj = select.options[select.selectedIndex].value
    for (var i =0;i<listPeople.children.length;++i) {
        listPeople.children[i].setAttribute("style","display:block")
    }
    for (var i =0;i<listPeople.children.length;++i) {
        if (!(listPeople.children[i].children[0].children[2].innerHTML==val_proj)) {
            listPeople.children[i].setAttribute("style","display:none")
        }
    }
}

function selectUser(check) {
    if (check.checked) {
        people_selected.push(check.parentElement.children[1].innerHTML)
    } else {
        var index = people_selected.indexOf(check.parentElement.children[1].innerHTML)
        console.log(index)
        people_selected.slice(index);
    }
    console.log(people_selected)
    document.getElementById("inventations").value = ""
    document.getElementById("inventations").value = people_selected;

}
