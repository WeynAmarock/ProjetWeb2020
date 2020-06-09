'use strict';

function ajaxRequest (type, url, callback, data = null) {
    let xhr = new XMLHttpRequest();
    if (type == 'GET' && data != null) {
        url += '?' + data;
    }
    xhr.open(type, url);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    
    xhr.onload = () => {
        switch (xhr.status) {
            case 200:
            case 201:
                // console.log(xhr.responseText);
                if(xhr.responseText.length != 0) callback(JSON.parse(xhr.responseText));                
                break;
            default:
                httpErrors(xhr.status);
        }
    };
    
    xhr.send(data);
}

function httpErrors (errorCode) {
    console.log(errorCode);
}
