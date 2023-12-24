<?php
session_start();
include('nav.php');
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>GYM To Train Fitness</title>
	<style>
		:root {
			--primary-color: #d63031;
			--secondary-color: #636e72;
			--font: 'Poppins', sans-serif;
		}

		* {
			padding: 0;
			margin: 0;
			box-sizing: border-box;
		}


		.banner {
			height: 87.1vh;
			width: 100%;
			/* background: linear-gradient(to right, #2691d9, #ffffff); */
			background: url(images/image-1.jpg);
			/* background-image: linear-gradient(rgba(0,0,50,0.5),rgba(0,0,50,0.5)),url(images/image-1.jpg); */
			/* background-image: linear-gradient(rgba(0,0,50,0.5),rgba(0,0,50,0.5)),url(images/image-1.jpg); */
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
			background-attachment: fixed;
		}

		.btn {
			padding: .6rem .8rem;
			text-transform: uppercase;
			font-family: var(--font);
			background: var(--primary-color);
			color: white;
			font-size: 16px;
			text-decoration: none;
			outline: none;
			border: 2px solid var(--primary-color);
			transition: .3s;
			cursor: pointer;
		}

		.btn:hover {
			background: transparent;
		}


		.intro {
			position: absolute;
			top: 30%;
			left: 10%;
			color: white;
		}

		select {
			margin: 500px 0px 200px 200px;
			height: 40px;
			width: 800px;
		}
	</style>
</head>

<body>
	<div>
		<?php
		if (isset($_SESSION["username"]) && !empty($_SESSION['username'])) {
		?>
			<header>
				<div class="banner">
					<div class="wc">
						<h1 style="color:#fff;">Welcome Dear user <?php echo $_SESSION['username'] ?></h1>
					</div>
				</div>
			</header>
		<?php
		} elseif (isset($_SESSION["trainername"]) && !empty($_SESSION['trainername'])) {
		?>
			<header>
				<div class="banner">
					<div class="wc">
						<h1 style="color:#fff;">Welcome mr trainer <?php echo $_SESSION['trainername'] ?></h1>
					</div>
				</div>
			</header>
		<?php
		} else { ?>
			<header>
				<div class="banner">
					<div class="intro">
						<h2 style="display:inline">Be Strong Fitness</h2>
						<p>Your Health is your wealth so form now decide to Workout with us.</p><br>
						<a href="contact.php"><button class="btn">Contact Now</button></a>
					</div>
				</div>
			</header>
		<?php } ?>
	</div>
	<?php
	include('footer.php');
	?>
</body>
</html>