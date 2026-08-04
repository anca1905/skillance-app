<?php
require 'config/config.php';

$sql = "
CREATE TABLE IF NOT EXISTS `payrolls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_type` enum('Programmer','Designer') COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `complexity` enum('Standard','Complex') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Standard',
  `qty` int(11) NOT NULL DEFAULT 1,
  `rate` decimal(15,2) NOT NULL,
  `total_amount` decimal(15,2) NOT NULL,
  `status` enum('Pending','Dibayar') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending',
  `payment_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";

if ($conn->query($sql) === TRUE) {
    echo "Table payrolls created successfully\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}

$conn->close();
?>
