<?php include('partials/menu.php') ?>
<!--Main content section starts here -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashbord</h1>
                <br><br>
                <?php 
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
       /* if(isset($_SESSION['user']))
        {
                    echo $_SESSION['user'];
                    unset($_SESSION['user']);
        }*/
        ?>
        <br><br>
        <div class="col-4 text-center">
                        <?php
                        $sql = "SELECT * FROM tbl_category";
                        //execute query
                        $res = mysqli_query($conn, $sql);
                        // count rows
                        $count = mysqli_num_rows($res);
                        ?>
                        <h1><?php echo $count; ?></h1>
                        <br>
                        Categories
                    </div>
                    <div class="col-4 text-center">
                        <?php
                        $sql2 = "SELECT * FROM tbl_food";
                        //execute the query
                        $res2 = mysqli_query($conn, $sql2);
                        // count rows
                        $count2 = mysqli_num_rows($res2);
                        ?>
                        <h1><?php echo ($count2); ?></h1>
                        <br>
                        Foods
                    </div>
                    <div class="col-4 text-center">
                        <?php
                        $sql3 = "SELECT * FROM tbl_order";
                        //execute the query
                        $res3 = mysqli_query($conn, $sql3);
                        // count rows
                        $count3 = mysqli_num_rows($res3);
                         ?>
                        <h1><?php echo ($count3); ?></h1>
                        <br>
                        Total Ordered
                    </div>
                    <div class="col-4 text-center">
                    <?php
                        // create sql query to get total revenue generated
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='delivered'";
                        //execute the query
                        $res4 = mysqli_query($conn, $sql4);
                        // get the value
                        $row4 = mysqli_fetch_array($res4);
                        // get the total revenue
                        $total_revenue = $row4['Total'];
                    ?>
                        <h1>Rs.<?php echo $total_revenue; ?></h1>
                        <br>
                        Revenu Generated
                    </div>
                    <div class="clearfix"></div>
            </div>
        </div>
<!--Main content section ends here -->
<?php include('partials/footer.php') ?>