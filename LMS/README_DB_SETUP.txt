# If you change anything in the database make sure you update the CREATE TABLE below to reflect the change.  This is necessary
# for a flawless integration with the actual site.


use `library_management_system`;

CREATE TABLE `team8_reg_login_attempt` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `login_success` tinyint(1) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE `team8_reg_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `rank` tinyint(2) unsigned NOT NULL,
  `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `token` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `token_validity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `token` (`token`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE `team8_book_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `publication` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `isbn` varchar(15) NOT NULL,  # do not change this must be a char in order to have the correct format otherwise mySql cannot hold an int this high!
  `issue_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `due_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `returned_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `image_file_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `current_user` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `availability` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

#----------------------------------------------------------------------------------------
# The following will create dummy bookInfo. To add to or take away from 
# the .txt file to your hearts desire.  Obviously needs to be in the format of team8_book_info 
# or it will not import properly.  A Partial load of data is possible.  Reloading again might get
# 'duplicate' error.
#---------------------------------------------------------------------------------------- 

LOAD DATA INFILE 'C:/xampp/htdocs/LMS/LMS/bookInfoData.txt'
INTO TABLE library_management_system.team8_book_info
FIELDS TERMINATED BY '\t'
LINES TERMINATED BY '\n';



 