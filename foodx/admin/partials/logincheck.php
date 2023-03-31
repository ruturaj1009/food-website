<?php
    if(!isset($_SESSION['user'])){
        $_SESSION['loginerror']="<div class='suck1 text-center'>Please login to continue.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
?>