<?php
session_start();
if (isset($_SESSION['username'])) {
    $usernamet = $_SESSION['username'];
}   
include("nav.php");
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
            $conn = new mysqli('localhost', 'root', '', 'gym');
            $sql = "insert into enrollment (name,address,phone,package,coach,time,gender) values('$name','$address','$phone','$package','$coach','$time','$gender')";
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
            height: 87vh;
            width: 100%;
            display: flex;
            justify-content: center;
            background: linear-gradient(to right, #2691d9, #ffffff);
        }

        .form1 {
            height: 510px;
            width: 550px;
            margin-top: 100px;
            background: rgba(255, 255, 255, 0.35);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 5px;
            align-items: center;
            border-radius: 10px;
        }

        .group {
            margin-bottom: 15px;
            font-size: 12px;
        }

        input[type=text] {
            padding: 5px;
            width: 300px;
            border-radius: 5px;
            border: 1px solid black;
            text-align: center;
            display: flex;

        }

        .btn button {
            width: 180px;
            height: 40px;
            border: 1px solid;
            background: #2691d9;
            border-radius: 20px;
            font-size: 15px;
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
            padding: 5px;
            width: 300px;
            border-radius: 5px;
            border: 1px solid black;
            text-align: center;
            display: flex;
        }
    </style>
</head>
<?php
?>
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
?>

<body>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form1">
            <h1>Gym Enrollment Form by User</h1><br>
            <div class="group">
                <input type="text" name="name" placeholder="Name*" value="<?php echo $gym_user['username']; ?>">
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


            <select name="package" required>
                <option value="">Select a Plan</option>
                <?php
                require_once "connection.php";
                $query = "SELECT * FROM package";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['plan'] . '">' . $row['plan'] . '</option>';
                    }
                }
                ?>
            </select><br>

            <select name="coach" required>
                <option value="">Select a coach</option>
                <?php
                $query = "SELECT * FROM trainer";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['trainername'] . '">' . $row['trainername'] . '</option>';
                    }
                }
                ?>
            </select><br>

            <select name="time" required>
                <option value="">Select Time Shift</option>
                <?php
                $query = "SELECT * FROM package";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['shift'] . '">' . $row['shift'] . '</option>';
                    }
                }
                ?>
            </select><br>


            <div class="group">
                <input type="radio" name="gender" value="Male">Male
                <input type="radio" name="gender" value="Female">Female
            </div>
            <div class="btn" id="">
                <button name="btnRegister" value="Register">Register</button><br>
                <br>
            </div>
        </form>
    </div>
</body>
<?php include "footer.php" ?>

</html>