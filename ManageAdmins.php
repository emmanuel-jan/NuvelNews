<?php require_once'include/Sessions.php'; ?>
<?php require_once'include/Functions.php'; ?>
<?php require_once'include/db.php'; ?>
<?php Confirm_Login(); ?>
<?php
//retriving data from the input element and taking the data to the database
if(isset($_POST["submit"])){
//getting the data using the post method
$Username=$conn->real_escape_string($_POST["username"]);
$Password=$conn->real_escape_string($_POST["password"]);
$ConfirmPassword=$conn->real_escape_string($_POST["confirmPassword"]);

            //setting the timezone
            date_default_timezone_set("Africa/Nairobi");
            //defining a variable which holds the time give by the time() function
            $currentTime=time();
            $DateTime=strftime("%B-%d-%Y %H:%M:%S",$currentTime);//declaring the format of the time given by the currentTime variable

$Admin=$_SESSION["Username"];

        //validation of the category from
        if(empty($Username)||empty($Password)||empty($ConfirmPassword)){
            $_SESSION["ErrorMessage"]="All fields must be filled out";
            redirect_to("ManageAdmins.php");
        }elseif(strlen($Password)<4){
            $_SESSION["ErrorMessage"]="Password name too short";
            redirect_to("ManageAdmins.php");
        }elseif($Password!==$ConfirmPassword){
            $_SESSION["ErrorMessage"]="Passwords don't match";
            redirect_to("ManageAdmins.php");
        }
        else{
            $Password=md5($Password);
            //inserting the data into the database
            $sql="INSERT INTO registration (datetime,username,password,addedby) VALUES ('$DateTime','$Username','$Password','$Admin')";
            if(mysqli_query($conn,$sql)){
                $_SESSION["SuccessMessage"]= "New Admin created successfully";
                redirect_to("ManageAdmins.php");
            }else{
                $_SESSION["ErrorMessage"]= "Something went wrong";
                redirect_to("ManageAdmins.php");
            }
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    
    
    <script></script>
    <title>Manage Admins</title>
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

        <form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>">
            <div class="row gtr-uniform">
                <div class="col-7 col-12-xsmall">
                    <input type="text" name="username" id="username" value="" placeholder="Enter Username" />
                </div>
                <div class="col-7 col-12-xsmall">
                    <input type="password" name="password" id="password" value="" placeholder="Enter Password" />
                </div>
                <div class="col-7 col-12-xsmall">
                    <input type="password" name="confirmPassword" id="confirmPassword" value="" placeholder="Confirm Password" />
                </div>
                <!-- Break -->
                <div class="col-12">
                    <ul class="actions">
                        <li><input type="submit" value="Add New Admin" name="submit" class="primary" /></li>
                        <li><input type="reset" value="Clear" /></li>
                    </ul>
                </div>
            </div>
        </form>
            <br><br>

        <div class="table-wrapper">
            <table >
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Date&Time</th>
                        <th>Admin Name</th>
                        <th>Added By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //selecting data from the database
                    $query="SELECT * FROM registration ORDER BY id desc";
                    $result=$conn->query($query);
                    $SrNo=0;
                    //Using while loop to fetch data from the database
                    while($rows=$result->fetch_assoc()){
                        $SrNo++;
                    ?>
                        <tr>
                            <td><?php echo $SrNo;?></td>
                            <td><?php echo $rows["datetime"]; ?></td>
                            <td><?php echo $rows["username"]; ?>.</td>
                            <td><?php echo $rows["addedby"]; ?>.</td>
                            <td><a href="DeleteAdmin.php?Delete=<?php echo $rows["id"]; ?>"><span class="button primary">Delete</span></a></td>
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