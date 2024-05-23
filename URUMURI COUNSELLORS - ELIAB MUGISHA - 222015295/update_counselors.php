<?php
 include('database_connection.php');

// Check if CounselorID is set
if(isset($_REQUEST['CounselorID'])) {
    $CID = $_REQUEST['CounselorID'];
    
    $stmt = $connection->prepare("SELECT * FROM counselors WHERE CounselorID=?");
    $stmt->bind_param("i", $CID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['CounselorID'];
        $y = $row['Experience'];
        $z = $row['LicenseNumber'];
        $x = $row['Education'];
        
       

       
    } else {

     echo "counselors not found.";
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Update counselors</title>
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
    <!-- Update counselors form -->
    <h2><u>Update Form of counselors</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="Experience">Experience:</label>
        <input type="text" name="Experience" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="LicenseNumber">LicenseNumber:</label>
        <input type="number" name="LicenseNumber" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

         <label for="Education">Education:</label>
        <input type="text" name="Education" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>


        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
include('database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $E = $_POST['Experience'];
    $LNUMBER  = $_POST['LicenseNumber'];
    $ED= $_POST['Education'];
    
   
    
    // Update the flight in the database
    $stmt = $connection->prepare("UPDATE counselors SET Experience=?,LicenseNumber=?,Education=? WHERE CounselorID=?");
    $stmt->bind_param("ssss", $E,$LNUMBER, $ED ,$CID);
    $stmt->execute();
    
    // Redirect to counselors.php
    header('Location: counselors.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>

   

    
   


        
        




        

   