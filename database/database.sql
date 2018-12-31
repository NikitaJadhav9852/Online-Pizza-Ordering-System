
CREATE database pizzademo;

USE pizzademo;
 
 
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(1000) NOT NULL,
  `user_password` varchar(1000) NOT NULL,
  `user_firstname` varchar(1000) NOT NULL,
  `user_lastname` varchar(1000) NOT NULL,
  `user_address` varchar(1000) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

CREATE TABLE `admin` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(500) NOT NULL DEFAULT '',
  `admin_password` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


INSERT INTO `admin` (`admin_id`,`admin_username`,`admin_password`) VALUES (1,'admin','admin');

CREATE TABLE `items` (
  `item_id` int(10) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(5000) NOT NULL DEFAULT '',
  `item_price` double DEFAULT NULL,
  `item_image` varchar(5000) NOT NULL DEFAULT '',
  `item_date` date NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

CREATE TABLE `orderdetails` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(10) DEFAULT NULL,
  `order_name` varchar(1000) DEFAULT NULL,
  `order_price` double DEFAULT NULL,
  `order_quantity` int(10) DEFAULT NULL,
  `order_total` double DEFAULT NULL,
  `order_status` varchar(45) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  PRIMARY KEY (`order_id`),
FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
 FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) 
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;
