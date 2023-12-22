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
?>
<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "safs";

$conn = mysqli_connect($server, $username, $password, $database);

if(!$conn){
    die("<script>alert('failed')</script>");
}

if (isset($_POST['action'])){
    $batch = $_POST['batch'];
     $date = date('y-m-d');
     $sql = "SELECT * FROM batch WHERE batch='$batch'";
     $res = mysqli_query($conn, $sql);
     if(mysqli_num_rows($res) > 0){ ?>
      <script>
                alert("Duplicated data found");
                window.location.href="http://localhost/safs/admin/batch.php";
                </script>
     <?php
  	  	
  	}else{
           $query = "INSERT INTO batch (batch) VALUES ('$batch')";
           $results = mysqli_query($conn, $query);
           if($results){
            ?>
            <script>
                alert("Batch added sucessfully");
                window.location.href="http://localhost/safs/admin/batch.php";
                </script>
    
                <?php
        }
           exit();
  	}
  }


if (isset($_POST['save'])){
    $sub = strtoupper($_POST['subject']);
     $date = date('y-m-d');
     $sql = "SELECT * FROM subjectlist WHERE subject='$sub'";
     $res = mysqli_query($conn, $sql);
     if(mysqli_num_rows($res) > 0){ ?>
      <script>
                alert("Duplicated data found");
                window.location.href="http://localhost/safs/admin/batch.php";
                </script>
     <?php
  	  	
  	}else{
           $query = "INSERT INTO subjectlist (subject) VALUES ('$sub')";
           $results = mysqli_query($conn, $query);
           if($results){
            ?>
            <script>
                alert("Subject added sucessfully");
                window.location.href="http://localhost/safs/admin/batch.php";
                </script>
    
                <?php
        }
           exit();
  	}
  }


  if (isset($_POST['save_faculty'])){
    $fac = strtoupper($_POST['faculty']);
     $date = date('y-m-d');
     $sql = "SELECT * FROM facultylist WHERE faculty='$fac'";
     $res = mysqli_query($conn, $sql);
     if(mysqli_num_rows($res) > 0){ ?>
      <script>
                alert("Duplicated faculty found");
                window.location.href="http://localhost/safs/admin/batch.php";
                </script>
     <?php
  	  	
  	}else{
           $query = "INSERT INTO facultylist (faculty) VALUES ('$fac')";
           $results = mysqli_query($conn, $query);
           if($results){
            
           echo '<script>
  setTimeout(function(){
    history.back();
  }, 100); // 2000 milliseconds = 2 seconds
</script>';
    
            
        }
           exit();
  	}
  }


?>







<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Batch</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <?php  include 'includes/link.php';?>
    </head>
    <script>
function validateForm() {
  
  let c = document.forms["myForms"]["batch"].value;
  if (c == "") {
    alert("please select batch:");
    return false;
  }


}
function validateForms() {
  
  let a = document.forms["form"]["subject"].value;
  if (a == "") {
    alert("please add subject:");
    return false;
  }


}
function validateFormss() {
  
  let z = document.forms["mform"]["faculty"].value;
  if (z == "") {
    alert("please add faculty:");
    return false;
  }


}
</script>
    <body>
    <?php  include 'includes/navigation.php' ?>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
      
<div class="row">
    <div class="container">
        <p><a href="/safs/admin">Dashboard</a>> Student Record:</p>
        <hr>
        <div class="col s12 m5 l5">
            <div class="card">  
                <form name="myForms"action="#safs login form"  onsubmit="return validateForm()"  method="POST">
                <div class="col s12">
                    <blockquote><h5 class="login-headtext">ADD Batch</h5></blockquote>
                     
                    <div class="col s12 m12 l12">
                        <div class="input-field">
                            <i class="material-icons prefix">av_timer</i>
                                <select class="validate" name="batch" class="validation">
                                    <option value="" disabled selected>select</option>
                                        <?php
                                            // Get the current year
                                            $currentYear = date('Y');
                                            // Loop through the past 10 years
                                            for ($i = $currentYear - 8; $i <= $currentYear; $i++) {
                                            echo "<option value=\"$i\">$i</option>";
                                                                                                    }
                                        ?>
                                </select>
                                    <label>Select Batch</label>
                        </div>
                    </div>
                </div>
                <button class="btn waves-effect orange" type="submit" name="action">Add Batch</button>
                </form>
            </div>
        </div>
    
        <div class="col s12 m7 l7">
          <h6 class="batch-history">Batch History:</h6>
                <?php
                $selectquery = " select * from batch ORDER BY batch ASC";
                $query = mysqli_query($conn,$selectquery);
                    $num = mysqli_num_rows($query);
                if ($num == 0) {
                 echo 'You dont have any batch available now !';
                     }
                    while($res = mysqli_fetch_array($query)){
                        ?>
                    
                    <span class="batch"> <i class="tiny material-icons">av_timer</i><?php echo $res['batch'];?></span>
                    <?php
                    }
                    ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="container">
        <div class="col s12 m5 l5">
                    <div class="card">
                    <form name="form"action="#safs add subject"  onsubmit="return validateForms()"  method="POST">
                        <div class="col s12">
                        <blockquote><h5 class="login-headtext">ADD Subject</h5></blockquote>
                     
                    <div class="col s12 m12 l12">
                        <div class="input-field">
                            <i class="material-icons prefix">layers</i>
                               <input type="text" name="subject" class="validation">
                                    <label>Add Subject</label>
                        </div>
                    </div>
                </div>
                <button class="btn waves-effect orange" type="submit" name="save">Add Subject</button>
                </form>
                    </div>
        </div>
        <div class="col s12 m7 l7">
        <h6 class="batch-history">Subject List:</h6>
                <?php
                $selectquerys = " select * from subjectlist";
                $querys = mysqli_query($conn,$selectquerys);
                    $nums = mysqli_num_rows($querys);
                if ($nums == 0) {
                 echo 'Subject not available';
                     }
                    while($res = mysqli_fetch_array($querys)){
                        ?>
                        <tr>
                            <td>
                            <span class="subject"><i class="tiny material-icons">layers</i><?php echo $res['subject'];?></span>
                  
                            </td>
                        </tr>                 
                   <?php
                    }
                    ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="container">
        <div class="col s12 m5 l5">
                    <div class="card">
                    <form name="mform"action="#safs add faculty"  onsubmit="return validateFormss()"  method="POST">
                        <div class="col s12">
                        <blockquote><h5 class="login-headtext">Add Faculty</h5></blockquote>
                     
                    <div class="col s12 m12 l12">
                        <div class="input-field">
                            <i class="material-icons prefix">layers</i>
                               <input type="text" name="faculty" class="validation">
                                    <label>Add Faculty</label>
                        </div>
                    </div>
                </div>
                <button class="btn waves-effect orange" type="submit" name="save_faculty">Add Faculty</button>
                </form>
                    </div>
        </div>
        <div class="col s12 m7 l7">
        <h6 class="batch-history">Faculty:</h6>
                <?php
                $selectquerys = " select * from facultylist";
                $querys = mysqli_query($conn,$selectquerys);
                    $nums = mysqli_num_rows($querys);
                if ($nums == 0) {
                 echo 'Faculty not available';
                     }
                    while($res = mysqli_fetch_array($querys)){
                        ?>
                        <tr>
                            <td>
                            <span class="subject"><i class="tiny material-icons">school</i><?php echo $res['faculty'];?></span>
                  
                            </td>
                        </tr>                 
                   <?php
                    }
                    ?>
        </div>
    </div>
</div>






<style>
     span.subject{
    
    padding:1px;
    font-weight:bold;
    background:#ffc166;
    
}
span.batch{

    background-color: #ff980099;
    padding: 5px;
    font-weight: bold;
    box-shadow: 1px 2px #a09191;
    
}
    .batch-history{
    background: #e1e1e1;
    padding:10px;
    text-align:center;
    
    
    
}
</style>
<script>
    
    $(document).ready(function(){
    $('select').formSelect();
  });
</script       
        <script src="" async defer></script>
       
    </body>
</html>