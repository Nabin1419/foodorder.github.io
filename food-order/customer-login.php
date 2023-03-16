<?php include('config/constants.php'); ?>
<?php
if(isset($_SESSION['customer-login']))
{
    echo $_SESSION['customer-login'];
    unset($_SESSION['customer-login']);
}
if(isset($_SESSION['no-login-customer']))
{
    echo $_SESSION['no-login-customer'];
    unset($_SESSION['no-login-customer']);
}

?>

<html>
<head>
    <title>customer-login</title>
    <!-- link css files-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/customer-login.css">
</head>
<body>
   
    
<!-- Navbar section start here -->
<section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>
            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="#">Home</a>
                    </li>
                    <li>
                        <a href="#">Categories</a>
                    </li>
                    <li>
                        <a href="#">Foods</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                    <li>
                    <a href="customer-logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
</section>
<!-- Navbar section ends here -->

</body>
<?php
    if(isset($_SESSION['signup-customer']))
    {
        echo $_SESSION['signup-customer'];
        unset($_SESSION['signup-customer']);
    }
    ?>

<div class="content">
            <div class="box2 ">
				<h1>Online Food<br><span>Order</span></h1>
				<p class="par">Food is your body's
                  <br> fuel. Without fuel, 
                <br>Your body wants to<br>
                    shut down.</p>
               <!-- <button class="cn"><a href="#">Contact Us</button>-->
            </div>
        <div class="box2 login">        	
            <form method="POST" class="form">
                	<h3 class="text-center">Login Here</h3>
                	<input type="text" name="username" placeholder="Enter username here"><br><br>
                	<input type="password" name="password" placeholder="Enter Password here"><br><br>
                	<input type="submit" name="submit" class="btn" value="Login">
                    <h4 class="text-center">Don't have an account</h4>
                <a href="customer-signup.php"><input class="btn" value="SignUp"></a>
            </form>
        </div>                
</div>
<div class="clearfix"></div>
<!-- footer Section Starts Here -->
<div class="footer-login">
<div class="container text-center">
    <p style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Design and Develop by:<a href="#">DNA TechGroup</a></p>
</div>
</div>

<!-- footer Section Ends Here -->

</html>
<?php
if(isset($_POST['submit']))
{
   //echo "Clicked";
   //1. get the data from login form
   $username= $_POST['username'];
   $password=$_POST['password'];
   //2.select sql query to select the usernam eor passwor dis exit or not
   $sql="SELECT * from tbl_signup WHERE username='$username' AND password='$password'";
   //3. execute the query
   $res=mysqli_query($conn,$sql); 
   //4. to check whether the user is exit or not
   $count= mysqli_num_rows($res);
   if($count==1)
   {
    $_SESSION['customer-login']="<div class='success'>Customer login sucessful</div>";
    $_SESSION['user']=$username;
    //redirect to homepage
    header("location:".SITEURL);
    die();
   }
   else
   {
    $_SESSION['customer-login']="<div class='error'>Customer login Failed!!</div>";
    //redirect to customer-login page
    header("location:".'customer-login.php');
    die();
   }
   

}
?>
