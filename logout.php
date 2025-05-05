<?php
session_start();
session_destroy();
echo "You have been logged out. Redirecting to login...";
header("refresh:2; url=login.php"); // redirect after 2 seconds
exit();
?>
