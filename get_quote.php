<?php
// Include your db_connect.php file to establish a database connection
include 'db_connect.php';

// Assuming you have a Quotes table with a column named 'quote'
$sql = "SELECT quote FROM Quotes ORDER BY RAND() LIMIT 1";
$result = $connection->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row["quote"];
    } else {
        echo "No quotes available";
    }
} else {
    echo "Error fetching quotes: " . $connection->error;
}

$connection->close();
?>
