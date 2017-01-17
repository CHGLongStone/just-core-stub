-- stub file


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
CREATE TABLE `client_fingerprint` (
  `client_fingerprint_pk` int(11) NOT NULL AUTO_INCREMENT,
  `canvas_fingerprint` varchar(32) NOT NULL,
  `digital_fingerprint` varchar(32) DEFAULT NULL,
  `ipv4` varchar(15) DEFAULT NULL,
  `ipv6` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`client_fingerprint_pk`),
  KEY `canvas_fingerprint_idx` (`canvas_fingerprint`),
  KEY `digital_fingerprint_idx` (`digital_fingerprint`)
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

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
-- Table structure for user_role
-- ----------------------------
CREATE TABLE `user_role` (
  `user_role_pk` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(60) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_role_pk`),
  KEY `user_role_pk` (`user_role_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;


-- ----------------------------
-- default data
-- ----------------------------
INSERT INTO `user_role` VALUES ('1', 'admin', '1');
INSERT INTO `user_role` VALUES ('2', 'super', '2');
INSERT INTO `user_role` VALUES ('3', 'client', '3');
INSERT INTO `user_role` VALUES ('4', 'legal_adviser', '2');
INSERT INTO `user_role` VALUES ('5', 'industry_adviser', '2');
INSERT INTO `user_role` VALUES ('6', 'guest', '6');

INSERT INTO `client` VALUES ('1', 'admin', '1278a8914fbed0d712734afbec855d32', '$2y$10$XvU5AcC182EZ/5IGTfdoseeDYiDPzE6CRvbesR214WmvzqEt1iPBi');
INSERT INTO `client_user` VALUES ('1', '1', '1', 'admin', 'user@domain.com', '$2y$10$XvU5AcC182EZ/5IGTfdoseeDYiDPzE6CRvbesR214WmvzqEt1iPBi', 'first', 'last', '123 Street', 'town', 'state', 'Country', 'postal', '5554445555', '');
















