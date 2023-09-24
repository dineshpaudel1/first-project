<?php
session_start();
include("nav.php");
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background: linear-gradient(to right, #2691d9, #ffffff);
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin: 146px 400px 146px 400px;
            /* margin: auto; */
            text-align: center;
            font-family: arial;

        }

        .title {
            color: grey;
            font-size: 18px;
        }

        button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }

        .close button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: red;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }

        a {
            text-decoration: none;
            font-size: 22px;
            color: black;
        }

        button:hover,
        a:hover {
            opacity: 0.7;
        }
    </style>
</head>

<body>
    <div class="card" id="myForm">

        <?php
        if (isset($_SESSION["username"]) && !empty($_SESSION['username'])) {
        ?>
            <h2 style="text-align:center">User Profile</h2>
            <img src="images/user_profile1.png" alt="John" style="width:200px" height="200px">
            <h1><?php echo $_SESSION['username'] ?></h1>
        <?php
        } elseif (isset($_SESSION["trainername"]) && !empty($_SESSION['trainername'])) {
        ?>
            <h2 style="text-align:center">Trainer Profile</h2>
            <img src="images/user_profile1.png" alt="John" style="width:200px" height="200px">
            <h1><?php echo $_SESSION['trainername'] ?></h1>
        <?php } ?>
        <p>Address</p>
        <p>Phone</p>
        <p>Gmail</p>
        <div class="close">
            <p><a href="f.php"> <button>Close</button></a></p>
        </div>
    </div>
</body>
<?php
include("footer.php");
?>

</html>