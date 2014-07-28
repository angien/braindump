CREATE TABLE `braindumpers` (
 `id` int(11) NOT NULL,
 `course_id` int(11) NOT NULL DEFAULT '0',
 PRIMARY KEY (`id`,`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `courses` (
 `course_id` int(11) NOT NULL AUTO_INCREMENT,
 `title` varchar(255) NOT NULL,
 `description` varchar(2000) NOT NULL,
 `recurring` tinyint(1) NOT NULL,
 PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1

CREATE TABLE `learners` (
 `id` int(11) NOT NULL,
 `course_id` int(11) NOT NULL,
 PRIMARY KEY (`id`,`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `links` (
 `course_id` int(11) NOT NULL,
 `link` varchar(756) NOT NULL,
 PRIMARY KEY (`course_id`,`link`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `tags` (
 `course_id` int(11) NOT NULL,
 `tag` varchar(100) NOT NULL,
 PRIMARY KEY (`course_id`,`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(255) NOT NULL,
 `email` varchar(255) NOT NULL,
 `password` varchar(255) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1

CREATE TABLE `webex` (
 `course_id` int(11) NOT NULL,
 `date` date NOT NULL,
 `time` time NOT NULL,
 `reg_link` varchar(2083) DEFAULT NULL,
 `host_link` varchar(2083) DEFAULT NULL,
 PRIMARY KEY (`course_id`,`date`,`time`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1