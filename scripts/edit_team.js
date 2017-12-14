let member_field = document.querySelector('section.main_area input#new_member');
let ul = document.querySelector('section.main_area ul');
let usersListSuggestions = document.querySelector('section.main_area datalist');

let project_id = document.querySelector('section.main_area input#proj_id').value;

let currentUsers = [];
let receivedUsers = [];

for(let i = 0; i < ul.children.length; i++) {

    let li = ul.children[i];
    let username = li.querySelector('input[id="username').value;
    let fullName = li.querySelector('input[id="fullName').value;

    let del_button = li.querySelector('button#delete_member');

    del_button.addEventListener('click', addRemoveMember.bind(this,username,0));

    currentUsers.push({username:username, fullName: fullName});

}

/**
 * utils
 */

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');  
}


let ajaxRequestFindUsers = new XMLHttpRequest();
let ajaxRequestAddUser = new XMLHttpRequest();
let ajaxRequestDeleteUser = new XMLHttpRequest();

const api_find_users = 'api_find_users.php';
const api_add_remove = 'api_add_remove_project_member.php';

function sendRequestFindUsers() {
    
    let pattern = member_field.value;

    while (usersListSuggestions.firstChild) {
        usersListSuggestions.removeChild(usersListSuggestions.firstChild);
    }

    if(pattern.length < 3)
        return;

    let requestData = {pattern: pattern, list_id: "null"};

    ajaxRequestFindUsers.open("get", (api_find_users + '?' + encodeForAjax(requestData)),true);
    ajaxRequestFindUsers.send();
    ajaxRequestFindUsers.addEventListener('load',requestUsersListener);

}

function requestUsersListener() {
    
    receivedUsers = JSON.parse(this.responseText);

    for(let i = 0; i < receivedUsers.length; i++) {
        let user = document.createElement("option");
        user.setAttribute('value',receivedUsers[i].fullName);
        usersListSuggestions.appendChild(user);
    }

}

function addRemoveMember(username,add_del,event) {

    let requestData = {username:username, proj_id:project_id, add_del:add_del};
    
    ajaxRequestAddUser.open("post", api_add_remove, true);
    ajaxRequestAddUser.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajaxRequestAddUser.send(encodeForAjax(requestData));

    ajaxRequestAddUser.addEventListener('load',receiveAjaxResponseAddDel);

}

console.log(currentUsers);

function receiveAjaxResponseAddDel() {

    let response = JSON.parse(this.responseText);

    if(response.add_del == 1) {

        for(let i = 0; i < receivedUsers.length; i++) {
            
            if(response.username == receivedUsers[i].username) {
                currentUsers.push(receivedUsers[i]);
    
                let li = document.createElement('li');
                li.innerHTML = receivedUsers[i].fullName;

                let inputUsername = document.createElement('input');
                inputUsername.setAttribute('type','text');
                inputUsername.setAttribute('id','username');
                inputUsername.setAttribute('value',response.username);
                inputUsername.setAttribute('class','hidden');

                li.appendChild(inputUsername);
    
                let img = document.createElement('img');
                img.setAttribute('src', receivedUsers[i].userPicturePath);
    
                li.appendChild(img);
                ul.appendChild(li);
    
                let button = document.createElement('button');

                button.addEventListener('click',addRemoveMember.bind(this,response.username,0));

                li.appendChild(button);

        
                member_field.value="";
    
                break;
            }
    
        }

        console.log(currentUsers);

    }

    else {

        console.log(currentUsers);

        for(let i = 0; i < currentUsers.length; i++) {
            
            if(response.username == currentUsers[i].username) {
                
                console.log(response.username);

                currentUsers.splice(i,1);

                let inputUsername = document.querySelector('section.main_area input[value=' + response.username + ']');
                
                console.log(inputUsername.parentElement);
                console.log(inputUsername.parentNode);
                
                ul.removeChild(inputUsername.parentElement);
    
                break;
            }
    
        }

    }

    


}

function selectUser(event) {

    let fullName = event.srcElement.value;

    for(let i = 0; i < currentUsers.length; i++) {

        if(fullName == currentUsers[i].fullName)
            return;
    }


    for(let i = 0; i < receivedUsers.length; i++) {

        if(fullName == receivedUsers[i].fullName) {
            
            addRemoveMember(receivedUsers[i].username,1,null);

            // currentUsers.push(receivedUsers[i]);

            // let li = document.createElement('li');
            // li.innerHTML = fullName;

            // let img = document.createElement('img');
            // img.setAttribute('src', receivedUsers[i].userPicturePath);

            // li.appendChild(img);
            // ul.appendChild(li);

            // let button = document.createElement('button');
            // li.appendChild(button);

            // member_field.value="";

            

            break;
        }

    }

    //console.log(currentUsers);

}



member_field.addEventListener('keyup',sendRequestFindUsers);
member_field.addEventListener('input',selectUser);