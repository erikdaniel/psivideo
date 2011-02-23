CREATE TABLE IF NOT EXISTS `#__psivideos` (
  `id` int(11) NOT NULL auto_increment,
  `poem_name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `poet_stage_name` varchar(255) NOT NULL,
  `poet_first_name` varchar(50) NOT NULL,
  `poet_last_name` varchar(50) NOT NULL,
  `poet_email` varchar(255) NOT NULL,
  `poet_phone` varchar(50) NOT NULL,
  `bio` text NOT NULL,
  `added_date` datetime NOT NULL,
  `published` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `#__psivideos_votes` (
  `id` int(11) NOT NULL auto_increment,
  `psivideo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vote_date` datetime NOT NULL,
  `ip_address` text NOT NULL,
  PRIMARY KEY  (`id`)
);

