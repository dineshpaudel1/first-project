<?php
session_start();
include('nav.php');

if (isset($_SESSION['trainername'])) {
    $trainernamet = $_SESSION['trainername'];
}

$trainer = [];
try {
    require_once 'connection.php';
    $sql = "SELECT * FROM enrollment WHERE coach = '$trainernamet'";
    $res = $conn->query($sql);
    if ($res && $res->num_rows > 0) {
        while ($a = $res->fetch_assoc()) {
            $trainer[] = $a;
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
    <title>My Users</title>
    <style>
    /* ===== Theme (scoped) ===== */
    .coach-page {
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

        /* spacing around sticky nav/footer */
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
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
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
        gap: 10px;
        padding: 6px 12px;
        border-radius: 999px;
        border: 1px solid rgba(231, 76, 60, .35);
        background: rgba(231, 76, 60, .18);
        font-weight: 800;
    }

    .table-wrap {
        padding: 16px 22px 22px;
        overflow: auto;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        min-width: 900px;
        /* allow horizontal scroll on small screens */
    }

    thead th {
        position: sticky;
        top: 0;
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
        vertical-align: middle;
    }

    tbody tr:hover td {
        background: rgba(255, 255, 255, .04);
    }

    .cell-id {
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
        white-space: nowrap;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, .18);
        background: rgba(255, 255, 255, .08);
        color: #fff;
        text-decoration: none;
        font-weight: 800;
        transition: .2s;
        box-shadow: 0 6px 16px rgba(0, 0, 0, .25);
        cursor: pointer;
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
    <div class="coach-page">
        <section class="card">
            <div class="card-head">
                <h1 class="title">My Users</h1>

                <div class="toolbar">
                    <div class="meta"><?php echo count($trainer); ?> total</div>

                    <!-- Quick client-side filter (optional, no logic change) -->
                    <label class="search">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z"
                                stroke="rgba(255,255,255,.8)" stroke-width="2" stroke-linecap="round" />
                        </svg>
                        <input type="text" id="tableFilter" placeholder="Search users...">
                    </label>
                </div>
            </div>

            <div class="table-wrap">
                <table id="usersTable">
                    <thead>
                        <tr>
                            <th style="width:60px;">ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Package</th>
                            <th>Coach</th>
                            <th>Time</th>
                            <th>Gender</th>
                            <th style="width:170px;">Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($trainer); $i++) { ?>
                        <tr>
                            <td class="cell-id"><?php echo htmlspecialchars($trainer[$i]['id']); ?></td>
                            <td><?php echo htmlspecialchars($trainer[$i]['name']); ?></td>
                            <td><?php echo htmlspecialchars($trainer[$i]['address']); ?></td>
                            <td><span class="badge"><?php echo htmlspecialchars($trainer[$i]['phone']); ?></span></td>
                            <td><?php echo htmlspecialchars($trainer[$i]['package']); ?></td>
                            <td><?php echo htmlspecialchars($trainer[$i]['coach']); ?></td>
                            <td><?php echo htmlspecialchars($trainer[$i]['time']); ?></td>
                            <td><?php echo htmlspecialchars($trainer[$i]['gender']); ?></td>
                            <td>
                                <a class="btn btn-primary"
                                    href="newdietplan.php?id=<?php echo urlencode($trainer[$i]['id']); ?>">
                                    Send Message
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <?php include('footer.php'); ?>

    <script>
    // simple client-side filter for convenience (no backend changes)
    const filter = document.getElementById('tableFilter');
    const rows = Array.from(document.querySelectorAll('#usersTable tbody tr'));
    filter?.addEventListener('input', () => {
        const q = filter.value.toLowerCase().trim();
        rows.forEach(tr => {
            tr.style.display = tr.innerText.toLowerCase().includes(q) ? '' : 'none';
        });
    });
    </script>
</body>

</html>