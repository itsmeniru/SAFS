<script>
    function validateForms() {
 
  let p = document.forms["form"]["denied"].value;
  if (p == "") {
    alert("please add subject:");
    return false;
  }


}
</script>


<?php
include 'config.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "select * from access_faculty where teacher_id = $id";
    $query = mysqli_query($conn,$sql);
     ?>
    <div class="row">
        <div class="container">

            <div class="col s12 m5 l6">

                <div class="card">
                    <div class="container">
                    <?php
                        while($res=mysqli_fetch_array($query)){ 
                        
                        $subject = ucfirst($res['faculty']);
                    ?>
                           
                                                    <?php } ?>
                                                   
                                                   
                                        <form name="myForms"  onsubmit="return validateForm()"  method="POST">
                                            
                                                <blockquote><h5 class="login-headtext">Choose Faculty</h5></blockquote>   
                                                <div class="row">
                                                <div class="input-field col s12 m10 l10"> 
         
                                                    <i class="material-icons prefix">av_timer</i>                                               <input id="text" type="hidden" value="<?php echo $id;?>"name="teacherid" class="validate">
                                                        <select multiple name="fac[]">
                                                        <option value="" disabled selected>Select</option>
                                            <?php
                                            $selectquery = " select * from facultylist";
                                            $query = mysqli_query($conn,$selectquery);
                                            while($res = mysqli_fetch_array($query)){
                                            
                                            $faculty = $res['faculty'];          
                                            ?>
                                            <option value="<?php echo $faculty; ?>"><?php echo $faculty; ?></option>
                                            <?php } ?>
                                                        </select>
                                                        <label>Faculty</label>
                                                    </div>
                                                    </div>
                                                    
                                                    <button class="btn waves-effect orange" type="submit" name="set_faculty">Set Permission</button>                               
                        
                                                </form>
                          
                        </div>                  </div>
            </div> 

            <div class="col s12 m6 l6">

                <div class="card">
                    <form  name="form" onsubmit="return validateForms()" method="POST">
                    <blockquote><h5 class="login-headtext">Select to denied faculty</h5></blockquote>
                          
                        <?php
                        $sq = " select * from access_faculty where teacher_id=$id";
                        $q = mysqli_query($conn,$sq); 
                        $numRows = mysqli_num_rows($q);
                        if ($numRows == 0) {
                        $displayNone = 'style="display: none;"';
                        } else {
                        $displayNone = '';
                        } ?>
                        <table class="striped responsive-table centered highlight">
                            <thead bgcolor="#fafafa" <?php echo $displayNone; ?>>
                                <tr>
                                <th>Faculty</th>
                                <th>
                                <button class="btn waves-effect orange" type="submit" name="denied">Denied</button>
                                </th>
                                </tr>
                        
                            </thead>
                                <tbody>
                                    <?php
                                    if(mysqli_num_rows($q) > 0){
                                        foreach($q as $row){ ?>
                                        <input type="hidden" name="tid" value="<?php echo $id;?>">
                                        <tr>
                                        <td><?php echo $row['faculty'];?></td>
                                        <td>
                                            <p><label>
                                                <input type="checkbox"  name="delete_faculty[]" value="<?php echo $row['id']?>">
                                                <span></span>
                                                </label>
                                            </p>
                                        </td>
                                        </tr>
                                        <?php }} else{ ?>
                                        <tr><td colspan="5">No Permission yet !</td></tr>
                                    <?php } ?>
                                </tbody>
                        </table>
                    </form>
            </div>
                             
        </div>
    </div>
            <?php
                                            
                        }
?>
<style>
    span>i{
    vertical-align: middle;
        color:#ff980094;
    
}
</style>
<script>
     $(document).ready(function(){
    $('select').formSelect();
    $('.modal').modal();
  });
</script>


<?php
if(isset($_POST['denied'])){
    $tid = $_POST['tid'];
    
  // Retrieve the selected checkboxes
  $selectedRecord = $_POST['delete_faculty'];
  
  

  // Delete the selected records
  foreach($selectedRecord as $recordIds){
    $recordIds = mysqli_real_escape_string($conn, $recordIds); // Escape the value for security
    $querys = "DELETE FROM access_faculty WHERE id = '$recordIds'";
    mysqli_query($conn, $querys);
  

  // Display success message or redirect to another page
  $message = "Selected records have been deleted successfully.";
echo '
<div id="message-container" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #00FF00; padding: 10px; color: #FFFFFF;">' . $message . '</div>
<script>
  // Close the message after 2 seconds
  setTimeout(function() {
    var messageContainer = document.getElementById("message-container");
    messageContainer.style.display = "none";
  }, 2000);
</script>
';


  echo '<script>
  setTimeout(function(){
    history.back();
  }, 2000); // 2000 milliseconds = 2 seconds
</script>';
}
}
?>



<?php
if(isset($_POST['set_faculty'])){
    $id = $_POST['teacherid'];
    $faculty = $_POST['fac'];
    foreach($faculty as $fac){
    $sql = "SELECT * FROM access_faculty WHERE faculty='$fac' and teacher_id='$id'";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){ 
         echo "<script>
                alert('Duplicated data found');
                window.location.href='http://localhost/safs/admin/teacher_access_add.php?id=$id';
                
         </script> ";

     }else{

        $query = "INSERT INTO `access_faculty`(`teacher_id`, `faculty`) VALUES ('$id','$fac')";
        $query_run = mysqli_query($conn,$query);
      echo "  <script>
        alert('Data inserted');
        window.location.href='http://localhost/safs/admin/teacher_access_add.php?id=$id';
 </script> ";
     }
    
}
}
?>
