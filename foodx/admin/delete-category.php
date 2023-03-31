<?php
    include('../config/connection.php'); 
    if(isset($_GET['id']) && isset($_GET['image_name'])){
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];
        if($image_name!=""){
            $path="../images/category/".$image_name;
            $remove=unlink($path);
            if($remove==false){
                $_SESSION['rmverr']="<div class='suck1'>Failed to remove image from category folder.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
            }
        }

        $sql="DELETE FROM x_category WHERE id=$id AND image_name='$image_name'";
        $res=mysqli_query($conn,$sql);
        if($res==true){
            $_SESSION['dltcat']="<div class='suck'>Category deleted successfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else{
            $_SESSION['dltcat']="<div class='suck1'>Failed to delete Category.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else{
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>