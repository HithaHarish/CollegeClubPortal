<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "college_club";
$port = 3307; // Updated port

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get team size from form
    $team_size = $_POST['teamSize'];

    // Insert team into 'teams' table with a prepared statement
    $stmt = $conn->prepare("INSERT INTO teams (team_size) VALUES (?)");
    $stmt->bind_param("i", $team_size);  // 'i' means integer
    if ($stmt->execute()) {
        // Get the last inserted team_id
        $team_id = $conn->insert_id;

        // Loop through and insert each team member into 'team_members' table
        for ($i = 1; $i <= $team_size; $i++) {
            // Collect each team member's data from the form
            $name = $_POST['name'.$i];
            $usn = $_POST['usn'.$i];
            $college_email = $_POST['collegeEmail'.$i];
            $contact = $_POST['contact'.$i];
            $branch = $_POST['branch'.$i];
            $semester = $_POST['semester'.$i];

            // Insert team member into the 'team_members' table with a prepared statement
            $stmt_member = $conn->prepare("INSERT INTO 	encipher_registrations (team_id, name, usn, college_email, contact, branch, semester) 
                                          VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt_member->bind_param("issssss", $team_id, $name, $usn, $college_email, $contact, $branch, $semester);

            if (!$stmt_member->execute()) {
                echo "Error inserting member: " . $stmt_member->error;
            }
        }

        // Successful registration message
        // Redirect to the same page to prevent form resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit; // Make sure no further code is executed

    } else {
        // Output error if team insertion fails
        echo "Error inserting team: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
