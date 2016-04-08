-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2016 at 03:44 AM
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`id`, `name`, `Description`) VALUES
(30, 'Building Permutation', 'Permutation p is an ordered set of integers p1,â€‰â€‰p2,â€‰â€‰...,â€‰â€‰pn, consisting of n distinct positive integers, each of them doesn''t exceed n. We''ll denote the i-th element of permutation p as pi. We''ll call number n the size or the length of permutation p1,â€‰â€‰p2,â€‰â€‰...,â€‰â€‰pn.\n\nYou have a sequence of integers a1,â€‰a2,â€‰...,â€‰an. In one move, you are allowed to decrease or increase any number by one. Count the minimum number of moves, needed to build a permutation from this sequence.\n\nInput\nThe first line contains integer n (1â€‰â‰¤â€‰nâ€‰â‰¤â€‰3Â·105) â€” the size of the sought permutation. The second line contains n integers a1,â€‰a2,â€‰...,â€‰an (â€‰-â€‰109â€‰â‰¤â€‰aiâ€‰â‰¤â€‰109).\n\nOutput\nPrint a single number â€” the minimum number of moves.\n\nPlease, do not use the %lld specifier to read or write 64-bit integers in Ð¡++. It is preferred to use the cin, cout streams or the %I64d specifier.\n\nInput\n2\n3 0\nOutput\n2\n\nInput\n3\n-1 -1 2\nOutput\n6\n\n------------------\nNote\n\nIn the first sample you should decrease the first number by one and then increase the second number by one. The resulting permutation is (2,â€‰1).\n\nIn the second sample you need 6 moves to build permutation (1,â€‰3,â€‰2).'),
(31, 'Chips', 'Gerald plays the following game. He has a checkered field of size nâ€‰Ã—â€‰n cells, where m various cells are banned. Before the game, he has to put a few chips on some border (but not corner) board cells. Then for nâ€‰-â€‰1 minutes, Gerald every minute moves each chip into an adjacent cell. He moves each chip from its original edge to the opposite edge. Gerald loses in this game in each of the three cases:\n\n    At least one of the chips at least once fell to the banned cell.\n    At least once two chips were on the same cell.\n    At least once two chips swapped in a minute (for example, if you stand two chips on two opposite border cells of a row with even length, this situation happens in the middle of the row). \n\nIn that case he loses and earns 0 points. When nothing like that happened, he wins and earns the number of points equal to the number of chips he managed to put on the board. Help Gerald earn the most points.\n\nInput\nThe first line contains two space-separated integers n and m (2â€‰â‰¤â€‰nâ€‰â‰¤â€‰1000, 0â€‰â‰¤â€‰mâ€‰â‰¤â€‰105) â€” the size of the field and the number of banned cells. Next m lines each contain two space-separated integers. Specifically, the i-th of these lines contains numbers xi and yi (1â€‰â‰¤â€‰xi,â€‰yiâ€‰â‰¤â€‰n) â€” the coordinates of the i-th banned cell. All given cells are distinct.\n\nConsider the field rows numbered from top to bottom from 1 to n, and the columns â€” from left to right from 1 to n.\n\nOutput\nPrint a single integer â€” the maximum points Gerald can earn in this game.\n\nExamples\n\nInput\n3 1\n2 2\nOutput\n0\n\nInput\n3 0\nOutput\n1\n\nInput\n4 3\n3 1\n3 2\n3 3\nOutput\n1\n\n-------------\nNote\n\nIn the first test the answer equals zero as we can''t put chips into the corner cells.\n\nIn the second sample we can place one chip into either cell (1, 2), or cell (3, 2), or cell (2, 1), or cell (2, 3). We cannot place two chips.\n\nIn the third sample we can only place one chip into either cell (2, 1), or cell (2, 4).'),
(32, 'Connected City', 'Imagine a city with n horizontal streets crossing m vertical streets, forming an (nâ€‰-â€‰1)â€‰Ã—â€‰(mâ€‰-â€‰1) grid. In order to increase the traffic flow, mayor of the city has decided to make each street one way. This means in each horizontal street, the traffic moves only from west to east or only from east to west. Also, traffic moves only from north to south or only from south to north in each vertical street. It is possible to enter a horizontal street from a vertical street, or vice versa, at their intersection.\r\n\r\nThe mayor has received some street direction patterns. Your task is to check whether it is possible to reach any junction from any other junction in the proposed street direction pattern.\r\n\r\nInput\r\nThe first line of input contains two integers n and m, (2â€‰â‰¤â€‰n,â€‰mâ€‰â‰¤â€‰20), denoting the number of horizontal streets and the number of vertical streets.\r\n\r\nThe second line contains a string of length n, made of characters ''<'' and ''>'', denoting direction of each horizontal street. If the i-th character is equal to ''<'', the street is directed from east to west otherwise, the street is directed from west to east. Streets are listed in order from north to south.\r\n\r\nThe third line contains a string of length m, made of characters ''^'' and ''v'', denoting direction of each vertical street. If the i-th character is equal to ''^'', the street is directed from south to north, otherwise the street is directed from north to south. Streets are listed in order from west to east.\r\n\r\nOutput\r\nIf the given pattern meets the mayor''s criteria, print a single line containing "YES", otherwise print a single line containing "NO".\r\n\r\nExamples\r\nInput\r\n3 3\r\n><>\r\nv^v\r\nOutput\r\nNO\r\n\r\nInput\r\n4 6\r\n<><>\r\nv^v^v^\r\nOutput\r\nYES\r\n\r\n-----------------\r\nNote\r\nThe figure above shows street directions in the second sample test case.'),
(33, 'Shortest path of the king', 'The king is left alone on the chessboard. In spite of this loneliness, he doesn''t lose heart, because he has business of national importance. For example, he has to pay an official visit to square t. As the king is not in habit of wasting his time, he wants to get from his current position s to square t in the least number of moves. Help him to do this.\r\nIn one move the king can get to the square that has a common side or a common vertex with the square the king is currently in (generally there are 8 different squares he can move to).\r\n\r\nInput\r\nThe first line contains the chessboard coordinates of square s, the second line â€” of square t.\r\nChessboard coordinates consist of two characters, the first one is a lowercase Latin letter (from a to h), the second one is a digit from 1 to 8.\r\n\r\nOutput\r\n\r\nIn the first line print n â€” minimum number of the king''s moves. Then in n lines print the moves themselves. Each move is described with one of the 8: L, R, U, D, LU, LD, RU or RD.\r\n\r\nL, R, U, D stand respectively for moves left, right, up and down (according to the picture), and 2-letter combinations stand for diagonal moves. If the answer is not unique, print any of them. \r\n\r\nExamples\r\nInput\r\na8\r\nh1\r\nOutput\r\n7\r\nRD\r\nRD\r\nRD\r\nRD\r\nRD\r\nRD\r\nRD'),
(34, 'Card Game', 'There is a card game called "Durak", which means "Fool" in Russian. The game is quite popular in the countries that used to form USSR. The problem does not state all the game''s rules explicitly â€” you can find them later yourselves if you want.\r\n\r\nTo play durak you need a pack of 36 cards. Each card has a suit ("S", "H", "D" and "C") and a rank (in the increasing order "6", "7", "8", "9", "T", "J", "Q", "K" and "A"). At the beginning of the game one suit is arbitrarily chosen as trump.\r\n\r\nThe players move like that: one player puts one or several of his cards on the table and the other one should beat each of them with his cards.\r\n\r\nA card beats another one if both cards have similar suits and the first card has a higher rank then the second one. Besides, a trump card can beat any non-trump card whatever the cardsâ€™ ranks are. In all other cases you can not beat the second card with the first one.\r\n\r\nYou are given the trump suit and two different cards. Determine whether the first one beats the second one or not.\r\n\r\nInput\r\nThe first line contains the tramp suit. It is "S", "H", "D" or "C".\r\nThe second line contains the description of the two different cards. Each card is described by one word consisting of two symbols. The first symbol stands for the rank ("6", "7", "8", "9", "T", "J", "Q", "K" and "A"), and the second one stands for the suit ("S", "H", "D" and "C").\r\n\r\nOutput\r\nPrint "YES" (without the quotes) if the first cards beats the second one. Otherwise, print "NO" (also without the quotes).\r\n\r\nExamples\r\nInput\r\nH\r\nQH 9S\r\nOutput\r\nYES\r\n\r\nInput\r\nS\r\n8D 6D\r\nOutput\r\nYES\r\n\r\nInput\r\nC\r\n7H AS\r\nOutput\r\nNO');

-- --------------------------------------------------------

--
-- Table structure for table `submittions`
--

CREATE TABLE IF NOT EXISTS `submittions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `problem` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `response` varchar(255) NOT NULL,
  `solution` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=144 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `rank`) VALUES
(53, 'hazem', '7ca8b5831105db429b8c3e0be5883d686b610e39', 1, 0),
(78, 'ahmed', 'd3a89dd521aea9dbd8f9d8a08e7394d6f0a9f71d', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
