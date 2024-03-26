<?php
// Your database connection code here
$username = "root";
$password = "";
$database = "vimin";

try {
    $pdo = new PDO("mysql:host=localhost;database=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}

$sql = "SELECT product_name, stocks FROM vimin.products";

try {
    $result = $pdo->query($sql);

    if (!$result) {
        throw new Exception('Query failed: ' . $pdo->errorInfo()[2]);
    }

    $data = array('labels' => array(), 'values' => array());

    while ($row = $result->fetch()) {
        $data['labels'][] = $row['product_name'];
        $data['values'][] = (int)$row['stocks'];
    }

    echo json_encode($data);
} catch (Exception $ex) {
    echo json_encode(array('error' => $ex->getMessage()));
}
?>
