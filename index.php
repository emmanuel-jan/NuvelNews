<?php require_once'include/db.php'; ?>
<?php require_once'include/Sessions.php'; ?>
<?php require_once'include/Functions.php'; ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Nuvel</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
	</head>
<body class="is-preload">

<!-- Wrapper -->
<div id="wrapper">

<!-- Main -->
<div id="main">
<div class="inner">

<!-- Header -->
<header id="header1">
<div class="Title">
		<div class="Mini-Title">
			<h1>NuvelNews</h1>
			<p>"Sharing Is Caring"</p>
		</div>
	</div>
</header>
<!-- Banner -->
<section id="banner">
	<div class="content">
	<?php
		$query="SELECT * FROM admin_panel ORDER BY id desc LIMIT 0,1";
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
		<header>
			<h1><?php echo $Title; ?></h1>
			<p><i>Category:<strong><?php echo $Category;?></strong>  Published On:<strong><?php echo $DateTime;?></strong></i></p>
		</header>
		<p>
			<?php 
				if(strlen($Post)>230){$Post=substr($Post,0,230).'...';}
				echo $Post;
			?>
		</p>
		<ul class="actions">
			<li><a href="FullPost.php?id=<?php echo $PostId?>" class="button big">Learn More</a></li>
		</ul>
	</div>
	<span class="image object">
		<img src="Upload/<?php echo $Image; ?>" alt="Headline Image" width="310px" height="388px"/>
	</span>
	<?php } ?>
</section>

<!-- Section -->
<section>
<header class="major">
	<h2>Categories</h2>
</header>
<div class="features">
<?php
$query="SELECT * FROM category ORDER BY id desc LIMIT 0,4";
$result=$conn->query($query);
while($rows=$result->fetch_assoc()){
	$PostId=$rows["id"];
	$CategoryName=$rows["name"];
	$Description=$rows["description"];
?>
	<article>
		<span class="icon solid fa-check-circle"></span>
		<div class="content">
			<h3><?php echo $CategoryName; ?></h3>
			<p><?php echo $Description; ?></p>
		</div>
	</article>
<?php } ?>
</div>
</section>

<!-- Section -->
<section>
<header class="major">
	<h2>Resent Posts</h2>
</header>
<div class="posts">
			<?php
			$query="SELECT * FROM admin_panel ORDER BY id desc LIMIT 0,6";
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
		<a href="FullPost.php?id=<?php echo $PostId; ?>" class="image"><img src="Upload/<?php echo $Image; ?>" alt="News Post" width="310px" height="388px" /></a>
		<h2><?php echo $Title;?></h2>
		<p><i class="logo">Category:<?php echo $Category; ?> Published On:<?php echo $DateTime; ?></i></p>
		<p>
			<?php
				if(strlen($Post)>60){$Post=substr($Post,0,60).'...';}
				echo nl2br($Post);
			?>
		</p>
		<ul class="actions">
			<li><a href="FullPost.php?id=<?php echo $PostId; ?>" class="button">More</a></li>
		</ul>
	</article>
	<?php } ?>
</div>
</section>

</div>
</div>

<!-- Sidebar -->
<div id="sidebar">
<div class="inner">

<!-- Search -->
<section id="search" class="alt">
	<blockquote><h4><i>"The Secret Of Getting A Head Is Getting Started."</i></h4></blockquote>
</section>

<!-- Menu -->
<nav id="menu">
	<header class="major">
		<h2>Menu</h2>
	</header>
	<ul>
		<li><a href="index.php">Homepage</a></li>
		<li><a href="NewsPanel.php?page=1">News Panel</a></li>
		
		<li><a href="gallery.php?page=1">Gallery</a></li>
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
		<li class="icon solid fa-home">Maseno University Busia Road <br/>
		Maseno, MSU 00000-0000</li>
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