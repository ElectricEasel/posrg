INSERT IGNORE INTO `#__rsform_config` (`SettingName`, `SettingValue`) VALUES ('crm.url', '');

CREATE TABLE IF NOT EXISTS `#__rsform_crm` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;