-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 17 Mars 2016 à 00:38
-- Version du serveur: 5.5.47-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `mvondo`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_64C19C1989D9B62` (`slug`),
  UNIQUE KEY `UNIQ_64C19C13DA5256D` (`image_id`),
  KEY `IDX_64C19C1727ACA70` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `image_id`, `name`, `description`, `parent_id`, `slug`) VALUES
(9, 24, 'Music', 'All about music', NULL, 'music'),
(10, 25, 'Comedy', 'All about comedy', NULL, 'comedy'),
(12, 26, 'Rnb', 'Rnb US', 9, 'rnb-1'),
(13, 27, 'Ndombolo', 'africa', 9, 'ndombolo');

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso_code` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `country`
--

INSERT INTO `country` (`id`, `iso_code`, `name`) VALUES
(1, 'cm', 'Cameroon'),
(2, 'fr', 'France');

-- --------------------------------------------------------

--
-- Structure de la table `followers`
--

CREATE TABLE IF NOT EXISTS `followers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fan_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8408FDA789C48F0B` (`fan_id`),
  KEY `IDX_8408FDA7B7970CF8` (`artist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`id`, `path`, `title`) VALUES
(1, 'profil_dread.jpg', 'profil_dread.jpg'),
(2, 'profil_dread.jpg', 'profil_dread.jpg'),
(3, 'IMG_20150516_062745.jpg', 'IMG_20150516_062745.jpg'),
(4, 'logo.png', 'logo.png'),
(5, 'Untitled.png', 'Untitled.png'),
(6, 'bdd.png', 'bdd.png'),
(7, 'bdd.png', 'bdd.png'),
(8, 'bdd.png', 'bdd.png'),
(9, 'IMG_20150516_062745.jpg', 'IMG_20150516_062745.jpg'),
(10, 'jpeg', 'profil_dread2.jpg'),
(11, 'png', 'bdd.png'),
(12, 'jpeg', 'profil_dread.jpg'),
(13, 'jpeg', 'profil_dread.jpg'),
(14, 'png', 'logo.png'),
(15, 'png', 'logo.png'),
(16, 'jpeg', 'IMG_20150516_062745.jpg'),
(17, 'jpeg', 'profil_dread.jpg'),
(20, 'png', 'logo.png'),
(21, 'png', 'bdd.png'),
(22, 'png', 'sasuke.png'),
(23, 'jpeg', 'IMG_20150516_062745.jpg'),
(24, 'png', 'logo.png'),
(25, 'png', 'Rastaman_con humo.png'),
(26, 'png', 'logo.png'),
(27, 'jpeg', 'profil.jpg'),
(29, 'png', 'logo.png'),
(30, 'png', 'logo.png'),
(31, 'jpeg', 'profil.jpg'),
(32, 'jpeg', 'IMG_20150516_062745.jpg'),
(33, 'jpeg', '11227767_10206510156849922_2756025695831308086_n.jpg'),
(34, 'png', 'Rastaman_con humo.png');

-- --------------------------------------------------------

--
-- Structure de la table `mvondo_group`
--

CREATE TABLE IF NOT EXISTS `mvondo_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1097AD455E237E06` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `mvondo_group`
--

INSERT INTO `mvondo_group` (`id`, `name`, `roles`) VALUES
(1, 'Standart', 'a:1:{i:0;s:9:"ROLE_USER";}'),
(2, 'Artist', 'a:1:{i:0;s:11:"ROLE_ARTIST";}'),
(3, 'Admin', 'a:1:{i:0;s:10:"ROLE_ADMIN";}');

-- --------------------------------------------------------

--
-- Structure de la table `mvondo_users`
--

CREATE TABLE IF NOT EXISTS `mvondo_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `profil_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biography` longtext COLLATE utf8_unicode_ci,
  `date_add` datetime NOT NULL,
  `date_up` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_69D44C6992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_69D44C69A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_69D44C69275ED078` (`profil_id`),
  KEY `IDX_69D44C69FE54D947` (`group_id`),
  KEY `IDX_69D44C69F92F3E70` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `mvondo_users`
--

INSERT INTO `mvondo_users` (`id`, `group_id`, `profil_id`, `country_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `firstname`, `lastname`, `biography`, `date_add`, `date_up`) VALUES
(1, 3, 23, 2, 'admin', 'admin', 'kenzo.nono@yahoo.fr', 'kenzo.nono@yahoo.fr', 1, '6nxegicapu4oocg8kk804gsowo8s8kc', 'dK9f4CeD+5I+Pwfv/dxaP42SXifHKh2tGg+pL0HS8KKamZJVYXMKgZybfe413OJLANJP9c4ftBzgYthfZKx38Q==', '2016-03-06 18:08:05', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL, 'Rodrigue', 'FUOSSEU', 'admin', '2015-09-09 21:46:15', '2016-03-06 18:08:05'),
(2, 2, 31, 2, 'artist', 'artist', 'fnfrodrigue@gmail.com', 'fnfrodrigue@gmail.com', 1, 'diabrjsicgg80kggkogokc8888oswwg', 'SwCgAjQPmwQwItf/T6Qd8yVfrLM5smvIWevMuBq5P+oODtyjBL+5m/2GR0y/vQXZ9AM7VT1Oz0Bwxr8okxusTg==', '2016-03-06 18:31:42', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:11:"ROLE_ARTIST";}', 0, NULL, 'Rodrigue', 'FUOSSEU', '-', '2015-09-10 18:40:41', '2016-03-06 18:31:42'),
(3, 1, 32, 2, 'user', 'user', 'kenzo_renoi@yahoo.fr', 'kenzo_renoi@yahoo.fr', 1, 'tw18sr051sgcs0s0wwwo00kgcoscw4k', 'N6Vf/IqganTlVWg02HZ3ML7tQrmiQ8AqGxG5eAnOFTsNadQOKxYPgQ2eBl4MTY+Ddbzz1t2Z5UKsrzDir4oZUw==', '2015-10-04 17:07:24', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Rodrigue', 'FUOSSEU', '-', '2015-09-10 18:43:27', '2015-10-04 17:07:24'),
(4, 3, NULL, 2, 'Drigo', 'drigo', 'fnfrodrigue@hotmail.fr', 'fnfrodrigue@hotmail.fr', 1, 'hpcboxqhcug4w00kwo0w0gw84cww4ko', '99GmFNeRj/V/aDvEp1osr9AFHLnRYKJSk3NBxBgFCDVbV4JMoyLoSRVevOVW9RZcWUHM9YDi1xBCANAl8t2PkQ==', '2015-09-23 22:22:20', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL, 'nono', 'fritz', NULL, '2015-09-23 22:22:19', '2015-09-23 22:22:20'),
(5, 2, 34, 2, 'fabien', 'fabien', 'ffsf@sdsdds.ff', 'ffsf@sdsdds.ff', 1, 'mh7c5r3aqzkgsso40ow40k4kc84k0gw', 'enE7s2mq7u2vuLsLkfTmouQ4hr/VcQS/POgSuoBvJZgkBX21yzhtxge9bzVPBFyL3L9aIIb6ZLrJbNBY9AnekA==', '2015-10-04 17:11:04', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:11:"ROLE_ARTIST";}', 0, NULL, 'toto', 'totot', 'ffdd', '2015-10-04 17:11:04', '2015-10-04 17:15:56');

-- --------------------------------------------------------

--
-- Structure de la table `origin`
--

CREATE TABLE IF NOT EXISTS `origin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `WSaccount` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `WSkey` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `origin`
--

INSERT INTO `origin` (`id`, `name`, `WSaccount`, `WSkey`) VALUES
(1, 'YouTube', 'Mvondo', 'mdp');

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `origin_id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `player_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_add` datetime NOT NULL,
  `date_up` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `signaled` tinyint(1) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `duration` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_7CC7DA2C989D9B62` (`slug`),
  KEY `IDX_7CC7DA2C56A273CC` (`origin_id`),
  KEY `IDX_7CC7DA2CF92F3E70` (`country_id`),
  KEY `IDX_7CC7DA2CA76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Contenu de la table `video`
--

INSERT INTO `video` (`id`, `origin_id`, `country_id`, `title`, `description`, `player_key`, `date_add`, `date_up`, `status`, `signaled`, `deleted`, `slug`, `user_id`, `duration`, `image`) VALUES
(1, 1, 1, 'Samo - Doy un Paso Atrás', '"Descarga “Inevitable” aquí: http://smarturl.it/samoinevitable?IQid=vevo\r\n\r\nMusic video by Samo performing Doy Un Paso Atrás. (C) 2013 Sony Music Entertainment México, S.A. de C.V. \r\n"', 'kWw20D_1hJA', '2015-09-26 18:47:17', '2015-09-26 19:10:03', 1, 0, 0, 'samo-doy-un-paso-atras', 1, 'PT4M27S', 'https://i.ytimg.com/vi/kWw20D_1hJA/hqdefault.jpg'),
(2, 1, NULL, 'Pitbull - Como Yo Le Doy ft. Don Miguelo', 'Download on iTunes: http://smarturl.it/comoyoledoy\n\nComo Yo Le Doy is apart of Pitbull''s new spanish album, DALE.  \n\nGet DALE on @applemusic: http://smarturl.it/pitbulldale\nGet DALE available on @amazonmusic http://smarturl.it/DaleAMZ  \nGet #DALE now on @GooglePlay: http://smarturl.it/DaleGP', 'zCB8Z_fO2Yo', '2015-09-26 18:52:59', '2015-09-26 18:52:59', 1, 0, 0, 'pitbull-como-yo-le-doy-ft-don-miguelo', 1, 'PT4M17S', 'https://i.ytimg.com/vi/zCB8Z_fO2Yo/hqdefault.jpg'),
(3, 1, NULL, 'Pitbull - Como Yo Le Doy (Lyric Video) ft. Don Miguelo', 'Pitbull ft. Don Miguelo - Como Yo Le Doy (Lyric Video)\n\nBuy it iTunes: http://www.smarturl.it/l5qj02', 'OAYw6tYc0y4', '2015-09-26 18:53:03', '2015-09-26 18:53:03', 1, 0, 0, 'pitbull-como-yo-le-doy-lyric-video-ft-don-miguelo', 1, 'PT4M24S', 'https://i.ytimg.com/vi/OAYw6tYc0y4/hqdefault.jpg'),
(4, 1, NULL, 'Yo les doy un año - peliculas completas en español latino de comedia romantica y drama HD', 'Yo les doy un año - peliculas completas en español latino de comedia romantica y drama  nuevas mejor HD\n\nEsta pelicula gira en torno a la lucha de una joven pareja por sobrevivir a su primer año de matrimonio y todos los problemas que ello conlleva ése primer año juntos.', 'DT5yseLspcA', '2015-09-26 18:53:12', '2015-09-26 18:53:12', 1, 0, 0, 'yo-les-doy-un-ano-peliculas-completas-en-espanol-latino-de-comedia-romantica-y-drama-hd', 1, 'PT1H52M29S', 'https://i.ytimg.com/vi/DT5yseLspcA/hqdefault.jpg'),
(5, 1, NULL, 'TE DOY MI ALMA, Carl Jung, Soul Keeper (subtitulos en español)', 'Pelicula de Hechos reales de la vida de Carl Jung con Una Paciente especial Rusa Sabina Que no solo de sí Curo Sino Que se convirtio En Una de las Mejores Terapeutas, Creando Nuevos metodos. Era judia y Una artista genial. \nLas Mujeres Dieron a Jung Toda la maestria y necesidad de CONOCER el inconsciente. Sabina siendo Desconocida EXCEPTO por El diario Que escribio a Jung, FUE Una de las Grandes Influencias del en su vida. \nMas videos de baño www.fundacion-soliris.eu/worldtv.htm', 'RDYoPVM2jI0', '2015-09-26 18:53:16', '2015-09-26 18:53:16', 1, 0, 0, 'te-doy-mi-alma-carl-jung-soul-keeper-subtitulos-en-espanol', 1, 'PT1H28M52S', 'https://i.ytimg.com/vi/RDYoPVM2jI0/hqdefault.jpg'),
(6, 1, NULL, 'COMO YO LE DOY -  DJ COBRA', 'FACEBOOK\nhttps://www.facebook.com/djcobramonterrey\n\nDescarga App android \nhttps://play.google.com/store/apps/details?id=com.teamcobra.teamcobra\n\nDescarga App Apple\nhttps://itunes.apple.com/mx/app/team-cobra/id988338184?mt=8&ign-mpt=uo%3D2', '2yHgH4d_JlY', '2015-09-26 18:53:20', '2015-09-26 18:53:20', 1, 0, 0, 'como-yo-le-doy-dj-cobra', 1, 'PT2M37S', 'https://i.ytimg.com/vi/2yHgH4d_JlY/hqdefault.jpg'),
(7, 1, NULL, 'COMO YO LE DOY - DON MIGUELO - THINCHO DJ FLOWREMIX', 'COMO YO LE DOY - DON MIGUELO - THINCHO DJ FLOWREMIX\nLINK DE DESCARGA : http://www.mediafire.com/download/y0324u4qjvbo4c0/COMO-YO-LE-DOY-MARLEY-FLOWREMIX-.mp3.mp3', 'iNQYjOWOvw8', '2015-09-26 18:53:24', '2015-09-26 18:53:24', 1, 0, 0, 'como-yo-le-doy-don-miguelo-thincho-dj-flowremix', 1, 'PT3M20S', 'https://i.ytimg.com/vi/iNQYjOWOvw8/hqdefault.jpg'),
(8, 1, NULL, 'Luis Fonsi - No Me Doy Por Vencido', 'Music video by Luis Fonsi performing No Me Doy Por Vencido. YouTube view counts pre-VEVO: 14,079,720. (C) 2008 Universal Music Latino', '8hRGBcr_gJc', '2015-09-26 18:53:28', '2015-09-26 18:53:28', 1, 0, 0, 'luis-fonsi-no-me-doy-por-vencido', 1, 'PT3M56S', 'https://i.ytimg.com/vi/8hRGBcr_gJc/hqdefault.jpg'),
(9, 1, NULL, 'PSquare - Collabo [Official Video] ft. Don Jazzy', 'P-Square finally release the long awaited video to arguably the biggest song off their recent album, "Collabo". Nothing short of an archetypical P-Square video, the flick which also features Don Jazzy, is a classy pictorial with a brief comic storyline about it. Shot in SA on different beautiful and crisp scenes, the Clarence Peters / Jude Okoye directed video is nothing but top notch.\nBuy "Collabo" on iTunes:- https://itunes.apple.com/us/album/collabo-feat.-don-jazzy/id918185976?ls=1\nListen to Collabo on the Afrobeats Top of the Charts Naija Spotify Playlist: https://play.spotify.com/user/freemedigital/playlist/1tHMaPEkO45Slt7PysoZtx\nCurated by http://www.freemedigital.com', 'tUvF7yj531A', '2015-10-04 16:58:30', '2015-10-04 16:58:30', 1, 0, 0, 'psquare-collabo-official-video-ft-don-jazzy', 1, 'PT4M2S', 'https://i.ytimg.com/vi/tUvF7yj531A/hqdefault.jpg'),
(10, 1, NULL, 'PSquare - Shekini [Official Video]', 'Africa’s biggest singing duo come through with the second video to one of the singles off their recently released 6th studio album, “Double Trouble”. “Shekini” video is an energetic pictorial which sees the artistes combine with youthful dancers to perform moves that’d bring you to life. From garages to underground scenes, the dark-themed flick definitely does justice to the song. Video was directed by Clarence Peters, and song produced by Vtek, who also made a cameo appearance\nBUY on iTunes:- https://itunes.apple.com/us/album/shekini-single/id914450637?ls=1\nListen to Shekini on the Afrobeats Top of the Charts Naija Spotify Playlist: https://play.spotify.com/user/freemedigital/playlist/1tHMaPEkO45Slt7PysoZtx\nCurated by www.freemedigital.com', 'aCcuzqRRTHQ', '2015-10-04 16:58:48', '2015-10-04 16:58:48', 1, 0, 0, 'psquare-shekini-official-video', 1, 'PT3M45S', 'https://i.ytimg.com/vi/aCcuzqRRTHQ/hqdefault.jpg'),
(11, 1, NULL, 'PSquare - Shekini [Official Video]', 'Africa’s biggest singing duo come through with the second video to one of the singles off their recently released 6th studio album, “Double Trouble”. “Shekini” video is an energetic pictorial which sees the artistes combine with youthful dancers to perform moves that’d bring you to life. From garages to underground scenes, the dark-themed flick definitely does justice to the song. Video was directed by Clarence Peters, and song produced by Vtek, who also made a cameo appearance\nBUY on iTunes:- https://itunes.apple.com/us/album/shekini-single/id914450637?ls=1\nListen to Shekini on the Afrobeats Top of the Charts Naija Spotify Playlist: https://play.spotify.com/user/freemedigital/playlist/1tHMaPEkO45Slt7PysoZtx\nCurated by www.freemedigital.com', 'aCcuzqRRTHQ', '2015-10-04 16:58:49', '2015-10-04 16:58:49', 1, 0, 0, 'psquare-shekini-official-video-1', 1, 'PT3M45S', 'https://i.ytimg.com/vi/aCcuzqRRTHQ/hqdefault.jpg'),
(12, 1, 1, 'P-Square - Personally', 'You can order ''Personally'' now on iTunes: http://georiot.co/1KaX\r\n\r\n"We dedicate this video to our mentor; the legendary King Of Pop\r\nThe late Michael Jackson, who still inspires us ''Personally''." -  P-Square\r\n\r\nMusic video by P-Square performing Personally. (C) 2013 Square Records.', 'ttdU19Kwce8', '2015-10-04 16:58:54', '2015-10-04 17:04:57', 1, 0, 0, 'p-square-personally', 1, 'PT3M17S', 'https://i.ytimg.com/vi/ttdU19Kwce8/hqdefault.jpg'),
(13, 1, NULL, 'PSquare - Bring it On [Official Video] ft. Dave Scott', 'Multiple Award Winners "PSquare" drops this inspirational single "Bring it On". Africa''s biggest duo, teams up with "Dave Scott" for this single off their "Double Trouble" album.The song which infuses R''n''B into cool rock talks about the phases,trials and struggles of life that one goes through before reaching the top and being a winner. \nDirected by talented Jude ''Engees'' Okoye and creative Clarence Peters, the video was shot in the beautiful city of Atlanta and also in South Africa and features beautiful beach side scenery.\nBuy on iTunes: https://itunes.apple.com/us/album/bring-it-on-feat.-dave-scott/id914460866?ls=1\nCurated by http://www.freemedigital.com\nhttp://www.vevo.com/watch/UK3AZ1512359', 'gUxptvq-Gjw', '2015-10-04 16:59:01', '2015-10-04 16:59:01', 1, 0, 0, 'psquare-bring-it-on-official-video-ft-dave-scott', 1, 'PT4M3S', 'https://i.ytimg.com/vi/gUxptvq-Gjw/hqdefault.jpg'),
(14, 1, NULL, 'Fingon Tralala - L''argent a toujours raison - Partie 1 - Comédie camerounaise (FTR)', 'Fingon Tralala', 'm-XtR7baNls', '2015-10-18 17:05:30', '2015-10-18 17:05:30', 1, 0, 0, 'fingon-tralala-l-argent-a-toujours-raison-partie-1-comedie-camerounaise-ftr', 1, 'PT49M31S', 'https://i.ytimg.com/vi/m-XtR7baNls/hqdefault.jpg'),
(15, 1, NULL, 'Sitcom Camerounais - Fingon le modeliste (FTR)', 'Besoin du DVD de n''importe quel film camerounais ? écrivez à distribution.paka@gmail.com et précisez le film dont vous avez besoin\n\nPar le réalisateur Fingon Tralala\n\nSynopsis', 'vVlmh_QHiQc', '2015-10-18 17:05:36', '2015-10-18 17:05:36', 1, 0, 0, 'sitcom-camerounais-fingon-le-modeliste-ftr', 1, 'PT14M8S', 'https://i.ytimg.com/vi/vVlmh_QHiQc/hqdefault.jpg'),
(16, 1, NULL, 'Fingon tralala en belgique - Film camerounais (FTR)', 'Fingon Tralala', 'Ph_eXZ_9uqM', '2015-10-18 17:05:40', '2015-10-18 17:05:40', 1, 0, 0, 'fingon-tralala-en-belgique-film-camerounais-ftr', 1, 'PT47M59S', 'https://i.ytimg.com/vi/Ph_eXZ_9uqM/hqdefault.jpg'),
(17, 1, NULL, 'Usher - Yeah! ft. Lil Jon, Ludacris', 'Listen on Spotify: http://smarturl.it/Usher_Sptfy?IQid=ytd.ushr.yea\n\nBuy Confessions: \nAmazon - http://smarturl.it/usher_conf_amzn?IQid=ytd.ushr.yea\niTunes - http://smarturl.it/usher_conf_itunes?IQid=ytd.ushr.yea\nGoogle Play - http://smarturl.it/usher_conf_gplay?IQid=ytd.ushr.yea\n\nAbout Confessions:\nConfessions is Usher''s fourth studio album, reased in 2004 by Arista Records. Confessions debuted at number one on the Billboard Hot 100 charts and has been certified diamond by the Recording IndustryAssociation of America (RIAA). As of 2012, it has sold 10 million copies in the US.\n\nFollow Usher on Twitter: http://smarturl.it/Usher_TW?IQid=ytd.ushr.yea\nFollow Usher on Instagram: http://smarturl.it/Usher_Insta?IQid=ytd.ushr.yea\nLike Usher on Facebook: http://smarturl.it/Usher_FB?IQid=ytd.ushr.yea\nSubscribe to the Usher YouTube Channel: http://smarturl.it/SubUsherVEVO?IQid=ytd.ushr.yea\n\nLyrics: \nPeace up, A-Town down\nI''m in the club with my homies, tryna get a lil'' v-I,\nKeep it down on the low key, cause you know how it feels.\nI said shawty she was checkin'' up on me,\nFrom the game she was spittin'' my ear you''d think that she knew me.\nSo we decided to chill\n\nYeah (yeah) shawty got down an'' said come and get me\nYeah (yeah) I got so caught up I forgot she told me\nYeah (yeah) Her and my girl would be the best of homies\nYeah (yeah) next thing I knew she was all up on me screaming', 'GxBSyx85Kp8', '2016-01-24 13:32:15', '2016-01-24 13:32:15', 1, 0, 0, 'usher-yeah-ft-lil-jon-ludacris', 1, 'PT4M17S', 'https://i.ytimg.com/vi/GxBSyx85Kp8/hqdefault.jpg'),
(18, 1, NULL, 'Usher - Confessions, Pt. II', 'Usher''s official music video for ''Confessions Part II''. Click to listen to Usher on Spotify: http://smarturl.it/UsherSpotify?IQid=UsherConf2\n\nAs featured on Confessions. Click to buy the track or album via iTunes: http://smarturl.it/UsherCnfshnsiTunes?IQid=UsherConf2\nGoogle Play: http://smarturl.it/UsherConf2play?IQid=UsherConf2\nAmazon: http://smarturl.it/UsherCnfshnsAmz?IQid=UsherConf2\n\nMore from Usher\nI Don''t Mind: https://youtu.be/nSKUXqJ5l1k\nGood Kisser: https://youtu.be/1lQtoRFaLsA\nBurn: https://youtu.be/t5XNWFw5HVw\n\nFollow Usher\nWebsite: http://usherworld.com/\nFacebook: https://www.facebook.com/usher/\nTwitter: https://twitter.com/usher\nInstagram: https://instagram.com/howuseeit/\n\nSubscribe to Usher on YouTube: http://smarturl.it/UsherSub?IQid=UsherConf2\n\nMore great Classic RNB videos here: http://smarturl.it/ClassicRNB?IQid=UsherConf2\n\n---------\n\nLyrics:\n\nThese are my confessions\nJust when I thought I said all I could say\nMy chick on the side said she got one on the way\nThese are my confessions\nMan I''m thrown and I dont know what to do\nI guess I gotta give part 2 of my confessions\nIf I''m gonna tell it then I gotta tell it all\nDamn near cried when I got that phone call\nI''m so throwed and I don''t know what to do\nBut to give you part 2 of my confessions\n\nNow this gon'' be the hardest thing I think I ever had to do\nGot me talkin'' to myself askin'' how I''m gon'' tell you\n''bout that chick on part 1 I told ya''ll I was creepin'' with, creepin'' with\nSaid she''s 3 months pregnant and she''s keepin'' it\nThe first thing that came to mind was you\nSecond thing was how do I know if it''s mine and is it true\nThird thing was me wishin'' that I never did what I did\nHow I ain''t ready for no kid and bye bye to our relationship', '5Sy19X0xxrM', '2016-01-24 13:32:23', '2016-01-24 13:32:23', 1, 0, 0, 'usher-confessions-pt-ii', 1, 'PT4M51S', 'https://i.ytimg.com/vi/5Sy19X0xxrM/hqdefault.jpg'),
(19, 1, NULL, 'Usher - Good Kisser', 'Usher''s official music video for ''Good Kisser''. Click to listen to Usher on Spotify: http://smarturl.it/UsherSpotify?IQid=UsherGK\n\nAs featured on Good Kisser - Single. Click to buy the track or album via iTunes: http://smarturl.it/UsherGKisseriTunes?IQid=UsherGK\nGoogle Play: http://smarturl.it/UsherGKisserplay?IQid=UsherGK\nAmazon: http://smarturl.it/UsherGKisserAmz?IQid=UsherGK\n\nMore from Usher\nI Don''t Mind: https://youtu.be/nSKUXqJ5l1k\nU Got It Bad: https://youtu.be/o3IWTfcks4k\nBurn: https://youtu.be/t5XNWFw5HVw\n\nFollow Usher\nWebsite: http://usherworld.com/\nFacebook: https://www.facebook.com/usher/\nTwitter: https://twitter.com/usher\nInstagram: https://instagram.com/howuseeit/\n\nSubscribe to Usher on YouTube: http://smarturl.it/UsherSub?IQid=UsherGK\n\nMore great Classic RNB videos here: http://smarturl.it/ClassicRNB?IQid=UsherGK\n\n---------\n\nLyrics:\n\nMake every minute worth it, baby\nThis for Usher, baby\nWatch this\n\nI done been around the world\nI done kissed a lot of girls\nSo I''m guessin'' that it''s true\nMake me holla and I bet a million dollars\nDon''t nobody kiss it like you\nDon''t nobody kiss it like you\nDon''t nobody kiss it like you, bang, bang, bang\nDon''t nobody kiss it like you\nDon''t nobody kiss it like you\n\nIt''s 5 inthe mornin''\nKush is rollin'' while she''s makin'' steak and eggs\nAt 5 in the mornin''\nWe can only be about to do one thing (what?)\n\nSee, I told her\nThe devil is a lie\nThem other girls can''t compete with mine\nYou do it so good, you fuck my mind\nYou pull it out, then you open wide\nYou make me wanna tap out and retire\nYour pretty lips leave me so inspired\n\nI think that she a winner\nShe could be a keeper\n\n''Cause she''s such a good kisser\nGot lipstick on my leg\nOh, baby\nShe''s such a good kisser\nI''m a rain on this parade\nOh, baby', '1lQtoRFaLsA', '2016-01-24 13:32:34', '2016-01-24 13:32:34', 1, 0, 0, 'usher-good-kisser', 1, 'PT5M4S', 'https://i.ytimg.com/vi/1lQtoRFaLsA/hqdefault.jpg'),
(20, 1, NULL, 'Usher - Good Kisser', 'Usher''s official music video for ''Good Kisser''. Click to listen to Usher on Spotify: http://smarturl.it/UsherSpotify?IQid=UsherGK\n\nAs featured on Good Kisser - Single. Click to buy the track or album via iTunes: http://smarturl.it/UsherGKisseriTunes?IQid=UsherGK\nGoogle Play: http://smarturl.it/UsherGKisserplay?IQid=UsherGK\nAmazon: http://smarturl.it/UsherGKisserAmz?IQid=UsherGK\n\nMore from Usher\nI Don''t Mind: https://youtu.be/nSKUXqJ5l1k\nU Got It Bad: https://youtu.be/o3IWTfcks4k\nBurn: https://youtu.be/t5XNWFw5HVw\n\nFollow Usher\nWebsite: http://usherworld.com/\nFacebook: https://www.facebook.com/usher/\nTwitter: https://twitter.com/usher\nInstagram: https://instagram.com/howuseeit/\n\nSubscribe to Usher on YouTube: http://smarturl.it/UsherSub?IQid=UsherGK\n\nMore great Classic RNB videos here: http://smarturl.it/ClassicRNB?IQid=UsherGK\n\n---------\n\nLyrics:\n\nMake every minute worth it, baby\nThis for Usher, baby\nWatch this\n\nI done been around the world\nI done kissed a lot of girls\nSo I''m guessin'' that it''s true\nMake me holla and I bet a million dollars\nDon''t nobody kiss it like you\nDon''t nobody kiss it like you\nDon''t nobody kiss it like you, bang, bang, bang\nDon''t nobody kiss it like you\nDon''t nobody kiss it like you\n\nIt''s 5 inthe mornin''\nKush is rollin'' while she''s makin'' steak and eggs\nAt 5 in the mornin''\nWe can only be about to do one thing (what?)\n\nSee, I told her\nThe devil is a lie\nThem other girls can''t compete with mine\nYou do it so good, you fuck my mind\nYou pull it out, then you open wide\nYou make me wanna tap out and retire\nYour pretty lips leave me so inspired\n\nI think that she a winner\nShe could be a keeper\n\n''Cause she''s such a good kisser\nGot lipstick on my leg\nOh, baby\nShe''s such a good kisser\nI''m a rain on this parade\nOh, baby', '1lQtoRFaLsA', '2016-01-24 13:32:35', '2016-01-24 13:32:35', 1, 0, 0, 'usher-good-kisser-1', 1, 'PT5M4S', 'https://i.ytimg.com/vi/1lQtoRFaLsA/hqdefault.jpg'),
(21, 1, NULL, 'Usher - Good Kisser', 'Usher''s official music video for ''Good Kisser''. Click to listen to Usher on Spotify: http://smarturl.it/UsherSpotify?IQid=UsherGK\n\nAs featured on Good Kisser - Single. Click to buy the track or album via iTunes: http://smarturl.it/UsherGKisseriTunes?IQid=UsherGK\nGoogle Play: http://smarturl.it/UsherGKisserplay?IQid=UsherGK\nAmazon: http://smarturl.it/UsherGKisserAmz?IQid=UsherGK\n\nMore from Usher\nI Don''t Mind: https://youtu.be/nSKUXqJ5l1k\nU Got It Bad: https://youtu.be/o3IWTfcks4k\nBurn: https://youtu.be/t5XNWFw5HVw\n\nFollow Usher\nWebsite: http://usherworld.com/\nFacebook: https://www.facebook.com/usher/\nTwitter: https://twitter.com/usher\nInstagram: https://instagram.com/howuseeit/\n\nSubscribe to Usher on YouTube: http://smarturl.it/UsherSub?IQid=UsherGK\n\nMore great Classic RNB videos here: http://smarturl.it/ClassicRNB?IQid=UsherGK\n\n---------\n\nLyrics:\n\nMake every minute worth it, baby\nThis for Usher, baby\nWatch this\n\nI done been around the world\nI done kissed a lot of girls\nSo I''m guessin'' that it''s true\nMake me holla and I bet a million dollars\nDon''t nobody kiss it like you\nDon''t nobody kiss it like you\nDon''t nobody kiss it like you, bang, bang, bang\nDon''t nobody kiss it like you\nDon''t nobody kiss it like you\n\nIt''s 5 inthe mornin''\nKush is rollin'' while she''s makin'' steak and eggs\nAt 5 in the mornin''\nWe can only be about to do one thing (what?)\n\nSee, I told her\nThe devil is a lie\nThem other girls can''t compete with mine\nYou do it so good, you fuck my mind\nYou pull it out, then you open wide\nYou make me wanna tap out and retire\nYour pretty lips leave me so inspired\n\nI think that she a winner\nShe could be a keeper\n\n''Cause she''s such a good kisser\nGot lipstick on my leg\nOh, baby\nShe''s such a good kisser\nI''m a rain on this parade\nOh, baby', '1lQtoRFaLsA', '2016-01-24 13:32:35', '2016-01-24 13:32:35', 1, 0, 0, 'usher-good-kisser-2', 1, 'PT5M4S', 'https://i.ytimg.com/vi/1lQtoRFaLsA/hqdefault.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `video_category`
--

CREATE TABLE IF NOT EXISTS `video_category` (
  `video_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`video_id`,`category_id`),
  KEY `IDX_AECE2B7D29C1004E` (`video_id`),
  KEY `IDX_AECE2B7D12469DE2` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `video_category`
--

INSERT INTO `video_category` (`video_id`, `category_id`) VALUES
(1, 13),
(2, 9),
(3, 9),
(4, 9),
(5, 9),
(6, 9),
(7, 9),
(8, 9),
(12, 12),
(14, 10),
(15, 10),
(16, 10),
(17, 12),
(18, 12),
(19, 12),
(20, 12),
(21, 12);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `FK_64C19C13DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `FK_64C19C1727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `FK_8408FDA789C48F0B` FOREIGN KEY (`fan_id`) REFERENCES `mvondo_users` (`id`),
  ADD CONSTRAINT `FK_8408FDA7B7970CF8` FOREIGN KEY (`artist_id`) REFERENCES `mvondo_users` (`id`);

--
-- Contraintes pour la table `mvondo_users`
--
ALTER TABLE `mvondo_users`
  ADD CONSTRAINT `FK_69D44C69275ED078` FOREIGN KEY (`profil_id`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `FK_69D44C69F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`),
  ADD CONSTRAINT `FK_69D44C69FE54D947` FOREIGN KEY (`group_id`) REFERENCES `mvondo_group` (`id`);

--
-- Contraintes pour la table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `FK_7CC7DA2C56A273CC` FOREIGN KEY (`origin_id`) REFERENCES `origin` (`id`),
  ADD CONSTRAINT `FK_7CC7DA2CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `mvondo_users` (`id`),
  ADD CONSTRAINT `FK_7CC7DA2CF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Contraintes pour la table `video_category`
--
ALTER TABLE `video_category`
  ADD CONSTRAINT `FK_AECE2B7D12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_AECE2B7D29C1004E` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
