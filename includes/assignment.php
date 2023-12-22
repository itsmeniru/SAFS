<?php

include 'config.php';
if (isset($_POST['submit'])){
    $teacher_id= $_SESSION['tid'];
    $title = $_POST['title'];
    $batch =$_POST['batch'];
    $semester = $_POST['semester'];
    $comment = $_POST['textarea'];    
    
    $remark = $_POST['remark'];
    $faculty = $_POST['faculty'];
    $sub = $_POST['sub'];
    $deadline = $_POST['deadline'];
    date_default_timezone_set('Asia/Kathmandu');
    $date = date('Y-m-d H:i:s');
    
    $pdf=$_FILES['pdf']['name'];
    $pdf_type=$_FILES['pdf']['type'];
    $pdf_size=$_FILES['pdf']['size'];
    $pdf_tem_loc=$_FILES['pdf']['tmp_name'];
    $pdf_store="pdf/".$pdf;
    move_uploaded_file($pdf_tem_loc,$pdf_store);
    $sql="INSERT INTO assignment(batch,semester,teacher_id,title,pdf,comment,remarks,registeredate,deadline,sub,faculty)
     values('$batch','$semester','$teacher_id','$title','$pdf','$comment','$remark','$date','$deadline','$sub','$faculty')";
    $query=mysqli_query($conn,$sql);
    if($query){
        ?>
        <script>
            alert("Assignment has been Added Sucessfully:");
            window.location.href="../SAFS/assignment.php";
            </script>

            <?php
    }else{
        ?>
        <script>
        alert("Something Error:");
        </script>
        <?php
    }
}

if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  $sql="DELETE FROM assignment WHERE id=$id";
  $query=mysqli_query($conn,$sql);
    if($query){
        ?>
        <script>
            alert("Do you want to delete this assignment?");
            window.location.href="../SAFS/assignment.php";
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
<script>
function validateForm() {
  let a = document.forms["myForms"]["title"].value;
  let c = document.forms["myForms"]["pdf"].value;
  let b = document.forms["myForms"]["sub"].value;
  let f = document.forms["myForms"]["deadline"].value;
  let g = document.forms["myForms"]["semester"].value;
  let h = document.forms["myForms"]["textarea"].value;
  let e = document.forms["myForms"]["batch"].value;
  let d = document.forms["myForms"]["faculty"].value;
  
  if (a == "") {
    alert("Please, Get your assignment Title:");
    return false;
  }
  if (b == "") {
    alert("Please, Get your subject first:");
    return false;
  }
  if (c == "" && h=="") {
    alert("Please, choose any format, text or file");
    return false;
  }
 
  if (f == "") {
    alert("Set your assignment deadline:");
    return false;
  }
  if (g == "") {
    alert("Set your semester:");
    return false;
  }
 
  if (e == "") {
    alert("Set your batch:");
    return false;
  }
  if (d == "") {
    alert("Set your faculty:");
    return false;
  }
}
</script>
<div id="admis">
  <div class="row">
          <div class="container">
            <div class="col s12 l5 m5">
                <form name="myForms" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()" class="col s12"> 
                    <blockquote><h5 class="login-headtext"><b>ADD ASSIGNMENT</b></h5></blockquote>  
                    <?php
                    $id = $_SESSION['tid'];
                    $selectquery = " select * from teacher where id = $id";
                    $query = mysqli_query($conn,$selectquery);
                    $num = mysqli_num_rows($query); 
                    while($res = mysqli_fetch_array($query)){
                    $teacher_lname= $res['tlname']; 
                                                            }
                    ?>    
                          
                      <div class="row">
                        <div class="input-field col s6 m6 l6">
                          <label for="text">Title</label>
                            <input id="text" type="text" name="title"   class="validate">
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
                                            $sem = $res['sub'];          
                                            ?>
                                            <option value="<?php echo $sem; ?>"><?php echo $sem; ?></option>
                                            <?php } ?>
                                        </select>
                                            
                            <label for="subject">Subject</label>
                        </div>
                      </div>

                    <div class="row">
                    <div class="file-field input-field col s6 m6 l6">
                        <div class="btn">
                          <span>File</span>
                          <input type="file" name="pdf">
                        </div>
                        <div class="file-path-wrapper">
                          <input class="file-path validate" type="text" placeholder="File">
                        </div>
                      </div>
                      <div class="input-field col s6 m6 l6">
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
                                            <label>Which Faculty?</label>
                                    
                                              </div>

                                      </div>

                                                <div class="row">
                                     <div class="input-field col s6 m6 l6">
                               <textarea id="textarea1" name="remark" class="materialize-textarea"></textarea>
                                 <label for="textarea1">Remarks</label>
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
                                            <label>Which Batch?</label>
                                    
                            </div>
                          </div>
                      <div class="row">
                            <div class="input-field col s12 m6">
                            <input id="date" type="date" name="deadline" placeholder="deadline"  class="validate">
                            <label for="date">Assignment Deadline</label>
                            </div>

                            <div class="input-field col s12 m6">
                          
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
                    <label>Which Semester?</label>
      
                            </div>
                            <div class="row">
                              <div class="input-field col s12 m12 l12">
                      <textarea name="textarea" placeholder="What is your Question?" id="mytextarea" rows="5" cols="30">

                    </textarea>
                              </div>
                            </div>
                            
                        </div>
                  <input  class="waves-effect waves-light btn" type="submit" name="submit" value="Add Assignment">
     
                </form>
            </div>

              <div class="col s12 m7 l7">


                         <?php
                          $id = $_SESSION['tid'];
                             $selectquery = " select * from assignment where teacher_id = $id ORDER BY ID DESC";
                                 $query = mysqli_query($conn,$selectquery);
                                $num = mysqli_num_rows($query); 
    
                               ?>

                            <h5 class="highlight"><b>My Posted Assignments:</b></h5>
                       <p><b>Number of Assignment:</b> (<?php echo $num?>)
                             <?php 
                         $sql = "SELECT MAX(registeredate) AS latest_date FROM assignment where teacher_id=$id";
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
                                                <th>Date</th>
                                   <th>Action </th></th>
   
                                      </tr>
                                         <?php 
                                while($res = mysqli_fetch_array($query))
                                {
                                  $comment = $res['comment'];
                                  $id = $res['teacher_id'];
                                  $sql = " select * from teacher where id = $id";
                                  $queries = mysqli_query($conn,$sql);
                                  while($result = mysqli_fetch_array($queries)){
                                    $fname = $result['tfname'];
                                    $lname = $result['tlname'];
                                    $name = $fname." ".$lname;
                                  }

                                 
                            ?>
       
                                   <tr>
                                      <td><?php echo $res['faculty'];?></td>
                                       <td><?php echo $res['batch'];?></td>
                                        <td><?php echo $res['semester']; ?> </td>
                                         <td><?php echo $res['sub'];?></td>
                                                   <td><?php echo $res['title'];?></td>
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
                               
                               
                               
                               
                                                   <?php if($res['pdf']){ ?>        
                                     <td><?php echo $res['pdf']; ?><a href="assignment_update.php?update_pdf=<?php echo $res['id'];?>">Change file</a></td>
                                 <?php } else{?>
                                          <td>(No file) <a href="assignment_update.php?update_pdf=<?php echo $res['id'];?>">Upload file</a></td>
                
                                  <?php } ?>
                                  <td><?php echo $res['registeredate'];?></td>
                                             <td>
                                               <a href="assignment_update.php?update=<?php echo $res['id'];?>"><i class="material-icons">edit</i></a>
                                             <a href="assignment.php?delete=<?php echo $res['id'];?>"><i class="material-icons">delete</i></a>
                                                  </td>

                                     </tr>        
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
      h5.highlight{
  padding:10px;
  border-left:1px solid #FF9800;
  border-bottom:  3px solid #FF9800;
}
    </style>

