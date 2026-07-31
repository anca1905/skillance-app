<?php
$conn = new mysqli('localhost', 'root', '', 'if0_41035429_skillance');
$res = $conn->query("DESCRIBE transactions");
$cols = [];
while ($row = $res->fetch_assoc()) $cols[] = $row;
file_put_contents('trx_cols.json', json_encode($cols, JSON_PRETTY_PRINT));
echo "Done";
