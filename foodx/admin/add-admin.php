<?php 

include('partials/menu.php'); 


?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br>
        <br>
        <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>
        <br><br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter your Name" ></td>
                </tr>
                <tr>
                    <td>User Name: </td>
                    <td><input type="text" name="username" placeholder="Enter your Name" ></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter your Password" ></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>


<?php

 if(isset($_POST['submit'])){
     $full_name=$_POST['full_name'];
     $username=$_POST['username'];
     $password=md5($_POST['password']);
     $err="eroor occured";

    // inserting data into table
     $sql = " INSERT INTO x_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
         ";

    

    // query push
    $res=mysqli_query($conn,$sql) or die(" ERROR: ") ;

    if($res==true){
        $_SESSION['add']="<div class='suck'> Admin added successfully </div>";
        header('location:manage-admin.php');
    }
    else{
        $_SESSION['add']="<div class='suck1'>Admin added Failed!</div>";
        header('location:add-admin.php');
    }

 }
 

?>