<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category Page</h1>
        <br><br>

        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>
        <br><br>
        <!-- Add category form start here -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                <input type="text" name="title" placeholder="Category Title">
                </td>
            </tr>
            <tr>
                <td>Select Image:</td>
                <td><input type="file" name="image"></td>
             </tr>

            <tr>
            <td>Featured:</td>
            <td>
                <input type="radio" name="featured" value="yes">Yes
                <input type="radio" name="featured" value="no">No

            </td>
            </tr>
            <tr>
                <td>Active:</td>
                <td>
                    <input type="radio" name="active" value="yes">Yes
                    <input type="radio" name="active" value="no">No
                </td>
            </tr>

            <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
            </tr>

            </table>
        </form>
        <!-- Add category form ends here -->
    <?php
     
if(isset($_POST['submit']))
{
    //echo "button clicked";
    //1. get the value form category form
    $title = $_POST['title'];

    // for radio button we need to check whether the button is clicked or not
    if(isset($_POST['featured']))
    {
        // get the value form form
        $featured = $_POST['featured'];
    }
    else
    {
        //set the defult value
        $featured = "No";
    }

    if(isset($_POST['active']))
    {
        // get the value from form
            $active = $_POST['active'];
    }
    else
    {
        // set the default form
        $active = "NO";
    }
        // chechk whether the image is selecte or not and set the value for image accordingly.
   // print_r($_FILES['image']) or die();
   if(isset($_FILES['image']['name']))
   {
         // upload the image 
            // to upload the image we need image name, source path and destination path
            $image_name = $_FILES['image']['name'];

            //upload the image if image is selected.
        if($image_name !="")
        {

            // auto rename our image
            // get the extension of our image(jpg,png,jif) e.g "Specialfood1.jpg"
            $ext = explode('.', $image_name);
            $ext1 = end($ext);
            // rename the image
            $image_name = "Food_Category_".rand(000, 999) .'.'.$ext1; // food_category_845.jpg
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/".$image_name;

            // finally upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            // check whether the image is upload or not 
            // and if the image is not uploaded then we will stop the process and redirect the page with error message
            if ($upload == false) 
            {
                    // set message
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                    // redirect to add category page
                    header('location:' . SITEURL . 'admin/add-category.php');
                    // stop the process
                    die();
    
            }  

        }
   }
   else
   {
    // don't upload the image and set the image_name value as blank
        $image_name = "";
   }

        // break the code here
    //2. Create sql query to insert category into the database
    $sql = "INSERT INTO tbl_category SET
    title = '$title',
    image_name ='$image_name',
    featured='$featured',
    active = '$active'
   ";

    //3. execute the query and save into the database
    $res = mysqli_query($conn, $sql);

    //4. to check whether the user is execute or not and data add into database
    if($res==TRUE)
    {
        // query executed and category added
        $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
        // redirect to manage admin page
        header('location:' . SITEURL . 'admin/manage-category.php');
    }
    else
    {
           
        // failed to add category
        $_SESSION['add'] = "<div class='error'>Failed to Add Category</div>";
        //redirect to manage admin page
        header('location:' . SITEURL . 'admin/add-category.php');
    }

 

}

    ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>