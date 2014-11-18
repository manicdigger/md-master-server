SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
CREATE DATABASE IF NOT EXISTS `manicdigger` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `manicdigger`;

DROP TABLE IF EXISTS `servers`;
CREATE TABLE `servers` (
  `server_id` int(11) NOT NULL,
  `address` varchar(1024) COLLATE utf8_bin NOT NULL,
  `port` smallint(6) NOT NULL,
  `version` varchar(32) COLLATE utf8_bin NOT NULL,
  `name` varchar(1024) COLLATE utf8_bin NOT NULL,
  `private_key` varchar(32) COLLATE utf8_bin NOT NULL,
  `key_hash` varchar(32) COLLATE utf8_bin NOT NULL,
  `max_clients` int(11) NOT NULL,
  `public` tinyint(1) NOT NULL,
  `password_protected` tinyint(1) NOT NULL,
  `allow_guests` tinyint(1) NOT NULL,
  `user_count` int(11) NOT NULL,
  `user_list` varchar(1024) COLLATE utf8_bin NOT NULL,
  `motd` varchar(1024) COLLATE utf8_bin NOT NULL,
  `game_mode` varchar(32) COLLATE utf8_bin NOT NULL,
  `last_heartbeat_date` datetime NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(16) COLLATE utf8_bin NOT NULL,
  `password_hash` varchar(32) COLLATE utf8_bin NOT NULL,
  `email` varchar(32) COLLATE utf8_bin NOT NULL,
  `joined_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `servers`
 ADD PRIMARY KEY (`server_id`);

ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

ALTER TABLE `servers`
MODIFY `server_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
