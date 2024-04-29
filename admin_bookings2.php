<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'auth.php';
include_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"] ?? null;
    $bookingId = $_POST["bookingId"] ?? null;

    echo "Action: $action, Booking ID: $bookingId"; // Add this line for debugging

    if ($action === "approve") {
        updateVenueBookingStatus($bookingId, 'Confirmed');
    } elseif ($action === "decline") {
        updateVenueBookingStatus($bookingId, 'Declined');
    } elseif ($action === "pending") {
        updateVenueBookingStatus($bookingId, 'Pending');
    } 
}

// Check if the user is not logged in, redirect to index page
$venueBookings = getVenueBookings(); // Make sure you have the appropriate function defined in database.php

// Fetch bookings from the database
// Make sure you have the appropriate function defined in database.php
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
    <h2>Venue Bookings</h2>

    <table>
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Venue Name</th>
                <th>Start Date</th>
                <th>Start Time</th>
                <th>End Date</th>
                <th>End Time</th>
                <th>Equipment Needed</th>
                <th>Catering</th>
                <th>Status</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($venueBookings as $booking): ?>
                <tr>
                    <td><?php echo $booking['event_name']; ?></td>
                    <td><?php echo $booking['venue_name']; ?></td>
                    <td><?php echo $booking['start_date']; ?></td>
                    <td><?php echo $booking['start_time']; ?></td>
                    <td><?php echo $booking['end_date']; ?></td>
                    <td><?php echo $booking['end_time']; ?></td>
                    <td><?php echo $booking['equipment_needed']; ?></td>
                    <td><?php echo $booking['catering']; ?></td>
                    <td><?php echo $booking['status']; ?></td>
                    <td>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="bookingId" value="<?php echo $booking['venue_booking_id']; ?>">
                            <button type="button" onclick="updateStatus('<?php echo $booking['venue_booking_id']; ?>', 'approve')">Confirm</button>
                            <button type="button" onclick="updateStatus('<?php echo $booking['venue_booking_id']; ?>', 'decline')">Decline</button>
                            <button type="button" onclick="updateStatus('<?php echo $booking['venue_booking_id']; ?>', 'pending')">Pending</button>
                        </form>
                        </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function updateStatus(bookingId, action) {
    console.log("Action: " + action + ", Booking ID: " + bookingId);
    var form = document.createElement("form");
    form.method = "post";
    form.action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>";

    // Create a new hidden input element for bookingId
    var bookingIdInput = document.createElement("input");
    bookingIdInput.type = "hidden";
    bookingIdInput.name = "bookingId";
    bookingIdInput.value = bookingId;
    form.appendChild(bookingIdInput);

    // Create a new hidden input element for action
    var actionInput = document.createElement("input");
    actionInput.type = "hidden";
    actionInput.name = "action";
    actionInput.value = action;  // Set the correct value for the 'action'
    form.appendChild(actionInput);

    // Append the form to the body and submit it
    document.body.appendChild(form);
    form.submit();
}
</script>
    
</body>
</html>