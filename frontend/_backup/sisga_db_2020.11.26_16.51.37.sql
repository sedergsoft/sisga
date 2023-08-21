-- -------------------------------------------
SET AUTOCOMMIT=0;
START TRANSACTION;
SET SQL_QUOTE_SHOW_CREATE = 1;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
-- -------------------------------------------
-- -------------------------------------------
-- START BACKUP
-- -------------------------------------------
-- -------------------------------------------
-- TABLE `anexo`
-- -------------------------------------------
DROP TABLE IF EXISTS `anexo`;
CREATE TABLE IF NOT EXISTS `anexo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `anexo` varchar(255) DEFAULT NULL,
  `tabla` varchar(255) DEFAULT NULL,
  `modelo` varchar(255) NOT NULL,
  `searchmodel` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `armas`
-- -------------------------------------------
DROP TABLE IF EXISTS `armas`;
CREATE TABLE IF NOT EXISTS `armas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo_armaid` int(10) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `no_licencia` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `cuadroid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKarmas841849` (`tipo_armaid`),
  KEY `FKarmas386612` (`cuadroid`),
  CONSTRAINT `FKarmas386612` FOREIGN KEY (`cuadroid`) REFERENCES `cuadro` (`id`),
  CONSTRAINT `FKarmas841849` FOREIGN KEY (`tipo_armaid`) REFERENCES `tipo_arma` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `auth_assignment`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `auth_item`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `auth_item_child`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `auth_rule`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `calificacion`
-- -------------------------------------------
DROP TABLE IF EXISTS `calificacion`;
CREATE TABLE IF NOT EXISTS `calificacion` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `calificacion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `capital`
-- -------------------------------------------
DROP TABLE IF EXISTS `capital`;
CREATE TABLE IF NOT EXISTS `capital` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `anexoid` int(10) NOT NULL,
  `activo_circulante` double DEFAULT NULL,
  `pasivo_circulante` double DEFAULT NULL,
  `Suma` varchar(25) NOT NULL,
  `creditos_bancarios` double DEFAULT NULL,
  `empresaid` int(10) NOT NULL,
  `fecha` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FKcapital537904` (`empresaid`),
  KEY `FKcapital537905` (`empresaid`),
  KEY `id` (`id`),
  KEY `anexoid` (`anexoid`),
  CONSTRAINT `FKanexo` FOREIGN KEY (`anexoid`) REFERENCES `evaluacion_anexo` (`id`),
  CONSTRAINT `FKcapital537904` FOREIGN KEY (`empresaid`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `cargo`
-- -------------------------------------------
DROP TABLE IF EXISTS `cargo`;
CREATE TABLE IF NOT EXISTS `cargo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cargo` varchar(255) NOT NULL,
  `salario` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `cargos_direccion`
-- -------------------------------------------
DROP TABLE IF EXISTS `cargos_direccion`;
CREATE TABLE IF NOT EXISTS `cargos_direccion` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tipo` (`tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `categoria_docente`
-- -------------------------------------------
DROP TABLE IF EXISTS `categoria_docente`;
CREATE TABLE IF NOT EXISTS `categoria_docente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `centro_estudios`
-- -------------------------------------------
DROP TABLE IF EXISTS `centro_estudios`;
CREATE TABLE IF NOT EXISTS `centro_estudios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `centro` varchar(255) NOT NULL,
  `municipioid` int(10) NOT NULL,
  `provinciaid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKcentro_est497024` (`municipioid`),
  KEY `FKcentro_est75138` (`provinciaid`),
  CONSTRAINT `FKcentro_est497024` FOREIGN KEY (`municipioid`) REFERENCES `municipio` (`id`),
  CONSTRAINT `FKcentro_est75138` FOREIGN KEY (`provinciaid`) REFERENCES `provincia` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `centro_trabajo`
-- -------------------------------------------
DROP TABLE IF EXISTS `centro_trabajo`;
CREATE TABLE IF NOT EXISTS `centro_trabajo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `centro` varchar(125) NOT NULL,
  `direccionesid` int(10) NOT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `idorganismo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKcentro_tra804301` (`direccionesid`),
  KEY `id` (`id`),
  KEY `idorganismo` (`idorganismo`),
  CONSTRAINT `centro_trabajo_ibfk_1` FOREIGN KEY (`idorganismo`) REFERENCES `organismo` (`idorganismo`),
  CONSTRAINT `centro_trabajo_ibfk_2` FOREIGN KEY (`direccionesid`) REFERENCES `direcciones` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `ciclos`
-- -------------------------------------------
DROP TABLE IF EXISTS `ciclos`;
CREATE TABLE IF NOT EXISTS `ciclos` (
  `CE` int(6) DEFAULT NULL COMMENT '\r\n\r\n\r\n\r\n ',
  `CEL` int(6) DEFAULT NULL,
  `CELD` int(10) DEFAULT NULL,
  `CPCE` int(10) DEFAULT NULL,
  `CPCED` int(10) DEFAULT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `empresaid` int(10) NOT NULL,
  `fecha` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `anexoid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKciclos374845` (`empresaid`),
  KEY `FKciclos374846` (`empresaid`),
  CONSTRAINT `FKciclos374845` FOREIGN KEY (`empresaid`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `comedor`
-- -------------------------------------------
DROP TABLE IF EXISTS `comedor`;
CREATE TABLE IF NOT EXISTS `comedor` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `gastos` float DEFAULT NULL,
  `ingresos` float DEFAULT NULL,
  `empresaid` int(10) NOT NULL,
  `fecha` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `anexoid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKcomedor441753` (`empresaid`),
  KEY `FKcomedor441754` (`empresaid`),
  CONSTRAINT `FKcomedor441753` FOREIGN KEY (`empresaid`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `condecoraciones`
-- -------------------------------------------
DROP TABLE IF EXISTS `condecoraciones`;
CREATE TABLE IF NOT EXISTS `condecoraciones` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `cuadroid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKcondecorac303372` (`cuadroid`),
  CONSTRAINT `FKcondecorac303372` FOREIGN KEY (`cuadroid`) REFERENCES `cuadro` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `confecionado`
-- -------------------------------------------
DROP TABLE IF EXISTS `confecionado`;
CREATE TABLE IF NOT EXISTS `confecionado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) NOT NULL,
  `idcargo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idcargo` (`idcargo`),
  CONSTRAINT `FKCargoDireccion` FOREIGN KEY (`idcargo`) REFERENCES `cargos_direccion` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `control_usuario`
-- -------------------------------------------
DROP TABLE IF EXISTS `control_usuario`;
CREATE TABLE IF NOT EXISTS `control_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `preg_1` text NOT NULL,
  `preg_2` text NOT NULL,
  `preg_3` text NOT NULL,
  `preg_4` text NOT NULL,
  `preg_5` text NOT NULL,
  `resp_1` text NOT NULL,
  `resp_2` text NOT NULL,
  `resp_3` text NOT NULL,
  `resp_4` text NOT NULL,
  `resp_5` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `criteriomedida`
-- -------------------------------------------
DROP TABLE IF EXISTS `criteriomedida`;
CREATE TABLE IF NOT EXISTS `criteriomedida` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `orden` int(10) NOT NULL,
  `Descripcion` varchar(1000) NOT NULL,
  `UM` varchar(255) NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '1',
  `Objetivoid` int(10) NOT NULL,
  `direccionid` int(10) NOT NULL,
  `topeid` int(10) DEFAULT NULL,
  `editable` tinyint(4) NOT NULL DEFAULT '1',
  `evaluado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FKcriteriome441165` (`Objetivoid`),
  KEY `FKcriteriome15122` (`direccionid`),
  KEY `FKcriteriome799435` (`topeid`),
  CONSTRAINT `FKcriteriome15122` FOREIGN KEY (`direccionid`) REFERENCES `direccion` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FKcriteriome441165` FOREIGN KEY (`Objetivoid`) REFERENCES `objetivo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FKcriteriome799435` FOREIGN KEY (`topeid`) REFERENCES `tope` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `cuadro`
-- -------------------------------------------
DROP TABLE IF EXISTS `cuadro`;
CREATE TABLE IF NOT EXISTS `cuadro` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `personaCI` varchar(11) NOT NULL,
  `Lugar_nacimiento` int(10) NOT NULL,
  `provinciaid` int(1) DEFAULT NULL,
  `ciudadania` varchar(255) NOT NULL,
  `color_piel` varchar(255) NOT NULL,
  `color_ojos` varchar(255) NOT NULL,
  `color_pelo` varchar(255) NOT NULL,
  `estatura` double NOT NULL,
  `peso` double NOT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `preparacion_intelectualid` int(10) NOT NULL,
  `centro_trabajoid` int(10) NOT NULL,
  `cargoid` int(10) NOT NULL,
  `fecha_inicio_cargo` date NOT NULL,
  `trayectoria_militarid` int(10) DEFAULT NULL,
  `ubicacion_tiempo_guerra` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `vehiculo` tinyint(4) DEFAULT NULL,
  `arma` tinyint(4) DEFAULT NULL,
  `ingresos_monetarios` tinyint(4) DEFAULT NULL,
  `beneficio_ingreso` int(10) DEFAULT NULL,
  `reserva_cuadro` tinyint(4) DEFAULT NULL,
  `saludid` int(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FKcuadro892128` (`personaCI`),
  KEY `FKcuadro677955` (`preparacion_intelectualid`),
  KEY `FKcuadro20536` (`centro_trabajoid`),
  KEY `FKcuadro167357` (`cargoid`),
  KEY `FKcuadro68125` (`trayectoria_militarid`),
  KEY `FKcuadro627345` (`saludid`),
  KEY `Lugar_nacimiento` (`Lugar_nacimiento`,`provinciaid`),
  KEY `provinciaid` (`provinciaid`),
  CONSTRAINT `FKcuadro167357` FOREIGN KEY (`cargoid`) REFERENCES `cargo` (`id`),
  CONSTRAINT `FKcuadro20536` FOREIGN KEY (`centro_trabajoid`) REFERENCES `centro_trabajo` (`id`),
  CONSTRAINT `FKcuadro627345` FOREIGN KEY (`saludid`) REFERENCES `salud` (`id`),
  CONSTRAINT `FKcuadro677955` FOREIGN KEY (`preparacion_intelectualid`) REFERENCES `preparacion_intelectual` (`id`),
  CONSTRAINT `FKcuadro68125` FOREIGN KEY (`trayectoria_militarid`) REFERENCES `trayectoria_militar` (`id`),
  CONSTRAINT `FKcuadro892128` FOREIGN KEY (`personaCI`) REFERENCES `persona` (`CI`),
  CONSTRAINT `cuadro_ibfk_1` FOREIGN KEY (`provinciaid`) REFERENCES `provincia` (`id`),
  CONSTRAINT `cuadro_ibfk_2` FOREIGN KEY (`Lugar_nacimiento`) REFERENCES `municipio` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `cuadro_escuela_politica`
-- -------------------------------------------
DROP TABLE IF EXISTS `cuadro_escuela_politica`;
CREATE TABLE IF NOT EXISTS `cuadro_escuela_politica` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cuadroid` int(10) NOT NULL,
  `escuela_politicaid` int(10) NOT NULL,
  `curso` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKcuadro_esc886448` (`escuela_politicaid`),
  KEY `FKcuadro_esc729016` (`cuadroid`),
  CONSTRAINT `FKcuadro_esc729016` FOREIGN KEY (`cuadroid`) REFERENCES `cuadro` (`id`),
  CONSTRAINT `FKcuadro_esc886448` FOREIGN KEY (`escuela_politicaid`) REFERENCES `escuela_politica` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `cuadro_estudios_actuales`
-- -------------------------------------------
DROP TABLE IF EXISTS `cuadro_estudios_actuales`;
CREATE TABLE IF NOT EXISTS `cuadro_estudios_actuales` (
  `cuadroid` int(10) NOT NULL,
  `estudios_actualesid` int(10) NOT NULL,
  PRIMARY KEY (`cuadroid`,`estudios_actualesid`),
  KEY `FKcuadro_est667544` (`estudios_actualesid`),
  KEY `FKcuadro_est458166` (`cuadroid`),
  CONSTRAINT `FKcuadro_est458166` FOREIGN KEY (`cuadroid`) REFERENCES `cuadro` (`id`),
  CONSTRAINT `FKcuadro_est667544` FOREIGN KEY (`estudios_actualesid`) REFERENCES `estudios_actuales` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `cuadro_familiar`
-- -------------------------------------------
DROP TABLE IF EXISTS `cuadro_familiar`;
CREATE TABLE IF NOT EXISTS `cuadro_familiar` (
  `cuadroid` int(10) NOT NULL,
  `familiarid` int(10) NOT NULL,
  PRIMARY KEY (`cuadroid`,`familiarid`),
  KEY `FKcuadro_fam548447` (`familiarid`),
  KEY `FKcuadro_fam275299` (`cuadroid`),
  CONSTRAINT `FKcuadro_fam275299` FOREIGN KEY (`cuadroid`) REFERENCES `cuadro` (`id`),
  CONSTRAINT `FKcuadro_fam548447` FOREIGN KEY (`familiarid`) REFERENCES `familiar` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `cuadro_ingresos_monetarios`
-- -------------------------------------------
DROP TABLE IF EXISTS `cuadro_ingresos_monetarios`;
CREATE TABLE IF NOT EXISTS `cuadro_ingresos_monetarios` (
  `cuadroid` int(10) NOT NULL,
  `ingresos_monetariosid` int(10) NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `FKcuadro_ing828156` (`ingresos_monetariosid`),
  KEY `FKcuadro_ing891547` (`cuadroid`),
  CONSTRAINT `FKcuadro_ing828156` FOREIGN KEY (`ingresos_monetariosid`) REFERENCES `ingresos_monetarios` (`id`),
  CONSTRAINT `FKcuadro_ing891547` FOREIGN KEY (`cuadroid`) REFERENCES `cuadro` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `cuadro_sanciones`
-- -------------------------------------------
DROP TABLE IF EXISTS `cuadro_sanciones`;
CREATE TABLE IF NOT EXISTS `cuadro_sanciones` (
  `sancionesid` int(10) NOT NULL,
  `cuadroid` int(10) NOT NULL,
  PRIMARY KEY (`sancionesid`,`cuadroid`),
  KEY `FKcuadro_san538966` (`cuadroid`),
  KEY `FKcuadro_san81783` (`sancionesid`),
  CONSTRAINT `FKcuadro_san538966` FOREIGN KEY (`cuadroid`) REFERENCES `cuadro` (`id`),
  CONSTRAINT `FKcuadro_san81783` FOREIGN KEY (`sancionesid`) REFERENCES `sanciones` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `cuentas`
-- -------------------------------------------
DROP TABLE IF EXISTS `cuentas`;
CREATE TABLE IF NOT EXISTS `cuentas` (
  `representatividad` double DEFAULT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `total_cuentas_vencidas` float DEFAULT NULL,
  `no_vencidas` int(20) DEFAULT NULL,
  `saldo_sentencias_judiciales` double DEFAULT NULL,
  `empresaid` int(10) NOT NULL,
  `cxc_litigio` double DEFAULT NULL,
  `nm_no_vencida` double DEFAULT NULL,
  `efectos` double DEFAULT NULL,
  `mn_total_vencida` double DEFAULT NULL,
  `ExC_litigio` double DEFAULT NULL,
  `ventas_acumuladas` double DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `tipo_cuentaid` int(10) NOT NULL,
  `efectiviadad` double DEFAULT NULL,
  `vencidas` int(50) DEFAULT NULL,
  `anexoid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKcuentas201399` (`tipo_cuentaid`),
  KEY `FKcuentas859872` (`empresaid`),
  KEY `FKcuentas201400` (`tipo_cuentaid`),
  KEY `FKcuentas859873` (`empresaid`),
  CONSTRAINT `FKcuentas201399` FOREIGN KEY (`tipo_cuentaid`) REFERENCES `tipo_cuenta` (`id`),
  CONSTRAINT `FKcuentas859872` FOREIGN KEY (`empresaid`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `cumplimiento`
-- -------------------------------------------
DROP TABLE IF EXISTS `cumplimiento`;
CREATE TABLE IF NOT EXISTS `cumplimiento` (
  `indicadores_gestionid` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `valor` float DEFAULT NULL,
  `observaciones` text,
  `estado_cumplimientoid` int(10) NOT NULL DEFAULT '1',
  `fecha` date NOT NULL,
  `fecha_informacion` date NOT NULL,
  `anexo` int(2) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `actual` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FKcumplimien846180` (`estado_cumplimientoid`),
  KEY `indicadores_gestionid` (`indicadores_gestionid`),
  KEY `userid` (`userid`),
  CONSTRAINT `FKIndicadorId` FOREIGN KEY (`indicadores_gestionid`) REFERENCES `indicadores_gestion` (`id`),
  CONSTRAINT `FKcumplimien846180` FOREIGN KEY (`estado_cumplimientoid`) REFERENCES `estado_cumplimiento` (`id`),
  CONSTRAINT `FkUserid` FOREIGN KEY (`userid`) REFERENCES `user` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `cumplimiento_anexo`
-- -------------------------------------------
DROP TABLE IF EXISTS `cumplimiento_anexo`;
CREATE TABLE IF NOT EXISTS `cumplimiento_anexo` (
  `cumplimientoid` int(10) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `anexoid` int(10) NOT NULL,
  `fecha` date DEFAULT NULL,
  `anexo` varchar(500) NOT NULL,
  `idtabla` int(10) NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `anexoid` (`anexoid`),
  KEY `cumplimientoid` (`cumplimientoid`),
  CONSTRAINT `FKanexocumplimientoid` FOREIGN KEY (`anexoid`) REFERENCES `anexo` (`id`),
  CONSTRAINT `FKcumplimientoid` FOREIGN KEY (`cumplimientoid`) REFERENCES `cumplimiento` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `direccion`
-- -------------------------------------------
DROP TABLE IF EXISTS `direccion`;
CREATE TABLE IF NOT EXISTS `direccion` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `responsable` varchar(255) NOT NULL,
  `Status` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `direcciones`
-- -------------------------------------------
DROP TABLE IF EXISTS `direcciones`;
CREATE TABLE IF NOT EXISTS `direcciones` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `calle` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `edif` varchar(255) DEFAULT NULL,
  `apto` varchar(255) DEFAULT NULL,
  `piso` varchar(255) DEFAULT NULL,
  `entre_calle_uno` varchar(255) NOT NULL,
  `entre_calle_dos` varchar(255) NOT NULL,
  `Reparto` varchar(255) DEFAULT NULL,
  `provinciaid` int(10) NOT NULL,
  `municipioid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKdireccione922126` (`provinciaid`),
  KEY `FKdireccione499759` (`municipioid`),
  CONSTRAINT `FKdireccione499759` FOREIGN KEY (`municipioid`) REFERENCES `municipio` (`id`),
  CONSTRAINT `FKdireccione922126` FOREIGN KEY (`provinciaid`) REFERENCES `provincia` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `directivo`
-- -------------------------------------------
DROP TABLE IF EXISTS `directivo`;
CREATE TABLE IF NOT EXISTS `directivo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cuadroid` int(10) NOT NULL,
  `cargos_direccionid` int(10) NOT NULL,
  `años_cargo` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKdirectivo627450` (`cargos_direccionid`),
  KEY `FKdirectivo907709` (`cuadroid`),
  CONSTRAINT `FKdirectivo627450` FOREIGN KEY (`cargos_direccionid`) REFERENCES `cargos_direccion` (`id`),
  CONSTRAINT `FKdirectivo907709` FOREIGN KEY (`cuadroid`) REFERENCES `cuadro` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `empresa`
-- -------------------------------------------
DROP TABLE IF EXISTS `empresa`;
CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `tegnologia_logisticaid` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKempresa836767` (`tegnologia_logisticaid`),
  KEY `FKempresa836768` (`tegnologia_logisticaid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `enfermedad`
-- -------------------------------------------
DROP TABLE IF EXISTS `enfermedad`;
CREATE TABLE IF NOT EXISTS `enfermedad` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `enfermedad` varchar(150) DEFAULT NULL,
  `tratamiento` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `enfermedad_salud`
-- -------------------------------------------
DROP TABLE IF EXISTS `enfermedad_salud`;
CREATE TABLE IF NOT EXISTS `enfermedad_salud` (
  `enfermedadid` int(10) NOT NULL,
  `saludid` int(10) NOT NULL,
  PRIMARY KEY (`enfermedadid`,`saludid`),
  KEY `FKenfermedad960331` (`saludid`),
  KEY `FKenfermedad760061` (`enfermedadid`),
  CONSTRAINT `FKenfermedad760061` FOREIGN KEY (`enfermedadid`) REFERENCES `enfermedad` (`id`),
  CONSTRAINT `FKenfermedad960331` FOREIGN KEY (`saludid`) REFERENCES `salud` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `escuela_politica`
-- -------------------------------------------
DROP TABLE IF EXISTS `escuela_politica`;
CREATE TABLE IF NOT EXISTS `escuela_politica` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `escuela` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `estado_cumplimiento`
-- -------------------------------------------
DROP TABLE IF EXISTS `estado_cumplimiento`;
CREATE TABLE IF NOT EXISTS `estado_cumplimiento` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `estado` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `estado_salud`
-- -------------------------------------------
DROP TABLE IF EXISTS `estado_salud`;
CREATE TABLE IF NOT EXISTS `estado_salud` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `estado_salud` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `estancia_exterior`
-- -------------------------------------------
DROP TABLE IF EXISTS `estancia_exterior`;
CREATE TABLE IF NOT EXISTS `estancia_exterior` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  `pais` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `cargo` varchar(255) DEFAULT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `cuadroid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKestancia_e87558` (`cuadroid`),
  CONSTRAINT `FKestancia_e87558` FOREIGN KEY (`cuadroid`) REFERENCES `cuadro` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `estudios_actuales`
-- -------------------------------------------
DROP TABLE IF EXISTS `estudios_actuales`;
CREATE TABLE IF NOT EXISTS `estudios_actuales` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `estudio` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `evaluacion`
-- -------------------------------------------
DROP TABLE IF EXISTS `evaluacion`;
CREATE TABLE IF NOT EXISTS `evaluacion` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `valor_vreal` float NOT NULL,
  `fechacreado` date NOT NULL,
  `fecha_informacion` date NOT NULL,
  `direccionid` int(10) NOT NULL,
  `criteriomedidaid` int(10) NOT NULL,
  `estado` int(1) DEFAULT '1',
  `periodo` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `observaciones` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `anexo` tinyint(4) NOT NULL DEFAULT '0',
  `actual` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FKevaluacion362970` (`direccionid`),
  KEY `FKevaluacion716761` (`criteriomedidaid`),
  KEY `FKevaluacion589778` (`userid`),
  KEY `estado` (`estado`),
  KEY `periodo` (`periodo`),
  CONSTRAINT `FKestado` FOREIGN KEY (`estado`) REFERENCES `estado_cumplimiento` (`id`),
  CONSTRAINT `FKevaluacion362970` FOREIGN KEY (`direccionid`) REFERENCES `direccion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FKevaluacion589778` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FKevaluacion716761` FOREIGN KEY (`criteriomedidaid`) REFERENCES `criteriomedida` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FKperiodo` FOREIGN KEY (`periodo`) REFERENCES `periodo` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `evaluacion_anexo`
-- -------------------------------------------
DROP TABLE IF EXISTS `evaluacion_anexo`;
CREATE TABLE IF NOT EXISTS `evaluacion_anexo` (
  `evaluacionid` int(10) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `anexoid` int(10) NOT NULL,
  `fecha` date DEFAULT NULL,
  `anexo` varchar(500) NOT NULL,
  `idtabla` int(10) NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `anexoid` (`anexoid`),
  KEY `cumplimientoid` (`evaluacionid`),
  CONSTRAINT `FKanexoid` FOREIGN KEY (`anexoid`) REFERENCES `anexo` (`id`),
  CONSTRAINT `FKevaluacionid` FOREIGN KEY (`evaluacionid`) REFERENCES `evaluacion` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `evaluacion_cuadro`
-- -------------------------------------------
DROP TABLE IF EXISTS `evaluacion_cuadro`;
CREATE TABLE IF NOT EXISTS `evaluacion_cuadro` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `complemento_textual` text,
  `señalamientos` text,
  `recomendaciones` text NOT NULL,
  `concluciones` text,
  `resultado_evaluacion` varchar(255) DEFAULT NULL,
  `superacion` varchar(255) DEFAULT NULL,
  `confecionado` int(11) NOT NULL,
  `entidad` varchar(255) DEFAULT NULL,
  `cuadroid` int(10) NOT NULL,
  `reservaid` int(10) NOT NULL,
  `proyeccionid` int(10) NOT NULL,
  `opinion_evaluadoid` int(10) NOT NULL,
  `experienciaid` int(10) NOT NULL,
  `periodo_evaluadoid` int(10) NOT NULL,
  `organismoidorganismo` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `ultima` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FKevaluacion662428` (`reservaid`),
  KEY `FKevaluacion580110` (`proyeccionid`),
  KEY `FKevaluacion677443` (`opinion_evaluadoid`),
  KEY `FKevaluacion764107` (`experienciaid`),
  KEY `FKevaluacion45648` (`periodo_evaluadoid`),
  KEY `cuadroid` (`cuadroid`),
  KEY `confecionado` (`confecionado`),
  CONSTRAINT `FKConfecionado` FOREIGN KEY (`confecionado`) REFERENCES `confecionado` (`id`),
  CONSTRAINT `FKcuadroid` FOREIGN KEY (`cuadroid`) REFERENCES `cuadro` (`id`),
  CONSTRAINT `FKevaluacion45648` FOREIGN KEY (`periodo_evaluadoid`) REFERENCES `periodo_evaluado` (`id`),
  CONSTRAINT `FKevaluacion580110` FOREIGN KEY (`proyeccionid`) REFERENCES `proyeccion` (`id`),
  CONSTRAINT `FKevaluacion662428` FOREIGN KEY (`reservaid`) REFERENCES `reserva` (`id`),
  CONSTRAINT `FKevaluacion677443` FOREIGN KEY (`opinion_evaluadoid`) REFERENCES `opinion_evaluado` (`id`),
  CONSTRAINT `FKevaluacion764107` FOREIGN KEY (`experienciaid`) REFERENCES `experiencia` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `evaluacion_cuadro_indicadores_evaluacion`
-- -------------------------------------------
DROP TABLE IF EXISTS `evaluacion_cuadro_indicadores_evaluacion`;
CREATE TABLE IF NOT EXISTS `evaluacion_cuadro_indicadores_evaluacion` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `evaluacion_cuadroid` int(10) NOT NULL,
  `Indicadores_evaluacionid` int(10) NOT NULL,
  `evaluacion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKevaluacion817933` (`evaluacion_cuadroid`),
  KEY `FKevaluacion780954` (`Indicadores_evaluacionid`),
  CONSTRAINT `FKevaluacion780954` FOREIGN KEY (`Indicadores_evaluacionid`) REFERENCES `indicadores_evaluacion` (`id`),
  CONSTRAINT `FKevaluacion817933` FOREIGN KEY (`evaluacion_cuadroid`) REFERENCES `evaluacion_cuadro` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `experiencia`
-- -------------------------------------------
DROP TABLE IF EXISTS `experiencia`;
CREATE TABLE IF NOT EXISTS `experiencia` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `años_cargo_actual` int(10) DEFAULT '0',
  `meses_cargo_actual` int(2) DEFAULT '0',
  `años_cuadro` int(2) DEFAULT '0',
  `meses_cuadro` int(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `familiar`
-- -------------------------------------------
DROP TABLE IF EXISTS `familiar`;
CREATE TABLE IF NOT EXISTS `familiar` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo_familiar` int(2) NOT NULL,
  `personaCI` varchar(11) NOT NULL,
  `centro_estudio_trabajo` varchar(255) NOT NULL,
  `conviviente` tinyint(4) DEFAULT '0',
  `sancionado` tinyint(4) DEFAULT '0',
  `viaje` tinyint(1) NOT NULL DEFAULT '0',
  `residenteExterior` tinyint(1) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FKfamiliar157419` (`personaCI`),
  KEY `tipo_familiar` (`tipo_familiar`),
  CONSTRAINT `FKfamiliar157419` FOREIGN KEY (`personaCI`) REFERENCES `persona` (`CI`),
  CONSTRAINT `FKfamiliarTipo` FOREIGN KEY (`tipo_familiar`) REFERENCES `tipo_familiar` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `familiar_integracion`
-- -------------------------------------------
DROP TABLE IF EXISTS `familiar_integracion`;
CREATE TABLE IF NOT EXISTS `familiar_integracion` (
  `familiarid` int(10) NOT NULL,
  `integracionid` int(10) NOT NULL,
  PRIMARY KEY (`familiarid`,`integracionid`),
  KEY `FKfamiliar_i394214` (`integracionid`),
  KEY `FKfamiliar_i954906` (`familiarid`),
  CONSTRAINT `FKfamiliar_i394214` FOREIGN KEY (`integracionid`) REFERENCES `integracion` (`id`),
  CONSTRAINT `FKfamiliar_i954906` FOREIGN KEY (`familiarid`) REFERENCES `familiar` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `familiares_exterior`
-- -------------------------------------------
DROP TABLE IF EXISTS `familiares_exterior`;
CREATE TABLE IF NOT EXISTS `familiares_exterior` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pais` varchar(255) NOT NULL,
  `nacionalidad` varchar(255) NOT NULL,
  `familiarid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKfamiliares676208` (`familiarid`),
  CONSTRAINT `FKfamiliares676208` FOREIGN KEY (`familiarid`) REFERENCES `familiar` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `fondo_salario`
-- -------------------------------------------
DROP TABLE IF EXISTS `fondo_salario`;
CREATE TABLE IF NOT EXISTS `fondo_salario` (
  `FSVA_vreal` varchar(25) DEFAULT NULL,
  `FSVA_plan` varchar(25) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `empresaid` int(10) NOT NULL,
  `plan_anterior` varchar(25) NOT NULL,
  `anexoid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKfondo_sala344342` (`empresaid`),
  KEY `FKfondo_sala344343` (`empresaid`),
  CONSTRAINT `FKfondo_sala344342` FOREIGN KEY (`empresaid`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `fondo_tiempo`
-- -------------------------------------------
DROP TABLE IF EXISTS `fondo_tiempo`;
CREATE TABLE IF NOT EXISTS `fondo_tiempo` (
  `adiestrado` int(10) DEFAULT NULL,
  `indice_utilizacion` float DEFAULT NULL,
  `indice_ausentismo` float DEFAULT NULL,
  `ausentismo_puro` float DEFAULT NULL,
  `promedio_trab_mensual` int(10) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `empresaid` int(10) NOT NULL,
  `anexoid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKfondo_tiem233770` (`empresaid`),
  KEY `FKfondo_tiem233771` (`empresaid`),
  CONSTRAINT `FKfondo_tiem233771` FOREIGN KEY (`empresaid`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `grado_cientifico`
-- -------------------------------------------
DROP TABLE IF EXISTS `grado_cientifico`;
CREATE TABLE IF NOT EXISTS `grado_cientifico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `idiomas`
-- -------------------------------------------
DROP TABLE IF EXISTS `idiomas`;
CREATE TABLE IF NOT EXISTS `idiomas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idioma` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `impuesto`
-- -------------------------------------------
DROP TABLE IF EXISTS `impuesto`;
CREATE TABLE IF NOT EXISTS `impuesto` (
  `venta35_plan` float DEFAULT NULL,
  `ventas35_vreal` float DEFAULT NULL,
  `ventas2_plan` float DEFAULT NULL,
  `ventas2_vreal` float DEFAULT NULL,
  `especial17_vreal` float DEFAULT NULL,
  `especial17_real2` float DEFAULT NULL,
  `recupercion_vreal` float DEFAULT NULL,
  `recuperacion_plan` int(10) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `empresaid` int(10) NOT NULL,
  `anexoid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKimpuesto65937` (`empresaid`),
  KEY `FKimpuesto65938` (`empresaid`),
  CONSTRAINT `FKimpuesto65938` FOREIGN KEY (`empresaid`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `indicadores_evaluacion`
-- -------------------------------------------
DROP TABLE IF EXISTS `indicadores_evaluacion`;
CREATE TABLE IF NOT EXISTS `indicadores_evaluacion` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(1000) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `indicadores_gestion`
-- -------------------------------------------
DROP TABLE IF EXISTS `indicadores_gestion`;
CREATE TABLE IF NOT EXISTS `indicadores_gestion` (
  `descripcion` text,
  `fecha_chequeo` date DEFAULT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `direccionid` int(10) NOT NULL,
  `UM` varchar(255) DEFAULT NULL,
  `topeid` int(10) NOT NULL,
  `orden` int(10) DEFAULT NULL,
  `objetivoid` int(10) NOT NULL,
  `editable` tinyint(4) NOT NULL DEFAULT '1',
  `status` int(2) NOT NULL DEFAULT '1',
  `evaluado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FKindicadore906544` (`direccionid`),
  KEY `FKindicadore906545` (`direccionid`),
  KEY `topeid` (`topeid`),
  KEY `objetivoid` (`objetivoid`),
  CONSTRAINT `FKindicadore906544` FOREIGN KEY (`direccionid`) REFERENCES `direccion` (`id`),
  CONSTRAINT `FKobjetivo` FOREIGN KEY (`objetivoid`) REFERENCES `objetivo` (`id`),
  CONSTRAINT `FKtope` FOREIGN KEY (`topeid`) REFERENCES `tope_indicador` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `informacion_laboratorios`
-- -------------------------------------------
DROP TABLE IF EXISTS `informacion_laboratorios`;
CREATE TABLE IF NOT EXISTS `informacion_laboratorios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `empresaid` int(10) NOT NULL,
  `cant` int(5) DEFAULT '0',
  `terminados` int(5) DEFAULT '0',
  `cant_func` int(5) DEFAULT '0',
  `cant_no_func` int(5) DEFAULT '0',
  `fecha` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `anexoid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `empresaid` (`empresaid`),
  CONSTRAINT `fkempresa` FOREIGN KEY (`empresaid`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `ingresos_monetarios`
-- -------------------------------------------
DROP TABLE IF EXISTS `ingresos_monetarios`;
CREATE TABLE IF NOT EXISTS `ingresos_monetarios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo_familiarid` int(2) NOT NULL,
  `tipo_ingresosid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKingresos_m38762` (`tipo_ingresosid`),
  KEY `tipo_familiarid` (`tipo_familiarid`),
  CONSTRAINT `FKingresos_m38762` FOREIGN KEY (`tipo_ingresosid`) REFERENCES `tipo_ingresos` (`id`),
  CONSTRAINT `FKtipo_familiar` FOREIGN KEY (`tipo_familiarid`) REFERENCES `tipo_familiar` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `integracion`
-- -------------------------------------------
DROP TABLE IF EXISTS `integracion`;
CREATE TABLE IF NOT EXISTS `integracion` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `organizacion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `inventario`
-- -------------------------------------------
DROP TABLE IF EXISTS `inventario`;
CREATE TABLE IF NOT EXISTS `inventario` (
  `inventario` float DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo_inventarioid` int(10) NOT NULL,
  `empresaid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKinventario270300` (`tipo_inventarioid`),
  KEY `FKinventario179580` (`empresaid`),
  KEY `FKinventario270301` (`tipo_inventarioid`),
  KEY `FKinventario179581` (`empresaid`),
  CONSTRAINT `FKinventario179580` FOREIGN KEY (`empresaid`) REFERENCES `empresa` (`id`),
  CONSTRAINT `FKinventario270301` FOREIGN KEY (`tipo_inventarioid`) REFERENCES `tipo_inventario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `limitaciones`
-- -------------------------------------------
DROP TABLE IF EXISTS `limitaciones`;
CREATE TABLE IF NOT EXISTS `limitaciones` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `limitacion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `limitaciones_salud`
-- -------------------------------------------
DROP TABLE IF EXISTS `limitaciones_salud`;
CREATE TABLE IF NOT EXISTS `limitaciones_salud` (
  `limitacionesid` int(10) NOT NULL,
  `saludid` int(10) NOT NULL,
  PRIMARY KEY (`limitacionesid`,`saludid`),
  KEY `FKlimitacion348500` (`saludid`),
  KEY `FKlimitacion715557` (`limitacionesid`),
  CONSTRAINT `FKlimitacion348500` FOREIGN KEY (`saludid`) REFERENCES `salud` (`id`),
  CONSTRAINT `FKlimitacion715557` FOREIGN KEY (`limitacionesid`) REFERENCES `limitaciones` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `lugares_residencia`
-- -------------------------------------------
DROP TABLE IF EXISTS `lugares_residencia`;
CREATE TABLE IF NOT EXISTS `lugares_residencia` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cuadroid` int(10) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `direccionesid` int(10) NOT NULL,
  `actual` varchar(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FKlugares_re336886` (`cuadroid`),
  KEY `FKlugares_re134363` (`direccionesid`),
  CONSTRAINT `FKlugares_re134363` FOREIGN KEY (`direccionesid`) REFERENCES `direcciones` (`id`),
  CONSTRAINT `FKlugares_re336886` FOREIGN KEY (`cuadroid`) REFERENCES `cuadro` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `migration`
-- -------------------------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `miitancia_politic`
-- -------------------------------------------
DROP TABLE IF EXISTS `miitancia_politic`;
CREATE TABLE IF NOT EXISTS `miitancia_politic` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `miitancia_politic_cuadro`
-- -------------------------------------------
DROP TABLE IF EXISTS `miitancia_politic_cuadro`;
CREATE TABLE IF NOT EXISTS `miitancia_politic_cuadro` (
  `miitancia_politicid` int(10) NOT NULL,
  `cuadroid` int(10) NOT NULL,
  PRIMARY KEY (`miitancia_politicid`,`cuadroid`),
  KEY `FKmiitancia_674297` (`miitancia_politicid`),
  CONSTRAINT `FKmiitancia_674297` FOREIGN KEY (`miitancia_politicid`) REFERENCES `miitancia_politic` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `militancia`
-- -------------------------------------------
DROP TABLE IF EXISTS `militancia`;
CREATE TABLE IF NOT EXISTS `militancia` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `movimiento_cuadro`
-- -------------------------------------------
DROP TABLE IF EXISTS `movimiento_cuadro`;
CREATE TABLE IF NOT EXISTS `movimiento_cuadro` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `causas_sustitucion` text,
  `sintesis_biografica` text NOT NULL,
  `resultados_controles` text NOT NULL,
  `fundamentacion` text NOT NULL,
  `consideraciones` text NOT NULL,
  `entidad` varchar(255) NOT NULL,
  `idcargo_propuesto` int(10) NOT NULL,
  `tipo_movimientoid` int(10) NOT NULL,
  `cuadroid` int(10) NOT NULL,
  `cuadro_sustituido` int(10) NOT NULL,
  `evaluacion_cuadroid` int(10) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `aprobada` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FKmovimiento593790` (`idcargo_propuesto`),
  KEY `FKmovimiento173819` (`tipo_movimientoid`),
  KEY `FKmovimiento468357` (`cuadroid`),
  KEY `FKmovimiento612838` (`cuadro_sustituido`),
  KEY `FKmovimiento396518` (`evaluacion_cuadroid`),
  CONSTRAINT `FKevaluacion` FOREIGN KEY (`evaluacion_cuadroid`) REFERENCES `evaluacion_cuadro` (`id`),
  CONSTRAINT `FKmovimiento173819` FOREIGN KEY (`tipo_movimientoid`) REFERENCES `tipo_movimiento` (`id`),
  CONSTRAINT `FKmovimiento468357` FOREIGN KEY (`cuadroid`) REFERENCES `cuadro` (`id`),
  CONSTRAINT `FKmovimiento593790` FOREIGN KEY (`idcargo_propuesto`) REFERENCES `cargos_direccion` (`id`),
  CONSTRAINT `FKmovimiento612838` FOREIGN KEY (`cuadro_sustituido`) REFERENCES `cuadro` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `municipio`
-- -------------------------------------------
DROP TABLE IF EXISTS `municipio`;
CREATE TABLE IF NOT EXISTS `municipio` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `municipio` varchar(255) NOT NULL,
  `provinciaid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKmunicipio833534` (`provinciaid`),
  CONSTRAINT `FKmunicipio833534` FOREIGN KEY (`provinciaid`) REFERENCES `provincia` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `nivel_escolaridad`
-- -------------------------------------------
DROP TABLE IF EXISTS `nivel_escolaridad`;
CREATE TABLE IF NOT EXISTS `nivel_escolaridad` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `objetivo`
-- -------------------------------------------
DROP TABLE IF EXISTS `objetivo`;
CREATE TABLE IF NOT EXISTS `objetivo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `orden` int(10) NOT NULL,
  `nombre` varchar(1000) NOT NULL,
  `abreviatura` varchar(5) NOT NULL,
  `descripcion` text NOT NULL,
  `fechaAct` date NOT NULL,
  `responsable` int(10) NOT NULL,
  `Status` tinyint(3) DEFAULT '1',
  `fechaDesac` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKobjetivo335764` (`responsable`),
  CONSTRAINT `FKobjetivo335764` FOREIGN KEY (`responsable`) REFERENCES `direccion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `opinion_evaluado`
-- -------------------------------------------
DROP TABLE IF EXISTS `opinion_evaluado`;
CREATE TABLE IF NOT EXISTS `opinion_evaluado` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `opinion` varchar(1000) DEFAULT NULL,
  `reclamacion` tinyint(1) NOT NULL,
  `reclamacion_desc` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `organismo`
-- -------------------------------------------
DROP TABLE IF EXISTS `organismo`;
CREATE TABLE IF NOT EXISTS `organismo` (
  `idorganismo` int(11) NOT NULL AUTO_INCREMENT,
  `organismo` varchar(255) NOT NULL,
  `Status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idorganismo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `perdida_investigacion`
-- -------------------------------------------
DROP TABLE IF EXISTS `perdida_investigacion`;
CREATE TABLE IF NOT EXISTS `perdida_investigacion` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `importe_total` float DEFAULT NULL,
  `cant_expedientas` int(10) DEFAULT NULL,
  `fuera_termino` int(10) DEFAULT NULL,
  `valor_fuera_termino` float DEFAULT NULL,
  `tipo_expedienteid` int(10) NOT NULL,
  `empresaid` int(10) NOT NULL,
  `fecha` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `anexoid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKperdida_in822466` (`tipo_expedienteid`),
  KEY `FKperdida_in791498` (`empresaid`),
  KEY `FKperdida_in822467` (`tipo_expedienteid`),
  KEY `FKperdida_in791499` (`empresaid`),
  CONSTRAINT `FKperdida_in791498` FOREIGN KEY (`empresaid`) REFERENCES `empresa` (`id`),
  CONSTRAINT `FKperdida_in822467` FOREIGN KEY (`tipo_expedienteid`) REFERENCES `tipo_expediente` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `periodo`
-- -------------------------------------------
DROP TABLE IF EXISTS `periodo`;
CREATE TABLE IF NOT EXISTS `periodo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `periodo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `periodo_evaluado`
-- -------------------------------------------
DROP TABLE IF EXISTS `periodo_evaluado`;
CREATE TABLE IF NOT EXISTS `periodo_evaluado` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `desde` date DEFAULT NULL,
  `hasta` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `persona`
-- -------------------------------------------
DROP TABLE IF EXISTS `persona`;
CREATE TABLE IF NOT EXISTS `persona` (
  `CI` varchar(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `primer_apellido` varchar(255) NOT NULL,
  `segundo_apellido` varchar(255) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  PRIMARY KEY (`CI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `plan_evaluacion`
-- -------------------------------------------
DROP TABLE IF EXISTS `plan_evaluacion`;
CREATE TABLE IF NOT EXISTS `plan_evaluacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idevaluador` int(11) NOT NULL,
  `idcuadro` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `status` int(11) DEFAULT '0',
  `ultima` int(11) NOT NULL DEFAULT '1',
  `observaciones` text,
  PRIMARY KEY (`id`),
  KEY `FKEvaluador` (`idevaluador`),
  KEY `FKCuadro` (`idcuadro`),
  CONSTRAINT `fkcuadro` FOREIGN KEY (`idcuadro`) REFERENCES `cuadro` (`id`),
  CONSTRAINT `fkevaluador` FOREIGN KEY (`idevaluador`) REFERENCES `user` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `plantilla`
-- -------------------------------------------
DROP TABLE IF EXISTS `plantilla`;
CREATE TABLE IF NOT EXISTS `plantilla` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cant_trabajadores` int(10) DEFAULT NULL,
  `cant_cuadros` int(10) DEFAULT NULL,
  `trabajadores_cubierta` int(10) DEFAULT NULL,
  `cuadros_cubierta` int(10) DEFAULT NULL,
  `empresaid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `preparacion_intelectual`
-- -------------------------------------------
DROP TABLE IF EXISTS `preparacion_intelectual`;
CREATE TABLE IF NOT EXISTS `preparacion_intelectual` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nivel_escolaridad` int(11) NOT NULL COMMENT '                                       ',
  `Especialidad` varchar(255) DEFAULT NULL,
  `grado_cientifico` int(11) DEFAULT NULL,
  `categoria_docente` int(11) DEFAULT NULL,
  `informatica` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `grado_cientifico` (`grado_cientifico`),
  KEY `categoria_docente` (`categoria_docente`),
  KEY `nivel_escolaridad` (`nivel_escolaridad`),
  CONSTRAINT `fkcategoria` FOREIGN KEY (`categoria_docente`) REFERENCES `categoria_docente` (`id`),
  CONSTRAINT `fkescolaridad` FOREIGN KEY (`nivel_escolaridad`) REFERENCES `nivel_escolaridad` (`id`),
  CONSTRAINT `fkgrado` FOREIGN KEY (`grado_cientifico`) REFERENCES `grado_cientifico` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `preparacion_intelectual_idiomas`
-- -------------------------------------------
DROP TABLE IF EXISTS `preparacion_intelectual_idiomas`;
CREATE TABLE IF NOT EXISTS `preparacion_intelectual_idiomas` (
  `preparacion_intelectualid` int(10) NOT NULL,
  `idiomasid` int(10) NOT NULL,
  `nivel` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`preparacion_intelectualid`,`idiomasid`),
  KEY `FKpreparacio142318` (`idiomasid`),
  KEY `FKpreparacio58858` (`preparacion_intelectualid`),
  CONSTRAINT `FKpreparacio142318` FOREIGN KEY (`idiomasid`) REFERENCES `idiomas` (`id`),
  CONSTRAINT `FKpreparacio58858` FOREIGN KEY (`preparacion_intelectualid`) REFERENCES `preparacion_intelectual` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `preparacion_militar`
-- -------------------------------------------
DROP TABLE IF EXISTS `preparacion_militar`;
CREATE TABLE IF NOT EXISTS `preparacion_militar` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `escuela` varchar(255) DEFAULT NULL,
  `curso` varchar(255) DEFAULT NULL,
  `fecha` date NOT NULL,
  `trayectoria_militarid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKpreparacio595743` (`trayectoria_militarid`),
  CONSTRAINT `FKpreparacio595743` FOREIGN KEY (`trayectoria_militarid`) REFERENCES `trayectoria_militar` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `productividad`
-- -------------------------------------------
DROP TABLE IF EXISTS `productividad`;
CREATE TABLE IF NOT EXISTS `productividad` (
  `plan` double DEFAULT NULL,
  `vreal` double DEFAULT NULL,
  `plan_anterior` double DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `correlacion` double DEFAULT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `empresaid` int(10) NOT NULL,
  `anexoid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKproductivi913153` (`empresaid`),
  KEY `FKproductivi913154` (`empresaid`),
  CONSTRAINT `FKproductivi913154` FOREIGN KEY (`empresaid`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `producto`
-- -------------------------------------------
DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `producto` varchar(255) DEFAULT NULL,
  `UM` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `provincia`
-- -------------------------------------------
DROP TABLE IF EXISTS `provincia`;
CREATE TABLE IF NOT EXISTS `provincia` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `provincia` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `provincia` (`provincia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `proyeccion`
-- -------------------------------------------
DROP TABLE IF EXISTS `proyeccion`;
CREATE TABLE IF NOT EXISTS `proyeccion` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo_proyeccionid` int(10) NOT NULL,
  `tipo_movimientoid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_movimientoid` (`tipo_movimientoid`),
  KEY `tipo_proyeccionid` (`tipo_proyeccionid`),
  CONSTRAINT `FKTipo_movimiento` FOREIGN KEY (`tipo_movimientoid`) REFERENCES `tipo_movimiento` (`id`),
  CONSTRAINT `proyeccion_ibfk_1` FOREIGN KEY (`tipo_proyeccionid`) REFERENCES `tipo_proyeccion` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `prueba`
-- -------------------------------------------
DROP TABLE IF EXISTS `prueba`;
CREATE TABLE IF NOT EXISTS `prueba` (
  `id` int(10) NOT NULL,
  `pais` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `municipio` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `reclamaciones`
-- -------------------------------------------
DROP TABLE IF EXISTS `reclamaciones`;
CREATE TABLE IF NOT EXISTS `reclamaciones` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cant_reclamacion` int(10) DEFAULT '0',
  `importe_reclamacion` varchar(25) DEFAULT '0',
  `demanda_cant` int(10) DEFAULT '0',
  `demanda_importe` varchar(25) DEFAULT '0',
  `anexoid` int(10) DEFAULT '0',
  `fecha` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `empresaid` int(10) NOT NULL,
  `tipo_reclamacion` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_reclamacion` (`tipo_reclamacion`),
  KEY `empresaid` (`empresaid`),
  CONSTRAINT `FKtipo_reclamacion` FOREIGN KEY (`tipo_reclamacion`) REFERENCES `tipo_relcamacion` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `relaciones_exterior`
-- -------------------------------------------
DROP TABLE IF EXISTS `relaciones_exterior`;
CREATE TABLE IF NOT EXISTS `relaciones_exterior` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pais` varchar(255) NOT NULL,
  `nacionalidad` varchar(255) NOT NULL,
  `personaCI` varchar(11) NOT NULL,
  `cuadroid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKrelaciones502950` (`personaCI`),
  KEY `FKrelaciones724376` (`cuadroid`),
  CONSTRAINT `FKrelaciones502950` FOREIGN KEY (`personaCI`) REFERENCES `persona` (`CI`),
  CONSTRAINT `FKrelaciones724376` FOREIGN KEY (`cuadroid`) REFERENCES `cuadro` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `reserva`
-- -------------------------------------------
DROP TABLE IF EXISTS `reserva`;
CREATE TABLE IF NOT EXISTS `reserva` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` int(10) DEFAULT NULL,
  `observaciones` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo` (`tipo`),
  KEY `tipo_2` (`tipo`),
  CONSTRAINT `FKTipo_reserva` FOREIGN KEY (`tipo`) REFERENCES `tipo_reserva` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `rol`
-- -------------------------------------------
DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rol` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `salud`
-- -------------------------------------------
DROP TABLE IF EXISTS `salud`;
CREATE TABLE IF NOT EXISTS `salud` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `estado_saludid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKsalud928587` (`estado_saludid`),
  CONSTRAINT `FKsalud928587` FOREIGN KEY (`estado_saludid`) REFERENCES `estado_salud` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `sancionados`
-- -------------------------------------------
DROP TABLE IF EXISTS `sancionados`;
CREATE TABLE IF NOT EXISTS `sancionados` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sancion` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `motivo` varchar(1000) NOT NULL,
  `familiarid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKsancionado909127` (`familiarid`),
  CONSTRAINT `FKsancionado909127` FOREIGN KEY (`familiarid`) REFERENCES `familiar` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `sanciones`
-- -------------------------------------------
DROP TABLE IF EXISTS `sanciones`;
CREATE TABLE IF NOT EXISTS `sanciones` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  `sansion` varchar(255) NOT NULL,
  `motivo` varchar(1000) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `sentido`
-- -------------------------------------------
DROP TABLE IF EXISTS `sentido`;
CREATE TABLE IF NOT EXISTS `sentido` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sentido` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tegnologia_logistica`
-- -------------------------------------------
DROP TABLE IF EXISTS `tegnologia_logistica`;
CREATE TABLE IF NOT EXISTS `tegnologia_logistica` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `existencia` int(10) DEFAULT NULL,
  `funcionando` int(10) DEFAULT NULL,
  `porciento_disp` float DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `tipo_MTid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKtegnologia397866` (`tipo_MTid`),
  KEY `FKtegnologia397867` (`tipo_MTid`),
  CONSTRAINT `FKtegnologia397867` FOREIGN KEY (`tipo_MTid`) REFERENCES `tipo_mt` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tipo_arma`
-- -------------------------------------------
DROP TABLE IF EXISTS `tipo_arma`;
CREATE TABLE IF NOT EXISTS `tipo_arma` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo_arma` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tipo_cuenta`
-- -------------------------------------------
DROP TABLE IF EXISTS `tipo_cuenta`;
CREATE TABLE IF NOT EXISTS `tipo_cuenta` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tipo_expediente`
-- -------------------------------------------
DROP TABLE IF EXISTS `tipo_expediente`;
CREATE TABLE IF NOT EXISTS `tipo_expediente` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tipo_extancia`
-- -------------------------------------------
DROP TABLE IF EXISTS `tipo_extancia`;
CREATE TABLE IF NOT EXISTS `tipo_extancia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tipo_familiar`
-- -------------------------------------------
DROP TABLE IF EXISTS `tipo_familiar`;
CREATE TABLE IF NOT EXISTS `tipo_familiar` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tipo_ingresos`
-- -------------------------------------------
DROP TABLE IF EXISTS `tipo_ingresos`;
CREATE TABLE IF NOT EXISTS `tipo_ingresos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tipo_inventario`
-- -------------------------------------------
DROP TABLE IF EXISTS `tipo_inventario`;
CREATE TABLE IF NOT EXISTS `tipo_inventario` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tipo_movimiento`
-- -------------------------------------------
DROP TABLE IF EXISTS `tipo_movimiento`;
CREATE TABLE IF NOT EXISTS `tipo_movimiento` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo_movimiento` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tipo_mt`
-- -------------------------------------------
DROP TABLE IF EXISTS `tipo_mt`;
CREATE TABLE IF NOT EXISTS `tipo_mt` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tipo_proyeccion`
-- -------------------------------------------
DROP TABLE IF EXISTS `tipo_proyeccion`;
CREATE TABLE IF NOT EXISTS `tipo_proyeccion` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tipo_relcamacion`
-- -------------------------------------------
DROP TABLE IF EXISTS `tipo_relcamacion`;
CREATE TABLE IF NOT EXISTS `tipo_relcamacion` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tipo_reserva`
-- -------------------------------------------
DROP TABLE IF EXISTS `tipo_reserva`;
CREATE TABLE IF NOT EXISTS `tipo_reserva` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tipo_sancion`
-- -------------------------------------------
DROP TABLE IF EXISTS `tipo_sancion`;
CREATE TABLE IF NOT EXISTS `tipo_sancion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tipo_vehiculo`
-- -------------------------------------------
DROP TABLE IF EXISTS `tipo_vehiculo`;
CREATE TABLE IF NOT EXISTS `tipo_vehiculo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo_vehiculo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tipo_venta`
-- -------------------------------------------
DROP TABLE IF EXISTS `tipo_venta`;
CREATE TABLE IF NOT EXISTS `tipo_venta` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo_venta` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tope`
-- -------------------------------------------
DROP TABLE IF EXISTS `tope`;
CREATE TABLE IF NOT EXISTS `tope` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `Itrimestre` float NOT NULL,
  `IItrimestre` float NOT NULL,
  `IIItrimestre` float NOT NULL,
  `IVtrimestre` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tope_indicador`
-- -------------------------------------------
DROP TABLE IF EXISTS `tope_indicador`;
CREATE TABLE IF NOT EXISTS `tope_indicador` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `valor` varchar(25) NOT NULL,
  `idsentido` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idsentido` (`idsentido`),
  CONSTRAINT `FKsentido` FOREIGN KEY (`idsentido`) REFERENCES `sentido` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `trabajador`
-- -------------------------------------------
DROP TABLE IF EXISTS `trabajador`;
CREATE TABLE IF NOT EXISTS `trabajador` (
  `nombre` varchar(255) NOT NULL,
  `primerApellido` varchar(255) NOT NULL,
  `segundoApellido` varchar(255) NOT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `CI` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `iduser` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iduser` (`iduser`),
  CONSTRAINT `FKuser` FOREIGN KEY (`iduser`) REFERENCES `user` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `trayectoria_estudiantil`
-- -------------------------------------------
DROP TABLE IF EXISTS `trayectoria_estudiantil`;
CREATE TABLE IF NOT EXISTS `trayectoria_estudiantil` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cuadroid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKtrayectori613028` (`cuadroid`),
  CONSTRAINT `FKtrayectori613028` FOREIGN KEY (`cuadroid`) REFERENCES `cuadro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `trayectoria_estudiantil_centro_estudios`
-- -------------------------------------------
DROP TABLE IF EXISTS `trayectoria_estudiantil_centro_estudios`;
CREATE TABLE IF NOT EXISTS `trayectoria_estudiantil_centro_estudios` (
  `trayectoria_estudiantilid` int(10) NOT NULL,
  `centro_estudiosid` int(10) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  PRIMARY KEY (`trayectoria_estudiantilid`,`centro_estudiosid`),
  KEY `FKtrayectori262744` (`trayectoria_estudiantilid`),
  KEY `FKtrayectori30761` (`centro_estudiosid`),
  KEY `FKtrayectori262745` (`trayectoria_estudiantilid`),
  KEY `FKtrayectori30762` (`centro_estudiosid`),
  CONSTRAINT `FKtrayectori262744` FOREIGN KEY (`trayectoria_estudiantilid`) REFERENCES `trayectoria_estudiantil` (`id`),
  CONSTRAINT `FKtrayectori262745` FOREIGN KEY (`trayectoria_estudiantilid`) REFERENCES `trayectoria_estudiantil` (`id`),
  CONSTRAINT `FKtrayectori30761` FOREIGN KEY (`centro_estudiosid`) REFERENCES `centro_estudios` (`id`),
  CONSTRAINT `FKtrayectori30762` FOREIGN KEY (`centro_estudiosid`) REFERENCES `centro_estudios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `trayectoria_laboral`
-- -------------------------------------------
DROP TABLE IF EXISTS `trayectoria_laboral`;
CREATE TABLE IF NOT EXISTS `trayectoria_laboral` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ocupacion` varchar(255) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `motivo_cambio` varchar(1000) DEFAULT NULL,
  `cuadroid` int(10) NOT NULL,
  `centro_trabajo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKtrayectori182184` (`cuadroid`),
  CONSTRAINT `FKtrayectori182184` FOREIGN KEY (`cuadroid`) REFERENCES `cuadro` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `trayectoria_militar`
-- -------------------------------------------
DROP TABLE IF EXISTS `trayectoria_militar`;
CREATE TABLE IF NOT EXISTS `trayectoria_militar` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `grado_militar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `trayectoria_militar_militancia`
-- -------------------------------------------
DROP TABLE IF EXISTS `trayectoria_militar_militancia`;
CREATE TABLE IF NOT EXISTS `trayectoria_militar_militancia` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `trayectoria_militarid` int(10) NOT NULL,
  `militanciaid` int(10) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `fecha_baja` date DEFAULT NULL,
  `causa_baja` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKtrayectori36257` (`militanciaid`),
  KEY `FKtrayectori616761` (`trayectoria_militarid`),
  CONSTRAINT `FKtrayectori36257` FOREIGN KEY (`militanciaid`) REFERENCES `militancia` (`id`),
  CONSTRAINT `FKtrayectori616761` FOREIGN KEY (`trayectoria_militarid`) REFERENCES `trayectoria_militar` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `trazas`
-- -------------------------------------------
DROP TABLE IF EXISTS `trazas`;
CREATE TABLE IF NOT EXISTS `trazas` (
  `IdTraza` int(10) NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(10) NOT NULL,
  `ip` varchar(28) NOT NULL,
  `tarea_realizada` varchar(200) DEFAULT NULL,
  `Tabla_Afectada` varchar(250) DEFAULT NULL,
  `ubicacion` varchar(500) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `id_modificado` varchar(10) NOT NULL,
  `valor_antiguo` text,
  `valor_actual` text,
  PRIMARY KEY (`IdTraza`),
  KEY `FKtrazas901690` (`IdUsuario`),
  CONSTRAINT `FKtrazas901690` FOREIGN KEY (`IdUsuario`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `user`
-- -------------------------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) NOT NULL,
  `trabajadorid` int(10) NOT NULL,
  `direccionid` int(10) DEFAULT NULL,
  `rolid` int(10) DEFAULT NULL,
  `auth_key` varchar(255) NOT NULL,
  `status` int(10) NOT NULL,
  `conectado` int(1) NOT NULL DEFAULT '0',
  `created_at` int(10) NOT NULL,
  `updated_at` int(10) NOT NULL,
  `password write-only password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKDireccion` (`direccionid`),
  KEY `FKRol` (`rolid`),
  KEY `rolid` (`rolid`),
  KEY `direccionid` (`direccionid`),
  KEY `trabajadorid` (`trabajadorid`),
  CONSTRAINT `FKDireccion` FOREIGN KEY (`direccionid`) REFERENCES `direccion` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FKRol` FOREIGN KEY (`rolid`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `utilidad`
-- -------------------------------------------
DROP TABLE IF EXISTS `utilidad`;
CREATE TABLE IF NOT EXISTS `utilidad` (
  `plan` float DEFAULT NULL,
  `vreal` float DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `empresaid` int(10) NOT NULL,
  `real_anterior` varchar(25) NOT NULL,
  `plan_anual` varchar(25) NOT NULL,
  `real_acum_plan` varchar(25) NOT NULL,
  `IPUI` varchar(25) NOT NULL,
  `IRUI` varchar(25) NOT NULL,
  `IPGI` varchar(25) NOT NULL,
  `IRGI` varchar(25) NOT NULL,
  `anexoid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKutilidad901498` (`empresaid`),
  KEY `FKutilidad901499` (`empresaid`),
  CONSTRAINT `FKutilidad901499` FOREIGN KEY (`empresaid`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `utilidadxpeso`
-- -------------------------------------------
DROP TABLE IF EXISTS `utilidadxpeso`;
CREATE TABLE IF NOT EXISTS `utilidadxpeso` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `UPVA_vreal` float DEFAULT NULL,
  `UPVA_plan` float DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `empresaid` int(10) NOT NULL,
  `plan_anterior` double NOT NULL,
  `anexoid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKutiliddadx790306` (`empresaid`),
  KEY `FKutiliddadx790307` (`empresaid`),
  CONSTRAINT `FKutiliddadx790307` FOREIGN KEY (`empresaid`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `valor_agregado`
-- -------------------------------------------
DROP TABLE IF EXISTS `valor_agregado`;
CREATE TABLE IF NOT EXISTS `valor_agregado` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `plan` float DEFAULT NULL,
  `vreal` float DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `empresaid` int(10) NOT NULL,
  `plan_anterior` varchar(25) NOT NULL,
  `anexoid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKvalor_agre2449` (`empresaid`),
  KEY `FKvalor_agre2450` (`empresaid`),
  CONSTRAINT `FKvalor_agre2450` FOREIGN KEY (`empresaid`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `variacion_gastos`
-- -------------------------------------------
DROP TABLE IF EXISTS `variacion_gastos`;
CREATE TABLE IF NOT EXISTS `variacion_gastos` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `empresaid` int(10) NOT NULL,
  `gastosxperdida` varchar(255) DEFAULT NULL,
  `gastosxfaltante` varchar(255) DEFAULT NULL,
  `fecha` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `periodo` varchar(255) NOT NULL,
  `anexoid` varchar(255) NOT NULL DEFAULT 'bnm',
  PRIMARY KEY (`id`),
  KEY `FKvariacion_657729` (`empresaid`),
  KEY `FKvariacion_657730` (`empresaid`),
  CONSTRAINT `FKvariacion_657730` FOREIGN KEY (`empresaid`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `vehiculo`
-- -------------------------------------------
DROP TABLE IF EXISTS `vehiculo`;
CREATE TABLE IF NOT EXISTS `vehiculo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo_vehiculoid` int(10) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `matricula` varchar(255) NOT NULL,
  `cuadroid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKvehiculo890385` (`tipo_vehiculoid`),
  KEY `FKvehiculo744227` (`cuadroid`),
  CONSTRAINT `FKvehiculo744227` FOREIGN KEY (`cuadroid`) REFERENCES `cuadro` (`id`),
  CONSTRAINT `FKvehiculo890385` FOREIGN KEY (`tipo_vehiculoid`) REFERENCES `tipo_vehiculo` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `ventas`
-- -------------------------------------------
DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `plan` varchar(15) DEFAULT NULL,
  `vreal` varchar(15) DEFAULT NULL,
  `productoid` int(10) DEFAULT NULL,
  `tipo_ventaid` int(10) NOT NULL,
  `empresaid` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `anexoid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKventas794153` (`productoid`),
  KEY `FKventas263627` (`tipo_ventaid`),
  KEY `FKventas220435` (`empresaid`),
  KEY `FKventas794154` (`productoid`),
  KEY `FKventas263628` (`tipo_ventaid`),
  KEY `FKventas220436` (`empresaid`),
  CONSTRAINT `FKventas220435` FOREIGN KEY (`empresaid`) REFERENCES `empresa` (`id`),
  CONSTRAINT `FKventas263628` FOREIGN KEY (`tipo_ventaid`) REFERENCES `tipo_venta` (`id`),
  CONSTRAINT `FKventas794153` FOREIGN KEY (`productoid`) REFERENCES `producto` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `viajes_familiares`
-- -------------------------------------------
DROP TABLE IF EXISTS `viajes_familiares`;
CREATE TABLE IF NOT EXISTS `viajes_familiares` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `pais` varchar(255) NOT NULL,
  `familiarid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKviajes_fam543219` (`familiarid`),
  CONSTRAINT `FKviajes_fam543219` FOREIGN KEY (`familiarid`) REFERENCES `familiar` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE DATA anexo
-- -------------------------------------------
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('1','Ventas Liberadas Acumuladas','ventas','frontend\\models\\Ventas','frontend\\models\\VentasSearch');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('2','reclamaciones y demandas interpuestas','reclamaciones','','');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('3','monitoreo de la red','ventas','Ventas','');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('6','Informacion de los laboratorioss','informacion_laboratorios','','');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('7','Analisis de cuentas','cuentas','','');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('8','Variacion de los gastos por perdidas y faltantes ','variacion_gastos','frontend\\models\\VariacionGastos','frontend\\models\\VariacionGastosSearch');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('9','Analisis del Capital de Trabajo ','capital','','');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('10','Ciclos de Cobros y Pagos ','ciclos','','');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('11','Cuentas por Cobrar y Efectividad de Cobro ','cuentas','','');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('12','Cuentas por pagar y Efectividad de Pago','cuentas','','');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('13','Expedientes de Perdidas en Investigacion','perdida_investigacion','','');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('14','Expedientes de Faltantes en Investigacion','perdida_investigacion','','');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('15','Expedientes de Sobrantes en Investigacion','perdida_investigacion','','');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('16','Cumplimiento del Plan de Ventas Netas','ventas','','');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('17','Cumplimiento de los Impuestos ','impuesto','','');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('18','Utilidad, Indice de Utilidad y Gasto por peso de ingreso','utilidad','','');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('19','Valor Agregado Bruto ','valor_agregado','','');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('20','Productividad y Correlacion Salario Medio-Productividad','productividad','','');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('21','Gasto de Salario por peso de VAB','fondo_salario','','');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('22','Utilidad por peso de Valor Agregado Bruto','utilidadxpeso','','');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('23','Analisis Perdida Comedor ','comedor','','');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('24','Analisis de Inventarios de Ociosos y Lento Movimiento','inventario','','');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('25','Indice de Utilizacion del fondo de Tiempo','fondo_tiempo','','');
INSERT INTO `anexo` (`id`,`anexo`,`tabla`,`modelo`,`searchmodel`) VALUES
('26','otros','','','');



-- -------------------------------------------
-- TABLE DATA armas
-- -------------------------------------------
INSERT INTO `armas` (`id`,`tipo_armaid`,`marca`,`modelo`,`no_licencia`,`tipo`,`cuadroid`) VALUES
('1','2','makarov','49','tl-45863','','34');
INSERT INTO `armas` (`id`,`tipo_armaid`,`marca`,`modelo`,`no_licencia`,`tipo`,`cuadroid`) VALUES
('2','1','AK','25lk','tl-1565','','34');
INSERT INTO `armas` (`id`,`tipo_armaid`,`marca`,`modelo`,`no_licencia`,`tipo`,`cuadroid`) VALUES
('45','1','ws','3','323','2','79');
INSERT INTO `armas` (`id`,`tipo_armaid`,`marca`,`modelo`,`no_licencia`,`tipo`,`cuadroid`) VALUES
('46','1','ws','3','323','2','81');
INSERT INTO `armas` (`id`,`tipo_armaid`,`marca`,`modelo`,`no_licencia`,`tipo`,`cuadroid`) VALUES
('52','1','ws','3','323','2','87');
INSERT INTO `armas` (`id`,`tipo_armaid`,`marca`,`modelo`,`no_licencia`,`tipo`,`cuadroid`) VALUES
('53','1','ws','3','323','2','1');
INSERT INTO `armas` (`id`,`tipo_armaid`,`marca`,`modelo`,`no_licencia`,`tipo`,`cuadroid`) VALUES
('54','2','AK','25lk','tl-1565','1','1');
INSERT INTO `armas` (`id`,`tipo_armaid`,`marca`,`modelo`,`no_licencia`,`tipo`,`cuadroid`) VALUES
('56','1','ws','3','323','2','4');
INSERT INTO `armas` (`id`,`tipo_armaid`,`marca`,`modelo`,`no_licencia`,`tipo`,`cuadroid`) VALUES
('57','2','ASL-215','Rifle','LA-39851','Arma de Asalto','87');
INSERT INTO `armas` (`id`,`tipo_armaid`,`marca`,`modelo`,`no_licencia`,`tipo`,`cuadroid`) VALUES
('58','1','makarov','mk-230','LA-565646','revolver','5');
INSERT INTO `armas` (`id`,`tipo_armaid`,`marca`,`modelo`,`no_licencia`,`tipo`,`cuadroid`) VALUES
('65','1','2','2','2','2','84');
INSERT INTO `armas` (`id`,`tipo_armaid`,`marca`,`modelo`,`no_licencia`,`tipo`,`cuadroid`) VALUES
('66','2','1','1','1','1','84');
INSERT INTO `armas` (`id`,`tipo_armaid`,`marca`,`modelo`,`no_licencia`,`tipo`,`cuadroid`) VALUES
('67','1','2','1','2','1','84');



-- -------------------------------------------
-- TABLE DATA auth_assignment
-- -------------------------------------------
INSERT INTO `auth_assignment` (`item_name`,`user_id`,`created_at`) VALUES
('cargar_BD','29','1606405304');
INSERT INTO `auth_assignment` (`item_name`,`user_id`,`created_at`) VALUES
('SiteAdmin','7','1606403542');



-- -------------------------------------------
-- TABLE DATA auth_item
-- -------------------------------------------
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('cargar_BD','2','El usuario que posea este permiso podra cargar la base desde un archivo guardado previamente','','','1606404017','1606405426');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('Crear_indicador','2','El usuario puede crear un indicador de Gestion','','','1606403096','1606405395');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('Eliminar indicador','2','El usuario que posea este permiso puede elliminar el indicador de gestion seleccionado','','','1606403262','1606403262');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('eliminar_BD','2','El usuario que posea este permiso podra eliminar una copia de la Base de Datos','','','1606405738','1606405738');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('Gestionar Indicadores','2','El usuario que possea este permiso podra crear, modificar y eliminar los indicadores de gestion','','','1606403369','1606403369');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('gestionar_BD','2','El usuario que posea este permiso podra crear salvas de la base de datos y cargar la base de datos desde un archivo','','','1606404403','1606404918');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('guardar_BD','2','El usuario que posea este permiso podra crear salvas de  la base de datos del sistema','','','1606403955','1606405544');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('Modificar Indicador','2','El usuario que posea este permiso puede modificar los datos de los indicadores de gestión','','','1606403189','1606403189');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('SiteAdmin','1','Tiene permisos de administracion sobre la aplicación','','','1606395812','1606395812');



-- -------------------------------------------
-- TABLE DATA auth_item_child
-- -------------------------------------------
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('Gestionar Indicadores','Crear_indicador');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('Gestionar Indicadores','Eliminar indicador');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('Gestionar Indicadores','Modificar Indicador');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('gestionar_BD','cargar_BD');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('gestionar_BD','guardar_BD');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('SiteAdmin','gestionar_BD');



-- -------------------------------------------
-- TABLE DATA calificacion
-- -------------------------------------------
INSERT INTO `calificacion` (`id`,`calificacion`) VALUES
('1','MB');
INSERT INTO `calificacion` (`id`,`calificacion`) VALUES
('2','B');
INSERT INTO `calificacion` (`id`,`calificacion`) VALUES
('3','R');
INSERT INTO `calificacion` (`id`,`calificacion`) VALUES
('4','M');
INSERT INTO `calificacion` (`id`,`calificacion`) VALUES
('5','NE');



-- -------------------------------------------
-- TABLE DATA capital
-- -------------------------------------------
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('1','4','68639.5','53146.1','232.1','15000','11','2019-07-31','0');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('2','4','69641.2','155985','94944.2','9440.3','12','2019-07-31','0');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('3','4','81759.4','65043.9','185.1','0','13','2019-07-31','0');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('4','4','78511.3','143626.5','6530','84085.2','14','2019-07-31','0');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('5','4','81283.3','111432.6','22876.7','0','15','2019-07-31','0');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('6','4','91474.8','98488.4','13844.7','7720.8','17','2019-07-31','0');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('7','4','124201.3','137378.3','0','24000','16','2019-07-31','0');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('8','4','71262.8','102343.4','37901.1','42177.3','18','2019-07-31','0');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('9','4','58250.9','112432.3','25359.2','19664.1','19','2019-07-31','0');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('10','4','82585','103805.1','34177.6','0','20','2019-07-31','0');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('11','4','59406.4','50529.5','13','2400','21','2019-07-31','0');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('12','4','96216.5','74451.9','0','20157.4','22','2019-07-31','0');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('13','4','77476.7','172407.8','103852.1','16250','23','2019-07-31','0');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('14','4','339525.4','606104.7','168780.7','267376','24','2019-07-31','0');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('15','4','134419.6','141396.3','2959.6','20000','25','2019-07-31','0');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('16','4','19697.2','34970.3','20356.2','0','26','2019-07-31','0');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('17','4','313223.1','359381.6','22373.3','28626.9','27','2019-07-31','0');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('18','4','53700.4','109645.7','38702.1','31459','28','2019-07-31','0');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('19','4','40877.7','4683.4','1065.6','0','29','2019-07-31','0');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('20','4','671476.4','878431.5','582.6','0','30','2019-07-31','0');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('21','4','12596.8','4321','0','0','31','2019-07-31','0');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('22','5','68639.5','53146.1','232.1','15000','11','2019-07-31','1');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('23','5','69641.2','155985','94944.2','9440.3','12','2019-07-31','1');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('24','5','81759.4','65043.9','185.1','0','13','2019-07-31','1');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('25','5','78511.3','143626.5','6530','84085.2','14','2019-07-31','1');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('26','5','81283.3','111432.6','22876.7','0','15','2019-07-31','1');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('27','5','91474.8','98488.4','13844.7','7720.8','17','2019-07-31','1');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('28','5','124201.3','137378.3','0','24000','16','2019-07-31','1');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('29','5','71262.8','102343.4','37901.1','42177.3','18','2019-07-31','1');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('30','5','58250.9','112432.3','25359.2','19664.1','19','2019-07-31','1');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('31','5','82585','103805.1','34177.6','0','20','2019-07-31','1');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('32','5','59406.4','50529.5','13','2400','21','2019-07-31','1');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('33','5','96216.5','74451.9','0','20157.4','22','2019-07-31','1');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('34','5','77476.7','172407.8','103852.1','16250','23','2019-07-31','1');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('35','5','339525.4','606104.7','168780.7','267376','24','2019-07-31','1');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('36','5','134419.6','141396.3','2959.6','20000','25','2019-07-31','1');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('37','5','19697.2','34970.3','20356.2','0','26','2019-07-31','1');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('38','5','313223.1','359381.6','22373.3','28626.9','27','2019-07-31','1');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('39','5','53700.4','109645.7','38702.1','31459','28','2019-07-31','1');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('40','5','40877.7','4683.4','1065.6','0','29','2019-07-31','1');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('41','5','671476.4','878431.5','582.6','0','30','2019-07-31','1');
INSERT INTO `capital` (`id`,`anexoid`,`activo_circulante`,`pasivo_circulante`,`Suma`,`creditos_bancarios`,`empresaid`,`fecha`,`status`) VALUES
('42','5','12596.8','4321','0','0','31','2019-07-31','1');



-- -------------------------------------------
-- TABLE DATA cargo
-- -------------------------------------------
INSERT INTO `cargo` (`id`,`cargo`,`salario`) VALUES
('231','Entrenador ','1256');
INSERT INTO `cargo` (`id`,`cargo`,`salario`) VALUES
('246','I+D','375');
INSERT INTO `cargo` (`id`,`cargo`,`salario`) VALUES
('266','I+D','375');
INSERT INTO `cargo` (`id`,`cargo`,`salario`) VALUES
('268','comunity manager','4578');
INSERT INTO `cargo` (`id`,`cargo`,`salario`) VALUES
('271','ingeniero de sistemas','4578');
INSERT INTO `cargo` (`id`,`cargo`,`salario`) VALUES
('275','I+D','4253');
INSERT INTO `cargo` (`id`,`cargo`,`salario`) VALUES
('276','I+D','4253');
INSERT INTO `cargo` (`id`,`cargo`,`salario`) VALUES
('281','dependiente','633');
INSERT INTO `cargo` (`id`,`cargo`,`salario`) VALUES
('290','dependiente','633');



-- -------------------------------------------
-- TABLE DATA cargos_direccion
-- -------------------------------------------
INSERT INTO `cargos_direccion` (`id`,`tipo`,`status`) VALUES
('1','Administrador','0');
INSERT INTO `cargos_direccion` (`id`,`tipo`,`status`) VALUES
('2','Gerente','1');
INSERT INTO `cargos_direccion` (`id`,`tipo`,`status`) VALUES
('3','Jefe De Seguridad','1');
INSERT INTO `cargos_direccion` (`id`,`tipo`,`status`) VALUES
('4','Directivo','0');
INSERT INTO `cargos_direccion` (`id`,`tipo`,`status`) VALUES
('5','Ejecutivo','1');
INSERT INTO `cargos_direccion` (`id`,`tipo`,`status`) VALUES
('6','Directivo Superior','1');



-- -------------------------------------------
-- TABLE DATA categoria_docente
-- -------------------------------------------
INSERT INTO `categoria_docente` (`id`,`tipo`) VALUES
('0','Ninguno');
INSERT INTO `categoria_docente` (`id`,`tipo`) VALUES
('1','Profesor Titular');
INSERT INTO `categoria_docente` (`id`,`tipo`) VALUES
('2','Profesor Auxialiar');



-- -------------------------------------------
-- TABLE DATA centro_estudios
-- -------------------------------------------
INSERT INTO `centro_estudios` (`id`,`centro`,`municipioid`,`provinciaid`) VALUES
('1','Escuela Tecnica Minero-Metalurgica','3','2');
INSERT INTO `centro_estudios` (`id`,`centro`,`municipioid`,`provinciaid`) VALUES
('3','Escuela Tecnica Minero-Metalurgica','3','2');
INSERT INTO `centro_estudios` (`id`,`centro`,`municipioid`,`provinciaid`) VALUES
('4','Escuela Tecnica Minero-Metalurgica de artemisa','3','2');
INSERT INTO `centro_estudios` (`id`,`centro`,`municipioid`,`provinciaid`) VALUES
('6','CUJAE','5','15');
INSERT INTO `centro_estudios` (`id`,`centro`,`municipioid`,`provinciaid`) VALUES
('10','Escuela Tecnica Minero-Metalurgica','4','12');
INSERT INTO `centro_estudios` (`id`,`centro`,`municipioid`,`provinciaid`) VALUES
('11','ENFA','31','4');
INSERT INTO `centro_estudios` (`id`,`centro`,`municipioid`,`provinciaid`) VALUES
('12','ENFos','4','11');
INSERT INTO `centro_estudios` (`id`,`centro`,`municipioid`,`provinciaid`) VALUES
('13','Formatur','2','10');
INSERT INTO `centro_estudios` (`id`,`centro`,`municipioid`,`provinciaid`) VALUES
('16','Tecnológico Villena-revolucion','24','4');
INSERT INTO `centro_estudios` (`id`,`centro`,`municipioid`,`provinciaid`) VALUES
('31','CUJAE','2','15');
INSERT INTO `centro_estudios` (`id`,`centro`,`municipioid`,`provinciaid`) VALUES
('51','CUJAE','2','15');
INSERT INTO `centro_estudios` (`id`,`centro`,`municipioid`,`provinciaid`) VALUES
('52','CUJAE','2','10');
INSERT INTO `centro_estudios` (`id`,`centro`,`municipioid`,`provinciaid`) VALUES
('55','CUJAE','33','4');
INSERT INTO `centro_estudios` (`id`,`centro`,`municipioid`,`provinciaid`) VALUES
('57','Escuela Tecnica Minero-Metalurgica','3','6');
INSERT INTO `centro_estudios` (`id`,`centro`,`municipioid`,`provinciaid`) VALUES
('58','Escuela Tecnica Minero-Metalurgica','3','6');
INSERT INTO `centro_estudios` (`id`,`centro`,`municipioid`,`provinciaid`) VALUES
('59','Escuela Tecnica Minero-Metalurgica','6','15');
INSERT INTO `centro_estudios` (`id`,`centro`,`municipioid`,`provinciaid`) VALUES
('66','Escuela Tecnica Minero-Metalurgica','4','10');



-- -------------------------------------------
-- TABLE DATA centro_trabajo
-- -------------------------------------------
INSERT INTO `centro_trabajo` (`id`,`centro`,`direccionesid`,`telefono`,`email`,`idorganismo`) VALUES
('101','Centro de entrenamiento de Rescate y salvamento ','379','64732567','','2');
INSERT INTO `centro_trabajo` (`id`,`centro`,`direccionesid`,`telefono`,`email`,`idorganismo`) VALUES
('116','Aduana Aeropuerto Internacional Jose Marti','409','76201546','cccc@cimex.cu','5');
INSERT INTO `centro_trabajo` (`id`,`centro`,`direccionesid`,`telefono`,`email`,`idorganismo`) VALUES
('136','Aduana Aeropuerto Internacional Jose Marti','449','76201546','cccc@cimex.cu','5');
INSERT INTO `centro_trabajo` (`id`,`centro`,`direccionesid`,`telefono`,`email`,`idorganismo`) VALUES
('138','OSDE GA','452','12365478','sistem@samsung.com','2');
INSERT INTO `centro_trabajo` (`id`,`centro`,`direccionesid`,`telefono`,`email`,`idorganismo`) VALUES
('141','Hospital Docente Julito Diaz','458','7589632','aduana@agr.cu','3');
INSERT INTO `centro_trabajo` (`id`,`centro`,`direccionesid`,`telefono`,`email`,`idorganismo`) VALUES
('145','Muelle julito Dias','464','7896656565656','aduana@agr.cu','6');
INSERT INTO `centro_trabajo` (`id`,`centro`,`direccionesid`,`telefono`,`email`,`idorganismo`) VALUES
('146','Muelle julito Dias','466','7896656565656','aduana@agr.cu','6');
INSERT INTO `centro_trabajo` (`id`,`centro`,`direccionesid`,`telefono`,`email`,`idorganismo`) VALUES
('151','Aduana Aeropuerto Internacional Jose Marti','472','666-666-6666','ada@agr.cu','5');
INSERT INTO `centro_trabajo` (`id`,`centro`,`direccionesid`,`telefono`,`email`,`idorganismo`) VALUES
('160','Aduana Aeropuerto Internacional Jose Marti','488','666-666-6666','ada@agr.cu','5');



-- -------------------------------------------
-- TABLE DATA condecoraciones
-- -------------------------------------------
INSERT INTO `condecoraciones` (`id`,`nombre`,`fecha`,`cuadroid`) VALUES
('9','Condecoracion por la obra de la vida','2020-09-07','84');
INSERT INTO `condecoraciones` (`id`,`nombre`,`fecha`,`cuadroid`) VALUES
('10','Jovenes por la vida','2020-08-13','44');
INSERT INTO `condecoraciones` (`id`,`nombre`,`fecha`,`cuadroid`) VALUES
('11','jovenes por la vida','2020-08-06','96');
INSERT INTO `condecoraciones` (`id`,`nombre`,`fecha`,`cuadroid`) VALUES
('12','jovenes por la vida','2020-08-06','96');
INSERT INTO `condecoraciones` (`id`,`nombre`,`fecha`,`cuadroid`) VALUES
('13','jovenes por la vida','2020-08-06','96');
INSERT INTO `condecoraciones` (`id`,`nombre`,`fecha`,`cuadroid`) VALUES
('14','jovenes por la vida','2020-08-06','96');
INSERT INTO `condecoraciones` (`id`,`nombre`,`fecha`,`cuadroid`) VALUES
('15','jovenes por la vida','2020-08-06','96');
INSERT INTO `condecoraciones` (`id`,`nombre`,`fecha`,`cuadroid`) VALUES
('16','jovenes por la vida','2020-08-06','96');



-- -------------------------------------------
-- TABLE DATA confecionado
-- -------------------------------------------
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('1','Juan Garcia','4');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('2','Pedro Suarez','5');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('3','Omar Linares','6');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('4','Omar Linares','6');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('5','Omar Linares','6');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('6','Omar Linares','6');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('7','Omar Vali','5');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('8','Omar Vali','5');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('9','Omar Vali','5');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('10','Omar Vali','5');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('11','Omar Vali','5');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('12','Omar Vali','5');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('13','Omar Vali','5');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('14','Omar Vali','5');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('15','Omar Vali','5');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('16','Omar Vali','5');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('17','Omar Vali','5');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('18','Omar Vali','5');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('19','Omar Vali','5');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('20','Omar Vali','5');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('21','Omar Vali','5');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('22','Omar Vali','5');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('23','Juan carbo','2');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('24','Juan carbo','2');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('25','Juan carbo','2');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('26','Juan carbo','2');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('27','jirge alir','5');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('28','Omar Linares','2');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('29','Omar Linares','2');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('30','Rosa ','4');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('31','Rosa ','4');
INSERT INTO `confecionado` (`id`,`Nombre`,`idcargo`) VALUES
('32','evaluador Garcia','6');



-- -------------------------------------------
-- TABLE DATA control_usuario
-- -------------------------------------------
INSERT INTO `control_usuario` (`id`,`userid`,`preg_1`,`preg_2`,`preg_3`,`preg_4`,`preg_5`,`resp_1`,`resp_2`,`resp_3`,`resp_4`,`resp_5`) VALUES
('1','3','Cual es su numero de telefono','como se llama su perro','Equipo de futbol','Pais Preferido','juego Preferido','55007156','yiyi','Real Madrid','españa','zuma');
INSERT INTO `control_usuario` (`id`,`userid`,`preg_1`,`preg_2`,`preg_3`,`preg_4`,`preg_5`,`resp_1`,`resp_2`,`resp_3`,`resp_4`,`resp_5`) VALUES
('2','21','Cual es su numero de telefono','como se llama su perro','Equipo de futbol','Pais Preferido','juego Preferido','55007156','yiyi','Real Madrid','españa','fifa');
INSERT INTO `control_usuario` (`id`,`userid`,`preg_1`,`preg_2`,`preg_3`,`preg_4`,`preg_5`,`resp_1`,`resp_2`,`resp_3`,`resp_4`,`resp_5`) VALUES
('3','22','Direccion a la que pertenece','edad','mes','hora','dia','auditoria','13','diciembre','11','7');
INSERT INTO `control_usuario` (`id`,`userid`,`preg_1`,`preg_2`,`preg_3`,`preg_4`,`preg_5`,`resp_1`,`resp_2`,`resp_3`,`resp_4`,`resp_5`) VALUES
('4','23','omar','omares','omar','omar','omar','omar','omares','omar','omar','omar');



-- -------------------------------------------
-- TABLE DATA criteriomedida
-- -------------------------------------------
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('1','1','Ejecutado el 100% de las acciones previstas para el año dentro del programa integral para la formación de competencias en cuadros, reservas y funcionarios.','%','1','1','2','1','1','1');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('2','2','Ejecutado el 100% de las acciones previstas para el año dentro del programa para la atención a jóvenes talentos motivados en la dirección y gestión de organizaciones empresariales.','%','1','1','2','2','1','1');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('3','3','Evaluado el nivel de vida del 100% de los cuadros, funcionarios y designados.','%','1','1','2','3','1','1');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('4','4','Incrementado el potencial de directivos listos para promover.','%','1','1','2','4','1','1');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('5','5','Ejecutado el 100% de las acciones de control integrales a las empresas.','%','1','1','2','5','1','1');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('6','6','Cumplidos los indicadores claves de rendimiento del Sistema de Trabajo con los Cuadros y sus Reservas.','%','1','1','2','6','1','1');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('7','1','Ejecutado el 100% de las acciones previstas para el año dentro del programa de formación de competencias laborales, asociados a la operación de cadena de suministro.','%','1','2','3','7','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('8','2','Elaborado los procedimientos para la capacitación y formación del personal basado en competencias.','%','0','2','3','8','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('9','3','Ejecutado el 100% de las acciones previstas en el programa para la implantación del sistema de gestión de seguridad y salud en el trabajo.','%','1','2','3','9','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('10','4','Revisados y validados el 100% de los sistemas de pagos usados en el sistema empresarial.','%','1','2','3','10','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('11','5','Controlada la ejecución y efectividad del presupuesto para medios de protección individual en todas las empresas del grupo.','%','1','2','3','11','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('12','6','Ejecutado las acciones previstas en el programa de atención al Hombre.','%','1','2','3','12','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('13','1','Ejecutado el 100% de las acciones previstas para el año dentro del programa de informatización de la gestión de la comercialización de alimentos.','%','1','3','6','13','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('14','2','Ejecutadas las acciones de control al cumplimiento del plan aprovisionamiento y ventas a cooperativas, arrendados y TCP.','%','1','3','6','14','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('15','3','Ejecutadas las acciones de monitoreo a la presencia de productos elegidos en el mercado liberado de todas las provincias.','%','1','3','6','15','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('16','4','Realizado el estudio de demandas en todas las empresas del grupo.','UNO','1','3','6','16','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('17','5','Lograda la conciliación del 100% de los contratos comerciales firmados, contra sus ejecuciones y los ingresos que de ellos se esperan alcanzar. ','%','1','3','6','17','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('18','6','Certificado la implementación en el sistema empresarial del procedimiento de la contratación económica adaptado a los principios de la cadena de suministro.','Certificado por Empresa','1','3','6','18','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('19','7','Ejecutadas las acciones de control y regulación para el aseguramiento de la calidad del 100% de las mercancías. ','%','1','3','6','19','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('20','1','Ejecutado el 100% de las acciones previstas para el año dentro del programa de recuperación del capital financiero en todas las empresas del GA.','%','0','4','12','20','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('21','2','Ejecutadas las acciones de control a la reducción de los gastos malos y las cuentas por cobrar en el 100% de las empresas del grupo.','%','0','4','12','21','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('22','3','Ejecutadas las acciones de control para eliminar el déficit de capital de trabajo en la totalidad de las empresas del grupo.','%','0','4','12','22','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('23','4','Ejecutadas las acciones de control y regulación para el cumplimiento de los indicadores del plan de la economía.','%','0','4','12','23','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('24','5','Evaluada la calidad de los estados financieros en todas la empresas del grupo.','Empresa','0','4','12','24','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('25','6','Ejecutadas las acciones para la introducción de la contabilidad de gestión en las empresas seleccionadas.','%','0','4','12','25','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('26','7','Ejecutadas las acciones para lograr el planificación digital dentro del procedimiento de planificación anual.','%','0','4','12','26','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('27','1','Ejecutado el 100% de las acciones previstas para el año dentro del programa para el incremento de categorización de los almacenes mayoristas.','%','1','5','10','27','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('28','2','Incrementada la categorización en al menos dos almacenes por empresas mayoristas.','UNO','1','5','10','28','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('29','3','Logrado al menos una estructura Mercabal en cada provincia.','UNO','1','5','10','29','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('30','4','Identificadas y controladas todas las acciones de mejoramiento de la imagen de almacenes, bases de aceite y salas de máquina.','%','1','5','10','30','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('31','5','Ejecutada la inversión planificada para el incremento de las capacidades de aceite comestible.','%','1','5','10','31','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('32','6','Cumplidas las acciones de control planificadas a la actividad de Normalización y metrología.','%','1','5','10','32','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('33','7','Lograda la disponibilidad técnica de equipos y medios de informática, que demanda la comercialización mayorista.','%','1','5','10','33','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('34','8','Evaluado el cumplimiento de las políticas para el uso de las TIC. ','Certificado por Empresa','1','5','10','34','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('35','1','Ejecutado el 100% de las acciones previstas para el año dentro del programa para la implementación de la gestión de la calidad total en el sistema empresarial que integra la OSDE.','%','1','6','9','35','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('36','2','Ejecutado el 100% de las acciones previstas para el año dentro del programa para el desarrollo de nuevos negocios, la inversión estratégica y la colaboración internacional.','%','1','6','9','36','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('37','3','Cumplido en su totalidad el plan de acciones estratégicas del año.','%','1','6','9','37','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('38','4','Cumplida en su totalidad la estrategia de informatización de la OSDE.','%','1','6','9','38','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('39','5','Evaluado el 100% de las propuestas de diagnósticos y expedientes de perfeccionamiento que presenten las empresas del grupo.','%','1','6','9','39','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('40','6','Implementado el Manual de Procedimientos para la gestión y dirección de la cadena de suministro.','%','1','6','9','40','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('41','7','Aplicadas soluciones innovadoras al banco de problemas y programas para el desarrollo.','%','1','6','9','41','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('42','8','Análisis del cumplimiento de los objetivos de trabajo del año.','%','1','6','9','42','1','1');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('43','1','Ejecutado el 100% de las acciones previstas para el año dentro del programa para el desarrollo técnico del sistema de protección física y seguridad de la información.','%','1','7','5','43','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('44','2','Certificado el sistema de la seguridad y protección en las empresas.','UNO','1','7','5','44','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('45','3','Ejecutado el 100% de las acciones planificadas para el desarrollo técnico del sistema de protección física y seguridad e encriptación de la información.','%','1','7','5','45','1','1');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('46','4','Ejecutadas las acciones para implementar el sistema de vigilancia tecnológica necesario a la EMPA Habana.','%','1','7','5','46','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('47','5','Certificado el cumplimiento de la normas de seguridad informática en el sistema empresarial.','UNO','1','7','5','47','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('48','6','Incrementado el número de las empresas con potencial para certificar la contabilidad.','UNO','1','7','5','48','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('49','7','Ejecutadas las auditorías financieras en empresas con potencialidades.','UNO','1','7','5','49','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('50','8','Ejecutada la auditoría de cumplimiento en empresas designadas.','UNO','1','7','5','50','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('51','9','Lograda la habilitación de al menos 10 auditores.','UNO','1','7','5','51','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('52','10','Logrado que los presuntos hechos delictivos y de corrupción sean detectados por el SCI.','%','1','7','5','52','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('53','11','Logrado el ambiente de control y gestión y prevención de riesgo en el sistema empresarial.','%','1','7','5','53','1','0');
INSERT INTO `criteriomedida` (`id`,`orden`,`Descripcion`,`UM`,`status`,`Objetivoid`,`direccionid`,`topeid`,`editable`,`evaluado`) VALUES
('54','12','Cumplidas el plan Integrado de las Acciones de Control.','%','1','7','5','54','1','0');



-- -------------------------------------------
-- TABLE DATA cuadro
-- -------------------------------------------
INSERT INTO `cuadro` (`id`,`personaCI`,`Lugar_nacimiento`,`provinciaid`,`ciudadania`,`color_piel`,`color_ojos`,`color_pelo`,`estatura`,`peso`,`telefono`,`email`,`preparacion_intelectualid`,`centro_trabajoid`,`cargoid`,`fecha_inicio_cargo`,`trayectoria_militarid`,`ubicacion_tiempo_guerra`,`foto`,`vehiculo`,`arma`,`ingresos_monetarios`,`beneficio_ingreso`,`reserva_cuadro`,`saludid`,`status`) VALUES
('44','78110976543','4','6','Cubana','1','Negros','Negro','189','82','567891234','Santiesteban@nauta.cu','101','101','231','1998-07-22','0','BPD','uploads/cuadros/fotos/78110976543.jpg','0','0','0','0','1','226','1');
INSERT INTO `cuadro` (`id`,`personaCI`,`Lugar_nacimiento`,`provinciaid`,`ciudadania`,`color_piel`,`color_ojos`,`color_pelo`,`estatura`,`peso`,`telefono`,`email`,`preparacion_intelectualid`,`centro_trabajoid`,`cargoid`,`fecha_inicio_cargo`,`trayectoria_militarid`,`ubicacion_tiempo_guerra`,`foto`,`vehiculo`,`arma`,`ingresos_monetarios`,`beneficio_ingreso`,`reserva_cuadro`,`saludid`,`status`) VALUES
('59','65457895656','4','9','espanola','0','azules','negro','178','78','349856546546566','garmendia@hotmail.es','116','116','246','2020-09-24','15','UM-23','uploads/cuadros/fotos/65457895656.jpg','0','0','0','0','1','241','1');
INSERT INTO `cuadro` (`id`,`personaCI`,`Lugar_nacimiento`,`provinciaid`,`ciudadania`,`color_piel`,`color_ojos`,`color_pelo`,`estatura`,`peso`,`telefono`,`email`,`preparacion_intelectualid`,`centro_trabajoid`,`cargoid`,`fecha_inicio_cargo`,`trayectoria_militarid`,`ubicacion_tiempo_guerra`,`foto`,`vehiculo`,`arma`,`ingresos_monetarios`,`beneficio_ingreso`,`reserva_cuadro`,`saludid`,`status`) VALUES
('79','65457895465','4','9','espanola','0','azules','negro','178','78','349856546546566','garmendia@hotmail.es','136','136','266','2020-09-24','0','UM-23','uploads/cuadros/fotos/65457895465.jpg','0','0','0','0','1','261','1');
INSERT INTO `cuadro` (`id`,`personaCI`,`Lugar_nacimiento`,`provinciaid`,`ciudadania`,`color_piel`,`color_ojos`,`color_pelo`,`estatura`,`peso`,`telefono`,`email`,`preparacion_intelectualid`,`centro_trabajoid`,`cargoid`,`fecha_inicio_cargo`,`trayectoria_militarid`,`ubicacion_tiempo_guerra`,`foto`,`vehiculo`,`arma`,`ingresos_monetarios`,`beneficio_ingreso`,`reserva_cuadro`,`saludid`,`status`) VALUES
('81','25479666565','5','12','cubana','0','N','C','179','86','536987878787','JRC@gmail.cu','138','138','268','2020-09-16','0','UM-6548','uploads/cuadros/fotos/25479666565.jpg','0','0','0','0','1','263','1');
INSERT INTO `cuadro` (`id`,`personaCI`,`Lugar_nacimiento`,`provinciaid`,`ciudadania`,`color_piel`,`color_ojos`,`color_pelo`,`estatura`,`peso`,`telefono`,`email`,`preparacion_intelectualid`,`centro_trabajoid`,`cargoid`,`fecha_inicio_cargo`,`trayectoria_militarid`,`ubicacion_tiempo_guerra`,`foto`,`vehiculo`,`arma`,`ingresos_monetarios`,`beneficio_ingreso`,`reserva_cuadro`,`saludid`,`status`) VALUES
('84','78123165498','4','15','cubano','3','c','c','165','68','55007156','MCValdes@nauta.cu','141','141','271','2020-09-24','16','TGC','uploads/cuadros/fotos/78123165498.jpg','0','0','0','0','1','266','0');
INSERT INTO `cuadro` (`id`,`personaCI`,`Lugar_nacimiento`,`provinciaid`,`ciudadania`,`color_piel`,`color_ojos`,`color_pelo`,`estatura`,`peso`,`telefono`,`email`,`preparacion_intelectualid`,`centro_trabajoid`,`cargoid`,`fecha_inicio_cargo`,`trayectoria_militarid`,`ubicacion_tiempo_guerra`,`foto`,`vehiculo`,`arma`,`ingresos_monetarios`,`beneficio_ingreso`,`reserva_cuadro`,`saludid`,`status`) VALUES
('87','56896226353','3','9','cubana','1','N','N','189','86','565465565656656456565645656565656','ndskjksjsd','145','145','275','2020-05-11','0','NMJ','uploads/cuadros/fotos/56896226353.jpg','0','0','0','0','1','270','0');
INSERT INTO `cuadro` (`id`,`personaCI`,`Lugar_nacimiento`,`provinciaid`,`ciudadania`,`color_piel`,`color_ojos`,`color_pelo`,`estatura`,`peso`,`telefono`,`email`,`preparacion_intelectualid`,`centro_trabajoid`,`cargoid`,`fecha_inicio_cargo`,`trayectoria_militarid`,`ubicacion_tiempo_guerra`,`foto`,`vehiculo`,`arma`,`ingresos_monetarios`,`beneficio_ingreso`,`reserva_cuadro`,`saludid`,`status`) VALUES
('88','56896226313','3','9','cubana','1','N','N','189','86','565465565656656456565645656565656','ndskjksjsd','146','146','276','2020-05-11','0','NMJ','uploads/cuadros/fotos/56896226313.jpg','0','0','0','0','1','271','1');
INSERT INTO `cuadro` (`id`,`personaCI`,`Lugar_nacimiento`,`provinciaid`,`ciudadania`,`color_piel`,`color_ojos`,`color_pelo`,`estatura`,`peso`,`telefono`,`email`,`preparacion_intelectualid`,`centro_trabajoid`,`cargoid`,`fecha_inicio_cargo`,`trayectoria_militarid`,`ubicacion_tiempo_guerra`,`foto`,`vehiculo`,`arma`,`ingresos_monetarios`,`beneficio_ingreso`,`reserva_cuadro`,`saludid`,`status`) VALUES
('89','12120265645','2','9','cubana','1','pardos','castaño','180','100','565-555-5555','neilin.pons@gmail.con','151','151','281','2020-08-26','0','UM-23','uploads/cuadros/fotos/12120265645.jpg','0','0','0','0','1','276','1');
INSERT INTO `cuadro` (`id`,`personaCI`,`Lugar_nacimiento`,`provinciaid`,`ciudadania`,`color_piel`,`color_ojos`,`color_pelo`,`estatura`,`peso`,`telefono`,`email`,`preparacion_intelectualid`,`centro_trabajoid`,`cargoid`,`fecha_inicio_cargo`,`trayectoria_militarid`,`ubicacion_tiempo_guerra`,`foto`,`vehiculo`,`arma`,`ingresos_monetarios`,`beneficio_ingreso`,`reserva_cuadro`,`saludid`,`status`) VALUES
('96','12121565689','2','9','cubana','1','pardos','castaño','180','100','565-555-5555','neilin.pons@gmail.con','160','160','290','2020-08-26','0','UM-23','uploads/cuadros/fotos/12121565689.jpg','0','0','0','0','1','285','0');



-- -------------------------------------------
-- TABLE DATA cuadro_escuela_politica
-- -------------------------------------------
INSERT INTO `cuadro_escuela_politica` (`id`,`cuadroid`,`escuela_politicaid`,`curso`,`fecha`) VALUES
('10','81','3','gestion de cuadros','2020-09-09');
INSERT INTO `cuadro_escuela_politica` (`id`,`cuadroid`,`escuela_politicaid`,`curso`,`fecha`) VALUES
('11','81','3','cuadro de mando','2023-08-10');
INSERT INTO `cuadro_escuela_politica` (`id`,`cuadroid`,`escuela_politicaid`,`curso`,`fecha`) VALUES
('18','84','3','superacion integral','2020-10-01');
INSERT INTO `cuadro_escuela_politica` (`id`,`cuadroid`,`escuela_politicaid`,`curso`,`fecha`) VALUES
('19','84','4','tecnicas de direccion','2019-10-03');
INSERT INTO `cuadro_escuela_politica` (`id`,`cuadroid`,`escuela_politicaid`,`curso`,`fecha`) VALUES
('20','84','5','gestion de crisis','2015-03-06');



-- -------------------------------------------
-- TABLE DATA cuadro_familiar
-- -------------------------------------------
INSERT INTO `cuadro_familiar` (`cuadroid`,`familiarid`) VALUES
('44','31');
INSERT INTO `cuadro_familiar` (`cuadroid`,`familiarid`) VALUES
('44','32');
INSERT INTO `cuadro_familiar` (`cuadroid`,`familiarid`) VALUES
('44','33');
INSERT INTO `cuadro_familiar` (`cuadroid`,`familiarid`) VALUES
('44','34');
INSERT INTO `cuadro_familiar` (`cuadroid`,`familiarid`) VALUES
('59','35');
INSERT INTO `cuadro_familiar` (`cuadroid`,`familiarid`) VALUES
('79','36');
INSERT INTO `cuadro_familiar` (`cuadroid`,`familiarid`) VALUES
('81','37');
INSERT INTO `cuadro_familiar` (`cuadroid`,`familiarid`) VALUES
('81','38');
INSERT INTO `cuadro_familiar` (`cuadroid`,`familiarid`) VALUES
('81','39');
INSERT INTO `cuadro_familiar` (`cuadroid`,`familiarid`) VALUES
('84','42');
INSERT INTO `cuadro_familiar` (`cuadroid`,`familiarid`) VALUES
('84','43');
INSERT INTO `cuadro_familiar` (`cuadroid`,`familiarid`) VALUES
('87','44');
INSERT INTO `cuadro_familiar` (`cuadroid`,`familiarid`) VALUES
('88','45');
INSERT INTO `cuadro_familiar` (`cuadroid`,`familiarid`) VALUES
('89','46');
INSERT INTO `cuadro_familiar` (`cuadroid`,`familiarid`) VALUES
('96','47');



-- -------------------------------------------
-- TABLE DATA cuadro_ingresos_monetarios
-- -------------------------------------------
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('44','11','17');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('59','12','18');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('79','13','19');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('81','14','20');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('81','15','21');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('81','16','22');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('81','14','23');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('81','15','24');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('81','16','25');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('81','14','26');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('81','15','27');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('81','16','28');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('84','17','29');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('84','18','30');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('84','19','31');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('84','17','32');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('84','18','33');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('84','19','34');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('87','20','35');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('88','21','36');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('89','22','37');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('89','23','38');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('96','24','39');
INSERT INTO `cuadro_ingresos_monetarios` (`cuadroid`,`ingresos_monetariosid`,`id`) VALUES
('96','25','40');



-- -------------------------------------------
-- TABLE DATA cuadro_sanciones
-- -------------------------------------------
INSERT INTO `cuadro_sanciones` (`sancionesid`,`cuadroid`) VALUES
('91','84');
INSERT INTO `cuadro_sanciones` (`sancionesid`,`cuadroid`) VALUES
('92','84');
INSERT INTO `cuadro_sanciones` (`sancionesid`,`cuadroid`) VALUES
('93','84');



-- -------------------------------------------
-- TABLE DATA cuentas
-- -------------------------------------------
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('0','1','0','0','0','11','0','34463','376','0','0','0','2019-07-31','0','2','1.7','0','7');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('0','2','0','0','0','12','0','24363','21773','0','0','0','2019-07-31','0','2','47.4','0','7');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('0','3','0','0','0','13','0','30354','10387','0','0','0','2019-07-31','0','2','80.9','0','7');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('0','4','0','0','0','14','0','38821','2737','5678','0','0','2019-07-31','0','2','27.8','0','7');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('0','5','0','0','0','15','0','38369','6285','1577','0','0','2019-07-31','0','2','44.5','0','7');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('0','6','0','0','0','17','0','42060','25356','0','0','0','2019-07-31','0','2','48.2','0','7');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('0','7','0','0','0','16','0','33523','0','0','0','0','2019-07-31','0','2','0','0','7');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('0','8','0','0','0','18','0','34449','0','0','0','0','2019-07-31','0','2','52.4','0','7');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('0','9','0','0','0','19','0','33923','456','0','0','0','2019-07-31','0','2','43.2','0','7');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('0','10','0','0','0','20','0','24572','4937','0','0','0','2019-07-31','0','2','16.8','0','7');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('0','11','0','0','0','21','0','33934','0','0','0','0','2019-07-31','0','2','50.2','0','7');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('0','12','0','0','0','22','0','47421','1001','0','0','0','2019-07-31','0','2','2.1','0','7');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('0','13','0','0','0','23','0','36339','0','2740','0','0','2019-07-31','0','2','74.6','0','7');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('0','14','0','0','0','24','0','28129','72965','2939','0','0','2019-07-31','0','2','73.7','0','7');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('0','15','0','0','0','25','0','132507','66080','103388','0','0','2019-07-31','0','2','71.9','0','7');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('0','16','0','0','0','26','0','8701','54080','0','0','0','2019-07-31','0','2','41','0','7');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('0','17','0','0','0','27','0','109972','0','0','0','0','2019-07-31','0','2','53.8','0','7');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('0','18','0','0','0','28','0','33247','0','0','0','0','2019-07-31','0','2','15.2','0','7');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('0','19','0','0','0','29','0','5941','117916','0','0','0','2019-07-31','0','2','32.2','0','7');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('0','20','0','0','0','30','0','249702','0','0','0','0','2019-07-31','0','2','70.1','0','7');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('','21','','','','11','','34463','376','0','','','2020-11-14','0','2','1.7','','64');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('','22','','','','12','','24363','21773','0','','','2020-11-14','0','2','47.4','','64');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('','23','','','','13','','30354','10387','0','','','2020-11-14','0','2','80.9','','64');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('','24','','','','14','','38821','2737','5678','','','2020-11-14','0','2','27.8','','64');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('','25','','','','15','','38369','6285','1577','','','2020-11-14','0','2','44.5','','64');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('','26','','','','17','','42060','25356','0','','','2020-11-14','0','2','48.2','','64');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('','27','','','','16','','33523','0','0','','','2020-11-14','0','2','0','','64');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('','28','','','','18','','34449','0','0','','','2020-11-14','0','2','52.4','','64');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('','29','','','','19','','33923','456','0','','','2020-11-14','0','2','43.2','','64');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('','30','','','','20','','24572','4937','0','','','2020-11-14','0','2','16.8','','64');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('','31','','','','21','','33934','0','0','','','2020-11-14','0','2','50.2','','64');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('','32','','','','22','','47421','1001','0','','','2020-11-14','0','2','2.1','','64');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('','33','','','','23','','36339','0','2740','','','2020-11-14','0','2','74.6','','64');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('','34','','','','24','','28129','72965','2939','','','2020-11-14','0','2','73.7','','64');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('','35','','','','25','','132507','66080','103388','','','2020-11-14','0','2','71.9','','64');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('','36','','','','26','','8701','54080','0','','','2020-11-14','0','2','41','','64');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('','37','','','','27','','109972','0','0','','','2020-11-14','0','2','53.8','','64');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('','38','','','','28','','33247','0','0','','','2020-11-14','0','2','15.2','','64');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('','39','','','','29','','5941','117916','0','','','2020-11-14','0','2','32.2','','64');
INSERT INTO `cuentas` (`representatividad`,`id`,`total_cuentas_vencidas`,`no_vencidas`,`saldo_sentencias_judiciales`,`empresaid`,`cxc_litigio`,`nm_no_vencida`,`efectos`,`mn_total_vencida`,`ExC_litigio`,`ventas_acumuladas`,`fecha`,`status`,`tipo_cuentaid`,`efectiviadad`,`vencidas`,`anexoid`) VALUES
('','40','','','','30','','249702','0','0','','','2020-11-14','0','2','70.1','','64');



-- -------------------------------------------
-- TABLE DATA cumplimiento
-- -------------------------------------------
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('55','23','1','76','jdkjkjdskjkjsd<br />
sd\'lsld;s<br />
dlsdklklskds<br />
kslkdlksldklskd','1','2019-07-27','2019-07-27','0','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('56','23','2','100','jhjskjasajj<br />
 jjJ JZ JSXB ;KS;LKSZX<br />
;LK','1','2019-06-28','2019-07-27','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('56','23','3','100','jhjskjasajj<br />
 jjJ JZ JSXB ;KS;LKSZX<br />
;LK','1','2019-07-27','2019-07-27','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('59','23','4','3','KDJLSKLSK,Z<br />
X;ZX;MZ;LXM;Z;X<br />
,Z;XL\'ZX,Z<br />
XZ,X<br />
;Z<br />
X<br />
Z\'X<br />
ZX','1','2019-07-27','2019-07-27','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('57','23','5','1.26','LKXLKKCLLKC<br />
KLKM LK KMKJKDJK DKFKDJKJ JKF F<br />
 KFJ KJFD KFDKFL\'L','1','2019-06-27','2019-07-27','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('57','23','6','1.26','LKXLKKCLLKC<br />
KLKM LK KMKJKDJK DKFKDJKJ JKF F<br />
 KFJ KJFD KFDKFL\'L','1','2019-07-27','2019-07-27','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('57','23','7','1.26','LKXLKKCLLKC<br />
KLKM LK KMKJKDJK DKFKDJKJ JKF F<br />
 KFJ KJFD KFDKFL\'L','1','2019-07-27','2019-07-27','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('57','23','8','1.26','LKXLKKCLLKC<br />
KLKM LK KMKJKDJK DKFKDJKJ JKF F<br />
 KFJ KJFD KFDKFL\'L','1','2019-07-31','2019-07-31','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('60','23','9','52','dkjkcjdkfjkjdlfj<br />
dfk;kf;hj;fg<br />
flglkf;cgjk;fgd<br />
fglkd\'cgl','1','2019-07-31','2019-07-31','1','1','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('1','26','10','52','lxmdlxkfk;lx<br />
c;xckv\'kx\'cvkx\'vc<br />
;cvk\'xkv\'kx','1','2019-08-15','2019-08-15','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('1','26','11','56','ksdmlskds<br />
skdslkd<br />
sdk<br />
sk','2','2019-08-15','2019-08-15','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('2','26','12','23','prueba importar excel otros','1','2019-08-20','2019-08-20','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('2','26','13','24','prueba importar excel 2','1','2019-08-20','2019-08-20','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('3','26','14','213','mas,d.a','1','2019-08-21','2019-08-21','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('4','26','15','45','mkasnnsna<br />
asaknslka','1','2019-08-21','2019-08-21','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('5','26','16','33','dkmsk','1','2019-08-21','2019-08-21','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('58','22','17','23','','1','2019-09-10','2019-09-10','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('58','22','18','23','','1','2019-09-10','2019-09-10','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('58','22','19','12','v','1','2019-09-10','2019-09-10','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('58','22','20','12','v','1','2019-09-10','2019-09-10','1','1','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('61','22','21','23','','1','2019-09-10','2019-09-10','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('61','22','22','23','','1','2019-09-10','2019-09-10','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('61','22','23','23','','1','2019-09-10','2019-09-10','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('61','22','24','23','','1','2019-09-10','2019-09-10','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('61','22','25','23','','1','2019-09-10','2019-09-10','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('61','22','26','23','','1','2019-09-10','2019-09-10','1','1','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('61','22','27','23','','1','2019-09-10','2019-09-10','1','1','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('57','22','28','1.26','LKXLKKCLLKC<br />
KLKM LK KMKJKDJK DKFKDJKJ JKF F<br />
 KFJ KJFD KFDKFL\'L','1','2019-09-10','2019-09-10','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('57','22','29','1.26','LKXLKKCLLKC<br />
KLKM LK KMKJKDJK DKFKDJKJ JKF F<br />
 KFJ KJFD KFDKFL\'L','1','2019-09-10','2019-09-10','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('57','22','30','1.26','LKXLKKCLLKC<br />
KLKM LK KMKJKDJK DKFKDJKJ JKF F<br />
 KFJ KJFD KFDKFL\'L','1','2019-09-10','2019-09-10','1','1','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('57','22','31','1.26','LKXLKKCLLKC<br />
KLKM LK KMKJKDJK DKFKDJKJ JKF F<br />
 KFJ KJFD KFDKFL\'L','1','2019-09-11','2019-09-11','1','1','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('56','22','32','100','jhjskjasajj<br />
 jjJ JZ JSXB ;KS;LKSZX<br />
;LK','1','2019-09-11','2019-09-11','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('55','22','33','212',',.,s.d,sd','1','2019-09-11','2019-09-11','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('56','22','34','233',' ,ls.m,d.s /.d,s','1','2019-09-11','2019-09-11','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('56','22','35','233',' ,ls.m,d.s /.d,s','1','2019-09-11','2019-09-11','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('56','22','36','233',' ,ls.m,d.s /.d,s','1','2019-09-11','2019-09-11','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('55','22','37','78','','1','2019-10-19','2019-10-19','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('55','22','38','78','','1','2019-10-19','2019-10-19','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('55','22','39','78','','1','2019-10-21','2019-10-21','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('55','22','40','78','','1','2019-10-21','2019-10-21','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('55','22','41','78','','1','2019-10-21','2019-10-21','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('56','22','42','12','mmsmdlmlsdlnsnld<br />
dmlsldkfs;','1','2018-11-13','2019-01-23','0','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('56','22','43','12','mmsmdlmlsdlnsnld<br />
dmlsldkfs;','1','2019-01-23','2019-01-23','0','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('56','22','44','12','mmsmdlmlsdlnsnld<br />
dmlsldkfs;','1','2018-12-13','2019-01-23','0','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('56','22','45','12','mmsmdlmlsdlnsnld<br />
dmlsldkfs;','1','2018-10-23','2019-01-23','0','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('56','22','46','12','mmsmdlmlsdlnsnld<br />
dmlsldkfs;','1','2019-10-28','2019-10-28','1','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('56','22','47','12','mmsmdlmlsdlnsnld<br />
dmlsldkfs;','1','2019-10-28','2019-10-28','1','1','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('57','22','48','45','nbjhl','2','2019-08-28','2019-08-28','1','1','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('1','26','49','92','njkjckjxjjzljc;vjzx;cjv;x','2','2020-05-02','2020-05-02','0','1','1');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('21','27','50','2','','1','2020-10-02','2020-10-02','1','1','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('23','27','51','0','','1','2020-10-02','2020-10-02','1','1','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('25','27','52','3','','1','2020-08-02','2020-08-02','1','1','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('55','22','53','76','','2','2020-10-30','2020-10-30','0','0','0');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('56','22','54','3','zxcsxzxcz','1','2020-09-07','2020-10-30','0','1','1');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('59','22','55','2','jhioip','1','2020-08-04','2020-10-30','0','1','1');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('45','32','56','100','','1','2020-10-30','2020-10-30','0','1','1');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('47','32','57','1','','1','2020-10-30','2020-10-30','0','1','1');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('48','32','58','23','','1','2020-10-30','2020-10-30','0','1','1');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('55','22','59','12','','2','2020-11-12','2020-11-14','0','1','1');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('2','26','60','92','','1','2020-11-17','2020-11-17','0','1','1');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('3','26','61','80','','1','2020-11-17','2020-11-17','0','1','1');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('4','26','62','100','','2','2020-11-17','2020-11-17','0','1','1');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('5','26','63','100','','1','2020-11-17','2020-11-17','0','1','1');
INSERT INTO `cumplimiento` (`indicadores_gestionid`,`userid`,`id`,`valor`,`observaciones`,`estado_cumplimientoid`,`fecha`,`fecha_informacion`,`anexo`,`status`,`actual`) VALUES
('57','23','64','0','','1','2020-11-17','2020-11-17','1','1','1');



-- -------------------------------------------
-- TABLE DATA cumplimiento_anexo
-- -------------------------------------------
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('2','reclamaciones_y_demandas_interpuestas190727160756.pdf','2','2019-06-28','uploads/anexos/indicadores/reclamaciones_y_demandas_interpuestas190727160756.xlsx','2','1','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('3','Informacion_de_los_laboratorioss190727160756.pdf','6','2019-07-27','uploads/anexos/indicadores/Informacion_de_los_laboratorioss190727160756.xlsx','3','2','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('4','Utilidad_por_peso_de_Valor_Agregado_Bruto190727160759.pdf','22','2019-07-27','uploads/anexos/indicadores/Utilidad_por_peso_de_Valor_Agregado_Bruto190727160759.xlsx','4','3','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('5','otros190727160757.pdf','26','2019-06-27','uploads/anexos/indicadores/otros190727160757.docx','5','4','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('6','otros190727170757.pdf','26','2019-07-27','uploads/anexos/indicadores/otros190727170757.docx','6','5','1');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('7','otros190727170757.pdf','26','2019-07-27','uploads/anexos/indicadores/otros190727170757.docx','7','6','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('8','Cuentas_por_pagar_y_Efectividad_de_Pago190731110757.pdf','12','2019-07-31','uploads/anexos/indicadores/Cuentas_por_pagar_y_Efectividad_de_Pago190731110757.xlsx','8','7','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('9','reclamaciones_y_demandas_interpuestas190731120760.pdf','2','2019-07-31','uploads/anexos/indicadores/reclamaciones_y_demandas_interpuestas190731120760.xlsx','9','8','1');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('10','Variacion_de_los_gastos_por_perdidas_y_faltantes_19081519081.pdf','8','2019-08-15','uploads/anexos/indicadores/Variacion_de_los_gastos_por_perdidas_y_faltantes_19081519081.xlsx','10','9','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('11','Variacion_de_los_gastos_por_perdidas_y_faltantes_19081519081.pdf','8','2019-08-15','uploads/anexos/indicadores/Variacion_de_los_gastos_por_perdidas_y_faltantes_19081519081.xlsx','11','10','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('12','otros19082013082.pdf','26','2019-08-20','uploads/anexos/indicadores/otros19082013082.xlsx','12','11','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('13','otros19082014082.pdf','26','2019-08-20','uploads/anexos/indicadores/otros19082014082.xlsx','13','12','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('14','otros19082111083.pdf','26','2019-08-21','uploads/anexos/indicadores/otros19082111083.docx','14','13','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('15','otros19082111084.pdf','26','2019-08-21','uploads/anexos/indicadores/otros19082111084.xlsx','15','14','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('16','otros19082111085.pdf','26','2019-08-21','uploads/anexos/indicadores/otros19082111085.xlsx','16','15','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('17','Cumplimiento_del_Plan_de_Ventas_Netas190910140958.pdf','16','2019-09-10','uploads/anexos/indicadores/Cumplimiento_del_Plan_de_Ventas_Netas190910140958.xlsx','17','16','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('18','Cumplimiento_del_Plan_de_Ventas_Netas190910140958.pdf','16','2019-09-10','uploads/anexos/indicadores/Cumplimiento_del_Plan_de_Ventas_Netas190910140958.xlsx','18','17','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('19','Cumplimiento_del_Plan_de_Ventas_Netas190910140958.pdf','16','2019-09-10','uploads/anexos/indicadores/Cumplimiento_del_Plan_de_Ventas_Netas190910140958.xlsx','19','18','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('20','Cumplimiento_del_Plan_de_Ventas_Netas190910140958.pdf','16','2019-09-10','uploads/anexos/indicadores/Cumplimiento_del_Plan_de_Ventas_Netas190910140958.xlsx','20','19','1');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('21','otros190910140961.pdf','26','2019-09-10','uploads/anexos/indicadores/otros190910140961.docx','21','20','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('22','otros190910150961.pdf','26','2019-09-10','uploads/anexos/indicadores/otros190910150961.doc','22','21','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('23','otros190910150961.pdf','26','2019-09-10','uploads/anexos/indicadores/otros190910150961.docx','23','22','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('24','otros190910150961.pdf','26','2019-09-10','uploads/anexos/indicadores/otros190910150961.docx','24','23','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('25','otros190910150961.pdf','26','2019-09-10','uploads/anexos/indicadores/otros190910150961.docx','25','24','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('26','otros190910150961.pdf','26','2019-09-10','uploads/anexos/indicadores/otros190910150961.docx','26','25','1');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('27','otros190910150961.pdf','26','2019-09-10','uploads/anexos/indicadores/otros190910150961.docx','27','26','1');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('28','otros190910150957.pdf','26','2019-09-10','uploads/anexos/indicadores/otros190910150957.docx','28','27','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('29','otros190910150957.pdf','26','2019-09-10','uploads/anexos/indicadores/otros190910150957.docx','29','28','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('30','otros190910150957.pdf','26','2019-09-10','uploads/anexos/indicadores/otros190910150957.docx','30','29','1');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('31','otros190911130957.pdf','26','2019-09-11','uploads/anexos/indicadores/otros190911130957.xlsx','31','30','1');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('32','otros190911130956.pdf','26','2019-09-11','uploads/anexos/indicadores/otros190911130956.xlsx','32','31','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('33','otros190911130955.pdf','26','2019-09-11','uploads/anexos/indicadores/otros190911130955.xlsx','33','32','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('34','otros190911130956.pdf','26','2019-09-11','uploads/anexos/indicadores/otros190911130956.docx','34','33','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('35','otros190911130956.pdf','26','2019-09-11','uploads/anexos/indicadores/otros190911130956.xlsx','35','34','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('36','otros190911130956.pdf','26','2019-09-11','uploads/anexos/indicadores/otros190911130956.docx','36','35','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('37','Variacion_de_los_gastos_por_perdidas_y_faltantes_191019081055.pdf','8','2019-10-19','uploads/anexos/indicadores/Variacion_de_los_gastos_por_perdidas_y_faltantes_191019081055.xlsx','37','36','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('38','Variacion_de_los_gastos_por_perdidas_y_faltantes_191019081055.pdf','8','2019-10-19','uploads/anexos/indicadores/Variacion_de_los_gastos_por_perdidas_y_faltantes_191019081055.xlsx','38','37','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('39','Variacion_de_los_gastos_por_perdidas_y_faltantes_191021101055.pdf','8','2019-10-21','uploads/anexos/indicadores/Variacion_de_los_gastos_por_perdidas_y_faltantes_191021101055.xlsx','39','38','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('40','Variacion_de_los_gastos_por_perdidas_y_faltantes_191021111055.pdf','8','2019-10-21','uploads/anexos/indicadores/Variacion_de_los_gastos_por_perdidas_y_faltantes_191021111055.xlsx','40','39','0');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('41','Variacion_de_los_gastos_por_perdidas_y_faltantes_191021121055.pdf','8','2019-10-21','uploads/anexos/indicadores/Variacion_de_los_gastos_por_perdidas_y_faltantes_191021121055.xlsx','41','40','1');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('46','Cumplimiento_de_los_Impuestos_191028091056.pdf','17','2019-10-28','uploads/anexos/indicadores/Cumplimiento_de_los_Impuestos_191028091056.xlsx','46','41','1');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('47','Cumplimiento_de_los_Impuestos_191028101056.pdf','17','2019-10-28','uploads/anexos/indicadores/Cumplimiento_de_los_Impuestos_191028101056.xlsx','47','42','1');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('48','Cumplimiento_de_los_Impuestos_190828090857.pdf','17','2019-08-28','uploads/anexos/indicadores/Cumplimiento_de_los_Impuestos_190828090857.xlsx','48','43','1');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('50','Utilidad,_Indice_de_Utilidad_y_Gasto_por_peso_de_ingreso201002151021.pdf','18','2020-10-02','uploads/anexos/indicadores/Utilidad,_Indice_de_Utilidad_y_Gasto_por_peso_de_ingreso201002151021.xlsx','50','44','1');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('51','Ventas_Liberadas_Acumuladas201002151023.pdf','1','2020-10-02','uploads/anexos/indicadores/Ventas_Liberadas_Acumuladas201002151023.xlsx','51','45','1');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('52','Ventas_Liberadas_Acumuladas200802150825.pdf','1','2020-08-02','uploads/anexos/indicadores/Ventas_Liberadas_Acumuladas200802150825.xlsx','52','46','1');
INSERT INTO `cumplimiento_anexo` (`cumplimientoid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('64','Expedientes_de_Perdidas_en_Investigacion201117191157.pdf','13','2020-11-17','uploads/anexos/indicadores/Expedientes_de_Perdidas_en_Investigacion201117191157.xlsx','64','47','1');



-- -------------------------------------------
-- TABLE DATA direccion
-- -------------------------------------------
INSERT INTO `direccion` (`id`,`nombre`,`responsable`,`Status`) VALUES
('1','OSDE','OSDE','0');
INSERT INTO `direccion` (`id`,`nombre`,`responsable`,`Status`) VALUES
('2','Dirección de Cuadros','Daisy Infante Roldán','1');
INSERT INTO `direccion` (`id`,`nombre`,`responsable`,`Status`) VALUES
('3','Dirección de Capital Humano','Gustavo Edrosa González','1');
INSERT INTO `direccion` (`id`,`nombre`,`responsable`,`Status`) VALUES
('4','Dirección de Planificación y Control de Gestión','Miguel Rojas Flores','1');
INSERT INTO `direccion` (`id`,`nombre`,`responsable`,`Status`) VALUES
('5','Dirección de Auditoría','Maribel Pérez Olivares,Onilvia Santa Cruz Pacheco Jorge','1');
INSERT INTO `direccion` (`id`,`nombre`,`responsable`,`Status`) VALUES
('6','Dirección de Comercial y Mercadotecnia','Nelson Sotolongo Pinillo','1');
INSERT INTO `direccion` (`id`,`nombre`,`responsable`,`Status`) VALUES
('7','Dirección de Informática y Desarrollo','René Alexander Roca Hernández','1');
INSERT INTO `direccion` (`id`,`nombre`,`responsable`,`Status`) VALUES
('8','Dirección Jurídica','Orestes Ruiz Lemes','1');
INSERT INTO `direccion` (`id`,`nombre`,`responsable`,`Status`) VALUES
('9','Dirección de Investigación,Desarrollo e Innovación','Kenia Hidalgo Marrero','1');
INSERT INTO `direccion` (`id`,`nombre`,`responsable`,`Status`) VALUES
('10','Dirección Técnica y Logística','Yalily Álvarez Calzado','1');
INSERT INTO `direccion` (`id`,`nombre`,`responsable`,`Status`) VALUES
('11','Dirección de Defensa,Seguridad y Protección','Manuel Andreu Hernández','1');
INSERT INTO `direccion` (`id`,`nombre`,`responsable`,`Status`) VALUES
('12','Dirección de Economía,Contabilidad y Finanzas','Odalis Infante García','1');
INSERT INTO `direccion` (`id`,`nombre`,`responsable`,`Status`) VALUES
('13','Dirección de Supervisión y Control','Lisbeth Peña Ramírez','1');



-- -------------------------------------------
-- TABLE DATA direcciones
-- -------------------------------------------
INSERT INTO `direcciones` (`id`,`calle`,`numero`,`edif`,`apto`,`piso`,`entre_calle_uno`,`entre_calle_dos`,`Reparto`,`provinciaid`,`municipioid`) VALUES
('379','5ta','1843','','','','2da','Final ','','4','32');
INSERT INTO `direcciones` (`id`,`calle`,`numero`,`edif`,`apto`,`piso`,`entre_calle_uno`,`entre_calle_dos`,`Reparto`,`provinciaid`,`municipioid`) VALUES
('380','Principal ','19','','','','1ra','Alturas del Rosario ','Volpe','4','39');
INSERT INTO `direcciones` (`id`,`calle`,`numero`,`edif`,`apto`,`piso`,`entre_calle_uno`,`entre_calle_dos`,`Reparto`,`provinciaid`,`municipioid`) VALUES
('409','pijaun','1258','','','','final',' final','','6','6');
INSERT INTO `direcciones` (`id`,`calle`,`numero`,`edif`,`apto`,`piso`,`entre_calle_uno`,`entre_calle_dos`,`Reparto`,`provinciaid`,`municipioid`) VALUES
('410','loinaz','12','','3','2','felizmendes','carajillo','zolous','15','6');
INSERT INTO `direcciones` (`id`,`calle`,`numero`,`edif`,`apto`,`piso`,`entre_calle_uno`,`entre_calle_dos`,`Reparto`,`provinciaid`,`municipioid`) VALUES
('449','pijaun','1258','','','','final',' final','','6','6');
INSERT INTO `direcciones` (`id`,`calle`,`numero`,`edif`,`apto`,`piso`,`entre_calle_uno`,`entre_calle_dos`,`Reparto`,`provinciaid`,`municipioid`) VALUES
('450','loinaz','12','','3','2','felizmendes','carajillo','zolous','15','6');
INSERT INTO `direcciones` (`id`,`calle`,`numero`,`edif`,`apto`,`piso`,`entre_calle_uno`,`entre_calle_dos`,`Reparto`,`provinciaid`,`municipioid`) VALUES
('452','pijaun','25','','','','sotshil','','','9','4');
INSERT INTO `direcciones` (`id`,`calle`,`numero`,`edif`,`apto`,`piso`,`entre_calle_uno`,`entre_calle_dos`,`Reparto`,`provinciaid`,`municipioid`) VALUES
('453','loinaz','12','','23er','2','felizmendes','carajillo','metropolitan','9','3');
INSERT INTO `direcciones` (`id`,`calle`,`numero`,`edif`,`apto`,`piso`,`entre_calle_uno`,`entre_calle_dos`,`Reparto`,`provinciaid`,`municipioid`) VALUES
('458','monte','1258','','','','arroyo',' final','','10','3');
INSERT INTO `direcciones` (`id`,`calle`,`numero`,`edif`,`apto`,`piso`,`entre_calle_uno`,`entre_calle_dos`,`Reparto`,`provinciaid`,`municipioid`) VALUES
('459','taiwan center','23','','','','herkai','','','15','6');
INSERT INTO `direcciones` (`id`,`calle`,`numero`,`edif`,`apto`,`piso`,`entre_calle_uno`,`entre_calle_dos`,`Reparto`,`provinciaid`,`municipioid`) VALUES
('464','Avenida del Puerto','3569','','','','final','','','4','31');
INSERT INTO `direcciones` (`id`,`calle`,`numero`,`edif`,`apto`,`piso`,`entre_calle_uno`,`entre_calle_dos`,`Reparto`,`provinciaid`,`municipioid`) VALUES
('465','tulipan','45','','7','8','boyeros','animas','lonbiz','4','35');
INSERT INTO `direcciones` (`id`,`calle`,`numero`,`edif`,`apto`,`piso`,`entre_calle_uno`,`entre_calle_dos`,`Reparto`,`provinciaid`,`municipioid`) VALUES
('466','Avenida del Puerto','3569','','','','final','','','4','31');
INSERT INTO `direcciones` (`id`,`calle`,`numero`,`edif`,`apto`,`piso`,`entre_calle_uno`,`entre_calle_dos`,`Reparto`,`provinciaid`,`municipioid`) VALUES
('467','tulipan','45','','7','8','boyeros','animas','lonbiz','4','35');
INSERT INTO `direcciones` (`id`,`calle`,`numero`,`edif`,`apto`,`piso`,`entre_calle_uno`,`entre_calle_dos`,`Reparto`,`provinciaid`,`municipioid`) VALUES
('472','van troi','25','','','','final',' final','','6','5');
INSERT INTO `direcciones` (`id`,`calle`,`numero`,`edif`,`apto`,`piso`,`entre_calle_uno`,`entre_calle_dos`,`Reparto`,`provinciaid`,`municipioid`) VALUES
('473','principal','23','','5-b','56','herkai','honjuin','metropolitan','6','5');
INSERT INTO `direcciones` (`id`,`calle`,`numero`,`edif`,`apto`,`piso`,`entre_calle_uno`,`entre_calle_dos`,`Reparto`,`provinciaid`,`municipioid`) VALUES
('488','van troi','25','','','','final',' final','','6','5');
INSERT INTO `direcciones` (`id`,`calle`,`numero`,`edif`,`apto`,`piso`,`entre_calle_uno`,`entre_calle_dos`,`Reparto`,`provinciaid`,`municipioid`) VALUES
('489','taiwan center','12','','','','herkai','','','6','4');



-- -------------------------------------------
-- TABLE DATA directivo
-- -------------------------------------------
INSERT INTO `directivo` (`id`,`cuadroid`,`cargos_direccionid`,`años_cargo`) VALUES
('134','59','4','2');
INSERT INTO `directivo` (`id`,`cuadroid`,`cargos_direccionid`,`años_cargo`) VALUES
('154','79','4','2');
INSERT INTO `directivo` (`id`,`cuadroid`,`cargos_direccionid`,`años_cargo`) VALUES
('155','81','3','2');
INSERT INTO `directivo` (`id`,`cuadroid`,`cargos_direccionid`,`años_cargo`) VALUES
('157','87','5','3');
INSERT INTO `directivo` (`id`,`cuadroid`,`cargos_direccionid`,`años_cargo`) VALUES
('158','88','5','3');



-- -------------------------------------------
-- TABLE DATA empresa
-- -------------------------------------------
INSERT INTO `empresa` (`id`,`nombre`,`tegnologia_logisticaid`) VALUES
('11','PINAR DEL RIO','0');
INSERT INTO `empresa` (`id`,`nombre`,`tegnologia_logisticaid`) VALUES
('12','ARTEMISA','0');
INSERT INTO `empresa` (`id`,`nombre`,`tegnologia_logisticaid`) VALUES
('13','MAYABEQUE','0');
INSERT INTO `empresa` (`id`,`nombre`,`tegnologia_logisticaid`) VALUES
('14','LA HABANA','0');
INSERT INTO `empresa` (`id`,`nombre`,`tegnologia_logisticaid`) VALUES
('15','MATANZAS','0');
INSERT INTO `empresa` (`id`,`nombre`,`tegnologia_logisticaid`) VALUES
('16','CIENFUEGOS','0');
INSERT INTO `empresa` (`id`,`nombre`,`tegnologia_logisticaid`) VALUES
('17','VILLA CLARA','0');
INSERT INTO `empresa` (`id`,`nombre`,`tegnologia_logisticaid`) VALUES
('18','SANCTI SPIRITUS','0');
INSERT INTO `empresa` (`id`,`nombre`,`tegnologia_logisticaid`) VALUES
('19','CIEGO DE AVILA','0');
INSERT INTO `empresa` (`id`,`nombre`,`tegnologia_logisticaid`) VALUES
('20','CAMAGÜEY','0');
INSERT INTO `empresa` (`id`,`nombre`,`tegnologia_logisticaid`) VALUES
('21','LAS TUNAS','0');
INSERT INTO `empresa` (`id`,`nombre`,`tegnologia_logisticaid`) VALUES
('22','HOLGUIN','0');
INSERT INTO `empresa` (`id`,`nombre`,`tegnologia_logisticaid`) VALUES
('23','GRANMA','0');
INSERT INTO `empresa` (`id`,`nombre`,`tegnologia_logisticaid`) VALUES
('24','SANTIAGO DE CUBA','0');
INSERT INTO `empresa` (`id`,`nombre`,`tegnologia_logisticaid`) VALUES
('25','GUANTANAMO','0');
INSERT INTO `empresa` (`id`,`nombre`,`tegnologia_logisticaid`) VALUES
('26','ISLA DE LA JUVENTUD','0');
INSERT INTO `empresa` (`id`,`nombre`,`tegnologia_logisticaid`) VALUES
('27','ASEGEM','0');
INSERT INTO `empresa` (`id`,`nombre`,`tegnologia_logisticaid`) VALUES
('28','TCFCS','0');
INSERT INTO `empresa` (`id`,`nombre`,`tegnologia_logisticaid`) VALUES
('29','ENFRIGO','0');
INSERT INTO `empresa` (`id`,`nombre`,`tegnologia_logisticaid`) VALUES
('30','EMMP','0');
INSERT INTO `empresa` (`id`,`nombre`,`tegnologia_logisticaid`) VALUES
('31','UNAL','0');



-- -------------------------------------------
-- TABLE DATA enfermedad
-- -------------------------------------------
INSERT INTO `enfermedad` (`id`,`enfermedad`,`tratamiento`) VALUES
('56','Asma bronquial','Aérosol ');
INSERT INTO `enfermedad` (`id`,`enfermedad`,`tratamiento`) VALUES
('71','glaucoma','sulfaprin');
INSERT INTO `enfermedad` (`id`,`enfermedad`,`tratamiento`) VALUES
('91','glaucoma','sulfaprin');
INSERT INTO `enfermedad` (`id`,`enfermedad`,`tratamiento`) VALUES
('94','gangrena','marihuana');
INSERT INTO `enfermedad` (`id`,`enfermedad`,`tratamiento`) VALUES
('95','ojeras','ruedas de pepino');
INSERT INTO `enfermedad` (`id`,`enfermedad`,`tratamiento`) VALUES
('98','bronkits','aerosol');
INSERT INTO `enfermedad` (`id`,`enfermedad`,`tratamiento`) VALUES
('101','Rinorea','');
INSERT INTO `enfermedad` (`id`,`enfermedad`,`tratamiento`) VALUES
('102','Rinorea','');
INSERT INTO `enfermedad` (`id`,`enfermedad`,`tratamiento`) VALUES
('104','asma','sulfaprin');
INSERT INTO `enfermedad` (`id`,`enfermedad`,`tratamiento`) VALUES
('111','asma','sulfaprin');



-- -------------------------------------------
-- TABLE DATA enfermedad_salud
-- -------------------------------------------
INSERT INTO `enfermedad_salud` (`enfermedadid`,`saludid`) VALUES
('56','226');
INSERT INTO `enfermedad_salud` (`enfermedadid`,`saludid`) VALUES
('71','241');
INSERT INTO `enfermedad_salud` (`enfermedadid`,`saludid`) VALUES
('91','261');
INSERT INTO `enfermedad_salud` (`enfermedadid`,`saludid`) VALUES
('94','263');
INSERT INTO `enfermedad_salud` (`enfermedadid`,`saludid`) VALUES
('95','263');
INSERT INTO `enfermedad_salud` (`enfermedadid`,`saludid`) VALUES
('98','266');
INSERT INTO `enfermedad_salud` (`enfermedadid`,`saludid`) VALUES
('101','270');
INSERT INTO `enfermedad_salud` (`enfermedadid`,`saludid`) VALUES
('102','271');
INSERT INTO `enfermedad_salud` (`enfermedadid`,`saludid`) VALUES
('104','276');
INSERT INTO `enfermedad_salud` (`enfermedadid`,`saludid`) VALUES
('111','285');



-- -------------------------------------------
-- TABLE DATA escuela_politica
-- -------------------------------------------
INSERT INTO `escuela_politica` (`id`,`escuela`) VALUES
('1','escuela politica 1');
INSERT INTO `escuela_politica` (`id`,`escuela`) VALUES
('2','escuela politica 2');
INSERT INTO `escuela_politica` (`id`,`escuela`) VALUES
('3','escuela politica 3');
INSERT INTO `escuela_politica` (`id`,`escuela`) VALUES
('4','escuela politica 4');
INSERT INTO `escuela_politica` (`id`,`escuela`) VALUES
('5','escuela politica 5');



-- -------------------------------------------
-- TABLE DATA estado_cumplimiento
-- -------------------------------------------
INSERT INTO `estado_cumplimiento` (`id`,`estado`) VALUES
('1','informado');
INSERT INTO `estado_cumplimiento` (`id`,`estado`) VALUES
('2','cerfificado');



-- -------------------------------------------
-- TABLE DATA estado_salud
-- -------------------------------------------
INSERT INTO `estado_salud` (`id`,`estado_salud`) VALUES
('1','Bueno');
INSERT INTO `estado_salud` (`id`,`estado_salud`) VALUES
('2','Regular');
INSERT INTO `estado_salud` (`id`,`estado_salud`) VALUES
('3','Malo');



-- -------------------------------------------
-- TABLE DATA evaluacion
-- -------------------------------------------
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('1','6','2019-07-31','2019-07-31','5','44','1','3','23',',ndxnkjsdlkjs<br />
dkd;ladjck;aijd;adllkdflsd;fk<br />
f;ldkflksn;dfkj;s<br />
fsdf\'k\'lskf\'lk','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('2','12','2019-07-31','2019-07-31','5','45','1','3','23',' nsv djbs,jdhlws<br />
dkdfn;ks;fsd<br />
;fl\'ksd\'flkl\'df,f\'lk\'ldhkf','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('3','53','2019-07-31','2019-07-31','2','1','1','3','26',',xjsd;o;dus;djkfs<br />
f;skfs<br />
fls\'od <br />
 d d fkjkjg <br />
dpko<br />
 ','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('4','53','2019-07-31','2019-07-31','2','1','1','3','26',',xjsd;o;dus;djkfs<br />
f;skfs<br />
fls\'od <br />
 d d fkjkjg <br />
dpko<br />
 ','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('5','53','2019-07-31','2019-07-31','2','1','2','3','26',',xjsd;o;dus;djkfs<br />
f;skfs<br />
fls\'od <br />
 d d fkjkjg <br />
dpko<br />
 ','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('6','23','2019-08-20','2019-08-20','2','2','1','3','26','prueba ','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('7','98','2019-08-20','2019-08-20','2','3','1','3','26','kolkl','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('8','12','2019-08-21','2019-08-21','2','4','1','3','26','lkfkojofidoiofod<br />
dfdo','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('9','43','2019-08-21','2019-08-21','2','5','1','3','26','prueba anexos xlsx id=26','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('10','43','2019-08-21','2019-08-21','2','5','1','3','26','prueba anexos xlsx id=26','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('11','23','2019-08-21','2019-08-21','2','5','1','3','26','otro de anexo xlsx id 26','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('12','23','2019-08-21','2019-08-21','2','5','1','3','26','otro de anexo xlsx id 26','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('13','43','2019-08-21','2019-08-21','2','6','1','3','26','probando anexos doc id!=26','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('14','43','2019-08-21','2019-08-21','2','6','1','3','26','probando anexos doc id!=26','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('15','45','2019-08-21','2019-08-21','2','1','1','3','26','kmknm,m ','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('16','56','2019-08-21','2019-08-21','2','2','1','3','26','','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('17','46','2019-08-21','2019-08-21','2','3','1','3','26','mnm,m,','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('18','23','2019-08-26','2019-08-26','2','4','1','3','26','klklksksd<br />
ks;lkd;kdf<br />
kslkdf;ksdf<br />
mfklsk','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('19','3','2019-08-26','2019-08-26','2','6','1','3','26','43','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('20','5','2019-08-26','2019-08-26','2','5','1','3','26','msdlkfnlkdsf;k<br />
fsmlfklk','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('21','5','2019-08-26','2019-08-26','2','5','1','3','26','msdlkfnlkdsf;k<br />
fsmlfklk','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('22','5','2019-08-26','2019-08-26','2','5','1','3','26','msdlkfnlkdsf;k<br />
fsmlfklk','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('23','89','2019-08-26','2019-08-26','2','5','1','3','26','kdljsdfsk','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('24','89','2019-08-26','2019-08-26','2','5','1','3','26','kdljsdfsk','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('25','21','2019-08-26','2019-08-26','2','5','1','3','26','msndm,sn,d<br />
smd.ms','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('26','21','2019-08-26','2019-08-26','2','5','1','3','26','mskdkjskdj<br />
dsfns x','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('27','21','2019-08-26','2019-08-26','2','5','1','3','26','mskdkjskdj<br />
dsfns x','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('28','21','2019-08-26','2019-08-26','2','5','1','3','26','mskdkjskdj<br />
dsfns x','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('29','21','2019-08-26','2019-08-26','2','5','1','3','26','mskdkjskdj<br />
dsfns x','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('30','21','2019-08-26','2019-08-26','2','5','1','3','26','mskdkjskdj<br />
dsfns x','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('31','21','2019-08-26','2019-08-28','2','5','1','3','26','mskdkjskdj<br />
dsfns x','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('32','21','2019-08-26','2019-08-28','2','5','1','3','26','mskdkjskdj<br />
dsfns x','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('33','21','2019-08-26','2019-08-28','2','5','1','3','26','mskdkjskdj<br />
dsfns x','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('34','21','2019-08-26','2019-08-28','2','5','1','3','26','mskdkjskdj<br />
dsfns x','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('35','21','2019-08-26','2019-08-28','2','5','1','3','26','mskdkjskdj<br />
dsfns x','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('36','21','2019-08-26','2019-08-28','2','5','1','3','26','mskdkjskdj<br />
dsfns x','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('37','21','2019-08-26','2019-08-28','2','5','1','3','26','mskdkjskdj<br />
dsfns x','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('38','21','2019-08-26','2019-08-28','2','5','1','3','26','mskdkjskdj<br />
dsfns x','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('39','21','2019-08-26','2019-08-28','2','5','1','3','26','mskdkjskdj<br />
dsfns x','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('40','21','2019-08-26','2019-08-28','2','5','1','3','26','mskdkjskdj<br />
dsfns x','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('41','21','2019-08-26','2019-08-28','2','5','1','3','26','mskdkjskdj<br />
dsfns x','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('42','23','2019-09-11','2019-09-11','5','52','1','3','22','msdmldm','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('43','23','2019-09-11','2019-09-11','5','52','1','3','22','msdmldm','1','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('44','23','2019-09-11','2019-09-11','5','47','1','3','22',',lm.,.s,.a,s.s','1','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('45','434','2019-09-11','2019-09-11','5','43','1','3','22','r543','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('46','323','2019-09-11','2019-09-11','5','44','1','3','22','','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('47','434','2019-09-11','2019-09-11','5','43','1','3','22','r543','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('48','434','2019-09-11','2019-09-11','5','43','1','3','22','r543','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('49','434','2019-09-11','2019-09-11','5','43','1','3','22','r543','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('50','434','2019-09-11','2019-09-11','5','43','1','3','22','r543','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('51','32','2019-09-11','2019-09-11','5','50','1','3','22',' m,dns ,mdmsd/<br />
ldmlsmd','1','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('52','433','2019-09-11','2019-09-11','5','51','1','3','22','msndmf.dm.ks.kd<br />
ksjdkfjsdkj;s','1','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('53','34','2019-11-02','2019-11-02','5','43','1','4','22','x,md,mdf,m','0','0','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('54','89','2019-11-02','2019-11-02','5','44','1','4','22','mndkj<br />
nkdjlkfjd<br />
kf;dk;lf','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('55','34','2019-11-02','2019-11-02','5','43','1','4','22','x,md,mdf,m','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('56','34','2019-11-02','2019-11-02','5','43','1','4','22','x,md,mdf,m','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('57','23','2019-11-03','2019-11-03','5','45','1','4','22','kfldlf','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('58','89','2019-11-03','2019-11-03','5','44','1','4','22','mndkj<br />
nkdjlkfjd<br />
kf;dk;lf','0','0','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('59','34','2019-11-03','2019-11-03','5','43','1','4','22','x,md,mdf,m','0','0','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('60','25','2019-11-03','2019-11-03','5','46','1','4','22',',m.,.m.,.,','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('61','89','2019-11-03','2019-11-03','5','44','1','4','22','mndkj<br />
nkdjlkfjd<br />
kf;dk;lf','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('62','68','2019-11-03','2019-11-03','5','43','1','4','22','kmlkmlzkmxlkmlxkcvlxk<br />
xmlcklvkxlckxvl','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('63','89','2019-11-03','2019-11-03','5','44','1','4','22','aslkdlask<br />
asdlaksl\'da<br />
ls\'daklsd<br />
la','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('64','65','2019-11-03','2019-11-03','5','43','2','4','22','odidodjdioid<br />
djfdf\'d','1','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('65','45','2019-11-03','2019-11-03','5','45','1','4','22','dnlsklkdl;fs<br />
k;fskd\'lfs<br />
klfd\'sldf','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('66','45','2019-11-03','2019-11-03','5','45','1','4','22','dnlsklkdl;fs<br />
k;fskd\'lfs<br />
klfd\'sldf','0','0','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('67','45','2019-11-03','2019-11-03','5','45','1','4','22','dnlsklkdl;fs<br />
k;fskd\'lfs<br />
klfd\'sldf','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('68','100','2020-10-30','2020-10-30','9','42','1','4','32','','1','0','1');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('69','23','2020-11-14','2020-11-14','5','45','1','4','22','','0','1','0');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('70','26','2020-11-14','2020-11-14','5','45','1','4','22','','1','0','1');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('71','100','2020-11-17','2020-11-17','2','1','2','4','26','','1','0','1');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('72','100','2020-11-17','2020-11-17','2','2','2','4','26','','1','0','1');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('73','100','2020-11-17','2020-11-17','2','3','1','4','26','','1','0','1');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('74','25','2020-11-17','2020-11-17','2','4','1','4','26','','1','0','1');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('75','100','2020-11-17','2020-11-17','2','5','1','4','26','','1','0','1');
INSERT INTO `evaluacion` (`id`,`valor_vreal`,`fechacreado`,`fecha_informacion`,`direccionid`,`criteriomedidaid`,`estado`,`periodo`,`userid`,`observaciones`,`status`,`anexo`,`actual`) VALUES
('76','100','2020-11-17','2020-11-17','2','6','1','4','26','','1','0','1');



-- -------------------------------------------
-- TABLE DATA evaluacion_anexo
-- -------------------------------------------
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('1','Indice_de_Utilizacion_del_fondo_de_Tiempo190731110744.pdf','25','2019-07-31','uploads/anexos/criterios/Indice_de_Utilizacion_del_fondo_de_Tiempo190731110744.xlsx','1','1','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('2','Gasto_de_Salario_por_peso_de_VAB190731120745.pdf','21','2019-07-31','uploads/anexos/criterios/Gasto_de_Salario_por_peso_de_VAB190731120745.xlsx','2','2','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('3','monitoreo_de_la_red19073113071.pdf','3','2019-07-31','uploads/anexos/criterios/monitoreo_de_la_red19073113071.xlsx','3','3','0');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('4','Analisis_del_Capital_de_Trabajo_19073113071.pdf','9','2019-07-31','uploads/anexos/criterios/Analisis_del_Capital_de_Trabajo_19073113071.xlsx','4','4','0');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('5','Analisis_del_Capital_de_Trabajo_19073113071.pdf','9','2019-07-31','uploads/anexos/criterios/Analisis_del_Capital_de_Trabajo_19073113071.xlsx','5','5','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('6','otros19082014082.pdf','26','2019-08-20','uploads/anexos/criterios/otros19082014082.docx','6','6','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('7','otros19082014083.pdf','26','2019-08-20','uploads/anexos/criterios/otros19082014083.xlsx','7','7','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('8','otros19082110084.pdf','26','2019-08-21','uploads/anexos/criterios/otros19082110084.docx','8','8','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('9','otros19082110085.pdf','26','2019-08-21','uploads/anexos/criterios/otros19082110085.xlsx','9','9','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('10','otros19082110085.pdf','26','2019-08-21','uploads/anexos/criterios/otros19082110085.xlsx','10','10','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('11','otros19082110085.pdf','26','2019-08-21','uploads/anexos/criterios/otros19082110085.xlsx','11','11','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('12','otros19082110085.pdf','26','2019-08-21','uploads/anexos/criterios/otros19082110085.xlsx','12','12','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('13','Variacion_de_los_gastos_por_perdidas_y_faltantes_19082110086.pdf','8','2019-08-21','uploads/anexos/criterios/Variacion_de_los_gastos_por_perdidas_y_faltantes_19082110086.docx','13','13','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('14','Variacion_de_los_gastos_por_perdidas_y_faltantes_19082110086.pdf','8','2019-08-21','uploads/anexos/criterios/Variacion_de_los_gastos_por_perdidas_y_faltantes_19082110086.xlsx','14','14','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('15','reclamaciones_y_demandas_interpuestas19082110081.pdf','2','2019-08-21','uploads/anexos/criterios/reclamaciones_y_demandas_interpuestas19082110081.xlsx','15','15','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('16','otros19082110082.pdf','26','2019-08-21','uploads/anexos/criterios/otros19082110082.xlsx','16','16','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('17','otros19082110083.pdf','26','2019-08-21','uploads/anexos/criterios/otros19082110083.docx','17','17','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('18','otros19082616084.pdf','26','2019-08-26','uploads/anexos/criterios/otros19082616084.xlsx','18','18','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('19','otros19082616086.pdf','26','2019-08-26','uploads/anexos/criterios/otros19082616086.xlsx','19','19','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('20','otros19082616085.pdf','26','2019-08-26','uploads/anexos/criterios/otros19082616085.xlsx','20','20','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('21','otros19082616085.pdf','26','2019-08-26','uploads/anexos/criterios/otros19082616085.xlsx','21','21','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('22','otros19082617085.pdf','26','2019-08-26','uploads/anexos/criterios/otros19082617085.xlsx','22','22','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('23','otros19082617085.pdf','26','2019-08-26','uploads/anexos/criterios/otros19082617085.xlsx','23','23','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('24','otros19082617085.pdf','26','2019-08-26','uploads/anexos/criterios/otros19082617085.xlsx','24','24','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('25','otros19082617085.pdf','26','2019-08-26','uploads/anexos/criterios/otros19082617085.xlsx','25','25','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('26','otros19082617085.pdf','26','2019-08-26','uploads/anexos/criterios/otros19082617085.xlsx','26','26','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('27','otros19082617085.pdf','26','2019-08-26','uploads/anexos/criterios/otros19082617085.xlsx','27','27','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('28','otros19082617085.pdf','26','2019-08-26','uploads/anexos/criterios/otros19082617085.xlsx','28','28','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('29','otros19082617085.pdf','26','2019-08-26','uploads/anexos/criterios/otros19082617085.xlsx','29','29','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('30','otros19082617085.pdf','26','2019-08-26','uploads/anexos/criterios/otros19082617085.xlsx','30','30','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('31','otros19082818085.pdf','26','2019-08-28','uploads/anexos/criterios/otros19082818085.xlsx','31','31','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('32','otros19082819085.pdf','26','2019-08-28','uploads/anexos/criterios/otros19082819085.xlsx','32','32','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('33','otros19082819085.pdf','26','2019-08-28','uploads/anexos/criterios/otros19082819085.xlsx','33','33','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('34','otros19082819085.pdf','26','2019-08-28','uploads/anexos/criterios/otros19082819085.xlsx','34','34','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('35','otros19082819085.pdf','26','2019-08-28','uploads/anexos/criterios/otros19082819085.xlsx','35','35','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('36','otros19082819085.pdf','26','2019-08-28','uploads/anexos/criterios/otros19082819085.xlsx','36','36','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('37','otros19082819085.pdf','26','2019-08-28','uploads/anexos/criterios/otros19082819085.xlsx','37','37','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('38','otros19082819085.pdf','26','2019-08-28','uploads/anexos/criterios/otros19082819085.xlsx','38','38','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('39','otros19082819085.pdf','26','2019-08-28','uploads/anexos/criterios/otros19082819085.xlsx','39','39','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('40','otros19082819085.pdf','26','2019-08-28','uploads/anexos/criterios/otros19082819085.xlsx','40','40','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('41','otros19082819085.pdf','26','2019-08-28','uploads/anexos/criterios/otros19082819085.xlsx','41','41','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('42','otros190911130952.pdf','26','2019-09-11','uploads/anexos/criterios/otros190911130952.xlsx','42','42','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('43','otros190911130952.pdf','26','2019-09-11','uploads/anexos/criterios/otros190911130952.xlsx','43','43','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('44','otros190911130947.pdf','26','2019-09-11','uploads/anexos/criterios/otros190911130947.xlsx','44','44','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('45','otros190911130943.pdf','26','2019-09-11','uploads/anexos/criterios/otros190911130943.docx','45','45','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('46','otros190911130944.pdf','26','2019-09-11','uploads/anexos/criterios/otros190911130944.xlsx','46','46','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('47','otros190911130943.pdf','26','2019-09-11','uploads/anexos/criterios/otros190911130943.docx','47','47','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('48','otros190911130943.pdf','26','2019-09-11','uploads/anexos/criterios/otros190911130943.xlsx','48','48','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('49','otros190911130943.pdf','26','2019-09-11','uploads/anexos/criterios/otros190911130943.xlsx','49','49','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('50','otros190911130943.pdf','26','2019-09-11','uploads/anexos/criterios/otros190911130943.xlsx','50','50','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('51','otros190911130950.pdf','26','2019-09-11','uploads/anexos/criterios/otros190911130950.xlsx','51','51','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('52','otros190911130951.pdf','26','2019-09-11','uploads/anexos/criterios/otros190911130951.docx','52','52','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('54','Productividad_y_Correlacion_Salario_Medio-Productividad191102111144.pdf','20','2019-11-02','uploads/anexos/criterios/Productividad_y_Correlacion_Salario_Medio-Productividad191102111144.xlsx','54','53','0');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('55','Utilidad_por_peso_de_Valor_Agregado_Bruto191102111143.pdf','22','2019-11-02','uploads/anexos/criterios/Utilidad_por_peso_de_Valor_Agregado_Bruto191102111143.xlsx','55','54','0');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('56','Expedientes_de_Sobrantes_en_Investigacion191102111143.pdf','15','2019-11-02','uploads/anexos/criterios/Expedientes_de_Sobrantes_en_Investigacion191102111143.xlsx','56','55','0');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('57','Informacion_de_los_laboratorioss191103171145.pdf','6','2019-11-03','uploads/anexos/criterios/Informacion_de_los_laboratorioss191103171145.xlsx','57','56','0');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('60','Expedientes_de_Faltantes_en_Investigacion191103171146.pdf','14','2019-11-03','uploads/anexos/criterios/Expedientes_de_Faltantes_en_Investigacion191103171146.xlsx','60','57','0');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('61','Expedientes_de_Sobrantes_en_Investigacion191103171144.pdf','15','2019-11-03','uploads/anexos/criterios/Expedientes_de_Sobrantes_en_Investigacion191103171144.xlsx','61','58','0');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('62','Variacion_de_los_gastos_por_perdidas_y_faltantes_191103171143.pdf','8','2019-11-03','uploads/anexos/criterios/Variacion_de_los_gastos_por_perdidas_y_faltantes_191103171143.xlsx','62','59','0');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('63','Gasto_de_Salario_por_peso_de_VAB191103171144.pdf','21','2019-11-03','uploads/anexos/criterios/Gasto_de_Salario_por_peso_de_VAB191103171144.xlsx','63','60','0');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('64','Variacion_de_los_gastos_por_perdidas_y_faltantes_191103171143.pdf','8','2019-11-03','uploads/anexos/criterios/Variacion_de_los_gastos_por_perdidas_y_faltantes_191103171143.xlsx','64','61','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('65','Cumplimiento_de_los_Impuestos_191103181145.pdf','17','2019-11-03','uploads/anexos/criterios/Cumplimiento_de_los_Impuestos_191103181145.xlsx','65','62','0');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('67','reclamaciones_y_demandas_interpuestas191103181145.pdf','2','2019-11-03','uploads/anexos/criterios/reclamaciones_y_demandas_interpuestas191103181145.xlsx','67','63','1');
INSERT INTO `evaluacion_anexo` (`evaluacionid`,`nombre`,`anexoid`,`fecha`,`anexo`,`idtabla`,`id`,`status`) VALUES
('69','Cuentas_por_pagar_y_Efectividad_de_Pago201114191145.pdf','12','2020-11-14','uploads/anexos/criterios/Cuentas_por_pagar_y_Efectividad_de_Pago201114191145.xlsx','69','64','0');



-- -------------------------------------------
-- TABLE DATA evaluacion_cuadro
-- -------------------------------------------
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('7','sasas','sdsdfsd','sdsdfsd','sdfsdfsd','5','','1','asd','59','22','21','21','22','22','2','0000-00-00','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('8','sasas','sdsdfsd','sdsdfsd','sdfsdfsd','2','sdsdfsdsd','1','asd','59','23','22','22','23','23','2','0000-00-00','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('9','ndsjdfsjdhfkjsdjfaldjljdfjjfsd
ds;f
lskdflk
sd;kf
lsd
kf
sadkfdsfsd','dm,nf,amd,nmf,sd.fnsd,f
dfmlsdknlfkmlsdkf
sdmflksdlfkads
fsdkflasdkfla','dslfjklsdjfjlsjdlfasd
fks;dkjflksjdlklsd
sldkflksdlfkasld
recomendaciones 1','recomendaciones2','2','continuar autosuperandose','1','OSDE GA','84','24','23','23','24','24','3','2020-09-15','1');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('10','mxknzxnjxz','d nlskdlksdlkslknd
sdm;s;dls
d;ks;ldk;','lkdlklsdks;kds
sdmksjdksjd
jsdksjds
','skdlnlfksdlks
jkdlskd;s
lskdl','2','d s,md, m,sd ,','1','ECOMIL','79','25','24','24','25','25','3','2020-09-02','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('11','zlkxjlkczlxklczlxkc;lzxk','zxjkczjxkcjzkxnckjzxnkcjnzkxjnckj','jkzxjkczkxjckhzjxckjzkxcjk','zsdasas','1','knjksjkjsljf;s
skdflksjkfljsd','3','Artex','79','26','25','25','26','26','1','0000-00-00','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('12','zlkxjlkczlxklczlxkc;lzxk','zxjkczjxkcjzkxnckjzxnkcjnzkxjnckj','jkzxjkczkxjckhzjxckjzkxcjk','zsdasas','1','knjksjkjsljf;s
skdflksjkfljsd','4','Artex','79','27','26','26','27','27','1','0000-00-00','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('13','zlkxjlkczlxklczlxkc;lzxk','zxjkczjxkcjzkxnckjzxnkcjnzkxjnckj','jkzxjkczkxjckhzjxckjzkxcjk','zsdasas','1','knjksjkjsljf;s
skdflksjkfljsd','5','Artex','79','28','27','27','28','28','1','0000-00-00','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('14','zlkxjlkczlxklczlxkc;lzxk','zxjkczjxkcjzkxnckjzxnkcjnzkxjnckj','jkzxjkczkxjckhzjxckjzkxcjk','zsdasas','1','knjksjkjsljf;s
skdflksjkfljsd','6','Artex','79','29','28','28','29','29','1','0000-00-00','1');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('15','smankskjsjjaskj','NSKZJNCKJKCJKJXCKJZKJJK','nkjdnkjsdkjvkljdfljlsdjnvj','nkdvskjdkjsdkvhkdjhsfkhvsd','2','','7','ARTEX','44','30','29','29','30','30','4','0000-00-00','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('16','smankskjsjjaskj','NSKZJNCKJKCJKJXCKJZKJJK','nkjdnkjsdkjvkljdfljlsdjnvj','nkdvskjdkjsdkvhkdjhsfkhvsd','2','','8','ARTEX','44','31','30','30','31','31','4','0000-00-00','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('17','smankskjsjjaskj','NSKZJNCKJKCJKJXCKJZKJJK','nkjdnkjsdkjvkljdfljlsdjnvj','nkdvskjdkjsdkvhkdjhsfkhvsd','2','','9','ARTEX','44','32','31','31','32','32','4','0000-00-00','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('18','smankskjsjjaskj','NSKZJNCKJKCJKJXCKJZKJJK','nkjdnkjsdkjvkljdfljlsdjnvj','nkdvskjdkjsdkvhkdjhsfkhvsd','2','','10','ARTEX','44','33','32','32','33','33','4','0000-00-00','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('19','smankskjsjjaskj','NSKZJNCKJKCJKJXCKJZKJJK','nkjdnkjsdkjvkljdfljlsdjnvj','nkdvskjdkjsdkvhkdjhsfkhvsd','2','','11','ARTEX','44','34','33','33','34','34','4','0000-00-00','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('20','smankskjsjjaskj','NSKZJNCKJKCJKJXCKJZKJJK','nkjdnkjsdkjvkljdfljlsdjnvj','nkdvskjdkjsdkvhkdjhsfkhvsd','2','','12','ARTEX','44','35','34','34','35','35','4','0000-00-00','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('21','smankskjsjjaskj','NSKZJNCKJKCJKJXCKJZKJJK','nkjdnkjsdkjvkljdfljlsdjnvj','nkdvskjdkjsdkvhkdjhsfkhvsd','2','','13','ARTEX','44','36','35','35','36','36','4','0000-00-00','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('22','smankskjsjjaskj','NSKZJNCKJKCJKJXCKJZKJJK','nkjdnkjsdkjvkljdfljlsdjnvj','nkdvskjdkjsdkvhkdjhsfkhvsd','2','','14','ARTEX1','44','38','36','36','38','38','4','0000-00-00','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('23','smankskjsjjaskj','NSKZJNCKJKCJKJXCKJZKJJK','nkjdnkjsdkjvkljdfljlsdjnvj','nkdvskjdkjsdkvhkdjhsfkhvsd','2','','15','ARTEX1','44','40','37','37','40','40','4','0000-00-00','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('24','smankskjsjjaskj','NSKZJNCKJKCJKJXCKJZKJJK','nkjdnkjsdkjvkljdfljlsdjnvj','nkdvskjdkjsdkvhkdjhsfkhvsd','2','','16','ARTEX1','44','41','38','38','41','41','4','0000-00-00','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('25','smankskjsjjaskj','NSKZJNCKJKCJKJXCKJZKJJK','nkjdnkjsdkjvkljdfljlsdjnvj','nkdvskjdkjsdkvhkdjhsfkhvsd','2','','18','ARTEX1','44','44','40','40','44','44','4','0000-00-00','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('26','smankskjsjjaskj','NSKZJNCKJKCJKJXCKJZKJJK','nkjdnkjsdkjvkljdfljlsdjnvj','nkdvskjdkjsdkvhkdjhsfkhvsd','2','','20','ARTEX1','44','47','42','42','47','47','4','0000-00-00','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('27','smankskjsjjaskj','NSKZJNCKJKCJKJXCKJZKJJK','nkjdnkjsdkjvkljdfljlsdjnvj','nkdvskjdkjsdkvhkdjhsfkhvsd','2','','21','ARTEX1','44','49','43','43','49','49','4','0000-00-00','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('28','smankskjsjjaskj','NSKZJNCKJKCJKJXCKJZKJJK','nkjdnkjsdkjvkljdfljlsdjnvj','nkdvskjdkjsdkvhkdjhsfkhvsd','2','','22','ARTEX1','44','50','44','44','50','50','4','0000-00-00','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('29','mknkjaksja
ajskja;ksjka
ksna;s;lkas
a;l','lksnlamns.jnamnsla,s
maslm;dALsmda
slmals
;alsnkjk','nksjksdjksjds
s;ldk;sjdkf;sd
njkldjskljd
nskjdksj','jhsdkjsljdkjsds
mskljdklfsjldfs
kksjd;kfsj;df','3','jsakjskjaksjkda','23','OSDE GA','44','51','45','45','51','51','4','0000-00-00','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('30','mknkjaksja
ajskja;ksjka
ksna;s;lkas
a;l','lksnlamns.jnamnsla,s
maslm;dALsmda
slmals
;alsnkjk','nksjksdjksjds
s;ldk;sjdkf;sd
njkldjskljd
nskjdksj','jhsdkjsljdkjsds
mskljdklfsjldfs
kksjd;kfsj;df','3','jsakjskjaksjkda','24','OSDE GA','44','53','46','46','53','53','4','0000-00-00','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('31','mknkjaksja
ajskja;ksjka
ksna;s;lkas
a;l','lksnlamns.jnamnsla,s
maslm;dALsmda
slmals
;alsnkjk','nksjksdjksjds
s;ldk;sjdkf;sd
njkldjskljd
nskjdksj','jhsdkjsljdkjsds
mskljdklfsjldfs
kksjd;kfsj;df','3','jsakjskjaksjkda','25','OSDE GA','44','54','47','47','54','54','4','0000-00-00','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('32','mknkjaksja
ajskja;ksjka
ksna;s;lkas
a;l','lksnlamns.jnamnsla,s
maslm;dALsmda
slmals
;alsnkjk','nksjksdjksjds
s;ldk;sjdkf;sd
njkldjskljd
nskjdksj','jhsdkjsljdkjsds
mskljdklfsjldfs
kksjd;kfsj;df','3','jsakjskjaksjkda','26','OSDE GA','44','55','48','48','55','55','4','2020-08-18','1');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('33','kdlskmlkmk','mlskdmlk','mvsldkvlskm','lvmslkdvlkn','2','sdlvkzlklxzc','27','Correos de cuba','81','56','49','49','56','56','2','2020-08-18','1');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('34','zxas','sasa','sasa','sasdas','','zcsadas','28','Comando 13','96','57','50','50','57','57','5','2020-11-23','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('35','zxas','sasa','sasa','sasdas','2','zcsadas','29','Comando 13','96','58','51','51','58','58','5','2020-11-23','1');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('36','jnxcnkxnckxm','nkcxjnkvjxnkcnjvkxcjkj','dksdkfjkshdsjkj','kjskjdkjsdkjshdjlhs','1','skjksjdkjsk','30','cubapetroleo','59','59','52','52','59','59','3','2020-11-25','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('37','jnxcnkxnckxm','nkcxjnkvjxnkcnjvkxcjkj','dksdkfjkshdsjkj','kjskjdkjsdkjshdjlhs','1','skjksjdkjsk','31','cubapetroleo','59','60','53','53','60','60','3','2020-11-25','0');
INSERT INTO `evaluacion_cuadro` (`id`,`complemento_textual`,`señalamientos`,`recomendaciones`,`concluciones`,`resultado_evaluacion`,`superacion`,`confecionado`,`entidad`,`cuadroid`,`reservaid`,`proyeccionid`,`opinion_evaluadoid`,`experienciaid`,`periodo_evaluadoid`,`organismoidorganismo`,`fecha`,`ultima`) VALUES
('38','sdsdsd','sdsdfsdfsd','sdsdfsd','sdfsdsdfsd','2','zxczxcz','32','Citmatel','59','61','54','54','61','61','10','2020-11-25','1');



-- -------------------------------------------
-- TABLE DATA evaluacion_cuadro_indicadores_evaluacion
-- -------------------------------------------
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('1','7','2','3');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('2','7','3','4');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('3','7','4','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('4','7','5','3');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('5','7','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('6','7','7','3');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('7','7','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('8','8','2','3');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('9','8','3','4');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('10','8','4','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('11','8','5','3');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('12','8','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('13','8','7','3');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('14','8','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('15','9','1','2');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('16','9','2','2');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('17','9','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('18','9','4','3');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('19','9','5','3');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('20','9','6','2');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('21','9','7','5');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('22','9','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('23','10','1','2');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('24','10','2','3');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('25','10','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('26','10','4','4');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('27','10','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('28','10','6','5');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('29','10','7','2');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('30','10','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('31','11','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('32','11','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('33','11','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('34','11','4','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('35','11','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('36','11','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('37','11','7','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('38','11','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('39','12','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('40','12','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('41','12','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('42','12','4','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('43','12','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('44','12','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('45','12','7','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('46','12','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('47','13','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('48','13','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('49','13','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('50','13','4','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('51','13','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('52','13','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('53','13','7','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('54','13','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('55','14','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('56','14','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('57','14','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('58','14','4','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('59','14','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('60','14','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('61','14','7','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('62','14','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('63','15','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('64','15','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('65','15','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('66','15','4','2');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('67','15','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('68','15','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('69','15','7','3');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('70','15','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('71','16','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('72','16','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('73','16','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('74','16','4','2');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('75','16','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('76','16','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('77','16','7','3');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('78','16','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('79','17','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('80','17','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('81','17','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('82','17','4','2');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('83','17','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('84','17','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('85','17','7','3');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('86','17','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('87','18','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('88','18','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('89','18','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('90','18','4','2');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('91','18','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('92','18','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('93','18','7','3');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('94','18','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('95','19','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('96','19','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('97','19','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('98','19','4','2');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('99','19','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('100','19','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('101','19','7','3');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('102','19','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('103','20','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('104','20','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('105','20','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('106','20','4','2');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('107','20','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('108','20','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('109','20','7','3');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('110','20','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('111','21','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('112','21','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('113','21','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('114','21','4','2');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('115','21','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('116','21','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('117','21','7','3');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('118','21','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('119','22','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('120','22','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('121','22','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('122','22','4','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('123','22','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('124','22','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('125','22','7','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('126','22','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('127','23','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('128','23','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('129','23','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('130','23','4','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('131','23','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('132','23','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('133','23','7','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('134','23','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('135','24','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('136','24','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('137','24','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('138','24','4','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('139','24','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('140','24','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('141','24','7','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('142','24','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('143','25','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('144','25','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('145','25','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('146','25','4','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('147','25','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('148','25','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('149','25','7','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('150','25','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('151','26','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('152','26','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('153','26','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('154','26','4','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('155','26','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('156','26','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('157','26','7','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('158','26','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('159','27','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('160','27','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('161','27','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('162','27','4','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('163','27','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('164','27','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('165','27','7','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('166','27','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('167','28','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('168','28','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('169','28','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('170','28','4','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('171','28','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('172','28','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('173','28','7','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('174','28','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('175','29','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('176','29','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('177','29','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('178','29','4','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('179','29','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('180','29','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('181','29','7','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('182','29','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('183','30','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('184','30','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('185','30','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('186','30','4','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('187','30','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('188','30','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('189','30','7','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('190','30','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('191','31','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('192','31','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('193','31','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('194','31','4','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('195','31','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('196','31','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('197','31','7','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('198','31','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('199','32','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('200','32','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('201','32','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('202','32','4','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('203','32','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('204','32','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('205','32','7','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('206','32','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('207','33','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('208','33','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('209','33','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('210','33','4','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('211','33','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('212','33','6','3');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('213','33','7','3');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('214','33','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('215','34','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('216','34','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('217','34','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('218','34','4','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('219','34','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('220','34','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('221','34','7','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('222','34','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('223','35','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('224','35','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('225','35','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('226','35','4','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('227','35','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('228','35','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('229','35','7','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('230','35','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('231','36','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('232','36','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('233','36','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('234','36','4','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('235','36','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('236','36','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('237','36','7','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('238','36','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('239','37','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('240','37','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('241','37','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('242','37','4','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('243','37','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('244','37','6','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('245','37','7','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('246','37','8','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('247','38','1','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('248','38','2','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('249','38','3','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('250','38','4','2');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('251','38','5','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('252','38','6','3');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('253','38','7','1');
INSERT INTO `evaluacion_cuadro_indicadores_evaluacion` (`id`,`evaluacion_cuadroid`,`Indicadores_evaluacionid`,`evaluacion`) VALUES
('254','38','8','1');



-- -------------------------------------------
-- TABLE DATA experiencia
-- -------------------------------------------
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('1','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('2','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('3','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('4','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('5','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('6','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('7','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('8','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('9','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('10','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('11','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('12','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('13','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('14','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('15','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('16','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('17','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('18','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('19','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('20','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('21','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('22','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('23','1','2','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('24','2','4','1','3');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('25','1','0','1','0');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('26','0','0','0','0');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('27','0','0','0','0');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('28','0','0','0','0');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('29','0','0','0','0');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('30','1','6','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('31','1','6','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('32','1','6','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('33','1','6','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('34','1','6','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('35','1','6','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('36','1','6','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('37','1','6','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('38','1','6','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('39','1','6','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('40','1','6','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('41','1','6','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('42','1','6','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('43','1','6','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('44','1','6','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('45','1','6','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('46','1','6','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('47','1','6','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('48','1','6','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('49','1','6','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('50','1','6','2','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('51','3','1','1','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('52','3','1','1','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('53','3','1','1','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('54','3','1','1','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('55','3','1','1','1');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('56','2','0','0','6');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('57','1','2','2','2');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('58','1','2','2','2');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('59','0','5','2','2');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('60','0','5','2','2');
INSERT INTO `experiencia` (`id`,`años_cargo_actual`,`meses_cargo_actual`,`años_cuadro`,`meses_cuadro`) VALUES
('61','2','4','4','3');



-- -------------------------------------------
-- TABLE DATA familiar
-- -------------------------------------------
INSERT INTO `familiar` (`id`,`tipo_familiar`,`personaCI`,`centro_estudio_trabajo`,`conviviente`,`sancionado`,`viaje`,`residenteExterior`,`active`) VALUES
('31','5','84120708580','2','1','0','1','1','1');
INSERT INTO `familiar` (`id`,`tipo_familiar`,`personaCI`,`centro_estudio_trabajo`,`conviviente`,`sancionado`,`viaje`,`residenteExterior`,`active`) VALUES
('32','3','63070385748','IPU Juventino Rosas','1','0','0','0','1');
INSERT INTO `familiar` (`id`,`tipo_familiar`,`personaCI`,`centro_estudio_trabajo`,`conviviente`,`sancionado`,`viaje`,`residenteExterior`,`active`) VALUES
('33','2','56033164849','Centro Recreacion Mavis','0','0','0','0','1');
INSERT INTO `familiar` (`id`,`tipo_familiar`,`personaCI`,`centro_estudio_trabajo`,`conviviente`,`sancionado`,`viaje`,`residenteExterior`,`active`) VALUES
('34','6','67041708462','Desvinculado Laboral','0','1','0','0','1');
INSERT INTO `familiar` (`id`,`tipo_familiar`,`personaCI`,`centro_estudio_trabajo`,`conviviente`,`sancionado`,`viaje`,`residenteExterior`,`active`) VALUES
('35','1','27946165615','2','1','0','0','0','1');
INSERT INTO `familiar` (`id`,`tipo_familiar`,`personaCI`,`centro_estudio_trabajo`,`conviviente`,`sancionado`,`viaje`,`residenteExterior`,`active`) VALUES
('36','1','27946165615','2','1','0','0','0','1');
INSERT INTO `familiar` (`id`,`tipo_familiar`,`personaCI`,`centro_estudio_trabajo`,`conviviente`,`sancionado`,`viaje`,`residenteExterior`,`active`) VALUES
('37','2','69854656564','3','1','0','1','0','1');
INSERT INTO `familiar` (`id`,`tipo_familiar`,`personaCI`,`centro_estudio_trabajo`,`conviviente`,`sancionado`,`viaje`,`residenteExterior`,`active`) VALUES
('38','5','89646313616','2','1','0','0','0','1');
INSERT INTO `familiar` (`id`,`tipo_familiar`,`personaCI`,`centro_estudio_trabajo`,`conviviente`,`sancionado`,`viaje`,`residenteExterior`,`active`) VALUES
('39','4','85113445645','2','0','0','0','1','1');
INSERT INTO `familiar` (`id`,`tipo_familiar`,`personaCI`,`centro_estudio_trabajo`,`conviviente`,`sancionado`,`viaje`,`residenteExterior`,`active`) VALUES
('42','4','89221656516','1','1','1','0','0','1');
INSERT INTO `familiar` (`id`,`tipo_familiar`,`personaCI`,`centro_estudio_trabajo`,`conviviente`,`sancionado`,`viaje`,`residenteExterior`,`active`) VALUES
('43','2','54123698461','2','1','0','1','0','1');
INSERT INTO `familiar` (`id`,`tipo_familiar`,`personaCI`,`centro_estudio_trabajo`,`conviviente`,`sancionado`,`viaje`,`residenteExterior`,`active`) VALUES
('44','3','54545454546','2','1','0','0','0','1');
INSERT INTO `familiar` (`id`,`tipo_familiar`,`personaCI`,`centro_estudio_trabajo`,`conviviente`,`sancionado`,`viaje`,`residenteExterior`,`active`) VALUES
('45','3','54545456546','2','1','0','0','0','1');
INSERT INTO `familiar` (`id`,`tipo_familiar`,`personaCI`,`centro_estudio_trabajo`,`conviviente`,`sancionado`,`viaje`,`residenteExterior`,`active`) VALUES
('46','2','27946165616','gghghg','1','0','0','0','1');
INSERT INTO `familiar` (`id`,`tipo_familiar`,`personaCI`,`centro_estudio_trabajo`,`conviviente`,`sancionado`,`viaje`,`residenteExterior`,`active`) VALUES
('47','2','27946165614','gghghg','1','0','0','0','1');



-- -------------------------------------------
-- TABLE DATA familiares_exterior
-- -------------------------------------------
INSERT INTO `familiares_exterior` (`id`,`pais`,`nacionalidad`,`familiarid`) VALUES
('7','','','39');
INSERT INTO `familiares_exterior` (`id`,`pais`,`nacionalidad`,`familiarid`) VALUES
('8','Alemania','Española','31');



-- -------------------------------------------
-- TABLE DATA fondo_salario
-- -------------------------------------------
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.3717','0.4327','2019-07-31','1','1','11','0.4063','2');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.4332','0.4337','2019-07-31','1','2','12','0.4247','2');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.3586','0.4241','2019-07-31','1','3','13','0.2879','2');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.2655','0.3149','2019-07-31','1','4','14','0.3252','2');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.4201','0.4552','2019-07-31','1','5','15','0.3199','2');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.3717','0.3718','2019-07-31','1','6','17','0.3935','2');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.3906','0.4346','2019-07-31','1','7','16','0.4512','2');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.3336','0.3701','2019-07-31','1','8','18','0.3648','2');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.398','0.4591','2019-07-31','1','9','19','0.4307','2');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.4216','0.4435','2019-07-31','1','10','20','0.3952','2');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.398','0.4535','2019-07-31','1','11','21','0.4667','2');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.5073','0.5089','2019-07-31','1','12','22','0.4977','2');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.3896','0.4084','2019-07-31','1','13','23','0.4721','2');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.4125','0.5503','2019-07-31','1','14','24','0.4875','2');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.4154','0.429','2019-07-31','1','15','25','0.4201','2');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.5566','0.5917','2019-07-31','1','16','26','0.5552','2');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.4611','0.5732','2019-07-31','1','17','27','0.5184','2');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.4026','0.4096','2019-07-31','1','18','28','0.433','2');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.2081','0.2896','2019-07-31','1','19','29','0.2596','2');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.4477','0.4836','2019-07-31','1','20','30','0.4206','2');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.3717','0.4327','2019-11-03','1','21','11','0.4063','60');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.4332','0.4337','2019-11-03','1','22','12','0.4247','60');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.3586','0.4241','2019-11-03','1','23','13','0.2879','60');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.2655','0.3149','2019-11-03','1','24','14','0.3252','60');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.4201','0.4552','2019-11-03','1','25','15','0.3199','60');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.3717','0.3718','2019-11-03','1','26','17','0.3935','60');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.3906','0.4346','2019-11-03','1','27','16','0.4512','60');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.3336','0.3701','2019-11-03','1','28','18','0.3648','60');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.398','0.4591','2019-11-03','1','29','19','0.4307','60');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.4216','0.4435','2019-11-03','1','30','20','0.3952','60');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.398','0.4535','2019-11-03','1','31','21','0.4667','60');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.5073','0.5089','2019-11-03','1','32','22','0.4977','60');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.3896','0.4084','2019-11-03','1','33','23','0.4721','60');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.4125','0.5503','2019-11-03','1','34','24','0.4875','60');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.4154','0.429','2019-11-03','1','35','25','0.4201','60');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.5566','0.5917','2019-11-03','1','36','26','0.5552','60');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.4611','0.5732','2019-11-03','1','37','27','0.5184','60');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.4026','0.4096','2019-11-03','1','38','28','0.433','60');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.2081','0.2896','2019-11-03','1','39','29','0.2596','60');
INSERT INTO `fondo_salario` (`FSVA_vreal`,`FSVA_plan`,`fecha`,`status`,`id`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('0.4477','0.4836','2019-11-03','1','40','30','0.4206','60');



-- -------------------------------------------
-- TABLE DATA fondo_tiempo
-- -------------------------------------------
INSERT INTO `fondo_tiempo` (`adiestrado`,`indice_utilizacion`,`indice_ausentismo`,`ausentismo_puro`,`promedio_trab_mensual`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('2','96.6','3.4','0.5','593','2019-07-31','1','1','11','1');
INSERT INTO `fondo_tiempo` (`adiestrado`,`indice_utilizacion`,`indice_ausentismo`,`ausentismo_puro`,`promedio_trab_mensual`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('5','94.7','5.3','1.2','532','2019-07-31','1','2','12','1');
INSERT INTO `fondo_tiempo` (`adiestrado`,`indice_utilizacion`,`indice_ausentismo`,`ausentismo_puro`,`promedio_trab_mensual`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('0','96.5','3.5','0.4','447','2019-07-31','1','3','13','1');
INSERT INTO `fondo_tiempo` (`adiestrado`,`indice_utilizacion`,`indice_ausentismo`,`ausentismo_puro`,`promedio_trab_mensual`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('0','98','2','0.3','985','2019-07-31','1','4','14','1');
INSERT INTO `fondo_tiempo` (`adiestrado`,`indice_utilizacion`,`indice_ausentismo`,`ausentismo_puro`,`promedio_trab_mensual`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('12','95.5','4.5','1.1','766','2019-07-31','1','5','15','1');
INSERT INTO `fondo_tiempo` (`adiestrado`,`indice_utilizacion`,`indice_ausentismo`,`ausentismo_puro`,`promedio_trab_mensual`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('0','97.4','2.6','0.4','518','2019-07-31','1','6','17','1');
INSERT INTO `fondo_tiempo` (`adiestrado`,`indice_utilizacion`,`indice_ausentismo`,`ausentismo_puro`,`promedio_trab_mensual`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('1','93.9','6.1','0.5','911','2019-07-31','1','7','16','1');
INSERT INTO `fondo_tiempo` (`adiestrado`,`indice_utilizacion`,`indice_ausentismo`,`ausentismo_puro`,`promedio_trab_mensual`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('0','95.3','4.7','0.1','438','2019-07-31','1','8','18','1');
INSERT INTO `fondo_tiempo` (`adiestrado`,`indice_utilizacion`,`indice_ausentismo`,`ausentismo_puro`,`promedio_trab_mensual`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('2','96.6','3.4','0.9','472','2019-07-31','1','9','19','1');
INSERT INTO `fondo_tiempo` (`adiestrado`,`indice_utilizacion`,`indice_ausentismo`,`ausentismo_puro`,`promedio_trab_mensual`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('1','93.6','6.4','0.4','608','2019-07-31','1','10','20','1');
INSERT INTO `fondo_tiempo` (`adiestrado`,`indice_utilizacion`,`indice_ausentismo`,`ausentismo_puro`,`promedio_trab_mensual`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('3','94.9','5.1','0.3','647','2019-07-31','1','11','21','1');
INSERT INTO `fondo_tiempo` (`adiestrado`,`indice_utilizacion`,`indice_ausentismo`,`ausentismo_puro`,`promedio_trab_mensual`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('0','94','6','0.2','1124','2019-07-31','1','12','22','1');
INSERT INTO `fondo_tiempo` (`adiestrado`,`indice_utilizacion`,`indice_ausentismo`,`ausentismo_puro`,`promedio_trab_mensual`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('1','92.8','7.2','0.4','802','2019-07-31','1','13','23','1');
INSERT INTO `fondo_tiempo` (`adiestrado`,`indice_utilizacion`,`indice_ausentismo`,`ausentismo_puro`,`promedio_trab_mensual`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('2','93.3','6.7','0.1','1136','2019-07-31','1','14','24','1');
INSERT INTO `fondo_tiempo` (`adiestrado`,`indice_utilizacion`,`indice_ausentismo`,`ausentismo_puro`,`promedio_trab_mensual`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('8','93.2','6.8','1.1','729','2019-07-31','1','15','25','1');
INSERT INTO `fondo_tiempo` (`adiestrado`,`indice_utilizacion`,`indice_ausentismo`,`ausentismo_puro`,`promedio_trab_mensual`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('0','95.7','4.3','0.5','187','2019-07-31','1','16','26','1');
INSERT INTO `fondo_tiempo` (`adiestrado`,`indice_utilizacion`,`indice_ausentismo`,`ausentismo_puro`,`promedio_trab_mensual`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('0','98.7','1.3','0.1','389','2019-07-31','1','17','27','1');
INSERT INTO `fondo_tiempo` (`adiestrado`,`indice_utilizacion`,`indice_ausentismo`,`ausentismo_puro`,`promedio_trab_mensual`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('3','98.7','1.3','0.6','159','2019-07-31','1','18','31','1');
INSERT INTO `fondo_tiempo` (`adiestrado`,`indice_utilizacion`,`indice_ausentismo`,`ausentismo_puro`,`promedio_trab_mensual`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('38','95.1','4.9','1.2','1681','2019-07-31','1','19','29','1');
INSERT INTO `fondo_tiempo` (`adiestrado`,`indice_utilizacion`,`indice_ausentismo`,`ausentismo_puro`,`promedio_trab_mensual`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('1','97.1','2.9','0.6','173','2019-07-31','1','20','30','1');
INSERT INTO `fondo_tiempo` (`adiestrado`,`indice_utilizacion`,`indice_ausentismo`,`ausentismo_puro`,`promedio_trab_mensual`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('0','98.1','1.9','0','446','2019-07-31','1','21','28','1');



-- -------------------------------------------
-- TABLE DATA grado_cientifico
-- -------------------------------------------
INSERT INTO `grado_cientifico` (`id`,`tipo`) VALUES
('0','Ninguno');
INSERT INTO `grado_cientifico` (`id`,`tipo`) VALUES
('1','Licenciado');
INSERT INTO `grado_cientifico` (`id`,`tipo`) VALUES
('2','Ingeniero');
INSERT INTO `grado_cientifico` (`id`,`tipo`) VALUES
('3','Master');
INSERT INTO `grado_cientifico` (`id`,`tipo`) VALUES
('4','Doctor');



-- -------------------------------------------
-- TABLE DATA idiomas
-- -------------------------------------------
INSERT INTO `idiomas` (`id`,`idioma`) VALUES
('1','Español');
INSERT INTO `idiomas` (`id`,`idioma`) VALUES
('2','Ingles');
INSERT INTO `idiomas` (`id`,`idioma`) VALUES
('3','Chino');
INSERT INTO `idiomas` (`id`,`idioma`) VALUES
('4','Ruso');
INSERT INTO `idiomas` (`id`,`idioma`) VALUES
('5','Frances');
INSERT INTO `idiomas` (`id`,`idioma`) VALUES
('6','Italiano');
INSERT INTO `idiomas` (`id`,`idioma`) VALUES
('7','Indio');
INSERT INTO `idiomas` (`id`,`idioma`) VALUES
('8','Alemán');



-- -------------------------------------------
-- TABLE DATA impuesto
-- -------------------------------------------
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('35841','42580.3','37029.2','41891.1','326734','282250','781388','771404','2019-10-28','1','1','31','42');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('1509.6','1850.7','1878','2424.6','18467.7','17045.4','49681.2','43038','2019-10-28','1','2','11','42');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('7121.2','6356.5','1841.1','2018.6','22708','19224.9','43886.3','41364','2019-10-28','1','3','12','42');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('767.2','775','1565','1735.7','14665.8','9575.4','34103.7','37294','2019-10-28','1','4','13','42');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('1782.1','1218.6','1118','1471','0','0','0','0','2019-10-28','1','5','14','42');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('4137.8','3333.9','2460','2831.7','25211.2','17134.2','55297.1','49712','2019-10-28','1','6','15','42');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('3740.7','3807.3','1728','2862.6','17815.5','16754','59550.1','57307','2019-10-28','1','7','17','42');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('2731.1','1597','1834.5','1953.5','11065.6','10861.8','46374.4','45103','2019-10-28','1','8','16','42');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('1264.6','1397.4','1754.9','1621.6','34560','11707.9','10801.2','36429','2019-10-28','1','9','18','42');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('2321.1','1533.6','1710.1','1725.6','10085.5','13516.5','35972.5','38764','2019-10-28','1','10','19','42');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('358.4','1843','2716.1','2674.5','21384.3','22404.2','46222.6','51613','2019-10-28','1','11','20','42');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('510.2','2245.3','1507.4','1759.7','11831.2','12841.2','29553.5','27941','2019-10-28','1','12','21','42');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('1634.8','2667.2','3034.9','3597.4','24831.9','20080.1','62722','58405','2019-10-28','1','13','22','42');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('232.8','206','2494.1','2874','23656.6','21767.4','46996.8','44839','2019-10-28','1','14','23','42');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('597.2','507.5','3239.1','3181.7','10926','23467','76241.5','62727','2019-10-28','1','15','24','42');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('0','4','1706.5','1864.3','12864.7','12569.8','33833.5','32424','2019-10-28','1','16','25','42');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('100.3','235.8','456.2','501.1','2935.6','2890.1','11490','10026','2019-10-28','1','17','26','42');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('0','0','0','0','0','0','0','0','2019-10-28','1','18','27','42');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('4582.7','11353.5','1762.2','2013.2','0','0','0','0','2019-10-28','1','19','28','42');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('0','0','0','0','0','0','0','0','2019-10-28','1','20','29','42');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('35841','42580.3','37029.2','41891.1','326734','282250','781388','771404','2019-08-28','1','21','31','43');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('1509.6','1850.7','1878','2424.6','18467.7','17045.4','49681.2','43038','2019-08-28','1','22','11','43');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('7121.2','6356.5','1841.1','2018.6','22708','19224.9','43886.3','41364','2019-08-28','1','23','12','43');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('767.2','775','1565','1735.7','14665.8','9575.4','34103.7','37294','2019-08-28','1','24','13','43');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('1782.1','1218.6','1118','1471','0','0','0','0','2019-08-28','1','25','14','43');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('4137.8','3333.9','2460','2831.7','25211.2','17134.2','55297.1','49712','2019-08-28','1','26','15','43');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('3740.7','3807.3','1728','2862.6','17815.5','16754','59550.1','57307','2019-08-28','1','27','17','43');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('2731.1','1597','1834.5','1953.5','11065.6','10861.8','46374.4','45103','2019-08-28','1','28','16','43');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('1264.6','1397.4','1754.9','1621.6','34560','11707.9','10801.2','36429','2019-08-28','1','29','18','43');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('2321.1','1533.6','1710.1','1725.6','10085.5','13516.5','35972.5','38764','2019-08-28','1','30','19','43');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('358.4','1843','2716.1','2674.5','21384.3','22404.2','46222.6','51613','2019-08-28','1','31','20','43');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('510.2','2245.3','1507.4','1759.7','11831.2','12841.2','29553.5','27941','2019-08-28','1','32','21','43');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('1634.8','2667.2','3034.9','3597.4','24831.9','20080.1','62722','58405','2019-08-28','1','33','22','43');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('232.8','206','2494.1','2874','23656.6','21767.4','46996.8','44839','2019-08-28','1','34','23','43');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('597.2','507.5','3239.1','3181.7','10926','23467','76241.5','62727','2019-08-28','1','35','24','43');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('0','4','1706.5','1864.3','12864.7','12569.8','33833.5','32424','2019-08-28','1','36','25','43');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('100.3','235.8','456.2','501.1','2935.6','2890.1','11490','10026','2019-08-28','1','37','26','43');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('0','0','0','0','0','0','0','0','2019-08-28','1','38','27','43');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('4582.7','11353.5','1762.2','2013.2','0','0','0','0','2019-08-28','1','39','28','43');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('0','0','0','0','0','0','0','0','2019-08-28','1','40','29','43');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('35841','42580.3','37029.2','41891.1','326734','282250','781388','771404','2019-11-03','1','41','31','62');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('1509.6','1850.7','1878','2424.6','18467.7','17045.4','49681.2','43038','2019-11-03','1','42','11','62');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('7121.2','6356.5','1841.1','2018.6','22708','19224.9','43886.3','41364','2019-11-03','1','43','12','62');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('767.2','775','1565','1735.7','14665.8','9575.4','34103.7','37294','2019-11-03','1','44','13','62');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('1782.1','1218.6','1118','1471','0','0','0','0','2019-11-03','1','45','14','62');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('4137.8','3333.9','2460','2831.7','25211.2','17134.2','55297.1','49712','2019-11-03','1','46','15','62');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('3740.7','3807.3','1728','2862.6','17815.5','16754','59550.1','57307','2019-11-03','1','47','17','62');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('2731.1','1597','1834.5','1953.5','11065.6','10861.8','46374.4','45103','2019-11-03','1','48','16','62');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('1264.6','1397.4','1754.9','1621.6','34560','11707.9','10801.2','36429','2019-11-03','1','49','18','62');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('2321.1','1533.6','1710.1','1725.6','10085.5','13516.5','35972.5','38764','2019-11-03','1','50','19','62');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('358.4','1843','2716.1','2674.5','21384.3','22404.2','46222.6','51613','2019-11-03','1','51','20','62');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('510.2','2245.3','1507.4','1759.7','11831.2','12841.2','29553.5','27941','2019-11-03','1','52','21','62');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('1634.8','2667.2','3034.9','3597.4','24831.9','20080.1','62722','58405','2019-11-03','1','53','22','62');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('232.8','206','2494.1','2874','23656.6','21767.4','46996.8','44839','2019-11-03','1','54','23','62');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('597.2','507.5','3239.1','3181.7','10926','23467','76241.5','62727','2019-11-03','1','55','24','62');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('0','4','1706.5','1864.3','12864.7','12569.8','33833.5','32424','2019-11-03','1','56','25','62');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('100.3','235.8','456.2','501.1','2935.6','2890.1','11490','10026','2019-11-03','1','57','26','62');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('0','0','0','0','0','0','0','0','2019-11-03','1','58','27','62');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('4582.7','11353.5','1762.2','2013.2','0','0','0','0','2019-11-03','1','59','28','62');
INSERT INTO `impuesto` (`venta35_plan`,`ventas35_vreal`,`ventas2_plan`,`ventas2_vreal`,`especial17_vreal`,`especial17_real2`,`recupercion_vreal`,`recuperacion_plan`,`fecha`,`status`,`id`,`empresaid`,`anexoid`) VALUES
('0','0','0','0','0','0','0','0','2019-11-03','1','60','29','62');



-- -------------------------------------------
-- TABLE DATA indicadores_evaluacion
-- -------------------------------------------
INSERT INTO `indicadores_evaluacion` (`id`,`descripcion`,`active`) VALUES
('1','(Resultados del trabajo): 
Influencia en el estado de la contabilidad, el comportamiento de las inversiones, los inventarios, las cuentas por cobrar y pagar, la correcta contratación económica y la marcha de los procesos vinculados a la inversión extranjera. Labor en la protección al consumidor. 

','1');
INSERT INTO `indicadores_evaluacion` (`id`,`descripcion`,`active`) VALUES
('2','Ejemplaridad, exigencia y autoridad ante el colectivo. Cumplimiento de los principios éticos y la disciplina laboral.
Tener en cuenta los resultados del proceso de “recomprobación”  realizado al cuadro.
','1');
INSERT INTO `indicadores_evaluacion` (`id`,`descripcion`,`active`) VALUES
('3','Resultados en la aplicación de lo establecido en el Sistema de Trabajo con los Cuadros y sus Reservas.
Contar al menos con una “reserva inmediata” lista para asumir el cargo (Sustituto Legal). 
Profundidad y rigor con que realizó los procesos de aprobación y de “recomprobación” a sus cuadros, funcionarios y trabajadores designados subordinados.
','1');
INSERT INTO `indicadores_evaluacion` (`id`,`descripcion`,`active`) VALUES
('4','Efectividad en el Sistema de Control Interno.','1');
INSERT INTO `indicadores_evaluacion` (`id`,`descripcion`,`active`) VALUES
('5','Cumplimiento de la disciplina informativa.','1');
INSERT INTO `indicadores_evaluacion` (`id`,`descripcion`,`active`) VALUES
('6','Capacidad laboral y de dirección.
Atención y preparación brindada a los jóvenes, en particular a los recién graduados
','1');
INSERT INTO `indicadores_evaluacion` (`id`,`descripcion`,`active`) VALUES
('7','Resultados que obtiene en su preparación. 
Preparación política-ideológica que posee. Valorar si se encuentra “habilitado” para el cabal desempeño del cargo que ocupa.  
','1');
INSERT INTO `indicadores_evaluacion` (`id`,`descripcion`,`active`) VALUES
('8','Resultados del trabajo
Influencia en el estado de la contabilidad, el comportamiento de las inversiones, los inventarios, las cuentas por cobrar y pagar, la correcta contratación económica y la marcha de los procesos vinculados a la inversión extranjera. Labor en la protección al consumidor.
','1');



-- -------------------------------------------
-- TABLE DATA indicadores_gestion
-- -------------------------------------------
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Completamiento de la plantilla de cuadros.','2020-11-12','1','2','%','1','1','1','1','1','1');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Expediente y plantilla de datos actualizados (RS-1.3-306)','2019-05-30','2','2','%','2','2','1','1','1','1');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Re comprobación de Cuadros con mayores riesgos.','2019-05-30','3','2','%','3','3','1','1','1','1');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Completamiento de los sustitutos legales por cargo (Un sustituto legal por cargo).','2019-05-30','4','2','%','4','4','1','1','1','1');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Completamiento de la reserva preparada de cuadros (Al menos dos reservas por cargo).','2019-05-30','5','2','%','5','5','1','1','1','1');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Gasto de Salario x Peso de Valor Agregado Bruto (D Máximo)','2019-05-30','6','3','$','6','1','2','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Estructura del fondo de salario','2019-05-30','7','3','MMP','7','2','2','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Promedio de Trabajadores','2019-05-30','8','3','UNO','8','3','2','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Productividad del Trabajo','2019-05-30','9','3','$','9','4','2','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Correlación Salario Medio Productividad','2019-05-30','10','3','$','10','5','2','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Ausentismo','2019-05-30','11','3','%','11','6','2','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Utilización del fondo de tiempo','2019-05-30','12','3','$','12','7','2','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Circulación Mercantil Mayorista (D Mínimo)','2019-05-30','13','6','MMCUP','13','1','3','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Ventas Netas Totales (D Mínimo)','2019-05-30','14','6','MMP','14','2','3','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Efectividad en el cobro de deudas.','2019-05-30','15','6','%','15','3','3','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Ciclo de aprovisionamiento de la canasta familiar normada.','2019-05-30','16','6','Días','16','4','3','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Ciclo de aprovisionamiento de las dietas.','2019-05-30','17','6','Días','17','5','3','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Ciclo de aprovisionamiento del consumo social.','2019-05-30','18','6','Días','18','6','3','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Efectividad de las reclamaciones.','2019-05-30','19','6','%','19','7','3','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Efectividad de las demandas.','2019-05-30','20','6','%','20','8','3','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Utilidad antes de Impuesto (D Mínimo)','2019-05-30','21','12','MMP','21','1','4','1','0','1');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Utilidad antes de Impuesto por $ de VAB (D Mínimo)','2019-05-30','22','12','$','22','2','4','1','0','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Gasto total x $ de Ingreso total (D Máximo)','2019-05-30','23','12','$','23','3','4','1','0','1');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Valor Agregado Bruto ','2019-05-30','24','12','MMP','24','4','4','1','0','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Importaciones totales (D Máximo)','2019-05-30','25','12','MCUC','25','5','4','1','0','1');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Créditos comerciales externos totales (D Máximo)','2019-05-30','26','12','MCUC','26','6','4','1','0','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Demanda compra de divisas total (D Máximo)','2019-05-30','27','12','MCUC','27','7','4','1','0','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Inversiones Nominales','2019-05-30','28','12','MP','28','8','4','1','0','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Nominales','2019-05-30','29','12','MP','29','9','4','1','0','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Inversiones No Nominales','2019-05-30','30','12','MP','30','10','4','1','0','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Plan de Preparación Fondos Básicos (D Mínimo)','2019-05-30','31','12','MP','31','11','4','1','0','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Energía eléctrica','2019-05-30','32','10','Kw/H','32','1','5','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Diésel','2019-05-30','33','10','t','33','2','5','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Gasolina','2019-05-30','34','10','t','34','3','5','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('GLP','2019-05-30','35','10','t','35','4','5','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Solvente','2019-05-30','36','10','t','36','5','5','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Lubricante','2019-05-30','37','10','t','37','6','5','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Gas Manufacturado.','2019-05-30','38','10','m3','38','7','5','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Recuperación de Almacenes (D Mínimo).','2019-05-30','39','10','MP','39','8','5','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Programa de Recuperación de Frigorífico e Instalación de Equipo de Refrigeración.','2019-05-30','40','10','MP','40','9','5','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Programa de Recuperación de Frigoríficos.','2019-05-30','41','10','MP','41','10','5','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Coeficiente de disponibilidad técnica de medios informáticos.','2019-05-30','42','10','%','42','11','5','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Efectividad en el uso de enlaces, tecnología móvil y servicios de redes.','2019-05-30','43','10','%/Emp','43','12','5','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Acciones para la implementación de la estrategia general de la OSDE.','2019-05-30','44','9','%','44','1','6','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Implementación de la base reglamentaria.','2019-05-30','45','9','%','45','2','6','1','1','1');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Control del funcionamiento de los ODC según el Reglamento.','2019-05-30','46','9','%','46','3','6','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Implantación del Sistema de Dirección y Gestión Empresarial en las empresas.','2019-05-30','47','9','UNO','47','4','6','1','1','1');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Desarrollo del Fórum de Ciencia y Técnica','2019-05-30','48','9','UNO','48','5','6','1','1','1');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Acciones para la implementación de la estrategia de informatización.','2019-05-30','49','9','%','49','6','6','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Implementación de la Comunicación Institucional.','2019-05-30','50','9','%','50','7','6','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Implementación de la Calidad Total en la OSDE.','2019-05-30','51','9','%','51','8','6','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Implementación del Sistema Informativo en la OSDE.','2019-05-30','52','9','UNO','52','9','6','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Control automatizado del inventario en tiempo real.','2019-05-30','53','9','%','53','10','6','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Gestión de Proyectos','2019-05-30','54','9','%','54','11','6','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Completamiento de la plantilla de auditores en las empresas y la OSDE.','2019-05-30','55','5','%','55','1','7','1','1','1');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Cumplimiento del Plan de auditoría, supervisión y control','2019-05-30','56','5','%','56','2','7','1','1','1');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Tiempo efectivo de detección del hecho','2019-05-30','57','5','UNO','57','3','7','1','1','1');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Daño económico (razonabilidad) [Menor impacto del hecho delictivo]','2019-05-30','58','5','%','58','4','7','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Tamaño de la cadena delictiva (Cantidad de Personas Implicadas en el hecho)','2019-05-30','59','5','Promedio','59','5','7','1','1','1');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Tiempo efectivo para la culminación de procesos investigativos de faltante y sobrante.','2019-05-30','60','5','Días','60','6','7','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('Tiempo efectivo para la culminación del proceso de aprobación PHC.','2019-05-30','61','5','Días','61','7','7','1','1','0');
INSERT INTO `indicadores_gestion` (`descripcion`,`fecha_chequeo`,`id`,`direccionid`,`UM`,`topeid`,`orden`,`objetivoid`,`editable`,`status`,`evaluado`) VALUES
('kjdmlfks;xsdkjskj;j;l','2019-05-23','63','6','%','66','1','4','1','0','0');



-- -------------------------------------------
-- TABLE DATA informacion_laboratorios
-- -------------------------------------------
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('1','11','9','9','9','0','2019-07-27','0','2');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('2','12','5','5','5','0','2019-07-27','0','2');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('3','13','3','3','3','0','2019-07-27','0','2');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('4','14','4','4','4','0','2019-07-27','0','2');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('5','15','6','3','1','5','2019-07-27','0','2');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('6','17','5','5','5','0','2019-07-27','0','2');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('7','16','14','14','14','0','2019-07-27','0','2');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('8','18','6','6','6','0','2019-07-27','0','2');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('9','19','6','6','6','0','2019-07-27','0','2');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('10','20','11','10','10','1','2019-07-27','0','2');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('11','21','9','9','9','0','2019-07-27','0','2');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('12','22','14','14','14','0','2019-07-27','0','2');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('13','23','14','14','14','0','2019-07-27','0','2');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('14','24','12','11','11','1','2019-07-27','0','2');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('15','25','8','6','6','2','2019-07-27','0','2');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('16','26','1','1','1','0','2019-07-27','0','2');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('17','28','2','2','2','0','2019-07-27','0','2');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('18','11','9','9','9','0','2019-11-03','1','56');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('19','12','5','5','5','0','2019-11-03','1','56');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('20','13','3','3','3','0','2019-11-03','1','56');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('21','14','4','4','4','0','2019-11-03','1','56');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('22','15','6','3','1','5','2019-11-03','1','56');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('23','17','5','5','5','0','2019-11-03','1','56');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('24','16','14','14','14','0','2019-11-03','1','56');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('25','18','6','6','6','0','2019-11-03','1','56');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('26','19','6','6','6','0','2019-11-03','1','56');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('27','20','11','10','10','1','2019-11-03','1','56');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('28','21','9','9','9','0','2019-11-03','1','56');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('29','22','14','14','14','0','2019-11-03','1','56');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('30','23','14','14','14','0','2019-11-03','1','56');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('31','24','12','11','11','1','2019-11-03','1','56');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('32','25','8','6','6','2','2019-11-03','1','56');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('33','26','1','1','1','0','2019-11-03','1','56');
INSERT INTO `informacion_laboratorios` (`id`,`empresaid`,`cant`,`terminados`,`cant_func`,`cant_no_func`,`fecha`,`status`,`anexoid`) VALUES
('34','28','2','2','2','0','2019-11-03','1','56');



-- -------------------------------------------
-- TABLE DATA ingresos_monetarios
-- -------------------------------------------
INSERT INTO `ingresos_monetarios` (`id`,`tipo_familiarid`,`tipo_ingresosid`) VALUES
('11','2','2');
INSERT INTO `ingresos_monetarios` (`id`,`tipo_familiarid`,`tipo_ingresosid`) VALUES
('12','5','1');
INSERT INTO `ingresos_monetarios` (`id`,`tipo_familiarid`,`tipo_ingresosid`) VALUES
('13','5','1');
INSERT INTO `ingresos_monetarios` (`id`,`tipo_familiarid`,`tipo_ingresosid`) VALUES
('14','2','3');
INSERT INTO `ingresos_monetarios` (`id`,`tipo_familiarid`,`tipo_ingresosid`) VALUES
('15','1','2');
INSERT INTO `ingresos_monetarios` (`id`,`tipo_familiarid`,`tipo_ingresosid`) VALUES
('16','3','3');
INSERT INTO `ingresos_monetarios` (`id`,`tipo_familiarid`,`tipo_ingresosid`) VALUES
('17','2','2');
INSERT INTO `ingresos_monetarios` (`id`,`tipo_familiarid`,`tipo_ingresosid`) VALUES
('18','3','1');
INSERT INTO `ingresos_monetarios` (`id`,`tipo_familiarid`,`tipo_ingresosid`) VALUES
('19','5','3');
INSERT INTO `ingresos_monetarios` (`id`,`tipo_familiarid`,`tipo_ingresosid`) VALUES
('20','2','1');
INSERT INTO `ingresos_monetarios` (`id`,`tipo_familiarid`,`tipo_ingresosid`) VALUES
('21','2','1');
INSERT INTO `ingresos_monetarios` (`id`,`tipo_familiarid`,`tipo_ingresosid`) VALUES
('22','5','4');
INSERT INTO `ingresos_monetarios` (`id`,`tipo_familiarid`,`tipo_ingresosid`) VALUES
('23','5','2');
INSERT INTO `ingresos_monetarios` (`id`,`tipo_familiarid`,`tipo_ingresosid`) VALUES
('24','5','4');
INSERT INTO `ingresos_monetarios` (`id`,`tipo_familiarid`,`tipo_ingresosid`) VALUES
('25','5','2');



-- -------------------------------------------
-- TABLE DATA limitaciones
-- -------------------------------------------
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('1','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('2','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('3','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('4','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('5','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('6','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('7','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('8','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('9','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('10','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('11','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('12','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('13','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('14','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('15','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('16','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('17','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('18','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('19','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('20','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('21','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('22','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('23','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('24','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('25','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('26','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('27','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('28','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('29','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('30','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('31','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('32','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('33','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('34','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('35','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('36','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('37','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('38','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('39','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('40','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('41','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('42','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('43','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('44','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('45','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('46','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('47','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('48','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('50','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('51','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('52','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('53','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('54','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('55','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('56','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('57','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('58','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('59','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('60','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('61','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('62','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('63','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('64','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('65','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('66','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('67','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('68','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('69','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('70','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('71','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('72','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('73','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('74','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('75','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('76','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('77','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('78','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('79','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('80','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('81','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('82','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('83','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('84','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('85','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('86','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('87','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('88','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('89','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('90','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('91','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('94','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('98','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('101','Falta de aire ');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('116','problemas en la vista');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('136','problemas en la vista');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('138','problemas en la rodilla');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('141','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('145','sangrado nasal');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('146','sangrado nasal');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('151','polvo');
INSERT INTO `limitaciones` (`id`,`limitacion`) VALUES
('160','polvo');



-- -------------------------------------------
-- TABLE DATA limitaciones_salud
-- -------------------------------------------
INSERT INTO `limitaciones_salud` (`limitacionesid`,`saludid`) VALUES
('101','226');
INSERT INTO `limitaciones_salud` (`limitacionesid`,`saludid`) VALUES
('116','241');
INSERT INTO `limitaciones_salud` (`limitacionesid`,`saludid`) VALUES
('136','261');
INSERT INTO `limitaciones_salud` (`limitacionesid`,`saludid`) VALUES
('138','263');
INSERT INTO `limitaciones_salud` (`limitacionesid`,`saludid`) VALUES
('141','266');
INSERT INTO `limitaciones_salud` (`limitacionesid`,`saludid`) VALUES
('145','270');
INSERT INTO `limitaciones_salud` (`limitacionesid`,`saludid`) VALUES
('146','271');
INSERT INTO `limitaciones_salud` (`limitacionesid`,`saludid`) VALUES
('151','276');
INSERT INTO `limitaciones_salud` (`limitacionesid`,`saludid`) VALUES
('160','285');



-- -------------------------------------------
-- TABLE DATA lugares_residencia
-- -------------------------------------------
INSERT INTO `lugares_residencia` (`id`,`cuadroid`,`fecha_inicio`,`fecha_fin`,`direccionesid`,`actual`) VALUES
('15','44','1980-09-29','1997-03-25','380','0');
INSERT INTO `lugares_residencia` (`id`,`cuadroid`,`fecha_inicio`,`fecha_fin`,`direccionesid`,`actual`) VALUES
('30','59','1991-07-24','1999-05-16','410','0');
INSERT INTO `lugares_residencia` (`id`,`cuadroid`,`fecha_inicio`,`fecha_fin`,`direccionesid`,`actual`) VALUES
('50','79','1991-07-24','1999-05-16','450','0');
INSERT INTO `lugares_residencia` (`id`,`cuadroid`,`fecha_inicio`,`fecha_fin`,`direccionesid`,`actual`) VALUES
('51','81','2020-10-02','2020-09-09','453','0');
INSERT INTO `lugares_residencia` (`id`,`cuadroid`,`fecha_inicio`,`fecha_fin`,`direccionesid`,`actual`) VALUES
('54','84','1970-07-23','0000-00-00','459','0');
INSERT INTO `lugares_residencia` (`id`,`cuadroid`,`fecha_inicio`,`fecha_fin`,`direccionesid`,`actual`) VALUES
('56','87','2020-05-01','2020-05-09','465','0');
INSERT INTO `lugares_residencia` (`id`,`cuadroid`,`fecha_inicio`,`fecha_fin`,`direccionesid`,`actual`) VALUES
('57','88','2020-05-01','2020-05-09','467','0');
INSERT INTO `lugares_residencia` (`id`,`cuadroid`,`fecha_inicio`,`fecha_fin`,`direccionesid`,`actual`) VALUES
('58','89','2020-08-21','2020-08-21','473','0');
INSERT INTO `lugares_residencia` (`id`,`cuadroid`,`fecha_inicio`,`fecha_fin`,`direccionesid`,`actual`) VALUES
('65','96','2020-08-21','2020-08-21','489','0');



-- -------------------------------------------
-- TABLE DATA migration
-- -------------------------------------------
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m000000_000000_base','1606356597');
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m140506_102106_rbac_init','1606359745');
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m170907_052038_rbac_add_index_on_auth_assignment_user_id','1606359746');
INSERT INTO `migration` (`version`,`apply_time`) VALUES
('m180523_151638_rbac_updates_indexes_without_prefix','1606359747');



-- -------------------------------------------
-- TABLE DATA miitancia_politic
-- -------------------------------------------
INSERT INTO `miitancia_politic` (`id`,`tipo`) VALUES
('1','UJC');
INSERT INTO `miitancia_politic` (`id`,`tipo`) VALUES
('2','PCC');
INSERT INTO `miitancia_politic` (`id`,`tipo`) VALUES
('3','Sin mitilancia');



-- -------------------------------------------
-- TABLE DATA militancia
-- -------------------------------------------
INSERT INTO `militancia` (`id`,`tipo`) VALUES
('1','FAR');
INSERT INTO `militancia` (`id`,`tipo`) VALUES
('2','MININT');
INSERT INTO `militancia` (`id`,`tipo`) VALUES
('3','RESERVA');



-- -------------------------------------------
-- TABLE DATA movimiento_cuadro
-- -------------------------------------------
INSERT INTO `movimiento_cuadro` (`id`,`causas_sustitucion`,`sintesis_biografica`,`resultados_controles`,`fundamentacion`,`consideraciones`,`entidad`,`idcargo_propuesto`,`tipo_movimientoid`,`cuadroid`,`cuadro_sustituido`,`evaluacion_cuadroid`,`status`,`aprobada`) VALUES
('5','MSNSDKJNSK','El Bar-parrillada Melesio Grill posee una afluencia de público que en ocasiones solo se acerca para informarse de las ofertas del mismo, lo que provoca personal ocupando espacios que no consumen, sumado todo esto a la disposición espacial del local hace que la gestión de las ventas y la atención a los clientes se ve demorada. La información de los pedidos es llevada de forma manual provocando errores en el saldo de las cuentas de los clientes debido a la asignación de pedidos cancelados o no hechos y el lógico disgusto de los clientes asistentes al local. Las propuestas culturales ofrecidas en local no son bien divulgadas y debido a esto se pierde un sector importante de posibles consumidores de los servicios ofertados. ','- Cumplimiento de cada uno de los requisitos establecidos para el cargo

- Resultados de las comprobaciones, verificaciones, tomas de opiniones con los órganos del MININT y organizaciones del PCC, Sindicato, Jefes Administrativos y otros factores de interés de las  entidades anteriores y de la entidad actual, de la comunidad, u otras acciones que sean necesarias

- Los que no son militantes del PCC y de la UJC, conocer y explicar las causas por lo que no lo son, y de los que han sido procesados y no fueron aprobados como militantes

- En los casos de los que han sido objeto de cualquier tipo de sanción,  profundizar y valorar las causas, tipo de medida, la fecha de aplicada y si se encuentran rehabilitados 
','PRIMERO: El Jefe del Órgano de Cuadros debe ser intransigente y no permitir que se presente al análisis de la Comisión de Cuadros, un DC-52 que no cumpla con la calidad, el rigor establecido y con las precisiones antes señaladas. De ser una decisión indic','PRIMERO: El Jefe del Órgano de Cuadros debe ser intransigente y no permitir que se presente al análisis de la Comisión de Cuadros, un DC-52 que no cumpla con la calidad, el rigor establecido y con las precisiones antes señaladas. De ser una decisión indicada por el Presidente o Director,  de someter un DC-52 sin la calidad y el rigor aquí precisado, a la Comisión de Cuadros,  el Jefe del Órgano de Cuadros debe exponerlo por escrito en estas consideraciones.

SEGUNDO: Aunque la propuesta de movimiento de cuadro la presente una entidad subordinada, estas consideraciones las elabora el Jefe del Órgano de Cuadros del nivel inmediato superior, es decir de la Comisión de Cuadros que aprobará el movimiento, por ejemplo, aunque el Director de una empresa sea el que presente la propuesta para Segundo Jefe o Sustituto Legal, para que sea aprobada por la Comisión de Cuadros del OSDE, quien elabora las consideraciones es el Jefe del Órgano de Cuadros del Grupo Empresarial. 
','CUPET','2','2','59','79','16','0','1');



-- -------------------------------------------
-- TABLE DATA municipio
-- -------------------------------------------
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('1','Consolación del Sur','1');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('2','Guane','1');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('3','Las Palmas','1');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('4','Los Palacion','1');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('5','Mantua','1');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('6','Minas de Matahambre','1');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('8','Pinar Del Rio','1');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('9','San Juan y Martínez','1');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('10','San Luis','1');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('11','Sandino','1');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('12','Viñales','1');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('13','Mariel','2');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('14','Guanajay','2');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('15','Caimito','2');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('16','Bauta','2');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('17','San Antonio De Lo Baños','2');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('18','Güira de Melena','2');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('19','Alquízar','2');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('20','Artemisa','2');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('21','Bahía Honda','2');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('22','Candelario','2');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('23','San Critobal','2');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('24','Boyeros','3');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('25','Centro Habana','3');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('26','Cerro','3');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('27','Cotorro','3');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('28','Diez de Octubre','3');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('29','Guanabacoa','3');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('30','Habana Del Este','3');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('31','Habana Vieja','3');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('32','La lisa','3');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('33','Marianao','3');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('34','Playa','3');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('35','Plaza De La Revolución','3');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('36','Regla','3');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('37','San Miguel Del Padrón','3');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('39','Arroyo Naranjo','3');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('40','Bejucal','4');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('41','San José de las Lajas','4');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('42','Jaruco','4');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('43','Santa Cruz del Norte','4');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('44','Madruga','4');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('45','Nueva Paz','4');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('46','San Nicolás de Bari','4');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('47','Güines','4');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('48','Melena del Sur','4');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('49','Batabanó','4');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('50','Quivicán','4');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('51','Calimete','5');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('52','Cárdenas','5');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('53','Ciénaga de Zapata','5');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('54','Colón','5');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('55','Jagüey Grande','5');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('56','Jovellanos','5');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('57','Limonar','5');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('58','Los Arabos','5');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('59','Jovellanos','5');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('60','Martí','5');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('61','Matanzas','5');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('62','Pedro Betancourt','5');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('63','Perico','5');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('64','Unión de Reyes','5');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('65','Abreus','6');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('66','Aguada de Pasajeros','6');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('67','Abreus','6');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('68','Aguada de Pasajeros','6');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('69','Cienfuegos','6');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('70','Cruces','6');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('71','Cumanayagua','6');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('72','Lajas','6');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('73','Palmira','6');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('74','Rodas','6');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('75','Caibarién','7');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('76',' Camajuaní','7');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('77','Cifuentes','7');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('78','Corralillo','7');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('79',' Encrucijada','7');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('80','Manicaragua','7');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('81',' Placetas','7');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('82','Quemado de Güines','7');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('83','Ranchuelo','7');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('84','Remedios','7');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('85','Sagua la Grande','7');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('86',' Santa Clara','7');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('87','Santo Domingo ','7');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('88','Sancti Spíritus
','8');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('89','Trinidad
','8');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('90','Yaguajay','8');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('91','Jatibonico','8');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('92','Taguasco','8');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('93','Fomento','8');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('94','La Sierpe','8');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('95',' Ciego de Ávila','9');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('96',' Morón','9');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('97','Chambas','9');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('98','Ciro Redondo','9');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('99',' Majagua','9');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('100','Florencia','9');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('101','Venezuela','9');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('102','Baraguá','9');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('103','Primero de Enero','9');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('104','Bolivia','9');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('105',' Camagüey ','10');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('106','Guáimaro','10');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('107',' Nuevitas ','10');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('108','Céspedes','10');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('109','Jimaguayú','10');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('110','Sibanicú','10');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('111','Esmeralda','10');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('112',' Minas ','10');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('113','Sierra de Cubitas','10');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('114','Florida','10');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('115','Najasa','10');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('116','Vertientes','10');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('117','Santa Cruz del Sur','10');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('118','Manatí','11');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('119','Puerto Padre','11');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('120','Jesús Menéndez','11');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('121','Majibacoa','11');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('122','Las Tunas','11');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('123','Jobabo','11');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('124','Colombia','11');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('125',' Amancio ','11');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('126','Bartolomé Masó','12');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('127','Bayamo','12');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('128','Buey Arriba','12');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('129','Campechuela','12');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('130','Cauto Cristo','12');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('131','Guisa','12');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('132','Jiguaní','12');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('133','Manzanillo','12');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('134','Media Luna','12');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('135','Niquero','12');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('136','Pilón','12');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('137','Río Cauto','12');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('138','Yara','12');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('139','Antilla','13');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('140','Báguanos','13');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('141','Banes','13');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('142','Cacocum','13');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('143','Calixto García','13');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('144','Cueto','13');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('145','Frank País','13');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('146','Gibara','13');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('147','Holguín','13');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('148','Mayarí','13');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('149','Moa','13');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('150','Rafael Freyre','13');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('151','Sagua de Tánamo','13');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('152','Urbano Noris','13');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('153','Contramaestre','14');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('154','Guamá','14');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('155','Mella','14');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('156','Palma Soriano','14');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('157','San Luis','14');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('158','San Luis','14');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('159','Santiago de Cuba','14');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('160','Segundo Frente','14');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('161','Songo-La Maya','14');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('162','Tercer Frente','14');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('163','Baracoa','15');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('164','Caimanera','15');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('165','El Salvador','15');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('166','Guantánamo','15');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('167','Imías','15');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('168','Maisí','15');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('169','Manuel Tames','15');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('170','Niceto Pérez','15');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('171','San Antonio del Sur	','15');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('172','Yateras','15');
INSERT INTO `municipio` (`id`,`municipio`,`provinciaid`) VALUES
('173','Isla De La Juventud','16');



-- -------------------------------------------
-- TABLE DATA nivel_escolaridad
-- -------------------------------------------
INSERT INTO `nivel_escolaridad` (`id`,`tipo`) VALUES
('0','9no grado');
INSERT INTO `nivel_escolaridad` (`id`,`tipo`) VALUES
('1','Pre-universitario');
INSERT INTO `nivel_escolaridad` (`id`,`tipo`) VALUES
('2','Universitario');



-- -------------------------------------------
-- TABLE DATA objetivo
-- -------------------------------------------
INSERT INTO `objetivo` (`id`,`orden`,`nombre`,`abreviatura`,`descripcion`,`fechaAct`,`responsable`,`Status`,`fechaDesac`) VALUES
('1','1','Objetivo de Trabajo No.1','Obj1','Garantizar que el 100% de los cuadros y sus reservas, comparten los valores morales y las competencias gerenciales que aseguran la efectividad en la comercialización mayorista de alimentos.','2019-05-01','2','1','0000-00-00');
INSERT INTO `objetivo` (`id`,`orden`,`nombre`,`abreviatura`,`descripcion`,`fechaAct`,`responsable`,`Status`,`fechaDesac`) VALUES
('2','2','Objetivo de Trabajo No.2','Obj2','Garantizar las competencias laborales necesarias para el 100% de los trabajadores que ocupan puestos claves en las empresas y el grupo.','2019-04-01','3','1','0000-00-00');
INSERT INTO `objetivo` (`id`,`orden`,`nombre`,`abreviatura`,`descripcion`,`fechaAct`,`responsable`,`Status`,`fechaDesac`) VALUES
('3','3','Objetivo de Trabajo No.3','Obj3','Incrementar en un 20% la efectividad en las operaciones comerciales, logrando alcanzar crecimientos en el mercado y en la satisfacción de los clientes.','2019-04-01','6','1','0000-00-00');
INSERT INTO `objetivo` (`id`,`orden`,`nombre`,`abreviatura`,`descripcion`,`fechaAct`,`responsable`,`Status`,`fechaDesac`) VALUES
('4','4','Objetivo de Trabajo No.4','Obj4','Garantizar el crecimiento del capital de trabajo, la implementación de la contabilidad de gestión y la razonabilidad de los estados financieros para el desarrollo económico sostenible de la comercialización mayorista en el 100% de las empresas.','2019-04-01','12','0','0000-00-00');
INSERT INTO `objetivo` (`id`,`orden`,`nombre`,`abreviatura`,`descripcion`,`fechaAct`,`responsable`,`Status`,`fechaDesac`) VALUES
('5','5','Objetivo de Trabajo No.5','Obj5','Asegurar, en todas las empresas del grupo, el incremento de categoría en la infraestructura logística así como el mantenimiento y mejora de otros medios tecnológicos necesarios a la comercialización mayorista de alimentos.','2019-04-01','10','1','0000-00-00');
INSERT INTO `objetivo` (`id`,`orden`,`nombre`,`abreviatura`,`descripcion`,`fechaAct`,`responsable`,`Status`,`fechaDesac`) VALUES
('6','6','Objetivo de Trabajo No.6','Obj6','Lograr el desarrollo científico tecnológico con alcance al 100% del sistema de dirección y gestión de la cadena de suministro.','2019-04-01','9','1','0000-00-00');
INSERT INTO `objetivo` (`id`,`orden`,`nombre`,`abreviatura`,`descripcion`,`fechaAct`,`responsable`,`Status`,`fechaDesac`) VALUES
('7','7','Objetivo de Trabajo No.7','Obj7','Alcanzar un 90% de confiabilidad en las operaciones de las empresas del grupo, a través de la gestión y control de los riesgos asociados a las operaciones y toma de decisiones en la cadena de suministro de productos alimenticios.','2019-04-01','5','1','0000-00-00');
INSERT INTO `objetivo` (`id`,`orden`,`nombre`,`abreviatura`,`descripcion`,`fechaAct`,`responsable`,`Status`,`fechaDesac`) VALUES
('8','3','Objetivo 3','OBJ 3','Lograr confiabilidad en la cadena de suministro de alimentos','2020-11-17','6','1','');



-- -------------------------------------------
-- TABLE DATA opinion_evaluado
-- -------------------------------------------
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('1','0','0','dfsdfdffsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('2','0','0','dfsdfdffsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('3','0','0','dfsdfdffsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('4','0','0','dfsdfdffsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('5','0','0','dfsdfdffsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('6','0','0','dfsdfdffsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('7','0','0','dfsdfdffsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('8','0','0','dfsdfdffsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('9','0','0','dfsdfdffsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('10','0','0','dfsdfdffsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('11','0','0','dfsdfdffsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('12','0','0','dfsdfdffsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('13','0','0','dfsdfdffsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('14','0','0','dfsdfdffsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('15','0','0','dfsdfdffsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('16','0','0','dfsdfdffsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('17','0','0','dfsdfdffsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('18','0','0','dfsdfdffsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('19','0','0','dfsdfdffsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('20','0','0','dfsdfdffsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('21','0','0','dfsdfdffsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('22','0','0','dfsdfdffsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('23','0','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('24','1','1','mnd skl,sknflsd');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('25','0','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('26','0','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('27','0','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('28','0','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('29','0','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('30','0','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('31','0','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('32','0','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('33','0','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('34','0','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('35','0','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('36','0','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('37','0','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('38','0','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('39','1','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('40','1','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('41','1','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('42','1','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('43','1','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('44','1','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('45','0','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('46','0','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('47','1','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('48','1','1','klsjdkjskdj');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('49','0','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('50','0','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('51','0','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('52','0','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('53','0','0','');
INSERT INTO `opinion_evaluado` (`id`,`opinion`,`reclamacion`,`reclamacion_desc`) VALUES
('54','0','0','');



-- -------------------------------------------
-- TABLE DATA organismo
-- -------------------------------------------
INSERT INTO `organismo` (`idorganismo`,`organismo`,`Status`) VALUES
('1','Educación','1');
INSERT INTO `organismo` (`idorganismo`,`organismo`,`Status`) VALUES
('2','Salud','1');
INSERT INTO `organismo` (`idorganismo`,`organismo`,`Status`) VALUES
('3','Comercio','1');
INSERT INTO `organismo` (`idorganismo`,`organismo`,`Status`) VALUES
('4','Cimex','1');
INSERT INTO `organismo` (`idorganismo`,`organismo`,`Status`) VALUES
('5','Aduana','1');
INSERT INTO `organismo` (`idorganismo`,`organismo`,`Status`) VALUES
('6','Transporte','1');
INSERT INTO `organismo` (`idorganismo`,`organismo`,`Status`) VALUES
('7','Gastronomia ','0');
INSERT INTO `organismo` (`idorganismo`,`organismo`,`Status`) VALUES
('8','Energia','1');
INSERT INTO `organismo` (`idorganismo`,`organismo`,`Status`) VALUES
('9','Cultura','1');
INSERT INTO `organismo` (`idorganismo`,`organismo`,`Status`) VALUES
('10','MIC','1');



-- -------------------------------------------
-- TABLE DATA perdida_investigacion
-- -------------------------------------------
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('1','600591','27','0','0','1','11','2019-11-03','1','57');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('2','17209','52','0','0','1','12','2019-11-03','1','57');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('3','26830.4','5','0','0','1','13','2019-11-03','1','57');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('4','2288860','58','16','2167240','1','14','2019-11-03','1','57');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('5','13650100','110','36','3546180','1','15','2019-11-03','1','57');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('6','279676','92','0','0','1','17','2019-11-03','1','57');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('7','17108.6','22','0','0','1','16','2019-11-03','1','57');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('8','314801','24','0','0','1','18','2019-11-03','1','57');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('9','40738400','30','1','35033000','1','19','2019-11-03','1','57');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('10','33485.7','12','0','0','1','20','2019-11-03','1','57');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('11','233664','86','19','34375.8','1','21','2019-11-03','1','57');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('12','341859','67','0','0','1','22','2019-11-03','1','57');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('13','61173.8','45','3','15092.5','1','23','2019-11-03','1','57');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('14','86319600','67','27','86252600','1','24','2019-11-03','1','57');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('15','822331','70','31','745812','1','25','2019-11-03','1','57');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('16','5063.59','6','0','0','1','26','2019-11-03','1','57');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('17','15035400','18','9','14933600','1','31','2019-11-03','1','57');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('18','0','0','0','0','1','27','2019-11-03','1','57');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('19','563154','18','5','123195','1','28','2019-11-03','1','57');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('20','27309.7','5','1','3332.91','1','29','2019-11-03','1','57');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('21','29791.3','10','0','0','1','30','2019-11-03','1','57');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('22','600591','27','0','0','2','11','2020-11-17','1','47');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('23','17209','52','0','0','2','12','2020-11-17','1','47');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('24','26830.4','5','0','0','2','13','2020-11-17','1','47');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('25','2288860','58','16','2167240','2','14','2020-11-17','1','47');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('26','13650100','110','36','3546180','2','15','2020-11-17','1','47');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('27','279676','92','0','0','2','17','2020-11-17','1','47');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('28','17108.6','22','0','0','2','16','2020-11-17','1','47');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('29','314801','24','0','0','2','18','2020-11-17','1','47');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('30','40738400','30','1','35033000','2','19','2020-11-17','1','47');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('31','33485.7','12','0','0','2','20','2020-11-17','1','47');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('32','233664','86','19','34375.8','2','21','2020-11-17','1','47');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('33','341859','67','0','0','2','22','2020-11-17','1','47');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('34','61173.8','45','3','15092.5','2','23','2020-11-17','1','47');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('35','86319600','67','27','86252600','2','24','2020-11-17','1','47');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('36','822331','70','31','745812','2','25','2020-11-17','1','47');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('37','5063.59','6','0','0','2','26','2020-11-17','1','47');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('38','15035400','18','9','14933600','2','31','2020-11-17','1','47');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('39','0','0','0','0','2','27','2020-11-17','1','47');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('40','563154','18','5','123195','2','28','2020-11-17','1','47');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('41','27309.7','5','1','3332.91','2','29','2020-11-17','1','47');
INSERT INTO `perdida_investigacion` (`id`,`importe_total`,`cant_expedientas`,`fuera_termino`,`valor_fuera_termino`,`tipo_expedienteid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('42','29791.3','10','0','0','2','30','2020-11-17','1','47');



-- -------------------------------------------
-- TABLE DATA periodo
-- -------------------------------------------
INSERT INTO `periodo` (`id`,`periodo`) VALUES
('1','1er Trimestre');
INSERT INTO `periodo` (`id`,`periodo`) VALUES
('2','2do trimestre');
INSERT INTO `periodo` (`id`,`periodo`) VALUES
('3','3er trimestre');
INSERT INTO `periodo` (`id`,`periodo`) VALUES
('4','4to trimestre');



-- -------------------------------------------
-- TABLE DATA periodo_evaluado
-- -------------------------------------------
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('1','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('2','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('3','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('4','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('5','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('6','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('7','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('8','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('9','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('10','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('11','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('12','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('13','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('14','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('15','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('16','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('17','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('18','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('19','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('20','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('21','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('22','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('23','2020-09-02','2020-10-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('24','2019-11-24','2020-09-07');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('25','2020-09-16','2020-09-23');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('26','2020-09-22','2020-10-02');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('27','2020-09-22','2020-10-02');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('28','2020-09-22','2020-10-02');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('29','2020-09-22','2020-10-02');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('30','2020-09-15','2020-09-25');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('31','2020-09-15','2020-09-25');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('32','2020-09-15','2020-09-25');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('33','2020-09-15','2020-09-25');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('34','2020-09-15','2020-09-25');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('35','2020-09-15','2020-09-25');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('36','2020-09-15','2020-09-25');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('37','2020-09-15','2020-09-25');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('38','2020-09-15','2020-09-25');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('39','2020-09-15','2020-09-25');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('40','2020-09-15','2020-09-25');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('41','2020-09-15','2020-09-25');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('42','2020-09-15','2020-09-25');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('43','2020-09-15','2020-09-25');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('44','2020-09-15','2020-09-25');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('45','2020-09-15','2020-09-25');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('46','2020-09-15','2020-09-25');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('47','2020-09-15','2020-09-25');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('48','2020-09-15','2020-09-25');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('49','2020-09-15','2020-09-25');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('50','2020-09-15','2020-09-25');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('51','2020-07-28','2020-08-29');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('52','2020-07-28','2020-08-29');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('53','2020-07-28','2020-08-29');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('54','2020-07-28','2020-08-29');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('55','2020-07-28','2020-08-29');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('56','2020-08-27','2020-08-25');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('57','2020-10-26','2020-12-05');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('58','2020-10-26','2020-12-05');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('59','2019-12-04','2020-02-21');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('60','2019-12-04','2020-02-21');
INSERT INTO `periodo_evaluado` (`id`,`desde`,`hasta`) VALUES
('61','2020-05-13','2020-11-26');



-- -------------------------------------------
-- TABLE DATA persona
-- -------------------------------------------
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('12120265645','don juan','castillo ','ruis','0');
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('12121565689','don juan','castillo ','ruis','0');
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('25479666565','Jose Ramon','Cuevas','Frias','0');
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('27946165614','familiar1','f1','f1','1');
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('27946165615','familiar1','casanova','ruis','2');
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('27946165616','familiar1','f1','f1','1');
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('54123698461','Javier','Garcia','Ruis','1');
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('54545454546','olav','valiño','suares','m');
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('54545456546','olav','valiño','suares','m');
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('56033164849','Gloria ','Reyes','Castillo ','1');
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('56896226313','Carlos Javier','Garcia','Olazabal','0');
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('56896226353','Carlos Javier','Garcia','Olazabal','0');
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('63070385748','Pedro ','Gutiérrez ','Lazaga ','1');
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('65457895465','Jorge','Garmendia','Lopez','0');
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('65457895656','Jorge','Garmendia','Lopez','0');
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('67041708462','Marcos','Gutiérrez ','Lazaga','1');
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('69854656564','Ramiro ','Valdes','Peres','1');
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('78110976543','Jesús David','Santiesteban ','Garrido ','0');
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('78123165498','Maria Del Carmen','Valdes','Suarez','0');
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('84120708580','Oniel ','Gutiérrez ','Reyes','1');
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('85113445645','Ricardo','fermin','Ortega','2');
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('89221656516','Roberto','Foncesca','Ramires','2');
INSERT INTO `persona` (`CI`,`Nombre`,`primer_apellido`,`segundo_apellido`,`sexo`) VALUES
('89646313616','Abel','Gerones','Ruis','1');



-- -------------------------------------------
-- TABLE DATA plan_evaluacion
-- -------------------------------------------
INSERT INTO `plan_evaluacion` (`id`,`idevaluador`,`idcuadro`,`fecha`,`status`,`ultima`,`observaciones`) VALUES
('11','33','59','2020-11-25','1','0','diciembre 2019 - febrero 2020');
INSERT INTO `plan_evaluacion` (`id`,`idevaluador`,`idcuadro`,`fecha`,`status`,`ultima`,`observaciones`) VALUES
('12','30','59','2020-11-25','1','0','febrero 2020- noviembre  2020');
INSERT INTO `plan_evaluacion` (`id`,`idevaluador`,`idcuadro`,`fecha`,`status`,`ultima`,`observaciones`) VALUES
('13','30','79','2020-11-25','0','1','');
INSERT INTO `plan_evaluacion` (`id`,`idevaluador`,`idcuadro`,`fecha`,`status`,`ultima`,`observaciones`) VALUES
('14','33','89','2013-05-31','0','1','diciembre 2019 - febrero 2020');
INSERT INTO `plan_evaluacion` (`id`,`idevaluador`,`idcuadro`,`fecha`,`status`,`ultima`,`observaciones`) VALUES
('15','33','44','2020-11-25','0','1','');
INSERT INTO `plan_evaluacion` (`id`,`idevaluador`,`idcuadro`,`fecha`,`status`,`ultima`,`observaciones`) VALUES
('16','33','81','2020-11-25','0','1','');
INSERT INTO `plan_evaluacion` (`id`,`idevaluador`,`idcuadro`,`fecha`,`status`,`ultima`,`observaciones`) VALUES
('17','30','88','2020-11-25','0','1','');
INSERT INTO `plan_evaluacion` (`id`,`idevaluador`,`idcuadro`,`fecha`,`status`,`ultima`,`observaciones`) VALUES
('18','30','59','2020-11-25','0','1','');



-- -------------------------------------------
-- TABLE DATA plantilla
-- -------------------------------------------
INSERT INTO `plantilla` (`id`,`cant_trabajadores`,`cant_cuadros`,`trabajadores_cubierta`,`cuadros_cubierta`,`empresaid`) VALUES
('1','25','23','25','23','30');
INSERT INTO `plantilla` (`id`,`cant_trabajadores`,`cant_cuadros`,`trabajadores_cubierta`,`cuadros_cubierta`,`empresaid`) VALUES
('3','1','2','2','3','15');
INSERT INTO `plantilla` (`id`,`cant_trabajadores`,`cant_cuadros`,`trabajadores_cubierta`,`cuadros_cubierta`,`empresaid`) VALUES
('4','2','1','1','1','26');
INSERT INTO `plantilla` (`id`,`cant_trabajadores`,`cant_cuadros`,`trabajadores_cubierta`,`cuadros_cubierta`,`empresaid`) VALUES
('5','40','24','35','20','14');
INSERT INTO `plantilla` (`id`,`cant_trabajadores`,`cant_cuadros`,`trabajadores_cubierta`,`cuadros_cubierta`,`empresaid`) VALUES
('6','60','25','45','18','31');



-- -------------------------------------------
-- TABLE DATA preparacion_intelectual
-- -------------------------------------------
INSERT INTO `preparacion_intelectual` (`id`,`nivel_escolaridad`,`Especialidad`,`grado_cientifico`,`categoria_docente`,`informatica`) VALUES
('101','1','Veterinaria ','0','0','1');
INSERT INTO `preparacion_intelectual` (`id`,`nivel_escolaridad`,`Especialidad`,`grado_cientifico`,`categoria_docente`,`informatica`) VALUES
('116','2','mecanica naval','2','1','2');
INSERT INTO `preparacion_intelectual` (`id`,`nivel_escolaridad`,`Especialidad`,`grado_cientifico`,`categoria_docente`,`informatica`) VALUES
('136','2','mecanica naval','2','1','2');
INSERT INTO `preparacion_intelectual` (`id`,`nivel_escolaridad`,`Especialidad`,`grado_cientifico`,`categoria_docente`,`informatica`) VALUES
('138','2','Sociologia','3','1','2');
INSERT INTO `preparacion_intelectual` (`id`,`nivel_escolaridad`,`Especialidad`,`grado_cientifico`,`categoria_docente`,`informatica`) VALUES
('141','2','mecanica naval','4','2','4');
INSERT INTO `preparacion_intelectual` (`id`,`nivel_escolaridad`,`Especialidad`,`grado_cientifico`,`categoria_docente`,`informatica`) VALUES
('145','0','termodinamica','0','0','3');
INSERT INTO `preparacion_intelectual` (`id`,`nivel_escolaridad`,`Especialidad`,`grado_cientifico`,`categoria_docente`,`informatica`) VALUES
('146','0','termodinamica','0','0','3');
INSERT INTO `preparacion_intelectual` (`id`,`nivel_escolaridad`,`Especialidad`,`grado_cientifico`,`categoria_docente`,`informatica`) VALUES
('151','1','aduana','0','1','3');
INSERT INTO `preparacion_intelectual` (`id`,`nivel_escolaridad`,`Especialidad`,`grado_cientifico`,`categoria_docente`,`informatica`) VALUES
('160','1','aduana','0','1','2');



-- -------------------------------------------
-- TABLE DATA preparacion_intelectual_idiomas
-- -------------------------------------------
INSERT INTO `preparacion_intelectual_idiomas` (`preparacion_intelectualid`,`idiomasid`,`nivel`) VALUES
('101','2','2');
INSERT INTO `preparacion_intelectual_idiomas` (`preparacion_intelectualid`,`idiomasid`,`nivel`) VALUES
('116','2','2');
INSERT INTO `preparacion_intelectual_idiomas` (`preparacion_intelectualid`,`idiomasid`,`nivel`) VALUES
('136','2','2');
INSERT INTO `preparacion_intelectual_idiomas` (`preparacion_intelectualid`,`idiomasid`,`nivel`) VALUES
('138','2','2');
INSERT INTO `preparacion_intelectual_idiomas` (`preparacion_intelectualid`,`idiomasid`,`nivel`) VALUES
('138','4','3');
INSERT INTO `preparacion_intelectual_idiomas` (`preparacion_intelectualid`,`idiomasid`,`nivel`) VALUES
('141','1','3');
INSERT INTO `preparacion_intelectual_idiomas` (`preparacion_intelectualid`,`idiomasid`,`nivel`) VALUES
('141','2','2');
INSERT INTO `preparacion_intelectual_idiomas` (`preparacion_intelectualid`,`idiomasid`,`nivel`) VALUES
('145','2','2');
INSERT INTO `preparacion_intelectual_idiomas` (`preparacion_intelectualid`,`idiomasid`,`nivel`) VALUES
('145','5','1');
INSERT INTO `preparacion_intelectual_idiomas` (`preparacion_intelectualid`,`idiomasid`,`nivel`) VALUES
('146','2','2');
INSERT INTO `preparacion_intelectual_idiomas` (`preparacion_intelectualid`,`idiomasid`,`nivel`) VALUES
('151','2','1');
INSERT INTO `preparacion_intelectual_idiomas` (`preparacion_intelectualid`,`idiomasid`,`nivel`) VALUES
('160','2','1');



-- -------------------------------------------
-- TABLE DATA preparacion_militar
-- -------------------------------------------
INSERT INTO `preparacion_militar` (`id`,`escuela`,`curso`,`fecha`,`trayectoria_militarid`) VALUES
('8','escuela para zapadores','desactivacion de minas','2020-09-30','14');
INSERT INTO `preparacion_militar` (`id`,`escuela`,`curso`,`fecha`,`trayectoria_militarid`) VALUES
('9','escuela de zapadores de reino unido','desminado de campos','2020-05-04','15');
INSERT INTO `preparacion_militar` (`id`,`escuela`,`curso`,`fecha`,`trayectoria_militarid`) VALUES
('10','escuela de buceo','apnea profunda','2020-09-17','15');
INSERT INTO `preparacion_militar` (`id`,`escuela`,`curso`,`fecha`,`trayectoria_militarid`) VALUES
('11','submarira','desactivacion de minas acuaticas','2019-12-30','16');
INSERT INTO `preparacion_militar` (`id`,`escuela`,`curso`,`fecha`,`trayectoria_militarid`) VALUES
('12','paracaidismo','salto al vacio','2020-09-08','16');



-- -------------------------------------------
-- TABLE DATA productividad
-- -------------------------------------------
INSERT INTO `productividad` (`plan`,`vreal`,`plan_anterior`,`fecha`,`status`,`correlacion`,`id`,`empresaid`,`anexoid`) VALUES
('8265.2','9417.7','12562.9','2019-11-02','0','0.9989','1','11','53');
INSERT INTO `productividad` (`plan`,`vreal`,`plan_anterior`,`fecha`,`status`,`correlacion`,`id`,`empresaid`,`anexoid`) VALUES
('11074.5','13577.3','11632.5','2019-11-02','0','0.8457','2','12','53');
INSERT INTO `productividad` (`plan`,`vreal`,`plan_anterior`,`fecha`,`status`,`correlacion`,`id`,`empresaid`,`anexoid`) VALUES
('12399.6','13745.1','10451.3','2019-11-02','0','0.8431','3','13','53');
INSERT INTO `productividad` (`plan`,`vreal`,`plan_anterior`,`fecha`,`status`,`correlacion`,`id`,`empresaid`,`anexoid`) VALUES
('7693.4','8422.3','10218.7','2019-11-02','0','0.923','4','14','53');
INSERT INTO `productividad` (`plan`,`vreal`,`plan_anterior`,`fecha`,`status`,`correlacion`,`id`,`empresaid`,`anexoid`) VALUES
('9994.6','8669','11010.2','2019-11-02','0','0.9999','5','15','53');
INSERT INTO `productividad` (`plan`,`vreal`,`plan_anterior`,`fecha`,`status`,`correlacion`,`id`,`empresaid`,`anexoid`) VALUES
('7897.8','10276.3','9510.7','2019-11-02','0','0.8987','6','17','53');
INSERT INTO `productividad` (`plan`,`vreal`,`plan_anterior`,`fecha`,`status`,`correlacion`,`id`,`empresaid`,`anexoid`) VALUES
('9993.1','8523.6','10523','2019-11-02','0','0.9013','7','16','53');
INSERT INTO `productividad` (`plan`,`vreal`,`plan_anterior`,`fecha`,`status`,`correlacion`,`id`,`empresaid`,`anexoid`) VALUES
('10489.4','9844.9','8975.1','2019-11-02','0','0.867','8','18','53');
INSERT INTO `productividad` (`plan`,`vreal`,`plan_anterior`,`fecha`,`status`,`correlacion`,`id`,`empresaid`,`anexoid`) VALUES
('7100.5','7798.2','9637.3','2019-11-02','0','0.9508','9','19','53');
INSERT INTO `productividad` (`plan`,`vreal`,`plan_anterior`,`fecha`,`status`,`correlacion`,`id`,`empresaid`,`anexoid`) VALUES
('8828.1','10758.3','9852.5','2019-11-02','0','0.8776','10','20','53');
INSERT INTO `productividad` (`plan`,`vreal`,`plan_anterior`,`fecha`,`status`,`correlacion`,`id`,`empresaid`,`anexoid`) VALUES
('6332.3','7947.8','8010.8','2019-11-02','0','0.9969','11','21','53');
INSERT INTO `productividad` (`plan`,`vreal`,`plan_anterior`,`fecha`,`status`,`correlacion`,`id`,`empresaid`,`anexoid`) VALUES
('8403','10430.9','8860.2','2019-11-02','0','0.9539','12','22','53');
INSERT INTO `productividad` (`plan`,`vreal`,`plan_anterior`,`fecha`,`status`,`correlacion`,`id`,`empresaid`,`anexoid`) VALUES
('6734.1','6109','7063.2','2019-11-02','0','0.7496','13','23','53');
INSERT INTO `productividad` (`plan`,`vreal`,`plan_anterior`,`fecha`,`status`,`correlacion`,`id`,`empresaid`,`anexoid`) VALUES
('7014.4','6257.5','8546.6','2019-11-02','0','0.9681','14','24','53');
INSERT INTO `productividad` (`plan`,`vreal`,`plan_anterior`,`fecha`,`status`,`correlacion`,`id`,`empresaid`,`anexoid`) VALUES
('5124.6','3879.3','5114.1','2019-11-02','0','0.9407','15','25','53');
INSERT INTO `productividad` (`plan`,`vreal`,`plan_anterior`,`fecha`,`status`,`correlacion`,`id`,`empresaid`,`anexoid`) VALUES
('6573.5','5505.7','7109.7','2019-11-02','0','0.8044','16','26','53');
INSERT INTO `productividad` (`plan`,`vreal`,`plan_anterior`,`fecha`,`status`,`correlacion`,`id`,`empresaid`,`anexoid`) VALUES
('8111.7','8145.5','9783.3','2019-11-02','0','0.983','17','27','53');
INSERT INTO `productividad` (`plan`,`vreal`,`plan_anterior`,`fecha`,`status`,`correlacion`,`id`,`empresaid`,`anexoid`) VALUES
('15991.9','23994.7','22544.4','2019-11-02','0','0.7186','18','28','53');
INSERT INTO `productividad` (`plan`,`vreal`,`plan_anterior`,`fecha`,`status`,`correlacion`,`id`,`empresaid`,`anexoid`) VALUES
('6618.3','7384.7','7885.5','2019-11-02','0','0.9258','19','29','53');
INSERT INTO `productividad` (`plan`,`vreal`,`plan_anterior`,`fecha`,`status`,`correlacion`,`id`,`empresaid`,`anexoid`) VALUES
('14017.5','52479.4','10108.6','2019-11-02','0','0.4392','20','30','53');



-- -------------------------------------------
-- TABLE DATA producto
-- -------------------------------------------
INSERT INTO `producto` (`id`,`producto`,`UM`) VALUES
('1','HARINA DE MAÍZ','Toneladas');
INSERT INTO `producto` (`id`,`producto`,`UM`) VALUES
('2','FOSFOROS','cajas');
INSERT INTO `producto` (`id`,`producto`,`UM`) VALUES
('3','P. ALIMENTICIA','Toneladas');
INSERT INTO `producto` (`id`,`producto`,`UM`) VALUES
('4','PURE DE TOMATE','Toneladas');
INSERT INTO `producto` (`id`,`producto`,`UM`) VALUES
('5','Otras Conservas de Tomate','Kilogramos');
INSERT INTO `producto` (`id`,`producto`,`UM`) VALUES
('6','Pastas Alimenticias','Toneladas');
INSERT INTO `producto` (`id`,`producto`,`UM`) VALUES
('7','Fideos','Kilogramos');
INSERT INTO `producto` (`id`,`producto`,`UM`) VALUES
('8','Frijoles ','Kilogramos');
INSERT INTO `producto` (`id`,`producto`,`UM`) VALUES
('9','Chicharos ','Toneladas');
INSERT INTO `producto` (`id`,`producto`,`UM`) VALUES
('10','Arroz ','toneladas');
INSERT INTO `producto` (`id`,`producto`,`UM`) VALUES
('11','Harina de Trigo ','kilogramos');
INSERT INTO `producto` (`id`,`producto`,`UM`) VALUES
('12','Azucar ','toneladas');
INSERT INTO `producto` (`id`,`producto`,`UM`) VALUES
('13','Sal ','Kilogramos');



-- -------------------------------------------
-- TABLE DATA provincia
-- -------------------------------------------
INSERT INTO `provincia` (`id`,`provincia`) VALUES
('2','Artemisa');
INSERT INTO `provincia` (`id`,`provincia`) VALUES
('10','Camagüey');
INSERT INTO `provincia` (`id`,`provincia`) VALUES
('9','Ciego de Avila');
INSERT INTO `provincia` (`id`,`provincia`) VALUES
('6','Cienfuegos');
INSERT INTO `provincia` (`id`,`provincia`) VALUES
('12','Granma');
INSERT INTO `provincia` (`id`,`provincia`) VALUES
('15','Guantánamo');
INSERT INTO `provincia` (`id`,`provincia`) VALUES
('13','Holguín');
INSERT INTO `provincia` (`id`,`provincia`) VALUES
('16','Isla De La Juventud');
INSERT INTO `provincia` (`id`,`provincia`) VALUES
('4','La Habana');
INSERT INTO `provincia` (`id`,`provincia`) VALUES
('11','Las Tunas');
INSERT INTO `provincia` (`id`,`provincia`) VALUES
('5','Matanzas');
INSERT INTO `provincia` (`id`,`provincia`) VALUES
('3','Mayabeque');
INSERT INTO `provincia` (`id`,`provincia`) VALUES
('1','Pinar Del Rio');
INSERT INTO `provincia` (`id`,`provincia`) VALUES
('8','Sancti Spiritus');
INSERT INTO `provincia` (`id`,`provincia`) VALUES
('14','Santiago De Cuba');
INSERT INTO `provincia` (`id`,`provincia`) VALUES
('7','Villa Clara');



-- -------------------------------------------
-- TABLE DATA proyeccion
-- -------------------------------------------
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('1','1','6');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('2','1','6');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('3','2','6');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('4','1','6');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('5','2','6');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('6','2','6');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('7','2','6');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('8','2','6');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('9','2','6');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('10','2','6');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('11','2','6');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('12','2','6');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('13','2','6');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('14','2','6');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('15','2','6');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('16','2','6');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('17','2','6');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('18','1','6');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('19','2','6');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('20','2','6');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('21','2','6');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('22','2','6');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('23','1','0');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('24','2','4');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('25','2','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('26','2','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('27','2','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('28','2','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('29','1','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('30','1','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('31','1','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('32','1','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('33','1','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('34','1','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('35','1','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('36','1','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('37','1','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('38','1','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('39','1','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('40','1','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('41','1','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('42','1','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('43','1','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('44','1','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('45','1','0');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('46','1','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('47','1','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('48','1','1');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('49','1','2');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('50','1','8');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('51','1','8');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('52','1','');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('53','1','2');
INSERT INTO `proyeccion` (`id`,`tipo_proyeccionid`,`tipo_movimientoid`) VALUES
('54','1','3');



-- -------------------------------------------
-- TABLE DATA reclamaciones
-- -------------------------------------------
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('1','0','0','0','0','1','2019-07-27','0','11','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('2','0','0','2','779559.39','1','2019-07-27','0','11','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('3','0','0','0','0','1','2019-07-27','0','12','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('4','32','15922837.25','0','0','1','2019-07-27','0','12','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('5','0','0','0','0','1','2019-07-27','0','13','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('6','0','','0','','1','2019-07-27','0','13','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('7','0','0','2','69042.65','1','2019-07-27','0','14','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('8','1','314.1','0','0','1','2019-07-27','0','14','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('9','0','0','0','0','1','2019-07-27','0','15','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('10','0','0','0','0','1','2019-07-27','0','15','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('11','0','0','0','0','1','2019-07-27','0','17','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('12','0','0','0','0','1','2019-07-27','0','17','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('13','0','0','4','3414011.81','1','2019-07-27','0','16','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('14','9','4217.81','0','0','1','2019-07-27','0','16','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('15','41','13261598.93','0','0','1','2019-07-27','0','18','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('16','43','3930.16','0','0','1','2019-07-27','0','18','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('17','5','6091020.83','0','0','1','2019-07-27','0','19','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('18','31','11330274.58','0','0','1','2019-07-27','0','19','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('19','56','29003287.36','0','0','1','2019-07-27','0','20','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('20','2','2601.2','0','0','1','2019-07-27','0','20','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('21','0','0','1','12992','1','2019-07-27','0','21','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('22','0','0','0','0','1','2019-07-27','0','21','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('23','8','10676032.02','0','0','1','2019-07-27','0','22','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('24','16','3858222.12','0','0','1','2019-07-27','0','22','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('25','0','0','0','0','1','2019-07-27','0','23','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('26','3','25742.01','0','0','1','2019-07-27','0','23','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('27','0','0','9','5474.45','1','2019-07-27','0','24','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('28','0','0','0','0','1','2019-07-27','0','24','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('29','0','0','0','0','1','2019-07-27','0','25','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('30','2','128420.93','0','0','1','2019-07-27','0','25','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('31','1','5794505.35','0','0','1','2019-07-27','0','26','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('32','0','0','0','0','1','2019-07-27','0','26','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('33','41','559980.25','33','310964.94','1','2019-07-27','0','27','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('34','47','162375.15','3','30048.2','1','2019-07-27','0','27','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('35','0','0','0','0','1','2019-07-27','0','28','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('36','0','0','0','0','1','2019-07-27','0','30','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('37','0','0','0','0','1','2019-07-27','0','29','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('38','0','0','0','0','1','2019-07-27','0','29','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('39','0','0','0','0','1','2019-07-27','0','30','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('40','0','','0','','1','2019-07-27','0','28','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('41','0','0','0','0','8','2019-07-31','1','11','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('42','0','0','2','779559.39','8','2019-07-31','1','11','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('43','0','0','0','0','8','2019-07-31','1','12','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('44','32','15922837.25','0','0','8','2019-07-31','1','12','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('45','0','0','0','0','8','2019-07-31','1','13','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('46','0','','0','','8','2019-07-31','1','13','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('47','0','0','2','69042.65','8','2019-07-31','1','14','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('48','1','314.1','0','0','8','2019-07-31','1','14','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('49','0','0','0','0','8','2019-07-31','1','15','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('50','0','0','0','0','8','2019-07-31','1','15','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('51','0','0','0','0','8','2019-07-31','1','17','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('52','0','0','0','0','8','2019-07-31','1','17','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('53','0','0','4','3414011.81','8','2019-07-31','1','16','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('54','9','4217.81','0','0','8','2019-07-31','1','16','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('55','41','13261598.93','0','0','8','2019-07-31','1','18','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('56','43','3930.16','0','0','8','2019-07-31','1','18','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('57','5','6091020.83','0','0','8','2019-07-31','1','19','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('58','31','11330274.58','0','0','8','2019-07-31','1','19','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('59','56','29003287.36','0','0','8','2019-07-31','1','20','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('60','2','2601.2','0','0','8','2019-07-31','1','20','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('61','0','0','1','12992','8','2019-07-31','1','21','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('62','0','0','0','0','8','2019-07-31','1','21','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('63','8','10676032.02','0','0','8','2019-07-31','1','22','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('64','16','3858222.12','0','0','8','2019-07-31','1','22','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('65','0','0','0','0','8','2019-07-31','1','23','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('66','3','25742.01','0','0','8','2019-07-31','1','23','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('67','0','0','9','5474.45','8','2019-07-31','1','24','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('68','0','0','0','0','8','2019-07-31','1','24','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('69','0','0','0','0','8','2019-07-31','1','25','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('70','2','128420.93','0','0','8','2019-07-31','1','25','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('71','1','5794505.35','0','0','8','2019-07-31','1','26','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('72','0','0','0','0','8','2019-07-31','1','26','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('73','41','559980.25','33','310964.94','8','2019-07-31','1','27','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('74','47','162375.15','3','30048.2','8','2019-07-31','1','27','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('75','0','0','0','0','8','2019-07-31','1','28','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('76','0','0','0','0','8','2019-07-31','1','30','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('77','0','0','0','0','8','2019-07-31','1','29','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('78','0','0','0','0','8','2019-07-31','1','29','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('79','0','0','0','0','8','2019-07-31','1','30','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('80','0','','0','','8','2019-07-31','1','28','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('81','0','0','0','0','15','2019-08-21','1','11','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('82','0','0','2','779559.39','15','2019-08-21','1','11','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('83','0','0','0','0','15','2019-08-21','1','12','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('84','32','15922837.25','0','0','15','2019-08-21','1','12','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('85','0','0','0','0','15','2019-08-21','1','13','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('86','0','','0','','15','2019-08-21','1','13','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('87','0','0','2','69042.65','15','2019-08-21','1','14','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('88','1','314.1','0','0','15','2019-08-21','1','14','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('89','0','0','0','0','15','2019-08-21','1','15','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('90','0','0','0','0','15','2019-08-21','1','15','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('91','0','0','0','0','15','2019-08-21','1','17','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('92','0','0','0','0','15','2019-08-21','1','17','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('93','0','0','4','3414011.81','15','2019-08-21','1','16','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('94','9','4217.81','0','0','15','2019-08-21','1','16','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('95','41','13261598.93','0','0','15','2019-08-21','1','18','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('96','43','3930.16','0','0','15','2019-08-21','1','18','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('97','5','6091020.83','0','0','15','2019-08-21','1','19','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('98','31','11330274.58','0','0','15','2019-08-21','1','19','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('99','56','29003287.36','0','0','15','2019-08-21','1','20','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('100','2','2601.2','0','0','15','2019-08-21','1','20','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('101','0','0','1','12992','15','2019-08-21','1','21','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('102','0','0','0','0','15','2019-08-21','1','21','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('103','8','10676032.02','0','0','15','2019-08-21','1','22','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('104','16','3858222.12','0','0','15','2019-08-21','1','22','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('105','0','0','0','0','15','2019-08-21','1','23','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('106','3','25742.01','0','0','15','2019-08-21','1','23','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('107','0','0','9','5474.45','15','2019-08-21','1','24','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('108','0','0','0','0','15','2019-08-21','1','24','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('109','0','0','0','0','15','2019-08-21','1','25','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('110','2','128420.93','0','0','15','2019-08-21','1','25','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('111','1','5794505.35','0','0','15','2019-08-21','1','26','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('112','0','0','0','0','15','2019-08-21','1','26','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('113','41','559980.25','33','310964.94','15','2019-08-21','1','27','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('114','47','162375.15','3','30048.2','15','2019-08-21','1','27','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('115','0','0','0','0','15','2019-08-21','1','28','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('116','0','0','0','0','15','2019-08-21','1','30','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('117','0','0','0','0','15','2019-08-21','1','29','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('118','0','0','0','0','15','2019-08-21','1','29','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('119','0','0','0','0','15','2019-08-21','1','30','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('120','0','','0','','15','2019-08-21','1','28','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('121','0','0','0','0','63','2019-11-03','1','11','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('122','0','0','2','779559.39','63','2019-11-03','1','11','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('123','0','0','0','0','63','2019-11-03','1','12','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('124','32','15922837.25','0','0','63','2019-11-03','1','12','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('125','0','0','0','0','63','2019-11-03','1','13','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('126','0','','0','','63','2019-11-03','1','13','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('127','0','0','2','69042.65','63','2019-11-03','1','14','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('128','1','314.1','0','0','63','2019-11-03','1','14','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('129','0','0','0','0','63','2019-11-03','1','15','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('130','0','0','0','0','63','2019-11-03','1','15','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('131','0','0','0','0','63','2019-11-03','1','17','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('132','0','0','0','0','63','2019-11-03','1','17','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('133','0','0','4','3414011.81','63','2019-11-03','1','16','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('134','9','4217.81','0','0','63','2019-11-03','1','16','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('135','41','13261598.93','0','0','63','2019-11-03','1','18','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('136','43','3930.16','0','0','63','2019-11-03','1','18','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('137','5','6091020.83','0','0','63','2019-11-03','1','19','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('138','31','11330274.58','0','0','63','2019-11-03','1','19','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('139','56','29003287.36','0','0','63','2019-11-03','1','20','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('140','2','2601.2','0','0','63','2019-11-03','1','20','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('141','0','0','1','12992','63','2019-11-03','1','21','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('142','0','0','0','0','63','2019-11-03','1','21','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('143','8','10676032.02','0','0','63','2019-11-03','1','22','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('144','16','3858222.12','0','0','63','2019-11-03','1','22','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('145','0','0','0','0','63','2019-11-03','1','23','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('146','3','25742.01','0','0','63','2019-11-03','1','23','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('147','0','0','9','5474.45','63','2019-11-03','1','24','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('148','0','0','0','0','63','2019-11-03','1','24','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('149','0','0','0','0','63','2019-11-03','1','25','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('150','2','128420.93','0','0','63','2019-11-03','1','25','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('151','1','5794505.35','0','0','63','2019-11-03','1','26','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('152','0','0','0','0','63','2019-11-03','1','26','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('153','41','559980.25','33','310964.94','63','2019-11-03','1','27','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('154','47','162375.15','3','30048.2','63','2019-11-03','1','27','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('155','0','0','0','0','63','2019-11-03','1','28','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('156','0','0','0','0','63','2019-11-03','1','30','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('157','0','0','0','0','63','2019-11-03','1','29','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('158','0','0','0','0','63','2019-11-03','1','29','1');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('159','0','0','0','0','63','2019-11-03','1','30','2');
INSERT INTO `reclamaciones` (`id`,`cant_reclamacion`,`importe_reclamacion`,`demanda_cant`,`demanda_importe`,`anexoid`,`fecha`,`status`,`empresaid`,`tipo_reclamacion`) VALUES
('160','0','','0','','63','2019-11-03','1','28','1');



-- -------------------------------------------
-- TABLE DATA reserva
-- -------------------------------------------
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('1','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('2','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('3','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('4','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('5','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('6','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('7','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('8','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('9','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('10','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('11','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('12','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('13','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('14','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('15','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('16','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('17','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('18','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('19','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('20','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('21','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('22','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('23','1','ssdsdsd');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('24','2','mantener la actitud ante las tareas asignadas');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('25','3','dmnsdlnms');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('26','2','jskbkdajskjlkjas
sada;ls;ldak');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('27','2','jskbkdajskjlkjas
sada;ls;ldak');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('28','2','jskbkdajskjlkjas
sada;ls;ldak');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('29','2','jskbkdajskjlkjas
sada;ls;ldak');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('30','2','zdasca');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('31','2','zdasca');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('32','2','zdasca');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('33','2','zdasca');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('34','2','zdasca');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('35','2','zdasca');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('36','2','zdasca');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('37','2','zdasca');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('38','2','zdasca');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('39','2','zdasca');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('40','2','zdasca');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('41','2','zdasca');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('42','2','zdasca');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('43','2','zdasca');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('44','2','zdasca');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('45','2','zdasca');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('46','2','zdasca');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('47','2','zdasca');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('48','2','zdasca');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('49','2','zdasca');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('50','2','zdasca');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('51','3','');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('52','3','');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('53','3','');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('54','3','');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('55','3','');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('56','2','dsndkjksdjs');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('57','2','csx');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('58','2','csx');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('59','1','kxdnsdljk');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('60','1','kxdnsdljk');
INSERT INTO `reserva` (`id`,`tipo`,`observaciones`) VALUES
('61','2','zczxczxc');



-- -------------------------------------------
-- TABLE DATA rol
-- -------------------------------------------
INSERT INTO `rol` (`id`,`rol`) VALUES
('1','SiteAdmin');
INSERT INTO `rol` (`id`,`rol`) VALUES
('2','Administrador');
INSERT INTO `rol` (`id`,`rol`) VALUES
('3','Director');
INSERT INTO `rol` (`id`,`rol`) VALUES
('4','Especialista');
INSERT INTO `rol` (`id`,`rol`) VALUES
('5','Presidente');
INSERT INTO `rol` (`id`,`rol`) VALUES
('6','Gestor de Cuadros');
INSERT INTO `rol` (`id`,`rol`) VALUES
('7','Evaluador');



-- -------------------------------------------
-- TABLE DATA salud
-- -------------------------------------------
INSERT INTO `salud` (`id`,`estado_saludid`) VALUES
('226','1');
INSERT INTO `salud` (`id`,`estado_saludid`) VALUES
('266','1');
INSERT INTO `salud` (`id`,`estado_saludid`) VALUES
('276','1');
INSERT INTO `salud` (`id`,`estado_saludid`) VALUES
('285','1');
INSERT INTO `salud` (`id`,`estado_saludid`) VALUES
('241','2');
INSERT INTO `salud` (`id`,`estado_saludid`) VALUES
('261','2');
INSERT INTO `salud` (`id`,`estado_saludid`) VALUES
('270','2');
INSERT INTO `salud` (`id`,`estado_saludid`) VALUES
('271','2');
INSERT INTO `salud` (`id`,`estado_saludid`) VALUES
('263','3');



-- -------------------------------------------
-- TABLE DATA sancionados
-- -------------------------------------------
INSERT INTO `sancionados` (`id`,`sancion`,`fecha`,`motivo`,`familiarid`) VALUES
('8','Privación de libertad ','1999-05-17','Accidente laboral ','34');
INSERT INTO `sancionados` (`id`,`sancion`,`fecha`,`motivo`,`familiarid`) VALUES
('9','trabajo correccional','0000-00-00','sacrificio de ganado mayor','42');



-- -------------------------------------------
-- TABLE DATA sanciones
-- -------------------------------------------
INSERT INTO `sanciones` (`id`,`tipo`,`sansion`,`motivo`,`fecha`) VALUES
('91','1','1','1','2020-09-15');
INSERT INTO `sanciones` (`id`,`tipo`,`sansion`,`motivo`,`fecha`) VALUES
('92','2','2','2','2015-12-12');
INSERT INTO `sanciones` (`id`,`tipo`,`sansion`,`motivo`,`fecha`) VALUES
('93','3','3','3','1998-02-25');



-- -------------------------------------------
-- TABLE DATA sentido
-- -------------------------------------------
INSERT INTO `sentido` (`id`,`sentido`) VALUES
('1','>');
INSERT INTO `sentido` (`id`,`sentido`) VALUES
('2','<');
INSERT INTO `sentido` (`id`,`sentido`) VALUES
('3','=');



-- -------------------------------------------
-- TABLE DATA tipo_arma
-- -------------------------------------------
INSERT INTO `tipo_arma` (`id`,`tipo_arma`) VALUES
('1','Particular');
INSERT INTO `tipo_arma` (`id`,`tipo_arma`) VALUES
('2','Asiganada');



-- -------------------------------------------
-- TABLE DATA tipo_cuenta
-- -------------------------------------------
INSERT INTO `tipo_cuenta` (`id`,`tipo`) VALUES
('1','cuentas por cobrar');
INSERT INTO `tipo_cuenta` (`id`,`tipo`) VALUES
('2','cuentas por pagar');



-- -------------------------------------------
-- TABLE DATA tipo_expediente
-- -------------------------------------------
INSERT INTO `tipo_expediente` (`id`,`tipo`) VALUES
('1','faltante');
INSERT INTO `tipo_expediente` (`id`,`tipo`) VALUES
('2','perdida');
INSERT INTO `tipo_expediente` (`id`,`tipo`) VALUES
('3','sobrante');



-- -------------------------------------------
-- TABLE DATA tipo_extancia
-- -------------------------------------------
INSERT INTO `tipo_extancia` (`id`,`tipo`) VALUES
('1','Misiones internacionalistas');
INSERT INTO `tipo_extancia` (`id`,`tipo`) VALUES
('2','Misiones oficiales');
INSERT INTO `tipo_extancia` (`id`,`tipo`) VALUES
('3','Viajes no oficiales');



-- -------------------------------------------
-- TABLE DATA tipo_familiar
-- -------------------------------------------
INSERT INTO `tipo_familiar` (`id`,`tipo`) VALUES
('1','Cónyuge');
INSERT INTO `tipo_familiar` (`id`,`tipo`) VALUES
('2','Madre');
INSERT INTO `tipo_familiar` (`id`,`tipo`) VALUES
('3','Padre');
INSERT INTO `tipo_familiar` (`id`,`tipo`) VALUES
('4','Hijo(a)');
INSERT INTO `tipo_familiar` (`id`,`tipo`) VALUES
('5','Hermano(a)');
INSERT INTO `tipo_familiar` (`id`,`tipo`) VALUES
('6','Tio(a)');
INSERT INTO `tipo_familiar` (`id`,`tipo`) VALUES
('7','Abuelo(a)');
INSERT INTO `tipo_familiar` (`id`,`tipo`) VALUES
('8','Primos');
INSERT INTO `tipo_familiar` (`id`,`tipo`) VALUES
('9','Otros');



-- -------------------------------------------
-- TABLE DATA tipo_ingresos
-- -------------------------------------------
INSERT INTO `tipo_ingresos` (`id`,`tipo`) VALUES
('1','Salario');
INSERT INTO `tipo_ingresos` (`id`,`tipo`) VALUES
('2','Estimulación en CUP');
INSERT INTO `tipo_ingresos` (`id`,`tipo`) VALUES
('3','Estimulación en CUC');
INSERT INTO `tipo_ingresos` (`id`,`tipo`) VALUES
('4','Remesas');
INSERT INTO `tipo_ingresos` (`id`,`tipo`) VALUES
('5','Jubilación');
INSERT INTO `tipo_ingresos` (`id`,`tipo`) VALUES
('6','Otros');



-- -------------------------------------------
-- TABLE DATA tipo_inventario
-- -------------------------------------------
INSERT INTO `tipo_inventario` (`id`,`tipo`) VALUES
('1','ocioso');
INSERT INTO `tipo_inventario` (`id`,`tipo`) VALUES
('2','lento movimiento');



-- -------------------------------------------
-- TABLE DATA tipo_movimiento
-- -------------------------------------------
INSERT INTO `tipo_movimiento` (`id`,`tipo_movimiento`) VALUES
('1','Promoción');
INSERT INTO `tipo_movimiento` (`id`,`tipo_movimiento`) VALUES
('2','Traslado');
INSERT INTO `tipo_movimiento` (`id`,`tipo_movimiento`) VALUES
('3','Reubicación');
INSERT INTO `tipo_movimiento` (`id`,`tipo_movimiento`) VALUES
('4','Liberación');
INSERT INTO `tipo_movimiento` (`id`,`tipo_movimiento`) VALUES
('5','Democión');
INSERT INTO `tipo_movimiento` (`id`,`tipo_movimiento`) VALUES
('6','Separación');
INSERT INTO `tipo_movimiento` (`id`,`tipo_movimiento`) VALUES
('7','Preparación');
INSERT INTO `tipo_movimiento` (`id`,`tipo_movimiento`) VALUES
('8','Superación');



-- -------------------------------------------
-- TABLE DATA tipo_proyeccion
-- -------------------------------------------
INSERT INTO `tipo_proyeccion` (`id`,`tipo`) VALUES
('1','Mantener en el cargo');
INSERT INTO `tipo_proyeccion` (`id`,`tipo`) VALUES
('2','No mantener en el cargo');



-- -------------------------------------------
-- TABLE DATA tipo_relcamacion
-- -------------------------------------------
INSERT INTO `tipo_relcamacion` (`id`,`tipo`) VALUES
('1','proveedores');
INSERT INTO `tipo_relcamacion` (`id`,`tipo`) VALUES
('2','cliente');



-- -------------------------------------------
-- TABLE DATA tipo_reserva
-- -------------------------------------------
INSERT INTO `tipo_reserva` (`id`,`tipo`) VALUES
('1','Incorporar a la reserva');
INSERT INTO `tipo_reserva` (`id`,`tipo`) VALUES
('2','Ratificar en la reserva');
INSERT INTO `tipo_reserva` (`id`,`tipo`) VALUES
('3','Excluir de la reserva');



-- -------------------------------------------
-- TABLE DATA tipo_sancion
-- -------------------------------------------
INSERT INTO `tipo_sancion` (`id`,`tipo`) VALUES
('1','Judiciales');
INSERT INTO `tipo_sancion` (`id`,`tipo`) VALUES
('2','Políticas');
INSERT INTO `tipo_sancion` (`id`,`tipo`) VALUES
('3','Administrativas');



-- -------------------------------------------
-- TABLE DATA tipo_vehiculo
-- -------------------------------------------
INSERT INTO `tipo_vehiculo` (`id`,`tipo_vehiculo`) VALUES
('1','Particular');
INSERT INTO `tipo_vehiculo` (`id`,`tipo_vehiculo`) VALUES
('2','Asignado Por Su Cargo');
INSERT INTO `tipo_vehiculo` (`id`,`tipo_vehiculo`) VALUES
('3','robado');



-- -------------------------------------------
-- TABLE DATA tipo_venta
-- -------------------------------------------
INSERT INTO `tipo_venta` (`id`,`tipo_venta`) VALUES
('1','Mercado paralelo');
INSERT INTO `tipo_venta` (`id`,`tipo_venta`) VALUES
('2','venta neta');
INSERT INTO `tipo_venta` (`id`,`tipo_venta`) VALUES
('3','venta liberada');



-- -------------------------------------------
-- TABLE DATA tope
-- -------------------------------------------
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('1','25','51','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('2','25','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('3','0','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('4','0','10','15','20');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('5','100','100','100','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('6','100','100','100','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('7','0','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('8','0','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('9','0','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('10','0','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('11','0','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('12','0','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('13','0','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('14','0','50','0','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('15','25','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('16','0','20','0','20');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('17','25','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('18','0','5','10','5');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('19','25','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('20','25','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('21','25','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('22','0','20','40','50');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('23','25','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('24','10','10','10','10');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('25','0','0','50','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('26','50','100','0','0');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('27','0','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('28','0','10','15','15');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('29','4','4','4','4');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('30','0','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('31','25','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('32','25','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('33','90','90','90','90');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('34','0','5','10','5');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('35','25','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('36','0','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('37','0','30','70','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('38','0','30','70','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('39','100','100','100','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('40','0','0','50','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('41','100','100','100','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('42','100','100','100','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('43','25','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('44','5','5','5','5');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('45','100','100','100','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('46','100','100','100','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('47','0','5','10','5');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('48','4','4','4','4');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('49','0','0','1','1');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('50','0','0','3','3');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('51','10','10','10','10');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('52','70','70','70','70');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('53','0','50','75','100');
INSERT INTO `tope` (`id`,`Itrimestre`,`IItrimestre`,`IIItrimestre`,`IVtrimestre`) VALUES
('54','100','100','100','100');



-- -------------------------------------------
-- TABLE DATA tope_indicador
-- -------------------------------------------
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('1','90.0000','1');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('2','90','1');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('3','75','1');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('4','100.0000','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('5','100','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('6','0','2');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('7','156','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('8','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('9','6.0008','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('10','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('11','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('12','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('13','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('14','0.0001','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('15','50','2');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('16','12','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('17','12','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('18','7','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('19','75','1');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('20','75','1');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('21','0.0000','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('22','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('23','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('24','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('25','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('26','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('27','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('28','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('29','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('30','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('31','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('32','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('33','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('34','292','2');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('35','83','2');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('36','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('37','38','2');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('38','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('39','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('40','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('41','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('42','86','1');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('43','100','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('44','100','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('45','100','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('46','100','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('47','2','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('48','21.0000','1');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('49','100','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('50','100','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('51','100','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('52','100','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('53','100','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('54','100','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('55','75','1');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('56','100','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('57','0','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('58','10','2');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('59','3','2');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('60','60','2');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('61','30','3');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('62','75','2');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('63','7','2');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('64','20.0001','2');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('65','263549.2319','1');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('66','22235.1500','2');
INSERT INTO `tope_indicador` (`id`,`valor`,`idsentido`) VALUES
('67','10.25','2');



-- -------------------------------------------
-- TABLE DATA trabajador
-- -------------------------------------------
INSERT INTO `trabajador` (`nombre`,`primerApellido`,`segundoApellido`,`telefono`,`CI`,`email`,`id`,`iduser`) VALUES
('oniel','gutierrez','reyes','55007156','84120708580','sederg01@gmail.com','6','21');
INSERT INTO `trabajador` (`nombre`,`primerApellido`,`segundoApellido`,`telefono`,`CI`,`email`,`id`,`iduser`) VALUES
('Director','Director','Director','1111111111','040404040404','director@unal.cu','7','22');
INSERT INTO `trabajador` (`nombre`,`primerApellido`,`segundoApellido`,`telefono`,`CI`,`email`,`id`,`iduser`) VALUES
('omar','ali','garcia','452136985','254684656565','sedergbhjhbj@unal.cu','8','23');
INSERT INTO `trabajador` (`nombre`,`primerApellido`,`segundoApellido`,`telefono`,`CI`,`email`,`id`,`iduser`) VALUES
('Irina','Gonzalez','Oduardo','58076396','86101256038','irina.gonzales@unal.cu','9','12');
INSERT INTO `trabajador` (`nombre`,`primerApellido`,`segundoApellido`,`telefono`,`CI`,`email`,`id`,`iduser`) VALUES
('sederg','sederg','sederg','524698321','84120708580','sederg01@gmail.cu','10','25');
INSERT INTO `trabajador` (`nombre`,`primerApellido`,`segundoApellido`,`telefono`,`CI`,`email`,`id`,`iduser`) VALUES
('DCuadros','DCuadros','DCuadros','1111111111','11111111111','DCuadros@unal.cu','11','26');
INSERT INTO `trabajador` (`nombre`,`primerApellido`,`segundoApellido`,`telefono`,`CI`,`email`,`id`,`iduser`) VALUES
('economia','economia','economia','556898766','84120708580','economia@sederg.cu','12','27');
INSERT INTO `trabajador` (`nombre`,`primerApellido`,`segundoApellido`,`telefono`,`CI`,`email`,`id`,`iduser`) VALUES
('informatica','informatica','informatica','787878787','45455454545','informatica@sedergsoft.com','13','28');
INSERT INTO `trabajador` (`nombre`,`primerApellido`,`segundoApellido`,`telefono`,`CI`,`email`,`id`,`iduser`) VALUES
('gestor','gestor','gestor','111111','11111111111','gestorcuadros@unal.cu','14','29');
INSERT INTO `trabajador` (`nombre`,`primerApellido`,`segundoApellido`,`telefono`,`CI`,`email`,`id`,`iduser`) VALUES
('Pedro','Garcia','Suarez','34354654645','84645321368','pedrogarcia@unal.cu','15','30');
INSERT INTO `trabajador` (`nombre`,`primerApellido`,`segundoApellido`,`telefono`,`CI`,`email`,`id`,`iduser`) VALUES
('Investigacio','Desarrollo','Innovacion','123654788','84130708523','I+D@unal.cu','16','31');
INSERT INTO `trabajador` (`nombre`,`primerApellido`,`segundoApellido`,`telefono`,`CI`,`email`,`id`,`iduser`) VALUES
('Investigacion','Desarrollo','Innovacion','111-111-1111','84123566656','I+D+I@unal.cu','17','32');
INSERT INTO `trabajador` (`nombre`,`primerApellido`,`segundoApellido`,`telefono`,`CI`,`email`,`id`,`iduser`) VALUES
('Rosa','Garcia ','Peres','789-656-6232','84121365987','rosagp@unal.cu','18','33');



-- -------------------------------------------
-- TABLE DATA trayectoria_estudiantil
-- -------------------------------------------
INSERT INTO `trayectoria_estudiantil` (`id`,`cuadroid`) VALUES
('16','44');
INSERT INTO `trayectoria_estudiantil` (`id`,`cuadroid`) VALUES
('31','59');
INSERT INTO `trayectoria_estudiantil` (`id`,`cuadroid`) VALUES
('51','79');
INSERT INTO `trayectoria_estudiantil` (`id`,`cuadroid`) VALUES
('52','81');
INSERT INTO `trayectoria_estudiantil` (`id`,`cuadroid`) VALUES
('55','84');
INSERT INTO `trayectoria_estudiantil` (`id`,`cuadroid`) VALUES
('57','87');
INSERT INTO `trayectoria_estudiantil` (`id`,`cuadroid`) VALUES
('58','88');
INSERT INTO `trayectoria_estudiantil` (`id`,`cuadroid`) VALUES
('59','89');
INSERT INTO `trayectoria_estudiantil` (`id`,`cuadroid`) VALUES
('66','96');



-- -------------------------------------------
-- TABLE DATA trayectoria_estudiantil_centro_estudios
-- -------------------------------------------
INSERT INTO `trayectoria_estudiantil_centro_estudios` (`trayectoria_estudiantilid`,`centro_estudiosid`,`fecha_inicio`,`fecha_fin`) VALUES
('16','16','1997-09-01','2000-07-25');
INSERT INTO `trayectoria_estudiantil_centro_estudios` (`trayectoria_estudiantilid`,`centro_estudiosid`,`fecha_inicio`,`fecha_fin`) VALUES
('31','31','2020-09-23','2020-09-23');
INSERT INTO `trayectoria_estudiantil_centro_estudios` (`trayectoria_estudiantilid`,`centro_estudiosid`,`fecha_inicio`,`fecha_fin`) VALUES
('51','51','2020-09-23','2020-09-23');
INSERT INTO `trayectoria_estudiantil_centro_estudios` (`trayectoria_estudiantilid`,`centro_estudiosid`,`fecha_inicio`,`fecha_fin`) VALUES
('52','52','2020-09-23','2020-09-23');
INSERT INTO `trayectoria_estudiantil_centro_estudios` (`trayectoria_estudiantilid`,`centro_estudiosid`,`fecha_inicio`,`fecha_fin`) VALUES
('55','55','2020-09-24','2020-09-12');
INSERT INTO `trayectoria_estudiantil_centro_estudios` (`trayectoria_estudiantilid`,`centro_estudiosid`,`fecha_inicio`,`fecha_fin`) VALUES
('57','57','2020-04-29','2020-05-05');
INSERT INTO `trayectoria_estudiantil_centro_estudios` (`trayectoria_estudiantilid`,`centro_estudiosid`,`fecha_inicio`,`fecha_fin`) VALUES
('58','58','2020-04-29','2020-05-05');
INSERT INTO `trayectoria_estudiantil_centro_estudios` (`trayectoria_estudiantilid`,`centro_estudiosid`,`fecha_inicio`,`fecha_fin`) VALUES
('59','59','2020-08-29','2020-08-13');
INSERT INTO `trayectoria_estudiantil_centro_estudios` (`trayectoria_estudiantilid`,`centro_estudiosid`,`fecha_inicio`,`fecha_fin`) VALUES
('66','66','2020-08-29','2020-08-13');



-- -------------------------------------------
-- TABLE DATA trayectoria_laboral
-- -------------------------------------------
INSERT INTO `trayectoria_laboral` (`id`,`ocupacion`,`fecha_inicio`,`fecha_fin`,`motivo_cambio`,`cuadroid`,`centro_trabajo`) VALUES
('57','Bombero voluntario','2002-02-21','2004-01-08','Superación','44','Comando 5');
INSERT INTO `trayectoria_laboral` (`id`,`ocupacion`,`fecha_inicio`,`fecha_fin`,`motivo_cambio`,`cuadroid`,`centro_trabajo`) VALUES
('72','chofer','2020-09-23','2020-09-23','','59','MInas Oro Juan Lopez');
INSERT INTO `trayectoria_laboral` (`id`,`ocupacion`,`fecha_inicio`,`fecha_fin`,`motivo_cambio`,`cuadroid`,`centro_trabajo`) VALUES
('92','chofer','2020-09-23','2020-09-23','','79','MInas Oro Juan Lopez');
INSERT INTO `trayectoria_laboral` (`id`,`ocupacion`,`fecha_inicio`,`fecha_fin`,`motivo_cambio`,`cuadroid`,`centro_trabajo`) VALUES
('96','operador reactores','2020-09-21','2020-09-15','cierre de la mina','81','Academia Antonio Maceo');
INSERT INTO `trayectoria_laboral` (`id`,`ocupacion`,`fecha_inicio`,`fecha_fin`,`motivo_cambio`,`cuadroid`,`centro_trabajo`) VALUES
('97','operador combustible','1994-08-05','2010-05-06','cierre de la central','81','central nuclear cienfuegos');
INSERT INTO `trayectoria_laboral` (`id`,`ocupacion`,`fecha_inicio`,`fecha_fin`,`motivo_cambio`,`cuadroid`,`centro_trabajo`) VALUES
('98','gestor de proyectos','2011-06-28','0000-00-00','','81','CITY');
INSERT INTO `trayectoria_laboral` (`id`,`ocupacion`,`fecha_inicio`,`fecha_fin`,`motivo_cambio`,`cuadroid`,`centro_trabajo`) VALUES
('101','operador reactores','2020-09-17','2020-09-30','cambio trabajo','84','UM1580');
INSERT INTO `trayectoria_laboral` (`id`,`ocupacion`,`fecha_inicio`,`fecha_fin`,`motivo_cambio`,`cuadroid`,`centro_trabajo`) VALUES
('103','operador reactores','2020-05-04','2020-05-06','','87','MInas Oro Juan Lopez');
INSERT INTO `trayectoria_laboral` (`id`,`ocupacion`,`fecha_inicio`,`fecha_fin`,`motivo_cambio`,`cuadroid`,`centro_trabajo`) VALUES
('104','operador reactores','2020-05-04','2020-05-06','','88','MInas Oro Juan Lopez');
INSERT INTO `trayectoria_laboral` (`id`,`ocupacion`,`fecha_inicio`,`fecha_fin`,`motivo_cambio`,`cuadroid`,`centro_trabajo`) VALUES
('105','chofer','2020-08-20','2020-08-29','','89','central nuclear fukichima');
INSERT INTO `trayectoria_laboral` (`id`,`ocupacion`,`fecha_inicio`,`fecha_fin`,`motivo_cambio`,`cuadroid`,`centro_trabajo`) VALUES
('112','chofer','2020-08-20','2020-08-29','','96','central nuclear fukichima');



-- -------------------------------------------
-- TABLE DATA trayectoria_militar
-- -------------------------------------------
INSERT INTO `trayectoria_militar` (`id`,`grado_militar`) VALUES
('15','general de brigada');
INSERT INTO `trayectoria_militar` (`id`,`grado_militar`) VALUES
('16','sub-teniente');



-- -------------------------------------------
-- TABLE DATA trayectoria_militar_militancia
-- -------------------------------------------
INSERT INTO `trayectoria_militar_militancia` (`id`,`trayectoria_militarid`,`militanciaid`,`fecha_entrada`,`fecha_baja`,`causa_baja`) VALUES
('5','15','2','2020-09-09','2020-09-23','cambio de organozacions');
INSERT INTO `trayectoria_militar_militancia` (`id`,`trayectoria_militarid`,`militanciaid`,`fecha_entrada`,`fecha_baja`,`causa_baja`) VALUES
('6','16','2','2020-09-14','2020-08-14','causa baja');



-- -------------------------------------------
-- TABLE DATA trazas
-- -------------------------------------------
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('1','23','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2019-07-27','16:36:50','','','1');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('2','23','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2019-07-27','16:39:11','','','2');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('3','23','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-07-27','16:41:40','2','2','3');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('4','23','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2019-07-27','16:44:29','','','4');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('5','23','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2019-07-27','16:56:36','','','5');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('6','23','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-07-27','17:14:05','5','5','7');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('7','23','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-07-31','11:54:14','7','7','8');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('8','23','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-07-31','11:57:05','','','1');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('9','23','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2019-07-31','12:00:04','','','9');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('10','23','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-07-31','12:05:45','','','2');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('11','26','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-07-31','13:04:11','','','3');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('12','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-07-31','13:05:01','3','3','4');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('13','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-07-31','13:05:06','4','4','5');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('14','26','127.0.0.1','Certificó evaluación','Evaluacion','frontend\\models\\Evaluacion','2019-07-31','13:05:56','','','5');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('15','21','192.168.43.57','Eliminó','Indicadores de Gestión','frontend\\models\\Indicadoresgestion','2019-08-14','09:01:23','63','63','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('16','26','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2019-08-15','19:42:12','','','10');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('17','26','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-08-15','19:43:02','10','10','11');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('18','26','127.0.0.1','Certificó evaluación','Cumplimiento','frontend\\models\\Cumplimiento','2019-08-15','19:44:39','','','11');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('19','26','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2019-08-20','13:50:42','','','12');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('20','26','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-08-20','14:04:53','12','12','13');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('21','26','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-08-20','14:23:28','','','6');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('22','26','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-08-20','14:27:09','','','7');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('23','26','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-08-21','10:25:54','','','8');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('24','26','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-08-21','10:29:45','','','9');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('25','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-21','10:32:35','9','9','10');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('26','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-21','10:33:29','10','10','11');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('27','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-21','10:34:02','11','11','12');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('28','26','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-08-21','10:35:36','','','13');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('29','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-21','10:38:31','13','13','14');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('30','26','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-08-21','10:50:23','','','15');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('31','26','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-08-21','10:51:03','','','16');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('32','26','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-08-21','10:51:47','','','17');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('33','26','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2019-08-21','11:05:30','','','14');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('34','26','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2019-08-21','11:06:16','','','15');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('35','26','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2019-08-21','11:43:37','','','16');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('36','26','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-08-26','16:38:59','','','18');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('37','26','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-08-26','16:42:44','','','19');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('38','26','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-08-26','16:44:05','','','20');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('39','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-26','16:45:14','20','20','21');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('40','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-26','17:07:46','21','21','22');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('41','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-26','17:08:24','22','22','23');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('42','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-26','17:09:43','23','23','24');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('43','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-26','17:10:19','24','24','25');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('44','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-26','17:11:13','25','25','26');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('45','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-26','17:13:07','26','26','27');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('46','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-26','17:13:43','27','27','28');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('47','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-26','17:15:08','28','28','29');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('48','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-26','17:18:53','29','29','30');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('49','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-28','18:58:27','30','30','31');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('50','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-28','19:00:25','31','31','32');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('51','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-28','19:02:12','32','32','33');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('52','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-28','19:03:29','33','33','34');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('53','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-28','19:05:11','34','34','35');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('54','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-28','19:06:30','35','35','36');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('55','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-28','19:07:51','36','36','37');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('56','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-28','19:08:29','37','37','38');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('57','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-28','19:09:00','38','38','39');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('58','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-28','19:14:36','39','39','40');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('59','26','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-08-28','19:17:20','40','40','41');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('60','22','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2019-09-10','14:41:17','','','17');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('61','22','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-09-10','14:44:38','17','17','18');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('62','22','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-09-10','14:45:27','18','18','19');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('63','22','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-09-10','14:45:58','19','19','20');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('64','22','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2019-09-10','14:55:54','','','21');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('65','22','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-09-10','15:01:27','21','21','22');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('66','22','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-09-10','15:06:47','22','22','24');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('67','22','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-09-10','15:07:52','23','23','25');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('68','22','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-09-10','15:10:41','24','24','26');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('69','22','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-09-10','15:11:48','25','25','27');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('70','22','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-09-10','15:18:27','8','8','30');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('71','22','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-09-11','13:00:15','','','42');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('72','22','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-09-11','13:02:35','42','42','43');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('73','22','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-09-11','13:05:05','','','44');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('74','21','127.0.0.1','Cerró la información del mes','Indicadores de Gestión','','2019-09-11','13:07:05','','','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('75','21','127.0.0.1','Cerró información mensual','Criterio de Medida','','2019-09-11','13:07:15','','','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('76','22','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2019-09-11','13:07:49','','','33');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('77','22','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2019-09-11','13:08:37','','','34');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('78','22','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-09-11','13:09:27','','','45');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('79','22','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-09-11','13:10:03','','','46');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('80','22','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-09-11','13:12:26','34','34','35');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('81','22','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-09-11','13:13:10','35','35','36');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('82','22','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-09-11','13:14:58','45','45','47');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('83','22','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-09-11','13:20:47','47','47','48');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('84','22','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-09-11','13:23:22','48','48','49');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('85','22','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-09-11','13:24:20','49','49','50');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('86','22','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-09-11','13:24:53','','','51');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('87','22','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-09-11','13:25:52','','','52');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('88','21','127.0.0.1','Cerró la información del mes','Indicadores de Gestión','','2019-09-19','08:32:03','','','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('89','21','127.0.0.1','Cerró información mensual','Criterio de Medida','','2019-09-19','08:32:37','','','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('90','22','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2019-10-19','08:38:52','','','37');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('91','22','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-10-19','08:41:47','37','37','38');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('92','22','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-10-21','10:36:06','38','38','39');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('93','22','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-10-21','11:05:48','39','39','40');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('94','22','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-10-21','12:04:39','40','40','41');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('95','22','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2019-01-23','17:22:39','','','42');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('96','22','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-01-23','17:38:55','42','42','43');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('97','22','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-01-23','17:42:46','43','43','44');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('98','22','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-01-23','17:43:39','44','44','45');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('99','22','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2019-10-28','10:25:57','45','45','47');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('100','22','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2019-08-28','09:29:21','','','48');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('101','22','127.0.0.1','Certificó evaluación','Cumplimiento','frontend\\models\\Cumplimiento','2019-08-28','09:35:58','','','48');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('102','22','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-11-02','11:01:24','','','53');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('103','22','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-11-02','11:02:49','','','54');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('104','22','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-11-02','11:03:51','53','53','55');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('105','22','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-11-02','11:37:03','55','55','56');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('106','22','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-11-03','17:06:16','','','57');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('107','22','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-11-03','17:15:13','54','54','58');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('108','22','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-11-03','17:15:47','56','56','59');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('109','22','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-11-03','17:16:22','','','60');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('110','22','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-11-03','17:17:24','58','58','61');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('111','21','127.0.0.1','Eliminó','Evaluacion','frontend\\models\\Evaluacion','2019-11-03','17:18:12','61','61','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('112','21','127.0.0.1','Eliminó','Evaluacion','frontend\\models\\Evaluacion','2019-11-03','17:35:53','59','59','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('113','21','127.0.0.1','Eliminó','Evaluacion','frontend\\models\\Evaluacion','2019-11-03','17:38:00','60','60','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('114','22','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-11-03','17:41:01','','','62');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('115','22','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-11-03','17:42:16','','','63');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('116','21','127.0.0.1','Eliminó','Evaluacion','frontend\\models\\Evaluacion','2019-11-03','17:42:52','57','57','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('117','21','127.0.0.1','Eliminó','Evaluacion','frontend\\models\\Evaluacion','2019-11-03','17:43:35','62','62','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('118','21','127.0.0.1','Eliminó','Evaluacion','frontend\\models\\Evaluacion','2019-11-03','17:44:06','63','63','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('119','22','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-11-03','17:45:03','','','64');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('120','22','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2019-11-03','18:01:46','','','65');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('121','22','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-11-03','18:02:04','65','65','66');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('122','22','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2019-11-03','18:03:10','66','66','67');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('123','26','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2020-05-02','10:56:02','','','49');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('124','26','127.0.0.1','Certificó evaluación','Cumplimiento','frontend\\models\\Cumplimiento','2020-05-02','10:56:49','','','49');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('125','21','127.0.0.1','Cerró el periodo de Evaluación','Indicadores de Gestión','','2020-09-02','10:08:51','','','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('126','21','127.0.0.1','Activó el periodo de Evaluación','Indicadores de Gestión','','2020-10-02','15:07:54','','','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('127','27','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2020-10-02','15:12:16','','','50');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('128','27','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2020-10-02','15:14:51','','','51');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('129','27','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2020-08-02','15:24:06','','','52');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('130','21','127.0.0.1','Eliminó','Objetivo','frontend\\models\\Objetivo','2020-10-28','11:41:15','1','1','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('131','21','127.0.0.1','Eliminó','Objetivo','frontend\\models\\Objetivo','2020-10-28','11:42:24','2','2','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('132','21','127.0.0.1','Eliminó','Criterio de Medida','frontend\\models\\Criteriomedida','2020-10-28','11:42:24','7','7','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('133','21','127.0.0.1','Eliminó','Criterio de Medida','frontend\\models\\Criteriomedida','2020-10-28','11:42:25','8','8','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('134','21','127.0.0.1','Eliminó','Criterio de Medida','frontend\\models\\Criteriomedida','2020-10-28','11:42:25','9','9','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('135','21','127.0.0.1','Eliminó','Criterio de Medida','frontend\\models\\Criteriomedida','2020-10-28','11:42:25','10','10','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('136','21','127.0.0.1','Eliminó','Criterio de Medida','frontend\\models\\Criteriomedida','2020-10-28','11:42:25','11','11','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('137','21','127.0.0.1','Eliminó','Criterio de Medida','frontend\\models\\Criteriomedida','2020-10-28','11:42:25','12','12','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('138','21','127.0.0.1','Eliminó','Objetivo','frontend\\models\\Objetivo','2020-10-28','15:46:01','1','1','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('139','21','127.0.0.1','Eliminó','Criterio de Medida','frontend\\models\\Criteriomedida','2020-10-28','15:46:02','1','1','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('140','21','127.0.0.1','Eliminó','Criterio de Medida','frontend\\models\\Criteriomedida','2020-10-28','15:46:02','2','2','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('141','21','127.0.0.1','Eliminó','Criterio de Medida','frontend\\models\\Criteriomedida','2020-10-28','15:46:02','3','3','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('142','21','127.0.0.1','Eliminó','Criterio de Medida','frontend\\models\\Criteriomedida','2020-10-28','15:46:02','4','4','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('143','21','127.0.0.1','Eliminó','Criterio de Medida','frontend\\models\\Criteriomedida','2020-10-28','15:46:02','5','5','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('144','21','127.0.0.1','Eliminó','Criterio de Medida','frontend\\models\\Criteriomedida','2020-10-28','15:46:03','6','6','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('145','21','127.0.0.1','Eliminó','Indicadores de Gestión','frontend\\models\\IndicadoresGestion','2020-10-28','15:46:03','1','1','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('146','21','127.0.0.1','Eliminó','Indicadores de Gestión','frontend\\models\\IndicadoresGestion','2020-10-28','15:46:03','2','2','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('147','21','127.0.0.1','Eliminó','Indicadores de Gestión','frontend\\models\\IndicadoresGestion','2020-10-28','15:46:03','3','3','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('148','21','127.0.0.1','Eliminó','Indicadores de Gestión','frontend\\models\\IndicadoresGestion','2020-10-28','15:46:04','4','4','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('149','21','127.0.0.1','Eliminó','Indicadores de Gestión','frontend\\models\\IndicadoresGestion','2020-10-28','15:46:04','5','5','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('150','21','127.0.0.1','Eliminó','Objetivo','frontend\\models\\Objetivo','2020-10-28','16:20:21','4','4','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('151','21','127.0.0.1','Eliminó','Criterio de Medida','frontend\\models\\Criteriomedida','2020-10-28','16:20:22','20','20','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('152','21','127.0.0.1','Eliminó','Criterio de Medida','frontend\\models\\Criteriomedida','2020-10-28','16:20:22','21','21','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('153','21','127.0.0.1','Eliminó','Criterio de Medida','frontend\\models\\Criteriomedida','2020-10-28','16:20:22','22','22','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('154','21','127.0.0.1','Eliminó','Criterio de Medida','frontend\\models\\Criteriomedida','2020-10-28','16:20:22','23','23','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('155','21','127.0.0.1','Eliminó','Criterio de Medida','frontend\\models\\Criteriomedida','2020-10-28','16:20:22','24','24','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('156','21','127.0.0.1','Eliminó','Criterio de Medida','frontend\\models\\Criteriomedida','2020-10-28','16:20:22','25','25','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('157','21','127.0.0.1','Eliminó','Criterio de Medida','frontend\\models\\Criteriomedida','2020-10-28','16:20:22','26','26','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('158','21','127.0.0.1','Eliminó','Indicadores de Gestión','frontend\\models\\IndicadoresGestion','2020-10-28','16:20:22','21','21','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('159','21','127.0.0.1','Eliminó','Indicadores de Gestión','frontend\\models\\IndicadoresGestion','2020-10-28','16:20:22','22','22','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('160','21','127.0.0.1','Eliminó','Indicadores de Gestión','frontend\\models\\IndicadoresGestion','2020-10-28','16:20:23','23','23','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('161','21','127.0.0.1','Eliminó','Indicadores de Gestión','frontend\\models\\IndicadoresGestion','2020-10-28','16:20:23','24','24','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('162','21','127.0.0.1','Eliminó','Indicadores de Gestión','frontend\\models\\IndicadoresGestion','2020-10-28','16:20:23','25','25','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('163','21','127.0.0.1','Eliminó','Indicadores de Gestión','frontend\\models\\IndicadoresGestion','2020-10-28','16:20:23','26','26','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('164','21','127.0.0.1','Eliminó','Indicadores de Gestión','frontend\\models\\IndicadoresGestion','2020-10-28','16:20:23','27','27','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('165','21','127.0.0.1','Eliminó','Indicadores de Gestión','frontend\\models\\IndicadoresGestion','2020-10-28','16:20:23','28','28','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('166','21','127.0.0.1','Eliminó','Indicadores de Gestión','frontend\\models\\IndicadoresGestion','2020-10-28','16:20:24','29','29','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('167','21','127.0.0.1','Eliminó','Indicadores de Gestión','frontend\\models\\IndicadoresGestion','2020-10-28','16:20:24','30','30','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('168','21','127.0.0.1','Eliminó','Indicadores de Gestión','frontend\\models\\IndicadoresGestion','2020-10-28','16:20:24','31','31','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('169','21','127.0.0.1','Eliminó','Indicadores de Gestión','frontend\\models\\IndicadoresGestion','2020-10-28','16:20:24','63','63','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('170','21','127.0.0.1','Eliminó','Criterio de Medida','frontend\\models\\Criteriomedida','2020-10-28','16:21:35','8','8','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('171','22','127.0.0.1','Actualizó','Cumplimiento','frontend\\models\\Cumplimiento','2020-10-30','15:19:42','41','41','53');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('172','22','127.0.0.1','Certificó evaluación','Evaluacion','frontend\\models\\Evaluacion','2020-10-30','15:20:31','','','64');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('173','22','127.0.0.1','Certificó evaluación','Cumplimiento','frontend\\models\\Cumplimiento','2020-10-30','15:20:55','','','53');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('174','21','127.0.0.1','Cerró información mensual','Criterio de Medida','','2020-10-30','15:26:16','','','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('175','21','127.0.0.1','Cerró la información del mes','Indicadores de Gestión','','2020-10-30','15:26:26','','','');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('176','22','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2020-10-30','15:27:48','','','54');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('177','22','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2020-10-30','15:28:31','','','55');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('178','32','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2020-10-30','22:17:47','','','56');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('179','32','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2020-10-30','22:21:40','','','68');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('180','32','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2020-10-30','22:23:15','','','57');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('181','32','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2020-10-30','22:23:43','','','58');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('182','22','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2020-11-14','19:23:52','','','59');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('183','22','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2020-11-14','19:25:44','','','69');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('184','22','127.0.0.1','Actualizó','Evaluacion','frontend\\models\\Evaluacion','2020-11-14','19:26:55','69','69','70');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('185','22','127.0.0.1','Certificó evaluación','Cumplimiento','frontend\\models\\Cumplimiento','2020-11-14','19:27:54','','','59');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('186','26','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2020-11-17','13:14:54','','','60');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('187','26','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2020-11-17','13:27:03','','','71');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('188','26','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2020-11-17','13:27:21','','','72');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('189','26','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2020-11-17','13:27:50','','','73');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('190','26','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2020-11-17','13:28:11','','','74');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('191','26','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2020-11-17','13:28:36','','','75');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('192','26','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2020-11-17','13:28:59','','','61');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('193','26','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2020-11-17','13:29:21','','','62');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('194','26','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2020-11-17','13:29:54','','','63');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('195','26','127.0.0.1','Creó','Evaluacion','frontend\\models\\Evaluacion','2020-11-17','13:30:09','','','76');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('196','26','127.0.0.1','Certificó evaluación','Evaluacion','frontend\\models\\Evaluacion','2020-11-17','13:32:31','','','72');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('197','26','127.0.0.1','Certificó evaluación','Evaluacion','frontend\\models\\Evaluacion','2020-11-17','13:32:35','','','71');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('198','26','127.0.0.1','Certificó evaluación','Cumplimiento','frontend\\models\\Cumplimiento','2020-11-17','13:32:52','','','62');
INSERT INTO `trazas` (`IdTraza`,`IdUsuario`,`ip`,`tarea_realizada`,`Tabla_Afectada`,`ubicacion`,`fecha`,`hora`,`id_modificado`,`valor_antiguo`,`valor_actual`) VALUES
('199','23','127.0.0.1','Creó','Cumplimiento','frontend\\models\\Cumplimiento','2020-11-17','19:04:19','','','64');



-- -------------------------------------------
-- TABLE DATA user
-- -------------------------------------------
INSERT INTO `user` (`id`,`username`,`password_hash`,`password_reset_token`,`trabajadorid`,`direccionid`,`rolid`,`auth_key`,`status`,`conectado`,`created_at`,`updated_at`,`password write-only password`) VALUES
('7','SiteAdmin','$2y$13$Dh.kJheu2x0rSBYfcvaPtOLwRA4r/6TRDpB8GFI.oP2nASraOD0ki','','0','7','1','hwhP_5wWW7haO1zlycU5d4s9b_GPqL_h','10','1','1552941901','1552966051','');
INSERT INTO `user` (`id`,`username`,`password_hash`,`password_reset_token`,`trabajadorid`,`direccionid`,`rolid`,`auth_key`,`status`,`conectado`,`created_at`,`updated_at`,`password write-only password`) VALUES
('11','edalio','$2y$13$JVhL0aREnQly2DS7.OUwZOwu3wy.kUZQfyW0Ql7AqlSbvd/G6S9wC','','0','1','5','EF5SAUt1FYR1ZKBCXL9-K_V9NbElgA4v','10','0','1553518114','1596812532','');
INSERT INTO `user` (`id`,`username`,`password_hash`,`password_reset_token`,`trabajadorid`,`direccionid`,`rolid`,`auth_key`,`status`,`conectado`,`created_at`,`updated_at`,`password write-only password`) VALUES
('12','irina','$2y$13$im4uQ7Jb6Ov8XOg1z3Su4etydLoknqqJDFF/2rxZaZZYVQ5TyAzsG','','0','2','4','-4GhyqQr0gwsN_jhfScjTD99cr1YpZhn','10','0','1553538232','1596812508','');
INSERT INTO `user` (`id`,`username`,`password_hash`,`password_reset_token`,`trabajadorid`,`direccionid`,`rolid`,`auth_key`,`status`,`conectado`,`created_at`,`updated_at`,`password write-only password`) VALUES
('21','sederg','$2y$13$Dh.kJheu2x0rSBYfcvaPtOLwRA4r/6TRDpB8GFI.oP2nASraOD0ki','','0','2','2','4yE0BcliWpgvbDUZE0G9ZSozLVUDnGp6','10','0','1555450626','1596812484','');
INSERT INTO `user` (`id`,`username`,`password_hash`,`password_reset_token`,`trabajadorid`,`direccionid`,`rolid`,`auth_key`,`status`,`conectado`,`created_at`,`updated_at`,`password write-only password`) VALUES
('22','director','$2y$13$WjGrZk/rgjpzKMRJR7NlrusMjn9kFuqLY/wOKI1rX7YmGuciVvisO','','0','5','3','VMJCGiO0n457zJzll9IjJR5gZmd8OFRG','10','0','1555509353','1596812466','');
INSERT INTO `user` (`id`,`username`,`password_hash`,`password_reset_token`,`trabajadorid`,`direccionid`,`rolid`,`auth_key`,`status`,`conectado`,`created_at`,`updated_at`,`password write-only password`) VALUES
('23','omar','$2y$13$.ccv3uubaZBg0hlGnvht6.4hvEd.6uflAKWzj.Fg0vVNE6efO9ivG','','0','5','4','VbVGx_CmlbywNg_bZ-nfWiC88Ov-y0Jz','10','0','1555608157','1604097882','');
INSERT INTO `user` (`id`,`username`,`password_hash`,`password_reset_token`,`trabajadorid`,`direccionid`,`rolid`,`auth_key`,`status`,`conectado`,`created_at`,`updated_at`,`password write-only password`) VALUES
('25','sederg01','$2y$13$XEHz0dFX9YAlR.pa1U7.H.1uCRxxFlR07F2w6u7.Y7412Ji1hzCf6','','0','4','3','0W0rjZHHrsqwzI67n_4yjgxCI7CSV9Vc','10','0','1556929592','1596812426','');
INSERT INTO `user` (`id`,`username`,`password_hash`,`password_reset_token`,`trabajadorid`,`direccionid`,`rolid`,`auth_key`,`status`,`conectado`,`created_at`,`updated_at`,`password write-only password`) VALUES
('26','DCuadros','$2y$13$plBuxxawg4tyCPs59eKF3eIO4T2.8SKxN4jl8h1f2VBLg8f97CWFe','','0','2','3','lgHOPHf8tLbh5lPVW6boeQIMo_396pef','10','0','1557449597','1596812403','');
INSERT INTO `user` (`id`,`username`,`password_hash`,`password_reset_token`,`trabajadorid`,`direccionid`,`rolid`,`auth_key`,`status`,`conectado`,`created_at`,`updated_at`,`password write-only password`) VALUES
('27','economia','$2y$13$zn3JJMcN/r6qs5x6V0b9GefYAGAXy/YrmZhuSKhPF3hms4P.HNiFW','','12','12','3','i-hi8Y5bhzzc7_8H9Dqy7mOaypCff6ED','10','0','1560112515','1596812361','');
INSERT INTO `user` (`id`,`username`,`password_hash`,`password_reset_token`,`trabajadorid`,`direccionid`,`rolid`,`auth_key`,`status`,`conectado`,`created_at`,`updated_at`,`password write-only password`) VALUES
('28','informatica','$2y$13$F8VTzezaUR5drE4cAvor7.qqDY.YJJTQr12W7xg0WLnCmVzsCCIo6','','13','7','3','JN3GZl698O3RG9GWHZdmp31cFgvtzdTm','10','0','1560112974','1596812296','');
INSERT INTO `user` (`id`,`username`,`password_hash`,`password_reset_token`,`trabajadorid`,`direccionid`,`rolid`,`auth_key`,`status`,`conectado`,`created_at`,`updated_at`,`password write-only password`) VALUES
('29','gestorcuadro','$2y$13$wAsgu.cvaCIiLTxqraHdCuK6Cz2O0p8vpwCHHvqaUG5qQ6.Y6mNiC','','14','2','6','uEt3KD8kxBtIp3fj1wJgLavRQSm2jYfO','10','1','1567538830','1596835992','');
INSERT INTO `user` (`id`,`username`,`password_hash`,`password_reset_token`,`trabajadorid`,`direccionid`,`rolid`,`auth_key`,`status`,`conectado`,`created_at`,`updated_at`,`password write-only password`) VALUES
('30','evaluador','$2y$13$cuJypb9MZvE8THp9CnjioeiCn.wr3Lun1Oa7q8EWAv5qLdrAhHZP6','','15','2','7','pwm4vy0s4yyS-qDT-FV20wapS4gUmsnT','10','0','1597439013','1597439013','');
INSERT INTO `user` (`id`,`username`,`password_hash`,`password_reset_token`,`trabajadorid`,`direccionid`,`rolid`,`auth_key`,`status`,`conectado`,`created_at`,`updated_at`,`password write-only password`) VALUES
('31','investigacion','$2y$13$87CK2RSb5vOEwOuGEdxy3u8v7E3cGVBkgj5L/Xjv9/XJhFdGTIgH.','','16','9','4','Dm0iDjYMEBWJCTkADWonSDgBtOsEh4ey','0','0','1604099927','1604099927','');
INSERT INTO `user` (`id`,`username`,`password_hash`,`password_reset_token`,`trabajadorid`,`direccionid`,`rolid`,`auth_key`,`status`,`conectado`,`created_at`,`updated_at`,`password write-only password`) VALUES
('32','investigacio','$2y$13$uMD2.XSQepWNDaQqhEI07eQ7huw0LGnolElPmTutCgl4VeBs7KzPy','','17','9','4','h0YQ3SToL-NdFCuGOMcfSJfztsKPQ53P','10','0','1604113816','1604113816','');
INSERT INTO `user` (`id`,`username`,`password_hash`,`password_reset_token`,`trabajadorid`,`direccionid`,`rolid`,`auth_key`,`status`,`conectado`,`created_at`,`updated_at`,`password write-only password`) VALUES
('33','rosa','$2y$13$MOGCR5/Zsc/Whf2gGSG0y.XFZaEjV1H8ABePyHHmeCLV7F6QWfAbm','','18','2','7','AH_60396L3ZicTenCUfiK86cjtluOmbC','10','0','1606162844','1606162844','');



-- -------------------------------------------
-- TABLE DATA utilidad
-- -------------------------------------------
INSERT INTO `utilidad` (`plan`,`vreal`,`fecha`,`status`,`id`,`empresaid`,`real_anterior`,`plan_anual`,`real_acum_plan`,`IPUI`,`IRUI`,`IPGI`,`IRGI`,`anexoid`) VALUES
('17289.4','32963.2','2020-10-02','1','1','31','45558.4','76537.5','43','0.0163','0.0268','0.9837','0.9732','44');
INSERT INTO `utilidad` (`plan`,`vreal`,`fecha`,`status`,`id`,`empresaid`,`real_anterior`,`plan_anual`,`real_acum_plan`,`IPUI`,`IRUI`,`IPGI`,`IRGI`,`anexoid`) VALUES
('835.6','1031.5','2020-10-02','1','2','11','3045.9','3282.6','31','0.0214','0.0184','0.9786','0.9816','44');
INSERT INTO `utilidad` (`plan`,`vreal`,`fecha`,`status`,`id`,`empresaid`,`real_anterior`,`plan_anual`,`real_acum_plan`,`IPUI`,`IRUI`,`IPGI`,`IRGI`,`anexoid`) VALUES
('227.2','2642.9','2020-10-02','1','3','12','3587.7','8017.4','33','0.0054','0.0587','0.9946','0.9413','44');
INSERT INTO `utilidad` (`plan`,`vreal`,`fecha`,`status`,`id`,`empresaid`,`real_anterior`,`plan_anual`,`real_acum_plan`,`IPUI`,`IRUI`,`IPGI`,`IRGI`,`anexoid`) VALUES
('1327.4','3262.8','2020-10-02','1','4','13','2484.6','6598.7','49','0.039','0.0875','0.961','0.9125','44');
INSERT INTO `utilidad` (`plan`,`vreal`,`fecha`,`status`,`id`,`empresaid`,`real_anterior`,`plan_anual`,`real_acum_plan`,`IPUI`,`IRUI`,`IPGI`,`IRGI`,`anexoid`) VALUES
('805.7','1425.8','2020-10-02','1','5','14','2910.2','2168.8','66','0.012','0.019','0.988','0.981','44');
INSERT INTO `utilidad` (`plan`,`vreal`,`fecha`,`status`,`id`,`empresaid`,`real_anterior`,`plan_anual`,`real_acum_plan`,`IPUI`,`IRUI`,`IPGI`,`IRGI`,`anexoid`) VALUES
('1383.4','1594.1','2020-10-02','1','6','15','2168.3','4461.1','36','0.0224','0.0243','0.9776','0.9757','44');
INSERT INTO `utilidad` (`plan`,`vreal`,`fecha`,`status`,`id`,`empresaid`,`real_anterior`,`plan_anual`,`real_acum_plan`,`IPUI`,`IRUI`,`IPGI`,`IRGI`,`anexoid`) VALUES
('865.6','1191.8','2020-10-02','1','7','17','1495.2','2875.7','41','0.0127','0.0168','0.9873','0.9832','44');
INSERT INTO `utilidad` (`plan`,`vreal`,`fecha`,`status`,`id`,`empresaid`,`real_anterior`,`plan_anual`,`real_acum_plan`,`IPUI`,`IRUI`,`IPGI`,`IRGI`,`anexoid`) VALUES
('1351.5','1249','2020-10-02','1','8','16','2894.1','4260.7','29','0.0347','0.0304','0.9653','0.9696','44');
INSERT INTO `utilidad` (`plan`,`vreal`,`fecha`,`status`,`id`,`empresaid`,`real_anterior`,`plan_anual`,`real_acum_plan`,`IPUI`,`IRUI`,`IPGI`,`IRGI`,`anexoid`) VALUES
('671.5','631.9','2020-10-02','1','9','18','1438','3652.8','17','0.0181','0.0162','0.9819','0.9838','44');
INSERT INTO `utilidad` (`plan`,`vreal`,`fecha`,`status`,`id`,`empresaid`,`real_anterior`,`plan_anual`,`real_acum_plan`,`IPUI`,`IRUI`,`IPGI`,`IRGI`,`anexoid`) VALUES
('80','205','2020-10-02','1','10','19','642.2','259.3','79','0.002','0.0049','0.998','0.9951','44');
INSERT INTO `utilidad` (`plan`,`vreal`,`fecha`,`status`,`id`,`empresaid`,`real_anterior`,`plan_anual`,`real_acum_plan`,`IPUI`,`IRUI`,`IPGI`,`IRGI`,`anexoid`) VALUES
('786.1','1850.6','2020-10-02','1','11','20','2064.6','2789.1','66','0.0129','0.0273','0.9871','0.9727','44');
INSERT INTO `utilidad` (`plan`,`vreal`,`fecha`,`status`,`id`,`empresaid`,`real_anterior`,`plan_anual`,`real_acum_plan`,`IPUI`,`IRUI`,`IPGI`,`IRGI`,`anexoid`) VALUES
('423.4','551.3','2020-10-02','1','12','21','1726.4','1514.9','36','0.0119','0.0109','0.9881','0.9891','44');
INSERT INTO `utilidad` (`plan`,`vreal`,`fecha`,`status`,`id`,`empresaid`,`real_anterior`,`plan_anual`,`real_acum_plan`,`IPUI`,`IRUI`,`IPGI`,`IRGI`,`anexoid`) VALUES
('2375.7','2938.4','2020-10-02','1','13','22','3942.5','7173.2','41','0.0311','0.0306','0.9689','0.9694','44');
INSERT INTO `utilidad` (`plan`,`vreal`,`fecha`,`status`,`id`,`empresaid`,`real_anterior`,`plan_anual`,`real_acum_plan`,`IPUI`,`IRUI`,`IPGI`,`IRGI`,`anexoid`) VALUES
('328.1','394.6','2020-10-02','1','14','23','1613.4','4514.8','9','0.0057','0.0058','0.9943','0.9942','44');
INSERT INTO `utilidad` (`plan`,`vreal`,`fecha`,`status`,`id`,`empresaid`,`real_anterior`,`plan_anual`,`real_acum_plan`,`IPUI`,`IRUI`,`IPGI`,`IRGI`,`anexoid`) VALUES
('1643.8','2115.2','2020-10-02','1','15','24','3152.3','6813.8','31','0.0221','0.0259','0.9779','0.9741','44');
INSERT INTO `utilidad` (`plan`,`vreal`,`fecha`,`status`,`id`,`empresaid`,`real_anterior`,`plan_anual`,`real_acum_plan`,`IPUI`,`IRUI`,`IPGI`,`IRGI`,`anexoid`) VALUES
('23.1','-84.5','2020-10-02','1','16','25','911.7','163.6','-52','0.0006','-0.002','0.9994','1.002','44');
INSERT INTO `utilidad` (`plan`,`vreal`,`fecha`,`status`,`id`,`empresaid`,`real_anterior`,`plan_anual`,`real_acum_plan`,`IPUI`,`IRUI`,`IPGI`,`IRGI`,`anexoid`) VALUES
('23.4','27.7','2020-10-02','1','17','26','340.5','84.7','33','0.0024','0.0025','0.9976','0.9975','44');
INSERT INTO `utilidad` (`plan`,`vreal`,`fecha`,`status`,`id`,`empresaid`,`real_anterior`,`plan_anual`,`real_acum_plan`,`IPUI`,`IRUI`,`IPGI`,`IRGI`,`anexoid`) VALUES
('120.9','126.6','2020-10-02','1','18','27','747.9','1443.5','9','0.0009','0.0007','0.9991','0.9993','44');
INSERT INTO `utilidad` (`plan`,`vreal`,`fecha`,`status`,`id`,`empresaid`,`real_anterior`,`plan_anual`,`real_acum_plan`,`IPUI`,`IRUI`,`IPGI`,`IRGI`,`anexoid`) VALUES
('389.8','2553.8','2020-10-02','1','19','28','36.3','4780.4','53','0.004','0.0244','0.996','0.9756','44');
INSERT INTO `utilidad` (`plan`,`vreal`,`fecha`,`status`,`id`,`empresaid`,`real_anterior`,`plan_anual`,`real_acum_plan`,`IPUI`,`IRUI`,`IPGI`,`IRGI`,`anexoid`) VALUES
('3090.5','3844.2','2020-10-02','1','20','29','4944.8','11055.1','35','0.1785','0.2208','0.8215','0.7792','44');



-- -------------------------------------------
-- TABLE DATA utilidadxpeso
-- -------------------------------------------
INSERT INTO `utilidadxpeso` (`id`,`UPVA_vreal`,`UPVA_plan`,`fecha`,`status`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('1','0.185','0.1699','2019-07-27','1','11','0.4144','3');
INSERT INTO `utilidadxpeso` (`id`,`UPVA_vreal`,`UPVA_plan`,`fecha`,`status`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('2','0.3611','0.0395','2019-07-27','1','12','0.5966','3');
INSERT INTO `utilidadxpeso` (`id`,`UPVA_vreal`,`UPVA_plan`,`fecha`,`status`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('3','0.5287','0.2374','2019-07-27','1','13','0.5283','3');
INSERT INTO `utilidadxpeso` (`id`,`UPVA_vreal`,`UPVA_plan`,`fecha`,`status`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('4','0.1775','0.108','2019-07-27','1','14','0.296','3');
INSERT INTO `utilidadxpeso` (`id`,`UPVA_vreal`,`UPVA_plan`,`fecha`,`status`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('5','0.241','0.1833','2019-07-27','1','15','0.2701','3');
INSERT INTO `utilidadxpeso` (`id`,`UPVA_vreal`,`UPVA_plan`,`fecha`,`status`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('6','0.1262','0.1191','2019-07-27','1','17','0.1718','3');
INSERT INTO `utilidadxpeso` (`id`,`UPVA_vreal`,`UPVA_plan`,`fecha`,`status`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('7','0.2807','0.2552','2019-07-27','1','16','0.5209','3');
INSERT INTO `utilidadxpeso` (`id`,`UPVA_vreal`,`UPVA_plan`,`fecha`,`status`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('8','0.1449','0.1392','2019-07-27','1','18','0.3506','3');
INSERT INTO `utilidadxpeso` (`id`,`UPVA_vreal`,`UPVA_plan`,`fecha`,`status`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('9','0.0551','0.0232','2019-07-27','1','19','0.1412','3');
INSERT INTO `utilidadxpeso` (`id`,`UPVA_vreal`,`UPVA_plan`,`fecha`,`status`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('10','0.2722','0.1349','2019-07-27','1','20','0.3194','3');
INSERT INTO `utilidadxpeso` (`id`,`UPVA_vreal`,`UPVA_plan`,`fecha`,`status`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('11','0.1062','0.1021','2019-07-27','1','21','0.3326','3');
INSERT INTO `utilidadxpeso` (`id`,`UPVA_vreal`,`UPVA_plan`,`fecha`,`status`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('12','0.2506','0.2504','2019-07-27','1','22','0.3955','3');
INSERT INTO `utilidadxpeso` (`id`,`UPVA_vreal`,`UPVA_plan`,`fecha`,`status`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('13','0.0805','0.0601','2019-07-27','1','23','0.287','3');
INSERT INTO `utilidadxpeso` (`id`,`UPVA_vreal`,`UPVA_plan`,`fecha`,`status`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('14','0.295','0.2047','2019-07-27','1','24','0.3199','3');
INSERT INTO `utilidadxpeso` (`id`,`UPVA_vreal`,`UPVA_plan`,`fecha`,`status`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('15','-0.0294','0.0058','2019-07-27','1','25','0.2383','3');
INSERT INTO `utilidadxpeso` (`id`,`UPVA_vreal`,`UPVA_plan`,`fecha`,`status`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('16','0.0264','0.017','2019-07-27','1','26','0.2348','3');
INSERT INTO `utilidadxpeso` (`id`,`UPVA_vreal`,`UPVA_plan`,`fecha`,`status`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('17','0.0388','0.0359','2019-07-27','1','27','0.1878','3');
INSERT INTO `utilidadxpeso` (`id`,`UPVA_vreal`,`UPVA_plan`,`fecha`,`status`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('18','0.2458','0.0554','2019-07-27','1','28','0.0039','3');
INSERT INTO `utilidadxpeso` (`id`,`UPVA_vreal`,`UPVA_plan`,`fecha`,`status`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('19','0.3053','0.2638','2019-07-27','1','29','0.3604','3');
INSERT INTO `utilidadxpeso` (`id`,`UPVA_vreal`,`UPVA_plan`,`fecha`,`status`,`empresaid`,`plan_anterior`,`anexoid`) VALUES
('20','0.6528','0.2176','2019-07-27','1','30','0.3822','3');



-- -------------------------------------------
-- TABLE DATA variacion_gastos
-- -------------------------------------------
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('1','11','135.3','187.7','2019-07-31','1','','3');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('2','12','178.3','165.5','2019-07-31','1','','3');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('3','13','118.3','374.8','2019-07-31','1','','3');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('4','14','600','779.7','2019-07-31','1','','3');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('5','15','141.7','300.4','2019-07-31','1','','3');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('6','17','100','172.5','2019-07-31','1','','3');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('7','16','115','405.2','2019-07-31','1','','3');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('8','18','141.7','159.4','2019-07-31','1','','3');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('9','19','135','233.7','2019-07-31','1','','3');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('10','20','176','237.6','2019-07-31','1','','3');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('11','21','108.3','143','2019-07-31','1','','3');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('12','22','141','633.4','2019-07-31','1','','3');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('13','23','208.3','436.1','2019-07-31','1','','3');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('14','24','216.7','416.4','2019-07-31','1','','3');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('15','25','166.7','466.9','2019-07-31','1','','3');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('16','26','10','6','2019-07-31','1','','3');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('18','11','718.89','0','2019-08-15','1','2019-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('19','11','7861.81','0','2019-08-15','1','2018-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('20','12','0','0','2019-08-15','1','2019-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('21','12','0','18538.07','2019-08-15','1','2018-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('22','13','0','0','2019-08-15','1','2019-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('23','13','0','0','2019-08-15','1','2018-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('24','14','66709.79','22860.89','2019-08-15','1','2019-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('25','14','46123.73','0','2019-08-15','1','2018-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('26','15','67275.79','394385.3','2019-08-15','1','2019-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('27','15','67992.05','0','2019-08-15','1','2018-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('28','17','2923.54','21458.27','2019-08-15','1','2019-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('29','17','39762.22','0','2019-08-15','1','2018-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('30','16','110305.38','0','2019-08-15','1','2019-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('31','16','67334.17','0','2019-08-15','1','2018-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('32','18','28197.77','0','2019-08-15','1','2019-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('33','18','15472.43','0','2019-08-15','1','2018-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('34','19','264.25','0','2019-08-15','1','2019-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('35','19','355854.59','898.13','2019-08-15','1','2018-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('36','20','13190.73','0','2019-08-15','1','2019-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('37','20','64607.77','0','2019-08-15','1','2018-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('38','21','1658.95','2485.05','2019-08-15','1','2019-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('39','21','6094','0','2019-08-15','1','2018-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('40','22','102632.83','106.52','2019-08-15','1','2019-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('41','22','422132.75','162858.04','2019-08-15','1','2018-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('42','23','38092.1','0','2019-08-15','1','2019-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('43','23','5879.94','0','2019-08-15','1','2018-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('44','24','55470.83','0','2019-08-15','1','2019-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('45','24','88067.02','44680.34','2019-08-15','1','2018-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('46','25','13303.12','0','2019-08-15','1','2019-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('47','25','45201.35','0','2019-08-15','1','2018-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('48','26','92776.38','23.45','2019-08-15','1','2019-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('49','26','105019.26','380.48','2019-08-15','1','2018-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('50','31','0','0','2019-08-15','1','2019-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('51','31','0','0','2019-08-15','1','2018-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('52','27','272416.35','0','2019-08-15','1','2019-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('53','27','355809.53','0','2019-08-15','1','2018-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('54','28','0','0','2019-08-15','1','2019-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('55','28','0','0','2019-08-15','1','2018-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('56','29','20961.41','0','2019-08-15','1','2019-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('57','29','0','0','2019-08-15','1','2018-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('58','30','2123.26','0','2019-08-15','1','2019-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('59','30','0','0','2019-08-15','1','2018-04','10');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('60','11','718.89','0','2019-08-21','1','2019-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('61','11','7861.81','0','2019-08-21','1','2018-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('62','12','0','0','2019-08-21','1','2019-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('63','12','0','18538.07','2019-08-21','1','2018-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('64','13','0','0','2019-08-21','1','2019-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('65','13','0','0','2019-08-21','1','2018-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('66','14','66709.79','22860.89','2019-08-21','1','2019-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('67','14','46123.73','0','2019-08-21','1','2018-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('68','15','67275.79','394385.3','2019-08-21','1','2019-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('69','15','67992.05','0','2019-08-21','1','2018-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('70','17','2923.54','21458.27','2019-08-21','1','2019-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('71','17','39762.22','0','2019-08-21','1','2018-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('72','16','110305.38','0','2019-08-21','1','2019-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('73','16','67334.17','0','2019-08-21','1','2018-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('74','18','28197.77','0','2019-08-21','1','2019-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('75','18','15472.43','0','2019-08-21','1','2018-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('76','19','264.25','0','2019-08-21','1','2019-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('77','19','355854.59','898.13','2019-08-21','1','2018-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('78','20','13190.73','0','2019-08-21','1','2019-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('79','20','64607.77','0','2019-08-21','1','2018-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('80','21','1658.95','2485.05','2019-08-21','1','2019-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('81','21','6094','0','2019-08-21','1','2018-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('82','22','102632.83','106.52','2019-08-21','1','2019-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('83','22','422132.75','162858.04','2019-08-21','1','2018-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('84','23','38092.1','0','2019-08-21','1','2019-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('85','23','5879.94','0','2019-08-21','1','2018-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('86','24','55470.83','0','2019-08-21','1','2019-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('87','24','88067.02','44680.34','2019-08-21','1','2018-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('88','25','13303.12','0','2019-08-21','1','2019-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('89','25','45201.35','0','2019-08-21','1','2018-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('90','26','92776.38','23.45','2019-08-21','1','2019-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('91','26','105019.26','380.48','2019-08-21','1','2018-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('92','31','0','0','2019-08-21','1','2019-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('93','31','0','0','2019-08-21','1','2018-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('94','27','272416.35','0','2019-08-21','1','2019-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('95','27','355809.53','0','2019-08-21','1','2018-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('96','28','0','0','2019-08-21','1','2019-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('97','28','0','0','2019-08-21','1','2018-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('98','29','20961.41','0','2019-08-21','1','2019-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('99','29','0','0','2019-08-21','1','2018-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('100','30','2123.26','0','2019-08-21','1','2019-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('101','30','0','0','2019-08-21','1','2018-04','14');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('102','11','718.89','0','2019-10-19','0','2019-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('103','11','7861.81','0','2019-10-19','0','2018-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('104','12','0','0','2019-10-19','0','2019-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('105','12','0','18538.07','2019-10-19','0','2018-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('106','13','0','0','2019-10-19','0','2019-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('107','13','0','0','2019-10-19','0','2018-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('108','14','66709.79','22860.89','2019-10-19','0','2019-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('109','14','46123.73','0','2019-10-19','0','2018-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('110','15','67275.79','394385.3','2019-10-19','0','2019-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('111','15','67992.05','0','2019-10-19','0','2018-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('112','17','2923.54','21458.27','2019-10-19','0','2019-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('113','17','39762.22','0','2019-10-19','0','2018-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('114','16','110305.38','0','2019-10-19','0','2019-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('115','16','67334.17','0','2019-10-19','0','2018-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('116','18','28197.77','0','2019-10-19','0','2019-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('117','18','15472.43','0','2019-10-19','0','2018-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('118','19','264.25','0','2019-10-19','0','2019-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('119','19','355854.59','898.13','2019-10-19','0','2018-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('120','20','13190.73','0','2019-10-19','0','2019-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('121','20','64607.77','0','2019-10-19','0','2018-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('122','21','1658.95','2485.05','2019-10-19','0','2019-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('123','21','6094','0','2019-10-19','0','2018-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('124','22','102632.83','106.52','2019-10-19','0','2019-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('125','22','422132.75','162858.04','2019-10-19','0','2018-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('126','23','38092.1','0','2019-10-19','0','2019-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('127','23','5879.94','0','2019-10-19','0','2018-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('128','24','55470.83','0','2019-10-19','0','2019-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('129','24','88067.02','44680.34','2019-10-19','0','2018-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('130','25','13303.12','0','2019-10-19','0','2019-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('131','25','45201.35','0','2019-10-19','0','2018-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('132','26','92776.38','23.45','2019-10-19','0','2019-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('133','26','105019.26','380.48','2019-10-19','0','2018-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('134','31','0','0','2019-10-19','0','2019-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('135','31','0','0','2019-10-19','0','2018-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('136','27','272416.35','0','2019-10-19','0','2019-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('137','27','355809.53','0','2019-10-19','0','2018-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('138','28','0','0','2019-10-19','0','2019-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('139','28','0','0','2019-10-19','0','2018-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('140','29','20961.41','0','2019-10-19','0','2019-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('141','29','0','0','2019-10-19','0','2018-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('142','30','2123.26','0','2019-10-19','0','2019-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('143','30','0','0','2019-10-19','0','2018-04','36');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('144','11','718.89','0','2019-10-19','0','2019-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('145','11','7861.81','0','2019-10-19','0','2018-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('146','12','0','0','2019-10-19','0','2019-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('147','12','0','18538.07','2019-10-19','0','2018-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('148','13','0','0','2019-10-19','0','2019-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('149','13','0','0','2019-10-19','0','2018-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('150','14','66709.79','22860.89','2019-10-19','0','2019-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('151','14','46123.73','0','2019-10-19','0','2018-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('152','15','67275.79','394385.3','2019-10-19','0','2019-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('153','15','67992.05','0','2019-10-19','0','2018-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('154','17','2923.54','21458.27','2019-10-19','0','2019-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('155','17','39762.22','0','2019-10-19','0','2018-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('156','16','110305.38','0','2019-10-19','0','2019-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('157','16','67334.17','0','2019-10-19','0','2018-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('158','18','28197.77','0','2019-10-19','0','2019-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('159','18','15472.43','0','2019-10-19','0','2018-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('160','19','264.25','0','2019-10-19','0','2019-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('161','19','355854.59','898.13','2019-10-19','0','2018-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('162','20','13190.73','0','2019-10-19','0','2019-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('163','20','64607.77','0','2019-10-19','0','2018-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('164','21','1658.95','2485.05','2019-10-19','0','2019-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('165','21','6094','0','2019-10-19','0','2018-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('166','22','102632.83','106.52','2019-10-19','0','2019-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('167','22','422132.75','162858.04','2019-10-19','0','2018-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('168','23','38092.1','0','2019-10-19','0','2019-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('169','23','5879.94','0','2019-10-19','0','2018-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('170','24','55470.83','0','2019-10-19','0','2019-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('171','24','88067.02','44680.34','2019-10-19','0','2018-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('172','25','13303.12','0','2019-10-19','0','2019-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('173','25','45201.35','0','2019-10-19','0','2018-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('174','26','92776.38','23.45','2019-10-19','0','2019-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('175','26','105019.26','380.48','2019-10-19','0','2018-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('176','31','0','0','2019-10-19','0','2019-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('177','31','0','0','2019-10-19','0','2018-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('178','27','272416.35','0','2019-10-19','0','2019-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('179','27','355809.53','0','2019-10-19','0','2018-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('180','28','0','0','2019-10-19','0','2019-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('181','28','0','0','2019-10-19','0','2018-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('182','29','20961.41','0','2019-10-19','0','2019-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('183','29','0','0','2019-10-19','0','2018-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('184','30','2123.26','0','2019-10-19','0','2019-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('185','30','0','0','2019-10-19','0','2018-07','37');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('186','11','7861.81','0','2019-10-21','0','2019-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('187','11','718.89','0','2019-10-21','0','2018-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('188','12','0','18538.07','2019-10-21','0','2019-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('189','12','0','0','2019-10-21','0','2018-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('190','13','0','0','2019-10-21','0','2019-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('191','13','0','0','2019-10-21','0','2018-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('192','14','46123.73','0','2019-10-21','0','2019-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('193','14','66709.79','-22860.89','2019-10-21','0','2018-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('194','15','67992.05','0','2019-10-21','0','2019-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('195','15','67275.79','-394385.3','2019-10-21','0','2018-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('196','17','39762.22','0','2019-10-21','0','2019-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('197','17','2923.54','-21458.27','2019-10-21','0','2018-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('198','16','67334.17','0','2019-10-21','0','2019-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('199','16','110305.38','0','2019-10-21','0','2018-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('200','18','15472.43','0','2019-10-21','0','2019-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('201','18','28197.77','0','2019-10-21','0','2018-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('202','19','355854.59','898.13','2019-10-21','0','2019-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('203','19','264.25','0','2019-10-21','0','2018-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('204','20','64607.77','0','2019-10-21','0','2019-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('205','20','13190.73','0','2019-10-21','0','2018-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('206','21','6094','0','2019-10-21','0','2019-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('207','21','1658.95','-2485.05','2019-10-21','0','2018-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('208','22','422132.75','162858.04','2019-10-21','0','2019-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('209','22','102632.83','106.52','2019-10-21','0','2018-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('210','23','5879.94','0','2019-10-21','0','2019-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('211','23','38092.1','0','2019-10-21','0','2018-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('212','24','88067.02','44680.34','2019-10-21','0','2019-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('213','24','55470.83','0','2019-10-21','0','2018-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('214','25','45201.35','0','2019-10-21','0','2019-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('215','25','13303.12','0','2019-10-21','0','2018-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('216','26','105019.26','380.48','2019-10-21','0','2019-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('217','26','92776.38','23.45','2019-10-21','0','2018-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('218','31','0','0','2019-10-21','0','2019-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('219','31','0','0','2019-10-21','0','2018-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('220','27','355809.53','0','2019-10-21','0','2019-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('221','27','272416.35','0','2019-10-21','0','2018-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('222','28','0','0','2019-10-21','0','2019-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('223','28','0','0','2019-10-21','0','2018-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('224','29','0','0','2019-10-21','0','2019-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('225','29','20961.41','0','2019-10-21','0','2018-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('226','30','0','0','2019-10-21','0','2019-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('227','30','2123.26','0','2019-10-21','0','2018-07','38');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('228','11','7861.81','0','2019-10-21','0','2019-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('229','11','718.89','0','2019-10-21','0','2018-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('230','12','0','18538.07','2019-10-21','0','2019-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('231','12','0','0','2019-10-21','0','2018-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('232','13','0','0','2019-10-21','0','2019-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('233','13','0','0','2019-10-21','0','2018-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('234','14','46123.73','0','2019-10-21','0','2019-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('235','14','66709.79','22860.89','2019-10-21','0','2018-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('236','15','67992.05','0','2019-10-21','0','2019-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('237','15','67275.79','394385.3','2019-10-21','0','2018-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('238','17','39762.22','0','2019-10-21','0','2019-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('239','17','2923.54','21458.27','2019-10-21','0','2018-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('240','16','67334.17','0','2019-10-21','0','2019-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('241','16','110305.38','0','2019-10-21','0','2018-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('242','18','15472.43','0','2019-10-21','0','2019-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('243','18','28197.77','0','2019-10-21','0','2018-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('244','19','355854.59','898.13','2019-10-21','0','2019-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('245','19','264.25','0','2019-10-21','0','2018-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('246','20','64607.77','0','2019-10-21','0','2019-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('247','20','13190.73','0','2019-10-21','0','2018-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('248','21','6094','0','2019-10-21','0','2019-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('249','21','1658.95','2485.05','2019-10-21','0','2018-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('250','22','422132.75','162858.04','2019-10-21','0','2019-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('251','22','102632.83','106.52','2019-10-21','0','2018-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('252','23','5879.94','0','2019-10-21','0','2019-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('253','23','38092.1','0','2019-10-21','0','2018-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('254','24','88067.02','44680.34','2019-10-21','0','2019-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('255','24','55470.83','0','2019-10-21','0','2018-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('256','25','45201.35','0','2019-10-21','0','2019-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('257','25','13303.12','0','2019-10-21','0','2018-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('258','26','105019.26','380.48','2019-10-21','0','2019-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('259','26','92776.38','23.45','2019-10-21','0','2018-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('260','31','0','0','2019-10-21','0','2019-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('261','31','0','0','2019-10-21','0','2018-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('262','27','355809.53','0','2019-10-21','0','2019-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('263','27','272416.35','0','2019-10-21','0','2018-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('264','28','0','0','2019-10-21','0','2019-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('265','28','0','0','2019-10-21','0','2018-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('266','29','0','0','2019-10-21','0','2019-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('267','29','20961.41','0','2019-10-21','0','2018-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('268','30','0','0','2019-10-21','0','2019-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('269','30','2123.26','0','2019-10-21','0','2018-07','39');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('270','11','7861.81','0','2019-10-21','1','2019-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('271','11','718.89','0','2019-10-21','1','2018-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('272','12','0','18538.07','2019-10-21','1','2019-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('273','12','0','0','2019-10-21','1','2018-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('274','13','0','0','2019-10-21','1','2019-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('275','13','0','0','2019-10-21','1','2018-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('276','14','46123.73','0','2019-10-21','1','2019-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('277','14','66709.79','22860.89','2019-10-21','1','2018-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('278','15','67992.05','0','2019-10-21','1','2019-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('279','15','67275.79','394385.3','2019-10-21','1','2018-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('280','17','39762.22','0','2019-10-21','1','2019-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('281','17','2923.54','21458.27','2019-10-21','1','2018-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('282','16','67334.17','0','2019-10-21','1','2019-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('283','16','110305.38','0','2019-10-21','1','2018-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('284','18','15472.43','0','2019-10-21','1','2019-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('285','18','28197.77','0','2019-10-21','1','2018-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('286','19','355854.59','-898.13','2019-10-21','1','2019-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('287','19','264.25','0','2019-10-21','1','2018-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('288','20','64607.77','0','2019-10-21','1','2019-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('289','20','13190.73','0','2019-10-21','1','2018-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('290','21','6094','0','2019-10-21','1','2019-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('291','21','1658.95','2485.05','2019-10-21','1','2018-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('292','22','422132.75','-162858.04','2019-10-21','1','2019-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('293','22','102632.83','106.52','2019-10-21','1','2018-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('294','23','5879.94','0','2019-10-21','1','2019-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('295','23','38092.1','0','2019-10-21','1','2018-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('296','24','88067.02','44680.34','2019-10-21','1','2019-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('297','24','55470.83','0','2019-10-21','1','2018-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('298','25','45201.35','0','2019-10-21','1','2019-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('299','25','13303.12','0','2019-10-21','1','2018-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('300','26','105019.26','380.48','2019-10-21','1','2019-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('301','26','92776.38','23.45','2019-10-21','1','2018-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('302','31','0','0','2019-10-21','1','2019-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('303','31','0','0','2019-10-21','1','2018-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('304','27','355809.53','0','2019-10-21','1','2019-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('305','27','272416.35','0','2019-10-21','1','2018-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('306','28','0','0','2019-10-21','1','2019-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('307','28','0','0','2019-10-21','1','2018-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('308','29','0','0','2019-10-21','1','2019-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('309','29','20961.41','0','2019-10-21','1','2018-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('310','30','0','0','2019-10-21','1','2019-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('311','30','2123.26','0','2019-10-21','1','2018-07','40');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('312','11','7861.81','0','2019-11-03','1','2019-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('313','11','718.89','0','2019-11-03','1','2018-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('314','12','0','18538.07','2019-11-03','1','2019-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('315','12','0','0','2019-11-03','1','2018-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('316','13','0','0','2019-11-03','1','2019-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('317','13','0','0','2019-11-03','1','2018-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('318','14','46123.73','0','2019-11-03','1','2019-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('319','14','66709.79','22860.89','2019-11-03','1','2018-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('320','15','67992.05','0','2019-11-03','1','2019-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('321','15','67275.79','394385.3','2019-11-03','1','2018-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('322','17','39762.22','0','2019-11-03','1','2019-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('323','17','2923.54','21458.27','2019-11-03','1','2018-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('324','16','67334.17','0','2019-11-03','1','2019-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('325','16','110305.38','0','2019-11-03','1','2018-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('326','18','15472.43','0','2019-11-03','1','2019-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('327','18','28197.77','0','2019-11-03','1','2018-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('328','19','355854.59','-898.13','2019-11-03','1','2019-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('329','19','264.25','0','2019-11-03','1','2018-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('330','20','64607.77','0','2019-11-03','1','2019-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('331','20','13190.73','0','2019-11-03','1','2018-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('332','21','6094','0','2019-11-03','1','2019-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('333','21','1658.95','2485.05','2019-11-03','1','2018-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('334','22','422132.75','-162858.04','2019-11-03','1','2019-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('335','22','102632.83','106.52','2019-11-03','1','2018-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('336','23','5879.94','0','2019-11-03','1','2019-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('337','23','38092.1','0','2019-11-03','1','2018-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('338','24','88067.02','44680.34','2019-11-03','1','2019-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('339','24','55470.83','0','2019-11-03','1','2018-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('340','25','45201.35','0','2019-11-03','1','2019-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('341','25','13303.12','0','2019-11-03','1','2018-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('342','26','105019.26','380.48','2019-11-03','1','2019-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('343','26','92776.38','23.45','2019-11-03','1','2018-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('344','31','0','0','2019-11-03','1','2019-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('345','31','0','0','2019-11-03','1','2018-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('346','27','355809.53','0','2019-11-03','1','2019-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('347','27','272416.35','0','2019-11-03','1','2018-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('348','28','0','0','2019-11-03','1','2019-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('349','28','0','0','2019-11-03','1','2018-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('350','29','0','0','2019-11-03','1','2019-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('351','29','20961.41','0','2019-11-03','1','2018-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('352','30','0','0','2019-11-03','1','2019-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('353','30','2123.26','0','2019-11-03','1','2018-07','59');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('354','11','7861.81','0','2019-11-03','1','2019-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('355','11','718.89','0','2019-11-03','1','2018-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('356','12','0','18538.07','2019-11-03','1','2019-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('357','12','0','0','2019-11-03','1','2018-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('358','13','0','0','2019-11-03','1','2019-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('359','13','0','0','2019-11-03','1','2018-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('360','14','46123.73','0','2019-11-03','1','2019-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('361','14','66709.79','22860.89','2019-11-03','1','2018-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('362','15','67992.05','0','2019-11-03','1','2019-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('363','15','67275.79','394385.3','2019-11-03','1','2018-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('364','17','39762.22','0','2019-11-03','1','2019-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('365','17','2923.54','21458.27','2019-11-03','1','2018-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('366','16','67334.17','0','2019-11-03','1','2019-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('367','16','110305.38','0','2019-11-03','1','2018-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('368','18','15472.43','0','2019-11-03','1','2019-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('369','18','28197.77','0','2019-11-03','1','2018-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('370','19','355854.59','-898.13','2019-11-03','1','2019-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('371','19','264.25','0','2019-11-03','1','2018-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('372','20','64607.77','0','2019-11-03','1','2019-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('373','20','13190.73','0','2019-11-03','1','2018-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('374','21','6094','0','2019-11-03','1','2019-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('375','21','1658.95','2485.05','2019-11-03','1','2018-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('376','22','422132.75','-162858.04','2019-11-03','1','2019-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('377','22','102632.83','106.52','2019-11-03','1','2018-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('378','23','5879.94','0','2019-11-03','1','2019-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('379','23','38092.1','0','2019-11-03','1','2018-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('380','24','88067.02','44680.34','2019-11-03','1','2019-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('381','24','55470.83','0','2019-11-03','1','2018-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('382','25','45201.35','0','2019-11-03','1','2019-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('383','25','13303.12','0','2019-11-03','1','2018-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('384','26','105019.26','380.48','2019-11-03','1','2019-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('385','26','92776.38','23.45','2019-11-03','1','2018-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('386','31','0','0','2019-11-03','1','2019-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('387','31','0','0','2019-11-03','1','2018-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('388','27','355809.53','0','2019-11-03','1','2019-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('389','27','272416.35','0','2019-11-03','1','2018-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('390','28','0','0','2019-11-03','1','2019-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('391','28','0','0','2019-11-03','1','2018-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('392','29','0','0','2019-11-03','1','2019-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('393','29','20961.41','0','2019-11-03','1','2018-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('394','30','0','0','2019-11-03','1','2019-07','61');
INSERT INTO `variacion_gastos` (`id`,`empresaid`,`gastosxperdida`,`gastosxfaltante`,`fecha`,`status`,`periodo`,`anexoid`) VALUES
('395','30','2123.26','0','2019-11-03','1','2018-07','61');



-- -------------------------------------------
-- TABLE DATA vehiculo
-- -------------------------------------------
INSERT INTO `vehiculo` (`id`,`tipo_vehiculoid`,`modelo`,`marca`,`matricula`,`cuadroid`) VALUES
('33','1','2','2','dsd','79');
INSERT INTO `vehiculo` (`id`,`tipo_vehiculoid`,`modelo`,`marca`,`matricula`,`cuadroid`) VALUES
('34','2','3','3','3','79');
INSERT INTO `vehiculo` (`id`,`tipo_vehiculoid`,`modelo`,`marca`,`matricula`,`cuadroid`) VALUES
('35','3','3','3','3','79');
INSERT INTO `vehiculo` (`id`,`tipo_vehiculoid`,`modelo`,`marca`,`matricula`,`cuadroid`) VALUES
('42','1','2107','lada','P2135456','84');
INSERT INTO `vehiculo` (`id`,`tipo_vehiculoid`,`modelo`,`marca`,`matricula`,`cuadroid`) VALUES
('43','2','land Rover','Mercedes Bens','p4589632','84');
INSERT INTO `vehiculo` (`id`,`tipo_vehiculoid`,`modelo`,`marca`,`matricula`,`cuadroid`) VALUES
('44','1','Sportage','KIA','P986545','84');



-- -------------------------------------------
-- TABLE DATA ventas
-- -------------------------------------------
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('4','2149110.5','2014814.1','0','2','31','2019-09-10','1','19');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('5','98883.9','90025.3','0','2','11','2019-09-10','1','19');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('6','70277.2','71704.8','0','2','12','2019-09-10','1','19');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('7','59059','62307.5','0','2','13','2019-09-10','1','19');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('8','134451.3','127840.7','0','2','14','2019-09-10','1','19');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('9','102907','104091.3','0','2','15','2019-09-10','1','19');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('10','125723.7','112701.5','10','2','17','2019-09-10','1','19');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('11','71603.6','66232','0','2','16','2019-09-10','1','19');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('12','70606','65646.9','0','2','18','2019-09-10','1','19');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('13','71846.6','71691.6','0','2','19','2019-09-10','1','19');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('14','118090.2','107252.1','0','2','20','2019-09-10','1','19');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('15','84868.7','72991.6','0','2','21','2019-09-10','1','19');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('16','163166.9','132019.2','0','2','22','2019-09-10','1','19');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('17','122543.1','99643.7','0','2','23','2019-09-10','1','19');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('18','153368.4','152914.7','0','2','24','2019-09-10','1','19');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('19','76940.2','69493.2','0','2','25','2019-09-10','1','19');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('20','18959.9','17783.3','0','2','26','2019-09-10','1','19');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('21','315532.7','313628.8','0','2','27','2019-09-10','1','19');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('22','204549.3','183210.6','0','2','28','2019-09-10','1','19');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('23','29727.9','28939.6','0','2','29','2019-09-10','1','19');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('24','135.3','187.7','1','3','11','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('25','719363','745899','2','3','11','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('26','18.6','1.9','3','1','11','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('27','178.3','165.5','1','3','12','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('28','616517','876960','2','3','12','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('29','24.8','3.1','3','3','12','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('30','118.3','374.8','1','3','13','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('31','462140','701280','2','3','13','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('32','18.6','2.4','3','3','13','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('33','600','779.7','1','3','14','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('34','2498579','3070189','2','3','14','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('35','37.2','12.2','3','3','14','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('36','141.7','300.4','1','3','15','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('37','846478','192211','2','3','15','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('38','24.8','16.9','3','3','15','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('39','100','112356.5','1','3','17','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('40','969456','1254024','2','3','17','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('41','7.8','2.7','3','3','17','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('42','115','405.2','1','3','16','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('43','496836','481382','2','3','16','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('44','7.8','9.2','3','3','16','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('45','141.7','159.4','1','3','18','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('46','566450','183754','2','3','18','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('47','7.8','15.7','3','3','18','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('48','135','233.7','1','3','19','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('49','518607','912042','2','3','19','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('50','7.8','12.3','3','3','19','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('51','176','237.6','1','3','20','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('52','946274','1105804','2','3','20','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('53','22.5','79.1','3','3','20','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('54','108.3','143','1','3','21','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('55','656271','740176','2','3','21','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('56','22.5','8.1','3','3','21','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('57','141','633.4','1','3','22','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('58','1261575','513072','2','3','22','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('59','30','27.6','3','3','22','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('60','208.3','436.1','1','3','23','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('61','1018653','863036','2','3','23','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('62','30','2.2','3','3','23','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('63','216.7','416.4','1','3','24','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('64','1274672','156994','2','3','24','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('65','30','8.6','3','3','24','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('66','166.7','466.9','1','3','25','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('67','621958','798752','2','3','25','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('68','15','4.2','3','3','25','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('69','10','6','1','3','26','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('70','105072','378534','2','3','26','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('71','','','3','3','26','2020-10-02','1','45');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('72','135.3','187.7','1','3','11','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('73','719363','745899','2','3','11','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('74','18.6','1.9','3','3','11','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('75','719363','745899','9','3','11','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('76','18.6','1.9','12','3','11','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('77','719363','745899','8','3','11','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('78','18.6','1.9','10','3','11','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('79','178.3','165.5','1','3','12','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('80','616517','876960','2','3','12','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('81','24.8','3.1','3','3','12','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('82','616517','876960','9','3','12','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('83','24.8','3.1','12','3','12','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('84','616517','876960','8','3','12','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('85','24.8','3.1','10','3','12','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('86','118.3','374.8','1','3','13','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('87','462140','701280','2','3','13','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('88','18.6','2.4','3','3','13','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('89','462140','701280','9','3','13','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('90','18.6','2.4','12','3','13','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('91','462140','701280','8','3','13','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('92','18.6','2.4','10','3','13','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('93','600','779.7','1','3','14','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('94','2498579','3070189','2','3','14','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('95','37.2','12.2','3','3','14','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('96','2498579','3070189','9','3','14','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('97','37.2','12.2','12','3','14','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('98','2498579','3070189','8','3','14','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('99','37.2','12.2','10','3','14','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('100','141.7','300.4','1','3','15','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('101','846478','192211','2','3','15','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('102','24.8','16.9','3','3','15','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('103','846478','192211','9','3','15','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('104','24.8','16.9','12','3','15','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('105','846478','192211','8','3','15','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('106','24.8','16.9','10','2','15','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('107','100','172.5','1','3','17','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('108','969456','1254024','2','1','17','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('109','7.8','2.7','3','3','17','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('110','969456','1254024','9','3','17','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('111','7.8','2.7','12','3','17','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('112','969456','1254024','8','3','17','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('113','7.8','2.7','10','3','17','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('114','115','405.2','1','3','16','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('115','496836','481382','2','3','16','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('116','7.8','9.2','3','3','16','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('117','496836','481382','9','3','16','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('118','7.8','9.2','12','3','16','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('119','496836','481382','8','3','16','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('120','7.8','9.2','10','3','16','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('121','141.7','159.4','1','3','18','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('122','566450','183754','2','3','18','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('123','7.8','15.7','3','3','18','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('124','566450','183754','9','3','18','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('125','7.8','15.7','12','3','18','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('126','566450','183754','8','3','18','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('127','7.8','15.7','10','3','18','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('128','135','233.7','1','3','19','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('129','518607','912042','2','3','19','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('130','7.8','12.3','3','3','19','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('131','518607','912042','9','3','19','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('132','7.8','12.3','12','3','19','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('133','518607','912042','8','3','19','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('134','7.8','12.3','10','3','19','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('135','176','237.6','1','3','20','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('136','946274','1105804','2','3','20','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('137','22.5','79.1','3','3','20','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('138','946274','1105804','9','3','20','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('139','22.5','79.1','12','3','20','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('140','946274','1105804','8','3','20','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('141','22.5','79.1','10','3','20','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('142','108.3','143','1','3','21','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('143','656271','740176','2','3','21','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('144','22.5','8.1','3','3','21','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('145','656271','740176','9','3','21','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('146','22.5','8.1','12','3','21','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('147','656271','740176','8','3','21','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('148','22.5','8.1','10','3','21','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('149','141','633.4','1','3','22','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('150','1261575','513072','2','3','22','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('151','30','27.6','3','3','22','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('152','1261575','513072','9','3','22','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('153','30','27.6','12','3','22','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('154','1261575','513072','8','3','22','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('155','30','27.6','10','3','22','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('156','208.3','436.1','1','3','23','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('157','1018653','863036','2','3','23','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('158','30','2.2','3','3','23','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('159','1018653','863036','9','3','23','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('160','30','2.2','12','3','23','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('161','1018653','863036','8','3','23','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('162','30','2.2','10','3','23','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('163','216.7','416.4','1','3','24','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('164','1274672','156994','2','3','24','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('165','30','8.6','3','3','24','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('166','1274672','156994','9','3','24','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('167','30','8.6','12','3','24','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('168','1274672','156994','8','3','24','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('169','30','8.6','10','3','24','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('170','166.7','466.9','1','3','25','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('171','621958','798752','2','3','25','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('172','15','4.2','3','3','25','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('173','621958','798752','9','3','25','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('174','15','4.2','12','3','25','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('175','621958','798752','8','3','25','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('176','15','4.2','10','3','25','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('177','10','6','1','3','26','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('178','105072','378534','2','3','26','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('179','','','3','3','26','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('180','105072','378534','9','3','26','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('181','','','12','3','26','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('182','105072','378534','8','3','26','2020-08-02','1','46');
INSERT INTO `ventas` (`id`,`plan`,`vreal`,`productoid`,`tipo_ventaid`,`empresaid`,`fecha`,`status`,`anexoid`) VALUES
('183','','','10','3','26','2020-08-02','1','46');



-- -------------------------------------------
-- TABLE DATA viajes_familiares
-- -------------------------------------------
INSERT INTO `viajes_familiares` (`id`,`fecha`,`pais`,`familiarid`) VALUES
('15','2009-06-16','España ','31');
INSERT INTO `viajes_familiares` (`id`,`fecha`,`pais`,`familiarid`) VALUES
('16','2020-09-15','rumania','37');
INSERT INTO `viajes_familiares` (`id`,`fecha`,`pais`,`familiarid`) VALUES
('17','1990-03-25','Japon','37');
INSERT INTO `viajes_familiares` (`id`,`fecha`,`pais`,`familiarid`) VALUES
('18','2001-03-05','Bulgaria','37');
INSERT INTO `viajes_familiares` (`id`,`fecha`,`pais`,`familiarid`) VALUES
('19','1996-06-15','francia','37');
INSERT INTO `viajes_familiares` (`id`,`fecha`,`pais`,`familiarid`) VALUES
('20','2018-03-03','Ecuador','43');
INSERT INTO `viajes_familiares` (`id`,`fecha`,`pais`,`familiarid`) VALUES
('21','2018-12-01','Rusia','43');



-- -------------------------------------------
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
COMMIT;
-- -------------------------------------------
-- -------------------------------------------
-- END BACKUP
-- -------------------------------------------
