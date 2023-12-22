<?php

include 'config.php';
if (isset($_POST['action'])){
   
    $email = $_POST['email'];
    $text = $_POST['text'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $date = date('y-m-d');
    $insertquery = "insert into message(email,fname,lname,message,message_on)
     values('$email','$fname','$lname','$text','$date')";
    $res=mysqli_query($conn,$insertquery);
    if($res){
        ?>
        <script>
            alert("Message sent successfully:");
            window.location.href="http://localhost/safs/";
            </script>

            <?php
    }else{
        ?>
        <script>
        alert("Failed to Sent:");
        </script>
        <?php
    }

}



?>
<script>
function validateForm() {
  let x = document.forms["myForms"]["email"].value;
  let y = document.forms["myForms"]["text"].value;
  let z = document.forms["myForms"]["tfname"].value;
  let a = document.forms["myForms"]["tlname"].value;
  if (x == "") {
    alert("email must be filled out");
    return false;
  }
  if (y == "") {
    alert("Message must be filled out");
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
    <div class="col s12 l12">
        <div class="card">  
            <form name="myForms"action="#safs contact"  onsubmit="return validateForm()"  method="POST">
           
                <blockquote><h5 class="login-headtext">Any Questions?</h5></blockquote>

                 
            
            <div class="col s12">
                
            <div class="input-field">
                <i class="material-icons prefix">account_circle</i>
                    <input id="firstname" type="text" name="fname"  class="validate">
                    <label for="firstname">First Name</label>
                </div>

                <div class="input-field">
                <i class="material-icons prefix">account_circle</i>
                    <input id="lastname" type="text" name="lname"  class="validate">
                    <label for="lastname">Last Name</label>
                </div>
                
                <div class="input-field">
                <i class="material-icons prefix">email</i>
                    <input id="email" type="email" name="email" class="validate">
                    <label for="email">Email</label>
                </div>
           

                <div class="input-field">
                <i class="material-icons prefix">create</i>
                    <input id="text" type="text" name="text"  class="validate">
                    <label for="text">Messages</label>
                </div>

                

            
                <button class="btn waves-effect orange" type="submit" name="action">SEND MESSAGE</button>
</div>
<div id="login-footer">
<p align="center">If you have any problem, <a  href="mailto:safs2021@gmail.com">mail here</a></p>
</div>

</form>  
   

  
        </div>
    </div>


    </div>
</div>