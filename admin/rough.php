<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Country State City</title>
        <!-- Latest compiled and minified CSS -->
        <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script scr="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script scr="js/jquery.js"></script>
        <style>
            body{
                background: #ccc;
            }
            form{
                background: #fff;
                padding: 30px;
                margin-top: 30px;
            }
            form h3{
                margin-top: 0;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <!--Course -->

                <form action="" name="form" method="POST">
                    
                               <label for="country">Country</label>
                                <select type="text" name="country" id="country" class="form-control">
                                    <option value="">Select Country</option>
                                    <?php
                                    $selectquery = " select * from teacher";
                                    $query = mysqli_query($conn,$selectquery);
                                    $num = mysqli_num_rows($query);
                                    while($res = mysqli_fetch_array($query)){  
                                        $fname = strtoupper($res['tfname']);
                                        $lname = strtoupper($res['tlname']);
                                        $name = $fname. " ".$lname  
                                    ?>
                                    <option value="<?php echo $res['id'];?>"><?php echo $name;?></option>
                                    <?php } ?>
                                </select>
                            <div class="col-md-4">
                                <label for="state">State</label>
                                <select type="text" id="state" name="state" class="form-control">
                                <option value="">Select Teacher</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="city">City</label>
                                <select name="city" id="city" class="form-control">
                                <option value="">Select Teacher</option>
                                </select>
                              
                            </div>
                            <div class="col-md-4">
                                <label for="chowk">Chowk</label>
                                <select name="chowk" id="chowk" class="form-control">
                                <option value="">Select Teacher</option>
                                </select>
                              
                            </div>

                      
                    
                </form>
            </div>
        </div>
        <!--- Jquery Library-->
      
    </body>
</html>
<script>
   $(document).ready(function(){
    $("#country").on('change',function(){
            var countryId=$(this).val();
            $.ajax({
                    method: "POST",
                    url:"ajax.php",
                    data:{id:countryId},
                    dataType:"html",
                    success:function(data){
                        $("#state").html(data);
                    }
            });
    });
    $("#country").on('change',function(){
            var stateId=$(this).val();
            $.ajax({
                    method: "POST",
                    url:"ajax.php",
                    data:{stateId:stateId},
                    dataType:"html",
                    success:function(data){
                        $("#city").html(data);
                    }
            });
    });
    $("#country").on('change',function(){
            var cityId=$(this).val();
            $.ajax({
                    method: "POST",
                    url:"ajax.php",
                    data:{cityId:cityId},
                    dataType:"html",
                    success:function(data){
                        $("#chowk").html(data);
                    }
            });
    });
});
</script>