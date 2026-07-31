<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");

require_once '../config/config.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $query = $conn->query("SELECT * FROM projects WHERE id=$id");
        if ($query && $row = $query->fetch_assoc()) {

            // Fetch addons
            $addons = [];
            $addon_query = $conn->query("SELECT id, name, price FROM project_addons WHERE project_id=$id ORDER BY created_at ASC");
            if ($addon_query) {
                while ($a_row = $addon_query->fetch_assoc()) {
                    $addons[] = [
                        "id" => $a_row['id'],
                        "name" => $a_row['name'],
                        "price" => (int)$a_row['price']
                    ];
                }
            }
            $row['addons'] = $addons;

            echo json_encode($row);
        } else {
            echo json_encode(["status" => "error", "message" => "Project tidak ditemukan"]);
        }
        exit();
    }

    $projects = [];
    $query = $conn->query("SELECT p.*, 
                          (SELECT SUM(price) FROM project_addons WHERE project_id=p.id) as total_addons 
                          FROM projects p ORDER BY p.deadline ASC");
    if ($query) {
        while ($row = $query->fetch_assoc()) {
            $total_addons = $row['total_addons'] ? (int)$row['total_addons'] : 0;
            $projects[] = [
                "id" => $row['id'],
                "name" => $row['name'],
                "platform" => $row['platform'],
                "client_name" => $row['client_name'],
                "deadline" => $row['deadline'],
                "status" => $row['status'],
                "payment" => $row['payment_status'],
                "price" => $row['price'],
                "dp_amount" => $row['dp_amount'],
                "total_addons" => $total_addons
            ];
        }
    }

    echo json_encode($projects);
    exit();
}

if ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!$data) $data = $_POST;

    $id = isset($data['id']) ? (int)$data['id'] : null;
    $name = $conn->real_escape_string($data['name'] ?? '');
    $platform = $conn->real_escape_string($data['platform'] ?? '');
    $client_name = $conn->real_escape_string($data['client_name'] ?? '');
    $client_contact = $conn->real_escape_string($data['client_contact'] ?? '');
    $client_institution = $conn->real_escape_string($data['client_institution'] ?? '');
    $deadline = $conn->real_escape_string($data['deadline'] ?? '');
    $status = $conn->real_escape_string($data['status'] ?? 'Development');
    $payment_status = $conn->real_escape_string($data['payment'] ?? 'Belum Bayar');
    $price = isset($data['price']) ? (int)$data['price'] : 0;
    $dp_amount = isset($data['dp_amount']) ? (int)$data['dp_amount'] : 0;
    $addons = isset($data['addons']) && is_array($data['addons']) ? $data['addons'] : [];

    if (empty($name) || empty($platform) || empty($client_name) || empty($deadline)) {
        echo json_encode(["status" => "error", "message" => "Data project minimal tidak lengkap"]);
        exit();
    }

    if ($id) {
        // UPDATE Existing Project
        $sql = "UPDATE projects SET 
                name='$name', platform='$platform', client_name='$client_name', 
                client_contact='$client_contact', client_institution='$client_institution', 
                deadline='$deadline', status='$status', payment_status='$payment_status', 
                price=$price, dp_amount=$dp_amount
                WHERE id=$id";

        if ($conn->query($sql)) {
            // Process Addons
            $conn->query("DELETE FROM project_addons WHERE project_id=$id");
            foreach ($addons as $addon) {
                $aname = $conn->real_escape_string($addon['name']);
                $aprice = (int)$addon['price'];
                if (!empty($aname) && $aprice > 0) {
                    $conn->query("INSERT INTO project_addons (project_id, name, price) VALUES ($id, '$aname', $aprice)");
                }
            }
            if ($dp_amount > 0) {
                $check_finance = "SELECT id FROM finances WHERE project_id=$id LIMIT 1";
                $res_finance = $conn->query($check_finance);
                $desc = "Pembayaran Project: " . $name;

                if ($res_finance && $res_finance->num_rows > 0) {
                    $conn->query("UPDATE finances SET amount=$dp_amount, description='$desc' WHERE project_id=$id");
                } else {
                    $date = date('Y-m-d');
                    $conn->query("INSERT INTO finances (type, amount, description, category, date, project_id) 
                                  VALUES ('income', $dp_amount, '$desc', 'Project', '$date', $id)");
                }
            } else {
                // If DP is 0, delete any existing finance record for this project
                $conn->query("DELETE FROM finances WHERE project_id=$id");
            }

            echo json_encode(["status" => "success", "message" => "Project berhasil diupdate"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal proses DB: " . $conn->error]);
        }
    } else {
        // INSERT New Project
        $sql = "INSERT INTO projects (name, platform, client_name, client_contact, client_institution, deadline, status, payment_status, cover_image, price, dp_amount) 
                VALUES ('$name', '$platform', '$client_name', '$client_contact', '$client_institution', '$deadline', '$status', '$payment_status', '', $price, $dp_amount)";
        if ($conn->query($sql)) {
            $new_project_id = $conn->insert_id;

            // Process Addons
            foreach ($addons as $addon) {
                $aname = $conn->real_escape_string($addon['name']);
                $aprice = (int)$addon['price'];
                if (!empty($aname) && $aprice > 0) {
                    $conn->query("INSERT INTO project_addons (project_id, name, price) VALUES ($new_project_id, '$aname', $aprice)");
                }
            }

            // FINANCES SYNC
            if ($dp_amount > 0) {
                $desc = "Pembayaran Project: " . $name;
                $date = date('Y-m-d');
                $conn->query("INSERT INTO finances (type, amount, description, category, date, project_id) 
                              VALUES ('income', $dp_amount, '$desc', 'Project', '$date', $new_project_id)");
            }

            echo json_encode(["status" => "success", "message" => "Project baru berhasil dicatat"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal menyimpan: " . $conn->error]);
        }
    }

    exit();
}

if ($method === 'DELETE') {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($id) {
        // Delete finance record first (foreign key conceptual constraint)
        $conn->query("DELETE FROM finances WHERE project_id=$id");

        // Delete project addons first
        $conn->query("DELETE FROM project_addons WHERE project_id=$id");

        // Delete project
        $sql = "DELETE FROM projects WHERE id=$id";
        if ($conn->query($sql)) {
            echo json_encode(["status" => "success", "message" => "Project berhasil dihapus"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal menghapus project: " . $conn->error]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "ID project tidak valid"]);
    }

    exit();
}

echo json_encode(["status" => "error", "message" => "Invalid request method"]);
