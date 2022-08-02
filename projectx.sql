/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MariaDB
 Source Server Version : 100148
 Source Host           : localhost:3306
 Source Schema         : projectx

 Target Server Type    : MariaDB
 Target Server Version : 100148
 File Encoding         : 65001

 Date: 28/07/2022 00:16:12
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ClearingCompany
-- ----------------------------
DROP TABLE IF EXISTS `ClearingCompany`;
CREATE TABLE `ClearingCompany`  (
  `clearingCompany_id` int(11) NOT NULL AUTO_INCREMENT,
  `clearingCompany_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '清運公司名稱',
  `clearingCompany_uniformNumbers` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '清運公司統編',
  `clearingCompany_principalName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '負責人姓名',
  `clearingCompany_identityCard` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '身分證號碼',
  `clearingCompany_phone` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '清運公司電話',
  `clearingCompany_address` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '清運公司地址',
  `user_id` int(11) NOT NULL COMMENT '使用者id',
  `permission_id` int(11) NOT NULL COMMENT '權限id',
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`clearingCompany_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ClearingDriver
-- ----------------------------
DROP TABLE IF EXISTS `ClearingDriver`;
CREATE TABLE `ClearingDriver`  (
  `clearingDriver_id` int(11) NOT NULL AUTO_INCREMENT,
  `clearingDriver_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '駕駛姓名',
  `clearingDriver_identityCard` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '駕駛身分證號碼',
  `clearingDriver_licensePlate` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '清運司機車牌',
  `clearingDriver_phone` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '清運司機連絡電話',
  `clearingDriver_bloodType` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '清運司機血型',
  `clearingCompany_id` int(10) NOT NULL COMMENT '清運公司外來鍵',
  `user_id` int(11) NOT NULL COMMENT '使用者id',
  `permission_id` int(11) NOT NULL COMMENT '權限id',
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`clearingDriver_id`) USING BTREE,
  INDEX `ClearingDriver_clearingCompany_id_foreign`(`clearingCompany_id`) USING BTREE,
  CONSTRAINT `ClearingDriver_clearingCompany_id_foreign` FOREIGN KEY (`clearingCompany_id`) REFERENCES `ClearingCompany` (`clearingCompany_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ContainmentCompany
-- ----------------------------
DROP TABLE IF EXISTS `ContainmentCompany`;
CREATE TABLE `ContainmentCompany`  (
  `containmentCompany_id` int(11) NOT NULL AUTO_INCREMENT,
  `containmentCompany_uniformNumbers` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收容公司統編',
  `containmentCompany_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收容公司名稱',
  `containmentCompany_principalName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '負責人姓名',
  `containmentCompany_principalPhone` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '負責人電話',
  `containmentCompany_placeAddress` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收容公司場所地址',
  `containmentCompany_address` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收容公司地址',
  `user_id` int(11) NOT NULL COMMENT '使用者id',
  `permission_id` int(11) NOT NULL COMMENT '權限id',
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`containmentCompany_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ContractingCompany
-- ----------------------------
DROP TABLE IF EXISTS `ContractingCompany`;
CREATE TABLE `ContractingCompany`  (
  `contracting_id` int(11) NOT NULL AUTO_INCREMENT,
  `contracting_companyName` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '承造公司名稱',
  `contracting_uniformNumbers` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '承造公司統編',
  `contracting_contractUserName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '承造人姓名',
  `contracting_contractUserPhone` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '承造人電話',
  `contracting_contractWatcherName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '監造人姓名',
  `contracting_contractWatcherPhone` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '監造人電話',
  `contracting_companyAddress` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '承造公司地址',
  `user_id` int(11) NOT NULL COMMENT '使用者id',
  `permission_id` int(11) NOT NULL COMMENT '權限id',
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`contracting_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for EngineeringManagement
-- ----------------------------
DROP TABLE IF EXISTS `EngineeringManagement`;
CREATE TABLE `EngineeringManagement`  (
  `engineering_id` int(11) NOT NULL AUTO_INCREMENT,
  `engineering_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '工程名稱',
  `engineering_projectNumber` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '工程流向編號',
  `contractCompany_id` int(11) NOT NULL COMMENT '承造公司外來鍵',
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`engineering_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for Government
-- ----------------------------
DROP TABLE IF EXISTS `Government`;
CREATE TABLE `Government`  (
  `government_id` int(11) NOT NULL AUTO_INCREMENT,
  `government_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '政府單位名稱',
  `government_principalName` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '政府單位負責人姓名',
  `government_principalPhone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '政府單位負責人電話',
  `government_address` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '政府單位地址',
  `user_id` int(11) NOT NULL COMMENT '使用者id',
  `permission_id` int(11) NOT NULL COMMENT '權限id',
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`government_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for PdfDocument
-- ----------------------------
DROP TABLE IF EXISTS `PdfDocument`;
CREATE TABLE `PdfDocument`  (
  `pdf_id` int(11) NOT NULL AUTO_INCREMENT,
  `pdf_fileNumber` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文件序號',
  `pdf_effectiveDate` date NULL DEFAULT NULL COMMENT '文件有效日期',
  `pdf_buildingName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '建物或拆除物名稱',
  `pdf_constructNumber` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '建造號碼',
  `pdf_buildingAddress` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '建築物地址',
  `pdf_starterName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '起造人姓名',
  `pdf_starterPhone` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '起造人電話',
  `pdf_contractingCompanyId` int(11) NOT NULL COMMENT '承造公司外來鍵',
  `pdf_clearingDriverId` int(11) NOT NULL COMMENT '清運司機外來鍵',
  `pdf_clearingCompanyId` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '清運公司外來鍵',
  `pdf_transportationRoute` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '運輸路線',
  `pdf_shippingQuantity` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '土石載運數量',
  `pdf_shippingContents` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '載運內容',
  `pdf_containmentCompanyId` int(11) NOT NULL COMMENT '收容單位外來鍵',
  `pdf_containmentPlaceEearthFlowNumer` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收容場所土石流向管制編號',
  `pdf_certifiedDocumentsIssuingUnit` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '證明文件核發單位',
  `pdf_contractingSign` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '承造公司簽名圖片位置',
  `pdf_driverSign` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '駕駛簽名圖片位置',
  `pdf_containmentPlaceSign` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收容場所圖片位置',
  `pdf_contractingSignDate` datetime(0) NULL DEFAULT NULL COMMENT '承造簽名日期',
  `pdf_driverSignDate` datetime(0) NULL DEFAULT NULL COMMENT '駕駛簽名日期',
  `pdf_containmentPlaceSignDate` datetime(0) NULL DEFAULT NULL COMMENT '收容場所簽名日期',
  `status_id` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文件狀態外來鍵',
  `engineering_id` int(11) NOT NULL COMMENT '工程管理外來鍵',
  `pdf_carFront` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '車頭圖片',
  `pdf_carBody` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '車斗圖片',
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`pdf_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for PdfStatus
-- ----------------------------
DROP TABLE IF EXISTS `PdfStatus`;
CREATE TABLE `PdfStatus`  (
  `status_id` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '狀態編號',
  `status_remark` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '狀態備註',
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`status_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of PdfStatus
-- ----------------------------
INSERT INTO `PdfStatus` VALUES ('1', '創建完成', '2022-07-28 00:15:52', '2022-07-28 00:15:52');
INSERT INTO `PdfStatus` VALUES ('2', '承造簽名完成', '2022-07-28 00:15:52', '2022-07-28 00:15:52');
INSERT INTO `PdfStatus` VALUES ('3', '司機簽名完成', '2022-07-28 00:15:52', '2022-07-28 00:15:52');
INSERT INTO `PdfStatus` VALUES ('4', '收容簽名完成', '2022-07-28 00:15:52', '2022-07-28 00:15:52');
INSERT INTO `PdfStatus` VALUES ('5', '簽名完畢', '2022-07-28 00:15:52', '2022-07-28 00:15:52');

-- ----------------------------
-- Table structure for Permission
-- ----------------------------
DROP TABLE IF EXISTS `Permission`;
CREATE TABLE `Permission`  (
  `permission_id` int(11) NOT NULL,
  `permission_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '權限名稱',
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`permission_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of Permission
-- ----------------------------
INSERT INTO `Permission` VALUES (1, 'root', '2022-07-28 00:15:52', '2022-07-28 00:15:52');
INSERT INTO `Permission` VALUES (2, '承造廠商(公司)', '2022-07-28 00:15:52', '2022-07-28 00:15:52');
INSERT INTO `Permission` VALUES (3, '清運廠商(公司)', '2022-07-28 00:15:52', '2022-07-28 00:15:52');
INSERT INTO `Permission` VALUES (4, '清運司機', '2022-07-28 00:15:52', '2022-07-28 00:15:52');
INSERT INTO `Permission` VALUES (5, '收容場所', '2022-07-28 00:15:52', '2022-07-28 00:15:52');
INSERT INTO `Permission` VALUES (6, '政府單位', '2022-07-28 00:15:52', '2022-07-28 00:15:52');

-- ----------------------------
-- Table structure for User
-- ----------------------------
DROP TABLE IF EXISTS `User`;
CREATE TABLE `User`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '使用者帳號',
  `user_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '使用者密碼',
  `permission_id` int(11) NOT NULL COMMENT '權限id',
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of User
-- ----------------------------
INSERT INTO `User` VALUES (1, 'root@root.xyz', 'e0a0a002818058f7dafaeb28b8c27bb21c942037', 1, '2022-07-28 00:15:52', '2022-07-28 00:15:52');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2022-07-14-135717', 'App\\Database\\Migrations\\ContractingCompany', 'default', 'App', 1658938529, 1);
INSERT INTO `migrations` VALUES (2, '2022-07-14-142438', 'App\\Database\\Migrations\\ClearingCompany', 'default', 'App', 1658938529, 1);
INSERT INTO `migrations` VALUES (3, '2022-07-14-150203', 'App\\Database\\Migrations\\ClearingDriver', 'default', 'App', 1658938529, 1);
INSERT INTO `migrations` VALUES (4, '2022-07-14-155118', 'App\\Database\\Migrations\\ContainmentCompany', 'default', 'App', 1658938529, 1);
INSERT INTO `migrations` VALUES (5, '2022-07-15-164708', 'App\\Database\\Migrations\\Permission', 'default', 'App', 1658938529, 1);
INSERT INTO `migrations` VALUES (6, '2022-07-15-164930', 'App\\Database\\Migrations\\User', 'default', 'App', 1658938529, 1);
INSERT INTO `migrations` VALUES (7, '2022-07-18-164439', 'App\\Database\\Migrations\\PdfDocument', 'default', 'App', 1658938529, 1);
INSERT INTO `migrations` VALUES (8, '2022-07-19-064413', 'App\\Database\\Migrations\\EngineeringManagement', 'default', 'App', 1658938529, 1);
INSERT INTO `migrations` VALUES (9, '2022-07-21-053733', 'App\\Database\\Migrations\\PdfStatus', 'default', 'App', 1658938529, 1);
INSERT INTO `migrations` VALUES (10, '2022-07-24-172216', 'App\\Database\\Migrations\\Government', 'default', 'App', 1658938529, 1);

SET FOREIGN_KEY_CHECKS = 1;
