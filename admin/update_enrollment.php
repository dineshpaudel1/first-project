<?php require_once 'check_admin.php'; ?>
<?php require_once 'expire_session.php'; ?>
<?php
$id = $_GET['id'];
if (isset($_POST['btnUpdate'])) {
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
      $sql = "update enrollment set name='$name',address='$address',phone='$phone', package='$package',  coach='$coach', time='$time', gender='$gender' where id=$id";
      $conn->query($sql);
      if ($conn->affected_rows == 1) {
        header('location:enrolled.php?action=1');
      }
    } catch (Exception $e) {
      die('Database  Error : ' . $e->getMessage());
    }
  }
}


try {
  $conn = new mysqli('localhost', 'root', '', 'gym');
  $sql = "select * from enrollment where id=$id";
  $res = $conn->query($sql);
  if ($res->num_rows == 1) {
    $user = $res->fetch_assoc();
    extract($user);
  } else {
    die("data not found");
  }
} catch (Exception $e) {
  die('Database  Error : ' . $e->getMessage());
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Gym update</title>
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
include("adm.php"); ?>

<body>
  <div class="container">
  <form action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $id ?>" method="post" class="form1">
      <h1>Gym Enrollment Form</h1><br>
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
        <select name="package">
          <option ><?php echo $package; ?></option>
          <option name="package" value="Basic">Basic</option>
          <option name="package" value="Premium">Premium</option>
          <option name="package" value="pro">pro</option>
        </select>
      </div>
      <div class="group">
        <select name="coach">
          <option><?php echo $coach; ?></option>
          <option value="Mr Ramesh Dhami">Mr Ramesh Dhami</option>
          <option value="Mr Anx Sharma">Mr Anx sharma</option>
        </select>
      </div>
      <div class="group">
        <select name="time">
          <option><?php echo $time; ?></option>
          <option value="Morning">Morning</option>
          <option value="Day">Day</option>
          <option value="Evening">Evening</option>
        </select>
      </div>
      <?php
      if ($user['gender'] == "Male") { ?>
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
      <button name="btnUpdate" value="Update">Update</button><br>
        <br>
      </div>
    </form>
  </div>
</body>

</html>