-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2019 at 09:44 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Table structure for table `album`
--
DROP TABLE IF EXISTS `melis_demo_album` ;

CREATE TABLE `melis_demo_album` (
  `alb_id` int(11) NOT NULL,
  `alb_name` varchar(255) NOT NULL,
  `alb_date` date NOT NULL,
  `alb_song_num` int(11) NOT NULL,
  PRIMARY KEY (`alb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `album`
--

INSERT INTO `melis_demo_album` (`alb_id`, `alb_name`, `alb_date`, `alb_song_num`) VALUES
  (1, 'Album Vol. 1', '2019-06-21', 8),
  (2, 'Album Vol. 2', '2019-06-27', 5),
  (3, 'Album Vol. 3', '2019-06-22', 6),
  (4, 'Album Vol. 4', '2019-06-23', 9),
  (5, 'Album Vol.  5', '2019-06-22', 7);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
