<?php
// Include your db_connect.php file to establish a database connection
include 'db_connect.php';

$response = array();

// Check if the student ID is provided in the POST data
if(isset($_POST['student_id'])) {
    // Sanitize the input to prevent SQL injection
    $student_id = $_POST['student_id'];
    
    // Prepare the delete statement
    $sql_delete = "DELETE FROM StudentRecords WHERE student_id = ?";
    $stmt = $connection->prepare($sql_delete);
    $stmt->bind_param("i", $student_id);
    
    // Execute the delete statement
    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['error'] = "Error deleting record: " . $stmt->error;
    }
    
    // Close the prepared statement
    $stmt->close();
} else {
    $response['success'] = false;
    $response['error'] = "Student ID not provided";
}

// Close the database connection
$connection->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
