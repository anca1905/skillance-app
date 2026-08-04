<?php
require 'config/config.php';

$sql = "
CREATE TABLE IF NOT EXISTS `project_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `status` enum('Backlog','To Do','Development','Testing','Bug & Improvement','Selesai') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Backlog',
  `priority` enum('Low','Normal','High') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Normal',
  `assignee_id` int(11) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";

if ($conn->query($sql) === TRUE) {
    echo "Table project_tasks created successfully\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}

$conn->close();
?>
