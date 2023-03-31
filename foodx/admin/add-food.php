<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php
             if(isset($_SESSION['add-food'])){
                echo $_SESSION['add-food'];
                unset($_SESSION['add-food']);
            }
            
        ?>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Enter food's title " ></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea cols="30" rows="5" name="description" placeholder="Enter food's description"></textarea></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price" placeholder="Enter food's price " ></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image" accept="image/*"></td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <Select name="category">
                        <?php 
                                
                                $sql = "SELECT * FROM x_category WHERE active='Yes'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);

                                if($count>0){

                                    while($row=mysqli_fetch_assoc($res)){
                                        
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

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
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No 
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add   Food" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit'])){
        $title=$_POST['title'];
        $description=$_POST['description'];
        $price=$_POST['price'];
        $category=$_POST['category'];
        if(isset($_POST['featured'])){
            $featured = $_POST['featured'];
        }
        else{
            $featured = "No";
        }

        if(isset($_POST['active'])){
            $active = $_POST['active'];
        }
        else{
            $active = "No";
        }


        if(isset($_FILES['image']['name'])){
            $image_name=$_FILES['image']['name'];
            if($image_name!=""){

                $ten=explode(".",$image_name);
                $ext=end($ten);
                $image_name="food_".rand(000,999).".".$ext;
                $source_path=$_FILES['image']['tmp_name'];
                $destination_path="../images/food/".$image_name;

                $upload=move_uploaded_file($source_path,$destination_path);
                if($upload==false){
                    $_SESSION['uplderr']="failed to upload image";
                    die();
                }
            }
            else{
                $image_name="";
            }
        }
        else{
            $image_name="";
        }


        $sql4="INSERT INTO x_food SET
            title='$title',
            description='$description',
            price=$price,
            image_name='$image_name',
            category_id=$category,
            featured='$featured',
            active='$active'
            ";
        $res4=mysqli_query($conn,$sql4);
        if($res4==true){
            $_SESSION['add-food']="food added successfully";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else{
            $_SESSION['add-food']="food not added successfully";
            header('location:'.SITEURL.'admin/add-food.php');
        }
    }

?>




<?php include('partials/footer.php') ?>