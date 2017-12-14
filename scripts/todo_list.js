'use strict';

//===== SET ACTIVE TAB =====
changeActiveTab(1);


let title = document.querySelector('form > input[name=title');
let desc = document.querySelector('form > textarea[name=description');
let deadline = document.querySelector('form > input[name=deadline');
let submit = document.querySelector('form > input[type=submit');
let projdeadline = parseInt(document.querySelector('form > input[name=projectdeadline').value) * 1000;

let completition_slider = document.querySelector("table#tasks_list input[type=range]");
let completition_slider_label = document.querySelector("table#tasks_list label[for=compl]");

let projectUsers = [];
let selectedUser = null;

let responsible = document.querySelector("table#tasks_list tr#add_new_task td input[name=task_responsable");
let usersList = document.querySelector("table#tasks_list tr#add_new_task td datalist#collaborators");

let list_id = parseInt(document.querySelector("form > input#id").value);

let ajaxRequestFindUsers = new XMLHttpRequest();
let ajaxRequestInsertTask = new XMLHttpRequest();
let ajaxRequestDeleteTask = new XMLHttpRequest();


const api_find_users = "api_find_users.php";
const api_add_task = "api_add_task.php";
const api_delete_task = "api_delete_task.php";

const GOOD_ACTION_DB = '00000';

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

/*****
 *  Tasks table
 *******/

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

    let requestData = {pattern: pattern, list_id: list_id};

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

responsible.addEventListener('keyup', sendRequestFindUsers);
responsible.addEventListener('input', selectUser);


let addButton = document.querySelector('table#tasks_list tr#add_new_task input[type=button');
let newTaskTitle = document.querySelector('table#tasks_list tr#add_new_task input[name=task_title');
let newTaskDesc = document.querySelector('table#tasks_list tr#add_new_task textarea[name=task_desc');
let newTaskPercentage = document.querySelector('table#tasks_list tr#add_new_task input#compl');
let newTaskDeadLine = document.querySelector('table#tasks_list tr#add_new_task input[name=task_deadline');

let newTaskFields = [addButton,newTaskTitle,newTaskPercentage,newTaskDeadLine,responsible];

addButton.setAttribute('disabled', 'disabled');


function validateTaskName() {

    return newTaskTitle.value.length >= 3;

}

function validateTaskDeadLine() {

    let task_deadline = new Date(newTaskDeadLine.value);
    let time = task_deadline.getTime();    
    return time <= new Date(deadline.value).getTime();

}

function validateTaskResponsable() {

    return selectedUser != null;
}

function selectUser() {

    selectedUser = null;

    for(let i = 0; i < projectUsers.length; i++) {
        
        if(projectUsers[i].fullName == responsible.value) {
            selectedUser = projectUsers[i];
            break;
        }
    }

    
    validateTaskFields();

}


function validateTaskFields() {

    if(validateTaskName() && validateTaskDeadLine() && validateTaskResponsable())
        addButton.removeAttribute('disabled');
    else
        addButton.setAttribute('disabled', 'disabled');

}




for(let i = 0; i < newTaskFields.length; i++) {
    newTaskFields[i].addEventListener('keyup', validateTaskFields);
}



function sendRequestAddTask() {
    
    let requestData = {title: newTaskTitle.value, 
                       list_id: list_id, 
                       user: selectedUser.username, 
                       desc: newTaskDesc.value,
                       deadline: new Date(newTaskDeadLine.value).getTime() / 1000,
                       percentage: newTaskPercentage.value

    };

    ajaxRequestInsertTask.open("post", api_add_task, true);
    ajaxRequestInsertTask.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajaxRequestInsertTask.send(encodeForAjax(requestData));

    ajaxRequestInsertTask.addEventListener('load',receiveNewTaskFromAjax);

}

function receiveNewTaskFromAjax() {

    let table = document.querySelector("table#tasks_list tbody");
    let trAddTask = document.querySelector("table#tasks_list tr#add_new_task");

    let newTask = JSON.parse(this.responseText);
    
    let tr = document.createElement("tr");

    let tdId = document.createElement("td");
    tdId.setAttribute('id','task_id');
    tdId.setAttribute('class','hidden');
    tdId.innerHTML = newTask.id;

    tr.appendChild(tdId);

    let tdTitle = document.createElement("td");
    tdTitle.innerHTML = newTask.taskTitle;
    tr.appendChild(tdTitle);

    let tdDesc = document.createElement("td");
    tdDesc.innerHTML = newTask.taskDescription;
    tr.appendChild(tdDesc);

    let tdPercentage = document.createElement("td");
    tdPercentage.innerHTML = newTask.percentageCompleted + "%";
    tr.appendChild(tdPercentage);

    let tdDate = document.createElement("td");
    tdDate.innerHTML = new Date(parseInt(newTask.taskDateDue)*1000).toLocaleDateString("pt-PT");
    tr.appendChild(tdDate);

    let tdDateNumber = document.createElement("td");
    tdDateNumber.innerHTML = parseInt(newTask.taskDateDue)*1000;
    tdDateNumber.setAttribute('id','taskdeadline');
    tr.appendChild(tdDateNumber);

    let tdUserName = document.createElement("td");
    tdUserName.innerHTML = newTask.fullName;
    tr.appendChild(tdUserName);

    let tdUserImage = document.createElement("td");
    let image = document.createElement("img");
    image.setAttribute('src',newTask.userPicturePath);
    tdUserImage.appendChild(image);
    tr.appendChild(tdUserImage);
    
    let tdEditButton = document.createElement("td");
    let editLink = document.createElement("a");
    editLink.setAttribute('href',"edit_task.php?task_id=" + newTask.id);
    let editImage = document.createElement('img');

    editImage.setAttribute('src','images/edit.svg');
    editLink.appendChild(editImage);
    tdEditButton.appendChild(editLink);

    tr.appendChild(tdEditButton);

    let tdDeleteButton = document.createElement("td");
    let deleteLink = document.createElement("a");
    deleteLink.setAttribute('href','');
    let deleteImage = document.createElement('img');
    deleteImage.setAttribute('src','images/delete.svg');

    deleteLink.appendChild(deleteImage);
    tdDeleteButton.appendChild(deleteLink);

    deleteLink.addEventListener('click',sendAjaxRequestDeleteTask.bind(newTask.id));

    tr.appendChild(tdDeleteButton);

    table.insertBefore(tr,trAddTask);


    let label = table.querySelector("label[for=compl]");

    newTaskTitle.value = "";
    newTaskDesc.value = "";
    newTaskPercentage.value = "0";
    newTaskDeadLine.value = new Date(deadline.value).toISOString().substring(0,10);
    responsible.value = "";

    addButton.setAttribute('disabled','disabled');

    label.innerHTML = "0";

}

addButton.addEventListener('click',sendRequestAddTask);




/**
 * Delete Task
 */


let table = document.querySelector('table#tasks_list').childNodes[1];

for(let i = 1; i < table.childNodes.length-1; i++) {

    let tr = table.childNodes[i];

    if(!(tr instanceof Element))
        continue;

    let id = tr.querySelector("td#task_id").innerHTML;
    let delete_task_button = tr.querySelector("td > a#delete_task_button");

    delete_task_button.addEventListener("click",sendAjaxRequestDeleteTask.bind(id)); //binded this to id (wow js is awesome)

}


function sendAjaxRequestDeleteTask(event) {

    event.preventDefault();
    let task_id = this;  // wow javascript is awesome

    let requestData = {task_id: this };

    ajaxRequestDeleteTask.open("post", api_delete_task, true);
    ajaxRequestDeleteTask.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajaxRequestDeleteTask.send(encodeForAjax(requestData));

    ajaxRequestDeleteTask.addEventListener('load',receiveAjaxResponseDeleteTask);

}

function receiveAjaxResponseDeleteTask() {

    let response = JSON.parse(this.responseText);

    if(response.error == GOOD_ACTION_DB)
        deleteTaskFromTableHTML(response.task_id);

}

function deleteTaskFromTableHTML(task_id) {


    for(let i = 1; i < table.childNodes.length-1; i++) {
        
        let tr = table.childNodes[i];

        if(!(tr instanceof Element))
            continue;

        let td_id = tr.querySelector("td#task_id");
        
        console.log(td_id.innerHTML);
        console.log(task_id);

        if(td_id.innerHTML == task_id) {
            table.removeChild(tr);
            return;
        }
        
    }

}


