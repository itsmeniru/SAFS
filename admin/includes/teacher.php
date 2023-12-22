<?php

include 'config.php';
if (isset($_POST['action'])){
  
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
    $fname = ucfirst($_POST['tfname']);
    $lname = ucfirst($_POST['tlname']);
    date_default_timezone_set('Asia/Kathmandu');
    $date = date('Y-m-d H:i:s');
    $emails = mysqli_real_escape_string($conn,$email);
    $emailquery = "select * from teacher where email='$email'";
    $query = mysqli_query($conn, $emailquery);
    $emailcount = mysqli_num_rows($query);
    if($emailcount>0){
        echo "<script>alert('Email has been already used, Please use another email');</script>";
    }else{


    $insertquery = "insert into teacher(email,password,tfname,tlname,registeredate)
     values('$email','$pass','$fname','$lname','$date')";
    $res=mysqli_query($conn,$insertquery);
   
    if($res){
        ?>
        <script>
            alert("Teacher has been added successfully:");
            window.location.href="http://localhost/safs/admin/teacher.php";
            </script>

            <?php
    }else{
        ?>
        <script>
        alert("Failed to insert:");
        </script>
        <?php
    }

}
}
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql="DELETE FROM teacher WHERE id=$id";
    $query=mysqli_query($conn,$sql);
      if($query){
          ?>
          <script>
              alert("Record has been delete");
              window.location.href="http://localhost/safs/admin/teacher.php";
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
  let z = document.forms["myForms"]["tfname"].value;
  let a = document.forms["myForms"]["tlname"].value;
  if (x == "") {
    alert("email must be filled out");
    return false;
  }
  if (y == "") {
    alert("password must be filled out");
    return false;
  }
  if (z == "") {
    alert("Teacher First Name must be filled out");
    return false;
  }
  if (a == "") {
    alert("Teacher Last Name must be filled out");
    return false;
  }
}
</script>
<div class="row">
    <div class="container">
    <p><a href="/safs/admin">Dashboard</a>> Teacher Record:</p>
    <hr>
    <div class="col s12 m5 l5">
        <div class="card">  
            <form name="myForms"action="#safs"  onsubmit="return validateForm()"  method="POST">
           
               
                 
            
            <div class="col s12">
            <blockquote><h5 class="login-headtext">ADD TEACHER RECORD</h5></blockquote>

                <div class="row">
                    <div class="col s12 m6 l6">
                    <div class="input-field">
                <i class="material-icons prefix">account_circle</i>
                    <input id="firstname" type="text" name="tfname"  class="validate">
                    <label for="firstname">First Name</label>
                </div>
                    </div>
                    <div class="col s12 m6 l6">
                    <div class="input-field">
                <i class="material-icons prefix">account_circle</i>
                    <input id="lastname" type="text" name="tlname"  class="validate">
                    <label for="lastname">Last Name</label>
                </div>
                    </div>
                </div>
           

               
                
                <div class="input-field">
                <i class="material-icons prefix">email</i>
                    <input id="email" type="email" name="email" class="validate">
                    <label for="email">Email</label>
                </div>
           

                <div class="input-field">
                <i class="material-icons prefix">lock</i>
                    <input id="password" type="password" name="password"  class="validate">
                    <label for="password">Password</label>
                </div>

                

            
                <button class="btn waves-effect orange" type="submit" name="action">Add Teacher</button>
</div>
<div id="login-footer">
<p align="center">If you have any problem, <a  href="mailto:safs2021@gmail.com">mail here</a></p>
</div>

</form>  
   

  
        </div>
    </div>

<div class="col s12 l7 m7">

<?php
    $selectquery = " select * from teacher";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query); ?>
   

    <?php
    if ($num == 0) {
      echo '<p class="empty">You have not added any teacher right now</p>';
    } else{?>
    <h5 class="highlight"><i class="material-icons">dehaze</i> List of Teachers </h5>
   <span class="num_date"> Number of Teachers: (<?php echo $num;?>) </span> 
    <span class="num_date">Last Added:
    <?php
    $sql = "SELECT MAX(registeredate) AS latest_date FROM teacher";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$latestDate = $row['latest_date'];
echo $latestDate;
?>
    </span>
        <table class="responsive-table">
  <tr>

    <th>Name</th>
    <th>Email</th>
    <th>Date</th>
    <th>Actions</th>
  </tr>
    <?php
    $selectquery = " select * from teacher";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query);
    while($res = mysqli_fetch_array($query))
    {
        $fname = $res['tfname'];
        $lname = $res['tlname'];
        $name = $fname . " ".$lname;
        ?>
       
        <tr>
            
            <td><?php echo $name ?> </td>
            
            <td><?php echo $res['email']; ?> </td>
             <td><?php echo $res['registeredate']; ?> </td>
             <td>
              <a href="teacher_update.php?update=<?php echo $res['id'];?>"><i class="material-icons">edit</i></a>
              <a href="teacher.php?delete=<?php echo $res['id'];?>"><i class="material-icons">delete</i></a>
            </td>
            
<?php
    }
}
?>
    </div>
    </div>
</div>