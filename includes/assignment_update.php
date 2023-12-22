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
if(isset($_POST['update'])){
    $id = $_POST['update_id'];    
    $title = $_POST['title'];
    $remark = $_POST['remark'];
    $batch = $_POST['batch'];
    $faculty = $_POST['faculty'];
    $semester = $_POST['semester'];
    $comment = $_POST['text'];
    $sub = $_POST['sub'];
    $deadline = $_POST['deadline'];
    
    $sql="UPDATE `assignment` SET  `batch`='$batch', `semester`='$semester',`title`='$title', `comment`='$comment',`remarks`='$remark',`deadline`='$deadline',`sub`='$sub',`faculty`='$faculty' WHERE id=$id";

    $query=mysqli_query($conn,$sql);
    if($query){
        ?>
        <script>
            alert("Assignment Updated");
            window.location.href="../SAFS/assignment.php";
            </script>

            <?php
    }else{
        ?>
        <script>
        alert("Something is error");
        </script>
        <?php
    }
}

if(isset($_POST['update_pdf'])){
  $id = $_POST['updatepdf_id'];    
  $pdf=$_FILES['pdf']['name'];
  $pdf_type=$_FILES['pdf']['type'];
  $pdf_size=$_FILES['pdf']['size'];
  $pdf_tem_loc=$_FILES['pdf']['tmp_name'];
  $pdf_store="pdf/".$pdf;
  move_uploaded_file($pdf_tem_loc,$pdf_store);
  $sql="UPDATE `assignment` SET `pdf`='$pdf' WHERE id=$id";

  $query=mysqli_query($conn,$sql);
  if($query){
      ?>
      <script>
          alert("Your file is updated now");
          window.location.href="../SAFS/assignment.php";
          </script>

          <?php
  }else{
      ?>
      <script>
      alert("Something is error");
      </script>
      <?php
  }
}
    

?>
<script>
function validateForm() {
  
  let y = document.forms["myForms"]["pdf"].value;
 
  if (y == "") {
    alert("Please upload File:");
    return false;
  }
  
}
function validateForms(){
let a = document.forms["myForms"]["sub"].value;
let b = document.forms["myForms"]["batch"].value;
  let c = document.forms["myForms"]["semester"].value;
  let d = document.forms["myForms"]["faculty"].value;
 
  
  if (a == "") {
    alert("Please Set Subject:");
    return false;
  }
  if (b == "") {
    alert("Please Set Batch:");
    return false;
  }
  if (c == "") {
    alert("Please Set Semester:");
    return false;
  }
  if (d == "") {
    alert("Please Set Faculty:");
    return false;
  }
}
</script>
<div id="admis">
  <div class="row">
    <div class="container">
      <div class="col s12 m5 l5">
          <?php
            if(isset($_GET['update'])){
            $id = $_GET['update'];
            $sql="select * FROM assignment WHERE id=$id";
            $query=mysqli_query($conn,$sql);
              foreach($query as $row)
                {
        
          ?>
                <form name="myForms" method="POST" enctype="multipart/form-data" onsubmit="return validateForms()" class="col s12"> 
                   <blockquote><h5 class="login-headtext"><b>UPDATE YOUR ASSIGNMENT</b></h5></blockquote>  
                 <div class="row">
                   <div class="input-field">
                            <input id="text" type="hidden" name="update_id" value="<?php echo $row['id']?>"  class="validate">
                            </div>
                        
                            <div class="input-field col s6 m6 l6">
                            <input id="text" type="text" name="title" value="<?php echo $row['title']?>"  class="validate">
                            <label for="text">Title</label>
                            </div>
                            <div class="input-field col s6 m6 l6">  
                            <i class="material-icons prefix">library_books</i>
                                        <select class="validate" name="sub">
                                            <option value="" disabled selected>Subject</option>
                                            <?php
                                            $id= $_SESSION['tid'];
                                            $selectquery = " select * from access_subject where teacher_id = $id";
                                            $query = mysqli_query($conn,$selectquery);
                                            while($res = mysqli_fetch_array($query)){
                                            $id= $res['id'];
                                            $sub = $res['sub'];          
                                            ?>
                                            <option value="<?php echo $sub; ?>"><?php echo $sub; ?></option>
                                            <?php } ?>
                                        </select>
                                            
                            <label for="subject">(Previous: <?php echo $row['sub'];?>)</label>
                            </div>
                    </div>  
                    <div class="row">
                      <div class="input-field col s6 m6 l6">
                        <input type="text" id="textarea1" name="remark" value="<?php echo $row['remarks']?>" class="materialize-textarea">
                        <label for="textarea1">Remarks[optional]:</label> 
                      </div>
                      <div class="input-field col s6 m6 l6">
                      <i class="material-icons prefix">av_timer</i>
                                        <select class="validate" name="batch">
                                            <option value="" disabled selected>Batch</option>
                                            <?php
                                            $selectquery = " select * from batch ORDER BY batch DESC";
                                            $query = mysqli_query($conn,$selectquery);
                                            while($res = mysqli_fetch_array($query)){
                                            $id= $res['id'];
                                            $batch = $res['batch'];          
                                            ?>
                                            <option value="<?php echo $batch; ?>"><?php echo $batch; ?></option>
                                            <?php } ?>
                                        </select>
                                            <label>(Previous: <?php echo $row['batch'];?>)</label>
                      </div>
                    </div>
                        <div class="row">
                          <div class="input-field col s6 m6 l6">
                            <input id="date" type="date"value="<?php echo $row['deadline']?>" name="deadline" placeholder="deadline"  class="validate">
                            <label for="date">Assignment Deadline</label>
                          </div>
                          <div class="input-field col s6 m6 l6">
                          <i class="material-icons prefix">beenhere</i>
        <select class="validate" name="semester">
        <option value="" disabled selected>Semester</option>
                                            <?php
                                             $id = $_SESSION['tid'];
                                            $selectquery = " select * from access where teacher_id = $id";
                                            $query = mysqli_query($conn,$selectquery);
                                            while($res = mysqli_fetch_array($query)){
                                            $id= $res['id'];
                                            $semester = strtoupper($res['semester']);          
                                            ?>
                                            <option value="<?php echo $semester; ?>"><?php echo $semester; ?></option>
                                            <?php } ?>
        </select>
        <label>(Previous: <?php echo $row['semester'];?>)</label>
                          </div>
                                  
                        </div>
                        <div class="row">
                          <div class="input-field col s12 m6 l6">
                          <i class="material-icons prefix">layers</i>
                                        <select class="validate" name="faculty">
                                            <option value="" disabled selected>Faculty</option>
                                            <?php
                                            $id= $_SESSION['tid'];
                                            $selectquery = " select * from access_faculty where teacher_id =$id ";
                                            $query = mysqli_query($conn,$selectquery);
                                            while($res = mysqli_fetch_array($query)){
                                            $id= $res['id'];
                                            $faculty = $res['faculty'];          
                                            ?>
                                            <option value="<?php echo $faculty; ?>"><?php echo $faculty; ?></option>
                                            <?php } ?>
                                        </select>
                                            <label>(Previous: <?php echo $row['faculty'];?>)</label>
                          </div>

                        
                              <div class="input-field col s12 m6 l6">
                              <input id="text" type="text" value="<?php echo $row['comment']?>" name="text"  class="validate">
                            <label for="text">Update Question:</label>
                              </div>
                            </div>


                      <input  class="waves-effect waves-light btn" type="submit" name="update" value="Update">
                </form>
                <?php
    }
}
?>

<?php
            if(isset($_GET['update_pdf'])){
            $id = $_GET['update_pdf'];
            $sql="select * FROM assignment WHERE id=$id";
            $query=mysqli_query($conn,$sql);
              foreach($query as $row)
                {
        
          ?>
                <form name="myForms" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()" class="col s12"> 
                   <blockquote><h5 class="login-headtext"><b>UPDATE YOUR FILE</b></h5></blockquote>  
                 <div class="row">
                   <div class="input-field col s12">
                            <input id="text" type="hidden" name="updatepdf_id" value="<?php echo $row['id']?>"  class="validate">  
                            </div>            
                    </div>  
                    <div class="file-field input-field">
      <div class="btn">
        <span>File</span>
        <input type="file" name="pdf">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text" placeholder="File">
      </div>
      <div class="input-field col s12">
        <?php if ($row['pdf']){?>
          <input disabled value="<?php echo $row['pdf'];?>" id="disabled" type="text" class="validate">
          <label for="disabled">Recent File</label>
          <?php }else {?>
              <span class="empty">--No any selected file</span>
            <?php } ?>
        
        </div>
    </div>
                   
                       
                      <input  class="waves-effect waves-light btn" type="submit" name="update_pdf" value="Upload">
                </form>
                <?php
    }
}
?>



</div>

<div class="col s12 m7 l7">


    <?php
    $id = $_SESSION['tid'];
    $selectquery = " select * from assignment where teacher_id = $id ORDER BY ID DESC";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query); 
?>

    <h5 class="highlight"><b>My Posted Assignments:</b></h5>
    <p><b>Number of Assignment:</b> (<?php echo $num?>) |
  <?php
 $sql = "SELECT MAX(registeredate) AS latest_date FROM assignment";
 $result = mysqli_query($conn,$sql);
 if ($result) {
  // Fetch the data
  $row = $result->fetch_assoc();
  $latestDate = $row['latest_date'];

  // Output the latest posted date
  echo "<b>Last Updated:</b>" . $latestDate;
} else {
  echo $conn->error;
} 

?>
  
  
  
  
  </p>
    <?php
    if($num ==0){
        echo '<p class="alert-msg">You donot have posted any assignment yet !</p>';
    }else{

    ?>
    
        <table>
  <tr>
    <th>Faculty</th>
    <th>Batch</th>
    <th>Semester</th>
    <th>Subject</th>
    <th>Title</th>
    <th>Text</th>
    <th>File</th>
    <th>Updated</th>
    
   
  </tr>
  <?php 
    while($res = mysqli_fetch_array($query)){
      $comment = $res['comment'];
      $id = $res['teacher_id'];
      $sql = " select * from teacher where id = $id";
    $qry = mysqli_query($conn,$sql);
    while($result = mysqli_fetch_array($qry)){

      $fname = $result['tfname'];
      $lname = $result['tlname'];
      $name = $fname." ".$lname;

    }
        ?>
       
        <tr>
            <td><?php echo $res['faculty']; ?></td>
            <td><?php echo $res['batch'];?></td>
            <td><?php echo $res['semester'];?></td>
            <td><?php echo $res['sub'];?></td>
            <td><?php echo $res['title']; ?> </td>
            <td>
                                                    <?php if ($comment){?>
                                                    <a href="#modal<?php echo $res['id']; ?>" class=" modal-trigger"><b>Read</b></a>    
                                                  <?php }else{ ?>
                                                    <span class="no">(No text)</span>
                                                    <?php }?>
                                                  </td>
                                                  <div id="modal<?php echo $res['id']; ?>" class="modal">
                                <div class="modal-content text">
                                  <center>
                                      <h4><b>Assignment No:<?php echo $res['id']; ?></b></h4>
                                  </center>
                                    <p style="float:right"><b>Date of Assignment: <?php echo $res['registeredate'];?></b> </p>
                                      <h5>  
                                         
                                               <b><?php echo strtoupper($name) ?></b>
                                        </h5> <hr> 
                                            <p><?php echo $comment;?></p>
                                  </div>
                                    <div class="modal-footer">
                                        <a href="#!" class="modal-close waves-effect waves-green btn-flat"><b>Close</b></a>
                                    </div>
                              </div>

            <?php if ($res['pdf']){?>
            <td><?php echo $res['pdf']; ?> <a href="assignment_update.php?update_pdf=<?php echo $res['id'];?>">Change file</a> </td>
            <?php }else{?>
              <td>(No file) <a href="assignment_update.php?update_pdf=<?php echo $res['id'];?>">upload file</a> </td>
              
              <?php }?>
           <td><?php echo $res['registeredate'];?></td>
           
<?php
    }
  }
?>
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
    
    </style>