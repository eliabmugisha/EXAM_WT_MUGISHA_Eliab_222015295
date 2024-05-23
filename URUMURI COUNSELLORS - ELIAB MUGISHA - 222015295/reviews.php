<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REVIEWS</title>
    <style>
        body {
            background-color: grey;
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        header {
            background-color: black;
            padding: 20px;
            text-align: center;
        }
        section {
            padding: 20px;
            border-bottom: 1px solid #ddd;
            background-color: mediumslateblue;
        }
        footer {
            text-align: center;
            padding: 15px;
            background-color: burlywood;
        }
        .dropdown {
            position: relative;
            display: inline-block;
            margin-right: 10px;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .search-form {
            text-align: right; /* Adjusted to right but within normal flow */
        }
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            text-align: center; /* Centered navigation links */
        }
        ul li {
            display: inline;
            margin-right: 10px;
        }
        ul li a {
            padding: 1px;
            color: white;
            background-color: skyblue;
            text-decoration: none;
            margin-right: 1px;
        }
        /* Updated styles for settings menu */
        .dropdown-content a {
            display: block;
            padding: 5px 10px;
            color: #333; /* Updated color */
            text-decoration: none;
        }
        .dropdown-content a:hover {
            background-color: #ddd; /* Updated hover background color */
        }
    </style>
</head>
<body>
<header>
    <!-- Search Form now right above the navigation links -->
    <form class="search-form" role="search" action="search.php">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    <ul>
       <img src="logo platform.JFIF" alt="Logo" height="50" width="50">
        <!-- List of Navigation Links -->
        <li style="display: inline; margin-right: 1px;"><a href="./HOME.html" style="padding: 1px; color: white; background-color: skyblue; text-decoration: none; margin-right: 1px;">HOME</a></li>
        <li style="display: inline; margin-right: 1px;"><a href="./CONTACT.html" style="padding: 1px; color: white; background-color: skyblue; text-decoration: none; margin-right: 1px;">CONTACT</a></li>
        <li style="display: inline; margin-right: 1px;"><a href="./ABOUT.html" style="padding: 1px; color: white; background-color: skyblue; text-decoration: none; margin-right: 1px;">ABOUT</a></li>

        <li style="display: inline; margin-right: 1px;"><a href="./appointments.php" style="padding: 1px; color: white; background-color: skyblue; text-decoration: none; margin-right: 1px;">appointments</a></li>
        <li style="display: inline; margin-right: 1px;"><a href="./availability.php" style="padding: 1px; color: white; background-color: skyblue; text-decoration: none; margin-right: 1px;">availability</a></li>
        <li style="display: inline; margin-right: 1px;"><a href="./clients.php" style="padding: 1px; color: white; background-color: skyblue; text-decoration: none; margin-right: 1px;">clients</a></li>
        <li style="display: inline; margin-right: 1px;"><a href="./counselors.php" style="padding: 1px; color: white; background-color: skyblue; text-decoration: none; margin-right: 1px;">counselors</a></li>
        <li style="display: inline; margin-right: 1px;"><a href="./payments.php" style="padding: 1px; color: white; background-color: skyblue; text-decoration: none; margin-right: 1px;">payments</a></li>
         <li style="display: inline; margin-right: 1px;"><a href="./profiles.php" style="padding: 1px; color: white; background-color: skyblue; text-decoration: none; margin-right: 1px;">profiles</a></li>
        <li style="display: inline; margin-right: 1px;"><a href="./progressnotes.php" style="padding: 1px; color: white; background-color: skyblue; text-decoration: none; margin-right: 1px;">progressnotes</a></li>
         <li style="display: inline; margin-right: 1px;"><a href="./reviews.php" style="padding: 1px; color: white; background-color: skyblue; text-decoration: none; margin-right: 1px;">reviews</a></li>
         <li style="display: inline; margin-right: 1px;"><a href="./sessions.php" style="padding: 1px; color: white; background-color: skyblue; text-decoration: none; margin-right: 1px;">sessions</a></li>
        <!-- Dropdown Settings Menu -->
        <li class="dropdown">
            <a href="#">SETTINGS</a>
            <div class="dropdown-content">
                <a href="register.html" style="background-color: #ff6347;">Register</a>
                <a href="login.html" style="background-color: #00bfff;">Login</a>
                <a href="logout.php" style="background-color: #228b22;">Logout</a>
            </div>
        </li>
    </ul>
</header>

<section>
    <h1>reviews Form</h1>
    <form method="post" action="reviews.php">
        <!-- Form Fields -->
        <label for="ReviewID">ReviewID:</label>
        <input type="number" id="ReviewID" name="ReviewID" required><br><br>
        <label for="CounselorID">CounselorID:</label>
        <input type="number" id="CounselorID" name="CounselorID" required><br><br>
        <label for="ClientID">ClientID:</label>
        <input type="number" id="ClientID" name="ClientID" required><br><br>
         <label for="ReviewContent">ReviewContent:</label>
        <input type="text" id="ReviewContent" name="ReviewContent" required><br><br>
        

        <input type="submit" name="insert" value="Insert"><br><br>
    </form>
    <a href="./home.html">Go Back to Home</a>
    <!-- PHP Code for Database Interaction -->
    <?php
    include('database_connection.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
        $stmt = $connection->prepare("INSERT INTO reviews (ReviewID, CounselorID, ClientID,ReviewContent) VALUES (?, ?, ?,?)");
        $stmt->bind_param("isss",  $RID, $CID,$CLID,$RC);
        $RID = $_POST['ReviewID'];
        $CID = $_POST['CounselorID'];
        $CLID = $_POST['ClientID'];
         $RC = $_POST['ReviewContent'];
          
        
        
        if ($stmt->execute()) {
            echo "New record has been added successfully.<br><br>";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }
        $stmt->close();
    }
    $sql = "SELECT * FROM reviews";
    $result = $connection->query($sql);
    ?>
    <!-- Data Display Table -->
    <center><h2>Table of reviews</h2></center>
    <table>
        <tr>
            <th>ReviewID</th>
            <th>CounselorID</th>
            <th>ClientID</th>
            <th>ReviewContent</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row["ReviewID"]}</td>
                    <td>{$row["CounselorID"]}</td>
                    <td>{$row["ClientID"]}</td> 
                     <td>{$row["ReviewContent"]}</td>
                    
                     
                    <td><a href='delete_reviews.php?ReviewID={$row["ReviewID"]}'>Delete</a></td> 
                    <td><a href='update_reviews.php?ReviewID={$row["ReviewID"]}'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No data found</td></tr>";
        }
        $connection->close();
        ?>
    </table>
</section>
<footer>
  <marquee><i style="color: yellow;">&copy; 2024</i><i style="color: blue;" ><b>WEB TECHNOLOGY CAT DESIGNED BY:MUGISHA eliab</b></marquee>
</footer>
</body>
</html>

