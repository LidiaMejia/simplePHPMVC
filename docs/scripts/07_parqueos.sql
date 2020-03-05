CREATE TABLE `dynapolls`.`parqueos` (
  `parqueoId` INT NOT NULL AUTO_INCREMENT,
  `parqueoEst` CHAR(3) NOT NULL,
  `parqueoLot` VARCHAR(75) NOT NULL,
  `parqueoTip` CHAR(3) NOT NULL,
  PRIMARY KEY (`parqueoId`));

INSERT INTO `dynapolls`.`parqueos` (`parqueoEst`, `parqueoLot`, `parqueoTip`) VALUES ('AVL', 'Por la capilla', 'MTO');
INSERT INTO `dynapolls`.`parqueos` (`parqueoEst`, `parqueoLot`, `parqueoTip`) VALUES ('AVL', 'Por la Biblioteca', 'CAR');
INSERT INTO `dynapolls`.`parqueos` (`parqueoEst`, `parqueoLot`, `parqueoTip`) VALUES ('OCP', 'Edificio B2', 'CAR');
INSERT INTO `dynapolls`.`parqueos` (`parqueoEst`, `parqueoLot`, `parqueoTip`) VALUES ('RSV', 'Edificio I', 'TRK');