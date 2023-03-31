<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        <?php 
            if(isset($_GET['id']) && isset($_GET['image_name'])){
                $id = $_GET['id'];
                $img=$_GET['image_name'];
                $sql = "SELECT * FROM x_food WHERE id=$id AND image_name='$img'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count==1){
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $description=$row['description'];
                    $price=$row['price'];
                    $old_image = $row['image_name'];
                    $old_category_id = $row['category_id'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else{
                    $_SESSION['no-food-found'] = "<div class='suck1'>Food not Found.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

            }
            else{
                header('location:'.SITEURL.'admin/manage-food.php');
            }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td><textarea cols="30" rows="5" name="description" ><?php echo $description; ?></textarea></td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>" ></td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($old_image != ""){
                    
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $old_image; ?>" width="200px">
                                <?php
                            }
                            else{
                                echo "<div class='error'>Image Not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                    <input type="file" name="image" accept="image/*">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <Select name="category">
                        <?php 
                                
                                $sql4 = "SELECT * FROM x_category WHERE active='Yes'";
                                $res4 = mysqli_query($conn, $sql4);
                                $count4 = mysqli_num_rows($res4);

                                if($count4>0){

                                    while($row4=mysqli_fetch_assoc($res4)){
                                        
                                        $category_id = $row4['id'];
                                        $category_title = $row4['title'];
                                        ?>

                                        <option <?php if($old_category_id==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                                        <?php
                                    }
                                }
                                else{

                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            

                            ?>
                        

                        </Select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes 

                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes 

                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="old_image" value="<?php echo $old_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php 
        
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description=$_POST['description'];
                $price=$_POST['price'];
                $old_image = $_POST['old_image'];
                $category=$_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];


                if(isset($_FILES['image']['name'])){
                    $image_name = $_FILES['image']['name'];


                    if($image_name != ""){
                        $ten=explode('.', $image_name);
                        $ext = end($ten);
                        $image_name = "food_".rand(000, 999).'.'.$ext;
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/food/".$image_name;

                        $upload = move_uploaded_file($source_path, $destination_path);

                        if($upload==false){
                            $_SESSION['upload-food'] = "<div class='suck1'>Failed to Upload Image. </div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                            die();
                        }

                        if($old_image!="")
                        {
                            $remove_path = "../images/food/".$old_image;
                            $remove = unlink($remove_path);

                            if($remove==false){
                                $_SESSION['failed-remove'] = "<div class='suck1'>Failed to remove current Image.</div>";
                                header('location:'.SITEURL.'admin/manage-food.php');
                                die();
                            }
                        }   

                    }

                    else{
                        $image_name = $old_image;
                    }
                }

                else{
                    $image_name = $old_image;
                }

                $sql5 = "UPDATE x_food SET 
                    title = '$title',
                    description = '$description',
                    price = '$price',
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active' 
                    WHERE id=$id
                ";

                $res5 = mysqli_query($conn, $sql5);

                if($res5==true){
                    $_SESSION['update-food'] = "<div class='suck'>Food Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else{
                    $_SESSION['update-food'] = "<div class='suck1'>Failed to Update Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>