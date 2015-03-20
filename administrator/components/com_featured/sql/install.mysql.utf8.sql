CREATE TABLE IF NOT EXISTS `#__featured_items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ordering` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` TEXT,
  `msrp` varchar(255) NULL,
  `price` varchar(255) NULL,
  `technology` varchar(255) NULL,
  `interface` varchar(255) NULL,
  `surface_treatment` varchar(255) NULL,
  `monitor_color` varchar(255) NULL,
  `part_number` varchar(255) NULL,
  `availability` varchar(255) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
