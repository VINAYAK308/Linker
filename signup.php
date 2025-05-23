<?php
require 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");

try {
  $stmt->execute([$name, $email, $password]);
  $userID = $pdo->lastInsertId(); // Get the auto-incremented ID
  echo json_encode(['status' => 'success', 'userID' => $userID]);
} catch (Exception $e) {
  echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
