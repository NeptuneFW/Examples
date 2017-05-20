-- --------------------------------------------------------
-- Sunucu:                       localhost
-- Sunucu sürümü:                10.2.3-MariaDB-log - mariadb.org binary distribution
-- Sunucu İşletim Sistemi:       Win32
-- HeidiSQL Sürüm:               9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- ntuser için veritabanı yapısı dökülüyor
CREATE DATABASE IF NOT EXISTS `ntuser` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ntuser`;

-- tablo yapısı dökülüyor ntuser.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(13) NOT NULL AUTO_INCREMENT,
  `rank` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ntuser.user: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `rank`, `deleted`, `name`, `surname`, `email`, `created_time`) VALUES
	(1, 1, 0, 'Emirhan', 'Engin', 'whitekod.com2001@gmail.com', '2017-05-16 21:05:26'),
	(2, 1, 0, 'Mehmet Ali', 'Peker', 'maps6134@gmail.com', '2017-05-16 21:05:26');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- tablo yapısı dökülüyor ntuser.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '0',
  `surname` varchar(50) DEFAULT '0',
  `banned` int(11) DEFAULT 0,
  `email` varchar(255) DEFAULT '0',
  `rank` int(11) DEFAULT 0,
  `created_time` timestamp NULL DEFAULT current_timestamp(),
  `about` text DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `picture` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ntuser.users: ~5 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `surname`, `banned`, `email`, `rank`, `created_time`, `about`, `password`, `picture`) VALUES
	(1, 'Mehmet Ali', 'Peker', 0, 'maps6134@gmail.com', 1, '2017-04-23 20:29:41', NULL, '99205748aa43626221c769cefdfb7754', 'https://scontent-ams3-1.xx.fbcdn.net/v/t1.0-1/p50x50/17342536_118694588666108_7644236276644242905_n.jpg?oh=a6e83ea6746bd5ae870ef30908b10eb1&oe=59C12B54'),
	(2, 'Emirhan', 'Engin', 0, 'wackhope.com@gmail.com', 0, '2017-05-11 00:26:52', NULL, '25f9e794323b453885f5181f1b624d0b', '/public/upload/5913859c326919.93222078.jpg'),
	(3, 'Emirhan', 'Engin', 1, 'wackhope.com@gmail.com', 0, '2017-05-11 00:27:04', NULL, '25f9e794323b453885f5181f1b624d0b', '/public/upload/591385a8741b79.37193188.jpg'),
	(4, 'Emirhan', 'Engin', 1, 'wackhope.com@gmail.com', 0, '2017-05-11 00:32:51', NULL, '25f9e794323b453885f5181f1b624d0b', '/public/upload/59138703369e69.06398898.jpg'),
	(5, 'John', 'Doe', 0, 'john@doe.com', 0, '2017-05-11 00:35:59', NULL, '81dc9bdb52d04dc20036dbd8313ed055', '/public/upload/591387bfb15f02.64493873.jpg'),
	(6, 'Mark', 'Zuckerberg', 0, 'mark@facebook.com', 0, '2017-05-11 00:38:10', NULL, '99205748aa43626221c769cefdfb7754', '/public/upload/591388429a76f5.94758356.jpg');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- ntblog için veritabanı yapısı dökülüyor
CREATE DATABASE IF NOT EXISTS `ntblog` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ntblog`;

-- tablo yapısı dökülüyor ntblog.articles
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created` timestamp NULL DEFAULT current_timestamp(),
  `permalink` varchar(250) DEFAULT '',
  `updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `category_id` int(11) DEFAULT NULL,
  `likes` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ntblog.articles: ~3 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` (`id`, `title`, `content`, `created`, `permalink`, `updated`, `user`, `deleted`, `category_id`, `likes`) VALUES
	(5, 'Flexible Nedir?', '&lt;h3&gt;Flexible bir CSS Grid System dır.&lt;/h3&gt;\r\n&lt;h5&gt;Bu yapıyor olduğunuz tasarımda her kutu modelini belli bir y&amp;uuml;zdeye b&amp;ouml;lmenize yarar. Flexible bu iş i&amp;ccedil;in kesirleri kullanır mesela xl-6-12 dersek 12 b&amp;ouml;l&amp;uuml;ml&amp;uuml;k bir ızgara &amp;uuml;zerinde 6 karelik alanı kaplayacağını s&amp;ouml;ylemiş oluyoruz. Flexible karşılaştığım en harika şeylerden birisi. Geliştiricisi Doğukan G&amp;uuml;ven Nomak ile&amp;nbsp;&lt;a href=&quot;https://www.facebook.com/dnomak?fref=ts&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;buradan&lt;/a&gt;&amp;nbsp;iletişim kurabilirsiniz. Flexible open source olup&amp;nbsp;&lt;a href=&quot;https://github.com/flexiblegs&quot;&gt;buradan&lt;/a&gt;&amp;nbsp;resmi GitHub hesabına erişebilirsiniz.&lt;/h5&gt;', '2017-05-04 23:46:50', 'flexible-nedir', '2017-05-13 20:50:20', 1, 0, 26, 0),
	(6, 'League of Legends API', '&lt;h1&gt;Neptune Framework ile League of Legends API kullandığım projenin kaynak kodları yayında!&lt;br /&gt;&lt;a title=&quot;https://github.com/MrPeker/LoLApi&quot; href=&quot;https://github.com/MrPeker/LoLApi&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;https://github.com/MrPeker/LoLApi&lt;/a&gt;&lt;/h1&gt;', '2017-05-19 21:22:08', 'league-ofl-legends-api', '2017-05-19 21:28:46', 1, 0, 23, 0),
	(8, 'Neptune Framework GitHub hesabı', '&lt;p&gt;https://github.com/NeptuneFW&lt;/p&gt;', '2017-05-19 21:51:13', 'neptune-framework-github-hesabi', '2017-05-19 21:59:00', 1, 0, 23, 0);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;

-- tablo yapısı dökülüyor ntblog.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `deleted` int(11) DEFAULT 0,
  `permalink` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ntblog.categories: ~6 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `description`, `deleted`, `permalink`) VALUES
	(21, 'PHP', 'PHP ile ilgili makaleler burada yer alacak.', 0, 'php'),
	(22, 'JavaScript', 'JavaScript\'i  namı-değer ECMA-262 yi yakından inceleyeceğiz.', 0, 'javascript'),
	(23, 'Neptune Framework Beta V1', 'Neptune Framework ile ilgili her şey burada olacak.', 0, 'neptune-framework-beta-v1'),
	(25, 'Kişisel', 'Kişisel makaleler burada yer alacak.', 0, 'kisisel'),
	(26, 'Flexible', 'Flexible ile ile ilgili makaleler burada yer alacak', 0, 'flexible');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- tablo yapısı dökülüyor ntblog.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `created` timestamp NULL DEFAULT current_timestamp(),
  `deleted` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ntblog.comments: ~1 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `post_id`, `user_id`, `text`, `created`, `deleted`) VALUES
	(3, 5, 1, 'Hello Emirhan!', '2017-05-06 19:51:15', 0),
	(5, 5, 6, 'I\'m CEO on Facebook', '2017-05-11 00:38:36', 0),
	(6, 8, 1, 'İnsan bunu link yapardı be!', '2017-05-19 22:01:07', 0),
	(7, 8, 1, 'Merhaba', '2017-05-20 01:26:36', 0);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- tablo yapısı dökülüyor ntblog.languages
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deleted` int(11) DEFAULT NULL,
  `icon_url` varchar(1000) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  KEY `İndeks 1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ntblog.languages: ~3 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` (`id`, `deleted`, `icon_url`, `title`, `code`) VALUES
	(1, 0, 'https://cdn4.iconfinder.com/data/icons/flat-circle-flag/182/turkey_circle_flag-512.png', 'Turkish', 'tr_TR'),
	(2, 0, 'http://i.hizliresim.com/z3qjG6.png', 'English', 'en_US');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;

-- tablo yapısı dökülüyor ntblog.likes
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `post` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ntblog.likes: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;

-- tablo yapısı dökülüyor ntblog.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `site_title` varchar(1000) DEFAULT NULL,
  `site_url` varchar(250) DEFAULT NULL,
  `site_keyw` varchar(250) DEFAULT NULL,
  `site_desc` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ntblog.settings: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`site_title`, `site_url`, `site_keyw`, `site_desc`) VALUES
	('a:3:{s:5:"tr_TR";s:12:"Neptün Blog";s:5:"en_US";s:12:"Neptune Blog";s:5:"ar_AR";s:25:"نبتون المدونة";}', 'http://blog.nt', NULL, NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- tablo yapısı dökülüyor ntblog.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(13) NOT NULL AUTO_INCREMENT,
  `rank` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ntblog.user: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
