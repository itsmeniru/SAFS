<footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Student Assignment Feedback System</h5>
                <p>
                <li><a href="/safs">HOME</a></li>
               
                <?php 
                if(isset($_SESSION['sfname'])){
                ?>
                <li><a href="profile.php"> PROFILE</a></li>
                <li><a href="viewassignment.php">VIEW ASSIGNEMENT</a></li>
                <li><a href="submitassignment.php"> SUBMIT ASSIGNEMENT</a></li>
                <li><a href="logout.php"> LOGOUT</a></li>
                 <?php } ?>

                 <?php 
                if(isset($_SESSION['tfname'])){
                ?>
                <li><a href="profile.php">PROFILE</a></li>
                <li><a href="assignment.php">ADD ASSIGNMENT</a></li>
                <li><a href="assignment_view.php">ASSIGNEMENT VIEW</a></li>
                <li><a href="logout.php"><i class="material-icons">exit_to_app</i>LOGOUT</a></li>
                 <?php } ?>
                 <?php
                 if(!isset($_SESSION['tfname']) && !isset($_SESSION['sfname'])){ ?>
    
    <li><a  href="studentlogin.php">Student</a></li>
    <li><a href="teacherlogin.php">Teacher</a></li>
   
<?php } ?>
                 </p>
              </div>
              
                 </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            <P align="center">
            © 2021 Copyright | Designed and Developed By Raksha Dhakal
            </P>
           
            </div>
          </div>
        </footer>