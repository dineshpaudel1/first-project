<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gym Management System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/504bf32129.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/nav.css">
</head>

<body>

    <nav class="topnav">
        <div class="wrap">
            <!-- Left: brand + primary links -->
            <div class="nav-left">
                <!-- brand goes to top/home section -->
                <a class="brand" href="#home" aria-label="Gym Home">
                    <i class="fa-solid fa-dumbbell"></i><span>FitZone Gym</span>
                </a>

                <?php if (isset($_SESSION["trainername"]) && !empty($_SESSION['trainername'])) { ?>
                <a href="#home">Home</a>
                <a href="#about">About Us</a>
                <a href="#contact">Contact</a>
                <?php } else { ?>
                <a href="#home">Home</a>
                <a href="#package">Package</a>
                <a href="about.php">About Us</a>
                <a href="contact.php">Contact</a>
                <?php } ?>
            </div>

            <!-- Right: user actions (keep as real pages) -->
            <div class="nav-right">
                <?php if (isset($_SESSION["username"]) && !empty($_SESSION['username'])) { ?>
                <a href="diettable.php"><i class="fa-solid fa-envelope"></i><span>Message</span></a>
                <a href="bmi.php"><i class="fa-solid fa-chart-simple"></i><span>My BMI</span></a>
                <a href="user_profile.php"><i class="fa-solid fa-user"></i><span>My Profile</span></a>
                <a href="logout.php" class="btn-pill"><i
                        class="fa-solid fa-right-to-bracket"></i><span>Logout</span></a>

                <?php } elseif (isset($_SESSION["trainername"]) && !empty($_SESSION['trainername'])) { ?>
                <a href="tablefeedback.php"><i class="fa-solid fa-envelope"></i><span>Message</span></a>
                <a href="myuser.php"><i class="fa-solid fa-chart-simple"></i><span>My Users</span></a>
                <a href="user_profile.php"><i class="fa-solid fa-user"></i><span>My Profile</span></a>
                <a href="logout.php" class="btn-pill"><i
                        class="fa-solid fa-right-to-bracket"></i><span>Logout</span></a>

                <?php } else { ?>
                <a href="customer_register.php" class="btn-pill"><i
                        class="fa-solid fa-user"></i><span>Register</span></a>
                <a href="how_to_login.php" class="btn-pill"><i
                        class="fa-solid fa-right-to-bracket"></i><span>Login</span></a>
                <?php } ?>
            </div>
        </div>
    </nav>
    <script>
    (function() {
        const HOME_PAGE = 'index.php'; // change if your sections are on a different file

        function hasTarget(hash) {
            if (!hash) return false;
            const id = hash.replace('#', '');
            return !!document.getElementById(id);
        }

        // 1) On page load: if URL has #hash but the element isn't here, go to HOME_PAGE#hash
        if (location.hash && !hasTarget(location.hash)) {
            const dest = HOME_PAGE + location.hash;
            // Preserve query if any
            const qs = location.search ? location.search : '';
            window.location.replace(HOME_PAGE + qs + location.hash);
        }

        // 2) On nav clicks: if link is same-page hash but target doesn't exist, redirect to HOME_PAGE#hash
        document.addEventListener('click', function(e) {
            const a = e.target.closest('a[href]');
            if (!a) return;

            const url = new URL(a.getAttribute('href'), location.href);

            // Only handle pure hash or same-path + hash links (your left nav)
            const isSamePathOrHashOnly =
                (a.getAttribute('href').startsWith('#')) ||
                (url.pathname === location.pathname && url.hash);

            if (isSamePathOrHashOnly && url.hash) {
                const hash = url.hash;
                // If target exists here, do smooth scroll (default behavior is already smooth via CSS)
                if (hasTarget(hash)) {
                    // let default happen, but prevent page jump jitter by ensuring element scrolls
                    e.preventDefault();
                    document.querySelector(hash).scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    history.replaceState(null, '', hash);
                } else {
                    // Target isn't on this page -> go to home page section
                    e.preventDefault();
                    window.location.href = HOME_PAGE + hash;
                }
            }
        });
    })();
    </script>

</body>

</html>