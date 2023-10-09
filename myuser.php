<?php
session_start();
include('nav.php');
if (isset($_SESSION['trainername'])) {
    $trainernamet = $_SESSION['trainername'];
}
?>
<?php
$trainer = [];
try {
    require_once 'connection.php';
    $sql = "SELECT *
    FROM enrollment
    WHERE coach = '$trainernamet';
    ";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while ($a = $res->fetch_assoc()) {
            array_push($trainer, $a);
        }
    }
} catch (Exception $e) {
    die('Database  Error : ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .bgs {
            height: 653px;
            background: linear-gradient(to right, #2691d9, #ffffff);
        }

        .user {
            display: flex;
            justify-content: center;
        }

        .user table {
            margin-top: 85px;
            width: 1000px;
        }

        .user table tr {
            height: 35px;
        }

        .user table tr th {
            font-size: 15px;
        }

        .user table tr td {
            text-align: center;
            font-size: 15px;
            margin: 5px;
            text-decoration: none;
        }

        .user table tr td .btn1 {
            border: 6px solid Green;
            border-radius: 5px;
            background-color: Green;
            color: #fff;
            text-decoration: none;
            font-size: 15px;
        }
        .user table tr td .btn2 {
            border: 6px solid purple;
            border-radius: 5px;
            background-color: purple;
            color: #fff;
            text-decoration: none;
            font-size: 15px;
        }

    </style>
</head>
<?php
$feedback = [];
try {
    $conn = new mysqli('localhost', 'root', '', 'gym');
    $sql = "select * from feedback";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while ($a = $res->fetch_assoc()) {
            array_push($feedback, $a);
        }
    }
} catch (Exception $e) {
    die('Database  Error : ' . $e->getMessage());
}

?>

<body>
    <div class="bgs">
        <div class="user">

            <table border="1px solid black">
                <tr>
                    <th colspan="11">My Total user</th>
                </tr>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Coach name</th>
                    <th>Gender</th>
                    <th colspan="3">Operation</th>
                </tr>
                <?php for ($i = 0; $i < count($trainer); $i++) { ?>
                    <tr>
                        <td><?php echo $trainer[$i]['id'] ?></td>
                        <td><?php echo $trainer[$i]['name'] ?></td>
                        <td><?php echo $trainer[$i]['address'] ?></td>
                        <td><?php echo $trainer[$i]['phone'] ?></td>
                        <td><?php echo $trainer[$i]['package'] ?></td>
                        <td><?php echo $trainer[$i]['coach'] ?></td>
                        <td><?php echo $trainer[$i]['time'] ?></td>
                        <td><?php echo $trainer[$i]['gender'] ?></td>
                        <td>
                            <a class="btn1" href="newdietplan.php?id=<?php echo $trainer[$i]["id"] ?>">Send Message</a>
                        </td>
                    </tr>

                <?php } ?>
            </table>
        </div>
    </div>
</body>
<?php include('footer.php'); ?>

</html>