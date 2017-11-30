'use strict';


let registerSelector = 'form#registrationForm input[value=Register]';
let submitButton = document.querySelector(registerSelector);

let usernameSelector = 'form#registrationForm input[name=username]';
let pwdSelector = 'form#registrationForm input[name=password]';
let rpwdSelector = 'form#registrationForm input#repeatPassword';
let fullNameSelector = 'form#registrationForm input[name=fullname]';


let usernameTextField = document.querySelector(usernameSelector);
let pwdTextField = document.querySelector(pwdSelector);
let rpwdTextField = document.querySelector(rpwdSelector);
let fullNameTextField = document.querySelector(fullNameSelector);

let textFields = [usernameTextField,pwdTextField,rpwdTextField,fullNameTextField];


submitButton.setAttribute('disabled','disabled');

for(let i = 0; i < textFields.length; i++) {
    textFields[i].addEventListener('keyup',validateFields);
}

function enableSubmitButton(enabled) {
    if(enabled)
        submitButton.removeAttribute('disabled');
    else
        submitButton.setAttribute('disabled','disabled');
}

function validateUserName() {

     if(usernameTextField.value.length >= 3) {
         console.log(usernameTextField.value.toLowerCase());
         usernameTextField.setAttribute('value',usernameTextField.value.toLowerCase());
         return true;
     }
    
}

function validatePassword() {

    let size = pwdTextField.value.length >= 5;
    let same = pwdTextField.value == rpwdTextField.value;
    return (size && same);

}

function validateFullName() {

    let fullName = fullNameTextField.value.replace(/\s\s+/g, ' ').trim();
    let allNames = fullName.split(" ");
    if(allNames.length > 1) {

        for(let i = 0; i < allNames.length; i++)
            if(allNames[i].length < 2)
                return false;

        fullNameTextField.setAttribute('value',fullName);
        return true;
    }
    return false;
}

function validateFields() {

    enableSubmitButton(validateUserName() && validatePassword() && validateFullName());
     
}

