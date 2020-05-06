<?php require_once'include/Sessions.php'; ?>
<?php require_once'include/Functions.php'; ?>
<?php require_once'include/db.php'; ?>
<?php Confirm_Login(); ?>
<?php
//retriving data from the input element and taking the data to the database
if(isset($_POST["submit"])){
//getting the data using the post method
$Title=$conn->real_escape_string($_POST["title"]);
$Category=$conn->real_escape_string($_POST["category"]);
$Post=$conn->real_escape_string($_POST["post"]);

            //setting the timezone
            date_default_timezone_set("Africa/Nairobi");
            //defining a variable which holds the time give by the time() function
            $currentTime=time();
            $DateTime=strftime("%B-%d-%Y %H:%M:%S",$currentTime);//declaring the format of the time given by the currentTime variable

$Admin=$_SESSION["Username"];
//declaring a variable to hold the image file
$Image=$_FILES["image"]["name"];
//specifying the image path to the directory where the image will be stored
$Target="Upload/".basename($_FILES["image"]["name"]);

        //validation of the title field
        if(empty($Title)||empty($Category)||empty($Post)||empty($Image)){
            $_SESSION["ErrorMessage"]="Title field must be filled out";
            redirect_to("AddNewPost.php");
        }elseif(strlen($Title)<2){
            $_SESSION["ErrorMessage"]="Title name too short";
            redirect_to("AddNewPost.php");
        }else{
            //inserting the data into the database
            $sql="INSERT INTO admin_panel (datetime,title,category,author,image,post) 
            VALUES ('$DateTime','$Title','$Category','$Admin','$Image','$Post')";
            //moving the file from the users pc to the web app
            //this is done using the move_uploaded_file function
            move_uploaded_file($_FILES["image"]["tmp_name"],$Target);
            if(mysqli_query($conn,$sql)){
                $_SESSION["SuccessMessage"]= "New post created successfully";
                redirect_to("AddNewPost.php");
            }else{
                $_SESSION["ErrorMessage"]= "Something went wrong";
                redirect_to("AddNewPost.php");
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
    <title>Add New Post</title>
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

        
<form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
    <div class="row gtr-uniform">
        <div class="col-6 col-12-xsmall">
            <input type="text" name="title" id="title" value="" placeholder="Enter News Title" />
        </div>
        <!-- Break -->
        <div class="col-6">
            <select name="category" id="category">
                <option></option>
                <?php 
                //fetching the categories entered in the category table
                //the fetched data is then placed in the option elements
                $query="SELECT * FROM category ORDER BY id desc";
                $result=$conn->query($query);
                while($rows=$result->fetch_assoc()){
                    $id=$rows["id"];
                    $CategoryName=$rows["name"];
                ?>
                <option><?php echo $CategoryName; ?></option>
                <?php } ?> 
            </select>
        </div>
        <div class="col-6 col-12-xsmall">
            <input type="file" name="image" id="image" />
        </div>     
        <!-- Break -->
        <div class="col-12">
            <textarea name="post" id="postArea" placeholder="Start Typing..." rows="6"></textarea>
        </div>
        <!-- Break -->
        <div class="col-12">
            <ul class="actions">
                <li><input type="submit" name="submit" value="Add New Post" class="primary" /></li>
                <li><input type="reset" value="Clear" /></li>
            </ul>
        </div>
    </div>
</form>
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
            <script src="ckeditor/ckeditor.js"></script>
            <script>
            CKEDITOR.replace('post');
            </script>
</body>
</html>