 <!-- connect to database-->
 <?php include('config/constants.php'); ?>
 <!-- Link our CSS file -->
 <link rel="stylesheet" href="css/style.css">
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
                    <a href="#">Logout</a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
</section>
<div class="login">
    
      
        <form action="" method="POST" class="text-center order">
        <h1 class="text-center text-color">Fill the Registeration Form</h1><br>
            
                <div class="order-label">FullName:</div>
                <input type="text" name="fullname" placeholder="Write your name" class="input-responsive" required>
                
                <div class="order-label">Username:</div>
                <input type="text" name="username" placeholder="Username" class="input-responsive" required>

                <div class="order-label">Email:</div>
                <input type="email" name="email" placeholder="example@gmail.com" class="input-responsive" required>

                <div class="order-label">Password:</div>
                <input type="password" name="password" placeholder="**********" class="input-responsive" required>
                <br><br>
                <input type="submit" name="submit" value="SignUp" class="btn btn-primary">
                <a href="customer-login.php">Click to Login</a>
            
            
        </form>
</div><br><br>
<div class="footer-login">
<div class="container text-center">
    <p style="font-family: Verdana, Geneva, Tahoma, sans-serif">Design and Develop by:<a href="#">DNA TechGroup</a></p>
</div>
</div>

<?php
//check whether the submit button clicked or not
//echo "button clicked";
//get the value form form
if (isset($_POST['submit'])) 
{
            $fullname = $_POST['fullname'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            //save the data into the database
            //create sql to save tsshe data
            $sql = "INSERT INTO tbl_signup SET
            fullname = '$fullname',
            username = '$username',
            email = '$email',
            password= '$password'
            ";
            //execute the query
            $result = mysqli_query($conn, $sql);
            //check whether query is executed or not
            if($result==TRUE)
            {
                
            $_SESSION['signup-customer'] = "<div class='success'>Signup Successful..</div>";
            ?>
            <!-- redirect using javascript -->
                <script>
           window.location.href="http://localhost/food-order/customer-login.php";
            </script>       
            <?php
            }           
}
?>