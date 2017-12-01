/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80003
 Source Host           : localhost:3306
 Source Schema         : ahmad_project

 Target Server Type    : MySQL
 Target Server Version : 80003
 File Encoding         : 65001

 Date: 01/12/2017 11:38:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ahmad_categories
-- ----------------------------
DROP TABLE IF EXISTS `ahmad_categories`;
CREATE TABLE `ahmad_categories` (
  `cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(60) DEFAULT NULL COMMENT '分类名',
  `parent_id` int(10) unsigned DEFAULT NULL COMMENT '父分类',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ahmad_posts
-- ----------------------------
DROP TABLE IF EXISTS `ahmad_posts`;
CREATE TABLE `ahmad_posts` (
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(120) NOT NULL DEFAULT '' COMMENT '标题',
  `author` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '作者ID',
  `content` text COMMENT '内容',
  `excerpt` varchar(255) DEFAULT NULL COMMENT '文章摘要',
  `status` enum('DRAFT','PUBLISH') DEFAULT NULL COMMENT 'publish:已发表;draft:草稿',
  `cat_id` smallint(5) unsigned DEFAULT NULL COMMENT '分类ID',
  `slug` varchar(120) DEFAULT NULL COMMENT '文章标识',
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ahmad_posts_tags
-- ----------------------------
DROP TABLE IF EXISTS `ahmad_posts_tags`;
CREATE TABLE `ahmad_posts_tags` (
  `post_id` int(11) unsigned NOT NULL COMMENT '博客ID',
  `tag_id` int(10) unsigned NOT NULL COMMENT '标签ID',
  PRIMARY KEY (`post_id`,`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ahmad_tags
-- ----------------------------
DROP TABLE IF EXISTS `ahmad_tags`;
CREATE TABLE `ahmad_tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(20) NOT NULL DEFAULT '' COMMENT '标签名',
  PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ahmad_users
-- ----------------------------
DROP TABLE IF EXISTS `ahmad_users`;
CREATE TABLE `ahmad_users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `avatar` varchar(120) NOT NULL DEFAULT '' COMMENT '头像270*270',
  `user_email` varchar(60) NOT NULL DEFAULT '' COMMENT '用户邮箱',
  `website` varchar(120) NOT NULL DEFAULT '' COMMENT '用户网站URL',
  `user_name` varchar(60) NOT NULL DEFAULT '' COMMENT '用户名',
  `user_pass` varchar(255) NOT NULL DEFAULT '' COMMENT '用户密码',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '账号状态0:禁用;1:正常;',
  `profession` varchar(30) NOT NULL DEFAULT '' COMMENT '职业',
  `address` varchar(30) NOT NULL DEFAULT '' COMMENT '居住地',
  `introduce` varchar(255) NOT NULL DEFAULT '' COMMENT '作者简介',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
