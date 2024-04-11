<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Elections</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.css" rel="stylesheet">
    <style>
        /* Additional custom styles can be added here */
    </style>
</head>
<body class="bg-gray-100">
<?php include 'navbar.php'; ?>
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4" style="font-size: 24px;">Upcoming Elections</h1><br>
    <div class="flex justify-center" id="calendar"></div>
    <div class="mt-8">
        <h2 class="text-xl font-semibold mb-4">Election Details</h2>
        <table class="w-full border-collapse border border-gray-200">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-8 py-4">Election ID</th>
                    <th class="px-12 py-4">Name of Election</th>
                    <th class="px-8 py-4">Date of Election</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Establish connection to your database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "votero";

                // Attempt to connect to the database
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check for connection errors
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch data from the election table
                $sql = "SELECT * FROM Election";
                $result = $conn->query($sql);

                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='px-8 py-4'>" . $row["Election_ID"] . "</td>";
                    echo "<td class='px-12 py-4'>" . $row["Election_Name"] . "</td>";
                    echo "<td class='px-8 py-4'>" . $row["Election_Date"] . "</td>";
                    echo "</tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth', // Set the initial view to month view
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: <?php echo json_encode($events); ?> // Pass your events data here
        });

        calendar.render();
    });
</script>

<?php
// Establish connection to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "votero";

// Attempt to connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the election table
$sql = "SELECT * FROM Election";
$result = $conn->query($sql);

// Initialize events array
$events = array();

// Populate events array with data from the database
while ($row = $result->fetch_assoc()) {
    $events[] = array(
        'title' => $row['Election_Name'],
        'start' => $row['Election_Date']
    );
}

// Close the database connection
$conn->close();
?>
</body>
</html>


