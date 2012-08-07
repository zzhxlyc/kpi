SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `datasource`
-- ----------------------------
DROP TABLE IF EXISTS `datasource`;
CREATE TABLE `datasource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `tablename` varchar(255) DEFAULT NULL,
  `valid` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of datasource
-- ----------------------------

-- ----------------------------
-- Table structure for `department`
-- ----------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `valid` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `ds_data`
-- ----------------------------
DROP TABLE IF EXISTS `ds_data`;
CREATE TABLE `ds_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datasource` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `month` tinyint(4) DEFAULT NULL,
  `depart` int(11) DEFAULT NULL COMMENT '元数据条目属于由哪个部门填写',
  `data` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `mtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `kpi_data`
-- ----------------------------
DROP TABLE IF EXISTS `kpi_data`;
CREATE TABLE `kpi_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `month` tinyint(4) DEFAULT NULL,
  `month2` tinyint(4) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT 'monthly or seasonly or yearly',
  `kpi_table` int(11) NOT NULL DEFAULT '0',
  `depart` int(11) DEFAULT NULL,
  `manager` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`kpi_table`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `kpi_data_item`
-- ----------------------------
DROP TABLE IF EXISTS `kpi_data_item`;
CREATE TABLE `kpi_data_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kpi_data` int(11) DEFAULT NULL,
  `score_depart` int(11) DEFAULT NULL,
  `kpi_table_item` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `verify` tinyint(4) DEFAULT NULL,
  `modified` tinyint(4) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `mtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `kpi_table`
-- ----------------------------
DROP TABLE IF EXISTS `kpi_table`;
CREATE TABLE `kpi_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `depart` int(11) DEFAULT NULL,
  `manager` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `valid` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `kpi_table_item`
-- ----------------------------
DROP TABLE IF EXISTS `kpi_table_item`;
CREATE TABLE `kpi_table_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kpi_table` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `desc` varchar(500) DEFAULT NULL,
  `timeline` varchar(255) DEFAULT NULL,
  `quality` varchar(255) DEFAULT NULL,
  `output` varchar(255) DEFAULT NULL,
  `standard` varchar(500) DEFAULT NULL,
  `datasource` int(11) DEFAULT NULL,
  `depart` int(11) DEFAULT NULL,
  `score_depart` int(11) DEFAULT NULL,
  `staff` int(11) DEFAULT NULL,
  `modified` tinyint(4) DEFAULT NULL,
  `valid` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `supervise`
-- ----------------------------
DROP TABLE IF EXISTS `supervise`;
CREATE TABLE `supervise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `depart` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `depart` int(11) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `limit` int(11) DEFAULT NULL,
  `login` datetime DEFAULT NULL,
  `valid` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '管理员', '202cb962ac59075b964b07152d234b70', 'admin', null, '1', '1', '2012-08-07 14:48:35', '1');
