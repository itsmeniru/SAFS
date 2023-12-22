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
  .card-stacked{
    background-image: linear-gradient(to right, #ff98001c , #0000002e);

}
h5.searchresult{
  
  padding:10px;
  border-left:2px solid #FF9800;
  border-bottom:4px solid #FF9800;
}
i.checked{
  color:#4caf50d9;
}
span.remain{
  
  color:green;
  font-weight:bold;
}
span.warn{
    color:red;
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
        <div class="row">
            <div class="container">
                <?php
            if (isset($_GET['query'])) {
                include 'config.php';
                if (isset($_SESSION['sfname']) && isset($_SESSION['sid'])){
                    $sem = $_SESSION['semester'];
                    $batch = $_SESSION['batch'];
                    $fac = $_SESSION['faculty'];
        $query = "SELECT * FROM assignment where semester='$sem' AND faculty='$fac' ORDER BY sub";
        
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
        $searchQuery = $_GET['query'];

        // Perform binary search
        $resultIndices = binarySearch($data, $searchQuery); ?>
       
    
      <?php  if (!empty($resultIndices)) { ?>
        <p><a href="index.php">Home</a> > <a href="">Search:</a></p>
            <h5 class="searchresult">Searched Result: <?php echo $searchQuery;?></h5>
            <?php
            foreach ($resultIndices as $index) {
                $resultData = $data[$index];
                $id = $resultData['id'];
                $batch = $resultData['batch'];
                $sem = $resultData['semester'];
                $faculty = $resultData['faculty'];
                $comment = $resultData['comment'];
                $deadline = $resultData['deadline'];
               $teacherid = $resultData['teacher_id'];
                $initialDate = strtotime($resultData['registeredate']);
                $finalDate = strtotime($resultData['deadline']);
                // Get the current date
          $currentDate = time();
          $remainingTime = $finalDate - $currentDate;
          // Calculate the remaining days by comparing the final date with the current date
          $remainingDays = ceil($remainingTime / (60 * 60 * 24));
                
            
                ?>
                <div class="col s12 m6 l6">
                <h5 class="header">#<?php echo $id;?>Assignment: <?php echo $resultData['title'];; ?> </h5> 
                        <div class="card horizontal">
                            <div class="card-stacked">
                            <p><span class="highlight"><?php echo $resultData['batch'];?> | <?php echo $resultData['faculty'];?> | <?php echo $resultData['semester'];?></span>
                        <span class="deadline">
                        <?php          
        $sql = "select * from teacher where id='$teacherid'";
        $query1 = mysqli_query($conn,$sql);
        while($res = mysqli_fetch_array($query1)){
          $fname = $res['tfname'];
          $lname = $res['tlname'];
          $name = $fname .' '.$lname;
         }?>
         <b><?php echo $name;?></b>

                        </span></p> 
                        
                        <div class="card-content">
                                      <p> <b>Subject:</b> <?php echo $resultData['sub']; ?></p>
                   
                                         <p><b>Deadline:</b> <?php echo $resultData['deadline'];?> </p>
                                         <?php if ($remainingDays >0){ ?> 
                                            <span class=" remain deadline"> <b><?php echo $remainingDays ?> days more</b>  </span></p>
                                             
                               
                                         <?php if ($resultData['pdf']){ ?>
                                        <a class="box "href="pdf/<?php echo $resultData['pdf']; ?>" download ><b>Download</b></a>         
                                            <?php } ?>
                                                 
                                         <?php if ($resultData['comment']){  ?>                   
                                          <a  href="#modal<?php echo $resultData['id']; ?>" class=" modal-trigger box"><b>Read More</b></a> 
                                       
                                            <?php } ?>
                                          
                                            <?php
                                                 
                                                 } else{
                                              ?>
                        
                                                 <span class="warn"><b>No more deadline</b> </span>
                          <?php
                                    }
                                        ?>
                                         <?php 
                    if ($resultData['remarks']){ ?>
                    <p class="remarks"><b>Remarks:</b> <?php echo $resultData['remarks']; ?></p>
                  <?php } else{?>
                        <p class="remarks"><b>Remarks:</b> Null</p>
                    <?php }?>


                   
        </div>
        <div id="modal<?php echo $resultData['id']; ?>" class="modal">
    <div class="modal-content text">
<center>
        <h4><b>Assignment No:<?php echo $id; ?></b></h4>
                      </center>
                      <p style="float:right"><b>Date:</b> <?php echo $resultData['registeredate'];?> </p>
                      <h5> <?php echo $resultData['title'];?> <br>
                      <?php echo $resultData['sub'];?><br>
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
   <?php } } else { 
             echo " 
             <p><a href='index.php'>Home</a> > <a href=''>Search:</a></p>
             <h5 class='searchresult'>Searched Result: $searchQuery</h5>
             <h5><center>Sorry, could not found your query, please try another subject name.</center></h5>
             ";
          }
        } 
         ?>

            </div>
        </div>
    </div>
   <?php } ?>
    </body>
</html>