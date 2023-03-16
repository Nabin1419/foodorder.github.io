<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
<?php
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Titlle:</td>
                    <td>
                        <input type="text" name="title" placeholder="title of the food" >
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="description of the food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                   <select name= "category">
                    <?php
                    // create php code to dislpay categroy from database

                    //1. create sql query to get all active category form database
                    $sql = "SELECT *FROM tbl_category WHERE active='yes' ";

                    // execute the query
                    $res = mysqli_query($conn, $sql);
                    // count rows to check whether we have categories or not
                    $count = mysqli_num_rows($res);

                    // if count is greater than zero, we have category else we do not have category
                    if($count>0)
                    {
                        // we have category
                        while($row=mysqli_fetch_assoc($res))
                        {
                            // get the details of category
                            $id = $row['id'];
                            $title = $row['title'];

                            ?>

                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                            <?php
                        }
                    }
                    else
                    {
                        //we do not have categroy
                        //
                        ?>
                        <option value="0">No Category Found</option>
                        <?php
                    }
                    // then display on dropdown
                    ?>                   
                   </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" value="Yes" name="featured">Yes
                        <input type="radio" value="No" name="featured">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" value="Yes" name="active">Yes
                        <input type="radio" value="No" name="active">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
// check whether the button is clicked or not
if(isset($_POST['submit']))
{
    //echo "button clicked";
    // Add the food in the database

    //1. to get the data from form
    
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    //check whether radio button for featured and active are checked or not
    if(isset($_POST['featured']))
    {
        $featured = $_POST['featured'];
    }
    else
    {
        $featured = "No"; // setting defult value
    }
    if(isset($_POST['active']))
    {
        $active = $_POST['active'];
    }
    else
    {
        $active = "No"; // default value
    }

    //2. upload the image if selected

    // check whether the select image is clicked or not and upload the image only if the image is selected
    if(isset($_FILES['image']['name']))
    {
       // get the details of the selected image 
        $image_name = $_FILES['image']['name'];

        // check whether the image is selected or not
        // and upload image only if selected
        if($image_name !=="")
        {
            // image is selected
            // A. rename the image
            // get the extension of selected image (jpg,[ng,gif etc) nabinbk.jpg
            $ext = explode('.', $image_name);
            $ext1 = end($ext);
            // create new name for image
            $image_name = "Food_Name_" . rand(0000, 9999) . "." . $ext1; // new image name may be "Food-Name-657.jpg
            //B. upload the image
            // get the source path and destination path
            // source path is the current location of the image
            $src = $_FILES['image']['tmp_name'];
            // destination path for the image to be uploaded
            $dst = "../images/food/".$image_name;
            // finally upload food image
            $upload = move_uploaded_file($src, $dst);
            // check whether image uploaded or not
            if($upload == false)
            {
                // failed to upload the image
                $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                // redirect to add food page with error message
                header('location:' . SITEURL . 'admin/add-food.php');
                // stop the process
                die();
            }

        }
        else
        {
            // not select image
        }

    }
    else
    {
        $image_name = ""; // setting default value as blank
    }

    //3. inset into databse
    // create sql query to save or added food
    $sql2 = "INSERT INTO tbl_food SET
    title = '$title',
    description = '$description',
    price = $price, /* for numerical value we do not need to pass inside quotes */
    image_name = '$image_name',
    category_id = $category,
    featured = '$featured',
    active = '$active'
    ";

    // execute the query

    $res2 = mysqli_query($conn, $sql2);

    // check whether data is inserted or not
      //4. redirect with message to manage food page
    if($res2==TRUE)
    {
        // data inserted successfully
        $_SESSION['add'] = "<div class='success'>Food Added Successfully</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
    else{
        // failed to insert data
        $_SESSION['add'] = "<div class='error'>Failed to Added Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
        
    } 
}
?>
<?php include('partials/footer.php');?>