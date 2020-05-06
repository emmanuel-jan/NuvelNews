<?php require_once'include/db.php'; ?>
<?php require_once'include/Sessions.php'; ?>
<?php require_once'include/Functions.php'; ?>
	<?php
		if(isset($_POST["Submit"])){
			$Name=$conn->real_escape_string($_POST["name"]);
			$Email=$conn->real_escape_string($_POST["email"]);
			$Comment=$conn->real_escape_string($_POST["comment"]);
			//setting the timezone
			date_default_timezone_set("Africa/Nairobi");
			//declaring a variable to hold the current date
			$CurrentTime=time();
			$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
			$PostId=$_GET["id"];
			//validating the entries
			if(empty($Name)||empty($Email)||empty($Comment)){
				$_SESSION["ErrorMessage"]="All Fields are required";
				redirect_to("FullPost.php?id={$PostId}");
			}
			elseif(strlen($Comment)>500){
				$_SESSION["ErrorMessage"]="Only 500 characters are allowed";
				redirect_to("FullPost.php?id={$PostId}");
			}
			else{
				$PostIdFromURL=$_GET["id"];
				$sql="INSERT INTO comments (datetime,name,email,comment,approvedby,status,admin_panel_id) VALUES 
				('$DateTime','$Name','$Email','$Comment','Pending','OFF',$PostIdFromURL)";
				if(mysqli_query($conn,$sql)){
					$_SESSION["SuccessMessage"]="Comment submitted successfully";
					
				}else{
					$_SESSION["ErrorMessage"]="Something went wrong";
					
				}
			}
		}
	?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>FullPost</title>
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
<section>
	<header class="main">
				<h3><strong><span>	
					<?php 
                    //These are session messages
                     echo Message();
                     echo SuccessMessage();
                     ?>
				</span></strong></h3>
	</header>
	<?php 
	$PostIdFromURL=$_GET["id"];
	$query="SELECT * FROM admin_panel WHERE id='$PostIdFromURL' ORDER BY id desc ";
	$result=$conn->query($query);
	while($rows=$result->fetch_assoc()){
		$PostId=$rows['id']; 
		$DateTime=$rows['datetime'];
		$Title=$rows['title'];
		$Category=$rows['category'];
		$Admin=$rows['author'];
		$Image=$rows['image'];
		$Post=$rows['post'];
	?>
	<div class="col-6 col-12-small">
		<span class="image left"><img src="Upload/<?php echo $Image; ?>" alt="news image" /></span>
		<h1><?php echo $Title; ?></h1>
		<p>Category:<?php echo $Category; ?> Published On:<?php echo $DateTime; ?></p>
		<p><?php echo nl2br($Post); ?></p>
	</div>
	<?php } ?>
</section>
<hr class="major" />
<br><br>
<!--Extracting comments-->

<h3>Comments.</h3>
	<?php
	$PostIdForComments=$_GET["id"];
	$query="SELECT * FROM comments WHERE admin_panel_id='$PostIdForComments' AND status='ON'";
	$result=$conn->query($query);
	while($rows=$result->fetch_assoc()){
		$CommentDate=$rows['datetime'];
		$CommenterName=$rows['name'];
		$Comment=$rows['comment'];
	
	?>
	<div class="box">
		<h3><?php echo $CommenterName; ?> <i>says...</i></h3>
		<p><?php echo $Comment; ?></p>
		<i><?php echo $CommentDate; ?></i>
	</div>
	<?php } ?>

<br><br>
	<p><strong><i>Keep the conversation alive.<br>Share your thoughts about the post here.</i></strong><p>
<form method="post" action="FullPost.php?id=<?php echo $PostId;?>">
    <div class="row gtr-uniform">
        <div class="col-6 col-12-xsmall">
            <input type="text" name="name" id="name" value="" placeholder="Enter Your Name" />
        </div>  
		<div class="col-6 col-12-xsmall">
            <input type="text" name="email" id="email" value="" placeholder="Enter Email" />
        </div> 
        <div class="col-12">
            <textarea name="comment" id="commentArea" placeholder="Type Your Comment Here..." rows="6"></textarea>
        </div>
        <!-- Break -->
        <div class="col-12">
            <ul class="actions">
                <li><input type="submit" name="Submit" value="Send" class="primary" /></li>
                <li><input type="reset" value="Clear" /></li>
            </ul>
        </div>
    </div>
</form>
</div>
</div>

<!-- Sidebar -->
<div id="sidebar">
<div class="inner">

<!-- Search -->
<section id="search" class="alt">
	<form method="post" action="#">
		<input type="text" name="query" id="query" placeholder="Search" />
	</form>
</section>

<!-- Menu -->
<nav id="menu">
<header class="major">
	<h2>Menu</h2>
</header>
<ul>
	<li><a href="index.php">Homepage</a></li> 
	<li><a href="NewsPanel.php">News Panel</a></li>
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