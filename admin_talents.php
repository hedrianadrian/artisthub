<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'auth.php';
include_once 'database.php';

// Check if the user is not logged in, redirect to index page
$venueBookings = getVenueBookings(); // Make sure you have the appropriate function defined in database.php

// Fetch talents from the database
$talents = getTalents();

// Handle talent addition
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add"])) {
        // Redirect to addtalent.php for adding talent
        header("Location: addtalent.php");
        exit();
    } elseif (isset($_POST["update"])) {
        // Redirect to updatetalent.php for updating talent with talent_id as a parameter
        $talentId = $_POST["talentId"];
        header("Location: updatetalent.php?talent_id=" . $talentId);
        exit();
    } elseif (isset($_POST["delete"])) {
        // Delete talent directly without confirmation
        $talentId = $_POST["talentId"];
        deleteTalent($talentId);
        
        // Redirect back to the same page after deletion
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Artist Hub Admin Dashboard</title>
</head>
<body>
    <div class="header">
        <h1>Artist Hub Admin Dashboard</h1>
        <p>Welcome <a href="logout.php">Logout</a></p>
    </div>

    <header>
        <nav>
            <a href="admin_dashboard.php">Admin Dashboard</a>
            <a href="admin_talents.php">Talents</a>
            <a href="admin_venues.php">Venues</a>
            <a href="admin_bookings.php">Talent Bookings</a>
            <a href="admin_bookings2.php">Venue Bookings</a>

        </nav>
    </header>

    <div class="container">
        <h2>Talents</h2>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <button type="submit" name="add">Add Talent</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Talent ID</th>
                    <th>Talent Name</th>
                    <th>Talent Skill</th>
                    <th>Talent Fee</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($talents as $talent): ?>
                    <tr>
                        <td><?php echo $talent['talent_id']; ?></td>
                        <td><?php echo $talent['talent_name']; ?></td>
                        <td><?php echo $talent['talent_skill']; ?></td>
                        <td><?php echo $talent['talent_fee']; ?></td>
                        <td>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <input type="hidden" name="talentId" value="<?php echo $talent['talent_id']; ?>">
                                <button type="submit" name="update">Update</button>
                                <button type="submit" name="delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
