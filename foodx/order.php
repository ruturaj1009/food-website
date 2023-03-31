<?php 
    include('partials/menu.php'); 
    if(isset($_GET['food_id'])){
        $food_id=$_GET['food_id'];

        $sql="SELECT * FROM x_food WHERE id=$food_id";
        $res=mysqli_query($conn,$sql);
        $count=mysqli_num_rows($res);

        if($count==1){
            $row=mysqli_fetch_assoc($res);
            $title=$row['title'];
            $price=$row['price'];
            $image_name=$row['image_name'];
        }
        else{
            header('location:'.SITEURL);
        }
    }
    else{
        header('location:'.SITEURL);
    }

?>



    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Food Order Cart</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                        if($image_name!=""){
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php
                        }
                        else{
                            echo "<div class='suck1'>image not found</div>";
                        }

                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price"><?php echo'₹'.$price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>
                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



<?php
if(isset($_POST['submit'])){
    $food=$_POST['food'];
    $price=$_POST['price'];
    $qty=$_POST['qty'];
    $total=$price * $qty;
    $order_date=date('y-m-d h:i:sa');
    $c_name=$_POST['full-name'];
    $c_contact=$_POST['contact'];
    $c_email=$_POST['email'];
    $c_address=$_POST['address'];


    $sql3="INSERT INTO x_order SET
           food='$food',
           price=$price,
           qty=$qty,
           total=$total,
           order_date='$order_date',
           status='Ordered',
           c_name='$c_name',
           c_contact='$c_contact',
           c_email='$c_email',
           c_address='$c_address'
           ";
    $res3=mysqli_query($conn,$sql3);
    if($res3==true){
        $_SESSION['order']="<div class='suck2'>Food Ordered Successfully</div>";
        header('location:'.SITEURL);
    }
    else{
        $_SESSION['order']="<div class='suck1'>Food Order Failed</div>";
        header('location:'.SITEURL);
    }

}


?>
<?php include('partials/footer.php'); ?>