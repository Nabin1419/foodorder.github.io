<?php include('partials-front/menu.php'); ?>
<?php //include('check-customer-login.php'); ?>
<?php 
/*if(isset($_SESSION['customer-login']))
{
    echo $_SESSION['customer-login'];
    unset($_SESSION['customer-login']);
} */

?>
<?php

    //check whether the food id is set or not
        if(isset($_GET['food_id']))
            {
                //get the food id and details of the selected food
                $food_id = $_GET['food_id'];
                //get the details of the selected food
                $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
                //execute the query
                $res = mysqli_query($conn, $sql);
                // count the rows
                $count = mysqli_num_rows($res);
                // check whether the data is available or not
                if($count==1)
                {
                    //we have value
                    //get the data from db
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    //redirect
                    //header('location:' . SITEURL.'order.php');

                }
                
                else
                {
                    //food not found
                    // redircet
                    header('location:' . SITEURL);
                }
                

            }
            else
            {
                //redirect to homepage
                header('location:' . SITEURL);
            }
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container div-order">
            
            <h2 class="text-center text-color">Fill the form to confirm the orders</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                                <?php
                                //check whether image is available or not
                                if($image_name=="")
                                {
                                    //image is not availavle
                                    echo "<div  class='error'>Image not available</div>";
                                }
                                else
                                {
                                    //image is available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    
                                    <?php
                                }

                                ?>
                       
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Nabin bk" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 98xxxxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. @gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
        </div>
            <?php
                //check whether submit button clicked or not
                if (isset($_POST['submit'])) 
                    {
                                    //get all the deatils from the form
                            
                                    $food = $_POST['food'];
                                    $price = $_POST['price'];
                                    $qty = $_POST['qty'];
                                    $total = $price * $qty; // total= price * qty
                                    $order_date = date("y-m-d h:i:sa"); // order date
                                    $status = "ordered"; // ordered, on delivered, delivered, cancelled
                                    $customer_name = $_POST['full-name'];
                                    $customer_contact = $_POST['contact'];
                                    $customer_email = $_POST['email'];
                                    $customer_address = $_POST['address'];

                                    // save the order in database
                                    // create sql to save the data

                                    $sql2 = "INSERT INTO tbl_order  SET 
                                    food = '$food',
                                    price = $price,
                                    qty = '$qty',
                                    total = $total,
                                    order_date = '$order_date',
                                    status = '$status',
                                    customer_name = '$customer_name',
                                    customer_contact = '$customer_contact',
                                    customer_email = '$customer_email',
                                    customer_address = '$customer_address'
                                    
                                    
                                    ";
                                    //execute the query
                                    $res2 = mysqli_query($conn, $sql2);
                                    // check whether the query is executed or not
                                    if($res2==true)
                                    {
                                    // query executed and order saved
                                    $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully</div>";
                                    ?>
                                    <script>
                                                 window.location.href="http://localhost/food-order/";
                                        </script>
                                    <?php
                                 
                                    }
                                    else
                                    {
                                    // failed to save order
                                    $_SESSION['order'] = "<div class='error text-center'>Failed to ordered</div>";
                                    
                                    header('location:' . SITEURL);
                                    }
                         
                    }
                ?>
    </section>
<!-- fOOD sEARCH Section Ends Here -->
<?php include('partials-front/footer.php'); ?>
</body>
</html>