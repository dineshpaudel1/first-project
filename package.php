<?php
session_start();
include('nav.php');
?>
<?php
$packages = [];
try {
    $conn = new mysqli('localhost', 'root', '', 'gym');
    $sql = "select * from package";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {

        while ($a = $res->fetch_assoc()) {
            array_push($packages, $a);
        }
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
    <title>Plan Package</title>
    <style>
        * {
            box-sizing: border-box;
        }

        .mrg {
            margin-top: 38px;
            padding: 30px;
        }

        body {
            background: linear-gradient(to right, #2691d9, #ffffff);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .columns {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .price {
            float: left;
            list-style-type: none;
            border: 1px solid #eee;
            margin: 0;
            padding: 0;
            -webkit-transition: 0.3s;
            transition: 0.3s;
            margin: 20px;
        }

        .price:hover {
            box-shadow: 0 8px 12px 0 rgba(0, 0, 0, 0.2)
        }

        .price .header {
            background-color: #2980b9, #8e44ad;
            color: white;
            font-size: 25px;
        }

        .price li {
            border-bottom: 1px solid #eee;
            padding: 20px;
            width: 400px;
            text-align: center;
        }

        .price .grey {
            background-color: goldenrod;
            font-size: 20px;
        }

        .button {
            background-color: crimson;
            border: none;
            color: white;
            padding: 10px 25px;
            text-align: center;
            text-decoration: none;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="mrg">
        <?php
        if (isset($_SESSION["username"]) && !empty($_SESSION['username'])) {
        ?>
            <h2 style="text-align:center">Your Excersise Plan</h2>
            <p style="text-align:center">Please slect your plan according to your choice </p>
            <div class="columns">
                <?php for ($i = 0; $i < count($packages); $i++) { ?>
                    <ul class="price">
                        <li class="header" style="background-color:green"><?php echo $packages[$i]['plan'] ?></li>
                        <li class="grey"><?php echo $packages[$i]['cost'] ?></li>
                        <li><?php echo $packages[$i]['offers'] ?></li>
                        <li><?php echo $packages[$i]['shift'] ?></li>
                        <li><?php echo $packages[$i]['discount'] ?></li>
                        <li class="grey"><a href="enrollment.php" class="button">Enroll Now</a></li> <br><br>
                    </ul>
                <?php } ?>
            </div>
            <p>.</p><br><br>
        <?php
        } else { ?>
            <h2 style="text-align:center">Your Excersise Plan</h2>
            <p style="text-align:center">Please slect your plan according to your choice </p>
            <div class="columns">
                <?php for ($i = 0; $i < count($packages); $i++) { ?>
                    <ul class="price">
                        <li class="header" style="background-color:green"><?php echo $packages[$i]['plan'] ?></li>
                        <li class="grey"><?php echo $packages[$i]['cost'] ?></li>
                        <li><?php echo $packages[$i]['offers'] ?></li>
                        <li><?php echo $packages[$i]['shift'] ?></li>
                        <li><?php echo $packages[$i]['discount'] ?></li>
                        <li class="grey"><a href="customer_login.php" class="button">Enroll Now</a></li> <br><br>
                    </ul>
                <?php } ?>
            </div>
            <p>.</p><br><br>
        <?php } ?>
    </div>
    <?php
    include('footer.php');
    ?>
</body>

</html>