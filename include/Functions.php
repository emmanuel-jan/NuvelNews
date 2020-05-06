<?php require_once'include/db.php'; ?>
<?php require_once'include/Sessions.php'; ?>
<?php
function redirect_to($New_Location){
    header("location:".$New_Location);
    exit;
}
function Login_Attempt($Username,$Password){
    $conn=mysqli_connect("localhost","root","Emaochi99","phpcms");
    $sql="SELECT * FROM registration WHERE username='$Username' AND password='$Password'";
    $result=$conn->query($sql);
    if($admin=mysqli_fetch_assoc($result)){
        return $admin;
    }else{
        return null;
    }
}
function Login(){
    if(isset($_SESSION["User_Id"])){
        return true;
    }
}
function Confirm_Login(){
    if(!Login()){
        $_SESSION["ErrorMessage"]="Login Required";
        redirect_to("login.php");
    }
}
?>