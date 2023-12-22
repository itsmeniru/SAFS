<?php
include 'config.php';

?>

<div class="row">
    <div class="container">
        <p><a href="/safs/admin">Dashboard</a>> Teacher Access:</p>
        <hr>
        <div class="col s12 m12 l12">
            <div class="card"> 
            <?php
    $selectquery = " select * from teacher";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query); ?>
   

    <?php
    if ($num == 0) {
      echo '<p class="empty">No any teachers registered till now.</p>';
    } else{?>
    <h5 class="highlight"><i class="material-icons">dehaze</i> List of Teachers: </h5>
   <span class="num_date"> Number of Teachers: (<?php echo $num;?>) </span> 
   
    </span>
        <table class="responsive-table">
  <tr>
    <th>S.N</th>
    <th>Name</th>
    <th>Email</th>
    <th>Active On:</th>
    <th>Actions</th>
  </tr>
    <?php
    $selectquery = " select * from teacher";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query);
    while($res = mysqli_fetch_array($query)){
        $id = $res['id'];
        $fname = ucfirst($res['tfname']);
        $lname = ucfirst($res['tlname']);
        $email = $res['email'];
        $date = $res['registeredate'];
    echo "        
       
        <tr>
            <td>$id</td>
            <td>$fname
            $lname
        </td>
            
            <td>$email </td>
             <td>$date </td>
             <td>
              <a href='teacher_access_add.php?id=$id'>Permission access <i class='material-icons tiny'>link</i></a>
              
            </td>
            </tr>

          ";  
         

    }
    }    
?>
 </table>
                                    
            </div>
        </div>
       
    </div>
</div>

