-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 25, 2019 at 01:37 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zedexper_mmrs_wmiot`
--

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_debug_app`
--

CREATE TABLE `tbl_debug_app` (
  `data` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_geo_fence`
--

CREATE TABLE `tbl_geo_fence` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `polygon_json` longtext,
  `temp_start` float DEFAULT '20',
  `temp_end` float DEFAULT '24',
  `temp_margin` float DEFAULT '3',
  `do_start` float DEFAULT '7',
  `do_end` float DEFAULT '9',
  `do_margin` float DEFAULT '1',
  `ph_start` float DEFAULT '6',
  `ph_end` float DEFAULT '9',
  `ph_margin` float DEFAULT '1',
  `date_time` varchar(100) DEFAULT '0',
  `update_date_time` varchar(100) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_geo_fence`
--

INSERT INTO `tbl_geo_fence` (`id`, `admin_id`, `user_id`, `name`, `polygon_json`, `temp_start`, `temp_end`, `temp_margin`, `do_start`, `do_end`, `do_margin`, `ph_start`, `ph_end`, `ph_margin`, `date_time`, `update_date_time`) VALUES
(1, 1, 1, 'AS Tentacle T3', '[\"24.933838,67.062858\",\"24.932398,67.063502\",\"24.934966,67.066463\",\"24.935745,67.065648\",\"24.936173,67.063674\"]', 20.1, 24, 3, 7, 9, 1, 6, 9, 1, '1542368359', '1546332253'),
(2, 1, 1, 'ADS1115 (AS DO, AliEx pH)', '[\"24.936834,67.063874\",\"24.936445,67.065762\",\"24.935317,67.066792\",\"24.936134,67.068037\",\"24.938196,67.065548\"]', 20, 24, 3, 7, 9, 1, 6, 9, 1, '1546425588', '1546425588'),
(3, 1, 1, 'Standard Formula', '[\"24.936289,67.063259\",\"24.933915,67.062358\",\"24.932086,67.063217\",\"24.931697,67.06283\",\"24.933993,67.060599\"]', 20, 24, 3, 7, 9, 1, 6, 9, 1, '1546425663', '1546425663'),
(4, 1, 1, 'Optical SR485 DO probe', '[\"24.935297,67.059898\",\"24.934246,67.06037\",\"24.938371,67.065262\",\"24.93911,67.064232\"]', 20, 24, 3, 7, 9, 1, 6, 9, 1, '1551163681', '1551163681'),
(5, 1, 1, 'Alibaba DO', '[\"24.936095,67.059151\",\"24.935745,67.05928\",\"24.936601,67.060524\",\"24.936873,67.059966\"]', 20, 24, 3, 7, 9, 1, 6, 9, 1, '1556964234', '1556964234'),
(6, 1, 2, 'Plastic Pool Data', '[\"24.936095,67.059151\",\"24.935745,67.05928\",\"24.936601,67.060524\",\"24.936873,67.059966\"]', 20, 24, 3, 7, 9, 1, 6, 9, 1, '1556964234', '1556964234');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `sim_serial` varchar(100) DEFAULT NULL,
  `address` longtext,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `pass_token` varchar(100) DEFAULT NULL,
  `app_pin_code` int(4) DEFAULT NULL,
  `photo` varchar(200) DEFAULT 'https://mmrsonline.zeddevelopers.com/app/WaterMonitoringIoT/admin/upload/dp/user_default.jpg',
  `date_time` varchar(100) DEFAULT NULL,
  `update_at` varchar(100) DEFAULT NULL,
  `access_level` varchar(100) DEFAULT NULL,
  `hash` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'active',
  `parent_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id`, `fullname`, `email`, `contact`, `sim_serial`, `address`, `city`, `country`, `password`, `pass_token`, `app_pin_code`, `photo`, `date_time`, `update_at`, `access_level`, `hash`, `status`, `parent_id`) VALUES
(1, 'Admin', 'admin@gmail.com', '923161126671', '', '', '', '', '7f557e3f2f1ca66ed9ef4ee6472a402e', '0805288c8fa6ba365b6fb12dfa68f4c2', 0, 'https://mmrsonline.zeddevelopers.com/app/WaterMonitoringIoT/admin/upload/dp/user_default.jpg', '1546358761', '1550574661', 'admin', '887281b1802590790430993e49524909', 'active', 0),
(2, 'Ghulam Abbass', '', '923323137489', '', '', '', '', '7f557e3f2f1ca66ed9ef4ee6472a402e', '0805288c8fa6ba365b6fb12dfa68f4c2', 0, 'https://mmrsonline.zeddevelopers.com/app/WaterMonitoringIoT/admin/upload/dp/user_default.jpg', '1546358761', '', 'user', '887281b1802590790430993e49524909', 'active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pond_log`
--

CREATE TABLE `tbl_pond_log` (
  `id` int(11) NOT NULL,
  `pond_id` int(11) DEFAULT NULL,
  `json` longtext,
  `timestamp` int(111) DEFAULT NULL,
  `lat` float DEFAULT '24.9353',
  `lon` float DEFAULT '67.0639'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pond_log`
--

INSERT INTO `tbl_pond_log` (`id`, `pond_id`, `json`, `timestamp`, `lat`, `lon`) VALUES
(1, 6, '{\"uptime\":\"0:0 Hours\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"memory\":\"948304/538268\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"58.5\'C\",\"d_o\":\"3.24\",\"ph\":\"8.389\",\"temp\":\"29.94\"}', 1568834379, 24.9353, 67.0639),
(2, 6, '{\"uptime\":\"0:5 Hours\",\"memory\":\"948304/545052\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"52.6\'C\",\"temp\":\"29.94\",\"ph\":\"8.394\",\"d_o\":\"3.25\"}', 1568834686, 24.9353, 67.0639),
(3, 6, '{\"memory\":\"948304/545868\",\"pcb_revision\":\"a22082\",\"uptime\":\"0:10 Hours\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"53.2\'C\",\"temp\":\"29.94\",\"d_o\":\"3.31\",\"ph\":\"8.385\"}', 1568834985, 24.9353, 67.0639),
(4, 6, '{\"memory\":\"948304/544284\",\"uptime\":\"0:15 Hours\",\"hardware\":\"BCM2835\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"53.2\'C\",\"temp\":\"29.94\",\"ph\":\"8.392\",\"d_o\":\"3.32\"}', 1568835284, 24.9353, 67.0639),
(5, 6, '{\"uptime\":\"0:20 Hours\",\"memory\":\"948304/545032\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"53.7\'C\",\"temp\":\"29.94\",\"d_o\":\"3.27\",\"ph\":\"8.388\"}', 1568835584, 24.9353, 67.0639),
(6, 6, '{\"memory\":\"948304/545468\",\"uptime\":\"0:25 Hours\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"hardware\":\"BCM2835\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"53.2\'C\",\"temp\":\"29.88\",\"d_o\":\"3.28\",\"ph\":\"8.395\"}', 1568835884, 24.9353, 67.0639),
(7, 6, '{\"uptime\":\"0:30 Hours\",\"memory\":\"948304/544744\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"hardware\":\"BCM2835\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"53.2\'C\",\"temp\":\"29.88\",\"ph\":\"8.392\",\"d_o\":\"3.31\"}', 1568836184, 24.9353, 67.0639),
(8, 6, '{\"uptime\":\"0:35 Hours\",\"memory\":\"948304/543496\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"53.7\'C\",\"temp\":\"29.88\",\"d_o\":\"3.32\",\"ph\":\"8.373\"}', 1568836484, 24.9353, 67.0639),
(9, 6, '{\"uptime\":\"0:40 Hours\",\"memory\":\"948304/543160\",\"pcb_revision\":\"a22082\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"temp_cpu\":\"53.7\'C\",\"temp\":\"29.88\",\"d_o\":\"3.36\",\"ph\":\"8.354\"}', 1568836785, 24.9353, 67.0639),
(10, 6, '{\"memory\":\"948304/543204\",\"uptime\":\"0:45 Hours\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"53.2\'C\",\"temp\":\"29.88\",\"ph\":\"8.373\",\"d_o\":\"3.48\"}', 1568837084, 24.9353, 67.0639),
(11, 6, '{\"uptime\":\"0:50 Hours\",\"memory\":\"948304/515672\",\"hardware\":\"BCM2835\",\"pcb_revision\":\"a22082\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"serial\":\"00000000b46309b1\",\"temp_cpu\":\"53.7\'C\",\"temp\":\"29.88\",\"ph\":\"8.376\",\"d_o\":\"3.29\"}', 1568837385, 24.9353, 67.0639),
(12, 6, '{\"memory\":\"948304/516176\",\"uptime\":\"0:55 Hours\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"52.6\'C\",\"temp\":\"29.88\",\"ph\":\"8.382\",\"d_o\":\"3.60\"}', 1568837684, 24.9353, 67.0639),
(13, 6, '{\"uptime\":\"1:0 Hours\",\"memory\":\"948304/515392\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"53.2\'C\",\"temp\":\"29.88\",\"ph\":\"8.394\",\"d_o\":\"4.07\"}', 1568837984, 24.9353, 67.0639),
(14, 6, '{\"memory\":\"948304/515120\",\"uptime\":\"1:5 Hours\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"53.7\'C\",\"temp\":\"29.81\",\"d_o\":\"3.32\",\"ph\":\"8.377\"}', 1568838284, 24.9353, 67.0639),
(15, 6, '{\"memory\":\"948304/513240\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"uptime\":\"1:10 Hours\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"53.7\'C\",\"temp\":\"29.81\",\"d_o\":\"3.37\",\"ph\":\"8.369\"}', 1568838584, 24.9353, 67.0639),
(16, 6, '{\"uptime\":\"1:15 Hours\",\"memory\":\"948304/515852\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"hardware\":\"BCM2835\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"53.7\'C\",\"temp\":\"29.81\",\"d_o\":\"3.14\",\"ph\":\"8.361\"}', 1568838887, 24.9353, 67.0639),
(17, 6, '{\"uptime\":\"1:20 Hours\",\"memory\":\"948304/514104\",\"serial\":\"00000000b46309b1\",\"hardware\":\"BCM2835\",\"pcb_revision\":\"a22082\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"53.7\'C\",\"temp\":\"29.81\",\"ph\":\"8.344\",\"d_o\":\"3.30\"}', 1568839184, 24.9353, 67.0639),
(18, 6, '{\"uptime\":\"1:25 Hours\",\"memory\":\"948304/514664\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"53.7\'C\",\"temp\":\"29.81\",\"ph\":\"8.354\",\"d_o\":\"3.11\"}', 1568839485, 24.9353, 67.0639),
(19, 6, '{\"uptime\":\"1:30 Hours\",\"memory\":\"948304/515292\",\"hardware\":\"BCM2835\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"53.7\'C\",\"temp\":\"29.81\",\"ph\":\"8.367\",\"d_o\":\"3.29\"}', 1568839784, 24.9353, 67.0639),
(20, 6, '{\"memory\":\"948304/514884\",\"uptime\":\"1:35 Hours\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"53.7\'C\",\"temp\":\"29.81\",\"ph\":\"8.365\",\"d_o\":\"3.17\"}', 1568840086, 24.9353, 67.0639),
(21, 6, '{\"uptime\":\"1:40 Hours\",\"memory\":\"948304/514488\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"53.7\'C\",\"temp\":\"29.81\",\"ph\":\"8.362\",\"d_o\":\"3.49\"}', 1568840384, 24.9353, 67.0639),
(22, 6, '{\"uptime\":\"1:45 Hours\",\"memory\":\"948304/513488\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"53.7\'C\",\"temp\":\"29.81\",\"d_o\":\"3.28\",\"ph\":\"8.376\"}', 1568840685, 24.9353, 67.0639),
(23, 6, '{\"uptime\":\"1:50 Hours\",\"memory\":\"948304/513480\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"53.2\'C\",\"temp\":\"29.75\",\"ph\":\"8.365\",\"d_o\":\"3.17\"}', 1568840985, 24.9353, 67.0639),
(24, 6, '{\"memory\":\"948304/514504\",\"uptime\":\"1:55 Hours\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"53.7\'C\",\"temp\":\"29.75\",\"ph\":\"8.364\",\"d_o\":\"3.10\"}', 1568841285, 24.9353, 67.0639),
(25, 6, '{\"memory\":\"948304/511968\",\"uptime\":\"2:0 Hours\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"53.7\'C\",\"temp\":\"29.75\",\"ph\":\"8.364\",\"d_o\":\"3.13\"}', 1568841585, 24.9353, 67.0639),
(26, 6, '{\"uptime\":\"4:15 Hours\",\"memory\":\"948304/488960\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"hardware\":\"BCM2835\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"52.6\'C\",\"ph\":\"8.306\",\"temp\":\"29.44\",\"d_o\":\"3.23\"}', 1568849919, 24.9353, 67.0639),
(27, 6, '{\"temp\":\"29.13\",\"uptime\":\"6:58 Hours\",\"memory\":\"948304/302272\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"52.6\'C\",\"ph\":\"8.340\",\"d_o\":\"4.88\"}', 1568859462, 24.9353, 67.0639),
(28, 6, '{\"ph\":\"8.338\",\"temp\":\"29.06\",\"uptime\":\"7:2 Hours\",\"memory\":\"948304/304180\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"serial\":\"00000000b46309b1\",\"temp_cpu\":\"52.1\'C\",\"d_o\":\"4.34\"}', 1568859825, 24.9353, 67.0639),
(29, 6, '{\"d_o\":\"3.15\",\"ph\":\"Error 254\",\"temp\":\"29.0\",\"uptime\":\"9:3 Hours\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"hardware\":\"BCM2835\",\"pcb_revision\":\"a22082\",\"memory\":\"948304/315252\",\"serial\":\"00000000b46309b1\",\"temp_cpu\":\"59.1\'C\"}', 1568866952, 24.9353, 67.0639),
(30, 6, '{\"d_o\":\"Error 254\",\"ph\":\"Error 255\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"hardware\":\"BCM2835\",\"pcb_revision\":\"a22082\",\"uptime\":\"9:3 Hours\",\"memory\":\"948304/459192\",\"temp_cpu\":\"67.7\'C\",\"temp\":\"29.0\"}', 1568866954, 24.9353, 67.0639),
(31, 6, '{\"temp\":\"29.0\",\"ph\":\"Error 255\",\"d_o\":\"\",\"uptime\":\"9:5 Hours\",\"memory\":\"948304/459488\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"hardware\":\"BCM2835\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"54.8\'C\"}', 1568867083, 24.9353, 67.0639),
(32, 6, '{\"temp\":\"29.0\",\"d_o\":\"3.89\",\"ph\":\"8.357\",\"memory\":\"948304/459656\",\"uptime\":\"9:10 Hours\",\"hardware\":\"BCM2835\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"54.2\'C\"}', 1568867384, 24.9353, 67.0639),
(33, 6, '{\"temp\":\"29.0\",\"ph\":\"8.351\",\"d_o\":\"3.53\",\"uptime\":\"9:15 Hours\",\"pcb_revision\":\"a22082\",\"memory\":\"948304/459268\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"54.2\'C\"}', 1568867717, 24.9353, 67.0639),
(34, 6, '{\"temp\":\"29.0\",\"ph\":\"8.375\",\"d_o\":\"3.46\",\"uptime\":\"9:20 Hours\",\"memory\":\"948304/464772\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"54.2\'C\"}', 1568867974, 24.9353, 67.0639),
(35, 6, '{\"uptime\":\"9:40 Hours\",\"memory\":\"948304/460104\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"54.8\'C\",\"temp\":\"29.0\",\"d_o\":\"3.31\",\"ph\":\"8.378\"}', 1568869179, 24.9353, 67.0639),
(36, 6, '{\"memory\":\"948304/460924\",\"uptime\":\"9:45 Hours\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"54.2\'C\",\"temp\":\"29.0\",\"ph\":\"8.387\",\"d_o\":\"3.33\"}', 1568869491, 24.9353, 67.0639),
(37, 6, '{\"uptime\":\"9:50 Hours\",\"memory\":\"948304/461144\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"serial\":\"00000000b46309b1\",\"temp_cpu\":\"54.8\'C\",\"temp\":\"29.06\",\"d_o\":\"3.64\",\"ph\":\"8.379\"}', 1568869787, 24.9353, 67.0639),
(38, 6, '{\"uptime\":\"9:55 Hours\",\"memory\":\"948304/458872\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"54.8\'C\",\"temp\":\"29.06\",\"d_o\":\"4.65\",\"ph\":\"8.386\"}', 1568870094, 24.9353, 67.0639),
(39, 6, '{\"uptime\":\"10:0 Hours\",\"memory\":\"948304/458876\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"54.8\'C\",\"temp\":\"29.06\",\"ph\":\"8.385\",\"d_o\":\"3.21\"}', 1568870387, 24.9353, 67.0639),
(40, 6, '{\"uptime\":\"10:5 Hours\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"memory\":\"948304/459376\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"serial\":\"00000000b46309b1\",\"temp_cpu\":\"54.8\'C\",\"temp\":\"29.06\",\"ph\":\"8.377\",\"d_o\":\"3.54\"}', 1568870688, 24.9353, 67.0639),
(41, 6, '{\"uptime\":\"10:10 Hours\",\"memory\":\"948304/449872\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"55.3\'C\",\"temp\":\"29.06\",\"ph\":\"8.378\",\"d_o\":\"3.60\"}', 1568870988, 24.9353, 67.0639),
(42, 6, '{\"uptime\":\"10:15 Hours\",\"memory\":\"948304/450408\",\"pcb_revision\":\"a22082\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"temp_cpu\":\"55.3\'C\",\"temp\":\"29.06\",\"ph\":\"8.397\",\"d_o\":\"3.30\"}', 1568871288, 24.9353, 67.0639),
(43, 6, '{\"uptime\":\"10:20 Hours\",\"memory\":\"948304/450032\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"55.8\'C\",\"temp\":\"29.06\",\"d_o\":\"3.20\",\"ph\":\"8.388\"}', 1568871589, 24.9353, 67.0639),
(44, 6, '{\"uptime\":\"10:25 Hours\",\"memory\":\"948304/450196\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"serial\":\"00000000b46309b1\",\"temp_cpu\":\"55.8\'C\",\"temp\":\"29.06\",\"ph\":\"8.397\",\"d_o\":\"3.17\"}', 1568871923, 24.9353, 67.0639),
(45, 6, '{\"uptime\":\"10:30 Hours\",\"memory\":\"948304/450024\",\"hardware\":\"BCM2835\",\"pcb_revision\":\"a22082\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"serial\":\"00000000b46309b1\",\"temp_cpu\":\"54.8\'C\",\"temp\":\"29.06\",\"ph\":\"8.385\",\"d_o\":\"3.40\"}', 1568872196, 24.9353, 67.0639),
(46, 6, '{\"uptime\":\"10:35 Hours\",\"memory\":\"948304/451116\",\"pcb_revision\":\"a22082\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"temp_cpu\":\"55.8\'C\",\"temp\":\"29.06\",\"ph\":\"8.396\",\"d_o\":\"3.67\"}', 1568872499, 24.9353, 67.0639),
(47, 6, '{\"uptime\":\"10:40 Hours\",\"memory\":\"948304/451764\",\"pcb_revision\":\"a22082\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"temp_cpu\":\"55.8\'C\",\"temp\":\"29.06\",\"ph\":\"8.396\",\"d_o\":\"3.34\"}', 1568872788, 24.9353, 67.0639),
(48, 6, '{\"memory\":\"948304/449684\",\"uptime\":\"10:45 Hours\",\"hardware\":\"BCM2835\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"56.4\'C\",\"temp\":\"29.06\",\"d_o\":\"3.44\",\"ph\":\"8.408\"}', 1568873106, 24.9353, 67.0639),
(49, 6, '{\"uptime\":\"10:50 Hours\",\"memory\":\"948304/448284\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"hardware\":\"BCM2835\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"56.4\'C\",\"temp\":\"29.06\",\"d_o\":\"3.28\",\"ph\":\"8.412\"}', 1568873465, 24.9353, 67.0639),
(50, 6, '{\"memory\":\"948304/448936\",\"uptime\":\"10:55 Hours\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"56.4\'C\",\"ph\":\"8.429\",\"d_o\":\"3.28\",\"temp\":\"29.06\"}', 1568873834, 24.9353, 67.0639),
(51, 6, '{\"uptime\":\"0:7 Hours\",\"memory\":\"948304/549364\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"60.1\'C\",\"d_o\":\"3.28\",\"temp\":\"29.19\",\"ph\":\"8.511\"}', 1568876058, 24.9353, 67.0639),
(52, 6, '{\"uptime\":\"0:12 Hours\",\"memory\":\"948304/547788\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"61.2\'C\",\"temp\":\"29.25\",\"ph\":\"8.479\",\"d_o\":\"3.72\"}', 1568876371, 24.9353, 67.0639),
(53, 6, '{\"memory\":\"948304/546872\",\"uptime\":\"0:17 Hours\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"62.3\'C\",\"ph\":\"8.503\",\"temp\":\"29.5\",\"d_o\":\"3.40\"}', 1568876661, 24.9353, 67.0639),
(54, 6, '{\"uptime\":\"0:22 Hours\",\"memory\":\"948304/547400\",\"hardware\":\"BCM2835\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"62.3\'C\",\"temp\":\"29.75\",\"ph\":\"8.499\",\"d_o\":\"3.27\"}', 1568876956, 24.9353, 67.0639),
(55, 6, '{\"uptime\":\"0:27 Hours\",\"memory\":\"948304/546352\",\"hardware\":\"BCM2835\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"63.9\'C\",\"ph\":\"8.495\",\"d_o\":\"3.37\",\"temp\":\"30.0\"}', 1568877254, 24.9353, 67.0639),
(56, 6, '{\"uptime\":\"0:32 Hours\",\"memory\":\"948304/547832\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"hardware\":\"BCM2835\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"64.5\'C\",\"temp\":\"30.19\",\"ph\":\"8.457\",\"d_o\":\"3.35\"}', 1568877561, 24.9353, 67.0639),
(57, 6, '{\"uptime\":\"0:37 Hours\",\"memory\":\"948304/546924\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"hardware\":\"BCM2835\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"64.5\'C\",\"temp\":\"30.44\",\"ph\":\"8.487\",\"d_o\":\"3.14\"}', 1568877864, 24.9353, 67.0639),
(58, 6, '{\"uptime\":\"0:42 Hours\",\"memory\":\"948304/544924\",\"hardware\":\"BCM2835\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"65.0\'C\",\"temp\":\"30.56\",\"ph\":\"8.454\",\"d_o\":\"3.17\"}', 1568878170, 24.9353, 67.0639),
(59, 6, '{\"memory\":\"948304/546500\",\"uptime\":\"0:47 Hours\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"65.0\'C\",\"temp\":\"30.75\",\"d_o\":\"3.23\",\"ph\":\"8.469\"}', 1568878456, 24.9353, 67.0639),
(60, 6, '{\"memory\":\"948304/545648\",\"uptime\":\"0:52 Hours\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"pcb_revision\":\"a22082\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"65.5\'C\",\"temp\":\"30.88\",\"d_o\":\"3.36\",\"ph\":\"8.471\"}', 1568878757, 24.9353, 67.0639),
(61, 6, '{\"uptime\":\"0:57 Hours\",\"memory\":\"948304/548184\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"hardware\":\"BCM2835\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"66.1\'C\",\"temp\":\"30.88\",\"ph\":\"8.463\",\"d_o\":\"3.34\"}', 1568879056, 24.9353, 67.0639),
(62, 6, '{\"pcb_revision\":\"a22082\",\"uptime\":\"0:5 Hours\",\"hardware\":\"BCM2835\",\"memory\":\"948304/521584\",\"serial\":\"00000000b46309b1\",\"temp_cpu\":\"73.1\'C\",\"temp\":\"31.13\",\"ph\":\"8.467\",\"d_o\":\"3.20\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\"}', 1568879627, 24.9353, 67.0639),
(63, 6, '{\"temp_cpu\":\"68.8\'C\",\"temp\":\"31.19\",\"ph\":\"8.406\",\"d_o\":\"3.27\",\"uptime\":\"0:10 Hours\",\"memory\":\"948304/519756\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\"}', 1568879936, 24.9353, 67.0639),
(64, 6, '{\"temp_cpu\":\"67.7\'C\",\"temp\":\"31.25\",\"ph\":\"8.434\",\"d_o\":\"3.23\",\"uptime\":\"0:15 Hours\",\"memory\":\"948304/520596\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\"}', 1568880236, 24.9353, 67.0639),
(65, 6, '{\"temp_cpu\":\"67.7\'C\",\"temp\":\"31.25\",\"ph\":\"8.463\",\"d_o\":\"3.41\",\"uptime\":\"0:20 Hours\",\"pcb_revision\":\"a22082\",\"memory\":\"948304/518796\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\"}', 1568880537, 24.9353, 67.0639),
(66, 6, '{\"temp_cpu\":\"68.8\'C\",\"temp\":\"31.19\",\"ph\":\"8.428\",\"d_o\":\"3.42\",\"uptime\":\"0:25 Hours\",\"memory\":\"948304/518280\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\"}', 1568880837, 24.9353, 67.0639),
(67, 6, '{\"temp_cpu\":\"67.7\'C\",\"temp\":\"31.13\",\"ph\":\"8.451\",\"d_o\":\"3.22\",\"uptime\":\"0:30 Hours\",\"memory\":\"948304/519752\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\"}', 1568881139, 24.9353, 67.0639),
(68, 6, '{\"temp_cpu\":\"68.2\'C\",\"temp\":\"31.19\",\"d_o\":\"3.29\",\"ph\":\"8.480\",\"memory\":\"948304/519452\",\"uptime\":\"0:35 Hours\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\"}', 1568881436, 24.9353, 67.0639),
(69, 6, '{\"temp_cpu\":\"67.7\'C\",\"temp\":\"31.19\",\"d_o\":\"3.37\",\"ph\":\"8.504\",\"uptime\":\"0:40 Hours\",\"pcb_revision\":\"a22082\",\"memory\":\"948304/519280\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\"}', 1568881736, 24.9353, 67.0639),
(70, 6, '{\"temp_cpu\":\"67.7\'C\",\"temp\":\"31.19\",\"d_o\":\"3.33\",\"ph\":\"8.443\",\"uptime\":\"0:45 Hours\",\"memory\":\"948304/518320\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\"}', 1568882036, 24.9353, 67.0639),
(71, 6, '{\"temp_cpu\":\"68.8\'C\",\"temp\":\"31.19\",\"d_o\":\"3.38\",\"ph\":\"8.487\",\"uptime\":\"0:50 Hours\",\"memory\":\"948304/518280\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\"}', 1568882336, 24.9353, 67.0639),
(72, 6, '{\"memory\":\"948304/540904\",\"uptime\":\"0:0 Hours\",\"hardware\":\"BCM2835\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"75.2\'C\",\"temp\":\"31.19\",\"ph\":\"8.479\",\"d_o\":\"3.16\"}', 1568883099, 24.9353, 67.0639),
(73, 6, '{\"uptime\":\"0:5 Hours\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"memory\":\"948304/555228\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"serial\":\"00000000b46309b1\",\"temp_cpu\":\"70.4\'C\",\"temp\":\"31.25\",\"ph\":\"8.499\",\"d_o\":\"3.25\"}', 1568883407, 24.9353, 67.0639),
(74, 6, '{\"uptime\":\"0:10 Hours\",\"memory\":\"948304/555392\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"70.4\'C\",\"temp\":\"31.25\",\"ph\":\"8.509\",\"d_o\":\"3.34\"}', 1568883741, 24.9353, 67.0639),
(75, 6, '{\"uptime\":\"0:15 Hours\",\"memory\":\"948304/554256\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"69.8\'C\",\"temp\":\"31.19\",\"ph\":\"8.517\",\"d_o\":\"3.66\"}', 1568884007, 24.9353, 67.0639),
(76, 6, '{\"uptime\":\"0:20 Hours\",\"memory\":\"948304/552312\",\"hardware\":\"BCM2835\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"69.8\'C\",\"temp\":\"31.19\",\"d_o\":\"3.28\",\"ph\":\"8.526\"}', 1568884313, 24.9353, 67.0639),
(77, 6, '{\"memory\":\"948304/556216\",\"uptime\":\"0:25 Hours\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"70.4\'C\",\"temp\":\"31.19\",\"ph\":\"8.515\",\"d_o\":\"3.22\"}', 1568884607, 24.9353, 67.0639),
(78, 6, '{\"uptime\":\"0:30 Hours\",\"memory\":\"948304/554636\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"hardware\":\"BCM2835\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"69.8\'C\",\"temp\":\"31.13\",\"d_o\":\"3.14\",\"ph\":\"8.534\"}', 1568884915, 24.9353, 67.0639),
(79, 6, '{\"memory\":\"948304/556476\",\"uptime\":\"0:35 Hours\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"70.9\'C\",\"temp\":\"31.13\",\"ph\":\"8.539\",\"d_o\":\"3.26\"}', 1568885207, 24.9353, 67.0639),
(80, 6, '{\"uptime\":\"0:40 Hours\",\"memory\":\"948304/555924\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"70.9\'C\",\"temp\":\"31.0\",\"d_o\":\"3.30\",\"ph\":\"8.500\"}', 1568885509, 24.9353, 67.0639),
(81, 6, '{\"memory\":\"948304/554404\",\"uptime\":\"0:45 Hours\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"69.8\'C\",\"temp\":\"30.94\",\"d_o\":\"3.43\",\"ph\":\"8.538\"}', 1568885807, 24.9353, 67.0639),
(82, 6, '{\"memory\":\"948304/552844\",\"pcb_revision\":\"a22082\",\"uptime\":\"0:50 Hours\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"69.8\'C\",\"temp\":\"30.88\",\"d_o\":\"3.22\",\"ph\":\"8.521\"}', 1568886108, 24.9353, 67.0639),
(83, 6, '{\"uptime\":\"0:55 Hours\",\"memory\":\"948304/554460\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"70.4\'C\",\"temp\":\"30.81\",\"d_o\":\"3.30\",\"ph\":\"8.518\"}', 1568886408, 24.9353, 67.0639),
(84, 6, '{\"memory\":\"948304/553736\",\"uptime\":\"1:0 Hours\",\"hardware\":\"BCM2835\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"70.9\'C\",\"temp\":\"30.75\",\"ph\":\"8.504\",\"d_o\":\"3.27\"}', 1568886708, 24.9353, 67.0639),
(85, 6, '{\"memory\":\"948304/533100\",\"hardware\":\"BCM2835\",\"uptime\":\"0:0 Hours\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"76.8\'C\",\"temp\":\"30.69\",\"d_o\":\"3.25\",\"ph\":\"8.494\"}', 1568886864, 24.9353, 67.0639),
(86, 6, '{\"uptime\":\"0:5 Hours\",\"memory\":\"948304/549836\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"hardware\":\"BCM2835\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"70.9\'C\",\"temp\":\"30.69\",\"ph\":\"8.507\",\"d_o\":\"3.35\"}', 1568887178, 24.9353, 67.0639),
(87, 6, '{\"memory\":\"948304/550600\",\"uptime\":\"0:10 Hours\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"70.4\'C\",\"temp\":\"30.63\",\"d_o\":\"3.32\",\"ph\":\"8.498\"}', 1568887473, 24.9353, 67.0639),
(88, 6, '{\"uptime\":\"0:15 Hours\",\"memory\":\"948304/547732\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"temp_cpu\":\"69.3\'C\",\"temp\":\"30.56\",\"ph\":\"8.535\",\"d_o\":\"3.75\"}', 1568887780, 24.9353, 67.0639),
(89, 6, '{\"uptime\":\"0:25 Hours\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"memory\":\"948304/548640\",\"serial\":\"00000000b46309b1\",\"temp_cpu\":\"68.8\'C\",\"temp\":\"30.56\",\"ph\":\"8.523\",\"d_o\":\"3.31\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\"}', 1568888360, 24.9353, 67.0639),
(90, 6, '{\"temp_cpu\":\"68.8\'C\",\"temp\":\"30.5\",\"ph\":\"8.505\",\"d_o\":\"3.32\",\"memory\":\"948304/546312\",\"pcb_revision\":\"a22082\",\"uptime\":\"0:30 Hours\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\"}', 1568888669, 24.9353, 67.0639),
(91, 6, '{\"temp_cpu\":\"68.8\'C\",\"temp\":\"30.5\",\"ph\":\"8.514\",\"d_o\":\"3.34\",\"uptime\":\"0:35 Hours\",\"memory\":\"948304/546988\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\",\"serial\":\"00000000b46309b1\"}', 1568888969, 24.9353, 67.0639),
(92, 6, '{\"temp_cpu\":\"68.2\'C\",\"temp\":\"30.44\",\"d_o\":\"3.25\",\"ph\":\"8.514\",\"uptime\":\"0:40 Hours\",\"pcb_revision\":\"a22082\",\"memory\":\"948304/546172\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\"}', 1568889271, 24.9353, 67.0639),
(93, 6, '{\"temp_cpu\":\"67.7\'C\",\"temp\":\"30.44\",\"ph\":\"8.508\",\"d_o\":\"3.70\",\"memory\":\"948304/547748\",\"uptime\":\"0:45 Hours\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\"}', 1568889571, 24.9353, 67.0639),
(94, 6, '{\"temp_cpu\":\"67.1\'C\",\"temp\":\"30.44\",\"d_o\":\"3.25\",\"ph\":\"8.513\",\"uptime\":\"0:50 Hours\",\"memory\":\"948304/547660\",\"pcb_revision\":\"a22082\",\"hardware\":\"BCM2835\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\"}', 1568889869, 24.9353, 67.0639),
(95, 6, '{\"temp_cpu\":\"66.6\'C\",\"temp\":\"30.44\",\"ph\":\"8.508\",\"d_o\":\"4.14\",\"uptime\":\"0:55 Hours\",\"memory\":\"948304/546228\",\"hardware\":\"BCM2835\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\"}', 1568890174, 24.9353, 67.0639),
(96, 6, '{\"temp_cpu\":\"65.5\'C\",\"temp\":\"30.44\",\"ph\":\"8.522\",\"d_o\":\"3.94\",\"memory\":\"948304/552024\",\"uptime\":\"1:0 Hours\",\"pcb_revision\":\"a22082\",\"serial\":\"00000000b46309b1\",\"hardware\":\"BCM2835\",\"ip_gway_host\":\"192.168.1.104 / 192.168.1.1 / raspberrypi\"}', 1568890460, 24.9353, 67.0639);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_solar_data`
--

CREATE TABLE `tbl_solar_data` (
  `id` int(11) NOT NULL,
  `pond_id` int(11) DEFAULT NULL,
  `solar_voltage` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `solar_ampere` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `battery_voltage` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `battery_ampere` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `battery_percentage` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `battery_charging` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'false',
  `load_voltage` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `load_ampere` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `energy_gen_24hrs` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `energy_gen_1week` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `energy_gen_1month` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `energy_used_24hrs` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `energy_used_1week` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `energy_used_1month` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_time` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_solar_data`
--

INSERT INTO `tbl_solar_data` (`id`, `pond_id`, `solar_voltage`, `solar_ampere`, `battery_voltage`, `battery_ampere`, `battery_percentage`, `battery_charging`, `load_voltage`, `load_ampere`, `energy_gen_24hrs`, `energy_gen_1week`, `energy_gen_1month`, `energy_used_24hrs`, `energy_used_1week`, `energy_used_1month`, `date_time`) VALUES
(1, 6, '1.83', '0.0', '12.52', '6.90', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568834403'),
(2, 6, '1.83', '0.0', '12.52', '6.90', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568834705'),
(3, 6, '1.83', '0.0', '12.52', '6.90', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568835007'),
(4, 6, '1.83', '0.0', '12.52', '6.90', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568835308'),
(5, 6, '1.83', '0.0', '12.52', '6.90', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568835610'),
(6, 6, '1.83', '0.0', '12.52', '6.90', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568835912'),
(7, 6, '1.83', '0.0', '12.52', '6.90', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568836214'),
(8, 6, '1.83', '0.0', '12.52', '6.90', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568836516'),
(9, 6, '1.83', '0.0', '12.52', '6.90', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568836817'),
(10, 6, '1.83', '0.0', '12.52', '6.90', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568837119'),
(11, 6, '1.83', '0.0', '12.52', '6.90', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568837421'),
(12, 6, '1.83', '0.0', '12.52', '6.90', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568837722'),
(13, 6, '1.83', '0.0', '12.52', '6.90', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568838025'),
(14, 6, '1.83', '0.0', '12.52', '6.90', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568838327'),
(15, 6, '1.83', '0.0', '12.52', '6.90', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568838629'),
(16, 6, '1.83', '0.0', '12.52', '6.90', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568838931'),
(17, 6, '1.83', '0.0', '12.52', '6.90', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568839233'),
(18, 6, '1.83', '0.0', '12.52', '6.90', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568839534'),
(19, 6, '1.83', '0.0', '12.52', '6.90', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568839836'),
(20, 6, '1.72', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568840140'),
(21, 6, '1.72', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568840442'),
(22, 6, '1.72', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568840744'),
(23, 6, '1.72', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568841045'),
(24, 6, '1.72', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568841347'),
(25, 6, '1.72', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568841648'),
(26, 6, '1.72', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568841951'),
(27, 6, '1.72', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568842253'),
(28, 6, '1.72', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568842555'),
(29, 6, '1.72', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568842856'),
(30, 6, '1.72', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568843158'),
(31, 6, '1.72', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568843460'),
(32, 6, '1.72', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568843761'),
(33, 6, '1.72', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568844063'),
(34, 6, '1.72', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568844365'),
(35, 6, '1.72', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568844666'),
(36, 6, '1.72', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568844968'),
(37, 6, '1.72', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568845270'),
(38, 6, '1.72', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568845572'),
(39, 6, '1.72', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568845874'),
(40, 6, '1.83', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568846175'),
(41, 6, '1.83', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568846477'),
(42, 6, '1.83', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568846779'),
(43, 6, '1.83', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568847080'),
(44, 6, '1.83', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568847382'),
(45, 6, '1.83', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568847683'),
(46, 6, '1.83', '0.0', '12.45', '6.94', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568847985'),
(47, 6, '1.83', '0.0', '12.38', '6.98', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568848286'),
(48, 6, '1.83', '0.0', '12.38', '6.98', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568848588'),
(49, 6, '1.83', '0.0', '12.38', '6.98', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568848890'),
(50, 6, '1.83', '0.0', '12.38', '6.98', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568849191'),
(51, 6, '1.83', '0.0', '12.38', '6.98', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568849493'),
(52, 6, '1.83', '0.0', '12.38', '6.98', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568849795'),
(53, 6, '1.83', '0.0', '12.38', '6.98', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568850096'),
(54, 6, '1.83', '0.0', '12.38', '6.98', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568850398'),
(55, 6, '1.83', '0.0', '12.38', '6.98', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568850700'),
(56, 6, '1.83', '0.0', '12.38', '6.98', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568851001'),
(57, 6, '1.83', '0.0', '12.38', '6.98', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568851303'),
(58, 6, '1.83', '0.0', '12.38', '6.98', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568851604'),
(59, 6, '1.83', '0.0', '12.38', '6.98', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568851906'),
(60, 6, '1.83', '0.0', '12.38', '6.98', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568852207'),
(61, 6, '1.83', '0.0', '12.38', '6.98', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568852509'),
(62, 6, '1.83', '0.0', '12.38', '6.98', '60.0', 'false', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568852811'),
(63, 6, '1.83', '0.0', '12.38', '6.98', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568853113'),
(64, 6, '1.83', '0.0', '12.38', '6.98', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568853414'),
(65, 6, '1.83', '0.0', '12.38', '6.98', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568853716'),
(66, 6, '1.83', '0.0', '12.38', '6.98', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568854017'),
(67, 6, '1.94', '0.0', '12.38', '6.98', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568854319'),
(68, 6, '2.37', '0.0', '12.38', '6.98', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568854621'),
(69, 6, '3.78', '0.0', '12.31', '7.02', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568854923'),
(70, 6, '6.48', '0.0', '12.31', '7.02', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568855224'),
(71, 6, '8.86', '0.0', '12.31', '7.02', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568855526'),
(72, 6, '10.59', '0.0', '12.31', '7.02', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568855827'),
(73, 6, '12.1', '0.0', '12.31', '7.02', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568856129'),
(74, 6, '12.32', '0.0', '12.31', '7.02', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568856430'),
(75, 6, '12.32', '0.0', '12.31', '7.02', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568856733'),
(76, 6, '12.32', '0.0', '12.31', '7.02', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568857034'),
(77, 6, '12.32', '0.0', '12.31', '7.02', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568857336'),
(78, 6, '12.32', '0.0', '12.31', '7.02', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568857637'),
(79, 6, '12.32', '0.0', '12.31', '7.02', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568857939'),
(80, 6, '12.32', '0.0', '12.31', '7.02', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568858240'),
(81, 6, '12.32', '0.0', '12.31', '7.02', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568858542'),
(82, 6, '12.32', '0.0', '12.31', '7.02', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568858844'),
(83, 6, '12.32', '0.0', '12.31', '7.02', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568859146'),
(84, 6, '12.32', '0.0', '12.31', '7.02', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568859447'),
(85, 6, '12.32', '0.0', '12.31', '7.02', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568859749'),
(86, 6, '12.32', '0.05', '12.31', '7.02', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568860051'),
(87, 6, '12.32', '0.05', '12.31', '7.02', '60.0', 'true', '4.2', '0.06', '116.0', '0', '0', '66.0', '0', '0', '1568860352'),
(88, 6, '12.32', '0.05', '12.31', '7.02', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568860654'),
(89, 6, '12.32', '0.05', '12.31', '7.02', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568860956'),
(90, 6, '12.32', '0.05', '12.31', '7.02', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568861257'),
(91, 6, '12.32', '0.05', '12.31', '7.02', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568861559'),
(92, 6, '12.32', '0.05', '12.31', '7.02', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568861860'),
(93, 6, '12.32', '0.05', '12.31', '7.02', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568862162'),
(94, 6, '12.32', '0.05', '12.31', '7.02', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568862464'),
(95, 6, '12.32', '0.05', '12.38', '6.98', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568862765'),
(96, 6, '12.32', '0.05', '12.38', '6.98', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568863067'),
(97, 6, '12.32', '0.05', '12.38', '6.98', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568863368'),
(98, 6, '12.32', '0.05', '12.31', '7.02', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568863670'),
(99, 6, '12.32', '0.05', '12.38', '6.98', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568863972'),
(100, 6, '12.32', '0.05', '12.38', '6.98', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568864274'),
(101, 6, '12.32', '0.05', '12.38', '6.98', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568864575'),
(102, 6, '12.32', '0.05', '12.38', '6.98', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568864877'),
(103, 6, '12.32', '0.05', '12.38', '6.98', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '66.0', '0', '0', '1568865178'),
(104, 6, '12.32', '0.05', '12.38', '6.98', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568865480'),
(105, 6, '12.32', '0.05', '12.38', '6.98', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568865782'),
(106, 6, '12.43', '0.05', '12.38', '6.98', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568866083'),
(107, 6, '12.32', '0.11', '12.38', '6.98', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568866385'),
(108, 6, '12.32', '0.11', '12.38', '6.98', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568866686'),
(109, 6, '12.32', '0.11', '12.31', '7.02', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568866988'),
(110, 6, '12.43', '0.11', '12.38', '6.98', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568867290'),
(111, 6, '12.43', '0.05', '12.38', '6.98', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568867592'),
(112, 6, '12.43', '0.11', '12.38', '6.98', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568867894'),
(113, 6, '12.43', '0.11', '12.38', '6.98', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568868196'),
(114, 6, '12.43', '0.11', '12.38', '6.98', '60.0', 'true', '4.2', '0.06', '116.0', '0', '0', '67.0', '0', '0', '1568868499'),
(115, 6, '12.43', '0.11', '12.38', '6.98', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568868801'),
(116, 6, '12.43', '0.11', '12.38', '6.98', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568869102'),
(117, 6, '12.43', '0.11', '12.38', '6.98', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568869404'),
(118, 6, '12.43', '0.11', '12.38', '6.98', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568869705'),
(119, 6, '12.43', '0.11', '12.45', '6.94', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568870007'),
(120, 6, '12.43', '0.11', '12.45', '6.94', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568870309'),
(121, 6, '12.43', '0.16', '12.45', '6.94', '60.0', 'false', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568870611'),
(122, 6, '12.54', '0.16', '12.45', '6.94', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568870912'),
(123, 6, '12.54', '0.22', '12.52', '6.90', '60.0', 'true', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568871215'),
(124, 6, '13.08', '0.62', '13.07', '6.61', '100.0', 'true', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568871516'),
(125, 6, '13.29', '0.79', '13.28', '6.51', '100.0', 'true', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568871818'),
(126, 6, '13.29', '0.79', '13.28', '6.51', '100.0', 'true', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568872120'),
(127, 6, '13.29', '0.79', '13.28', '6.51', '100.0', 'true', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568872422'),
(128, 6, '13.29', '0.84', '13.28', '6.51', '100.0', 'true', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568872723'),
(129, 6, '13.29', '0.84', '13.28', '6.51', '100.0', 'true', '4.2', '0.12', '116.0', '0', '0', '67.0', '0', '0', '1568873025'),
(130, 6, '13.29', '0.84', '13.35', '6.47', '100.0', 'false', '4.2', '0.12', '117.0', '0', '0', '67.0', '0', '0', '1568873326'),
(131, 6, '13.4', '0.84', '13.35', '6.47', '100.0', 'true', '4.2', '0.12', '117.0', '0', '0', '67.0', '0', '0', '1568873628'),
(132, 6, '13.4', '0.9', '13.35', '6.47', '100.0', 'true', '4.2', '0.12', '117.0', '0', '0', '67.0', '0', '0', '1568873930'),
(133, 6, '13.4', '0.84', '13.35', '6.47', '100.0', 'true', '4.2', '0.12', '117.0', '0', '0', '67.0', '0', '0', '1568874232'),
(134, 6, '13.4', '0.9', '13.42', '6.44', '100.0', 'false', '4.2', '0.12', '117.0', '0', '0', '67.0', '0', '0', '1568874533'),
(135, 6, '13.4', '0.9', '13.42', '6.44', '100.0', 'false', '4.2', '0.12', '117.0', '0', '0', '67.0', '0', '0', '1568874835'),
(136, 6, '13.51', '0.96', '13.42', '6.44', '100.0', 'true', '4.2', '0.12', '117.0', '0', '0', '67.0', '0', '0', '1568875136'),
(137, 6, '13.51', '0.96', '13.42', '6.44', '100.0', 'true', '4.2', '0.12', '117.0', '0', '0', '67.0', '0', '0', '1568875438'),
(138, 6, '13.51', '0.96', '13.49', '6.40', '100.0', 'true', '4.2', '0.12', '117.0', '0', '0', '67.0', '0', '0', '1568875740'),
(139, 6, '13.51', '0.96', '13.49', '6.40', '100.0', 'true', '4.2', '0.12', '117.0', '0', '0', '67.0', '0', '0', '1568876041'),
(140, 6, '13.51', '0.96', '13.49', '6.40', '100.0', 'true', '4.2', '0.12', '117.0', '0', '0', '67.0', '0', '0', '1568876343'),
(141, 6, '13.51', '1.01', '13.56', '6.37', '100.0', 'false', '4.2', '0.12', '117.0', '0', '0', '67.0', '0', '0', '1568876645'),
(142, 6, '13.62', '1.01', '13.56', '6.37', '100.0', 'true', '4.2', '0.12', '117.0', '0', '0', '67.0', '0', '0', '1568876946'),
(143, 6, '13.62', '1.01', '13.63', '6.34', '100.0', 'false', '4.2', '0.12', '118.0', '0', '0', '67.0', '0', '0', '1568877248'),
(144, 6, '13.62', '1.01', '13.63', '6.34', '100.0', 'false', '4.2', '0.18', '118.0', '0', '0', '67.0', '0', '0', '1568877550'),
(145, 6, '13.62', '1.01', '13.63', '6.34', '100.0', 'false', '4.2', '0.18', '118.0', '0', '0', '67.0', '0', '0', '1568877851'),
(146, 6, '13.72', '1.07', '13.7', '6.31', '100.0', 'true', '4.2', '0.18', '118.0', '0', '0', '67.0', '0', '0', '1568878153'),
(147, 6, '13.72', '1.07', '13.7', '6.31', '100.0', 'true', '4.2', '0.18', '118.0', '0', '0', '67.0', '0', '0', '1568878455'),
(148, 6, '13.83', '1.07', '13.77', '6.27', '100.0', 'true', '4.2', '0.18', '118.0', '0', '0', '67.0', '0', '0', '1568878756'),
(149, 6, '13.83', '1.07', '13.77', '6.27', '100.0', 'true', '4.2', '0.18', '118.0', '0', '0', '67.0', '0', '0', '1568879058'),
(150, 6, '13.83', '1.01', '13.77', '6.27', '100.0', 'true', '4.2', '0.18', '118.0', '0', '0', '67.0', '0', '0', '1568879359'),
(151, 6, '13.83', '1.07', '13.84', '6.24', '100.0', 'false', '4.2', '0.18', '118.0', '0', '0', '67.0', '0', '0', '1568879661'),
(152, 6, '13.94', '1.07', '13.91', '6.21', '100.0', 'true', '4.2', '0.18', '118.0', '0', '0', '67.0', '0', '0', '1568879962'),
(153, 6, '14.05', '1.07', '13.91', '6.21', '100.0', 'true', '4.2', '0.18', '118.0', '0', '0', '67.0', '0', '0', '1568880264'),
(154, 6, '14.16', '1.07', '13.91', '6.21', '100.0', 'true', '4.2', '0.18', '118.0', '0', '0', '67.0', '0', '0', '1568880566'),
(155, 6, '14.7', '0.96', '13.91', '6.21', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568880867'),
(156, 6, '15.02', '0.9', '13.91', '6.21', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568881169'),
(157, 6, '15.24', '0.84', '13.91', '6.21', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568881471'),
(158, 6, '15.35', '0.79', '13.91', '6.21', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568881772'),
(159, 6, '15.56', '0.79', '13.91', '6.21', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568882074'),
(160, 6, '14.48', '0.9', '14.05', '6.15', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568882375'),
(161, 6, '16.1', '0.67', '13.91', '6.21', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568882677'),
(162, 6, '16.32', '0.62', '13.91', '6.21', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568882979'),
(163, 6, '16.32', '0.62', '13.91', '6.21', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568883280'),
(164, 6, '16.64', '0.56', '13.84', '6.24', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568883582'),
(165, 6, '16.75', '0.5', '13.84', '6.24', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568883883'),
(166, 6, '16.86', '0.5', '13.84', '6.24', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568884185'),
(167, 6, '16.86', '0.45', '13.84', '6.24', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568884487'),
(168, 6, '17.08', '0.45', '13.84', '6.24', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568884788'),
(169, 6, '16.1', '0.45', '13.84', '6.24', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568885090'),
(170, 6, '17.08', '0.45', '13.91', '6.21', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568885392'),
(171, 6, '16.43', '0.45', '13.91', '6.21', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568885693'),
(172, 6, '16.1', '0.45', '13.91', '6.21', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568885995'),
(173, 6, '15.56', '0.39', '13.84', '6.24', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568886296'),
(174, 6, '14.16', '0.45', '13.91', '6.21', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568886598'),
(175, 6, '14.81', '0.45', '13.98', '6.18', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568886900'),
(176, 6, '17.08', '0.16', '13.77', '6.27', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568887201'),
(177, 6, '17.72', '0.11', '13.21', '6.54', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568887503'),
(178, 6, '16.64', '0.16', '13.21', '6.54', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568887805'),
(179, 6, '16.32', '0.16', '13.28', '6.51', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568888107'),
(180, 6, '16.32', '0.22', '13.28', '6.51', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568888408'),
(181, 6, '16.32', '0.22', '13.28', '6.51', '100.0', 'true', '4.2', '0.18', '119.0', '0', '0', '67.0', '0', '0', '1568888710'),
(182, 6, '15.78', '0.16', '13.21', '6.54', '100.0', 'true', '4.2', '0.18', '120.0', '0', '0', '67.0', '0', '0', '1568889012'),
(183, 6, '17.62', '0.22', '13.35', '6.47', '100.0', 'true', '4.2', '0.18', '120.0', '0', '0', '67.0', '0', '0', '1568889314'),
(184, 6, '16.32', '0.16', '13.28', '6.51', '100.0', 'true', '4.2', '0.18', '120.0', '0', '0', '67.0', '0', '0', '1568889616'),
(185, 6, '16.97', '0.16', '13.28', '6.51', '100.0', 'true', '4.2', '0.18', '120.0', '0', '0', '67.0', '0', '0', '1568889918'),
(186, 6, '16.54', '0.22', '13.28', '6.51', '100.0', 'true', '4.2', '0.18', '120.0', '0', '0', '67.0', '0', '0', '1568890219'),
(187, 6, '17.72', '0.16', '13.35', '6.47', '100.0', 'true', '4.2', '0.18', '120.0', '0', '0', '67.0', '0', '0', '1568890521'),
(188, 6, '16.64', '0.22', '13.35', '6.47', '100.0', 'true', '4.2', '0.18', '120.0', '0', '0', '67.0', '0', '0', '1568890824'),
(189, 6, '17.29', '0.16', '13.35', '6.47', '100.0', 'true', '4.2', '0.18', '120.0', '0', '0', '67.0', '0', '0', '1568891126'),
(190, 6, '17.18', '0.16', '13.42', '6.44', '100.0', 'true', '4.2', '0.18', '120.0', '0', '0', '67.0', '0', '0', '1568891428'),
(191, 6, '16.75', '0.16', '13.35', '6.47', '100.0', 'true', '4.2', '0.18', '120.0', '0', '0', '67.0', '0', '0', '1568891730'),
(192, 6, '16.75', '0.16', '13.42', '6.44', '100.0', 'true', '4.2', '0.18', '120.0', '0', '0', '67.0', '0', '0', '1568892033'),
(193, 6, '16.64', '0.16', '13.35', '6.47', '100.0', 'true', '4.2', '0.18', '120.0', '0', '0', '67.0', '0', '0', '1568892335'),
(194, 6, '16.32', '0.16', '13.42', '6.44', '100.0', 'true', '4.2', '0.18', '120.0', '0', '0', '67.0', '0', '0', '1568892636'),
(195, 6, '16.0', '0.22', '13.42', '6.44', '100.0', 'true', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568892938'),
(196, 6, '15.67', '0.22', '13.42', '6.44', '100.0', 'true', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568893240'),
(197, 6, '15.56', '0.16', '13.42', '6.44', '100.0', 'true', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568893541'),
(198, 6, '15.35', '0.16', '13.42', '6.44', '100.0', 'true', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568893843'),
(199, 6, '14.7', '0.22', '13.49', '6.40', '100.0', 'true', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568894145'),
(200, 6, '14.16', '0.22', '13.49', '6.40', '100.0', 'true', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568894447'),
(201, 6, '14.16', '0.22', '13.49', '6.40', '100.0', 'true', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568894749'),
(202, 6, '13.94', '0.22', '13.49', '6.40', '100.0', 'true', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568895051'),
(203, 6, '13.83', '0.22', '13.49', '6.40', '100.0', 'true', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568895352'),
(204, 6, '13.62', '0.16', '13.49', '6.40', '100.0', 'true', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568895654'),
(205, 6, '13.4', '0.16', '13.42', '6.44', '100.0', 'false', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568895956'),
(206, 6, '13.29', '0.16', '13.28', '6.51', '100.0', 'true', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568896257'),
(207, 6, '13.18', '0.16', '13.21', '6.54', '100.0', 'false', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568896559'),
(208, 6, '13.08', '0.11', '13.0', '6.65', '100.0', 'true', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568896860'),
(209, 6, '12.97', '0.11', '12.93', '6.68', '100.0', 'true', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568897162'),
(210, 6, '12.86', '0.11', '12.86', '6.72', '80.0', 'true', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568897464'),
(211, 6, '12.86', '0.05', '12.86', '6.72', '80.0', 'true', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568897765'),
(212, 6, '12.86', '0.05', '12.8', '6.75', '80.0', 'true', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568898067'),
(213, 6, '12.75', '0.05', '12.8', '6.75', '80.0', 'false', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568898369'),
(214, 6, '12.75', '0.0', '12.73', '6.79', '80.0', 'true', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568898670'),
(215, 6, '12.75', '0.0', '12.73', '6.79', '80.0', 'true', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568898972'),
(216, 6, '12.75', '0.0', '12.73', '6.79', '80.0', 'true', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568899274'),
(217, 6, '12.75', '0.0', '12.73', '6.79', '80.0', 'true', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568899575'),
(218, 6, '11.67', '0.0', '12.73', '6.79', '80.0', 'false', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568899877'),
(219, 6, '10.27', '0.0', '12.73', '6.79', '80.0', 'false', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568900179'),
(220, 6, '8.64', '0.0', '12.73', '6.79', '80.0', 'false', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568900480'),
(221, 6, '6.37', '0.0', '12.73', '6.79', '80.0', 'false', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568900782'),
(222, 6, '3.78', '0.0', '12.73', '6.79', '80.0', 'false', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568901084'),
(223, 6, '2.16', '0.0', '12.73', '6.79', '80.0', 'false', '4.2', '0.12', '120.0', '0', '0', '67.0', '0', '0', '1568901385'),
(224, 6, '1.83', '0.0', '12.73', '6.79', '80.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568901687'),
(225, 6, '1.72', '0.0', '12.66', '6.82', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568901989'),
(226, 6, '1.72', '0.0', '12.66', '6.82', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568902291'),
(227, 6, '1.72', '0.0', '12.66', '6.82', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568902592'),
(228, 6, '1.72', '0.0', '12.66', '6.82', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568902894'),
(229, 6, '1.72', '0.0', '12.66', '6.82', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568903196'),
(230, 6, '1.72', '0.0', '12.66', '6.82', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568903498'),
(231, 6, '1.72', '0.0', '12.66', '6.82', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568903799'),
(232, 6, '1.72', '0.0', '12.66', '6.82', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568904101'),
(233, 6, '1.72', '0.0', '12.66', '6.82', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568904404'),
(234, 6, '1.72', '0.0', '12.66', '6.82', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568904707'),
(235, 6, '1.72', '0.0', '12.66', '6.82', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568905010'),
(236, 6, '1.72', '0.0', '12.66', '6.82', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568905313'),
(237, 6, '1.72', '0.0', '12.66', '6.82', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568905615'),
(238, 6, '1.72', '0.0', '12.66', '6.82', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568905919'),
(239, 6, '1.72', '0.0', '12.66', '6.82', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568906229'),
(240, 6, '1.72', '0.0', '12.59', '6.86', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568906532'),
(241, 6, '1.72', '0.0', '12.66', '6.82', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568906845'),
(242, 6, '1.72', '0.0', '12.59', '6.86', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568907150'),
(243, 6, '1.72', '0.0', '12.59', '6.86', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568907459'),
(244, 6, '1.72', '0.0', '12.59', '6.86', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568907762'),
(245, 6, '1.72', '0.0', '12.59', '6.86', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568908064'),
(246, 6, '1.72', '0.0', '12.59', '6.86', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568908366'),
(247, 6, '1.72', '0.0', '12.59', '6.86', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568908669'),
(248, 6, '1.72', '0.0', '12.59', '6.86', '60.0', 'false', '4.2', '0.12', '120.0', '0', '0', '68.0', '0', '0', '1568908976'),
(249, 6, '2.27', '0.0', '12.59', '6.86', '60.0', 'false', '4.2', '0.06', '120.0', '0', '0', '68.0', '0', '0', '1568909278'),
(250, 6, '1.72', '0.0', '12.8', '6.75', '80.0', 'false', '4.2', '0.0', '120.0', '0', '0', '68.0', '0', '0', '1568909580'),
(251, 6, '1.83', '0.0', '12.8', '6.75', '80.0', 'false', '4.2', '0.0', '120.0', '0', '0', '68.0', '0', '0', '1568909882'),
(252, 6, '1.72', '0.0', '12.8', '6.75', '80.0', 'false', '4.2', '0.0', '120.0', '0', '0', '68.0', '0', '0', '1568910183'),
(253, 6, '1.83', '0.0', '12.73', '6.79', '80.0', 'false', '4.2', '0.0', '120.0', '0', '0', '68.0', '0', '0', '1568913059'),
(254, 6, '1.83', '0.0', '12.73', '6.79', '80.0', 'false', '4.2', '0.0', '120.0', '0', '0', '68.0', '0', '0', '1568913360'),
(255, 6, '1.83', '0.0', '12.73', '6.79', '80.0', 'false', '4.2', '0.0', '120.0', '0', '0', '68.0', '0', '0', '1568913662'),
(256, 6, '1.83', '0.0', '12.73', '6.79', '80.0', 'false', '4.2', '0.0', '120.0', '0', '0', '68.0', '0', '0', '1568913965'),
(257, 6, '1.83', '0.0', '12.73', '6.79', '80.0', 'false', '4.2', '0.0', '120.0', '0', '0', '68.0', '0', '0', '1568914267'),
(258, 6, '1.83', '0.0', '12.73', '6.79', '80.0', 'false', '4.2', '0.0', '120.0', '0', '0', '68.0', '0', '0', '1568914569'),
(259, 6, '1.83', '0.0', '12.73', '6.79', '80.0', 'false', '4.2', '0.0', '120.0', '0', '0', '68.0', '0', '0', '1568914871'),
(260, 6, '1.83', '0.0', '12.73', '6.79', '80.0', 'false', '4.2', '0.0', '120.0', '0', '0', '68.0', '0', '0', '1568915172'),
(261, 6, '1.83', '0.0', '12.73', '6.79', '80.0', 'false', '4.2', '0.0', '120.0', '0', '0', '68.0', '0', '0', '1568915474'),
(262, 6, '1.83', '0.0', '12.73', '6.79', '80.0', 'false', '4.2', '0.0', '120.0', '0', '0', '68.0', '0', '0', '1568915777'),
(263, 6, '1.83', '0.0', '12.73', '6.79', '80.0', 'false', '4.2', '0.0', '120.0', '0', '0', '68.0', '0', '0', '1568916079'),
(264, 6, '1.83', '0.0', '12.73', '6.79', '80.0', 'false', '4.2', '0.0', '120.0', '0', '0', '68.0', '0', '0', '1568916381'),
(265, 6, '1.83', '0.0', '12.73', '6.79', '80.0', 'false', '4.2', '0.0', '120.0', '0', '0', '68.0', '0', '0', '1568916685'),
(266, 6, '1.83', '0.0', '12.73', '6.79', '80.0', 'false', '4.2', '0.0', '120.0', '0', '0', '68.0', '0', '0', '1568916987');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_geo_fence`
--
ALTER TABLE `tbl_geo_fence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pond_log`
--
ALTER TABLE `tbl_pond_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_solar_data`
--
ALTER TABLE `tbl_solar_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `tbl_geo_fence`
--
ALTER TABLE `tbl_geo_fence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_pond_log`
--
ALTER TABLE `tbl_pond_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `tbl_solar_data`
--
ALTER TABLE `tbl_solar_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
