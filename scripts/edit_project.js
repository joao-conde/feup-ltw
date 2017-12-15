'use strict';

//===== SET ACTIVE TAB =====
changeActiveTab(2);


let title = document.querySelector('form > input[name=title');
let desc = document.querySelector('form > textarea[name=description');
let proj_deadline_string = document.querySelector('form > input[name=deadline');
let submit = document.querySelector('form > input[type=submit');

let fields = [title,desc,proj_deadline_string];

function validateTitle() {
    return title.value.length > 0;
}

function validateDesc() {
    return desc.value.length > 0;
}

function validateDate() {

    let changedDate = convertDateToEpochSecs(proj_deadline_string.value);
    return changedDate >= getCurrentDayEpochSecs();
    
}


function validateFields() {

    if(validateTitle() && validateDesc() && validateDate()) {
        submit.removeAttribute('disabled');
    }
    else
        submit.setAttribute('disabled','disabled');

}

for(let i = 0; i < fields.length; i++) {
    fields[i].addEventListener('keyup',validateFields);
    fields[i].addEventListener('input',validateFields);
}



/**
 * Add list AJAX + Validation
 */


let newListTitle = document.querySelector('table#project_lists tr#add_new_list input[name=list_title]');
let newListDesc = document.querySelector('table#project_lists tr#add_new_list textarea[name=list_desc]');
let newListDeadline = document.querySelector('table#project_lists tr#add_new_list input[name=list_deadline]');

let addListButton = document.querySelector('table#project_lists tr#add_new_list input[name=add_new_list_button]');

let proj_id = document.querySelector('form#edit_project_form > input[name=id]');

addListButton.setAttribute('disabled','disabled');

function validateNewListTitle() {
    return newListTitle.value.length > 0;
}

function validateNewListDeadLine() {

    let selectedDateForList = convertDateToEpochSecs(newListDeadline.value);

    return selectedDateForList <= convertDateToEpochSecs(proj_deadline_string.value);

}

function validateNewListFields() {

    if(validateNewListTitle() && validateNewListDeadLine()) {
        addListButton.removeAttribute('disabled');
    }
    else
        addListButton.setAttribute('disabled','disabled');

}

newListDeadline.addEventListener('input', validateNewListFields);
newListTitle.addEventListener('input', validateNewListFields);


let ajaxRequestInsertList = new XMLHttpRequest();
const api_add_list = "api_add_list.php";

addListButton.addEventListener('click',sendRequestAddList);


function sendRequestAddList() {
    
    let requestData = {list_title: newListTitle.value, 
                       list_desc: newListDesc.value,
                       list_deadline: convertDateToEpochSecs(newListDeadline.value),
                       proj_id: proj_id.value

    };

    console.log(requestData);


    ajaxRequestInsertList.open("post", api_add_list, true);
    ajaxRequestInsertList.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajaxRequestInsertList.send(encodeForAjax(requestData));

    ajaxRequestInsertList.addEventListener('load',receiveNewListFromAjax);


}

function receiveNewListFromAjax() {

    let newList = JSON.parse(this.responseText);

    console.log(newList);

    let table = document.querySelector("table#project_lists tbody");
    let trAddList = document.querySelector("table#project_lists tr#add_new_list");

    let tr = document.createElement("tr");

    let tdTitle = document.createElement('td');
    tdTitle.innerHTML = newList.tdlTitle;
    tr.appendChild(tdTitle);

    let tdDesc = document.createElement('td');
    tdDesc.innerHTML = newList.tdlDescription;
    tr.appendChild(tdDesc);

    let tdDate = document.createElement('td');
    tdDate.innerHTML = convertEpochSecsToDateString(newList.tdlDateDue);
    tr.appendChild(tdDate);

    let tdPerc = document.createElement('td');
    tdPerc.innerHTML = "0 %";
    tr.appendChild(tdPerc);


    let tdEdit = document.createElement('td');
    let tdEditLink = document.createElement('a');
    tdEditLink.setAttribute('href','edit_list.php?list_id='+newList.id);
    let tdImg = document.createElement('img');
    tdImg.setAttribute('src','images/edit.svg');

    tdEditLink.appendChild(tdImg);
    tdEdit.appendChild(tdEditLink);
    tr.appendChild(tdEdit);

    table.insertBefore(tr,trAddList);

    newListTitle.value = "";
    newListDesc.value = "";
    newListDeadline.value = proj_deadline_string.value;

    addListButton.setAttribute('disable','disabled');


}
