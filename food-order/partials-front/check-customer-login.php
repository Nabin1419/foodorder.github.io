<?php

//check authorization -access control
if(!isset($_SESSION['user']))
{
//if user session is not set
//user is not login
//redirect to logon page with message
$_SESSION['no-login-customer']="<div class='error'>Please login to access our FOMS</div>";
//redirect to login page
header("location:".'customer-login.php');

} 

?>