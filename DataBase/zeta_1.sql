-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2018 at 11:55 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zeta`
--

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE IF NOT EXISTS `problems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `input_file` varchar(255) NOT NULL,
  `output_file` varchar(255) NOT NULL,
  `rank` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`id`, `name`, `Description`, `input_file`, `output_file`, `rank`) VALUES
(55, 'Amalgamated Artichokes', 'Fatima Cynara is an analyst at Amalgamated Artichokes\r\n(AA). As with any company, AA has had some very good\r\ntimes as well as some bad ones. Fatima does trending\r\nanalysis of the stock prices for AA, and she wants to determine\r\nthe largest decline in stock prices over various time\r\nspans. For example, if over a span of time the stock prices\r\nwere 19, 12, 13, 11, 20 and 14, then the largest decline\r\nwould be 8 between the first and fourth price. If the last\r\nprice had been 10 instead of 14, then the largest decline\r\nwould have been 10 between the last two prices.\r\nFatima has done some previous analyses and has found\r\nthat the stock price over any period of time can be modelled\r\nreasonably accurately with the following equation:\r\nprice(k) = p Â· (sin(a Â· k + b) + cos(c Â· k + d) + 2)\r\nwhere p, a, b, c and d are constants. Fatima would like you to write a program to determine the largest\r\nprice decline over a given sequence of prices. Figure A.1 illustrates the price function for Sample Input 1.\r\nYou have to consider the prices only for integer values of k.\r\nk\r\nprice(k)\r\n1 2 3 4 5 6 7 8 9 10\r\nFigure A.1: Sample Input 1. The largest decline occurs from the fourth to the seventh price.\r\nInput\r\nThe input consists of a single line containing 6 integers p (1 â‰¤ p â‰¤ 1 000), a, b, c, d (0 â‰¤ a, b, c, d â‰¤\r\n1 000) and n (1 â‰¤ n â‰¤ 106\r\n). The first 5 integers are described above. The sequence of stock prices to\r\nconsider is price(1), price(2), . . . , price(n).\r\nACM-ICPC World Finals 2015 Problem A: Amalgamated Artichokes 1\r\nOutput\r\nDisplay the maximum decline in the stock prices. If there is no decline, display the number 0. Your\r\noutput should have an absolute or relative error of at most 10âˆ’6\r\n.\r\nSample Input 1 Sample Output 1\r\n42 1 23 4 8 10 104.855110477\r\nSample Input 2 Sample Output 2\r\n100 7 615 998 801 3 0.00\r\nSample Input 3 Sample Output 3\r\n100 432 406 867 60 1000 399.303813', 'INPUT.in', 'OUTPUT.out', 1000),
(56, 'Adding Problem', 'add numbers and output the summitions\r\nInput File : INPUT.in\r\noutput File : OUTPUT.out', 'INPUT.in', 'OUTPUT.out', 500);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'start_time', '05:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `submittions`
--

CREATE TABLE IF NOT EXISTS `submittions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `problem_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `response` varchar(255) NOT NULL,
  `solution` text NOT NULL,
  `submittion_rank` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `submittions`
--

INSERT INTO `submittions` (`id`, `user_id`, `problem_id`, `time`, `response`, `solution`, `submittion_rank`) VALUES
(1, 78, 56, '2018-04-11 03:50:35', 'Accepted', '// basic file operations\n#include <iostream>\n#include <fstream>\nusing namespace std;\n\nint main () {\n\n  int n,x,y;\n  fstream input,output;\n  \n  input.open("INPUT.in",ios::in);\n  output.open("OUTPUT.out",ios::out);\n  \n  input >> n;\n  for(int i = 0; i < n ; i++)\n  {\n  		input >> x >> y;\n  		output << x+y << endl;\n  }\n\n\n  input.close();\n  output.close();\n  return 0;\n}', 0),
(2, 78, 55, '2018-04-11 03:15:40', 'Compiler Error', '// writing on a text file\n#include <iostream>\n#include <fstream>\nusing namespace std;\n\nint main () {\n  ofstream myfile ("ex.txt");\n\n    myfile << "This is a line.\\n"\n    myfile << "This is another line.\\n";\n    myfile.close();\n\n  return 0;\n}', 0),
(3, 78, 56, '2018-04-11 03:10:40', 'Compiler Error', '// writing on a text file\n#include <iostream>\n#include <fstream>\nusing namespace std;\n\nint main () {\n  ofstream myfile ("ex.txt");\n\n    myfile << "This is a line.\\n"\n    myfile << "This is another line.\\n";\n    myfile.close();\n\n  return 0;\n}', 0),
(4, 80, 55, '2018-04-11 03:50:40', '--', 'this is submittion for this problem', 0);

-- --------------------------------------------------------

--
-- Table structure for table `testcases`
--

CREATE TABLE IF NOT EXISTS `testcases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `problem_id` int(11) NOT NULL,
  `input_text` text NOT NULL,
  `output_text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `testcases`
--

INSERT INTO `testcases` (`id`, `problem_id`, `input_text`, `output_text`) VALUES
(25, 55, '350 120 957 785 310 1\r\n', '0.000000\r\n'),
(26, 55, '350 0 957 0 310 1000000\r\n', '0.000000\r\n'),
(27, 55, '200 411 433 922 805 2\r\n', '665.522430\r\n'),
(28, 55, '200 178 828 458 260 2\r\n', '0.000000\r\n'),
(29, 55, '1000 797 148 780 347 1000000\r\n', '3999.977117\r\n'),
(30, 55, '1000 358 984 955 264 1000000\r\n', '3999.980182\r\n'),
(31, 55, '1000 811 740 98 337 1000000\r\n', '3999.986003\r\n'),
(32, 55, '1000 889 755 966 497 1000000\r\n', '3999.919039\r\n'),
(33, 55, '1000 208 734 845 264 1000000\r\n', '3999.441508\r\n'),
(34, 55, '1000 429 460 845 909 1000000\r\n', '3999.276771\r\n'),
(35, 55, '1000 355 190 512 960 1000000\r\n', '3999.975060\r\n'),
(36, 56, '4\r\n5 5\r\n7 7\r\n6 6\r\n1 1', '10\r\n14\r\n12\r\n2\r\n'),
(37, 56, '5\r\n5 21\r\n7 7\r\n6 9\r\n1 8\r\n6 5', '26\r\n14\r\n15\r\n9\r\n11\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL COMMENT '0->user 1 ->admin',
  `rank` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `rank`) VALUES
(53, 'hazem', '7ca8b5831105db429b8c3e0be5883d686b610e39', 1, 0),
(78, 'ahmed', 'd3a89dd521aea9dbd8f9d8a08e7394d6f0a9f71d', 0, 444),
(79, 'ali', 'e583fa8aa5c6d5fd413f7c157d8d7290bc555f5d', 0, 0),
(80, 'sameh', 'debaf413a40f829e815b2b15181f760fb10b895f', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
