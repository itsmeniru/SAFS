<?php
              $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

         ?>

<?php
include 'config.php';
session_start(); ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Search</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <?php  include 'includes/link.php';?>
    </head>
<style>
  span.highlight{
  background:#9E9E9E;
  padding:5px;
  color:#e8e6e6;
  }
  
h5.searchresult{
  
  padding:10px;
  border-left:2px solid #FF9800;
  border-bottom:4px solid #FF9800;
}

</style>
<body>
<?php  include 'includes/navigation.php' ?>


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

<div id="admis">
    <div class="container">
                                <?php
                                if (isset($_GET['query'])) {
                                    include 'config.php';
                                    if (isset($_SESSION['tid'])){
                                        $id = $_SESSION['tid'];
                                    
                                        $query = "SELECT * FROM assignmentsubmit  where teachername = '$id' ORDER BY ID DESC ,sub ";
                                        $result = mysqli_query($conn, $query);
                                        $data = array();
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        $data[] = $row;
                                                                                    }
                                        // Binary search function
                                        function binarySearch($arr, $target) {
                                          $low = 0;
                                            $high = count($arr) - 1;
                                            $results = array(); // Array to store multiple search results
                                            while ($low <= $high) {
                                            $mid = floor(($low + $high) / 2);
                                            if ($arr[$mid]['sub'] == $target) {
                                                $results[] = $mid;
                                                    // Continue searching in both directions for more occurrences
                                                $prev = $mid - 1;
                                                $next = $mid + 1;
                                                while ($prev >= 0 && $arr[$prev]['sub'] == $target) {
                                                $results[] = $prev;
                                                $prev--;
                                                                                                        }
                                                while ($next < count($arr) && $arr[$next]['sub'] == $target) {
                                                $results[] = $next;
                                                $next++;
                                                                                                                }
                                                return $results;
                                            } elseif ($arr[$mid]['sub'] < $target) {
                                                $low = $mid + 1;
                                            } else {
                                            $high = $mid - 1;
                                                    }
                                            }
                                            return $results; // Empty array if target value not found
                                        }
                                         // Get the user's search query
                                        $searchQuery = strtoupper($_GET['query']);
                                        // Perform binary search
                                        $resultIndices = binarySearch($data, $searchQuery); 
                                        if (!empty($resultIndices)) { ?>
                                            <h5 class="searchresult">Searched Result: <?php echo $searchQuery;?>
                                        </h5>
                                            <?php
                                            foreach ($resultIndices as $index) {
                                                $resultData = $data[$index];
                                                $id = $resultData['id'];
                                                $batch = $resultData['batch'];
                                                $sem = strtoupper($resultData['semester']);
                                                $faculty = $resultData['faculty'];
                                                $sub = $resultData['sub'];
                                                $comment = $resultData['comment'];
                                                $reg = $resultData['registeredate'];
                                               $studentid = $resultData['student_id'];
                                                $feedback = $resultData['feedback'];
                                                $number = $resultData['star'];
                                            ?>
        <div class="row">       
            <div class="col s12 m6 l6 car">
                <h5 class="header">#<Assignment:><?php echo $resultData['id']; ?>Assignment: <?php echo $resultData['title']; ?></h5>
                <div class="card horizontal">
                    <div class="card-stacked">
                        <p><span class="highlight"><?php echo $resultData['batch'];?> | <?php echo $resultData['faculty'];?> | <?php echo $resultData['semester'];?></span>
                        <span class="star">
                          <?php
                            if ($number >= 1 && $number <= 5) {
  for ($i = 1; $i <= $number; $i++) {
    echo '<i class=" material-icons star">star</i>
    ';
  }
} ?>
                         </span>   
                       <span class="deadline"><b><?php 
                         $sql = "select * from student where id='$studentid'";
                         $query1 = mysqli_query($conn,$sql);
                         while($res = mysqli_fetch_array($query1)){
                           $fname = $res['sfname'];
                           $lname = $res['slname'];
                           $name = $fname .' '.$lname; }
                        echo $name;
                        
                        ?></b></span></p>
                        <div class="card-content">
                            <p><b>Subject:</b> <?php echo "$sub"?></p>
                            <p><b>Teacher: </b><?php 
                              $id = $resultData['teachername'];
                              $sql = " select tfname,tlname from teacher where id = $id";
                              $query1 = mysqli_query($conn,$sql);
                              while($result = mysqli_fetch_array($query1)){
                                $fname=$result['tfname'];
                                $lname = $result['tlname'];
                                $tname = $fname. " ".$lname;
                                echo $tname;
                              }
                            ?></p>
                            <p><b>Received:</b> <?php echo $resultData['registeredate']; ?></p>
                               
                                <?php if ($resultData['pdf']){ ?>
                                <b><a class="box"href="pdf/<?php echo $resultData['pdf']; ?>" download >Download</a> </b>        
                                <?php } ?>
                                <?php if ($comment){  ?>                   
                                    <a href="#modal<?php echo $resultData['id']; ?>" class=" modal-trigger box"><b>Read</b></a> 
                                    <?php } ?>

                                    <div id="modal<?php echo $resultData['id']; ?>" class="modal">
                                <div class="modal-content text">
                                        <center>
                                          <h4><b>Assignment No: <?php echo $resultData['id']; ?></b></h4>
                                        </center>
                                        <p style="float:right"><b>Received On:</b> <?php echo $resultData['registeredate'];?> </p>
                                        
                                               To,<br><b><?php echo $tname;?></b>
                                        </h5> <hr> 
                                            <p><b>Answer:</b><?php echo $comment;?></p>
                                            <?php if ($resultData['remarks']){?>
                                <p class="remarks"><b>Remarks: </b> <?php echo $resultData['remarks']; ?></p>
                                <?php } else{?>
                                    <p class="remarks"><b>Remarks: </b> Null</p>
                                    <?php } ?>
                                </div>
                                <div class="modal-footer">
                                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Done</a>
                                </div>
                        </div>
                                                <?php 
                        if(!$feedback){
                                                  ?>
                                  
                                  <a href="#m<?php echo $resultData['id']; ?>" class=" modal-trigger right"><b>Give Feedback</b></a> 
                                    <div id="m<?php echo $resultData['id']; ?>" class="modal">
                                        <div class="modal-content text">
                                             <center>
                                                  <h4><b>Assignment No:<?php echo $resultData['id']; ?></b></h4>
                                         
                                                 </center>
                                                 <h5 class="highlight">Send Feedback</h5>
                                                <form name="myForms" method="POST" enctype="multipart/form-data" onsubmit="return validateForms()">
                                                    <input type="hidden" name="fid" value="<?php echo $resultData['id'];?>">
                                                    <div class="input-field">
                          
                                                        <i class="material-icons prefix">beenhere</i>
                                                        <input type="number" name="star"  min="1" max="5" maxlength="1">
                                                            <label>Give Star (1-5)</label>
      
                                                    </div>
                                                    <div class="input-field">
                                                        <i class="material-icons prefix">insert_comment</i>
                                                        <input id="text" type="text" name="ftext" class="validate">
                                                        <label for="email">Feedback</label>
                                                    </div>
                                                    <div class="input-field">
                                                        <button class="btn waves-effect orange" name="fsubmit" type="submit" >Send</button>
                                                        <button class="btn waves-effect orange" type="reset">Reset</button>
                                                    </div>         
                                                </form>
                                        </div>
                                        <div class="modal-footer">
                                          <a href="#!" class="modal-close waves-effect waves-green btn-flat"><b>Close</b></a>
                                        </div>
                                    </div>
                                 
                                  <?php }else{ ?>
           
                               
                                        <a href="#modal1<?php echo $resultData['id']; ?>" class=" modal-trigger right"><i class="material-icons checked">check_box</i> <b>Edit</b></a>         

                                    <div id="modal1<?php echo $resultData['id']; ?>" class="modal">
                                        <div class="modal-content text">
                                             <center>
                                                <h4><b>Assignment No:<?php echo $resultData['id']; ?></b></h4>
                                                </center>
                                            <h5 class="highlight">Update Feedback</h5>
                                            <form id="myForm" name="myForms" method="POST" enctype="multipart/form-data" onsubmit="return validateForms()">
                                                <input type="hidden" name="uid" value="<?php echo $resultData['id'];?>">
                                                <div class="input-field">
 
                                                    <i class="material-icons prefix">beenhere</i>
                                                        <input type="number" name="upstar" value="<?php echo $resultData['star'];?>"  min="1" max="5" maxlength="1">

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

   
   <?php }
         ?>





                       
                                    
                            
                            
                                   
                    </div>
                </div>
            </div>
        </div>
      
                                                                            <?php
                                                                                }
                                                                    }
                                        }   else{
                                            echo " <h5 class='searchresult'>Searched Result: $searchQuery</h5>
                                            <h5><center>Sorry, could not found your query, please try to search with another faculty name.</center></h5>
                                            ";
                                        }
                                    }

                                
                                     
                                    ?>


    </div>
    </div>
</body>
</html>
<?php
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
          window.location.href="<?php  $actual_link; ?>";
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
          window.location.href="<?php  $actual_link; ?>";
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