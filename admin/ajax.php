<?php
include 'config.php';
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $selectquery = " select * from access where teacher_id = $id";
    $query = mysqli_query($conn,$selectquery);
?>
    <option value="" disabled selected>Select Semester</option>
<?php

    while($row = mysqli_fetch_array($query)){ 
        $id = $row['id'];
        $sem = strtoupper($row['semester']); 
    
    
    echo "   
    
    <option value='$id'> $sem</option>
    ";
}
}

if(isset($_POST['stateId'])){
    $id = $_POST['stateId'];
    $selectquery = " select * from access_subject where teacher_id = $id";
    $query = mysqli_query($conn,$selectquery);
    ?>
    <option value="" disabled selected>Select Subject</option>
<?php
    while($row = mysqli_fetch_array($query)){ 
        $id = $row['id'];
        $sub = strtoupper($row['sub']); 
    
    
    echo "    <option value='$id'> $sub</option>
    ";
}
}
if(isset($_POST['cityId'])){
    $id = $_POST['cityId'];
    $selectquery = " select * from access_faculty where teacher_id = $id";
    $query = mysqli_query($conn,$selectquery);
    ?>
    <option value="" disabled selected>Select Faculty</option>
<?php
    while($row = mysqli_fetch_array($query)){ 
        $id = $row['id'];
        $faculty = strtoupper($row['faculty']); 
    
    
    echo "    <option value='$id'> $faculty</option>
    ";
}
}
?>