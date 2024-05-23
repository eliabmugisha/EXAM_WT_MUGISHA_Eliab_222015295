<?php
// Include the database connection file
include('database_connection.php');

// Check if NoteID is set
if (isset($_REQUEST['NoteID'])) {
    $NID = $_REQUEST['NoteID'];

    $stmt = $connection->prepare("SELECT * FROM progressnotes WHERE NoteID=?");
    $stmt->bind_param("i", $NID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['NoteID'];
        $y = $row['SessionID'];
        $z = $row['NoteContent'];
    } else {
        echo "Progress note not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update progressnotes</title>
    <style>
        body {
            background-color: deepskyblue; 
            color: red; /* Dark gray text */
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: red; /* Light Goldenrod Yellow */
            padding: 20px;
            border: 2px solid #4682b4; /* Steel Blue */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: black; /* Sea Green */
        }
        label {
            color: black; /* Slate Blue */
        }
        input[type="submit"] {
            background-color: yellow; 
            color: blue;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
        }
        input[type="submit"]:hover {
            background-color: black; /* Tomato */
        }
    </style>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <div class="container">
        <h2><u>Update Form of Progress Notes</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="SessionID">Session ID:</label>
            <input type="number" name="SessionID" value="<?php echo isset($y) ? $y : ''; ?>" required>
            <br><br>

            <label for="NoteContent">Note Content:</label>
            <input type="text" name="NoteContent" value="<?php echo isset($z) ? $z : ''; ?>" required>
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $SID = $_POST['SessionID'];
    $NC  = $_POST['NoteContent'];

    // Update the progress notes in the database
    $stmt = $connection->prepare("UPDATE progressnotes SET SessionID=?, NoteContent=? WHERE NoteID=?");
    $stmt->bind_param("ssi", $SID, $NC, $NID);
    $stmt->execute();

    // Redirect to progressnotes.php
    header('Location: progressnotes.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
$connection->close();
?>
