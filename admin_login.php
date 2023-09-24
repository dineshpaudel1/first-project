<?php
session_start();
include("nav.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            height: 87.1vh;
            width: 100%;
            display: flex;
            justify-content: center;
            background: linear-gradient(to right, #2691d9, #ffffff);

        }

        .form1 {
            height: 500px;
            width: 500px;
            margin: 20px;
            background: rgba(255, 255, 255, 0.35);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 10px;
            align-items: center;
            border-radius: 10px;
        }

        .btn button {
            width: 200px;
            height: 40px;
            border: 1px solid;
            background: #2691d9;
            border-radius: 20px;
            font-size: 18px;
            color: #e9f4fb;
            font-weight: 700;
            cursor: pointer;
            outline: none;
        }

        .password1 {
            position: relative;
        }

        .name1,
        .password1 {
            margin-bottom: 40px;
        }

        input[type=text],
        input[type=password] {
            padding: 10px;
            width: 300px;
            border-radius: 5px;
            border: 1px solid black;
            text-align: center;
        }

        .login h1 {
            margin-bottom: 50px;
            text-align: center;
        }

        form i {
            position: absolute;
            cursor: pointer;
            right: 10px;
            top: 9px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login">
            <form class="form1" action="">
                <h1>Admin Login</h1>
                <div class="name1">
                    <input type="text" placeholder="Username:">
                </div>
                <div class="password1">
                    <input type="password" name="password" id="password" placeholder="Password:">
                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                </div>
                <div class="btn">
                    <button>Submit</button>
                </div>
            </form>
        </div>
    </div>
    <?php
    include("footer.php")
    ?>
    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            // toggle the icon
            this.classList.toggle("bi-eye");
        });
    </script>
</body>

</html>