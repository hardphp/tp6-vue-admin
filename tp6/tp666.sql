/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 80013
Source Host           : localhost:3306
Source Database       : tp6

Target Server Type    : MYSQL
Target Server Version : 80013
File Encoding         : 65001

Date: 2020-03-28 22:18:21
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
INSERT INTO `tp_admin` VALUES ('1', 'admini', 'd93a5def7511da3d0f2d171d9c344e91', '123@163.com', '123', '15237156573', 'https://hardphp.oss-cn-beijing.aliyuncs.com\\images/20200115\\1ed50a8ff67bedbe1d4794705868a234.jpg', '127.0.0.1', '1585404867', '39.149.12.184', '1585404867', '1', '1', '1540975213', '0');
INSERT INTO `tp_admin` VALUES ('2', 'admina', '00b091d5bbbcbea4a371242e61d644a3', '123@163.com', '王五一', '15237156573', 'https://hardphp.oss-cn-beijing.aliyuncs.com/vedios/20191220/044a612bd5f0874e669e0755f51ca93e.jpg', '127.0.0.1', '1540975213', '123.149.208.76', '1579146396', '1', '1', '1540975213', '0');
INSERT INTO `tp_admin` VALUES ('60', 'test', '', '', '', '', 'https://hardphp.oss-cn-beijing.aliyuncs.com/vedios/20191220/044a612bd5f0874e669e0755f51ca93e.jpg', '127.0.0.1', '1540975213', '0', '1579104327', '1', '2', '1540975213', '1579104327');
INSERT INTO `tp_admin` VALUES ('5831189944471553', '123123', '794484e50babce6d890d24bdbcd3a63b', '123@123.com', '1231', '15237156573', 'https://hardphp.oss-cn-beijing.aliyuncs.com\\images/20200115\\1ed50a8ff67bedbe1d4794705868a234.jpg', '127.0.0.1', '0', '', '1579104339', '1', '2', '1579103200', '1579104339');
INSERT INTO `tp_admin` VALUES ('6014628748464129', '3ewr23', '42fa3e555eecf2754a3da41c5e86af35', '', '', '', 'https://hardphp.oss-cn-beijing.aliyuncs.com\\images/20200115\\1ed50a8ff67bedbe1d4794705868a234.jpg', '127.0.0.1', '0', '', '1579149556', '1', '2', '1579146935', '0');
INSERT INTO `tp_admin` VALUES ('6026749121007617', '2324dfsdf', '80713128888be539a72c80820ea92649', '', 'sdf', '', 'https://hardphp.oss-cn-beijing.aliyuncs.com\\images/20200115\\1ed50a8ff67bedbe1d4794705868a234.jpg', '127.0.0.1', '0', '', '1582174917', '0', '2', '1579149824', '1582174917');

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
-- Table structure for tp_article
-- ----------------------------
DROP TABLE IF EXISTS `tp_article`;
CREATE TABLE `tp_article` (
  `id` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `title` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'seo描述',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态  0 禁用，1正常',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `sorts` int(3) NOT NULL DEFAULT '100' COMMENT '排序',
  `cate_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '分类id',
  `column_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '所属栏目',
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Records of tp_article
-- ----------------------------
INSERT INTO `tp_article` VALUES ('1', 'ty9fd2848a039ab554', '管理员端', '1582518981', '1', '1514962598', '100', '18716532003704833', '7264324116680705', 'https://hardphp.oss-cn-beijing.aliyuncs.com\\images/20200221\\c2a62a8dbba7ae828c5837291e170a4c.jpg');

-- ----------------------------
-- Table structure for tp_article_categery
-- ----------------------------
DROP TABLE IF EXISTS `tp_article_categery`;
CREATE TABLE `tp_article_categery` (
  `id` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '栏目名称',
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '描述',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态  0 禁用，1正常',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `sorts` int(3) NOT NULL DEFAULT '100' COMMENT '排序',
  `column_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '所属栏目',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章分类表';

-- ----------------------------
-- Records of tp_article_categery
-- ----------------------------
INSERT INTO `tp_article_categery` VALUES ('18716532003704833', '未全额委屈', '', '1582175304', '1', '1582175304', '100', '7264576798330881');

-- ----------------------------
-- Table structure for tp_article_column
-- ----------------------------
DROP TABLE IF EXISTS `tp_article_column`;
CREATE TABLE `tp_article_column` (
  `id` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '栏目名称',
  `seo_title` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'seo关键词',
  `seo_dec` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'seo描述',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态  0 禁用，1正常',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `sorts` int(3) NOT NULL DEFAULT '100' COMMENT '排序',
  `pid` bigint(20) NOT NULL DEFAULT '0' COMMENT '父id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章栏目表';

-- ----------------------------
-- Records of tp_article_column
-- ----------------------------
INSERT INTO `tp_article_column` VALUES ('1', '编程语言', 'ec32286d0718118861afdbf6e401ee81', '管理员端', '1579444850', '1', '1514962598', '100', '0');
INSERT INTO `tp_article_column` VALUES ('7264107703177217', '数据库', '1', '1', '1579445065', '1', '1579444834', '100', '0');
INSERT INTO `tp_article_column` VALUES ('7264249676173313', '开发框架', '', '', '1579444868', '1', '1579444868', '100', '0');
INSERT INTO `tp_article_column` VALUES ('7264324116680705', '开发工具', '', '', '1579444885', '1', '1579444885', '100', '0');
INSERT INTO `tp_article_column` VALUES ('7264576798330881', '应用实例', '', '', '1579444946', '1', '1579444946', '100', '0');
INSERT INTO `tp_article_column` VALUES ('7264664253763585', 'php', '', '', '1579445040', '1', '1579444966', '100', '1');
INSERT INTO `tp_article_column` VALUES ('7264796114292737', 'golang', '', '', '1579444998', '1', '1579444998', '100', '1');
INSERT INTO `tp_article_column` VALUES ('7264844751441921', 'python', '', '', '1579445009', '1', '1579445009', '100', '1');

-- ----------------------------
-- Table structure for tp_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_group`;
CREATE TABLE `tp_auth_group` (
  `id` bigint(20) unsigned NOT NULL,
  `title` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '用户组中文名称',
  `status` tinyint(1) DEFAULT '1' COMMENT '为1正常，为0禁用',
  `rules` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '用户组拥有的规则id， 多个规则","隔开',
  `update_time` int(10) unsigned DEFAULT '0' COMMENT '更新时间',
  `create_time` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户组表';

-- ----------------------------
-- Records of tp_auth_group
-- ----------------------------
INSERT INTO `tp_auth_group` VALUES ('1', '超级管理员', '1', '7246645603471361,7247512280895489,7247267136409601,7247034964905985,43,44,39,40,1,38,7,2', '1579440951', '1544881719');
INSERT INTO `tp_auth_group` VALUES ('2', '普通管理员', '1', '1,2', '1542787522', '1542787522');
INSERT INTO `tp_auth_group` VALUES ('6119919951417345', 'teste', '1', '43,44', '1579172038', '1579172038');

-- ----------------------------
-- Table structure for tp_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_rule`;
CREATE TABLE `tp_auth_rule` (
  `id` bigint(20) unsigned NOT NULL,
  `name` char(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则唯一标识',
  `title` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则中文名称',
  `type` tinyint(1) DEFAULT '1' COMMENT '为1正常，为0禁用',
  `status` tinyint(1) DEFAULT '1' COMMENT '1 正常，0=禁用',
  `condition` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '规则表达式，为空表示存在就验证',
  `pid` bigint(20) DEFAULT '0' COMMENT '上级菜单',
  `sorts` mediumint(8) DEFAULT '0' COMMENT '升序',
  `icon` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
  `update_time` int(10) unsigned DEFAULT '0' COMMENT '更新时间',
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '路经',
  `component` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '组件',
  `hidden` tinyint(1) DEFAULT '0' COMMENT '左侧菜单 0==显示,1隐藏',
  `no_cache` tinyint(1) DEFAULT '0' COMMENT '1=不缓存，0=缓存',
  `always_show` tinyint(1) DEFAULT '0' COMMENT '1= 总显示,0=否 依据子菜单个数',
  `redirect` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
  `create_time` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='规则表';

-- ----------------------------
-- Records of tp_auth_rule
-- ----------------------------
INSERT INTO `tp_auth_rule` VALUES ('1', 'manage', '权限管理', '1', '1', '', '0', '0', 'component', '1542602916', '/manage', 'layout', '0', '0', '1', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('2', 'manage/admin', '管理员列表', '1', '1', '', '1', '0', 'user', '1541666364', 'admin', 'manage/admin', '0', '0', '0', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('7', 'manage/rules', '权限列表', '1', '1', '', '1', '0', 'lock', '1542353476', 'rules', 'manage/rules', '0', '0', '0', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('38', 'manage/roles', '角色列表', '1', '1', '', '1', '0', 'list', '1542602805', 'roles', 'manage/roles', '0', '0', '0', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('39', 'log', '日志管理', '1', '1', '', '0', '0', 'component', '1579436605', '/log', 'layout', '0', '0', '1', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('40', 'log/log', '登陆日志', '1', '1', '', '39', '0', 'list', '1579435976', 'log', 'log/log', '0', '0', '0', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('43', 'icon', '图标管理', '1', '1', '', '0', '0', 'component', '1579436588', '/icon', 'layout', '0', '0', '0', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('44', 'icon/index', '图标列表', '1', '1', '', '43', '0', 'list', '0', 'index', 'icons/index', '0', '0', '0', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('7246645603471361', 'article', '文章管理', '1', '1', '', '0', '0', 'component', '1579440670', '/article', 'layout', '0', '0', '1', '', '1579440670');
INSERT INTO `tp_auth_rule` VALUES ('7247034964905985', 'article/categery', '分类列表', '1', '1', '', '7246645603471361', '0', 'list', '1579440763', 'categery', 'article/categery', '0', '0', '0', '', '1579440763');
INSERT INTO `tp_auth_rule` VALUES ('7247267136409601', 'article/column', '栏目列表', '1', '1', '', '7246645603471361', '0', 'list', '1579440819', 'column', 'article/column', '0', '0', '0', '', '1579440819');
INSERT INTO `tp_auth_rule` VALUES ('7247512280895489', 'article/blog', '文章列表', '1', '1', '', '7246645603471361', '0', 'list', '1579440877', 'blog', 'article/blog', '0', '0', '0', '', '1579440877');

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
-- Table structure for tp_image_hash
-- ----------------------------
DROP TABLE IF EXISTS `tp_image_hash`;
CREATE TABLE `tp_image_hash` (
  `id` bigint(20) unsigned NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '图片',
  `hash` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '图片hash',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tp_image_hash
-- ----------------------------
INSERT INTO `tp_image_hash` VALUES ('5819117802229761', 'https://hardphp.oss-cn-beijing.aliyuncs.com\\images/20200115\\1ed50a8ff67bedbe1d4794705868a234.jpg', 'd3ab533b8b10e4f3daeee85dde4179df68cfcc4d', '1579100321', '1579100321');
INSERT INTO `tp_image_hash` VALUES ('19177852159266817', 'https://hardphp.oss-cn-beijing.aliyuncs.com\\images/20200221\\c2a62a8dbba7ae828c5837291e170a4c.jpg', 'b3857f39fb233da316eae01bbbedc67561519cdb', '1582285292', '1582285292');

-- ----------------------------
-- Table structure for tp_login_log
-- ----------------------------
DROP TABLE IF EXISTS `tp_login_log`;
CREATE TABLE `tp_login_log` (
  `id` bigint(20) unsigned NOT NULL COMMENT 'ID',
  `uid` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `username` char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名',
  `login_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间',
  `roles` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '角色',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员登录';

-- ----------------------------
-- Records of tp_login_log
-- ----------------------------
INSERT INTO `tp_login_log` VALUES ('502', '1', 'admin', '115.60.16.49', '1569570610', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('503', '1', 'admin', '115.60.16.49', '1569570926', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('504', '1', 'admin', '115.60.16.49', '1569571106', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('505', '1', 'admin', '115.60.16.49', '1569571198', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('506', '1', 'admin', '115.60.16.49', '1569572567', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('507', '1', 'admin', '115.60.16.49', '1569572862', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('508', '1', 'admin', '115.60.16.49', '1569577336', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('509', '1', 'admin', '115.60.16.49', '1569577374', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('510', '1', 'admin', '115.60.16.49', '1569579992', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('511', '1', 'admin', '115.60.16.49', '1569580000', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('512', '1', 'admin', '115.60.16.49', '1569580041', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('513', '1', 'admin', '115.60.16.49', '1569580343', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('514', '1', 'admin', '115.60.16.49', '1569580809', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('515', '1', 'admin', '115.60.16.49', '1569580949', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('516', '1', 'admin', '115.60.16.49', '1569581081', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('517', '1', 'admin', '115.60.16.49', '1569581087', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('518', '1', 'admin', '115.60.16.49', '1569581136', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('519', '1', 'admin', '115.60.16.49', '1569581209', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('520', '1', 'admin', '115.60.16.49', '1569581628', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('521', '1', 'admin', '115.60.16.49', '1569581657', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('522', '1', 'admin', '115.60.16.49', '1569581699', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('523', '1', 'admin', '115.60.16.49', '1569581722', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('524', '1', 'admin', '115.60.16.49', '1569583325', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('525', '1', 'admin', '115.60.19.188', '1569634122', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('526', '1', 'admin', '115.60.19.188', '1569639797', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('527', '1', 'admin', '115.60.19.188', '1569639873', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('528', '1', 'admin', '115.60.19.188', '1569640203', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('529', '1', 'admin', '115.60.19.188', '1569640213', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('530', '1', 'admin', '115.60.19.188', '1569642217', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('531', '1', 'admin', '39.149.247.160', '1574342514', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('532', '1', 'admin', '39.149.247.160', '1574468895', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('533', '1', 'admin', '223.88.30.142', '1574846370', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('534', '1', 'admin', '223.88.30.142', '1574848961', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('535', '1', 'admin', '223.88.30.142', '1574849547', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('536', '1', 'admin', '223.88.30.142', '1574849754', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('537', '1', 'admin', '223.88.30.142', '1574850555', '超级管理员', '0', '0');
INSERT INTO `tp_login_log` VALUES ('538', '1', 'admin', '223.88.30.142', '1574850985', '超级管理员', '0', '0');

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
