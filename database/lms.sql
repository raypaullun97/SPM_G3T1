-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 05, 2021 at 09:00 AM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `testing` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chatadmins`
--

DROP TABLE IF EXISTS `chatadmins`;
CREATE TABLE IF NOT EXISTS `chatadmins` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` enum('0','1','2') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `username` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `joined` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `country` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `about` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sex` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dob` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `picname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chatadmins`
--

INSERT INTO `chatadmins` (`id`, `status`, `username`, `password`, `email`, `name`, `joined`, `country`, `about`, `sex`, `dob`, `picname`) VALUES
(1, '0', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'limweilun1997@gmail.com', 'Wchat Admin', '2016-09-16 08:46:04', 'Canada', 'Developed with  by Deven Katariya for developers', 'female', '', 'Wchat.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `chatcountries`
--

DROP TABLE IF EXISTS `chatcountries`;
CREATE TABLE IF NOT EXISTS `chatcountries` (
  `iso` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `name` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `printable_name` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `iso3` char(3) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`iso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chatcountries`
--

INSERT INTO `chatcountries` (`iso`, `name`, `printable_name`, `iso3`, `numcode`) VALUES
('AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4),
('AL', 'ALBANIA', 'Albania', 'ALB', 8),
('DZ', 'ALGERIA', 'Algeria', 'DZA', 12),
('AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16),
('AD', 'ANDORRA', 'Andorra', 'AND', 20),
('AO', 'ANGOLA', 'Angola', 'AGO', 24),
('AI', 'ANGUILLA', 'Anguilla', 'AIA', 660),
('AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL),
('AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28),
('AR', 'ARGENTINA', 'Argentina', 'ARG', 32),
('AM', 'ARMENIA', 'Armenia', 'ARM', 51),
('AW', 'ARUBA', 'Aruba', 'ABW', 533),
('AU', 'AUSTRALIA', 'Australia', 'AUS', 36),
('AT', 'AUSTRIA', 'Austria', 'AUT', 40),
('AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31),
('BS', 'BAHAMAS', 'Bahamas', 'BHS', 44),
('BH', 'BAHRAIN', 'Bahrain', 'BHR', 48),
('BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50),
('BB', 'BARBADOS', 'Barbados', 'BRB', 52),
('BY', 'BELARUS', 'Belarus', 'BLR', 112),
('BE', 'BELGIUM', 'Belgium', 'BEL', 56),
('BZ', 'BELIZE', 'Belize', 'BLZ', 84),
('BJ', 'BENIN', 'Benin', 'BEN', 204),
('BM', 'BERMUDA', 'Bermuda', 'BMU', 60),
('BT', 'BHUTAN', 'Bhutan', 'BTN', 64),
('BO', 'BOLIVIA', 'Bolivia', 'BOL', 68),
('BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70),
('BW', 'BOTSWANA', 'Botswana', 'BWA', 72),
('BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL),
('BR', 'BRAZIL', 'Brazil', 'BRA', 76),
('IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL),
('BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96),
('BG', 'BULGARIA', 'Bulgaria', 'BGR', 100),
('BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854),
('BI', 'BURUNDI', 'Burundi', 'BDI', 108),
('KH', 'CAMBODIA', 'Cambodia', 'KHM', 116),
('CM', 'CAMEROON', 'Cameroon', 'CMR', 120),
('CA', 'CANADA', 'Canada', 'CAN', 124),
('CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132),
('KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136),
('CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140),
('TD', 'CHAD', 'Chad', 'TCD', 148),
('CL', 'CHILE', 'Chile', 'CHL', 152),
('CN', 'CHINA', 'China', 'CHN', 156),
('CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL),
('CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL),
('CO', 'COLOMBIA', 'Colombia', 'COL', 170),
('KM', 'COMOROS', 'Comoros', 'COM', 174),
('CG', 'CONGO', 'Congo', 'COG', 178),
('CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180),
('CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184),
('CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188),
('CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384),
('HR', 'CROATIA', 'Croatia', 'HRV', 191),
('CU', 'CUBA', 'Cuba', 'CUB', 192),
('CY', 'CYPRUS', 'Cyprus', 'CYP', 196),
('CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203),
('DK', 'DENMARK', 'Denmark', 'DNK', 208),
('DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262),
('DM', 'DOMINICA', 'Dominica', 'DMA', 212),
('DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214),
('EC', 'ECUADOR', 'Ecuador', 'ECU', 218),
('EG', 'EGYPT', 'Egypt', 'EGY', 818),
('SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222),
('GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226),
('ER', 'ERITREA', 'Eritrea', 'ERI', 232),
('EE', 'ESTONIA', 'Estonia', 'EST', 233),
('ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231),
('FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238),
('FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234),
('FJ', 'FIJI', 'Fiji', 'FJI', 242),
('FI', 'FINLAND', 'Finland', 'FIN', 246),
('FR', 'FRANCE', 'France', 'FRA', 250),
('GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254),
('PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258),
('TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL),
('GA', 'GABON', 'Gabon', 'GAB', 266),
('GM', 'GAMBIA', 'Gambia', 'GMB', 270),
('GE', 'GEORGIA', 'Georgia', 'GEO', 268),
('DE', 'GERMANY', 'Germany', 'DEU', 276),
('GH', 'GHANA', 'Ghana', 'GHA', 288),
('GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292),
('GR', 'GREECE', 'Greece', 'GRC', 300),
('GL', 'GREENLAND', 'Greenland', 'GRL', 304),
('GD', 'GRENADA', 'Grenada', 'GRD', 308),
('GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312),
('GU', 'GUAM', 'Guam', 'GUM', 316),
('GT', 'GUATEMALA', 'Guatemala', 'GTM', 320),
('GN', 'GUINEA', 'Guinea', 'GIN', 324),
('GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624),
('GY', 'GUYANA', 'Guyana', 'GUY', 328),
('HT', 'HAITI', 'Haiti', 'HTI', 332),
('HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL),
('VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336),
('HN', 'HONDURAS', 'Honduras', 'HND', 340),
('HK', 'HONG KONG', 'Hong Kong', 'HKG', 344),
('HU', 'HUNGARY', 'Hungary', 'HUN', 348),
('IS', 'ICELAND', 'Iceland', 'ISL', 352),
('IN', 'INDIA', 'India', 'IND', 356),
('ID', 'INDONESIA', 'Indonesia', 'IDN', 360),
('IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364),
('IQ', 'IRAQ', 'Iraq', 'IRQ', 368),
('IE', 'IRELAND', 'Ireland', 'IRL', 372),
('IL', 'ISRAEL', 'Israel', 'ISR', 376),
('IT', 'ITALY', 'Italy', 'ITA', 380),
('JM', 'JAMAICA', 'Jamaica', 'JAM', 388),
('JP', 'JAPAN', 'Japan', 'JPN', 392),
('JO', 'JORDAN', 'Jordan', 'JOR', 400),
('KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398),
('KE', 'KENYA', 'Kenya', 'KEN', 404),
('KI', 'KIRIBATI', 'Kiribati', 'KIR', 296),
('KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408),
('KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410),
('KW', 'KUWAIT', 'Kuwait', 'KWT', 414),
('KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417),
('LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418),
('LV', 'LATVIA', 'Latvia', 'LVA', 428),
('LB', 'LEBANON', 'Lebanon', 'LBN', 422),
('LS', 'LESOTHO', 'Lesotho', 'LSO', 426),
('LR', 'LIBERIA', 'Liberia', 'LBR', 430),
('LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434),
('LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438),
('LT', 'LITHUANIA', 'Lithuania', 'LTU', 440),
('LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442),
('MO', 'MACAO', 'Macao', 'MAC', 446),
('MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807),
('MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450),
('MW', 'MALAWI', 'Malawi', 'MWI', 454),
('MY', 'MALAYSIA', 'Malaysia', 'MYS', 458),
('MV', 'MALDIVES', 'Maldives', 'MDV', 462),
('ML', 'MALI', 'Mali', 'MLI', 466),
('MT', 'MALTA', 'Malta', 'MLT', 470),
('MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584),
('MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474),
('MR', 'MAURITANIA', 'Mauritania', 'MRT', 478),
('MU', 'MAURITIUS', 'Mauritius', 'MUS', 480),
('YT', 'MAYOTTE', 'Mayotte', NULL, NULL),
('MX', 'MEXICO', 'Mexico', 'MEX', 484),
('FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583),
('MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498),
('MC', 'MONACO', 'Monaco', 'MCO', 492),
('MN', 'MONGOLIA', 'Mongolia', 'MNG', 496),
('MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500),
('MA', 'MOROCCO', 'Morocco', 'MAR', 504),
('MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508),
('MM', 'MYANMAR', 'Myanmar', 'MMR', 104),
('NA', 'NAMIBIA', 'Namibia', 'NAM', 516),
('NR', 'NAURU', 'Nauru', 'NRU', 520),
('NP', 'NEPAL', 'Nepal', 'NPL', 524),
('NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528),
('AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530),
('NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540),
('NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554),
('NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558),
('NE', 'NIGER', 'Niger', 'NER', 562),
('NG', 'NIGERIA', 'Nigeria', 'NGA', 566),
('NU', 'NIUE', 'Niue', 'NIU', 570),
('NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574),
('MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580),
('NO', 'NORWAY', 'Norway', 'NOR', 578),
('OM', 'OMAN', 'Oman', 'OMN', 512),
('PK', 'PAKISTAN', 'Pakistan', 'PAK', 586),
('PW', 'PALAU', 'Palau', 'PLW', 585),
('PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL),
('PA', 'PANAMA', 'Panama', 'PAN', 591),
('PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598),
('PY', 'PARAGUAY', 'Paraguay', 'PRY', 600),
('PE', 'PERU', 'Peru', 'PER', 604),
('PH', 'PHILIPPINES', 'Philippines', 'PHL', 608),
('PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612),
('PL', 'POLAND', 'Poland', 'POL', 616),
('PT', 'PORTUGAL', 'Portugal', 'PRT', 620),
('PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630),
('QA', 'QATAR', 'Qatar', 'QAT', 634),
('RE', 'REUNION', 'Reunion', 'REU', 638),
('RO', 'ROMANIA', 'Romania', 'ROM', 642),
('RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643),
('RW', 'RWANDA', 'Rwanda', 'RWA', 646),
('SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654),
('KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659),
('LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662),
('PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666),
('VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670),
('WS', 'SAMOA', 'Samoa', 'WSM', 882),
('SM', 'SAN MARINO', 'San Marino', 'SMR', 674),
('ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678),
('SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682),
('SN', 'SENEGAL', 'Senegal', 'SEN', 686),
('CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL),
('SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690),
('SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694),
('SG', 'SINGAPORE', 'Singapore', 'SGP', 702),
('SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703),
('SI', 'SLOVENIA', 'Slovenia', 'SVN', 705),
('SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90),
('SO', 'SOMALIA', 'Somalia', 'SOM', 706),
('ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710),
('GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL),
('ES', 'SPAIN', 'Spain', 'ESP', 724),
('LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144),
('SD', 'SUDAN', 'Sudan', 'SDN', 736),
('SR', 'SURINAME', 'Suriname', 'SUR', 740),
('SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744),
('SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748),
('SE', 'SWEDEN', 'Sweden', 'SWE', 752),
('CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756),
('SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760),
('TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158),
('TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762),
('TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834),
('TH', 'THAILAND', 'Thailand', 'THA', 764),
('TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL),
('TG', 'TOGO', 'Togo', 'TGO', 768),
('TK', 'TOKELAU', 'Tokelau', 'TKL', 772),
('TO', 'TONGA', 'Tonga', 'TON', 776),
('TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780),
('TN', 'TUNISIA', 'Tunisia', 'TUN', 788),
('TR', 'TURKEY', 'Turkey', 'TUR', 792),
('TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795),
('TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796),
('TV', 'TUVALU', 'Tuvalu', 'TUV', 798),
('UG', 'UGANDA', 'Uganda', 'UGA', 800),
('UA', 'UKRAINE', 'Ukraine', 'UKR', 804),
('AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784),
('GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826),
('US', 'UNITED STATES', 'United States', 'USA', 840),
('UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL),
('UY', 'URUGUAY', 'Uruguay', 'URY', 858),
('UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860),
('VU', 'VANUATU', 'Vanuatu', 'VUT', 548),
('VE', 'VENEZUELA', 'Venezuela', 'VEN', 862),
('VN', 'VIET NAM', 'Viet Nam', 'VNM', 704),
('VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92),
('VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850),
('WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876),
('EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732),
('YE', 'YEMEN', 'Yemen', 'YEM', 887),
('ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894),
('ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716);

-- --------------------------------------------------------

--
-- Table structure for table `chatmessages`
--

DROP TABLE IF EXISTS `chatmessages`;
CREATE TABLE IF NOT EXISTS `chatmessages` (
  `message_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `from_id` varchar(40) NOT NULL DEFAULT '',
  `to_id` varchar(50) NOT NULL DEFAULT '',
  `from_uname` varchar(225) NOT NULL DEFAULT '',
  `to_uname` varchar(255) NOT NULL DEFAULT '',
  `message_content` longtext NOT NULL,
  `message_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` tinyint(1) NOT NULL DEFAULT '0',
  `seen` enum('0','1') NOT NULL DEFAULT '0',
  `message_type` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chatuserdata`
--

DROP TABLE IF EXISTS `chatuserdata`;
CREATE TABLE IF NOT EXISTS `chatuserdata` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` enum('0','1','2') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `username` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `joined` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `country` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `about` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sex` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dob` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `picname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'avatar_default.png',
  `oauth_provider` enum('','facebook','google','twitter') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `oauth_uid` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `oauth_link` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chatuserdata`
--

INSERT INTO `chatuserdata` (`id`, `status`, `username`, `password`, `email`, `name`, `joined`, `country`, `about`, `sex`, `dob`, `picname`, `oauth_provider`, `oauth_uid`, `oauth_link`) VALUES
(1, '0', 'raypaullun', '21232f297a57a5a743894a0e4a801fc3', 'lwl_1997@hotmail.com', 'Weilun Lim', '2021-11-05 04:41:27', '', '', '', '', 'avatar_default.png', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `class_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `capacity` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_register_date` date NOT NULL,
  `end_register_date` date NOT NULL,
  `engineer_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`class_id`,`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `course_id`, `capacity`, `day`, `start_time`, `end_time`, `start_date`, `end_date`, `start_register_date`, `end_register_date`, `engineer_id`) VALUES
('G1', 'IS216', 3, 3, '16:00:00', '17:00:00', '2021-12-03', '2021-12-05', '2021-10-16', '2021-11-30', '3'),
('G1', 'IS424', 4, 3, '14:30:00', '17:30:00', '2021-10-28', '2021-10-28', '2021-09-30', '2021-10-29', '3'),
('G1', 'IS460', 1, 2, '12:00:00', '15:15:00', '2021-10-17', '2021-10-31', '2021-09-30', '2021-10-10', '3'),
('G1', 'IS461', 20, 3, '12:00:00', '15:15:00', '2021-11-01', '2021-11-03', '2021-10-10', '2021-10-30', '3'),
('G2', 'IS212', 40, 5, '12:00:00', '15:15:00', '2021-10-16', '2021-12-01', '2021-09-30', '2021-11-12', '3'),
('G2', 'IS424', 1, 3, '14:30:00', '17:30:00', '2021-11-27', '2021-12-12', '2021-10-01', '2021-10-17', '3'),
('G3', 'IS212', 3, 2, '14:30:00', '17:30:00', '2021-10-30', '2021-12-12', '2021-09-30', '2021-11-12', '3'),
('G3', 'IS424', 1, 3, '14:30:00', '17:30:00', '2021-10-19', '2021-10-20', '2021-10-01', '2021-10-16', '3'),
('G4', 'IS212', 1, 3, '12:00:00', '15:15:00', '2021-12-10', '2021-12-07', '2021-09-30', '2021-11-12', '3');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `course_id` varchar(50) NOT NULL,
  `course_name` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `description`) VALUES
('IS111', 'Programming', 'Good'),
('IS211', 'IDP', 'Ideation'),
('IS212', 'SPM', 'Software Project Management'),
('IS216', 'WAD2', 'Code and Code'),
('IS424', 'DM', 'Data Mining'),
('IS446', 'MCRA', 'Managing Customer Relations Management'),
('IS453', 'FA', 'Financial Analytics'),
('IS460', 'ML', 'Machine Learning'),
('IS461', 'Advanced Cloud Computing', 'For advanced learners');

-- --------------------------------------------------------

--
-- Table structure for table `course_prerequisite`
--

DROP TABLE IF EXISTS `course_prerequisite`;
CREATE TABLE IF NOT EXISTS `course_prerequisite` (
  `course_id` varchar(50) NOT NULL,
  `prerequisite` varchar(50) NOT NULL,
  PRIMARY KEY (`course_id`,`prerequisite`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_prerequisite`
--

INSERT INTO `course_prerequisite` (`course_id`, `prerequisite`) VALUES
('IS216', 'IS111'),
('IS446', 'IS424');

-- --------------------------------------------------------

--
-- Table structure for table `course_status`
--

DROP TABLE IF EXISTS `course_status`;
CREATE TABLE IF NOT EXISTS `course_status` (
  `engineer_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`engineer_id`,`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_status`
--

INSERT INTO `course_status` (`engineer_id`, `course_id`, `status`) VALUES
('1', 'IS111', 'Completed'),
('1', 'IS211', 'Pending'),
('1', 'IS212', 'Pending'),
('1', 'IS216', 'Pending'),
('1', 'IS460', 'Completed'),
('2', 'IS212', 'Pending'),
('4', 'IS111', 'Completed'),
('5', 'IS111', 'Completed'),
('6', 'IS111', 'Completed'),
('6', 'IS216', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `engineer`
--

DROP TABLE IF EXISTS `engineer`;
CREATE TABLE IF NOT EXISTS `engineer` (
  `engineer_id` varchar(50) NOT NULL,
  `engineer_name` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`engineer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `engineer`
--

INSERT INTO `engineer` (`engineer_id`, `engineer_name`, `username`, `first_name`, `last_name`, `status`, `designation`, `department`) VALUES
('1', 'weilun', 'lwl_1997@hotmail.com', 'wl', 'lim', 'engineer', NULL, NULL),
('2', 'james', 'james123@lms.com', 'james', 'ong', 'engineer', NULL, NULL),
('3', 'kankan', 'kankanzhou123@lms.com', 'kankan', 'zhou', 'senior engineer', NULL, NULL),
('4', 'jia cheng', 'jcteo@lms.com', 'jc', 'teo', 'engineer', NULL, NULL),
('5', 'ian', 'ian@lms.com', 'ian', 'leong', 'engineer', NULL, NULL),
('6', 'cheryl', 'cheryl@lms.com', 'cheryl', 'chee', 'engineer', NULL, NULL),
('7', 'jia xiang', 'jiaxiang@lms.com', 'jiaxiang', 'leow', 'engineer', NULL, NULL),
('8', 'testing', 'testing@lms.com', 'test', 'ing', 'engineer', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `engineer_badges`
--

DROP TABLE IF EXISTS `engineer_badges`;
CREATE TABLE IF NOT EXISTS `engineer_badges` (
  `engineer_id` varchar(50) NOT NULL,
  `badge_name` varchar(50) NOT NULL,
  PRIMARY KEY (`engineer_id`,`badge_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

DROP TABLE IF EXISTS `forum`;
CREATE TABLE IF NOT EXISTS `forum` (
  `forum_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` varchar(50) DEFAULT NULL,
  `description` varchar(256) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `class_id` varchar(45) NOT NULL,
  PRIMARY KEY (`forum_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`forum_id`, `course_id`, `description`, `type`, `class_id`) VALUES
(1, '', 'Open Forum', 'open', ''),
(2, 'IS460', 'Forum', NULL, 'G1');

-- --------------------------------------------------------

--
-- Table structure for table `hr`
--

DROP TABLE IF EXISTS `hr`;
CREATE TABLE IF NOT EXISTS `hr` (
  `hr_id` varchar(50) NOT NULL,
  `hr_name` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  PRIMARY KEY (`hr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `learner_enrollment`
--

DROP TABLE IF EXISTS `learner_enrollment`;
CREATE TABLE IF NOT EXISTS `learner_enrollment` (
  `enrollment_id` int(11) NOT NULL AUTO_INCREMENT,
  `engineer_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `class_id` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`enrollment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `learner_enrollment`
--

INSERT INTO `learner_enrollment` (`enrollment_id`, `engineer_id`, `course_id`, `class_id`, `status`, `type`) VALUES
(34, '2', 'IS212', 'G4', 'Enrolled', NULL),
(35, '2', 'IS424', 'G2', 'Enrolled', NULL),
(36, '1', 'IS460', 'G1', 'Enrolled', NULL),
(37, '1', 'IS212', 'G2', 'Withdrawn', 'Self'),
(38, '1', 'IS211', 'G1', 'Withdrawn', ''),
(39, '1', 'IS216', 'G1', 'Withdrawn', 'Self'),
(60, '1', 'IS424', 'G3', 'Withdrawn', 'Self'),
(63, '1', 'IS424', 'G1', 'Enrolled', 'Self'),
(66, '1', 'IS212', 'G3', 'Withdrawn', 'Self');

-- --------------------------------------------------------

--
-- Table structure for table `learning_material`
--

DROP TABLE IF EXISTS `learning_material`;
CREATE TABLE IF NOT EXISTS `learning_material` (
  `learning_material_id` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `class_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  `type` varchar(50) NOT NULL,
  `document_name` varchar(256) NOT NULL,
  PRIMARY KEY (`learning_material_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `learning_material`
--

INSERT INTO `learning_material` (`learning_material_id`, `section_id`, `class_id`, `course_id`, `description`, `type`, `document_name`) VALUES
(1, 4, 'G2', 'IS212', 'Week 1', '.pptx', 'Data Mining'),
(2, 5, 'G2', 'IS212', 'Week 2', '.pptx', 'Data Mining2'),
(3, 6, 'G2', 'IS212', 'for week 3', '.pptx', 'Data Mining3');

-- --------------------------------------------------------

--
-- Table structure for table `learning_material_complete`
--

DROP TABLE IF EXISTS `learning_material_complete`;
CREATE TABLE IF NOT EXISTS `learning_material_complete` (
  `learning_material_id` varchar(50) NOT NULL,
  `engineer_id` varchar(50) NOT NULL,
  PRIMARY KEY (`learning_material_id`,`engineer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `thread_id` varchar(50) NOT NULL,
  `p_description` varchar(256) NOT NULL,
  `engineer_id` varchar(50) NOT NULL,
  `post_time` time NOT NULL,
  `post_date` date NOT NULL,
  PRIMARY KEY (`post_id`,`thread_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `thread_id`, `p_description`, `engineer_id`, `post_time`, `post_date`) VALUES
(1, '1', 'James looking for study mates ', '2', '21:39:39', '2021-10-10'),
(2, '1', 'Hi, i looking for study group', '1', '02:20:05', '2021-11-03'),
(3, '1', 'Testing', '4', '21:39:39', '2021-11-03'),
(4, '6', 'Hi, i looking for study group', '4', '21:39:39', '2021-11-03'),
(5, '6', 'Hi, i looking for study group', '1', '03:33:17', '2021-11-03');

-- --------------------------------------------------------

--
-- Table structure for table `qualified_courses`
--

DROP TABLE IF EXISTS `qualified_courses`;
CREATE TABLE IF NOT EXISTS `qualified_courses` (
  `engineer_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  PRIMARY KEY (`engineer_id`,`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qualified_courses`
--

INSERT INTO `qualified_courses` (`engineer_id`, `course_id`) VALUES
('3', 'IS111'),
('3', 'IS212'),
('3', 'IS216'),
('3', 'IS424'),
('3', 'IS446'),
('3', 'IS453'),
('3', 'IS461'),
('8', 'IS424');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `quiz_id` int(11) NOT NULL,
  `question_id` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  `option_1` varchar(50) NOT NULL,
  `option_2` varchar(50) NOT NULL,
  `option_3` varchar(50) NOT NULL,
  `option_4` varchar(50) NOT NULL,
  `answer` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`quiz_id`,`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`quiz_id`, `question_id`, `description`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`, `type`) VALUES
(1, '1', 'Did iron man die?', 'True', 'False', 'NIL', 'NIL', 'Answer 1', 'True or False'),
(1, '2', 'Did spiderman die?', 'True', 'False', 'NIL', 'NIL', 'Answer 2', 'True or False');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `quiz_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` varchar(50) NOT NULL,
  `class_id` varchar(50) NOT NULL,
  `section_id` int(11) NOT NULL,
  `engineer_id` varchar(50) NOT NULL,
  `passing_mark` int(11) NOT NULL,
  `time_limit` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `quiz_name` varchar(50) NOT NULL,
  PRIMARY KEY (`quiz_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `course_id`, `class_id`, `section_id`, `engineer_id`, `passing_mark`, `time_limit`, `type`, `quiz_name`) VALUES
(1, 'IS212', 'G2', 4, '3', 1, 1, '', 'MARVEL'),
(2, 'IS212', 'G2', 5, '3', 2, 4, '', 'MARVEL');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `section_name` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`section_id`,`class_id`,`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `class_id`, `course_id`, `section_name`, `description`) VALUES
(1, 'G1', 'IS424', 'Session 1', 'for week 1'),
(2, 'G1', 'IS424', 'Session 2', 'for week 2'),
(3, 'G1', 'IS424', 'Session 3', 'for week 3'),
(4, 'G2', 'IS212', 'Session 1', 'for week 1'),
(5, 'G2', 'IS212', 'Session 2', 'for week 2'),
(6, 'G2', 'IS212', 'Session 3', 'for week 3');

-- --------------------------------------------------------

--
-- Table structure for table `section_quiz_grade`
--

DROP TABLE IF EXISTS `section_quiz_grade`;
CREATE TABLE IF NOT EXISTS `section_quiz_grade` (
  `attempts` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `engineer_id` varchar(50) NOT NULL,
  `class_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `mark` int(11) NOT NULL,
  `quiz_id` varchar(50) NOT NULL,
  PRIMARY KEY (`attempts`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section_quiz_grade`
--

INSERT INTO `section_quiz_grade` (`attempts`, `section_id`, `engineer_id`, `class_id`, `course_id`, `mark`, `quiz_id`) VALUES
(8, 4, '1', 'G2', 'IS212', 1, 'IS212G2S4'),
(9, 4, '1', 'G2', 'IS212', 1, 'IS212G2S4'),
(10, 4, '1', 'G2', 'IS212', 0, 'IS212G2S4'),
(11, 4, '1', 'G2', 'IS212', 1, 'IS212G2S4'),
(12, 4, '1', 'G2', 'IS212', 0, 'IS212G2S4'),
(13, 4, '1', 'G2', 'IS212', 0, 'IS212G2S4'),
(14, 4, '1', 'G2', 'IS212', 2, 'IS212G2S4'),
(15, 4, '1', 'G2', 'IS212', 1, 'IS212G2S4'),
(16, 4, '1', 'G2', 'IS212', 2, 'IS212G2S4'),
(17, 4, '1', 'G2', 'IS212', 1, 'IS212G2S4'),
(18, 4, '1', 'G2', 'IS212', 2, 'IS212G2S4');

-- --------------------------------------------------------

--
-- Table structure for table `section_status`
--

DROP TABLE IF EXISTS `section_status`;
CREATE TABLE IF NOT EXISTS `section_status` (
  `section_id` int(11) NOT NULL,
  `engineer_id` varchar(50) NOT NULL,
  `class_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `mark` int(11) NOT NULL,
  PRIMARY KEY (`section_id`,`engineer_id`,`class_id`,`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section_status`
--

INSERT INTO `section_status` (`section_id`, `engineer_id`, `class_id`, `course_id`, `mark`) VALUES
(1, '1', 'G1', 'IS424', 0),
(2, '1', 'G1', 'IS424', 0),
(3, '1', 'G1', 'IS424', 0);

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

DROP TABLE IF EXISTS `thread`;
CREATE TABLE IF NOT EXISTS `thread` (
  `thread_id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_id` varchar(50) NOT NULL,
  `t_description` varchar(256) NOT NULL,
  `engineer_id` varchar(50) NOT NULL,
  PRIMARY KEY (`thread_id`,`forum_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `thread`
--

INSERT INTO `thread` (`thread_id`, `forum_id`, `t_description`, `engineer_id`) VALUES
(1, '1', 'Looking for study group', '2'),
(2, '1', 'Looking for chats', '4'),
(3, '1', 'Looking for study guide', '5'),
(4, '1', 'Looking for senior guidance', '1'),
(5, '1', 'Looking for printer expertise', '1'),
(6, '2', 'Looking for study group', '6'),
(7, '2', 'Looking for senior guidance', '1'),
(8, '2', 'Looking for printer expertise', '1');

-- --------------------------------------------------------

--
-- Table structure for table `trainer_assignment`
--

DROP TABLE IF EXISTS `trainer_assignment`;
CREATE TABLE IF NOT EXISTS `trainer_assignment` (
  `engineer_id` varchar(50) NOT NULL,
  `class_id` varchar(50) NOT NULL,
  PRIMARY KEY (`engineer_id`,`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
