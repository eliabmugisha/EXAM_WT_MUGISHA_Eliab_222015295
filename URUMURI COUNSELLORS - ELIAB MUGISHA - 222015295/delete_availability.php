<?php
// Include the database connection file
    include('database_connection.php');
// Check if AvailabilityID is set
if(isset($_REQUEST['AvailabilityID'])) {
    $AID = $_REQUEST['AvailabilityID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM availability WHERE AvailabilityID=?");
    $stmt->bind_param("i", $AID);
     ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="AID" value="<?php echo $AID; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
}
?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "AvailabilityID is not set.";
}

$connection->close();
?>
