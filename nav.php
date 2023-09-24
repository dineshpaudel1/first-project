<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gym Management System</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://kit.fontawesome.com/504bf32129.js" crossorigin="anonymous"></script>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Arial, Helvetica, sans-serif;
    }

    .topnav {
      overflow: hidden;
      background-color: crimson;
    }

    .topnav a {
      float: left;
      color: #f2f2f2;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      font-size: 17px;
    }


    .topnav .user {
      float: right;
      color: #f2f2f2;
      text-align: center;
      text-decoration: none;
      font-size: 17px;

    }

    .topnav a:hover {
      background-color: green;
      color: black;
    }

    .topnav a.active {
      background-color: green;
      color: white;
    }

    h1 {
      text-align: center;
    }
  </style>
</head>

<body>
  <?php
  if (isset($_SESSION["trainername"]) && !empty($_SESSION['trainername'])) {
  ?>
    <div class="topnav">
      <a href="f.php">Home</a>
      <a href="about.php">About Us</a>
      <a href="contact.php">Contact</a>
    <?php
  } else {
    
    ?>
      <div class="topnav">
        <a href="f.php">Home</a>
        <a href="package.php">Package</a>
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact</a>
      <?php } ?>

      <div class="user">
        <?php
        if (isset($_SESSION["username"]) && !empty($_SESSION['username'])) {
        ?>
          <a href="utrainer_sugg.php" onclick="openForm()"><i class="fa-solid fa-envelope"></i> Trainer Suggestion</a>
          <a href="bmi.php" onclick="openForm()"><i class="fa-solid fa-chart-simple"></i> My BMI</a>
          <a href="user_profile.php" onclick="openForm()"><i class="fa-solid fa-user"></i> My Profile</a>
          <a href="logout.php"><i class="fa-solid fa-right-to-bracket"></i>Logout</a>

          
        <?php
        } elseif (isset($_SESSION["trainername"]) && !empty($_SESSION['trainername'])) {
        ?>
          <a href="myuser.php" onclick="openForm()"><i class="fa-solid fa-chart-simple"></i> My users</a>
          <a href="user_profile.php" onclick="openForm()"><i class="fa-solid fa-user"></i> My Profile</a>
          <a href="logout.php"><i class="fa-solid fa-right-to-bracket"></i>Logout</a>
        <?php
        } else { ?>
          <a href="customer_register.php"><i class="fa-solid fa-user"></i><label for="">Register</a>
          <a href="how_to_login.php"></label> <i class="fa-solid fa-right-to-bracket"></i><label for="">Login</a>
        <?php } ?>
      </div>
      </div>
</body>

</html>