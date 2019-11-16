
delimiter $$
CREATE database demo;
use demo;

delimiter $$


delimiter $$

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `contact` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  `user_type` varchar(45) DEFAULT NULL,
  `date` datetime NOT NULL,
  `register` int(2),
  PRIMARY KEY (`login_id`),
  UNIQUE KEY `profile_id_UNIQUE` (`login_id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8$$

delimiter $$




