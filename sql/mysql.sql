
CREATE TABLE `toplist_history` (
  `id` int(11) NOT NULL auto_increment,
  `website_id` int(11) NOT NULL,
  `site_count` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `toplist_log` (
  `id` int(11) NOT NULL auto_increment,
  `website_id` int(11) NOT NULL,
  `user_agent` varchar(100) NOT NULL,
  `user_ip` varchar(30) NOT NULL,
  `user_os` varchar(100) NOT NULL,
  `timestamp` int(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE `toplist_websites` (
`id` int(11) unsigned NOT NULL auto_increment ,
 `user_id` INT( 11 ) NOT NULL ,
 `website_name` VARCHAR( 100 ) NOT NULL ,
 `website_url` VARCHAR( 100 ) NOT NULL ,
 `website_description` TEXT NOT NULL ,
 `website_approve` INT( 1 ) NOT NULL DEFAULT '0',
 PRIMARY KEY ( `id` ) ,
 UNIQUE (`website_url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



 
