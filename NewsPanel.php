<?php require_once'include/db.php'; ?>
<?php require_once'include/Sessions.php'; ?>
<?php require_once'include/Functions.php'; ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>NuvelNews Panel</title>
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

<!-- Banner 
<section id="banner">
    <div class="content">
        <header>
            <h1>Coronavirus<br />
            in Kenya</h1>
            <p>A deadly virus outbreak</p>
        </header>
        <p>Aenean ornare velit lacus, ac varius enim ullamcorper eu. Proin
            aliquam facilisis ante interdum congue. Integer mollis, nisl amet 
            convallis, porttitor magna ullamcorper, amet egestas mauris. Ut magna 
            finibus nisi nec lacinia. Nam maximus erat id euismod egestas. 
            Pellentesque sapien ac quam. Lorem ipsum dolor sit nullam.</p>
        <ul class="actions">
            <li><a href="#" class="button big">Learn More</a></li>
        </ul>
    </div>
    <span class="image object">
        <img src="Upload/pic15.jpg" alt="" />
    </span>
</section>
-->
<!-- Section -->

<section>
    <header class="major">
        <h2>Headlines</h2>
    </header>
 
    <div class="posts">
    <?php 
    //Activating the search area
    if(isset($_GET["SearchButton"])){
        $Search=$_GET["query"];
        //Query when the search button is active
        $query="SELECT * FROM admin_panel 
        WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE '%$Search%'
        ORDER BY id desc";
    }elseif(isset($_GET["Category"])){
        $Category=$_GET["Category"];
        $query="SELECT * FROM admin_panel WHERE category='$Category' ORDER BY id desc";
    }
    elseif(isset($_GET["page"])){
        $page=$_GET["page"];
        if($page==0||$page<1){
            $ShowPostForm=0;
        }else{
        $ShowPostForm=($page*5)-5;
        }
        $query ="SELECT * FROM admin_panel ORDER BY id desc LIMIT $ShowPostForm,6";
    }else{
    //fetching data from the database
    $query="SELECT * FROM admin_panel ORDER BY id desc LIMIT 0,6";}
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
            <a href="FullPost.php?id=<?php echo $PostId; ?>" class="image"><img src="Upload/<?php echo $Image;?>" alt="" width="310px" height="388px" /></a>
            
            <h2><?php echo $Title;?></h2>
            <p><i class="logo">Category:<strong><?php echo $Category;?></strong> Published on:<strong><?php echo $DateTime;?></strong></i></p>
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

    <ul class="pagination">
            <?php 
            if(isset($page)){
            if($page>1){
            ?>
            <li><a href="NewsPanel.php?page=<?php echo $page-1; ?>" class="button">Prev</a></li>
            <?php
            }
        }
            ?>
            <?php 
            $query="SELECT COUNT(*) FROM admin_panel";
            $Execute=$conn->query($query);
            $RowPagination=mysqli_fetch_array($Execute);
            $TotalPosts=array_shift($RowPagination);
            //echo $TotalPosts;
            $PostPagination=$TotalPosts/6;
            $PostPagination=ceil($PostPagination);
            //echo $PostPagination;
        for($i=1;$i<=$PostPagination;$i++){
            if(isset($page)){
                if($i==$page){
            ?>
              <li><a href="NewsPanel.php?page=<?php echo $i; ?>" class="page active"><?php echo $i; ?></a></li>
            <?php 
            }else{
                ?>
                <li><a href="NewsPanel.php?page=<?php echo $i; ?>" class="page"><?php echo $i; ?></a></li> 
                <?php
                }
            }
        }?>
            <?php 
                if(isset($page)){
                if($page<$PostPagination){
                    ?>
                    <li><a href="NewsPanel.php?page=<?php echo $page+1; ?>" class="button">next</a></li>
                <?php
                }
            }
            ?>
    </ul>

    

</div>
</div>

<!-- Sidebar -->
<div id="sidebar">
<div class="inner">

    <!-- Search -->
        <section id="search" class="alt">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type="text" name="query" id="query" placeholder="Search" />
                <button class="button small" name="SearchButton">Go</button>
            </form>
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
            <p> </p>
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