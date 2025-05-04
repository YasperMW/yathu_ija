-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 12, 2024 at 09:45 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `update_date_based_on_weekday`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_date_based_on_weekday` ()   BEGIN
    DECLARE current_day INT;
    DECLARE current_weekday INT;

    -- Get the current day of the week (Sunday is 1, Monday is 2, ..., Saturday is 7)
    SET current_day = DAYOFWEEK(CURDATE());

    -- Calculate the offset to the current Wednesday (assuming Wednesday is the target day)
    SET current_weekday = IF(current_day < 4, 4 - current_day, 7 - (current_day - 4));

    -- Update the date column by adding the calculated offset
    UPDATE schedule
    SET date = CURDATE() + INTERVAL current_weekday DAY;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `pass_word` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `pass_word`, `email`) VALUES
(1, 'admin123', 'admin1@example.com'),
(2, 'securepass', 'admin2@example.com'),
(3, 'password123', 'admin3@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

DROP TABLE IF EXISTS `bus`;
CREATE TABLE IF NOT EXISTS `bus` (
  `bus_id` int NOT NULL AUTO_INCREMENT,
  `bus_name` varchar(255) DEFAULT NULL,
  `number_plate` varchar(20) DEFAULT NULL,
  `number_of_seats` int DEFAULT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `mileage` decimal(10,2) DEFAULT NULL,
  `bus_type` varchar(50) DEFAULT NULL,
  `availability` varchar(50) NOT NULL,
  `fuel_used` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`bus_id`),
  UNIQUE KEY `number_plate` (`number_plate`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`bus_id`, `bus_name`, `number_plate`, `number_of_seats`, `weight`, `mileage`, `bus_type`, `availability`, `fuel_used`) VALUES
(1, 'CITY TOURS', 'BTW524', 66, 4000.00, 70000.00, 'Passenger Bus', 'Available', 589.00),
(2, 'MATOURS', 'LBP675', 50, 4000.00, 0.00, 'Passenger Bus', 'Available', 6000.00),
(3, 'FUTURE TOURS', 'BOO467', 40, 2000.00, 3250.00, 'Passenger Bus', 'Available', 4000.00),
(4, 'POST TOURS', 'CVB123', 60, 3000.00, 0.00, 'Passenger Bus', 'Available', 300.00),
(5, 'AXA COACH', 'AOL673', 50, 34500.00, 200.00, 'Hire Bus', 'Available', 15678.00),
(6, 'NJINGA YAMOTO', 'POL450', 50, 2000.00, 65.00, 'Hire Bus', 'Available', 4567.00);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(25) NOT NULL,
  `date_of_birth` date NOT NULL,
  `pass_word` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

DROP TABLE IF EXISTS `driver`;
CREATE TABLE IF NOT EXISTS `driver` (
  `driver_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `phone_number` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `licence` varchar(25) NOT NULL,
  `certification` varchar(50) NOT NULL,
  `perfomance` int NOT NULL,
  `salary` int NOT NULL,
  `driver_condition` varchar(50) NOT NULL,
  PRIMARY KEY (`driver_id`)
) ENGINE=MyISAM AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `first_name`, `last_name`, `phone_number`, `email`, `date_of_birth`, `licence`, `certification`, `perfomance`, `salary`, `driver_condition`) VALUES
(101, 'John', 'Doe', 123456789, 'john.doe@example.com', '1990-01-01', '12345678901234', 'CDL', 0, 8000, 'Active'),
(102, 'Jane', 'Smith', 987654321, 'jane.smith@example.com', '1992-05-15', '0987654321', 'CDL', 0, 4500, 'Active'),
(103, 'Michael', 'Johnson', 555555555, 'michael.johnson@example.com', '1985-12-10', '111222333', 'CDL', 0, 4000, 'Inactive'),
(105, 'Yankho', 'chisale', 883271664, 'yankhochisale4@gmail.com', '2024-04-30', '12345678', '', 7, 500000, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `hire_receipt`
--

DROP TABLE IF EXISTS `hire_receipt`;
CREATE TABLE IF NOT EXISTS `hire_receipt` (
  `hire_receipt_id` int NOT NULL AUTO_INCREMENT,
  `bus_id` int DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `specified_distance` decimal(10,2) DEFAULT NULL,
  `payable_amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `gender` varchar(8) NOT NULL,
  `date_of_birth` date NOT NULL,
  `receipt_status` varchar(50) DEFAULT 'Pending Confirmation',
  `credit_card_number` varchar(20) NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `CCV` int DEFAULT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`hire_receipt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hire_receipt`
--

INSERT INTO `hire_receipt` (`hire_receipt_id`, `bus_id`, `first_name`, `last_name`, `email`, `specified_distance`, `payable_amount`, `payment_method`, `gender`, `date_of_birth`, `receipt_status`, `credit_card_number`, `expiry_date`, `CCV`, `proof_of_payment`) VALUES
(45, 6, 'Yankho', 'Chisale', 'jimmywellington805@gmail.com', 30.00, 186600.00, 'Cash', 'Male', '2008-01-01', 'Pending Confirmation', '', NULL, NULL, NULL),
(13, 1, 'Yankho', 'chisale', 'yankhochisale4@gmail.com', 12.00, 7200.00, 'Cash', '', '0000-00-00', 'paid', '', NULL, NULL, NULL),
(12, 1, 'Yankho', 'chisale', 'yankhochisale4@gmail.com', 12.00, 7200.00, 'Cash', '', '0000-00-00', 'paid', '', NULL, NULL, NULL),
(18, 5, 'Yankho', 'chisale', 'ulunjiewana@gmail.com', 132.00, 79200.00, 'Credit Card', '', '0000-00-00', 'Pending Confirmation', '', NULL, NULL, NULL),
(19, 5, 'Yankho', 'chisale', 'ulunjiewana@gmail.com', 132.00, 79200.00, 'Mobile Money', '', '0000-00-00', 'Pending Confirmation', '', NULL, NULL, NULL),
(20, 5, 'ulunjie', 'Wana', 'yankhochisale4@gmail.com', 1212.00, 727200.00, 'Credit Card', 'Male', '2024-05-08', 'Pending Confirmation', '123456789', '2024-05-29', 123, NULL),
(21, 5, 'ulunjie', 'Wana', 'yankhochisale4@gmail.com', 1212.00, 727200.00, 'Mobile Money', '', '0000-00-00', 'Pending Confirmation', '', NULL, NULL, 'uploads/1+(1).jpg'),
(22, 5, 'Yankho', 'chisale', 'yankhochisale4@gmail.com', 0.00, 120600.00, 'Cash', 'Male', '2024-05-15', 'Pending Confirmation', '', NULL, NULL, NULL),
(23, 5, 'Yankho', 'chisale', 'yankhochisale4@gmail.com', 123.00, 73800.00, 'Cash', 'Male', '2024-05-08', 'Pending Confirmation', '', NULL, NULL, NULL),
(24, 5, 'Yankho', 'chisale', 'yankhochisale4@gmail.com', 1232.00, 120600.00, 'Credit Card', '', '0000-00-00', 'Pending Confirmation', '1234567780902', '2024-05-22', 123, NULL),
(25, 5, 'Yankho', 'chisale', 'yankhochisale4@gmail.com', 1232.00, 739200.00, 'Cash', '', '0000-00-00', 'Pending Confirmation', '', NULL, NULL, NULL),
(26, 5, 'Yankho', 'chisale', 'yankhochisale4@gmail.com', 1232.00, 739200.00, 'Cash', '', '0000-00-00', 'Pending Confirmation', '', NULL, NULL, NULL),
(33, 5, 'Yankho', 'chisale', 'ulunjiewana@gmail.com', 0.00, 186600.00, '', 'Male', '2008-01-01', 'Pending Confirmation', '', NULL, NULL, NULL),
(34, 5, 'Yankho', 'chisale', 'ulunjiewana@gmail.com', 213.00, 186600.00, 'Cash', 'Male', '2008-01-01', 'Pending Confirmation', '', NULL, NULL, NULL),
(35, 5, 'Yankho', 'chisale', 'ulunjiewana@gmail.com', 213.00, 127800.00, 'Cash', 'Male', '2008-01-01', 'Pending Confirmation', '', NULL, NULL, NULL),
(36, 5, 'Yankho', 'chisale', 'ulunjiewana@gmail.com', 213.00, 127800.00, 'Mobile Money', 'Male', '2008-01-01', 'Pending Confirmation', '', NULL, NULL, 'uploads/_Tom_Clancy_s_The_division__saving_civilians_045923_.jpg'),
(37, 5, 'Yankho', 'chisale', 'ulunjiewana@gmail.com', 213.00, 127800.00, 'Mobile Money', 'Male', '2008-01-01', 'Pending Confirmation', '', NULL, NULL, 'uploads/_Tom_Clancy_s_The_division__saving_civilians_045923_.jpg'),
(38, 5, 'Yankho', 'chisale', 'ulunjiewana@gmail.com', 40000.00, 24000000.00, 'Cash', 'Male', '2008-01-01', 'Pending Confirmation', '', NULL, NULL, NULL),
(40, 5, 'Yankho', 'chisale', 'ulunjiewana@gmail.com', 123.00, 73800.00, 'Cash', 'Male', '2008-01-01', 'Pending Confirmation', '', NULL, NULL, NULL),
(41, 5, 'Yankho', 'chisale', 'ulunjiewana@gmail.com', 64.00, 38400.00, 'Cash', 'Male', '2008-01-01', 'Pending Confirmation', '', NULL, NULL, NULL),
(42, 5, 'Yankho', 'chisale', 'ulunjiewana@gmail.com', 0.00, 120600.00, 'Cash', 'Male', '2008-01-01', 'Pending Confirmation', '', NULL, NULL, NULL),
(43, 6, 'Yankho', 'chisale', 'ulunjiewana@gmail.com', 125.00, 75000.00, 'Cash', 'Male', '2008-01-01', 'Pending Confirmation', '', NULL, NULL, NULL),
(44, 5, 'hastings', 'fred', 'jimmywellington805@gmail.com', 0.00, 120600.00, 'Mobile Money', 'Male', '2007-12-07', 'Pending Confirmation', '', NULL, NULL, 'uploads/Screenshot (18).png');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

DROP TABLE IF EXISTS `route`;
CREATE TABLE IF NOT EXISTS `route` (
  `route_id` int NOT NULL AUTO_INCREMENT,
  `route_name` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `origin` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `destination` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `distance` int NOT NULL,
  PRIMARY KEY (`route_id`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`route_id`, `route_name`, `origin`, `destination`, `distance`) VALUES
(1, 'balaka-lilongwe', 'balaka', 'lilongwe', 201),
(2, 'blantyre-lilongwe', 'blantyre', 'lilongwe', 311),
(3, 'chikwawa-lilongwe', 'chikwawa', 'lilongwe', 359),
(4, 'chitipa-lilongwe', 'chitipa', 'lilongwe', 691),
(5, 'dedza-lilongwe', 'dedza', 'lilongwe', 84),
(6, 'dowa-lilongwe', 'dowa', 'lilongwe', 53),
(7, 'karonga-lilongwe', 'karonga', 'lilongwe', 590),
(8, 'kasungu-lilongwe', 'kasungu', 'lilongwe', 127),
(9, 'machinga-lilongwe', 'machinga', 'lilongwe', 250),
(10, 'mangochi-lilongwe', 'mangochi', 'lilongwe', 245),
(11, 'blantyre-balaka', 'blantyre', 'balaka', 127),
(12, 'chikwawa-balaka', 'chikwawa', 'balaka', 175),
(13, 'chitipa-balaka', 'chitipa', 'balaka', 889),
(14, 'dedza-balaka', 'dedza', 'balaka', 118),
(15, 'dowa-balaka', 'dowa', 'balaka', 254),
(16, 'karonga-balaka', 'karonga', 'balaka', 788),
(17, 'machinga-balaka', 'machinga', 'balaka', 49),
(18, 'mangochi-balaka', 'mangochi', 'balaka', 97),
(19, 'kasungu-balaka', 'kasungu', 'balaka', 328),
(20, 'chikwawa-blantyre', 'chikwawa', 'blantyre', 54),
(21, 'chitipa-blantyre', 'chitipa', 'blantyre', 1000),
(22, 'dedza-blantyre', 'dedza', 'blantyre', 229),
(23, 'dowa-blantyre', 'dowa', 'blantyre', 365),
(24, 'karonga-blantyre', 'karonga', 'blantyre', 889),
(25, 'kasungu-blantyre', 'kasungu', 'blantyre', 439),
(26, 'machinga-blantyre', 'machinga', 'blantyre', 100),
(27, 'zomba-thyolo', 'zomba', 'thyolo', 105),
(28, 'zomba-salima', 'zomba', 'salima', 243),
(29, 'zomba-salima', 'zomba', 'salima', 243),
(30, 'zomba-rumphi', 'zomba', 'rumphi', 715),
(31, 'zomba-ntchisi', 'zomba', 'ntchisi', 376),
(32, 'zomba-nsanje', 'zomba', 'nsanje', 247),
(33, 'zomba-nkhotakota', 'zomba', 'nkhotakota', 352),
(34, 'zomba-nkhatabay', 'zomba', 'nkhatabay', 550),
(35, 'zomba-mzuzu', 'zomba', 'mzuzu', 650),
(36, 'zomba-mzimba', 'zomba', 'mzimba', 561),
(37, 'zomba-mwanza', 'zomba', 'mwanza', 168),
(38, 'zomba-mulanje', 'zomba', 'mulanje', 125),
(39, 'zomba-monkeybay', 'zomba', 'monkeybay', 189),
(40, 'zomba-mchinji', 'zomba', 'mchinji', 395),
(41, 'zomba-machinga', 'zomba', 'machinga', 36),
(42, 'zomba-kasungu', 'zomba', 'kasungu', 413),
(43, 'zomba-karonga', 'zomba', 'karonga', 815),
(44, 'zomba-dowa', 'zomba', 'dowa', 339),
(45, 'zomba-dedza', 'zomba', 'dedza', 203),
(46, 'zomba-chitipa', 'zomba', 'chitipa', 974),
(47, 'zomba-chikwawa', 'zomba', 'chikwawa', 64),
(48, 'zomba-blantyre', 'zomba', 'blantyre', 64),
(49, 'zomba-lilongwe', 'zomba', 'lilongwe', 286),
(50, 'zomba-balaka', 'zomba', 'balaka', 85),
(51, 'thyolo-salima', 'thyolo', 'salima', 315),
(52, 'thyolo-rumphi', 'thyolo', 'rumphi', 787),
(53, 'thyolo-ntchisi', 'thyolo', 'ntchisi', 448),
(54, 'thyolo-ntcheu', 'thyolo', 'ntcheu', 200),
(55, 'thyolo-nsanje', 'thyolo', 'nsanje', 146),
(56, 'thyolo-nkhotakota', 'thyolo', 'nkhotakota', 424),
(57, 'thyolo-nkhatabay', 'thyolo', 'nkhatabay', 622),
(58, 'thyolo-mzuzu', 'thyolo', 'mzuzu', 722),
(59, 'thyolo-mzimba', 'thyolo', 'mzimba', 633),
(60, 'thyolo-mwanza', 'thyolo', 'mwanza', 150),
(61, 'thyolo-mulanje', 'thyolo', 'mulanje', 47),
(62, 'thyolo-monkeybay', 'thyolo', 'monkeybay', 294),
(64, 'thyolo-mchinji', 'thyolo', 'mchinji', 467),
(65, 'thyolo-mangochi', 'thyolo', 'mangochi', 231),
(66, 'thyolo-machinga', 'thyolo', 'machinga', 141),
(67, 'thyolo-kasungu', 'thyolo', 'kasungu', 485),
(68, 'thyolo-dowa', 'thyolo', 'dowa', 411),
(69, 'thyolo-karonga', 'thyolo', 'karonga', 885),
(70, 'thyolo-dedza', 'thyolo', 'dedza', 275),
(71, 'thyolo-chitipa', 'thyolo', 'chitipa', 1046),
(72, 'thyolo-chikwawa', 'thyolo', 'chikwawa', 101),
(73, 'thyolo-blantyre', 'thyolo', 'blantyre', 47),
(74, 'thyolo-balaka', 'thyolo', 'balaka', 176),
(75, 'thyolo-lilongwe', 'thyolo', 'lilongwe', 358),
(76, 'salima-rumphi', 'salima', 'rumphi', 414),
(77, 'salima-ntchisi', 'salima', 'ntchisi', 120),
(78, 'salima-ntcheu', 'salima', 'ntcheu', 163),
(79, 'salima-nsanje', 'salima', 'nsanje', 445),
(80, 'salima-nkhotakota', 'salima', 'nkhotakota', 111),
(81, 'salima-nkhatabay', 'salima', 'nkhatabay', 309),
(82, 'salima-mzuzu', 'salima', 'mzuzu', 346),
(83, 'salima-mzimba', 'salima', 'mzimba', 464),
(84, 'salima-mwanza', 'salima', 'mwanza', 258),
(85, 'salima-mulanje', 'salima', 'mulanje', 335),
(86, 'salima-monkeybay', 'salima', 'monkeybay', 335),
(87, 'salima-mchinji', 'salima', 'mchinji', 207),
(88, 'salima-mangochi', 'salima', 'mangochi', 172),
(89, 'salima-machinga', 'salima', 'machinga', 207),
(90, 'salima-kasungu', 'salima', 'kasungu', 173),
(91, 'salima-karonga', 'salima', 'karonga', 572),
(92, 'salima-dowa', 'salima', 'dowa', 67),
(93, 'salima-dedza', 'salima', 'dedza', 126),
(94, 'salima-chitipa', 'salima', 'chitipa', 673),
(95, 'salima-chikwawa', 'salima', 'chikwawa', 316),
(96, 'salima-blantyre', 'salima', 'blantyre', 269),
(97, 'salima-balaka', 'salima', 'balaka', 158),
(98, 'salima-lilongwe', 'salima', 'lilongwe', 103),
(99, 'rumphi-ntchisi', 'rumphi', 'ntchisi', 389),
(100, 'rumphi-ntcheu', 'rumphi', 'ntcheu', 588),
(101, 'rumphi-nsanje', 'rumphi', 'nsanje', 917),
(102, 'rumphi-nkhotakota', 'rumphi', 'nkhotakota', 303),
(103, 'rumphi-nkhatabay', 'rumphi', 'nkhatabay', 115),
(104, 'rumphi-mzuzu', 'rumphi', 'mzuzu', 68),
(105, 'rumphi-mzimba', 'rumphi', 'mzimba', 170),
(106, 'rumphi-mwanza', 'rumphi', 'mwanza', 730),
(107, 'rumphi-mulanje', 'rumphi', 'mulanje', 807),
(108, 'rumphi-monkeybay', 'rumphi', 'monkeybay', 545),
(109, 'rumphi-mchinji', 'rumphi', 'mchinji', 440),
(110, 'rumphi-mangochi', 'rumphi', 'mangochi', 584),
(111, 'rumphi-mangochi', 'rumphi', 'mangochi', 440),
(112, 'rumphi-machinga', 'rumphi', 'machinga', 728),
(113, 'rumphi-kasungu', 'rumphi', 'kasungu', 305),
(114, 'rumphi-karonga', 'rumphi', 'karonga', 176),
(115, 'rumphi-dowa', 'rumphi', 'dowa', 410),
(116, 'rumphi-dedza', 'rumphi', 'dedza', 513),
(117, 'rumphi-chitipa', 'rumphi', 'chitipa', 276),
(118, 'rumphi-chikwawa', 'rumphi', 'chikwawa', 788),
(119, 'rumphi-blantyre', 'rumphi', 'blantyre', 741),
(120, 'rumphi-balaka', 'rumphi', 'balaka', 630),
(121, 'rumphi-lilongwe', 'rumphi', 'lilongwe', 432),
(122, 'ntchisi-ntcheu', 'ntchisi', 'ntcheu', 248),
(123, 'ntchisi-nsanje', 'ntchisi', 'nsanje', 578),
(124, 'ntchisi-nkhotakota', 'ntchisi', 'nkhotakota', 89),
(125, 'ntchisi-nkhatabay', 'ntchisi', 'nkhatabay', 370),
(126, 'ntchisi-mzuzu', 'ntchisi', 'mzuzu', 324),
(127, 'ntchisi-mzimba', 'ntchisi', 'mzimba', 535),
(128, 'ntchisi-mwanza', 'ntchisi', 'mwanza', 391),
(129, 'ntchisi-mulanje', 'ntchisi', 'mulanje', 468),
(130, 'ntchisi-monkeybay', 'ntchisi', 'monkeybay', 251),
(131, 'ntchisi-mchinji', 'ntchisi', 'mchinji', 194),
(132, 'ntchisi-mangochi', 'ntchisi', 'mangochi', 290),
(133, 'ntchisi-machinga', 'ntchisi', 'machinga', 340),
(134, 'ntchisi-kasungu', 'ntchisi', 'kasungu', 85),
(135, 'ntchisi-karonga', 'ntchisi', 'karonga', 547),
(136, 'ntchisi-dowa', 'ntchisi', 'dowa', 53),
(137, 'ntchisi-dedza', 'ntchisi', 'dedza', 174),
(138, 'ntchisi-chitipa', 'ntchisi', 'chitipa', 648),
(139, 'ntchisi-chikwawa', 'ntchisi', 'chikwawa', 449),
(140, 'ntchisi-blantyre', 'ntchisi', 'blantyre', 402),
(141, 'ntchisi-balaka', 'ntchisi', 'balaka', 291),
(142, 'ntchisi-lilongwe', 'ntchisi', 'lilongwe', 90),
(143, 'ntcheu-nsanje', 'ntcheu', 'nsanje', 330),
(144, 'ntcheu-nkhotakota', 'ntcheu', 'nkhotakota', 272),
(145, 'ntcheu-nkhatabay', 'ntcheu', 'nkhatabay', 752),
(146, 'ntcheu-mzuzu', 'ntcheu', 'mzuzu', 523),
(147, 'ntcheu-mzimba', 'ntcheu', 'mzimba', 434),
(148, 'ntcheu-mwanza', 'ntcheu', 'mwanza', 143),
(149, 'ntcheu-mulanje', 'ntcheu', 'mulanje', 220),
(150, 'ntcheu-monkeybay', 'ntcheu', 'monkeybay', 155),
(151, 'ntcheu-mchinji', 'ntcheu', 'mchinji', 267),
(152, 'ntcheu-mangochi', 'ntcheu', 'mangochi', 141),
(153, 'ntcheu-machinga', 'ntcheu', 'machinga', 92),
(154, 'ntcheu-kasungu', 'ntcheu', 'kasungu', 284),
(155, 'ntcheu-karonga', 'ntcheu', 'karonga', 746),
(156, 'ntcheu-dowa', 'ntcheu', 'dowa', 211);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `schedule_id` int NOT NULL AUTO_INCREMENT,
  `schedule_name` varchar(25) NOT NULL,
  `time_stamp` time NOT NULL,
  `date` date NOT NULL,
  `route_id` int NOT NULL,
  `bus_id` int NOT NULL,
  `driver_id` int NOT NULL,
  PRIMARY KEY (`schedule_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `schedule_name`, `time_stamp`, `date`, `route_id`, `bus_id`, `driver_id`) VALUES
(1, 'Morning Route', '08:30:00', '2024-05-14', 1, 1, 101),
(2, 'Afternoon Route', '13:00:00', '2024-05-15', 2, 2, 102),
(3, 'Evening Route', '18:00:00', '2024-05-15', 3, 3, 103),
(4, 'Morning Route', '08:00:00', '2024-05-16', 1, 1, 101),
(5, 'Afternoon Route', '13:00:00', '2024-05-17', 1, 2, 102),
(6, 'Evening Route', '18:00:00', '2024-05-18', 1, 3, 103),
(7, 'Morning Route', '08:00:00', '2024-05-19', 1, 1, 101),
(8, 'Afternoon Route', '13:30:00', '2024-05-20', 1, 2, 102),
(9, 'Evening Route', '18:30:00', '2024-05-21', 1, 3, 103),
(10, 'Evening', '13:30:00', '2024-05-22', 1, 1, 103),
(12, 'Evening', '13:30:00', '2024-06-04', 1, 1, 103);

-- --------------------------------------------------------

--
-- Table structure for table `seat_ticket`
--

DROP TABLE IF EXISTS `seat_ticket`;
CREATE TABLE IF NOT EXISTS `seat_ticket` (
  `ticket_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `payment_method` varchar(25) NOT NULL,
  `amount` int NOT NULL,
  `bus_id` int NOT NULL,
  `seat_number` int DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL,
  `card_number` varchar(20) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `ccv` varchar(3) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'pending confirmation',
  `customer_type` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `route_id` int DEFAULT NULL,
  `schedule_id` int DEFAULT NULL,
  `original_amount` decimal(65,2) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `gender` varchar(8) NOT NULL,
  PRIMARY KEY (`ticket_id`)
) ENGINE=MyISAM AUTO_INCREMENT=186 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `seat_ticket`
--

INSERT INTO `seat_ticket` (`ticket_id`, `first_name`, `last_name`, `payment_method`, `amount`, `bus_id`, `seat_number`, `email`, `proof_of_payment`, `card_number`, `expiry_date`, `ccv`, `status`, `customer_type`, `date_of_birth`, `route_id`, `schedule_id`, `original_amount`, `booking_date`, `gender`) VALUES
(118, 'Yankho', 'chisale', 'Cash', 167940, 2, 1, 'phiri64paul@gmail.com', NULL, NULL, NULL, NULL, 'paid', 'Children', NULL, NULL, NULL, NULL, '2024-05-08', ''),
(130, 'ulunjie', 'wana', 'Cash', 139950, 2, 2, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', NULL, NULL, NULL, '2024-05-08', ''),
(184, 'hastings', 'fred', 'Cash', 161550, 3, 2, 'jimmywellington805@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2007-12-31', 3, 3, 215400.00, '2024-05-15', 'Male'),
(136, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 8, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(137, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 9, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(138, 'ulunjie', 'ulunjie', 'Cash', 167940, 2, 10, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'inter-regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(139, 'ulunjie', 'ulunjie', 'Cash', 186600, 2, 11, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'inter-regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(140, 'ulunjie', 'ulunjie', 'Cash', 186600, 2, 12, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'inter-regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(141, 'ulunjie', 'ulunjie', 'Cash', 186600, 2, 13, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'inter-regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(142, 'ulunjie', 'ulunjie', 'Cash', 186600, 2, 14, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'inter-regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(143, 'ulunjie', 'ulunjie', 'Cash', 0, 2, 15, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'inter-regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(144, 'ulunjie', 'ulunjie', 'Cash', 186600, 2, 16, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'inter-regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(145, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 17, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(146, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 18, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(147, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 19, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(148, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 20, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(149, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 21, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(150, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 22, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 0, 2, 186600.00, '2024-05-08', ''),
(151, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 23, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 0, 2, 186600.00, '2024-05-08', ''),
(152, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 24, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(175, 'ulunjie', 'ulunjie', 'Mobile Money', 139950, 2, 45, 'ulunjiewana@gmail.com', 'uploads/_Tom_Clancy_s_The_division__saving_civilians_045923_.jpg', NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(172, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 43, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(155, 'ulunjie', 'ulunjie', 'Cash', 90450, 1, 1, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 1, 1, 120600.00, '2024-05-08', ''),
(156, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 27, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(157, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 28, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(158, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 29, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(159, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 30, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(160, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 31, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(161, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 32, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(162, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 33, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(163, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 34, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(164, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 35, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(165, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 36, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(166, 'ulunjie', 'ulunjie', 'Cash', 186600, 2, 37, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'inter-regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(167, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 38, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(168, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 39, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(169, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 40, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(173, 'ulunjie', 'ulunjie', 'Cash', 139950, 2, 44, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 2, 2, 186600.00, '2024-05-08', ''),
(176, 'ulunjie', 'ulunjie', 'Cash', 90450, 1, 2, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 1, 4, 120600.00, '2024-05-09', 'Male'),
(177, 'ulunjie', 'baka', 'Cash', 90450, 1, 3, 'ulunjiewana@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2003-08-13', 1, 4, 120600.00, '2024-05-09', 'Female'),
(179, 'Paul', 'Phiri', 'Cash', 90450, 1, 4, 'phiri6paul@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2004-06-08', 1, 4, 120600.00, '2024-05-09', 'Male'),
(185, 'hastings', 'fred', 'Cash', 161550, 3, 3, 'jimmywellington805@gmail.com', NULL, NULL, NULL, NULL, 'pending confirmation', 'regional', '2007-12-31', 3, 3, 215400.00, '2024-05-15', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `tms_feedback`
--

DROP TABLE IF EXISTS `tms_feedback`;
CREATE TABLE IF NOT EXISTS `tms_feedback` (
  `f_id` int NOT NULL AUTO_INCREMENT,
  `f_uname` varchar(200) NOT NULL,
  `f_content` longtext NOT NULL,
  `f_status` varchar(200) NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tms_feedback`
--

INSERT INTO `tms_feedback` (`f_id`, `f_uname`, `f_content`, `f_status`) VALUES
(1, 'Elliot Gape', 'I like how fast i can travel with your buses. Last week, i left blantyre at 10am\r\nby 4pm i had arrived in Mzuzu. I surely recommend ', 'Published'),
(2, 'Mark L. Anderson', 'The inside of your buses is so refreshing and very comfortable... A very executive suit.', 'Published'),
(18, 'hastings fred', 'please the speed its so unsafe', 'Pending'),
(20, 'hastings fred', 'Very Good service', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(7) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass_word` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `user_type`, `phone_number`, `date_of_birth`, `gender`, `email`, `pass_word`) VALUES
(1, 'Yankho', 'chisale', 'Admin', '0883271664', '2002-05-26', 'Male', 'yankhochisale4@gmail.com', '3f5b380ac3cbce3dbf23c810c6411e8b808f3d5d4c053112d79f5b55b58b3bc8'),
(2, 'ulunjie', 'ulunjie', 'Customer', '0997823454', '2003-08-13', 'Male', 'ulunjiewana@gmail.com', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414'),
(4, 'Hastings', 'Fred', 'Customer', '0982246111', '2003-06-17', 'Male', 'hastingsfred4@gmail.com', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225'),
(5, 'hastings', 'fred', 'Customer', '099923543', '2007-12-31', 'Male', 'jimmywellington805@gmail.com', '7f5741fbd93481f422aa5d0373c8b1c0bce7d4b9fa900bc40ac8fc624011e98d');

DELIMITER $$
--
-- Events
--
DROP EVENT IF EXISTS `update_date_event`$$
CREATE DEFINER=`root`@`localhost` EVENT `update_date_event` ON SCHEDULE EVERY 1 WEEK STARTS '2024-05-05 18:28:03' ON COMPLETION NOT PRESERVE ENABLE DO CALL update_date_based_on_weekday()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
