<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'auth.php';
include_once 'database.php';

// Check if the user is not logged in, redirect to index page
$venueBookings = getVenueBookings(); // Make sure you have the appropriate function defined in database.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Artist Hub</title>
</head>
<body>
    <div class="header">
        <h1>Artist Hub</h1>
        <p>Welcome!     <a href="logout.php">Logout</a></p>
    </div>

    <header>
        <nav>
            <a href="index.php">Home</a>
            <a href="talents.php">Talents</a>
            <a href="venues.php">Venues</a>
            <a href="bookings.php">Bookings</a>
        </nav>
    </header>

    <section>
        <h2>About Us</h2>
        <p>Welcome to Artist Hub, your premier platform for connecting artists, performers, and art enthusiasts! Our mission is to create a vibrant and supportive community where creativity thrives and talent shines.</p>

        <p>At Artist Hub, we believe in the power of art to inspire, connect, and transform lives. Whether you're an artist looking to showcase your talents, a venue seeking exciting performances, or an art lover eager to explore and support the local arts scene, we've got you covered.</p>

        <p>Explore our diverse range of talents, discover amazing venues, and stay updated on the latest events and bookings. Join us in celebrating the rich tapestry of artistic expression that makes our community unique.</p>

        <p>Thank you for being a part of Artist Hub. Let's create, inspire, and make art together!</p>
    </section>


</body>
</html>
