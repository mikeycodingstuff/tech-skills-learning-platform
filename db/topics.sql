/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `topics` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `topic_name` varchar(255) NOT NULL,
  `status` enum('not learning','learning') NOT NULL,
  `resources` varchar(10000) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `topics` (`id`, `topic_name`, `status`, `resources`, `deleted`) VALUES
(1, 'TypeScript', 'learning', 'https://www.typescriptlang.org/docs/', 0);
INSERT INTO `topics` (`id`, `topic_name`, `status`, `resources`, `deleted`) VALUES
(2, 'Vue.js', 'learning', 'https://vuejs.org/', 0);
INSERT INTO `topics` (`id`, `topic_name`, `status`, `resources`, `deleted`) VALUES
(3, 'Python', 'learning', 'https://www.python.org/', 0);
INSERT INTO `topics` (`id`, `topic_name`, `status`, `resources`, `deleted`) VALUES
(4, 'Angular', 'not learning', 'https://angular.io/', 0),
(5, 'C#', 'not learning', 'https://dotnet.microsoft.com/en-us/learn/csharp', 0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;