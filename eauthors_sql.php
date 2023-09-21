CREATE TABLE `unnuke_authors` (
`uid` int(11) NOT NULL AUTO_INCREMENT,
`aid` varchar(25) NOT NULL DEFAULT '',
`name` varchar(50) DEFAULT NULL,
`url` varchar(255) NOT NULL DEFAULT '',
`email` varchar(255) NOT NULL DEFAULT '',
`pwd` varchar(40) DEFAULT NULL,
`counter` int NOT NULL DEFAULT '0',
`radminsuper` tinyint(1) NOT NULL DEFAULT '1',
`admlanguage` varchar(30) NOT NULL DEFAULT '',
`admincreated` int(11) NOT NULL default '0',
`user_id` int(11) NOT NULL,
PRIMARY KEY (`uid`),
KEY `aid` (`aid`),
KEY `admincreated` (`admincreated`),
KEY `user_id` (`user_id`)
) ENGINE=MyISAM;