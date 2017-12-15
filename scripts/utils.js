const AJAX_REQUEST_GET = "get";
const AJAX_REQUEST_POST = "post";

const ERROR_CODE_GOOD = "00000";

function changeActiveTab(index) {
    menu_items = document.querySelectorAll("nav#menu li");

        for (let i = 0; i < menu_items.length; i++) {
        let item = menu_items[i];

        if (i == index)
            item.classList.add("active");
        else
            item.classList.remove("active");
    }
}

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

function getCurrentEpochSecs() {

    return parseInt(new Date().getTime()/1000);

}

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');  
}

function sendAsyncAjaxRequest(request, data, api, type, receiveListener) {


    if(type == AJAX_REQUEST_GET) {

        request.open(type, (api + '?' + encodeForAjax(data)),true);
        request.send();

    }

    else {

        request.open(type, api, true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.send(encodeForAjax(data));

    }

    if(receiveListener != undefined) {

        request.addEventListener('load',receiveListener);

    }

}

function addLeadingZero(number) {

    if(number < 10)
        return "0" + number;
    return number;

}