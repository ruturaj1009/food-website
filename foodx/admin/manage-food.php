
<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br>
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br><br>
        <?php
            if(isset($_SESSION['add-food'])){
                echo $_SESSION['add-food'];
                unset($_SESSION['add-food']);
            }
            if(isset($_SESSION['delete-food'])){
                echo $_SESSION['delete-food'];
                unset($_SESSION['delete-food']);
            }
            if(isset($_SESSION['no-food-found'])){
                echo $_SESSION['no-food-found'];
                unset($_SESSION['no-food-found']);
            }
            if(isset($_SESSION['update-food'])){
                echo $_SESSION['update-food'];
                unset($_SESSION['update-food']);
            }
            if(isset($_SESSION['upload-food'])){
                echo $_SESSION['upload-food'];
                unset($_SESSION['upload-food']);
            }
            if(isset($_SESSION['failed-remove'])){
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
            
        ?>
        <br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Price</th>
                <th>Feature</th>
                <th>Active</th>
                <th>Action</th>
            </tr>

            <?php
                $sql="SELECT * FROM x_food";
                $res=mysqli_query($conn,$sql) or die('Error :');
                if($res==true){
                    $count=mysqli_num_rows($res);
                    $sn=1;
                    if($count>0){
                        while($rows=mysqli_fetch_assoc($res)){
                            $id=$rows['id'];
                            $title=$rows['title'];
                            $image_name=$rows['image_name'];
                            $price=$rows['price'];
                            $feature=$rows['featured'];
                            $active=$rows['active'];
                        ?>

                            <tr>
                                <td><?php echo $sn++; ?>.</td>
                                <td><?php echo $title; ?></td>
                                <td>
                                    <?php 
                                        if($image_name!=""){
                                            ?>

                                            <img src="<?php echo SITEURL.'images/food/'.$image_name; ?>" width="100px" >

                                            <?php
                                        }
                                        else{
                                             echo "<div class='suck1'>Image not uploaded</div>"; 
                                        }
                                    ?>
                                </td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $feature; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>

                                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update Food</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                                </td>
                            </tr>
                            <?php


                        }
                    }
                    else{
                        echo "food not added";
                    }
                }
                


            ?>
        </table>

    </div>
</div>


<?php include('partials/footer.php') ?>