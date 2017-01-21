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

-- Inserting data into tables

INSERT INTO `User` (`username`, `password`, `email`)
VALUES 	('milosh', md5('miloshcic'), 'milosh.mitrovic@gmail.com'),
        ('jana', md5('janica'), 'proticjana@gmail.com'),
        ('milan', md5('milancic'), 'milanjeremic@live.com');

INSERT INTO TVShow (`tvshow_id`, `title`, `description`, `last_update`, `picture`)
VALUES	(0944947, 'Game of Thrones', 'Nine noble families fight for control over the mythical lands of Westeros. Meanwhile, a forgotten race hell-bent on destruction returns after being dormant for thousands of years.', NOW(), 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjM5OTQ1MTY5Nl5BMl5BanBnXkFtZTgwMjM3NzMxODE@._V1_SX300.jpg'),
        (2372162, 'Orange is the New Black', 'The story of Piper Chapman, a woman in her thirties who is sentenced to fifteen months in prison after being convicted of a decade-old crime of transporting money to her drug-dealing girlfriend.', NOW(), 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjMzMjAxNDY5MV5BMl5BanBnXkFtZTgwMzAzNTQxODE@._V1_SX300.jpg'),
        (0903747, 'Breaking Bad', 'A high school chemistry teacher diagnosed with inoperable lung cancer turns to manufacturing and selling methamphetamine in order to secure his family\'s future.', NOW(), 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTQ0ODYzODc0OV5BMl5BanBnXkFtZTgwMDk3OTcyMDE@._V1_SX300.jpg');

INSERT INTO Watching (`user_id`, `tvshow_id`)
VALUES 	(1, 0944947),
        (1, 2372162),
        (1, 0903747),
        (2, 0944947),
        (2, 2372162),
        (2, 0903747),
        (3, 0944947),
        (3, 0903747);
