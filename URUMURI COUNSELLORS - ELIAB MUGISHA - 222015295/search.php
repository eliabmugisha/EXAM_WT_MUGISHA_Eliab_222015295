<?php
// Include the database connection file
include('database_connection.php');

// Check if search term is provided
if (isset($_GET['query'])) {
    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Perform the search query for appointments
    $sql_appointments = "SELECT * FROM appointments WHERE AppointmentDate LIKE '%$searchTerm%'";
    $result_appointments = $connection->query($sql_appointments);

    // Perform the search query for availability
    $sql_availability = "SELECT * FROM availability WHERE DayOfWeek LIKE '%$searchTerm%'";
    $result_availability = $connection->query($sql_availability);

    // Perform the search query for clients
    $sql_clients = "SELECT * FROM clients WHERE RelationshipStatus LIKE '%$searchTerm%'";
    $result_clients = $connection->query($sql_clients);

    // Perform the search query for counselors
    $sql_counselors = "SELECT * FROM counselors WHERE Experience LIKE '%$searchTerm%'";
    $result_counselors = $connection->query($sql_counselors);

    // Perform the search query for payments
    $sql_payments = "SELECT * FROM payments WHERE PaymentMethod LIKE '%$searchTerm%'";
    $result_payments = $connection->query($sql_payments);

    // Perform the search query for profiles
    $sql_profiles = "SELECT * FROM profiles WHERE Location LIKE '%$searchTerm%'";
    $result_profiles = $connection->query($sql_profiles);


    // Perform the search query for progressnotes
    $sql_progressnotes = "SELECT * FROM progressnotes WHERE NoteContent LIKE '%$searchTerm%'";
    $result_progressnotes = $connection->query($sql_progressnotes);

    // Perform the search query for reviews
    $sql_reviews = "SELECT * FROM reviews WHERE ReviewContent LIKE '%$searchTerm%'";
    $result_reviews = $connection->query($sql_reviews);
    // Perform the search query for sessions
    $sql_sessions = "SELECT * FROM sessions WHERE SessionNotes LIKE '%$searchTerm%'";
    $result_sessions = $connection->query($sql_sessions);

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";
    
    // Display appointments
    echo "<h3>appointments:</h3>";
    if ($result_appointments->num_rows > 0) {
        while ($row = $result_appointments->fetch_assoc()) {
            echo "<p>" . $row['AppointmentDate'] . "</p>";
        }
    } else {
        echo "<p>No appointments found matching the search term: " . $searchTerm . "</p>";
    }

    // Display availability
    echo "<h3>availability:</h3>";
    if ($result_availability->num_rows > 0) {
        while ($row = $result_availability->fetch_assoc()) {
            echo "<p>" . $row['DayOfWeek'] . "</p>";
        }
    } else {
        echo "<p>No availability found matching the search term: " . $searchTerm . "</p>";
    }

    // Display clients
    echo "<h3>clients:</h3>";
    if ($result_clients->num_rows > 0) {
        while ($row = $result_clients->fetch_assoc()) {
            echo "<p>" . $row['RelationshipStatus'] . "</p>";
        }
    } else {
        echo "<p>No clients found matching the search term: " . $searchTerm . "</p>";
    }

    // Display counselors
    echo "<h3>counselors:</h3>";
    if ($result_counselors->num_rows > 0) {
        while ($row = $result_counselors->fetch_assoc()) {
            echo "<p>" . $row['Experience'] . "</p>";
        }
    } else {
        echo "<p>No counselors found matching the search term: " . $searchTerm . "</p>";
    }
    // Display payments
    echo "<h3>payments:</h3>";
    if ($result_counselors->num_rows > 0) {
        while ($row = $result_payments->fetch_assoc()) {
            echo "<p>" . $row['PaymentMethod'] . "</p>";
        }
    } else {
        echo "<p>No payments found matching the search term: " . $searchTerm . "</p>";
    }
    // Display profiles
    echo "<h3>profiles:</h3>";
    if ($result_profiles->num_rows > 0) {
        while ($row = $result_profiles->fetch_assoc()) {
            echo "<p>" . $row['Location'] . "</p>";
        }
    } else {
        echo "<p>No profiles found matching the search term: " . $searchTerm . "</p>";
    }
    // Display progressnotes
    echo "<h3>progressnotes:</h3>";
    if ($result_progressnotes->num_rows > 0) {
        while ($row = $result_progressnotes->fetch_assoc()) {
            echo "<p>" . $row['NoteContent'] . "</p>";
        }
    } else {
        echo "<p>No progressnotes found matching the search term: " . $searchTerm . "</p>";
    }
    // Display reviews
    echo "<h3>reviews:</h3>";
    if ($result_reviews->num_rows > 0) {
        while ($row = $result_reviews->fetch_assoc()) {
            echo "<p>" . $row['ReviewContent'] . "</p>";
        }
    } else {
        echo "<p>No reviews found matching the search term: " . $searchTerm . "</p>";
    }
    // Display sessions
    echo "<h3>sessions:</h3>";
    if ($result_sessions->num_rows > 0) {
        while ($row = $result_sessions->fetch_assoc()) {
            echo "<p>" . $row['SessionNotes'] . "</p>";
        }
    } else {
        echo "<p>No sessions found matching the search term: " . $searchTerm . "</p>";
    }

    // Close the database connection
    $connection->close();
} else {
    echo "No search term was provided.";
}
?>
