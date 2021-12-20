var listShown = false;
var people_selected = [];
var people_selected_id = [];
var maxStudents = 0;
function openList() {
    var select = document.getElementById("projects_input")
    var val_proj = select.options[select.selectedIndex].value;
    if (val_proj!=="-") {
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
        alert("Kein Projekt selektiert.")
    }
}

function sort() {
    var listPeople = document.getElementsByClassName("list_of_people")[0]
    var select = document.getElementById("projects_input")
    var val_proj = select.options[select.selectedIndex].value.substr(0,select.options[select.selectedIndex].value.indexOf('|'))
    maxStudents = parseInt(select.options[select.selectedIndex].value.substr(select.options[select.selectedIndex].value.indexOf('|')+1));
    for (var i =0;i<listPeople.children.length;++i) {
        listPeople.children[i].setAttribute("style","display:block")
    }
    for (var i =0;i<listPeople.children.length;++i) {
        var list_projects = JSON.parse(listPeople.children[i].children[0].children[2].innerHTML);

        if (!(list_projects.find((res)=>{return val_proj===res.project_id}))) {
            listPeople.children[i].setAttribute("style","display:none")
        }
    }
}

function selectUser(check) {
    if (check.checked) {
        if (people_selected.length<maxStudents) {
            people_selected.push(check.parentElement.children[1].innerHTML)
            var id  = check.parentElement.children[0].getAttribute("id");
            people_selected_id.push(parseInt(id.substr(-1)));
        } else {
            alert("Maximale Anzahl von: "+maxStudents+" Studenten ist erreicht!")
            check.checked = false;
        }
    } else {
        var index = people_selected.indexOf(check.parentElement.children[1].innerHTML)
        people_selected.splice(index,1);

        index  = people_selected_id.indexOf(parseInt(check.parentElement.children[0].getAttribute("id")));
        people_selected_id.splice(index,1);
    }
    document.getElementById("inventations").value = people_selected;

}
function submitForm() {
    var name = document.getElementById("group_name").value;
    if (name.length>0) {
        document.getElementById("name").value = document.getElementById("group_name").value;
        document.getElementById("member").value = JSON.stringify(people_selected_id);
        var select = document.getElementById("projects_input")
        document.getElementById("course_id").value = select.options[select.selectedIndex].value.substr(0, select.options[select.selectedIndex].value.indexOf('|'));
        document.getElementById("submitform").submit();
    } else {
        alert("Bitte einen Namen eingeben")
    }
}
function goBack() {
    window.location.href = './../../../'
}
