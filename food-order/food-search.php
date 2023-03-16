<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
            if(isset($_POST['search']))
            {
            // get the search keyboard
            $search = mysqli_real_escape_string($conn, $_POST['search']);
            }
    
            ?>
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search; ?></a></h2>
            <?php
            ?>
        </div>
    </section>
    <!-- fOOD SEARCH Section Ends Here -->
    <!-- fOOD Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
                    <?php
                       // $search = $_POST['search'];
                        $search = mysqli_real_escape_string($conn, $_POST['search']);
                            
                        // create sql query to get food based on search
                        // $search = burger'; DROP database name
                        //"SELECT * FROm tbl_food WHERE title LIKE '%burger'%' OR description LIKE '%burger'%'";
                        $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
                        // execute the query
                        $res = mysqli_query($conn, $sql);

                        // count rows
                        $count = mysqli_num_rows($res);
                        if (!$res) {
                            echo "Error: " . mysqli_error($conn);
                        }
                       if($count>0)
                        {
                            //food available
                            while($row = mysqli_fetch_assoc($res))
                            {
                                // get the details
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $description = $row['description'];
                                $image_name = $row['image_name'];
                                ?>
                                <div class="food-menu-box">
                                        <div class="food-menu-img">
                                        <?php
                                            if($image_name =="")
                                            {
                                                // image not available
                                            echo "<div class='error'>Image not found</div>";
                                            }
                                            else
                                            {
                                                   // image found
                                                   ?>
                                                   <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                                   <?php   
                                            }                                            
                                        ?>     
                                    </div>
                                        <div class="food-menu-desc">
                                            <h4><?php echo $title; ?></h4>
                                            <p class="food-price">Rs.<?php echo $price; ?></p>
                                            <p class="food-detail">
                                                <?php echo $description; ?>
                                            </p>
                                            <br>

                                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                        </div>
                                    </div>
                                <?php
                                
                            }
                        }
                        else
                        {
                            // food not available
                            echo "<div class='error'>Food not found</div>";
                        }
                    ?>
            <div class="clearfix"></div>
        </div>
    </section> 
<!-- fOOD Menu Section Ends Here -->
<?php include('partials-front/footer.php'); ?>
</body>
</html>