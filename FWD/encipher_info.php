<?php
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


// SQL query to fetch data
$sql = "SELECT team_id, name, usn, college_email, contact, branch, semester FROM encipher_registrations"; // Replace with your table name
$result = $conn->query($sql);

// Check if records were found
$data = [];
if ($result->num_rows > 0) {
    // Fetch all rows into an array
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data = null;
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members Table</title>
    <style>
        /* Basic styles for table and page layout */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .no-data {
            text-align: center;
            color: red;
        }
    </style>
</head>
<body>
    <h1>Members Table</h1>

    <?php if ($data): ?>
        <table>
            <thead>
                <tr>
                    <th>Team ID</th>
                    <th>Name</th>
                    <th>USN</th>
                    <th>College Email</th>
                    <th>Contact</th>
                    <th>Branch</th>
                    <th>Semester</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?php echo $row['team_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['usn']; ?></td>
                        <td><?php echo $row['college_email']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
                        <td><?php echo $row['branch']; ?></td>
                        <td><?php echo $row['semester']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-data">No data found in the table.</p>
    <?php endif; ?>

    <!-- JavaScript for redirect -->
    <script>
        setTimeout(function() {
            window.location.href = "file:///C:/xampp/htdocs/FWD/events.html";
        }, 3000); // Redirect after 3 seconds
    </script>

</body>
</html>
