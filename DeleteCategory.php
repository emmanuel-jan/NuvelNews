<?php require_once'include/db.php'; ?>
<?php require_once'include/Sessions.php'; ?>
<?php require_once'include/Functions.php'; ?>
<?php
        $DeleteFromURL=$_GET['id'];
        $sql="DELETE FROM category  WHERE id='$DeleteFromURL'";
        if (mysqli_query($conn, $sql)) {
            $_SESSION["SuccessMessage"]= "Category deleted successfully";
            redirect_to("categories.php");
        } else {
            $_SESSION["ErrorMessage"]= "Something went wrong";
            redirect_to("categories.php");
        }
?>