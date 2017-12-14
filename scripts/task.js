
//===== SET ACTIVE TAB =====
changeActiveTab(0);

// ===========  HANDLE TASKS TABLE  ===========
let tbody_my_tasks = document.querySelector('table#my_tasks > tbody');

 //===== Ordenation of columns =====
columnsOrdenation();
function columnsOrdenation(){
    let divs_order_by = tbody_my_tasks.querySelectorAll("div.div_order_by");
    console.log(divs_order_by);
    for (let i = 0; i < divs_order_by.length; i++) {
        const orderBy = divs_order_by[i].id;
        if (orderBy) {
            divs_order_by[i].addEventListener('click', sendRequestOrderingTasksBy.bind(this, orderBy));
        }
    }
}

 //===== Setup Tasks user interface =====

setupTasksUserInterface();
function setupTasksUserInterface(){
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
}

function showCompl(input, label) {

    label.innerHTML = input.value;
}

// ===========  HANDLE HIDDEN COMPLETED CHECKBOX  ===========

let show_completed_checkbox = tbody_my_tasks.querySelector('input#show_completed');
show_completed_checkbox.addEventListener('change', hiddenCompletedTasks);

hiddenCompletedTasks(); //Default hidden.
function hiddenCompletedTasks(){

    hidden = document.querySelector('input#show_completed').checked;
    console.log(hidden);

    for (let i = 1; i < tbody_my_tasks.childElementCount; i++) {
        let row = tbody_my_tasks.children[i];

        if (row.querySelector('td.range > input').value == 100){
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

    let requestData = {
        percentage: input.value,
        taskID: input.id
    };

    // Changes in database
    ajaxRequestChangeTaskCompletion.open("post", api_change_task_completion, true);
    ajaxRequestChangeTaskCompletion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajaxRequestChangeTaskCompletion.send(encodeForAjax(requestData));

    // Changes in table
    let row = input.parentNode.parentNode;
    let semaphore = row.querySelector('div#task_semaphore');
    semaphore.setAttribute('style', "background-color: hsl(" + input.value + ", 100%, 50%)");

}


let ajaxRequestOrderingTasksBy = new XMLHttpRequest();
let api_ordering_tasks_by = "api_ordering_tasks_by.php";

function sendRequestOrderingTasksBy(orderBy){

    let requestData = {
        order_by: orderBy
    }

    ajaxRequestOrderingTasksBy.open('post', api_ordering_tasks_by, true);
    ajaxRequestOrderingTasksBy.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajaxRequestOrderingTasksBy.send(encodeForAjax(requestData));

    ajaxRequestOrderingTasksBy.addEventListener('load', loadRequestOrderingTasksBy);

}

function loadRequestOrderingTasksBy(){

    let newTasks = JSON.parse(this.responseText);

    let my_tasks = document.querySelector('table#my_tasks > tbody');
    while (my_tasks.children[1]) {
        my_tasks.removeChild(my_tasks.children[1]);
    }

    for (let i = 0; i < newTasks.length; i++) {
        const task = newTasks[i];
        
        let tr = document.createElement("tr");

        let taskTitle = document.createElement("td");
        taskTitle.innerHTML = task.taskTitle;
        tr.appendChild(taskTitle);

        let taskDesc = document.createElement("td");
        taskDesc.innerHTML = task.taskDescription;
        taskDesc.setAttribute('class','mobileHidden');
        tr.appendChild(taskDesc);

        let taskDate = document.createElement("td");
        taskDate.innerHTML = new Date(parseInt(task.taskDateDue) * 1000).toLocaleDateString("pt-PT");
        tr.appendChild(taskDate);

        let taskCompletion = document.createElement("td");
        taskCompletion.setAttribute('class', 'range');

        let taskSlider = document.createElement("input");
        taskSlider.setAttribute('id', task.id);
        taskSlider.setAttribute('type', 'range');
        taskSlider.setAttribute('min', '0');
        taskSlider.setAttribute('max', '100');
        taskSlider.setAttribute('step', '5');
        taskSlider.setAttribute('name', 'task_completition');
        taskSlider.setAttribute('value', task.percentageCompleted);

        let taskSliderLabel = document.createElement("label");
        taskSliderLabel.setAttribute("for", "compl");
        taskSliderLabel.innerHTML = task.percentageCompleted;

        taskCompletion.appendChild(taskSlider);
        taskCompletion.appendChild(taskSliderLabel);
        taskCompletion.innerHTML += '%';
        tr.appendChild(taskCompletion);

        let taskTdlTitle = document.createElement("td");
        let taskTdlLink = document.createElement("a");
        taskTdlLink.setAttribute("href", "#");
        taskTdlLink.innerHTML = task.tdlTitle;
        taskTdlTitle.appendChild(taskTdlLink);
        taskTdlTitle.setAttribute('class','mobileHidden');
        tr.appendChild(taskTdlTitle);


        let taskSemaphore = document.createElement("td");
        let taskSemaphoreDiv = document.createElement("div");
        taskSemaphoreDiv.setAttribute("id", "task_semaphore");
        taskSemaphore.appendChild(taskSemaphoreDiv);
        tr.appendChild(taskSemaphore);

        my_tasks.appendChild(tr);

    }

    // Setup tasks ui
    hiddenCompletedTasks();
    setupTasksUserInterface();

    
}   