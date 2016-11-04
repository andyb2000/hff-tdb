DROP TABLE IF EXISTS `#__toydatabase`;
 
CREATE TABLE `#__toydatabase` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`greeting` VARCHAR(25) NOT NULL,
	`published` tinyint(4) NOT NULL,
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;
 
INSERT INTO `#__toydatabase` (`greeting`) VALUES
('Hello Toy Database from DB!'),
('Goodbye toy Database from DB!');