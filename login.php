<?php require_once'include/db.php'; ?>
<?php require_once'include/Sessions.php'; ?>
<?php require_once'include/Functions.php'; ?>
<?php
 if(isset($_POST["submit"])){
     $Username=$conn->real_escape_string($_POST["username"]);
     $Password=$conn->real_escape_string($_POST["password"]);

     if(empty($Username)||empty($Password)){
         $_SESSION["ErrorMessage"]="All fields must be filled";
         redirect_to("login.php");
     }else{
         $Password=md5($Password);
         $FoundAccount=Login_Attempt($Username,$Password);
         $_SESSION["User_Id"]=$FoundAccount["id"];
         $_SESSION["Username"]=$FoundAccount["username"];
         if($FoundAccount){
             $_SESSION["SuccessMessage"]="Welcome! {$_SESSION["Username"]}";
             redirect_to("Dashboard.php");
         }else{
             $_SESSION["ErrorMessage"]="Invalid details";
             redirect_to("login.php");
         }
     }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/login.css" type="text/css">
</head>
<body>

    <div class="loginbox">
        <img src="image/10000404.jpg" class="avatar">
        <h1>Login Here</h1>
        <form method="post" action="<?php echo(htmlentities($_SERVER["PHP_SELF"])); ?>">
             
                <span> 
                    <?php 
                     echo Message();
                     echo SuccessMessage();
                    ?>
                </span>

            <p>Username</p>
            <input type="text" name="username" placeholder="Enter Username">
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter Password">
            <input type="submit" name="submit" value="Login">
            <a href="#">Lost your password?</a><br>
            <a href="#">Don't have an account?</a>
        </form>
    </div>
</body>
</html>