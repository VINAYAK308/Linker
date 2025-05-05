<?php
require 'db.php';

if (!isset($_POST['userID']) || !isset($_POST['password'])) {
  echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
  exit;
}

$userID = $_POST['userID'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $pdo->prepare("UPDATE users SET password = ? WHERE userID = ?");
try {
  $stmt->execute([$password, $userID]);
  if ($stmt->rowCount()) {
    echo json_encode(['status' => 'success']);
  } else {
    echo json_encode(['status' => 'error', 'message' => 'UserID not found or password unchanged']);
  }
} catch (Exception $e) {
  echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
