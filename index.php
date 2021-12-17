<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bug Tracker</title>
    <style>
        td {
            padding-right: 30px;
        }
    </style>
</head>

<body>
    <h1>Bug Tracker</h1>
    <?php
    // Connect to DB
    $link = mysqli_connect("localhost", "root", "", "bug_tracker");

    // Get all table records from bugs table in DB
    $query = "SELECT * FROM bugs";
    $result = mysqli_query($link, $query);

    //Open table tag
    echo "<table border='1'>";

    // Render table headings
    echo
    "<tr><td style=>" . "<h3>Bug ID#</h3>" .
        "</td><td>" . "<h3>Product Name</h3>" .
        "</td><td>" . "<h3>Version</h3>" .
        "</td><td>" . "<h3>Hardware Type</h3>" .
        "</td><td>" . "<h3>Operating System</h3>" .
        "</td><td>" . "<h3>Occurrence Frequency</h3>" .
        "</td><td>" . "<h3>Proposed Solution</h3>" . "</td></tr>";
    
    // Initialize counter to use as URL param to find selected record
    $counter = 1;    
    
    // Render each record as a row
    while ($row = mysqli_fetch_array($result)) {
        echo
        "<tr><td>" . $row['bug_id'] .
            "</td><td>" . $row['product_name'] .
            "</td><td>" . $row['version'] .
            "</td><td>" . $row['hardware_type'] .
            "</td><td>" . $row['operating_system'] .
            "</td><td>" . $row['occurrence_frequency'] .
            "</td><td>" . $row['proposed_solution'] .
            "</td><td>" . "<a href='update.php?bug_id=$counter'>Edit</a>" . "</td></tr>";
    $counter++;
    }
    echo "</table>";

    // Close connection
    mysqli_close($link);
    ?>
    <p>
        <!-- Link to create new record -->
        <a href="insert.php">Add a bug</a>
    </p>
</body>

</html>
