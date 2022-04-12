<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    
    <!-- bootstrap cdn cs -->
    <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous"/>
</head>
<body>
    <h2>TODO list</h2>
    <h4>Registration</h4>
    <form id="registration">
        <p>
            <label>Your login:<br></label>
            <input name="login" id="login" type="text" size="20" maxlength="20">
        </p>
        <p>
            <label>Your password:<br></label>
            <input name="password" id="password" type="password" size="20" maxlength="20">
        </p>
        <p>
            <label>Your email:<br></label>
            <input name="email" id="email" type="email" size="20" maxlength="20">
        </p>
        <p>
            <input type="submit" name="submit" value="Register">
        </p>
    </form>
    <p>
        <a href='index.php'>Go to main</a>
    </p>

    <!-- sweetalert cdn -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    let element = document.getElementById("registration");
        
    function sendReqest(login, password, email) {
        const xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let response = JSON.parse(this.responseText);

                if(response["success"]) {
                    Swal.fire({
                        title: "Success!",
                        text: response["message"],
                        icon: "success",
                    }).then(function () {
                        window.location.href = "index.php";
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

        xmlhttp.open("POST", "save_user.php", true);

        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.setRequestHeader("Cache-Control", "no-cache");

        xmlhttp.send("login=" + login + "&" + "password=" + password + "&" + "email=" + email);
    }

    if (element !== null) {
            element.onsubmit = function(e) {
            e.preventDefault();
            
            let login = document.getElementById('login').value;
            let password = document.getElementById('password').value;
            let email = document.getElementById('email').value;

            sendReqest(login, password, email);
        };
    }
    </script>

</body>
</html>