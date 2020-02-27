CREATE TABLE `dynapolls`.`colores` (
  `colorcod` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `colorhxd` CHAR(7) NOT NULL,
  `colordsc` VARCHAR(70) NOT NULL,
  `colorobs` VARCHAR(128) NOT NULL,
  PRIMARY KEY (`colorcod`));

ALTER TABLE `dynapolls`.`colores`
ADD COLUMN `colorest` CHAR
(3) NOT NULL DEFAULT 'ACT' AFTER `colorobs`; 

INSERT INTO `dynapolls`.`colores` (`colorhxd`, `colordsc`, `colorobs`, `colorest`) VALUES ('#FFFFFF', 'Blanco', 'Paredes de un Hospital Psiquiátrico', 'ACT');
INSERT INTO `dynapolls`.`colores` (`colorhxd`, `colordsc`, `colorobs`, `colorest`) VALUES ('#000000', 'Negro', 'Decorativos en paredes de otro color', 'ACT');
INSERT INTO `dynapolls`.`colores` (`colorhxd`, `colordsc`, `colorobs`, `colorest`) VALUES ('#FF7F50', 'Coral', 'Paredes de la sala', 'ACT');
INSERT INTO `dynapolls`.`colores` (`colorhxd`, `colordsc`, `colorobs`, `colorest`) VALUES ('#191970', 'Azul Medianoche', 'Paredes del estudio', 'ACT');
INSERT INTO `dynapolls`.`colores` (`colorhxd`, `colordsc`, `colorobs`, `colorest`) VALUES ('#A0522D', 'Siena', 'Exterior de una casa', 'ACT');

