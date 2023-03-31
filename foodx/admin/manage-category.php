<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper" style="width:90%">
        <h1>Manage Category</h1>
        <br>
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br><br>
        <?php
             if(isset($_SESSION['no-category-found'])){
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }
             if(isset($_SESSION['add-category'])){
                echo $_SESSION['add-category'];
                unset($_SESSION['add-category']);
            }
             if(isset($_SESSION['failed-remove'])){
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
             if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
             if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            
        ?>
        <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Feature</th>
                <th>Active</th>
                <th>Action</th>
            </tr>

            <?php
                $sql="SELECT * FROM x_category";
                $res=mysqli_query($conn,$sql) or die('Error :');
                if($res==true){
                    $count=mysqli_num_rows($res);
                    $sn=1;
                    if($count>0){
                        while($rows=mysqli_fetch_assoc($res)){
                            $id=$rows['id'];
                            $title=$rows['title'];
                            $image_name=$rows['image_name'];
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

                                            <img src="<?php echo SITEURL.'images/category/'.$image_name; ?>" width="100px" >

                                            <?php
                                        }
                                        else{
                                             echo "<div class='suck1'>Image not uploaded</div>"; 
                                        }
                                    ?>
                                </td>
                                <td><?php echo $feature; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>

                                    <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update category</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                                </td>
                            </tr>
                            <?php


                        }
                    }
                }
                


            ?>
        </table>
    </div>
</div>


<?php include('partials/footer.php'); ?>