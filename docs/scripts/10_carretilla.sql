CREATE TABLE `dynapolls`.`carretilla` (
  `usercod` BIGINT(10) NOT NULL,
  `codprd` BIGINT(18) NOT NULL,
  `crrctd` INT(5) NOT NULL,
  `crrprc` DECIMAL(12,2) NOT NULL,
  `crrfching` DATETIME NOT NULL,
  PRIMARY KEY (`usercod`, `codprd`),
  INDEX `codprd_idx` (`codprd` ASC),
  CONSTRAINT `carretilla_user_key`
    FOREIGN KEY (`usercod`)
    REFERENCES `dynapolls`.`usuario` (`usercod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `carretilla_prd_key`
    FOREIGN KEY (`codprd`)
    REFERENCES `dynapolls`.`productos` (`codprd`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);