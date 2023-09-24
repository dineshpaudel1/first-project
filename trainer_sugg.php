<?php
session_start();
if (isset($_SESSION['trainername'])) {
    $trainernamet = $_SESSION['trainername'];
    $uid = $_SESSION['id'];
}
include("nav.php");
$id = $_GET['id'];
$queries = $c_user = '';
if (isset($_POST['btnQueries'])) {
    $err = [];
    if (isset($_POST['c_user']) && !empty($_POST['c_user']) && trim($_POST['c_user'])) {
        $c_user = $_POST['c_user'];
    } else {
        $err['c_user'] = "Enter c_user";
    }
    if (isset($_POST['queries']) && !empty($_POST['queries']) && trim($_POST['queries'])) {
        $queries = $_POST['queries'];
    } else {
        $err['queries'] = "Enter queries";
    }

    if (count($err) == 0) {
        try {
            $conn = new mysqli('localhost', 'root', '', 'bot');
            $sql = "insert into t_message (c_user,queries) values('$c_user','$queries')";
            $conn->query($sql);
            if ($conn->affected_rows == 1 && $conn->insert_id > 0) {
                header('location:myuser.php?action=1');
            }
        } catch (Exception $e) {
            die('Database  Error : ' . $e->getMessage());
        }
    }
}

try {
    $conn = new mysqli('localhost', 'root', '', 'gym');
    $sql = "select * from enrollment where id=$id";
    $res = $conn->query($sql);
    if ($res->num_rows == 1) {
        $user = $res->fetch_assoc();
        extract($user);
    } else {
        die("data not found");
    }
} catch (Exception $e) {
    die('Database  Error : ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }


        * {
            box-sizing: border-box;
        }

        /* Style inputs */
        input[type=text],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }

        input[type=submit] {
            background-color: crimson;
            color: white;
            padding: 12px 20px;
            border: none;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        /* Style the container/contact section */
        .container {
            height: 87.1vh;
            width: 100%;
            border-radius: 5px;
            background: linear-gradient(to right, #2691d9, #ffffff);
            padding: 10px;
        }

        /* Create two columns that float next to eachother */
        .column {
            float: left;
            width: 50%;
            margin-top: 6px;
            padding: 20px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {

            .column,
            input[type=submit] {
                width: 100%;
                margin-top: 0;
            }
        }
    </style>
</head>
<?php
try {
    $conn = new mysqli('localhost', 'root', '', 'bot');
    $sql = "select * from c_message where t_user= '$trainernamet'";
    $res = $conn->query($sql);
    if ($res->num_rows == 1) {
        $user = $res->fetch_assoc();
        extract($user);
    } else {
        die("data not found");
    }
} catch (Exception $e) {
    die('Database  Error : ' . $e->getMessage());
}
?>
<body>
    <div class="container">
        <div style="text-align:center">
        </div>
        <div class="row">
            <div class="column">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $id ?>" method="post" class="form1">
                    <label for="subject">User Name</label>
                    <input type="text" name="c_user" placeholder="Name*" value="<?php echo $name; ?>">
                    <label for="subject">User Replies</label>
                    <input type="text" name="" placeholder="Name*" value="<?php echo $c_replies; ?>">
                    <label for="subject">Give Your Suggest</label>
                    <textarea id="subject" name="queries" placeholder="Write something.." style="height:170px"></textarea>
                    <a href="#"><input type="submit" name="btnQueries" value="Submit"></a>
                </form>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>

</html>