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

 Date: 04/11/2018 07:18:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for info_ps_status
-- ----------------------------
DROP TABLE IF EXISTS `info_ps_status`;
CREATE TABLE `info_ps_status`  (
  `ID` int(8) NOT NULL AUTO_INCREMENT,
  `dingdanhao` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '订单号',
  `chepaihao` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '车牌号',
  `jqxtoubaodanhao` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '交强险投保单号',
  `syxtoubaodanhao` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商业险投保单号',
  `jqxbaodanhao` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '交强险保单号',
  `jqxshengxiaoriqi` datetime(0) NULL DEFAULT NULL COMMENT '交强险保单生效日期',
  `syxshengxiaoriqi` datetime(0) NULL DEFAULT NULL COMMENT '商业险保单生效日期',
  `syxbaodanhao` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商业险保单号',
  `sfsheng` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '收费地址的省',
  `sfshi` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '收费地址的市\r\n收费地址的市',
  `sfquxian` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '收费地址的区县',
  `sfdizhi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '收费地址',
  `peisongdantiaoma1` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '第一次打印配送单条码号',
  `sdsheng` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '送单地址的省',
  `sdshi` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '送单地址的市',
  `sdquxian` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '送单地址的区县',
  `sddizhi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '送单地址',
  `peisongdantiaoma2` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '第二次打印配送单条码号',
  `sfdizhineiwai` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '收费地址是/否为外埠',
  `sddizhineiwai` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '送单地址是/否为外埠',
  `shoujianren` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '收件人',
  `songdanriqi2` datetime(0) NULL DEFAULT NULL COMMENT '第二次定时送单时间',
  `sfriqi` datetime(0) NULL DEFAULT NULL COMMENT '收费时间',
  `songdanriqi1` datetime(0) NULL DEFAULT NULL COMMENT '第一次定时送单时间',
  `zhifufangshi` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '支付方式',
  `dayinriqi` datetime(0) NULL DEFAULT NULL COMMENT '打印时间',
  `zuoxigonghao` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '坐席工号',
  `beizhu` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `dadanyuan` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '打单员',
  `jqxjine` decimal(10, 2) NULL DEFAULT NULL COMMENT '交强险金额',
  `syxjine` decimal(10, 2) NULL DEFAULT NULL COMMENT '商业险金额',
  `ccsjine` decimal(10, 2) NULL DEFAULT NULL COMMENT '车船税金额',
  `sfjine` decimal(10, 2) NULL DEFAULT NULL COMMENT '收费金额',
  `lipinmingcheng` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '礼品名称',
  `lipinmingchengshougong` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '礼品名称手工对照',
  `feichexianmingcheng1` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '非车险名称1',
  `feichexianbaodanhao1` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '非车险保单号1',
  `feichexiankaishiriqi1` datetime(0) NULL DEFAULT NULL COMMENT '非车险保单开始日期1',
  `feichexianjieshuriqi1` datetime(0) NULL DEFAULT NULL COMMENT '非车险保单结束日期1',
  `feichexianjine1` decimal(10, 2) NULL DEFAULT NULL COMMENT '非车险金额1',
  `songdanleixing` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '送单类型',
  `dingshipeisongshifou` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '是否定时配送',
  `yancheshifou` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '是否需验车',
  `chudanjigou` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '出单机构',
  `fapiaoleixing` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '发票类型',
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
