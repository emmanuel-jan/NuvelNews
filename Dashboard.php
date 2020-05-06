<?php require_once'include/Sessions.php'; ?>
<?php require_once'include/Functions.php'; ?>
<?php require_once'include/db.php'; ?>
<?php Confirm_Login(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    
    
    <script></script>
    <title>Admin</title>
</head>
<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">

<!-- Main -->
<div id="main">
	<div class="inner">

		<!-- Header -->
			<header id="header">
			<i class="logo">Hello!! <strong><?php echo $Admin=$_SESSION["Username"];?></strong> You're logged in.</i>
				<ul class="icons">
					<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
					<li><a href="#" class="icon brands fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
					<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
					<li><a href="#" class="icon brands fa-medium-m"><span class="label">Medium</span></a></li>
				</ul>
			</header>

			<span> 
                <?php 
                     echo Message();
                     echo SuccessMessage();
                    ?>
                </span>
            <br><br>
			
			<div class="table-wrapper">
				<table class="alt">
					<thead>
						<tr>
							<th>No</th>
							<th>Post Title</th>
							<th>Date&Time</th>
							<th>Author</th>
							<th>Category</th>
							<th>Banner</th>
							<th>Comments</th>
							<th>Actions</th>
							<th>Details</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$query="SELECT * FROM admin_panel ORDER BY id desc";
						$result=$conn->query($query);
						$SrNo=0;
						while($rows=$result->fetch_assoc()){
							$Id=$rows["id"];
							$Datetime=$rows["datetime"];
							$Title=$rows["title"];
							$Category=$rows["category"];
							$Admin=$rows["author"];
							$Image=$rows["image"];
							$Post=$rows["post"];
							$SrNo++;
						?>
						<tr>
							<td><?php echo $SrNo;?></td>
							<td><?php echo $Title;?></td>
							<td><?php echo $Datetime;?></td>
							<td><?php echo $Admin;?></td>
							<td><?php echo $Category;?></td>
							<td><img class="nuvelImages" src="Upload/<?php echo $Image;?>" ></td>
							<td>
							
							<?php 
                                $Query="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='ON'";
                                $results=$conn->query($Query);
                                $rows=mysqli_fetch_array($results);
                                $TotalApproved=array_shift($rows);
                                if($TotalApproved>0){
                            ?>
                                <span class="comment success"><?php echo $TotalApproved;?></span>
                                <?php }?>  

								<?php 
                                $Query="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='OFF'";
                                $results=$conn->query($Query);
                                $rows=mysqli_fetch_array($results);
                                $TotalApproved=array_shift($rows);
                                if($TotalApproved>0){
                            ?>
                                <span class="comment warning"><?php echo $TotalApproved;?></span>
                                <?php }?>  

							</td>
							<td>
								<a href="EditPost.php?Edit=<?php echo $Id;?>"class="button small">Edit</a>
								<a href="DeletePost.php?Delete=<?php echo $Id;?>" class="button primary small">Delete</a>
							</td>
							<td>
							<a href="FullPost.php?id=<?php echo $Id;?>" target="_blank" class="button small">Live Preview</a>
							</td>
						</tr>
					<?php }?>
					</tbody>
				
				</table>
			</div>

			</div>
		</div>

<div id="sidebar">
		<div class="inner">

   <!-- Welcome section -->
   <section id="search" class="alt">
		<h2><i>Welcome! <?php echo $Admin=$_SESSION["Username"]; ?></i></h2>
    </section>

<!-- Menu -->
<nav id="menu">
	<header class="major">
		<h2>Menu</h2>
	</header>
	<ul>
		<li><a href="Dashboard.php">Dashboard</a></li>
		<li><a href="AddNewPost.php">Add New Post</a></li>
		<li><a href="categories.php">Categories</a></li>
		<li><a href="ManageAdmins.php">Manage Admins</a></li>
		<li><a href="comments.php">Comments
		<?php 
			$Query="SELECT COUNT(*) FROM comments WHERE status='OFF'";
			$results=$conn->query($Query);
			$rows=mysqli_fetch_array($results);
			$Total=array_shift($rows);
			if($Total>0){
		?>
			<span class="comment info"> Unapproved Comments: <?php echo $Total;?> </span>
			<?php }?>    
		</a></li>
		<li><a href="NewsPanel.php?page=1" target="_blank">Live Blog</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>
</nav>

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