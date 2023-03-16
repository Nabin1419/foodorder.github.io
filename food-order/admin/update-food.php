<?php include('partials/menu.php'); ?>
<?php
if(isset($_GET['id']))
{
    //get all the datials
    $id = $_GET['id'];
    // sql query too get the select food
    $sql2 = "SELECT * FROM tbl_food WHERE id= $id";

    // execute the query
    $res2 = mysqli_query($conn, $sql2);

    // get the value BASED ON SELECTED QUERY
    $row2 = mysqli_fetch_assoc($res2);
    // get the individual value of selected food.
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_cateogry = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
}
else
{
    //redirect to manage food
    header('location:' . SITEURL . 'admin/manage-food.php');
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
    <br><br>

    <form action="" method="POST" enctype="multipart/form-data">
    <table class="tbl-30">
        <tr>
            <td>Title:</td>
            <td>
                <input type="text" name="title" value="<?php echo $title; ?>">
            </td>
        </tr>

        <tr>
            <td>Description:</td>
            <td>
                <textarea name="description" cols="30" rows="5"> <?php echo $description; ?></textarea>
            </td>
        </tr>

        <tr>
            <td>Price:</td>
            <td>
                <input type="number" name="price" value="<?php echo $price ?>">
            </td>
        </tr>

        <tr>
            <td>Current Image:</td>
            <td>
               <?php
               if($current_image =="")
               {
                //image not available
                echo "<div class='error'>Image not found</div>";
               }
               else
               {
                //Image available
                ?>
                <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="100px">

                <?php
               }

               ?>
            </td>
        </tr>

        <tr>
            <td>Select New Image:</td>
            <td>
                <input type="file" name="image">
            </td>
        </tr>

        <tr>
            <td>Category:</td>
            <td>
                <select name="category">
                    <?php
                    // query to get active category
                    $sql = "SELECT * FROM tbl_category WHERE active='yes'";
                    // execute the query
                    $res = mysqli_query($conn, $sql);
                    // count rows
                    $count = mysqli_num_rows($res);

                    // check catgeory available or not
                    if($count>0)
                    {
                        // availabe
                        while($row = mysqli_fetch_assoc($res))
                        {
                            $category_title = $row['title'];
                            $category_id = $row['id'];

                            //echo "<option value='$category_id'>$category_title</option>";
                            ?>
                            <option <?php if($current_cateogry==$category_id) { echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                            <?php                        
                        }
                    }
                    {
                        // category not availabe
                        echo "<option value='0'>Category not available</option>";
                    }
                    ?> 
                </select>
            </td>
        </tr>

        <tr>
            <td>Featured:</td>
            <td>
            <input <?php if($featured=="Yes") { echo "checked"; } ?>  type="radio" name="featured" value="Yes">Yes
            <input <?php if($featured=="No") { echo "checked"; } ?>  type="radio" name="featured" value="No">No
            </td>
        </tr>

        <tr>
            <td>Active:</td>
            <td>
            <input <?php if($active=="Yes") { echo "checked"; } ?> type="radio" name="active" value="Yes">Yes
            <input <?php if($active=="No") { echo "checked";} ?> type="radio" name="active" value="No">No
            </td>
        </tr>

        <tr>
            <td>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                <input type="submit" name="submit" value="update food" class="btn-secondary">
            </td>

        </tr>

    </table>
    </form>
    </div>
</div>
<?php
// check button click or not
if(isset($_POST['submit']))
{
    //echo ("button clciked");
    //1. get the details from the form
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $current_image = $_POST['current_image'];
    $category = $_POST['category'];

    $featured = $_POST['featured'];
    $active = $_POST['active'];

    //2.A.upload the image if selected

    // check if the image is upload or not
    if(isset($_FILES['image']['name']))
    {
        // button clicked
        $image_name = $_FILES['image']['name']; //new image name

        // check whether the file is available or not
        if($image_name!="")
        {
            // rename the image
            $ext = explode('.', $image_name); //get the extension of image
            $ext1 = end($ext);
            $image_name = "Food-Name-" . rand(0000, 9999) . '.' . $ext1; // rename the image name with "Food-Name-"
            // get the source path
            $src_path = $_FILES['image']['tmp_name']; //source path
            $dest_path = "../images/food/".$image_name; //destination path
            // upload the image
            $upload = move_uploaded_file($src_path, $dest_path);
            // check whether the image is upload or not
            if($upload==false)
            {
                $_SESSION['upload'] = "<div class='error'>Failed to upload food image</div>";
                // redirect
                header('location:' . SITEURL . 'admin/manage-food.php');
                die(); //stop the process
            }
            //3.remove the image if the new image is selected and current image is exists.
            //B. remove current image if available
            if($current_image !="")
            {
                // remove the path
                $remove_path = "../images/food/".$current_image;
                $remove = unlink($remove_path);

                // check whether the image is remove or not
                if($remove ==false)
                {
                    // failed to remvoe
                    $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image.</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                    die(); //stop the process
                }
            }
        }
        else
        {
                 
        $image_name = $current_image;  //default image when image is not selected
        }
        
    }
    else
    {
        // button not clicked a
        $image_name = $current_image; //default image when button is not clicked
    }
    //4.update the food in database
    $sql3 = "UPDATE tbl_food SET
    title = '$title',
    description = '$description',
    price = $price,
    image_name = '$image_name',
    category_id = '$category',
    featured = '$featured',
    active = '$active'
    WHERE id = $id
     ";
     // execute the query
    $res3 = mysqli_query($conn, $sql3);
     // check query is execute or not
     if($res3==TRUE)
     {
        // query executed and update food
        $_SESSION['update'] = "<div class='success'>Food Update Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
     }
     else{
        //5. redirect the manage-food page
        // failed to update food
        $_SESSION['update'] = "<div class='error'>Faield to update food!.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
     }

}
?>
<?php include('partials/footer.php'); ?>