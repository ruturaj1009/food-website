
<?php include('partials/menu.php'); ?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <br><br>
        <?php
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
        }
        ?>
        <br><br>
        <div class="col-4 text-center">
            <?php
                $sql="SELECT * FROM x_category";
                $res=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res);
            ?>
            <h1><?php echo $count;?></h1>
            <br />
            Total Categories
        </div>

        <div class="col-4 text-center">
            <?php
                $sql2="SELECT * FROM x_food";
                $res2=mysqli_query($conn,$sql2);
                $count2=mysqli_num_rows($res2);
            ?>
            <h1><?php echo $count2;?></h1>
            <br />
            Total Foods
        </div>

        <div class="col-4 text-center">
            <?php
                $sql3="SELECT * FROM x_order";
                $res3=mysqli_query($conn,$sql3);
                $count3=mysqli_num_rows($res3);
            ?>
            <h1><?php echo $count3;?></h1>
            <br />
            Total Orders
        </div>

        <div class="col-4 text-center">
            <?php
                $sql4="SELECT SUM(total) AS Total FROM x_order";
                $res4=mysqli_query($conn,$sql4);
                $row=mysqli_fetch_assoc($res4);
                $total=$row['Total'];
            ?>
            <h1>₹ <?php echo $total;?></h1>
            <br />
            Total Sales
        </div>

        <div class="clearfix"></div>

    </div>
   
</div>
<!-- Main Content Setion Ends -->

<?php include('partials/footer.php') ?>