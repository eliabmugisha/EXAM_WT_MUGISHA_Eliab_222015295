<?php
 include('database_connection.php');

// Check if AppointmentID is set
if(isset($_REQUEST['AppointmentID'])) {
    $AID = $_REQUEST['AppointmentID'];
    
    $stmt = $connection->prepare("SELECT * FROM appointments WHERE AppointmentID=?");
    $stmt->bind_param("i", $AID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['AppointmentID'];
        $y = $row['ClientID'];
        $z = $row['CounselorID'];
        $x = $row['AppointmentDate'];
        $y = $row['AppointmentTime'];
       

       
    } else {

     echo "appointments not found.";
    }
}
?> 



<!DOCTYPE html>
<html>
<head>
    <title>Update appointments</title>
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
<body body bgcolor="pink"><center>
    <!-- Update appointments form -->
    <h2><u>Update Form of appointments</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="ClientID">ClientID:</label>
        <input type="number" name="ClientID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="CounselorID">CounselorID:</label>
        <input type="number" name="CounselorID" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

         <label for="AppointmentDate">AppointmentDate:</label>
        <input type="date" name="AppointmentDate" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="AppointmentTime">AppointmentTime:</label>
        <input type="time" name="AppointmentTime" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        



        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
include('database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $CLID = $_POST['ClientID'];
    $CID  = $_POST['CounselorID'];
    $ADATE= $_POST['AppointmentDate'];
    $ATIME = $_POST['AppointmentTime'];
   
    
    // Update the appointments in the database
    $stmt = $connection->prepare("UPDATE appointments SET ClientID=?,CounselorID=?,AppointmentDate=?,AppointmentTime=? WHERE AppointmentID=?");
    $stmt->bind_param("sssss", $CLID, $CID , $ADATE,$ATIME,$AID);
    $stmt->execute();
    
    // Redirect to appointments.php
    header('Location: appointments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
