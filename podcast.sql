-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.14 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5249
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for podcasts
CREATE DATABASE IF NOT EXISTS `podcasts` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `podcasts`;

-- Dumping structure for table podcasts.podcasts_tracks
CREATE TABLE IF NOT EXISTS `podcasts_tracks` (
  `tracks_id` int(11) NOT NULL AUTO_INCREMENT,
  `track_artist` varchar(255) NOT NULL,
  `track_title` varchar(255) NOT NULL,
  `podcast_id` int(11) NOT NULL,
  PRIMARY KEY (`tracks_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table podcasts.podcasts_tracks: 3 rows
DELETE FROM `podcasts_tracks`;
/*!40000 ALTER TABLE `podcasts_tracks` DISABLE KEYS */;
INSERT INTO `podcasts_tracks` (`tracks_id`, `track_artist`, `track_title`, `podcast_id`) VALUES
	(1, 'artist 1', 'track 1', 1),
	(2, 'artist 2', 'track 2', 1),
	(3, 'new', 'new', 1);
/*!40000 ALTER TABLE `podcasts_tracks` ENABLE KEYS */;

-- Dumping structure for table podcasts.pod_list
CREATE TABLE IF NOT EXISTS `pod_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `date` date NOT NULL,
  `duration` time NOT NULL,
  `mixcloud_url` varchar(255) NOT NULL,
  `live` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table podcasts.pod_list: 2 rows
DELETE FROM `pod_list`;
/*!40000 ALTER TABLE `pod_list` DISABLE KEYS */;
INSERT INTO `pod_list` (`id`, `title`, `description`, `date`, `duration`, `mixcloud_url`) VALUES
	(1, 'Raveon&#39;s Show #001', 'Hello fellow music lovers, it&#39;s been a long time waiting, but I&#39;m back. After the birth of my daugter DJing had to be to put on hold to make sure our daughter had the best start in life. She is now close to 5 years old, and the Rave is back on!<br><br>\r\nI will start with a monthly show, and if it does prove to be popular and I have time, it will be more frequent podcast.<br><br>\r\nIn this very first episode I will take you through some of the stuff I was playing back in 2013 and I might drop some new stuff in...so sit back, turn on your speakrs and enjoy!', '2018-04-05', '01:00:00', ''),
	(2, 'Raveon&#39;s Show #002', 'Testing', '2018-04-10', '01:00:00', '');
/*!40000 ALTER TABLE `pod_list` ENABLE KEYS */;

-- Dumping structure for table podcasts.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table podcasts.users: 1 rows
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`) VALUES
	(1, 'user', '');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
