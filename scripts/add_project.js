'use strict';
//===== SET ACTIVE TAB =====
changeActiveTab(2);

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
    let todayString = (time.getMonth() + 1) + "/" + time.getDate() + "/" + time.getFullYear();

    let seconds = convertDateToEpochSecs(todayString);

    return seconds;

}

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');  
}



let title = document.querySelector('form > input[name="title');
let deadline = document.querySelector('form > input[name="deadline');
let desc = document.querySelector('form > textarea[name=description]');
let submit = document.querySelector('form > input[type="submit');

submit.setAttribute('disabled','disabled');

let fields = [title,deadline,desc];



for(let i = 0; i < fields.length; i++)
    fields[i].addEventListener('input',validateFields);

/**
 * Validations
 */


function validateTitle() {
    return title.value.length > 0;
}

function validateDesc() {
    return desc.value.length > 0;
}

function validateDate() {

    let selectedDate = convertDateToEpochSecs(deadline.value);
    let isFuture = selectedDate >= getCurrentDayEpochSecs();
    return isFuture;
    
}

function validateFields() {

    if(validateTitle() && validateDesc() && validateDate())
        submit.removeAttribute('disabled');
    else
        submit.setAttribute('disabled','disabled');
}


/**
 * ajax to get users
 */


const api_find_users = "api_find_users.php";
let collaborator = document.querySelector("form input[name=collaborators");
let usersList = document.querySelector("form datalist#collaborators");

let projectUsers = [];
let selectedUsers = [];

let ajaxRequestFindUsers = new XMLHttpRequest();

function sendRequestFindUsers() {
    
    let pattern = collaborator.value;

    while (usersList.firstChild) {
        usersList.removeChild(usersList.firstChild);
    }

    if(pattern.length < 3)
        return;

    let requestData = {pattern: pattern, list_id: "null"};

    ajaxRequestFindUsers.open("get", (api_find_users + '?' + encodeForAjax(requestData)),true);
    ajaxRequestFindUsers.send();
    ajaxRequestFindUsers.addEventListener('load',requestUsersListener);

}

function requestUsersListener() {

    projectUsers = JSON.parse(this.responseText);

    console.log(projectUsers);
    console.log(usersList);
    
    for(let i = 0; i < projectUsers.length; i++) {
        let user = document.createElement("option");
        user.setAttribute('value',projectUsers[i].fullName);
        usersList.appendChild(user);
    }

}

function addUser() {

    for(let i = 0; i < projectUsers.length; i++) {
        
        if(projectUsers[i].fullName == collaborator.value) {
            
            let selectedUser = projectUsers[i];
            if(selectedUsers.indexOf(selectedUser) != -1)
                return;

            selectedUsers.push(selectedUser);
            updateUsersList(selectedUser,true);

            collaborator.value = "";

            break;
        }
    }

}

function updateUsersList(user, added,event) {

    let select = document.querySelector("form > select[id=selectCollaborator");
    let ul = document.querySelector("form > ul");

    if(added) {

        let option = document.createElement('option');
        option.setAttribute('value',user.username);
        option.setAttribute('selected','true');
        select.appendChild(option);

       
        let li = document.createElement('li');
        li.setAttribute('id',user.username);
        li.innerHTML = user.fullName;

        let img = document.createElement('img');
        img.setAttribute('src',user.userPicturePath);
        li.appendChild(img);

        let deleteButton = document.createElement('button');

        deleteButton.addEventListener('click',updateUsersList.bind(this,user,false));

        li.appendChild(deleteButton);

        ul.appendChild(li);

    }

    else if(added == false) {

        event.preventDefault();

        let username = user.username;

        let li_to_delete = ul.querySelector("li[id=" + username + "]");
        let option_to_delete = select.querySelector("option[value=" + username + "]");
        
        ul.removeChild(li_to_delete);
        select.removeChild(option_to_delete);

    }

}


collaborator.addEventListener('keyup',sendRequestFindUsers);
collaborator.addEventListener('input',addUser);
