-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- DROP TABLE "data_sekolah" -----------------------------------
DROP TABLE IF EXISTS `data_sekolah` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "data_sekolah" ---------------------------------
CREATE TABLE `data_sekolah` ( 
	`id` Int( 1 ) NOT NULL DEFAULT 1,
	`nss` VarChar( 60 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`npsn` VarChar( 20 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`nama_sekolah` VarChar( 60 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`status_akreditasi` VarChar( 5 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`alamat_sekolah` Text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`email_sekolah` VarChar( 60 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`telp` VarChar( 30 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`website` VarChar( 60 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`kepsek_id` VarChar( 30 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`logo` VarChar( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = latin1
COLLATE = latin1_swedish_ci
ENGINE = InnoDB;
-- -------------------------------------------------------------


-- DROP TABLE "gurus" ------------------------------------------
DROP TABLE IF EXISTS `gurus` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "gurus" ----------------------------------------
CREATE TABLE `gurus` ( 
	`id` Int( 4 ) AUTO_INCREMENT NOT NULL,
	`nip` VarChar( 30 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`nama_lengkap` VarChar( 100 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`jk` VarChar( 1 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`password` Text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`hp` VarChar( 16 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`email` VarChar( 60 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`alamat` Text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`role` VarChar( 10 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = latin1
COLLATE = latin1_swedish_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------


-- DROP TABLE "kds" --------------------------------------------
DROP TABLE IF EXISTS `kds` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "kds" ------------------------------------------
CREATE TABLE `kds` ( 
	`id` Int( 4 ) AUTO_INCREMENT NOT NULL,
	`kode_kd` VarChar( 30 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`ki` VarChar( 5 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`tema` VarChar( 10 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`tingkat_id` VarChar( 2 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`mapel_id` VarChar( 30 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`teks_kd` Text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = latin1
COLLATE = latin1_swedish_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------


-- DROP TABLE "mapels" -----------------------------------------
DROP TABLE IF EXISTS `mapels` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "mapels" ---------------------------------------
CREATE TABLE `mapels` ( 
	`id` Int( 3 ) AUTO_INCREMENT NOT NULL,
	`kode_mapel` VarChar( 30 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`nama_mapel` VarChar( 100 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = latin1
COLLATE = latin1_swedish_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------


-- DROP TABLE "nilais" -----------------------------------------
DROP TABLE IF EXISTS `nilais` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "nilais" ---------------------------------------
CREATE TABLE `nilais` ( 
	`id` Int( 10 ) AUTO_INCREMENT NOT NULL,
	`sem` VarChar( 2 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`tapel` VarChar( 5 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`rombel_id` VarChar( 20 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`tema_id` VarChar( 10 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`kd_id` VarChar( 10 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`mapel_id` VarChar( 10 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`skor` Decimal( 2, 2 ) NOT NULL,
	`pred` VarChar( 1 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = latin1
COLLATE = latin1_swedish_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------


-- DROP TABLE "ortus" ------------------------------------------
DROP TABLE IF EXISTS `ortus` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "ortus" ----------------------------------------
CREATE TABLE `ortus` ( 
	`id` Int( 10 ) AUTO_INCREMENT NOT NULL,
	`nik_aktif` VarChar( 20 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`nama_ayah` VarChar( 60 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`nama_ibu` VarChar( 60 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`nama_wali` VarChar( 60 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`job_ayah` VarChar( 60 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`job_ibu` VarChar( 60 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`job_wali` VarChar( 60 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`alamat_ayah` VarChar( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`alamat_ibu` VarChar( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`alamat_wali` VarChar( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`hp_ayah` VarChar( 16 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`hp_ibu` VarChar( 16 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`hp_wali` VarChar( 16 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`status_wali` VarChar( 60 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`email_aktif` VarChar( 60 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	PRIMARY KEY ( `id` ),
	CONSTRAINT `nik_aktif` UNIQUE( `nik_aktif` ) )
CHARACTER SET = latin1
COLLATE = latin1_swedish_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------


-- DROP TABLE "rombels" ----------------------------------------
DROP TABLE IF EXISTS `rombels` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "rombels" --------------------------------------
CREATE TABLE `rombels` ( 
	`id` Int( 3 ) AUTO_INCREMENT NOT NULL,
	`kode_rombel` VarChar( 20 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`nama_rombel` VarChar( 30 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`tingkat` VarChar( 1 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`guru_id` VarChar( 25 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = latin1
COLLATE = latin1_swedish_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------


-- DROP TABLE "semesters" --------------------------------------
DROP TABLE IF EXISTS `semesters` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "semesters" ------------------------------------
CREATE TABLE `semesters` ( 
	`id` Int( 1 ) AUTO_INCREMENT NOT NULL,
	`sem_ke` VarChar( 1 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`kat_sem` VarChar( 1 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`tipe_sem` VarChar( 6 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = latin1
COLLATE = latin1_swedish_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------


-- DROP TABLE "siswas" -----------------------------------------
DROP TABLE IF EXISTS `siswas` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "siswas" ---------------------------------------
CREATE TABLE `siswas` ( 
	`id` Int( 10 ) AUTO_INCREMENT NOT NULL,
	`nis` VarChar( 12 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`nisn` VarChar( 20 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`nama_siswa` VarChar( 100 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`jk` VarChar( 1 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`jl_siswa` VarChar( 100 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`desa_siswa` VarChar( 60 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`kec_siswa` VarChar( 60 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`kab_siswa` VarChar( 60 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`prov_siswa` VarChar( 60 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`hp_siswa` VarChar( 16 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`email_siswa` VarChar( 60 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`rombel_id` VarChar( 30 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	`ortu_id` VarChar( 30 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = latin1
COLLATE = latin1_swedish_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------


-- DROP TABLE "subtemas" ---------------------------------------
DROP TABLE IF EXISTS `subtemas` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "subtemas" -------------------------------------
CREATE TABLE `subtemas` ( 
	`id` Int( 5 ) AUTO_INCREMENT NOT NULL,
	`kode_subtema` VarChar( 10 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`tema_id` VarChar( 10 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`tingkat` VarChar( 2 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`teks_subtema` Text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = latin1
COLLATE = latin1_swedish_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------


-- DROP TABLE "tapels" -----------------------------------------
DROP TABLE IF EXISTS `tapels` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "tapels" ---------------------------------------
CREATE TABLE `tapels` ( 
	`id` Int( 3 ) AUTO_INCREMENT NOT NULL,
	`kode_tapel` VarChar( 5 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`label` VarChar( 10 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = latin1
COLLATE = latin1_swedish_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------


-- DROP TABLE "temas" ------------------------------------------
DROP TABLE IF EXISTS `temas` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "temas" ----------------------------------------
CREATE TABLE `temas` ( 
	`id` Int( 3 ) AUTO_INCREMENT NOT NULL,
	`kode_tema` VarChar( 5 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`tingkat_id` VarChar( 4 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`teks_tema` VarChar( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = latin1
COLLATE = latin1_swedish_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------


-- DROP TABLE "tingkats" ---------------------------------------
DROP TABLE IF EXISTS `tingkats` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "tingkats" -------------------------------------
CREATE TABLE `tingkats` ( 
	`id` VarChar( 2 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`tingkat` VarChar( 3 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`label` VarChar( 60 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = latin1
COLLATE = latin1_swedish_ci
ENGINE = InnoDB;
-- -------------------------------------------------------------


-- Dump data of "data_sekolah" -----------------------------
-- ---------------------------------------------------------


-- Dump data of "gurus" ------------------------------------
-- ---------------------------------------------------------


-- Dump data of "kds" --------------------------------------
-- ---------------------------------------------------------


-- Dump data of "mapels" -----------------------------------
-- ---------------------------------------------------------


-- Dump data of "nilais" -----------------------------------
-- ---------------------------------------------------------


-- Dump data of "ortus" ------------------------------------
-- ---------------------------------------------------------


-- Dump data of "rombels" ----------------------------------
-- ---------------------------------------------------------


-- Dump data of "semesters" --------------------------------
-- ---------------------------------------------------------


-- Dump data of "siswas" -----------------------------------
-- ---------------------------------------------------------


-- Dump data of "subtemas" ---------------------------------
-- ---------------------------------------------------------


-- Dump data of "tapels" -----------------------------------
-- ---------------------------------------------------------


-- Dump data of "temas" ------------------------------------
-- ---------------------------------------------------------


-- Dump data of "tingkats" ---------------------------------
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


