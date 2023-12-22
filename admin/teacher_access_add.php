<?php 
session_start();
if(!isset($_SESSION['fname'])){
	echo"<script>window.open('login.php?you must login first','_self')</script>";
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Student | Safs</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <?php  include 'includes/link.php';?>
    </head>
    <body>
    <?php  include 'includes/navigation.php';?>
    <div class="container">
    <p><a href="/safs/admin">Dashboard</a>> <a href="http://localhost/safs/admin/teacher_access.php">Permission</a>> Give Access to teachers:</p><hr>
    
    <?php include 'includes/access.php' ;?>
    <?php include 'includes/access_sub.php' ?>
    <?php include 'includes/access_faculty.php' ?>
    </div>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <script src="" async defer></script>
    </body>
</html>