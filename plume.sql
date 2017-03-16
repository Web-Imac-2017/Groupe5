-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- G√©n√©r√© le :  Jeu 16 Mars 2017 √† 19:37
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de donn√©es :  `plume`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`ID`, `password`, `username`) VALUES
(1, 'e03bb121a09084d7584fd24150caf012', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `centre_interet`
--

CREATE TABLE IF NOT EXISTS `centre_interet` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `centre_interet`
--

INSERT INTO `centre_interet` (`ID`, `nom`) VALUES
(1, 'Music'),
(2, 'Movies'),
(3, 'Series'),
(4, 'Trip'),
(5, 'Arts'),
(6, 'Computering'),
(7, 'Sport'),
(8, 'Cooking'),
(9, 'Video games'),
(10, 'Fashion'),
(11, 'Sciences'),
(12, 'Politics'),
(13, 'Animals'),
(14, 'Automobile'),
(15, 'Seam'),
(16, 'Astronomy');

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE IF NOT EXISTS `conversation` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `conversation`
--

INSERT INTO `conversation` (`ID`, `titre`) VALUES
(1, NULL),
(2, NULL),
(3, NULL),
(5, NULL),
(6, NULL),
(7, NULL),
(8, NULL),
(9, NULL),
(10, NULL),
(12, NULL),
(13, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `etat_activite`
--

CREATE TABLE IF NOT EXISTS `etat_activite` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `etat_activite`
--

INSERT INTO `etat_activite` (`ID`, `nom`) VALUES
(1, 'Disconnected'),
(2, 'Online'),
(3, 'Absent'),
(4, 'Invisible');

-- --------------------------------------------------------

--
-- Structure de la table `langue`
--

CREATE TABLE IF NOT EXISTS `langue` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(60) NOT NULL,
  `abrev_langue` varchar(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `langue`
--

INSERT INTO `langue` (`ID`, `Nom`, `abrev_langue`) VALUES
(1, 'English', 'en'),
(2, 'French', 'fr'),
(3, 'Spanish', 'es'),
(4, 'Italian', 'it'),
(5, 'Japanese', 'ja'),
(6, 'Russian', 'ru');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` varbinary(50000) NOT NULL,
  `date` datetime NOT NULL,
  `id_user` int(11) NOT NULL COMMENT 'emetteur',
  `id_conversation` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `id_user` (`id_user`),
  KEY `id_conversation` (`id_conversation`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`ID`, `contenu`, `date`, `id_user`, `id_conversation`) VALUES
(47, '•îÇŒí''^ºé˜aÜ%€∏¥ÛpÅJˆÈ.ﬂR] ãl´Sy¸ç›''“2J''Æ˘<Cyt"æããÿ√Bdb~£^B_∞Ÿ"©Y˛%ç;;Ãí+æ|æó¬8óÅ˘.◊Dôƒ»°ïAŸJË.…BVÇél$‡Z\r@Ù‚ÜΩ‹≥A√', '2017-03-16 10:21:08', 5, 5),
(48, 'w`Uı_B‘å\0Y˙É≤ô≠›O˝uC.zøÏ` 2⁄ëuQ˛ﬂ’IΩ?π7(Â>@˚®sÑ;j≥äs\n°˛*]Sˇï\n\n≈ƒıqËÕÈy”„<“£cçﬂp¥Î≠`xÓ PŸ‚Bg“Ï\r˘''OàºÎc⁄ÏΩ}y9]"ﬂ“ÖÓ¢ê<ï a', '2017-03-16 10:21:30', 5, 5),
(49, '£ñ\ZªCsè˙{aó`¶nQ∆g⁄Óg⁄0íœ≥î\nœÖ[¬á¶‘˚⁄ÍëÕÃÏÔ*nﬂuı†(ËêFbOúk˙EMør“î€ò<¿2˚ümLúùÒZÍñ∞íÌ¨ºòI*Gl¿#o>®xØﬂŒ≤_≈™o¿Å\0åîƒ#àŒç', '2017-03-16 10:24:01', 1, 5),
(50, 'ì»Ò¯ou-èÀ≠~¡⁄\0ÆæΩ"ôÚŒ†£¬|ll»(\0T$Ú≈|t3[Xuón\0|EÊy>n9)€–ˇldˇm‚·4ËÓFQ?±Ñ•çh¨ÀS#0åœJQ›¨≈®û\ZìRΩ˛Rêë‹∆	òT`e6Í''ËgW+¬CáÃ?', '2017-03-16 10:24:10', 1, 5),
(51, '[æxê\ZƒéâÎﬂH‘˚‹ã1]†ò\n{-ùdÀ≤ˇ\ZÍ	∫nç3X„©—ãŒw§%˛L''Ò™ºÀ2?|±V¥√≈;]øø+/€ÉV∑ÑhB8&ûØ8Nt2Z2z” S@io⁄¥¬æ»U Å{_ôM{ÿÜÉ5—q¶8h`=“«mo', '2017-03-16 10:28:47', 1, 5),
(52, 'OM•p@,‚òá7Y»eUF.\nX|°P‡kèñÿ÷ˇg''˝-˝±Øp¯áµ÷Ã\0´Wô#\\…œ∑YGÁëõ`Í|Â	,e|Ö˚äi?◊üO†ÇL›@\rä.-Éƒ∏î¯q}^™a8˙<Âﬂ÷ﬂ]uB?SYm…3}⁄:·…n 	¨', '2017-03-16 10:31:15', 1, 1),
(53, 'rƒë<9f¯¨V‹@ §Y⁄ﬂ¿ûm»\n∏\rXê\0∏mZi˙”ü¯Œ=¯[hË‘¨«üPÏŸ>»Rj“;)ΩÄ‰‰∞QÊüÄìÅSÖ- µD?qMÌ˜|''©qﬂÍ/\\¢—)®“2;êB	&ô±:C*Z‚5˛⁄éåñﬁ∆ÊTú¡Ö<', '2017-03-16 10:31:34', 1, 1),
(54, 'S∑‚f¡ƒ]Òô2Ô+†ÃI“‰?)¥ﬂÌùÑ—˘◊˛áTX3›ﬂFhôm%~ÙUPå7PjŸÉ#Ωîh⁄i?<Ky£%T7cgJ¶ÛöS3∂ùP‚©rÀõW‡#QÿjZÎ9-P-Ä∏s—’;—å©£^°q	<>©Jz»‘d¿;“', '2017-03-16 10:33:22', 1, 6),
(55, '=≈\rã°¨« ßT¿·æﬁl#Kì4‰aÂ”:Ñ”ΩkAı.$Inº·rÔ¯txå˙ª® ·∫–4k6vÃ [xÀtaÑLETF`R~ª/ãì-ÓòYßüä’öƒ’H◊©`%∫l•-∫dË‡‚‰L;YÑF"HK∆„ƒƒ√Ä{', '2017-03-16 10:34:32', 9, 6),
(59, 'ê`în…“:L√5Ëòﬁƒ”\n„⁄¥äç´J˜ßÅ&O`D†óÍe ~ˇÒ¿"(&FïWˆ#Ÿ;Ÿ«®∫®zÇÆZj—]FˇZ ´@‹íÓ¡ÃÍBÌ¿¯Û$TﬁOøöŒØz,6ﬂ˜,&5Bpé„w\\£¸Æƒê™6ì''v©"r/\n∞ó', '2017-03-16 13:58:08', 9, 12),
(60, 'û¯2AÕÚàó\nπÅº≥¬∑»ç''æ’÷†éW.J°ÚÚù”>\rò»\Z‘àÏèÃÃezrbfc	*\0‡lº*èD}lcÕl£oÏP<"«^Ïõ±.a˙π•0CÉ¿P’…9ﬂ»é?Vù‚CÈ˘ÚuÓŒú*JÊ¢ˆ_˘4∞', '2017-03-16 14:04:37', 5, 3),
(61, 'z\nt—`°P≤&™⁄ˆ¸Øƒ\n⁄íüØnìX≥f/X©ü¢(Á„◊f±Æ4m€@ÑtIô˘®xû@√—⁄i©^-EÚ†Ï¡g@Îbv”*‘ˆV‹{Éß(7üS„k„ê_¿◊ÜöÁ4Yo!˛Ãà\ZüïYfÒS¡\0íz¶	¯ËÍ=ÙgŸ', '2017-03-16 14:04:45', 5, 3),
(62, 'aZKQm‹¬"+À*ŸX◊È†Ûﬂ¨@”ÓRÊáÊE<˜uQ–Ï''ò0nàP∂±âÇïA˘4‚ÙQ’œ®äg:.÷·ìﬁ,Ìı§ùÇÁ´†Î\\Ö˜‘i±™Å…Xü\Z<¶˛ê4˝íæ·´¥ê∏⁄JÊÕW¿ˆRΩ˜ß”n?ÿVæ', '2017-03-16 16:36:42', 5, 5),
(66, 's‚¿œ:ØAG=\nß≥û≠\r3AÈﬂIe?∂Øb\Z≤ª \Zƒê\nëCÏ¶é»l!æJ=Â∂<≈ñﬂÔKg)åÜòká◊2Kå0ôT¨íSƒµ√%ﬂ–í°ÁŸÊÕ5)q¶îÜÑÿJ√	ô˘˝z:bºŒVAç÷…iŒS', '2017-03-16 19:37:12', 5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `contenu_notification` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `notification`
--

INSERT INTO `notification` (`ID`, `contenu_notification`) VALUES
(1, 'Conversation request from'),
(2, 'New message from');

-- --------------------------------------------------------

--
-- Structure de la table `table_pays`
--

CREATE TABLE IF NOT EXISTS `table_pays` (
  `id_pays` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(2) NOT NULL,
  `nom_pays` varchar(255) NOT NULL,
  PRIMARY KEY (`id_pays`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=239 ;

--
-- Contenu de la table `table_pays`
--

INSERT INTO `table_pays` (`id_pays`, `code`, `nom_pays`) VALUES
(0, '00', 'Not filled'),
(1, 'AF', 'Afghanistan'),
(2, 'ZA', 'South Africa'),
(3, 'AL', 'Albania'),
(4, 'DZ', 'Algeria'),
(5, 'DE', 'Germany'),
(6, 'AD', 'Andorra'),
(7, 'AO', 'Angola'),
(8, 'AI', 'Anguilla'),
(9, 'AQ', 'Antarctica'),
(10, 'AG', 'Antigua & Barbuda'),
(11, 'AN', 'Netherlands Antilles'),
(12, 'SA', 'Saudi Arabia'),
(13, 'AR', 'Argentina'),
(14, 'AM', 'Armenia'),
(15, 'AW', 'Aruba'),
(16, 'AU', 'Australia'),
(17, 'AT', 'Austria'),
(18, 'AZ', 'Azerbaijan'),
(19, 'BJ', 'Benin'),
(20, 'BS', 'Bahamas, The'),
(21, 'BH', 'Bahrain'),
(22, 'BD', 'Bangladesh'),
(23, 'BB', 'Barbados'),
(24, 'PW', 'Palau'),
(25, 'BE', 'Belgium'),
(26, 'BZ', 'Belize'),
(27, 'BM', 'Bermuda'),
(28, 'BT', 'Bhutan'),
(29, 'BY', 'Belarus'),
(30, 'MM', 'Myanmar (ex-Burma)'),
(31, 'BO', 'Bolivia'),
(32, 'BA', 'Bosnia and Herzegovina'),
(33, 'BW', 'Botswana'),
(34, 'BR', 'Brazil'),
(35, 'BN', 'Brunei Darussalam'),
(36, 'BG', 'Bulgaria'),
(37, 'BF', 'Burkina Faso'),
(38, 'BI', 'Burundi'),
(39, 'CI', 'Ivory Coast (see Cote d''Ivoire)'),
(40, 'KH', 'Cambodia'),
(41, 'CM', 'Cameroon'),
(42, 'CA', 'Canada'),
(43, 'CV', 'Cape Verde'),
(44, 'CL', 'Chile'),
(45, 'CN', 'China'),
(46, 'CY', 'Cyprus'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'KP', 'Korea, Demo. People s Rep. of'),
(51, 'KR', 'Korea, (South) Republic of'),
(52, 'CR', 'Costa Rica'),
(53, 'HR', 'Croatia'),
(54, 'CU', 'Cuba'),
(55, 'DK', 'Denmark'),
(56, 'DJ', 'Djibouti'),
(57, 'DM', 'Dominica'),
(58, 'EG', 'Egypt'),
(59, 'AE', 'United Arab Emirates'),
(60, 'EC', 'Ecuador'),
(61, 'ER', 'Eritrea'),
(62, 'ES', 'Spain'),
(63, 'EE', 'Estonia'),
(64, 'US', 'United States'),
(65, 'ET', 'Ethiopia'),
(66, 'FI', 'Finland'),
(67, 'FR', 'France'),
(68, 'GE', 'Georgia'),
(69, 'GA', 'Gabon'),
(70, 'GM', 'Gambia, the'),
(71, 'GH', 'Ghana'),
(72, 'GI', 'Gibraltar'),
(73, 'GR', 'Greece'),
(74, 'GD', 'Grenada'),
(75, 'GL', 'Greenland'),
(76, 'GP', 'Guinea, Equatorial'),
(77, 'GU', 'Guam'),
(78, 'GT', 'Guatemala'),
(79, 'GN', 'Guinea'),
(80, 'GQ', 'Equatorial Guinea'),
(81, 'GW', 'Guinea-Bissau'),
(82, 'GY', 'Guyana'),
(83, 'GF', 'Guiana, French'),
(84, 'HT', 'Haiti'),
(85, 'HN', 'Honduras'),
(86, 'HK', 'Hong Kong, (China)'),
(87, 'HU', 'Hungary'),
(88, 'BV', 'Bouvet Island'),
(89, 'CX', 'Christmas Island'),
(90, 'NF', 'Norfolk Island'),
(91, 'KY', 'Cayman Islands'),
(92, 'CK', 'Cook Islands'),
(93, 'FO', 'Faroe Islands'),
(94, 'FK', 'Falkland Islands (Malvinas)'),
(95, 'FJ', 'Fiji'),
(96, 'GS', 'S. Georgia and S. Sandwich Is.'),
(97, 'HM', 'Heard and McDonald Islands'),
(98, 'MH', 'Marshall Islands'),
(99, 'PN', 'Pitcairn Island'),
(100, 'SB', 'Solomon Islands'),
(101, 'SJ', 'Svalbard and Jan Mayen Islands'),
(102, 'TC', 'Turks and Caicos Islands'),
(103, 'VI', 'Virgin Islands, U.S.'),
(104, 'VG', 'Virgin Islands, British'),
(105, 'CC', 'Cocos (Keeling) Islands'),
(106, 'UM', 'US Minor Outlying Islands'),
(107, 'IN', 'India'),
(108, 'ID', 'Indonesia'),
(109, 'IR', 'Iran, Islamic Republic of'),
(110, 'IQ', 'Iraq'),
(111, 'IE', 'Ireland'),
(112, 'IS', 'Iceland'),
(113, 'IL', 'Israel'),
(114, 'IT', 'Italy'),
(115, 'JM', 'Jamaica'),
(116, 'JP', 'Japan'),
(117, 'JO', 'Jordan'),
(118, 'KZ', 'Kazakhstan'),
(119, 'KE', 'Kenya'),
(120, 'KG', 'Kyrgyzstan'),
(121, 'KI', 'Kiribati'),
(122, 'KW', 'Kuwait'),
(123, 'LA', 'Lao People s Democratic Republic'),
(124, 'LS', 'Lesotho'),
(125, 'LV', 'Latvia'),
(126, 'LB', 'Lebanon'),
(127, 'LR', 'Liberia'),
(128, 'LY', 'Libyan Arab Jamahiriya'),
(129, 'LI', 'Liechtenstein'),
(130, 'LT', 'Lithuania'),
(131, 'LU', 'Luxembourg'),
(132, 'MO', 'Macao, (China)'),
(133, 'MG', 'Madagascar'),
(134, 'MY', 'Malaysia'),
(135, 'MW', 'Malawi'),
(136, 'MV', 'Maldives'),
(137, 'ML', 'Mali'),
(138, 'MT', 'Malta'),
(139, 'MP', 'Northern Mariana Islands'),
(140, 'MA', 'Morocco'),
(141, 'MQ', 'Martinique'),
(142, 'MU', 'Mauritius'),
(143, 'MR', 'Mauritania'),
(144, 'YT', 'Mayotte'),
(145, 'MX', 'Mexico'),
(146, 'FM', 'Micronesia, Federated States of'),
(147, 'MD', 'Moldova, Republic of'),
(148, 'MC', 'Monaco'),
(149, 'MN', 'Mongolia'),
(150, 'MS', 'Montserrat'),
(151, 'MZ', 'Mozambique'),
(152, 'NP', 'Nepal'),
(153, 'NA', 'Namibia'),
(154, 'NR', 'Nauru'),
(155, 'NI', 'Nicaragua'),
(156, 'NE', 'Niger'),
(157, 'NG', 'Nigeria'),
(158, 'NU', 'Niue'),
(159, 'NO', 'Norway'),
(160, 'NC', 'New Caledonia'),
(161, 'NZ', 'New Zealand'),
(162, 'OM', 'Oman'),
(163, 'UG', 'Uganda'),
(164, 'UZ', 'Uzbekistan'),
(165, 'PE', 'Peru'),
(166, 'PK', 'Pakistan'),
(167, 'PA', 'Panama'),
(168, 'PG', 'Papua New Guinea'),
(169, 'PY', 'Paraguay'),
(170, 'NL', 'Netherlands'),
(171, 'PH', 'Philippines'),
(172, 'PL', 'Poland'),
(173, 'PF', 'French Polynesia'),
(174, 'PR', 'Puerto Rico'),
(175, 'PT', 'Portugal'),
(176, 'QA', 'Qatar'),
(177, 'CF', 'Central African Republic'),
(178, 'CD', 'Congo, Democratic Rep. of the'),
(179, 'DO', 'Dominican Republic'),
(180, 'CZ', 'Czech Republic'),
(181, 'RE', 'Reunion'),
(182, 'RO', 'Romania'),
(183, 'GB', 'Saint Pierre and Miquelon'),
(184, 'RU', 'Russia (Russian Federation)'),
(185, 'RW', 'Rwanda'),
(186, 'SN', 'Senegal'),
(187, 'EH', 'Western Sahara'),
(188, 'KN', 'Saint Kitts and Nevis'),
(189, 'SM', 'San Marino'),
(190, 'PM', 'Saint Pierre and Miquelon'),
(191, 'VA', 'Vatican City State (Holy See)'),
(192, 'VC', 'Saint Vincent and the Grenadines'),
(193, 'SH', 'Saint Helena'),
(194, 'LC', 'Saint Lucia'),
(195, 'SV', 'El Salvador'),
(196, 'WS', 'Samoa'),
(197, 'AS', 'American Samoa'),
(198, 'ST', 'Sao Tome and Principe'),
(199, 'SC', 'Seychelles'),
(200, 'SL', 'Sierra Leone'),
(201, 'SG', 'Singapore'),
(202, 'SI', 'Slovenia'),
(203, 'SK', 'Slovakia'),
(204, 'SO', 'Somalia'),
(205, 'SD', 'Sudan'),
(206, 'LK', 'Sri Lanka (ex-Ceilan)'),
(207, 'SE', 'Sweden'),
(208, 'CH', 'Switzerland'),
(209, 'SR', 'Suriname'),
(210, 'SZ', 'Swaziland'),
(211, 'SY', 'Syrian Arab Republic'),
(212, 'TW', 'Taiwan'),
(213, 'TJ', 'Tajikistan'),
(214, 'TZ', 'Tanzania, United Republic of'),
(215, 'TD', 'Chad'),
(216, 'TF', 'French Southern Territories - TF'),
(217, 'IO', 'British Indian Ocean Territory'),
(218, 'TH', 'Thailand'),
(219, 'TL', 'Timor-Leste (East Timor)'),
(220, 'TG', 'Togo'),
(221, 'TK', 'Tokelau'),
(222, 'TO', 'Tonga'),
(223, 'TT', 'Trinidad & Tobago'),
(224, 'TN', 'Tunisia'),
(225, 'TM', 'Turkmenistan'),
(226, 'TR', 'Turkey'),
(227, 'TV', 'Tuvalu'),
(228, 'UA', 'Ukraine'),
(229, 'UY', 'Uruguay'),
(230, 'VU', 'Vanuatu'),
(231, 'VE', 'Venezuela'),
(232, 'VN', 'Viet Nam'),
(233, 'WF', 'Wallis and Futuna'),
(234, 'YE', 'Yemen'),
(235, 'YU', 'Saint Pierre and Miquelon'),
(236, 'ZM', 'Zambia'),
(237, 'ZW', 'Zimbabwe'),
(238, 'MK', 'Macedonia, TFYR');

-- --------------------------------------------------------

--
-- Structure de la table `traduction_centre_interet`
--

CREATE TABLE IF NOT EXISTS `traduction_centre_interet` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_mot_a_traduire` int(11) NOT NULL,
  `id_langue_destination` int(11) NOT NULL,
  `centre_interet_traduit` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `id_traduction` (`id_mot_a_traduire`),
  KEY `id_langue` (`id_langue_destination`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Contenu de la table `traduction_centre_interet`
--

INSERT INTO `traduction_centre_interet` (`ID`, `id_mot_a_traduire`, `id_langue_destination`, `centre_interet_traduit`) VALUES
(1, 1, 2, 'Musique'),
(2, 2, 2, 'Film'),
(3, 3, 2, 'S√©ries TV'),
(4, 4, 2, 'Voyage'),
(5, 5, 2, 'Art'),
(6, 6, 2, 'Informatique'),
(7, 7, 2, 'Sport'),
(8, 8, 2, 'Cuisine'),
(9, 9, 2, 'Jeux Vid√©o'),
(10, 10, 2, 'Mode'),
(11, 11, 2, 'Sciences'),
(12, 12, 2, 'Politique'),
(13, 13, 2, 'Animaux'),
(14, 14, 2, 'Automobile'),
(15, 15, 2, 'Couture'),
(16, 16, 2, 'Astronomie'),
(17, 1, 3, 'Musica'),
(18, 2, 3, 'Pel√≠cula'),
(19, 3, 3, 'Serie'),
(20, 4, 3, 'Viaje'),
(21, 5, 3, 'Arte'),
(22, 6, 3, 'Inform√°tica'),
(23, 7, 3, 'Deporte'),
(24, 8, 3, 'Cocina'),
(25, 9, 3, 'Videojuegos'),
(26, 10, 3, 'Moda'),
(27, 11, 3, 'Ciencias'),
(28, 12, 3, 'Pol√≠tico'),
(29, 13, 3, 'Animales'),
(30, 14, 3, 'Automovil√≠stico'),
(31, 15, 3, 'Costura'),
(32, 16, 3, 'Astronomia'),
(33, 1, 4, 'Musica'),
(34, 2, 4, 'Film'),
(35, 3, 4, 'Series'),
(36, 4, 4, 'Viaggio'),
(37, 5, 4, 'Arte'),
(38, 6, 4, 'Informatica'),
(39, 7, 4, 'Sport'),
(40, 8, 4, 'Cucina'),
(41, 9, 4, 'Videogiochi'),
(42, 10, 4, 'Alla moda'),
(43, 11, 4, 'Scienzas'),
(44, 12, 4, 'Politica'),
(45, 13, 4, 'Animali'),
(46, 14, 4, 'Automobile'),
(47, 15, 4, 'Couture'),
(48, 16, 4, 'Astronomia');

-- --------------------------------------------------------

--
-- Structure de la table `traduction_etat_activite`
--

CREATE TABLE IF NOT EXISTS `traduction_etat_activite` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_mot_a_traduire` int(11) NOT NULL,
  `id_langue_destination` int(11) NOT NULL,
  `etat_activite_traduit` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `id_mot_a_traduire` (`id_mot_a_traduire`),
  KEY `id_langue_destination` (`id_langue_destination`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `traduction_etat_activite`
--

INSERT INTO `traduction_etat_activite` (`ID`, `id_mot_a_traduire`, `id_langue_destination`, `etat_activite_traduit`) VALUES
(1, 1, 2, 'D√©connect√©'),
(2, 2, 2, 'En ligne'),
(3, 3, 2, 'Absent'),
(4, 4, 2, 'Invisible'),
(5, 1, 3, 'Desconectado'),
(6, 2, 3, 'Conectado'),
(7, 3, 3, 'Ausente'),
(8, 4, 3, 'Invisible'),
(9, 1, 4, 'Disconnesso'),
(10, 2, 4, 'Connesso'),
(11, 3, 4, 'Assente'),
(12, 4, 4, 'Invisible');

-- --------------------------------------------------------

--
-- Structure de la table `traduction_langue`
--

CREATE TABLE IF NOT EXISTS `traduction_langue` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_mot_a_traduire` int(11) NOT NULL,
  `id_langue_destination` int(11) NOT NULL,
  `langue_traduite` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `id_traduction` (`id_mot_a_traduire`),
  KEY `id_langue` (`id_langue_destination`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `traduction_langue`
--

INSERT INTO `traduction_langue` (`ID`, `id_mot_a_traduire`, `id_langue_destination`, `langue_traduite`) VALUES
(1, 1, 2, 'Anglais'),
(2, 2, 2, 'Fran√ßais'),
(3, 3, 2, 'Espagnol'),
(4, 4, 2, 'Italien'),
(5, 5, 2, 'Japonais'),
(6, 6, 2, 'Russe'),
(7, 1, 3, 'Ingl√©s'),
(8, 2, 3, 'Franc√©s'),
(9, 3, 3, 'Espa√±ol'),
(10, 4, 3, 'Italiano'),
(11, 5, 3, 'Japon√©s'),
(12, 6, 3, 'Ruso'),
(13, 1, 4, 'Inglese'),
(14, 2, 4, 'Francese'),
(15, 3, 4, 'Spagnolo'),
(16, 4, 4, 'Italiano'),
(17, 5, 4, 'Giapponese'),
(18, 6, 4, 'Russo');

-- --------------------------------------------------------

--
-- Structure de la table `traduction_notification`
--

CREATE TABLE IF NOT EXISTS `traduction_notification` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_notification_a_traduire` int(11) NOT NULL,
  `id_langue_traduction` int(11) NOT NULL,
  `contenu_notification_traduite` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `id_notification_a_traduire` (`id_notification_a_traduire`),
  KEY `id_langue_traduction` (`id_langue_traduction`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `traduction_notification`
--

INSERT INTO `traduction_notification` (`ID`, `id_notification_a_traduire`, `id_langue_traduction`, `contenu_notification_traduite`) VALUES
(1, 1, 2, 'Demande de conversation de'),
(2, 2, 2, 'Nouveau(x) message(s) de'),
(3, 1, 3, 'Aplicaci√≥n de chat'),
(4, 2, 3, 'Nuevo mensaje de'),
(5, 1, 4, 'Richiesta di conversazione'),
(6, 2, 4, 'Nuovo messaggio da');

-- --------------------------------------------------------

--
-- Structure de la table `traduction_pays`
--

CREATE TABLE IF NOT EXISTS `traduction_pays` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_pays_a_traduire` int(11) NOT NULL,
  `id_langue_destination` int(11) NOT NULL,
  `pays_traduit` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `id_pays_a_traduire` (`id_pays_a_traduire`),
  KEY `id_langue_destination` (`id_langue_destination`),
  KEY `id_langue_destination_2` (`id_langue_destination`),
  KEY `id_pays_a_traduire_2` (`id_pays_a_traduire`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=300 ;

--
-- Contenu de la table `traduction_pays`
--

INSERT INTO `traduction_pays` (`ID`, `id_pays_a_traduire`, `id_langue_destination`, `pays_traduit`) VALUES
(1, 1, 2, 'Afghanistan'),
(2, 2, 2, 'Afrique du Sud'),
(3, 3, 2, 'Albanie'),
(4, 4, 2, 'Alg√©rie'),
(5, 5, 2, 'Allemagne'),
(6, 6, 2, 'Andorre'),
(7, 7, 2, 'Angola'),
(8, 8, 2, 'Anguilla'),
(9, 9, 2, 'Antarctique'),
(10, 10, 2, 'Antigua-et-Barbuda'),
(11, 11, 2, 'Antilles n√©erlandaises'),
(12, 12, 2, 'Arabie saoudite'),
(13, 13, 2, 'Argentine'),
(14, 14, 2, 'Arm√©nie'),
(15, 15, 2, 'Aruba'),
(16, 16, 2, 'Australie'),
(17, 17, 2, 'Autriche'),
(18, 18, 2, 'Azerba√Ødjan'),
(19, 19, 2, 'B√©nin'),
(20, 20, 2, 'Bahamas'),
(21, 21, 2, 'Bahre√Øn'),
(22, 22, 2, 'Bangladesh'),
(23, 23, 2, 'Barbade'),
(24, 24, 2, 'Belau'),
(25, 25, 2, 'Belgique'),
(26, 26, 2, 'Belize'),
(27, 27, 2, 'Bermudes'),
(28, 28, 2, 'Bhoutan'),
(29, 29, 2, 'Bi√©lorussie'),
(30, 30, 2, 'Birmanie'),
(31, 31, 2, 'Bolivie'),
(32, 32, 2, 'Bosnie-Herz√©govine'),
(33, 33, 2, 'Botswana'),
(34, 34, 2, 'Br√©sil'),
(35, 35, 2, 'Brunei'),
(36, 36, 2, 'Bulgarie'),
(37, 37, 2, 'Burkina Faso'),
(38, 38, 2, 'Burundi'),
(39, 39, 2, 'C√¥te d''Ivoire'),
(40, 40, 2, 'Cambodge'),
(41, 41, 2, 'Cameroun'),
(42, 42, 2, 'Canada'),
(43, 43, 2, 'Cap-Vert'),
(44, 44, 2, 'Chili'),
(45, 45, 2, 'Chine'),
(46, 46, 2, 'Chypre'),
(47, 47, 2, 'Colombie'),
(48, 48, 2, 'Comores'),
(49, 49, 2, 'Congo'),
(50, 50, 2, 'Cor√©e du Nord'),
(51, 51, 2, 'Cor√©e du Sud'),
(52, 52, 2, 'Costa Rica'),
(53, 53, 2, 'Croatie'),
(54, 54, 2, 'Cuba'),
(55, 55, 2, 'Danemark'),
(56, 56, 2, 'Djibouti'),
(57, 57, 2, 'Dominique'),
(58, 58, 2, '√âgypte'),
(59, 59, 2, '√âmirats arabes unis'),
(60, 60, 2, '√âquateur'),
(61, 61, 2, '√ârythr√©e'),
(62, 62, 2, 'Espagne'),
(63, 63, 2, 'Estonie'),
(64, 64, 2, '√âtats-Unis'),
(65, 65, 2, '√âthiopie'),
(66, 66, 2, 'Finlande'),
(67, 67, 2, 'France'),
(68, 68, 2, 'G√©orgie'),
(69, 69, 2, 'Gabon'),
(70, 70, 2, 'Gambie'),
(71, 71, 2, 'Ghana'),
(72, 72, 2, 'Gibraltar'),
(73, 73, 2, 'Gr√®ce'),
(74, 74, 2, 'Grenade'),
(75, 75, 2, 'Groenland'),
(76, 76, 2, 'Guadeloupe'),
(77, 77, 2, 'Guam'),
(78, 78, 2, 'Guatemala'),
(79, 79, 2, 'Guin√©e'),
(80, 80, 2, 'Guin√©e √©quatoriale'),
(81, 81, 2, 'Guin√©e-Bissao'),
(82, 82, 2, 'Guyana'),
(83, 83, 2, 'Guyane fran√ßaise'),
(84, 84, 2, 'Ha√Øti'),
(85, 85, 2, 'Honduras'),
(86, 86, 2, 'Hong Kong'),
(87, 87, 2, 'Hongrie'),
(88, 88, 2, 'Ile Bouvet'),
(89, 89, 2, 'Ile Christmas'),
(90, 90, 2, 'Ile Norfolk'),
(91, 91, 2, 'Iles Cayman'),
(92, 92, 2, 'Iles Cook'),
(93, 93, 2, 'Iles F√©ro√©'),
(94, 94, 2, 'Iles Falkland'),
(95, 95, 2, 'Iles Fidji'),
(96, 96, 2, 'Iles G√©orgie du Sud et Sandwich du Sud'),
(97, 97, 2, 'Iles Heard et McDonald'),
(98, 98, 2, 'Iles Marshall'),
(99, 99, 2, 'Iles Pitcairn'),
(100, 100, 2, 'Iles Salomon'),
(101, 101, 2, 'Iles Svalbard et Jan Mayen'),
(102, 102, 2, 'Iles Turks-et-Caicos'),
(103, 103, 2, 'Iles Vierges am√©ricaines'),
(104, 104, 2, 'Iles Vierges britanniques'),
(105, 105, 2, 'Iles des Cocos (Keeling)'),
(106, 106, 2, 'Iles mineures √©loign√©es des √âtats-Unis'),
(107, 107, 2, 'Inde'),
(108, 108, 2, 'Indon√©sie'),
(109, 109, 2, 'Iran'),
(110, 110, 2, 'Iraq'),
(111, 111, 2, 'Irlande'),
(112, 112, 2, 'Islande'),
(113, 113, 2, 'Isra√´l'),
(114, 114, 2, 'Italie'),
(115, 115, 2, 'Jama√Øque'),
(116, 116, 2, 'Japon'),
(117, 117, 2, 'Jordanie'),
(118, 118, 2, 'Kazakhstan'),
(119, 119, 2, 'Kenya'),
(120, 120, 2, 'Kirghizistan'),
(121, 121, 2, 'Kiribati'),
(122, 122, 2, 'Kowe√Øt'),
(123, 123, 2, 'Laos'),
(124, 124, 2, 'Lesotho'),
(125, 125, 2, 'Lettonie'),
(126, 126, 2, 'Liban'),
(127, 127, 2, 'Liberia'),
(128, 128, 2, 'Libye'),
(129, 129, 2, 'Liechtenstein'),
(130, 130, 2, 'Lituanie'),
(131, 131, 2, 'Luxembourg'),
(132, 132, 2, 'Macao'),
(133, 133, 2, 'Madagascar'),
(134, 134, 2, 'Malaisie'),
(135, 135, 2, 'Malawi'),
(136, 136, 2, 'Maldives'),
(137, 137, 2, 'Mali'),
(138, 138, 2, 'Malte'),
(139, 139, 2, 'Mariannes du Nord'),
(140, 140, 2, 'Maroc'),
(141, 141, 2, 'Martinique'),
(142, 142, 2, 'Maurice'),
(143, 143, 2, 'Mauritanie'),
(144, 144, 2, 'Mayotte'),
(145, 145, 2, 'Mexique'),
(146, 146, 2, 'Micron√©sie'),
(147, 147, 2, 'Moldavie'),
(148, 148, 2, 'Monaco'),
(149, 149, 2, 'Mongolie'),
(150, 150, 2, 'Montserrat'),
(151, 151, 2, 'Mozambique'),
(152, 152, 2, 'N√©pal'),
(153, 153, 2, 'Namibie'),
(154, 154, 2, 'Nauru'),
(155, 155, 2, 'Nicaragua'),
(156, 156, 2, 'Niger'),
(157, 157, 2, 'Nigeria'),
(158, 158, 2, 'Niou√©'),
(159, 159, 2, 'Norv√®ge'),
(160, 160, 2, 'Nouvelle-Cal√©donie'),
(161, 161, 2, 'Nouvelle-Z√©lande'),
(162, 162, 2, 'Oman'),
(163, 163, 2, 'Ouganda'),
(164, 164, 2, 'Ouzb√©kistan'),
(165, 165, 2, 'P√©rou'),
(166, 166, 2, 'Pakistan'),
(167, 167, 2, 'Panama'),
(168, 168, 2, 'Papouasie-Nouvelle-Guin√©e'),
(169, 169, 2, 'Paraguay'),
(170, 170, 2, 'TABLE_pays-Bas'),
(171, 171, 2, 'Philippines'),
(172, 172, 2, 'Pologne'),
(173, 173, 2, 'Polyn√©sie fran√ßaise'),
(174, 174, 2, 'Porto Rico'),
(175, 175, 2, 'Portugal'),
(176, 176, 2, 'Qatar'),
(177, 177, 2, 'R√©publique centrafricaine'),
(178, 178, 2, 'R√©publique d√©mocratique du Congo'),
(179, 179, 2, 'R√©publique dominicaine'),
(180, 180, 2, 'R√©publique tch√®que'),
(181, 181, 2, 'R√©union'),
(182, 182, 2, 'Roumanie'),
(183, 183, 2, 'Royaume-Uni'),
(184, 184, 2, 'Russie'),
(185, 185, 2, 'Rwanda'),
(186, 186, 2, 'S√©n√©gal'),
(187, 187, 2, 'Sahara occidental'),
(188, 188, 2, 'Saint-Christophe-et-Ni√©v√®s'),
(189, 189, 2, 'Saint-Marin'),
(190, 190, 2, 'Saint-Pierre-et-Miquelon'),
(191, 191, 2, 'Saint-Si√®ge '),
(192, 192, 2, 'Saint-Vincent-et-les-Grenadines'),
(193, 193, 2, 'Sainte-H√©l√®ne'),
(194, 194, 2, 'Sainte-Lucie'),
(195, 195, 2, 'Salvador'),
(196, 196, 2, 'Samoa'),
(197, 197, 2, 'Samoa am√©ricaines'),
(198, 198, 2, 'Sao Tom√©-et-Principe'),
(199, 199, 2, 'Seychelles'),
(200, 200, 2, 'Sierra Leone'),
(201, 201, 2, 'Singapour'),
(202, 202, 2, 'Slov√©nie'),
(203, 203, 2, 'Slovaquie'),
(204, 204, 2, 'Somalie'),
(205, 205, 2, 'Soudan'),
(206, 206, 2, 'Sri Lanka'),
(207, 207, 2, 'Su√®de'),
(208, 208, 2, 'Suisse'),
(209, 209, 2, 'Suriname'),
(210, 210, 2, 'Swaziland'),
(211, 211, 2, 'Syrie'),
(212, 212, 2, 'Ta√Øwan'),
(213, 213, 2, 'Tadjikistan'),
(214, 214, 2, 'Tanzanie'),
(215, 215, 2, 'Tchad'),
(216, 216, 2, 'Terres australes fran√ßaises'),
(217, 217, 2, 'Territoire britannique de l Oc√©an Indien'),
(218, 218, 2, 'Tha√Ølande'),
(219, 219, 2, 'Timor Oriental'),
(220, 220, 2, 'Togo'),
(221, 221, 2, 'Tok√©laou'),
(222, 222, 2, 'Tonga'),
(223, 223, 2, 'Trinit√©-et-Tobago'),
(224, 224, 2, 'Tunisie'),
(225, 225, 2, 'Turkm√©nistan'),
(226, 226, 2, 'Turquie'),
(227, 227, 2, 'Tuvalu'),
(228, 228, 2, 'Ukraine'),
(229, 229, 2, 'Uruguay'),
(230, 230, 2, 'Vanuatu'),
(231, 231, 2, 'Venezuela'),
(232, 232, 2, 'Vi√™t Nam'),
(233, 233, 2, 'Wallis-et-Futuna'),
(234, 234, 2, 'Y√©men'),
(235, 235, 2, 'Yougoslavie'),
(236, 236, 2, 'Zambie'),
(237, 237, 2, 'Zimbabwe'),
(238, 238, 2, 'ex-R√©publique yougoslave de Mac√©doine'),
(239, 0, 2, 'Non renseign√©'),
(240, 0, 3, 'Desconocido'),
(241, 0, 4, 'Sconosciuto'),
(242, 1, 3, 'Afganist√°n'),
(243, 1, 4, 'Afghanistan (Repubblica Islamica del)'),
(244, 2, 3, 'Sud√°frica'),
(245, 2, 4, 'Sudafrica'),
(246, 3, 3, 'Albania'),
(247, 3, 4, 'Albania'),
(248, 4, 3, 'Argelia'),
(249, 4, 4, 'Argelia'),
(250, 5, 3, 'Alemania'),
(251, 5, 4, 'Germania'),
(252, 6, 3, 'Andorra'),
(253, 6, 4, 'Andorra'),
(254, 8, 3, 'Anguilla'),
(255, 8, 4, 'Anguilla'),
(256, 9, 3, 'Ant√°rtida'),
(257, 9, 4, 'Antartide'),
(258, 7, 3, 'Angola'),
(259, 7, 4, 'Angola'),
(260, 10, 3, 'Antigua y Barbuda'),
(261, 10, 4, 'Antigua e Barbuda'),
(262, 11, 3, 'Antillas Holandesas'),
(263, 11, 4, 'Antille Olandesi'),
(264, 12, 3, 'Arabia Saudita'),
(265, 12, 4, 'Arabia Saudita'),
(266, 13, 3, 'Argentina'),
(267, 13, 4, 'Argentina'),
(268, 14, 3, 'Armenia'),
(269, 14, 4, 'Armenia'),
(270, 15, 3, 'Aruba'),
(271, 15, 4, 'Aruba'),
(272, 16, 3, 'Australia'),
(273, 16, 4, 'Australia'),
(274, 17, 3, 'Austria'),
(275, 17, 4, 'Austria'),
(276, 18, 3, 'Azerbaiy√°n'),
(277, 18, 4, 'Azerbaijan'),
(278, 19, 3, 'Benin'),
(279, 19, 4, 'Benin'),
(280, 20, 3, 'Bahamas'),
(281, 20, 4, 'Bahamas'),
(282, 21, 3, 'Bahrein'),
(283, 21, 4, 'Bahrein'),
(284, 22, 3, 'Bangladesh'),
(285, 22, 4, 'Bangladesh'),
(286, 23, 3, 'Barbados'),
(287, 23, 4, 'Barbados'),
(288, 24, 3, 'Palau'),
(289, 24, 4, 'Palau'),
(290, 25, 3, 'B√©lgica'),
(291, 25, 4, 'Belgio'),
(292, 26, 3, 'Belice'),
(293, 26, 4, 'Belize'),
(294, 28, 3, 'Bermudas'),
(295, 28, 4, 'Bermuda'),
(296, 29, 3, 'Bielorrusia'),
(297, 29, 4, 'Bielorussia'),
(298, 30, 3, 'Myanmar, Birmania'),
(299, 30, 4, 'Birmania (Myanmar)');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) NOT NULL,
  `prenom` varchar(60) NOT NULL,
  `pseudo` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `avatar_state` int(11) NOT NULL DEFAULT '0' COMMENT '0 : Pending 1 : approved 2 : refused',
  `age` int(11) NOT NULL,
  `sexe` int(3) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `couleur` varchar(10) NOT NULL,
  `date_inscription` date NOT NULL,
  `derniere_connexion` date NOT NULL,
  `description` text NOT NULL,
  `id_pays` int(11) NOT NULL,
  `id_etat_activite` int(4) NOT NULL COMMENT 'Etat d''activite l''utilisateur',
  `public_key` text NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `pseudo` (`pseudo`),
  KEY `id_pays` (`id_pays`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`ID`, `nom`, `prenom`, `pseudo`, `email`, `password`, `avatar`, `avatar_state`, `age`, `sexe`, `ville`, `couleur`, `date_inscription`, `derniere_connexion`, `description`, `id_pays`, `id_etat_activite`, `public_key`) VALUES
(1, 'Fabrice', 'Teatcher', 'Fabricetea', 'test@test.fr', '489f71f382393834491ba8ac79208a56', '/static/avatar/Fabricetea.jpg', 1, 38, 1, 'Saint-Pierre', '#456545', '2017-02-16', '2017-02-16', 'Couleur pr√©f√©r√©e    Vert\n\nV√©hicule    2005 Kia Sedona ', 183, 1, '-----BEGIN PUBLIC KEY-----\r\nMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDk30xR5WWSBDxSOLYYPBQNjxiB\r\nO5pS89EQaP6hYmsqFczgYq17ft/1ZO6ds6tzYGt3zdL5kqfkE0iJs/5dSQvico3m\r\n+kCkyK7mkzs058eDWvE1mPybPFT206EqpuX1BPJQ6mBycPajNVFqTQj+e1ysqpwn\r\nbMX9Zpk7ss6fF9ZiQQIDAQAB\r\n-----END PUBLIC KEY-----'),
(2, 'M√©rion', 'Pierre-Augustin', 'PAdu77', 'test@test.fr', '851819adaaefda0a86d44e677c04ae87', '/static/avatar/PAdu77.jpg', 0, 24, 2, 'NANCY', '#875698', '2017-02-16', '2017-02-16', 'Couleur pr√©f√©r√©e  Bleu\nV√©hicule   1999 Volvo V70 ', 67, 1, '-----BEGIN PUBLIC KEY-----\r\nMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCyxOWQptiomtb2VdkNFm9al0vO\r\n51Q7PTcxDfYG1dogb00WqAJhQb5jwbGXR2U04mXLdhTY9qFmHgjbbfpUyZh69BqB\r\nTa1oO7X+ItIJKMnNINWlwjZEA/6sgC+3GxZp4NjPXdF0ekqZ3UCASO6GeMSsXX7h\r\nekkLe1DeXh7QMLYv1QIDAQAB\r\n-----END PUBLIC KEY-----'),
(3, 'Robtano', 'Benjamin', 'sapristi', 'test@test.fr', '3549458efc6a3e8c48e5c3d4c7c603e3', '/static/avatar/sapristi.jpg', 0, 68, 3, 'Navas de Estena', '#ab58df', '2017-02-16', '2017-02-16', 'Saperlipopette, sapristipopette !', 62, 2, '-----BEGIN PUBLIC KEY-----\r\nMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDKz+E32nZTFptpqCB/mzvBo4cv\r\n8vWUTy/DVj4DTb8YMizpXuVpceJHQcuj/LyjMGipKihQiODfMS/w992OsA2xWImx\r\nH0Ww7L4XcFE6HAW2snRVU60taDgeDS3G/pY3J6ixhL/n4i5Sc2Yg36ERA2OYkPjJ\r\nWh4wEKQkQaF3AKBAKQIDAQAB\r\n-----END PUBLIC KEY-----'),
(4, 'Panzer', 'Caecilia', 'JesusGR', 'test@test.fr', '1035934c7570550f2a6e4c04dd2aa0a9', '/static/avatar/default.jpg', 0, 18, 2, 'Steinhausen', '#547862', '2017-02-16', '2017-02-16', 'I''m Jesus''s bitch. Pray our Lord and Savior.', 5, 2, '-----BEGIN PUBLIC KEY-----\r\nMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDtfaBjJnX4ItV8y56H0DFQt8Hj\r\nJC7agBVdS1/4/cZkO2rL45ZpYSaB7z5dVlidoqOcDr8qydkSFvkXHJDNijyUUgYr\r\nmjp4YKynGXYPDKaa4dM6bfecraoGUE4tZHmdkisIxVNgfHUjPEm9zVYcp5HXzBDK\r\nLkUvQDYNYDUGLyeZVwIDAQAB\r\n-----END PUBLIC KEY-----'),
(5, 'Kalista', 'Vence', 'kingofimac', 'test@test.fr', '247c94e4e1f436851b7e9046f8f0c8e7', '/static/avatar/kingofimac.png', 1, 29, 0, 'MULHOUSE', '#35A7FF', '2017-02-16', '2017-02-16', 'The kingof the king of France ! Let''s learn languages together !', 67, 2, '-----BEGIN PUBLIC KEY-----\r\nMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCjdnEB+KDyrFCwR4F3oVTeOjhs\r\nBucE6TpxB0r5CMiJzOQ/9+CSzUpvBQTfbNWB1yVtEi2TkLsG/n0FSugRk+pTvmH1\r\nFn2iwUzD5QmFsjI7r0DkduTp75WzmOLscqpBU6eKYpniuRnCDYg/31yTAoK3PVNz\r\ndMkpPbKyYAy/JzLQGQIDAQAB\r\n-----END PUBLIC KEY-----'),
(8, 'Poirier', 'Albracca', 'AlbaPoire', 'test@test.fr', '387695e0c7f944bbde4d70bd426184b9', '/static/avatar/default.jpg', 0, 20, 2, 'CLAMART', '#35A7FF', '2017-03-09', '2017-03-09', 'Favorite color    Orange\r\nVehicle    2004 Maserati Coupe ', 67, 2, '-----BEGIN PUBLIC KEY-----\r\nMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC+SMKCi6nOchhy5Nq0Dv1mh/YI\r\ndH/CVNb+9X+pJOZduxPo9eJ45TD1bpf5lTXrDNsdgVNvKz2NQ4O20OoXbO0T9Q1s\r\nIe/cffMxLGjmlHGmd6MdiajUsAmiXQuyCw7EUvVPaSgrBw5mHHAvVauS7g1u3WvR\r\nxKfojDgNVlfB+Qjq+QIDAQAB\r\n-----END PUBLIC KEY-----'),
(9, 'Birch', 'Corey ', 'Butcher', 'test@test.fr', '37d8a04619a799c21820ae183c42d27e', '/static/avatar/default.jpg', 0, 58, 1, 'LONGCROSS', '#35A7FF', '2017-03-09', '2017-03-09', 'Favorite color ¬† ¬†Silver\nVehicle ¬†2000 BMW 320 ', 5, 1, '-----BEGIN PUBLIC KEY-----\r\nMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC5IelagtmcTMoZphN9Jzh5Ck/8\r\nh7U97lQXVg4y77CZwUAhqchjm+jXiPy3+EL25mRyHkhTdEkiu5URUPMAI/WpQrmF\r\nwWMoVy6HS/17xBcJ2OqgEaAZgFIVyZDcsxt5G08IsKwpuRGMIZIXbbOsE+Zcf6vw\r\nPqZfd6M1zweEgIju6wIDAQAB\r\n-----END PUBLIC KEY-----'),
(10, 'Gougeon', 'Astrid', 'Whangs', 'AstridGougeon@jourrapide.com', '5955970709495922ef47c9008bf828b8', '/static/avatar/Whangs.png', 0, 23, 1, 'Saint-Ouen', '#6ABE83', '0000-00-00', '0000-00-00', 'Clinical&amp;amp;amp;amp;amp;nbsp;laboratory&amp;amp;amp;amp;amp;nbsp;technologist', 67, 1, '-----BEGIN PUBLIC KEY-----\r\nMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDLLgBULr6D+hbI9/oS0tlR+w69\r\n4+1zjzjp14Hwon0J7a0b1wKHQDqFO7EV6JPw0SznoXimyAJ2UaE2/KKFwXhAe5Io\r\nuxFn2t4QmhJRethXNtT2YuYxtw+FlUpbF2aa9z7KS0cSZt8hCQKRA5TkzigQG/1V\r\nEjbdJB3nZ1wAdiLYtwIDAQAB\r\n-----END PUBLIC KEY-----'),
(11, 'Guti√©rrez', 'Milva', 'Commusithad', 'MilvaMoraGutierrez@rhyta.com', '407fef20103fe918ca9131e70ccf616f', '/static/avatar/Commusithad.png', 0, 37, 1, 'Toga', '#E62739', '0000-00-00', '0000-00-00', 'Shopping&amp;nbsp;!', 62, 2, '-----BEGIN PUBLIC KEY-----\r\nMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDgStHECFHJZ7KM/pmhIMIL1ige\r\n1ZyfUh7n7Lc2Fa9C4f+TukV5D8SkinYr9sZmGtvoj52PA4P5OqxehHwb357ewdpX\r\n94vahkSNbTIXdsAI/Mcx5F6NDedu+ac9auzRYP5YWqjgSd5c/5L5UogkLaq+u9fR\r\nWmqwkLvAEPkMwjIfCQIDAQAB\r\n-----END PUBLIC KEY-----'),
(12, 'Loggia', 'Fioretta', 'Alubly', 'FiorettaLoggia@dayrep.com', 'cd1432f168e9df1f6b8489e6b32d7f7c', '/static/avatar/Alubly.png', 0, 39, 1, 'Villapriolo', '#9881F5', '0000-00-00', '0000-00-00', 'Hello!&amp;nbsp;I&amp;nbsp;want&amp;nbsp;to&amp;nbsp;improve&amp;nbsp;my&amp;nbsp;english!', 114, 2, '-----BEGIN PUBLIC KEY-----\r\nMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDBFdZ7nOqYN7nu5DpNo1VBigBp\r\nFY+O0goK1ezoStqo/Q2ffq+d2FvvzNl9rGxTXov4u8d5QGbhMukfWPD7rNcRAAki\r\nTu+RlKaI7kwXuXJRYhefBG9ZJIhvaeoHZNswn2iHZgtfhBVfJkpKfMvJsZfBb2Kf\r\nwcZGjHqpgejAM1a/hQIDAQAB\r\n-----END PUBLIC KEY-----'),
(13, 'Boisclair', 'Gemma', 'Biry1940', 'GemmaBoisclair@teleworm.us', 'd4f7c7de3231a4f24febbe18fb63e101', '/static/avatar/Biry1940.png', 0, 24, 1, 'LOOS', '#35A7FF', '0000-00-00', '0000-00-00', 'Coucou&sbquo;&amp;nbsp;je&amp;nbsp;suis&amp;nbsp;une&amp;nbsp;licorne&amp;nbsp;;)', 67, 1, '-----BEGIN PUBLIC KEY-----\r\nMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDXlF+SfiRbi2sdhukMVUPNcyET\r\nvYwKYryzO1FVHPYC8EY0dGUqo7d/lFRi4wWxJUqRrOUHKkciMamE5sW2BvFjxAhd\r\nf8uRRN19GueTqXHeZhktOZjuXEUGDz9YvZx/fDHO58NRGCMTTcDE1jBlf32CNreC\r\ngzUeMMnO75mpyBgtbQIDAQAB\r\n-----END PUBLIC KEY-----'),
(14, 'Labrosse', 'Victor', 'Baces1953', 'VictorLabrosse@rhyta.com', '126cfbcd4d16ae6d25c9bfcae76d8ee4', '/static/avatar/Baces1953.png', 0, 63, 2, 'LE M√âE-SUR-SEINE', '#60C5BA', '0000-00-00', '0000-00-00', '', 67, 1, '-----BEGIN PUBLIC KEY-----\r\nMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDHReezXmkIKBtjNVzSe0zyDKVG\r\n6CtUYuuEqSHxtPCsJr0d0HxqXTXM2xVLmf6ukwWq39E3Zyw/owjqJLDDV2q2A1f/\r\nl8Vfcc8ZT+mMHIF6WBLOS6jVcBcvkDmDMAPUpHulWFJbVA9rj6mHz52ENM6b/W1I\r\n+NzBYOJjla2I9Xkg5QIDAQAB\r\n-----END PUBLIC KEY-----'),
(15, 'Kelly', 'Richard', 'Theiny', 'RichardTKelly@teleworm.us', '1aa9b0daf8083ffe5eb79731c58f9323', '/static/avatar/Theiny.png', 0, 46, 2, 'Montreal', '#FFE74C', '0000-00-00', '0000-00-00', 'Hello', 42, 2, '-----BEGIN PUBLIC KEY-----\r\nMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDE2057hP8gz8s11UTLsaGAwHvy\r\nT3sYhU2+fpR3lrGoH/U1GoqOq132oUEIQWBR+tG//VAUufVXjGdM0RgrJQWrqPsa\r\n6OAFQl0IrM/QFopAW8v3LCTQIsu/jAGyFJSTOuzN1LzUbHYs6SdF6uwu/QjytGVJ\r\n29hYkOk3ij49uP7FHQIDAQAB\r\n-----END PUBLIC KEY-----'),
(16, 'Pau', 'Lucy', 'Sicisom', 'Sicisom@armyspy.com', 'c684200b1eacfa90b13293e6f781a0a2', '/static/avatar/Sicisom.png', 0, 19, 1, 'Southfield', '#003366', '0000-00-00', '0000-00-00', '', 64, 2, '-----BEGIN PUBLIC KEY-----\r\nMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCs56EXBCyDgVEcUGLt8nnDPtQ7\r\nSHwpuOwj7ZEvds3OrPSeVm/OvhDCpk3Br20LETn0ibqHY6JLoUYd/NNf4nZBBTeE\r\nUgg0CDP2lYVBCIvKetzCaMUJqnzahsQhu6BfrahjCtQoIksRHW5VaOSHOIk9rW/Y\r\nKBsyGpHd/ZENP5VBqQIDAQAB\r\n-----END PUBLIC KEY-----');

-- --------------------------------------------------------

--
-- Structure de la table `user_centre_interet`
--

CREATE TABLE IF NOT EXISTS `user_centre_interet` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_interet` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `id_user` (`id_user`),
  KEY `id_interet` (`id_interet`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=86 ;

--
-- Contenu de la table `user_centre_interet`
--

INSERT INTO `user_centre_interet` (`ID`, `id_user`, `id_interet`) VALUES
(1, 1, 7),
(2, 2, 2),
(3, 3, 5),
(4, 4, 14),
(6, 1, 12),
(7, 3, 1),
(8, 2, 10),
(9, 1, 6),
(10, 1, 8),
(11, 2, 9),
(12, 2, 11),
(13, 3, 10),
(14, 3, 11),
(15, 4, 10),
(16, 1, 2),
(18, 3, 9),
(19, 4, 3),
(20, 4, 16),
(23, 8, 9),
(24, 8, 4),
(25, 8, 6),
(26, 8, 10),
(27, 9, 2),
(28, 9, 15),
(29, 9, 13),
(30, 9, 16),
(31, 1, 16),
(32, 1, 5),
(51, 5, 8),
(52, 5, 2),
(53, 5, 12),
(54, 5, 1),
(55, 5, 9),
(60, 11, 13),
(61, 11, 10),
(62, 11, 3),
(63, 11, 4),
(64, 12, 12),
(65, 12, 7),
(66, 12, 14),
(67, 12, 13),
(68, 13, 9),
(69, 13, 6),
(70, 13, 8),
(71, 13, 5),
(72, 13, 3),
(73, 13, 7),
(74, 15, 5),
(75, 15, 13),
(76, 15, 10),
(77, 15, 1),
(78, 15, 2),
(79, 16, 5),
(80, 16, 13),
(81, 16, 10),
(82, 16, 1),
(83, 16, 3),
(84, 16, 7),
(85, 16, 8);

-- --------------------------------------------------------

--
-- Structure de la table `user_conversation`
--

CREATE TABLE IF NOT EXISTS `user_conversation` (
  `id_user_conversation` int(11) NOT NULL AUTO_INCREMENT,
  `id_conversation` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_user_conversation`),
  KEY `id_conversation` (`id_conversation`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `user_conversation`
--

INSERT INTO `user_conversation` (`id_user_conversation`, `id_conversation`, `id_user`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 2, 4),
(5, 3, 5),
(6, 3, 2),
(8, 5, 1),
(9, 5, 5),
(10, 6, 9),
(11, 6, 1),
(14, 12, 9),
(15, 12, 8),
(16, 13, 5),
(17, 13, 15);

-- --------------------------------------------------------

--
-- Structure de la table `user_langue`
--

CREATE TABLE IF NOT EXISTS `user_langue` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_langue` int(11) NOT NULL,
  `maitrise` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `id_user` (`id_user`),
  KEY `id_langue` (`id_langue`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- Contenu de la table `user_langue`
--

INSERT INTO `user_langue` (`ID`, `id_user`, `id_langue`, `maitrise`) VALUES
(1, 3, 5, 1),
(2, 3, 3, 1),
(5, 1, 2, 1),
(6, 1, 6, 2),
(7, 2, 3, 1),
(8, 2, 1, 2),
(11, 3, 4, 1),
(12, 2, 5, 2),
(13, 4, 6, 1),
(14, 4, 5, 2),
(17, 1, 5, 1),
(18, 1, 4, 1),
(19, 2, 4, 2),
(20, 3, 6, 2),
(21, 4, 1, 1),
(22, 4, 3, 2),
(24, 8, 2, 2),
(25, 9, 6, 1),
(26, 9, 3, 1),
(43, 5, 4, 1),
(44, 5, 6, 1),
(45, 5, 3, 2),
(46, 5, 2, 2),
(47, 5, 5, 2),
(50, 11, 3, 2),
(51, 11, 1, 1),
(52, 12, 4, 2),
(53, 12, 2, 2),
(54, 12, 1, 1),
(55, 13, 2, 2),
(56, 13, 3, 2),
(57, 13, 1, 1),
(58, 13, 5, 1),
(59, 13, 6, 1),
(60, 15, 5, 1),
(61, 15, 2, 2),
(62, 15, 1, 2),
(63, 15, 6, 1),
(64, 15, 4, 2),
(65, 15, 3, 1),
(66, 16, 5, 2),
(67, 16, 2, 1),
(68, 16, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user_notification`
--

CREATE TABLE IF NOT EXISTS `user_notification` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_user1` int(11) NOT NULL COMMENT 'Emetteur',
  `ID_user2` int(11) NOT NULL COMMENT 'Recepteur',
  `date` datetime NOT NULL,
  `id_notification` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_user1` (`ID_user1`),
  KEY `ID_user2` (`ID_user2`),
  KEY `id_notification` (`id_notification`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `user_notification`
--

INSERT INTO `user_notification` (`ID`, `ID_user1`, `ID_user2`, `date`, `id_notification`) VALUES
(1, 2, 1, '2017-03-06 00:00:00', 1),
(2, 3, 4, '2017-03-06 00:00:00', 1),
(8, 4, 2, '2017-03-10 00:00:00', 2),
(9, 3, 8, '2017-03-10 12:11:14', 2),
(19, 2, 3, '2017-03-10 12:25:55', 1),
(20, 5, 13, '2017-03-16 14:31:49', 1),
(21, 5, 9, '2017-03-16 14:32:06', 1),
(22, 15, 2, '2017-03-16 14:43:45', 1),
(23, 15, 11, '2017-03-16 14:43:48', 1),
(25, 16, 11, '2017-03-16 14:54:11', 1),
(26, 16, 12, '2017-03-16 14:54:18', 1);

--
-- Contraintes pour les tables export√©es
--

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`id_conversation`) REFERENCES `conversation` (`ID`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`ID`);

--
-- Contraintes pour la table `traduction_centre_interet`
--
ALTER TABLE `traduction_centre_interet`
  ADD CONSTRAINT `traduction_centre_interet_ibfk_1` FOREIGN KEY (`id_mot_a_traduire`) REFERENCES `centre_interet` (`ID`),
  ADD CONSTRAINT `traduction_centre_interet_ibfk_2` FOREIGN KEY (`id_langue_destination`) REFERENCES `langue` (`ID`);

--
-- Contraintes pour la table `traduction_etat_activite`
--
ALTER TABLE `traduction_etat_activite`
  ADD CONSTRAINT `traduction_etat_activite_ibfk_1` FOREIGN KEY (`id_mot_a_traduire`) REFERENCES `etat_activite` (`ID`),
  ADD CONSTRAINT `traduction_etat_activite_ibfk_2` FOREIGN KEY (`id_langue_destination`) REFERENCES `langue` (`ID`);

--
-- Contraintes pour la table `traduction_langue`
--
ALTER TABLE `traduction_langue`
  ADD CONSTRAINT `traduction_langue_ibfk_1` FOREIGN KEY (`id_mot_a_traduire`) REFERENCES `langue` (`ID`),
  ADD CONSTRAINT `traduction_langue_ibfk_2` FOREIGN KEY (`id_langue_destination`) REFERENCES `langue` (`ID`);

--
-- Contraintes pour la table `traduction_notification`
--
ALTER TABLE `traduction_notification`
  ADD CONSTRAINT `traduction_notification_ibfk_1` FOREIGN KEY (`id_notification_a_traduire`) REFERENCES `notification` (`ID`),
  ADD CONSTRAINT `traduction_notification_ibfk_2` FOREIGN KEY (`id_langue_traduction`) REFERENCES `langue` (`ID`);

--
-- Contraintes pour la table `traduction_pays`
--
ALTER TABLE `traduction_pays`
  ADD CONSTRAINT `traduction_pays_ibfk_1` FOREIGN KEY (`id_pays_a_traduire`) REFERENCES `table_pays` (`id_pays`),
  ADD CONSTRAINT `traduction_pays_ibfk_2` FOREIGN KEY (`id_langue_destination`) REFERENCES `langue` (`ID`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_pays`) REFERENCES `table_pays` (`id_pays`);

--
-- Contraintes pour la table `user_centre_interet`
--
ALTER TABLE `user_centre_interet`
  ADD CONSTRAINT `user_centre_interet_ibfk_1` FOREIGN KEY (`id_interet`) REFERENCES `centre_interet` (`ID`),
  ADD CONSTRAINT `user_centre_interet_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`ID`);

--
-- Contraintes pour la table `user_conversation`
--
ALTER TABLE `user_conversation`
  ADD CONSTRAINT `user_conversation_ibfk_1` FOREIGN KEY (`id_conversation`) REFERENCES `conversation` (`ID`),
  ADD CONSTRAINT `user_conversation_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`ID`);

--
-- Contraintes pour la table `user_langue`
--
ALTER TABLE `user_langue`
  ADD CONSTRAINT `user_langue_ibfk_1` FOREIGN KEY (`id_langue`) REFERENCES `langue` (`ID`),
  ADD CONSTRAINT `user_langue_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`ID`);

--
-- Contraintes pour la table `user_notification`
--
ALTER TABLE `user_notification`
  ADD CONSTRAINT `user_notification_ibfk_1` FOREIGN KEY (`ID_user1`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `user_notification_ibfk_2` FOREIGN KEY (`ID_user2`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `user_notification_ibfk_3` FOREIGN KEY (`id_notification`) REFERENCES `notification` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
