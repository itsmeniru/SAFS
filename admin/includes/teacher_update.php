<?php
include 'config.php';
if(isset($_POST['update'])){
    $id = $_POST['update_id'];    
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql="UPDATE `teacher` SET `email`='$email',`password`='$password' WHERE id=$id";

    $query=mysqli_query($conn,$sql);
    if($query){
        ?>
        <script>
            alert("Data has been Updated Sucessfully");
            window.location.href="http://localhost/safs/admin/teacher.php";
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

<div class="row">
    <div class="container">
    <p><a href="/safs/admin">Dashboard</a>> <a href="teacher.php">Teacher Record</a>>Teacher Record Update:</p>
    <hr>
    <div class="col s12 l5">
<div class="card">  
<?php
            if(isset($_GET['update'])){
            $id = $_GET['update'];
            $sql="select * FROM teacher WHERE id=$id";
            $query=mysqli_query($conn,$sql);
              foreach($query as $row)
                {
        
          ?>
            <form name="myForms"  onsubmit="return validateForm()"  method="POST">
           
              

                 
            
            <div class="col s12">
            <blockquote><h5 class="login-headtext">UPDATE TEACHER</h5></blockquote>
                <input type="hidden" name="update_id" value="<?php echo $row['id']?>">

                <div class="row">
                    <div class="col s12 m6 l6">
                    <div class="input-field">
                <i class="material-icons prefix">account_circle</i>
                    <input id="firstname" type="text"  value="<?php echo $row['tfname'];?>" name="tfname"  class="validate">
                    <label for="firstname">First Name</label>
                </div>
                    </div>
                    <div class="col s12 m6 l6">
                    <div class="input-field">
                <i class="material-icons prefix">account_circle</i>
                    <input id="lastname" type="text"  value="<?php echo $row['tlname'];?>" name="tlname"  class="validate">
                    <label for="lastname">Last Name</label>
                </div>
                    </div>
                </div>

               

               


                <div class="input-field">
                <i class="material-icons prefix">email</i>
                    <input id="email" type="email" value="<?php echo $row['email'];?>" name="email" class="validate">
                    <label for="email">Email</label>
                </div>

               

              
                
               
            
                <button class="btn waves-effect orange" type="submit" name="update">Update</button>
 
</div>
<div id="login-footer">
<p align="center">If you have any problem, <a  href="mailto:safs2021@gmail.com">mail here</a></p>
</div>

</form>  
   
<?php
      
            }
        }
?>
  
        </div>
    </div>

<div class="col s12 l7">
<?php
 $selectquery = " select * from teacher";
 $query = mysqli_query($conn,$selectquery);
 $num = mysqli_num_rows($query); 
 if ($num == 0) {
    echo '<p class="empty">You have not added any students right now</p>';
  } else{?>
<h5 class="highlight"><i class="material-icons">dehaze</i> List of Teachers </h5>
   <span class="num_date"> Number of Teachers: (<?php echo $num;?>) </span> 
   
        <table>
  <tr>
    
    <th>Name</th> 
    <th>Email</th>
    <th>Date</th>
    
  </tr>
    <?php
    $selectquery = " select * from teacher";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query);
    while($res = mysqli_fetch_array($query)){
        $fname = $res['tfname'];
        $lname = $res['tlname'];
        $name = $fname . " ".$lname;
        ?>
       
        <tr>
            
            <td><?php echo $name; ?> </td>
            <td><?php echo $res['email']; ?> </td>
            <td><?php echo $res['registeredate']; ?> </td>
           
<?php
    
    }}
?>
    
    </div>
    </div>
</div>