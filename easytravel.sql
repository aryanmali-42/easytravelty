-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2025 at 06:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easytravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_cred`
--

CREATE TABLE `admin_cred` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_cred`
--

INSERT INTO `admin_cred` (`sr_no`, `admin_name`, `admin_pass`) VALUES
(1, 'aryan', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `package_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `totalprice` decimal(10,2) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`sr_no`, `booking_id`, `package_name`, `price`, `quantity`, `totalprice`, `user_name`, `phonenum`, `address`) VALUES
(294, 70647368, 'Mumbai To Uttarkhand', 2.00, 3, 6.00, 'Aryan1', '1234567891', '1'),
(295, 70396639, 'Mumbai To Uttarkhand', 2.00, 1, 2.00, 'Aryan1', '1234567891', '1'),
(296, 70269259, 'Mumbai To Goa', 15999.00, 1, 15999.00, 'Aryan1', '1234567891', '1'),
(297, 70522004, 'Mumbai to Manali', 1.00, 1, 1.00, 'Aryan1', '1234567891', '1'),
(298, 7219581, 'Mumbai To Ayodhya', 22000.00, 1, 22000.00, 'Shrush', '7887569401', 'Mulund'),
(299, 73511707, 'Mumbai to Manali', 1.00, 1, 1.00, 'Pratik', '9892310688', '211 sbc bhandup'),
(300, 70542356, 'Mumbai to Manali', 1.00, 1, 1.00, 'Aryan1', '1234567891', '1'),
(301, 70629703, 'Mumbai To Goa', 1.00, 1, 1.00, 'Aryan1', '1234567891', '1'),
(302, 74202233, 'Mumbai to Manali', 1.00, 1, 1.00, 'OMKARDhadam', '7506381038', 'Ok'),
(303, 74762812, 'Mumbai To Goa', 1.00, 4, 4.00, 'OMKARDhadam', '7506381038', 'Ok'),
(304, 75182347, 'Mumbai to Manali', 1.00, 1, 1.00, 'Gzon1', '9132222053', '11'),
(305, 75730492, 'Mumbai to Manali', 1.00, 1, 1.00, 'Gzon1', '9132222053', '11'),
(306, 69348781, 'Mumbai to Manali', 1.00, 1, 1.00, 'sreyoshie', '913632053', 'sa'),
(307, 75502675, 'Mumbai to Manali', 1.00, 3, 3.00, 'Gzon1', '9132222053', '11');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `pn1` varchar(100) NOT NULL,
  `pn2` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `insta` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `pn2`, `email`, `fb`, `insta`, `tw`, `iframe`) VALUES
(1, ' ARYAN MALI, MULUND', 'https://maps.app.goo.gl/yq13kToyZvGj91Pc6', '+9137632053', '+9137632053', 'aryanmali440@gmail.com', 'facebook.com', 'instagram.com', 'twitter.com', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d60303.97707776508!2d72.97482800000002!3d19.15154!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b8edba39322f%3A0x80da2c634844abaf!2sMulund%20East%2C%20Mumbai%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1737271693117!5m2!1sen!2sin');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `description`) VALUES
(17, 'IMG_34760.svg', 'free wifi', 'We Will Provide You A Free WIfi'),
(26, 'IMG_17131.svg', 'Swimming Pool', ''),
(32, 'IMG_81310.svg', '4-star hotel stay with breakfast', ''),
(34, 'IMG_27215.svg', 'Airport pickup &amp; drop', ''),
(35, 'IMG_88449.svg', 'Professional tour guide', ''),
(36, 'IMG_12197.svg', '24/7 customer support', '');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(27, 'bus service'),
(30, 'Welcome Drink'),
(45, 'Breakfast'),
(46, 'All Meals Included'),
(47, 'Dinner Only'),
(49, 'Cultural Experiences'),
(50, 'Guided beach tours'),
(51, 'Water sports (Jet Ski, Parasailing, Scuba Diving'),
(52, 'Nightlife experience at top clubs');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `booking_id` int(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `payment_id` varchar(200) DEFAULT NULL,
  `trans_amt` decimal(10,2) NOT NULL,
  `booking_status` varchar(150) NOT NULL DEFAULT 'pending',
  `quantity` int(11) NOT NULL,
  `refund` int(11) DEFAULT NULL,
  `rate_review` int(11) NOT NULL DEFAULT 1,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`booking_id`, `user_id`, `package_id`, `payment_id`, `trans_amt`, `booking_status`, `quantity`, `refund`, `rate_review`, `added_date`) VALUES
(7219581, 72, 70, NULL, 22000.00, 'pending', 1, NULL, 1, '2025-03-09 12:38:24'),
(69348781, 69, 75, 'pay_Q4mVtoSjiA65w7', 1.00, 'booked', 1, NULL, 0, '2025-03-09 17:24:13'),
(70269259, 70, 74, 'pay_Q4jqNa1qd4OFkJ', 15999.00, 'booked', 1, NULL, 0, '2024-03-09 11:19:55'),
(70396639, 70, 73, 'pay_Q4fknYkyWVHH6X', 2.00, 'cancelled', 1, 1, 1, '2025-03-09 11:17:30'),
(70522004, 70, 75, 'pay_Q4mVtoSjiA65w7', 1.00, 'booked', 1, NULL, 1, '2025-03-09 12:28:43'),
(70542356, 70, 75, 'pay_Q4mVtoSjiA65w7', 1.00, 'booked', 1, NULL, 1, '2025-03-09 15:15:23'),
(70629703, 70, 74, 'pay_Q4jqNa1qd4OFkJ', 1.00, 'booked', 1, NULL, 0, '2025-03-09 15:16:27'),
(70647368, 70, 73, 'pay_Q4fknYkyWVHH6X', 6.00, 'cancelled', 3, 1, 0, '2025-03-09 10:52:20'),
(73511707, 73, 75, 'pay_Q4mVtoSjiA65w7', 1.00, 'booked', 1, NULL, 0, '2025-03-09 12:44:30'),
(74202233, 74, 75, 'pay_Q4mVtoSjiA65w7', 1.00, 'booked', 1, NULL, 0, '2025-03-09 16:45:46'),
(74762812, 74, 74, NULL, 4.00, 'pending', 4, NULL, 1, '2025-03-09 16:54:21'),
(75182347, 75, 75, 'pay_Q4mVtoSjiA65w7', 1.00, 'booked', 1, NULL, 0, '2025-03-09 17:05:17'),
(75502675, 75, 75, 'pay_Q4mVtoSjiA65w7', 3.00, 'booked', 3, NULL, 1, '2025-03-09 23:24:14'),
(75730492, 75, 75, 'pay_Q4mVtoSjiA65w7', 1.00, 'booked', 1, NULL, 0, '2025-03-09 17:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `duration` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `travel_mode` varchar(150) NOT NULL,
  `date` date NOT NULL,
  `adult` int(11) NOT NULL,
  `category` varchar(150) NOT NULL,
  `description` varchar(4500) NOT NULL,
  `iternity` varchar(4500) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0,
  `available_stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `duration`, `price`, `travel_mode`, `date`, `adult`, `category`, `description`, `iternity`, `status`, `removed`, `available_stock`) VALUES
(62, 'Mumbai To Delhi', 5, 15, 'bus', '2025-07-05', 0, 'family', 'The Mumbai to Delhi Tour takes you on a journey through Indiaâ€™s capital city, exploring its blend of rich history, culture, and modernity. From the majestic Red Fort to the divine serenity of Akshardham Temple, this tour will give you a taste of the diverse landmarks that make Delhi a global hub for travelers. This 4-day tour is perfect for history buffs, culture enthusiasts, and anyone looking to explore the heart of India.', 'ðŸ›« Departure from Mumbai â€“ Arrival in Delhi\r\nðŸ° Delhi City Tour â€“ Red Fort, Qutub Minar, and India Gate\r\nðŸŒ¸ Explore Akshardham Temple and Lotus Temple\r\nðŸ›¬ Departure from Delhi â€“ Return to Mumbai', 1, 0, 0),
(65, 'Aryan Mali', 3, 15, 'train', '2025-02-20', 12, 'adventure', 'Aryan', 'Day1\r\nday2\r\nday3', 1, 1, 0),
(69, 'Mumbai To Alibaug', 3, 1500, 'bus', '2024-03-15', 15, 'family', 'Experience the perfect blend of adventure and relaxation in Goa. Enjoy stunning beaches, thrilling water sports, vibrant nightlife, and scenic landscapes. Stay at a luxurious resort and explore famous attractions like Fort Aguada, Dudhsagar Falls, and Basilica of Bom Jesus. Perfect for solo travelers, families, and groups looking for an unforgettable vacation.', 'Arrival in Goa - Beachside Welcome Party\r\nNorth Goa Sightseeing - Water Sports Adventure\r\nSouth Goa Tour - Basilica And Spice Plantation Visit\r\nDudhsagar Waterfall Trip And Mandovi River Cruise\r\nLeisure And Departure', 1, 0, 0),
(70, 'Mumbai To Ayodhya', 4, 22000, 'flight', '2025-12-05', 34, 'family', 'Embark on a spiritual journey with the Mumbai to Ayodhya Tour, a sacred pilgrimage that takes you through the holy city of Ayodhya, the birthplace of Lord Ram. This tour offers an immersive experience into the rich history and spirituality of the region, providing the opportunity to visit some of the most revered temples and sacred sites in India.', 'ðŸ›« Day 1: Departure from Mumbai â€“ Arrival in Ayodhya\r\nðŸ° Day 2: Ayodhya Temple Tour â€“ Ram Janmabhoomi and Hanuman Garhi\r\nðŸŒ¸ Day 3: Explore Local Temples and Markets\r\nðŸ›¬ Day 4: Departure from Ayodhya â€“ Return to Mumbai', 1, 0, 0),
(71, 'Mumbai To Kedarnath', 5, 25, 'flight', '2024-02-01', 25, 'family', 'Experience the perfect blend of adventure and relaxation in Goa. Enjoy stunning beaches, thrilling water sports, vibrant nightlife, and scenic landscapes. Stay at a luxurious resort and explore famous attractions like Fort Aguada, Dudhsagar Falls, and Basilica of Bom Jesus. Perfect for solo travelers, families, and groups looking for an unforgettable vacation.', 'Arrival in Goa - Beachside Welcome Party\r\nNorth Goa Sightseeing - Water Sports Adventure\r\nSouth Goa Tour - Basilica And Spice Plantation Visit\r\nDudhsagar Waterfall Trip And Mandovi River Cruise\r\nLeisure And Departure', 1, 0, 0),
(72, 'Mumbai To Jaipur', 5, 1, 'train', '2025-06-05', 30, 'adventure', 'Embark on a captivating journey from Mumbai to Jaipur, the enchanting capital of Rajasthan, and experience its royal heritage, rich culture, and majestic landmarks. This 5-day tour package has been designed for travelers who seek to explore the vibrant colors, magnificent forts, and palaces that make Jaipur one of the most popular tourist destinations in India.', 'ðŸš‚ Departure from Mumbai â€“ Arrival in Jaipur\r\nðŸ°  Jaipur City Tour â€“ Amber Fort and Hawa Mahal\r\nðŸŒ¸  Explore Nahargarh Fort, Jaigarh Fort and Local Culture\r\nðŸ›ï¸  Day at Leisure â€“ Local Markets and Shopping\r\nðŸš‚  Departure from Jaipur â€“ Return to Mumbai', 1, 0, 0),
(73, 'Mumbai To Uttarkhand', 5, 1, 'flight', '2025-06-01', 0, 'adventure', 'Uttarakhand, also known as Devbhumi (Land of Gods), is a state located in the northern part of India. It is renowned for its picturesque landscapes, ancient temples, and spiritual significance. The state is home to some of the most famous pilgrimage sites like Haridwar, Rishikesh, Badrinath, Kedarnath, and Yamunotri. The majestic Himalayas form the backdrop of much of the state, providing opportunities for trekking, adventure sports, and peaceful retreats.', 'ðŸ›«Flight from Mumbai to Delhi, Drive to Mussoorie\r\nðŸ”ï¸Mussoorie Sightseeing, Kempty Falls\r\nðŸ•ï¸Drive to Jim Corbett National Park\r\nðŸŒ²Drive to Nainital, Lake Tour\r\nðŸŒŠDrive to Rishikesh, Adventure Activities\r\nðŸ™Haridwar, Departure to Delhi\r\nðŸ›¬ Flight from Delhi to Mumbai', 1, 0, 0),
(74, 'Mumbai To Goa', 5, 1, 'flight', '2025-03-15', 23, 'honeymoon', 'Experience the perfect blend of adventure and relaxation in Goa. Enjoy stunning beaches, thrilling water sports, vibrant nightlife, and scenic landscapes. Stay at a luxurious resort and explore famous attractions like Fort Aguada, Dudhsagar Falls, and Basilica of Bom Jesus. Perfect for solo travelers, families, and groups looking for an unforgettable vacation.', 'ðŸ›«Arrival in Goa - Beachside Welcome Party\r\nðŸ–ï¸North Goa Sightseeing - Water Sports Adventure\r\nâ›ªSouth Goa Tour - Basilica And Spice Plantation Visit\r\nðŸ’¦Dudhsagar Waterfall Trip And Mandovi River Cruise\r\nðŸŒ´Leisure And Departure', 1, 0, 0),
(75, 'Mumbai to Manali', 6, 1, 'flight', '2025-06-08', 22, 'honeymoon', 'Embark on a romantic getaway from Mumbai to the breathtaking hill station of Manali. This honeymoon package is specially curated to offer you a blend of adventure, romance, and relaxation. With scenic landscapes, adventure activities, and cozy hotel stays, this package ensures a memorable honeymoon experience.\r\n\r\nYou will begin your journey with a flight from Mumbai to Delhi, followed by a scenic overnight Volvo bus journey to Manali. Upon arrival, enjoy a warm welcome with a honeymoon-special room decoration. Spend your days exploring mesmerizing locations like Solang Valley, Rohtang Pass, Hidimba Temple, and Old Manaliâ€™s charming cafÃ©s. Experience adventure activities, shop for souvenirs, and indulge in a romantic candlelight dinner.', 'ðŸ›«Departure from Mumbai â€“ Flight Volvo Bus Journey .\r\nðŸŒ„Arrival in Manali â€“ Local Sightseeing Mall Road,\r\nðŸ”ï¸Solang Valley And Adventure Sports\r\nâ„ï¸Rohtang Pass and Snow Activities\r\nðŸ°Naggar Castle, Hidimba Temple and Shopping\r\nðŸ›¬Departure â€“ Manali to Mumbai', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `package_facilities`
--

CREATE TABLE `package_facilities` (
  `sr_no` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_facilities`
--

INSERT INTO `package_facilities` (`sr_no`, `package_id`, `facilities_id`) VALUES
(699, 62, 26),
(700, 62, 32),
(701, 62, 36),
(702, 69, 26),
(703, 69, 32),
(704, 69, 34),
(705, 69, 35),
(706, 69, 36),
(707, 70, 32),
(708, 70, 34),
(709, 70, 36),
(714, 73, 26),
(715, 73, 32),
(716, 72, 32),
(717, 72, 34),
(718, 72, 35),
(719, 72, 36),
(720, 74, 26),
(721, 74, 32),
(722, 74, 34),
(723, 74, 36),
(724, 75, 34),
(725, 75, 35),
(726, 75, 36),
(727, 71, 26);

-- --------------------------------------------------------

--
-- Table structure for table `package_features`
--

CREATE TABLE `package_features` (
  `sr_no` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_features`
--

INSERT INTO `package_features` (`sr_no`, `package_id`, `features_id`) VALUES
(643, 62, 46),
(644, 62, 49),
(645, 69, 49),
(646, 70, 27),
(647, 70, 30),
(648, 70, 47),
(649, 70, 49),
(650, 70, 52),
(654, 73, 27),
(655, 73, 47),
(656, 73, 49),
(657, 72, 49),
(658, 72, 50),
(659, 72, 52),
(660, 74, 30),
(661, 74, 45),
(662, 74, 50),
(663, 74, 51),
(664, 74, 52),
(665, 75, 49),
(666, 75, 52),
(667, 71, 27),
(668, 71, 47),
(669, 71, 51),
(670, 71, 52);

-- --------------------------------------------------------

--
-- Table structure for table `package_image`
--

CREATE TABLE `package_image` (
  `sr_no` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_image`
--

INSERT INTO `package_image` (`sr_no`, `package_id`, `image`, `thumb`) VALUES
(52, 62, 'IMG_60276.jpg', 0),
(53, 62, 'IMG_55894.jpg', 1),
(54, 62, 'IMG_18279.jpg', 0),
(59, 62, 'IMG_61964.jpg', 0),
(76, 62, 'IMG_77219.jpg', 0),
(78, 62, 'IMG_31521.jpg', 0),
(79, 69, 'IMG_14859.jpeg', 0),
(80, 69, 'IMG_73498.jpeg', 1),
(81, 69, 'IMG_45620.jpeg', 0),
(82, 69, 'IMG_60868.jpeg', 0),
(83, 70, 'IMG_28512.jpg', 0),
(84, 70, 'IMG_47899.jpg', 1),
(86, 70, 'IMG_16585.jpg', 0),
(87, 70, 'IMG_61864.jpg', 0),
(88, 72, 'IMG_76889.jpg', 1),
(89, 72, 'IMG_39093.jpg', 0),
(90, 72, 'IMG_72795.jpeg', 0),
(91, 72, 'IMG_26201.jpg', 0),
(92, 73, 'IMG_64207.jpg', 0),
(95, 74, 'IMG_35855.jpg', 0),
(96, 74, 'IMG_49508.jpg', 1),
(97, 74, 'IMG_57755.jpg', 0),
(98, 74, 'IMG_41321.jpg', 0),
(99, 75, 'IMG_43544.jpg', 1),
(100, 75, 'IMG_31772.jpg', 0),
(101, 75, 'IMG_99898.jpg', 0),
(102, 75, 'IMG_38057.jpg', 0),
(103, 73, 'IMG_32792.jpg', 0),
(104, 73, 'IMG_86323.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rating_review`
--

CREATE TABLE `rating_review` (
  `sr_no` int(11) NOT NULL,
  `boking_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(200) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating_review`
--

INSERT INTO `rating_review` (`sr_no`, `boking_id`, `package_id`, `user_id`, `rating`, `review`, `seen`, `datentime`) VALUES
(55, 70647368, 73, 70, 3, 'goof', 0, '2025-03-09 11:19:02'),
(56, 70269259, 74, 70, 5, 'nice', 0, '2025-03-09 11:20:24'),
(57, 73511707, 75, 73, 4, 'nice , the website is also easy to use!!', 0, '2025-03-09 12:46:45'),
(58, 70629703, 74, 70, 3, 'Nice Package', 0, '2025-03-09 15:20:05'),
(59, 74202233, 75, 74, 5, 'The Manali package is soo good. Nice experience with easytravels..', 0, '2025-03-09 16:47:42'),
(60, 75182347, 75, 75, 2, 'low review to check', 0, '2025-03-09 17:06:48'),
(61, 75730492, 75, 75, 5, 'VeryGood', 0, '2025-03-09 17:08:33'),
(62, 69348781, 75, 69, 5, 'We enjoyed a trip a lot yesterday', 0, '2025-03-09 17:24:44');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(250) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'EasyTravels', 'EasyTravels specializes in curated travel experiences, offering adventure tours, family vacations, and honeymoon getaways. From sightseeing to cultural experiences, we provide the best itineraries to make your journey memorable.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `team_details`
--

CREATE TABLE `team_details` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_details`
--

INSERT INTO `team_details` (`sr_no`, `name`, `picture`) VALUES
(62, 'Aryan Vivekanand Mali', 'IMG_12073.jpg'),
(63, 'ayn ar', 'IMG_34583.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phonenum` varchar(200) NOT NULL,
  `profile` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(200) DEFAULT NULL,
  `t_expire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `email`, `address`, `phonenum`, `profile`, `password`, `is_verified`, `token`, `t_expire`, `status`, `datetime`) VALUES
(69, 'sreyoshie', 'sanjyotimali51@gmail.com', 'sa', '913632053', 'IMG_46374.jpeg', '$2y$10$AM156n2Gvf8tJaDQY6FcyOl.gBotOSkDKOPmF46JDSGJeOIgPq/p2', 1, NULL, NULL, 1, '2025-03-09 08:28:35'),
(70, 'Vijay', 'aryanmali@gmail.com', '1', '1234567891', 'IMG_80356.jpeg', '$2y$10$Xt3fbJgqClrZsEwJMl/5musdZKMzeZQEH/pSGtID5nh7EvnTwNUra', 1, NULL, NULL, 1, '2025-03-09 10:37:21'),
(72, 'Shrush', 'shrushtimalusare30@gmail.com', 'Mulund', '7887569401', 'IMG_14730.jpeg', '$2y$10$lp9fI.m19pVGk7.TpBPWEupfQdoBtkjDGXUk/9jKVd7760rT.RW4i', 1, '0e39f1c6559f37c5907c072f3c7377f9', NULL, 1, '2025-03-09 12:35:42'),
(73, 'Pratik', 'pratikkadam1030@gmail.com', '211 sbc bhandup', '9892310688', 'IMG_35326.jpeg', '$2y$10$LL3uq.ByLio1RotgGjxO5eTKh.F.y3CiPr0IE78HnlZqDe2yRwSRu', 1, 'e5c9a290eb70415587b7c4bc8ff2f4b7', NULL, 1, '2025-03-09 12:43:16'),
(74, 'OMKARDhadam', 'omkardhadam979@gmail.com', 'Ok', '7506381038', 'IMG_98821.jpeg', '$2y$10$gqpOZwgrZPka53DoFGtKJObS.eob.ziL68skfqpFDn4TeW.GCQuPG', 1, '85feaf6545768e6b766f4a841637a7fd', NULL, 1, '2025-03-09 16:11:27'),
(75, 'Gzon1', 'gzon598@gmail.com', '11', '9132222053', 'IMG_60787.jpeg', '$2y$10$RuAxradwSMXf9eDRDQGhQOjMt.TxRLX0LpY5juKDgGc3gBZcwa1kS', 1, 'e996c967475d4f20d4b2553eaa2c8464', NULL, 1, '2025-03-09 16:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_queries`
--

INSERT INTO `user_queries` (`sr_no`, `name`, `email`, `subject`, `message`, `date`, `seen`) VALUES
(68, 'Johneruby', 'yawiviseya67@gmail.com', 'Hi  i am write about your   prices', 'Ciao, volevo sapere il tuo prezzo.', '2025-03-01', 0),
(72, 'Aryan', 'aryanmali440@gmail.com', 'Special Rates Required', 'Can I get special rates', '2025-03-09', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_facilities`
--
ALTER TABLE `package_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `facilities id` (`facilities_id`),
  ADD KEY `package id` (`package_id`);

--
-- Indexes for table `package_features`
--
ALTER TABLE `package_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `features id` (`features_id`),
  ADD KEY `pid` (`package_id`);

--
-- Indexes for table `package_image`
--
ALTER TABLE `package_image`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `rating_review`
--
ALTER TABLE `rating_review`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `boking_id` (`boking_id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `team_details`
--
ALTER TABLE `team_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `booking_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75730493;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `package_facilities`
--
ALTER TABLE `package_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=728;

--
-- AUTO_INCREMENT for table `package_features`
--
ALTER TABLE `package_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=671;

--
-- AUTO_INCREMENT for table `package_image`
--
ALTER TABLE `package_image`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `rating_review`
--
ALTER TABLE `rating_review`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `team_details`
--
ALTER TABLE `team_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `orders` (`booking_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`);

--
-- Constraints for table `package_facilities`
--
ALTER TABLE `package_facilities`
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `package id` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `package_features`
--
ALTER TABLE `package_features`
  ADD CONSTRAINT `features id` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `pid` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `package_image`
--
ALTER TABLE `package_image`
  ADD CONSTRAINT `package_image_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`);

--
-- Constraints for table `rating_review`
--
ALTER TABLE `rating_review`
  ADD CONSTRAINT `rating_review_ibfk_1` FOREIGN KEY (`boking_id`) REFERENCES `orders` (`booking_id`),
  ADD CONSTRAINT `rating_review_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`),
  ADD CONSTRAINT `rating_review_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
