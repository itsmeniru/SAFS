<?php
include 'config.php';
?>
<?php
              $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

              
              if($actual_link){
                ?>
                    <style>
                nav{
                  background:#5c564cb5 !important;
                }
                </style>
<?php 
}



?>



<div id="profile-bdy">
  <div class="container" >
    <div class="row">
      <div class="col s12 m5">
                      <?php
                          if (isset($_SESSION['tid'])){
                            $id = $_SESSION['tid'];
                            $selectquery = " select * from teacher where id = $id";
                            $query = mysqli_query($conn,$selectquery);
                            $teacher=mysqli_fetch_array($query);
                            $t_id=$teacher['id'];
                            $tfname=strtoupper($teacher['tfname']);
                            $tlname=strtoupper($teacher['tlname']);
                            $tbio=$teacher['bio'];
                            $rdate=$teacher['registeredate'];
                            $tmail=$teacher['email'];      
                      ?>
                        <?php
                            echo "<h4 class='nametext'>$tfname $tlname</h4>
                                  Email: $tmail
                                  <p class='joined'>Joined On: $rdate </p> ";
                                    if($tbio){
                        ?>   
                              <p class="bio-text"><?php echo $tbio; ?></p>
                                <?php }
                          else{ ?>
                                <p class='bio-text'>No bio Yet</p>
                          <?php }
                          ?>
                              <a class="waves-effect waves-light btn modal-trigger" href="#modal2"><i class="material-icons right">edit</i>Edit Profile</a>
                              <a class="waves-effect waves-light btn modal-trigger" href="#modal3"><i class="material-icons right">edit</i>Change Password</a>
                          <?php } ?> 
 

                          <?php
                              if (isset($_SESSION['sfname'])){
                                $sid = $_SESSION['sid'];
                                $selectquery = " select * from student where id = $sid";
                                $query = mysqli_query($conn,$selectquery);
                                $std=mysqli_fetch_array($query);
                                $s_id=$std['id'];
                                $sfname=strtoupper($std['sfname']);
                                $batch =$std['batch'];
                                $faculty= $std['faculty'];
                                $semester= $std['semester'];
                                $slname=strtoupper($std['slname']);
                                $rdate=$std['registrationdate'];
                                $smail=$std['email'];  
                                $sbio=$std['sbio'];      
                            ?>
                          
                        <?php
                        

                          echo "<h4 class='nametext'>$sfname $slname</h4>
                          <span class='light'>$batch <span class='bar'>|</span> $semester <span class='bar'>|</span> $faculty</span> 
                          Email: $smail
                            <p class='joined'>Joined On: $rdate </p> ";  
                            if($sbio){
                             ?>   
                              <p class="bio-text"><?php echo $sbio; ?></p>
                            <?php }
                            else{ ?>
                                <p class='bio-text'>No bio Yet</p>
                             <?php }
                          ?>
                     <!-- Modal Trigger -->
  <a class="waves-effect waves-light btn modal-trigger" href="#modal1"><i class="material-icons right">edit</i>Edit Profile</a>
  <a class="waves-effect waves-light btn modal-trigger" href="#modal4"><i class="material-icons right">edit</i>Change Password</a>
    
  <?php } ?>            
        </div>          
                      
            

            <div class="col s12 m6 l6">
              <?php 
            if (isset($_SESSION['tid'])){ ?>
          <?php 
      $id = $_SESSION['tid'];
  
  
      $qryy= "SELECT COUNT(*) as total FROM assignmentsubmit where teachername = $id";
      $reslt = $conn->query($qryy);
      $rw = $reslt->fetch_assoc();
      $totalRecords = $rw['total'];
      
      $recordsPerPage = 6; // Number of records to display per page
      $totalPages = ceil($totalRecords / $recordsPerPage);
      
      $currentpage = isset($_GET['page']) ? $_GET['page'] : 1;
      
      $startFrom = ($currentpage - 1) * $recordsPerPage; ?>

             
                
              

              <?php
    $id = $_SESSION['tid'];
    $selectquery = " select * from assignment where teacher_id = $id ORDER BY ID DESC ";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query);
    ?>
  
    <?php
    if($num == 0){
        echo '<p class="alert-msg">You have empty Added assignment !</p>';
    }else{

    ?>  
  <?php 
    while($res = mysqli_fetch_array($query)){
        ?>
        <h4>My Activities:
        <span class="pagination page right">
        
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <a <?php if ($i == $currentpage) echo 'class="active"'; ?> href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?> 
      </span>
        </h4>

     <p class="activities"><a><?php echo $res['registeredate']?></a>:<span class="highlight"><?php echo $res['faculty'];?> | <?php echo $res['semester'];?> | <?php echo $res['batch'];?></span>
      Added Assignment On title: <a><?php echo $res['title']; ?></a>
        
        
        <?php
          if ($res['remarks']){ ?>
           with remarks  <a> <?php echo $res['remarks']; ?> </a>
          <?php }
        ?> 
     
     
    </p>

     <?php
    $select = " select * from assignmentsubmit where teachername = $id ORDER BY ID DESC LIMIT $startFrom, $recordsPerPage ";
    $query = mysqli_query($conn,$select);
    while($result = mysqli_fetch_array($query)){
      $number=$result['star'];
      $studentid = $result['student_id'];
      if($result['feedback']){
      ?>
      
   
   <p class="activities"><a><?php echo $result['feedbackdate']?></a>:<span class="highlight"><?php echo $result['faculty'];?> | <?php echo $result['semester'];?> | <?php echo $result['batch'];?></span>
   Sent 
   <?php
                            if ($number >= 1 && $number <= 5) {
  for ($i = 1; $i <= $number; $i++) {
    echo '<i class="material-icons tiny star">star</i>';
  }
}
            ?>
   with feedback <a><?php echo $result['feedback']; ?> </a> to 
  <?php 
   $select1 = " select sfname,slname from student where id='$studentid'";
   $query1 = mysqli_query($conn,$select1);
   while($result1 = mysqli_fetch_array($query1)){
    $fname = $result1['sfname'];
    $lname = $result1['slname'];
    $name = $fname.' '.$lname;
   }
  ?>
  <a><?php echo $name;?></a>
  </p>
<?php
    }
  }



    }
  }
?>
<?php } ?>
<?php
if (isset($_SESSION['sfname'])){ ?>
            
              <?php
    $id = $_SESSION['sid'];


    $querys = "SELECT COUNT(*) as total FROM assignmentsubmit where student_id = $id";
    $results = $conn->query($querys);
    $rows = $results->fetch_assoc();
    $totalRecords = $rows['total'];
    
    $recordsPerPage = 3; // Number of records to display per page
    $totalPages = ceil($totalRecords / $recordsPerPage);
    
    $currentpage = isset($_GET['page']) ? $_GET['page'] : 1;
    
    $startFrom = ($currentpage - 1) * $recordsPerPage;
    






    $selectquery = " select * from assignmentsubmit where student_id = $id ORDER BY ID DESC LIMIT $startFrom, $recordsPerPage";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query);
    ?>
     <h4>My Activities:
      <span class="pagination page right">
         
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <a <?php if ($i == $currentpage) echo 'class="active"'; ?> href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?> 
      </span>
      </h4>
    <?php
    if($num == 0){
        echo '<p class="alert-msg">You have empty submitted assignment !</p>';
    }else{

    ?>  
  <?php 
    while($res = mysqli_fetch_array($query)){
      $feedback = $res['feedback'];
      $star = $res['star'];
        ?>
       
      
     <p class="activities"> <a class="dateformat"><?php echo $res['registeredate']?></a>: <i class=" material-icons">done</i> Submited Assignment On title: <b><a><?php echo $res['title']; ?></a></b>
      <?php 
        if($res['teachername']){ ?>
             to <b>  <i class=" material-icons">person</i><a>
              
             
             <?php 
             $id= $res['teachername']; 
             $sql = " select * from teacher where id = '$id'";
             $qry = mysqli_query($conn,$sql);
             while ($result = mysqli_fetch_array($qry)){
               $tfname = $result['tfname'];
               $tlname = $result['tlname'];
               $name = $tfname.' '.$tlname;
               echo $name;
             }
             
             ?>
            
            
            </a></b>
        <?php }
      ?>       
      <?php if($res['remarks']){?>
        with remark
      <b><a> <?php echo $res['remarks']; ?> </a></b> 
      <?php }else{?>
          
        <?php } ?> </p>
      
      <?php
      if($feedback){ ?>
        <p class="activities"><i class="material-icons">assistant_photo</i></i>[ Received Feedback <b><?php echo $feedback ?></b>  with 
      
        <?php
                            if ($star >= 1 && $star <= 5) {
  for ($i = 1; $i <= $star; $i++) {
    echo '<i class="material-icons tiny star">star</i>';
  }
}
            ?> on <b><?php echo $res['feedbackdate'];?></b>
      
      </p>
       <?php }
      else{ ?>
        <p>[ Feedback Pending ]</p>
       <?php }
      ?>
      
      <hr>
    </p>
    
         

   
<?php
    }
  }
?>
<?php } ?>



            </div>    
           
            
    </div>
    <!-- Modal Structure -->
<div id="modal1" class="modal">
  <div class="modal-content">
  <h4>Edit Profile</h4>
      <div class="row">
      <form action="profile.php" method="post" class="col s12 m6">
            <p>
    
                    <?php
                    
                     
                    
                  echo "
                
                  <input type='text' class='nametext' name='sfname' value='$sfname'>
                  <input type='text' class='nametext' name='slname' value='$slname'>
                  <input type='email' class='nametext' name='semail' value='$smail'>
                  <input type='text' class='nametext' name='sbio' placeholder='Add  Bio' value='$sbio'>
                  ";
                    ?>
    </p>
    <input  class="waves-effect waves-light btn" type="submit" name="sprofile" value="Edit profile">
                        
                        </form>
  </div>
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
  </div>
</div>
 <!-- Modal Structure -->
    <div id="modal2" class="modal">
      <div class="modal-content">
        <h4>Edit Profile</h4>
        <div class="row">
          <form action="profile.php" method="post" class="col s12 m6">
            <p>
    
                    <?php
                    
                     
                    
                  echo "
                
                  <input type='text' class='nametext' name='tfname' value='$tfname'>
                  <input type='text' class='nametext' name='tlname' value='$tlname'>
                  <input type='email' class='nametext' name='temail' value='$tmail'>
                  <input type='text' class='nametext' name='tbio' placeholder='Add  Bio' value='$tbio'>
                  ";
                    ?>
                 </p>
                <input  class="waves-effect waves-light btn" type="submit" name="profile" value="Edit profile">
                        
          </form>
        </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
      </div>
    </div>
    <div id="modal3" class="modal">
      <div class="modal-content">
        <h4>Change Password</h4>
        <div class="row">
        <form method="POST" action="">
    <label for="current_password">Current Password:</label>
    <input type="password" id="current_password" name="current_password" required><br>

    <label for="new_password">New Password:</label>
    <input type="password" id="new_password" name="new_password" required><br>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required><br>

    <input type="submit"  class="waves-effect waves-light btn"name="teachersubmit" value="Change Password">
</form>

        </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
      </div>
    </div>
    <div id="modal4" class="modal">
      <div class="modal-content">
        <h4>Change Password</h4>
        <div class="row">
        <form method="POST" action="">
    <label for="current_password">Current Password:</label>
    <input type="password" id="current_password" name="current_password" required><br>

    <label for="new_password">New Password:</label>
    <input type="password" id="new_password" name="new_password" required><br>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required><br>

    <input type="submit"  class="waves-effect waves-light btn"name="studentsubmit" value="Change Password">
</form>

        </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
      </div>
    </div>

    <?php
// Assuming you have a database connection established

// Check if the form is submitted
if (isset($_SESSION['tid'])){
$id = $_SESSION['tid'];
if (isset($_POST['teachersubmit'])) {
    // Retrieve form inputs
    $currentPassword = md5($_POST['current_password']);
    $newPassword = md5($_POST['new_password']);
    $confirmPassword = md5($_POST['confirm_password']);

    // Validate form inputs
    $errors = [];

    // Check if the current password is correct (you'll need to modify the query and condition)
    $query = "SELECT * FROM teacher WHERE id = $id AND password = '$currentPassword'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 0) {
        $errors[] = "Current password is incorrect.";
    }

    // Check if the new password and confirm password match
    if ($newPassword !== $confirmPassword) {
        $errors[] = "New password and confirm password do not match.";
    }

    // If there are no errors, update the password in the database
    if (empty($errors)) {
        $newPassword = mysqli_real_escape_string($conn, $newPassword);
        $query = "UPDATE teacher SET password = '$newPassword' WHERE id = $id"; // Modify the query and condition as needed
        mysqli_query($conn, $query);
        $successMessage = "Password has been changed successfully.";
    }
}
}
?>

<?php
// Check if the form is submitted
if (isset($_SESSION['sid'])){
$id = $_SESSION['sid'];
if (isset($_POST['studentsubmit'])) {
    // Retrieve form inputs
    $currentPassword = md5($_POST['current_password']);
    $newPassword = md5($_POST['new_password']);
    $confirmPassword = md5($_POST['confirm_password']);

    // Validate form inputs
    $errors = [];

    // Check if the current password is correct (you'll need to modify the query and condition)
    $query = "SELECT * FROM student WHERE id = $id AND password = '$currentPassword'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 0) {
        $errors[] = "Current password is incorrect.";
    }

    // Check if the new password and confirm password match
    if ($newPassword !== $confirmPassword) {
        $errors[] = "New password and confirm password do not match.";
    }

    // If there are no errors, update the password in the database
    if (empty($errors)) {
        $newPassword = mysqli_real_escape_string($conn, $newPassword);
        $query = "UPDATE student SET password = '$newPassword' WHERE id = $id"; // Modify the query and condition as needed
        mysqli_query($conn, $query);
        $successMessage = "Password has been changed successfully.";
    }
}
}
?>


<script>
<?php
if (isset($errors) && !empty($errors)) {
    echo "alert('Error: " . implode("\\n", $errors) . "');";
}

if (isset($successMessage)) {
    echo "alert('$successMessage');";
}
?>
</script>

<?php
if (isset($_POST['profile'])){
    $fname = $_POST['tfname'];
    $tlname = $_POST['tlname'];
    $temail = $_POST['temail'];
    $tbio = $_POST['tbio'];
    $sql = "UPDATE teacher SET tfname='$fname',tlname='$tlname',email='$temail',bio='$tbio' where id=$id";
    $query = mysqli_query($conn, $sql);
    if($query){
        ?>
        <script>
            alert("Updated Sucessfully");
            window.location.href="../SAFS/profile.php";
            </script>

            <?php
    }else{
        ?>
        <script>
        alert("Error Found");
        </script>
        <?php
    }

}
?>
<?php
if (isset($_POST['sprofile'])){
    $sfname = $_POST['sfname'];
    $slname = $_POST['slname'];
    $semail = $_POST['semail'];
    $sbio = $_POST['sbio'];
    $sql = "UPDATE student SET email='$semail',sfname='$sfname',slname='$slname',sbio='$sbio' where id=$sid";
    $query = mysqli_query($conn, $sql);
    if($query){
        ?>
        <script>
            alert("Updated Sucessfully");
            window.location.href="../SAFS/profile.php";
            </script>

            <?php
    }else{
        ?>
        <script>
        alert("Error Found");
        </script>
        <?php
    }

}
?>
<style>
  span.highlight{
  background:#9E9E9E;
  color:white;
  padding:5px;
  
}
span.page{
  font-size:23px;
 
}
</style>