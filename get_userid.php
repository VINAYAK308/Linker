<?php
require 'db.php';

$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'] ?? '';

if (!$email) {
  echo json_encode(['status' => 'error', 'message' => 'Email is required']);
  exit;
}

$stmt = $pdo->prepare("SELECT userID FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
  echo json_encode(['status' => 'success', 'userID' => $user['userID']]);
} else {
  echo json_encode(['status' => 'error', 'message' => 'User not found']);
}
?>
