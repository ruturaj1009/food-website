<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>
        <?php 
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $sql = "SELECT * FROM x_order WHERE id=$id ";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count==1){
                    $row = mysqli_fetch_assoc($res);
                    $food = $row['food'];
                    $price=$row['price'];
                    $qty=$row['qty'];
                    $c_name = $row['c_name'];
                    $c_email = $row['c_email'];
                    $c_contact = $row['c_contact'];
                    $c_address = $row['c_address'];
                    $status = $row['status'];
                }
                else{
                    $_SESSION['no-order-found'] = "<div class='suck1'>Order not Found.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }

            }
            else{
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Food Name: </td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td><b>₹ <?php echo $price; ?></b></td>
                </tr>

                <tr>
                    <td>Quantity: </td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>" ></td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <Select name="status">
                        <option <?php if($status=="Ordered"){echo 'selected';} ?> >Ordered</option>
                        <option <?php if($status=="Ondelivery"){echo 'selected';} ?>>Ondelivery</option>
                        <option <?php if($status=="Delivered"){echo 'selected';} ?>>Delivered</option>
                        <option <?php if($status=="Cancelled"){echo 'selected';} ?> >Cancelled</option>
                        </Select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name: </td>
                    <td><input type="text" name="name" value="<?php echo $c_name; ?>" ></td>
                </tr>

                <tr>
                    <td>Customer Contact: </td>
                    <td><input type="text" name="contact" value="<?php echo $c_contact; ?>" ></td>
                </tr>

                <tr>
                    <td>Customer Email: </td>
                    <td><input type="text" name="email" value="<?php echo $c_email; ?>" ></td>
                </tr>

                <tr>
                    <td>Customer Address: </td>
                    <td><textarea cols="30" rows="5" name="address" ><?php echo $c_address; ?></textarea></td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php 
        
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty=$_POST['qty'];
                $total=$price *$qty;
                $c_name = $_POST['name'];
                $c_email = $_POST['email'];
                $c_contact = $_POST['contact'];
                $c_address = $_POST['address'];
                $status = $_POST['status'];


                

                $sql5 = "UPDATE x_order SET 
                    qty = '$qty',
                    total = '$total',
                    status = '$status',
                    c_name = '$c_name',
                    c_contact = '$c_contact',
                    c_email = '$c_email',
                    c_address = '$c_address' 
                    WHERE id=$id
                ";

                $res5 = mysqli_query($conn, $sql5);

                if($res5==true){
                    $_SESSION['update-order'] = "<div class='suck'>Order Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else{
                    $_SESSION['update-order'] = "<div class='suck1lo'>Failed to Update Order.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }

            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>