CREATE TABLE `dynapolls`.`colores` (
  `colorcod` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `colorhxd` CHAR(7) NOT NULL,
  `colordsc` VARCHAR(70) NOT NULL,
  `colorobs` VARCHAR(128) NOT NULL,
  PRIMARY KEY (`colorcod`));

INSERT INTO `dynapolls`.`colores` (`colorhxd`, `colordsc`, `colorobs`) VALUES ('#FFFFFF', 'Blanco', 'Paredes de un Hospital Psiquiátrico');
INSERT INTO `dynapolls`.`colores` (`colorhxd`, `colordsc`, `colorobs`) VALUES ('#000000', 'Negro', 'Decorativos en paredes de otro color');
INSERT INTO `dynapolls`.`colores` (`colorhxd`, `colordsc`, `colorobs`) VALUES ('#FF7F50', 'Coral', 'Paredes de la sala');
INSERT INTO `dynapolls`.`colores` (`colorhxd`, `colordsc`, `colorobs`) VALUES ('#191970', 'Azul Medianoche', 'Paredes del estudio');
INSERT INTO `dynapolls`.`colores` (`colorhxd`, `colordsc`, `colorobs`) VALUES ('#A0522D', 'Siena', 'Exterior de una casa');