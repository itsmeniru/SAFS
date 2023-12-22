
<?php
include 'config.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "select * from access_subject where teacher_id = $id";
    $query = mysqli_query($conn,$sql);
     ?>
    <div class="row">
        <div class="container">

            <div class="col s12 m5 l6">

                <div class="card">
                    <div class="container">
                    <?php
                        while($res=mysqli_fetch_array($query)){ 
                        
                        $subject = ucfirst($res['sub']);
                    ?>
                           
                                                    <?php } ?>
                                                   
                                                   
                                        <form name="myForms"  onsubmit="return validateForm()"  method="POST">
                                            
                                                <blockquote><h5 class="login-headtext">ADD SUBJECT</h5></blockquote>   
                                                <div class="row">
                                                <div class="input-field col s12 m10 l10"> 
         
                                                    <i class="material-icons prefix">av_timer</i>                                               <input id="text" type="hidden" value="<?php echo $id;?>"name="teacherid" class="validate">
                                                        <select multiple name="sub[]">
                                                        <option value="" disabled selected>Select</option>
                                            <?php
                                            $selectquery = " select * from subjectlist ORDER BY id DESC";
                                            $query = mysqli_query($conn,$selectquery);
                                            while($res = mysqli_fetch_array($query)){
                                            
                                            $subject = $res['subject'];          
                                            ?>
                                            <option value="<?php echo $subject; ?>"><?php echo $subject; ?></option>
                                            <?php } ?>
                                                        </select>
                                                        <label>Subject</label>
                                                    </div>
                                                    </div>
                                                    
                                                    <button class="btn waves-effect orange" type="submit" name="set">Set Permission</button>                               
                        
                                                </form>
                          
                        </div>                  </div>
            </div> 

            <div class="col s12 m6 l6">

                <div class="card">
                    <form name="forms"  onsubmit="return validateForm()" method="POST">
                    <blockquote><h5 class="login-headtext">Edit Subject</h5></blockquote>
                          
                        <?php
                        $sq = " select * from access_subject where teacher_id=$id";
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
                                <th>Subject</th>
                                <th>
                                <button class="btn waves-effect orange" type="submit" name="delete_sub">Delete</button>
                                </th>
                                </tr>
                        
                            </thead>
                                <tbody>
                                    <?php
                                    if(mysqli_num_rows($q) > 0){
                                        foreach($q as $row){ ?>
                                        <input type="hidden" name="tid" value="<?php echo $id;?>">
                                        <tr>
                                        <td><?php echo $row['sub'];?></td>
                                        <td>
                                            <p><label>
                                                <input type="checkbox" name="delete_subject[]" value="<?php echo $row['id']?>">
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
if(isset($_POST['delete_sub'])){
    $tid = $_POST['tid'];
  // Retrieve the selected checkboxes
  $selectedRecord = $_POST['delete_subject'];

  foreach($selectedRecord as $recordId){
    $recordIds = mysqli_real_escape_string($conn, $recordId); // Escape the value for security
    $querys = "DELETE FROM access_subject WHERE id = '$recordIds'";
    mysqli_query($conn, $querys);
  }

  // Display success message or redirect to another page
  echo '<script>
  setTimeout(function(){
    history.back();
  }, 100); // 2000 milliseconds = 2 seconds
</script>';
}
?>



<?php
if(isset($_POST['set'])){
    $id = $_POST['teacherid'];
    $subject = $_POST['sub'];
    foreach($subject as $sub){
    $sql = "SELECT * FROM access_subject WHERE sub='$sub' and teacher_id='$id'";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){ 
         echo "<script>
                alert('Duplicated data found');
                window.location.href='http://localhost/safs/admin/teacher_access_add.php?id=$id';
                
         </script> ";

     }else{

        $query = "INSERT INTO `access_subject`(`teacher_id`, `sub`) VALUES ('$id','$sub')";
        $query_run = mysqli_query($conn,$query);
      echo "  <script>
        alert('Data inserted');
        window.location.href='http://localhost/safs/admin/teacher_access_add.php?id=$id';
 </script> ";
     }
    
}
}
?>
