<?php
session_start();
if (isset($_SESSION['username'])) {
    $usernamet = $_SESSION['username'];
}
include("nav.php");
?><?php
    $name = $address = $phone = $gender = $res = $package = $coach = $time = '';
    if (isset($_POST['btnRegister'])) {
        $package = $_POST['package'];
        $coach = $_POST['coach'];
        $time = $_POST['time'];
        $err = [];
        if (isset($_POST['name']) && !empty($_POST['name']) && trim($_POST['name'])) {
            $name = $_POST['name'];
        } else {
            $err['name'] = "Enter name";
        }

        if (isset($_POST['address']) && !empty($_POST['address']) && trim($_POST['address'])) {
            $address = $_POST['address'];
        } else {
            $err['address'] = "Enter address";
        }
        if (isset($_POST['phone']) && !empty($_POST['phone']) && trim($_POST['phone'])) {
            $phone = $_POST['phone'];
        } else {
            $err['phone'] = "Enter phone";
        }
        if (isset($_POST['gender']) && !empty($_POST['gender']) && trim($_POST['gender'])) {
            $gender = $_POST['gender'];
        } else {
            $err['gender'] = "Enter gender";
        }

        if (count($err) == 0) {
            try {
                require_once 'connection.php';
                $sql = "insert into enrollment (name,address,phone,package,coach,time,gender) values('$name','$address','$phone','$package','$coach','$time'  ,'$gender')";
                $conn->query($sql);
                if ($conn->affected_rows > 0 && $conn->insert_id > 0) {
                    header('location:f.php');
                }
            } catch (Exception $e) {
                die('Database  Error : ' . $e->getMessage());
            }
        }
    }
    ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Regestration</title>
    <style>
        h1,
        p {
            text-align: center;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            height: 86vh;
            width: 100%;
            display: flex;
            justify-content: center;
            background: linear-gradient(to right, #2691d9, #ffffff);

        }

        .form1 {
            height: 560px;
            width: 560px;
            background: rgba(255, 255, 255, 0.35);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
        }


        .group {
            margin-bottom: 25px;
            font-size: 13px;
        }

        input[type=text] {
            padding: 7px;
            width: 300px;
            border-radius: 5px;
            border: 1px solid black;
            text-align: center;
            display: flex;

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

        .btn label {
            color: green;
            margin-left: 30px;
            margin-bottom: -10px;
        }

        select,
        option {
            padding: 7px;
            width: 300px;
            border-radius: 5px;
            border: 1px solid black;
            text-align: center;
            display: flex;
        }
    </style>
</head>
<?php
try {
    $gym_user = [];
    $err = [];
    require_once 'connection.php';
    $sql = "SELECT * FROM gym_user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usernamet);
    $stmt->execute();
    $res = $stmt->get_result();
    $gym_user = $res->fetch_assoc();
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
echo $gym_user;
?>

<body>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form1">
            <h1>Gym Enrollment Form</h1><br>
            <div class="group">
                <input type="text" name="name" placeholder="Name*" value="<?php echo $gym_user['name']; ?>">
                <?php echo (isset($err['name']) ? $err['name'] : ''); ?>
            </div>
            <div class="group">
                <input type="text" name="address" placeholder="Address" value="<?php echo  $gym_user['address']; ?>">
                <?php echo (isset($err['address']) ? $err['address'] : ''); ?>
            </div>
            <div class="group">
                <input type="text" name="phone" placeholder="Phone" value="<?php echo  $gym_user['phone']; ?>">
                <?php echo (isset($err['phone']) ? $err['phone'] : ''); ?>
            </div>
            <div class="group">
                <select name="package">
                    <option>Select Package</option>
                    <option name="package" value="Basic">Basic</option>
                    <option name="package" value="Premium">Premium</option>
                    <option name="package" value="pro">pro</option>
                </select>
            </div>
            <div class="group">
                <select name="coach">
                    <option>select coach</option>
                    <option value="Mr Ramesh Dhami">Mr Ramesh Dhami</option>
                    <option value="Mr Anx Sharma">Mr Anx sharma</option>
                </select>
            </div>
            <div class="group">
                <select name="time">
                    <option>select time shift</option>
                    <option value="Morning">Morning</option>
                    <option value="Day">Day</option>
                    <option value="Evening">Evening</option>
                </select>
            </div>
            <?php
            if ($gym_user['gender'] == "Male") { ?>
                <div class="group">
                    <input type="radio" name="gender" value="Male" checked>Male
                    <input type="radio" name="gender" value="Female">Female
                </div>
            <?php } else { ?>
                <div class="group">
                    <input type="radio" name="gender" value="Male">Male
                    <input type="radio" name="gender" value="Female" checked>Female
                </div>
            <?php } ?>
            <div class="btn" id="">
                <button name="btnRegister" value="Register">Register</button><br>
                <br>
                <label>
                    <?php echo (isset($err['reg']) ? $err['reg'] : ''); ?>
                </label>
            </div>
        </form>
    </div>
    <?php
    include("footer.php");
    ?>
</body>

</html>