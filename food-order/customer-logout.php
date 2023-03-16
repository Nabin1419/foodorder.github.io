<?php
//1.include constat.php for SITEURL
include('../config/constants.php');
//1. destroy session
session_destroy();
//2. redriect to login page
header("location:".'customer-login.php');
?>