/*
 Navicat Premium Data Transfer

 Source Server         : local_MySQL
 Source Server Type    : MySQL
 Source Server Version : 50714
 Source Host           : localhost:3306
 Source Schema         : app_sz88

 Target Server Type    : MySQL
 Target Server Version : 50714
 File Encoding         : 65001

 Date: 09/10/2018 20:42:51
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tab_baodan
-- ----------------------------
DROP TABLE IF EXISTS `tab_baodan`;
CREATE TABLE `tab_baodan`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `baodanhao` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `toubaodanhao` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `baodanhao4` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `chepaihao` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `chezhu` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `beibaoren` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `toubaoren` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `biaozhunbaofei` decimal(10, 2) NULL DEFAULT NULL,
  `shijibaofei` decimal(10, 2) NULL DEFAULT NULL,
  `chechuanshui` decimal(10, 2) NULL DEFAULT NULL,
  `baodanleixing` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4632 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tab_baofei
-- ----------------------------
DROP TABLE IF EXISTS `tab_baofei`;
CREATE TABLE `tab_baofei`  (
  `ID` int(8) NOT NULL AUTO_INCREMENT,
  `chepaihao` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `toubaoren` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `beibaoren` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kehujuese` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `baodanhao` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `toubaodanhao` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `baodanhao4` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `toubaodanhao4` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `peisongyuanbianma` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `yinhangmingcheng` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `yinhangkahao` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `chushishijian` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 37 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tab_baofei
-- ----------------------------
INSERT INTO `tab_baofei` VALUES (34, '苏A-288Z9', '樊华强', '樊华强', '被保人', '11065013900409281487', '51065013900575273948', NULL, NULL, NULL, '中国工商银行', '123225', '2018-04-02 23:39:18');
INSERT INTO `tab_baofei` VALUES (35, '苏A-Q921Y', '褚道路', '褚道路', '投保人', '11065013900409300730', '51065013900575298100', NULL, NULL, NULL, '中国工商银行', '5456456456', '2018-04-02 23:58:37');
INSERT INTO `tab_baofei` VALUES (36, '苏A-U0M18', '魏礼平', '魏礼平', '被保人', '11065013900409297864', '51065013900575294537', '4537', NULL, NULL, '中国工商银行', '45645645', '2018-04-03 00:15:01');

SET FOREIGN_KEY_CHECKS = 1;
