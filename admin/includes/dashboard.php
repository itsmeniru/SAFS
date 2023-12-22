<?php
if(isset($_SESSION['fname'])){
include 'config.php';
    $selectquery = " select * from student";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query);
      
?>
<div class="container">

    <div id="dashboard">
        <h5 class="highlight">Dashboard <span class="id"> <?php echo $_SESSION['fname'];?></span></h5>
        


        <div class="row">
    <div class="col s12 m4">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title"> <i class="material-icons">person</i> Total Students  <?php echo $num; ?></span>
        
        <div class="card-action">
          
          <a href="http://localhost/safs/admin/student.php">View Student</a>
        </div>
      </div>
    </div>
  </div>

   <div class="row">
    <div class="col s12 m4">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
        <?php 
           $selectquery = " select * from teacher";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query);
          ?>
          <span class="card-title"><i class="material-icons">person</i> Total teachers <?php echo $num;?></span>
        
        <div class="card-action">
          
          <a href="http://localhost/safs/admin/teacher.php">View Teacher</a>
        </div>
      </div>
    </div>
  </div>




  <div class="row">
    <div class="col s12 m4">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
        <?php 
           $selectquery = " select * from assignment";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query); ?>
          <span class="card-title"><i class="material-icons">person</i>Assignments <?php echo $num;?></span>
       
        <div class="card-action">
          
          <a href="http://localhost/safs/admin/assignment.php">View Assignment</a>
        </div>
      </div>
    </div>
  </div>

  
  <div class="row">
    <div class="col s12 m4">
      <div class="card blue-grey darken-1">
      <?php 
           $selectquery = " select * from assignmentsubmit";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query);
        ?>
        <div class="card-content white-text">
          <span class="card-title">Submitted Assignments <?php   echo $num;?></span>
         <div class="number">
         
        </div>
        <div class="card-action">
          
          <a href="http://localhost/safs/admin/submittedassignment.php">View Assignment</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col s12 m4">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
       
          <span class="card-title">Batch,Subject and faculty </span>
         <div class="number">
         
        </div>
        <div class="card-action">
          
          <a href="http://localhost/safs/admin/batch.php">View</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col s12 m4">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title"><i class="material-icons">link</i> Teacher Access</span>
         <div class="number">
         <?php 
           $selectquery = " select * from access";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query);
          ?>
        </div>
        <div class="card-action">
          
          <a href="http://localhost/safs/admin/teacher_access.php">Access to teacher</a>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col s12 m4">
      <div class="card blue-grey darken-1">
      <?php 
           $selectquery = " select * from contact_form";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query);
        ?>
        <div class="card-content white-text">
       
          <span class="card-title">Messages <?php echo $num;?> </span>
         <div class="number">
         
        </div>
        <div class="card-action">
          
          <a href="http://localhost/safs/admin/message.php">View</a>
        </div>
      </div>
    </div>
  </div>





    </div>

</div>
<?php 
}
?>
 