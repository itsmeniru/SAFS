<!DOCTYPE html>
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
if(!isset($_SESSION['fname'])){
	echo"<script>window.open('login.php?you must login first','_self')</script>";
}
else{

?>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
 
  <title>Dashboard</title>

  <?php  include 'includes/link.php';?>
</head>
<body>
  
    <?php  include 'includes/navigation.php' ?>
    <?php  include 'includes/dashboard.php' ?>
  


  


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
  <script>
    $(document).ready(function(){
    $('select').formSelect();
    
  });
  
    </script>
</html>
<?php } ?>