DROP TABLE IF EXISTS `#__toydatabase`;
 
CREATE TABLE `#__toydatabase_membership` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`joomla_userid`       INT(11)     NOT NULL,
	`type` smallint(1) NOT NULL,
	`urn` varchar(255) NOT NULL,
	`name` varchar(255) NOT NULL,
	`companyname` varchar(255) NOT NULL,
	`address1` varchar(255) NOT NULL,
	`address2` varchar(255) NOT NULL,
	`town` varchar(255) NOT NULL,
	`postcode` varchar(255) NOT NULL,
	`telephone` varchar(255) NOT NULL,
	`mobile` varchar(255) NOT NULL,
	`email` varchar(255) NOT NULL,
	`memb_category` smallint(1) NOT NULL,
	`renewaldate` datetime NOT NULL,
	`joindate` datetime NOT NULL,
	`disabilities` blob NOT NULL,
	`children` smallint(1) NOT NULL,
	`active` smallint(1) NOT NULL,
	`creationdate` datetime NOT NULL,
	`adminuser` int(11) NOT NULL,
	`adminnotes` blob NOT NULL,
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

CREATE TABLE `#__toydatabase_membershiptypes` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`type` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;
	
CREATE TABLE `#__toydatabase_membershiplink` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`membershipid` int(11) NOT NULL,
	`membershiptypeid` int(11) NOT NULL,
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

CREATE TABLE `#__toydatabase_equipment_category` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`category` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;
	
CREATE TABLE `#__toydatabase_equipment` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`urn` varchar(255) NOT NULL,
	`name` varchar(255) NOT NULL,
	`picture` varchar(255) NOT NULL,
	`description` blob NOT NULL,
	`storagelocation` varchar(255) NOT NULL,
	`status` smallint(1) NOT NULL,
	`active` smallint(1) NOT NULL,
	`creationdate` datetime NOT NULL,
	`adminuser` int(11) NOT NULL,
	`notes` blob NOT NULL,
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;
	
CREATE TABLE `#__toydatabase_categorylink` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`equipmentid` int(11) NOT NULL,
	`categoryid` int(11) NOT NULL,
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;
	
CREATE TABLE `#__toydatabase_loanlink` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`equipmentid` int(11) NOT NULL,
	`membershipid` int(11) NOT NULL,
	`requestdate` datetime NOT NULL,
	`loandate` datetime NOT NULL,
	`returnbydate` datetime NOT NULL,
	`returndate` datetime NOT NULL,
	`status` smallint(1) NOT NULL,
	`adminuser` int(11) NOT NULL,
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;
CREATE TABLE `#__toydatabase_permissions` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`function` varchar(255) NOT NULL,
	`groupname` varchar(255) NOT NULL,
	`permissions` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;