<?php
$conn = new mysqli('localhost', 'root', '', 'if0_41035429_skillance');
$tables = ['finances', 'transactions', 'users'];
$out = "";
foreach ($tables as $t) {
    $res = $conn->query("SHOW CREATE TABLE $t");
    if ($res) {
        $row = $res->fetch_row();
        $out .= $row[1] . ";\n\n";
    }
}
file_put_contents('schema_dump.txt', $out);
echo "Done";
