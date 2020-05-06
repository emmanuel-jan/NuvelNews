<?php require_once'include/Sessions.php'; ?>
<?php require_once'include/Functions.php'; ?>
<?php require_once'include/db.php'; ?>
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
        if(empty($Title)){
            $_SESSION["ErrorMessage"]="Title field must be filled out";
            redirect_to("EditPost.php");
        }elseif(strlen($Title)<2){
            $_SESSION["ErrorMessage"]="Title name too short";
            redirect_to("EditPost.php");
        }else{
            //updating data in the database
            $EditFromURL=$_GET["Edit"];
            $sql="UPDATE admin_panel SET datetime='$DateTime',title='$Title',category='$Category',author='$Admin',image='$Image',post='$Post'
             WHERE id='$EditFromURL'";
            //moving the file from the users pc to the web app
            //this is done using the move_uploaded_file function
            move_uploaded_file($_FILES["image"]["tmp_name"],$Target);
            if(mysqli_query($conn,$sql)){
                $_SESSION["SuccessMessage"]= "Post updated successfully";
                redirect_to("Dashboard.php");
            }else{
                $_SESSION["ErrorMessage"]= "Something went wrong";
                redirect_to("Dashboard.php");
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
    <title>Update Post</title>
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
                <?php 
                    //extracting the content from where the id is equal to the search parameter
                    $SearchQuery=$_GET["Edit"];
                    $query="SELECT * FROM admin_panel WHERE id='$SearchQuery'";
                    $result=$conn->query($query);
                    while($rows=$result->fetch_assoc()){
                        $TitleToBeUpdated=$rows["title"];
                        $CategoryToBeUpdated=$rows["category"];
                        $ImageToBeUpdated=$rows["image"];
                        $PostToBeUpdated=$rows["post"];
                    }
                ?>        
<form method="post" action="EditPost.php?Edit=<?php echo $SearchQuery; ?>" enctype="multipart/form-data">
    <div class="row gtr-uniform">
        <div class="col-6 col-12-xsmall">
            <input type="text" name="title" id="title" value="<?php echo $TitleToBeUpdated;?>" placeholder="Enter News Title" />
        </div>
        <!-- Break -->
        <div class="col-7">
            <i class="logo">Existing Category:<strong><?php echo $CategoryToBeUpdated?></strong></i>
            <select name="category" id="category">
                <option>-Select News Category -</option>
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
            <i class="logo">Existing Image:</i>
            <p> <img src="Upload/<?php echo $ImageToBeUpdated; ?>" alt="image to be updated" width="100px" height="100px"/></p>
            <p> <input type="file" name="image" id="image" /> </p>
        </div>     
        <!-- Break -->
        <div class="col-12">
            <textarea name="post" id="postArea" placeholder="Start Typing..." rows="6"><?php echo $PostToBeUpdated; ?></textarea>
        </div>
        <!-- Break -->
        <div class="col-12">
            <ul class="actions">
                <li><input type="submit" name="submit" value="Update Post" class="primary" /></li>
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
                        <li><a href="comments.php">Comments</a></li>
                        <li><a href="#">Live Blog</a></li>
                        <li><a href="#">Logout</a></li>
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