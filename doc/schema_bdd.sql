-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'Users'
-- 
-- ---

DROP TABLE IF EXISTS `Users`;
		
CREATE TABLE `Users` (
  `id_user` INTEGER(10) NULL AUTO_INCREMENT DEFAULT NULL,
  `id_group` INTEGER(10) NULL DEFAULT NULL,
  `id_profil` INTEGER(10) NULL DEFAULT NULL,
  `id_country` INTEGER NULL DEFAULT NULL,
  `firstname` VARCHAR(100) NULL DEFAULT NULL,
  `lastname` VARCHAR(100) NULL DEFAULT NULL,
  `email` VARCHAR(50) NULL DEFAULT NULL,
  `Pseudo` VARCHAR(50) NULL DEFAULT NULL,
  `slug` VARCHAR(50) NULL DEFAULT NULL,
  `salt` VARCHAR(50) NULL DEFAULT NULL,
  `password` VARCHAR(100) NULL DEFAULT NULL,
  `biography` MEDIUMTEXT NULL DEFAULT NULL,
  `date_add` DATETIME NULL DEFAULT NULL,
  `date_up` INTEGER NULL DEFAULT NULL,
  `date_lastconnect` DATETIME NULL DEFAULT NULL,
  `status` TINYINT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`)
);

-- ---
-- Table 'Video'
-- 
-- ---

DROP TABLE IF EXISTS `Video`;
		
CREATE TABLE `Video` (
  `id_video` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `id_user` INTEGER NULL DEFAULT NULL,
  `id_country` INTEGER(10) NULL DEFAULT NULL,
  `id_origin` INTEGER(10) NULL DEFAULT NULL,
  `id_image` INTEGER(10) NULL DEFAULT NULL,
  `player_key` VARCHAR(100) NULL DEFAULT NULL,
  `title` VARCHAR(100) NULL DEFAULT NULL,
  `description` MEDIUMTEXT NULL DEFAULT NULL,
  `slug` VARCHAR(50) NULL DEFAULT NULL,
  `date_add` DATETIME NULL DEFAULT NULL,
  `date_up` DATETIME NULL DEFAULT NULL,
  `status` TINYINT(1) NULL DEFAULT NULL,
  `signaled` INTEGER(1) NULL DEFAULT NULL,
  `deleted` TINYINT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id_video`)
);

-- ---
-- Table 'Comments'
-- 
-- ---

DROP TABLE IF EXISTS `Comments`;
		
CREATE TABLE `Comments` (
  `id_comment` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `id_user` INTEGER(10) NULL DEFAULT NULL,
  `id_video` INTEGER(10) NULL DEFAULT NULL,
  `id_parent` INTEGER(10) NULL DEFAULT 0,
  `content` MEDIUMTEXT NULL DEFAULT NULL,
  `status` TINYINT(1) NULL DEFAULT NULL,
  `date_add` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id_comment`)
);

-- ---
-- Table 'Image'
-- 
-- ---

DROP TABLE IF EXISTS `Image`;
		
CREATE TABLE `Image` (
  `id_image` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `path` VARCHAR(255) NULL DEFAULT NULL,
  `title` VARCHAR NULL DEFAULT NULL,
  PRIMARY KEY (`id_image`)
);

-- ---
-- Table 'Country'
-- 
-- ---

DROP TABLE IF EXISTS `Country`;
		
CREATE TABLE `Country` (
  `id_country` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `iso_code` VARCHAR(10) NULL DEFAULT NULL,
  `name` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`id_country`)
);

-- ---
-- Table 'Category'
-- 
-- ---

DROP TABLE IF EXISTS `Category`;
		
CREATE TABLE `Category` (
  `id_category` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `id_image` INTEGER(10) NULL DEFAULT NULL,
  `name` VARCHAR(100) NULL DEFAULT NULL,
  `description` MEDIUMTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id_category`)
);

-- ---
-- Table 'Playlist'
-- 
-- ---

DROP TABLE IF EXISTS `Playlist`;
		
CREATE TABLE `Playlist` (
  `id_playlist` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `id_user` INTEGER(10) NULL DEFAULT NULL,
  `name` INTEGER NULL DEFAULT NULL,
  PRIMARY KEY (`id_playlist`)
);

-- ---
-- Table 'Playlist_videos'
-- 
-- ---

DROP TABLE IF EXISTS `Playlist_videos`;
		
CREATE TABLE `Playlist_videos` (
  `id_playlist` INTEGER(10) NULL AUTO_INCREMENT DEFAULT NULL,
  `id_video` INTEGER(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id_playlist`, `id_video`)
);

-- ---
-- Table 'Category_video'
-- 
-- ---

DROP TABLE IF EXISTS `Category_video`;
		
CREATE TABLE `Category_video` (
  `id_category` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `id_video` INTEGER(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id_category`, `id_video`)
);

-- ---
-- Table 'Followers'
-- 
-- ---

DROP TABLE IF EXISTS `Followers`;
		
CREATE TABLE `Followers` (
  `id_artist` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `id_user` INTEGER NULL DEFAULT NULL,
  `date_add` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id_artist`, `id_user`)
);

-- ---
-- Table 'Likes'
-- 
-- ---

DROP TABLE IF EXISTS `Likes`;
		
CREATE TABLE `Likes` (
  `id_video` INTEGER NULL DEFAULT NULL,
  `id_user` INTEGER NULL DEFAULT NULL,
  `date_add` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id_video`, `id_user`)
);

-- ---
-- Table 'Group'
-- User''s group
-- ---

DROP TABLE IF EXISTS `Group`;
		
CREATE TABLE `Group` (
  `id_group` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `name` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`id_group`)
) COMMENT 'User''s group';

-- ---
-- Table 'Origin'
-- 
-- ---

DROP TABLE IF EXISTS `Origin`;
		
CREATE TABLE `Origin` (
  `id_origin` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `name` VARCHAR(50) NULL DEFAULT NULL,
  `WSaccount` VARCHAR(100) NULL DEFAULT NULL,
  `WSkey` INTEGER(100) NULL DEFAULT NULL,
  PRIMARY KEY (`id_origin`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `Users` ADD FOREIGN KEY (id_user) REFERENCES `Followers` (`id_artist`);
ALTER TABLE `Users` ADD FOREIGN KEY (id_user) REFERENCES `Followers` (`id_user`);
ALTER TABLE `Users` ADD FOREIGN KEY (id_group) REFERENCES `Group` (`id_group`);
ALTER TABLE `Users` ADD FOREIGN KEY (id_profil) REFERENCES `Image` (`id_image`);
ALTER TABLE `Users` ADD FOREIGN KEY (id_country) REFERENCES `Country` (`id_country`);
ALTER TABLE `Video` ADD FOREIGN KEY (id_video) REFERENCES `Playlist_videos` (`id_video`);
ALTER TABLE `Video` ADD FOREIGN KEY (id_user) REFERENCES `Users` (`id_user`);
ALTER TABLE `Video` ADD FOREIGN KEY (id_country) REFERENCES `Country` (`id_country`);
ALTER TABLE `Video` ADD FOREIGN KEY (id_origin) REFERENCES `Origin` (`id_origin`);
ALTER TABLE `Video` ADD FOREIGN KEY (id_image) REFERENCES `Image` (`id_image`);
ALTER TABLE `Comments` ADD FOREIGN KEY (id_user) REFERENCES `Users` (`id_user`);
ALTER TABLE `Comments` ADD FOREIGN KEY (id_video) REFERENCES `Video` (`id_video`);
ALTER TABLE `Comments` ADD FOREIGN KEY (id_parent) REFERENCES `Comments` (`id_comment`);
ALTER TABLE `Category` ADD FOREIGN KEY (id_category) REFERENCES `Category_video` (`id_category`);
ALTER TABLE `Category` ADD FOREIGN KEY (id_image) REFERENCES `Image` (`id_image`);
ALTER TABLE `Playlist` ADD FOREIGN KEY (id_playlist) REFERENCES `Playlist_videos` (`id_playlist`);
ALTER TABLE `Playlist` ADD FOREIGN KEY (id_user) REFERENCES `Users` (`id_user`);
ALTER TABLE `Category_video` ADD FOREIGN KEY (id_video) REFERENCES `Video` (`id_video`);
ALTER TABLE `Likes` ADD FOREIGN KEY (id_video) REFERENCES `Video` (`id_video`);
ALTER TABLE `Likes` ADD FOREIGN KEY (id_user) REFERENCES `Users` (`id_user`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `Users` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Video` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Comments` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Image` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Country` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Category` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Playlist` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Playlist_videos` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Category_video` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Followers` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Likes` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Group` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Origin` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `Users` (`id_user`,`id_group`,`id_profil`,`id_country`,`firstname`,`lastname`,`email`,`Pseudo`,`slug`,`salt`,`password`,`biography`,`date_add`,`date_up`,`date_lastconnect`,`status`) VALUES
-- ('','','','','','','','','','','','','','','','');
-- INSERT INTO `Video` (`id_video`,`id_user`,`id_country`,`id_origin`,`id_image`,`player_key`,`title`,`description`,`slug`,`date_add`,`date_up`,`status`,`signaled`,`deleted`) VALUES
-- ('','','','','','','','','','','','','','');
-- INSERT INTO `Comments` (`id_comment`,`id_user`,`id_video`,`id_parent`,`content`,`status`,`date_add`) VALUES
-- ('','','','','','','');
-- INSERT INTO `Image` (`id_image`,`path`,`title`) VALUES
-- ('','','');
-- INSERT INTO `Country` (`id_country`,`iso_code`,`name`) VALUES
-- ('','','');
-- INSERT INTO `Category` (`id_category`,`id_image`,`name`,`description`) VALUES
-- ('','','','');
-- INSERT INTO `Playlist` (`id_playlist`,`id_user`,`name`) VALUES
-- ('','','');
-- INSERT INTO `Playlist_videos` (`id_playlist`,`id_video`) VALUES
-- ('','');
-- INSERT INTO `Category_video` (`id_category`,`id_video`) VALUES
-- ('','');
-- INSERT INTO `Followers` (`id_artist`,`id_user`,`date_add`) VALUES
-- ('','','');
-- INSERT INTO `Likes` (`id_video`,`id_user`,`date_add`) VALUES
-- ('','','');
-- INSERT INTO `Group` (`id_group`,`name`) VALUES
-- ('','');
-- INSERT INTO `Origin` (`id_origin`,`name`,`WSaccount`,`WSkey`) VALUES
-- ('','','','');
