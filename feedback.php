<?php
ob_start();              // allow redirects even if nav.php echoed
session_start();
$id = $_GET['id'] ?? '';

// handle form before any HTML is sent
if (isset($_POST['btnRegister'])) {
    $err = [];
    $trainername = isset($_POST['trainername']) && trim($_POST['trainername']) !== '' ? $_POST['trainername'] : ($err['trainername'] = "Enter trainername") && null;
    $username    = isset($_POST['username'])    && trim($_POST['username'])    !== '' ? $_POST['username']    : ($err['username']    = "Enter Username") && null;
    $query       = isset($_POST['query'])       && trim($_POST['query'])       !== '' ? $_POST['query']       : ($err['query']       = "Enter your query") && null;

    if (count($err) === 0) {
        try {
            $conn = new mysqli('localhost', 'root', '', 'gym');
            if ($conn->connect_error) throw new Exception($conn->connect_error);
            $stmt = $conn->prepare("INSERT INTO feedback (trainername, username, message) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $trainername, $username, $query);
            $stmt->execute();
            if ($stmt->affected_rows === 1) {
                header('Location: f.php');
                exit;
            }
        } catch (Exception $e) {
            die('Database  Error : ' . $e->getMessage());
        }
    }
}

// fetch selected dietplan row to prefill To/From
try {
    $conn = new mysqli('localhost', 'root', '', 'gym');
    if ($conn->connect_error) throw new Exception($conn->connect_error);
    $idSafe = (int)$id;
    $res = $conn->query("SELECT * FROM dietplan WHERE id={$idSafe} LIMIT 1");
    if ($res && $res->num_rows === 1) {
        $dietplan = $res->fetch_assoc(); // has trainername, username, goal, etc.
        extract($dietplan, EXTR_SKIP);
    } else {
        die("data not found");
    }
} catch (Exception $e) {
    die('Database  Error : ' . $e->getMessage());
}

// include nav AFTER logic; if your nav prints <html>/<body>, we’ll use a container div below
include "nav.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Send Feedback</title>
    <style>
        /* ===== THEME (scoped) ===== */
        .feedback-page {
            --bg-start: #1a1a1a;
            --bg-end: #2d2d2d;
            --text: #fff;
            --muted: #cfcfcf;
            --accent: #e74c3c;
            --card: rgba(255, 255, 255, .06);
            --border: rgba(255, 255, 255, .15);
            --shadow: 0 24px 48px rgba(0, 0, 0, .35);

            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            background: linear-gradient(135deg, var(--bg-start) 0%, var(--bg-end) 100%);

            /* layout + spacing */
            min-height: 100vh;
            display: flex;
            align-items: flex-start;
            /* respect top padding (sticky nav) */
            justify-content: center;

            /* safe space for your sticky nav/footer */
            --nav-h: 65px;
            /* fallback if not set globally */
            padding: calc(var(--nav-h) + 24px) 16px 96px;
            /* top | sides | bottom */
            box-sizing: border-box;
        }

        .feedback-card {
            width: 100%;
            max-width: 840px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 22px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
            overflow: hidden;
            scroll-margin-top: calc(var(--nav-h) + 16px);
        }

        .fb-head {
            padding: 24px 22px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
            background: rgba(255, 255, 255, .04);
        }

        .fb-title {
            margin: 0;
            font-weight: 900;
            font-size: clamp(22px, 4vw, 28px);
            text-shadow: 0 2px 10px rgba(0, 0, 0, .35);
        }

        .fb-sub {
            margin: 6px 0 0;
            color: var(--muted);
        }

        .fb-body {
            padding: 22px;
        }

        .form-row {
            margin-bottom: 14px;
        }

        label {
            display: block;
            font-weight: 800;
            font-size: 13px;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: #fff;
            margin-bottom: 6px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: rgba(255, 255, 255, .08);
            color: #fff;
            outline: none;
            transition: border-color .2s, box-shadow .2s, background .2s, transform .1s;
        }

        textarea {
            resize: vertical;
            min-height: 140px;
        }

        input::placeholder,
        textarea::placeholder {
            color: #9aa0a6;
        }

        input:focus,
        textarea:focus {
            border-color: rgba(231, 76, 60, .85);
            box-shadow: 0 0 0 4px rgba(231, 76, 60, .15);
            background: rgba(255, 255, 255, .1);
            transform: translateY(-1px);
        }

        .err {
            display: block;
            color: #ff8a8a;
            font-weight: 700;
            margin-top: 6px;
            font-size: .92rem;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 6px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, .18);
            background: rgba(255, 255, 255, .08);
            color: #fff;
            font-weight: 800;
            cursor: pointer;
            text-decoration: none;
            transition: .2s;
            box-shadow: 0 8px 18px rgba(0, 0, 0, .25);
        }

        .btn:hover {
            background: rgba(255, 255, 255, .15);
            transform: translateY(-1px);
        }

        .btn-primary {
            background: var(--accent);
            border-color: rgba(231, 76, 60, .9);
        }

        .btn-primary:hover {
            background: #ff5b49;
        }

        .btn-ghost {
            background: transparent;
            border-color: rgba(255, 255, 255, .25);
        }

        .meta {
            margin-top: 8px;
            color: var(--muted);
            font-size: .95rem;
        }

        .meta strong {
            color: #fff;
        }

        @media (max-width:680px) {
            .feedback-page {
                padding: calc(var(--nav-h) + 16px) 12px 80px;
            }

            .feedback-card {
                border-radius: 18px;
            }
        }
    </style>
</head>

<body>
    <!-- Use a CONTAINER DIV (not body class) because nav.php already opened <body> -->
    <div class="feedback-page">
        <section class="feedback-card">
            <header class="fb-head">
                <h1 class="fb-title">Send Feedback</h1>
                <p class="fb-sub">Reply to your trainer about this plan.</p>
                <?php if (!empty($goal)): ?>
                    <p class="meta">Plan message: <strong><?php echo htmlspecialchars($goal); ?></strong></p>
                <?php endif; ?>
            </header>

            <div class="fb-body">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=<?php echo urlencode($id); ?>"
                    method="post">
                    <div class="form-row">
                        <label for="trainername">To Trainer</label>
                        <input type="text" id="trainername" name="trainername"
                            value="<?php echo isset($trainername) ? htmlspecialchars($trainername) : ''; ?>" required>
                        <?php if (!empty($err['trainername'])): ?><span
                                class="err"><?php echo $err['trainername']; ?></span><?php endif; ?>
                    </div>

                    <div class="form-row">
                        <label for="username">From User</label>
                        <input type="text" id="username" name="username"
                            value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" required>
                        <?php if (!empty($err['username'])): ?><span
                                class="err"><?php echo $err['username']; ?></span><?php endif; ?>
                    </div>

                    <div class="form-row">
                        <label for="query">Your Message</label>
                        <textarea id="query" name="query" placeholder="Write your message to the trainer..."
                            required></textarea>
                        <?php if (!empty($err['query'])): ?><span
                                class="err"><?php echo $err['query']; ?></span><?php endif; ?>
                    </div>

                    <div class="actions">
                        <button type="submit" name="btnRegister" value="Register" class="btn btn-primary">Send</button>
                        <a href="f.php" class="btn btn-ghost">Cancel</a>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <?php include "footer.php"; ?>
</body>

</html>
<?php ob_end_flush(); ?>