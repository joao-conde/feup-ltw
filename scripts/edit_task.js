'use strict';

//===== SET ACTIVE TAB =====
changeActiveTab(1);

let title = document.querySelector('form > input[name=title');
let desc = document.querySelector('form > textarea[name=description');
let task_deadline_string = document.querySelector('form > input[name=deadline');
let responsible = document.querySelector('form > input[name=responsible');

let fields = [title,desc,task_deadline_string,responsible];

let list_deadline_secs = document.querySelector('form > input[id=list_deadline_secs');
let list_id = document.querySelector('form > input[id=list_id');

let usersList = document.querySelector("form datalist#collaborators");
let projectUsers = [];
let selectedUser = responsible.value;

let submitButton = document.querySelector("form input[type=submit]");

let ajaxRequestFindUsers = new XMLHttpRequest();
const api_find_users = "api_find_users.php";




/**
 * Utils
 */

 function convertDateToEpochSecs(dateString) {

    return new Date(dateString).getTime() / 1000;

 }

 function convertEpochSecsToDateString(seconds) {
    
    return new Date(seconds*1000).toLocaleDateString("pt-PT");
    
}


function getCurrentDayEpochSecs() {

    let time = new Date();
    let todayString = (time.getMonth() + 1) + "/" + time.getDate() +  + "/" + time.getFullYear();
    return convertDateToEpochSecs(todayString);

}

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');  
}

function sendRequestFindUsers() {
    
    let pattern = responsible.value;

    console.log(pattern);

    while (usersList.firstChild) {
        usersList.removeChild(usersList.firstChild);
    }

    if(pattern.length < 3)
        return;

    let requestData = {pattern: pattern, list_id: list_id.value};

    ajaxRequestFindUsers.open("get", (api_find_users + '?' + encodeForAjax(requestData)),true);
    ajaxRequestFindUsers.send();
    ajaxRequestFindUsers.addEventListener('load',requestUsersListener);

    selectUser();

}

function requestUsersListener() {
    
    projectUsers = JSON.parse(this.responseText);
    
    for(let i = 0; i < projectUsers.length; i++) {
        let user = document.createElement("option");
        user.setAttribute('value',projectUsers[i].fullName);
        usersList.appendChild(user);
    }

}

/**
 *  Validation
 */

function validateTitle() {
    return title.value.length > 0;
}

function validateDate() {

    let changedDate = convertDateToEpochSecs(deadline.value);
    return changedDate <= list_deadline_secs.value;
    
}

function validateResponsible() {
    return selectedUser != null;
}

function validateFields() {

    if(validateTitle() && validateDate() && validateResponsible())
        submitButton.removeAttribute('disabled');
    else
        submitButton.setAttribute('disabled','disabled');

}

function selectUser() {
    
    selectedUser = null;

    for(let i = 0; i < projectUsers.length; i++) {
        
        if(projectUsers[i].fullName == responsible.value) {
            selectedUser = projectUsers[i];

            let form = document.querySelector("form");
            let hidden_input = document.createElement("input");

            hidden_input.setAttribute('class','hidden');
            hidden_input.setAttribute('type','text');
            hidden_input.setAttribute('value',selectedUser.username);
            hidden_input.setAttribute('name', 'username_responsible');

            let old_user = document.querySelector('form input[name=username_responsible');

            if(old_user != undefined)
                form.removeChild(old_user);

            form.appendChild(hidden_input);

            break;
        }
    }

    
    validateFields();

}

for(let i = 0; i < fields.length; i++) {
    fields[i].addEventListener('keyup', validateFields);
}

responsible.addEventListener('input', selectUser);

responsible.addEventListener('keyup',sendRequestFindUsers);




