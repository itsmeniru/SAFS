<?php
include 'config.php';
if(isset($_POST['delete'])){
    
    $all_id = $_POST['sem'];
    
   $extract_id = implode(',',$all_id);
   echo "<h1>$extract_id</h1>";
$qquery = "DELETE FROM access WHERE id IN($extract_id)";
$query_run = mysqli_query($con,$query);
if ($query_run){
?>
                 <script>
                  alert("Deleted");
                  window.location.href="http://localhost/safs/admin/batch.php";
                  </script>
<?php 

}



}
?>