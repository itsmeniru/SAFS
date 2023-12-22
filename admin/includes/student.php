<?php
include 'config.php';

if (isset($_POST['action'])){
  $email = $_POST['email'];
  $pass = md5($_POST['password']);
  $sfname = ucfirst($_POST['sfname']);
  $lname = ucfirst($_POST['slname']);
  $faculty=$_POST['faculty'];
  $batch = $_POST['batch'];
  $semester = ucfirst($_POST['semester']);
  date_default_timezone_set('Asia/Kathmandu');
   $date = date('Y-m-d H:i:s');
   $sql = "SELECT * FROM student WHERE email='$email'";
   $res = mysqli_query($conn, $sql);
   if(mysqli_num_rows($res) > 0){ ?>
    <script>
              alert("Email already in use");
              window.location.href="http://localhost/safs/admin/student.php";
              </script>
   <?php
      
  }else{
    $insertquery = "insert into student(email,batch,semester,password,sfname,slname,registrationdate,faculty) 
    values('$email','$batch','$semester','$pass','$sfname','$lname','$date','$faculty')";
         $results = mysqli_query($conn, $insertquery);
         if($results){
          ?>
          <script>
              alert("Student added sucessfully");
              window.location.href="http://localhost/safs/admin/student.php";
              </script>
  
              <?php
      }
         exit();
  }
}



if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql="DELETE FROM student WHERE id=$id";
    $query=mysqli_query($conn,$sql);
      if($query){
          ?>
          <script>
              alert("Student has been delete");
              window.location.href="http://localhost/safs/admin/student.php";
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
<script>
function validateForm() {
  let x = document.forms["myForms"]["email"].value;
  let y = document.forms["myForms"]["password"].value;
  let z = document.forms["myForms"]["sfname"].value;
  let a = document.forms["myForms"]["slname"].value;
  let b = document.forms["myForms"]["semester"].value;
  let c = document.forms["myForms"]["batch"].value;
  let d = document.forms["myForms"]["faculty"].value;
  

  if (x == "") {
    alert("Please Enter Email:");
    return false;
  }
  if (y == "") {
    alert("Did you Entered Password?");
    return false;
  }
  if (z == "") {
    alert("Need a Student Name:");
    return false;
  }
  if (a == "") {
    alert("Need a student last name:");
    return false;
  }
  if (b == "") {
    alert("please select semester:");
    return false;
  }
  if (c == "") {
    alert("please select batch:");
    return false;
  }
  if (d == "") {
    alert("please select faculty:");
    return false;
  }


}
</script>
<div class="row">
  
    <div class="container">
    <p><a href="/safs/admin">Dashboard</a>> Student Record:</p>
    <hr>
    <div class="col s12 m5 l5">
     
        <div class="card">  
            <form name="myForms"action="#safs login form"  onsubmit="return validateForm()"  method="POST">
           
               

            <div class="col s12">
            <blockquote><h5 class="login-headtext">ADD STUDENT RECORD</h5></blockquote>   
            <div class="row">
                    
                <div class="col s6 m6 l6">
            <div class="input-field">
                <i class="material-icons prefix">account_circle</i>
                    <input id="firstname" type="text" name="sfname"  class="validate">
                    <label for="firstname">First Name</label>
                </div>
</div>
<div class="col s6 m6 l6">
                <div class="input-field">
                <i class="material-icons prefix">account_circle</i>
                    <input id="lastname" type="text" name="slname"  class="validate">
                    <label for="lastname">Last Name</label>
                </div>
</div>
                </div>
                
               <div class="row">
               <div class="input-field col s12 m6 l6">
                <i class="material-icons prefix">email</i>
                    <input id="email" type="email" name="email" class="validate">
                    <label for="email">Email</label>
                </div>
                <div class="input-field col s12 m6 l6">
                <i class="material-icons prefix">beenhere</i>
        <select class="validate" name="faculty">
          <option value="" disabled selected>select</option>
          <?php
                                             $id = $_SESSION['id'];
                                            $selectquery = " select * from facultylist";
                                            $query = mysqli_query($conn,$selectquery);
                                            while($res = mysqli_fetch_array($query)){
                                            $id= $res['id'];
                                            $faculty = strtoupper($res['faculty']);          
                                            ?>
                                            <option value="<?php echo $faculty; ?>"><?php echo $faculty; ?></option>
                                            <?php } ?>
         
        </select>
        <label>Select Faculty</label>
                </div>
               </div>

                <div class="row">
                    <div class="col s6 m6 l6">
      <div class="input-field">
      <i class="material-icons prefix">av_timer</i>
        <select class="validate" name="batch">
        <option value="" disabled selected>select</option>
          <?php
                                             $id = $_SESSION['id'];
                                            $selectquery = " select * from batch";
                                            $query = mysqli_query($conn,$selectquery);
                                            while($res = mysqli_fetch_array($query)){
                                            $id= $res['id'];
                                            $batch = $res['batch'];          
                                            ?>
                                            <option value="<?php echo $batch; ?>"><?php echo $batch; ?></option>
                                            <?php } ?>
        </select>
        <label>Select Batch</label>
      </div>
</div>
<div class="col s6 m6 l6">
      <div class="input-field">
      <i class="material-icons prefix">layers</i>
        <select class="validate" name="semester">
          <option value="" disabled selected>select</option>
          <option value="first">First</option>
          <option value="second">Second</option>
          <option value="third">Third</option>
          <option value="fourth">Fourth</option>
          <option value="fifth">Fifth</option>
          <option value="sixth">Sixth</option>
          <option value="seventh">Seventh</option>
          <option value="eighth">Eighth</option>
        </select>
        <label>Select Semester</label>
      </div>
</div>


    </div>
                <div class="input-field">
                <i class="material-icons prefix">lock</i>
                    <input id="password" type="password" name="password"  class="validate">
                    <label for="password">Password</label>
                </div>
               

              
            
                <button class="btn waves-effect orange" type="submit" name="action">Add now</button>
 
</div>
<div id="login-footer">
<p align="center">If you have any problem, <a  href="mailto:safs2021@gmail.com">mail here</a></p>
</div>

</form>  
   

  
        </div>
    </div>
<script>
    
    $(document).ready(function(){
    $('select').formSelect();
  });
</script>
<div class="col s12 m7 l7">


     
    <?php
    $selectquery = " select * from student ORDER BY id DESC";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query); ?>
   

    <?php
    if ($num == 0) {
      echo '<p class="empty">You have not added any students right now</p>';
    } else{?>
    <h5 class="highlight"><i class="material-icons">dehaze</i> List of students </h5>
   <span class="num_date"> Number of Students: (<?php echo $num;?>) </span> 
    <span class="num_date">Last Added:
    <?php
    $sql = "SELECT MAX(registrationdate) AS latest_date FROM student";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$latestDate = $row['latest_date'];
echo $latestDate;
?>
    </span>
     

    <table class="responsive-table">
    <tr>
      <th>Faculty</th>
      <th>Batch</th>
      <th>Name</th>
      <th>Semester</th>
      <th>Email</th>
      <th>Active On</th>
      <th>Actions</th>
    </tr>
    <?php
    while($res = mysqli_fetch_array($query)){
      $fname = $res['sfname'];
      $lname = $res['slname'];
      $name = $fname . " ".$lname;
      $email = $res['email'];
      $date = $res['registrationdate'];
      $rdate = substr($date, 0, 11);

// Find the position of the "@" symbol
$atPosition = strpos($email, "g");

if ($atPosition !== false) {
  // Extract the part before the "@"
  $emailid = substr($email, 0, $atPosition);
}
        ?>
       
        <tr>
          <td><?php echo $res['faculty'];?></td>
            <td><?php echo $res['batch']; ?> </td>
            <td><?php echo $name; ?> </td>
           
            <td><?php echo $res['semester']; ?> </td>
            <td><?php echo $emailid; ?> </td>
            <td class="date"><?php echo $rdate; ?> </td>
            <td>
              <a href="student_update.php?update=<?php echo $res['id'];?>"><i class="material-icons">edit</i></a>
              <a href="student.php?delete=<?php echo $res['id'];?>"><i class="material-icons">delete</i></a>
            </td>
    </tr>
<?php
    }
  }
?>
    
    </div>
    </div>
</div>