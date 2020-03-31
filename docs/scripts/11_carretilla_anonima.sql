CREATE TABLE `carretillaanon` (
  `anoncod` varchar(128) NOT NULL,
  `codprd` bigint(18) NOT NULL,
  `crrctd` int(5) NOT NULL,
  `crrprc` decimal(12,2) NOT NULL,
  `crrfching` datetime NOT NULL,
  PRIMARY KEY (`anoncod`,`codprd`),
  KEY `codprd_idx` (`codprd`),
  CONSTRAINT `carretillaanon_prd_key` FOREIGN KEY (`codprd`) REFERENCES `productos` (`codprd`) ON DELETE NO ACTION ON UPDATE NO ACTION
);