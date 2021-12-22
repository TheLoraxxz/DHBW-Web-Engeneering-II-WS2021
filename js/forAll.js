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

    var sortsindex = sorts.map((res)=>{return res.index}).indexOf(index)
    if (sortsindex===-1) {
        sorts.push({"index":index,"desc":1,"order":1})
    } else {

        switch (sorts[sortsindex]["desc"]) {
            case 0:
                sorts[sortsindex]["desc"] = 1;
            case 1:
                sorts[sortsindex]["desc"]=-1;
            case -1:
                sorts[sortsindex]["desc"]=0;
        }
    }

    switch (desc) {
        case 0:
            desc = 1;
            img_src =img_src+"sort-down.png";
            break;
        case 1:
            desc = -1;
            img_src =img_src+"sort-up.png";
            break;
        case -1:
            desc = 0;
            img_src =img_src+"sort-no.png";
    }
    headerValue.children[1].setAttribute("src",img_src)
    //gets the tbody and sorts it
    var tbody = document.getElementById("tableBodyTemplate");
    var rows = tbody.children
    var tbodyKeys = Object.keys(rows);
    var rowArray = []
    tbodyKeys.forEach((key)=>{
        rowArray.push(rows[key])
    })
    rowArray.sort((a, b)=>compareColumns(a,b,index))
    tbodyKeys.forEach((key)=> {
        document.getElementById("tableBodyTemplate").appendChild(rowArray[key]);
    })
}

//function sort

function compareColumns(a,b,index) {
    if (desc===1) {
        if (a.children[index].innerHTML < b.children[index].innerHTML) {
            return -1
        }
        if (a.children[index].innerHTML > b.children[index].innerHTML) {
            return 1
        }
        return 0
    } else if(desc===-1) {
        if (a.children[index].innerHTML < b.children[index].innerHTML) {
            return 1
        }
        if (a.children[index].innerHTML > b.children[index].innerHTML) {
            return -1
        }
        return 0
    } else {
        if(a.getAttribute("id")<b.getAttribute("id")) {
            return -1
        } else  if (a.getAttribute("id")>b.getAttribute("id")){
            return 1
        } else {
            return 0
        }
    }
}