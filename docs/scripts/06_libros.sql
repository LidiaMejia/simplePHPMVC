CREATE TABLE `dynapolls`.`libros` (
`librocod` INT(10) UNSIGNED NOT NULL,
`libronom` VARCHAR(100) NOT NULL,
`libroautor` VARCHAR(100) NOT NULL,
`libroest` CHAR(3) NOT NULL DEFAULT 'DIS',
PRIMARY KEY (`librocod`));

ALTER TABLE `dynapolls`.`libros` 
CHANGE COLUMN `librocod` `librocod` INT
(10) UNSIGNED NOT NULL AUTO_INCREMENT ;

INSERT INTO `dynapolls`.`libros` (`libronom`, `libroautor`, `libroest`) VALUES ('Don Quijote de la Mancha', 'Miguel de Cervantes', 'DIS');
INSERT INTO `dynapolls`.`libros` (`libronom`, `libroautor`, `libroest`) VALUES ('El Alquimista', 'Paulo Cohelo', 'DIS');
INSERT INTO `dynapolls`.`libros` (`libronom`, `libroautor`, `libroest`) VALUES ('Saga Harry Potter', 'J.K. Rowling', 'DIS');
INSERT INTO `dynapolls`.`libros` (`libronom`, `libroautor`, `libroest`) VALUES ('Saga Game of Thrones', 'George Martin', 'DIS');