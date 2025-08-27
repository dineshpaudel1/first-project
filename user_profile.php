<?php
session_start();
include("nav.php");

// ---- fetch profile data (read-only) ----
$role = null;
$displayName = 'Guest';
$address = $phone = $email = '—';

try {
    $conn = new mysqli('localhost', 'root', '', 'gym');
    if ($conn->connect_error) {
        throw new Exception($conn->connect_error);
    }

    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        $role = 'user';
        $displayName = $_SESSION['username'];
        $stmt = $conn->prepare("SELECT address, phone, email FROM gym_user WHERE username = ?");
        $stmt->bind_param("s", $displayName);
        $stmt->execute();
        $stmt->bind_result($addr, $ph, $em);
        if ($stmt->fetch()) {
            $address = $addr ?: '—';
            $phone   = $ph   ?: '—';
            $email   = $em   ?: '—';
        }
        $stmt->close();
    } elseif (isset($_SESSION['trainername']) && !empty($_SESSION['trainername'])) {
        $role = 'trainer';
        $displayName = $_SESSION['trainername'];
        $stmt = $conn->prepare("SELECT address, phone, email FROM trainer WHERE trainername = ?");
        $stmt->bind_param("s", $displayName);
        $stmt->execute();
        $stmt->bind_result($addr, $ph, $em);
        if ($stmt->fetch()) {
            $address = $addr ?: '—';
            $phone   = $ph   ?: '—';
            $email   = $em   ?: '—';
        }
        $stmt->close();
    }
    $conn->close();
} catch (Exception $e) {
    // keep UI clean; optionally log the error
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>User Profile - FitZone</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
    :root {
        --bg-start: #1a1a1a;
        --bg-end: #2d2d2d;
        --text: #ffffff;
        --muted: #cccccc;
        --accent: #e74c3c;
        --card-bg: rgba(255, 255, 255, .06);
        --card-border: rgba(255, 255, 255, .15);
        --ring: rgba(231, 76, 60, .18);
        --maxw: 1100px;
        /* a bit wider to breathe under the navbar */
    }

    /* page background matches site */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text);
        background: linear-gradient(135deg, var(--bg-start) 0%, var(--bg-end) 100%);
        min-height: 100vh;
    }

    /* wrapper: adds space under sticky nav and centers content */
    .page {
        min-height: calc(100vh - 160px);
        display: flex;
        align-items: flex-start;
        /* start so the card sits under nav nicely */
        justify-content: center;
        padding: 28px 16px 40px;
        /* top padding so nav never feels cramped */
    }

    /* main profile card */
    .profile {
        width: 100%;
        max-width: var(--maxw);
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 22px;
        box-shadow: 0 24px 48px rgba(0, 0, 0, .35);
        backdrop-filter: blur(10px);
        overflow: hidden;
    }

    /* header area */
    .header {
        padding: 26px 22px 18px;
        text-align: center;
        border-bottom: 1px solid rgba(255, 255, 255, .08);
        background: rgba(255, 255, 255, .04);
    }

    .role-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 12px;
        border-radius: 999px;
        background: var(--ring);
        color: #fff;
        font-weight: 800;
        border: 1px solid rgba(231, 76, 60, .35);
        margin-bottom: 10px;
    }

    .role-chip i {
        color: var(--accent);
    }

    .title {
        font-size: clamp(24px, 4vw, 36px);
        font-weight: 900;
        text-shadow: 0 2px 10px rgba(0, 0, 0, .35);
        margin: 4px 0 2px;
    }

    .subtitle {
        color: var(--muted);
        margin-top: 6px;
    }

    /* grid layout */
    .content {
        display: grid;
        grid-template-columns: 320px 1fr;
        gap: 28px;
        padding: 24px;
    }

    @media (max-width: 900px) {
        .content {
            grid-template-columns: 1fr;
            padding: 18px;
        }
    }

    /* left: avatar block */
    .avatar {
        display: flex;
        align-items: flex-start;
        justify-content: center;
    }

    .pic {
        width: 320px;
        height: 320px;
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, .15);
        background: rgba(255, 255, 255, .04);
        box-shadow: 0 16px 30px rgba(0, 0, 0, .35);
    }

    .pic img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* right: details */
    .info {
        display: grid;
        gap: 14px;
        align-content: start;
    }

    .name {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.55rem;
        font-weight: 800;
    }

    .name i {
        color: var(--accent);
    }

    /* key/value rows with subtle glass effect */
    .kv {
        display: grid;
        grid-template-columns: 160px 1fr;
        gap: 12px;
        padding: 14px 16px;
        background: rgba(255, 255, 255, .05);
        border: 1px solid rgba(255, 255, 255, .12);
        border-radius: 14px;
        transition: border-color .2s ease, box-shadow .2s ease, transform .1s ease;
    }

    .kv:hover {
        border-color: rgba(231, 76, 60, .35);
        box-shadow: 0 0 0 4px rgba(231, 76, 60, .12) inset;
        transform: translateY(-1px);
    }

    .label {
        color: #e0e0e0;
        font-weight: 700;
        letter-spacing: .04em;
    }

    .value {
        color: var(--muted);
    }

    /* actions */
    .actions {
        margin-top: 8px;
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 10px 16px;
        border-radius: 999px;
        cursor: pointer;
        text-decoration: none;
        font-weight: 800;
        color: #fff;
        border: 1px solid rgba(255, 255, 255, .2);
        background: rgba(255, 255, 255, .08);
        transition: background .2s ease, transform .1s ease, box-shadow .2s ease;
    }

    .btn:hover {
        background: rgba(255, 255, 255, .15);
        transform: translateY(-1px);
    }

    .btn:active {
        transform: translateY(0);
    }

    .btn i {
        color: #fff;
    }

    .btn-primary {
        background: var(--accent);
        border-color: rgba(231, 76, 60, .9);
        box-shadow: 0 8px 20px rgba(231, 76, 60, .35);
    }

    .btn-primary:hover {
        background: #ff5b49;
        box-shadow: 0 12px 26px rgba(231, 76, 60, .45);
    }

    /* tighter spacing on smaller screens, smaller avatar */
    @media (max-width:600px) {
        .pic {
            width: 260px;
            height: 260px;
        }

        .kv {
            grid-template-columns: 120px 1fr;
        }
    }
    </style>
</head>

<body>

    <main class="page">
        <section class="profile">
            <header class="header">
                <?php if ($role === 'user'): ?>
                <div class="role-chip"><i class="fa-solid fa-user"></i> User Profile</div>
                <h1 class="title">Account Overview</h1>
                <p class="subtitle">Manage your FitZone account details</p>
                <?php elseif ($role === 'trainer'): ?>
                <div class="role-chip"><i class="fa-solid fa-user-tie"></i> Trainer Profile</div>
                <h1 class="title">Coach Overview</h1>
                <p class="subtitle">Your public info and contact details</p>
                <?php else: ?>
                <div class="role-chip"><i class="fa-solid fa-user"></i> Profile</div>
                <h1 class="title">Welcome</h1>
                <p class="subtitle">Sign in to view full profile</p>
                <?php endif; ?>
            </header>

            <div class="content">
                <!-- Left: avatar -->
                <div class="avatar">
                    <div class="pic">
                        <img src="images/user_profile1.png" alt="Profile">
                    </div>
                </div>

                <!-- Right: info -->
                <div class="info">
                    <div class="name">
                        <i class="fa-solid fa-id-card"></i>
                        <span><?php echo htmlspecialchars($displayName); ?></span>
                    </div>

                    <div class="kv">
                        <div class="label">Address</div>
                        <div class="value"><?php echo htmlspecialchars($address); ?></div>
                    </div>
                    <div class="kv">
                        <div class="label">Phone</div>
                        <div class="value"><?php echo htmlspecialchars($phone); ?></div>
                    </div>
                    <div class="kv">
                        <div class="label">Email</div>
                        <div class="value"><?php echo htmlspecialchars($email); ?></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include("footer.php"); ?>
</body>

</html>