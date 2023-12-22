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
<?php
include 'config.php';
if (isset($_POST['asubmit'])){
    $student_id= $_SESSION['sid'];
    $title = $_POST['title'];
    $tname = $_POST['tname'];
    $batch = $_POST['batch'];
    $semester=$_POST['semester'];
    $faculty = $_POST['faculty'];
    $sub = $_POST['sub'];
    date_default_timezone_set('Asia/Kathmandu');
    $date = date('Y-m-d H:i:s');
    $remarks = $_POST['remarks'];
    $comment  = $_POST['comment'];
    $pdf=$_FILES['pdf']['name'];
    $pdf_type=$_FILES['pdf']['type'];
    $pdf_size=$_FILES['pdf']['size'];
    $pdf_tem_loc=$_FILES['pdf']['tmp_name'];
    $pdf_store="pdf/".$pdf;
    move_uploaded_file($pdf_tem_loc,$pdf_store);
    $sql="INSERT INTO assignmentsubmit(student_id,title,teachername,batch,semester,remarks,registeredate,pdf,comment,sub,faculty)
     values('$student_id','$title','$tname','$batch','$semester','$remarks','$date','$pdf','$comment','$sub','$faculty')";
    $query=mysqli_query($conn,$sql);
    if($query){
        ?>
        <script>
            alert("Data has been inserted");
            window.location.href="http://localhost/SAFS/submitassignment.php";
            </script>

            <?php
    }else{
        ?>
        <script>
        alert("Data Not inserted");
        </script>
        <?php
    }
}

if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  $sql="DELETE FROM assignmentsubmit WHERE id=$id";
  $query=mysqli_query($conn,$sql);
    if($query){
        ?>
        <script>
            alert("Data has been delete");
            window.location.href="http://localhost/SAFS/submitassignment.php";
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
<script>
function validateForm() {
  let x = document.forms["myForms"]["title"].value;
  let y = document.forms["myForms"]["pdf"].value;
  
  let a = document.forms["myForms"]["sub"].value;
  let b = document.forms["myForms"]["tname"].value;
  let c = document.forms["myForms"]["comment"].value;
  
  if (x == "") {
    alert("Please, Get your assignment Title:");
    return false;
  }
  if (y == "" && c=="") {
    alert("Please, Choose any one format, pdf of text:");
    return false;
  }
  
  if (a == "") {
    alert("Please, Enter Subject:");
    return false;
  }
  if (b == "") {
    alert("Please, select teacher:");
    return false;
  }
  
}
</script>
<div id="admis">
  <div class="container">
    <div class="row">     
            <div class="col s12 m5 l5">
                 <form name="myForms" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()" class="col s12"> 
                  <blockquote><h5 class="login-headtext">ASSIGNMENT SUBMISSION FORM</h5></blockquote>  
                  <?php
                    $student_id = $_SESSION['sid'];
                    $selectquery = " select * from student where id = $student_id";
                      $query = mysqli_query($conn,$selectquery);
                       $num = mysqli_num_rows($query); 
                          while($res = mysqli_fetch_array($query)){
                         
      $batch = $res['batch'];
      $semester = $res['semester'];
      $faculty = $res['faculty'];
    }
?>

<input id="text" type="hidden" value="<?php echo $student_lname;?>"name="slname"
                               class="validate">
 <input id="text" type="hidden" value="<?php echo $batch;?>" name="batch" class="validate">
 <input id="text" type="hidden" value="<?php echo $semester;?>" name="semester" class="validate">
 <input id="text" type="hidden" value="<?php echo $faculty;?>" name="faculty" class="validate">
 
    <div class="row">
      <div class="input-field col s6 m6 l6">             
                <select name="title"  class="validate">
                     <option value="" disabled selected>Select Title</option>
                     <?php
                       if (isset($_SESSION['sfname']) && isset($_SESSION['sid'])){
                        $sem = $_SESSION['semester'];
                        $batch = $_SESSION['batch'];
                        $faculty= $_SESSION['faculty'];
                    $selectquery = " select * from assignment where faculty='$faculty' and semester='$sem' and batch ='$batch' ORDER BY ID DESC";
                    $query = mysqli_query($conn,$selectquery);
                    while($res = mysqli_fetch_array($query)){
                      $aid= $res['id'];
                      $atitle = $res['title'];          
                      $asub = $res['sub'];
                      $initialDate = strtotime($res['registeredate']);
                      $finalDate = strtotime($res['deadline']);
                      // Get the current date
                $currentDate = time();
                $remainingTime = $finalDate - $currentDate;
                // Calculate the remaining days by comparing the final date with the current date
                $remainingDays = ceil($remainingTime / (60 * 60 * 24));
                      ?>
                      <?php if ($remainingDays > 0){?>
                      <option value="<?php echo $atitle; ?>"><?php echo $atitle; ?></option>
                      <?php } ?>
                  <?php } ?>
                </select>
                    <label>Select Assignment Title:</label>
      </div>
    <?php } ?>
    <div class="input-field col s6 m6 l6">
                               <select name="sub" class="validate">
                              <option value="" disabled selected>Choose Subject</option>
                              <?php
                                if (isset($_SESSION['sid'])){
                                  $sem = $_SESSION['semester'];
                                  $batch = $_SESSION['batch'];
                                  $selectquery = "SELECT DISTINCT sub FROM assignment where batch='$batch' and semester='$sem' ORDER BY ID DESC";
                              $query = mysqli_query($conn,$selectquery);
                                while($res = mysqli_fetch_array($query)){
                            
                                $sub = $res['sub'];
                                  $initialDate = strtotime($res['registeredate']);
                                    $finalDate = strtotime($res['deadline']);
                                            // Get the current date
                                              $currentDate = time();
                                            $remainingTime = $finalDate - $currentDate;
                                                        // Calculate the remaining days by comparing the final date with the current date
                                                  $remainingDays = ceil($remainingTime / (60 * 60 * 24)); 
                                                      ?>
                                                   
                                                 <option value="<?php echo $sub; ?>"><?php echo $sub; ?></option>
                                              
                                                          <?php } ?>
                                            </select>
                                              <label>
                                                Select Subject
                                              </label>
                                              <?php } ?>
                            </div>
    </div>
<div class="row">
<div class="file-field input-field col s12 m12 l12">
      <div class="btn">
        <span>File</span>
        <input type="file" name="pdf">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text" placeholder="File">
      </div>
    </div>
                          </div>
                          <div class="row">
        <div class="input-field col s6 m6 l6">
          <textarea id="textarea1" name="remarks" class="materialize-textarea"></textarea>
          <label for="textarea1">Remarks[Optional]</label>    
        </div>
        <div class="input-field col s6 m6 l6">
        <select name="tname"  class="validate">
                     <option value="" disabled selected>Teacher Name</option>
                     <?php
                    $selectquery = " select * from teacher ORDER BY ID DESC";
                    $query = mysqli_query($conn,$selectquery);
                    while($res = mysqli_fetch_array($query)){
                      $id = $res['id'];
                      $fname= $res['tfname'];
                      $lname = $res['tlname'];
                      $name = $fname." ".$lname;
                                
                
                      ?>
                      <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                  <?php } ?>
                </select>
                    <label>Select Teacher Name:</label>
        </div>
</div>
<div class="row">
<div class="input-field col s12 m12 l12">
<textarea name="comment"  class="validate" placeholder="Answers goes here..." id="mytextarea" rows="2" cols="30">
</textarea>
</div>
</div>
 
    

   
        <input  class="waves-effect waves-light btn" type="submit" name="asubmit" value="submit">
     
                </form>
            </div>
<div class="col s12 l7 m7">

    <?php
    $id = $_SESSION['sid'];
    $selectquery = " select * from assignmentsubmit where student_id = $id ORDER BY ID DESC";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query); ?>
    <h5 class="highlight"><b>My Submited Assignments:</b></h5>
    <p><b>Number of Assignment:</b> (<?php echo $num?>)
  
  
  
    <?php 
                         $sql = "SELECT MAX(registeredate) AS latest_date FROM assignmentsubmit where student_id=$id";
                         $result = mysqli_query($conn,$sql);
                       if ($result) {
                        // Fetch the data
                         $row = $result->fetch_assoc();
                    $latestDate = $row['latest_date'];
                   if($latestDate){
                      // Output the latest posted date
                  echo  "| <b>Last Uploaded:</b>" .$latestDate;
                   }
                                } else {
                    echo $conn->error;
                     } 
                        ?>
  
  
  
  
  
  
  
  
  </p>
    <?php
    if($num ==0){
        echo '<p class="alert-msg">You have empty submitted assignment !</p>';
    }else{

    ?>
    
        <table class="responsive-table highlight striped">
  <tr>
    <th>Semester</th>
    <th>Teacher</th>
    <th>Subject</th>
    <th>Title</th>
    <th>File</th>
    <th>Answer</th>
    <th>Action</th></th>
   
  </tr>
        <?php 
      while($res = mysqli_fetch_array($query)){
        $id = $res['teachername'];
        $sql = " select tfname,tlname from teacher where id = $id";
        $query1 = mysqli_query($conn,$sql);
        while($result = mysqli_fetch_array($query1)){
          $fname=$result['tfname'];
          $lname = $result['tlname'];
          $tname = $fname. " ".$lname;
        }
        ?>
       
    <tr>
           <td><?php echo $res['semester'];?></td>
          <td><?php echo $tname;?>
                  <td><?php echo $res['sub'];?></td>
          </td>
           <td><?php echo $res['title']; ?> </td>
           <?php if ($res['pdf']){ ?>
            <td><?php echo $res['pdf']; ?><a href="submitassignment_update.php?update_pdf=<?php echo $res['id'];?>"><b>Change</b></a> </td>
            <?php }else{?>
              <td><span class="empty">(No File)<a href="submitassignment_update.php?update_pdf=<?php echo $res['id'];?>">Upload File</a> </span></td>
              <?php } ?>
            <td>
              <?php if ($res['comment']){?>
            <a href="#modal<?php echo $res['id']; ?>" class=" modal-trigger"><b>Read</b></a>    
                            <?php }else{ ?>
                              <span class="empty">(No text)</span>    
          <?php }?>
          </td>

          <div id="modal<?php echo $res['id']; ?>" class="modal">
                                <div class="modal-content text">
                                  <center>
                                      <h4><b>Assignment No:<?php echo $res['id']; ?></b></h4>
                                  </center>
                                    <p style="float:right"><b>Date of Assignment: <?php echo $res['registeredate'];?></b> </p>
                                      <h5>  
                                         To teacher<br>
                                               <b><?php echo strtoupper($tname) ?></b>
                                        </h5> <hr> 
                                            <p><b>Answer:</b><?php echo $res['comment'];?></p><br>
                                            <b>Remarks:</b>
                                            <?php if ($res['remarks']) { ?>
                                            <span>
                                              
                                              
                                            <?php echo $res['remarks'];?></span>
                                            <?php }else{ ?>
                                              <span>Null</span>
                                              <?php } ?>
                                  </div>
                                    <div class="modal-footer">
                                        <a href="#!" class="modal-close waves-effect waves-green btn-flat"><b>Close</b></a>
                                    </div>
                              </div>




            <td>
              <a href="submitassignment_update.php?update=<?php echo $res['id'];?>"><i class="material-icons">edit</i></a>
              <a href="submitassignment.php?delete=<?php echo $res['id'];?>"><i class="material-icons">delete</i></a>
            </td>
      </tr> 
                                
<?php
    }
  }
?>
</table>
    </div>
</div>
    </div>
  </div>
  <script src="https://cdn.tiny.cloud/1/pqjrfj6h8yyyp7rw5e53snplp5ci47htuh49n32sle2b31ni/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
      tinymce.init({
        selector: '#mytextarea'
      });
    </script>
    <style>
      span.empty{
    color:#8b8989;
    font-weight:bold;
    font-size:11px;
    font-family:cursive;

}
    </style>