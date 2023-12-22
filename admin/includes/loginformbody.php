<?php

include 'config.php';

if(isset($_POST['email'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $sql = "select * from admin where email='".$email."' AND password='".$pass."' limit 1";
    $result= mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['email'] = $row['email'];
        header("location:index.php?sucessfully loggged in");
        exit();
    }
    else{
        header("location: login.php?error=Invalid Credentials, Please check it again!");
    }
}

?>

<div class="row">
    <div class="col s12 m4 offset-m4">
        <div class="card">  
            <form action="#safs admin login form" method="POST">
           
                <blockquote><h5 class="login-headtext">ADMIN LOGIN</h5></blockquote>

                    <?php
                    if(isset($_GET['error'])){ ?>
                      
                        <p class="waves-effect error"><i class="material-icons">error</i> <?php echo $_GET['error']; ?></p>
                    

                     <?php }
                    ?>
            
            <div class="card-content col s12">
                
                <div class="input-field">
                <i class="material-icons prefix">account_circle</i>
                    <input id="email" type="email" name="email" class="validate">
                    <label for="email">Email</label>
                </div>

                <div class="input-field">
                <i class="material-icons prefix">lock</i>
                    <input id="password" type="password" name="password"  class="validate">
                    <label for="password">Password</label>
                </div>
            
                <p>Oh No, I <a href="#">forgot my password  </a></a></p>
                <br>
                <button class="btn waves-effect orange" type="submit" name="action">Submit</button>
 
</div>
<div id="login-footer">
    <p>If you have any problem, <a  href="mailto:safs2021@gmail.com">mail here</a></p>
</div>

</form>  
   

  
        </div>
    </div>
</div>