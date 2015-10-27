DROP TABLE IF EXISTS `arrowchat`;
DROP TABLE IF EXISTS `arrowchat_admin`;
DROP TABLE IF EXISTS `arrowchat_applications`;
DROP TABLE IF EXISTS `arrowchat_banlist`;
DROP TABLE IF EXISTS `arrowchat_chatroom_banlist`;
DROP TABLE IF EXISTS `arrowchat_chatroom_messages`;
DROP TABLE IF EXISTS `arrowchat_chatroom_rooms`;
DROP TABLE IF EXISTS `arrowchat_chatroom_users`;
DROP TABLE IF EXISTS `arrowchat_config`;
DROP TABLE IF EXISTS `arrowchat_graph_log`;
DROP TABLE IF EXISTS `arrowchat_notifications`;
DROP TABLE IF EXISTS `arrowchat_markup`;
DROP TABLE IF EXISTS `arrowchat_smilies`;
DROP TABLE IF EXISTS `arrowchat_status`;
DROP TABLE IF EXISTS `arrowchat_themes`;
DROP TABLE IF EXISTS `arrowchat_trayicons`;

CREATE TABLE IF NOT EXISTS `arrowchat` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `from` varchar(25) character set utf8 NOT NULL,
  `to` varchar(25) character set utf8 NOT NULL,
  `message` text character set utf8 NOT NULL,
  `sent` int(10) unsigned NOT NULL,
  `read` int(10) unsigned NOT NULL,
  `user_read` tinyint(1) NOT NULL default '0',
  `direction` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `to` (`to`),
  KEY `read` (`read`),
  KEY `user_read` (`user_read`),
  KEY `from` (`from`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `arrowchat_admin` (
  `id` int(3) unsigned NOT NULL auto_increment,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `arrowchat_applications` (
  `id` int(3) unsigned NOT NULL auto_increment,
  `name` varchar(100) character set utf8 collate utf8_bin NOT NULL,
  `folder` varchar(100) character set utf8 collate utf8_bin NOT NULL,
  `icon` varchar(100) character set utf8 collate utf8_bin NOT NULL,
  `width` int(4) unsigned NOT NULL,
  `height` int(4) unsigned NOT NULL,
  `bar_width` int(3) unsigned default NULL,
  `bar_name` varchar(100) default NULL,
  `dont_reload` tinyint(1) unsigned default '0',
  `default_bookmark` tinyint(1) unsigned default '1',
  `show_to_guests` tinyint(1) unsigned default '1',
  `link` varchar(255) default NULL,
  `update_link` varchar(255) default NULL,
  `version` varchar(20) default NULL,
  `active` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `arrowchat_banlist` (
  `ban_id` int(10) unsigned NOT NULL auto_increment,
  `ban_userid` varchar(25) default NULL,
  `ban_ip` varchar(50) default NULL,
  PRIMARY KEY  (`ban_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `arrowchat_chatroom_banlist` (
  `user_id` varchar(25) NOT NULL,
  `chatroom_id` int(10) unsigned NOT NULL,
  `ban_length` int(10) unsigned NOT NULL,
  `ban_time` int(10) unsigned NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `chatroom_id` (`chatroom_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS `arrowchat_chatroom_messages` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `chatroom_id` int(10) unsigned NOT NULL,
  `user_id` varchar(25) NOT NULL,
  `username` varchar(100) collate utf8_bin NOT NULL,
  `message` text collate utf8_bin NOT NULL,
  `global_message` tinyint(1) unsigned default '0',
  `sent` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `chatroom_id` (`chatroom_id`),
  KEY `user_id` (`user_id`),
  KEY `sent` (`sent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=30;

CREATE TABLE IF NOT EXISTS `arrowchat_chatroom_rooms` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `author_id` varchar(25) NOT NULL,
  `name` varchar(100) collate utf8_bin NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `password` varchar(25) collate utf8_bin default NULL,
  `length` int(10) unsigned NOT NULL,
  `session_time` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `session_time` (`session_time`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS `arrowchat_chatroom_users` (
  `user_id` varchar(25) NOT NULL,
  `chatroom_id` int(10) unsigned NOT NULL,
  `is_admin` tinyint(1) unsigned NOT NULL default '0',
  `is_mod` tinyint(1) unsigned NOT NULL default '0',
  `block_chats` tinyint(4) unsigned NOT NULL default '0',
  `session_time` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`user_id`),
  KEY `chatroom_id` (`chatroom_id`),
  KEY `is_admin` (`is_admin`),
  KEY `is_mod` (`is_mod`),
  KEY `session_time` (`session_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS `arrowchat_config` (
  `config_name` varchar(255) character set utf8 collate utf8_bin NOT NULL,
  `config_value` text,
  `is_dynamic` tinyint(1) unsigned NOT NULL default '0',
  UNIQUE KEY `config_name` (`config_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `arrowchat_graph_log` (
  `id` int(6) unsigned NOT NULL auto_increment,
  `date` varchar(30) NOT NULL,
  `user_messages` int(10) unsigned default '0',
  `chat_room_messages` int(10) unsigned default '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `arrowchat_notifications` (
  `id` int(25) unsigned NOT NULL auto_increment,
  `to_id` varchar(25) NOT NULL,
  `author_id` varchar(25) NOT NULL,
  `author_name` varchar(100) NOT NULL,
  `misc1` varchar(255) default NULL,
  `misc2` varchar(255) default NULL,
  `misc3` varchar(255) default NULL,
  `type` int(3) unsigned NOT NULL,
  `alert_read` int(1) unsigned NOT NULL default '0',
  `user_read` int(1) unsigned NOT NULL default '0',
  `alert_time` int(15) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `to_id` (`to_id`),
  KEY `alert_read` (`alert_read`),
  KEY `user_read` (`user_read`),
  KEY `alert_time` (`alert_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `arrowchat_notifications_markup` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `type` int(3) unsigned NOT NULL,
  `markup` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `arrowchat_smilies` (
  `id` int(3) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `code` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `arrowchat_status` (
  `userid` varchar(25) NOT NULL,
  `guest_name` varchar(50) default NULL,
  `message` text,
  `status` varchar(10) default NULL,
  `theme` int(3) unsigned default NULL,
  `popout` int(11) unsigned default NULL,
  `typing` text,
  `hide_bar` tinyint(1) unsigned default NULL,
  `play_sound` tinyint(1) unsigned default '1',
  `window_open` tinyint(1) unsigned default NULL,
  `only_names` tinyint(1) unsigned default NULL,
  `chatroom_window` varchar(2) NOT NULL default '-1',
  `chatroom_stay` varchar(2) NOT NULL default '-1',
  `chatroom_block_chats` tinyint(1) unsigned default NULL,
  `chatroom_sound` tinyint(1) unsigned default NULL,
  `announcement` tinyint(1) unsigned NOT NULL default '1',
  `unfocus_chat` text,
  `focus_chat` varchar(20) default NULL,
  `last_message` text,
  `apps_bookmarks` text,
  `apps_other` text,
  `apps_open` int(10) unsigned default NULL,
  `apps_load` text,
  `block_chats` text,
  `session_time` int(20) unsigned NOT NULL default '0',
  `is_admin` tinyint(1) unsigned NOT NULL default '0',
  `hash_id` varchar(20) NOT NULL default '0',
  PRIMARY KEY  (`userid`),
  KEY `hash_id` (`hash_id`),
  KEY `session_time` (`session_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `arrowchat_themes` (
  `id` int(3) unsigned NOT NULL auto_increment,
  `folder` varchar(25) NOT NULL,
  `name` varchar(100) NOT NULL,
  `active` tinyint(1) unsigned NOT NULL,
  `update_link` varchar(255) default NULL,
  `version` varchar(20) default NULL,
  `default` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `arrowchat_trayicons` (
  `id` int(3) unsigned NOT NULL auto_increment,
  `name` varchar(100) character set utf8 collate utf8_bin NOT NULL,
  `icon` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `target` varchar(25) default NULL,
  `width` int(4) unsigned default NULL,
  `height` int(4) unsigned default NULL,
  `tray_width` int(3) unsigned default NULL,
  `tray_name` varchar(100) character set utf8 collate utf8_bin default NULL,
  `tray_location` int(3) unsigned NOT NULL,
  `active` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;