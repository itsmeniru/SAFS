<?php
include 'config.php';


if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql="DELETE FROM assignmentsubmit WHERE id=$id";
    $query=mysqli_query($conn,$sql);
      if($query){
          ?>
          <script>
              alert("Data has been deleted");
              window.location.href="http://localhost/safs/admin/submittedassignment.php";
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
<p><a href="/safs/admin">Dashboard</a>> Assignment Record:</p>
    <hr>
<div class="col s12 l12">

<?php
    $selectquery = " select * from assignmentsubmit";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query); ?>
   

    <?php
    if ($num == 0) {
      echo '<p class="empty">No any assignment submitted by students right now</p>';
    } else{?>
    <h5 class="highlight"><i class="material-icons">dehaze</i> Received from Students </h5>
   <span class="num_date"> Number of Assignments: (<?php echo $num;?>) </span> 
    <span class="num_date">Last Updated:
    <?php
    $sql = "SELECT MAX(registeredate) AS latest_date FROM assignmentsubmit";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$latestDate = $row['latest_date'];
echo $latestDate;
?>
    </span>
      
    <?php
    $selectquery = " select * from assignmentsubmit order by id desc";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query);
    if ($num = 0){ ?>
        <p>No any submitted Assignment</p>
    <?php }else{ ?>
        <table class="responsive-table">
        <tr>
          
          <th>Sent From</th>
          <th>Sent To</th>
          <th>Subject</th>
          <th>Batch</th>
          <th>Semester</th>
          <th>Faculty</th>
          <th>Title</th>
          <th>File</th>
          <th>Question</th>
          
          <th>Date</th>
          <th>Remove</th>
        </tr>
        <?php 
    while($res = mysqli_fetch_array($query)){

     
      
        $question = $res['comment'];
        $remarks = $res['remarks'];
        $remark = substr($remarks, 0, 20);
        $id = $res['teachername'];
        $sql = " select tfname,tlname from teacher where id='$id'";
        $queries = mysqli_query($conn,$sql);
        while($result = mysqli_fetch_array($queries)){
            $fname = $result['tfname'];
            $lname = $result['tlname'];
            $name = $fname. " ".$lname;

        }
        ?>
       
        <tr>
        <td><?php
             $id=$res['student_id'];
             $select = " select * from student where id='$id'";
             $querys = mysqli_query($conn,$select);
             while($result = mysqli_fetch_array($querys)){
              $fname = $result['sfname'];
              $lname= $result['slname'];
              $sname= $fname." ".$lname;
             }?>
             <?php echo $sname;?>
             </td>
            <td><?php echo $name; ?> </td>
            <td><?php echo $res['sub']; ?> </td>
            <td><?php echo $res['batch']; ?> </td>
            <td><?php echo $res['semester']; ?> </td>
            <td><?php echo $res['faculty']; ?> </td>
            <td><?php echo $res['title']; ?> </td>
            <td><?php if ($res['pdf']){?>
            <?php echo $res['pdf']; ?>
              <?php }else{?>
                <span class="file">-----</span>
                <?php }?>
              </td>

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
                                         
                                               <b><?php echo $name; ?></b>
                                        </h5> <hr> 
                                            <p><?php echo $question;?></p>
                                  </div>
                                    <div class="modal-footer">
                                        <a href="#!" class="modal-close waves-effect waves-green btn-flat"><b>Close</b></a>
                                    </div>
                              </div>




             
            <td><?php echo $res['registeredate']; ?> </td>
            <td>
              <a href="submittedassignment.php?delete=<?php echo $res['id'];?>"><i class="material-icons">delete</i></a>
            </td>
<?php
    }
    }
  }
?>
    </div>
    </div>
    </div>
