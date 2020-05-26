
function prepareTable() {

    var rows = document.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

    //loop through all elements getting links
    var len = rows.length;
    for (var i = 0; i < len; i++) {

        var row = rows[i];
        ajax(row, row.getElementsByTagName("a")[0].href);
    }
}

function ajax(row, url) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {

            var response = JSON.parse(this.responseText);

            row.getElementsByClassName('title')[0].innerHTML = response.title;
            row.getElementsByClassName('time')[0].innerHTML = response.time;
        }
    };
    xhttp.open("GET", 'index.php/AjaxTitle?l=' + url, true);
    xhttp.send();
}