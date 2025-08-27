<?php include 'nav.php'; ?>
<?php
$name = $address = $phone = $email = $username = $password = $gender = $res = $cpassword = '';
if (isset($_POST['btnRegister'])) {
    $err = [];
    if (isset($_POST['name']) && !empty($_POST['name']) && trim($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $err['name'] = "Enter valid name";
    }
    if (isset($_POST['address']) && !empty($_POST['address']) && trim($_POST['address'])) {
        $address = $_POST['address'];
    } else {
        $err['address'] = "Enter valid address";
    }

    $phone = $_POST['phone'];
    $phone = preg_replace('/[^0-9]/', '', $phone);
    if (strlen($phone) !== 10) {
        echo "Invalid phone number";
    }

    if (isset($_POST['email']) && !empty($_POST['email']) && trim($_POST['email'])) {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err['email'] = "Invalid email format";
        }
    } else {
        $err['email'] = "Enter valid email";
    }

    if (isset($_POST['username']) && !empty($_POST['username']) && trim($_POST['username'])) {
        $username = $_POST['username'];
    } else {
        $err['username'] = "Enter valid username";
    }
    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = md5($_POST['password']);
    } else {
        $err['password'] = "Enter valid password";
    }
    if (isset($_POST['cpassword']) && !empty($_POST['cpassword']) && (($_POST['password']) == ($_POST['cpassword']))) {
        $cpassword = md5($_POST['cpassword']);
    } else {
        $err['cpassword'] = "password do not Match";
    }
    if (isset($_POST['gender']) && !empty($_POST['gender']) && trim($_POST['gender'])) {
        $gender = $_POST['gender'];
    } else {
        $err['gender'] = "Enter gender";
    }

    if (count($err) == 0) {
        try {
            $conn = new mysqli('localhost', 'root', '', 'gym');
            $sql = "insert into gym_user (name,address,phone,email,username,password,gender) values('$name','$address','$phone','$email','$username','$password','$gender')";
            $conn->query($sql);
            if ($conn->affected_rows == 1 && $conn->insert_id > 0) {
                header('location:how_to_login.php');
            }
        } catch (Exception $e) {
            die('Database  Error : ' . $e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Registration Form</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <style>
        /* ===== Theme (scoped) ===== */
        .register-page {
            --bg-start: #1a1a1a;
            --bg-end: #2d2d2d;
            --text: #ffffff;
            --muted: #cccccc;
            --accent: #e74c3c;
            --card-bg: rgba(255, 255, 255, .06);
            --card-border: rgba(255, 255, 255, .15);
            --nav-h: 72px;
            /* match your sticky nav height */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            background: linear-gradient(135deg, var(--bg-start) 0%, var(--bg-end) 100%);
            min-height: 100vh;
        }

        .register-page * {
            box-sizing: border-box;
        }

        /* Only center the main section, not the whole body (so nav/footer behave) */
        .register-main {
            min-height: calc(100vh - 1px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: calc(var(--nav-h) + 24px) 16px 64px;
            /* room for sticky nav + footer space */
        }

        /* Wrapper */
        .register-page .container {
            max-width: 520px;
            width: 100%;
            margin: 0 auto;
            padding: 0;
            /* override bootstrap default */
        }

        /* Card */
        .register-page .card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 18px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .35);
            backdrop-filter: blur(10px);
            padding: 26px 22px 22px;
        }

        .register-page h2 {
            text-align: center;
            margin: 0 0 8px;
            font-weight: 800;
            font-size: 26px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, .35);
        }

        .register-page .sub {
            text-align: center;
            color: var(--muted);
            margin-bottom: 18px;
        }

        .register-page .form-group {
            margin-bottom: 14px;
        }

        .register-page label {
            display: block;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: #fff;
            margin-bottom: 6px;
        }

        .register-page input[type="text"],
        .register-page input[type="email"],
        .register-page input[type="password"],
        .register-page select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid var(--card-border);
            border-radius: 12px;
            background: rgba(255, 255, 255, .08);
            color: #fff;
            outline: none;
            transition: border-color .2s ease, box-shadow .2s ease, background .2s ease, transform .1s ease;
        }

        .register-page input::placeholder {
            color: #9aa0a6
        }

        .register-page input:focus,
        .register-page select:focus {
            border-color: rgba(231, 76, 60, .85);
            box-shadow: 0 0 0 4px rgba(231, 76, 60, .15);
            background: rgba(255, 255, 255, .1);
            transform: translateY(-1px);
        }

        .register-page #name_err,
        .register-page .phone_err {
            display: block;
            margin-top: 6px;
            color: #ff8a8a;
            font-size: .9rem;
            font-weight: 600;
        }

        .register-page .text-success {
            color: #4cd964;
            font-weight: 700;
        }

        .register-page .btn1 {
            width: 100%;
            height: 44px;
            border: 1px solid rgba(231, 76, 60, .9);
            background: var(--accent);
            border-radius: 999px;
            font-size: 16px;
            color: #fff;
            font-weight: 800;
            cursor: pointer;
            outline: none;
            transition: background .2s ease, transform .1s ease, box-shadow .2s ease;
            box-shadow: 0 8px 20px rgba(231, 76, 60, .35);
            margin-top: 6px;
        }

        .register-page .btn1:hover {
            background: #ff5b49;
            transform: translateY(-1px);
            box-shadow: 0 12px 26px rgba(231, 76, 60, .45);
        }

        .register-page .btn1:active {
            transform: translateY(0)
        }

        .register-page .form-control {
            width: 100%
        }
    </style>
</head>

<body class="register-page">
    <main class="register-main">
        <div class="container">
            <div class="card">
                <h2>User Registration Form</h2>
                <p class="sub">Create your FitZone account</p>

                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form1">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name"
                            value="<?php echo $name; ?>">
                        <span id="name_err"><?php echo (isset($err['name']) ? $err['name'] : ''); ?></span>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="address" name="address"
                            placeholder="Enter your address" value="<?php echo $address; ?>">
                        <span id="name_err"><?php echo (isset($err['address']) ? $err['address'] : ''); ?></span>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="Enter your phone number" value="<?php echo $phone; ?>">
                        <span id="phone_availability"
                            class="phone_err"><?php echo (isset($err['phone']) ? $err['phone'] : ''); ?></span>
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                            value="<?php echo $email; ?>">
                        <span id="email_availability"
                            class="phone_err"><?php echo (isset($err['email']) ? $err['email'] : ''); ?></span>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Enter your username" value="<?php echo $username; ?>">
                        <span id="username_availability"
                            class="phone_err"><?php echo (isset($err['username']) ? $err['username'] : ''); ?></span>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Enter your password">
                        <span id="name_err"><?php echo (isset($err['password']) ? $err['password'] : ''); ?></span>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" id="cpassword" name="cpassword"
                            placeholder="Enter your Confirm Password">
                        <span id="name_err"><?php echo (isset($err['cpassword']) ? $err['cpassword'] : ''); ?></span>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="male" <?php echo ($gender === 'male' ? 'selected' : ''); ?>>Male</option>
                            <option value="female" <?php echo ($gender === 'female' ? 'selected' : ''); ?>>Female
                            </option>
                            <option value="other" <?php echo ($gender === 'other' ? 'selected' : ''); ?>>Other</option>
                        </select>
                    </div>

                    <button name="btnRegister" value="Register" id="register" class="btn1">Register</button><br>
                </form>
            </div>
        </div>
    </main>

    <script>
        $(function() {
            $('#username').blur(function() {
                var username = $(this).val();
                $.post('check.php', {
                    user_name: username
                }, function(data) {
                    if (data != '0') {
                        $('#username_availability').html(
                            '<span class="text-danger">Username not available</span>');
                        $('#register').attr("disabled", true);
                    } else {
                        $('#username_availability').html(
                            '<span class="text-success">Username Available</span>');
                        $('#register').attr("disabled", false);
                    }
                });
            });

            $('#phone').blur(function() {
                var phone = $(this).val();
                $.post('check.php', {
                    user_phone: phone
                }, function(data) {
                    if (data != '0') {
                        $('#phone_availability').html(
                            '<span class="text-danger">phone not available</span>');
                        $('#register').attr("disabled", true);
                    } else {
                        $('#phone_availability').html(
                            '<span class="text-success">phone Available</span>');
                        $('#register').attr("disabled", false);
                    }
                });
            });

            $('#email').blur(function() {
                var email = $(this).val();
                $.post('check.php', {
                    user_email: email
                }, function(data) {
                    if (data != '0') {
                        $('#email_availability').html(
                            '<span class="text-danger">email not available</span>');
                        $('#register').attr("disabled", true);
                    } else {
                        $('#email_availability').html(
                            '<span class="text-success">email Available</span>');
                        $('#register').attr("disabled", false);
                    }
                });
            });
        });
    </script>
</body>
<?php include 'footer.php'; ?>

</html>