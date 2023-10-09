<?php
session_start();
include "nav.php";
$id = $_GET['id'];

if (isset($_POST['btnRegister'])) {
    $err = [];
    if (isset($_POST['trainername']) && !empty($_POST['trainername']) && trim($_POST['trainername'])) {
        $trainername = $_POST['trainername'];
    } else {
        $err['trainername'] = "Enter trainername";
    }
    if (isset($_POST['username']) && !empty($_POST['username']) && trim($_POST['username'])) {
        $username = $_POST['username'];
    } else {
        $err['username'] = "Enter Username";
    }
    if (isset($_POST['query']) && !empty($_POST['query']) && trim($_POST['query'])) {
        $query = $_POST['query'];
    } else {
        $err['query'] = "Enter your query ";
    }

    if (count($err) == 0) {
        try {
            $conn = new mysqli('localhost', 'root', '', 'gym');
            $sql = "insert into feedback (trainername,username,message) values('$trainername','$username','$query')";
            $conn->query($sql);
            if ($conn->affected_rows == 1 && $conn->insert_id > 0) {
                header('location:f.php');
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beautiful Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            background-image: url(images/image-1.jpg);
            background-size: cover;
        }

        .gap {
            margin: 130px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        button {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<?php
try {
    $conn = new mysqli('localhost', 'root', '', 'gym');
    $sql = "select * from dietplan where id=$id";
    $res = $conn->query($sql);
    if ($res->num_rows == 1) {
        $dietplan = $res->fetch_assoc();
        extract($dietplan);
    } else {
        die("data not found");
    }
} catch (Exception $e) {
    die('Database  Error : ' . $e->getMessage());
}
?>

<body>
    <div class="gap">
        <div class="container">
            <h2>MY Feedback</h2>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $id ?>" method="post" class="form1">
                <div class="form-group">
                    <label for="trainername">To Trainername:</label>
                    <input type="text" id="trainername" name="trainername" value="<?php echo $trainername; ?>" required>
                </div>
                <div class="form-group">
                    <label for="username">From Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>
                </div>
                <div class="group">
                    <textarea id="query" name="query" rows="5" required placeholder="Write Your query..."></textarea>
                </div>
                <button type="submit" name="btnRegister" value="Register">Send</button>
            </form>
        </div>
    </div>
</body>
<?php include "footer.php";
?>

</html>