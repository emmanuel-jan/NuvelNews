<?php require_once'include/db.php'; ?>
<?php require_once'include/Sessions.php'; ?>
<?php require_once'include/Functions.php'; ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>gallery</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
        <link rel="stylesheet" href="assets/css/lightbox.min.css"/>
        <script src="assets/js/lightbox-plus-jquery.min.js"></script>
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
			<h1>Gallery</h1>
			<p>"Photography Is Truth"</p>
		</div>
	</div>
</header>

<!-- Content -->
<br><br>
<div class="box alt">
	<div class="row gtr-50 gtr-uniform gallery" >
<?php
	 $query="SELECT * FROM admin_panel ORDER BY id desc";
    $result=$conn->query($query);
    while($rows=$result->fetch_assoc()){
        $PostId=$rows["id"];
        $DateTime=$rows["datetime"];
        $Title=$rows["title"];
        $Category=$rows["category"];
        $Image=$rows["image"];
        
    ?>
		<div class="col-4">
		<span class="image fit">
		<a href="Upload/<?php echo $Image; ?>" data-lightbox="mygallery" data-title="<?php echo $Title; ?>">
		<img src="Upload/<?php echo $Image;?>" alt="" />
		</a>
		</span>
		</div>
	<?php }?>
	</div>
</div>

</div>
</div>

<!-- Sidebar -->
<div id="sidebar">
<div class="inner">

	<!-- Search -->
		<section id="search" class="alt">
		<blockquote><h4><i>"I Don't Trust Words. I Trust Pictures."</i></h4></blockquote>
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
			<ul class="actions">
				<li><a href="#" class="button">More</a></li>
			</ul>
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