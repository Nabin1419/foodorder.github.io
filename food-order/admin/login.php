<?php include('../config/constants.php') ?>
<html>
    <head>
        <title>
            login food order section
        </title>
        <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login:</h1>
        <br><br>
    <?php 
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['no-login-message']))
        {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
    ?>
        <br><br>
        <!-- login form start here -->
        <form action="" method="POST" class="text-center">
            Username:
            <br>
            <input type="text" name="username" placeholder="Enter Username">
            <br><br>
            Password:
            <br>
            <input type="password" name="password" placeholder="Enter password">
            <br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        </form>

        <!-- login form ends here -->
        <p class="text-center"> Created By - <a href="#">DNA TechGroup</a></p>
    </div>
</body>
</html>
<?php
// check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    // process for login

    //1. get the data from login form
    //$username = $_POST['username'];
    $username = mysqli_real_escape_string($conn,$_POST['username']);
     //$password = md5($_POST['password']);
     $password = mysqli_real_escape_string($conn, md5($_POST['password']));

     //2. Sql to check whether the username and password exit or not
    $sql = "SELECT * FROM tbl_admin WHERE username= '$username' AND password = '$password' ";

     //3. execute the query
    $res = mysqli_query($conn, $sql);

    //4. to check whether the user exist or not
    $count = mysqli_num_rows($res);

    if($count==1)
    {
        // user availabe and login success
        $_SESSION['login'] = "<div class='success'>Login Successful</div>";
        $_SESSION['user'] = $username; // to check whether the user is login or not and logout will unset it.       
       // redirect to dashbord
       header('location:'.SITEURL.'admin/');        
    }   
    else
    {
    // user not availabe here and login failed
    $_SESSION['login'] = "<div class='error text-center'>Login Failed</div>";
    header('location:'.SITEURL.'admin/login.php');
    }    
}
?>