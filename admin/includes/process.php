<?php
// Establish the database connection
$server = "localhost";
$username = "root";
$password = "";
$database = "safs";

$connection = mysqli_connect($server, $username, $password, $database);

if(!$connection){
    die("<script>alert('failed')</script>");
}

// Retrieve the selected sorting option
$sortBy = $_POST['sort-by'];

// Your MySQL query
$query = "SELECT * FROM assignment ORDER BY registeredate";

// Execute the query and fetch the sorted results
$result = mysqli_query($connection, $query);

// Check if any results were returned
if (mysqli_num_rows($result) > 0) {
    // Output the sorted data
    echo "<table>";
    echo "<tr><th>Registration Date</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['registeredate'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No data found.";
}

// Close the database connection
mysqli_close($connection);
?>
