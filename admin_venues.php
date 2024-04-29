<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'auth.php';
include_once 'database.php';

// Check if the user is not logged in, redirect to index page
$venueBookings = getVenueBookings(); // Make sure you have the appropriate function defined in database.php

// Fetch venues from the database
$venues = getVenues(); // Make sure you have the appropriate function defined in database.php

// Handle venue addition, update, and deletion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add"])) {
        // Redirect to addvenue.php for adding venue
        header("Location: addvenue.php");
        exit();
    } elseif (isset($_POST["update"])) {
        // Redirect to updatevenue.php for updating venue with venue_id as a parameter
        $venueId = $_POST["venueId"];
        header("Location: updatevenue.php?venue_id=" . $venueId);
        exit();
    } elseif (isset($_POST["delete"])) {
        // Directly delete the venue
        $venueId = $_POST["venueId"];
        deleteVenue($venueId);
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
        <h2>Venues</h2>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <button type="submit" name="add">Add Venue</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Venue ID</th>
                    <th>Venue Name</th>
                    <th>Capacity</th>
                    <th>Location</th>
                    <th>Contact Person</th>
                    <th>Contact Phone</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($venues as $venue): ?>
                    <tr>
                        <td><?php echo $venue['venue_id']; ?></td>
                        <td><?php echo $venue['venue_name']; ?></td>
                        <td><?php echo $venue['capacity']; ?></td>
                        <td><?php echo $venue['location']; ?></td>
                        <td><?php echo $venue['contact_person']; ?></td>
                        <td><?php echo $venue['contact_phone']; ?></td>
                        <td>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <input type="hidden" name="venueId" value="<?php echo $venue['venue_id']; ?>">
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
