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
        // console.dir(element);
        let login;
        let password;
        let email;
        

        function sendReqest(login, password, email) {
            const xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                // console.dir(this.readyState);
                // console.dir(this.status);

                if (this.readyState == 4 && this.status == 200) {
                    let response = JSON.parse(this.responseText);
                    
                    // response = response[0];

                    // console.dir(typeof this.responseText);
                    // console.dir(typeof response);
                    // console.dir(JSON.parse(this.responseText));
                    // console.dir(typeof response["success"]);

                    // let sweet_alert = Swal.mixin({
                    //         text: response["message"],
                    //     });

                    if(response["success"]) {
                        Swal.fire({
                            title: "Success!",
                            text: response["message"],
                            icon: "success",
                        }).then(function () {
                            // console.log("modal is success");
                            // document.location.reload();
                            window.location.href = "index.php";
                        });

                        // sweet_alert.fire({
                        //     title: "Success!",
                        //     icon: "success",
                        // }).then(function () {
                        //     console.log('modal is success');
                        //     document.location.reload();
                        // });
                        
                        // alert("test");

                        
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: response["message"],
                            icon: "error",
                        }).then(function () {
                                console.log("modal is error");
                        });
                    }

                    

                    // sweet_alert.fire({
                    //     title: "Error!",
                    //     icon: "error",
                    // }).then(function () {
                    //         console.log('modal is error');
                    // });
                    
                    // document.getElementById("form_feedback").innerHTML = response["message"];
                    // document.getElementById("form_feedback").innerHTML = this.responseText;
                }
            };

            xmlhttp.open("POST", "save_user.php", true);

            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            // xmlhttp.responseType = "json";
            xmlhttp.setRequestHeader("Cache-Control", "no-cache");

            xmlhttp.send("login=" + login + "&" + "password=" + password + "&" + "email=" + email);
    }

        if (element !== null) {
                element.onsubmit = function(e) {
                // alert('test');

                

                e.preventDefault();
                
                login = document.getElementById('login').value;
                password = document.getElementById('password').value;
                email = document.getElementById('email').value;

                // console.dir(login);
                // console.dir(password);

                sendReqest(login, password, email);

            };
        }
    </script>

</body>
</html>