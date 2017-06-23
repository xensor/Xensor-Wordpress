CREATE TABLE `wprh_maint` (
 `maint_id` int(11) NOT NULL AUTO_INCREMENT,
 `maint` text COLLATE utf8_unicode_ci NOT NULL,
 `bid` int(11) NOT NULL,
 `sid` int(11) NOT NULL,
 `gid` int(11) NOT NULL,
 `mid` text COLLATE utf8_unicode_ci NOT NULL,
 `ban_url` text COLLATE utf8_unicode_ci NOT NULL,
 `ban_page` text COLLATE utf8_unicode_ci NOT NULL,
 `maint_page` text COLLATE utf8_unicode_ci NOT NULL,
 `login_page` int(11) NOT NULL,
 PRIMARY KEY (`maint_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
