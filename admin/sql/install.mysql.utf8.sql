CREATE TABLE IF NOT EXISTS `#__jlhoroscope_sign` (
	`id` int(11) NOT NULL auto_increment, 
	`title` VARCHAR(200) NOT NULL, 
	`alias` VARCHAR(200) NOT NULL, 
	`asset_id` INTEGER UNSIGNED NOT NULL DEFAULT 0 COMMENT 'FK to the #__assets table.', 
	`introtext` TEXT NOT NULL, 
	`fulltext` TEXT NOT NULL, 
	`created` DATETIME NOT NULL, 
	`ordering` INT(11) NOT NULL, 
	`metakey` TEXT NOT NULL, 
	`metadesc` TEXT NOT NULL, 
	`hits` INT(11) NOT NULL, 
	`created_by` INT(11) NOT NULL, 
	`published` INT(2) NOT NULL, 
	`params` TEXT NOT NULL, 
	`catid` INT(11) NOT NULL, 
	`sign` VARCHAR(150) NOT NULL,
	`dates` VARCHAR(255) NOT NULL,
	`code` VARCHAR(20) NOT NULL,
	`image` VARCHAR(255) NOT NULL,
	`tumbinail` VARCHAR(255) NOT NULL, 
	UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

CREATE TABLE IF NOT EXISTS `#__jlhoroscope_horoscope` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `alias` varchar(200) NOT NULL,
  `fulltext` text NOT NULL,
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `sign` varchar(20) NOT NULL,
  `dates` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `horo_type` varchar(20) NOT NULL,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `sign` (`sign`,`type`,`horo_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

CREATE TABLE IF NOT EXISTS `#__jlhoroscope_date` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_update` date NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `#__jlhoroscope_sign` (`id`, `title`, `alias`, `asset_id`, `introtext`, `fulltext`, `created`, `ordering`, `metakey`, `metadesc`, `hits`, `created_by`, `published`, `params`, `catid`, `sign`, `image`, `tumbinail`, `dates`, `code`) VALUES
(1, 'Овен', 'oven', 1206, '<p>Я Есть! Ключевая особенность - предприимчивость.</p>', '', '2016-09-12 07:15:40', 1, '', '', 0, 23, 1, '', 0, '', 'images/com_jlhoroscope/4-300.jpg', 'images/com_jlhoroscope/4-100.jpg', 'Март 21 - Апрель 20', 'aries'),
(2, 'Телец', 'telets', 1207, '<p>Я приобретаю! Ключевая особенность - практичность.</p>', '', '2016-09-12 07:44:13', 2, '', '', 0, 23, 1, '', 0, '', 'images/com_jlhoroscope/5-300.jpg', 'images/com_jlhoroscope/5-100.jpg', 'Апрель 21 - Май 21', 'taurus'),
(3, 'Близнецы', 'bliznetsy', 1208, '<p>Я думаю! Ключевая особенность - ловкость.</p>', '', '2016-09-12 07:45:50', 3, '', '', 0, 23, 1, '', 0, '', 'images/com_jlhoroscope/6-300.jpg', 'images/com_jlhoroscope/6-100.jpg', 'Май 21 - Июнь 21', 'gemini'),
(4, 'Рак', 'rak', 1209, '<p>Я чувствую! Ключевая особенность - чувство.</p>', '', '2016-09-12 07:47:09', 4, '', '', 0, 23, 1, '', 0, '', 'images/com_jlhoroscope/7-300.jpg', 'images/com_jlhoroscope/7-100.jpg', 'Июнь 22 - Июль 22', 'cancer'),
(5, 'Лев', 'lev', 1210, '<p>Я Буду! Ключевая особенность - самовыражение.</p>', '', '2016-09-12 07:48:37', 5, '', '', 0, 23, 1, '', 0, '', 'images/com_jlhoroscope/8-300.jpg', 'images/com_jlhoroscope/8-100.jpg', 'Июль 23 - Август 23', 'leo'),
(6, 'Дева', 'deva', 1211, '<p>Я анализирую! Ключевая особенность - усердие.</p>', '', '2016-09-12 07:49:59', 6, '', '', 0, 23, 1, '', 0, '', 'images/com_jlhoroscope/9-300.jpg', 'images/com_jlhoroscope/9-100.jpg', 'Август 24 - Сентябрь 23', 'virgo'),
(7, 'Весы', 'vesy', 1212, '<p>Я уравновешиваю! Ключевая особенность - сдержанность.</p>', '', '2016-09-12 07:51:35', 7, '', '', 0, 23, 1, '', 0, '', 'images/com_jlhoroscope/10-300.jpg', 'images/com_jlhoroscope/10-100.jpg', 'Сентябрь 24 - Октябрь 23', 'libra'),
(8, 'Скорпион', 'skorpion', 1213, '<p>Я хочу! Ключевая особенность - проницательность.</p>', '', '2016-09-12 07:52:31', -1, '', '', 0, 23, 1, '', 0, '', 'images/com_jlhoroscope/11-300.jpg', 'images/com_jlhoroscope/11-100.jpg', 'Октябрь 24 - Ноябрь 22', 'scorpio'),
(9, 'Стрелец', 'strelets', 1214, '<p>Я вижу! Ключевая особенность - прямолинейность.</p>', '', '2016-09-12 07:54:07', -3, '', '', 0, 23, 1, '', 0, '', 'images/com_jlhoroscope/12-300.jpg', 'images/com_jlhoroscope/12-100.jpg', 'Ноябрь 23 - Декабрь 21', 'sagittarius'),
(10, 'Козерог', 'kozerog', 1215, '', '', '2016-09-12 07:54:56', -2, '', '', 0, 23, 1, '', 0, '', 'images/com_jlhoroscope/1-300.jpg', 'images/com_jlhoroscope/1-100.jpg', 'Декабрь 22 - Январь 20', 'capricorn'),
(11, 'Водолей', 'vodolej', 1216, '<p>Я знаю! Ключевая особенность - нетрадиционность.</p>', '', '2016-09-12 07:55:51', -1, '', '', 0, 23, 1, '', 0, '', 'images/com_jlhoroscope/2-300.jpg', 'images/com_jlhoroscope/2-100.jpg', 'Январь 21 - Февраль 19', 'aquarius'),
(12, 'Рыбы', 'ryby', 1217, '<p>Я верю! Ключевая особенность - мечтательность.</p>', '', '2016-09-12 07:56:38', -1, '', '', 0, 23, 1, '', 0, '', 'images/com_jlhoroscope/3-300.jpg', 'images/com_jlhoroscope/3-100.jpg', 'Февраль 20 - Март 20', 'pisces');

