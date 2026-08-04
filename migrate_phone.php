<?php
require 'config/config.php';

$sql = "ALTER TABLE `users` ADD COLUMN `phone` VARCHAR(20) DEFAULT NULL AFTER `email`";

if ($conn->query($sql) === TRUE) {
    echo "Column phone added to users table successfully\n";
} else {
    echo "Error adding column: " . $conn->error . "\n";
}

$conn->close();
?>
