/**
 * Created by liuwen on 2016/12/6.
 */
function ajax(method,url,data,succes) {
    var xhr = null;
    if (window.XMLHttpRequest){
        xhr = new XMLHttpRequest();
    }else {
        xhr = new ActiveXObject();
    }
    if (method == "get"){
        url += "?"+data;
    }
    xhr.open(method,url,true);
    if (method == "get"){
        xhr.send();
    }else {
        xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
        xhr.send(data);
    }

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4){
            if (xhr.status == 200){
                succes&&succes(xhr.responseText);
            }else {
                alert("出错了"+xhr.status);
            }
        }
    }
}




