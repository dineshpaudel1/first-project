<?php require_once 'check_admin.php'; ?>
<?php require_once 'expire_session.php'; ?>
<?php
$name = $address = $phone = $email = $username = $password = $gender = $res = '';
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
  } else {
    $err['email'] = "Enter email";
  }
  if (isset($_POST['username']) && !empty($_POST['username']) && trim($_POST['username'])) {
    $username = $_POST['username'];
  } else {
    $err['username'] = "Enter username";
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
      $sql = "insert into gym_user (name,address,phone,email,username,password,gender) values('$name','$address','$phone','$email','$username','$password','$gender')";
      $conn->query($sql);
      if ($conn->affected_rows == 1 && $conn->insert_id > 0) {
        header('location:user.php?action=1');
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
      height: 100vh;
      width: 1075px;
      margin-left: 200px;
      display: flex;
      justify-content: center;
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
  </style>
</head>
<?php
include("adm.php");

?>

<body>
  <div class="container">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form1">
      <h1>Adding User from Admin</h1><br>
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
        <input type="text" name="username" placeholder="username" value="<?php echo $username; ?>">
        <?php echo (isset($err['username']) ? $err['username'] : ''); ?>
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
</body>

</html>