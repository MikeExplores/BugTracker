<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Bug</title>
</head>

<body>
    <?php
    // Check if record is submitted and assign POST values to variables
    if (isset($_POST['submit'])) {
        // Connect to DB
        $link = mysqli_connect("localhost", "root", "", "bug_tracker");

        // Check connection
        if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        // Securely escape inputs
        $product_name = mysqli_real_escape_string($link, $_REQUEST['product_name']);
        $version = mysqli_real_escape_string($link, $_REQUEST['version']);
        $hardware_type = mysqli_real_escape_string($link, $_REQUEST['hardware_type']);
        $operating_system = mysqli_real_escape_string($link, $_REQUEST['operating_system']);
        $occurrence_frequency = mysqli_real_escape_string($link, $_REQUEST['occurrence_frequency']);
        $proposed_solution = mysqli_real_escape_string($link, $_REQUEST['proposed_solution']);

        // Try INSERT
        $sql = "INSERT INTO bugs (
            product_name, 
            version, 
            hardware_type, 
            operating_system, 
            occurrence_frequency, 
            proposed_solution
        ) VALUES (
            '$product_name', 
            '$version', 
            '$hardware_type', 
            '$operating_system',
            '$occurrence_frequency',
            '$proposed_solution'
        )";
        if (mysqli_query($link, $sql)) {
            echo "New bug added.";
            //redirects to all records page
            header("location:index.php"); 
            exit;
        } else {
            echo "Could not execute query.";
        }

        // Close connection
        mysqli_close($link);
    }
    ?>
    <h1>Create a new bug record:</h1>
    <form action="insert.php" method="post">
        <p>
            <label for="productName">Product Name:</label>
            <input type="text" name="product_name" id="productName" required />
        </p>
        <p>
            <label for="version">Version:</label>
            <input type="text" name="version" id="version" required />
        </p>
        <p>
            <label for="hardwareType">Hardware Type:</label>
            <input type="text" name="hardware_type" id="hardwareType" required />
        </p>
        <p>
            <label for="operatingSystem">Operating System:</label>
            <input type="text" name="operating_system" id="operatingSystem" required />
        </p>
        <p>
            <label for="occurrenceFrequency">Occurrence Frequency:</label>
            <input type="text" name="occurrence_frequency" id="occurrenceFrequency" required />
        </p>
        <p>
            <label for="proposedSolution">Proposed Solution:</label>
            <input type="text" name="proposed_solution" id="proposedSolution" required />
        </p>
        <input type="submit" name="submit" value="Create" />
        <input type="reset" value="Reset" />
        <input type="button" value="Back" onclick="document.location='index.php'" />
    </form>
</body>

</html>
