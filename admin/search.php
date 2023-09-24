
<?php
include("adm.php");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $product_name = $_GET["product_name"];
    $conn = new mysqli("localhost", "root", "", "gym");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT * FROM gym_user WHERE 1=1";

    if (!empty($product_name)) {
        $sql .= " AND username LIKE '%$product_name%'";
    }
    $result = mysqli_query($conn, $sql);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search value</title>
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
            font-size: 18px;
        }

        .user table tr td {
            text-align: center;
            font-size: 18px;
            margin: 5px;
            text-decoration: none;
        }

        .user table tr td .btn1 {
            border: 6px solid Green;
            border-radius: 5px;
            background-color: Green;
            color: #fff;
            text-decoration: none;
            font-size: 18px;
        }

        .user table tr td .btn2 {
            border: 6px solid red;
            border-radius: 5px;
            background-color: red;
            color: #fff;
            text-decoration: none;
            font-size: 18px;
        }

        .user table tr th .btn3 {
            border: 6px solid brown;
            border-radius: 5px;
            background-color: brown;
            color: #fff;
            text-decoration: none;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <?php
    if (mysqli_num_rows($result) > 0) { ?>
        <div class="bgs">
            <div class="user">
                <table>
                    <tr>
                        <th colspan="9" style="color:Red">User Detail</th>
                    </tr>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Gender</th>
                        <th colspan="3">Operation</th>
                        <th rowspan="7">
                            <a class="btn3" href="add_user.php"><i class="fa-solid fa-plus"></i>Add User</a>
                        </th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['phone'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['username'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td>
                                <a class="btn1" href="update_user.php?id=<?php echo $row['id'] ?>"><i class="fa-solid fa-pen-to-square"></i>update</a>
                            </td>
                            <td>
                                <a class="btn2" href="delete.php?id=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i>delete</a>
                            </td>

                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    <?php } ?>
    <?php
    mysqli_close($conn);
    ?>
</body>

</html>