/*
 Navicat Premium Data Transfer

 Source Server         : local_SQL
 Source Server Type    : MySQL
 Source Server Version : 50714
 Source Host           : localhost:3306
 Source Schema         : zzpicc

 Target Server Type    : MySQL
 Target Server Version : 50714
 File Encoding         : 65001

 Date: 04/11/2018 07:18:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for user_psyinfo
-- ----------------------------
DROP TABLE IF EXISTS `user_psyinfo`;
CREATE TABLE `user_psyinfo`  (
  `userid` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `companyid` mediumint(8) UNSIGNED NULL DEFAULT NULL COMMENT '公司id',
  `pid` mediumint(8) NULL DEFAULT NULL COMMENT '父id',
  `username` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `userpwd` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '密码',
  `usercode` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户编码',
  `nickname` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '昵称',
  `regdate` int(10) UNSIGNED NULL DEFAULT NULL COMMENT '注册时间',
  `lastdate` int(10) UNSIGNED NULL DEFAULT NULL COMMENT '最后一次登录时间',
  `regip` char(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '注册ip',
  `lastip` char(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '最后一次登录ip',
  `loginnum` smallint(5) UNSIGNED NULL DEFAULT 0 COMMENT '登录次数',
  `email` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '邮箱',
  `mobile` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '手机号码',
  `islock` tinyint(1) UNSIGNED NULL DEFAULT 0 COMMENT '是否锁定',
  `vip` tinyint(1) UNSIGNED NULL DEFAULT 0 COMMENT '是否会员',
  `overduedate` int(10) UNSIGNED NULL DEFAULT NULL COMMENT '账户过期时间',
  `status` tinyint(1) UNSIGNED NULL DEFAULT 0 COMMENT '状态-用于软删除',
  PRIMARY KEY (`userid`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE,
  INDEX `email`(`email`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_psyinfo
-- ----------------------------
INSERT INTO `user_psyinfo` VALUES (1, NULL, NULL, '王佳', '111', '111', '', NULL, NULL, '', '', 0, '', '', 0, 0, NULL, 0);
INSERT INTO `user_psyinfo` VALUES (2, NULL, NULL, '张明', '222', '222', '', NULL, NULL, '', '', 0, '', '', 0, 0, NULL, 0);
INSERT INTO `user_psyinfo` VALUES (3, NULL, NULL, '宋平', '333', '333', '', NULL, NULL, '', '', 0, '', '', 0, 0, NULL, 0);

SET FOREIGN_KEY_CHECKS = 1;
