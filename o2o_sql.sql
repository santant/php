/*
 Navicat Premium Data Transfer

 Source Server         : php测试服务器
 Source Server Type    : MySQL
 Source Server Version : 50542
 Source Host           : localhost
 Source Database       : data_o2o

 Target Server Type    : MySQL
 Target Server Version : 50542
 File Encoding         : utf-8

 Date: 09/30/2017 10:02:57 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `o2o_area` 商圈表
-- ----------------------------
DROP TABLE IF EXISTS `o2o_area`;
CREATE TABLE `o2o_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商圈表id',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `city_id` int(11) DEFAULT '0' COMMENT '城市id',
  `parent_id` int(10) NOT NULL DEFAULT '0',
  `listorder` int(8) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  KEY `name` (`name`),
  KEY `name_2` (`name`),
  KEY `city_id_2` (`city_id`),
  KEY `city_id_3` (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商圈表';

-- ----------------------------
--  Table structure for `o2o_bis` 商户表
-- ----------------------------
DROP TABLE IF EXISTS `o2o_bis`;
CREATE TABLE `o2o_bis` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id 商户表',
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `logo` varchar(255) DEFAULT NULL COMMENT 'logo',
  `licence_logo` varchar(255) DEFAULT NULL COMMENT '营业执照',
  `description` text COMMENT '描述',
  `city_id` int(11) NOT NULL COMMENT '城市id',
  `city_path` varchar(50) NOT NULL COMMENT '城市的地址文本路径',
  `parent_id` int(11) NOT NULL,
  `back_info` varchar(50) DEFAULT NULL COMMENT '银行的详细信息',
  `money` decimal(10,0) NOT NULL DEFAULT '0' COMMENT '金额',
  `bank_name` varchar(50) DEFAULT NULL COMMENT '开户行',
  `bank_user` varchar(50) DEFAULT NULL COMMENT '开户行名称',
  `faren` varchar(20) DEFAULT NULL COMMENT '法人',
  `faren_tel` varchar(20) DEFAULT NULL COMMENT '法人联系方式',
  `listorder` int(8) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商户表';

-- ----------------------------
--  Table structure for `o2o_bis_account` 商户账号表
-- ----------------------------
DROP TABLE IF EXISTS `o2o_bis_account`;
CREATE TABLE `o2o_bis_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id 商户名称表',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT 'username',
  `password` varchar(30) NOT NULL DEFAULT '' COMMENT 'password',
  `code` varchar(10) NOT NULL DEFAULT '' COMMENT '随机数code',
  `bis_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商户id',
  `last_login_ip` varchar(30) NOT NULL DEFAULT '' COMMENT '商户最后登录的ip',
  `last_login_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商户登录时间',
  `is_main` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是不是管理员',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `bis_id` (`bis_id`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商户账号表';

-- ----------------------------
--  Table structure for `o2o_bis_location` 商户门店表
-- ----------------------------
DROP TABLE IF EXISTS `o2o_bis_location`;
CREATE TABLE `o2o_bis_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id 商户名称表',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `logo` varchar(255) NOT NULL DEFAULT '' COMMENT 'logo',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '地址',
  `code` varchar(10) DEFAULT '' COMMENT '地址',
  `tel` varchar(30) DEFAULT '' COMMENT '电话号码',
  `comtact` varchar(20) DEFAULT '' COMMENT '联系人',
  `xpoint` varchar(20) DEFAULT '' COMMENT '经度',
  `ypoint` varchar(20) DEFAULT '' COMMENT '维度',
  `bis_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商户id',
  `city_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '城市id',
  `city_path` varchar(50) NOT NULL DEFAULT '' COMMENT '城市具体名称',
  `open_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '营业时间',
  `coentent` text NOT NULL COMMENT '门店介绍',
  `api_address` varchar(255) NOT NULL DEFAULT '' COMMENT '分店地址',
  `is_main` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是不是管理员',
  `category_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '分类的id',
  `category_path` varchar(50) NOT NULL DEFAULT '' COMMENT '栏目的相关path',
  `bnak_info` varchar(50) NOT NULL DEFAULT '' COMMENT '银行相关描述',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  KEY `bis_id` (`bis_id`),
  KEY `category_id` (`category_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商户门店表';

-- ----------------------------
--  Table structure for `o2o_categpry` 生活服务分类表
-- ----------------------------
DROP TABLE IF EXISTS `o2o_categpry`;
CREATE TABLE `o2o_categpry` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id_数据库',
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `parent_id` int(10) NOT NULL DEFAULT '0' COMMENT '商品id',
  `listorder` int(8) DEFAULT NULL COMMENT '商品',
  `status` tinyint(1) DEFAULT NULL COMMENT '状态',
  `create_time` int(11) DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='生活服务分类表';

-- ----------------------------
--  Table structure for `o2o_city` 城市表
-- ----------------------------
DROP TABLE IF EXISTS `o2o_city`;
CREATE TABLE `o2o_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(50) NOT NULL COMMENT '城市名称',
  `uname` varchar(50) NOT NULL COMMENT '城市英文名称(唯一)',
  `parent_id` int(10) DEFAULT NULL COMMENT 'parent_id',
  `listorder` int(8) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uname` (`uname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='城市表';

-- ----------------------------
--  Table structure for `o2o_deal` 团购商品表
-- ----------------------------
DROP TABLE IF EXISTS `o2o_deal`;
CREATE TABLE `o2o_deal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id 团购商品表',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '商品名称',
  `category_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '栏目id',
  `bis_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商户id',
  `location_ids` varchar(100) NOT NULL DEFAULT '' COMMENT '所属店面的信息',
  `image` varchar(200) NOT NULL DEFAULT '' COMMENT '所属商品的图标',
  `start_time` int(11) NOT NULL DEFAULT '0' COMMENT '团购商品的开始时间',
  `end_time` int(11) NOT NULL DEFAULT '0' COMMENT '团购商品的结束时间',
  `description` text NOT NULL COMMENT '描述',
  `origin_price` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '团购商品的金额',
  `current_price` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '团购商品的原价',
  `city_id` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '商品属于那个城市id',
  `buy_count` int(11) NOT NULL DEFAULT '0' COMMENT '商品能购买多少份',
  `total_count` int(11) NOT NULL DEFAULT '0' COMMENT '商品总数量',
  `coupons_begin_time` int(11) NOT NULL DEFAULT '0' COMMENT '消费劵的开始时间',
  `coupons_end_time` int(11) NOT NULL DEFAULT '0' COMMENT '消费劵的结束时间',
  `xpoint` varchar(20) NOT NULL DEFAULT '' COMMENT '经度',
  `ypoint` varchar(20) NOT NULL DEFAULT '' COMMENT '维度',
  `bis_account_id` int(11) NOT NULL DEFAULT '0' COMMENT '哪一个商家提交的数据',
  `balance_price` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '卖家和商家的结算价',
  `notes` text NOT NULL COMMENT '商品的提示',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `bis_id` (`bis_id`),
  KEY `name` (`name`),
  KEY `category_id` (`category_id`),
  KEY `city_id` (`city_id`),
  KEY `start_time` (`start_time`),
  KEY `end_time` (`end_time`),
  KEY `coupons_begin_time` (`coupons_begin_time`),
  KEY `coupons_end_time` (`coupons_end_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='团购商品表';

-- ----------------------------
--  Table structure for `o2o_featured` 推荐位表
-- ----------------------------
DROP TABLE IF EXISTS `o2o_featured`;
CREATE TABLE `o2o_featured` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id 用户注册表id',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '类型',
  `title` varchar(30) NOT NULL DEFAULT '' COMMENT '标题',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT 'url',
  `description` text NOT NULL COMMENT '描述',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='推荐位表';

-- ----------------------------
--  Table structure for `o2o_user` 前台用户注册表
-- ----------------------------
DROP TABLE IF EXISTS `o2o_user`;
CREATE TABLE `o2o_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id 用户注册表id',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT 'username',
  `password` varchar(30) NOT NULL DEFAULT '' COMMENT 'password',
  `code` varchar(10) NOT NULL DEFAULT '' COMMENT '随机数code',
  `last_login_ip` varchar(30) NOT NULL DEFAULT '' COMMENT '商户最后登录的ip',
  `last_login_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商户登录时间',
  `email` varchar(30) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` varchar(30) NOT NULL DEFAULT '' COMMENT '联系方式',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='前台用户注册表  ';

SET FOREIGN_KEY_CHECKS = 1;
