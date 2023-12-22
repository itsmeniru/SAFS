<?php
              $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

              
              if($actual_link){
                ?>
                    <style>
                nav{
                  background:#ff9800 !important;
                }
                </style>
<?php 
}
?>
<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'includes/loginlink.php' ;?>
    <title>Admin Login | SAFS</title>
</head>
<body>
    <?php
    if(isset($_SESSION['fname'])){
        header("location:index.php");
    }else{ ?>
<?php include 'includes/loginnavigation.php';?>
<?php include 'includes/loginformbody.php';?>


<?php }?>
</body>
</html>