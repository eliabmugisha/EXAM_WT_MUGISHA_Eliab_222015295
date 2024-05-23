<?php
 include('database_connection.php');

// Check if AvailabilityID is set
if(isset($_REQUEST['AvailabilityID'])) {
    $AID = $_REQUEST['AvailabilityID'];
    
    $stmt = $connection->prepare("SELECT * FROM availability WHERE AvailabilityID=?");
    $stmt->bind_param("i", $AID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['AvailabilityID'];
        $y = $row['CounselorID'];
        $z = $row['DayOfWeek'];
        $x = $row['StartTime'];
        $y = $row['EndTime'];
       

       
    } else {

     echo "availability not found.";
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Update availability</title>
    <style>
        body {
            background-color: #f0f8ff; /* Alice Blue */
            color: #333333; /* Dark gray text */
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
            color: grey; /* Sea Green */
        }
        label {
            color: pink; /* Slate Blue */
        }
        input[type="submit"] {
            background-color: green; /* Orange Red */
            color: blue;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
        }
        input[type="submit"]:hover {
            background-color: #ff6347; /* Tomato */
        }
    </style>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update availability form -->
    <h2><u>Update Form of availability</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="CounselorID">CounselorID:</label>
        <input type="number" name="CounselorID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="DayOfWeek">DayOfWeek:</label>
        <input type="text" name="DayOfWeek" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

         <label for="StartTime">StartTime:</label>
        <input type="time" name="StartTime" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="EndTime">EndTime:</label>
        <input type="time" name="EndTime" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

         

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
include('database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $CID = $_POST['CounselorID'];
    $DW  = $_POST['DayOfWeek'];
    $STIME= $_POST['StartTime'];
    $ETIME = $_POST['EndTime'];
   
    
    // Update the flight in the database
    $stmt = $connection->prepare("UPDATE availability SET CounselorID=?,DayOfWeek=?,StartTime=?,EndTime=? WHERE AvailabilityID=?");
    $stmt->bind_param("sssss",  $CID , $DW,$STIME,$ETIME,$AID);
    $stmt->execute();
    
    // Redirect to availability.php
    header('Location: availability.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
