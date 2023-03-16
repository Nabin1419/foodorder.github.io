<?php include('partials/menu.php')  ?>
<div class="main-content">
        <div class="wrapper">
                <h1>Add Admin </h1>
            <br><br>
            <?php
            if(isset($_SESSION['add'])) // check whether the session is set or not
            {
                echo $_SESSION['add']; // display the message in add admin
                unset($_SESSION['add']); // Remove the message from add admin

            }
            ?>
            <form action="" method="POST">
                 <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="enter your name">
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="your username">
                    </td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="your password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
                </table>
            </form>

        </div>
</div>
<?php include('partials/footer.php')  ?>
<?php 
// process the value from form and save into the database
//check whether the submit button is click or not
if(isset($_POST['submit']))
{
    // button clicked
    //echo" button clicked";

    //1.get the data from our form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // password encrypted using md5 algorithm

    //2. SQL query to save the data into the database
    $sql = "INSERT INTO tbl_admin SET
    full_name = '$full_name',
    username = '$username',
    password = '$password'
    "; 

    //3. executing query and saving into the database
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    // check whether the(query is executed) data is inserted or not and display the message
    if($res==TRUE)
    {
        // data inserted
        //echo "Data Inserted";
         //create a session variable to display the message
         $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";

         // Redirect page to Manage admin
         header("location:".SITEURL.'admin/manage-admin.php');
    }
    else{
        // data not inserted
        //echo "Failed to inset data";
        $_SESSION['add'] = "<div class='error'>Failed to add admin</div>";

        // Redirect page to Add admin
        header("location:".SITEURL.'admin/add-admin.php');
       
    }

}
?>