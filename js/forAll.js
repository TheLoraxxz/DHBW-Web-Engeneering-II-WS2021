
//sorts is uesed to determine in which order the table needs to be sorted
var sorts = []


function sortTable(headerValue) {
    //getting which element it is from the main point
    var headerrow = headerValue.parentElement
    var i=0;
    var index =0
    headerrow.childNodes.forEach((value)=> {
        if (value.hasChildNodes() && value.children.length>0) {
            if (value.firstElementChild.innerHTML===headerValue.firstElementChild.innerHTML) {
                index = i
            }
        }
        ++i;
    })
    //get image source
    var img_src = headerValue.children[1].getAttribute("src");
    img_src = img_src.substr(0,img_src.indexOf("sort-"));
    //increase everything by one so there can be only one zero
    sorts.forEach((value)=>{
        value["order"]++;
    })
    //get index of current sorting
    var sortsindex = sorts.map((res)=>{return res.index}).indexOf(index)
    //if it is not found the new thing is pushed to the stack else it is changed accorinngly
    if (sortsindex===-1) {
        sorts.push({"index":index,"desc":1,"order":0})
        img_src =img_src+"sort-down.png";
    } else {
        sorts[sortsindex]["order"]=0;
        switch (sorts[sortsindex]["desc"]) {
            case 0:
                sorts[sortsindex]["desc"] = 1;
                img_src =img_src+"sort-down.png";
                break;
            case 1:
                sorts[sortsindex]["desc"]=-1;
                img_src =img_src+"sort-up.png";
                break;
            case -1:
                sorts[sortsindex]["desc"]=0;
                img_src =img_src+"sort-no.png";
                break;
        }
    }
    //sorts it in rorder so it is right again
    sorts.sort((a,b)=>{
        if (a["order"]<b["order"]) {
            return -1;
        } else  if (a["order"]>b["order"]){
            return 1;
        }
        return 0
    })
    //Assigns right order value
    i=0
    sorts.forEach((sort)=>{
        sort["order"] =i;
        ++i;
        //write the value to the header element
        if (sort["desc"]===0 ){
            headerValue.parentElement.children[sort["index"]].children[2].innerHTML="";
        } else {
            headerValue.parentElement.children[sort["index"]].children[2].innerHTML=sort["order"];
        }

    });


    headerValue.children[1].setAttribute("src",img_src)
    //gets the tbody and sorts it
    var tbody = document.getElementById("tableBodyTemplate");
    var rows = tbody.children
    var tbodyKeys = Object.keys(rows);
    var rowArray = []
    tbodyKeys.forEach((key)=>{
        rowArray.push(rows[key])
    })
    //sorts all
    rowArray.sort((a, b)=>compareColumns(a,b))
    //tbody is beeing appended so it is the new table
    tbodyKeys.forEach((key)=> {
        document.getElementById("tableBodyTemplate").appendChild(rowArray[key]);
    })
}

//function sort
/**
 * shows which to compare --> compares the first
 * */
function compareColumns(a,b) {
    //goes through each compare so it chehcks whether it needs to be checked
    for (var i =0;i<sorts.length;++i) {
        //if it is desc it sorts it
        if (sorts[i]["desc"]===1) {
            if (a.children[sorts[i]["index"]].innerHTML < b.children[sorts[i]["index"]].innerHTML) {
                return -1
            }
            if (a.children[sorts[i]["index"]].innerHTML > b.children[sorts[i]["index"]].innerHTML) {
                return 1
            }
            //else elsewise
        } else if(sorts[i]["desc"]===-1) {
            if (a.children[sorts[i]["index"]].innerHTML < b.children[sorts[i]["index"]].innerHTML) {
                return 1
            }
            if (a.children[sorts[i]["index"]].innerHTML > b.children[sorts[i]["index"]].innerHTML) {
                return -1
            }
        }
    }
    //only if all are zero for this one it is sorted by id and because then there is always a difference this is changed
    if(a.getAttribute("id")<b.getAttribute("id")) {
        return -1
    } else  if (a.getAttribute("id")>b.getAttribute("id")){
        return 1
    }
    return 0;
}