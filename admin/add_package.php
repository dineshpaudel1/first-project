<?php require_once 'check_admin.php'; ?>
<?php require_once 'expire_session.php'; ?>
<?php
$plan = $cost = $offers = $shift = $discount = '';
if (isset($_POST['btnRegister'])) {
  $err = [];
  if (isset($_POST['plan']) && !empty($_POST['plan']) && trim($_POST['plan'])) {
    $plan = $_POST['plan'];
  } else {
    $err['plan'] = "Enter plan";
  }

  if (isset($_POST['cost']) && !empty($_POST['cost']) && trim($_POST['cost'])) {
    $cost = $_POST['cost'];
  } else {
    $err['cost'] = "Enter cost";
  }
  if (isset($_POST['offers']) && !empty($_POST['offers']) && trim($_POST['offers'])) {
    $offers = $_POST['offers'];
  } else {
    $err['offers'] = "Enter offers";
  }

  if (isset($_POST['shift']) && !empty($_POST['shift']) && trim($_POST['shift'])) {
    $shift = $_POST['shift'];
  } else {
    $err['shift'] = "Enter shift";
  }
  if (isset($_POST['discount']) && !empty($_POST['discount']) && trim($_POST['discount'])) {
    $discount = $_POST['discount'];
  } else {
    $err['discount'] = "Enter discount";
  }

  if (count($err) == 0) {
    try {
      $conn = new mysqli('localhost', 'root', '', 'gym');
      $sql = "insert into package (plan,cost,offers,shift,discount) values('$plan','$cost','$offers','$shift','$discount')";
      $conn->query($sql);
      if ($conn->affected_rows == 1 && $conn->insert_id > 0) {
        header('location:packaged.php?action=1');
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
  <title>Adding Package</title>
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
      <h1>Adding Package</h1><br>
      <div class="group">
        <input type="text" name="plan" placeholder="plan" value="<?php echo $plan; ?>">
        <?php echo (isset($err['plan']) ? $err['plan'] : ''); ?>
      </div>
      <div class="group">
        <input type="text" name="cost" placeholder="cost" value="<?php echo $cost; ?>">
        <?php echo (isset($err['cost']) ? $err['cost'] : ''); ?>
      </div>
      <div class="group">
        <input type="text" name="offers" placeholder="offers" value="<?php echo $offers; ?>">
        <?php echo (isset($err['offers']) ? $err['offers'] : ''); ?>
      </div>
      <div class="group">
        <input type="text" name="shift" placeholder="shift" value="<?php echo $shift; ?>">
        <?php echo (isset($err['shift']) ? $err['shift'] : ''); ?>
      </div>
      <div class="group">
        <input type="text" name="discount" placeholder="discount" value="<?php echo $discount; ?>">
        <?php echo (isset($err['discount']) ? $err['discount'] : ''); ?>
      </div>
      
      <div class="btn" id="">
        <button name="btnRegister" value="Register">Register</button><br>
      </div>
    </form>
  </div>
</body>

</html>