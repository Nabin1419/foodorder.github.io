
<?php //echo ('delete food');
// include constants page
include('../config/constants.php');
if((isset($_GET['id'])) && isset($_GET['image_name']))
{
    // process delete
   // echo "Process delete";
   //1. get id and image name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

   //2. remove the image if availabe
   //(check whether the image is availabe or not and delete only if available)
   if($image_name !="")
   {
    // It has image and need to remove from folder
    // get the image path
        $path = "../images/food/".$image_name;

        // remove image file from folder
        $remove = unlink($path);

        // check image successfully remove or not
        if($remove == false)
        {
            // failed to remove image
            $_SESSION['upload'] = "<div class='error'>Failed to remove image files</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
            die(); // stop the process
        }
   }
   else
   {

   }

   //3. delete food from database
    $sql = "DELETE FROM tbl_food WHERE id = $id";
    // execute the query
    $res = mysqli_query($conn, $sql);

    // check whether the query is execute or not and set the session message
    //4. redirect to manage food with session message
    if($res==true)
    {
        // food delete
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
    else
    {
        // failed to delete
        $_SESSION['delete'] = "<div class='error'>Filed to Delete food.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }  
}
else
{
    // redirect to manage food page
    //echo "process redirect";
    $_SESSION['unautorize'] = "<div class='error'>Unauthorized Access!!</div>";
    header('location:' . SITEURL . 'admin/manage-food.php');
}
?>