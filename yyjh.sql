/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50610
Source Host           : localhost:3306
Source Database       : yyjh

Target Server Type    : MYSQL
Target Server Version : 50610
File Encoding         : 65001

Date: 2017-10-09 10:03:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sl_sys_fun
-- ----------------------------
DROP TABLE IF EXISTS `sl_sys_fun`;
CREATE TABLE `sl_sys_fun` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID记录唯一标识',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '名称',
  `description` varchar(50) NOT NULL DEFAULT '' COMMENT '描述',
  `msort` int(10) unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  `mstatus` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `flag` varchar(10) NOT NULL DEFAULT '' COMMENT '唯一标识码',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sl_sys_fun
-- ----------------------------
INSERT INTO `sl_sys_fun` VALUES ('1', '添加', '', '100', '0', 'ADD', '2017-09-30 17:24:43', '2017-10-09 09:56:09');
INSERT INTO `sl_sys_fun` VALUES ('2', '修改', '', '100', '0', 'EDIT', '2017-09-30 17:53:10', '2017-10-09 09:35:29');
INSERT INTO `sl_sys_fun` VALUES ('3', '删除', '', '100', '0', 'DEL', '2017-09-30 17:55:58', '2017-10-09 09:35:35');
INSERT INTO `sl_sys_fun` VALUES ('6', '启用/禁用', '', '100', '0', 'STATUS', '2017-10-09 09:31:22', '2017-10-09 09:35:40');
INSERT INTO `sl_sys_fun` VALUES ('7', '功能', '', '100', '0', 'FUN', '2017-10-09 09:31:28', '2017-10-09 09:35:46');
INSERT INTO `sl_sys_fun` VALUES ('8', '详情', '', '100', '0', 'INFO', '2017-10-09 09:31:33', '2017-10-09 09:35:51');
INSERT INTO `sl_sys_fun` VALUES ('9', '管理员', '', '100', '0', 'ADMIN', '2017-10-09 09:31:38', '2017-10-09 09:35:55');
INSERT INTO `sl_sys_fun` VALUES ('10', '微信菜单', '', '100', '0', 'wechat', '2017-10-09 09:31:43', '2017-10-09 09:36:03');
INSERT INTO `sl_sys_fun` VALUES ('11', '医养护菜单', '', '100', '0', 'yyh', '2017-10-09 09:31:48', '2017-10-09 09:36:13');
INSERT INTO `sl_sys_fun` VALUES ('12', '审批', '', '100', '0', 'approve', '2017-10-09 09:31:53', '2017-10-09 09:36:14');

-- ----------------------------
-- Table structure for sl_sys_module
-- ----------------------------
DROP TABLE IF EXISTS `sl_sys_module`;
CREATE TABLE `sl_sys_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL DEFAULT '' COMMENT '名称',
  `description` char(50) NOT NULL DEFAULT '',
  `msort` int(10) unsigned NOT NULL DEFAULT '100',
  `mstatus` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `hid` int(10) unsigned NOT NULL DEFAULT '0',
  `linkurl` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `mindex` (`id`,`mstatus`,`hid`)
) ENGINE=MyISAM AUTO_INCREMENT=174 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sl_sys_module
-- ----------------------------
INSERT INTO `sl_sys_module` VALUES ('1', '系统管理', '', '900', '0', '0', '');
INSERT INTO `sl_sys_module` VALUES ('2', '系统功能', '', '100', '0', '84', 'SysFun/index');
INSERT INTO `sl_sys_module` VALUES ('3', '系统模块', '', '101', '0', '84', 'SysModule/index');
INSERT INTO `sl_sys_module` VALUES ('4', '角色管理', '', '220', '0', '1', 'SysRole/index');
INSERT INTO `sl_sys_module` VALUES ('5', '用户管理', '', '230', '0', '1', 'SysUser/index');
INSERT INTO `sl_sys_module` VALUES ('44', '血糖仪', '', '200', '0', '40', 'Device/sugar');
INSERT INTO `sl_sys_module` VALUES ('45', '菜单管理', '', '800', '0', '0', '');
INSERT INTO `sl_sys_module` VALUES ('46', '微信菜单', '', '100', '0', '45', 'Menu/index');
INSERT INTO `sl_sys_module` VALUES ('47', '医养护菜单', '', '200', '0', '45', 'Menu/yyh');
INSERT INTO `sl_sys_module` VALUES ('48', '医院管理', '', '150', '0', '1', 'Hospital/index');
INSERT INTO `sl_sys_module` VALUES ('49', '档案管理', '', '400', '0', '0', '');
INSERT INTO `sl_sys_module` VALUES ('40', '设备管理', '', '600', '0', '0', '');
INSERT INTO `sl_sys_module` VALUES ('41', '移动设备', '', '300', '0', '40', 'Device/hospital');
INSERT INTO `sl_sys_module` VALUES ('42', '村级设备', '', '400', '0', '40', 'Device/index');
INSERT INTO `sl_sys_module` VALUES ('43', '血压计', '', '100', '0', '40', 'Device/blood');
INSERT INTO `sl_sys_module` VALUES ('50', '家庭档案', '', '100', '1', '49', 'Family/index');
INSERT INTO `sl_sys_module` VALUES ('51', '健康档案', '', '100', '0', '49', 'Member/index');
INSERT INTO `sl_sys_module` VALUES ('52', '菜单管理', '', '700', '0', '0', '');
INSERT INTO `sl_sys_module` VALUES ('53', '项目分类', '', '100', '1', '52', 'SysBase/index');
INSERT INTO `sl_sys_module` VALUES ('54', '基础数据', '', '100', '1', '52', 'SysBaseData/index');
INSERT INTO `sl_sys_module` VALUES ('55', '医疗支撑', '', '100', '0', '0', '');
INSERT INTO `sl_sys_module` VALUES ('56', '身心调养', '', '200', '0', '0', '');
INSERT INTO `sl_sys_module` VALUES ('57', '健康教育', '', '1', '0', '56', 'Heducation/index');
INSERT INTO `sl_sys_module` VALUES ('58', '兴趣内容', '', '30', '0', '56', 'Interest/index');
INSERT INTO `sl_sys_module` VALUES ('59', '饮食干预', '', '2', '0', '56', 'Eatintervene/index');
INSERT INTO `sl_sys_module` VALUES ('60', '健康评估', '', '70', '0', '55', 'Healthy/index');
INSERT INTO `sl_sys_module` VALUES ('61', '转诊转出', '', '60', '0', '55', 'Getout/index');
INSERT INTO `sl_sys_module` VALUES ('62', '转诊回转', '', '50', '0', '55', 'Getback/index');
INSERT INTO `sl_sys_module` VALUES ('63', '住院申请', '', '40', '0', '55', 'Apphos/index');
INSERT INTO `sl_sys_module` VALUES ('64', '分诊导医', '', '20', '0', '55', 'Triage/index');
INSERT INTO `sl_sys_module` VALUES ('65', '预约专家', '', '10', '0', '55', 'Expert/index');
INSERT INTO `sl_sys_module` VALUES ('66', '健康咨询', '', '999', '0', '55', 'Consult/index');
INSERT INTO `sl_sys_module` VALUES ('120', '专家介绍', '', '30', '0', '52', 'Docter/description');
INSERT INTO `sl_sys_module` VALUES ('69', '健康监护', '', '300', '0', '0', '');
INSERT INTO `sl_sys_module` VALUES ('70', '生活照理', '', '10', '0', '69', 'lifecare/index');
INSERT INTO `sl_sys_module` VALUES ('71', '医健帮理', '', '20', '0', '69', 'Hoshelp/index');
INSERT INTO `sl_sys_module` VALUES ('72', '基本体检', '', '1', '0', '55', 'Basecheck/index');
INSERT INTO `sl_sys_module` VALUES ('73', '深度体检', '', '2', '0', '55', 'Deepcheck/index');
INSERT INTO `sl_sys_module` VALUES ('74', '视频教育', '', '10', '0', '56', 'Music/index');
INSERT INTO `sl_sys_module` VALUES ('75', '图片教育', '', '20', '0', '56', 'Picture/index');
INSERT INTO `sl_sys_module` VALUES ('76', '健康提醒', '', '30', '0', '69', 'Heremind/index');
INSERT INTO `sl_sys_module` VALUES ('132', '生活照理审核', '', '100', '0', '69', 'lifecare/approve');
INSERT INTO `sl_sys_module` VALUES ('131', '医健帮理审核', '', '100', '0', '69', 'Hoshelp/approve');
INSERT INTO `sl_sys_module` VALUES ('80', '血压数据', '', '80', '0', '69', 'Hedata/index');
INSERT INTO `sl_sys_module` VALUES ('81', '血压异常', '', '40', '0', '69', 'Unusualblood/index');
INSERT INTO `sl_sys_module` VALUES ('82', '康复总评', '', '110', '1', '69', 'Rehabiltation/Index');
INSERT INTO `sl_sys_module` VALUES ('83', '卫生室管理', '', '100', '0', '1', 'Clinic/index');
INSERT INTO `sl_sys_module` VALUES ('84', '系统框架', '', '999', '0', '0', '');
INSERT INTO `sl_sys_module` VALUES ('85', '医院信息', '', '200', '0', '1', 'Hospital/info');
INSERT INTO `sl_sys_module` VALUES ('86', '专家列表', '', '40', '0', '1', 'Docter/index');
INSERT INTO `sl_sys_module` VALUES ('87', '科室列表', '', '30', '0', '1', 'Department/index');
INSERT INTO `sl_sys_module` VALUES ('89', '医院检查', '', '4', '0', '55', 'Cfcheck/index');
INSERT INTO `sl_sys_module` VALUES ('119', '先进设备', '', '40', '0', '52', 'Xjsb/index');
INSERT INTO `sl_sys_module` VALUES ('91', '血糖数据', '', '90', '0', '69', 'Sugardata/index');
INSERT INTO `sl_sys_module` VALUES ('92', '医院新闻', '', '40', '0', '1', 'New/index');
INSERT INTO `sl_sys_module` VALUES ('94', '血糖异常', '', '50', '0', '69', 'Unusualsugar/index');
INSERT INTO `sl_sys_module` VALUES ('95', '血压回访', '', '60', '0', '69', 'Xyhf/index');
INSERT INTO `sl_sys_module` VALUES ('96', '血糖回访', '', '65', '0', '69', 'Xthf/index');
INSERT INTO `sl_sys_module` VALUES ('98', '远程监控', '', '500', '0', '0', '');
INSERT INTO `sl_sys_module` VALUES ('99', '健康干预', '', '550', '0', '0', '');
INSERT INTO `sl_sys_module` VALUES ('100', '村级监控', '', '100', '0', '98', 'Cemera/index');
INSERT INTO `sl_sys_module` VALUES ('101', '监控统计', '', '200', '1', '98', 'Hospital/video');
INSERT INTO `sl_sys_module` VALUES ('102', '居家监控', '', '300', '0', '98', 'Spdj/index');
INSERT INTO `sl_sys_module` VALUES ('103', '监护数据', '', '500', '0', '98', 'Shsj/index');
INSERT INTO `sl_sys_module` VALUES ('104', '体质辨识', '', '100', '0', '99', 'Physical/index');
INSERT INTO `sl_sys_module` VALUES ('105', '高血压辨识', '', '200', '0', '99', 'BloodDis/index');
INSERT INTO `sl_sys_module` VALUES ('106', '高血压随访', '', '300', '0', '99', 'BloodDis/follow');
INSERT INTO `sl_sys_module` VALUES ('107', '高血压测试', '', '400', '1', '99', 'BloodDis/test');
INSERT INTO `sl_sys_module` VALUES ('108', '高血糖辨识', '', '500', '0', '99', 'SugarDis/index');
INSERT INTO `sl_sys_module` VALUES ('109', '高血糖随访', '', '550', '0', '99', 'SugarDis/follow');
INSERT INTO `sl_sys_module` VALUES ('110', '高血糖测试', '', '600', '1', '99', 'SugarDis/test');
INSERT INTO `sl_sys_module` VALUES ('111', '儿童中医服务', '', '700', '0', '99', 'ChildServer/index');
INSERT INTO `sl_sys_module` VALUES ('114', '医院介绍', '', '20', '0', '52', 'Hospital/description');
INSERT INTO `sl_sys_module` VALUES ('121', '检查指南', '', '60', '0', '52', 'Jczn/index');
INSERT INTO `sl_sys_module` VALUES ('116', '特色科室', '', '50', '0', '52', 'Ksinfo/special');
INSERT INTO `sl_sys_module` VALUES ('118', '科室介绍', '', '20', '0', '52', 'Ksinfo/index');
INSERT INTO `sl_sys_module` VALUES ('122', '就医指南', '', '70', '0', '52', 'Jyzn/index');
INSERT INTO `sl_sys_module` VALUES ('123', '就诊预约', '', '80', '0', '52', 'Jzyy/index');
INSERT INTO `sl_sys_module` VALUES ('124', '疾病预防', '', '90', '0', '52', 'Jbyf/index');
INSERT INTO `sl_sys_module` VALUES ('125', '人群分类', '', '10', '1', '1', 'People/index');
INSERT INTO `sl_sys_module` VALUES ('126', '病种分类', '', '20', '0', '1', 'Disease/index');
INSERT INTO `sl_sys_module` VALUES ('127', '提醒模板', '', '100', '0', '1', 'Remindtype/index');
INSERT INTO `sl_sys_module` VALUES ('128', '健康课堂', '', '100', '0', '56', 'Course/index');
INSERT INTO `sl_sys_module` VALUES ('129', '兴趣分类', '', '100', '0', '1', 'Interest/type');
INSERT INTO `sl_sys_module` VALUES ('130', '住院审批', '', '100', '0', '55', 'Apphos/approve');
INSERT INTO `sl_sys_module` VALUES ('134', '圣乐简介', '', '100', '0', '52', 'Company/index');
INSERT INTO `sl_sys_module` VALUES ('140', '出院管理', '', '100', '0', '56', 'Leavehos/index');
INSERT INTO `sl_sys_module` VALUES ('137', '形象策划', '', '100', '0', '52', 'Product/xxch');
INSERT INTO `sl_sys_module` VALUES ('138', '移动公卫', '', '100', '0', '52', 'Product/ydgw');
INSERT INTO `sl_sys_module` VALUES ('139', '医养护产品', '', '100', '0', '52', 'Product/index');
INSERT INTO `sl_sys_module` VALUES ('141', '系统动态', '', '100', '1', '1', 'Data/index');
INSERT INTO `sl_sys_module` VALUES ('142', '家庭签约', '', '100', '0', '166', 'Qianyue/index');
INSERT INTO `sl_sys_module` VALUES ('143', '圣乐文化', '', '100', '0', '52', 'Company/culture');
INSERT INTO `sl_sys_module` VALUES ('144', '联系圣乐', '', '100', '0', '52', 'Company/relation');
INSERT INTO `sl_sys_module` VALUES ('145', '友情链接', '', '100', '0', '52', 'Company/link');
INSERT INTO `sl_sys_module` VALUES ('146', '医养结合', '', '100', '0', '52', 'Company/yyjh');
INSERT INTO `sl_sys_module` VALUES ('147', '慢病管理', '', '100', '0', '52', 'Company/mxbgl');
INSERT INTO `sl_sys_module` VALUES ('148', '圣乐内训', '', '100', '0', '52', 'Company/nx');
INSERT INTO `sl_sys_module` VALUES ('149', '圣乐会议', '', '100', '0', '52', 'Company/conference');
INSERT INTO `sl_sys_module` VALUES ('165', '会议管理', '', '100', '0', '84', 'MeetEnroll/meet_list');
INSERT INTO `sl_sys_module` VALUES ('164', '会议报名', '', '100', '1', '84', 'MeetEnroll/index');
INSERT INTO `sl_sys_module` VALUES ('162', '综合评估', '', '100', '0', '166', 'Zhpg/index');
INSERT INTO `sl_sys_module` VALUES ('157', '服务分类', '', '100', '0', '1', 'fwfl/index');
INSERT INTO `sl_sys_module` VALUES ('158', '服务项目', '', '100', '0', '1', 'fwxm/index');
INSERT INTO `sl_sys_module` VALUES ('159', '病种统计', '', '100', '0', '98', 'bzfl/index');
INSERT INTO `sl_sys_module` VALUES ('160', '生活评估', '', '100', '0', '56', 'Life/index');
INSERT INTO `sl_sys_module` VALUES ('161', '心理评估', '', '100', '0', '56', 'Mentality/index');
INSERT INTO `sl_sys_module` VALUES ('166', '签约管理', '', '460', '0', '0', '');
INSERT INTO `sl_sys_module` VALUES ('167', '签约设置', '', '100', '0', '1', 'Qianyue/setqianyue');
INSERT INTO `sl_sys_module` VALUES ('168', '签约服务包', '', '100', '0', '1', 'Qianyue/fwb');
INSERT INTO `sl_sys_module` VALUES ('169', '签约服务项目', '', '100', '0', '1', 'Qianyue/qyfwxm');
INSERT INTO `sl_sys_module` VALUES ('170', '健康咨询测试', '', '100', '0', '84', 'Ytx/index');
INSERT INTO `sl_sys_module` VALUES ('171', '启动培训管理', '', '100', '0', '84', 'Qdpx/index');
INSERT INTO `sl_sys_module` VALUES ('172', '论坛观摩管理', '', '100', '0', '84', 'Ltgm/index');
INSERT INTO `sl_sys_module` VALUES ('173', '易启秀', '', '100', '0', '1', 'Flash/index');

-- ----------------------------
-- Table structure for sl_sys_module_fun
-- ----------------------------
DROP TABLE IF EXISTS `sl_sys_module_fun`;
CREATE TABLE `sl_sys_module_fun` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(10) unsigned NOT NULL DEFAULT '0',
  `fid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `mindex` (`id`,`mid`,`fid`)
) ENGINE=MyISAM AUTO_INCREMENT=677 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sl_sys_module_fun
-- ----------------------------
INSERT INTO `sl_sys_module_fun` VALUES ('75', '6', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('76', '6', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('77', '6', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('78', '6', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('83', '29', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('84', '29', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('85', '29', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('86', '29', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('87', '29', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('111', '3', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('112', '3', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('113', '3', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('114', '3', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('115', '3', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('143', '40', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('144', '40', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('145', '40', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('146', '40', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('147', '40', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('148', '76', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('149', '76', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('150', '76', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('151', '76', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('152', '76', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('153', '71', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('154', '71', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('155', '71', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('156', '71', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('157', '71', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('174', '52', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('175', '52', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('176', '52', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('177', '52', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('178', '52', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('179', '52', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('180', '52', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('181', '53', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('182', '53', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('183', '53', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('184', '53', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('185', '53', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('186', '53', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('187', '53', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('188', '51', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('189', '51', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('190', '51', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('191', '51', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('192', '51', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('193', '51', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('194', '51', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('195', '50', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('196', '50', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('197', '50', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('198', '50', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('199', '50', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('200', '50', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('201', '50', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('202', '44', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('203', '44', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('204', '44', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('205', '44', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('206', '44', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('207', '44', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('208', '44', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('209', '57', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('210', '57', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('211', '57', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('212', '57', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('213', '57', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('214', '57', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('215', '57', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('229', '69', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('230', '69', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('231', '69', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('232', '69', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('233', '69', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('234', '69', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('235', '69', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('236', '82', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('237', '82', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('238', '82', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('239', '82', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('240', '82', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('241', '82', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('242', '82', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('243', '70', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('244', '70', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('245', '70', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('246', '70', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('247', '70', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('248', '70', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('249', '70', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('250', '81', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('251', '81', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('252', '81', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('253', '81', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('254', '81', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('255', '81', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('256', '81', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('257', '80', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('258', '80', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('259', '80', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('260', '80', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('261', '80', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('262', '80', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('263', '80', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('264', '83', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('265', '83', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('266', '83', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('267', '83', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('268', '83', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('269', '83', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('270', '83', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('278', '59', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('279', '59', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('280', '59', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('281', '59', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('282', '59', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('283', '59', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('284', '59', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('285', '74', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('286', '74', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('287', '74', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('288', '74', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('293', '58', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('294', '58', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('295', '58', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('296', '58', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('297', '58', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('298', '58', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('299', '58', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('300', '55', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('301', '55', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('302', '55', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('303', '55', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('304', '55', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('305', '55', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('306', '55', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('314', '73', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('315', '73', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('316', '73', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('317', '73', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('318', '73', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('319', '73', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('320', '73', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('321', '68', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('322', '68', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('323', '68', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('324', '68', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('325', '68', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('326', '68', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('327', '68', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('328', '67', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('329', '67', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('330', '67', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('331', '67', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('332', '67', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('333', '67', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('334', '67', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('335', '66', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('336', '66', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('337', '66', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('338', '66', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('339', '66', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('340', '66', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('341', '66', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('342', '64', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('343', '64', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('344', '64', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('345', '64', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('346', '64', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('347', '64', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('348', '64', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('349', '62', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('350', '62', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('351', '62', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('352', '62', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('353', '62', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('354', '62', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('355', '62', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('356', '60', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('357', '60', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('358', '60', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('359', '60', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('360', '60', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('361', '60', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('362', '60', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('370', '63', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('371', '63', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('372', '63', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('373', '63', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('374', '63', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('375', '63', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('376', '63', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('377', '61', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('378', '61', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('379', '61', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('380', '61', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('381', '61', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('382', '61', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('383', '61', '7');
INSERT INTO `sl_sys_module_fun` VALUES ('384', '5', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('385', '5', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('386', '5', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('387', '5', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('388', '5', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('389', '4', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('390', '4', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('391', '4', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('392', '4', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('397', '1', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('398', '1', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('399', '1', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('400', '1', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('401', '2', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('402', '2', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('403', '2', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('404', '2', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('405', '27', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('406', '27', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('407', '27', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('408', '27', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('409', '28', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('410', '28', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('411', '28', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('412', '28', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('413', '77', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('414', '77', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('415', '77', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('416', '77', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('417', '45', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('418', '45', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('419', '45', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('420', '45', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('429', '87', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('430', '87', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('431', '87', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('432', '87', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('433', '86', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('434', '86', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('435', '86', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('436', '86', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('437', '42', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('438', '42', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('439', '42', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('440', '42', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('441', '42', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('442', '42', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('443', '43', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('444', '43', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('445', '43', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('446', '43', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('447', '43', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('448', '43', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('449', '41', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('450', '41', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('451', '41', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('452', '41', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('453', '41', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('454', '41', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('463', '85', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('464', '85', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('465', '48', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('466', '48', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('467', '48', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('468', '48', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('469', '48', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('470', '48', '9');
INSERT INTO `sl_sys_module_fun` VALUES ('471', '48', '10');
INSERT INTO `sl_sys_module_fun` VALUES ('472', '48', '11');
INSERT INTO `sl_sys_module_fun` VALUES ('473', '78', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('474', '78', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('475', '78', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('476', '78', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('477', '78', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('478', '79', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('479', '79', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('480', '79', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('481', '79', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('482', '79', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('489', '46', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('490', '46', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('491', '46', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('492', '46', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('497', '92', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('498', '92', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('499', '92', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('500', '92', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('523', '56', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('524', '56', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('525', '56', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('526', '56', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('527', '56', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('528', '56', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('529', '47', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('530', '47', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('531', '47', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('532', '47', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('533', '47', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('554', '72', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('555', '72', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('556', '72', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('557', '72', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('558', '72', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('559', '72', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('560', '125', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('561', '125', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('562', '125', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('563', '126', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('564', '126', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('565', '126', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('566', '128', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('567', '128', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('568', '128', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('569', '129', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('570', '129', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('571', '129', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('572', '127', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('573', '127', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('574', '127', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('575', '65', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('576', '65', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('577', '65', '14');
INSERT INTO `sl_sys_module_fun` VALUES ('578', '65', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('579', '65', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('580', '65', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('581', '65', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('582', '130', '14');
INSERT INTO `sl_sys_module_fun` VALUES ('583', '131', '14');
INSERT INTO `sl_sys_module_fun` VALUES ('584', '132', '14');
INSERT INTO `sl_sys_module_fun` VALUES ('585', '133', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('586', '133', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('587', '133', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('588', '133', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('589', '140', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('590', '140', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('591', '140', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('592', '140', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('598', '75', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('599', '75', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('600', '75', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('601', '75', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('602', '75', '4');
INSERT INTO `sl_sys_module_fun` VALUES ('605', '147', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('606', '144', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('607', '143', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('609', '145', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('610', '146', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('611', '148', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('612', '148', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('613', '148', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('620', '149', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('621', '149', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('622', '149', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('623', '151', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('624', '151', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('625', '151', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('626', '152', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('627', '152', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('628', '152', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('629', '153', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('630', '153', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('631', '153', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('632', '155', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('633', '155', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('634', '155', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('635', '156', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('636', '156', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('637', '156', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('638', '157', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('639', '157', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('640', '157', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('641', '158', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('642', '158', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('643', '158', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('644', '160', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('645', '161', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('648', '162', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('649', '162', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('650', '162', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('651', '104', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('652', '104', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('653', '105', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('654', '105', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('655', '106', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('656', '106', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('657', '108', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('658', '108', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('659', '109', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('660', '109', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('661', '111', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('662', '111', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('663', '142', '8');
INSERT INTO `sl_sys_module_fun` VALUES ('664', '142', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('665', '142', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('666', '142', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('670', '168', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('671', '168', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('672', '168', '3');
INSERT INTO `sl_sys_module_fun` VALUES ('673', '168', '5');
INSERT INTO `sl_sys_module_fun` VALUES ('674', '169', '1');
INSERT INTO `sl_sys_module_fun` VALUES ('675', '169', '2');
INSERT INTO `sl_sys_module_fun` VALUES ('676', '169', '3');

-- ----------------------------
-- Table structure for sl_sys_role
-- ----------------------------
DROP TABLE IF EXISTS `sl_sys_role`;
CREATE TABLE `sl_sys_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '名称',
  `description` varchar(50) NOT NULL DEFAULT '',
  `msort` int(10) unsigned NOT NULL DEFAULT '100',
  `mstatus` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `hid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sl_sys_role
-- ----------------------------
INSERT INTO `sl_sys_role` VALUES ('55', '医院管理员', '', '100', '0', '0');
INSERT INTO `sl_sys_role` VALUES ('56', '平台运营', '', '100', '0', '0');

-- ----------------------------
-- Table structure for sl_sys_user
-- ----------------------------
DROP TABLE IF EXISTS `sl_sys_user`;
CREATE TABLE `sl_sys_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '登录账号',
  `password` varchar(50) NOT NULL DEFAULT '' COMMENT '密码',
  `truename` varchar(50) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `mstatus` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `hid` int(11) NOT NULL DEFAULT '0' COMMENT '医院ID',
  `ptitle` varchar(100) NOT NULL DEFAULT '' COMMENT '医院名称或卫生室名称',
  `cid` int(11) NOT NULL DEFAULT '0' COMMENT '卫生室id',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '0 平台用户 1 医院管理员  2 卫生室管理员 3 医院其他用户 ',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`,`username`),
  UNIQUE KEY `indexusername` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sl_sys_user
-- ----------------------------
INSERT INTO `sl_sys_user` VALUES ('1', 'admin', '10470c3b4b1fed12c3baac014be15fac67c6e815', '超级用户', '0', '0', '', '0', '0', '2017-09-30 16:14:43', '2017-09-30 16:26:09');

-- ----------------------------
-- Table structure for sl_sys_user_ext
-- ----------------------------
DROP TABLE IF EXISTS `sl_sys_user_ext`;
CREATE TABLE `sl_sys_user_ext` (
  `uid` int(10) unsigned NOT NULL,
  `description` varchar(50) NOT NULL COMMENT '说明',
  `loginarea` varchar(20) NOT NULL DEFAULT '' COMMENT '最后登录地',
  `logincount` int(5) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `loginip` varchar(30) NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `logintime` datetime NOT NULL DEFAULT '2001-01-01 00:00:00' COMMENT '最后登录时间',
  `tel` varchar(50) NOT NULL DEFAULT '' COMMENT '联系电话',
  `mobile` varchar(50) NOT NULL DEFAULT '' COMMENT '手机号',
  `qq` varchar(50) NOT NULL DEFAULT '' COMMENT 'QQ号码',
  `weixin` varchar(50) NOT NULL DEFAULT '' COMMENT '微信号',
  `sex` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '性别',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sl_sys_user_ext
-- ----------------------------
