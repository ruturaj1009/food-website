<?php
    include('../config/connection.php'); 

    if(isset($_GET['id']) && isset($_GET['image_name'])){

        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        if($image_name!=""){
            $path="../images/food/".$image_name;
            $remove=unlink($path);
            if($remove==false){
                $_SESSION['remove-food']="<div class='suck1'>Failed to remove image from Food folder.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }
        }

        $sql="DELETE FROM x_food WHERE id=$id AND image_name='$image_name'";
        $res=mysqli_query($conn,$sql);
        if($res==true){
            $_SESSION['delete-food']="<div class='suck'>Food deleted successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else{
            $_SESSION['delete-food']="<div class='suck1'>Failed to delete Food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }
    else{
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>