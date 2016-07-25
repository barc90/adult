-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `categories` (`id`, `slug`, `name`) VALUES
(1,	'big-tits',	'Big Tits'),
(2,	'milf',	'Milf'),
(4,	'russian',	'Russian'),
(5,	'blonde',	'Blonde');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_07_21_232552_create_videos_table',	1),
('2016_07_21_232637_create_category_table',	1),
('2016_07_22_160018_videos',	2);

DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` tinyint(3) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `video_file` varchar(255) NOT NULL,
  `converted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `videos` (`id`, `category_id`, `title`, `url`, `thumb`, `video_file`, `converted`) VALUES
(1,	1,	'Blonde And Brunette Suck And Fuck A Big Penis Together',	'porn.com/videos/blonde-and-brunette-suck-and-fuck-a-big-penis-together-1894553',	'65ppu8_1469448565.jpg',	'rtk20v_1469448565.mp4',	1),
(2,	1,	'a cute young asian plays with her fuck toys on cam',	'porn.com/videos/a-cute-young-asian-plays-with-her-fuck-toys-on-cam-2209685',	'c2uvd2_1469448755.jpg',	'wvieoa_1469448755.mp4',	1),
(3,	1,	'Babe In White Skirt Loves To Get Her Pussy Ate Out',	'porn.com/videos/babe-in-white-skirt-loves-to-get-her-pussy-ate-out-2322867',	'29yfzi_1469449032.jpg',	'k5oavj_1469449032.mp4',	1),
(4,	1,	'Young Blonde Gets Her Bald Hole Filled With Cock',	'porn.com/videos/young-blonde-gets-her-bald-hole-filled-with-cock-2554823',	'inc3pc_1469449294.jpg',	'z1ftwt_1469449295.mp4',	1),
(5,	1,	'Lovely Young Girlfriend Masturbates His Cock And Sucks On It',	'porn.com/videos/lovely-young-girlfriend-masturbates-his-cock-and-sucks-on-it-2358937',	'wtoe7d_1469450005.jpg',	'o9nnom_1469450005.mp4',	1),
(6,	2,	'Brunette Girls Fuck Each Other With Toy And Fingers',	'porn.com/videos/brunette-girls-fuck-each-other-with-toy-and-fingers-1838905',	'68suin_1469450549.jpg',	'd0aq4z_1469450550.mp4',	1),
(7,	2,	'Amateur Brunette Sucks And Rides A Black Cock',	'porn.com/videos/amateur-brunette-sucks-and-rides-a-black-cock-2554833',	'231hxy_1469450765.jpg',	'atrz8y_1469450765.mp4',	1),
(8,	2,	'Keana Moire Has Some Good Times With Her Busty Friend',	'porn.com/videos/keana-moire-has-some-good-times-with-her-busty-friend-2615091',	'dx70kv_1469451537.jpg',	'nr4fmm_1469451538.mp4',	1),
(9,	2,	'Brunette Girls Eat Each Other Out On Couch',	'porn.com/videos/brunette-girls-eat-each-other-out-on-couch-2322793',	'20ndqr_1469451817.jpg',	'dtvebs_1469451818.mp4',	1),
(10,	2,	'Babe With Tight Snatch Loves To Play With Herself',	'porn.com/videos/babe-with-tight-snatch-loves-to-play-with-herself-2347763',	'dmm4lu_1469452628.jpg',	'2zra0c_1469452628.mp4',	1),
(11,	4,	'Man Receives Pleasure From Two Blonde Women',	'porn.com/videos/man-receives-pleasure-from-two-blonde-women-2577535',	'6o3a3p_1469452970.jpg',	'x6pkkg_1469452970.mp4',	1),
(12,	4,	'Stockings Foot Fetish Anal Fuck Flick Extravaganza',	'porn.com/videos/stockings-foot-fetish-anal-fuck-flick-extravaganza-2322781',	'cx98bk_1469453528.jpg',	'1o6nts_1469453528.mp4',	1),
(13,	4,	'Brunette pleases with feet fetish',	'porn.com/videos/brunette-pleases-with-feet-fetish-2322775',	'iws96s_1469453867.jpg',	'ldgpnk_1469453867.mp4',	1),
(14,	4,	'foot worshipping submissive',	'porn.com/videos/foot-worshipping-submissive-2322773',	'fkr55b_1469454151.jpg',	'li8urk_1469454151.mp4',	1),
(15,	4,	'Hot Babe Gets Her Ass Hole Fucked Deep And Jizzed',	'porn.com/videos/hot-babe-gets-her-ass-hole-fucked-deep-and-jizzed-2322789',	'fs9mf2_1469454452.jpg',	'exz675_1469454453.mp4',	1),
(16,	5,	'Adorable Blonde Chick Gives Some Amazing Head',	'porn.com/videos/adorable-blonde-chick-gives-some-amazing-head-2287619',	'ztjfj6_1469455091.jpg',	'0yrr3x_1469455091.mp4',	1),
(17,	5,	'Busty Blonde Woman Fucked In Her Trimmed Vagina',	'porn.com/videos/busty-blonde-woman-fucked-in-her-trimmed-vagina-1894545',	'2pgbk7_1469455252.jpg',	'wzz5lf_1469455252.mp4',	1),
(18,	5,	'Sassy Teen Gets A Rock Hard Dick In Her Butt',	'porn.com/videos/sassy-teen-gets-a-rock-hard-dick-in-her-butt-2558781',	'80d77l_1469455867.jpg',	'd6ewlx_1469455867.mp4',	1),
(19,	5,	'Randy Teen Spreads Eagle For His Erect Penis',	'porn.com/videos/randy-teen-spreads-eagle-for-his-erect-penis-1894743',	'3mwudz_1469456421.jpg',	'sgo8s9_1469456421.mp4',	1),
(20,	5,	'Sucking On His Big Schlong He Can\'t Resist Her',	'porn.com/videos/sucking-on-his-big-schlong-he-can-t-resist-her-2487157',	'go8gtu_1469457102.jpg',	'w1v992_1469457103.mp4',	1);

-- 2016-07-25 22:22:32
