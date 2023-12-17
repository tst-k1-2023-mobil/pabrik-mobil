-- Adminer 4.8.3 MySQL 8.2.0 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `pabrik`;
CREATE DATABASE `pabrik` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pabrik`;

DROP TABLE IF EXISTS `mobil`;
CREATE TABLE `mobil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `spesifikasi` varchar(3000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stok` int NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `waktuProduksi` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `mobil` (`id`, `nama`, `jenis`, `spesifikasi`, `stok`, `harga`, `waktuProduksi`) VALUES
(1,	'Kapibara',	'Sedan',	'Mobil murah bagus untuk keluarga',	100,	100000000,	2),
(2,	'Masbro',	'Coupe',	'Kapibara tapi lebih sporty',	10,	110000000,	3),
(3,	'Calico',	'Station wagon',	'Mobil tiga baris dengan warna belang tiga',	1000,	95000000,	1);

DROP TABLE IF EXISTS `assembly`;
CREATE TABLE `assembly` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mobilId` int NOT NULL,
  `status` enum('Produksi','Done') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Produksi',
  `tglProduksi` date NOT NULL,
  `tglSelesai` date NOT NULL,
  `booked` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `mobilId` (`mobilId`),
  CONSTRAINT `assembly_ibfk_2` FOREIGN KEY (`mobilId`) REFERENCES `mobil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `assembly` (`id`, `mobilId`, `status`, `tglProduksi`, `tglSelesai`, `booked`) VALUES
(115,	1,	'Produksi',	'2023-12-17',	'2023-12-18',	0);

DELIMITER ;;

CREATE TRIGGER `assembly_insert_before` BEFORE INSERT ON `assembly` FOR EACH ROW
BEGIN
  set new.tglProduksi = coalesce(
    (WITH a as
      (select tanggal, count(*) count from lineproduksi
      where tanggal>curdate()
      group by tanggal
      having count < 10
      order by tanggal asc
      limit 1)
    select tanggal from a),
    (WITH a as
      (select tanggal, count(*) count from lineproduksi
      where tanggal>curdate()
      group by tanggal
      having count = 10
      order by tanggal desc
      limit 1)
    SELECT tanggal from a) + interval 1 day,
    curdate() + interval 1 day
  );
  set new.tglSelesai = new.tglProduksi + interval (select waktuProduksi from mobil where id=new.mobilId) day - interval 1 day;
  checkLoop: while (@currentCheckedDate <= new.tglSelesai)
  do
    if (select count(*) from lineproduksi where tanggal=@currentCheckedDate) < 10 then
      set @currentCheckedDate = @currentCheckedDate + interval 1 day;
    else
      signal sqlstate '45000'
      SET message_text = 'Pabrik penuh';
    end if;
  end while checkLoop;
END;;

CREATE TRIGGER `assembly_insert_after` AFTER INSERT ON `assembly` FOR EACH ROW
BEGIN
  set @currentCheckedDate = new.tglProduksi;
  checkLoop: while (@currentCheckedDate <= new.tglSelesai)
  do
    insert into lineproduksi (assemblyId, tanggal) values (new.id, @currentCheckedDate);
    set @currentCheckedDate = @currentCheckedDate + interval 1 day;
  end while checkLoop;
END;;

CREATE TRIGGER `assembly_delete` AFTER DELETE ON `assembly` FOR EACH ROW
BEGIN
  delete from lineproduksi where assemblyId = old.id;
END;;

DELIMITER ;

DROP TABLE IF EXISTS `lineproduksi`;
CREATE TABLE `lineproduksi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `assemblyId` int NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `assemblyId` (`assemblyId`),
  CONSTRAINT `lineproduksi_ibfk_1` FOREIGN KEY (`assemblyId`) REFERENCES `assembly` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=262 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `lineproduksi` (`id`, `assemblyId`, `tanggal`) VALUES
(260,	115,	'2023-12-17'),
(261,	115,	'2023-12-18');

DELIMITER ;;

CREATE PROCEDURE `update_stok`()
BEGIN
 update mobil set stok=stok + (select count(*) from assembly where tglSelesai=(curdate()-interval 1 day) and mobilId=mobil.id and status='Produksi' and not booked);
 update assembly set status='Done' where tglSelesai=curdate()-interval 1 day;
END;;

SET GLOBAL event_scheduler = ON;;
CREATE EVENT `update_stok` ON SCHEDULE EVERY 1 DAY STARTS '2023-12-14 00:00:00' ON COMPLETION PRESERVE ENABLE DO CALL update_stok();;

DELIMITER ;
SET GLOBAL event_scheduler = ON;

-- 2023-12-15 23:27:26