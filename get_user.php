<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
  echo json_encode(['error' => 'User not logged in']);
  exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT name, email, profile_img FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

echo json_encode([
  'user_name' => $user['name'],
  'email' => $user['email'],
  'profile_img' => $user['profile_img']
]);
?>

