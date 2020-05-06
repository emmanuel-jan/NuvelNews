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
    <title>Comments</title>
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
                   <h3>Un-Approved Comments</h3>
					<thead>
						<tr>
							<th>No</th>
							<th>Name</th>
							<th>Date&Time</th>
							<th>Comment</th>
							<th>Approve</th>
							<th>Delete</th>
							<th>Details</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$query="SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
						$result=$conn->query($query);
						$SrNo=0;
						while($rows=$result->fetch_assoc()){
							$CommentId=$rows["id"];
							$CommentDate=$rows["datetime"];
							$CommenterName=$rows["name"];
							$Comment=$rows["comment"];
							$CommentedPostId=$rows["admin_panel_id"];
							$SrNo++;
						?>
						<tr>
							<td><?php echo $SrNo;?></td>
							<td><?php echo $CommenterName;?></td>
							<td><?php echo $CommentDate;?></td>
							<td><?php echo $Comment;?></td>
							<td>
                                <a href="ApproveComments.php?id=<?php echo $CommentId;?>"class="button small">Approve</a>
                            </td>
                            <td>
								<a href="DeleteComments.php?Delete=<?php echo $CommentId;?>" class="button primary small">Delete</a>
							</td>
							<td>
							<a href="FullPost.php?id=<?php echo $CommentedPostId;?>" target="_blank" class="button small">Live Preview</a>
							</td>
						</tr>
					<?php }?>
					</tbody>
				</table>
            </div>
            

			<div class="table-wrapper">
				<table class="alt">
                   <h3>Approved Comments</h3>
					<thead>
						<tr>
							<th>No</th>
							<th>Name</th>
							<th>Date&Time</th>
                            <th>Comment</th>
                            <th>Approved By</th>
							<th>Revert Approval</th>
							<th>Delete</th>
							<th>Details</th>
						</tr>
					</thead>
					<tbody>
                        <?php 
                        $Admin=$_SESSION["Username"];
						$query="SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
						$result=$conn->query($query);
						$SrNo=0;
						while($rows=$result->fetch_assoc()){
							$CommentId=$rows["id"];
							$CommentDate=$rows["datetime"];
							$CommenterName=$rows["name"];
                            $Comment=$rows["comment"];
                            $ApprovedBy=$rows["approvedby"];
							$CommentedPostId=$rows["admin_panel_id"];
							$SrNo++;
						?>
						<tr>
							<td><?php echo $SrNo;?></td>
							<td><?php echo $CommenterName;?></td>
							<td><?php echo $CommentDate;?></td>
                            <td><?php echo $Comment;?></td>
                            <td><?php echo $ApprovedBy; ?>
							<td>
                                <a href="DisapproveComments.php?id=<?php echo $CommentId;?>"class="button small">Disapprove</a>
                            </td>
                            <td>
								<a href="DeleteComment.php?Delete=<?php echo $CommentId;?>" class="button primary small">Delete</a>
							</td>
							<td>
							<a href="FullPost.php?id=<?php echo $CommentedPostId;?>" class="button small">Live Preview</a>
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