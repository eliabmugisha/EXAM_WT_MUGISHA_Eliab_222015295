<?php
// Include the database connection file
include('database_connection.php');

// Check if SessionID is set
if (isset($_REQUEST['SessionID'])) {
    $SID = $_REQUEST['SessionID'];

    $stmt = $connection->prepare("SELECT * FROM sessions WHERE SessionID=?");
    $stmt->bind_param("i", $SID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $counselorID = $row['CounselorID'];
        $clientID = $row['ClientID'];
        $startTime = $row['StartTime'];
        $endTime = $row['EndTime'];
        $sessionNotes = $row['SessionNotes'];
    } else {
        echo "Session not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Session</title>
    <style>
        body {
            background-color: deepskyblue; 
            color: red;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: red;
            padding: 20px;
            border: 2px solid #4682b4;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: black;
        }
        label {
            color: black;
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
            background-color: black;
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
        <h2><u>Update Form of Session</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="CounselorID">Counselor ID:</label>
            <input type="number" name="CounselorID" value="<?php echo isset($counselorID) ? $counselorID : ''; ?>" required>
            <br><br>

            <label for="ClientID">Client ID:</label>
            <input type="number" name="ClientID" value="<?php echo isset($clientID) ? $clientID : ''; ?>" required>
            <br><br>

            <label for="StartTime">Start Time:</label>
            <input type="datetime-local" name="StartTime" value="<?php echo isset($startTime) ? date('Y-m-d\TH:i', strtotime($startTime)) : ''; ?>" required>
            <br><br>

            <label for="EndTime">End Time:</label>
            <input type="datetime-local" name="EndTime" value="<?php echo isset($endTime) ? date('Y-m-d\TH:i', strtotime($endTime)) : ''; ?>" required>
            <br><br>

            <label for="SessionNotes">Session Notes:</label>
            <input type="text" name="SessionNotes" value="<?php echo isset($sessionNotes) ? $sessionNotes : ''; ?>" required>
            <br><br>

            <input type="submit" name="update" value="Update">
        </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['update'])) {
    // Retrieve updated values from form
    $counselorID = $_POST['CounselorID'];
    $clientID = $_POST['ClientID'];
    $startTime = $_POST['StartTime'];
    $endTime = $_POST['EndTime'];
    $sessionNotes = $_POST['SessionNotes'];

    // Update the session in the database
    $stmt = $connection->prepare("UPDATE sessions SET CounselorID=?, ClientID=?, StartTime=?, EndTime=?, SessionNotes=? WHERE SessionID=?");
    $stmt->bind_param("iisssi", $counselorID, $clientID, $startTime, $endTime, $sessionNotes, $SID);
    $stmt->execute();

    // Redirect to sessions.php
    header('Location: sessions.php');
    exit();
}
$connection->close();
?>
