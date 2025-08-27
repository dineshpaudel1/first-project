<?php
session_start();
if (isset($_SESSION['username'])) {
    $usernamet = $_SESSION['username'];
}

$name = $address = $phone = $gender = $res = $package = $coach = $time = '';
if (isset($_POST['btnRegister'])) {
    $package = $_POST['package'];
    $coach   = $_POST['coach'];
    $time    = $_POST['time'];
    $err = [];

    if (isset($_POST['name']) && !empty($_POST['name']) && trim($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $err['name'] = "Enter name";
    }

    if (isset($_POST['address']) && !empty($_POST['address']) && trim($_POST['address'])) {
        $address = $_POST['address'];
    } else {
        $err['address'] = "Enter address";
    }

    if (isset($_POST['phone']) && !empty($_POST['phone']) && trim($_POST['phone'])) {
        $phone = $_POST['phone'];
    } else {
        $err['phone'] = "Enter phone";
    }

    if (isset($_POST['gender']) && !empty($_POST['gender']) && trim($_POST['gender'])) {
        $gender = $_POST['gender'];
    } else {
        $err['gender'] = "Enter gender";
    }

    if (count($err) == 0) {
        try {
            $conn = new mysqli('localhost', 'root', '', 'gym');
            $sql = "insert into enrollment (name,address,phone,package,coach,time,gender) values('$name','$address','$phone','$package','$coach','$time','$gender')";
            $conn->query($sql);
            if ($conn->affected_rows > 0 && $conn->insert_id > 0) {
                header('location:index.php');
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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gym Registration</title>
    <style>
        :root {
            --bg-1: #0f0f10;
            --bg-2: #1b1b1e;
            --accent: #e74c3c;
            --text: #ffffff;
            --muted: #cfcfcf;
            --card: rgba(255, 255, 255, .08);
            --border: rgba(255, 255, 255, .15);
            --ring: rgba(231, 76, 60, .35);
            --shadow: 0 30px 60px rgba(0, 0, 0, .45);
            --radius: 18px;
            --maxw: 980px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        body {
            font-family: system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif;
            color: var(--text);
            min-height: 100vh;
            background:
                radial-gradient(1200px 600px at 10% -10%, #21212a 0%, transparent 60%),
                radial-gradient(1200px 600px at 110% 110%, #2a1b1b 0%, transparent 60%),
                linear-gradient(135deg, var(--bg-1), var(--bg-2));
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
        }

        .wrap {
            width: 100%;
            max-width: var(--maxw);
        }

        .card {
            background: var(--card);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            border-radius: var(--radius);
            overflow: hidden;
        }

        .head {
            padding: 28px 28px 12px 28px;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(180deg, rgba(255, 255, 255, .06), rgba(255, 255, 255, 0));
        }

        .head h1 {
            font-size: clamp(22px, 3vw, 30px);
            letter-spacing: .3px;
        }

        .sub {
            color: var(--muted);
            margin-top: 6px;
            font-size: 14px;
        }

        form {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 18px;
            padding: 28px;
        }

        .col-6 {
            grid-column: span 6;
        }

        .col-12 {
            grid-column: span 12;
        }

        @media (max-width: 720px) {
            .col-6 {
                grid-column: span 12;
            }
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        label {
            font-size: 14px;
            color: #eaeaea;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 14px 14px;
            border-radius: 12px;
            border: 1px solid var(--border);
            background: rgba(0, 0, 0, .25);
            color: var(--text);
            outline: none;
            font-size: 15px;
            transition: box-shadow .15s ease, border-color .15s ease, transform .04s ease;
        }

        input[type="text"]:focus,
        select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 6px var(--ring);
        }

        .radios {
            display: flex;
            gap: 18px;
            align-items: center;
            flex-wrap: wrap;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: rgba(0, 0, 0, .2);
        }

        .radio {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            grid-column: 1 / -1;
            margin-top: 4px;
        }

        .btn {
            appearance: none;
            border: 1px solid transparent;
            background: var(--accent);
            color: #fff;
            font-weight: 700;
            padding: 14px 22px;
            border-radius: 999px;
            cursor: pointer;
            letter-spacing: .3px;
            transition: transform .06s ease, filter .15s ease, box-shadow .15s ease;
            box-shadow: 0 12px 24px rgba(231, 76, 60, .25);
        }

        .btn:hover {
            filter: brightness(1.05);
        }

        .btn:active {
            transform: translateY(1px) scale(.99);
        }

        .err {
            color: #ffb4b4;
            font-size: 12px;
            line-height: 1.2;
        }

        /* helper chip under selects */
        .hint {
            color: var(--muted);
            font-size: 12px;
        }

        /* footer spacer if your nav/footer is fixed */
        .spacer {
            height: 8px;
        }

        .back-btn {
            display: inline-block;
            text-align: center;
            background: #555;
            /* gray background */
            box-shadow: 0 12px 24px rgba(0, 0, 0, .25);
        }

        .back-btn:hover {
            filter: brightness(1.1);
        }
    </style>
</head>

<?php
try {
    $gym_user = [];
    $err = isset($err) ? $err : [];
    require_once 'connection.php';
    $sql = "SELECT * FROM gym_user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usernamet);
    $stmt->execute();
    $res = $stmt->get_result();
    $gym_user = $res->fetch_assoc();
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>

<body>
    <div class="wrap">

        <div class="card">

            <div class="head">
                <h1>Gym Enrollment Form</h1>
                <p class="sub">Fill your details and pick your package, coach, and timing.</p>
            </div>

            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form">
                <!-- Name -->
                <div class="field col-6">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name" placeholder="e.g., John Doe"
                        value="<?php echo $gym_user['username']; ?>">
                    <span class="err"><?php echo (isset($err['name']) ? $err['name'] : ''); ?></span>
                </div>

                <!-- Phone -->
                <div class="field col-6">
                    <label for="phone">Phone *</label>
                    <input type="text" id="phone" name="phone" placeholder="98XXXXXXXX"
                        value="<?php echo $gym_user['phone']; ?>">
                    <span class="err"><?php echo (isset($err['phone']) ? $err['phone'] : ''); ?></span>
                </div>

                <!-- Address -->
                <div class="field col-12">
                    <label for="address">Address *</label>
                    <input type="text" id="address" name="address" placeholder="Street, City"
                        value="<?php echo $gym_user['address']; ?>">
                    <span class="err"><?php echo (isset($err['address']) ? $err['address'] : ''); ?></span>
                </div>

                <!-- Package -->
                <div class="field col-6">
                    <label for="package">Package *</label>
                    <select name="package" id="package" required>
                        <option value="">Select a Plan</option>
                        <?php
                        require_once "connection.php";
                        $query = "SELECT * FROM package";
                        $result = $conn->query($query);
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['plan'] . '">' . $row['plan'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <span class="hint">Choose from available membership plans.</span>
                </div>

                <!-- Coach -->
                <div class="field col-6">
                    <label for="coach">Coach *</label>
                    <select name="coach" id="coach" required>
                        <option value="">Select a Coach</option>
                        <?php
                        $query = "SELECT * FROM trainer";
                        $result = $conn->query($query);
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['trainername'] . '">' . $row['trainername'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <span class="hint">Pick your preferred trainer.</span>
                </div>

                <!-- Time -->
                <div class="field col-6">
                    <label for="time">Time Shift *</label>
                    <select name="time" id="time" required>
                        <option value="">Select Time Shift</option>
                        <?php
                        $query = "SELECT * FROM package";
                        $result = $conn->query($query);
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['shift'] . '">' . $row['shift'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <span class="hint">Morning / Day / Evening, etc.</span>
                </div>

                <!-- Gender -->
                <div class="field col-6">
                    <label>Gender *</label>
                    <div class="radios">
                        <label class="radio">
                            <input type="radio" name="gender" value="Male"> Male
                        </label>
                        <label class="radio">
                            <input type="radio" name="gender" value="Female"> Female
                        </label>
                    </div>
                    <span class="err"><?php echo (isset($err['gender']) ? $err['gender'] : ''); ?></span>
                </div>

                <!-- Actions -->
                <div class="actions">
                    <!-- Back button -->
                    <a href="index.php" class="btn back-btn">← Back</a>
                    <!-- Register button -->
                    <button class="btn" name="btnRegister" value="Register">Register</button>
                </div>
            </form>
        </div>
        <div class="spacer"></div>
    </div>
</body>


</html>