<?php
// include constants.php for SITEURL
include('../config/constants.php');
//1. destroy the session.
session_destroy(); //unset $_SESSION['user'] and user
//2. redirect to login page
header('location:' . SITEURL . 'admin/login.php');
?>