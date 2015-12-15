/*
Navicat MySQL Data Transfer

Source Server         : 阿里云
Source Server Version : 50604
Source Host           : 114.215.140.114:3306
Source Database       : v_show

Target Server Type    : MYSQL
Target Server Version : 50604
File Encoding         : 65001

Date: 2015-12-15 21:22:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for vs_admin
-- ----------------------------
DROP TABLE IF EXISTS `vs_admin`;
CREATE TABLE `vs_admin` (
  `id` tinyint(4) NOT NULL,
  `username` varchar(14) NOT NULL,
  `password` char(32) NOT NULL,
  `last_login` int(11) DEFAULT NULL,
  `last_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for vs_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `vs_auth_group`;
CREATE TABLE `vs_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for vs_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `vs_auth_group_access`;
CREATE TABLE `vs_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for vs_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `vs_auth_rule`;
CREATE TABLE `vs_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for vs_course
-- ----------------------------
DROP TABLE IF EXISTS `vs_course`;
CREATE TABLE `vs_course` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_name` varchar(12) NOT NULL,
  `course_about` varchar(200) NOT NULL,
  `course_pv` int(11) NOT NULL DEFAULT '0',
  `course_image` varchar(30) NOT NULL,
  `teacher_id` int(10) unsigned NOT NULL,
  `create_time` int(11) NOT NULL,
  `teacher_name` varchar(4) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `FK_teacher_id` (`teacher_id`),
  CONSTRAINT `FK_teacher_id` FOREIGN KEY (`teacher_id`) REFERENCES `vs_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for vs_course_homework
-- ----------------------------
DROP TABLE IF EXISTS `vs_course_homework`;
CREATE TABLE `vs_course_homework` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `homework_name` varchar(16) NOT NULL,
  `homework_expires` int(11) NOT NULL,
  `homework_about` varchar(200) NOT NULL,
  `pub_time` int(11) NOT NULL,
  `teacher_name` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for vs_course_interflow
-- ----------------------------
DROP TABLE IF EXISTS `vs_course_interflow`;
CREATE TABLE `vs_course_interflow` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(24) NOT NULL DEFAULT '',
  `content` varchar(200) NOT NULL DEFAULT '',
  `pub_time` int(10) unsigned NOT NULL DEFAULT '0',
  `course_id` int(10) unsigned NOT NULL DEFAULT '0',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `truename` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for vs_course_notice
-- ----------------------------
DROP TABLE IF EXISTS `vs_course_notice`;
CREATE TABLE `vs_course_notice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `title` varchar(24) NOT NULL DEFAULT '',
  `content` varchar(500) NOT NULL DEFAULT '',
  `pub_time` int(11) NOT NULL DEFAULT '0',
  `teacher_name` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for vs_course_resource
-- ----------------------------
DROP TABLE IF EXISTS `vs_course_resource`;
CREATE TABLE `vs_course_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(16) NOT NULL DEFAULT '',
  `teacher_name` varchar(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_path` varchar(48) NOT NULL DEFAULT '',
  `file_size` varchar(36) NOT NULL DEFAULT '0 kb',
  `course_id` int(11) NOT NULL,
  `pub_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for vs_course_student
-- ----------------------------
DROP TABLE IF EXISTS `vs_course_student`;
CREATE TABLE `vs_course_student` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `add_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `INDEX_COURSE_ID` (`course_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for vs_file
-- ----------------------------
DROP TABLE IF EXISTS `vs_file`;
CREATE TABLE `vs_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fdName` varchar(32) DEFAULT NULL,
  `fdContentID` int(11) DEFAULT NULL,
  `fdURL` varchar(128) DEFAULT NULL,
  `fdSize` int(11) DEFAULT NULL,
  `fdCreate` datetime DEFAULT NULL,
  `fdUpdate` datetime DEFAULT NULL,
  `fdTypeID` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for vs_homework_list
-- ----------------------------
DROP TABLE IF EXISTS `vs_homework_list`;
CREATE TABLE `vs_homework_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `homework_id` int(10) unsigned NOT NULL,
  `course_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `file_path` varchar(50) NOT NULL,
  `user_name` varchar(4) NOT NULL,
  `pub_time` int(11) NOT NULL,
  `comment` varchar(64) NOT NULL DEFAULT '',
  `score` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for vs_learning
-- ----------------------------
DROP TABLE IF EXISTS `vs_learning`;
CREATE TABLE `vs_learning` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fdName` varchar(255) NOT NULL,
  `fdType` tinyint(4) NOT NULL,
  `fdContentID` int(11) DEFAULT NULL,
  `fdDescribe` text,
  `fdCreate` datetime DEFAULT NULL,
  `fdUpdate` datetime DEFAULT NULL,
  `fdLabel` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for vs_teacher_info
-- ----------------------------
DROP TABLE IF EXISTS `vs_teacher_info`;
CREATE TABLE `vs_teacher_info` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_name` varchar(5) NOT NULL,
  `teacher_sex` char(1) NOT NULL,
  `teacher_id` int(10) unsigned NOT NULL,
  `teacher_about` varchar(200) NOT NULL,
  `teacher_company` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_info_teacher_id` (`teacher_id`),
  CONSTRAINT `FK_info_teacher_id` FOREIGN KEY (`teacher_id`) REFERENCES `vs_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for vs_user
-- ----------------------------
DROP TABLE IF EXISTS `vs_user`;
CREATE TABLE `vs_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL DEFAULT '',
  `stu_id` varchar(15) DEFAULT '',
  `username` varchar(14) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `avater_path` varchar(36) NOT NULL DEFAULT 'default.gif',
  `reg_date` int(11) NOT NULL DEFAULT '0',
  `last_login` int(11) NOT NULL DEFAULT '0',
  `last_ip` varchar(15) NOT NULL DEFAULT '0',
  `token_code` char(32) DEFAULT '0',
  `token_expiry` int(11) DEFAULT '0',
  `truename` varchar(10) NOT NULL DEFAULT '',
  `sign` varchar(40) NOT NULL DEFAULT '这个家伙很懒，什么都没有留下',
  `group_id` tinyint(4) NOT NULL DEFAULT '3',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for vs_works
-- ----------------------------
DROP TABLE IF EXISTS `vs_works`;
CREATE TABLE `vs_works` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `works_name` varchar(24) NOT NULL,
  `works_about` varchar(200) NOT NULL,
  `works_pubtime` int(11) NOT NULL,
  `works_path` varchar(64) NOT NULL,
  `works_image` varchar(64) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `works_label` varchar(20) DEFAULT NULL,
  `is_rec` tinyint(4) NOT NULL DEFAULT '0',
  `homework_id` int(11) NOT NULL DEFAULT '0',
  `works_author` varchar(255) NOT NULL DEFAULT '未知',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for vs_works_counts
-- ----------------------------
DROP TABLE IF EXISTS `vs_works_counts`;
CREATE TABLE `vs_works_counts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `praise_counts` int(10) unsigned NOT NULL DEFAULT '0',
  `collect_counts` int(10) unsigned NOT NULL DEFAULT '0',
  `comment_counts` int(10) unsigned NOT NULL DEFAULT '0',
  `click_counts` int(10) unsigned NOT NULL DEFAULT '0',
  `works_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for vs_works_operation
-- ----------------------------
DROP TABLE IF EXISTS `vs_works_operation`;
CREATE TABLE `vs_works_operation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `works_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL,
  `operate_id` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `operate_time` int(10) unsigned NOT NULL,
  `is_operate` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;
