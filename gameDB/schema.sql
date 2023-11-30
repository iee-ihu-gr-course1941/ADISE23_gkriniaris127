-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.11.4-MariaDB-1~deb12u1-log - Debian 12
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table game.board
CREATE TABLE IF NOT EXISTS `board` (
  `x` tinyint(4) NOT NULL,
  `y` tinyint(4) NOT NULL,
  `piece_color` enum('Y','R','B','G') DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`x`,`y`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table game.board: ~92 rows (approximately)
INSERT INTO `board` (`x`, `y`, `piece_color`, `position`) VALUES
	(1, 7, NULL, NULL),
	(1, 8, NULL, NULL),
	(1, 9, NULL, NULL),
	(2, 7, NULL, NULL),
	(2, 8, NULL, NULL),
	(2, 9, NULL, NULL),
	(3, 3, 'Y', 59),
	(3, 4, 'Y', 60),
	(3, 7, NULL, NULL),
	(3, 8, NULL, NULL),
	(3, 9, NULL, NULL),
	(3, 12, 'B', 58),
	(3, 13, 'B', 59),
	(4, 3, 'Y', 58),
	(4, 4, 'Y', 61),
	(4, 7, NULL, NULL),
	(4, 8, NULL, NULL),
	(4, 9, NULL, NULL),
	(4, 12, 'B', 61),
	(4, 13, 'B', 60),
	(5, 7, NULL, NULL),
	(5, 8, NULL, NULL),
	(5, 9, NULL, NULL),
	(6, 7, NULL, NULL),
	(6, 8, NULL, NULL),
	(6, 9, NULL, NULL),
	(7, 1, NULL, NULL),
	(7, 2, NULL, NULL),
	(7, 3, NULL, NULL),
	(7, 4, NULL, NULL),
	(7, 5, NULL, NULL),
	(7, 6, NULL, NULL),
	(7, 8, NULL, NULL),
	(7, 10, NULL, NULL),
	(7, 11, NULL, NULL),
	(7, 12, NULL, NULL),
	(7, 13, NULL, NULL),
	(7, 14, NULL, NULL),
	(7, 15, NULL, NULL),
	(8, 1, NULL, NULL),
	(8, 2, NULL, NULL),
	(8, 3, NULL, NULL),
	(8, 4, NULL, NULL),
	(8, 5, NULL, NULL),
	(8, 6, NULL, NULL),
	(8, 7, NULL, NULL),
	(8, 9, NULL, NULL),
	(8, 10, NULL, NULL),
	(8, 11, NULL, NULL),
	(8, 12, NULL, NULL),
	(8, 13, NULL, NULL),
	(8, 14, NULL, NULL),
	(8, 15, NULL, NULL),
	(9, 1, NULL, NULL),
	(9, 2, NULL, NULL),
	(9, 3, NULL, NULL),
	(9, 4, NULL, NULL),
	(9, 5, NULL, NULL),
	(9, 6, NULL, NULL),
	(9, 8, NULL, NULL),
	(9, 10, NULL, NULL),
	(9, 11, NULL, NULL),
	(9, 12, NULL, NULL),
	(9, 13, NULL, NULL),
	(9, 14, NULL, NULL),
	(9, 15, NULL, NULL),
	(10, 7, NULL, NULL),
	(10, 8, NULL, NULL),
	(10, 9, NULL, NULL),
	(11, 7, NULL, NULL),
	(11, 8, NULL, NULL),
	(11, 9, NULL, NULL),
	(12, 3, 'G', 60),
	(12, 4, 'G', 61),
	(12, 7, NULL, NULL),
	(12, 8, NULL, NULL),
	(12, 9, NULL, NULL),
	(12, 12, 'R', 61),
	(12, 13, 'R', 58),
	(13, 3, 'G', 59),
	(13, 4, 'G', 58),
	(13, 7, NULL, NULL),
	(13, 8, NULL, NULL),
	(13, 9, NULL, NULL),
	(13, 12, 'R', 60),
	(13, 13, 'R', 59),
	(14, 7, NULL, NULL),
	(14, 8, NULL, NULL),
	(14, 9, NULL, NULL),
	(15, 7, NULL, NULL),
	(15, 8, NULL, NULL),
	(15, 9, NULL, NULL);

-- Dumping structure for table game.board_empty
CREATE TABLE IF NOT EXISTS `board_empty` (
  `x` tinyint(4) NOT NULL,
  `y` tinyint(4) NOT NULL,
  `piece_color` enum('Y','R','B','G') DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`x`,`y`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table game.board_empty: ~92 rows (approximately)
INSERT INTO `board_empty` (`x`, `y`, `piece_color`, `position`) VALUES
	(1, 7, NULL, NULL),
	(1, 8, NULL, NULL),
	(1, 9, NULL, NULL),
	(2, 7, NULL, NULL),
	(2, 8, NULL, NULL),
	(2, 9, NULL, NULL),
	(3, 3, 'Y', 59),
	(3, 4, 'Y', 60),
	(3, 7, NULL, NULL),
	(3, 8, NULL, NULL),
	(3, 9, NULL, NULL),
	(3, 12, 'B', 58),
	(3, 13, 'B', 59),
	(4, 3, 'Y', 58),
	(4, 4, 'Y', 61),
	(4, 7, NULL, NULL),
	(4, 8, NULL, NULL),
	(4, 9, NULL, NULL),
	(4, 12, 'B', 61),
	(4, 13, 'B', 60),
	(5, 7, NULL, NULL),
	(5, 8, NULL, NULL),
	(5, 9, NULL, NULL),
	(6, 7, NULL, NULL),
	(6, 8, NULL, NULL),
	(6, 9, NULL, NULL),
	(7, 1, NULL, NULL),
	(7, 2, NULL, NULL),
	(7, 3, NULL, NULL),
	(7, 4, NULL, NULL),
	(7, 5, NULL, NULL),
	(7, 6, NULL, NULL),
	(7, 8, NULL, NULL),
	(7, 10, NULL, NULL),
	(7, 11, NULL, NULL),
	(7, 12, NULL, NULL),
	(7, 13, NULL, NULL),
	(7, 14, NULL, NULL),
	(7, 15, NULL, NULL),
	(8, 1, NULL, NULL),
	(8, 2, NULL, NULL),
	(8, 3, NULL, NULL),
	(8, 4, NULL, NULL),
	(8, 5, NULL, NULL),
	(8, 6, NULL, NULL),
	(8, 7, NULL, NULL),
	(8, 9, NULL, NULL),
	(8, 10, NULL, NULL),
	(8, 11, NULL, NULL),
	(8, 12, NULL, NULL),
	(8, 13, NULL, NULL),
	(8, 14, NULL, NULL),
	(8, 15, NULL, NULL),
	(9, 1, NULL, NULL),
	(9, 2, NULL, NULL),
	(9, 3, NULL, NULL),
	(9, 4, NULL, NULL),
	(9, 5, NULL, NULL),
	(9, 6, NULL, NULL),
	(9, 8, NULL, NULL),
	(9, 10, NULL, NULL),
	(9, 11, NULL, NULL),
	(9, 12, NULL, NULL),
	(9, 13, NULL, NULL),
	(9, 14, NULL, NULL),
	(9, 15, NULL, NULL),
	(10, 7, NULL, NULL),
	(10, 8, NULL, NULL),
	(10, 9, NULL, NULL),
	(11, 7, NULL, NULL),
	(11, 8, NULL, NULL),
	(11, 9, NULL, NULL),
	(12, 3, 'G', 60),
	(12, 4, 'G', 61),
	(12, 7, NULL, NULL),
	(12, 8, NULL, NULL),
	(12, 9, NULL, NULL),
	(12, 12, 'R', 61),
	(12, 13, 'R', 58),
	(13, 3, 'G', 59),
	(13, 4, 'G', 58),
	(13, 7, NULL, NULL),
	(13, 8, NULL, NULL),
	(13, 9, NULL, NULL),
	(13, 12, 'R', 60),
	(13, 13, 'R', 59),
	(14, 7, NULL, NULL),
	(14, 8, NULL, NULL),
	(14, 9, NULL, NULL),
	(15, 7, NULL, NULL),
	(15, 8, NULL, NULL),
	(15, 9, NULL, NULL);

-- Dumping structure for procedure game.clean_board
DELIMITER //
CREATE PROCEDURE `clean_board`()
BEGIN
	REPLACE INTO board SELECT * FROM board_empty;
END//
DELIMITER ;

-- Dumping structure for table game.game_status
CREATE TABLE IF NOT EXISTS `game_status` (
  `status` enum('not active','initialized','started','ended','aborded') DEFAULT 'not active',
  `dice_num` enum('1','2','3','4','5','6') DEFAULT NULL,
  `p_turn` enum('Y','R','B','G') DEFAULT NULL,
  `result` enum('Y','R','B','G') DEFAULT NULL,
  `last_change` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table game.game_status: ~1 rows (approximately)
INSERT INTO `game_status` (`status`, `dice_num`, `p_turn`, `result`, `last_change`) VALUES
	('not active', NULL, NULL, NULL, '2023-11-30 03:10:59');

-- Dumping structure for table game.players
CREATE TABLE IF NOT EXISTS `players` (
  `username` varchar(20) DEFAULT NULL,
  `piece_colour` enum('Y','R','B','G') NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `last_action` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`piece_colour`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table game.players: ~0 rows (approximately)

-- Dumping structure for table game.positions
CREATE TABLE IF NOT EXISTS `positions` (
  `position` tinyint(4) NOT NULL,
  `yellowX` tinyint(4) NOT NULL,
  `yellowY` tinyint(4) NOT NULL,
  `redX` tinyint(4) NOT NULL,
  `redY` tinyint(4) NOT NULL,
  `blueX` tinyint(4) NOT NULL,
  `blueY` tinyint(4) NOT NULL,
  `greenX` tinyint(4) NOT NULL,
  `greenY` tinyint(4) NOT NULL,
  PRIMARY KEY (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table game.positions: ~61 rows (approximately)
INSERT INTO `positions` (`position`, `yellowX`, `yellowY`, `redX`, `redY`, `blueX`, `blueY`, `greenX`, `greenY`) VALUES
	(1, 7, 2, 9, 14, 2, 9, 14, 7),
	(2, 7, 3, 9, 13, 3, 9, 13, 7),
	(3, 7, 4, 9, 12, 4, 9, 12, 7),
	(4, 7, 5, 9, 11, 5, 9, 11, 7),
	(5, 7, 6, 9, 10, 6, 9, 10, 7),
	(6, 6, 7, 10, 9, 7, 10, 9, 6),
	(7, 5, 7, 11, 9, 7, 11, 9, 5),
	(8, 4, 7, 12, 9, 7, 12, 9, 4),
	(9, 3, 7, 13, 9, 7, 13, 9, 3),
	(10, 2, 7, 14, 9, 7, 14, 9, 2),
	(11, 1, 7, 15, 9, 7, 15, 9, 1),
	(12, 1, 8, 15, 8, 8, 15, 8, 1),
	(13, 1, 9, 15, 7, 9, 15, 7, 1),
	(14, 2, 9, 14, 7, 9, 14, 7, 2),
	(15, 3, 9, 13, 7, 9, 13, 7, 3),
	(16, 4, 9, 12, 7, 9, 12, 7, 4),
	(17, 5, 9, 11, 7, 9, 11, 7, 5),
	(18, 6, 9, 10, 7, 9, 10, 7, 6),
	(19, 7, 10, 9, 6, 10, 9, 6, 7),
	(20, 7, 11, 9, 5, 11, 9, 5, 7),
	(21, 7, 12, 9, 4, 12, 9, 4, 7),
	(22, 7, 13, 9, 3, 13, 9, 3, 7),
	(23, 7, 14, 9, 2, 14, 9, 2, 7),
	(24, 7, 15, 9, 1, 15, 9, 1, 7),
	(25, 8, 15, 8, 1, 15, 8, 1, 8),
	(26, 9, 15, 7, 1, 15, 7, 1, 9),
	(27, 9, 14, 7, 2, 14, 7, 2, 9),
	(28, 9, 13, 7, 3, 13, 7, 3, 9),
	(29, 9, 12, 7, 4, 12, 7, 4, 9),
	(30, 9, 11, 7, 5, 11, 7, 5, 9),
	(31, 9, 10, 7, 6, 10, 7, 6, 9),
	(32, 10, 9, 6, 7, 9, 6, 7, 10),
	(33, 11, 9, 5, 7, 9, 5, 7, 11),
	(34, 12, 9, 4, 7, 9, 4, 7, 12),
	(35, 13, 9, 3, 7, 9, 3, 7, 13),
	(36, 14, 9, 2, 7, 9, 2, 7, 14),
	(37, 15, 9, 1, 7, 9, 1, 7, 15),
	(38, 15, 8, 1, 8, 8, 1, 8, 15),
	(39, 15, 7, 1, 9, 7, 1, 9, 15),
	(40, 14, 7, 2, 9, 7, 2, 9, 14),
	(41, 13, 7, 3, 9, 7, 3, 9, 13),
	(42, 12, 7, 4, 9, 7, 4, 9, 12),
	(43, 11, 7, 5, 9, 7, 5, 9, 11),
	(44, 10, 7, 6, 9, 7, 6, 9, 10),
	(45, 9, 6, 7, 10, 6, 7, 10, 9),
	(46, 9, 5, 7, 11, 5, 7, 11, 9),
	(47, 9, 4, 7, 12, 4, 7, 12, 9),
	(48, 9, 3, 7, 13, 3, 7, 13, 9),
	(49, 9, 2, 7, 14, 2, 7, 14, 9),
	(50, 9, 1, 7, 15, 1, 7, 15, 9),
	(51, 8, 1, 8, 15, 1, 8, 15, 8),
	(52, 8, 2, 8, 14, 2, 8, 14, 8),
	(53, 8, 3, 8, 13, 3, 8, 13, 8),
	(54, 8, 4, 8, 12, 4, 8, 12, 8),
	(55, 8, 5, 8, 11, 5, 8, 11, 8),
	(56, 8, 6, 8, 10, 6, 8, 10, 8),
	(57, 8, 7, 8, 9, 7, 8, 9, 8),
	(58, 4, 3, 12, 13, 3, 12, 13, 4),
	(59, 3, 3, 13, 13, 3, 13, 13, 3),
	(60, 3, 4, 13, 12, 4, 13, 12, 3),
	(61, 4, 4, 12, 12, 4, 12, 12, 4);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
