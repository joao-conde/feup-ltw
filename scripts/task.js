
// ===========  HANDLE SLIDER  ===========
let tbody_my_tasks = document.querySelector('table#my_tasks > tbody');

for (let i = 1; i < tbody_my_tasks.childElementCount; i++) {
    const row = tbody_my_tasks.children[i];

    //===== Linteners of slider =====
    let input = row.querySelector('td.range > input');
    let label = row.children[3].children[1];

    input.addEventListener('input', showCompl.bind(this, input, label));
    input.addEventListener('change', sendRequestChangePercentageCompleted.bind(this, input));


    //===== Color of Semaphore =====
    let semaphore = row.querySelector('div#task_semaphore');
    semaphore.setAttribute('style', "background-color: hsl(" + input.value + ", 100%, 50%)");

}

function showCompl(input, label) {

    label.innerHTML = input.value;
}

// ===========  HANDLE HIDDEN COMPLETED CHECKBOX  ===========

let show_completed_checkbox = tbody_my_tasks.querySelector('input#show_completed')
console.log(show_completed_checkbox);
show_completed_checkbox.addEventListener('change', hiddenCompletedTasks);

hiddenCompletedTasks(); //Default hidden.
function hiddenCompletedTasks(){

    hidden = document.querySelector('input#show_completed').checked;
    console.log(hidden);

    for (let i = 1; i < tbody_my_tasks.childElementCount; i++) {
        let row = tbody_my_tasks.children[i];

        if (row.querySelector('td.range > input').getAttribute('value') == 100){
            
            if(hidden) 
                row.style.display = 'none';
            else
                row.style.display = 'table-row';


        }
        
    }
}

// ===========  AJAX REQUESTS  ===========

function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}


let ajaxRequestChangeTaskCompletion = new XMLHttpRequest();
let api_change_task_completion = "api_change_task_completion.php";

function sendRequestChangePercentageCompleted(input) {

    console.log(input);
    let requestData = {
        percentage: input.value,
        taskID: input.id
    };

    ajaxRequestChangeTaskCompletion.open("post", api_change_task_completion, true);
    ajaxRequestChangeTaskCompletion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajaxRequestChangeTaskCompletion.send(encodeForAjax(requestData));

    let semaphore = input.parentNode.parentNode.querySelector('div#task_semaphore');
    semaphore.setAttribute('style', "background-color: hsl(" + input.value + ", 100%, 50%)");

}