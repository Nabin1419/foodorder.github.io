<?php
// include constants.php file here
include('../config/constants.php');

//1. get the id of admin to be deleted
$id = $_GET['id'];

//2. we need to create sql query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

//execute the query
$res = mysqli_query($conn, $sql);

// check whether the query is executed successifully or not
if($res==TRUE)
{
    // query executed successifully and admin deleted
    //echo "Admin deleted";

    // to create session variables to display the message
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
    // Redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else{
    // failed to delete admin
    //echo "failed to delete admin";
    $_SESSION['delete'] = "<div class='error'>Failed to delete admin</div>";
    // redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
}

//3. Redirect to manage admin page with message, either success or error

?>