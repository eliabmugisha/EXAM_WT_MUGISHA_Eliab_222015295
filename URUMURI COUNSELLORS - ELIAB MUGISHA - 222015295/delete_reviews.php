<?php
// Include the database connection file
    include('database_connection.php');
// Check if ReviewID is set
if(isset($_REQUEST['ReviewID'])) {
    $RID = $_REQUEST['ReviewID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM reviews WHERE ReviewID=?");
    $stmt->bind_param("i", $RID);
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
            <input type="hidden" name="RID" value="<?php echo $RID; ?>">
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
    echo "ReviewID is not set.";
}

$connection->close();
?>
