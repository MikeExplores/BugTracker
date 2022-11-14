<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Bug</title>
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
    if (isset($_POST['submit'])) {

        // Connect to DB
        $link = mysqli_connect("localhost", "root", "", "bug_tracker");

        // Check connection
        if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        // Get bug_id from URL
        $id = filter_input(INPUT_GET, 'bug_id', FILTER_SANITIZE_URL);
        echo "THIS IS THE ID: ". $id;

        // Try DELETE
        $sql = "DELETE FROM `bugs` WHERE `bug_id` = '$id'";
        echo $sql;
        if (mysqli_query($link, $sql)) {
            echo "Bug deleted.";
            //redirects to all records page
            header("location:index.php"); 
            exit;
        } else {
            echo "Could not delete.";
        }
    };
    // Close connection
    mysqli_close($link);
    ?>
    <h1>Delete record for Bug <?php echo $id?>?</h1>
    <form action="delete.php?bug_id=<?php echo $id?>" method="post">
        <p>Product Name: <?php echo $response['product_name']?></p>
        <p>Version: <?php echo $response['version']?></p>
        <p>Hardware Type: <?php echo $response['hardware_type']?></p>
        <p>Operating System: <?php echo $response['operating_system']?></p>
        <p>Occurrence Frequency: <?php echo $response['occurrence_frequency']?></p>
        <p>Proposed Solution: <?php echo $response['proposed_solution']?></p>
        <input type="submit" name="submit" value="Delete" />
        <input type="button" value="Edit" onclick="document.location='update.php?bug_id=<?php echo $id?>'" />
        <input type="button" value="Back" onclick="document.location='index.php'" />
    </form>
</body>

</html>
