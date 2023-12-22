<?php
include 'config.php';
?>

<?php
 $id = $_SESSION['tid'];
// Count total number of records
$query = "SELECT COUNT(*) as total FROM assignmentsubmit where teachername = $id and feedback <> ''";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$totalRecords = $row['total'];

$recordsPerPage = 4; // Number of records to display per page
$totalPages = ceil($totalRecords / $recordsPerPage);

$currentpage = isset($_GET['page']) ? $_GET['page'] : 1;

$startFrom = ($currentpage - 1) * $recordsPerPage;



  if(isset($_POST['fsubmit'])){
    $id = $_POST['fid'];    
    $ftext = $_POST['ftext'];
    $star = $_POST['star'];
    date_default_timezone_set('Asia/Kathmandu');
    $date = date('Y-m-d H:i:s');
  
  $sql="UPDATE `assignmentsubmit` SET `feedback`='$ftext',`star`='$star',`feedbackdate`='$date'WHERE id=$id";
  $query=mysqli_query($conn,$sql);
  if($query){
      ?>
      <script>
          alert("Feedback Submited");
          window.location.href="../SAFS/feedback.php";
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
        if (isset($_SESSION['tfname']) && isset($_SESSION['tlname'])){
          $id = $_SESSION['tid'];
        $fname = $_SESSION['tfname'];
        $lname = $_SESSION['tlname'];
      
        $result = $fname . " " . $lname;
        $selectquery = " select * from assignmentsubmit where teachername = '$id' AND feedback <> '' ORDER BY ID DESC LIMIT $startFrom, $recordsPerPage";
        $query = mysqli_query($conn,$selectquery);
        $num = mysqli_num_rows($query); ?>
          <h4 class="light">Feedback on Assignment:
          </h4>
        <h6> <a href="/safs"><b>Home</b></a> > <b>Your feedback on assignments:</b>
        <span class="pagination right">
        
        <?php
        
        for ($i = 1; $i <= $totalPages; $i++) : ?>
            <a <?php if ($i == $currentpage) echo 'class="active"'; ?> href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </span>
      </h6>
        <?php
        $sql = "SELECT MAX(registeredate) AS latest_date FROM assignmentsubmit where  id=$id";
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
                echo '<p class="alert-msg"> No more feedback left</p>';
              
                }else{

                      while($res = mysqli_fetch_array($query)){
                    
                    $sub = $res['sub'];
                    $number = $res['star'];
                                                $comment = $res['comment'];
                    $teacher = $res['teachername'];
                                                                            $feedback = $res['feedback'];
                        ?>
  
                         



                  <div class="row">       
                    <div class="col s12 m6 l6">
                      <h5 class="header">#<Assignment:><?php echo $res['id']; ?>Assignment: <?php echo $res['title']; ?></h5>
                      <div class="card horizontal">
                        <div class="card-stacked">
                          <p><span class="highlight"><?php echo $res['batch'];?> | <?php echo $res['faculty'];?> | <?php echo $res['semester'];?></span>
                         <span class="star">
                          <?php
                            if ($number >= 1 && $number <= 5) {
  for ($i = 1; $i <= $number; $i++) {
    echo '<i class=" material-icons star">star</i>
    ';
  }
} ?>
                         </span>
                          <span class="deadline"><b>

                          <?php 
                            $id=  $res['student_id'];

                              $sql = " select * from student where id = '$id'";
        $qry = mysqli_query($conn,$sql);
        while ($result = mysqli_fetch_array($qry)){
          $fname = $result['sfname'];
          $lname = $result['slname'];
          $name = $fname.' '.$lname;
          echo $name;
        }  ?>
                          </b></span></p>
                            <div class="card-content">
                  
                              <p><b>Subject:</b> <?php echo "$sub"?></p>
    <?php
                              $id = $res['teachername'];
        $sql = " select tfname,tlname from teacher where id = $id";
        $query1 = mysqli_query($conn,$sql);
        while($result = mysqli_fetch_array($query1)){
          $fname=$result['tfname'];
          $lname = $result['tlname'];
          $tname = $fname. " ".$lname;
        }
        ?>
                               <p><b>Teacher:</b> <?php echo $tname;?></p>
                              

                               <p><b>Received:</b> <?php echo $res['registeredate']; ?></p>
                                
                                       <?php if ($res['pdf']){ ?>
                                      <a class="box "href="pdf/<?php echo $res['pdf']; ?>" download ><b>Download</b></a>         
                                         <?php } ?>
                                       <?php if ($comment){  ?>                   
                                     <a  href="#modal<?php echo $res['id']; ?>" class=" modal-trigger box"><b>Read More</b></a> 
                                        <div id="modal<?php echo $res['id']; ?>" class="modal">
                                              <div class="modal-content text">
                                             <center>
                                                  <h4><b>Assignment No:<?php echo $res['id']; ?></b></h4>
                                              </center>
                                                     <p style="float:right"><b>Received On: <?php echo $res['registeredate'];?></b> </p>
                                                   <h5>
                                                    <?php
                              $id = $res['teachername'];
        $sql = " select tfname,tlname from teacher where id = $id";
        $query1 = mysqli_query($conn,$sql);
        while($result = mysqli_fetch_array($query1)){
          $fname=$result['tfname'];
          $lname = $result['tlname'];
          $tname = $fname. " ".$lname;
        }
        ?>
                                                      <b>To <br><?php echo $tname; ?></b>
                                                  </h5> <hr> 
                                                      <p><b>Answer:</b><?php echo $comment;?></p>

                                                      <?php if ($res['remarks']){?>
                                                            <b>Remarks:</b> <?php echo $res['remarks'];?>
                                                        <?php }?>
                                                </div>
                                                    <div class="modal-footer">
                                                    <a href="#!" class="modal-close waves-effect waves-green btn-flat"><b>Close</b></a>
                                                     </div>
                                        </div>
                            
                                       <?php } ?>
                                        <?php
                                  if(!$feedback){
                                                  ?>
                                  <a href="#m<?php echo $res['id']; ?>" class=" modal-trigger right"><b>Give Feedback</b></a> 
                                  <div id="m<?php echo $res['id']; ?>" class="modal">
                                        <div class="modal-content text">
                                          <center>
                                         <h4><b>Assignment No:<?php echo $res['id']; ?></b></h4>
                                         
                                          </center>
                                          <h5 class="highlight">Send Feedback</h5>
                                          <form name="myForms" method="POST" enctype="multipart/form-data" onsubmit="return validateForms()">
                                              <input type="hidden" name="fid" value="<?php echo $res['id'];?>">
                                              <div class="input-field">
                          
                                                 <i class="material-icons prefix">beenhere</i>
                                                  <input type="number" name="star" placeholder="Number between 1-5" min="1" max="5" maxlength="1">
                                               <label>Give Star</label>
      
                                                       </div>
                                              <div class="input-field">
                                                <i class="material-icons prefix">insert_comment</i>
                                                <input id="text" type="text" name="ftext" class="validate">
                                                <label for="email">Feedback</label>
                                              </div>
                                              <div class="input-field">
                                                <button class="btn waves-effect orange" name="fsubmit" type="submit" >Send</button>
                                             
                                              </div>         
                                          </form>
                                        </div>
                                        <div class="modal-footer">
                                          <a href="#!" class="modal-close waves-effect waves-green btn-flat"><b>Close</b></a>
                                        </div>
                                  </div>
                                  </div>
                                  <?php } else{ ?>
           
                               
                                    <a href="#modal1<?php echo $res['id']; ?>" class=" modal-trigger right"><i class="material-icons checked">check_box</i> <b>Edit</b></a>         
                       
                                    <div id="modal1<?php echo $res['id']; ?>" class="modal">
                                        <div class="modal-content text">
                                          <center>
                                          <h4><b>Assignment No:<?php echo $res['id']; ?></b></h4>
                                           </center>
                                           <h5 class="highlight">Update Feedback</h5>
                                              <form id="myForm" name="myForms" method="POST" enctype="multipart/form-data" onsubmit="return validateForms()">
                                                   <input type="hidden" name="uid" value="<?php echo $res['id'];?>">
                                                   <div class="input-field">
                          
                          <i class="material-icons prefix">beenhere</i>
                           <input type="number" name="upstar" value="<?php echo $res['star'];?>"  min="1" max="5" maxlength="1">
                
                                      <label>Select Star</label>

                                </div>
                                                <div class="input-field">
                                                  <i class="material-icons prefix">insert_comment</i>
                                                   <input type="text" name="ftext" value="<?php echo $feedback;?>" placeholder="update Feedback">
                                                   <label for="text">Feedback</label>
                                                       </div>

                                                    <div class="input-field">
               
                                                    <input  class="waves-effect waves-light btn" type="submit" name="update">
                                                    </div>  
                                  
                                              </form>
                                        </div>
                                          <div class="modal-footer">
                                             <a href="#!" class="modal-close waves-effect waves-green btn-flat"><b>Close</b></a>
                                          </div>
                                    </div>
    
                            </div>
                            <?php }
                                  ?>
                        </div>
                      </div>
                    </div>
                        <?php }}}?>
                  </div>

                  


    </div>
    
    

                                  </div>
                               


    <?php
  if(isset($_POST['update'])){
    $id = $_POST['uid'];    
    $ftext = $_POST['ftext'];
    $upstar = $_POST['upstar'];
    date_default_timezone_set('Asia/Kathmandu');
    $date = date('Y-m-d H:i:s');

  $sql="UPDATE `assignmentsubmit` SET `feedback`='$ftext',`star`='$upstar',`feedbackdate`='$date' WHERE id=$id";
  $query=mysqli_query($conn,$sql);
  if($query){
      ?>
      <script>
          alert("Feedback Submited");
          window.location.href="../SAFS/feedback.php";
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
<script>
    $(document).ready(function(){
    $('.modals').modal();
  });
</script>
<style>
   .pagination{
         
        }  
        .pagination a {
            display: inline-block;
            padding: 8px 16px;
            text-decoration: none;
            color: black;
            
        }
        .pagination a.active {
            background-color: orange;
            color: white;
        }
        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
</style>