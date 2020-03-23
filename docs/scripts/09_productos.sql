CREATE TABLE `dynapolls`.`productos` (
  `codprd` BIGINT(18) NOT NULL AUTO_INCREMENT,
  `dscprd` VARCHAR(70) NOT NULL,
  `sdscprd` VARCHAR(255) NOT NULL,
  `ldscprd` TEXT NULL,
  `skuprd` VARCHAR(128) NOT NULL,
  `bcdprd` VARCHAR(128) NOT NULL,
  `stkprd` INT NOT NULL,
  `typprd` CHAR(3) NOT NULL,
  `prcprd` DECIMAL(12,2) NOT NULL,
  `urlprd` VARCHAR(255) NULL,
  `urlthbprd` VARCHAR(255) NULL,
  `estprd` CHAR(3) NOT NULL,
  PRIMARY KEY (`codprd`),
  UNIQUE INDEX `skuprd_UNIQUE` (`skuprd` ASC),
  UNIQUE INDEX `bcdprd_UNIQUE` (`bcdprd` ASC));

  INSERT INTO `dynapolls`.`productos` (`dscprd`, `sdscprd`, `ldscprd`, `skuprd`, `bcdprd`, `stkprd`, `typprd`, `prcprd`, `urlprd`, `urlthbprd`, `estprd`) VALUES ('Panadol Extra Fuerte', 'Caja de 20 Tabletas de Panadol Extra Fuerte', 'Panadol Extra Fuerte para el alivio de dolores leves a moderados y la fiebre', 'PANC501', '012345678905', '10', 'RTL', '100', 'urlpanadol', 'urlpeqpanadol', 'ACT');