<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'auth.php';
include_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["confirm"])) {
        $bookingId = $_POST["bookingId"]; // Change to 'bookingId'
        updateBookingStatus($bookingId, 'confirmed');
    } elseif (isset($_POST["decline"])) {
        $bookingId = $_POST["bookingId"]; // Change to 'bookingId'
        updateBookingStatus($bookingId, 'declined');
    } elseif (isset($_POST["pending"])) {
        $bookingId = $_POST["bookingId"]; // Change to 'bookingId'
        updateBookingStatus($bookingId, 'pending');
    } 
}

// Fetch bookings from the database
$bookings = getBookings(); // Make sure you have the appropriate function defined in database.php
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
        <h2>Talent Bookings</h2>

        <table>
            <thead>
                <tr>
                <th>Person Inquiring</th>
                    <th>Title/Role/Affiliation</th>
                    <th>Contact Number</th>
                    <th>Event Name</th>
                    <th>Talent Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    
                    
                    <th>Date of Booking</th>
                    <th>Status</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?php echo $booking['person_inquiring']; ?></td>
                        <td><?php echo $booking['title_role_affiliation']; ?></td>
                        <td><?php echo $booking['contact_number']; ?></td>
                        <td><?php echo $booking['event_name']; ?></td>
                        <td><?php echo getTalentNameById($booking['talent_id']); ?></td>
                        <td><?php echo $booking['date']; ?></td>
                        <td><?php echo $booking['time']; ?></td>
                        <td><?php echo $booking['date_of_booking']; ?></td>
                        <td><?php echo $booking['status']; ?></td>
                        <td>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <input type="hidden" name="bookingId" value="<?php echo $booking['booking_id']; ?>">
                                <button type="submit" name="confirm">Confirm</button>
                                <button type="submit" name="decline">Decline</button>
                                <button type="submit" name="pending">Pending</button>
                            </form>
                        </td>
                        
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
