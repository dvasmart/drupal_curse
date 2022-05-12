let element = document.getElementById('authorization');

function sendReqest(login, password) {
    const xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);

            if(response["success"]) {
                Swal.fire({
                    title: "Success!",
                    text: response["message"],
                    icon: "success",
                }).then(function() {
                    document.location.reload();
                });                        
            } else {
                Swal.fire({
                    title: "Error!",
                    text: response["message"],
                    icon: "error",
                });
            }
        }
    };

    xmlhttp.open("POST", "testreg.php", true);

    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader("Cache-Control", "no-cache");

    xmlhttp.send("login=" + login + "&" + "password=" + password);
}

if (element !== null) {
        element.onsubmit = function(e) {

        e.preventDefault();
        
        let login = document.getElementById('login').value;
        let password = document.getElementById('password').value;

        sendReqest(login, password);

    };
}
    
function sendReqestChecked(id, done) {
    const xmlhttp = new XMLHttpRequest();

    done ? done = 1 : done = 0;

    xmlhttp.open("POST", "checked.php", true);

    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader("Cache-Control", "no-cache");

    xmlhttp.send("id=" + id + "&" + "done=" + done);
}

var inputs = document.querySelectorAll("input[type='checkbox']");

for(var i = 0, len = inputs.length; i < len; i++) {
    inputs[i].onclick = function() {
        sendReqestChecked(this.id, this.checked);
    }
}