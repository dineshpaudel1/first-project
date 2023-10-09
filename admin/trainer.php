<?php require_once 'check_admin.php'; ?>
<?php require_once 'expire_session.php'; ?>
<?php
include("adm.php");
?>
<?php
$trainers = [];
try {
    $conn = new mysqli('localhost', 'root', '', 'gym');
    $sql = "select * from trainer";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while ($a = $res->fetch_assoc()) {
            $avatarPath = $a["avatar"];
            array_push($trainers, $a);
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
    <title>Trainer Details</title>
    <style>
        .bgs {
            height: 618px;
        }

        .user {
            display: flex;
            justify-content: center;
            margin-left: 220px;
        }

        .user table {
            margin-top: 85px;
            width: 1000px;
        }

        .user table tr {
            height: 50px;
        }

        .user table tr th {
            font-size: 17px;
        }

        .user table tr td {
            text-align: center;
            font-size: 17px;
            margin: 5px;
            text-decoration: none;
        }

        .user table tr td .btn1 {
            border: 6px solid Green;
            border-radius: 5px;
            background-color: Green;
            color: #fff;
            text-decoration: none;
            font-size: 17px;
        }

        .user table tr td .btn2 {
            border: 6px solid red;
            border-radius: 5px;
            background-color: red;
            color: #fff;
            text-decoration: none;
            font-size: 17px;
        }

        .user table tr th .btn3 {
            border: 6px solid brown;
            border-radius: 5px;
            background-color: brown;
            color: #fff;
            text-decoration: none;
            font-size: 17px;
        }
    </style>
</head>

<body>
    <div class="bgs">
        <div class="user">

            <table>
                <tr>
                    <th colspan="9" style="color:green">Trainer Detail</th>
                </tr>
                <tr>
                    <!-- <th rowspan="7">User Details</th> -->
                    <th>id</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Trainername</th>
                    <th>Gender</th>
                    <th colspan="3">Operation</th>
                    <th rowspan="7">
                        <a class="btn3" href="add_trainer.php"><i class="fa-solid fa-plus"></i>Add Trainer</a>
                    </th>
                </tr>
                <?php for ($i = 0; $i < count($trainers); $i++) { ?>
                    <tr>
                        <td><?php echo $i + 1 ?></td>
                        <td><?php echo $trainers[$i]['name'] ?></td>
                        <td><?php echo $trainers[$i]['address'] ?></td>
                        <td><?php echo $trainers[$i]['phone'] ?></td>
                        <td><?php echo $trainers[$i]['email'] ?></td>
                        <td><?php echo $trainers[$i]['trainername'] ?></td>
                        <td><?php echo $trainers[$i]['gender'] ?></td>
                        <td>
                            <a class="btn1" href="update_trainer.php?id=<?php echo $trainers[$i]['id'] ?>"><i class="fa-solid fa-pen-to-square"></i>update</a>
                        </td>
                        <td>
                            <a class="btn2" href="del.php?id=<?php echo $trainers[$i]['id'] ?>" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i>delete</a>
                        </td>

                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>

</html>