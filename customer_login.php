<?php
include("nav.php");
$username = '';
if (isset($_POST['btnLogin'])) {
    $err  = [];
    if (isset($_POST['username']) && !empty($_POST['username']) && trim($_POST['username'])) {
        $username = $_POST['username'];
    } else {
        $err['username'] = "Enter username";
    }

    if (isset($_POST['password']) && !empty($_POST['password']) && trim($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $err['password'] =  'Enter password';
    }


    $conn = new mysqli("localhost", "root", "", "gym");
    if ($conn->connect_error) {
        die("Connection Failed : " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("select * from gym_user where username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if ($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();
            if ($data['password'] === $password) {
                header('location:index.php');
            } else {
                echo "<h2>invalid password</h2>";
            }

            if (isset($_POST['remember'])) {
                setcookie('username', $username, time() + 60);
            }
            session_start();
            $_SESSION['username'] =  $username;
            $_SESSION['login_status'] = true;
            header('location:index.php');
        } else {
            echo "<h2>invalid username</h2>";
        }
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
            background-image: url(images/gym.svg);
        }

        .main {
            background-image: url(images/wave.png);
            height: 73.7vh;
            width: 60%;
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
            right: 307px;
            top: 407px;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="container">
            <form class="login-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <h2>User Login</h2>
                <div class="logo">
                    <img src="images/logo.png" alt="Logo">
                </div>
                <div class="group">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" placeholder="username" name="username" required>
                </div>
                <div class="group">
                    <i class="fa-solid fa-fingerprint"></i>
                    <input type="password" placeholder="password" name="password" required>
                    <i class="eye bi bi-eye-slash" id="togglePassword"></i>
                </div>
                <button value="Login" name="btnLogin">Login</button><br>
            </form>
        </div>
    </div>
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
    <?php
    include("footer.php");
    ?>
</body>

</html>