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


// Count total number of records
$query = "SELECT COUNT(*) as total FROM assignment";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$totalRecords = $row['total'];

$recordsPerPage = 4; // Number of records to display per page
$totalPages = ceil($totalRecords / $recordsPerPage);

$currentpage = isset($_GET['page']) ? $_GET['page'] : 1;

$startFrom = ($currentpage - 1) * $recordsPerPage;


?>

<div id="admis">
<div class="container">
<h6> <a href="/safs">Home</a> > View Assignment:


<div class="pagination right">
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <a <?php if ($i == $currentpage) echo 'class="active"'; ?> href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>

</h6>

<div class="row">


    <?php
      if (isset($_SESSION['sfname']) && isset($_SESSION['sid'])){
        $sem = $_SESSION['semester'];
        $faculty = $_SESSION['faculty'];
        $selectquery = "SELECT * FROM `assignment` WHERE semester='$sem' AND faculty='$faculty' ORDER BY ID DESC LIMIT $startFrom, $recordsPerPage";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query);

    if($num ==0){
      echo '<p class="alert-msg">No any Assignment Found !</p>';
  }else{

    while($result = mysqli_fetch_array($query)){
      $batch = $result['batch'];                
      $id = $result['id'];
      $title = $result['title'];
      
      $teacherid = $result['teacher_id'];
      $comment = $result['comment'];
      $faculty=$result['faculty'];
      $initialDate = strtotime($result['registeredate']);
      $finalDate = strtotime($result['deadline']);
      // Get the current date
$currentDate = time();
$remainingTime = $finalDate - $currentDate;
// Calculate the remaining days by comparing the final date with the current date
$remainingDays = ceil($remainingTime / (60 * 60 * 24));
      ?>
        
      <div class="col s12 m6 l6 car">
        
      <h5 class="header">#<?php echo $id;?>Assignment: <?php echo $title; ?> </h5> 
    

    <div class="card horizontal">
     
      <div class="card-stacked">
      <p><span class="highlight"> <?php echo "$batch | $sem | $faculty" ?></span>
      <?php 
         
        $sql = "select * from teacher where id='$teacherid'";
        $query1 = mysqli_query($conn,$sql);
        while($res = mysqli_fetch_array($query1)){
          $fname = $res['tfname'];
          $lname = $res['tlname'];
          $name = $fname .' '.$lname;
         
        }
        ?>
      <span class="right">
      <b><?php echo $name;?></b> 
      </span> </p>
                      
      <div class="card-content">
                                      <p> <b>Subject:</b> <?php echo $result['sub']; ?></p>
                   
                                         <p><b>Deadline:</b> <?php echo $result['deadline'];?> </p>
                                         <?php if ($remainingDays >0){ ?> 
                                            <span class=" remain deadline"> <b><?php echo $remainingDays ?> days more</b>  </span></p>
                                             
                               
                                         <?php if ($result['pdf']){ ?>
                                        <a class="box "href="pdf/<?php echo $result['pdf']; ?>" download ><b>Download</b></a>         
                                            <?php } ?>
                                                 
                                         <?php if ($result['comment']){  ?>                   
                                          <a  href="#modal<?php echo $result['id']; ?>" class=" modal-trigger box"><b>Read More</b></a> 
                                       
                                            <?php } ?>
                                          
                                            <?php
                                                 
                                                 } else{
                                              ?>
                        
                                                 <span class="warn"><b>No more deadline</b> </span>
                          <?php
                                    }
                                        ?>
                                         <?php 
                    if ($result['remarks']){ ?>
                    <p class="remarks"><b>Remarks:</b> <?php echo $result['remarks']; ?></p>
                  <?php } else{?>
                        <p class="remarks"><b>Remarks:</b> Null</p>
                    <?php }?>


                   
        </div>
        <div id="modal<?php echo $result['id']; ?>" class="modal">
    <div class="modal-content text">
<center>
        <h4><b>Assignment No:<?php echo $id; ?></b></h4>
                      </center>
                      <p style="float:right"><b>Date:</b> <?php echo $result['registeredate'];?> </p>
                      <h5> <?php echo $title;?> <br>
                      <?php echo $result['sub'];?><br>
                       <b><?php echo $name;?></b>
                     
                    </h5>
                    
                    
                    <hr> 
                    <p><?php echo $comment;?></p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-orange btn-flat">Done</a>
    </div>
</div>
       
 
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
    </div>
    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    
      <script>
        $(document).ready(function(){
            $('.modal').modal();
        });
    </script>
    <style>

  .card-content {
    transform: rotate(360deg);
    
    background-image: linear-gradient(-1deg, rgb(255 193 7 / 15%) 0px, rgb(53 144 131 / 0%) 100%);
    
  }
    .card .card-action:last-child {

    border-top: none;
    }
    span.warn{
            color : red;
        
          }
    span.remain{
            
            color:green;
          }
        .pagination{
         

        }  
        .pagination a {
            display: inline-block;
            padding: 8px 16px;
            text-decoration: none;
              color: black;
            font-size:11px;
        }
        .pagination a.active {
            background-color: orange;
            color: white;
        }
        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
</style>