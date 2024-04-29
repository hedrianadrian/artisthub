-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 06, 2024 at 01:57 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artist`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `adminUsername` varchar(50) NOT NULL,
  `adminPassword` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `adminUsername`, `adminPassword`) VALUES
(3, 'admin', '123'),
(5, 'user1', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_venue` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_date`, `event_venue`) VALUES
(1, 'Birthday', '2024-02-29', 'Coli');

-- --------------------------------------------------------

--
-- Table structure for table `talents`
--

CREATE TABLE `talents` (
  `talent_id` int(11) NOT NULL,
  `talent_name` varchar(255) NOT NULL,
  `talent_skill` varchar(100) NOT NULL,
  `talent_fee` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `talents`
--

INSERT INTO `talents` (`talent_id`, `talent_name`, `talent_skill`, `talent_fee`) VALUES
(3, 'Alex Johnson', 'Musician', 6000.00),
(4, 'Sarah Brown', 'Actor', 8000.00),
(9, 'Jane Doe', 'Throat Singing', 100000.00);

-- --------------------------------------------------------

--
-- Table structure for table `talents_bookings`
--

CREATE TABLE `talents_bookings` (
  `booking_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `talent_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `talents_bookings`
--

INSERT INTO `talents_bookings` (`booking_id`, `event_name`, `talent_id`, `date`, `time`, `status`) VALUES
(1, 'Concert', 3, '2024-03-05', '21:00:00', 'declined'),
(2, 'Dance Concert', 4, '2024-03-10', '21:00:00', 'declined');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(6, 'user', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
(7, 'user', '8d23cf6c86e834a7aa6eded54c26ce2bb2e74903538c61bdd5d2197997ab2f72');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `venue_id` int(11) NOT NULL,
  `venue_name` varchar(255) NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`venue_id`, `venue_name`, `capacity`, `location`, `contact_person`, `contact_phone`) VALUES
(1, 'Music Hall', 1000, 'City A', 'John Manager', '123-456-7890'),
(3, 'Convention Center', 2000, 'Taguig City', 'David Advincula', '9171537554'),
(4, 'Conference Center', 500, 'City C', 'Alex Organizer', '555-123-4567'),
(5, 'Outdoor Amphitheater', 1500, 'City D', 'Emily Event Planner', '222-789-1234'),
(6, 'Black Box Theater', 100, 'City E', 'Chris Director', '333-456-7890');

-- --------------------------------------------------------

--
-- Table structure for table `venues_bookings`
--

CREATE TABLE `venues_bookings` (
  `booking_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `venue_name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_date` date NOT NULL,
  `end_time` time NOT NULL,
  `equipment_needed` text DEFAULT NULL,
  `catering` enum('Yes','No') NOT NULL,
  `status` enum('Pending','Confirmed','Rejected') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `venues_bookings`
--

INSERT INTO `venues_bookings` (`booking_id`, `event_name`, `venue_name`, `start_date`, `start_time`, `end_date`, `end_time`, `equipment_needed`, `catering`, `status`) VALUES
(1, 'Orphanage Concert', 'Music Hall', '2024-12-02', '21:00:00', '2024-12-03', '21:00:00', 'Audio, Sounds, Led Wall', 'Yes', 'Pending'),
(2, 'GMA Kapuso Show', 'Convention Center', '2024-03-21', '18:00:00', '2024-03-22', '06:00:00', 'Audio, Sounds, Led Wall', 'No', 'Pending'),
(3, 'BaconPop 2024', 'Convention Center', '2024-03-29', '06:00:00', '2024-03-31', '00:00:00', 'Audio, Lights, Led Wall', 'Yes', 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `adminUsername` (`adminUsername`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `talents`
--
ALTER TABLE `talents`
  ADD PRIMARY KEY (`talent_id`);

--
-- Indexes for table `talents_bookings`
--
ALTER TABLE `talents_bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `talent_id` (`talent_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`venue_id`);

--
-- Indexes for table `venues_bookings`
--
ALTER TABLE `venues_bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `talents`
--
ALTER TABLE `talents`
  MODIFY `talent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `talents_bookings`
--
ALTER TABLE `talents_bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `venue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `venues_bookings`
--
ALTER TABLE `venues_bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `talents_bookings`
--
ALTER TABLE `talents_bookings`
  ADD CONSTRAINT `talents_bookings_ibfk_1` FOREIGN KEY (`talent_id`) REFERENCES `talents` (`talent_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
