<?php
include 'config.php';
?>
<style>
  
span.highlight{
  background:#9E9E9E;
  padding:5px;
  color:#e8e6e6;
  }
  .card-stacked{
    background-image: linear-gradient(to right, white , #ffc10769);
}
h5.searchresult{
  
  padding:10px;
  border-left:2px solid #FF9800;
  border-bottom:4px solid #FF9800;
}
i.checked{
  color:#4caf50d9;
}
</style>

<?php
  if(isset($_POST['fsubmit'])){
    $id = $_POST['fid'];    
    $ftext = $_POST['ftext'];
  
  $sql="UPDATE `assignmentsubmit` SET `feedback`='$ftext' WHERE id=$id";
  $query=mysqli_query($conn,$sql);
  if($query){
      ?>
      <script>
          alert("Feedback Submited");
          window.location.href="../SAFS/assignment_view.php";
          </script>

          <?php
  }else{
      ?>
      <script>
      alert("Feedback Failed");
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
<style>
  h4.light{
  padding:10px;
  border-bottom:3px solid #FF9800;
  border-left:1px solid #FF9800;
}
</style>


<div id="admis">
  <div class="container">

          <?php
            if (isset($_SESSION['tfname']) && isset($_SESSION['tlname'])){ ?>
              <h4 class="light">Your have received Assignments:</h4>
                <?php
            } ?>


 
     <?php
        if (isset($_SESSION['tfname']) && isset($_SESSION['tlname'])){
        $fname = $_SESSION['tfname'];
        $lname = $_SESSION['tlname'];
      
        $result = $fname . " " . $lname;
        $selectquery = " select * from assignmentsubmit where teachername = '$result' ORDER BY ID DESC";
        $query = mysqli_query($conn,$selectquery);
        $num = mysqli_num_rows($query); ?>
        <h6> <a href="/safs"><b>Home</b></a> > <b>Assignment Received From Students:</b> (<?php echo $num ?>)
        <?php
        $sql = "SELECT MAX(registeredate) AS latest_date FROM assignmentsubmit";
        $results = mysqli_query($conn,$sql);
        if ($results) {
                        $row = $results->fetch_assoc();
                        $latestDate = $row['latest_date'];
                        if($latestDate){
     
                          echo  "| <b>Last Received:</b>" .$latestDate;
                                      }
                      } else {
        echo $conn->error;
          }
        


    if($num ==0){
      echo '<p class="alert-msg">No any Assignment Received till now !</p>';
  }else{

    while($res = mysqli_fetch_array($query)){
      $sfname= strtoupper($res['student_fname']);
      $lname = strtoupper($res['student_lname']);
      $sub = $res['sub'];
      $comment = $res['comment'];
      $teacher = $res['teachername'];
      $feedback = $res['feedback'];
?>
  
<div class="row">       
      <div class="col s12 m6 l6 car">
          <h5 class="header">#<Assignment:><?php echo $res['id']; ?>Assignment: <?php echo $res['title']; ?></h5>
          <div class="card horizontal">
              <div class="card-stacked">
                  <p><span class="highlight"><?php echo $res['batch'];?> | <?php echo $res['faculty'];?> | <?php echo $res['semester'];?></span>
                  <span class="deadline"><b><?php echo "$sfname $lname" ?></span></b></p>
                  <div class="card-content">
                  
                     <p><b>Subject:</b> <?php echo "$sub"?></p>
                    <p><b>Teacher:</b> <?php echo $teacher;?></p>
                    <p><b>Received:</b> <?php echo $res['registeredate']; ?></p>
                        <?php if ($res['remarks']){?>
                            <p class="remarks"><b>Remarks:</b>  <?php echo $res['remarks']; ?></p>
                        <?php } ?>
                        <?php if ($res['pdf']){ ?>
                            <a href="pdf/<?php echo $res['pdf']; ?>" download ><b>Download Assignment</b></a>         
                        <?php } ?> <br>
                          <?php if ($comment){  ?>                   
                             <a href="#modal<?php echo $res['id']; ?>" class=" modal-trigger"><b>Read Text Assignment</b></a> 
                            <div id="modal<?php echo $res['id']; ?>" class="modal">
                                <div class="modal-content text">
                                  <center>
                                      <h4><b>Assignment No:<?php echo $res['id']; ?></b></h4>
                                  </center>
                                    <p style="float:right"><b>Date of Assignment: <?php echo $res['registeredate'];?></b> </p>
                                      <h5><b>Title:</b> <?php echo $res['title'];;?> <br>
                                          <b>Subject:</b> <?php echo $res['sub'];?><br>
                                               <b><?php echo strtoupper($teacher) ?></b>
                                        </h5> <hr> 
                                            <p><?php echo $comment;?></p>
                                  </div>
                                    <div class="modal-footer">
                                        <a href="#!" class="modal-close waves-effect waves-green btn-flat"><b>Close</b></a>
                                    </div>
                              </div>
                            
                              <?php } ?>
                            <?php
                                  if(!$feedback){
                                                  ?>
                                <form name="myForms" method="POST" enctype="multipart/form-data" onsubmit="return validateForms()">
                                    <div class="row">
                                            <div class="col s12 l8">
                                              <input type="hidden" name="fid" value="<?php echo $res['id'];?>">
                                             </div>
                                          <div class="col s12 l8">
                                                  <input type="text" name="ftext" placeholder="Send Feedback">
                                                </div>
                  <div class="col s12 l4">
               <input  class="waves-effect waves-light btn" type="submit" name="fsubmit" value="Feedback">
              </div>
          </div>
         
          </form>
          <?php } else{ ?>
            
            <p class="feedback_submit"> <i class="material-icons checked">check_box</i><b>Feedback Submitted -</b> <a href="assignmentview_update.php?update=<?php echo $res['id'];?>"><i class="material-icons create">create</i></a>         
                                      </div>
               
              
           <?php }
               ?>
      </div>
      </div>
    </div>
      
<?php
    }
  }
}
?>


    </div>
    </div>
