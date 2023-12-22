<nav>
    <div class="container">
        <div class="nav-wrapper">
            <a href="/safs/admin/" class="logo">SA<span>FS</span></a>
            <?php 
                if(isset($_SESSION['fname'])){
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
                if(isset($_SESSION['fname'])){
                ?>
               
               
                <li><a href="logout.php">LOGOUT</a></li>
                 <?php }
                else{ ?>
                  
                    <li> <a class="btn orange" href="login.php">LOGIN</a></li>
                   
                <?php } ?>
                
               
            </ul>
        </div>
    </div>
</nav>
    <ul class="sidenav right" id="mobile-nav">
        <h5 class="center">Menu</h5>
        <?php 
                if(isset($_SESSION['fname'])){
                ?>
               
              
                <hr>
                <li><a href="logout.php"> <i class="material-icons">exit_to_app</i>LOGOUT</a></li>
                 <?php }
                else{ ?>
                   
                    <li> <a class="btn orange" href="login.php">LOGIN</a></li>
                    
                <?php } ?>
                
               
            </ul>
        </ul>