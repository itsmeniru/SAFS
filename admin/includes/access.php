
<?php
include 'config.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "select * from access where teacher_id = $id";
    $query = mysqli_query($conn,$sql);
     ?>
     
    <div class="row">
        <div class="container">

            <div class="col s12 m6 l6">

                <div class="card">
                    <div class="container">
                    <?php
                        while($res=mysqli_fetch_array($query)){ 
                        
                        $semester = ucfirst($res['semester']);
                    ?>
                           
                                                    <?php } ?>
                                                   
                                                   
                                        <form name="myForms"  onsubmit="return validateForm()"  method="POST">
                                            
                                                 <div class="row">
                                                 <blockquote><h5 class="login-headtext">ADD SEMESTER</h5></blockquote>   
                                             
                                                <div class="input-field col s12 m10 l10"> 
                                                    
         
                                                    <i class="material-icons prefix">av_timer</i>                                               <input id="text" type="hidden" value="<?php echo $id;?>"name="teacherid" class="validate">
                                                        <select multiple name="sem[]">
                                                        <option value="" disabled selected>Choose your option</option>
                                                        <option value="first">First</option>
                                                        <option value="second">Second</option>
                                                        <option value="third">Third</option>
                                                        <option value="fourth">Fourth</option>
                                                        <option value="fifth">Fifth</option>
                                                        <option value="sixth">Sixth</option>
                                                        <option value="seventh">Seventh</option>
                                                        <option value="eighth">Eighth</option>
                                                        </select>
                                                        <label>Semester</label>
                                                    </div>
                                                    </div>
                                                    
                                                    <button class="btn waves-effect orange" type="submit" name="action">Set Permission</button>                               
                        
                                                </form>
                          
                        </div>
                        
                                      </div>



<div class="card">
    <form  method="POST">
    <blockquote><h5 class="login-headtext">Edit Semester</h5></blockquote>       
        <?php
        $selectquery = " select * from access where teacher_id=$id";
        $query = mysqli_query($conn,$selectquery); 
        $numRows = mysqli_num_rows($query);
        if ($numRows == 0) {
        $displayNone = 'style="display: none;"';
        } else {
        $displayNone = '';
        } ?>
        <table class="striped responsive-table centered highlight">
            <thead bgcolor="#fafafa" <?php echo $displayNone; ?>>
                <tr>
                <th>Semester</th>
                <th>
                <button class="btn waves-effect orange" type="submit" name="submit_sem">Delete</button>
                </th>
                </tr>
        
            </thead>
                <tbody>
                    <?php
                    if(mysqli_num_rows($query) > 0){
                        foreach($query as $row){ ?>
                        <input type="hidden" name="tid" value="<?php echo $id;?>">
                        <tr>
                        <td><?php echo strtoupper($row['semester']);?></td>
                        <td>
                            <p><label>
                                <input type="checkbox" name="delete[]" value="<?php echo $row['id']?>">
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
if(isset($_POST['submit_sem'])){
    $tid = $_POST['tid'];
  // Retrieve the selected checkboxes
  $selectedRecords = $_POST['delete'];

  // Delete the selected records
  foreach($selectedRecords as $recordId){
    $recordId = mysqli_real_escape_string($conn, $recordId); // Escape the value for security
    $query = "DELETE FROM access WHERE id = '$recordId'";
    mysqli_query($conn, $query);
  

  // Display success message or redirect to another page
  echo '<script>
  setTimeout(function(){
    history.back();
  }, 1000); // 2000 milliseconds = 2 seconds
</script>';
}
}
?>



<?php
if(isset($_POST['action'])){
    $id = $_POST['teacherid'];
    $semester = $_POST['sem'];
    foreach($semester as $sem){
    $sql = "SELECT * FROM access WHERE semester='$sem' and teacher_id='$id'";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){ 
         echo "<script>
                alert('Duplicated data found');
                window.location.href='http://localhost/safs/admin/teacher_access_add.php?id=$id';
                
         </script> ";

     }else{

        $query = "INSERT INTO `access`(`teacher_id`, `semester`) VALUES ('$id','$sem')";
        $query_run = mysqli_query($conn,$query);
      echo "  <script>
        alert('Data inserted');
        window.location.href='http://localhost/safs/admin/teacher_access_add.php?id=$id';
 </script> ";
     }
    
}
}
?>
