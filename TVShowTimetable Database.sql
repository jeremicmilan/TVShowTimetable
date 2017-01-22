-- Database: `tvshowsTimetable`

DROP DATABASE IF EXISTS `TVShowsTimetable`;
CREATE DATABASE `TVShowsTimetable`;

USE `TVShowsTimetable`;

-- Table structure for table `User`

CREATE TABLE `User` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` CHAR(32) NOT NULL,
  `email` varchar(40) NOT NULL,
  PRIMARY KEY (user_id),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Table structure for table `tvshow`

CREATE TABLE `TVShow` (
  `tvshow_id` INT NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `last_update` datetime NOT NULL,
  `picture` text,
  PRIMARY KEY (tvshow_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table structure for table `Watching`

CREATE TABLE `Watching` (
  `user_id` INT NOT NULL,
  `tvshow_id` INT NOT NULL,
  PRIMARY KEY (`user_id`, `tvshow_id`),
  FOREIGN KEY (`user_id`) REFERENCES `User`(`user_id`) ON DELETE CASCADE,
  FOREIGN KEY (`tvshow_id`) REFERENCES `TVShow`(`tvshow_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table structure for table `Season`

CREATE TABLE `Season` (
  `tvshow_id` INT NOT NULL,
  `season_id` INT NOT NULL,
  PRIMARY KEY (`tvshow_id`, `season_id`),
  FOREIGN KEY (`tvshow_id`) REFERENCES `TVShow`(`tvshow_id`)
	ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table structure for table `Episode`

CREATE TABLE `Episode` (
  `tvshow_id` INT NOT NULL,
  `season_id` INT NOT NULL,
  `episode_id` INT NOT NULL,
  `title` varchar(50) NOT NULL,
  `airdate` datetime NOT NULL,
  `description` text NOT NULL,
  `picture` text,
  PRIMARY KEY (`tvshow_id`, `season_id`, `episode_id`),
  FOREIGN KEY (`tvshow_id`, `season_id`) REFERENCES `Season`(`tvshow_id`, `season_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
