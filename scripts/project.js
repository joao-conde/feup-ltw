'use strict';

let title = document.querySelector('form > input[name=title');
let desc = document.querySelector('form > textarea[name=description');
let deadline = document.querySelector('form > input[name=deadline');
let submit = document.querySelector('form > input[type=submit');
let projdeadline = parseInt(document.querySelector('form > input[name=projectdeadline').value) * 1000;

let completition_slider = document.querySelector("table#tasks_list input[type=range]");
let completition_slider_label = document.querySelector("table#tasks_list label[for=compl]");

let responsible = document.querySelector("table#tasks_list tr#add_new_task td input[name=task_responsable");
let usersList = document.querySelector("table#tasks_list tr#add_new_task td ul#suggestions");

console.log(usersList);

let ajaxRequestFindUsers = new XMLHttpRequest();


const api_find_users = "api_find_users.php";

function getlastTaskTime() {

    let table_rows = document.querySelector('table#tasks_list').getElementsByTagName('tr');

    let lasttime = 0;

    for(let i = 1; i < table_rows.length-1; i++) {

        let new_t = new Date(parseInt(table_rows[i].querySelector('td#taskdeadline').innerHTML)*1000).getTime();
        if(new_t > lasttime)
            lasttime = new_t;
    }

    return lasttime;

}


function validateTitle() {
    return title.value.length > 0;
}

function validateDesc() {
    return desc.value.length > 0;
}

function validateDate() {

    let listdeadline = new Date(deadline.value).getTime();
    let lastTaskTime = getlastTaskTime();
    return projdeadline >= listdeadline && listdeadline >= lastTaskTime;
}

function validateFields() {
    if(validateTitle() && validateDesc() && validateDate())
        submit.removeAttribute('disabled');
    else
        submit.setAttribute('disabled','disabled');
}

function showCompl() {

    completition_slider_label.innerHTML = completition_slider.value;
}

completition_slider.addEventListener('input',showCompl);


title.addEventListener('keyup',validateFields);
desc.addEventListener('keyup',validateFields);
deadline.addEventListener('keyup',validateFields);



function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');  
}

function sendRequestFindUsers() {

    let pattern = responsible.value;

    while (usersList.firstChild) {
        usersList.removeChild(usersList.firstChild);
    }

    if(pattern.length < 3)
        return;


    //ajaxRequestFindUsers.abort();
    let requestData = {pattern: pattern};

    ajaxRequestFindUsers.open("get", (api_find_users + '?' + encodeForAjax(requestData)),true);
    ajaxRequestFindUsers.send();
    ajaxRequestFindUsers.addEventListener('load',requestUsersListener);

}

function requestUsersListener() {
    
    let users = JSON.parse(this.responseText);
    
    

    for(let i = 0; i < users.length; i++) {
        let user = document.createElement("li");
        user.innerHTML = users[i].fullName;
        usersList.appendChild(user);
    }

}

responsible.addEventListener('keyup', sendRequestFindUsers);


