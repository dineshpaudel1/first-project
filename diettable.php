<?php
session_start();
include('nav.php');

if (isset($_SESSION['username'])) {
    $usermate = $_SESSION['username'];
}

$users = [];
try {
    $conn = new mysqli('localhost', 'root', '', 'gym');
    $sql = "SELECT * FROM dietplan WHERE username = '$usermate'";
    $res = $conn->query($sql);
    if ($res && $res->num_rows > 0) {
        while ($a = $res->fetch_assoc()) {
            $users[] = $a;
        }
    }
} catch (Exception $e) {
    die('Database  Error : ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Messages</title>
    <style>
    /* ===== THEME (scoped) ===== */
    .inbox-page {
        --bg-start: #1a1a1a;
        --bg-end: #2d2d2d;
        --text: #ffffff;
        --muted: #cfcfcf;
        --accent: #e74c3c;
        --card: rgba(255, 255, 255, .06);
        --border: rgba(255, 255, 255, .15);
        --tableHead: rgba(255, 255, 255, .08);
        --tableRow: rgba(255, 255, 255, .04);
        --shadow: 0 20px 40px rgba(0, 0, 0, .35);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text);
        background: linear-gradient(135deg, var(--bg-start) 0%, var(--bg-end) 100%);
        min-height: calc(100vh - 0px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 36px 16px;
    }

    .inbox-wrap {
        width: 100%;
        max-width: 1200px;
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 20px;
        box-shadow: var(--shadow);
        backdrop-filter: blur(10px);
        overflow: hidden;
    }

    .inbox-head {
        padding: 22px 20px 16px;
        border-bottom: 1px solid rgba(255, 255, 255, .08);
        background: rgba(255, 255, 255, .04);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .inbox-title {
        margin: 0;
        font-size: clamp(20px, 3.5vw, 28px);
        font-weight: 900;
        text-shadow: 0 2px 10px rgba(0, 0, 0, .35);
    }

    .inbox-sub {
        color: var(--muted);
        margin: 0;
    }

    .inbox-body {
        padding: 18px;
    }

    /* table */
    .table-wrap {
        width: 100%;
        overflow: auto;
        border-radius: 14px;
        border: 1px solid var(--border);
        background: rgba(255, 255, 255, .03);
    }

    table.msg-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        min-width: 720px;
    }

    .msg-table thead th {
        text-align: left;
        font-weight: 800;
        font-size: 14px;
        letter-spacing: .04em;
        text-transform: uppercase;
        color: #fff;
        padding: 14px 14px;
        background: var(--tableHead);
        border-bottom: 1px solid var(--border);
    }

    .msg-table tbody tr {
        transition: background .15s ease, transform .05s ease;
    }

    .msg-table tbody tr:hover {
        background: rgba(255, 255, 255, .06);
    }

    .msg-table td {
        padding: 14px;
        border-bottom: 1px solid rgba(255, 255, 255, .08);
        color: var(--muted);
    }

    .msg-table td strong {
        color: #fff;
    }

    /* buttons */
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border-radius: 999px;
        cursor: pointer;
        text-decoration: none;
        font-weight: 800;
        color: #fff;
        border: 1px solid rgba(255, 255, 255, .18);
        background: rgba(255, 255, 255, .08);
        transition: .2s;
        white-space: nowrap;
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

    /* empty state */
    .empty {
        padding: 24px;
        text-align: center;
        color: var(--muted);
    }

    .empty h3 {
        margin: 0 0 6px;
        color: #fff;
    }

    .empty p {
        margin: 0 0 14px;
    }

    .actions-top {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    @media (max-width:720px) {
        .inbox-head {
            padding: 18px 14px;
        }

        .inbox-body {
            padding: 14px;
        }
    }
    </style>
</head>

<body>
    <main class="inbox-page">
        <section class="inbox-wrap">
            <header class="inbox-head">
                <div>
                    <h1 class="inbox-title">Messages from Trainer</h1>
                    <p class="inbox-sub">All diet plan notes & replies for
                        <strong><?php echo isset($usermate) ? htmlspecialchars($usermate) : 'Guest'; ?></strong>
                    </p>
                </div>
                <div class="actions-top">
                    <a href="index.php#home" class="btn">← Back Home</a>
                </div>
            </header>

            <div class="inbox-body">
                <?php if (count($users) === 0): ?>
                <div class="empty">
                    <h3>No messages yet</h3>
                    <p>When your trainer sends you a plan or note, it will appear here.</p>
                    <a href="contact.php" class="btn btn-primary">Contact Us</a>
                </div>
                <?php else: ?>
                <div class="table-wrap">
                    <table class="msg-table">
                        <thead>
                            <tr>
                                <th style="width:80px;">ID</th>
                                <th>My Name</th>
                                <th>My Trainer</th>
                                <th>Message</th>
                                <th style="width:160px; text-align:center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($users); $i++): ?>
                            <tr>
                                <td><strong><?php echo htmlspecialchars($users[$i]['id']); ?></strong></td>
                                <td><?php echo htmlspecialchars($users[$i]['username']); ?></td>
                                <td><?php echo htmlspecialchars($users[$i]['trainername']); ?></td>
                                <td><?php echo htmlspecialchars($users[$i]['goal']); ?></td>
                                <td style="text-align:center;">
                                    <a class="btn btn-primary"
                                        href="feedback.php?id=<?php echo urlencode($users[$i]['id']); ?>">Reply
                                        Message</a>
                                </td>
                            </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php include "footer.php"; ?>
</body>

</html>