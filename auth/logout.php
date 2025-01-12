<?php
session_start();

// Store admin status before destroying session
$isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;

session_unset();
session_destroy();

// Use absolute paths
if ($isAdmin) {
    header("Location: /e_commerce/auth/loginAdmin.php");
} else {
    header("Location: /e_commerce/auth/login.php");
}
exit();
