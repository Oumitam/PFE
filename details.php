<?php
if (isset($_GET['id'])) {
    $employee_id = $_GET['id'];
    
    $conn = new mysqli('localhost', 'root', '', 'gestionemployee');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT * FROM utilisateurs WHERE IdUtl = $employee_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h1>Employee Details</h1>";
        echo "<p>Employee ID: " . $row['IdUtl'] . "</p>";
        echo "<p>Name: " . $row['nom'] . "</p>";
        echo "<p>Status: " . $row['statut'] . "</p>";
        echo "<p>Current Project: " . $row['project'] . "</p>";
        echo "<p>Details: " . $row['details'] . "</p>";
    } else {
        echo "No details found for this employee.";
    }
    
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
