<?php
include 'config.php';


if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql="DELETE FROM contact_form WHERE id=$id";
    $query=mysqli_query($conn,$sql);
      if($query){
          ?>
          <script>
              alert("Data has been deleted");
              window.location.href="http://localhost/safs/admin/message.php";
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
<div class="row">
<div class="container">
<p><a href="/safs/admin">Dashboard</a>> Messages from others</p><hr>

<div class="col s12 l12">

  
<?php
    $selectquery = " select * from contact_form order by id desc";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query); ?>
   

    <?php
    if ($num == 0) {
      echo '<p class="empty">No any messages right now</p>';
    } else{?>
    <h5 class="highlight"><i class="material-icons">dehaze</i> List of Messages
    


  
  </h5>
   <span class="num_date"> Number of Messages: (<?php echo $num;?>) </span> 
    <span class="num_date">Last Updated:
    <?php
    $sql = "SELECT MAX(registeredate) AS latest_date FROM assignment";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$latestDate = $row['latest_date'];
echo $latestDate;
?>
    </span>
        <table class="responsive-table"
  <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>Messages</th>
    <th>Date</th>
    <th>Ip Address</th>
    <th>Delete</th>
    
  </tr>
    <?php
    $selectquery = " select * from contact_form order by id desc";
    $query = mysqli_query($conn,$selectquery);
    $num = mysqli_num_rows($query);
    while($res = mysqli_fetch_array($query)){
       
        $fname = $res['first_name'];
        $lname = $res['last_name'];
        $email = $res['email'];
       
        $date = $res['dateofsubmit'];
        $ip = $res['ip_address'];
        $question = $res['messages'];

       
        ?>
       
        <tr>
           <td><?php echo $fname;?></td>

            <td><?php echo $lname;?> </td>
           <td><?php echo $email ;?></td>
        
           
            
            <td>
                                                    <?php if ($question){?>
                                                    <a href="#modal<?php echo $res['id']; ?>" class=" modal-trigger"><b>Read</b></a>    
                                                  <?php }else{ ?>
                                                    <span class="no">(No text)</span>
                                                    <?php }?>
                                                  </td>
                                                  <td><?php echo $date; ?> </td>
            <td><?php echo $ip; ?> </td>
                                                 <td>
                                                 <a href="message.php?delete=<?php echo $res['id'];?>"><i class="material-icons">delete</i></a>

                                                 </td>


                                                  <div id="modal<?php echo $res['id']; ?>" class="modal">
                                <div class="modal-content text">
                                  <center>
                                      <h4><b>CASE No:<?php echo $res['id']; ?></b></h4>
                                  </center>
                                    <p style="float:right"><b>Date: <?php echo $res['dateofsubmit'];?></b> </p>
                                      <h5>  
                                         
                                      <b>Message:
            </b>
                                        </h5> <hr> 
                                            <p><?php echo $question;?></p>
                                  </div>
                                    <div class="modal-footer">
                                        <a href="#!" class="modal-close waves-effect waves-green btn-flat"><b>Close</b></a>
                                    </div>
                              </div>



           


          
<?php

    }}
?>
    </div>
    </div>
    </div>

    <script>
       $(document).ready(function(){
    $('select').formSelect();
  });
    </script>