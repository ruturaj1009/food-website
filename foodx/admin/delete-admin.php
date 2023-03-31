<?php include('../config/connection.php'); ?>


<?php
 $id=$_GET['id'];
 $sql = "DELETE FROM x_admin WHERE id=$id";

 $res=mysqli_query($conn,$sql);
 if($res==true){
    echo $_SESSION['delete']="<div class='suck'>Admin deleted successfully</div>";
    header('location:manage-admin.php');
 }
 else{
    echo $_SESSION['delete']="<div class='suck1'>Admin deleted Failed!</div>";
    header('location:manage-admin.php');
 }

?>