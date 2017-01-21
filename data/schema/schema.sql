-- stub file

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for access_control_list
-- ----------------------------
CREATE TABLE `access_control_list` (
  `access_control_list_pk` int(3) NOT NULL AUTO_INCREMENT,
  `parent_id` int(3) NOT NULL,
  `rule_name` varchar(30) NOT NULL,
  `rule_fail_msg` varchar(255) DEFAULT NULL,
  `rule_desc` varchar(255) DEFAULT NULL,
  `allow` varchar(255) NOT NULL DEFAULT '{"allow":["none"]}',
  `deny` varchar(255) NOT NULL DEFAULT '{"deny":["all"]}',
  PRIMARY KEY (`access_control_list_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for client
-- ----------------------------
CREATE TABLE `client` (
  `client_pk` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) DEFAULT NULL,
  `api_key` varchar(140) DEFAULT NULL,
  `pass_phrase` varchar(140) DEFAULT NULL,
  PRIMARY KEY (`client_pk`),
  UNIQUE KEY `api_key_idx` (`api_key`),
  KEY `pass_phrase_idx` (`pass_phrase`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for client_fingerprint
-- ----------------------------
CREATE TABLE `client_user_fingerprint` (
  `client_user_fingerprint_pk` int(11) NOT NULL AUTO_INCREMENT,
  `canvas_fingerprint` varchar(32) NOT NULL,
  `digital_fingerprint` varchar(32) DEFAULT NULL,
  `ipv4` varchar(15) DEFAULT NULL,
  `ipv6` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`client_user_fingerprint_pk`),
  KEY `canvas_fingerprint_idx` (`canvas_fingerprint`),
  KEY `digital_fingerprint_idx` (`digital_fingerprint`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for fingerprint_to_client_user
-- ----------------------------
CREATE TABLE `fingerprint_to_client_user` (
  `fingerprint_to_client_user_pk` int(111) NOT NULL AUTO_INCREMENT,
  `client_user_fingerprint_pk` int(11) NOT NULL,
  `client_user_fk` int(11) NOT NULL,
  PRIMARY KEY (`fingerprint_to_client_user_pk`),
  KEY `client_user_fingerprint_pk_idx` (`client_user_fingerprint_pk`),
  KEY `client_user_fk_idx` (`client_user_fk`),
  CONSTRAINT `client_user_fingerprint_ibfk_1` FOREIGN KEY (`client_user_fingerprint_pk`) REFERENCES `client_user_fingerprint` (`client_user_fingerprint_pk`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `client_user_fingerprint_ibfk_2` FOREIGN KEY (`client_user_fk`) REFERENCES `client_user` (`client_user_pk`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for client_user
-- ----------------------------
CREATE TABLE `client_user` (
  `client_user_pk` int(11) NOT NULL AUTO_INCREMENT,
  `client_fk` int(11) NOT NULL,
  `user_role_fk` int(11) NOT NULL DEFAULT '6',
  `alias` varchar(60) NOT NULL,
  `email` varchar(130) NOT NULL,
  `password` varchar(80) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(60) NOT NULL,
  `state` varchar(4) NOT NULL,
  `country` varchar(4) NOT NULL,
  `postal_code` varchar(7) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `fax` varchar(15) NOT NULL,
  PRIMARY KEY (`client_user_pk`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `alias_idx` (`alias`),
  KEY `client_user_to_client_fk_idx` (`client_fk`),
  KEY `user_role_fk_idx` (`user_role_fk`),
  CONSTRAINT `client_user_to_client_fk_idx` FOREIGN KEY (`client_fk`) REFERENCES `client` (`client_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_role_fk_idx` FOREIGN KEY (`user_role_fk`) REFERENCES `user_role` (`user_role_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for client_whitelist
-- ----------------------------
CREATE TABLE `client_whitelist` (
  `client_whitelist_pk` int(11) NOT NULL AUTO_INCREMENT,
  `client_fk` int(11) NOT NULL,
  `ipv4` varchar(15) DEFAULT NULL,
  `ipv6` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`client_whitelist_pk`),
  KEY `client_whitelist_to_client_fk` (`client_fk`),
  KEY `ipv4_idx` (`ipv4`),
  KEY `ipv6_idx` (`ipv6`),
  CONSTRAINT `client_whitelist_to_client_fk` FOREIGN KEY (`client_fk`) REFERENCES `client` (`client_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- ----------------------------
-- Table structure for client_log
-- ----------------------------
CREATE TABLE `client_log` (
  `client_log_pk` int(11) NOT NULL AUTO_INCREMENT,
  `client_user_fk` int(11) NOT NULL,
  `client_user_fingerprint_fk` int(11) NOT NULL,
  `log_code` float(11,0) NOT NULL,
  `log_message` varchar(60) NOT NULL,
  `log_data` text NOT NULL,
  `log_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`client_log_pk`),
  KEY `client_log_to_client_user_fk` (`client_user_fk`),
  KEY `client_log_to_client_fingerprint_fk` (`client_user_fingerprint_fk`),
  CONSTRAINT `client_log_to_client_fingerprint_fk` FOREIGN KEY (`client_user_fingerprint_fk`) REFERENCES `client_fingerprint` (`client_user_fingerprint_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `client_log_to_client_user_fk` FOREIGN KEY (`client_user_fk`) REFERENCES `client_user` (`client_user_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for iso_countries
-- ----------------------------
CREATE TABLE `iso_countries` (
  `PK` int(11) NOT NULL AUTO_INCREMENT,
  `CommonName` varchar(255) DEFAULT NULL,
  `FormalName` varchar(255) DEFAULT NULL,
  `Capital` varchar(255) DEFAULT NULL,
  `ISO_4217_Currency_Code` varchar(3) DEFAULT NULL,
  `ISO_4217_Currency_Name` varchar(255) DEFAULT NULL,
  `ITU-T_Telephone_Code` varchar(5) DEFAULT NULL,
  `ISO_3166-1_2_Letter_Code` varchar(2) DEFAULT NULL,
  `ISO_3166-1_3 Letter_Code` varchar(3) DEFAULT NULL,
  `ISO_3166-1_Number` varchar(4) DEFAULT NULL,
  `IANA_Country_Code_TLD` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`PK`),
  KEY `ISO_2_Letter_idx` (`ISO_3166-1_2_Letter_Code`),
  KEY `ISO_3 Letter_idx` (`ISO_3166-1_3 Letter_Code`),
  KEY `Country_Code_TLD_idx` (`IANA_Country_Code_TLD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- ----------------------------
-- Table structure for user_role
-- ----------------------------
CREATE TABLE `user_role` (
  `user_role_pk` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(60) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_role_pk`),
  KEY `user_role_pk` (`user_role_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for cron_log
-- ----------------------------
CREATE TABLE `cron_log` (
  `cron_log_pk` int(11) NOT NULL AUTO_INCREMENT,
  `job_name` varchar(255) NOT NULL,
  `service_call` varchar(255) NOT NULL,
  `service_call_params` varchar(255) DEFAULT 'NULL',
  `service_call_result_summary` mediumtext,
  `service_call_result_data` text,
  `last_initialization` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `job_duration` time DEFAULT NULL,
  PRIMARY KEY (`cron_log_pk`),
  KEY `job_name_idx` (`job_name`),
  KEY `service_call_idx` (`service_call`),
  KEY `last_initialization_idx` (`last_initialization`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;









-- ----------------------------
-- default data
-- ----------------------------

INSERT INTO `access_control_list` VALUES ('1', '1', 'fuck_off', 'Oi! Fuck OFF!', 'block all', '{\"allow\":[\"none\"]}', '{\"deny\":[\"all\"]}');
INSERT INTO `access_control_list` VALUES ('2', '2', 'admin_access', 'Oi! Fuck OFF!', 'allow admin full access', '{\"allow\":[\"admin\"]}', '{\"deny\":[\"all\"]}');
INSERT INTO `access_control_list` VALUES ('3', '3', 'super_user_access', 'user permission failure', 'allow super user full access', '{\"allow\":[\"super_user\"]}', '{\"allow\":[\"all\"]}');
INSERT INTO `access_control_list` VALUES ('4', '3', 'super_userS_access', 'user permission failure', 'allow super userS full access', '{\"allow\":[\"super_user\",\"legal_adviser\",\"industry_adviser\"]}', '{\"deny\":[\"all\"]}');


INSERT INTO `user_role` VALUES ('1', 'admin', '1');
INSERT INTO `user_role` VALUES ('2', 'super', '2');
INSERT INTO `user_role` VALUES ('3', 'client', '3');
INSERT INTO `user_role` VALUES ('4', 'legal_adviser', '2');
INSERT INTO `user_role` VALUES ('5', 'industry_adviser', '2');
INSERT INTO `user_role` VALUES ('6', 'guest', '6');

INSERT INTO `client` VALUES ('1', 'admin', '1278a8914fbed0d712734afbec855d32', '$2y$10$XvU5AcC182EZ/5IGTfdoseeDYiDPzE6CRvbesR214WmvzqEt1iPBi');
INSERT INTO `client_user` VALUES ('1', '1', '1', 'admin', 'user@domain.com', '$2y$10$XvU5AcC182EZ/5IGTfdoseeDYiDPzE6CRvbesR214WmvzqEt1iPBi', 'first', 'last', '123 Street', 'town', 'state', 'Country', 'postal', '5554445555', '');



INSERT INTO `iso_countries` VALUES ('1', 'Afghanistan', 'Islamic State of Afghanistan', 'Kabul', 'AFN', 'Afghani', '93', 'AF', 'AFG', '4', '.af');
INSERT INTO `iso_countries` VALUES ('2', 'Albania', 'Republic of Albania', 'Tirana', 'ALL', 'Lek', '355', 'AL', 'ALB', '8', '.al');
INSERT INTO `iso_countries` VALUES ('3', 'Algeria', 'People\'s Democratic Republic of Algeria', 'Algiers', 'DZD', 'Dinar', '213', 'DZ', 'DZA', '12', '.dz');
INSERT INTO `iso_countries` VALUES ('4', 'Andorra', 'Principality of Andorra', 'Andorra la Vella', 'EUR', 'Euro', '376', 'AD', 'AND', '20', '.ad');
INSERT INTO `iso_countries` VALUES ('5', 'Angola', 'Republic of Angola', 'Luanda', 'AOA', 'Kwanza', '244', 'AO', 'AGO', '24', '.ao');
INSERT INTO `iso_countries` VALUES ('6', 'Antigua and Barbuda', null, 'Saint John\'s', 'XCD', 'Dollar', '-267', 'AG', 'ATG', '28', '.ag');
INSERT INTO `iso_countries` VALUES ('7', 'Argentina', 'Argentine Republic', 'Buenos Aires', 'ARS', 'Peso', '54', 'AR', 'ARG', '32', '.ar');
INSERT INTO `iso_countries` VALUES ('8', 'Armenia', 'Republic of Armenia', 'Yerevan', 'AMD', 'Dram', '374', 'AM', 'ARM', '51', '.am');
INSERT INTO `iso_countries` VALUES ('9', 'Australia', 'Commonwealth of Australia', 'Canberra', 'AUD', 'Dollar', '61', 'AU', 'AUS', '36', '.au');
INSERT INTO `iso_countries` VALUES ('10', 'Austria', 'Republic of Austria', 'Vienna', 'EUR', 'Euro', '43', 'AT', 'AUT', '40', '.at');
INSERT INTO `iso_countries` VALUES ('11', 'Azerbaijan', 'Republic of Azerbaijan', 'Baku', 'AZN', 'Manat', '994', 'AZ', 'AZE', '31', '.az');
INSERT INTO `iso_countries` VALUES ('12', 'Bahamas, The', 'Commonwealth of The Bahamas', 'Nassau', 'BSD', 'Dollar', '-241', 'BS', 'BHS', '44', '.bs');
INSERT INTO `iso_countries` VALUES ('13', 'Bahrain', 'Kingdom of Bahrain', 'Manama', 'BHD', 'Dinar', '973', 'BH', 'BHR', '48', '.bh');
INSERT INTO `iso_countries` VALUES ('14', 'Bangladesh', 'People\'s Republic of Bangladesh', 'Dhaka', 'BDT', 'Taka', '880', 'BD', 'BGD', '50', '.bd');
INSERT INTO `iso_countries` VALUES ('15', 'Barbados', null, 'Bridgetown', 'BBD', 'Dollar', '-245', 'BB', 'BRB', '52', '.bb');
INSERT INTO `iso_countries` VALUES ('16', 'Belarus', 'Republic of Belarus', 'Minsk', 'BYR', 'Ruble', '375', 'BY', 'BLR', '112', '.by');
INSERT INTO `iso_countries` VALUES ('17', 'Belgium', 'Kingdom of Belgium', 'Brussels', 'EUR', 'Euro', '32', 'BE', 'BEL', '56', '.be');
INSERT INTO `iso_countries` VALUES ('18', 'Belize', null, 'Belmopan', 'BZD', 'Dollar', '501', 'BZ', 'BLZ', '84', '.bz');
INSERT INTO `iso_countries` VALUES ('19', 'Benin', 'Republic of Benin', 'Porto-Novo', 'XOF', 'Franc', '229', 'BJ', 'BEN', '204', '.bj');
INSERT INTO `iso_countries` VALUES ('20', 'Bhutan', 'Kingdom of Bhutan', 'Thimphu', 'BTN', 'Ngultrum', '975', 'BT', 'BTN', '64', '.bt');
INSERT INTO `iso_countries` VALUES ('21', 'Bolivia', 'Republic of Bolivia', 'La Paz (administrative/legislative) and Sucre (judical)', 'BOB', 'Boliviano', '591', 'BO', 'BOL', '68', '.bo');
INSERT INTO `iso_countries` VALUES ('22', 'Bosnia and Herzegovina', null, 'Sarajevo', 'BAM', 'Marka', '387', 'BA', 'BIH', '70', '.ba');
INSERT INTO `iso_countries` VALUES ('23', 'Botswana', 'Republic of Botswana', 'Gaborone', 'BWP', 'Pula', '267', 'BW', 'BWA', '72', '.bw');
INSERT INTO `iso_countries` VALUES ('24', 'Brazil', 'Federative Republic of Brazil', 'Brasilia', 'BRL', 'Real', '55', 'BR', 'BRA', '76', '.br');
INSERT INTO `iso_countries` VALUES ('25', 'Brunei', 'Negara Brunei Darussalam', 'Bandar Seri Begawan', 'BND', 'Dollar', '673', 'BN', 'BRN', '96', '.bn');
INSERT INTO `iso_countries` VALUES ('26', 'Bulgaria', 'Republic of Bulgaria', 'Sofia', 'BGN', 'Lev', '359', 'BG', 'BGR', '100', '.bg');
INSERT INTO `iso_countries` VALUES ('27', 'Burkina Faso', null, 'Ouagadougou', 'XOF', 'Franc', '226', 'BF', 'BFA', '854', '.bf');
INSERT INTO `iso_countries` VALUES ('28', 'Burundi', 'Republic of Burundi', 'Bujumbura', 'BIF', 'Franc', '257', 'BI', 'BDI', '108', '.bi');
INSERT INTO `iso_countries` VALUES ('29', 'Cambodia', 'Kingdom of Cambodia', 'Phnom Penh', 'KHR', 'Riels', '855', 'KH', 'KHM', '116', '.kh');
INSERT INTO `iso_countries` VALUES ('30', 'Cameroon', 'Republic of Cameroon', 'Yaounde', 'XAF', 'Franc', '237', 'CM', 'CMR', '120', '.cm');
INSERT INTO `iso_countries` VALUES ('31', 'Canada', null, 'Ottawa', 'CAD', 'Dollar', '1', 'CA', 'CAN', '124', '.ca');
INSERT INTO `iso_countries` VALUES ('32', 'Cape Verde', 'Republic of Cape Verde', 'Praia', 'CVE', 'Escudo', '238', 'CV', 'CPV', '132', '.cv');
INSERT INTO `iso_countries` VALUES ('33', 'Central African Republic', null, 'Bangui', 'XAF', 'Franc', '236', 'CF', 'CAF', '140', '.cf');
INSERT INTO `iso_countries` VALUES ('34', 'Chad', 'Republic of Chad', 'N\'Djamena', 'XAF', 'Franc', '235', 'TD', 'TCD', '148', '.td');
INSERT INTO `iso_countries` VALUES ('35', 'Chile', 'Republic of Chile', 'Santiago (administrative/judical) and Valparaiso (legislative)', 'CLP', 'Peso', '56', 'CL', 'CHL', '152', '.cl');
INSERT INTO `iso_countries` VALUES ('36', 'China, People\'s Republic of', 'People\'s Republic of China', 'Beijing', 'CNY', 'Yuan Renminbi', '86', 'CN', 'CHN', '156', '.cn');
INSERT INTO `iso_countries` VALUES ('37', 'Colombia', 'Republic of Colombia', 'Bogota', 'COP', 'Peso', '57', 'CO', 'COL', '170', '.co');
INSERT INTO `iso_countries` VALUES ('38', 'Comoros', 'Union of Comoros', 'Moroni', 'KMF', 'Franc', '269', 'KM', 'COM', '174', '.km');
INSERT INTO `iso_countries` VALUES ('39', 'Congo, (Congo Â– Kinshasa)', 'Democratic Republic of the Congo', 'Kinshasa', 'CDF', 'Franc', '243', 'CD', 'COD', '180', '.cd');
INSERT INTO `iso_countries` VALUES ('40', 'Congo, (Congo Â– Brazzaville)', 'Republic of the Congo', 'Brazzaville', 'XAF', 'Franc', '242', 'CG', 'COG', '178', '.cg');
INSERT INTO `iso_countries` VALUES ('41', 'Costa Rica', 'Republic of Costa Rica', 'San Jose', 'CRC', 'Colon', '506', 'CR', 'CRI', '188', '.cr');
INSERT INTO `iso_countries` VALUES ('42', 'Cote d\'Ivoire (Ivory Coast)', 'Republic of Cote d\'Ivoire', 'Yamoussoukro', 'XOF', 'Franc', '225', 'CI', 'CIV', '384', '.ci');
INSERT INTO `iso_countries` VALUES ('43', 'Croatia', 'Republic of Croatia', 'Zagreb', 'HRK', 'Kuna', '385', 'HR', 'HRV', '191', '.hr');
INSERT INTO `iso_countries` VALUES ('44', 'Cuba', 'Republic of Cuba', 'Havana', 'CUP', 'Peso', '53', 'CU', 'CUB', '192', '.cu');
INSERT INTO `iso_countries` VALUES ('45', 'Cyprus', 'Republic of Cyprus', 'Nicosia', 'CYP', 'Pound', '357', 'CY', 'CYP', '196', '.cy');
INSERT INTO `iso_countries` VALUES ('46', 'Czech Republic', null, 'Prague', 'CZK', 'Koruna', '420', 'CZ', 'CZE', '203', '.cz');
INSERT INTO `iso_countries` VALUES ('47', 'Denmark', 'Kingdom of Denmark', 'Copenhagen', 'DKK', 'Krone', '45', 'DK', 'DNK', '208', '.dk');
INSERT INTO `iso_countries` VALUES ('48', 'Djibouti', 'Republic of Djibouti', 'Djibouti', 'DJF', 'Franc', '253', 'DJ', 'DJI', '262', '.dj');
INSERT INTO `iso_countries` VALUES ('49', 'Dominica', 'Commonwealth of Dominica', 'Roseau', 'XCD', 'Dollar', '-766', 'DM', 'DMA', '212', '.dm');
INSERT INTO `iso_countries` VALUES ('50', 'Dominican Republic', null, 'Santo Domingo', 'DOP', 'Peso', '+1-80', 'DO', 'DOM', '214', '.do');
INSERT INTO `iso_countries` VALUES ('51', 'Ecuador', 'Republic of Ecuador', 'Quito', 'USD', 'Dollar', '593', 'EC', 'ECU', '218', '.ec');
INSERT INTO `iso_countries` VALUES ('52', 'Egypt', 'Arab Republic of Egypt', 'Cairo', 'EGP', 'Pound', '20', 'EG', 'EGY', '818', '.eg');
INSERT INTO `iso_countries` VALUES ('53', 'El Salvador', 'Republic of El Salvador', 'San Salvador', 'USD', 'Dollar', '503', 'SV', 'SLV', '222', '.sv');
INSERT INTO `iso_countries` VALUES ('54', 'Equatorial Guinea', 'Republic of Equatorial Guinea', 'Malabo', 'XAF', 'Franc', '240', 'GQ', 'GNQ', '226', '.gq');
INSERT INTO `iso_countries` VALUES ('55', 'Eritrea', 'State of Eritrea', 'Asmara', 'ERN', 'Nakfa', '291', 'ER', 'ERI', '232', '.er');
INSERT INTO `iso_countries` VALUES ('56', 'Estonia', 'Republic of Estonia', 'Tallinn', 'EEK', 'Kroon', '372', 'EE', 'EST', '233', '.ee');
INSERT INTO `iso_countries` VALUES ('57', 'Ethiopia', 'Federal Democratic Republic of Ethiopia', 'Addis Ababa', 'ETB', 'Birr', '251', 'ET', 'ETH', '231', '.et');
INSERT INTO `iso_countries` VALUES ('58', 'Fiji', 'Republic of the Fiji Islands', 'Suva', 'FJD', 'Dollar', '679', 'FJ', 'FJI', '242', '.fj');
INSERT INTO `iso_countries` VALUES ('59', 'Finland', 'Republic of Finland', 'Helsinki', 'EUR', 'Euro', '358', 'FI', 'FIN', '246', '.fi');
INSERT INTO `iso_countries` VALUES ('60', 'France', 'French Republic', 'Paris', 'EUR', 'Euro', '33', 'FR', 'FRA', '250', '.fr');
INSERT INTO `iso_countries` VALUES ('61', 'Gabon', 'Gabonese Republic', 'Libreville', 'XAF', 'Franc', '241', 'GA', 'GAB', '266', '.ga');
INSERT INTO `iso_countries` VALUES ('62', 'Gambia, The', 'Republic of The Gambia', 'Banjul', 'GMD', 'Dalasi', '220', 'GM', 'GMB', '270', '.gm');
INSERT INTO `iso_countries` VALUES ('63', 'Georgia', 'Republic of Georgia', 'Tbilisi', 'GEL', 'Lari', '995', 'GE', 'GEO', '268', '.ge');
INSERT INTO `iso_countries` VALUES ('64', 'Germany', 'Federal Republic of Germany', 'Berlin', 'EUR', 'Euro', '49', 'DE', 'DEU', '276', '.de');
INSERT INTO `iso_countries` VALUES ('65', 'Ghana', 'Republic of Ghana', 'Accra', 'GHC', 'Cedi', '233', 'GH', 'GHA', '288', '.gh');
INSERT INTO `iso_countries` VALUES ('66', 'Greece', 'Hellenic Republic', 'Athens', 'EUR', 'Euro', '30', 'GR', 'GRC', '300', '.gr');
INSERT INTO `iso_countries` VALUES ('67', 'Grenada', null, 'Saint George\'s', 'XCD', 'Dollar', '-472', 'GD', 'GRD', '308', '.gd');
INSERT INTO `iso_countries` VALUES ('68', 'Guatemala', 'Republic of Guatemala', 'Guatemala', 'GTQ', 'Quetzal', '502', 'GT', 'GTM', '320', '.gt');
INSERT INTO `iso_countries` VALUES ('69', 'Guinea', 'Republic of Guinea', 'Conakry', 'GNF', 'Franc', '224', 'GN', 'GIN', '324', '.gn');
INSERT INTO `iso_countries` VALUES ('70', 'Guinea-Bissau', 'Republic of Guinea-Bissau', 'Bissau', 'XOF', 'Franc', '245', 'GW', 'GNB', '624', '.gw');
INSERT INTO `iso_countries` VALUES ('71', 'Guyana', 'Co-operative Republic of Guyana', 'Georgetown', 'GYD', 'Dollar', '592', 'GY', 'GUY', '328', '.gy');
INSERT INTO `iso_countries` VALUES ('72', 'Haiti', 'Republic of Haiti', 'Port-au-Prince', 'HTG', 'Gourde', '509', 'HT', 'HTI', '332', '.ht');
INSERT INTO `iso_countries` VALUES ('73', 'Honduras', 'Republic of Honduras', 'Tegucigalpa', 'HNL', 'Lempira', '504', 'HN', 'HND', '340', '.hn');
INSERT INTO `iso_countries` VALUES ('74', 'Hungary', 'Republic of Hungary', 'Budapest', 'HUF', 'Forint', '36', 'HU', 'HUN', '348', '.hu');
INSERT INTO `iso_countries` VALUES ('75', 'Iceland', 'Republic of Iceland', 'Reykjavik', 'ISK', 'Krona', '354', 'IS', 'ISL', '352', '.is');
INSERT INTO `iso_countries` VALUES ('76', 'India', 'Republic of India', 'New Delhi', 'INR', 'Rupee', '91', 'IN', 'IND', '356', '.in');
INSERT INTO `iso_countries` VALUES ('77', 'Indonesia', 'Republic of Indonesia', 'Jakarta', 'IDR', 'Rupiah', '62', 'ID', 'IDN', '360', '.id');
INSERT INTO `iso_countries` VALUES ('78', 'Iran', 'Islamic Republic of Iran', 'Tehran', 'IRR', 'Rial', '98', 'IR', 'IRN', '364', '.ir');
INSERT INTO `iso_countries` VALUES ('79', 'Iraq', 'Republic of Iraq', 'Baghdad', 'IQD', 'Dinar', '964', 'IQ', 'IRQ', '368', '.iq');
INSERT INTO `iso_countries` VALUES ('80', 'Ireland', null, 'Dublin', 'EUR', 'Euro', '353', 'IE', 'IRL', '372', '.ie');
INSERT INTO `iso_countries` VALUES ('81', 'Israel', 'State of Israel', 'Jerusalem', 'ILS', 'Shekel', '972', 'IL', 'ISR', '376', '.il');
INSERT INTO `iso_countries` VALUES ('82', 'Italy', 'Italian Republic', 'Rome', 'EUR', 'Euro', '39', 'IT', 'ITA', '380', '.it');
INSERT INTO `iso_countries` VALUES ('83', 'Jamaica', null, 'Kingston', 'JMD', 'Dollar', '-875', 'JM', 'JAM', '388', '.jm');
INSERT INTO `iso_countries` VALUES ('84', 'Japan', null, 'Tokyo', 'JPY', 'Yen', '81', 'JP', 'JPN', '392', '.jp');
INSERT INTO `iso_countries` VALUES ('85', 'Jordan', 'Hashemite Kingdom of Jordan', 'Amman', 'JOD', 'Dinar', '962', 'JO', 'JOR', '400', '.jo');
INSERT INTO `iso_countries` VALUES ('86', 'Kazakhstan', 'Republic of Kazakhstan', 'Astana', 'KZT', 'Tenge', '7', 'KZ', 'KAZ', '398', '.kz');
INSERT INTO `iso_countries` VALUES ('87', 'Kenya', 'Republic of Kenya', 'Nairobi', 'KES', 'Shilling', '254', 'KE', 'KEN', '404', '.ke');
INSERT INTO `iso_countries` VALUES ('88', 'Kiribati', 'Republic of Kiribati', 'Tarawa', 'AUD', 'Dollar', '686', 'KI', 'KIR', '296', '.ki');
INSERT INTO `iso_countries` VALUES ('89', 'Korea, North', 'Democratic People\'s Republic of Korea', 'Pyongyang', 'KPW', 'Won', '850', 'KP', 'PRK', '408', '.kp');
INSERT INTO `iso_countries` VALUES ('90', 'Korea, South', 'Republic of Korea', 'Seoul', 'KRW', 'Won', '82', 'KR', 'KOR', '410', '.kr');
INSERT INTO `iso_countries` VALUES ('91', 'Kuwait', 'State of Kuwait', 'Kuwait', 'KWD', 'Dinar', '965', 'KW', 'KWT', '414', '.kw');
INSERT INTO `iso_countries` VALUES ('92', 'Kyrgyzstan', 'Kyrgyz Republic', 'Bishkek', 'KGS', 'Som', '996', 'KG', 'KGZ', '417', '.kg');
INSERT INTO `iso_countries` VALUES ('93', 'Laos', 'Lao People\'s Democratic Republic', 'Vientiane', 'LAK', 'Kip', '856', 'LA', 'LAO', '418', '.la');
INSERT INTO `iso_countries` VALUES ('94', 'Latvia', 'Republic of Latvia', 'Riga', 'LVL', 'Lat', '371', 'LV', 'LVA', '428', '.lv');
INSERT INTO `iso_countries` VALUES ('95', 'Lebanon', 'Lebanese Republic', 'Beirut', 'LBP', 'Pound', '961', 'LB', 'LBN', '422', '.lb');
INSERT INTO `iso_countries` VALUES ('96', 'Lesotho', 'Kingdom of Lesotho', 'Maseru', 'LSL', 'Loti', '266', 'LS', 'LSO', '426', '.ls');
INSERT INTO `iso_countries` VALUES ('97', 'Liberia', 'Republic of Liberia', 'Monrovia', 'LRD', 'Dollar', '231', 'LR', 'LBR', '430', '.lr');
INSERT INTO `iso_countries` VALUES ('98', 'Libya', 'Great Socialist People\'s Libyan Arab Jamahiriya', 'Tripoli', 'LYD', 'Dinar', '218', 'LY', 'LBY', '434', '.ly');
INSERT INTO `iso_countries` VALUES ('99', 'Liechtenstein', 'Principality of Liechtenstein', 'Vaduz', 'CHF', 'Franc', '423', 'LI', 'LIE', '438', '.li');
INSERT INTO `iso_countries` VALUES ('100', 'Lithuania', 'Republic of Lithuania', 'Vilnius', 'LTL', 'Litas', '370', 'LT', 'LTU', '440', '.lt');
INSERT INTO `iso_countries` VALUES ('101', 'Luxembourg', 'Grand Duchy of Luxembourg', 'Luxembourg', 'EUR', 'Euro', '352', 'LU', 'LUX', '442', '.lu');
INSERT INTO `iso_countries` VALUES ('102', 'Macedonia', 'Republic of Macedonia', 'Skopje', 'MKD', 'Denar', '389', 'MK', 'MKD', '807', '.mk');
INSERT INTO `iso_countries` VALUES ('103', 'Madagascar', 'Republic of Madagascar', 'Antananarivo', 'MGA', 'Ariary', '261', 'MG', 'MDG', '450', '.mg');
INSERT INTO `iso_countries` VALUES ('104', 'Malawi', 'Republic of Malawi', 'Lilongwe', 'MWK', 'Kwacha', '265', 'MW', 'MWI', '454', '.mw');
INSERT INTO `iso_countries` VALUES ('105', 'Malaysia', null, 'Kuala Lumpur (legislative/judical) and Putrajaya (administrative)', 'MYR', 'Ringgit', '60', 'MY', 'MYS', '458', '.my');
INSERT INTO `iso_countries` VALUES ('106', 'Maldives', 'Republic of Maldives', 'Male', 'MVR', 'Rufiyaa', '960', 'MV', 'MDV', '462', '.mv');
INSERT INTO `iso_countries` VALUES ('107', 'Mali', 'Republic of Mali', 'Bamako', 'XOF', 'Franc', '223', 'ML', 'MLI', '466', '.ml');
INSERT INTO `iso_countries` VALUES ('108', 'Malta', 'Republic of Malta', 'Valletta', 'MTL', 'Lira', '356', 'MT', 'MLT', '470', '.mt');
INSERT INTO `iso_countries` VALUES ('109', 'Marshall Islands', 'Republic of the Marshall Islands', 'Majuro', 'USD', 'Dollar', '692', 'MH', 'MHL', '584', '.mh');
INSERT INTO `iso_countries` VALUES ('110', 'Mauritania', 'Islamic Republic of Mauritania', 'Nouakchott', 'MRO', 'Ouguiya', '222', 'MR', 'MRT', '478', '.mr');
INSERT INTO `iso_countries` VALUES ('111', 'Mauritius', 'Republic of Mauritius', 'Port Louis', 'MUR', 'Rupee', '230', 'MU', 'MUS', '480', '.mu');
INSERT INTO `iso_countries` VALUES ('112', 'Mexico', 'United Mexican States', 'Mexico', 'MXN', 'Peso', '52', 'MX', 'MEX', '484', '.mx');
INSERT INTO `iso_countries` VALUES ('113', 'Micronesia', 'Federated States of Micronesia', 'Palikir', 'USD', 'Dollar', '691', 'FM', 'FSM', '583', '.fm');
INSERT INTO `iso_countries` VALUES ('114', 'Moldova', 'Republic of Moldova', 'Chisinau', 'MDL', 'Leu', '373', 'MD', 'MDA', '498', '.md');
INSERT INTO `iso_countries` VALUES ('115', 'Monaco', 'Principality of Monaco', 'Monaco', 'EUR', 'Euro', '377', 'MC', 'MCO', '492', '.mc');
INSERT INTO `iso_countries` VALUES ('116', 'Mongolia', null, 'Ulaanbaatar', 'MNT', 'Tugrik', '976', 'MN', 'MNG', '496', '.mn');
INSERT INTO `iso_countries` VALUES ('117', 'Montenegro', 'Republic of Montenegro', 'Podgorica', 'EUR', 'Euro', '382', 'ME', 'MNE', '499', '.me a');
INSERT INTO `iso_countries` VALUES ('118', 'Morocco', 'Kingdom of Morocco', 'Rabat', 'MAD', 'Dirham', '212', 'MA', 'MAR', '504', '.ma');
INSERT INTO `iso_countries` VALUES ('119', 'Mozambique', 'Republic of Mozambique', 'Maputo', 'MZM', 'Meticail', '258', 'MZ', 'MOZ', '508', '.mz');
INSERT INTO `iso_countries` VALUES ('120', 'Myanmar (Burma)', 'Union of Myanmar', 'Naypyidaw', 'MMK', 'Kyat', '95', 'MM', 'MMR', '104', '.mm');
INSERT INTO `iso_countries` VALUES ('121', 'Namibia', 'Republic of Namibia', 'Windhoek', 'NAD', 'Dollar', '264', 'NA', 'NAM', '516', '.na');
INSERT INTO `iso_countries` VALUES ('122', 'Nauru', 'Republic of Nauru', 'Yaren', 'AUD', 'Dollar', '674', 'NR', 'NRU', '520', '.nr');
INSERT INTO `iso_countries` VALUES ('123', 'Nepal', null, 'Kathmandu', 'NPR', 'Rupee', '977', 'NP', 'NPL', '524', '.np');
INSERT INTO `iso_countries` VALUES ('124', 'Netherlands', 'Kingdom of the Netherlands', 'Amsterdam (administrative) and The Hague (legislative/judical)', 'EUR', 'Euro', '31', 'NL', 'NLD', '528', '.nl');
INSERT INTO `iso_countries` VALUES ('125', 'New Zealand', null, 'Wellington', 'NZD', 'Dollar', '64', 'NZ', 'NZL', '554', '.nz');
INSERT INTO `iso_countries` VALUES ('126', 'Nicaragua', 'Republic of Nicaragua', 'Managua', 'NIO', 'Cordoba', '505', 'NI', 'NIC', '558', '.ni');
INSERT INTO `iso_countries` VALUES ('127', 'Niger', 'Republic of Niger', 'Niamey', 'XOF', 'Franc', '227', 'NE', 'NER', '562', '.ne');
INSERT INTO `iso_countries` VALUES ('128', 'Nigeria', 'Federal Republic of Nigeria', 'Abuja', 'NGN', 'Naira', '234', 'NG', 'NGA', '566', '.ng');
INSERT INTO `iso_countries` VALUES ('129', 'Norway', 'Kingdom of Norway', 'Oslo', 'NOK', 'Krone', '47', 'NO', 'NOR', '578', '.no');
INSERT INTO `iso_countries` VALUES ('130', 'Oman', 'Sultanate of Oman', 'Muscat', 'OMR', 'Rial', '968', 'OM', 'OMN', '512', '.om');
INSERT INTO `iso_countries` VALUES ('131', 'Pakistan', 'Islamic Republic of Pakistan', 'Islamabad', 'PKR', 'Rupee', '92', 'PK', 'PAK', '586', '.pk');
INSERT INTO `iso_countries` VALUES ('132', 'Palau', 'Republic of Palau', 'Melekeok', 'USD', 'Dollar', '680', 'PW', 'PLW', '585', '.pw');
INSERT INTO `iso_countries` VALUES ('133', 'Panama', 'Republic of Panama', 'Panama', 'PAB', 'Balboa', '507', 'PA', 'PAN', '591', '.pa');
INSERT INTO `iso_countries` VALUES ('134', 'Papua New Guinea', 'Independent State of Papua New Guinea', 'Port Moresby', 'PGK', 'Kina', '675', 'PG', 'PNG', '598', '.pg');
INSERT INTO `iso_countries` VALUES ('135', 'Paraguay', 'Republic of Paraguay', 'Asuncion', 'PYG', 'Guarani', '595', 'PY', 'PRY', '600', '.py');
INSERT INTO `iso_countries` VALUES ('136', 'Peru', 'Republic of Peru', 'Lima', 'PEN', 'Sol', '51', 'PE', 'PER', '604', '.pe');
INSERT INTO `iso_countries` VALUES ('137', 'Philippines', 'Republic of the Philippines', 'Manila', 'PHP', 'Peso', '63', 'PH', 'PHL', '608', '.ph');
INSERT INTO `iso_countries` VALUES ('138', 'Poland', 'Republic of Poland', 'Warsaw', 'PLN', 'Zloty', '48', 'PL', 'POL', '616', '.pl');
INSERT INTO `iso_countries` VALUES ('139', 'Portugal', 'Portuguese Republic', 'Lisbon', 'EUR', 'Euro', '351', 'PT', 'PRT', '620', '.pt');
INSERT INTO `iso_countries` VALUES ('140', 'Qatar', 'State of Qatar', 'Doha', 'QAR', 'Rial', '974', 'QA', 'QAT', '634', '.qa');
INSERT INTO `iso_countries` VALUES ('141', 'Romania', null, 'Bucharest', 'RON', 'Leu', '40', 'RO', 'ROU', '642', '.ro');
INSERT INTO `iso_countries` VALUES ('142', 'Russia', 'Russian Federation', 'Moscow', 'RUB', 'Ruble', '7', 'RU', 'RUS', '643', '.ru a');
INSERT INTO `iso_countries` VALUES ('143', 'Rwanda', 'Republic of Rwanda', 'Kigali', 'RWF', 'Franc', '250', 'RW', 'RWA', '646', '.rw');
INSERT INTO `iso_countries` VALUES ('144', 'Saint Kitts and Nevis', 'Federation of Saint Kitts and Nevis', 'Basseterre', 'XCD', 'Dollar', '-868', 'KN', 'KNA', '659', '.kn');
INSERT INTO `iso_countries` VALUES ('145', 'Saint Lucia', null, 'Castries', 'XCD', 'Dollar', '-757', 'LC', 'LCA', '662', '.lc');
INSERT INTO `iso_countries` VALUES ('146', 'Saint Vincent and the Grenadines', null, 'Kingstown', 'XCD', 'Dollar', '-783', 'VC', 'VCT', '670', '.vc');
INSERT INTO `iso_countries` VALUES ('147', 'Samoa', 'Independent State of Samoa', 'Apia', 'WST', 'Tala', '685', 'WS', 'WSM', '882', '.ws');
INSERT INTO `iso_countries` VALUES ('148', 'San Marino', 'Republic of San Marino', 'San Marino', 'EUR', 'Euro', '378', 'SM', 'SMR', '674', '.sm');
INSERT INTO `iso_countries` VALUES ('149', 'Sao Tome and Principe', 'Democratic Republic of Sao Tome and Principe', 'Sao Tome', 'STD', 'Dobra', '239', 'ST', 'STP', '678', '.st');
INSERT INTO `iso_countries` VALUES ('150', 'Saudi Arabia', 'Kingdom of Saudi Arabia', 'Riyadh', 'SAR', 'Rial', '966', 'SA', 'SAU', '682', '.sa');
INSERT INTO `iso_countries` VALUES ('151', 'Senegal', 'Republic of Senegal', 'Dakar', 'XOF', 'Franc', '221', 'SN', 'SEN', '686', '.sn');
INSERT INTO `iso_countries` VALUES ('152', 'Serbia', 'Republic of Serbia', 'Belgrade', 'RSD', 'Dinar', '381', 'RS', 'SRB', '688', '.rs a');
INSERT INTO `iso_countries` VALUES ('153', 'Seychelles', 'Republic of Seychelles', 'Victoria', 'SCR', 'Rupee', '248', 'SC', 'SYC', '690', '.sc');
INSERT INTO `iso_countries` VALUES ('154', 'Sierra Leone', 'Republic of Sierra Leone', 'Freetown', 'SLL', 'Leone', '232', 'SL', 'SLE', '694', '.sl');
INSERT INTO `iso_countries` VALUES ('155', 'Singapore', 'Republic of Singapore', 'Singapore', 'SGD', 'Dollar', '65', 'SG', 'SGP', '702', '.sg');
INSERT INTO `iso_countries` VALUES ('156', 'Slovakia', 'Slovak Republic', 'Bratislava', 'SKK', 'Koruna', '421', 'SK', 'SVK', '703', '.sk');
INSERT INTO `iso_countries` VALUES ('157', 'Slovenia', 'Republic of Slovenia', 'Ljubljana', 'EUR', 'Euro', '386', 'SI', 'SVN', '705', '.si');
INSERT INTO `iso_countries` VALUES ('158', 'Solomon Islands', null, 'Honiara', 'SBD', 'Dollar', '677', 'SB', 'SLB', '90', '.sb');
INSERT INTO `iso_countries` VALUES ('159', 'Somalia', null, 'Mogadishu', 'SOS', 'Shilling', '252', 'SO', 'SOM', '706', '.so');
INSERT INTO `iso_countries` VALUES ('160', 'South Africa', 'Republic of South Africa', 'Pretoria (administrative), Cape Town (legislative), and Bloemfontein (judical)', 'ZAR', 'Rand', '27', 'ZA', 'ZAF', '710', '.za');
INSERT INTO `iso_countries` VALUES ('161', 'Spain', 'Kingdom of Spain', 'Madrid', 'EUR', 'Euro', '34', 'ES', 'ESP', '724', '.es');
INSERT INTO `iso_countries` VALUES ('162', 'Sri Lanka', 'Democratic Socialist Republic of Sri Lanka', 'Colombo (administrative/judical) and Sri Jayewardenepura Kotte (legislative)', 'LKR', 'Rupee', '94', 'LK', 'LKA', '144', '.lk');
INSERT INTO `iso_countries` VALUES ('163', 'Sudan', 'Republic of the Sudan', 'Khartoum', 'SDD', 'Dinar', '249', 'SD', 'SDN', '736', '.sd');
INSERT INTO `iso_countries` VALUES ('164', 'Suriname', 'Republic of Suriname', 'Paramaribo', 'SRD', 'Dollar', '597', 'SR', 'SUR', '740', '.sr');
INSERT INTO `iso_countries` VALUES ('165', 'Swaziland', 'Kingdom of Swaziland', 'Mbabane (administrative) and Lobamba (legislative)', 'SZL', 'Lilangeni', '268', 'SZ', 'SWZ', '748', '.sz');
INSERT INTO `iso_countries` VALUES ('166', 'Sweden', 'Kingdom of Sweden', 'Stockholm', 'SEK', 'Kronoa', '46', 'SE', 'SWE', '752', '.se');
INSERT INTO `iso_countries` VALUES ('167', 'Switzerland', 'Swiss Confederation', 'Bern', 'CHF', 'Franc', '41', 'CH', 'CHE', '756', '.ch');
INSERT INTO `iso_countries` VALUES ('168', 'Syria', 'Syrian Arab Republic', 'Damascus', 'SYP', 'Pound', '963', 'SY', 'SYR', '760', '.sy');
INSERT INTO `iso_countries` VALUES ('169', 'Tajikistan', 'Republic of Tajikistan', 'Dushanbe', 'TJS', 'Somoni', '992', 'TJ', 'TJK', '762', '.tj');
INSERT INTO `iso_countries` VALUES ('170', 'Tanzania', 'United Republic of Tanzania', 'Dar es Salaam (administrative/judical) and Dodoma (legislative)', 'TZS', 'Shilling', '255', 'TZ', 'TZA', '834', '.tz');
INSERT INTO `iso_countries` VALUES ('171', 'Thailand', 'Kingdom of Thailand', 'Bangkok', 'THB', 'Baht', '66', 'TH', 'THA', '764', '.th');
INSERT INTO `iso_countries` VALUES ('172', 'Timor-Leste (East Timor)', 'Democratic Republic of Timor-Leste', 'Dili', 'USD', 'Dollar', '670', 'TL', 'TLS', '626', '.tp a');
INSERT INTO `iso_countries` VALUES ('173', 'Togo', 'Togolese Republic', 'Lome', 'XOF', 'Franc', '228', 'TG', 'TGO', '768', '.tg');
INSERT INTO `iso_countries` VALUES ('174', 'Tonga', 'Kingdom of Tonga', 'Nuku\'alofa', 'TOP', 'Pa\'anga', '676', 'TO', 'TON', '776', '.to');
INSERT INTO `iso_countries` VALUES ('175', 'Trinidad and Tobago', 'Republic of Trinidad and Tobago', 'Port-of-Spain', 'TTD', 'Dollar', '-867', 'TT', 'TTO', '780', '.tt');
INSERT INTO `iso_countries` VALUES ('176', 'Tunisia', 'Tunisian Republic', 'Tunis', 'TND', 'Dinar', '216', 'TN', 'TUN', '788', '.tn');
INSERT INTO `iso_countries` VALUES ('177', 'Turkey', 'Republic of Turkey', 'Ankara', 'TRY', 'Lira', '90', 'TR', 'TUR', '792', '.tr');
INSERT INTO `iso_countries` VALUES ('178', 'Turkmenistan', null, 'Ashgabat', 'TMM', 'Manat', '993', 'TM', 'TKM', '795', '.tm');
INSERT INTO `iso_countries` VALUES ('179', 'Tuvalu', null, 'Funafuti', 'AUD', 'Dollar', '688', 'TV', 'TUV', '798', '.tv');
INSERT INTO `iso_countries` VALUES ('180', 'Uganda', 'Republic of Uganda', 'Kampala', 'UGX', 'Shilling', '256', 'UG', 'UGA', '800', '.ug');
INSERT INTO `iso_countries` VALUES ('181', 'Ukraine', null, 'Kiev', 'UAH', 'Hryvnia', '380', 'UA', 'UKR', '804', '.ua');
INSERT INTO `iso_countries` VALUES ('182', 'United Arab Emirates', 'United Arab Emirates', 'Abu Dhabi', 'AED', 'Dirham', '971', 'AE', 'ARE', '784', '.ae');
INSERT INTO `iso_countries` VALUES ('183', 'United Kingdom', 'United Kingdom of Great Britain and Northern Ireland', 'London', 'GBP', 'Pound', '44', 'GB', 'GBR', '826', '.uk');
INSERT INTO `iso_countries` VALUES ('184', 'United States', 'United States of America', 'Washington', 'USD', 'Dollar', '1', 'US', 'USA', '840', '.us');
INSERT INTO `iso_countries` VALUES ('185', 'Uruguay', 'Oriental Republic of Uruguay', 'Montevideo', 'UYU', 'Peso', '598', 'UY', 'URY', '858', '.uy');
INSERT INTO `iso_countries` VALUES ('186', 'Uzbekistan', 'Republic of Uzbekistan', 'Tashkent', 'UZS', 'Som', '998', 'UZ', 'UZB', '860', '.uz');
INSERT INTO `iso_countries` VALUES ('187', 'Vanuatu', 'Republic of Vanuatu', 'Port-Vila', 'VUV', 'Vatu', '678', 'VU', 'VUT', '548', '.vu');
INSERT INTO `iso_countries` VALUES ('188', 'Vatican City', 'State of the Vatican City', 'Vatican City', 'EUR', 'Euro', '379', 'VA', 'VAT', '336', '.va');
INSERT INTO `iso_countries` VALUES ('189', 'Venezuela', 'Bolivarian Republic of Venezuela', 'Caracas', 'VEB', 'Bolivar', '58', 'VE', 'VEN', '862', '.ve');
INSERT INTO `iso_countries` VALUES ('190', 'Vietnam', 'Socialist Republic of Vietnam', 'Hanoi', 'VND', 'Dong', '84', 'VN', 'VNM', '704', '.vn');
INSERT INTO `iso_countries` VALUES ('191', 'Yemen', 'Republic of Yemen', 'Sanaa', 'YER', 'Rial', '967', 'YE', 'YEM', '887', '.ye');
INSERT INTO `iso_countries` VALUES ('192', 'Zambia', 'Republic of Zambia', 'Lusaka', 'ZMK', 'Kwacha', '260', 'ZM', 'ZMB', '894', '.zm');
INSERT INTO `iso_countries` VALUES ('193', 'Zimbabwe', 'Republic of Zimbabwe', 'Harare', 'ZWD', 'Dollar', '263', 'ZW', 'ZWE', '716', '.zw');
INSERT INTO `iso_countries` VALUES ('194', 'Abkhazia', 'Republic of Abkhazia', 'Sokhumi', 'RUB', 'Ruble', '995', 'GE', 'GEO', '268', '.ge');
INSERT INTO `iso_countries` VALUES ('195', 'China, Republic of (Taiwan)', 'Republic of China', 'Taipei', 'TWD', 'Dollar', '886', 'TW', 'TWN', '158', '.tw');
INSERT INTO `iso_countries` VALUES ('196', 'Nagorno-Karabakh', 'Nagorno-Karabakh Republic', 'Stepanakert', 'AMD', 'Dram', '277', 'AZ', 'AZE', '31', '.az');
INSERT INTO `iso_countries` VALUES ('197', 'Northern Cyprus', 'Turkish Republic of Northern Cyprus', 'Nicosia', 'TRY', 'Lira', '-302', 'CY', 'CYP', '196', '.nc.t');
INSERT INTO `iso_countries` VALUES ('198', 'Pridnestrovie (Transnistria)', 'Pridnestrovian Moldavian Republic', 'Tiraspol', null, 'Ruple', '-160', 'MD', 'MDA', '498', '.md');
INSERT INTO `iso_countries` VALUES ('199', 'Somaliland', 'Republic of Somaliland', 'Hargeisa', null, 'Shilling', '252', 'SO', 'SOM', '706', '.so');
INSERT INTO `iso_countries` VALUES ('200', 'South Ossetia', 'Republic of South Ossetia', 'Tskhinvali', 'RUB', 'Ruble and Lari', '995', 'GE', 'GEO', '268', '.ge');
INSERT INTO `iso_countries` VALUES ('201', 'Ashmore and Cartier Islands', 'Territory of Ashmore and Cartier Islands', null, null, null, null, 'AU', 'AUS', '36', '.au');
INSERT INTO `iso_countries` VALUES ('202', 'Christmas Island', 'Territory of Christmas Island', 'The Settlement (Flying Fish Cove)', 'AUD', 'Dollar', '61', 'CX', 'CXR', '162', '.cx');
INSERT INTO `iso_countries` VALUES ('203', 'Cocos (Keeling) Islands', 'Territory of Cocos (Keeling) Islands', 'West Island', 'AUD', 'Dollar', '61', 'CC', 'CCK', '166', '.cc');
INSERT INTO `iso_countries` VALUES ('204', 'Coral Sea Islands', 'Coral Sea Islands Territory', null, null, null, null, 'AU', 'AUS', '36', '.au');
INSERT INTO `iso_countries` VALUES ('205', 'Heard Island and McDonald Islands', 'Territory of Heard Island and McDonald Islands', null, null, null, null, 'HM', 'HMD', '334', '.hm');
INSERT INTO `iso_countries` VALUES ('206', 'Norfolk Island', 'Territory of Norfolk Island', 'Kingston', 'AUD', 'Dollar', '672', 'NF', 'NFK', '574', '.nf');
INSERT INTO `iso_countries` VALUES ('207', 'New Caledonia', null, 'Noumea', 'XPF', 'Franc', '687', 'NC', 'NCL', '540', '.nc');
INSERT INTO `iso_countries` VALUES ('208', 'French Polynesia', 'Overseas Country of French Polynesia', 'Papeete', 'XPF', 'Franc', '689', 'PF', 'PYF', '258', '.pf');
INSERT INTO `iso_countries` VALUES ('209', 'Mayotte', 'Departmental Collectivity of Mayotte', 'Mamoudzou', 'EUR', 'Euro', '262', 'YT', 'MYT', '175', '.yt');
INSERT INTO `iso_countries` VALUES ('210', 'Saint Barthelemy', 'Collectivity of Saint Barthelemy', 'Gustavia', 'EUR', 'Euro', '590', 'GP', 'GLP', '312', '.gp');
INSERT INTO `iso_countries` VALUES ('211', 'Saint Martin', 'Collectivity of Saint Martin', 'Marigot', 'EUR', 'Euro', '590', 'GP', 'GLP', '312', '.gp');
INSERT INTO `iso_countries` VALUES ('212', 'Saint Pierre and Miquelon', 'Territorial Collectivity of Saint Pierre and Miquelon', 'Saint-Pierre', 'EUR', 'Euro', '508', 'PM', 'SPM', '666', '.pm');
INSERT INTO `iso_countries` VALUES ('213', 'Wallis and Futuna', 'Collectivity of the Wallis and Futuna Islands', 'Mata\'utu', 'XPF', 'Franc', '681', 'WF', 'WLF', '876', '.wf');
INSERT INTO `iso_countries` VALUES ('214', 'French Southern and Antarctic Lands', 'Territory of the French Southern and Antarctic Lands', 'Martin-de-ViviÃ¨s', null, null, null, 'TF', 'ATF', '260', '.tf');
INSERT INTO `iso_countries` VALUES ('215', 'Clipperton Island', null, null, null, null, null, 'PF', 'PYF', '258', '.pf');
INSERT INTO `iso_countries` VALUES ('216', 'Bouvet Island', null, null, null, null, null, 'BV', 'BVT', '74', '.bv');
INSERT INTO `iso_countries` VALUES ('217', 'Cook Islands', null, 'Avarua', 'NZD', 'Dollar', '682', 'CK', 'COK', '184', '.ck');
INSERT INTO `iso_countries` VALUES ('218', 'Niue', null, 'Alofi', 'NZD', 'Dollar', '683', 'NU', 'NIU', '570', '.nu');
INSERT INTO `iso_countries` VALUES ('219', 'Tokelau', null, null, 'NZD', 'Dollar', '690', 'TK', 'TKL', '772', '.tk');
INSERT INTO `iso_countries` VALUES ('220', 'Guernsey', 'Bailiwick of Guernsey', 'Saint Peter Port', 'GGP', 'Pound', '44', 'GG', 'GGY', '831', '.gg');
INSERT INTO `iso_countries` VALUES ('221', 'Isle of Man', null, 'Douglas', 'IMP', 'Pound', '44', 'IM', 'IMN', '833', '.im');
INSERT INTO `iso_countries` VALUES ('222', 'Jersey', 'Bailiwick of Jersey', 'Saint Helier', 'JEP', 'Pound', '44', 'JE', 'JEY', '832', '.je');
INSERT INTO `iso_countries` VALUES ('223', 'Anguilla', null, 'The Valley', 'XCD', 'Dollar', '-263', 'AI', 'AIA', '660', '.ai');
INSERT INTO `iso_countries` VALUES ('224', 'Bermuda', null, 'Hamilton', 'BMD', 'Dollar', '-440', 'BM', 'BMU', '60', '.bm');
INSERT INTO `iso_countries` VALUES ('225', 'British Indian Ocean Territory', null, null, null, null, '246', 'IO', 'IOT', '86', '.io');
INSERT INTO `iso_countries` VALUES ('226', 'British Sovereign Base Areas', null, 'Episkopi', 'CYP', 'Pound', '357', null, null, null, null);
INSERT INTO `iso_countries` VALUES ('227', 'British Virgin Islands', null, 'Road Town', 'USD', 'Dollar', '-283', 'VG', 'VGB', '92', '.vg');
INSERT INTO `iso_countries` VALUES ('228', 'Cayman Islands', null, 'George Town', 'KYD', 'Dollar', '-344', 'KY', 'CYM', '136', '.ky');
INSERT INTO `iso_countries` VALUES ('229', 'Falkland Islands (Islas Malvinas)', null, 'Stanley', 'FKP', 'Pound', '500', 'FK', 'FLK', '238', '.fk');
INSERT INTO `iso_countries` VALUES ('230', 'Gibraltar', null, 'Gibraltar', 'GIP', 'Pound', '350', 'GI', 'GIB', '292', '.gi');
INSERT INTO `iso_countries` VALUES ('231', 'Montserrat', null, 'Plymouth', 'XCD', 'Dollar', '-663', 'MS', 'MSR', '500', '.ms');
INSERT INTO `iso_countries` VALUES ('232', 'Pitcairn Islands', null, 'Adamstown', 'NZD', 'Dollar', null, 'PN', 'PCN', '612', '.pn');
INSERT INTO `iso_countries` VALUES ('233', 'Saint Helena', null, 'Jamestown', 'SHP', 'Pound', '290', 'SH', 'SHN', '654', '.sh');
INSERT INTO `iso_countries` VALUES ('234', 'South Georgia & South Sandwich Islands', null, null, null, null, null, 'GS', 'SGS', '239', '.gs');
INSERT INTO `iso_countries` VALUES ('235', 'Turks and Caicos Islands', null, 'Grand Turk', 'USD', 'Dollar', '-648', 'TC', 'TCA', '796', '.tc');
INSERT INTO `iso_countries` VALUES ('236', 'Northern Mariana Islands', 'Commonwealth of The Northern Mariana Islands', 'Saipan', 'USD', 'Dollar', '-669', 'MP', 'MNP', '580', '.mp');
INSERT INTO `iso_countries` VALUES ('237', 'Puerto Rico', 'Commonwealth of Puerto Rico', 'San Juan', 'USD', 'Dollar', '+1-78', 'PR', 'PRI', '630', '.pr');
INSERT INTO `iso_countries` VALUES ('238', 'American Samoa', 'Territory of American Samoa', 'Pago Pago', 'USD', 'Dollar', '-683', 'AS', 'ASM', '16', '.as');
INSERT INTO `iso_countries` VALUES ('239', 'Baker Island', null, null, null, null, null, 'UM', 'UMI', '581', null);
INSERT INTO `iso_countries` VALUES ('240', 'Guam', 'Territory of Guam', 'Hagatna', 'USD', 'Dollar', '-670', 'GU', 'GUM', '316', '.gu');
INSERT INTO `iso_countries` VALUES ('241', 'Howland Island', null, null, null, null, null, 'UM', 'UMI', '581', null);
INSERT INTO `iso_countries` VALUES ('242', 'Jarvis Island', null, null, null, null, null, 'UM', 'UMI', '581', null);
INSERT INTO `iso_countries` VALUES ('243', 'Johnston Atoll', null, null, null, null, null, 'UM', 'UMI', '581', null);
INSERT INTO `iso_countries` VALUES ('244', 'Kingman Reef', null, null, null, null, null, 'UM', 'UMI', '581', null);
INSERT INTO `iso_countries` VALUES ('245', 'Midway Islands', null, null, null, null, null, 'UM', 'UMI', '581', null);
INSERT INTO `iso_countries` VALUES ('246', 'Navassa Island', null, null, null, null, null, 'UM', 'UMI', '581', null);
INSERT INTO `iso_countries` VALUES ('247', 'Palmyra Atoll', null, null, null, null, null, 'UM', 'UMI', '581', null);
INSERT INTO `iso_countries` VALUES ('248', 'U.S. Virgin Islands', 'United States Virgin Islands', 'Charlotte Amalie', 'USD', 'Dollar', '-339', 'VI', 'VIR', '850', '.vi');
INSERT INTO `iso_countries` VALUES ('249', 'Wake Island', null, null, null, null, null, 'UM', 'UMI', '850', null);
INSERT INTO `iso_countries` VALUES ('250', 'Hong Kong', 'Hong Kong Special Administrative Region', null, 'HKD', 'Dollar', '852', 'HK', 'HKG', '344', '.hk');
INSERT INTO `iso_countries` VALUES ('251', 'Macau', 'Macau Special Administrative Region', 'Macau', 'MOP', 'Pataca', '853', 'MO', 'MAC', '446', '.mo');
INSERT INTO `iso_countries` VALUES ('252', 'Faroe Islands', null, 'Torshavn', 'DKK', 'Krone', '298', 'FO', 'FRO', '234', '.fo');
INSERT INTO `iso_countries` VALUES ('253', 'Greenland', null, 'Nuuk (Godthab)', 'DKK', 'Krone', '299', 'GL', 'GRL', '304', '.gl');
INSERT INTO `iso_countries` VALUES ('254', 'French Guiana', 'Overseas Region of Guiana', 'Cayenne', 'EUR', 'Euro', '594', 'GF', 'GUF', '254', '.gf');
INSERT INTO `iso_countries` VALUES ('255', 'Guadeloupe', 'Overseas Region of Guadeloupe', 'Basse-Terre', 'EUR', 'Euro', '590', 'GP', 'GLP', '312', '.gp');
INSERT INTO `iso_countries` VALUES ('256', 'Martinique', 'Overseas Region of Martinique', 'Fort-de-France', 'EUR', 'Euro', '596', 'MQ', 'MTQ', '474', '.mq');
INSERT INTO `iso_countries` VALUES ('257', 'Reunion', 'Overseas Region of Reunion', 'Saint-Denis', 'EUR', 'Euro', '262', 'RE', 'REU', '638', '.re');
INSERT INTO `iso_countries` VALUES ('258', 'Aland', null, 'Mariehamn', 'EUR', 'Euro', '340', 'AX', 'ALA', '248', '.ax');
INSERT INTO `iso_countries` VALUES ('259', 'Aruba', null, 'Oranjestad', 'AWG', 'Guilder', '297', 'AW', 'ABW', '533', '.aw');
INSERT INTO `iso_countries` VALUES ('260', 'Netherlands Antilles', null, 'Willemstad', 'ANG', 'Guilder', '599', 'AN', 'ANT', '530', '.an');
INSERT INTO `iso_countries` VALUES ('261', 'Svalbard', null, 'Longyearbyen', 'NOK', 'Krone', '47', 'SJ', 'SJM', '744', '.sj');
INSERT INTO `iso_countries` VALUES ('262', 'Ascension', null, 'Georgetown', 'SHP', 'Pound', '247', 'AC', 'ASC', null, '.ac');
INSERT INTO `iso_countries` VALUES ('263', 'Tristan da Cunha', null, 'Edinburgh', 'SHP', 'Pound', '290', 'TA', 'TAA', null, null);
INSERT INTO `iso_countries` VALUES ('268', 'Australian Antarctic Territory', null, null, null, null, null, 'AQ', 'ATA', '10', '.aq');
INSERT INTO `iso_countries` VALUES ('269', 'Ross Dependency', null, null, null, null, null, 'AQ', 'ATA', '10', '.aq');
INSERT INTO `iso_countries` VALUES ('270', 'Peter I Island', null, null, null, null, null, 'AQ', 'ATA', '10', '.aq');
INSERT INTO `iso_countries` VALUES ('271', 'Queen Maud Land', null, null, null, null, null, 'AQ', 'ATA', '10', '.aq');
INSERT INTO `iso_countries` VALUES ('272', 'British Antarctic Territory', null, null, null, null, null, 'AQ', 'ATA', '10', '.aq');












