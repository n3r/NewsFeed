CREATE DATABASE `newsfeed`;

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `news` WRITE;

INSERT INTO `news` (`id`, `title`, `content`, `date_created`, `date_updated`)
VALUES
	(2,'Новость 232','1Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','2014-04-28 01:00:00','2014-04-28 02:24:04'),
	(3,'Тестовая новость','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','2014-04-28 00:00:00','2014-04-28 00:00:00'),
	(5,'Test','Test','2014-04-28 02:12:41','2014-04-28 02:12:41'),
	(7,'TEDSASD','asdsdgqsd ds fedgergh ehnhn','2014-04-28 02:24:13','2014-04-28 02:24:13');

UNLOCK TABLES;