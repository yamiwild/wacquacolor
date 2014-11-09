/*
Navicat MySQL Data Transfer

Source Server         : # LOCALHOST
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : cli_acquacolor

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2014-11-09 21:08:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `bu_budget`
-- ----------------------------
DROP TABLE IF EXISTS `bu_budget`;
CREATE TABLE `bu_budget` (
  `BU_COD` int(11) NOT NULL AUTO_INCREMENT,
  `CLI_COD` int(11) DEFAULT NULL,
  `BU_DATETIME` datetime DEFAULT NULL,
  PRIMARY KEY (`BU_COD`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of bu_budget
-- ----------------------------
INSERT INTO `bu_budget` VALUES ('13', '4', '2014-11-09 20:40:12');

-- ----------------------------
-- Table structure for `bu_products`
-- ----------------------------
DROP TABLE IF EXISTS `bu_products`;
CREATE TABLE `bu_products` (
  `BU_COD` int(11) DEFAULT NULL,
  `PR_COD` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of bu_products
-- ----------------------------
INSERT INTO `bu_products` VALUES ('13', '15');
INSERT INTO `bu_products` VALUES ('13', '16');

-- ----------------------------
-- Table structure for `cl_client`
-- ----------------------------
DROP TABLE IF EXISTS `cl_client`;
CREATE TABLE `cl_client` (
  `CLI_COD` int(11) NOT NULL AUTO_INCREMENT,
  `CLI_NAME` varchar(255) DEFAULT NULL,
  `CLI_CNPJ` varchar(255) DEFAULT NULL,
  `CLI_DATETIME` datetime DEFAULT NULL,
  `CLI_EMAIL` varchar(120) DEFAULT NULL,
  `CLI_TELEFONE` varchar(255) DEFAULT NULL,
  `CLI_CONTACT_NAME` varchar(255) DEFAULT NULL,
  `CLI_DESCRIPTION` text,
  PRIMARY KEY (`CLI_COD`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cl_client
-- ----------------------------
INSERT INTO `cl_client` VALUES ('4', 'Cliente 1', '17.217.713/0001-04', '2014-11-09 22:54:46', 'diogo@weverest.com.br', '1139740189', 'Diogo Brito', 'Descrição');

-- ----------------------------
-- Table structure for `fw_module`
-- ----------------------------
DROP TABLE IF EXISTS `fw_module`;
CREATE TABLE `fw_module` (
  `MOD_COD` int(11) NOT NULL AUTO_INCREMENT,
  `MOD_NAME` varchar(80) DEFAULT NULL,
  `MOD_DATE` date DEFAULT NULL,
  `MOD_ICON` varchar(100) DEFAULT NULL,
  `MOD_VISIBLE` int(11) DEFAULT NULL,
  `MOD_URL` varchar(100) DEFAULT NULL,
  `MOD_NAME_URL` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`MOD_COD`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fw_module
-- ----------------------------
INSERT INTO `fw_module` VALUES ('1', 'Login', '2014-07-04', null, '0', 'login', 'login');
INSERT INTO `fw_module` VALUES ('2', 'Painel', '2014-07-04', 'icon-home', '1', 'dashboard', 'dashboard');
INSERT INTO `fw_module` VALUES ('3', 'Clientes', '2014-07-08', 'icon-users', '1', 'clients', 'clients');
INSERT INTO `fw_module` VALUES ('4', 'Galeria de Imagens', '2014-11-01', 'icon-picture', '1', 'galery', 'galery');
INSERT INTO `fw_module` VALUES ('5', 'Produtos', '2014-11-01', 'icon-grid', '1', 'products', 'products');
INSERT INTO `fw_module` VALUES ('6', 'Orçamentos', '2014-11-01', 'icon-calculator', '1', 'budgets', 'budgets');
INSERT INTO `fw_module` VALUES ('7', 'Páginas', '2014-11-01', 'icon-docs', '1', 'pages', 'pages');

-- ----------------------------
-- Table structure for `fw_module_privilege`
-- ----------------------------
DROP TABLE IF EXISTS `fw_module_privilege`;
CREATE TABLE `fw_module_privilege` (
  `PRI_COD` int(11) NOT NULL AUTO_INCREMENT,
  `MOS_COD` int(11) DEFAULT NULL,
  `MOD_COD` int(11) NOT NULL,
  `PRI_NAME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PRI_COD`),
  KEY `FK_FW_REL_MODULE_PRIVILEGE` (`MOD_COD`),
  KEY `FK_FW_REL_MODULE_SECTION_PRIVI` (`MOS_COD`),
  CONSTRAINT `fw_module_privilege_ibfk_1` FOREIGN KEY (`MOD_COD`) REFERENCES `fw_module` (`MOD_COD`),
  CONSTRAINT `fw_module_privilege_ibfk_2` FOREIGN KEY (`MOS_COD`) REFERENCES `fw_module_section` (`MOS_COD`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fw_module_privilege
-- ----------------------------
INSERT INTO `fw_module_privilege` VALUES ('1', null, '1', 'Acesso ao módulo Login');
INSERT INTO `fw_module_privilege` VALUES ('2', null, '2', 'Acesso ao módulo Dashboard');
INSERT INTO `fw_module_privilege` VALUES ('3', null, '3', 'Acesso ao módulo Cliente');
INSERT INTO `fw_module_privilege` VALUES ('4', '3', '3', 'Listagem de Clientes');
INSERT INTO `fw_module_privilege` VALUES ('5', '4', '3', 'Adicionar Cliente');
INSERT INTO `fw_module_privilege` VALUES ('6', '5', '4', 'Visualizar Galerias');
INSERT INTO `fw_module_privilege` VALUES ('7', '5', '4', 'Editar Galeria');
INSERT INTO `fw_module_privilege` VALUES ('8', '5', '4', 'Remover Galeria');
INSERT INTO `fw_module_privilege` VALUES ('9', '6', '4', 'Adicionar Galeria');
INSERT INTO `fw_module_privilege` VALUES ('10', '7', '5', 'Gerenciar Produtos');
INSERT INTO `fw_module_privilege` VALUES ('11', '7', '5', 'Editar Produtos');
INSERT INTO `fw_module_privilege` VALUES ('12', '7', '5', 'Remover Produtos');
INSERT INTO `fw_module_privilege` VALUES ('13', '8', '5', 'Adicionar Produtos');
INSERT INTO `fw_module_privilege` VALUES ('14', null, '6', 'Gerenciar Orçamentos');
INSERT INTO `fw_module_privilege` VALUES ('15', null, '6', 'Visualizar Orçamento');
INSERT INTO `fw_module_privilege` VALUES ('16', '10', '7', 'Gerenciar Distribuidores');
INSERT INTO `fw_module_privilege` VALUES ('17', '11', '5', 'Gerenciar Categorias');
INSERT INTO `fw_module_privilege` VALUES ('18', '11', '5', 'Editar Categoria');
INSERT INTO `fw_module_privilege` VALUES ('19', '11', '5', 'Excluir Categoria');
INSERT INTO `fw_module_privilege` VALUES ('20', '12', '5', 'Adicionar Categoria');

-- ----------------------------
-- Table structure for `fw_module_section`
-- ----------------------------
DROP TABLE IF EXISTS `fw_module_section`;
CREATE TABLE `fw_module_section` (
  `MOS_COD` int(11) NOT NULL AUTO_INCREMENT,
  `MOD_COD` int(11) NOT NULL,
  `MOS_NAME` varchar(100) DEFAULT NULL,
  `MOS_ICON` varchar(100) DEFAULT NULL,
  `MOS_URL` varchar(100) DEFAULT NULL,
  `MOS_VISIBLE` int(11) DEFAULT NULL,
  `MOS_COD_MASTER` int(11) DEFAULT NULL,
  `MOS_ORDER` int(11) DEFAULT NULL,
  PRIMARY KEY (`MOS_COD`),
  KEY `FK_FW_REL_MODULE_SECTION` (`MOD_COD`),
  CONSTRAINT `fw_module_section_ibfk_1` FOREIGN KEY (`MOD_COD`) REFERENCES `fw_module` (`MOD_COD`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fw_module_section
-- ----------------------------
INSERT INTO `fw_module_section` VALUES ('3', '3', 'Gerenciar Clientes', 'icon-user', 'clients', '1', null, null);
INSERT INTO `fw_module_section` VALUES ('4', '3', 'Adicionar Cliente', 'icon-user-follow', 'clients/register', '1', null, null);
INSERT INTO `fw_module_section` VALUES ('5', '4', 'Gerenciar Galerias', 'icon-list', 'galery', '1', null, null);
INSERT INTO `fw_module_section` VALUES ('6', '4', 'Adicionar Galeria', 'icon-plus', 'galery/register', '1', null, null);
INSERT INTO `fw_module_section` VALUES ('7', '5', 'Gerenciar Produtos', 'icon-list', 'products', '1', null, null);
INSERT INTO `fw_module_section` VALUES ('8', '5', 'Adicionar Produto', 'icon-plus', 'products/register', '1', null, null);
INSERT INTO `fw_module_section` VALUES ('9', '6', 'Gerenciar Orçamentos', 'icon-list', 'budgets', '0', null, null);
INSERT INTO `fw_module_section` VALUES ('10', '7', 'Distribuídores', 'icon-doc', 'pages/distribuidores', '1', null, null);
INSERT INTO `fw_module_section` VALUES ('11', '5', 'Gerenciar Categorias', 'icon-loop', 'products/categories', '1', null, null);
INSERT INTO `fw_module_section` VALUES ('12', '5', 'Adicionar Categoria', 'icon-plus', 'products/category/add', '1', null, null);

-- ----------------------------
-- Table structure for `fw_profile`
-- ----------------------------
DROP TABLE IF EXISTS `fw_profile`;
CREATE TABLE `fw_profile` (
  `PRO_COD` int(11) NOT NULL AUTO_INCREMENT,
  `PRO_NAME` varchar(100) DEFAULT NULL,
  `PRO_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`PRO_COD`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fw_profile
-- ----------------------------
INSERT INTO `fw_profile` VALUES ('1', 'Administrador', '2014-07-04 18:20:27');
INSERT INTO `fw_profile` VALUES ('2', 'Cliente', '2014-08-15 18:10:47');
INSERT INTO `fw_profile` VALUES ('3', 'Usuário', '2014-08-21 17:38:00');

-- ----------------------------
-- Table structure for `fw_rel_profile_module_privilege`
-- ----------------------------
DROP TABLE IF EXISTS `fw_rel_profile_module_privilege`;
CREATE TABLE `fw_rel_profile_module_privilege` (
  `PRO_COD` int(11) NOT NULL,
  `PRI_COD` int(11) NOT NULL,
  PRIMARY KEY (`PRO_COD`,`PRI_COD`),
  KEY `FK_FW_REL_PROFILE_MODULE_PRIVILEGE2` (`PRI_COD`),
  CONSTRAINT `fw_rel_profile_module_privilege_ibfk_1` FOREIGN KEY (`PRO_COD`) REFERENCES `fw_profile` (`PRO_COD`),
  CONSTRAINT `fw_rel_profile_module_privilege_ibfk_2` FOREIGN KEY (`PRI_COD`) REFERENCES `fw_module_privilege` (`PRI_COD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fw_rel_profile_module_privilege
-- ----------------------------
INSERT INTO `fw_rel_profile_module_privilege` VALUES ('1', '1');
INSERT INTO `fw_rel_profile_module_privilege` VALUES ('1', '2');
INSERT INTO `fw_rel_profile_module_privilege` VALUES ('1', '3');
INSERT INTO `fw_rel_profile_module_privilege` VALUES ('1', '4');
INSERT INTO `fw_rel_profile_module_privilege` VALUES ('1', '5');
INSERT INTO `fw_rel_profile_module_privilege` VALUES ('1', '6');
INSERT INTO `fw_rel_profile_module_privilege` VALUES ('1', '7');
INSERT INTO `fw_rel_profile_module_privilege` VALUES ('1', '8');
INSERT INTO `fw_rel_profile_module_privilege` VALUES ('1', '9');
INSERT INTO `fw_rel_profile_module_privilege` VALUES ('1', '10');
INSERT INTO `fw_rel_profile_module_privilege` VALUES ('1', '11');
INSERT INTO `fw_rel_profile_module_privilege` VALUES ('1', '12');
INSERT INTO `fw_rel_profile_module_privilege` VALUES ('1', '13');
INSERT INTO `fw_rel_profile_module_privilege` VALUES ('1', '14');
INSERT INTO `fw_rel_profile_module_privilege` VALUES ('1', '15');
INSERT INTO `fw_rel_profile_module_privilege` VALUES ('1', '16');
INSERT INTO `fw_rel_profile_module_privilege` VALUES ('1', '17');
INSERT INTO `fw_rel_profile_module_privilege` VALUES ('1', '18');
INSERT INTO `fw_rel_profile_module_privilege` VALUES ('1', '19');
INSERT INTO `fw_rel_profile_module_privilege` VALUES ('1', '20');

-- ----------------------------
-- Table structure for `fw_user`
-- ----------------------------
DROP TABLE IF EXISTS `fw_user`;
CREATE TABLE `fw_user` (
  `USE_COD` int(11) NOT NULL AUTO_INCREMENT,
  `PRO_COD` int(11) NOT NULL,
  `USE_NAME` varchar(70) DEFAULT NULL,
  `USE_LOGIN` varchar(50) DEFAULT NULL,
  `USE_PASSWORD` varchar(32) DEFAULT NULL,
  `USE_DATE` datetime DEFAULT NULL,
  `USE_EMAIL` varchar(100) DEFAULT NULL,
  `USE_STATUS` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`USE_COD`),
  KEY `FK_FW_REL_PROFILE_USER` (`PRO_COD`),
  CONSTRAINT `fw_user_ibfk_2` FOREIGN KEY (`PRO_COD`) REFERENCES `fw_profile` (`PRO_COD`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fw_user
-- ----------------------------
INSERT INTO `fw_user` VALUES ('1', '1', 'Administrador', 'admin', '9a286406c252a3d14218228974e1f567', '2014-07-10 14:50:44', 'brito@grupodpg.com.br', '0');

-- ----------------------------
-- Table structure for `pr_category`
-- ----------------------------
DROP TABLE IF EXISTS `pr_category`;
CREATE TABLE `pr_category` (
  `PCA_COD` int(11) NOT NULL AUTO_INCREMENT,
  `PCA_NAME` varchar(250) DEFAULT NULL,
  `PCA_URL` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`PCA_COD`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pr_category
-- ----------------------------
INSERT INTO `pr_category` VALUES ('3', 'Corações', 'coracoes');
INSERT INTO `pr_category` VALUES ('4', 'Alimentos', 'alimentos');
INSERT INTO `pr_category` VALUES ('5', 'Anjos', 'anjos');
INSERT INTO `pr_category` VALUES ('6', 'Animais', 'animais');
INSERT INTO `pr_category` VALUES ('7', 'Datas Comemorativas', 'datas-comemorativas');
INSERT INTO `pr_category` VALUES ('8', 'Egípcios', 'egipcios');
INSERT INTO `pr_category` VALUES ('9', 'Esotéricos', 'esotericos');
INSERT INTO `pr_category` VALUES ('10', 'Feminino', 'feminino');
INSERT INTO `pr_category` VALUES ('11', 'Flores e Folhas', 'flores-e-folhas');
INSERT INTO `pr_category` VALUES ('12', 'Infantil', 'infantil');
INSERT INTO `pr_category` VALUES ('13', 'Masculino', 'masculino');
INSERT INTO `pr_category` VALUES ('14', 'Músicais', 'musicais');

-- ----------------------------
-- Table structure for `pr_gallery`
-- ----------------------------
DROP TABLE IF EXISTS `pr_gallery`;
CREATE TABLE `pr_gallery` (
  `PG_COD` int(11) NOT NULL AUTO_INCREMENT,
  `PR_COD` int(11) DEFAULT NULL,
  `PG_IMAGE` varchar(250) DEFAULT NULL,
  `PG_IMAGE_THUMB` varchar(250) DEFAULT NULL,
  `PG_SIZE` int(11) DEFAULT NULL,
  `PG_EXT` char(6) DEFAULT NULL,
  `PG_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`PG_COD`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pr_gallery
-- ----------------------------
INSERT INTO `pr_gallery` VALUES ('26', '15', 'arte_de_cozinhar_23-101_original.png', 'arte_de_cozinhar_23-101_thumb.png', '2524156', 'png', '2014-11-02 18:42:16');
INSERT INTO `pr_gallery` VALUES ('28', '15', 'Imagem1_original.jpg', 'Imagem1_thumb.jpg', '55311', 'jpg', '2014-11-02 21:37:14');
INSERT INTO `pr_gallery` VALUES ('29', '16', 'Imagem1_original.jpg', 'Imagem1_thumb.jpg', '55311', 'jpg', '2014-11-02 23:31:47');
INSERT INTO `pr_gallery` VALUES ('30', '17', 'Imagem1_original.jpg', 'Imagem1_thumb.jpg', '55311', 'jpg', '2014-11-02 23:33:35');

-- ----------------------------
-- Table structure for `pr_product`
-- ----------------------------
DROP TABLE IF EXISTS `pr_product`;
CREATE TABLE `pr_product` (
  `PR_COD` int(11) NOT NULL AUTO_INCREMENT,
  `PCA_COD` int(11) DEFAULT NULL,
  `PR_NAME` varchar(250) DEFAULT NULL,
  `PR_COD_REF` varchar(50) DEFAULT NULL,
  `PR_DIMENSION` varchar(100) DEFAULT NULL,
  `PR_DESCRIPTION` text,
  `PR_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`PR_COD`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pr_product
-- ----------------------------
INSERT INTO `pr_product` VALUES ('15', '3', 'Teste Imagens', '12345', '1235 X 1235', '&lt;p&gt;Teste&lt;/p&gt;\r\n', '2014-11-02 21:37:10');
INSERT INTO `pr_product` VALUES ('16', '3', 'Produto 2', '1234', '123 X 123', '&lt;p&gt;Descri&amp;ccedil;&amp;atilde;o&lt;/p&gt;\r\n', '2014-11-02 23:31:44');
INSERT INTO `pr_product` VALUES ('17', '3', 'Produto 2', '12345', '1235 X 1235', '&lt;p&gt;Descri&amp;ccedil;&amp;atilde;o&lt;/p&gt;\r\n', '2014-11-02 23:33:31');
