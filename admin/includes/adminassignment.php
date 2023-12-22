<?php
include 'config.php';


if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql="DELETE FROM assignment WHERE id=$id";
    $query=mysqli_query($conn,$sql);
      if($query){
          ?>
          <script>
              alert("Data has been deleted");
              window.location.href="http://localhost/safs/admin/assignment.php";
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
<div class="row">
<div class="container">
<p><a href="/safs/admin">Dashboard</a>> Assignment Record:</p><hr>

<div class="col s12 l12">

  
<?php
    $selectquery = " select * from assignment";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query); ?>
   

    <?php
    if ($num == 0) {
      echo '<p class="empty">No any teachers added assignment till now</p>';
    } else{?>
    <h5 class="highlight"><i class="material-icons">dehaze</i> List of Assignments 
    


  
  </h5>
   <span class="num_date"> Number of Assignments: (<?php echo $num;?>) </span> 
    <span class="num_date">Last Updated:
    <?php
    $sql = "SELECT MAX(registeredate) AS latest_date FROM assignment";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$latestDate = $row['latest_date'];
echo $latestDate;
?>
    </span>
        <table class="responsive-table">
  <tr>
    <th>Teacher Name</th>
    <th>Faculty</th>
    <th>Semester</th>
    <th>Batch</th>
    <th>Title</th>
    <th>Subject</th>
    <th>Questions</th>
    <th>Files</th>
    <th>Deadline</th>
    <th>Status</th>
    <th>Posted on:</th>
    <th>Remove</th>
  </tr>
    <?php
    $selectquery = " select * from assignment";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query);
    while($res = mysqli_fetch_array($query)){
       
        $faculty = $res['faculty'];
        $semester = $res['semester'];
        $batch = $res['batch'];
        $title = $res['title'];
        $subject = $res['sub'];
        $question = $res['comment'];
        $file = $res['pdf'];
        $deadline = $res['deadline'];
        $poston = $res['registeredate'];


        $finalDate = strtotime($res['deadline']);
        // Get the current date
  $currentDate = time();
  $remainingTime = $finalDate - $currentDate;
  // Calculate the remaining days by comparing the final date with the current date
  $remainingDays = ceil($remainingTime / (60 * 60 * 24));

        ?>
       
        <tr>
            <td><?php
             $id=$res['teacher_id'];
             $select = " select tfname,tlname from teacher where id='$id'";
             $querys = mysqli_query($conn,$select);
             while($result = mysqli_fetch_array($querys)){
              $fname = $result['tfname'];
              $lname= $result['tlname'];
              $tname= $fname." ".$lname;
             }?>
             <?php echo $tname;?>
             </td>

            <td><?php echo $faculty;?> </td>
           <td><?php echo $semester ;?></td>
           <td><?php echo $batch; ?></td>
            <td><?php echo $title ?> </td>
            <td><?php echo $subject; ?> </td>
            
            <td>
                                                    <?php if ($question){?>
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
                                         
                                      <b><?php
             $id=$res['teacher_id'];
             $select = " select tfname,tlname from teacher where id='$id'";
             $querys = mysqli_query($conn,$select);
             while($result = mysqli_fetch_array($querys)){
              $fname = $result['tfname'];
              $lname= $result['tlname'];
              $tname= $fname." ".$lname;
             }?>
             <?php echo $tname;?>
            </b>
                                        </h5> <hr> 
                                            <p><?php echo $question;?></p>
                                  </div>
                                    <div class="modal-footer">
                                        <a href="#!" class="modal-close waves-effect waves-green btn-flat"><b>Close</b></a>
                                    </div>
                              </div>



            <td>
            <?php if ($file){ ?>
              <a class="box "href="../pdf/<?php echo $res['pdf']; ?>" download ><b>Download file</b></a>         
                                      
            <?php } else{?>
                <span class="file">----</span>
              <?php } ?>
          
          </td>


            <td><?php echo $deadline;?></td>
            <td>
            <?php if ($remainingDays > 0){?>
            <span class="remain"><?php echo $remainingDays;?> days left</span>
            <?php }else{ ?>
              <span class="end"> Deadline ended</span>
              <?php }?>
              </td>
            <td><?php echo $poston; ?> </td>
            <td>
             
              <a href="assignment.php?delete=<?php echo $res['id'];?>"><i class="material-icons">delete</i></a>
            </td>
<?php

    }}
?>
    </div>
    </div>
    </div>

    <script>
       $(document).ready(function(){
    $('select').formSelect();
  });
    </script>