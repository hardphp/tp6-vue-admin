/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 80013
Source Host           : localhost:3306
Source Database       : tp6

Target Server Type    : MYSQL
Target Server Version : 80013
File Encoding         : 65001

Date: 2020-01-11 10:28:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_admin
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin`;
CREATE TABLE `tp_admin` (
  `id` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `username` char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '密码',
  `email` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户邮箱',
  `realname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '姓名',
  `phone` char(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户手机',
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '头像',
  `reg_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '注册IP',
  `login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `login_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户状态  0 禁用，1正常',
  `group_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '权限组',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员用户表';

-- ----------------------------
-- Records of tp_admin
-- ----------------------------
INSERT INTO `tp_admin` VALUES ('1', 'admin', 'd93a5def7511da3d0f2d171d9c344e91', '123@163.com', '123', '15237156573', 'http://en.hardphp.com/uploads/images/20181210/5dd1100ffa8f8ea12d3aca64206e836e.png', '127.0.0.1', '1578656070', '39.149.12.184', '1578656070', '1', '1', '0', '0');
INSERT INTO `tp_admin` VALUES ('2', 'admina', '00b091d5bbbcbea4a371242e61d644a3', '123@163.com', '王五一', '15237156573', 'http://api.hardphp.com/uploads/images/20181031/042adb39755351c39233681bee2b9ad9.jpg', '127.0.0.1', '1521449129', '123.149.208.76', '1540975213', '1', '1', '0', '0');
INSERT INTO `tp_admin` VALUES ('60', 'test', '', '', '', '', '', '127.0.0.1', '0', '0', '0', '1', '2', '0', '0');

-- ----------------------------
-- Table structure for tp_app
-- ----------------------------
DROP TABLE IF EXISTS `tp_app`;
CREATE TABLE `tp_app` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `appid` char(18) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '应用id',
  `app_salt` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '应用签名盐值',
  `title` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '名称',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '备注',
  `reg_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '注册IP',
  `login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `login_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户状态  0 禁用，1正常',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `appid` (`appid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='app应用表';

-- ----------------------------
-- Records of tp_app
-- ----------------------------
INSERT INTO `tp_app` VALUES ('1', 'ty9fd2848a039ab554', 'ec32286d0718118861afdbf6e401ee81', '管理员端', '', '127.0.0.1', '1521305444', '123.149.208.76', '1514962598', '1', '0');

-- ----------------------------
-- Table structure for tp_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_group`;
CREATE TABLE `tp_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '用户组中文名称',
  `status` tinyint(1) DEFAULT '1' COMMENT '为1正常，为0禁用',
  `rules` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '用户组拥有的规则id， 多个规则","隔开',
  `update_time` int(10) unsigned DEFAULT '0' COMMENT '更新时间',
  `create_time` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户组表';

-- ----------------------------
-- Records of tp_auth_group
-- ----------------------------
INSERT INTO `tp_auth_group` VALUES ('1', '超级管理员', '1', '41,42,39,40,1,38,7,2', '1544881719', '0');
INSERT INTO `tp_auth_group` VALUES ('2', '普通管理员', '1', '1,2', '1542787522', '0');

-- ----------------------------
-- Table structure for tp_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_rule`;
CREATE TABLE `tp_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则唯一标识',
  `title` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则中文名称',
  `type` tinyint(1) DEFAULT '1' COMMENT '为1正常，为0禁用',
  `status` tinyint(1) DEFAULT '1' COMMENT '1 正常，0=禁用',
  `condition` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '规则表达式，为空表示存在就验证',
  `pid` mediumint(8) DEFAULT '0' COMMENT '上级菜单',
  `sorts` mediumint(8) DEFAULT '0' COMMENT '升序',
  `icon` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `update_time` int(10) unsigned DEFAULT '0' COMMENT '更新时间',
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '路经',
  `component` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '组件',
  `hidden` tinyint(1) DEFAULT '0' COMMENT '左侧菜单 0==显示,1隐藏',
  `no_cache` tinyint(1) DEFAULT '0' COMMENT '1=不缓存，0=缓存',
  `always_show` tinyint(1) DEFAULT '0' COMMENT '1= 总显示,0=否 依据子菜单个数',
  `redirect` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `create_time` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COMMENT='规则表';

-- ----------------------------
-- Records of tp_auth_rule
-- ----------------------------
INSERT INTO `tp_auth_rule` VALUES ('1', 'manage', '权限管理', '1', '1', '', '0', '0', 'component', '1542602916', '/manage', 'layout/Layout', '0', '0', '1', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('2', 'manage/admin', '管理员列表', '1', '1', '', '1', '0', 'user', '1541666364', 'admin', 'manage/admin', '0', '0', '0', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('7', 'manage/rules', '权限列表', '1', '1', '', '1', '0', 'lock', '1542353476', 'rules', 'manage/rules', '0', '0', '0', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('38', 'manage/roles', '角色列表', '1', '1', '', '1', '0', 'list', '1542602805', 'roles', 'manage/roles', '0', '1', '1', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('39', 'log', '日志管理', '1', '1', '', '0', '0', 'component', '1542602916', '/log', 'layout/Layout', '0', '0', '1', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('40', 'log/log', '登陆日志', '1', '1', '', '39', '0', 'list', '1542602805', 'log', 'log/log', '0', '1', '1', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('41', 'shop', '商城管理', '1', '1', '', '0', '0', 'component', '1542602916', '/shop', 'layout/Layout', '0', '0', '1', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('42', 'shop/store', '店铺管理', '1', '1', '', '41', '0', 'list', '1542602805', 'log', 'shop/store', '0', '1', '1', '', '0');

-- ----------------------------
-- Table structure for tp_failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `tp_failed_jobs`;
CREATE TABLE `tp_failed_jobs` (
  `id` bigint(20) NOT NULL,
  `type` tinyint(1) DEFAULT '1' COMMENT '1=小程序，2=短信',
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '数据',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='队列失败任务记录';

-- ----------------------------
-- Records of tp_failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for tp_login_log
-- ----------------------------
DROP TABLE IF EXISTS `tp_login_log`;
CREATE TABLE `tp_login_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `uid` int(10) unsigned NOT NULL COMMENT '用户ID',
  `username` char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名',
  `login_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间',
  `roles` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '角色',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=539 DEFAULT CHARSET=utf8 COMMENT='管理员登录';

-- ----------------------------
-- Records of tp_login_log
-- ----------------------------
INSERT INTO `tp_login_log` VALUES ('502', '1', 'admin', '115.60.16.49', '1569570610', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('503', '1', 'admin', '115.60.16.49', '1569570926', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('504', '1', 'admin', '115.60.16.49', '1569571106', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('505', '1', 'admin', '115.60.16.49', '1569571198', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('506', '1', 'admin', '115.60.16.49', '1569572567', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('507', '1', 'admin', '115.60.16.49', '1569572862', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('508', '1', 'admin', '115.60.16.49', '1569577336', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('509', '1', 'admin', '115.60.16.49', '1569577374', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('510', '1', 'admin', '115.60.16.49', '1569579992', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('511', '1', 'admin', '115.60.16.49', '1569580000', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('512', '1', 'admin', '115.60.16.49', '1569580041', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('513', '1', 'admin', '115.60.16.49', '1569580343', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('514', '1', 'admin', '115.60.16.49', '1569580809', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('515', '1', 'admin', '115.60.16.49', '1569580949', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('516', '1', 'admin', '115.60.16.49', '1569581081', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('517', '1', 'admin', '115.60.16.49', '1569581087', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('518', '1', 'admin', '115.60.16.49', '1569581136', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('519', '1', 'admin', '115.60.16.49', '1569581209', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('520', '1', 'admin', '115.60.16.49', '1569581628', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('521', '1', 'admin', '115.60.16.49', '1569581657', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('522', '1', 'admin', '115.60.16.49', '1569581699', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('523', '1', 'admin', '115.60.16.49', '1569581722', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('524', '1', 'admin', '115.60.16.49', '1569583325', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('525', '1', 'admin', '115.60.19.188', '1569634122', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('526', '1', 'admin', '115.60.19.188', '1569639797', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('527', '1', 'admin', '115.60.19.188', '1569639873', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('528', '1', 'admin', '115.60.19.188', '1569640203', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('529', '1', 'admin', '115.60.19.188', '1569640213', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('530', '1', 'admin', '115.60.19.188', '1569642217', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('531', '1', 'admin', '39.149.247.160', '1574342514', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('532', '1', 'admin', '39.149.247.160', '1574468895', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('533', '1', 'admin', '223.88.30.142', '1574846370', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('534', '1', 'admin', '223.88.30.142', '1574848961', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('535', '1', 'admin', '223.88.30.142', '1574849547', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('536', '1', 'admin', '223.88.30.142', '1574849754', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('537', '1', 'admin', '223.88.30.142', '1574850555', '超级管理员');
INSERT INTO `tp_login_log` VALUES ('538', '1', 'admin', '223.88.30.142', '1574850985', '超级管理员');

-- ----------------------------
-- Table structure for tp_notice_send_log
-- ----------------------------
DROP TABLE IF EXISTS `tp_notice_send_log`;
CREATE TABLE `tp_notice_send_log` (
  `id` bigint(20) NOT NULL,
  `type` tinyint(1) DEFAULT '1' COMMENT '1=小程序，2=公众号，3=短信',
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '数据',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `result` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '结果',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='通知消息发送记录';

-- ----------------------------
-- Records of tp_notice_send_log
-- ----------------------------

-- ----------------------------
-- Table structure for tp_sms
-- ----------------------------
DROP TABLE IF EXISTS `tp_sms`;
CREATE TABLE `tp_sms` (
  `id` bigint(20) unsigned NOT NULL,
  `phone` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '手机号',
  `code` varchar(10) NOT NULL COMMENT '验证码',
  `ip` varchar(50) NOT NULL COMMENT 'ip地址',
  `deadline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '过期时间',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=注册，2=登录，3=找回密码',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 未使用，1已使用',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `phone` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='手机验证码';

-- ----------------------------
-- Records of tp_sms
-- ----------------------------

-- ----------------------------
-- Table structure for tp_user
-- ----------------------------
DROP TABLE IF EXISTS `tp_user`;
CREATE TABLE `tp_user` (
  `id` bigint(20) NOT NULL COMMENT 'ID',
  `openid` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '微信身份标识',
  `password` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '32位小写MD5密码',
  `phone` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '手机号',
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否启用',
  `nickname` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户昵称',
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '头像URL',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别标志：0，其他；1，男；2，女',
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '账户余额',
  `birth` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '生日',
  `descript` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '账户总金额',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `reg_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '注册IP',
  `login_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'IP',
  `login_time` int(10) NOT NULL DEFAULT '0' COMMENT '登录时间',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '时间',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`),
  KEY `phone` (`phone`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='主系统用户表。';

-- ----------------------------
-- Records of tp_user
-- ----------------------------
INSERT INTO `tp_user` VALUES ('1', '', '', '15237156573', '12312333', '1', 'xiegaolei', '/uploads/images/20180512/6c7cf3ee6e3e83c031e260c5fa0844fb.jpg', '0', '20210.00', '1989-10-10', '我要给你一个拥抱 给你一双温热手掌', '525225.00', '1515057952', '123.149.214.69', '', '0', '0', '0');
INSERT INTO `tp_user` VALUES ('10', '', '', '', '', '1', '', '', '0', '0.00', '', '', '0.00', '0', '', '', '0', '0', '0');
