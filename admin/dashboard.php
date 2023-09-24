<?php require_once 'check_admin.php'; ?>
<?php require_once 'expire_session.php'; ?>
<?php include('adm.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <script src="https://kit.fontawesome.com/504bf32129.js" crossorigin="anonymous"></script>
    <style>
        .home-content {
            height: 600px;
            width: 95%;
        }

        .home-content .box2,
        .box3,
        .box4 h2 {
            color: black;
            text-align: center;
            padding: 50px;
        }



        .home-content .box3 {
            border: 2px solid black;
            border-radius: 20px;
            margin: 10px;
            height: 200px;
            width: 18%;
            float: right;
        }

        .home-content button {
            width: 130px;
            height: 30px;
            border: 1px solid;
            background: #2691d9;
            border-radius: 20px;
            font-size: 15px;
            color: #e9f4fb;
            font-weight: 700;
            cursor: pointer;
            outline: none;
        }
    </style>
</head>

<body>
    <div class="home-content"><br><br><br><br><br><br>
        <div class="box3">
            <h2>User Enrollment</h2>
            <i class="fa-sharp fa-solid fa-arrow-right"></i><br><br>
            <a href="enrolled.php"><button>View Detais</button></a>
        </div>
        <div class="box3">
            <h2>Gym Package</h2>
            <i class="bx bx-pie-chart-alt-2"></i></i><br><br>
            <a href="packaged.php"><button>View Detais</button></a>
        </div>
        <div class="box3">
            <h2>My Trainers</h2>
            <i class="bx bx-list-ul"></i><br><br>
            <a href="Trainer.php"><button>View Detais</button></a>
        </div>
        <div class="box3">
            <h2>My Gym Users</h2>
            <i class="fa-solid fa-user"></i><br><br>
            <a href="user.php"><button>View Details</button></a>
        </div>

    </div>
</body>

</html>