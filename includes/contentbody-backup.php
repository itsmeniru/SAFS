<?php
include 'config.php';
?>
<div class="content">
  
<div class="row">
  <?php
      $selectquery = " select * from assignment  ORDER BY ID DESC limit 5";  
      $query = mysqli_query($conn,$selectquery);
      $num = mysqli_num_rows($query);

    if($num ==0){
      echo '<p class="alert-msg">No any Assignment Found !</p>';
  }else{

    while($res = mysqli_fetch_array($query)){
      $fname = $res['teacher_fname'];
      $lname = $res['teacher_lname'];
      $initialDate = strtotime($res['registeredate']);
      $finalDate = strtotime($res['deadline']);
      // Get the current date
$currentDate = time();
$remainingTime = $finalDate - $currentDate;
// Calculate the remaining days by comparing the final date with the current date
$remainingDays = ceil($remainingTime / (60 * 60 * 24));

// Check if there is exactly one day remaining or more

    
        ?>
        <style>
          span.warn{
            color : white;
            background-color:red;
            padding:10px;
          }
          span.remain{
            background-color:green;
            padding:10px;
            color:white;
          }
        </style>
      <div class="col s12 m6 l6 car">
        
    <h5 class="header">#<Assignment:><?php echo $res['id']; ?>Assignment: <?php echo $res['title']; ?></h5>
    

    <div class="card horizontal">
     
      <div class="card-stacked">
      <p><span class="posted">Posted on: <?php echo $res['registeredate']; ?> </span>
       <span class="deadline">Deadline: <?php echo $res['deadline'];?> </span></p>
        
        <div class="card-content">
        <p> Subject: <?php echo $res['sub']; ?></p>
        <p>Teacher Name: <?php echo " $fname $lname " ?>
          <p class="remarks">Remarks:  <?php echo $res['remarks']; ?></p>
          
       
        </p>

        </div>
        <div class="card-action">
         <?php
         if ($remainingDays >0){
         
        if(isset($_SESSION['tfname']) OR isset($_SESSION['sfname'])){ ?>
        Get Assignment: <a href="pdf/<?php echo $res['pdf']; ?>" download >Download Assignment</a>
        <span class="remain">  <?php echo $remainingDays; ?> Day left</span>
<?php }
         }
         else{
          ?>
          <span class="warn">Sorry, Deadline end </span>
          <?php
         }
         ?>

        </div>
      </div>
    </div>
  </div>  
    
<?php
    }
  }
?>

 
</div>
</div>
