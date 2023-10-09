
<?php
session_start();
include "nav.php";
$users = [];
try {
    $conn = new mysqli('localhost', 'root', '', 'gym');
    $sql = "select * from feedback";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while ($a = $res->fetch_assoc()) {
            array_push($users, $a);
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
    <title>Feedback Details</title>
    <style>
        .bgs {
            height: 660px;
            background: linear-gradient(to right, #2691d9, #ffffff);
        }

        .user {
            display: flex;
            justify-content: center;
        }

        .user table {
            margin-top: auto;
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
            border: 6px solid red;
            border-radius: 5px;
            background-color: red;
            color: #fff;
            text-decoration: none;
            font-size: 15px;
        }

        .user table tr th .btn3 {
            border: 6px solid brown;
            border-radius: 5px;
            background-color: brown;
            color: #fff;
            text-decoration: none;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <div class="bgs">
        <div class="user">

            <table border="1px solid black">
                <tr>
                    <th colspan="11">Feedback Details</th>
                </tr>
                <tr>
                    <!-- <th rowspan="7">User Details</th> -->
                    <th>id</th>
                    <th>Myname</th>
                    <th>Username</th>
                    <th>feedback</th>
                </tr>
                <?php for ($i = 0; $i < count($users); $i++) { ?>
                    <tr>
                        <td><?php echo $users[$i]['id'] ?></td>
                        <td><?php echo $users[$i]['trainername'] ?></td>
                        <td><?php echo $users[$i]['username'] ?></td>
                        <td><?php echo $users[$i]['message'] ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
<?php include "footer.php";
?>

</html>