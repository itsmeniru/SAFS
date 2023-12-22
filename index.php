<!DOCTYPE html>
<?php
session_start();
include 'config.php';
?>
<script>
function validateForm() {
  var selectedOption = document.getElementById("query").value;
 

  if (selectedOption === "") {
    document.getElementById("error-message").innerHTML = "Please select subject";
    return false; // Prevent form submission
  }
  
}
</script>
<?php
// Assuming you have a database connection established

$successMessage = "";

if (isset($_POST['submit'])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    date_default_timezone_set('Asia/Kathmandu');
    $date = date('Y-m-d H:i:s');
    $ipAddress = $_SERVER['REMOTE_ADDR']; // Get the IP address of the user
    

    // Insert the form data into the database, including the IP address
    $query = "INSERT INTO contact_form (first_name, last_name, email, messages,dateofsubmit, ip_address) 
    VALUES ('$firstName', '$lastName', '$email', '$message','$date', '$ipAddress')";
    mysqli_query($conn, $query);

    // Set the success message
    $successMessage = "Form submitted successfully!";
}
?>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Index | SAFS</title>

  <?php  include 'includes/link.php';?>
</head>
<body>  
    <?php  include 'includes/navigation.php' ?>
  <div id="index-banner" class="parallax-container">
          <div class="section no-pad-bot">
            <div class="container">
              <br><br>
                  <h2 class="header center">Student Assignment Feedback System</h2>
                    <p class="center  col s12 light">Make it feel easy to submit your assignment here !
                    </p>
                    <div class="row center">
                      <?php   if (isset($_SESSION['sid'])){ 
                         $sem = $_SESSION['semester'];
                         $batch = $_SESSION['batch'];
                        ?>
                      <div class="row">
                        <div class="container">
                        <div class="input-field col s12 m12 l12">
                        <form method="GET" action="search_for_student.php" onsubmit="return validateForm()">
            <div class="input-field">
           
                                       <select name="query" id="query">
                                       <option value="" disabled selected>Subject</option>
                                       <?php
                                           
      
                                            $selectquery = "SELECT DISTINCT sub FROM assignment where batch='$batch' and semester='$sem' ORDER BY ID DESC";
                            
                                            $query = mysqli_query($conn,$selectquery);
                                            while($res = mysqli_fetch_array($query)){
                                            $id= $res['id'];
                                            $sem = $res['sub'];          
                                            ?>
                                             <option value="<?php echo $sem; ?>"><?php echo $sem; ?></option>
                                             <?php }?>
                                       </select>
                                            
                            <label for="subject">Subject</label>
            </div>
            <button class="btn waves-effect waves-light" name="submit" type="submit">Search</button>
        </form>
                        </div>
                       
</div>
                      </div>
                      <div id="error-message"></div>  
                     <?php }  
                     if (isset($_SESSION['tid'])){
                      $id = $_SESSION['tid'];
                      ?>
                      <div class="row">
                        <div class="container">
                        <div class="input-field col s12 m12 l12">
                        <form method="GET" action="search_for_teacher.php" onsubmit="return validateForm()">
            <div class="input-field">
            <select name="query" id="query">
                                       <option value="" disabled selected>Subject</option>
                                       <?php
                                           
                                            $selectquery = " select * from access_subject where teacher_id = $id ";
                                            $query = mysqli_query($conn,$selectquery);
                                            while($res = mysqli_fetch_array($query)){
                                            
                                            $sem = $res['sub'];          
                                            ?>
                                             <option value="<?php echo $sem; ?>"><?php echo $sem; ?></option>
                                             <?php }?>
                                       </select>
                                            
                            <label for="subject">Subject</label>
            </div>
            <button class="btn waves-effect waves-light" name="submit" type="submit">Search</button>
        </form>
         
                        </div>
</div>
                      </div>
                      <div id="error-message"></div> 

                      <?php }?>

                    </div>
                        <br><br>
            </div>
          </div>
        <div class="parallax"><img src="bg1.jpg" alt="Unsplashed background img 1"></div> 
    </div>

<div id="content-body">
    <div class="container">
      <?php  include 'includes/contentbody.php' ?>
    </div>
</div>
<?php if (!isset($_SESSION['tid']) && !isset($_SESSION['sid'])){?>
<div class="middle-body">
<div class="container">
  <div class="row">
    <div class="col s12 m6 l6">
    <img class="responsive-img" src="photos/preview.gif" alt="GIF Image" >
   
    </div>
    <div class="col s12 m6 l6 offset-m4 form">
    <h5 class="highlight">Contact Form</h5>
        <div class="card">  
         <!-- Display success message if set -->
  <?php if ($successMessage !== ""): ?>
    <p class="success"><?php echo $successMessage; ?></p>
  <?php endif; ?>
            <form action="#safs student assignement feedback system" method="POST">
           
                

                   
            
            <div class="card-content col s12">
                
               <div class="row">
                <div class="col s12 m6 l6">
                <div class="input-field">
               
                <input type="text" id="first_name" name="first_name" required><br>
               <label for="email">First Name:</label>
           </div>
                </div>
                <div class="col s12 m6 l6">
                <div class="input-field">
               
                <input type="text" id="last_name" name="last_name" required><br>
               <label for="email">Last Name:</label>
           </div>
                </div>

               </div>
                  <div class="row">
                  <div class="input-field col s12 m12 l12">
                
                  <input type="email" id="email" name="email" required><br>
                <label for="password">Email</label>
            </div>
                  </div>
                  <div class="row">
                  <div class="input-field col s12 m12 l12">
                
                  <textarea id="message" name="message" required></textarea><br>
                  <label for="message">Message:</label>
            </div>
                  </div>
                
            
                
                <br>
                
                <input class="btn waves-effect orange" type="submit" name="submit" value="Submit">
 
</div>


</form>  
   

  
        </div>
    </div>

  </div>

</div>

</div>
<?php }?>
<div id="content-body">  
  <?php  include 'includes/footer.php' ?>
</div>
</body>
</html> 


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

 
  <script>
    $(document).ready(function(){
    $('select').formSelect();
    
  });
  
    </script>

<style>
   input[type="text"]:focus:not(.browser-default) {
            border-bottom: 1px solid #000;
            box-shadow: 0 1px 0 0 #000;
        }

       
</style>

