'use strict';

/**
 * Utils
 */

changeActiveTab(2);

function toogleElement(element, on) {

    if(on == false)
        element.setAttribute('disabled','disabled');
    else
        element.removeAttribute('disabled');

}

function toogleSendButton() {

    toogleElement(sendButton,messageTextArea.value.trim().length > 0 && !sending);

}

let messageTextArea = document.querySelector("section#chat section#send_message textarea");
let sendButton = document.querySelector("section#chat section#send_message input#send");
let messagesSection = document.querySelector("section#chat section#messages");
let newMessageSound = document.querySelector("audio#new_messages");

console.log(newMessageSound);

messagesSection.scrollTop = messagesSection.scrollHeight;

let sending = false;

let username = document.querySelector("p#username").innerHTML;
let proj_id = document.querySelector("p#proj_id").innerHTML;
let proj_name = document.querySelector("p#proj_name").innerHTML;
let last_message_id = document.querySelector("p#lastMessageId").innerHTML;


let ajaxRequestSendMessage = new XMLHttpRequest();
let ajaxRequestReceiveMessages = new XMLHttpRequest();

let send_api = "api_send_message.php";
let receive_api = "api_receive_messages.php";

toogleElement(sendButton, false);
messageTextArea.addEventListener('keyup', messageValidation);
messageTextArea.addEventListener('keypress', function(event){
    if(event.key == "Enter")
        event.preventDefault();
});

function messageValidation(event){

    if(event.key == "Enter")
        sendMessage();

    toogleSendButton();

}

sendButton.addEventListener('click', sendMessage);


function sendMessage() {

    if(messageTextArea.value.trim().length == 0 && sending)
        return;

    let message = {

        message_text: messageTextArea.value,
        message_username: username,
        message_date: getCurrentEpochSecs(),
        message_proj_id: proj_id,
        message_proj_name: proj_name

    };

    sending = true;
    toogleSendButton();
    sendAsyncAjaxRequest(ajaxRequestSendMessage, message, send_api, AJAX_REQUEST_POST, sendMessageListener);

}

function sendMessageListener() {

    let response = JSON.parse(this.responseText);
    
    if(response.error == ERROR_CODE_GOOD) {

        messageTextArea.value = "";
        toogleElement(sendButton, false);
        receiveMessages();
    }
        
    sending = false;
    toogleSendButton();

}

function receiveMessages() {

    let data = {last_message_id:last_message_id, project_id: proj_id};

    sendAsyncAjaxRequest(ajaxRequestReceiveMessages, data, receive_api, AJAX_REQUEST_GET, receiveMessagesListener);

}

function receiveMessagesListener() {

    let newMessages = JSON.parse(this.responseText);

    if(newMessages.length == 0)
        return; 

    for(let i = 0; i < newMessages.length; i++) {
        addNewMessage(newMessages[i]);
        last_message_id = newMessages[newMessages.length-1].messageId;
        
    }
    newMessageSound.play();
    
}

function addNewMessage(message) {

    let div = document.createElement('div');
    div.setAttribute('id','message');

    let img = document.createElement('img');
    let spanSender = document.createElement('span');
    spanSender.setAttribute('id','sender');
    let spanDate = document.createElement('span');
    spanDate.setAttribute('id','date');
    let spanMessage = document.createElement('span');
    spanMessage.setAttribute('id','message_body');

    img.setAttribute('src', message.userPicPath);
    spanSender.innerHTML = message.fullName;

    let date = new Date(parseInt(message.messageDate * 1000));

    spanDate.innerHTML = date.getDate() + "/" + (date.getMonth()+1) + "/" + date.getFullYear() + " " + date.getHours() + ":" + addLeadingZero(date.getMinutes()) + ":" + addLeadingZero(date.getSeconds());
    spanMessage.innerHTML = message.messageText;

    div.appendChild(img);
    div.appendChild(spanSender);
    div.appendChild(spanDate);
    div.appendChild(spanMessage);

    messagesSection.appendChild(div);

    messagesSection.scrollTop = messagesSection.scrollHeight;

}

window.setInterval(receiveMessages, 1000);



