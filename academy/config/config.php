<?php
// Academy Config - Connect to shared database
if (!function_exists('loadEnvAcademy')) {
    function loadEnvAcademy() {
        $paths = [
            __DIR__ . '/../.env',
            __DIR__ . '/../../.env',
            '/www/wwwroot/skillance.cloud/.env'
        ];
        foreach ($paths as $path) {
            if (file_exists($path)) {
                $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($lines as $line) {
                    $line = trim($line);
                    if (empty($line) || strpos($line, '#') === 0) continue;
                    if (strpos($line, '=') !== false) {
                        list($key, $val) = explode('=', $line, 2);
                        $key = trim($key);
                        $val = trim($val);
                        if (!array_key_exists($key, $_ENV)) {
                            $_ENV[$key] = $val;
                            if (function_exists('putenv')) {
                                @putenv("$key=$val");
                            }
                        }
                    }
                }
                break;
            }
        }
    }
}
loadEnvAcademy();

$host = $_ENV['DB_HOST'] ?? (function_exists('getenv') && getenv('DB_HOST') ? getenv('DB_HOST') : "localhost");
$user = $_ENV['DB_USERNAME'] ?? (function_exists('getenv') && getenv('DB_USERNAME') ? getenv('DB_USERNAME') : "root");
$pass = $_ENV['DB_PASSWORD'] ?? (function_exists('getenv') && getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : "");
$db   = $_ENV['DB_DATABASE'] ?? (function_exists('getenv') && getenv('DB_DATABASE') ? getenv('DB_DATABASE') : "skillance");

$conn = null;
try {
    mysqli_report(MYSQLI_REPORT_OFF);
    $conn = @new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        $conn = null;
    }
} catch (Throwable $e) {
    $conn = null;
}
