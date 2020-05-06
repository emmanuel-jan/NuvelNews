<?php require_once'include/Sessions.php'; ?>
<?php require_once'include/Functions.php'; ?>
<?php require_once'include/db.php'; ?>
<?php 
if(isset($_GET["id"])){
    $IdFromURL=$_GET["id"];
    $sql="UPDATE comments SET status='OFF' WHERE id='$IdFromURL'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION["SuccessMessage"]= "Comment disapproved successfully";
        redirect_to("comments.php");
    } else {
        $_SESSION["ErrorMessage"]= "Something went wrong";
        redirect_to("comments.php");
    }
}
?>