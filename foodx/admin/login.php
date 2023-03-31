<?php
  include("../config/connection.php")

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodX/Login</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
    <h1 class="text-center">Admin Login</h1>
    <?php
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['loginerror'])){
            echo $_SESSION['loginerror'];
            unset($_SESSION['loginerror']);
        }
    ?>
    <form action="" method="POST">
        <div>
        UserName:
        <input type="text" name="username" placeholder="Enter your Username">
        </div>  
        <br>
        <div>
        Password:
        <input type="password" name="password" placeholder="Enter your password">
        </div>
        <br>
        <input type="submit" value="Login" name="submit" class="btn-primary" id="lgbtn">
    </form>
    <h5 class="text-center">All Rights Reserved. Designed with 🖤 by <a href="#">Ruturaj</a></h5>
    </div>
</body>
</html>
<?php
    
    if(isset($_POST['submit'])){
       $username=$_POST['username'];
       $pass=md5($_POST['password']);

       $sql="SELECT * FROM x_admin WHERE username='$username' AND password='$pass' ";
       $res=mysqli_query($conn,$sql);
        $count = mysqli_num_rows($res);
        $name=mysqli_fetch_assoc($res);
        $full_name=$name['full_name'];
        if($count==1){
            $_SESSION['login']="<div class='suck'>Login successfully as $full_name </div>";
            $_SESSION['user']=$username;
            header('location:'.SITEURL.'admin/');
        }
        else{
            $_SESSION['login']="<div class='suck1 text-center'>Username or Password Not Found</div>";
            header('location:'.SITEURL.'admin/login.php');
        }
    }


?>