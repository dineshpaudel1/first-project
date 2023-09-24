<?php
session_start();
include('nav.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      margin: 0;
      background: linear-gradient(to right, #2691d9, #ffffff);
      height: 100vh;
      width: 100%;
    }
    h2{
      margin-top: 35.1px;
    }

    .column {
      float: left;
      width: 33.3%;
      margin-bottom: 16px;
      padding: 0 8px;
    }


    .container1 {
      padding: 0 16px;
    }

    .container1::after,
    .row::after {
      content: "";
      clear: both;
      display: table;
    }

    .container1 input {
      border: none;
      outline: 0;
      display: inline-block;
      padding: 8px;
      color: white;
      background-color: crimson;
      text-align: center;
      cursor: pointer;
      width: 100%;
    }

    .button:hover {
      background-color: #555;
    }
  </style>
</head>

<body>
    <h2 style="text-align:center">About Us</h2>
    <div class="row">
      <div class="column">
        <div class="card">
          <img src="images/profile-1.jpeg" alt="dinesh" style="height:347px; width:370px">
          <div class="container1">
            <h2 style="text-align:center">Dinesh Paudel</h2>
            <p class="title">CEO</p><br>
            <p>Hey iam Dinesh Paudel Founder of Online Gym Management System.</p><br>
            <p>Paudeldinesh961@gmail.com</p><br>
            <p><a href="contact.php"><input type="submit" name="btnContact" value="Contact"></a>
            <p>
          </div>
        </div>
      </div>

      <div class="column">
        <div class="card">
          <img src="images/profile-5.123.jpg" alt="bikesh" style="height:348apx; width:370px">
          <div class="container1">
            <h2 style="text-align:center">Bikesh Das</h2>
            <p class="title">founder</p><br>
            <p>hey it's bikesh das iam responsible for Gym every facilities.</p><br>
            <p>bikesh@gmail.com</p><br>
            <p><a href="contact.php"><input type="submit" name="btnContact" value="Contact"></a>
            <p>
          </div>
        </div>
      </div>

      <div class="column">
        <div class="card">
          <img src="images/profile-3.jpeg" alt="Ramesh" style="height:365px; width:370px" >
          <div class="container1">
            <h2 style="text-align:center">Ramesh Dhami</h2>
            <p class="title">Trainer</p><br>
            <p>Hey it's me Ramesh Dhami i will give you best train ever.</p><br>
            <p>rameshdhami@gmail.com</p><br>
            <p><a href="contact.php"><input type="submit" name="btnContact" value="Contact"></a>
            <p>
              <!-- <p><button class="button"><a href="">Contact</a></button></p> -->
          </div>
        </div>
      </div>
    </div>
  <?php
  include('footer.php');
  ?>
</body>

</html>