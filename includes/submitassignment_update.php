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
    
    $subject = $_POST['sub']; 
    $teacher = $_POST['tname'];
    $comment = $_POST['comment'];       
    $sql="UPDATE `assignmentsubmit` SET `title`='$title',`teachername`='$teacher',`remarks`='$remark',`comment`='$comment',`sub`='$subject' WHERE id=$id";

    $query=mysqli_query($conn,$sql);
    if($query){
        ?>
        <script>
            alert("Updated Sucessfully");
            window.location.href="../SAFS/submitassignment.php";
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

if(isset($_POST['update_pdf'])){
  $id = $_POST['updatepdf_id'];    
  $pdf=$_FILES['pdf']['name'];
  $pdf_type=$_FILES['pdf']['type'];
  $pdf_size=$_FILES['pdf']['size'];
  $pdf_tem_loc=$_FILES['pdf']['tmp_name'];
  $pdf_store="pdf/".$pdf;
  move_uploaded_file($pdf_tem_loc,$pdf_store);
  $sql="UPDATE `assignmentsubmit` SET `pdf`='$pdf' WHERE id=$id";

  $query=mysqli_query($conn,$sql);
  if($query){
      ?>
      <script>
          alert("Data has been inserted");
          window.location.href="../SAFS/submitassignment.php";
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
    

?>
<script>
function validateForm() {
  
  let y = document.forms["myForms"]["pdf"].value;
 
  
  if (y == "") {
    alert("Select your file to upload:");
    return false;
  }
  
}
function validateForms() {
  
  let a = document.forms["myForms"]["title"].value;
  let b = document.forms["myForms"]["sub"].value;
  let c = document.forms["myForms"]["tname"].value;


  
  if (a == "") {
    alert("Select your title:");
    return false;
  }
  if (b == "") {
    alert("Which is your Subject?:");
    return false;
  }
  if (c == "") {
    alert("Who is your Teacher?:");
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
            $sql="select * FROM assignmentsubmit WHERE id=$id";
            $query=mysqli_query($conn,$sql);
              foreach($query as $row)
                {
        
          ?>
                <form name="myForms" method="POST" enctype="multipart/form-data" onsubmit="return validateForms()" class="col s12"> 
                   <blockquote><h5 class="login-headtext">UPDATE YOUR SUBMIT ASSIGNMENT</h5></blockquote>  
                 <div class="row">
                 <div class="input-field">
                            <input id="text" type="hidden" name="update_id" value="<?php echo $row['id']?>"  class="validate">
                            </div>
                        
                          <div class="input-field col s6 m6 l6">
                               <select name="title" class="validate">
                              <option value="" disabled selected>Choose Title</option>
                              <?php
                                if (isset($_SESSION['sid'])){
                                  $sem = $_SESSION['semester'];
                                  $batch = $_SESSION['batch'];
                                  $selectquery = " select * from assignment where batch='$batch' and semester='$sem' ORDER BY ID DESC";
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
                                              <label>
                                                (Previous: <?php echo $row['title'];?>)
                                              </label>
                                              <?php } ?>
                            </div>

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
                                                (Previous: <?php echo $row['sub'];?>)
                                              </label>
                                              <?php } ?>
                            </div>
                                                    </div>
                  
                    <div class="row">
                      <div class="input-field col s6 m6 l6">
                        <input type="text" id="textarea1" name="remark" value="<?php echo $row['remarks']?>" class="materialize-textarea">
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
                    $tname = $fname. " ".$lname;                       
                
                      ?>
                      <option value="<?php echo $id; ?>"><?php echo $tname; ?></option>
                  <?php } ?>
                </select>
                    <label>Select Teacher Name:</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12 m12 l12">
                      <textarea name="comment"  class="validate"  id="mytextarea" rows="2" cols="30">
                      <?php echo $row['comment'];?>    
                    </textarea>
                      
                      </div>
                    </div>  

                       
                      <input  class="waves-effect waves-light btn" type="submit" name="update" value="Update Assignment">
                </form>
                <?php
    }
}
?>

<?php
            if(isset($_GET['update_pdf'])){
            $id = $_GET['update_pdf'];
            $sql="select * FROM assignmentsubmit WHERE id=$id";
            $query=mysqli_query($conn,$sql);
              foreach($query as $row)
                {
        
          ?>
                <form name="myForms" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()" class="col s12"> 
                   <blockquote><h5 class="login-headtext">UPDATE YOUR FILE</h5></blockquote>  
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
          <input disabled value="<?php echo $row['pdf'];?>" id="disabled" type="text" class="validate">
          <label for="disabled">Recent File</label>
        </div>
    </div>
                   
                       
                      <input  class="waves-effect waves-light btn" type="submit" name="update_pdf" value="Update File">
                </form>
                <?php
    }
}
?>




</div>
<div class="col s12 m7 l7">

    <?php
    $id = $_SESSION['sid'];
    $selectquery = " select * from assignmentsubmit where student_id = $id ORDER BY ID DESC";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query); 
?>

    <h5 class="highlight"><b>My submited Assignments:</b></h5>
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
        echo '<p class="alert-msg">You donot have posted any assignment yet !</p>';
    }else{

    ?>
    
        <table class="responsive-table">
  <tr>
    <th>Semester</th>
    <th>Teacher</th>
    <th>Subject</th>
    <th>Title</th>
    <th>File</th>
    <th>Answer</th>
    <th>Action</th>
    
   
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
            <td><?php echo $tname;?></td>
            <td><?php echo $res['sub'];?></td>
            <td><?php echo $res['title']; ?> </td>
          
            <?php if ($res['pdf']){?>  
              <td class="empty"><?php echo $res['pdf']; ?> <a href="submitassignment_update.php?update_pdf=<?php echo $res['id'];?>">Change file</a> </td>
            <?php } else{ ?>
              <td><span class="empty">(No-file)<a href="submitassignment_update.php?update_pdf=<?php echo $res['id'];?>">Upload</a></span> </td>
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