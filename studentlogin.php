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
    <title>Login | SAFS</title>
</head>
<body>
    <?php
    if(isset($_SESSION['sfname'])){
        header("location:index.php");
    }else{ ?>
<?php include 'includes/studentloginnavigation.php';?>
<?php include 'includes/studentloginformbody.php';?>


<?php }?>
</body>
</html>