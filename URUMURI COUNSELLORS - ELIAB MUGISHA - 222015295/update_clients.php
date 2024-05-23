<?php
 include('database_connection.php');

// Check if ClientID is set
if(isset($_REQUEST['ClientID'])) {
    $CLID = $_REQUEST['ClientID'];
    
    $stmt = $connection->prepare("SELECT * FROM clients WHERE ClientID=?");
    $stmt->bind_param("i", $CLID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['ClientID'];
        $y = $row['RelationshipStatus'];
        $z = $row['RelationshipLength'];
        
       

       
    } else {

     echo "clients not found.";
    }
}



?>

<!DOCTYPE html>
<html>
<head>
    <title>Update clients</title>
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
<body body bgcolor="grey"><center>
    <!-- Update clients form -->
    <h2><u>Update Form of clients</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="RelationshipStatus">RelationshipStatus:</label>
        <select name="RelationshipStatus" id="RelationshipStatus">
            <option value="Dating">Dating</option>
            <option value="Married">Married</option>
             <option value="Divorce">Divorce</option>
        </select><br><br>

        <label for="RelationshipLength">RelationshipLength:</label>
        <input type="text" name="RelationshipLength" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        
        




        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
include('database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $RS = $_POST['RelationshipStatus'];
    $RL = $_POST['RelationshipLength'];
    
    
    // Update the clients in the database
    $stmt = $connection->prepare("UPDATE clients SET RelationshipStatus=?,RelationshipLength=? WHERE ClientID=?");
    $stmt->bind_param("sss", $RS, $RL , $CLID);
    $stmt->execute();
    
    // Redirect to clients.php
    header('Location: clients.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
