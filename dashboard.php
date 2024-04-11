<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Custom CSS styles here */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            animation: changeBackground 10s linear infinite;
        }

        @keyframes changeBackground {
            0% {
                background-color: rgb(255, 0, 0); /* Red */
            }

            25% {
                background-color: rgb(0, 255, 0); /* Green */
            }

            50% {
                background-color: rgb(0, 0, 255); /* Blue */
            }

            75% {
                background-color: rgb(255, 255, 0); /* Yellow */
            }

            100% {
                background-color: rgb(255, 0, 255); /* Magenta */
            }
        }

        .container {
            margin-top: 20px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .logout-btn {
            margin-bottom: 20px;
        }

        .card {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            color: #333;
            margin-bottom: 20px;
            border: none;
            border-radius: 10px;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            padding: 20px;
        }

        .quote {
            font-size: 18px;
        }

        /* Custom CSS for pagination */
        .pagination .page-item.active .page-link {
            background-color: #007bff; /* Change to the desired color */
            border-color: #007bff; /* Change to the desired color */
            color: #fff; /* Change to the desired color */
        }

        .pagination .page-item.active .page-link:hover {
            background-color: #0056b3; /* Change to the desired color */
            border-color: #0056b3; /* Change to the desired color */
            color: #fff; /* Change to the desired color */
        }
    </style>
</head>

<body>
    <div class="container p-4" style="max-width: 1600px;">
        <div class="text-right mb-4">
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
        <div class="text-center mb-4">
            <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2><br>
            <h4>A Program created by Aashik</h4>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <h5 class="card-header">Current Time</h5>
                    <div class="card-body" id="time-info">
                        <!-- Time information will be updated dynamically -->
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <h5 class="card-header">Thought for the Day</h5>
                    <div class="card-body" id="quote-info">
                        <!-- Quote information will be updated dynamically -->
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h2 class="card-header">List of Students</h2>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Student ID</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="student-table-body">
<<<<<<< HEAD
                                    <!-- Student records will be dynamically loaded here -->
=======
                                    <?php
                                    // Include db_connect.php to establish a database connection
                                    include 'db_connect.php';

                                    // Pagination variables
                                    $results_per_page = 10;
                                    $sql_students = "SELECT full_name, student_id FROM StudentRecords";
                                    $result_students = $connection->query($sql_students);
                                    $num_rows = $result_students->num_rows;
                                    $num_pages = ceil($num_rows / $results_per_page);

                                    // Get current page from URL query string
                                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                    $start_index = ($page - 1) * $results_per_page;

                                    // Retrieve students for the current page
                                    $sql_page = "SELECT full_name, student_id FROM StudentRecords LIMIT $start_index, $results_per_page";
                                    $result_page = $connection->query($sql_page);

                                    if ($result_page->num_rows > 0) {
                                        while ($row = $result_page->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td><a href='student_details.php?id=" . $row['student_id'] . "'>" . $row['full_name'] . "</a></td>";
                                            echo "<td>" . $row['student_id'] . "</td>";
                                            echo "<td><button class='btn btn-danger' onclick='deleteStudent(" . $row['student_id'] . ")'>Delete</button></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='3'>No students found.</td></tr>";
                                    }
                                    ?>
>>>>>>> b79d957c247dc2937c9fca5b55ac6f3294902608
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination links -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center" id="pagination-links">
                                <!-- Pagination links will be dynamically loaded here -->
                            </ul>
                            <!-- Loading spinner -->
                            <div id="loading-spinner" class="spinner-border text-primary" role="status" style="display: none;">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </nav>
                        <a href="add_student.php" class="btn btn-primary">Add Student</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for AJAX -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
<<<<<<< HEAD
        // Function to fetch time information via AJAX
        function getTime() {
            $.ajax({
                url: 'get_time.php',
                success: function(response) {
                    $('#time-info').text('Current Time: ' + response);
                }
            });
        }

        // Function to fetch quote information via AJAX
        function getQuote() {
            $.ajax({
                url: 'get_quote.php',
                success: function(response) {
                    $('#quote-info').text(response);
                }
            });
        }

        // Function to fetch paginated student records
        function getStudents(page) {
            // Show loading spinner
            $('#loading-spinner').show();

            $.ajax({
                url: 'get_students.php?page=' + page,
                success: function(response) {
                    // Hide loading spinner
                    $('#loading-spinner').hide();
                    $('#student-table-body').html(response);
                }
            });
        }

        // Attach click event to pagination links
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            getStudents(page);
        });

        // Attach click event to delete buttons
        $(document).on('click', '.delete-btn', function() {
            var studentId = $(this).data('student-id');
            if (confirm('Are you sure you want to delete this student?')) {
                $.ajax({
                    url: 'delete_student.php',
                    method: 'POST',
                    data: { student_id: studentId },
                    success: function(response) {
                        if (response.success) {
                            // Refresh student list after deletion
                            getStudents(<?php echo isset($_GET['page']) ? $_GET['page'] : 1; ?>);
                        } else {
                            alert("Error deleting student: " + response.error);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error deleting student:", error);
                    }
                });
            }
        });
=======
     // Function to fetch time information via JavaScript
    function getTime() {
        var options = {
            hour: 'numeric',
            minute: 'numeric',
            second: 'numeric',
            hour12: true // Display time in 12-hour format
        };
        var currentTime = new Date().toLocaleTimeString([], options);
        $('#time-info').text('Current Time: ' + currentTime);
    }
>>>>>>> b79d957c247dc2937c9fca5b55ac6f3294902608

        // Initial load of students
        getStudents(<?php echo isset($_GET['page']) ? $_GET['page'] : 1; ?>);

<<<<<<< HEAD
        // Initial call to fetch time and quote information
        getTime();
        getQuote();

        // Update time every second
        setInterval(getTime, 1000);

        // Update quote every 30 seconds
        setInterval(getQuote, 30000);
    </script>
=======
    // Initial call to fetch time and quote information
    getTime();
    getQuote();

    // Update time every second
    setInterval(getTime, 1000);

    // Update quote every 30 seconds
    setInterval(getQuote, 30000);
    
    // Function to delete a student record asynchronously
    function deleteStudent(studentId) {
        // First confirmation dialog
        if (confirm('Are you sure you want to delete this student record?')) {
            // Second confirmation dialog
            if (confirm('This action is irreversible. Are you absolutely sure?')) {
                $.ajax({
                    url: 'delete_student.php?id=' + studentId,
                    type: 'GET',
                    beforeSend: function() {
                        // Show loading spinner before sending the request
                        $('#loading-spinner').show();
                    },
                    success: function(response) {
                        // Redirect to the dashboard after successful deletion
                        window.location.href = 'dashboard.php';
                    },
                    error: function(xhr, status, error) {
                        // Display an error message if deletion fails
                        alert('Error deleting student record. Please try again.');
                    },
                    complete: function() {
                        // Remove loading spinner after request completion
                        $('#loading-spinner').hide();
                    }
                });
            }
        }
    }
</script>


>>>>>>> b79d957c247dc2937c9fca5b55ac6f3294902608
</body>

</html>
