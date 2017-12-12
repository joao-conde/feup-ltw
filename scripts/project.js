'use strict';

let title = document.querySelector('section#projects_list table#projects tr#add_new_project input[name=proj_title');
let desc = document.querySelector('section#projects_list table#projects tr#add_new_project textarea[name=proj_desc');
let deadline = document.querySelector('section#projects_list table#projects tr#add_new_project input[name=proj_deadline');
let submit = document.querySelector('section#projects_list table#projects tr#add_new_project input[type=button');
// let projdeadline = parseInt(document.querySelector('form > input[name=proj_deadline').value) * 1000;
let user = document.querySelector('section#projects_list table#projects tr#add_new_project input[name=proj_responsable');
// let completition_slider = document.querySelector("table#projects tr#add_new_project input[type=range]");
// let completition_slider_label = document.querySelector("table#projects tr#add_new_project label[for=compl]");

let responsible = document.querySelector("table#projects tr#add_new_project td input[name=proj_responsable");
// let usersList = document.querySelector("table#tasks_list tr#add_new_task td ul#suggestions");

let ajaxRequestInsertProject = new XMLHttpRequest();

const api_add_project = "api_add_project.php";

function validateTitle() {
    return title.value.length > 0;
}

function validateDesc() {
    return desc.value.length > 0;
}


function validateFields() {
    if(validateTitle() && validateDesc())
        submit.removeAttribute('disabled');
    else
        submit.setAttribute('disabled','disabled');
}

function showCompl() {

    completition_slider_label.innerHTML = completition_slider.value;
}


title.addEventListener('keyup',validateFields);
desc.addEventListener('keyup',validateFields);
deadline.addEventListener('keyup',validateFields);


function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');  
}


function receiveNewProjectFromAjax() {
    
    

      
       

        let table = document.querySelector("table#projects tbody");
        let trAddProject = document.querySelector("table#projects tr#add_new_project");
        console.log(this.responseText);
        let newProject = JSON.parse(this.responseText);
    
        console.log(newProject);
        
        let tr = document.createElement("tr");
    
        let tdTitle = document.createElement("td");
        tdTitle.innerHTML = newProject.project_title;
        tr.appendChild(tdTitle);
    
        let tdDesc = document.createElement("td");
        tdDesc.innerHTML = newProject.project_desc;
        tr.appendChild(tdDesc);
    
    
        let tdDate = document.createElement("td");
        tdDate.innerHTML = new Date(parseInt(newProject.project_deadline)*1000).toLocaleDateString("pt-PT");
        tr.appendChild(tdDate);
        
        let tdUserName = document.createElement("td");
        tdUserName.innerHTML = newProject.project_user;
        tr.appendChild(tdUserName);
    
        let tdUserImage = document.createElement("td");
        let image = document.createElement("img");
        image.setAttribute('src',newProject.userPicturePath);
        tdUserImage.appendChild(image);
        tr.appendChild(tdUserImage);
        
        //table.insertBefore(tr,trAddProject);
    
        // let label = table.querySelector("label[for=compl]");
    
        // newTaskTitle.value = "";
        // newTaskDesc.value = "";
        // newTaskPercentage.value = "0";
        // newTaskDeadLine.value = new Date(projdeadline).toISOString().substring(0,10);
        // responsible.value = "";
    
        // label.innerHTML = "0";
    
    }


function sendRequestAddProject() {
 
    let requestData = {
         title: title.value,  
         desc: desc.value,
         username: user.value,
         deadline: new Date(deadline.value).getTime() / 1000
     };


    console.log(requestData);
    
    ajaxRequestInsertProject.open("post", api_add_project, true);
    ajaxRequestInsertProject.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajaxRequestInsertProject.send(encodeForAjax(requestData));
    
    ajaxRequestInsertProject.addEventListener('load',receiveNewProjectFromAjax);
    
}


submit.addEventListener('click', sendRequestAddProject);