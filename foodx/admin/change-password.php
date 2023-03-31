<?php include('partials/menu.php') ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br>
    <?php
        if(isset($_GET['id'])){
        $id=$_GET['id'];
        }
    ?>


    
    <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Old Password: </td>
                        <td><input type="password" name="old_pass" placeholder="Enter Old password" required></td>
                    </tr>
                    <tr>
                        <td>New Password: </td>
                        <td><input type="password" name="new_pass" placeholder="Enter new password" required></td>
                    </tr>
                    <tr>
                        <td>Confirm Password: </td>
                        <td><input type="password" name="confirm_pass" placeholder="Confirm new password" required></td>
                    </tr>
                    <br>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id;?>" >
                            <input type="submit" name="submit" value="Update Password" class="btn-primary">
                        </td>
                    </tr>
                </table>
            </form>
</div>

<?php
    if(isset($_POST['submit']))
    {
         $id=$_POST['id'];
         $old_pass = md5($_POST['old_pass']);
         $new_pass = md5($_POST['new_pass']);
         $confirm_pass = md5($_POST['confirm_pass']);
         
         $sql="SELECT * FROM x_admin WHERE id=$id AND password='$old_pass' ";
         $res=mysqli_query($conn,$sql);

         if($res==true)
         {
             $count=mysqli_num_rows($res);
             if($count==1){

                if($new_pass!=$confirm_pass)
                    {
                    echo "<div class='suck1'>New Password and current password not matched</div>";
                    }
                else
                    {
                    $sql1="UPDATE x_admin SET
                    password='$new_pass' ";
                    $res1=mysqli_query($conn,$sql1);
                    if($res1==true)
                        {
                        $_SESSION['cngpass']="<div class='suck2'>PASSWORD CHANGED SUCCESSFULLY</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    else
                        {
                        $_SESSION['cngpass']="<div class='suck1'>FAILED TO CHANGE PASSWORD</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    }
                    // echo "user found";
             }
             else{
                 $_SESSION['cngpass']="<div class='suck1'>USER NOT FOUND</div>";
                 header('location:'.SITEURL.'admin/manage-admin.php');
                // echo "user not found";
             }
         }
    }
?>


<?php include('partials/footer.php') ?>