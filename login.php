<?php
require 'db.php';
session_start();  // Start the session

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
  $_SESSION['user_name'] = $user['name'];
  $_SESSION['user_id'] = $user['userID'];  // Store userID in session
  echo json_encode([
    'status' => 'success',
    'name' => $user['name'],
    'userID' => $user['userID']   // Send userID in response
  ]);
} else {
  echo json_encode(['status' => 'fail']);
}
?>
