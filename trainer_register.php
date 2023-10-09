<?php
include("nav.php");
$name = $address = $phone = $email = $trainername = $password = $gender = $res = '';
if (isset($_POST['btnRegister'])) {
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

  if (isset($_POST['email']) && !empty($_POST['email']) && trim($_POST['email'])) {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $err['email'] = "Invalid email format";
    }
  } else {
    $err['email'] = "Enter email";
  }
  if (isset($_POST['trainername']) && !empty($_POST['trainername']) && trim($_POST['trainername'])) {
    $trainername = $_POST['trainername'];
  } else {
    $err['trainername'] = "Enter trainername";
  }

  if (isset($_POST['password']) && !empty($_POST['password'])) {
    $password = md5($_POST['password']);
  } else {
    $err['password'] = "Enter password";
  }
  if (isset($_POST['gender']) && !empty($_POST['gender']) && trim($_POST['gender'])) {
    $gender = $_POST['gender'];
  } else {
    $err['gender'] = "Enter gender";
  }


  if (count($err) == 0) {
    try {
      $conn = new mysqli('localhost', 'root', '', 'gym');
      $sql = "insert into trainer (name,address,phone,email,trainername,password,gender) values('$name','$address','$phone','$email','$trainername','$password','$gender')";
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
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gym Regestration</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    h1,
    p {
      text-align: center;
    }

    .container {
      height: 87.1vh;
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
      margin-bottom: 20px;
      font-size: 12px;
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
  </style>
</head>

<body>
  <div class="container">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form1">
      <h1>Gym Trainer Registration Form</h1><br>
      <div class="group">
        <input type="text" name="name" placeholder="Name*" value="<?php echo $name; ?>">
        <?php echo (isset($err['name']) ? $err['name'] : ''); ?>
      </div>
      <div class="group">
        <input type="text" name="address" placeholder="Address" value="<?php echo $address; ?>">
        <?php echo (isset($err['address']) ? $err['address'] : ''); ?>
      </div>
      <div class="group">
        <input type="text" name="phone" placeholder="Phone" value="<?php echo $phone; ?>">
        <?php echo (isset($err['phone']) ? $err['phone'] : ''); ?>
      </div>
      <div class="group">
        <input type="text" name="email" placeholder="Email" value="<?php echo $email; ?>">
        <?php echo (isset($err['email']) ? $err['email'] : ''); ?>
      </div>
      <div class="group">
        <input type="text" name="trainername" placeholder="trainername" value="<?php echo $trainername; ?>">
        <?php echo (isset($err['trainername']) ? $err['trainername'] : ''); ?>
      </div>
      <div class="group">
        <input type="text" name="password" placeholder="password">
        <?php echo (isset($err['password']) ? $err['password'] : ''); ?>
      </div>
      <div class="group">
        <input type="radio" name="gender" value="Male">Male
        <input type="radio" name="gender" value="Female">Female
      </div>
      <div class="btn" id="">
        <button name="btnRegister" value="Register">Register</button><br>
        <br><label><?php echo $res; ?></label>
      </div>
    </form>
  </div>
  <?php
  include("footer.php");
  ?>
</body>

</html>