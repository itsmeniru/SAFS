<nav>
    <div class="container">
        <div class="nav-wrapper">
            <a href="/safs" class="logo">SA<span>FS</span></a>
            <?php 
                if(isset($_SESSION['tid']) || isset($_SESSION['sid'])){
                ?>
                 <a href="#" class="sidenav-trigger right white-text" data-target="mobile-nav">
                <i class="material-icons">account_circle</i>
                 </a>
                 
                        <?php }
                        else{ ?>
                 <a href="#" class="sidenav-trigger right white-text" data-target="mobile-nav">
                <i class="material-icons">menu</i>
            </a>
                        <?php } ?>


            <ul class="right hide-on-med-and-down">

<?php 
if(isset($_SESSION['sid'])){
?>

<li><a href="profile.php">PROFILE</a></li>
<li><a href="viewassignment.php">VIEW ASSIGNMENT</a></li>
<li><a href="submitassignment.php">SUBMIT ASSIGNMENT</a></li>
<li><a href="logout.php">LOGOUT</a></li>
 <?php } ?>

 <?php 
                if(isset($_SESSION['tid'])){
                ?>
                <li><a href="profile.php">PROFILE</a></li>
                <li><a href="assignment.php">ADD</a></li>
                <li><a href="assignment_view.php">VIEW</a></li>
                <li><a href="feedback.php">FEEDBACK</a></li>
               
                <li><a href="logout.php">LOGOUT</a></li>
                 <?php }
                  



                    if(!isset($_SESSION['tid']) && !isset($_SESSION['sid'])){ ?>
                    <li ><a href="#feedback">ANY QUESTIONS?</a></li>
                    <li> <a class="btn orange" href="studentlogin.php">Student</a></li>
                    <li> <a class="btn orange" href="teacherlogin.php">Teacher</a></li>
                   
                <?php } ?>
                
               
            </ul>
        </div>
    </div>
</nav>
    <ul class="sidenav right" id="mobile-nav">
        <h5 class="center">Menu</h5>
        <?php 
                if(isset($_SESSION['sid'])){
                ?>
                <li><a href="profile.php"> <i class="material-icons">account_circle</i>PROFILE</a></li>
                <li><a href="viewassignment.php"> <i class="material-icons">shop</i>VIEW ASSIGNEMENT</a></li>
                <li><a href="submitassignment.php"> <i class="material-icons">shop</i>SUBMIT ASSIGNEMENT</a></li>
               
                <hr>
                <li><a href="logout.php"> <i class="material-icons">exit_to_app</i>LOGOUT</a></li>
                 <?php } ?>

                 <?php 
                if(isset($_SESSION['tid'])){
                ?>
                <li><a href="profile.php"><i class="material-icons">account_circle</i>PROFILE</a></li>
                <li><a href="assignment.php"><i class="material-icons">shop</i>ADD</a></li>
                <li><a href="assignment_view.php"> <i class="material-icons">shop</i>VIEW</a></li>
                <li><a href="feedback.php"><i class="material-icons">shop</i>FEEDBACK</a></li>
               
              
                <hr>
                <li><a href="logout.php"><i class="material-icons">exit_to_app</i>LOGOUT</a></li>
                 <?php }


if(!isset($_SESSION['tid']) && !isset($_SESSION['sid'])){ ?>
    <li ><a href="#feedback">ANY QUESTIONS?</a></li>
    <li> <a class="btn orange" href="studentlogin.php">Student</a></li>
    <li> <a class="btn orange" href="teacherlogin.php">Teacher</a></li>
   
<?php } ?>
                
               
            </ul>
        </ul>