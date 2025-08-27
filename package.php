<?php
$packages = [];
try {
    $conn = new mysqli('localhost', 'root', '', 'gym');
    $sql = "select * from package";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while ($a = $res->fetch_assoc()) {
            array_push($packages, $a);
        }
    } else {
        die("data not found");
    }
} catch (Exception $e) {
    die('Database  Error : ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Plan Package</title>
    <script src="https://kit.fontawesome.com/504bf32129.js" crossorigin="anonymous"></script>

    <style>
        :root {
            --bg-start: #1a1a1a;
            --bg-end: #2d2d2d;
            --text: #ffffff;
            --muted: #cfcfcf;
            --accent: #e74c3c;
            /* match footer/nav red */
            --maxw: 1200px;
            --nav-h: 72px;
            /* adjust to your real navbar height */
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        html {
            scroll-behavior: smooth
        }

        /* Any element targeted by #hash won’t hide under sticky nav */
        [id] {
            scroll-margin-top: calc(var(--nav-h) + 16px)
        }

        body {
            background: linear-gradient(135deg, var(--bg-start) 0%, var(--bg-end) 100%);
            color: var(--text);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* anchor shim (optional visual spacing at top of section) */
        .anchor-top-space {
            height: 8px
        }

        .page {
            max-width: var(--maxw);
            margin: 38px auto 40px;
            padding: 0 20px;
        }

        .page-head {
            text-align: center;
            margin-bottom: 22px
        }

        .page-title {
            font-size: clamp(24px, 4vw, 36px);
            font-weight: 800;
            letter-spacing: .2px;
            margin-bottom: 6px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, .35);
        }

        .page-sub {
            color: var(--muted);
            font-size: 1rem
        }

        /* grid of cards */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 22px;
            margin-top: 22px;
        }

        /* pricing card */
        .price-card {
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 26px rgba(0, 0, 0, .35);
            backdrop-filter: blur(8px);
            transition: transform .15s ease, box-shadow .15s ease, border-color .2s ease;
        }

        .price-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 34px rgba(0, 0, 0, .45);
            border-color: rgba(231, 76, 60, .35);
        }

        .card-head {
            padding: 18px 20px;
            background: linear-gradient(135deg, rgba(231, 76, 60, .18) 0%, rgba(231, 76, 60, .05) 100%);
            border-bottom: 1px solid rgba(255, 255, 255, .08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .plan-name {
            font-weight: 800;
            font-size: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .plan-name i {
            color: var(--accent)
        }

        .price-tag {
            font-weight: 800;
            color: #fff;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .2);
            padding: 6px 10px;
            border-radius: 999px;
        }

        .card-body {
            padding: 18px 20px
        }

        .feat {
            list-style: none;
            color: var(--muted);
            font-size: .98rem;
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin: 0 0 18px 0;
        }

        .feat li {
            display: flex;
            align-items: flex-start;
            gap: 10px
        }

        .feat li i {
            color: var(--accent);
            margin-top: 2px
        }

        .card-foot {
            padding: 16px 20px 20px;
            border-top: 1px solid rgba(255, 255, 255, .08);
            display: flex;
            justify-content: center;
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
            text-decoration: none;
            font-weight: 700;
            transition: background .2s ease, border-color .2s ease, transform .1s ease;
            cursor: pointer;
        }

        .btn:hover {
            background: rgba(255, 255, 255, .15)
        }

        .btn:active {
            transform: translateY(1px)
        }

        .btn-primary {
            background: var(--accent);
            border-color: rgba(231, 76, 60, .9)
        }

        .btn-primary:hover {
            background: #ff5b49
        }

        .mono {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace
        }

        @media (max-width:600px) {
            .page {
                margin-top: 28px
            }

            :root {
                --nav-h: 88px;
            }

            /* if mobile nav is taller */
        }
    </style>
</head>

<body>

    <!-- The #package anchor is the page’s main wrapper so all links like #package land here -->
    <main id="package" class="page">
        <div class="anchor-top-space" aria-hidden="true"></div>

        <?php if (isset($_SESSION["username"]) && !empty($_SESSION['username'])) { ?>
            <header class="page-head">
                <h2 class="page-title">Your Exercise Plan</h2>
                <p class="page-sub">Please select your plan according to your choice.</p>
            </header>

            <section class="grid">
                <?php for ($i = 0; $i < count($packages); $i++) { ?>
                    <article class="price-card">
                        <div class="card-head">
                            <div class="plan-name">
                                <i class="fa-solid fa-dumbbell"></i><?php echo $packages[$i]['plan']; ?>
                            </div>
                            <div class="price-tag mono"><?php echo $packages[$i]['cost']; ?></div>
                        </div>
                        <div class="card-body">
                            <ul class="feat">
                                <li><i class="fa-solid fa-gift"></i><span><?php echo $packages[$i]['offers']; ?></span></li>
                                <li><i class="fa-solid fa-clock"></i><span><?php echo $packages[$i]['shift']; ?></span></li>
                                <li><i class="fa-solid fa-percent"></i><span><?php echo $packages[$i]['discount']; ?></span>
                                </li>
                            </ul>
                        </div>
                        <div class="card-foot">
                            <a href="enrollment.php" class="btn btn-primary">
                                <i class="fa-solid fa-arrow-right-to-bracket"></i> Enroll Now
                            </a>
                        </div>
                    </article>
                <?php } ?>
            </section>

        <?php } else { ?>
            <header class="page-head">
                <h2 class="page-title">Your Exercise Plan</h2>
                <p class="page-sub">Please select your plan according to your choice.</p>
            </header>

            <section class="grid">
                <?php for ($i = 0; $i < count($packages); $i++) { ?>
                    <article class="price-card">
                        <div class="card-head">
                            <div class="plan-name">
                                <i class="fa-solid fa-dumbbell"></i><?php echo $packages[$i]['plan']; ?>
                            </div>
                            <div class="price-tag mono"><?php echo $packages[$i]['cost']; ?></div>
                        </div>
                        <div class="card-body">
                            <ul class="feat">
                                <li><i class="fa-solid fa-gift"></i><span><?php echo $packages[$i]['offers']; ?></span></li>
                                <li><i class="fa-solid fa-clock"></i><span><?php echo $packages[$i]['shift']; ?></span></li>
                                <li><i class="fa-solid fa-percent"></i><span><?php echo $packages[$i]['discount']; ?></span>
                                </li>
                            </ul>
                        </div>
                        <div class="card-foot">
                            <a href="customer_login.php" class="btn btn-primary">
                                <i class="fa-solid fa-arrow-right-to-bracket"></i> Enroll Now
                            </a>
                        </div>
                    </article>
                <?php } ?>
            </section>
        <?php } ?>
    </main>

    <script>
        // Ensure that even if someone visits this page without the hash,
        // internal links to #package behave consistently (optional nicety).
        (function() {
            if (!location.hash) {
                // Set the hash without jumping (keeps scroll position)
                history.replaceState(null, '', '#package');
            }
            // If a hash exists but the element is off-screen, scroll into view smoothly
            const target = document.getElementById('package');
            if (target) {
                // Small timeout lets the page paint before scrolling
                setTimeout(() => target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                }), 0);
            }
        })();
    </script>
</body>

</html>