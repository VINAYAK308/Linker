<?php
require_once 'db.php'; // Your DB connection file

header('Content-Type: application/json');

if (isset($_GET['userID'])) {
    $userID = intval($_GET['userID']);

    $stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
    $stmt->execute([$userID]);

    if ($row = $stmt->fetch()) {
        echo json_encode(['username' => $row['username']]);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'User not found']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'userID not provided']);
}
