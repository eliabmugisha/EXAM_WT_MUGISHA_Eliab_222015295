<?php
 include('database_connection.php');

// Check if PaymentID is set
if(isset($_REQUEST['PaymentID'])) {
    $PID = $_REQUEST['PaymentID'];
    
    $stmt = $connection->prepare("SELECT * FROM payments WHERE PaymentID=?");
    $stmt->bind_param("i", $PID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['PaymentID'];
        $y = $row['Amount'];
        $z = $row['PaymentDate'];
        $x = $row['PaymentMethod'];
        
       

       
    } else {

     echo "payments not found.";
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Update payments</title>
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
    <!-- Update payments form -->
    <h2><u>Update Form of payments</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="Amount">Amount:</label>
        <input type="text" name="Amount" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="PaymentDate">PaymentDate:</label>
        <input type="date" name="PaymentDate" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

         <label for="PaymentMethod">PaymentMethod:</label>
        <input type="text" name="PaymentMethod" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>


       




        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
include('database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $A= $_POST['Amount'];
    $PDATE = $_POST['PaymentDate'];
    $PM= $_POST['PaymentMethod'];
    
   
    
    // Update the flight in the database
    $stmt = $connection->prepare("UPDATE payments SET Amount=?,PaymentDate=?,PaymentMethod=? WHERE PaymentID=?");
    $stmt->bind_param("ssss", $A, $PDATE , $PM,$PID);
    $stmt->execute();
    
    // Redirect to payments.php
    header('Location: payments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
