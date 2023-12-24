<?php
include("nav.php");
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
    if (strlen($phone) === 10) {
        echo "";
    } else {
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: sans-serif;
            background-color: #fff;
            background: linear-gradient(to right, #2691d9, #ffffff);
        }

        .container {
            width: 500px;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 10px;
        }

        label {
            font-weight: bold;
        }

        input,
        select {
            width: 500px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #name_err {
            color: red;
        }

        .phone_err {
            color: red;
        }

        .btn1 {
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
            margin-left: 130px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>User Registration Form</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form1">
            <div class="form-group">
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="<?php echo $name; ?>">
                <span id="name_err"><?php echo (isset($err['name']) ? $err['name'] : ''); ?></span>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" value="<?php echo $address; ?>">
                <span id="name_err"><?php echo (isset($err['address']) ? $err['address'] : ''); ?></span>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" value="<?php echo $phone; ?>">
                <span id="phone_availability" class="phone_err"><?php echo (isset($err['phone']) ? $err['phone'] : ''); ?></span>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php echo $email; ?>">
                <span id="email_availability" class="phone_err"><?php echo (isset($err['email']) ? $err['email'] : ''); ?></span>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" value="<?php echo $username; ?>">
                <span id="username_availability" class="phone_err"><?php echo (isset($err['username']) ? $err['username'] : ''); ?></span>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                <span id="name_err"><?php echo (isset($err['password']) ? $err['password'] : ''); ?></span>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Enter your Confirm Password">
                <span id="name_err"><?php echo (isset($err['cpassword']) ? $err['cpassword'] : ''); ?></span>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <button name="btnRegister" value="Register" id="register" class="btn1">Register</button><br>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#username').blur(function() {
                var username = $(this).val();
                $.ajax({
                    url: 'check.php',
                    method: "POST",
                    data: {
                        user_name: username
                    },
                    success: function(data) {
                        if (data != '0') {
                            $('#username_availability').html('<span class="text-danger">Username not available</span>');
                            $('#register').attr("disabled", true);
                        } else {
                            $('#username_availability').html('<span class="text-success">Username Available</span>');
                            $('#register').attr("disabled", false);
                        }
                    }
                })

            });
        });

        $(document).ready(function() {
            $('#phone').blur(function() {

                var phone = $(this).val();

                $.ajax({
                    url: 'check.php',
                    method: "POST",
                    data: {
                        user_phone: phone
                    },
                    success: function(data) {
                        if (data != '0') {
                            $('#phone_availability').html('<span class="text-danger">phone not available</span>');
                            $('#register').attr("disabled", true);
                        } else {
                            $('#phone_availability').html('<span class="text-success">phone Available</span>');
                            $('#register').attr("disabled", false);
                        }
                    }
                })

            });
        });
        $(document).ready(function() {
            $('#email').blur(function() {

                var email = $(this).val();

                $.ajax({
                    url: 'check.php',
                    method: "POST",
                    data: {
                        user_email: email
                    },
                    success: function(data) {
                        if (data != '0') {
                            $('#email_availability').html('<span class="text-danger">email not available</span>');
                            $('#register').attr("disabled", true);
                        } else {
                            $('#email_availability').html('<span class="text-success">email Available</span>');
                            $('#register').attr("disabled", false);
                        }
                    }
                })

            });
        });
    </script>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <?php
    include("footer.php")
    ?>
</body>

</html>