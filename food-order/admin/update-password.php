<?php include('partials/menu.php');?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Change Password</h1>
            <br><br>
            <?php  
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
            ?>            
            <form action="" method="POST">
                <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td><input type="password" name="current_password" placeholder="enter your old password"></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" placeholder="enter your new password"></td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirm_password" placeholder="confirm you password"></td>
                </tr>                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo ("$id"); ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
                </table>
            </form>
        </div>
</div>
    <?php
    // check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Clicked";
       //1. get the data from database
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);
        //2. Check whether the user current id and current password is executed or not
        $sql = "SELECT * FROM tbl_admin WHERE id= $id AND password = '$current_password'";
        // execute the query
        $res = mysqli_query($conn, $sql);
        if($res==true)
        {
            // Check whether the data is availabe or not
        $count = mysqli_num_rows($res);
            if($count==1)
            {
            // User exits and password can be changed
            //echo "user found";
                // check whether the new password and confirm password match or not
                if($new_password==$confirm_password)
                {
                     //echo "password match";
                    // update the password
                   
                $sql2 = "UPDATE tbl_admin SET
                password = '$new_password'
                WHERE id = $id                
                ";
                    //Execute the query
                $res2 = mysqli_query($conn, $sql2);

                // check whether the query is executed or not
                if($res2==true)
                {
                    // Display success msg
                    $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";
                    // redirect the user
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                }
                else
                {
                    //display error message
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to changed the Password</div>";
                }


                }
                else
                {
                    // redirect page to the manage admin page
                $_SESSION['pwd-not-match'] = "<div class='error'>Password did not match</div>";
                    // redirect
                header('location:' . SITEURL . 'admin/manage-admin.php');
                }


            }
            else{
                //user doesnot exist set message and redirect page to manage admin
            $_SESSION['user-not-found'] = "<div class='error'>User not found</div>";
                // redirect the user into the manage admin page
            header('location:' .SITEURL. 'admin/manage-admin.php');

            }

        }  
               
    } 

?>
<?php include('partials/footer.php');?>