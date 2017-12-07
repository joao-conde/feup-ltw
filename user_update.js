'use strict';


let registerSelector = 'form#registrationForm input[type=submit]';
let submitButton = document.querySelector(registerSelector);

let usernameSelector = 'form#registrationForm input[name=username]';
let pwdSelector = 'form#registrationForm input[name=password]';
let rpwdSelector = 'form#registrationForm input#repeatPassword';
let oldPasswordSelector = 'form#registrationForm input#oldpwd';
let fullNameSelector = 'form#registrationForm input[name=fullname]';
let profileSelector = 'form#registrationForm input[name=profileImage]';
let imageSelector = 'form#registrationForm img#profilePicture';

let usernameTextField = document.querySelector(usernameSelector);
let pwdTextField = document.querySelector(pwdSelector);
let rpwdTextField = document.querySelector(rpwdSelector);
let oldPwdTextField = document.querySelector(oldPasswordSelector);
let fullNameTextField = document.querySelector(fullNameSelector);
let picture = document.querySelector(imageSelector);

pwdTextField.addEventListener('keypress', preventSpaces);
rpwdTextField.addEventListener('keypress', preventSpaces);
usernameTextField.addEventListener('keypress', preventSpaces);
oldPwdTextField.addEventListener('keypress',preventSpaces);

let profilePictureField = document.querySelector(profileSelector);
profilePictureField.addEventListener('change',validateProfilePicture);

let textFields = [usernameTextField,pwdTextField,rpwdTextField,fullNameTextField,oldPwdTextField];

submitButton.setAttribute('disabled','disabled');

for(let i = 0; i < textFields.length; i++) {
    textFields[i].addEventListener('keyup',validateFields);
    textFields[i].addEventListener('onchange',validateFields);
}

function enableSubmitButton(enabled) {
    if(enabled)
        submitButton.removeAttribute('disabled');
    else
        submitButton.setAttribute('disabled','disabled');
}

function validateUserName() {

     if(usernameTextField.value.length >= 3) {
         usernameTextField.setAttribute('value',usernameTextField.value.toLowerCase());
         return true;
     }
    
}

function validateOldPassword() {

    return oldPwdTextField.value.length >= 5;

}

function validatePassword() {

    let size = pwdTextField.value.length >= 5;
    let same = pwdTextField.value == rpwdTextField.value;
    console.log(size);
    console.log(same);
    return ((size == true) && same) || (pwdTextField.value.length == 0 && same);

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

    enableSubmitButton(validateUserName() && validatePassword() && validateFullName() && validateOldPassword());
     
}

function validateProfilePicture() {

    let files = profilePictureField.files;

    console.log(files);

    if(files.length > 0) {

        let file = files[0];

        if(file.type == 'image/jpeg' || file.type == 'image/gif' || file.type == 'image/png'){
            picture.src = URL.createObjectURL(file);
            return true;
        }

        let errorMessage = document.createElement('p');
        errorMessage.innerHTML = "Please select an image (.png,.jpg,.gif)";

        let form = document.querySelector("section#main_area form");
        form.insertBefore(errorMessage,submitButton);

        picture.removeAttribute('src');

        return false;

    }

    return true;

}

function preventSpaces(event) {
    let key = event.keyCode;
    if(key == 32)
        event.preventDefault();
}

