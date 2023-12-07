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

 Date: 07/12/2023 23:04:04
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
INSERT INTO `admin` VALUES (1, 'admin', 'admin', '管理员', 'smtp.163.com', 'srq2138099022@163.com', 'TOWATVEECUOBBIOU', '2023-03-15 14:22:19', '2023-12-07 22:54:40', 54, 'http://works_pro.srqcode.com/student/login');

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
) ENGINE = InnoDB AUTO_INCREMENT = 51 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `admin_ip` VALUES (25, 1, '183.234.123.118', '移动', '2023-12-04 23:09:33', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE3MDI1NzMsImV4cCI6MTcwMTcwNjE3M30.dj4m8k1lJ7ZulHUE6-G_Pww1zjB5ImSDAxbceWP-f8s');
INSERT INTO `admin_ip` VALUES (26, 1, '183.234.123.118', '移动', '2023-12-04 23:12:14', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE3MDI3MzQsImV4cCI6MTcwMTcwNjMzNH0.-TNPjLX4L_E9qQ8D6Lq3eqnoSZrFT8DFuKFENAwk_fI');
INSERT INTO `admin_ip` VALUES (27, 1, '183.234.123.118', '移动', '2023-12-04 23:14:38', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE3MDI4NzgsImV4cCI6MTcwMTcwNjQ3OH0.xw7lm1QEyT9c_SsOAQvBoE4G8r2zUpkEyEV4jolyzPg');
INSERT INTO `admin_ip` VALUES (28, 1, '183.234.123.118', '移动', '2023-12-04 23:18:50', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE3MDMxMjksImV4cCI6MTcwMTcwNjcyOX0.M5o3tJvU4B5MdRdhAptphZfOPwkhc9omTKNZOaVscys');
INSERT INTO `admin_ip` VALUES (29, 1, '183.234.123.118', '移动', '2023-12-04 23:21:08', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE3MDMyNjgsImV4cCI6MTcwMTcwNjg2OH0.ky2yFv6vdg1BO7MPjRsRS9XzZ8aD9jm_d47Ma1O06kc');
INSERT INTO `admin_ip` VALUES (30, 1, '183.234.123.118', '移动', '2023-12-05 11:01:24', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE3NDUyODQsImV4cCI6MTcwMTc0ODg4NH0.W8ih3_pe2rBKV6hdgRI1IXzxAptDRICVVL5AuxphKp0');
INSERT INTO `admin_ip` VALUES (31, 1, '183.234.123.118', '移动', '2023-12-05 14:46:44', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE3NTg4MDQsImV4cCI6MTcwMTc2MjQwNH0.U-f6QcJwRNzVYeDiI65o0Xts1_SuYPjlj3GFHiyZnY8');
INSERT INTO `admin_ip` VALUES (32, 1, '183.234.123.118', '移动', '2023-12-06 08:26:03', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE4MjIzNjIsImV4cCI6MTcwMTgyNTk2Mn0.djHB2oUPD0frWG4fnCjl2eFTXA048OEdQc1wx-A0CEo');
INSERT INTO `admin_ip` VALUES (33, 1, '183.234.123.118', '移动', '2023-12-06 09:31:24', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE4MjYyODQsImV4cCI6MTcwMTgyOTg4NH0.nAVYl7fYOzYdYN9E9aXm5zlHNPyKjUFzHENZqjjoM_Q');
INSERT INTO `admin_ip` VALUES (34, 1, '183.234.123.118', '移动', '2023-12-06 16:58:49', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE4NTMxMjksImV4cCI6MTcwMTg1NjcyOX0.VDRMaG8Az8yYfA1eo4B7K4xg6yIIwB0hhUbMdM_ZArw');
INSERT INTO `admin_ip` VALUES (35, 1, '183.234.123.118', '移动', '2023-12-06 17:10:10', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE4NTM4MTAsImV4cCI6MTcwMTg1NzQxMH0.ZByITf4HLvlIfBYV66WT2wASvwFPpKTdixnHSsG3IFs');
INSERT INTO `admin_ip` VALUES (36, 1, '183.234.123.118', '移动', '2023-12-06 17:10:34', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE4NTM4MzMsImV4cCI6MTcwMTg1NzQzM30.ZR1HzLViedKi1aO9BY1c79w9vc7K9iWPoUb4UPH1pvI');
INSERT INTO `admin_ip` VALUES (37, 1, '183.234.123.118', '移动', '2023-12-06 18:12:18', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE4NTc1MzgsImV4cCI6MTcwMTg2MTEzOH0.84i3h6DzDz5JNkZkRkBZtDTMKNeCdcPM4L9lWFKVZzI');
INSERT INTO `admin_ip` VALUES (38, 1, '183.234.123.118', '移动', '2023-12-06 18:12:26', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE4NTc1NDYsImV4cCI6MTcwMTg2MTE0Nn0.upsX-kfJri5ZHC1T5vv1JmuHXULQEXri3c8XfngBspY');
INSERT INTO `admin_ip` VALUES (39, 1, '183.234.123.118', '移动', '2023-12-07 10:40:54', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE5MTY4NTMsImV4cCI6MTcwMTkyMDQ1M30.8OH5mZuAnWSzzB-bZyuEwmtngy94VN8_183Bch9SZuo');
INSERT INTO `admin_ip` VALUES (40, 1, '183.234.123.118', '移动', '2023-12-07 11:41:46', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE5MjA1MDYsImV4cCI6MTcwMTkyNDEwNn0.mNo2WNYgsD3LfeCCRStl0Y107Q9GyfZt_UEvLJvgFfI');
INSERT INTO `admin_ip` VALUES (41, 1, '183.234.123.118', '移动', '2023-12-07 12:43:08', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE5MjQxODgsImV4cCI6MTcwMTkyNzc4OH0.4y_YGHL1ShKpu2OW_PgYq1fCD5fdLmpbTJD-_2xS6i0');
INSERT INTO `admin_ip` VALUES (42, 1, '183.234.123.118', '移动', '2023-12-07 15:07:01', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE5MzI4MjEsImV4cCI6MTcwMTkzNjQyMX0.LfLBs4F00020cJpS0UfuPB-OpqeAfjZV_MEnMtuaGS0');
INSERT INTO `admin_ip` VALUES (43, 1, '183.234.123.118', '移动', '2023-12-07 21:09:15', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE5NTQ1NTUsImV4cCI6MTcwMTk1ODE1NX0.-pRIFnOv9AVl_mkgPsKfBuqQL2GHeDGDijWvyXOiv0w');
INSERT INTO `admin_ip` VALUES (44, 1, '183.234.123.118', '移动', '2023-12-07 21:27:48', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE5NTU2NjgsImV4cCI6MTcwMTk1OTI2OH0.S4VrZjCxtWNog-c4hMR-Y7q-G-ZjJXmxbiAKH0ZaZE0');
INSERT INTO `admin_ip` VALUES (45, 1, '183.234.123.118', '移动', '2023-12-07 21:28:26', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE5NTU3MDYsImV4cCI6MTcwMTk1OTMwNn0.INcEMCrW3dVWxoVbh0vwRbkVBKdD3GjFW3YbQkPXK44');
INSERT INTO `admin_ip` VALUES (46, 1, '183.234.123.118', '移动', '2023-12-07 21:28:35', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE5NTU3MTUsImV4cCI6MTcwMTk1OTMxNX0.yjpQ0M4sXhNzB1uHg-6-DDhvGJwgVQ1E0l6Jg4iX4dQ');
INSERT INTO `admin_ip` VALUES (47, 1, '183.234.123.118', '移动', '2023-12-07 21:30:48', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE5NTU4NDgsImV4cCI6MTcwMTk1OTQ0OH0.UBDlCAffomAx1WexVinnT3meX5G0JW9UM3gJWm6uIH8');
INSERT INTO `admin_ip` VALUES (48, 1, '183.234.123.118', '移动', '2023-12-07 21:30:57', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE5NTU4NTcsImV4cCI6MTcwMTk1OTQ1N30.LEiux52wuzdkRWyhGtUy60mouIhzPqWG_oc_eUye2ow');
INSERT INTO `admin_ip` VALUES (49, 1, '183.234.123.118', '移动', '2023-12-07 21:34:12', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE5NTYwNTEsImV4cCI6MTcwMTk1OTY1MX0.dgRRyCvFvCvNitrPE-k7wyKgRecFoTOC3TJoz_77D8Q');
INSERT INTO `admin_ip` VALUES (50, 1, '183.234.123.118', '移动', '2023-12-07 22:54:40', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1bmFtZSI6ImFkbWluIiwidW5hbWVfaWQiOjEsImlzcyI6Im1laXpob3UiLCJpYXQiOjE3MDE5NjA4ODAsImV4cCI6MTcwMTk2NDQ4MH0.pAn6AHknodOmRTShxodXarEj7R6fKPAipNKTEV1x9sk');

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
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of classes
-- ----------------------------
INSERT INTO `classes` VALUES (22, 2023001, 'Web程序开发课程', '2023-12-02 11:19:00', '公楼C404 周二上午一二节', '本课程旨在于培养学生的程序开发兴趣！', 0);
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
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of is_work
-- ----------------------------
INSERT INTO `is_work` VALUES (6, 2005, 2, 201120184, '1', '2023-12-07 22:44:27');
INSERT INTO `is_work` VALUES (7, 2005, 1, 201120184, '1', '2023-12-07 22:46:26');

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
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of score
-- ----------------------------
INSERT INTO `score` VALUES (5, 2005, 2, 201120184, 201120184, '10', '2023-12-06 09:31:00');
INSERT INTO `score` VALUES (6, 2005, 1, 201120184, 201120184, '100', '2023-12-07 22:54:16');

-- ----------------------------
-- Table structure for stu
-- ----------------------------
DROP TABLE IF EXISTS `stu`;
CREATE TABLE `stu`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '主健字段',
  `class_id` int NOT NULL COMMENT '所属班级代码',
  `stu_no` int NOT NULL COMMENT '学生学号',
  `stu_pwd` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '密码',
  `stu_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '学生姓名',
  `gender` tinyint NOT NULL COMMENT '性别0男1女',
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '学生邮箱',
  `add_time` datetime NOT NULL COMMENT '添加时间',
  `last_time` datetime NOT NULL COMMENT '最近登录时间',
  `count` int NULL DEFAULT 0 COMMENT '登录次数',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_stu_name`(`stu_name` ASC) USING BTREE COMMENT '姓名查询'
) ENGINE = InnoDB AUTO_INCREMENT = 134 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of stu
-- ----------------------------
INSERT INTO `stu` VALUES (36, 2005, 201120184, '123456', '陈楚培', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-07 22:38:56', 18);
INSERT INTO `stu` VALUES (37, 2005, 201120185, '95b0lhmv', '黄泽娟', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (38, 2005, 201120186, '0oxa4mpu', '陆夏琳', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (39, 2005, 201120187, 'k39ymjed', '黄波评', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (40, 2005, 201120188, '6j0mg4n6', '杨思婷', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (41, 2005, 201120189, 'uqmm0dcd', '李婉婷', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (42, 2005, 201120190, '1cjrz690', '温梓倩', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (43, 2005, 201120192, 'up1or2hi', '余奕济', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (44, 2005, 201120193, 'wa7rrcmr', '陈静微', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (45, 2005, 201120194, 'fzgjm3hf', '罗华琳', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (46, 2005, 201120195, '6r3076dd', '谢小庆', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (47, 2005, 201120196, '123456', '沈锐清', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (48, 2005, 201120197, 'necqugms', '李美春', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (49, 2005, 201120198, 'odvjgsu0', '潘炫宇', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (50, 2005, 201120199, '4xhqlxue', '何宇健', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (51, 2005, 201120200, 'qfnbzbna', '郑炫晴', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (52, 2005, 201120201, 'd5imyoqk', '何锡佳', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (53, 2005, 201120202, 'ozyoga7t', '孔祥盛', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (54, 2005, 201120203, 'wvdcxh16', '古伟浩', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (55, 2005, 201120205, '6n4xwi60', '何远波', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (56, 2005, 201120206, 't3oin6wu', '许嘉豪', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (57, 2005, 201120207, 'bvaw7zww', '方依颖', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (58, 2005, 201120208, 'icsskb5r', '温智康', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (59, 2005, 201120209, 'zj0wtmyo', '刘展文', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (60, 2005, 201120210, 'a1ivc7x8', '黄德涌', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (61, 2005, 201120211, '1h5r4chh', '余缘', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (62, 2005, 201120212, 'ipodqdup', '欧阳鑫', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (63, 2005, 201120213, 'mnuryzvt', '林映昇', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (64, 2005, 201120214, '451uopel', '汤雪雁', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (65, 2005, 201120215, 'geeiyhxv', '廖燕瑜', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (66, 2005, 201120216, 'grii42z8', '陈家启', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (67, 2005, 201120217, 'ovi5eup9', '辜英琪', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (68, 2005, 201120218, 'ajpu3pvn', '梁传君', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (69, 2005, 201120221, '14p164pv', '林嘉敏', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (70, 2005, 201120222, 'a6x84wap', '蔡秋霞', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (71, 2005, 201120223, 'b0cha6zz', '何泽琳', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (72, 2005, 201120225, 'pv6412e6', '黄特峰', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (73, 2005, 201120226, 'hhejohrr', '杨添', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (74, 2005, 201120227, 'ix3sqo2g', '许玉纯', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (75, 2005, 201120228, 'h9eaq563', '刘楷浩', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (76, 2005, 201120294, 'hoc6h63s', '唐晓漫', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (77, 2005, 201120296, 'gjael6al', '彭方红霞', 1, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (78, 2005, 201120297, 'pfc72yxl', '杨磊', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (79, 2005, 201120298, '4j3r1gob', '王广', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (80, 2005, 201120299, 'rymuav72', '姜关雨', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);
INSERT INTO `stu` VALUES (81, 2005, 201120300, 'dfli4rwy', '姜龙', 0, '2833924820@qq.com', '2023-12-04 16:26:09', '2023-12-04 16:26:09', 0);

-- ----------------------------
-- Table structure for stu_ip
-- ----------------------------
DROP TABLE IF EXISTS `stu_ip`;
CREATE TABLE `stu_ip`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int NULL DEFAULT NULL COMMENT '班级代码',
  `stu_no` int NOT NULL COMMENT '登录用户id',
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '用户ip',
  `lsp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '登录服务商',
  `last_time` datetime NOT NULL COMMENT '登录时间',
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '登录城市',
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '登录token',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of stu_ip
-- ----------------------------
INSERT INTO `stu_ip` VALUES (25, 2005, 201120184, '183.234.123.118', '移动', '2023-12-04 23:14:47', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MzYsInN0dV9ubyI6MjAxMTIwMTg0LCJjbGFzc19pZCI6MjAwNSwiaXNzIjoibWVpemhvdSIsImlhdCI6MTcwMTcwMjg4NywiZXhwIjoxNzAxNzA2NDg3fQ.u5k-5nTCgZ21R6rGcSzJZEtiPRyXrp-9Tdr1nafP8vU');
INSERT INTO `stu_ip` VALUES (26, 2005, 201120184, '183.234.123.118', '移动', '2023-12-05 00:02:27', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MzYsInN0dV9ubyI6MjAxMTIwMTg0LCJjbGFzc19pZCI6MjAwNSwiaXNzIjoibWVpemhvdSIsImlhdCI6MTcwMTcwNTc0NywiZXhwIjoxNzAxNzA5MzQ3fQ.jATM-hKpu33VW0Vl7uVfezbkjrNp_xogZ5Y1Fd1UjBw');
INSERT INTO `stu_ip` VALUES (27, 2005, 201120184, '183.234.123.118', '移动', '2023-12-05 10:08:12', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MzYsInN0dV9ubyI6MjAxMTIwMTg0LCJjbGFzc19pZCI6MjAwNSwiaXNzIjoibWVpemhvdSIsImlhdCI6MTcwMTc0MjA5MiwiZXhwIjoxNzAxNzQ1NjkyfQ.SvISrru1EhqiP6OlTh4d3KjsTCvzpsWpH9-f3Z-OOX0');
INSERT INTO `stu_ip` VALUES (28, 2005, 201120184, '183.234.123.118', '移动', '2023-12-05 11:11:08', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MzYsInN0dV9ubyI6MjAxMTIwMTg0LCJjbGFzc19pZCI6MjAwNSwiaXNzIjoibWVpemhvdSIsImlhdCI6MTcwMTc0NTg2OCwiZXhwIjoxNzAxNzQ5NDY4fQ.31PG53AGFrqDywxXYWJmJaN-bonmcayL0Vn0JxPUn6o');
INSERT INTO `stu_ip` VALUES (29, 2005, 201120184, '183.234.123.118', '移动', '2023-12-05 14:46:40', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MzYsInN0dV9ubyI6MjAxMTIwMTg0LCJjbGFzc19pZCI6MjAwNSwiaXNzIjoibWVpemhvdSIsImlhdCI6MTcwMTc1ODgwMCwiZXhwIjoxNzAxNzYyNDAwfQ.nfXKZig6V8BBhHwmeDDiAzAb37Grkryx746uGFrlK7Y');
INSERT INTO `stu_ip` VALUES (30, 2005, 201120184, '183.234.123.118', '移动', '2023-12-05 15:52:36', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MzYsInN0dV9ubyI6MjAxMTIwMTg0LCJjbGFzc19pZCI6MjAwNSwiaXNzIjoibWVpemhvdSIsImlhdCI6MTcwMTc2Mjc1NiwiZXhwIjoxNzAxNzY2MzU2fQ.wlpH3iE7OqZODhtx8BtxIL81hbgbDiq7HmzPnS5tDM0');
INSERT INTO `stu_ip` VALUES (31, 2005, 201120184, '183.234.123.118', '移动', '2023-12-05 17:26:27', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MzYsInN0dV9ubyI6MjAxMTIwMTg0LCJjbGFzc19pZCI6MjAwNSwiaXNzIjoibWVpemhvdSIsImlhdCI6MTcwMTc2ODM4NywiZXhwIjoxNzAxNzcxOTg3fQ.pPEHxxDXPxf7gLbqtUvk92qv4naf4yQdmFeY3Ly8jfg');
INSERT INTO `stu_ip` VALUES (32, 2005, 201120184, '183.234.123.118', '移动', '2023-12-06 08:25:57', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MzYsInN0dV9ubyI6MjAxMTIwMTg0LCJjbGFzc19pZCI6MjAwNSwiaXNzIjoibWVpemhvdSIsImlhdCI6MTcwMTgyMjM1NywiZXhwIjoxNzAxODI1OTU3fQ.Px3u9_LJEvRmS6sc1a94i12F4WRZIxuq5vcezIrCMJc');
INSERT INTO `stu_ip` VALUES (33, 2005, 201120184, '183.234.123.118', '移动', '2023-12-06 09:26:04', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MzYsInN0dV9ubyI6MjAxMTIwMTg0LCJjbGFzc19pZCI6MjAwNSwiaXNzIjoibWVpemhvdSIsImlhdCI6MTcwMTgyNTk2NCwiZXhwIjoxNzAxODI5NTY0fQ.DB9gDOrLrAxcMOWnFUjdX_asrF6wbD3Qo07SRevvyDo');
INSERT INTO `stu_ip` VALUES (34, 2005, 201120184, '183.234.123.118', '移动', '2023-12-06 18:08:58', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MzYsInN0dV9ubyI6MjAxMTIwMTg0LCJjbGFzc19pZCI6MjAwNSwiaXNzIjoibWVpemhvdSIsImlhdCI6MTcwMTg1NzMzOCwiZXhwIjoxNzAxODYwOTM4fQ.U8YhYoBW77ZersWzCKP4j-GrgK_K0g9UlN9v1O8c6dw');
INSERT INTO `stu_ip` VALUES (35, 2005, 201120184, '183.234.123.118', '移动', '2023-12-06 18:09:40', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MzYsInN0dV9ubyI6MjAxMTIwMTg0LCJjbGFzc19pZCI6MjAwNSwiaXNzIjoibWVpemhvdSIsImlhdCI6MTcwMTg1NzM4MCwiZXhwIjoxNzAxODYwOTgwfQ.sW90cmVKVPJsdTrRXl0tz4QTM_kJmVrLe8mMXztlLF8');
INSERT INTO `stu_ip` VALUES (36, 2005, 201120184, '183.234.123.118', '移动', '2023-12-06 18:11:21', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MzYsInN0dV9ubyI6MjAxMTIwMTg0LCJjbGFzc19pZCI6MjAwNSwiaXNzIjoibWVpemhvdSIsImlhdCI6MTcwMTg1NzQ4MSwiZXhwIjoxNzAxODYxMDgxfQ.1tZ0Lbzj0xY390wJn0Bdbb9dd024sBIVXDaryp35f2s');
INSERT INTO `stu_ip` VALUES (37, 2005, 201120184, '183.234.123.118', '移动', '2023-12-07 10:40:39', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MzYsInN0dV9ubyI6MjAxMTIwMTg0LCJjbGFzc19pZCI6MjAwNSwiaXNzIjoibWVpemhvdSIsImlhdCI6MTcwMTkxNjgzOCwiZXhwIjoxNzAxOTIwNDM4fQ.yD5JMtGSZTngfVLIXZ2bNuCGpFUXaNr5rKfQvk-0H2M');
INSERT INTO `stu_ip` VALUES (38, 2005, 201120184, '183.234.123.118', '移动', '2023-12-07 22:22:22', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MzYsInN0dV9ubyI6MjAxMTIwMTg0LCJjbGFzc19pZCI6MjAwNSwiaXNzIjoibWVpemhvdSIsImlhdCI6MTcwMTk1ODk0MiwiZXhwIjoxNzAxOTYyNTQyfQ.NgI1inFfFqI-FIvqaaY1nKD0EAdqC6N39MNfQIynR18');
INSERT INTO `stu_ip` VALUES (39, 2005, 201120184, '183.234.123.118', '移动', '2023-12-07 22:26:51', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MzYsInN0dV9ubyI6MjAxMTIwMTg0LCJjbGFzc19pZCI6MjAwNSwiaXNzIjoibWVpemhvdSIsImlhdCI6MTcwMTk1OTIxMSwiZXhwIjoxNzAxOTYyODExfQ.3rss4P7CcPWnC-FVTKOc1Wc08ie_1s9Va4fl0vwjO8I');
INSERT INTO `stu_ip` VALUES (40, 2005, 201120184, '183.234.123.118', '移动', '2023-12-07 22:27:18', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MzYsInN0dV9ubyI6MjAxMTIwMTg0LCJjbGFzc19pZCI6MjAwNSwiaXNzIjoibWVpemhvdSIsImlhdCI6MTcwMTk1OTIzNywiZXhwIjoxNzAxOTYyODM3fQ.Qg-mpxGqK7JLRZAuAQVVFG54nloj_zHlT3cJXivGx-s');
INSERT INTO `stu_ip` VALUES (41, 2005, 201120184, '183.234.123.118', '移动', '2023-12-07 22:38:56', '梅州', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MzYsInN0dV9ubyI6MjAxMTIwMTg0LCJjbGFzc19pZCI6MjAwNSwiaXNzIjoibWVpemhvdSIsImlhdCI6MTcwMTk1OTkzNiwiZXhwIjoxNzAxOTYzNTM2fQ.mGX2vBKip6xERmGOPpWs6WlvS1bXEpVI6BsyH5gEnpk');

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
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of work
-- ----------------------------
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
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci COMMENT = '这是一个存储学生文件上传路径的表' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of works
-- ----------------------------
INSERT INTO `works` VALUES (14, 2005, 2, 201120184, 'index.pdf', 'storage/2005/stu_work/2/201120184/index.pdf', '2023-12-05 16:47:38');
INSERT INTO `works` VALUES (15, 2005, 2, 201120184, 'hyj.jpg', 'storage/2005/stu_work/2/201120184/hyj.jpg', '2023-12-07 22:42:07');
INSERT INTO `works` VALUES (16, 2005, 1, 201120184, 'cc.jpg', 'storage/2005/stu_work/1/201120184/cc.jpg', '2023-12-07 22:45:40');
INSERT INTO `works` VALUES (17, 2005, 1, 201120184, 'hzl.jpg', 'storage/2005/stu_work/1/201120184/hzl.jpg', '2023-12-07 22:45:41');
INSERT INTO `works` VALUES (18, 2005, 1, 201120184, 'yy.jpg', 'storage/2005/stu_work/1/201120184/yy.jpg', '2023-12-07 22:45:41');
INSERT INTO `works` VALUES (19, 2005, 1, 201120184, 'qq.jpg', 'storage/2005/stu_work/1/201120184/qq.jpg', '2023-12-07 22:45:42');
INSERT INTO `works` VALUES (20, 2005, 1, 201120184, 'hyj.jpg', 'storage/2005/stu_work/1/201120184/hyj.jpg', '2023-12-07 22:45:43');
INSERT INTO `works` VALUES (21, 2005, 1, 201120184, 'index.pdf', 'storage/2005/stu_work/1/201120184/index.pdf', '2023-12-07 22:46:21');

SET FOREIGN_KEY_CHECKS = 1;
