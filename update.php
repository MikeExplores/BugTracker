<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Bug</title>
</head>

<body>
    <?php

    // Connect to DB
    $link = mysqli_connect("localhost", "root", "", "bug_tracker");
    // Check connection
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    // Get bug_id from URL
    $id = filter_input(INPUT_GET, 'bug_id', FILTER_SANITIZE_URL);

    // Get all table values from bugs table in DB for selected bug
    $query = "SELECT * FROM `bugs` WHERE bug_id='" . $id . "'";
    $result = mysqli_query($link, $query);
    $response = mysqli_fetch_array($result);

    // Check if record is submitted and assign POST values to variables
    if (isset($_POST['update'])) {

        // Connect to DB
        $link = mysqli_connect("localhost", "root", "", "bug_tracker");

        // Check connection
        if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        // Get bug_id from URL
        $id = filter_input(INPUT_GET, 'bug_id', FILTER_SANITIZE_URL);
        echo "THIS IS THE ID: ". $id;

        // Assign inputs to variables
        $product_name = $_POST['product_name'];
        $version = $_POST['version'];
        $hardware_type = $_POST['hardware_type'];
        $operating_system = $_POST['operating_system'];
        $occurrence_frequency = $_POST['occurrence_frequency'];
        $proposed_solution = $_POST['proposed_solution'];

        // Try UPDATE
        $sql = "UPDATE `bugs` SET
            `product_name` = '" . $product_name . "', 
            `version` = '" . $version . "', 
            `hardware_type` = '" . $hardware_type . "', 
            `operating_system` = '" . $operating_system . "',
            `occurrence_frequency` = '" . $occurrence_frequency . "',
            `proposed_solution` = '" . $proposed_solution . "'
            WHERE `bug_id` = '$id'";
        echo $sql;
        if (mysqli_query($link, $sql)) {
            echo "Bug updated.";
            //redirects to all records page
            header("location:index.php"); 
            exit;
        } else {
            echo "Could not update.";
        }
    };
    // Close connection
    mysqli_close($link);
    ?>
    <h1>Update existing bug record:</h1>
    <form action="update.php?bug_id=<?php echo $id;?>" method="post">
        <p>
            <label for="productName">Product Name:</label>
            <input type="text" name="product_name" id="productName" value="<?php echo $response['product_name']; ?>" required />
        </p>
        <p>
            <label for="version">Version:</label>
            <input type="text" name="version" id="version" value="<?php echo $response['version']; ?>" required />
        </p>
        <p>
            <label for="hardwareType">Hardware Type:</label>
            <input type="text" name="hardware_type" id="hardwareType" value="<?php echo $response['hardware_type']; ?>" required />
        </p>
        <p>
            <label for="operatingSystem">Operating System:</label>
            <input type="text" name="operating_system" id="operatingSystem" value="<?php echo $response['operating_system']; ?>" required />
        </p>
        <p>
            <label for="occurrenceFrequency">Occurrence Frequency:</label>
            <input type="text" name="occurrence_frequency" id="occurrenceFrequency" value="<?php echo $response['occurrence_frequency']; ?>" required />
        </p>
        <p>
            <label for="proposedSolution">Proposed Solution:</label>
            <input type="text" name="proposed_solution" id="proposedSolution" value="<?php echo $response['proposed_solution']; ?>" required />
        </p>
        <input type="submit" name="update" value="Submit" />
        <input type="reset" value="Reset" />
    </form>
    <p>
        <a href="index.php">Return to Bug Tracker</a><br />
    </p>
</body>

</html>
