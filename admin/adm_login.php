<?php
session_start();
if (!isset($_SESSION['adminname'])) {
    echo '<script type="text/javascript">';
    echo 'alert("Your session has expired. Please log in again.")';
    echo '</script>';
}
if (isset($_POST['btnLogin'])) {
    $err = [];
    if (isset($_POST['adminname']) && !empty($_POST['adminname']) && trim($_POST['adminname'])) {
        $adminname = $_POST['adminname'];
    } else {
        $err['adminname'] = 'adminname is required';
    }

    if (isset($_POST['password']) && !empty($_POST['password']) && trim($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $err['password'] = 'Enter your password';
    }
}
$conn = new mysqli("localhost", "root", "", "gym");
if (isset($err) && count($err) == 0) {
    $sql = "SELECT * FROM admin WHERE adminname = '$adminname' and password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        $_SESSION['adminname'] = $adminname;
        $_SESSION['id'] = $row['id'];
        $_SESSION['login_status'] = true;
        $_SESSION['start_time'] = time();
        header('location:dashboard.php');
    } else {
        $err['msg'] = "Your Login Name or Password is invalid";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy Admin Login</title>
    <script src="https://kit.fontawesome.com/504bf32129.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url(image/gym.svg);
        }

        .main {
            background-image: url(image/wave.png);
            height: 85vh;
            width: 100%;
        }

        .container {
            width: 350px;
            margin: 100px 900px 100px 800px;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo img {
            height: 100px;
            width: 100px;
        }

        .login-form {
            background-color: #fff;
            border-radius: 5px;
            padding: 40px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .login-form h2 {
            text-align: center;
        }

        .login-form input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .login-form button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #4caf50;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .login-form button:hover {
            background-color: #45a049;
        }

        .login-form button:active {
            background-color: #3e8e41;
        }

        .login-form input:focus {
            outline: none;
            border-color: #4caf50;
        }

        .group {
            display: flex;
            justify-content: center;
        }

        .group i {
            margin: 10px;
        }

        .eye {
            position: absolute;
            cursor: pointer;
            right: 170px;
            top: 360px;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="container">
            <form class="login-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <h2>Admin Login</h2>
                <div class="logo">
                    <img src="image/logo.png" alt="Logo">
                </div>
                <div class="group">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" placeholder="adminname" name="adminname" required>
                </div>
                <div class="group">
                    <i class="fa-solid fa-fingerprint"></i>
                    <input type="password" placeholder="password" name="password" required>
                </div>
                <button value="Login" name="btnLogin">Login</button><br>
            </form>
        </div>
    </div>
</body>

</html>