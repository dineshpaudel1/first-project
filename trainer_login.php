<?php
include("nav.php");

if (isset($_POST['btnLogin'])) {
    $err  = [];
    if (isset($_POST['trainername']) && !empty($_POST['trainername']) && trim($_POST['trainername'])) {
        $trainername = $_POST['trainername'];
    } else {
        $err['trainername'] = "Enter trainername";
    }

    if (isset($_POST['password']) && !empty($_POST['password']) && trim($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $err['password'] =  'Enter password';
    }

    require_once 'connection.php';
    if ($conn->connect_error) {
        die("Connection Failed : " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("select * from trainer where trainername = ?");
        $stmt->bind_param("s", $trainername);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if ($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();
            if ($data['password'] === $password) {
                header('location:index.php');
            } else {
                echo "<h2>invalid password</h2>";
            }
            session_start();
            $_SESSION['trainername'] =  $trainername;
            $_SESSION['login_status'] = true;
            header('location:index.php');
        } else {
            echo "<h2>invalid username</h2>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trainer Login - FitZone</title>
    <script src="https://kit.fontawesome.com/504bf32129.js" crossorigin="anonymous"></script>
    <style>
        :root {
            --bg-start: #1a1a1a;
            --bg-end: #2d2d2d;
            --text: #ffffff;
            --muted: #cccccc;
            --accent: #e74c3c;
            --card-bg: rgba(255, 255, 255, .06);
            --card-border: rgba(255, 255, 255, .15);
            --maxw: 1200px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        /* any PHP echo errors */
        body>h2 {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #ffb3b3;
            background: rgba(231, 76, 60, .12);
            border: 1px solid rgba(231, 76, 60, .35);
            border-radius: 10px;
            padding: 10px 12px;
            max-width: var(--maxw);
            margin: 12px auto 0;
            text-align: center;
            font-size: 1rem;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            background: linear-gradient(135deg, var(--bg-start) 0%, var(--bg-end) 100%);
            min-height: 100vh;
        }

        /* center only the page content, keep footer separate */
        .page {
            min-height: calc(100vh - 160px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 16px;
        }

        .login-wrap {
            width: 100%;
            max-width: 420px;
        }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 18px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .35);
            backdrop-filter: blur(10px);
            overflow: hidden;
        }

        .card-head {
            text-align: center;
            padding: 22px 16px 10px;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
            background: rgba(255, 255, 255, .04);
        }

        .brand-mark {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #fff;
            font-weight: 800;
            letter-spacing: .3px;
        }

        .brand-mark i {
            color: var(--accent)
        }

        .title {
            font-size: 1.6rem;
            font-weight: 800;
            margin: 6px 0 2px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, .35);
        }

        .sub {
            color: var(--muted);
            margin: 0 0 6px;
        }

        .card-body {
            padding: 22px 20px 20px;
        }

        .form-row {
            margin-bottom: 14px;
        }

        label {
            display: block;
            font-weight: 800;
            font-size: 13px;
            color: #fff;
            letter-spacing: .08em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .field {
            position: relative;
        }

        .field .icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--accent);
        }

        .toggle-eye {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #ddd;
            cursor: pointer;
            border: none;
            background: transparent;
        }

        .toggle-eye:hover {
            color: #fff
        }

        .input {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 1px solid var(--card-border);
            border-radius: 12px;
            background: rgba(255, 255, 255, .08);
            color: #fff;
            outline: none;
            font-size: 15.5px;
            transition: border-color .2s, box-shadow .2s, background .2s, transform .1s;
        }

        .input::placeholder {
            color: #9aa0a6
        }

        .input:focus {
            border-color: rgba(231, 76, 60, .9);
            background: rgba(255, 255, 255, .1);
            box-shadow: 0 0 0 4px rgba(231, 76, 60, .15);
            transform: translateY(-1px);
        }

        .row-inline {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-top: 6px;
        }

        .remember {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #fff;
            font-weight: 600;
            font-size: .95rem;
        }

        .remember input {
            transform: translateY(1px)
        }

        .btn {
            width: 100%;
            border: 1px solid rgba(231, 76, 60, .9);
            background: var(--accent);
            color: #fff;
            font-weight: 800;
            font-size: 16px;
            padding: 12px 16px;
            border-radius: 999px;
            cursor: pointer;
            box-shadow: 0 10px 26px rgba(231, 76, 60, .35);
            transition: background .2s, transform .1s, box-shadow .2s;
            margin-top: 4px;
        }

        .btn:hover {
            background: #ff5b49;
            transform: translateY(-1px);
            box-shadow: 0 14px 30px rgba(231, 76, 60, .45);
        }

        .btn:active {
            transform: translateY(0)
        }

        .links {
            margin-top: 12px;
            text-align: center;
            color: var(--muted);
        }

        .links a {
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            border-bottom: 1px solid transparent;
            transition: border-color .2s, color .2s;
        }

        .links a:hover {
            color: var(--accent);
            border-color: var(--accent);
        }

        @media (max-width:480px) {
            .title {
                font-size: 1.4rem;
            }
        }
    </style>
</head>

<body>
    <main class="page">
        <div class="login-wrap">
            <section class="card">
                <header class="card-head">
                    <span class="brand-mark"><i class="fa-solid fa-dumbbell"></i> FitZone Gym</span>
                    <h1 class="title">Trainer Login</h1>
                    <p class="sub">Welcome back! Please sign in to continue.</p>
                </header>

                <div class="card-body">
                    <form class="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" novalidate>
                        <div class="form-row">
                            <label for="trainername">Trainername</label>
                            <div class="field">
                                <i class="fa-solid fa-user-tie icon"></i>
                                <input class="input" type="text" id="trainername" name="trainername"
                                    placeholder="Enter your trainername" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <label for="password">Password</label>
                            <div class="field">
                                <i class="fa-solid fa-lock icon"></i>
                                <input class="input" type="password" id="password" name="password"
                                    placeholder="Enter your password" required>
                                <button type="button" class="toggle-eye" id="togglePassword"
                                    aria-label="Show/Hide password">
                                    <i class="fa-solid fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>

                        <div class="row-inline">
                            <label class="remember">
                                <input type="checkbox" name="remember" value="1"> Remember me
                            </label>
                            <span style="color:var(--muted)">Need help?</span>
                        </div>

                        <button value="Login" name="btnLogin" class="btn">Login</button>

                        <div class="links">
                            Not a trainer? <a href="how_to_login.php">Choose another login</a>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </main>

    <script>
        // Show/Hide password
        (function() {
            const btn = document.getElementById('togglePassword');
            const input = document.getElementById('password');
            if (btn && input) {
                btn.addEventListener('click', function() {
                    const show = input.getAttribute('type') === 'password';
                    input.setAttribute('type', show ? 'text' : 'password');
                    this.innerHTML = show ?
                        '<i class="fa-solid fa-eye"></i>' :
                        '<i class="fa-solid fa-eye-slash"></i>';
                });
            }
        })();
    </script>

    <?php include("footer.php"); ?>
</body>

</html>