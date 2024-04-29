<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'auth.php';
include_once 'database.php';

// Check if the user is not logged in, redirect to index page

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'promote' button is clicked
    if (isset($_POST["promote"])) {
        $user_id = $_POST["user_id"];

        // Move the user to the admin table
        promoteUserToAdmin($user_id);

        // Redirect back to admin_dashboard.php
        header("Location: admin_dashboard.php");
        exit();
    }

    // Check if the 'demote' button is clicked
    if (isset($_POST["demote"])) {
        $admin_id = $_POST["admin_id"];

        // Move the admin to the users table
        demoteAdminToUser($admin_id);

        // Redirect back to admin_dashboard.php
        header("Location: admin_dashboard.php");
        exit();
    }

    // Check if the 'delete' button is clicked
    if (isset($_POST["delete"])) {
        $user_id = $_POST["user_id"];

        // Delete the user
        deleteUser($user_id);

        // Redirect back to admin_dashboard.php
        header("Location: admin_dashboard.php");
        exit();
    }
}
?>
