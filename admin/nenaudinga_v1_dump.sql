--
-- MySQL 5.5.8
-- Sun, 14 Oct 2012 07:56:39 +0000
-- 
--

CREATE TABLE `conf` (
   `id` int(11) not null auto_increment,
   `tytul` char(60) not null,
   `slogan` text not null,
   `logo` text not null,
   `description` text not null,
   `tags` text not null,
   `img_na_strone` int(11) not null default '10',
   `regulamin` text,
   `email` text not null,
   `komentarze` int(1) not null default '0',
   `img_title` int(1) not null default '1',
   `req_code` int(1) not null default '1',
   `max_file_size` int(32) not null default '500',
   `reklama` int(1) not null default '1',
   `theme` varchar(64) not null,
   PRIMARY KEY (`id`),
   UNIQUE KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;


CREATE TABLE `reklama` (
   `id` int(11) not null auto_increment,
   `kod` text,
   `pod_obrazkiem` int(3) not null,
   PRIMARY KEY (`id`),
   UNIQUE KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;


CREATE TABLE `shity` (
   `id` int(11) not null auto_increment,
   `title` varchar(60) not null,
   `content` varchar(256),
   `img` text not null,
   `source` text,
   `author` text not null,
   `data` text not null,
   `is_waiting` int(11) not null default '1',
   `type` varchar(30) not null default 'wiedza',
   `share` int(11) not null default '0',
   PRIMARY KEY (`id`),
   UNIQUE KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=134;


CREATE TABLE `user` (
   `id` int(11) not null auto_increment,
   `login` varchar(30),
   `email` char(30),
   `haslo` varchar(32),
   `ranga` int(11) not null default '0',
   `code` int(11) not null default '0',
   PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;