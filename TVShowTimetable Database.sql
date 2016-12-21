-- Database: `TVShowsTimetable`

DROP DATABASE IF EXISTS `TVShowsTimetable`;
CREATE DATABASE `TVShowsTimetable`;

USE `TVShowsTimetable`;

-- Table structure for table `User`

CREATE TABLE `User` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` CHAR(32) NOT NULL,
  `email` varchar(40) NOT NULL,
  PRIMARY KEY (user_id),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Table structure for table `TVShow`

CREATE TABLE `TVShow` (
  `TVShow_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `last_update` datetime NOT NULL,
  `picture` text,
  PRIMARY KEY (TVShow_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table structure for table `Watching`

CREATE TABLE `Watching` (
  `user_id` int(11) NOT NULL,
  `TVShow_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`, `TVShow_id`),
  FOREIGN KEY (`user_id`) REFERENCES `User`(`user_id`)
	ON DELETE CASCADE,
  FOREIGN KEY (`TVShow_id`) REFERENCES `TVShow`(`TVShow_id`)
	ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table structure for table `Season`

CREATE TABLE `Season` (
  `season_id` int(11) NOT NULL AUTO_INCREMENT,
  `TVShow_id` int(11) NOT NULL,
  PRIMARY KEY (`season_id`),
  FOREIGN KEY (`TVShow_id`) REFERENCES `TVShow`(`TVShow_id`)
	ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table structure for table `Episode`

CREATE TABLE `Episode` (
  `episode_id` int(11) NOT NULL AUTO_INCREMENT,
  `season_id` int(11) NOT NULL,
  `airdate` datetime NOT NULL,
  `description` text NOT NULL,
  `picture` text,
  PRIMARY KEY (`episode_id`),
  FOREIGN KEY (`season_id`) REFERENCES `Season`(`season_id`)
	ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Inserting data into tables

INSERT INTO `User` (`username`, `password`, `email`)
VALUES 	('milosh', md5('miloshcic'), 'milosh.mitrovic@gmail.com'),
	('jana', md5('janica'), 'proticjana@gmail.com'),
	('milan', md5('milancic'), 'milanjeremic@live.com');

INSERT INTO TVShow (`title`, `description`, `last_update`)
VALUES	('Game of Thrones', 'Nine noble families fight for control over the mythical lands of Westeros. Meanwhile, a forgotten race hell-bent on destruction returns after being dormant for thousands of years.', NOW()),
	('Orange is the New Black', 'The story of Piper Chapman, a woman in her thirties who is sentenced to fifteen months in prison after being convicted of a decade-old crime of transporting money to her drug-dealing girlfriend.', NOW()),
	('Breaking Bad', 'A high school chemistry teacher diagnosed with inoperable lung cancer turns to manufacturing and selling methamphetamine in order to secure his family\'s future.', NOW());

INSERT INTO Watching (`user_id`, `TVShow_id`)
VALUES 	(1, 1),
	(1, 2),
	(1, 3),
	(2, 1),
	(2, 2),
	(2, 3),
	(3, 1),
	(3, 3);
