
<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br><br>
        <?php
            if(isset($_SESSION['update-order'])){
                echo $_SESSION['update-order'];
                unset($_SESSION['update-order']);
            }
        ?>
        <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Date</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php
                $sql="SELECT * FROM x_order";
                $res=mysqli_query($conn,$sql) or die('Error :');
                if($res==true){
                    $count=mysqli_num_rows($res);
                    $sn=1;
                    if($count>0){
                        while($rows=mysqli_fetch_assoc($res)){
                            $id=$rows['id'];
                            $food=$rows['food'];
                            $price=$rows['price'];
                            $qty=$rows['qty'];
                            $total=$rows['total'];
                            $order_date=$rows['order_date'];
                            $status=$rows['status'];
                            $name=$rows['c_name'];
                            $contact=$rows['c_contact'];
                            $email=$rows['c_email'];
                            $address=$rows['c_address'];

                        ?>

                            <tr>
                                <td><?php echo $sn++; ?>.</td>
                                <td><?php echo $food; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo $total; ?></td>
                                <td><?php echo $order_date; ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $contact; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $address; ?></td>
                                <td>
                                    <?php 
                                        if($status=='Ordered'){
                                            echo "<label style='color:black;'><b>$status</b></label>";
                                        }
                                        if($status=='Ondelivery'){
                                            echo "<label style='color:orange;'><b>$status</b></label>";
                                        } 
                                        if($status=='Delivered'){
                                            echo "<label style='color:green;'><b>$status</b></label>";
                                        } 
                                        if($status=='Cancelled'){
                                            echo "<label style='color:red;'><b>$status</b></label>";
                                        } 
                                    ?>
                                </td>
                                <td>

                                    <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                </td>
                            </tr>
                            <?php


                        }
                    }
                }
                


            ?>
        </table>
</div>

<?php include('partials/footer.php') ?>