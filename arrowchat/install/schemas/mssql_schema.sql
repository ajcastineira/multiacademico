CREATE TABLE arrowchat (
  id int NOT NULL,
  [from] varchar(25) NOT NULL,
  [to] varchar(25) NOT NULL,
  message text NOT NULL,
  sent int NOT NULL,
  [read] int NOT NULL,
  user_read tinyint NOT NULL default '0',
  direction int NOT NULL default '0',
  PRIMARY KEY  (id),
  --KEY to (to),
  --KEY read (read),
  --KEY user_read (user_read),
  --KEY from (from)
);

CREATE TABLE arrowchat_admin (
  id int NOT NULL,
  username varchar(20) NOT NULL,
  password varchar(50) NOT NULL,
  email varchar(50) NOT NULL,
  PRIMARY KEY  (id)
);

CREATE TABLE arrowchat_applications (
  id int NOT NULL,
  name varchar(100) NOT NULL,
  folder varchar(100) NOT NULL,
  icon varchar(100) NOT NULL,
  width int NOT NULL,
  height int NOT NULL,
  bar_width int default NULL,
  bar_name varchar(100) default NULL,
  dont_reload tinyint default '0',
  default_bookmark tinyint default '1',
  show_to_guests tinyint default '1',
  link varchar(255) default NULL,
  update_link varchar(255) default NULL,
  version varchar(20) default NULL,
  active tinyint NOT NULL default '1',
  PRIMARY KEY  (id)
);

CREATE TABLE arrowchat_banlist (
  ban_id int NOT NULL,
  ban_userid varchar(25) default NULL,
  ban_ip varchar(50) default NULL,
  PRIMARY KEY  (ban_id)
);

CREATE TABLE arrowchat_chatroom_banlist (
  user_id varchar(25) NOT NULL,
  chatroom_id int NOT NULL,
  ban_length int NOT NULL,
  ban_time int NOT NULL,
  PRIMARY KEY  (user_id),
  --KEY chatroom_id (chatroom_id)
);

CREATE TABLE arrowchat_chatroom_messages (
  id int NOT NULL,
  chatroom_id int NOT NULL,
  user_id varchar(25) NOT NULL,
  username varchar(100) NOT NULL,
  message text NOT NULL,
  global_message tinyint default '0',
  sent int NOT NULL,
  PRIMARY KEY  (id),
  --KEY chatroom_id (chatroom_id),
  --KEY user_id (user_id),
  --KEY sent (sent)
);

CREATE TABLE arrowchat_chatroom_rooms (
  id int NOT NULL,
  author_id varchar(25) NOT NULL,
  name varchar(100) NOT NULL,
  type tinyint NOT NULL,
  password varchar(25) default NULL,
  length int NOT NULL,
  session_time int NOT NULL,
  PRIMARY KEY  (id),
  --KEY session_time (session_time),
  --KEY author_id (author_id)
);

CREATE TABLE arrowchat_chatroom_users (
  user_id varchar(25) NOT NULL,
  chatroom_id int NOT NULL,
  is_admin tinyint NOT NULL default '0',
  is_mod tinyint NOT NULL default '0',
  block_chats tinyint NOT NULL default '0',
  session_time int NOT NULL,
  PRIMARY KEY  (user_id),
  --KEY chatroom_id (chatroom_id),
  --KEY is_admin (is_admin),
  --KEY is_mod (is_mod),
  --KEY session_time (session_time)
);

CREATE TABLE arrowchat_config (
  config_name varchar(255) NOT NULL,
  config_value text,
  is_dynamic tinyint NOT NULL default '0',
  --UNIQUE KEY config_name (config_name)
);

CREATE TABLE arrowchat_graph_log (
  id int NOT NULL,
  date varchar(30) NOT NULL,
  user_messages int default '0',
  chat_room_messages int default '0',
  PRIMARY KEY (id),
  --UNIQUE KEY date (date)
);

CREATE TABLE arrowchat_notifications (
  id int NOT NULL,
  to_id varchar(25) NOT NULL,
  author_id varchar(25) NOT NULL,
  author_name char(100) NOT NULL,
  misc1 varchar(255) default NULL,
  misc2 varchar(255) default NULL,
  misc3 varchar(255) default NULL,
  type int NOT NULL,
  alert_read int NOT NULL default '0',
  user_read int NOT NULL default '0',
  alert_time int NOT NULL,
  PRIMARY KEY  (id),
  --KEY to_id (to_id),
  --KEY alert_read (alert_read),
  --KEY user_read (user_read),
  --KEY alert_time (alert_time)
);

CREATE TABLE arrowchat_notifications_markup (
  id int NOT NULL,
  name varchar(50) NOT NULL,
  type int NOT NULL,
  markup text NOT NULL,
  PRIMARY KEY  (id)
);

CREATE TABLE arrowchat_smilies (
  id int NOT NULL,
  name varchar(20) NOT NULL,
  code varchar(10) NOT NULL,
  PRIMARY KEY  (id)
);

CREATE TABLE arrowchat_status (
  userid varchar(25) NOT NULL,
  guest_name varchar(50) default NULL,
  message text,
  status varchar(10) default NULL,
  theme int default NULL,
  popout int default NULL,
  typing text,
  hide_bar tinyint default NULL,
  play_sound tinyint default '1',
  window_open tinyint default NULL,
  only_names tinyint default NULL,
  chatroom_window varchar(2) NOT NULL default '-1',
  chatroom_stay varchar(2) NOT NULL default '-1',
  chatroom_block_chats tinyint default NULL,
  announcement tinyint NOT NULL default '1',
  unfocus_chat text,
  focus_chat varchar(20) default NULL,
  last_message text,
  apps_bookmarks text,
  apps_other text,
  apps_open int default NULL,
  apps_load text,
  block_chats text,
  session_time int NOT NULL,
  is_admin tinyint NOT NULL default '0',
  hash_id varchar(20) NOT NULL,
  PRIMARY KEY  (userid),
  --KEY hash_id (hash_id),
  --KEY session_time (session_time)
);

CREATE TABLE arrowchat_themes (
  id int NOT NULL,
  folder varchar(25) NOT NULL,
  name varchar(100) NOT NULL,
  active tinyint NOT NULL,
  update_link varchar(255) default NULL,
  version varchar(20) default NULL,
  [default] tinyint NOT NULL,
  PRIMARY KEY  (id)
);

CREATE TABLE arrowchat_trayicons (
  id int NOT NULL,
  name varchar(100) NOT NULL,
  icon varchar(100) NOT NULL,
  location varchar(255) NOT NULL,
  target varchar(25) default NULL,
  width int default NULL,
  height int default NULL,
  tray_width int default NULL,
  tray_name varchar(100) default NULL,
  tray_location int NOT NULL,
  active tinyint NOT NULL default '1',
  PRIMARY KEY  (id)
);
