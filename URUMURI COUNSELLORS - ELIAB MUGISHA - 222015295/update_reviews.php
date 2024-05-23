<?php
 include('database_connection.php');

// Check if ReviewID is set
if(isset($_REQUEST['ReviewID'])) {
    $RID = $_REQUEST['ReviewID'];
    
    $stmt = $connection->prepare("SELECT * FROM reviews WHERE ReviewID=?");
    $stmt->bind_param("i", $RID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['ReviewID'];
        $y = $row['CounselorID'];
        $z = $row['ClientID'];
        $x = $row['ReviewContent'];
        
       
    } else {

     echo "reviews not found.";
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Update reviews</title>
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
    <!-- Update reviews form -->
    <h2><u>Update Form of reviews</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="CounselorID">CounselorID:</label>
        <input type="number" name="CounselorID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="ClientID">ClientID:</label>
        <input type="number" name="ClientID" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

         <label for="ReviewContent">ReviewContent:</label>
        <input type="text" name="ReviewContent" value="<?php echo isset($y) ? $y : ''; ?>">
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
    $CLID  = $_POST['ClientID'];
    $RC= $_POST['ReviewContent'];
    
   
    
    // Update the reviews in the database
    $stmt = $connection->prepare("UPDATE reviews SET CounselorID=?,ClientID=?,ReviewContent=? WHERE ReviewID=?");
    $stmt->bind_param("ssss", $CID, $CLID , $RC,$RID);
    $stmt->execute();
    
    // Redirect to reviews.php
    header('Location: reviews.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
