var desc = 0
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

    sorts.forEach((value)=>{
        value["order"]++;
    })
    var sortsindex = sorts.map((res)=>{return res.index}).indexOf(index)
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
    sorts.sort((a,b)=>{
        if (a["order"]<b["order"]) {
            return -1;
        } else  if (a["order"]>b["order"]){
            return 1;
        }
        return 0
    })
    i=0
    sorts.forEach((sort)=>{
        sort["order"] =i;
        ++i;
        headerValue.parentElement.children[sort["index"]].children[2].innerHTML=sort["order"];
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
    rowArray.sort((a, b)=>compareColumns(a,b))
    tbodyKeys.forEach((key)=> {
        document.getElementById("tableBodyTemplate").appendChild(rowArray[key]);
    })
}

//function sort
/**
 * shows which to compare --> compares the first
 * */
function compareColumns(a,b) {
    for (var i =0;i<sorts.length;++i) {
        if (sorts[0]["desc"]===1) {
            if (a.children[sorts[i]["index"]].innerHTML < b.children[sorts[i]["index"]].innerHTML) {
                return -1
            }
            if (a.children[sorts[i]["index"]].innerHTML > b.children[sorts[i]["index"]].innerHTML) {
                return 1
            }
        } else if(sorts[i]["desc"]===-1) {
            if (a.children[sorts[i]["index"]].innerHTML < b.children[sorts[i]["index"]].innerHTML) {
                return 1
            }
            if (a.children[sorts[i]["index"]].innerHTML > b.children[sorts[i]["index"]].innerHTML) {
                return -1
            }
        } else {
            if(a.getAttribute("id")<b.getAttribute("id")) {
                return -1
            } else  if (a.getAttribute("id")>b.getAttribute("id")){
                return 1
            }
        }
    }
    return 0;
}