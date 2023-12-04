/*
 Navicat Premium Data Transfer

 Source Server         : 新加坡服务器
 Source Server Type    : MySQL
 Source Server Version : 80034 (8.0.34)
 Source Host           : 8.219.164.123:3306
 Source Schema         : works_pro

 Target Server Type    : MySQL
 Target Server Version : 80034 (8.0.34)
 File Encoding         : 65001

 Date: 04/12/2023 17:40:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int NOT NULL COMMENT '主健',
  `uname` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '用户名',
  `pwd` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '密码',
  `nickname` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '管理员昵称',
  `email_system` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '邮箱服务器',
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '管理员个人邮箱（用于发放密码）',
  `check_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '邮箱服务器开放秘钥',
  `add_time` datetime NOT NULL COMMENT '添加时间',
  `last_time` datetime NOT NULL COMMENT '最近登录时间',
  `count` int NOT NULL COMMENT '服务登录次数',
  `server_ip` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL COMMENT '学生登入主页网站',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_stu_name`(`nickname` ASC) USING BTREE COMMENT '姓名查询'
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'admin', 'admin', '管理员', 'smtp.163.com', 'srq2138099022@163.com', 'TOWATVEECUOBBIOU', '2023-03-15 14:22:19', '2023-12-04 17:28:46', 28, 'works_pro/student/login');

-- ----------------------------
-- Table structure for admin_ip
-- ----------------------------
DROP TABLE IF EXISTS `admin_ip`;
CREATE TABLE `admin_ip`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL COMMENT '登录用户id',
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '用户ip',
  `lsp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '登录服务商',
  `last_time` datetime NOT NULL COMMENT '登录时间',
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '登录城市',
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '登录token',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_ip
-- ----------------------------
INSERT INTO `admin_ip` VALUES (1, 1, '183.234.123.118', '移动', '2023-11-19 19:56:46', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDAzOTUwMDYsImV4cCI6MTcwMDM5ODYwNn0.t7HbhHNJ5W9hPYwTjwy63-Z0RO-jQOJneYuMC9Ev3Mc');
INSERT INTO `admin_ip` VALUES (2, 1, '183.234.123.118', '移动', '2023-12-01 09:37:24', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDEzOTQ2NDQsImV4cCI6MTcwMTM5ODI0NH0.ZANNKw5QhL4M1ZBKp5hdJe9gDJsDwGAqf1IjbuK3mZY');
INSERT INTO `admin_ip` VALUES (3, 1, '183.234.123.118', '移动', '2023-12-02 10:18:42', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE0ODM1MjEsImV4cCI6MTcwMTQ4NzEyMX0.rWfOMCAl0iVdzcHyQcf-D5lBViv2DfqVS2W8YR3E-jI');
INSERT INTO `admin_ip` VALUES (4, 1, '183.234.123.118', '移动', '2023-12-02 11:18:53', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE0ODcxMzMsImV4cCI6MTcwMTQ5MDczM30.4_G7xsHC0yq3kmLwFhZbRbUrjbk2350zDFCmHl7tuxU');
INSERT INTO `admin_ip` VALUES (5, 1, '183.234.123.118', '移动', '2023-12-02 12:19:33', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE0OTA3NzIsImV4cCI6MTcwMTQ5NDM3Mn0.2PSy8jB8XhKOB3wEmaw9L8mD7TZvnBE0FbWwlWKBQpU');
INSERT INTO `admin_ip` VALUES (6, 1, '183.234.123.118', '移动', '2023-12-02 16:33:50', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE1MDYwMjksImV4cCI6MTcwMTUwOTYyOX0.JWDX_EKRCniP3_dT2uON3yAH-C59ppMYzTlxC4aTsyA');
INSERT INTO `admin_ip` VALUES (7, 1, '183.234.123.118', '移动', '2023-12-02 17:34:07', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE1MDk2NDcsImV4cCI6MTcwMTUxMzI0N30.Iq2Gwlsjz2mN2z7E3GLwaaCEZMM8xK_k1_iwNdXY_uI');
INSERT INTO `admin_ip` VALUES (8, 1, '183.234.123.118', '移动', '2023-12-02 17:34:08', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE1MDk2NDcsImV4cCI6MTcwMTUxMzI0N30.Iq2Gwlsjz2mN2z7E3GLwaaCEZMM8xK_k1_iwNdXY_uI');
INSERT INTO `admin_ip` VALUES (9, 1, '183.234.123.118', '移动', '2023-12-02 20:18:12', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE1MTk0OTIsImV4cCI6MTcwMTUyMzA5Mn0.kjr-F_6i0gbjD5TFbo9yYxldSq1I1Ig1YiNokxK4ock');
INSERT INTO `admin_ip` VALUES (10, 1, '183.234.123.118', '移动', '2023-12-02 21:23:24', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE1MjM0MDMsImV4cCI6MTcwMTUyNzAwM30.pNjiNchp1f8wcbAbIXHRezap4us9a2hmBgFMGXsSPGM');
INSERT INTO `admin_ip` VALUES (11, 1, '183.234.123.118', '移动', '2023-12-02 22:23:35', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE1MjcwMTUsImV4cCI6MTcwMTUzMDYxNX0.VWEhCGchW6L8OdLN9OKo6g3WD8km4jvN4-831EsU9A4');
INSERT INTO `admin_ip` VALUES (12, 1, '183.234.123.118', '移动', '2023-12-03 08:32:03', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE1NjM1MjMsImV4cCI6MTcwMTU2NzEyM30.9EGBHmI46SONJbEEBuZI76BB-stH1HR33uY9b51DLk8');
INSERT INTO `admin_ip` VALUES (13, 1, '183.234.123.118', '移动', '2023-12-03 15:13:57', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE1ODc2MzcsImV4cCI6MTcwMTU5MTIzN30.GFT8UVlLeu2ArLhAnUvPmNX1BKnvthIAk45xzY5h0Uc');
INSERT INTO `admin_ip` VALUES (14, 1, '183.234.123.118', '移动', '2023-12-03 16:17:39', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE1OTE0NTksImV4cCI6MTcwMTU5NTA1OX0.bpELeG_MGF8SnMRnTRvLxAgX-IMkKfIoTeOOSkf5SF8');
INSERT INTO `admin_ip` VALUES (15, 1, '183.234.123.118', '移动', '2023-12-03 17:20:11', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE1OTUyMTAsImV4cCI6MTcwMTU5ODgxMH0.9vBnZ1qWoPeHTanBv-Jv6JeehYmniOsYoLn1RojWiys');
INSERT INTO `admin_ip` VALUES (16, 1, '183.234.123.118', '移动', '2023-12-03 17:49:39', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE1OTY5NzksImV4cCI6MTcwMTYwMDU3OX0.THuA5vCor9VkslsRla4fQiUc54dn59os0tAK2Az7WRY');
INSERT INTO `admin_ip` VALUES (17, 1, '183.234.123.118', '移动', '2023-12-03 17:50:37', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE1OTcwMzYsImV4cCI6MTcwMTYwMDYzNn0.9yZZTXqM5SHwMCxpOW3kH7nshhKCFOrSPwZ-nxYD4Ro');
INSERT INTO `admin_ip` VALUES (18, 1, '183.234.123.118', '移动', '2023-12-03 17:53:02', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE1OTcxODIsImV4cCI6MTcwMTYwMDc4Mn0.BsQ6H0THsInv4UYUCmVOeVtHEWryM4-Z43tXHKXgBww');
INSERT INTO `admin_ip` VALUES (19, 1, '183.234.123.118', '移动', '2023-12-03 17:54:44', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE1OTcyODMsImV4cCI6MTcwMTYwMDg4M30.DeaqqfLCimhx2ZrWRBUg6x5iRTTgjTCAZAQa-e_38ME');
INSERT INTO `admin_ip` VALUES (20, 1, '183.234.123.118', '移动', '2023-12-03 18:09:28', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE1OTgxNjgsImV4cCI6MTcwMTYwMTc2OH0.4_jGWnirAC0VyemHfIRQCA2HxfklIO5W5glNZWj6Iso');
INSERT INTO `admin_ip` VALUES (21, 1, '183.234.123.118', '移动', '2023-12-04 10:10:14', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE2NTU4MTQsImV4cCI6MTcwMTY1OTQxNH0.c7Ms8q3ykujTKmzcpAY-GJE1g4Mv_USCIlsqsLSon7U');
INSERT INTO `admin_ip` VALUES (22, 1, '183.234.123.118', '移动', '2023-12-04 11:47:20', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE2NjE2NDAsImV4cCI6MTcwMTY2NTI0MH0.RklkwPlRRMb-_IC3lT4_S-IjDyLs5-BdVoOpArw4K4w');
INSERT INTO `admin_ip` VALUES (23, 1, '183.234.123.118', '移动', '2023-12-04 16:15:22', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE2Nzc3MjEsImV4cCI6MTcwMTY4MTMyMX0.toT5TmexFjpc8pXKsgpaskXMBP-ubyMSDeEm0shfZb0');
INSERT INTO `admin_ip` VALUES (24, 1, '183.234.123.118', '移动', '2023-12-04 17:28:46', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE2ODIxMjYsImV4cCI6MTcwMTY4NTcyNn0.wlLC4WTQytKwhdP0ZJIPOILEdD6C07RgjPgv27fF1G8');

-- ----------------------------
-- Table structure for classes
-- ----------------------------
DROP TABLE IF EXISTS `classes`;
CREATE TABLE `classes`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '主键',
  `class_id` int NOT NULL COMMENT '班级代码',
  `class_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '课程名称',
  `start_time` datetime NOT NULL COMMENT '班级创建时间',
  `class_time` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL COMMENT '上课时间地点',
  `remarks` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL COMMENT '网站备注',
  `status` tinyint NOT NULL COMMENT '0正常1关闭',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `class_id`(`class_id` ASC) USING BTREE COMMENT '唯一索引'
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of classes
-- ----------------------------
INSERT INTO `classes` VALUES (22, 2023001, 'Web程序开发课程', '2023-12-02 11:19:00', '公楼C404 周二上午一二节', '本课程旨在于培养学生的程序开发兴趣', 0);
INSERT INTO `classes` VALUES (28, 2023002, '管理信息2', '2023-12-04 11:50:25', '123', '12346546666666', 1);
INSERT INTO `classes` VALUES (30, 2005, '管理信息课程', '2023-12-04 16:25:44', '公楼C404 周二上午一二节', '无', 0);

-- ----------------------------
-- Table structure for is_work
-- ----------------------------
DROP TABLE IF EXISTS `is_work`;
CREATE TABLE `is_work`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id',
  `class_id` int NOT NULL COMMENT '班级代码',
  `work_id` int NOT NULL COMMENT '作业号',
  `stu_no` int NOT NULL COMMENT '学号',
  `is_true` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '0未上传、1已上传',
  `last_time` datetime NOT NULL COMMENT '最近提交时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of is_work
-- ----------------------------

-- ----------------------------
-- Table structure for score
-- ----------------------------
DROP TABLE IF EXISTS `score`;
CREATE TABLE `score`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id',
  `class_id` int NOT NULL COMMENT '班级代码',
  `work_id` int NOT NULL COMMENT '被评价的作业次数',
  `stu_no` int NOT NULL COMMENT '被评价的学生',
  `to_stu_no` int NOT NULL COMMENT '参与评分的学生',
  `score` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '作业分数',
  `start_time` datetime NOT NULL COMMENT '评价时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of score
-- ----------------------------

-- ----------------------------
-- Table structure for stu
-- ----------------------------
DROP TABLE IF EXISTS `stu`;
CREATE TABLE `stu`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主健字段',
  `class_id` int NOT NULL COMMENT '所属班级代码',
  `stu_no` int NOT NULL COMMENT '学生学号',
  `stu_pwd` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '密码',
  `stu_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '学生姓名',
  `gender` tinyint NOT NULL COMMENT '性别0男1女',
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '学生邮箱',
  `add_time` datetime NOT NULL COMMENT '添加时间',
  `last_time` datetime NOT NULL COMMENT '最近登录时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_stu_name`(`stu_name` ASC) USING BTREE COMMENT '姓名查询'
) ENGINE = InnoDB AUTO_INCREMENT = 82 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of stu
-- ----------------------------
INSERT INTO `stu` VALUES (21, 2023001, 2023002, '237f7zw8', '沈锐清', 0, '2833924820@qq.com', '2023-12-02 21:23:38', '2023-12-02 21:23:38');
INSERT INTO `stu` VALUES (22, 2023001, 2023003, 'fcs552t1', '沈锐清', 0, '2833924820@qq.com', '2023-12-02 21:23:38', '2023-12-02 21:23:38');
INSERT INTO `stu` VALUES (23, 2023001, 2023004, 'zcx0ebts', '测试人员b', 0, '2833924820@qq.com', '2023-12-03 09:04:36', '2023-12-03 09:04:36');
INSERT INTO `stu` VALUES (24, 2023001, 2023005, 'rs6yifb6', '测试人员b', 0, '2833924820@qq.com', '2023-12-03 09:06:30', '2023-12-03 09:06:30');
INSERT INTO `stu` VALUES (25, 2023001, 2023006, 'xyp8cetd', '测试人员c', 0, '2833924820@qq.com', '2023-12-03 09:07:46', '2023-12-03 09:07:46');
INSERT INTO `stu` VALUES (26, 2023001, 2023007, '6lclit96', '测试人员c', 0, '2833924820@qq.com', '2023-12-03 09:08:23', '2023-12-03 09:08:23');
INSERT INTO `stu` VALUES (27, 2023001, 2023008, '945546546546453', '测试人员c', 0, '2833924820@qq.com', '2023-12-03 09:09:50', '2023-12-03 09:09:50');
INSERT INTO `stu` VALUES (28, 2023001, 2023009, '6ijjftnf', '测试人员c', 0, '2833924820@qq.com', '2023-12-03 09:10:26', '2023-12-03 09:10:26');
INSERT INTO `stu` VALUES (32, 2023002, 2023001, '7sji458y', '沈锐清', 0, '2833924820@qq.com', '2023-12-04 12:08:26', '2023-12-04 12:08:26');
INSERT INTO `stu` VALUES (33, 2023002, 2023002, '123456', '小燕', 1, '2833924820@qq.com', '2023-12-04 16:16:30', '2023-12-04 16:16:30');
INSERT INTO `stu` VALUES (34, 2023002, 2023003, 'xb0ilea8', '测试人员5', 0, '2833924820@qq.com', '2023-12-04 16:17:21', '2023-12-04 16:17:21');
INSERT INTO `stu` VALUES (35, 2005, 181120201, '5xqhgf6q', '李耀灿', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (36, 2005, 201120184, 'q10xoq49', '陈楚培', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (37, 2005, 201120185, '95b0lhmv', '黄泽娟', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (38, 2005, 201120186, '0oxa4mpu', '陆夏琳', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (39, 2005, 201120187, 'k39ymjed', '黄波评', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (40, 2005, 201120188, '6j0mg4n6', '杨思婷', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (41, 2005, 201120189, 'uqmm0dcd', '李婉婷', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (42, 2005, 201120190, '1cjrz690', '温梓倩', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (43, 2005, 201120192, 'up1or2hi', '余奕济', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (44, 2005, 201120193, 'wa7rrcmr', '陈静微', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (45, 2005, 201120194, 'fzgjm3hf', '罗华琳', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (46, 2005, 201120195, '6r3076dd', '谢小庆', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (47, 2005, 201120196, '123456', '沈锐清', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (48, 2005, 201120197, 'necqugms', '李美春', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (49, 2005, 201120198, 'odvjgsu0', '潘炫宇', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (50, 2005, 201120199, '4xhqlxue', '何宇健', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (51, 2005, 201120200, 'qfnbzbna', '郑炫晴', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (52, 2005, 201120201, 'd5imyoqk', '何锡佳', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (53, 2005, 201120202, 'ozyoga7t', '孔祥盛', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (54, 2005, 201120203, 'wvdcxh16', '古伟浩', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (55, 2005, 201120205, '6n4xwi60', '何远波', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (56, 2005, 201120206, 't3oin6wu', '许嘉豪', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (57, 2005, 201120207, 'bvaw7zww', '方依颖', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (58, 2005, 201120208, 'icsskb5r', '温智康', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (59, 2005, 201120209, 'zj0wtmyo', '刘展文', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (60, 2005, 201120210, 'a1ivc7x8', '黄德涌', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (61, 2005, 201120211, '1h5r4chh', '余缘', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (62, 2005, 201120212, 'ipodqdup', '欧阳鑫', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (63, 2005, 201120213, 'mnuryzvt', '林映昇', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (64, 2005, 201120214, '451uopel', '汤雪雁', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (65, 2005, 201120215, 'geeiyhxv', '廖燕瑜', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (66, 2005, 201120216, 'grii42z8', '陈家启', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (67, 2005, 201120217, 'ovi5eup9', '辜英琪', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (68, 2005, 201120218, 'ajpu3pvn', '梁传君', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (69, 2005, 201120221, '14p164pv', '林嘉敏', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (70, 2005, 201120222, 'a6x84wap', '蔡秋霞', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (71, 2005, 201120223, 'b0cha6zz', '何泽琳', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (72, 2005, 201120225, 'pv6412e6', '黄特峰', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (73, 2005, 201120226, 'hhejohrr', '杨添', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (74, 2005, 201120227, 'ix3sqo2g', '许玉纯', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (75, 2005, 201120228, 'h9eaq563', '刘楷浩', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (76, 2005, 201120294, 'hoc6h63s', '唐晓漫', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (77, 2005, 201120296, 'gjael6al', '彭方红霞', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (78, 2005, 201120297, 'pfc72yxl', '杨磊', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (79, 2005, 201120298, '4j3r1gob', '王广', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (80, 2005, 201120299, 'rymuav72', '姜关雨', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');
INSERT INTO `stu` VALUES (81, 2005, 201120300, 'dfli4rwy', '姜龙', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09');

-- ----------------------------
-- Table structure for work
-- ----------------------------
DROP TABLE IF EXISTS `work`;
CREATE TABLE `work`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id',
  `class_id` int NOT NULL COMMENT '班级代码',
  `work_id` tinyint NOT NULL COMMENT '第几次作业,填写1，2，3',
  `work_remarks` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '作业描述',
  `work_start_time` datetime NOT NULL COMMENT '作业创建时间',
  `work_last_time` datetime NOT NULL COMMENT '作业截止时间',
  `status` tinyint NOT NULL COMMENT '作业状态，0开启，1关闭（手动调整的）',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of work
-- ----------------------------
INSERT INTO `work` VALUES (19, 2023001, 4, '44', '2023-12-03 15:23:58', '2023-12-03 00:00:00', 0);
INSERT INTO `work` VALUES (20, 2023001, 12, '12', '2023-12-03 16:02:51', '2023-12-05 00:00:00', 0);
INSERT INTO `work` VALUES (21, 2005, 1, '项目文档', '2023-12-04 16:33:34', '2023-12-31 00:00:00', 0);
INSERT INTO `work` VALUES (22, 2005, 2, '个人网页', '2023-12-04 16:31:49', '2023-12-31 00:00:00', 0);

-- ----------------------------
-- Table structure for works
-- ----------------------------
DROP TABLE IF EXISTS `works`;
CREATE TABLE `works`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'id',
  `class_id` int NOT NULL COMMENT '班级代码',
  `work_id` int NOT NULL COMMENT '所属作业的id',
  `stu_no` int NOT NULL COMMENT '所属的学生',
  `filename` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '文件的名称',
  `work_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '作业的路径',
  `start_time` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci COMMENT = '这是一个存储学生文件上传路径的表' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of works
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
