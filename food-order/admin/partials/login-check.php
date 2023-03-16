<?php
// Authorization -Access control
// to check whether the user is login or not
if(!isset($_SESSION['user']))   // if user session is not set
{
    // user is not login

    // redirect to login page with message
    $_SESSION['no-login-message'] = "<div class='error'>Please login to access the Admin Panel</div>";
    // redirect to login page
    header('location:' . SITEURL . 'admin/login.php');
}
?>