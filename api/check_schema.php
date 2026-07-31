<?php
$conn = new mysqli('localhost', 'root', '', 'db_skillance');
$result = $conn->query("SHOW COLUMNS FROM projects");
while ($row = $result->fetch_assoc()) {
    echo $row['Field'] . " - " . $row['Type'] . "\n";
}
