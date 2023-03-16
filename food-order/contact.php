<?php include('partials-front/menu.php'); 
if(isset($_SESSION['contact']))
    {
        echo $_SESSION['contact'];
        unset($_SESSION['contact']);
    }
?>
<doctype html>
    <html>
        <head>
            <title>contact form</title>
        </head>
        <body>
<!-- Contact section starts here -->
            <div class="container div-order">
               
                <form action="" method="POST" class="order">
                    <fieldset>
                        <legend class="legend-contact">Contact Details:</legend>
                        <div class="order-label">Full Name:</div>
                        <input type="text" name="fullname" placeholder="your name..." class="input-responsive-contact" required>

                        <div class="order-label">Phone Number:</div>
                        <input type="tel" name="phonenumber" placeholder="+977 98xxxxxxx" class="input-responsive-contact" required>

                        <div class="order-label">Email:</div>
                        <input type="email" name="email" placeholder=".....@gmail.com" class="input-responsive-contact" required>

                        <div class="order-label">Address:</div>
                        <textarea name="address" rows="3" placeholder="city, town, village" class="input-responsive-contact"></textarea>

                        <div class="order-label">Feedback:</div>
                        <textarea name="feedback" rows="8" placeholder="Customer Opinion.." class="input-responsive-contact" required></textarea>
                        
  

                        <input type="submit" name="submit" value="Click here" class="btn btn-primary btn-contact" >

                    </fieldset>
                </form>
            </div>
<!-- Contact section ends here -->
        </body>
</html>

<?php include('partials-front/footer.php'); ?>

<?php
// check whether submit button clicked or not
if(isset($_POST['submit']))
{
    //echo "You clicked the button";
    // get the value from form
    $fullname = $_POST['fullname'];
    $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $feedback = $_POST['feedback'];
    // save the data into the database
    // create SQL to save the data
    $sql = "INSERT INTO tbl_contact SET
    fullname = '$fullname',
    phonenumber = '$phonenumber',
    email = '$email',
    address = '$address',
    feedback = '$feedback'
    ";

    //execute the query
    $result = mysqli_query($conn, $sql);
    //check whether the query is executed or not
    if ($result)
    {
        $_SESSION['contact'] = "<div class='success'>Thank you for your kind suggestion..</div>";
        //redirect with js code
        ?>
        <script>
            window.location.href="http://localhost/food-order/contact.php";
        </Script>
        <?php
    }
   // $_SESSION['contact'] = ($result==true) ? "<div class='success text-center'>Thank You for your kind suggesstions...</div>" : "<div class='error'>Failed to connect</div>";

}


?>