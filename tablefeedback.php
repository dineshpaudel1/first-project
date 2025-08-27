<?php
session_start();
include "nav.php";

$users = [];
try {
    $conn = new mysqli('localhost', 'root', '', 'gym');
    $sql = "SELECT * FROM feedback";
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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Feedback Details</title>
    <style>
    /* ===== Theme (scoped) ===== */
    .feedback-list {
        --bg-start: #1a1a1a;
        --bg-end: #2d2d2d;
        --text: #fff;
        --muted: #cfcfcf;
        --accent: #e74c3c;
        --card: rgba(255, 255, 255, .06);
        --border: rgba(255, 255, 255, .15);
        --shadow: 0 24px 48px rgba(0, 0, 0, .35);
        --maxw: 1200px;
        --nav-h: 65px;

        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text);
        background: linear-gradient(135deg, var(--bg-start) 0%, var(--bg-end) 100%);
        min-height: 100vh;

        padding: calc(var(--nav-h) + 24px) 16px 96px;
        box-sizing: border-box;
        display: flex;
        justify-content: center;
    }

    .card {
        width: 100%;
        max-width: var(--maxw);
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 22px;
        box-shadow: var(--shadow);
        backdrop-filter: blur(10px);
        overflow: hidden;
    }

    .card-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 22px;
        border-bottom: 1px solid rgba(255, 255, 255, .08);
        background: rgba(255, 255, 255, .04);
    }

    .title {
        margin: 0;
        font-weight: 900;
        font-size: clamp(20px, 4vw, 28px);
        text-shadow: 0 2px 10px rgba(0, 0, 0, .35);
    }

    .meta {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 12px;
        border-radius: 999px;
        border: 1px solid rgba(231, 76, 60, .35);
        background: rgba(231, 76, 60, .18);
        font-weight: 800;
    }

    .toolbar {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .search {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        border-radius: 12px;
        border: 1px solid var(--border);
        background: rgba(255, 255, 255, .08);
        color: #fff;
    }

    .search input {
        background: transparent;
        border: 0;
        outline: none;
        color: #fff;
        min-width: 220px;
    }

    .search input::placeholder {
        color: #9aa0a6;
    }

    .table-wrap {
        padding: 16px 22px 22px;
        overflow: auto;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        min-width: 800px;
    }

    thead th {
        position: sticky;
        top: 0;
        z-index: 1;
        background: rgba(255, 255, 255, .06);
        backdrop-filter: blur(8px);
        border-bottom: 1px solid rgba(255, 255, 255, .12);
        text-align: left;
        padding: 14px;
        font-size: 14px;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: #eaeaea;
    }

    tbody td {
        padding: 14px;
        border-bottom: 1px solid rgba(255, 255, 255, .08);
        color: var(--muted);
        vertical-align: top;
    }

    tbody tr:hover td {
        background: rgba(255, 255, 255, .04);
    }

    .cell-id {
        font-weight: 800;
        color: #fff;
        width: 60px;
    }

    .trainer {
        font-weight: 800;
        color: #fff;
    }

    .badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, .18);
        background: rgba(255, 255, 255, .08);
        color: #fff;
        font-weight: 700;
        font-size: .9rem;
    }

    .msg {
        background: rgba(255, 255, 255, .04);
        border: 1px solid rgba(255, 255, 255, .12);
        border-radius: 10px;
        padding: 10px 12px;
        color: #e7e7e7;
        line-height: 1.55;
    }

    @media (max-width:720px) {
        .table-wrap {
            padding: 10px;
        }

        .search input {
            min-width: 140px;
        }
    }
    </style>
</head>

<body>
    <main class="feedback-list">
        <section class="card">
            <header class="card-head">
                <h1 class="title">Feedback Details</h1>
                <div class="toolbar">
                    <div class="meta"><?php echo count($users); ?> total</div>
                    <label class="search" title="Filter table">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z"
                                stroke="rgba(255,255,255,.85)" stroke-width="2" stroke-linecap="round" />
                        </svg>
                        <input type="text" id="filter" placeholder="Search feedback...">
                    </label>
                </div>
            </header>

            <div class="table-wrap">
                <table id="fbTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Trainer</th>
                            <th>Username</th>
                            <th>Feedback</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($users); $i++) { ?>
                        <tr>
                            <td class="cell-id"><?php echo htmlspecialchars($users[$i]['id']); ?></td>
                            <td class="trainer"><?php echo htmlspecialchars($users[$i]['trainername']); ?></td>
                            <td><span class="badge"><?php echo htmlspecialchars($users[$i]['username']); ?></span></td>
                            <td>
                                <div class="msg"><?php echo nl2br(htmlspecialchars($users[$i]['message'])); ?></div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <?php include "footer.php"; ?>

    <script>
    // simple client-side filter for convenience
    const input = document.getElementById('filter');
    const rows = Array.from(document.querySelectorAll('#fbTable tbody tr'));
    input?.addEventListener('input', () => {
        const q = input.value.toLowerCase().trim();
        rows.forEach(tr => {
            tr.style.display = tr.innerText.toLowerCase().includes(q) ? '' : 'none';
        });
    });
    </script>
</body>

</html>