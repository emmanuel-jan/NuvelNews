<?php require_once'include/db.php'; ?>
<?php require_once'include/Sessions.php'; ?>
<?php require_once'include/Functions.php'; ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>about</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
<body class="is-preload">

<!-- Wrapper -->
<div id="wrapper">

<!-- Main -->
<div id="main">
	<div class="inner">

		<!-- Header -->
			<header id="header">
				<a href="index.php" class="logo"><strong>NuvelNews</strong> by Jan-Tech</a>
				<ul class="icons">
					<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
					<li><a href="#" class="icon brands fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
					<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
					<li><a href="#" class="icon brands fa-medium-m"><span class="label">Medium</span></a></li>
				</ul>
			</header>

		<!-- Content -->
		<section id="banner">
				<div class="content">
					<header>
						<h1>Hi, I’m NuvelNews<br />
							by Jan-Tech</h1>
						<p>A Digital Media Platform</p>
					</header>
					<p>
						As the mantra goes "Knowledge is power".We can then deduce that
						the ability to learn is a "Super Power".At NuvelNews we bring 
						you educative, informative and entertaining content to help you learn 
						more about your society in a holistic manner. This is the place to be 
						to get the latest news on what is happening around the globe.
					</p>

					<p>
						Behind NuvelNews is a team of dedicated media personel ready
						to equip you with the relevant information on all emerging news.
						We believe that "Sharing Is Caring" and that we should put this 
						wise quote to practice by sharing what we know with you.
					</p>
		
				</div>
				<span class="image object">
					<img src="Upload/pic31.jpg"/>
				</span>
			</section>

	</div>
</div>

<!-- Sidebar -->
<div id="sidebar">
	<div class="inner">

		<!-- Search -->
			<section id="search" class="alt">
				<blockquote><h4><i>"Information Is Not Knowledge."</i></h4></blockquote>
			</section>

		<!-- Menu -->
			<nav id="menu">
				<header class="major">
					<h2>Menu</h2>
				</header>
				<ul>
					<li><a href="index.php">Homepage</a></li> 
					<li><a href="NewsPanel.php?page=1">News Panel</a></li>
					
					<li><a href="gallery.php">Gallery</a></li>
					<li><a href="about.php">About</a></li>
				</ul>
			</nav>

		<!-- Section -->
			<section>
				<header class="major">
					<h2>Trending</h2>
				</header>
				<div class="mini-posts">
				<?php
					$query="SELECT * FROM admin_panel WHERE category='Trending' ORDER BY id desc LIMIT 0,3";
					$result=$conn->query($query);
					while($rows=$result->fetch_assoc()){
						$PostId=$rows["id"];
						$DateTime=$rows["datetime"];
						$Title=$rows["title"];
						$Category=$rows["category"];
						$Admin=$rows["author"];
						$Image=$rows["image"];
						$Post=$rows["post"];
				?>
				<article>
					<a href="FullPost.php?id=<?php echo $PostId; ?>" class="image"><img src="Upload/<?php echo $Image?>" alt="" /></a>
					<h3><?php echo $Title; ?></h3>
				</article>
				<?php } ?>
				</div>
				
			</section>

		<!-- Section -->
			<section>
				<header class="major">
					<h2>Get in touch</h2>
				</header>
				<p></p>
				<ul class="contact">
					<li class="icon solid fa-envelope"><a href="#">emmanueljan80@gmail.com</a></li>
					<li class="icon solid fa-phone">(254) 791-575965</li>
					<li class="icon solid fa-home">Maseno University Busia Road<br />
					Maseno MSU 00000-0000</li>
				</ul>
			</section>

		<!-- Footer -->
			<footer id="footer">
				<p class="copyright">&copy;2020 NuvelNews. All rights reserved.Powered by: <a href="#">Jan-Tech</a>.</p>
			</footer>

	</div>
</div>

</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>