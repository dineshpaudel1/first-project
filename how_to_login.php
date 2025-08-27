<?php
session_start();
if (isset($_SESSION["email"])) {
    header("location:f.php");
}
include("nav.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Options</title>
    <style>
    /* ===== Theme (same as previous design) ===== */
    .login-page {
        --bg-start: #1a1a1a;
        --bg-end: #2d2d2d;
        --text: #ffffff;
        --muted: #cccccc;
        --accent: #e74c3c;
        --card-bg: rgba(255, 255, 255, .06);
        --card-border: rgba(255, 255, 255, .15);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text);
        background: linear-gradient(135deg, var(--bg-start) 0%, var(--bg-end) 100%);
        min-height: 100vh;
    }

    .login-main {
        min-height: calc(100vh - 1px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 100px 16px 80px;
    }

    .login-card {
        max-width: 600px;
        width: 100%;
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 18px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, .35);
        backdrop-filter: blur(10px);
        padding: 36px 26px 30px;
        text-align: center;
    }

    .login-card h3 {
        font-weight: 800;
        font-size: 26px;
        margin-bottom: 10px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, .35);
    }

    .login-card p {
        color: var(--muted);
        margin-bottom: 26px;
        line-height: 1.6;
    }

    .btn-choice {
        display: inline-block;
        width: 220px;
        margin: 10px;
        padding: 14px 20px;
        border-radius: 999px;
        border: 1px solid rgba(231, 76, 60, .9);
        background: var(--accent);
        color: #fff;
        font-size: 16px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: background .2s ease, transform .1s ease, box-shadow .2s ease;
        box-shadow: 0 8px 20px rgba(231, 76, 60, .35);
    }

    .btn-choice:hover {
        background: #ff5b49;
        transform: translateY(-1px);
        box-shadow: 0 12px 26px rgba(231, 76, 60, .45);
    }

    .btn-choice:active {
        transform: translateY(0);
    }
    </style>
</head>

<body class="login-page">
    <main class="login-main">
        <div class="login-card">
            <h3>How do you want to Login?</h3>
            <p>
                Choose your login type below. <br>
                Customers can access fitness plans, Trainers can manage users, and Admins handle system management.
            </p>
            <div class="actions">
                <a href="customer_login.php" class="btn-choice">Customer Login</a>
                <a href="trainer_login.php" class="btn-choice">Trainer Login</a>
            </div>
        </div>
    </main>

    <?php include('footer.php'); ?>
</body>

</html>