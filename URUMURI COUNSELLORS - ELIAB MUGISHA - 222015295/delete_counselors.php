<?php
// Include the database connection file
    include('database_connection.php');
// Check if CounselorID is set
if(isset($_REQUEST['CounselorID'])) {
    $CID = $_REQUEST['CounselorID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM counselors WHERE CounselorID=?");
    $stmt->bind_param("i", $CID);
     ?>
   <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <style>
            body {
                background-color: grey; /* Alice Blue */
                color: pink; /* Dark gray text */
                font-family: Arial, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .container {
                background-color: black; /* Light Goldenrod Yellow */
                padding: 20px;
                border: 2px solid #4682b4; /* Steel Blue */
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            h1 {
                color: yellow; /* Sea Green */
            }
            p {
                color: blue; /* Slate Blue */
            }
            input[type="submit"] {
                background-color: red; 
                color: green;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
            }
            input[type="submit"]:hover {
                background-color: skyblue; /* Tomato */
            }
        </style>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="CID" value="<?php echo $CID; ?>">
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
    echo "CounselorID is not set.";
}

$connection->close();
?>
