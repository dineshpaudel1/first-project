<?php
// Coverpage.php — HERO / BANNER only.
// NOTE: do NOT put session_start() here, index.php already starts session.
?>
<!-- ===== HERO / BANNER ===== -->
<style>
    :root {
        --bg-start: #1a1a1a;
        --bg-end: #2d2d2d;
        --text: #ffffff;
        --muted: #cccccc;
        --accent: #e74c3c;
        --maxw: 1200px;
        --nav-h: 72px;
        /* adjust to your actual navbar height */
    }

    html {
        scroll-behavior: smooth;
    }

    [id] {
        scroll-margin-top: calc(var(--nav-h) + 16px);
    }

    .banner {
        position: relative;
        min-height: 86vh;
        width: 100%;
        background:
            linear-gradient(135deg, rgba(26, 26, 26, .9) 0%, rgba(45, 45, 45, .75) 100%),
            url('images/image-1.jpg') center/cover no-repeat fixed;
        box-shadow: 0 6px 20px rgba(0, 0, 0, .35) inset;
        display: flex;
        align-items: center;
    }

    .banner .wrap {
        max-width: var(--maxw);
        margin: 0 auto;
        padding: 0 20px;
        width: 100%;
    }

    .hero-card {
        max-width: 760px;
        background: rgba(255, 255, 255, .06);
        border: 1px solid rgba(255, 255, 255, .15);
        border-radius: 18px;
        padding: 28px;
        backdrop-filter: blur(8px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, .35);
    }

    .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: var(--muted);
        font-weight: 600;
        letter-spacing: .08em;
        text-transform: uppercase;
        margin-bottom: 10px;
        font-size: .9rem;
    }

    .hero-eyebrow i {
        color: var(--accent)
    }

    .hero-title {
        font-size: clamp(28px, 4.2vw, 44px);
        line-height: 1.15;
        font-weight: 800;
        margin-bottom: 10px;
        text-shadow: 0 2px 12px rgba(0, 0, 0, .35);
    }

    .hero-sub {
        color: var(--muted);
        font-size: 1.05rem;
        line-height: 1.7;
        margin-bottom: 22px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 18px;
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
        border-color: rgba(231, 76, 60, .9);
    }

    .btn-primary:hover {
        background: #ff5b49
    }

    .btn-ghost {
        background: transparent;
        border-color: rgba(255, 255, 255, .25);
    }

    .cta {
        display: flex;
        gap: 14px;
        flex-wrap: wrap
    }

    .welcome-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 12px;
        border-radius: 999px;
        background: rgba(231, 76, 60, .18);
        color: #fff;
        font-weight: 700;
        margin-bottom: 10px;
        border: 1px solid rgba(231, 76, 60, .35);
    }

    .welcome-chip i {
        color: var(--accent)
    }

    @media (max-width:640px) {
        .hero-card {
            padding: 20px
        }
    }
</style>

<header id="home" class="banner">
    <div class="wrap">
        <?php if (isset($_SESSION["username"]) && !empty($_SESSION['username'])): ?>
            <div class="hero-card">
                <div class="welcome-chip"><i class="fa-solid fa-user"></i> Welcome,
                    <?php echo htmlspecialchars($_SESSION['username']); ?></div>
                <h1 class="hero-title">Great to see you back at <span style="color:var(--accent)">FitZone</span>!</h1>
                <p class="hero-sub">
                    Track your <strong>BMI</strong>, message your trainer, and continue your fitness journey.
                    Stay consistent—your goals are closer than you think.
                </p>
                <div class="cta">
                    <a class="btn btn-primary" href="bmi.php"><i class="fa-solid fa-chart-simple"></i> My BMI</a>
                    <a class="btn btn-ghost" href="diettable.php"><i class="fa-solid fa-envelope"></i> Message</a>
                    <a class="btn" href="user_profile.php"><i class="fa-solid fa-user"></i> Profile</a>
                </div>
            </div>

        <?php elseif (isset($_SESSION["trainername"]) && !empty($_SESSION['trainername'])): ?>
            <div class="hero-card">
                <div class="welcome-chip"><i class="fa-solid fa-user-tie"></i> Welcome, Trainer
                    <?php echo htmlspecialchars($_SESSION['trainername']); ?></div>
                <h1 class="hero-title">Coach your athletes to new personal bests.</h1>
                <p class="hero-sub">
                    Review your assigned members, reply to messages, and keep plans on track.
                    Your guidance makes the difference.
                </p>
                <div class="cta">
                    <a class="btn btn-primary" href="myuser.php"><i class="fa-solid fa-users"></i> My Users</a>
                    <a class="btn btn-ghost" href="tablefeedback.php"><i class="fa-solid fa-envelope"></i> Messages</a>
                    <a class="btn" href="user_profile.php"><i class="fa-solid fa-user"></i> Profile</a>
                </div>
            </div>

        <?php else: ?>
            <div class="hero-card">
                <div class="hero-eyebrow"><i class="fa-solid fa-dumbbell"></i> Transform with us</div>
                <h1 class="hero-title">Stronger body. Sharper mind. Better you.</h1>
                <p class="hero-sub">
                    Your health is your wealth—start today with proven programs and dedicated trainers.
                    Join our community and take the first step toward lasting change.
                </p>
                <div class="cta">
                    <a class="btn btn-primary" href="customer_register.php"><i class="fa-solid fa-user-plus"></i> Join
                        Now</a>
                    <a class="btn" href="#package"><i class="fa-solid fa-box"></i> View Packages</a>
                    <a class="btn btn-ghost" href="#contact"><i class="fa-solid fa-phone"></i> Contact Us</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</header>