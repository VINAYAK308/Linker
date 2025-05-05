<?php
require 'db.php';

function getUserIDByEmail($email) {
    global $pdo;
    if (!$email) {
        return ['status' => 'error', 'message' => 'Email is required'];
    }

    $stmt = $pdo->prepare("SELECT userID FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        return ['status' => 'success', 'userID' => $user['userID']];
    } else {
        return ['status' => 'error', 'message' => 'User not found'];
    }
}
?>
