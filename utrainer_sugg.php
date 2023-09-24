<?php
$id = "";
session_start();
if (isset($_SESSION['username'])) {
    $usernamet = $_SESSION['username'];
    $uid = $_SESSION['id'];
}
include("nav.php");
$queries = $t_user = '';
if (isset($_POST['btnQueries'])) {
    $err = [];
    if (isset($_POST['t_user']) && !empty($_POST['t_user']) && trim($_POST['t_user'])) {
        $t_user = $_POST['t_user'];
    } else {
        $err['t_user'] = "Enter t_user";
    }
    if (isset($_POST['queries']) && !empty($_POST['queries']) && trim($_POST['queries'])) {
        $queries = $_POST['queries'];
    } else {
        $err['queries'] = "Enter queries";
    }

    if (count($err) == 0) {
        try {
            $conn = new mysqli('localhost', 'root', '', 'bot');
            $sql = "insert into c_message (t_user,c_replies) values('$t_user','$queries')";
            $conn->query($sql);
            if ($conn->affected_rows == 1 && $conn->insert_id > 0) {
                header('location:f.php?action=1');
            }
        } catch (Exception $e) {
            die('Database  Error : ' . $e->getMessage());
        }
    }
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
    $conn = new mysqli('localhost', 'root', '', 'gym');
    $sql = "select * from enrollment where name= '$usernamet'";
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
<?php
try {
    $conn = new mysqli('localhost', 'root', '', 'bot');
    $sql = "select * from t_message where c_user= '$usernamet'";
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
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form1">
                    <label for="subject">My Trainer</label>
                    <input type="text" name="t_user" placeholder="Name*" value="<?php echo $coach; ?>">
                    <label for="subject">Trainer Suggestion</label>
                    <input type="text" name="" placeholder="Name*" value="<?php echo $queries; ?>">
                    <label for="subject">Give Replies</label>
                    <textarea id="subject" name="queries" placeholder="Write something.." style="height:170px"></textarea>
                    <a href="#"><input type="submit" name="btnQueries" value="Submit"></a>
                </form>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>

</html>