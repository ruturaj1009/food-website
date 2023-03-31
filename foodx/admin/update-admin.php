<?php include('partials/menu.php'); ?>
<div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>
            <br>
            <br>

<?php
    $id=$_GET['id'];
    $sql="SELECT * FROM x_admin WHERE id=$id";
    $res=mysqli_query($conn, $sql);
    
    if($res==true){
        $count=mysqli_num_rows($res);
        if($count==1){
            $msg = "<div class='suck2'>USER FOUND</div>";
            $row=mysqli_fetch_assoc($res);
            $full=$row['full_name'];
            $user=$row['username'];
            $pass=$row['password'];
        }
        else{
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

?>


            <form action="" method="POST">
                <table class="tbl-30">
                <?php echo $msg ?>
                    <tr>
                        <td>Update Name: </td>
                        <td><input type="text" name="full_name" value="<?php echo $full; ?>"></td>
                    </tr>
                    <tr>
                        <td>Update Username: </td>
                        <td><input type="text" name="username" value="<?php echo $user; ?>"></td>
                    </tr>
                    <br>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id;?>" >
                            <input type="submit" name="submit" value="Update Admin" class="btn-primary">
                        </td>
                    </tr>
                </table>
            </form>
            <br>
        </div>
    </div>
<?php

if(isset($_POST['submit'])){
   $full_name=$_POST['full_name'];
   $username=$_POST['username'];

   $sql="UPDATE x_admin SET 
   full_name='$full_name',
   username='$username'
   WHERE x_admin.id=$id
   ";

    $res=mysqli_query($conn,$sql);
    if($res==true){
        $_SESSION['update']="<div class='suck'>Admin updated successfully</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        $_SESSION['update']="<div class='suck1'>Admin not updated</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
}






?>
<?php include('partials/footer.php') ?>

