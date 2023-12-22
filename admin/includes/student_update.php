<?php
include 'config.php';

if(isset($_POST['update'])){
    $id = $_POST['update_id'];    
    $email = $_POST['email'];
    $fname = $_POST['sfname'];
    $lname = $_POST['slname'];
    $sem = ucfirst($_POST['sem']);
    $bat = $_POST['bat'];  
    $faculty = $_POST['faculty'];  

    $sql="UPDATE `student` SET `email`='$email', `batch`='$bat',`semester`='$sem',`sfname`='$fname',`slname`='$lname',`faculty`='$faculty'
     WHERE id=$id";

    $query=mysqli_query($conn,$sql);
    if($query){
        ?>
        <script>
            alert("Student Record has been Updated Sucessfully");
            window.location.href="http://localhost/safs/admin/student.php";
            </script>

            <?php
    }else{
        ?>
        <script>
        alert("Data Not Updated, please check it again");
        </script>
        <?php
    }
}
?>
<script>

function validateForm() {
  
  let a = document.forms["myForms"]["sem"].value;
  let b = document.forms["myForms"]["bat"].value;
  let c = document.forms["myForms"]["faculty"].value;
  
  if (a == "") {
    alert("Select your semester:");
    return false;
  }
  if (b == "") {
    alert("Select your batch:");
    return false;
  }
  if (c == "") {
    alert("Select your faculty:");
    return false;
  }
  
  
}
</script>
<div class="row">
  
    <div class="container">
    <p><a href="/safs/admin">Dashboard</a>> <a href="student.php">Student Record</a>> Student Update:</p>
    <hr>
    <div class="col s6 m5 l5">
     
        <div class="card"> 
        <?php
                
                $id = $_GET['update'];
                $sql="select * FROM student WHERE id=$id";
                $query=mysqli_query($conn,$sql);
                foreach($query as $row)
                    { 
                    ?> 
            <form name="myForms"action="#safs login form"  onsubmit="return validateForm()"  method="POST">
           
               

            <div class="col s12">
            <blockquote><h5 class="login-headtext">Update Student Record</h5></blockquote>  
            <input type="hidden" name="update_id" value="<?php echo $row['id']?>"> 
            <div class="row">
                    
                <div class="col s6 m6 l6">
            <div class="input-field">
                <i class="material-icons prefix">account_circle</i>
                    <input id="firstname" type="text" value="<?php echo $row['sfname'];?>" name="sfname"  class="validate">
                    <label for="firstname">First Name</label>
                </div>
</div>
<div class="col s6 m6 l6">
                <div class="input-field">
                <i class="material-icons prefix">account_circle</i>
                    <input id="lastname" type="text" name="slname" value= "<?php echo $row['slname'];?>" class="validate">
                    <label for="lastname">Last Name</label>
                </div>
</div>
                </div>
                

                        <div class="row">
                        <div class="col s12 m6 l6">
                        <div class="input-field">
                <i class="material-icons prefix">email</i>
                    <input id="email" type="email" name="email" value= "<?php echo $row['email'];?>" class="validate">
                    <label for="email">Email</label>
                </div>
                        </div>
                        <div class="col s12 m6 l6">
                        <div class="input-field">
                                        <i class="material-icons prefix">beenhere</i>
                                        <select class="validate" name="faculty">
                                            <option value="" disabled selected>Faculty</option>
                                            <?php
                                            $selectquery = " select * from facultylist ORDER BY faculty DESC";
                                            $query = mysqli_query($conn,$selectquery);
                                            while($res = mysqli_fetch_array($query)){
                                            $id= $res['id'];
                                            $faculty = $res['faculty'];          
                                            ?>
                                            <option value="<?php echo $faculty; ?>"><?php echo $faculty; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php
                                        $selectquery = " select * from student";
                                            $query = mysqli_query($conn,$selectquery);
                                            $res = mysqli_fetch_array($query) ?>
                                            <label>Previous(<?php echo $res['faculty']; ?>)</label> 
                                    </div>
                        </div>

                        </div>


               





                            <div class="row">
                                <div class="col s6 m6 l6">
                                <div class="input-field">
                                        <i class="material-icons prefix">av_timer</i>
                                        <select class="validate" name="bat">
                                            <option value="" disabled selected>Batch</option>
                                            <?php
                                            $selectquery = " select * from batch ORDER BY batch DESC";
                                            $query = mysqli_query($conn,$selectquery);
                                            while($res = mysqli_fetch_array($query)){
                                            $id= $res['id'];
                                            $batch = $res['batch'];          
                                            ?>
                                            <option value="<?php echo $batch; ?>"><?php echo $batch; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php
                                        $selectquery = " select * from student";
                                            $query = mysqli_query($conn,$selectquery);
                                            $res = mysqli_fetch_array($query) ?>
                                            <label>Previous(<?php echo $res['batch']; ?>)</label>
                                    </div>
                                </div>
                                <div class="col s6  m6 l6">
                                <div class="input-field">
      <i class="material-icons prefix">layers</i>
        <select class="validate" name="sem">
          <option value="" disabled selected>semester</option>
          <option value="first">First</option>
          <option value="second">Second</option>
          <option value="third">Third</option>
          <option value="fourth">Fourth</option>
          <option value="fifth">Fifth</option>
          <option value="sixth">Sixth</option>
          <option value="seventh">Seventh</option>
          <option value="eighth">Eighth</option>
        </select>
        <?php
                                        $selectquery = " select * from student";
                                            $query = mysqli_query($conn,$selectquery);
                                            $res = mysqli_fetch_array($query) ?>
                                            <label>Previous(<?php echo $res['semester']; ?>)</label>
      </div>
                                </div>
                            </div>
              

                
     
               
             

    <button class="btn waves-effect orange" type="submit" name="update">Update</button>
 
</div>
<div id="login-footer">
<p align="center">If you have any problem, <a  href="mailto:safs2021@gmail.com">mail here</a></p>
</div>

</form>  
<?php    
            }
            
?>
  
        </div>
    </div>
<script>
    
    $(document).ready(function(){
    $('select').formSelect();
  });
</script>
<div class="col s6 m7 l7">
<?php
 $selectquery = " select * from student";
 $query = mysqli_query($conn,$selectquery);
 $num = mysqli_num_rows($query); 
 if ($num == 0) {
    echo '<p class="empty">You have not added any students right now</p>';
  } else{?>
<h5 class="highlight"><i class="material-icons">dehaze</i> List of students </h5>
   <span class="num_date"> Number of Students: (<?php echo $num;?>) </span> 
   
        <table>
  <tr>
    <th>Faculty</th>
    <th>Batch</th>
    <th>Name</th>
    <th>Semester</th>
    <th>Email</th>
    <th>Active On</th>
    
    
  </tr>
    <?php
    $selectquery = " select * from student";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query);
    while($res = mysqli_fetch_array($query)){
        $fname = $res['sfname'];
        $lname = $res['slname'];
        $name = $fname." ".$lname;
    $email = $res['email'];    

    $date = $res['registrationdate'];
    $rdate = substr($date, 0, 11);
// Find the position of the "@" symbol

    
        ?>

        <tr>
            <td><?php echo $res['faculty']; ?> </td>
            <td><?php echo $res['batch']; ?> </td>
            <td><?php echo $name; ?> </td>
            <td><?php echo $res['semester']; ?> </td>
            <td><?php echo $email; ?> </td>
            <td class="date"><?php echo $rdate; ?> </td>
            
           
    </tr>
<?php
    }
}
?>
    
    </div>
    </div>
</div>
<style>
    tr:nth-child(even) {
  background-color: #ff9f121f;
}
h5.highlight{
font-weight:bolder;
    padding:10px;
    border-left:2px solid #FF9800;
    border-bottom:4px solid #FF9800;
}
p.empty{
    text-align:center;
    background:#ff98003d;
    padding:5px;
}
table th,td{
   white-space: nowrap;
   text-align: center;
}
   td.date{
    color:#ff9800;
    font-size:11px;

}
table a{
  color:#ff9800;
}
span.highlight{
    color:#dedede;
    background:#adadad;
    padding:5px;
}
span.num_date{
    background:#e0d8d8;
    padding:2px;
}
</style>