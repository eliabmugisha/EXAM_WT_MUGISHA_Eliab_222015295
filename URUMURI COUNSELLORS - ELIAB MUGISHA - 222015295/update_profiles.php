<?php
 include('database_connection.php');

// Check if ProfileID is set
if(isset($_REQUEST['ProfileID'])) {
    $PID = $_REQUEST['ProfileID'];
    
    $stmt = $connection->prepare("SELECT * FROM profiles WHERE ProfileID=?");
    $stmt->bind_param("i", $PID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['ProfileID'];
        $y = $row['FullName'];
        $z = $row['Gender'];
        $x = $row['Age'];
        $x = $row['Location'];
        
       

       
    } else {

     echo "profiles not found.";
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Update profiles</title>
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
<body><center>
    <!-- Update profiles form -->
    <h2><u>Update Form of profiles</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="FullName">FullName:</label>
        <input type="text" name="FullName" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="Gender">Gender:</label>
         <select name="Gender" id="Gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br><br>

         <label for="Age">Age:</label>
        <input type="text" name="Age" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <label for="Location">Location:</label>
        <input type="text" name="Location" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>


        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
include('database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $FNAME = $_POST['FullName'];
    $G  = $_POST['Gender'];
    $A= $_POST['Age'];
    $L= $_POST['Location'];
    
    
   
    
    // Update the flight in the database
    $stmt = $connection->prepare("UPDATE profiles SET FullName=?,Gender=?,Age=?,Location=? WHERE ProfileID=?");
    $stmt->bind_param("sssss", $FNAME,$G, $A ,$L,$PID);
    $stmt->execute();
    
    // Redirect to profiles.php
    header('Location: profiles.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>

   

    
   


        
        




        

   