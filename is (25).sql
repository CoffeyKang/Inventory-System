-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 29, 2018 at 05:48 PM
-- Server version: 5.5.56-MariaDB
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `is`
--

-- --------------------------------------------------------

--
-- Table structure for table `adjustinventory`
--

CREATE TABLE `adjustinventory` (
  `number` int(11) NOT NULL,
  `item` varchar(255) DEFAULT NULL,
  `goodtobad` int(11) DEFAULT NULL,
  `badtogood` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `costchange` float(11,2) DEFAULT NULL,
  `physical` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apchck`
--

CREATE TABLE `apchck` (
  `invno` varchar(80) DEFAULT NULL,
  `vendno` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `ppriority` varchar(1) DEFAULT NULL,
  `aprpay` float(11,2) DEFAULT NULL,
  `amt1099` float(11,2) DEFAULT NULL,
  `ref` varchar(255) DEFAULT NULL,
  `checkno` varchar(255) DEFAULT NULL,
  `checkdate` date DEFAULT NULL,
  `voiddate` date DEFAULT NULL,
  `chkacc` varchar(255) DEFAULT NULL,
  `typ1099` varchar(255) DEFAULT NULL,
  `apstat` varchar(255) DEFAULT NULL,
  `ckstat` varchar(255) DEFAULT NULL,
  `cktype` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apdist`
--

CREATE TABLE `apdist` (
  `vendno` varchar(60) DEFAULT NULL,
  `invno` varchar(80) DEFAULT NULL,
  `pstdate` date DEFAULT NULL,
  `ref` varchar(255) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  `jobcode` varchar(255) DEFAULT NULL,
  `phase` varchar(255) DEFAULT NULL,
  `subcode` varchar(255) DEFAULT NULL,
  `amount` float(11,2) DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `dtstat` varchar(255) DEFAULT NULL,
  `dttype` varchar(255) DEFAULT NULL,
  `jccode` varchar(255) DEFAULT NULL,
  `prtid` varchar(255) DEFAULT NULL,
  `batch` varchar(255) DEFAULT NULL,
  `taxcode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apdisttemp`
--

CREATE TABLE `apdisttemp` (
  `vendno` varchar(60) DEFAULT NULL,
  `invno` varchar(80) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pstdate` varchar(255) DEFAULT NULL,
  `ref` varchar(255) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  `jobcode` varchar(255) DEFAULT NULL,
  `phase` varchar(255) DEFAULT NULL,
  `subcode` varchar(255) DEFAULT NULL,
  `amount` float(11,2) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `dtstat` varchar(255) DEFAULT NULL,
  `dttype` varchar(255) DEFAULT NULL,
  `jccode` varchar(255) DEFAULT NULL,
  `prtid` varchar(255) DEFAULT NULL,
  `batch` varchar(255) DEFAULT NULL,
  `taxcode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apmast`
--

CREATE TABLE `apmast` (
  `invno` varchar(80) DEFAULT NULL,
  `vendno` varchar(60) DEFAULT NULL,
  `ppriority` varchar(255) DEFAULT NULL,
  `pdisc` float DEFAULT NULL,
  `pdays` float DEFAULT NULL,
  `pnet` float DEFAULT NULL,
  `purdate` date DEFAULT NULL,
  `duedate` date DEFAULT NULL,
  `disdate` date DEFAULT NULL,
  `discount` float(11,2) DEFAULT NULL,
  `puramt` float(11,2) DEFAULT NULL,
  `paidamt` float(11,2) DEFAULT '0.00',
  `disamt` float(11,2) DEFAULT NULL,
  `adjamt` float(11,2) DEFAULT NULL,
  `aprpay` float(11,2) DEFAULT NULL,
  `aprdis` float DEFAULT NULL,
  `apradj` float DEFAULT NULL,
  `amt1099` float DEFAULT NULL,
  `buyer` varchar(255) DEFAULT NULL,
  `current` varchar(255) DEFAULT NULL,
  `ref` varchar(255) DEFAULT NULL,
  `checkno` varchar(255) DEFAULT NULL,
  `checkdate` date DEFAULT NULL,
  `apacc` varchar(255) DEFAULT NULL,
  `chkacc` varchar(255) DEFAULT NULL,
  `typ1099` varchar(255) DEFAULT NULL,
  `apstat` varchar(255) DEFAULT NULL,
  `aptype` varchar(255) DEFAULT NULL,
  `tosw` varchar(255) DEFAULT NULL,
  `signature` float DEFAULT NULL,
  `cvendno` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apychk_8`
--

CREATE TABLE `apychk_8` (
  `invno` varchar(8) DEFAULT NULL,
  `vendno` varchar(255) DEFAULT NULL,
  `company` varchar(35) DEFAULT NULL,
  `ppriority` varchar(255) DEFAULT NULL,
  `aprpay` float DEFAULT NULL,
  `amt1099` float DEFAULT NULL,
  `ref` varchar(255) DEFAULT NULL,
  `checkno` varchar(255) DEFAULT NULL,
  `checkdate` date DEFAULT NULL,
  `voiddate` date DEFAULT NULL,
  `chkacc` varchar(255) DEFAULT NULL,
  `typ1099` varchar(255) DEFAULT NULL,
  `apstat` varchar(255) DEFAULT NULL,
  `ckstat` varchar(255) DEFAULT NULL,
  `cktype` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apydst_8`
--

CREATE TABLE `apydst_8` (
  `vendno` varchar(6) DEFAULT NULL,
  `invno` varchar(20) DEFAULT NULL,
  `pstdate` date DEFAULT NULL,
  `ref` varchar(255) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  `jobcode` varchar(255) DEFAULT NULL,
  `phase` varchar(255) DEFAULT NULL,
  `subcode` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `dtstat` varchar(255) DEFAULT NULL,
  `dttype` varchar(255) DEFAULT NULL,
  `jccode` varchar(255) DEFAULT NULL,
  `prtid` varchar(255) DEFAULT NULL,
  `batch` varchar(255) DEFAULT NULL,
  `taxcode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `araddr`
--

CREATE TABLE `araddr` (
  `custno` varchar(6) DEFAULT NULL,
  `invno` varchar(20) DEFAULT NULL,
  `adtype` varchar(1) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `address3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aradrs`
--

CREATE TABLE `aradrs` (
  `custno` varchar(6) DEFAULT NULL,
  `cshipno` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `terr` varchar(255) DEFAULT NULL,
  `salesmn` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `disc` float DEFAULT NULL,
  `entered` date DEFAULT NULL,
  `gllink` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `taxcode` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `dealer` varchar(255) DEFAULT NULL,
  `faxno` varchar(255) DEFAULT NULL,
  `taxdist` varchar(255) DEFAULT NULL,
  `signature` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `arcash`
--

CREATE TABLE `arcash` (
  `invno` varchar(20) DEFAULT NULL,
  `invdte` date DEFAULT NULL,
  `custno` varchar(60) DEFAULT NULL,
  `salesmn` varchar(255) DEFAULT NULL,
  `ponum` varchar(20) DEFAULT NULL,
  `disamt` float DEFAULT NULL,
  `paidamt` float(11,2) DEFAULT NULL,
  `dtepaid` date DEFAULT NULL,
  `refno` varchar(255) DEFAULT NULL,
  `apcode` varchar(1) DEFAULT NULL,
  `artype` varchar(1) DEFAULT NULL,
  `glarec` varchar(3) DEFAULT NULL,
  `batch` varchar(3) DEFAULT NULL,
  `glaccnt` varchar(9) DEFAULT NULL,
  `userid` varchar(4) DEFAULT NULL,
  `oti` varchar(9) DEFAULT NULL,
  `ccati` varchar(8) DEFAULT NULL,
  `applto` varchar(9) DEFAULT NULL,
  `recdel` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `arimak01`
--

CREATE TABLE `arimak01` (
  `row_id` int(11) NOT NULL,
  `item` varchar(15) DEFAULT NULL,
  `make` varchar(10) DEFAULT NULL,
  `yearbeg` varchar(5) DEFAULT NULL,
  `yearend` varchar(5) DEFAULT NULL,
  `note` varchar(30) DEFAULT NULL,
  `signature` int(11) DEFAULT NULL,
  `keynew` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `arisup01`
--

CREATE TABLE `arisup01` (
  `item` varchar(15) DEFAULT NULL,
  `vpartno` varchar(255) DEFAULT NULL,
  `vendno` varchar(255) DEFAULT NULL,
  `lrecdate` date DEFAULT NULL,
  `seq` varchar(255) DEFAULT NULL,
  `lead` float DEFAULT NULL,
  `cost` float DEFAULT NULL,
  `ytdqty` float DEFAULT NULL,
  `onorder` float DEFAULT NULL,
  `onhand` float DEFAULT NULL,
  `orderpt` float DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `signature` float DEFAULT NULL,
  `onship` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `armail`
--

CREATE TABLE `armail` (
  `custno` varchar(60) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `fillupso` varchar(255) DEFAULT NULL,
  `signature` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `armast`
--

CREATE TABLE `armast` (
  `invno` int(20) NOT NULL,
  `invdte` date DEFAULT NULL,
  `custno` varchar(255) DEFAULT NULL,
  `salesmn` varchar(255) DEFAULT NULL,
  `terr` varchar(255) DEFAULT NULL,
  `ponum` varchar(255) DEFAULT NULL,
  `refno` varchar(255) DEFAULT NULL,
  `disc` float(11,2) DEFAULT NULL,
  `taxrate` float DEFAULT NULL,
  `tax` float(11,2) DEFAULT NULL,
  `invamt` float(11,2) DEFAULT NULL,
  `disamt` float(11,2) DEFAULT NULL,
  `paidamt` float(11,2) DEFAULT '0.00',
  `balance` float(11,2) DEFAULT NULL,
  `shipvia` varchar(255) DEFAULT NULL,
  `shipping` float(11,2) NOT NULL DEFAULT '0.00',
  `fob` varchar(255) DEFAULT NULL,
  `pterms` varchar(255) DEFAULT NULL,
  `pdisc` float DEFAULT NULL,
  `pdays` float DEFAULT NULL,
  `pnet` float DEFAULT NULL,
  `dtepaid` date DEFAULT NULL,
  `ordate` date DEFAULT NULL,
  `ornum` varchar(255) DEFAULT NULL,
  `commid` varchar(255) DEFAULT NULL,
  `glarec` varchar(255) DEFAULT NULL,
  `tosw` varchar(255) DEFAULT NULL,
  `maint` varchar(255) DEFAULT NULL,
  `prtid` varchar(255) DEFAULT NULL,
  `arstat` varchar(255) DEFAULT NULL,
  `artype` varchar(255) DEFAULT 'N',
  `batch` varchar(255) DEFAULT NULL,
  `current` varchar(255) DEFAULT NULL,
  `taxdist` varchar(255) DEFAULT NULL,
  `userid` varchar(255) DEFAULT NULL,
  `oti` varchar(255) DEFAULT NULL,
  `signature` float DEFAULT NULL,
  `make` varchar(255) DEFAULT NULL,
  `locid` varchar(1) DEFAULT NULL,
  `package` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `artran`
--

CREATE TABLE `artran` (
  `invno` varchar(20) DEFAULT NULL,
  `custno` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `descrip` varchar(255) DEFAULT NULL,
  `disc` float DEFAULT NULL,
  `taxrate` float DEFAULT NULL,
  `cost` float(11,2) DEFAULT NULL,
  `price` float(11,2) DEFAULT NULL,
  `qtyord` float(11,2) DEFAULT NULL,
  `qtyshp` float(11,2) DEFAULT NULL,
  `invdte` date DEFAULT NULL,
  `ponum` varchar(255) DEFAULT NULL,
  `extprice` float(11,2) DEFAULT NULL,
  `salesmn` varchar(255) DEFAULT NULL,
  `terr` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `stkcode` varchar(255) DEFAULT NULL,
  `taxable` varchar(255) DEFAULT NULL,
  `arstat` varchar(255) DEFAULT NULL,
  `artype` varchar(255) DEFAULT 'N',
  `glsale` varchar(255) DEFAULT NULL,
  `glasst` varchar(255) DEFAULT NULL,
  `batch` varchar(255) DEFAULT NULL,
  `current` varchar(255) DEFAULT NULL,
  `taxdist` varchar(255) DEFAULT NULL,
  `seq` varchar(255) DEFAULT NULL,
  `make` varchar(255) DEFAULT NULL,
  `locid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cuptandduty`
--

CREATE TABLE `cuptandduty` (
  `id` int(11) NOT NULL,
  `reqno` varchar(255) NOT NULL,
  `duty` float(11,2) NOT NULL,
  `cupt` float(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customernotes`
--

CREATE TABLE `customernotes` (
  `id` int(11) NOT NULL,
  `custno` varchar(255) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customeropenreceivable`
--

CREATE TABLE `customeropenreceivable` (
  `id` int(11) NOT NULL,
  `custno` varchar(255) DEFAULT NULL,
  `current` float(11,2) DEFAULT NULL,
  `day30` float(11,2) DEFAULT NULL,
  `day60` float(11,2) DEFAULT NULL,
  `day90` float(11,2) DEFAULT NULL,
  `day120` float(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `custno` varchar(6) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `terr` varchar(255) DEFAULT NULL,
  `indust` varchar(255) DEFAULT NULL,
  `salesmn` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `pterms` varchar(255) DEFAULT NULL,
  `pdisc` float DEFAULT NULL,
  `pdays` float DEFAULT NULL,
  `pnet` float DEFAULT NULL,
  `svc` float DEFAULT NULL,
  `tax` float(11,2) DEFAULT NULL,
  `disc` float(11,2) DEFAULT '0.00',
  `ldate` date DEFAULT NULL,
  `lastpay` date DEFAULT NULL,
  `entered` date DEFAULT NULL,
  `limit` float(11,2) DEFAULT NULL,
  `balance` float(11,2) DEFAULT NULL,
  `ptdsls` float(11,2) DEFAULT NULL,
  `ytdsls` float(11,2) DEFAULT NULL,
  `onorder` float(11,2) DEFAULT NULL,
  `credit` float(11,2) DEFAULT NULL,
  `lpymt` float(11,2) DEFAULT NULL,
  `lsale` float(11,2) DEFAULT NULL,
  `gllink` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `history` varchar(255) DEFAULT NULL,
  `pricecode` varchar(255) DEFAULT NULL,
  `taxcode` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `flags` varchar(255) DEFAULT NULL,
  `cstnum1` float DEFAULT NULL,
  `cstnum2` float DEFAULT NULL,
  `lstcall` date DEFAULT NULL,
  `dealer` varchar(255) DEFAULT NULL,
  `faxno` varchar(255) DEFAULT NULL,
  `taxdist` varchar(255) DEFAULT NULL,
  `statfmt` varchar(255) DEFAULT NULL,
  `forward` float DEFAULT NULL,
  `signature` float DEFAULT NULL,
  `permit` varchar(255) DEFAULT NULL,
  `locid` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `rtforward` float DEFAULT NULL,
  `assign` varchar(255) DEFAULT NULL,
  `respon` varchar(255) DEFAULT NULL,
  `ptdnbill` float DEFAULT NULL,
  `ytdnbill` float DEFAULT NULL,
  `ptdbill` float DEFAULT NULL,
  `ytdbill` float DEFAULT NULL,
  `over30` float DEFAULT NULL,
  `over60` float DEFAULT NULL,
  `over90` float DEFAULT NULL,
  `over120` float DEFAULT NULL,
  `ptdpay` float DEFAULT NULL,
  `ytdpay` float DEFAULT NULL,
  `ptdadj` float DEFAULT NULL,
  `ytdadj` float DEFAULT NULL,
  `commid` varchar(255) DEFAULT NULL,
  `markup` varchar(255) DEFAULT NULL,
  `pmarkup` float DEFAULT NULL,
  `retainer` float DEFAULT NULL,
  `minret` float DEFAULT NULL,
  `inform` varchar(255) DEFAULT NULL,
  `stform` varchar(255) DEFAULT NULL,
  `memprt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `entiresoshortlists`
--

CREATE TABLE `entiresoshortlists` (
  `id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `extPrice` float(11,2) NOT NULL,
  `custno` varchar(255) NOT NULL,
  `sono` int(255) NOT NULL,
  `descrip` varchar(255) DEFAULT NULL,
  `tax` float(11,2) DEFAULT NULL,
  `subtotal` float(11,2) DEFAULT NULL,
  `unitPrice` float(11,2) NOT NULL,
  `disc` varchar(255) DEFAULT NULL,
  `userid` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fillupso`
--

CREATE TABLE `fillupso` (
  `id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `sono` varchar(255) NOT NULL,
  `qtyord` int(11) NOT NULL DEFAULT '0',
  `custno` varchar(255) NOT NULL,
  `ordate` date DEFAULT NULL,
  `salesmn` varchar(255) DEFAULT NULL,
  `fill` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `glacnt`
--

CREATE TABLE `glacnt` (
  `glacnt` varchar(9) DEFAULT NULL,
  `gldesc` varchar(35) DEFAULT NULL,
  `glstat` varchar(1) DEFAULT NULL,
  `gltype` varchar(2) DEFAULT NULL,
  `glcatag` varchar(2) DEFAULT NULL,
  `glsource` varchar(6) DEFAULT NULL,
  `glcolu` varchar(2) DEFAULT NULL,
  `glseq` varchar(6) DEFAULT NULL,
  `glatype` varchar(1) DEFAULT NULL,
  `glafig` float DEFAULT NULL,
  `glaper` float DEFAULT NULL,
  `glaact` varchar(9) DEFAULT NULL,
  `glratio` varchar(2) DEFAULT NULL,
  `glfasb95` varchar(3) DEFAULT NULL,
  `gldact01` varchar(9) DEFAULT NULL,
  `gldact02` varchar(9) DEFAULT NULL,
  `gldact03` varchar(9) DEFAULT NULL,
  `gldact04` varchar(9) DEFAULT NULL,
  `gldact05` varchar(9) DEFAULT NULL,
  `gldact06` varchar(9) DEFAULT NULL,
  `gldact07` varchar(9) DEFAULT NULL,
  `gldact08` varchar(9) DEFAULT NULL,
  `gldact09` varchar(9) DEFAULT NULL,
  `gldact10` varchar(9) DEFAULT NULL,
  `gldpct01` float DEFAULT NULL,
  `gldpct02` float DEFAULT NULL,
  `gldpct03` float DEFAULT NULL,
  `gldpct04` float DEFAULT NULL,
  `gldpct05` float DEFAULT NULL,
  `gldpct06` float DEFAULT NULL,
  `gldpct07` float DEFAULT NULL,
  `gldpct08` float DEFAULT NULL,
  `gldpct09` float DEFAULT NULL,
  `gldpct10` float DEFAULT NULL,
  `glptdb` float DEFAULT NULL,
  `glytdb` float DEFAULT NULL,
  `glcurb` float DEFAULT NULL,
  `glcbal01` float DEFAULT NULL,
  `glcbal02` float DEFAULT NULL,
  `glcbal03` float DEFAULT NULL,
  `glcbal04` float DEFAULT NULL,
  `glcbal05` float DEFAULT NULL,
  `glcbal06` float DEFAULT NULL,
  `glcbal07` float DEFAULT NULL,
  `glcbal08` float DEFAULT NULL,
  `glcbal09` float DEFAULT NULL,
  `glcbal10` float DEFAULT NULL,
  `glcbal11` float DEFAULT NULL,
  `glcbal12` float DEFAULT NULL,
  `glcbal13` float DEFAULT NULL,
  `gllbal01` float DEFAULT NULL,
  `gllbal02` float DEFAULT NULL,
  `gllbal03` float DEFAULT NULL,
  `gllbal04` float DEFAULT NULL,
  `gllbal05` float DEFAULT NULL,
  `gllbal06` float DEFAULT NULL,
  `gllbal07` float DEFAULT NULL,
  `gllbal08` float DEFAULT NULL,
  `gllbal09` float DEFAULT NULL,
  `gllbal10` float DEFAULT NULL,
  `gllbal11` float DEFAULT NULL,
  `gllbal12` float DEFAULT NULL,
  `gllbal13` float DEFAULT NULL,
  `glcbud01` float DEFAULT NULL,
  `glcbud02` float DEFAULT NULL,
  `glcbud03` float DEFAULT NULL,
  `glcbud04` float DEFAULT NULL,
  `glcbud05` float DEFAULT NULL,
  `glcbud06` float DEFAULT NULL,
  `glcbud07` float DEFAULT NULL,
  `glcbud08` float DEFAULT NULL,
  `glcbud09` float DEFAULT NULL,
  `glcbud10` float DEFAULT NULL,
  `glcbud11` float DEFAULT NULL,
  `glcbud12` float DEFAULT NULL,
  `glcbud13` float DEFAULT NULL,
  `gllbud01` float DEFAULT NULL,
  `gllbud02` float DEFAULT NULL,
  `gllbud03` float DEFAULT NULL,
  `gllbud04` float DEFAULT NULL,
  `gllbud05` float DEFAULT NULL,
  `gllbud06` float DEFAULT NULL,
  `gllbud07` float DEFAULT NULL,
  `gllbud08` float DEFAULT NULL,
  `gllbud09` float DEFAULT NULL,
  `gllbud10` float DEFAULT NULL,
  `gllbud11` float DEFAULT NULL,
  `gllbud12` float DEFAULT NULL,
  `gllbud13` float DEFAULT NULL,
  `glscr1` float DEFAULT NULL,
  `glscr2` float DEFAULT NULL,
  `glcomp` varchar(2) DEFAULT NULL,
  `signature` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `glacnt`
--

INSERT INTO `glacnt` (`glacnt`, `gldesc`, `glstat`, `gltype`, `glcatag`, `glsource`, `glcolu`, `glseq`, `glatype`, `glafig`, `glaper`, `glaact`, `glratio`, `glfasb95`, `gldact01`, `gldact02`, `gldact03`, `gldact04`, `gldact05`, `gldact06`, `gldact07`, `gldact08`, `gldact09`, `gldact10`, `gldpct01`, `gldpct02`, `gldpct03`, `gldpct04`, `gldpct05`, `gldpct06`, `gldpct07`, `gldpct08`, `gldpct09`, `gldpct10`, `glptdb`, `glytdb`, `glcurb`, `glcbal01`, `glcbal02`, `glcbal03`, `glcbal04`, `glcbal05`, `glcbal06`, `glcbal07`, `glcbal08`, `glcbal09`, `glcbal10`, `glcbal11`, `glcbal12`, `glcbal13`, `gllbal01`, `gllbal02`, `gllbal03`, `gllbal04`, `gllbal05`, `gllbal06`, `gllbal07`, `gllbal08`, `gllbal09`, `gllbal10`, `gllbal11`, `gllbal12`, `gllbal13`, `glcbud01`, `glcbud02`, `glcbud03`, `glcbud04`, `glcbud05`, `glcbud06`, `glcbud07`, `glcbud08`, `glcbud09`, `glcbud10`, `glcbud11`, `glcbud12`, `glcbud13`, `gllbud01`, `gllbud02`, `gllbud03`, `gllbud04`, `gllbud05`, `gllbud06`, `gllbud07`, `gllbud08`, `gllbud09`, `gllbud10`, `gllbud11`, `gllbud12`, `gllbud13`, `glscr1`, `glscr2`, `glcomp`, `signature`) VALUES
('11010-', 'Cash in Banks (CANADIAN CHECKING)', 'A', 'A1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '10', 'C00', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('11010-000', 'Cash in Banks', 'I', 'A1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '10', 'C00', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('11011-', 'Cash in Banks (US)', 'A', 'A1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '10', 'C00', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('11011-000', 'Cash in Banks (Manual Checking)', 'I', 'A1', '', '', '1', '1  1', 'M', 0, 0, '', '10', 'C00', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('11020-', 'Cash on Hand', 'A', 'A1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '10', 'C00', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('11020-000', 'Cash on Hand', 'I', 'A1', '', '', '1', '1  1', 'M', 0, 0, '', '10', 'C00', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('11025-', 'Marketable Securities', 'A', 'A1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', 'I15', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('11025-000', 'Marketable Securities', 'I', 'A1', '', '', '1', '1  1', 'M', 0, 0, '', '', 'I15', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('11030-', 'Accounts Receivable', 'A', 'A1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '11', 'O08', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('11030-000', 'Accounts Receivable', 'I', 'A1', '', '', '1', '1  1', 'M', 0, 0, '', '11', 'O08', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('11040-', 'Allowance for Doubtful Accounts', 'A', 'A1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '12', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('11040-000', 'Allowance for Doubtful Accounts', 'I', 'A1', '', '', '1', '1  1', 'M', 0, 0, '', '12', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('11050-', 'Inventory (Finished Goods)', 'A', 'A1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '13', 'O12', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('11050-000', 'Inventory (Finished Goods)', 'I', 'A1', '', '', '1', '1  1', 'M', 0, 0, '', '13', 'O12', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('11051-', 'Inventory (Work in Progress)', 'A', 'A1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '13', 'O12', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('11051-000', 'Inventory (Work in Progress)', 'I', 'A1', '', '', '1', '1  1', 'M', 0, 0, '', '13', 'O12', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('11052-', 'Non-stock Inventory - Miscellaneous', 'A', 'A1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '13', 'O12', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('11052-000', 'Non-stock Inventory - Miscellaneous', 'I', 'A1', '', '', '1', '1  1', 'M', 0, 0, '', '13', 'O12', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('11053-', 'Inventory Adjustment', 'A', 'A1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '13', 'O12', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('11053-000', 'Inventory Adjustment', 'I', 'A1', '', '', '1', '1  1', 'M', 0, 0, '', '13', 'O12', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18000-', 'Fixed Assets - Default Account', 'A', 'A2', 'CC', '', '1', '1  2', 'M', 0, 0, '', '15', 'I05', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18000-000', 'Fixed Assets - Default Account', 'I', 'A2', '', '', '1', '1  2', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18005-', 'Fixed Assets - Accumulated Deprec.', 'A', 'A2', 'CC', '', '1', '1  2', 'M', 0, 0, '', '15', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18005-000', 'Fixed Assets - Accumulated Deprec.', 'I', 'A2', '', '', '1', '1  2', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18010-', 'Office Furniture and Equipment', 'A', 'A2', 'CC', '', '1', '1  2', 'M', 0, 0, '', '15', 'I05', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18010-000', 'Office Furniture and Equipment', 'I', 'A2', '', '', '1', '1  2', 'M', 0, 0, '', '15', 'I05', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18015-', 'Office Furniture/Equipment-Accm.Dep', 'A', 'A2', 'CD', '', '1', '1  2', 'M', 0, 0, '', '15', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18015-000', 'Office Furniture/Equipment-Accm.Dep', 'I', 'A2', '', '', '1', '1  2', 'M', 0, 0, '', '15', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18020-', 'Warehouse Equipment', 'A', 'A2', 'CC', '', '1', '1  2', 'M', 0, 0, '', '15', 'I05', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18020-000', 'Warehouse Equipment', 'I', 'A2', '', '', '1', '1  2', 'M', 0, 0, '', '15', 'I05', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18025-', 'Warehouse Equipment - Accum.Deprec.', 'A', 'A2', 'CD', '', '1', '1  2', 'M', 0, 0, '', '15', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18025-000', 'Warehouse Equipment - Accum.Deprec.', 'I', 'A2', '', '', '1', '1  2', 'M', 0, 0, '', '15', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18030-', 'Vehicles', 'A', 'A2', 'CC', '', '1', '1  2', 'M', 0, 0, '', '15', 'I05', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18030-000', 'Vehicles', 'I', 'A2', '', '', '1', '1  2', 'M', 0, 0, '', '15', 'I05', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18035-', 'Vehicles - Accumulated Depreciation', 'A', 'A2', 'CD', '', '1', '1  2', 'M', 0, 0, '', '15', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18035-000', 'Vehicles - Accumulated Depreciation', 'I', 'A2', '', '', '1', '1  2', 'M', 0, 0, '', '15', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18040-', 'Computer Equipment', 'A', 'A2', 'CC', '', '1', '1  2', 'M', 0, 0, '', '15', 'I05', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18040-000', 'Computer Equipment', 'I', 'A2', '', '', '1', '1  2', 'M', 0, 0, '', '15', 'I05', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18045-', 'Computer Equipment - Accum.Deprec.', 'A', 'A2', 'CD', '', '1', '1  2', 'M', 0, 0, '', '15', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18045-000', 'Computer Equipment - Accum.Deprec.', 'I', 'A2', '', '', '1', '1  2', 'M', 0, 0, '', '15', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18080-', 'Building (Warehouse)', 'A', 'A2', 'CC', '', '1', '1  2', 'M', 0, 0, '', '15', 'I05', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18080-000', 'Building (Warehouse)', 'I', 'A2', '', '', '1', '1  2', 'M', 0, 0, '', '15', 'I05', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18085-', 'Building (Warehouse) - Accum.Deprc.', 'A', 'A2', 'CD', '', '1', '1  2', 'M', 0, 0, '', '15', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18085-000', 'Building (Warehouse) - Accum.Deprc.', 'I', 'A2', '', '', '1', '1  2', 'M', 0, 0, '', '15', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18090-', 'Real Estate Property', 'A', 'A2', 'CC', '', '1', '1  2', 'M', 0, 0, '', '15', 'I05', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18090-000', 'Real Estate Property', 'I', 'A2', '', '', '1', '1  2', 'M', 0, 0, '', '15', 'I05', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18095-', 'Real Estate Property - Accum.Dep.', 'A', 'A2', 'CD', '', '1', '1  2', 'M', 0, 0, '', '15', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18095-000', 'Real Estate Property - Accum.Dep.', 'I', 'A2', '', '', '1', '1  2', 'M', 0, 0, '', '15', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('19010-', 'Deposits', 'A', 'A3', 'CC', '', '1', '1  3', 'M', 0, 0, '', '15', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('19010-000', 'Deposits', 'I', 'A3', '', '', '1', '1  3', 'M', 0, 0, '', '15', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('19030-', 'Insurance (Pre-paid)', 'A', 'A3', 'CC', '', '1', '1  3', 'M', 0, 0, '', '16', 'O16', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('19030-000', 'Insurance (Pre-paid)', 'I', 'A3', '', '', '1', '1  3', 'M', 0, 0, '', '16', 'O16', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('20010-', 'Accounts Payable PURCHASE', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '20', 'O20', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('20010-000', 'Accounts Payable EXPENSE', 'I', 'L1', 'C', '', '1', '1  1', 'M', 0, 0, '', '20', 'O20', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('20020-', 'Interest Payable', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '20', 'O20', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('20020-000', 'Interest Payable', 'I', 'L1', '', '', '1', '1  1', 'M', 0, 0, '', '20', 'O20', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('20030-', 'Deposits', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '21', 'O20', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('20030-000', 'Deposits', 'I', 'L1', '', '', '1', '1  1', 'M', 0, 0, '', '21', 'O20', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('21010-', 'Purchase Discounts Taken', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', 'O32', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('21010-000', 'Purchase Discounts Taken', 'I', 'L1', '', '', '1', '1  1', 'M', 0, 0, '', '', 'O32', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('21060-', 'Employee State Tax Withheld', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '21', 'O24', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('21060-000', 'Employee State Tax Withheld', 'I', 'L1', '', '', '1', '1  1', 'M', 0, 0, '', '21', 'O24', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('21310-', 'Sales Tax Payable', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '21', 'O24', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('21310-000', 'Sales Tax Payable', 'I', 'L1', '', '', '1', '1  1', 'M', 0, 0, '', '21', 'O24', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('21320-', 'Miscellaneous Tax Payable', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '21', 'O24', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('21320-000', 'Miscellaneous Tax Payable', 'I', 'L1', '', '', '1', '1  1', 'M', 0, 0, '', '21', 'O24', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23010-000', 'Payroll Taxes Payable', 'I', 'L1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23010-110', 'Payroll Taxes Payable - FICA', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23010-120', 'Payroll Taxes Payable - SUTA', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23010-130', 'Payroll Taxes Payable - FUTA', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23020-000', 'Employee Tax Payable', 'I', 'L1', '', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23020-110', 'Employee Tax Payable - FWT', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23020-120', 'Employee Tax Payable - FICA', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23020-130', 'Employee Tax Payable - SWH', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23020-140', 'Employee Tax Payable - SDI', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23090-', 'Property Tax Payable', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '21', 'O24', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23090-000', 'Property Tax Payable', 'I', 'L1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23110-', 'Federal Corp Income Tax Payable', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '21', 'O24', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23110-000', 'Federal Income Tax Payable', 'I', 'L1', '', '', '1', '1  1', 'M', 0, 0, '', '21', 'O24', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23120-', 'Ontario Corp Income Tax Payable', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '21', 'O24', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23120-000', 'State Income Tax Payable', 'I', 'L1', '', '', '1', '1  1', 'M', 0, 0, '', '21', 'O24', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23220-', 'Miscellaneous Taxes Payable', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23220-000', 'Miscellaneous Taxes Payable', 'I', 'L1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23301-', 'Employee Deduction Payable - Type 1', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23301-000', 'Employee Deduction Payable - Type 1', 'I', 'L1', '', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23302-', 'Employee Deduction Payable - Type 2', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23302-000', 'Employee Deduction Payable - Type 2', 'I', 'L1', '', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23303-', 'Employee Deduction Payable - Type 3', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23303-000', 'Employee Deduction Payable - Type 3', 'I', 'L1', '', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23304-', 'Employee Deduction Payable - Type 4', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23304-000', 'Employee Deduction Payable - Type 4', 'I', 'L1', 'L', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23305-', 'Employee Deduction Payable - Type 5', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23305-000', 'Employee Deduction Payable - Type 5', 'I', 'L1', '', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23306-', 'Employee Deduction Payable - Type 6', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23306-000', 'Employee Deduction Payable - Type 6', 'I', 'L1', 'L', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23307-', 'Employee Deduction Payable - Type 7', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23307-000', 'Employee Deduction Payable - Type 7', 'I', 'L1', 'L', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23308-', 'Employee Deduction Payable - Type 8', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23308-000', 'Employee Deduction Payable - Type 8', 'I', 'L1', '', '', '1', '1  1', 'M', 0, 0, '', '21', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('29010-', 'Notes Payable', 'A', 'L2', 'LC', '', '1', '1  2', 'M', 0, 0, '', '21', 'O32', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('29010-000', 'Notes Payable', 'I', 'L2', '', '', '1', '1  2', 'M', 0, 0, '', '21', 'O24', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('31010-', 'Capital Stock', 'A', 'E1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '30', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('31010-000', 'Capital Stock', 'I', 'E1', '', '', '1', '1  1', 'M', 0, 0, '', '30', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('31015-', 'Capital Stock Dividends', 'A', 'E1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('31015-000', 'Capital Stock Dividends', 'I', 'E1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('31020-', 'Net Income', 'A', 'E1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('31020-000', 'Net Income', 'I', 'E1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('31020-010', 'Net Income - Domestic', 'A', 'E1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('31020-020', 'Net Income - International', 'A', 'E1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('31030-', 'Retained Earnings (Default)', 'A', 'E1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('31030-000', 'Retained Earnings', 'I', 'E1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('31030-010', 'Retained Earnings (Domestic)', 'A', 'E1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('31030-020', 'Retained Earnings (International)', 'A', 'E1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('39999-', 'Suspense (Default)', 'A', 'E1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('39999-000', 'Suspense', 'I', 'E1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('41010-000', 'Sales', 'I', 'S1', '', '', '1', '1  1', 'M', 0, 0, '', '40', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('41010-010', 'Sales - Domestic', 'A', 'S1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '40', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('41010-020', 'Sales - International', 'A', 'S1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '40', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('41020-000', 'Service', 'I', 'S1', '', '', '1', '1  1', 'M', 0, 0, '', '40', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('41020-010', 'Service - Domestic', 'A', 'S1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '40', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('41020-020', 'Service - International', 'A', 'S1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '40', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('41030-000', 'Returns and Allowances', 'I', 'S1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('41030-010', 'Returns and Allowances - Domestic', 'A', 'S1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('41030-020', 'Returns and Allowances - Interntnl', 'A', 'S1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('41040-000', 'Sales Discounts', 'I', 'S1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('41040-010', 'Sales Discounts - Domestic', 'A', 'S1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('41040-020', 'Sales Discounts - International', 'A', 'S1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('41050-000', 'Early Payment Discounts', 'I', 'S1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('41050-010', 'Early Payment Discounts - Domestic', 'A', 'S1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('41050-020', 'Early Payment Discounts - Interntnl', 'A', 'S1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('51001-000', 'Cost of Goods (Stock)', 'I', 'C1', '', '', '1', '1  1', 'M', 0, 0, '', '50', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('51001-010', 'Cost of Goods (Stock) - Domestic', 'A', 'C1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '50', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('51001-020', 'Cost of Goods (Stock) - Interntnl', 'A', 'C1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '50', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('51200-000', 'Cost of Goods (Non-Stock)', 'I', 'C1', '', '', '1', '1  1', 'M', 0, 0, '', '50', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('51200-010', 'Cost of Goods (Non-Stock) - Domestc', 'A', 'C1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '50', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('51200-020', 'Cost of Goods (Non-Stock) - Intrntl', 'A', 'C1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '50', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('52010-000', 'Freight', 'I', 'C1', '', '', '1', '1  1', 'M', 0, 0, '', '50', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('52010-010', 'Freight - In(international)', 'A', 'C1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '50', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('52010-020', 'Freight - Out', 'A', 'C1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '50', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0);
INSERT INTO `glacnt` (`glacnt`, `gldesc`, `glstat`, `gltype`, `glcatag`, `glsource`, `glcolu`, `glseq`, `glatype`, `glafig`, `glaper`, `glaact`, `glratio`, `glfasb95`, `gldact01`, `gldact02`, `gldact03`, `gldact04`, `gldact05`, `gldact06`, `gldact07`, `gldact08`, `gldact09`, `gldact10`, `gldpct01`, `gldpct02`, `gldpct03`, `gldpct04`, `gldpct05`, `gldpct06`, `gldpct07`, `gldpct08`, `gldpct09`, `gldpct10`, `glptdb`, `glytdb`, `glcurb`, `glcbal01`, `glcbal02`, `glcbal03`, `glcbal04`, `glcbal05`, `glcbal06`, `glcbal07`, `glcbal08`, `glcbal09`, `glcbal10`, `glcbal11`, `glcbal12`, `glcbal13`, `gllbal01`, `gllbal02`, `gllbal03`, `gllbal04`, `gllbal05`, `gllbal06`, `gllbal07`, `gllbal08`, `gllbal09`, `gllbal10`, `gllbal11`, `gllbal12`, `gllbal13`, `glcbud01`, `glcbud02`, `glcbud03`, `glcbud04`, `glcbud05`, `glcbud06`, `glcbud07`, `glcbud08`, `glcbud09`, `glcbud10`, `glcbud11`, `glcbud12`, `glcbud13`, `gllbud01`, `gllbud02`, `gllbud03`, `gllbud04`, `gllbud05`, `gllbud06`, `gllbud07`, `gllbud08`, `gllbud09`, `gllbud10`, `gllbud11`, `gllbud12`, `gllbud13`, `glscr1`, `glscr2`, `glcomp`, `signature`) VALUES
('53100-000', 'Purchase Variance', 'I', 'C1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('53100-010', 'Purchase Variance - Domestic', 'A', 'C1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('53100-020', 'Purchase Variance - International', 'A', 'C1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71170-000', 'Salaries', 'I', 'X1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71170-010', 'Salaries - Domestic', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71170-020', 'Salaries - International', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71170-100', 'Salaries - Office', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71170-200', 'Salaries - Warehouse', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71171-', 'Commissions - Default', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71171-000', 'Commissions', 'I', 'X1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71171-010', 'Commissions - Domestic', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71171-020', 'Commissions - International', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71172-', 'Hourly Rate Wages', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71172-000', 'Hourly Rate Wages', 'I', 'X1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71172-010', 'Hourly Rate Wages - Domestic', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71172-020', 'Hourly Rate Wages - International', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71173-', 'Piecework Wages', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71173-000', 'Piecework Wages', 'I', 'X1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71173-010', 'Piecework Wages - Domestic', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71173-020', 'Piecework Wages - International', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71174-', 'Sick Pay Wages', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71174-000', 'Sick Pay Wages', 'I', 'X1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71174-010', 'Sick Pay Wages - Domestic', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71174-020', 'Sick Pay Wages - International', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71175-', 'Vacation Pay Wages', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71175-000', 'Vacation Pay Wages', 'I', 'X1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71175-010', 'Vacation Pay Wages - Domestic', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71175-020', 'Vacation Pay Wages - International', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71176-', 'Holiday Pay Wages', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71176-000', 'Holiday Pay Wages', 'I', 'X1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71176-010', 'Holiday Pay Wages - Domestic', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71176-020', 'Holiday Pay Wages - International', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71177-', 'Personal Pay Wages', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71177-000', 'Personal Pay Wages', 'I', 'X1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71177-010', 'Personal Pay Wages - Domestic', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71177-020', 'Personal Pay Wages - International', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71178-', 'Other Pay Wages', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71178-000', 'Other Pay Wages', 'I', 'X1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71178-010', 'Other Pay Wages - Domestic', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71178-020', 'Other Pay Wages - International', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71179-000', 'Overtime/Doubletime Wages', 'I', 'X1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71179-010', 'Overtime/Doubletime Wages - Domestc', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71179-020', 'Overtime/Doubletime Wages - Intntnl', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71180-', 'Contract Labor', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71180-000', 'Contract Labor', 'I', 'X1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75105-', 'Consulting Services - General', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75105-000', 'Consulting Services', 'I', 'X1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75105-010', 'Consulting Services - Domestic', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75105-020', 'Consulting Services - International', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75106-', 'Repair and Maintenance - General', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75106-000', 'Repair and Maintenance', 'I', 'X1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75106-010', 'Repair and Maintenance - Warehouse', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75106-020', 'Repair and Maintenance - Internatnl', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75110-000', 'Office Supplies', 'I', 'X1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75110-010', 'Office Supplies - Domestic', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75110-020', 'Office Supplies - International', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75120-000', 'Postage', 'I', 'X1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75120-010', 'Postage - Domestic', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75120-020', 'Postage - International', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75125-', 'Office Space Rental', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75125-000', 'Office Space Rental', 'I', 'X1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75130-000', 'Warehouse Supplies', 'I', 'X1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75130-010', 'Warehouse Supplies - Domestic', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75130-020', 'Warehouse Supplies - International', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75140-', 'Miscellaneous Expense', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75140-000', 'Miscellaneous Expense', 'I', 'X1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75140-010', 'Miscellaneous Expense - Domestic', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75140-020', 'Miscellaneous Expense - Internatnl', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('76110-', 'Interest Expense', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '70', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('76110-000', 'Interest Expense', 'I', 'X1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('77110-', 'Depreciation Expense', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', 'O04', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('77110-000', 'Depreciation Expense', 'I', 'X1', '', '', '1', '1  1', 'M', 0, 0, '', '', 'O04', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('78110-', 'Insurance Expense', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('78110-000', 'Insurance Expense', 'I', 'X1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('81020-', 'Interest Income', 'A', 'I1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('81020-000', 'Interest Income', 'I', 'I1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('81025-', 'Finance Charge Income', 'A', 'I1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('81025-000', 'Finance Charge Income', 'I', 'I1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('81030-', 'Discounts Taken', 'A', 'I1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('81030-000', 'Discounts Taken', 'I', 'I1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('81040-000', 'Miscellaneous Revenue', 'I', 'I1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('81040-010', 'Miscellaneous Revenue - Domestic', 'A', 'I1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('81040-020', 'Miscellaneous Revenue - Internatnl', 'A', 'I1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('91010-', 'SUTA Expense', 'A', 'T1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '80', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('91010-000', 'SUTA Expense', 'I', 'T1', '', '', '1', '1  1', 'M', 0, 0, '', '80', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('91020-', 'FUTA Expense', 'A', 'T1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '80', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('91020-000', 'FUTA Expense', 'I', 'T1', '', '', '1', '1  1', 'M', 0, 0, '', '80', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('91030-', 'SDI Expense', 'A', 'T1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '80', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('91030-000', 'SDI Expense', 'I', 'T1', '', '', '1', '1  1', 'M', 0, 0, '', '80', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('91040-', 'FICA Expense', 'A', 'T1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '80', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('91040-000', 'FICA Expense', 'I', 'T1', '', '', '1', '1  1', 'M', 0, 0, '', '80', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('91110-', 'State Income Tax Expense', 'A', 'T1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '80', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('91110-000', 'State Income Tax Expense', 'I', 'T1', '', '', '1', '1  1', 'M', 0, 0, '', '80', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('91120-', 'Federal Income Tax Expense', 'A', 'T1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '80', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('91120-000', 'Federal Income Tax Expense', 'I', 'T1', '', '', '1', '1  1', 'M', 0, 0, '', '80', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('91130-', 'Sales Tax Expense', 'A', 'T1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '80', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('91130-000', 'Sales Tax Expense', 'I', 'T1', '', '', '1', '1  1', 'M', 0, 0, '', '80', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('91140-', 'Other Taxes', 'A', 'T1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('91140-000', 'Other Taxes', 'I', 'T1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('92010-', 'Property Tax Expense', 'A', 'T1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '80', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('92010-000', 'Property Tax Expense', 'I', 'T1', '', '', '1', '1  1', 'M', 0, 0, '', '80', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71010-000', 'Advertising', 'I', 'X1', '', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71010-', 'Advertising', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('20010-030', 'Accounts Payable EXPENSE', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('20010-010', 'Accounts Payable PURCHASE', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71165-000', 'SECURITY DEPOSIT', 'I', 'X1', '', '', '1', '1  1', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('71165-', 'SECURITY SYSTEM', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('78210-000', 'SALES EXPENSE', 'I', 'X1', '', '', '1', '1  1', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('78210-', 'SALES EXPENSE', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71165-010', 'SECURITY DEPOSIT', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71050-000', 'SALE EXPENSE', 'I', 'X1', '', '', '1', '1  1', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('71050-', 'SALE EXPENSE', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71050-020', 'SALE EXPENSE-HOTEL', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71050-030', 'SALE EXPENSE-CAR RENTAL/TRANSPORTAT', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71050-040', 'SALE EXPENSE-ENTERTAINMENT', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71050-050', 'SALE EXPENSE-MEAL', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71050-060', 'SALE EXPENSE-GAS', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71050-070', 'SALE EXPENSE-TOLL/PARKING', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('78210-010', 'SALES EXPENSE-SHOW TICKET', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('78210-020', 'SALES EXPENSE-COURIER', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('78210-030', 'SALES EXPENSE-GAS', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('22010-000', 'CPP,EI,INCOME TAX DEDUCTION PAYABLE', 'I', 'L1', '', '', '1', '1  1', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('22010-010', 'CPP,EI,INCOME TAX DEDUCTION PAYABLE', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71070-000', 'UTILITY', 'I', 'X1', '', '', '1', '1  1', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('71070-', 'UTILITY', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71070-020', 'UTILITY-HYDRO', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71070-030', 'UTILITY-GAS', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('21310-010', 'GST Payable (Purchase Goods)', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('79110-000', 'CUSTOMS BROKERAGE', 'I', 'X1', '', '', '1', '1  1', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('79110-010', 'CUSTOMS BROKERAGE', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('11010-020', 'Cash in Banks(US CHECKING)', 'A', 'A1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71080-000', 'PHONE', 'I', 'X1', '', '', '1', '1  1', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('71080-', 'PHONE', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71080-020', 'PHON0(MOBILE)', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75110-030', 'OFFICE EQUIPMENT RENTAL', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71172-030', 'Hourly Rate Wages(Temporary)', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75106-030', 'WASTE BEAN SERVICE', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('22010-020', 'WSIB PAYABLE', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71030-000', 'AUTO Expense', 'I', 'X1', '', '', '1', '1  1', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('71030-010', 'AUTO GAS', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71030-020', 'AUTO INSURANCE', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71030-030', 'AUTO MAINTENANCE', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0);
INSERT INTO `glacnt` (`glacnt`, `gldesc`, `glstat`, `gltype`, `glcatag`, `glsource`, `glcolu`, `glseq`, `glatype`, `glafig`, `glaper`, `glaact`, `glratio`, `glfasb95`, `gldact01`, `gldact02`, `gldact03`, `gldact04`, `gldact05`, `gldact06`, `gldact07`, `gldact08`, `gldact09`, `gldact10`, `gldpct01`, `gldpct02`, `gldpct03`, `gldpct04`, `gldpct05`, `gldpct06`, `gldpct07`, `gldpct08`, `gldpct09`, `gldpct10`, `glptdb`, `glytdb`, `glcurb`, `glcbal01`, `glcbal02`, `glcbal03`, `glcbal04`, `glcbal05`, `glcbal06`, `glcbal07`, `glcbal08`, `glcbal09`, `glcbal10`, `glcbal11`, `glcbal12`, `glcbal13`, `gllbal01`, `gllbal02`, `gllbal03`, `gllbal04`, `gllbal05`, `gllbal06`, `gllbal07`, `gllbal08`, `gllbal09`, `gllbal10`, `gllbal11`, `gllbal12`, `gllbal13`, `glcbud01`, `glcbud02`, `glcbud03`, `glcbud04`, `glcbud05`, `glcbud06`, `glcbud07`, `glcbud08`, `glcbud09`, `glcbud10`, `glcbud11`, `glcbud12`, `glcbud13`, `gllbud01`, `gllbud02`, `gllbud03`, `gllbud04`, `gllbud05`, `gllbud06`, `gllbud07`, `gllbud08`, `gllbud09`, `gllbud10`, `gllbud11`, `gllbud12`, `gllbud13`, `glscr1`, `glscr2`, `glcomp`, `signature`) VALUES
('71080-010', 'PHONE', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23700-000', 'AUTO LOAN', 'I', 'L1', '', '', '1', '1  1', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('23700-', 'LOAN', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18030-010', 'AUTO LOAN (TRUCK #700-7LC)', 'A', 'A2', 'CC', '', '1', '1  2', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71040-000', 'BANK CHARGE- TD CANADA TRUST', 'I', 'X1', '', '', '1', '1  1', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('71040-010', 'BANK CHARGE- TD CANADA TRUST', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75210-000', 'INTERNET EXPENSE', 'I', 'X1', '', '', '1', '1  1', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('75210-010', 'INTERNET EXPENSE', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('51001-030', 'DUTY OF GOODS (INTERNATIONAL)', 'A', 'C1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71040-020', 'CRDIT CARD CHARGE-VISA', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71040-030', 'CREDIT CARD CHARGE-M.C.', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75215-000', 'SHOW EXPENSE', 'I', 'X1', '', '', '1', '1  1', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('75215-010', 'SHOW EXPENSE', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75215-020', 'SHOW EXPENSE-RENT', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71050-010', 'SALE EXPENSE-TICKET', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71010-010', 'Advertising-Magazine Newspaper', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71101-000', 'GIFT', 'I', 'X1', '', '', '1', '1  1', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('71101-010', 'GIFT', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71140-000', 'LICENSE & PERMITS', 'I', 'X1', '', '', '1', '1  1', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('71140-', 'LICENSE & PERMITS', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71140-010', 'AUTO LICENSE', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('72030-000', 'SALE EXPENSE', 'I', 'X1', '', '', '1', '1  1', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('72030-', 'SALE EXPENSE', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('72030-010', 'SALE EXPENSE(AUTO)', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75106-040', 'CLEANING SERVICE', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('21310-050', 'GST-FREIGHT', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('21310-070', 'GST-EXPENSE', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('21310-071', 'GST-SPACE RENTAL', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('21310-051', 'HST-FREIGHT', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('21310-072', 'GST-WAREHOUSE SUPPLIES', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('21310-073', 'GST-UTILITY', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('21310-074', 'GST-OFFICE SUPPLIES', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('22310-000', 'PST PAYABLE', 'I', 'L1', '', '', '1', '1  1', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('22310-010', 'PST PAYABLE', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75105-030', 'LEAGEL SERVICE', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18030-020', 'Vehicle-70\'CHEVELLE(#DII-GLA)', 'A', 'A2', 'CC', '', '1', '1  2', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71140-020', 'AUTO PERMITS', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18030-012', 'Vehicles Equipment-FORD Truck', 'A', 'A2', 'CC', '', '1', '1  2', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71101-020', 'GIFT (PROMOTION)', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('41030-011', 'Sales return', 'A', 'S1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '40', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('78210-040', 'SALES EXPENSE-MEAL', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18030-030', 'Vehicles-70 CHEVELLE PARTS', 'A', 'A2', 'CC', '', '1', '1  2', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('78110-020', 'Insurance Expense-Health', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('78210-050', 'SALES EXPENSE-PRINTING', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('52010-012', 'Freight - In(Domestic)', 'A', 'C1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '50', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71010-020', 'Advertising-sign', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18030-040', 'Vehicles-Interstate Trailer#A89-89X', 'A', 'A2', 'CC', '', '1', '1  2', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23700-010', 'SHORT-TERM LOAN', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('21310-020', 'GST-REMITTANCES', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75105-040', 'DUES AND SUBSCRIPTIONS', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71050-080', 'SALE EXPENSE-MISCELLANEOUS', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('78110-010', 'Insurance Expense - Warehouse', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('78110-030', 'Insurance Expense - SHOW CAR', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('51001-040', 'Cost of Goods - Contract Work', 'A', 'C1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '50', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75110-040', 'WAREHOUSE EQUIPMENT RENTAL', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75110-050', 'OFFICE EXPENSE-MOVING COST', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('79110-020', 'CUSTOMS - CBSA CUSTOMS EXAM', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('79110-030', 'CUSTOMS - OTHER EXPENSES/DUTY', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('76110-010', 'Interest Expense-loan(CAD)', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('76110-020', 'Interest Expense-loan(USD)', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71030-040', 'AUTO LEASING/FINANCING', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75215-030', 'SHOW EXPENSE-SHOW EQUIPMENT', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18030-050', 'Vehicles- 47\'CHEVY PICK UP', 'A', 'A2', 'CC', '', '1', '1  2', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18030-060', 'Vehicles-2007 Featherlite Trailer', 'A', 'A2', 'CC', '', '1', '1  2', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('31015-010', 'DIVIDEND', 'A', 'E1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('31015-020', 'DIVIDEND WITHHOLDING TAX', 'A', 'E1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('51200-030', 'Cost of Goods (Non-Stock) - Sample', 'A', 'C1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71050-090', 'SALE EXPENSE-TRAVEL PETTY CASH', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75215-040', 'SHOW EXPENSE-SHOW GAS', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('75105-050', 'CHARITY & SPONSORSHIP', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71040-040', 'FINANCIAL CHARGE / PENALTY', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('23700-020', 'LOAN-REPAYMENT', 'A', 'L1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('31030-030', 'REDEMPTION OF COMMON SHARES', 'A', 'E1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('76110-030', 'LOAN PAYMENT PRINCIPAL PORTION', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('71040-050', 'ONLINE SALES SERVICE CHARGE', 'A', 'X1', 'CC', '', '1', '1  1', 'M', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01', 0),
('18050-', 'equipment', 'A', 'A0', 'CC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('18050-010', 'equipment - tooling', 'A', 'A0', 'CC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('75110-060', 'OFFICE EXPENSE - SOFTWARE UPGRADE', 'A', 'X1', 'CC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('18010', 'office furniture and equipment', 'A', 'A0', 'CC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('51001-050', 'cost of sales- intl tooling', 'A', 'C1', 'CC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gla_address`
--

CREATE TABLE `gla_address` (
  `id` int(11) NOT NULL,
  `addressType` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `postalCode` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gltype`
--

CREATE TABLE `gltype` (
  `gltype` varchar(2) DEFAULT NULL,
  `gldesc` varchar(35) DEFAULT NULL,
  `glseq` varchar(3) DEFAULT NULL,
  `gllow` varchar(5) DEFAULT NULL,
  `glupp` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gltype`
--

INSERT INTO `gltype` (`gltype`, `gldesc`, `glseq`, `gllow`, `glupp`) VALUES
('A0', '============  Assets  ============', '', '', ''),
('A1', 'Current Assets', '1', '11000', '11999'),
('A2', 'Fixed Assets', '1', '18000', '18999'),
('A3', 'Other Assets', '1', '19000', '19999'),
('AT', 'Total Assets', '', '', ''),
('C0', '====  Cost of Goods Sold  ====', '0', '00000', '00000'),
('C1', 'Cost of Sales', '1', '51000', '59999'),
('CT', 'Total Cost of Sales', '', '', ''),
('E0', '============  Equity  ============', '', '', ''),
('E1', 'Posted Equity', '1', '31000', '39999'),
('ET', 'Total Equity', '', '', ''),
('I0', '=====  Other Income  ====', '', '', ''),
('I1', 'Other Income', '1', '81000', '81999'),
('IT', 'Total Other Income', '', '', ''),
('L0', '=========  Liabilities  ==========', '', '', ''),
('L1', 'Current Liabilities', '1', '20000', '23999'),
('L2', 'Long Term Liabilities', '1', '29000', '29999'),
('LT', 'Total Liabilities', '', '', ''),
('S0', '========  Sales  ========', '', '', ''),
('S1', 'Sales', '1', '41000', '41999'),
('ST', 'Total Sales', '', '', ''),
('T0', '========  Taxes  ========', '', '', ''),
('T1', 'Taxes', '1', '91000', '99999'),
('TT', 'Total Taxes', '', '', ''),
('X0', '=======  Expenses  ======', '', '', ''),
('X1', 'Operating Expenses', '1', '71000', '79999'),
('XT', 'Total Expenses', '', '', ''),
('Z0', 'Balance Sheet', '', '', ''),
('Z1', 'Net Income for Current Period', '', '', ''),
('Z2', 'Total Liabilities and Equity', '', '', ''),
('Z5', 'Income Statement', '', '', ''),
('Z6', 'Gross Margin', '', '', ''),
('Z7', 'Gross Income Before Taxes', '', '', ''),
('Z8', 'Net Income After Taxes', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `item` varchar(15) NOT NULL,
  `class` varchar(50) DEFAULT NULL,
  `descrip` varchar(255) DEFAULT NULL,
  `descrip2` varchar(255) DEFAULT NULL,
  `cost` float(11,2) DEFAULT NULL,
  `fobcost` float(11,2) DEFAULT '0.00',
  `onhand` float DEFAULT '0',
  `onhand2` float DEFAULT NULL,
  `onshpeta` varchar(255) DEFAULT NULL,
  `onorder` float DEFAULT '0',
  `onorder2` float DEFAULT NULL,
  `aloc` float DEFAULT '0',
  `aloc2` float DEFAULT NULL,
  `wip` float DEFAULT NULL,
  `price` float(11,2) DEFAULT '0.00',
  `price2` float(11,2) DEFAULT '0.00',
  `level2` float(11,2) DEFAULT NULL,
  `price3` float(11,2) DEFAULT '0.00',
  `level3` float DEFAULT NULL,
  `ptdqty` float DEFAULT '0',
  `ytdqty` float DEFAULT '0',
  `ptdsls` float(11,2) DEFAULT '0.00',
  `ytdsls` float(11,2) DEFAULT '0.00',
  `discrate` float DEFAULT NULL,
  `unitms` varchar(50) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `seq` varchar(50) DEFAULT NULL,
  `seq2` varchar(50) DEFAULT NULL,
  `ldate` varchar(255) DEFAULT NULL,
  `lastordr` varchar(255) DEFAULT NULL,
  `orderpt` varchar(255) NOT NULL DEFAULT '0',
  `orderqty` int(11) DEFAULT NULL,
  `supplier` varchar(50) DEFAULT 'dii',
  `vpartno` varchar(15) DEFAULT NULL,
  `lead` float DEFAULT NULL,
  `gllink` varchar(50) DEFAULT NULL,
  `decnum` float DEFAULT NULL,
  `taxcode` varchar(50) DEFAULT NULL,
  `stkcode` varchar(50) DEFAULT NULL,
  `history` varchar(50) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `req1` float DEFAULT NULL,
  `rec1` float DEFAULT NULL,
  `req2` float DEFAULT NULL,
  `rec2` float DEFAULT NULL,
  `req3` float DEFAULT NULL,
  `rec3` float DEFAULT NULL,
  `req4` float DEFAULT NULL,
  `rec4` float DEFAULT NULL,
  `req5` float DEFAULT NULL,
  `rec5` float DEFAULT NULL,
  `req6` float DEFAULT NULL,
  `rec6` float DEFAULT NULL,
  `signature` float DEFAULT NULL,
  `price4` float(11,2) DEFAULT '0.00',
  `price5` float(11,2) DEFAULT '0.00',
  `price6` float(11,2) DEFAULT '0.00',
  `pricel` float(11,2) DEFAULT '0.00',
  `totqty` float(11,2) DEFAULT NULL,
  `totsls` float(11,2) DEFAULT NULL,
  `make` varchar(50) DEFAULT NULL,
  `mark` varchar(50) DEFAULT NULL,
  `onhandb` float DEFAULT NULL,
  `onhandb2` float DEFAULT NULL,
  `orderpt2` float DEFAULT NULL,
  `ytdqty2` float DEFAULT NULL,
  `ytdsls2` float DEFAULT NULL,
  `ptdqty2` float DEFAULT NULL,
  `ptdsls2` float DEFAULT NULL,
  `totqty2` float DEFAULT NULL,
  `totsls2` float DEFAULT NULL,
  `empire` varchar(15) DEFAULT NULL,
  `onship` float(11,2) DEFAULT '0.00',
  `onship2` float DEFAULT NULL,
  `exchangerate` varchar(255) NOT NULL DEFAULT '0',
  `CADcost` float(11,2) NOT NULL DEFAULT '0.00',
  `length` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `lbs` varchar(255) DEFAULT NULL,
  `cupt` float(11,2) DEFAULT '0.00',
  `year_from` varchar(255) DEFAULT NULL,
  `year_end` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `display` int(11) NOT NULL DEFAULT '1',
  `itemcontinue` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoiceshort`
--

CREATE TABLE `invoiceshort` (
  `id` int(11) NOT NULL,
  `item` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `extPrice` float(11,2) DEFAULT NULL,
  `custno` varchar(255) DEFAULT NULL,
  `invno` int(255) DEFAULT NULL,
  `descrip` varchar(255) DEFAULT NULL,
  `tax` float(11,2) DEFAULT NULL,
  `subtotal` float(11,2) DEFAULT NULL,
  `unitPrice` float(11,2) DEFAULT NULL,
  `disc` varchar(255) DEFAULT NULL,
  `qtyshp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `itemnotes`
--

CREATE TABLE `itemnotes` (
  `id` int(20) NOT NULL,
  `item` varchar(20) NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mc`
--

CREATE TABLE `mc` (
  `id` int(11) NOT NULL,
  `custno` varchar(25) DEFAULT NULL,
  `descript` varchar(255) DEFAULT NULL,
  `amount` float(11,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `monthlyHistories`
--

CREATE TABLE `monthlyHistories` (
  `id` int(11) NOT NULL,
  `receive_invoice_total` float(11,2) NOT NULL DEFAULT '0.00',
  `period` date NOT NULL,
  `receive_ptd_bill` float(11,2) NOT NULL,
  `receive_ptd_receipt` float(11,2) NOT NULL,
  `cogs` float(11,2) NOT NULL DEFAULT '0.00',
  `inventory_value` float(11,2) NOT NULL DEFAULT '0.00',
  `inventory_value_cad` float(11,2) NOT NULL DEFAULT '0.00',
  `payable_balance_total` float(11,2) NOT NULL DEFAULT '0.00',
  `payable_ptd_payables` float(11,2) NOT NULL,
  `payable_ptd_payment` float(11,2) NOT NULL,
  `open_order` float(11,2) NOT NULL DEFAULT '0.00',
  `so_ptd_orders` float(11,2) NOT NULL,
  `so_ptd_shipment` float(11,2) NOT NULL,
  `open_pos` float(11,2) NOT NULL DEFAULT '0.00',
  `po_ptd_orders` float(11,2) NOT NULL,
  `po_container` float(11,2) NOT NULL,
  `po_ptd_receipts` float(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_apymst`
--

CREATE TABLE `new_apymst` (
  `invno` varchar(20) DEFAULT NULL,
  `vendno` varchar(60) DEFAULT NULL,
  `ppriority` varchar(1) DEFAULT NULL,
  `pdisc` float DEFAULT NULL,
  `pdays` float DEFAULT NULL,
  `pnet` float DEFAULT NULL,
  `purdate` date DEFAULT NULL,
  `duedate` date DEFAULT NULL,
  `disdate` date DEFAULT NULL,
  `discount` float(11,2) DEFAULT NULL,
  `puramt` float(11,2) DEFAULT NULL,
  `paidamt` float(11,2) DEFAULT NULL,
  `disamt` float(11,2) DEFAULT NULL,
  `adjamt` float(11,2) DEFAULT NULL,
  `aprpay` float(11,2) DEFAULT NULL,
  `aprdis` float DEFAULT NULL,
  `apradj` float DEFAULT NULL,
  `amt1099` float DEFAULT NULL,
  `buyer` varchar(255) DEFAULT NULL,
  `current` varchar(255) DEFAULT NULL,
  `ref` varchar(255) DEFAULT NULL,
  `checkno` varchar(8) DEFAULT NULL,
  `checkdate` varchar(255) DEFAULT NULL,
  `apacc` varchar(255) DEFAULT NULL,
  `chkacc` varchar(255) DEFAULT NULL,
  `typ1099` varchar(255) DEFAULT NULL,
  `apstat` varchar(255) DEFAULT NULL,
  `aptype` varchar(255) DEFAULT NULL,
  `tosw` varchar(255) DEFAULT NULL,
  `signature` float DEFAULT NULL,
  `cvendno` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_arycsh01`
--

CREATE TABLE `new_arycsh01` (
  `invno` varchar(20) DEFAULT NULL,
  `invdte` date DEFAULT NULL,
  `custno` varchar(60) DEFAULT NULL,
  `salesmn` varchar(20) DEFAULT NULL,
  `ponum` varchar(20) DEFAULT NULL,
  `disamt` float DEFAULT NULL,
  `paidamt` float DEFAULT NULL,
  `dtepaid` date DEFAULT NULL,
  `refno` varchar(255) DEFAULT NULL,
  `apcode` varchar(1) DEFAULT NULL,
  `artype` varchar(1) DEFAULT NULL,
  `glarec` varchar(3) DEFAULT NULL,
  `batch` varchar(3) DEFAULT NULL,
  `glaccnt` varchar(9) DEFAULT NULL,
  `userid` varchar(4) DEFAULT NULL,
  `oti` varchar(9) DEFAULT NULL,
  `ccati` varchar(8) DEFAULT NULL,
  `applto` varchar(9) DEFAULT NULL,
  `recdel` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_arymst`
--

CREATE TABLE `new_arymst` (
  `invno` varchar(20) DEFAULT NULL,
  `invdte` date DEFAULT NULL,
  `custno` varchar(255) DEFAULT NULL,
  `salesmn` varchar(255) DEFAULT NULL,
  `terr` varchar(200) DEFAULT NULL,
  `ponum` varchar(255) DEFAULT NULL,
  `refno` varchar(255) DEFAULT NULL,
  `disc` float(11,2) DEFAULT NULL,
  `taxrate` float DEFAULT NULL,
  `tax` float(11,2) DEFAULT NULL,
  `invamt` float(11,2) DEFAULT NULL,
  `disamt` float(11,2) DEFAULT NULL,
  `paidamt` float(11,2) DEFAULT NULL,
  `balance` float(11,2) DEFAULT NULL,
  `shipvia` varchar(255) DEFAULT NULL,
  `shipping` varchar(255) NOT NULL DEFAULT '0',
  `fob` varchar(255) DEFAULT NULL,
  `pterms` varchar(255) DEFAULT NULL,
  `pdisc` float DEFAULT NULL,
  `pdays` float DEFAULT NULL,
  `pnet` float DEFAULT NULL,
  `dtepaid` date DEFAULT NULL,
  `ordate` date DEFAULT NULL,
  `ornum` varchar(255) DEFAULT NULL,
  `commid` varchar(255) DEFAULT NULL,
  `glarec` varchar(255) DEFAULT NULL,
  `tosw` varchar(255) DEFAULT NULL,
  `maint` varchar(255) DEFAULT NULL,
  `prtid` varchar(255) DEFAULT NULL,
  `arstat` varchar(255) DEFAULT NULL,
  `artype` varchar(255) DEFAULT NULL,
  `batch` varchar(255) DEFAULT NULL,
  `current` varchar(255) DEFAULT NULL,
  `taxdist` varchar(255) DEFAULT NULL,
  `userid` varchar(255) DEFAULT NULL,
  `oti` varchar(255) DEFAULT NULL,
  `signature` float DEFAULT NULL,
  `make` varchar(255) DEFAULT NULL,
  `locid` varchar(255) DEFAULT NULL,
  `package` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_arytrn`
--

CREATE TABLE `new_arytrn` (
  `invno` varchar(20) DEFAULT NULL,
  `custno` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `descrip` varchar(255) DEFAULT NULL,
  `disc` float DEFAULT NULL,
  `taxrate` float DEFAULT NULL,
  `cost` float DEFAULT NULL,
  `price` float DEFAULT NULL,
  `qtyord` float DEFAULT NULL,
  `qtyshp` float DEFAULT NULL,
  `invdte` date DEFAULT NULL,
  `ponum` varchar(255) DEFAULT NULL,
  `extprice` float DEFAULT NULL,
  `salesmn` varchar(255) DEFAULT NULL,
  `terr` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `stkcode` varchar(255) DEFAULT NULL,
  `taxable` varchar(255) DEFAULT NULL,
  `arstat` varchar(255) DEFAULT NULL,
  `artype` varchar(255) DEFAULT NULL,
  `glsale` varchar(255) DEFAULT NULL,
  `glasst` varchar(255) DEFAULT NULL,
  `batch` varchar(255) DEFAULT NULL,
  `current` varchar(255) DEFAULT NULL,
  `taxdist` varchar(255) DEFAULT NULL,
  `seq` varchar(255) DEFAULT NULL,
  `make` varchar(255) DEFAULT NULL,
  `locid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_poymst`
--

CREATE TABLE `new_poymst` (
  `purno` varchar(8) DEFAULT NULL,
  `vendno` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `taxrate` float(11,2) DEFAULT NULL,
  `puramt` float(11,2) DEFAULT NULL,
  `recamt` float(11,2) DEFAULT NULL,
  `purdate` date DEFAULT NULL,
  `reqdate` date DEFAULT NULL,
  `shipvia` varchar(255) DEFAULT NULL,
  `fob` varchar(255) DEFAULT NULL,
  `freight` varchar(255) DEFAULT NULL,
  `buyer` varchar(255) DEFAULT NULL,
  `pterms` varchar(255) DEFAULT NULL,
  `pdisc` float DEFAULT NULL,
  `pdays` float DEFAULT NULL,
  `pnet` float DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `confirm` varchar(255) DEFAULT NULL,
  `commid` varchar(255) DEFAULT NULL,
  `tosw` varchar(255) DEFAULT NULL,
  `maint` varchar(255) DEFAULT NULL,
  `prtid` varchar(255) DEFAULT NULL,
  `potype` varchar(255) DEFAULT NULL,
  `postat` varchar(255) DEFAULT NULL,
  `current` varchar(255) DEFAULT NULL,
  `faxno` varchar(255) DEFAULT NULL,
  `signature` float DEFAULT NULL,
  `import` varchar(255) DEFAULT NULL,
  `locid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_poyrcp`
--

CREATE TABLE `new_poyrcp` (
  `purno` varchar(8) DEFAULT NULL,
  `vendno` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `vpartno` varchar(255) DEFAULT NULL,
  `descrip` varchar(255) DEFAULT NULL,
  `qtyrec` float DEFAULT NULL,
  `reqdate` date DEFAULT NULL,
  `recdate` date DEFAULT NULL,
  `disc` float(11,2) DEFAULT NULL,
  `taxrate` float DEFAULT NULL,
  `cost` float(11,2) DEFAULT NULL,
  `exttax` float(11,2) DEFAULT NULL,
  `extcost` float(11,2) DEFAULT NULL,
  `reqno` varchar(255) DEFAULT NULL,
  `dept` varchar(3) DEFAULT NULL,
  `locid` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_poytrn`
--

CREATE TABLE `new_poytrn` (
  `id` int(11) NOT NULL,
  `purno` varchar(8) DEFAULT NULL,
  `vendno` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `vpartno` varchar(255) DEFAULT NULL,
  `descrip` varchar(255) DEFAULT NULL,
  `cost` float(11,2) DEFAULT NULL,
  `qtyord` float DEFAULT NULL,
  `qtyrec` float DEFAULT NULL,
  `purdate` date DEFAULT NULL,
  `disc` float DEFAULT NULL,
  `taxrate` float(11,2) DEFAULT NULL,
  `exttax` float(11,2) DEFAULT NULL,
  `extcost` float(11,2) DEFAULT NULL,
  `recdate` date DEFAULT NULL,
  `reqdate` date DEFAULT NULL,
  `dept` varchar(255) DEFAULT NULL,
  `reqno` varchar(255) DEFAULT NULL,
  `taxable` varchar(255) DEFAULT NULL,
  `postat` varchar(255) DEFAULT NULL,
  `potype` varchar(255) DEFAULT NULL,
  `locid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_soyshp`
--

CREATE TABLE `new_soyshp` (
  `sono` varchar(8) DEFAULT NULL,
  `custno` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `descrip` varchar(255) DEFAULT NULL,
  `shipdate` date DEFAULT NULL,
  `disc` float DEFAULT NULL,
  `taxrate` float DEFAULT NULL,
  `cost` float(11,2) DEFAULT NULL,
  `price` float(11,2) DEFAULT NULL,
  `qtyshp` float DEFAULT NULL,
  `extprice` float(11,2) DEFAULT NULL,
  `salesmn` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `terr` varchar(255) DEFAULT NULL,
  `seq` varchar(255) DEFAULT NULL,
  `glsale` varchar(255) DEFAULT NULL,
  `glasst` varchar(255) DEFAULT NULL,
  `userid` varchar(255) DEFAULT NULL,
  `invno` varchar(255) DEFAULT NULL,
  `serialno` varchar(255) DEFAULT NULL,
  `locid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_soytrn`
--

CREATE TABLE `new_soytrn` (
  `id` int(11) NOT NULL,
  `sono` varchar(8) DEFAULT NULL,
  `custno` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `descrip` varchar(255) DEFAULT NULL,
  `disc` float DEFAULT NULL,
  `taxrate` float DEFAULT NULL,
  `cost` float(11,2) DEFAULT NULL,
  `price` float(11,2) DEFAULT NULL,
  `qtyord` float DEFAULT NULL,
  `qtyshp` float DEFAULT NULL,
  `extprice` float DEFAULT NULL,
  `ordate` date DEFAULT NULL,
  `rqdate` date DEFAULT NULL,
  `shipdate` date DEFAULT NULL,
  `shipqty` float DEFAULT NULL,
  `terr` varchar(255) DEFAULT NULL,
  `salesmn` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `seq` varchar(255) DEFAULT NULL,
  `glsale` varchar(255) DEFAULT NULL,
  `glasst` varchar(255) DEFAULT NULL,
  `wono` varchar(255) DEFAULT NULL,
  `macode` varchar(255) DEFAULT NULL,
  `stkcode` varchar(255) DEFAULT NULL,
  `taxable` varchar(255) DEFAULT NULL,
  `current` varchar(255) DEFAULT NULL,
  `sostat` varchar(255) DEFAULT NULL,
  `sotype` varchar(255) DEFAULT NULL,
  `taxdist` varchar(255) DEFAULT NULL,
  `locid` varchar(255) DEFAULT NULL,
  `make` varchar(255) DEFAULT NULL,
  `aloc` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pomast`
--

CREATE TABLE `pomast` (
  `purno` varchar(8) DEFAULT NULL,
  `vendno` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `taxrate` float(11,2) DEFAULT NULL,
  `puramt` float(11,2) DEFAULT NULL,
  `recamt` float(11,2) DEFAULT '0.00',
  `purdate` date DEFAULT NULL,
  `reqdate` date DEFAULT NULL,
  `shipvia` varchar(255) DEFAULT NULL,
  `fob` varchar(255) DEFAULT NULL,
  `freight` varchar(255) DEFAULT NULL,
  `buyer` varchar(255) DEFAULT NULL,
  `pterms` varchar(255) DEFAULT NULL,
  `pdisc` float DEFAULT NULL,
  `pdays` float DEFAULT NULL,
  `pnet` float DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `confirm` varchar(255) DEFAULT NULL,
  `commid` varchar(255) DEFAULT NULL,
  `tosw` varchar(255) DEFAULT NULL,
  `maint` varchar(255) DEFAULT NULL,
  `prtid` varchar(255) DEFAULT NULL,
  `potype` varchar(255) DEFAULT NULL,
  `postat` varchar(255) DEFAULT NULL,
  `current` varchar(255) DEFAULT NULL,
  `faxno` varchar(255) DEFAULT NULL,
  `signature` float DEFAULT NULL,
  `import` varchar(255) DEFAULT NULL,
  `locid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pomshp`
--

CREATE TABLE `pomshp` (
  `vendno` varchar(6) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `taxrate` float DEFAULT NULL,
  `shpamt` float(11,2) DEFAULT NULL,
  `takedays` date DEFAULT NULL,
  `recamt` float(11,2) NOT NULL DEFAULT '0.00',
  `shpdate` date DEFAULT NULL,
  `shipvia` varchar(255) DEFAULT NULL,
  `fob` varchar(255) NOT NULL DEFAULT '0',
  `freight` varchar(255) DEFAULT NULL,
  `prtid` varchar(255) DEFAULT NULL,
  `postat` varchar(255) DEFAULT NULL,
  `signature` float DEFAULT NULL,
  `reqno` varchar(255) DEFAULT NULL,
  `maint` varchar(255) DEFAULT NULL,
  `import` varchar(255) DEFAULT NULL,
  `locid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `poship`
--

CREATE TABLE `poship` (
  `purno` varchar(8) DEFAULT NULL,
  `vendno` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `vpartno` varchar(255) DEFAULT NULL,
  `descrip` varchar(255) DEFAULT NULL,
  `qtyshp` float NOT NULL DEFAULT '0',
  `qtyrec` float NOT NULL DEFAULT '0',
  `shpdate` date DEFAULT NULL,
  `recdate` date DEFAULT NULL,
  `disc` float DEFAULT NULL,
  `taxrate` float DEFAULT NULL,
  `cost` float NOT NULL DEFAULT '0',
  `exttax` float NOT NULL DEFAULT '0',
  `extcost` float NOT NULL DEFAULT '0',
  `reqno` varchar(255) DEFAULT NULL,
  `taxable` varchar(255) DEFAULT NULL,
  `postat` varchar(255) DEFAULT NULL,
  `locid` varchar(255) DEFAULT NULL,
  `fobcost` varchar(255) DEFAULT NULL,
  `cuft` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `poshipto`
--

CREATE TABLE `poshipto` (
  `id` int(11) NOT NULL,
  `purno` varchar(255) NOT NULL,
  `addressType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `poshortlists`
--

CREATE TABLE `poshortlists` (
  `id` int(255) NOT NULL,
  `vendno` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `qty` int(255) NOT NULL,
  `extCost` float(11,2) NOT NULL,
  `purno` varchar(255) NOT NULL,
  `descrip` varchar(255) NOT NULL,
  `fobcost` float(11,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `potran`
--

CREATE TABLE `potran` (
  `id` int(11) NOT NULL,
  `purno` varchar(255) DEFAULT NULL,
  `vendno` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `vpartno` varchar(255) DEFAULT NULL,
  `descrip` varchar(255) DEFAULT NULL,
  `cost` float(11,2) NOT NULL DEFAULT '0.00',
  `qtyord` float NOT NULL DEFAULT '0',
  `qtyrec` float NOT NULL DEFAULT '0',
  `purdate` date DEFAULT NULL,
  `disc` float DEFAULT NULL,
  `taxrate` float(11,2) DEFAULT NULL,
  `exttax` float(11,2) DEFAULT NULL,
  `extcost` float(11,2) NOT NULL DEFAULT '0.00',
  `recdate` date DEFAULT NULL,
  `reqdate` date DEFAULT NULL,
  `dept` varchar(255) DEFAULT NULL,
  `reqno` varchar(255) DEFAULT NULL,
  `taxable` varchar(255) DEFAULT NULL,
  `postat` varchar(255) DEFAULT NULL,
  `potype` varchar(255) DEFAULT NULL,
  `locid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shortlists`
--

CREATE TABLE `shortlists` (
  `id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `extPrice` float(11,2) NOT NULL,
  `custno` varchar(255) NOT NULL,
  `sono` int(255) NOT NULL,
  `descrip` varchar(255) DEFAULT NULL,
  `tax` float(11,2) DEFAULT NULL,
  `subtotal` float(11,2) DEFAULT NULL,
  `unitPrice` float(11,2) NOT NULL,
  `disc` varchar(255) DEFAULT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soaddr`
--

CREATE TABLE `soaddr` (
  `custno` varchar(255) DEFAULT NULL,
  `sono` varchar(255) DEFAULT NULL,
  `adtype` varchar(1) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `address3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soaddr01`
--

CREATE TABLE `soaddr01` (
  `custno` varchar(255) DEFAULT NULL,
  `sono` varchar(8) DEFAULT NULL,
  `adtype` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `address3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `somast`
--

CREATE TABLE `somast` (
  `sono` varchar(255) NOT NULL,
  `custno` varchar(255) DEFAULT NULL,
  `sodate` date DEFAULT NULL,
  `ordate` date DEFAULT NULL,
  `shipvia` varchar(255) DEFAULT NULL,
  `fob` varchar(255) DEFAULT NULL,
  `pterms` varchar(255) DEFAULT NULL,
  `pdisc` float DEFAULT NULL,
  `pdays` float DEFAULT NULL,
  `pnet` float DEFAULT NULL,
  `disc` float DEFAULT '0',
  `taxrate` float DEFAULT NULL,
  `tax` float(11,2) DEFAULT NULL,
  `ordamt` float(11,2) DEFAULT NULL,
  `shpamt` float(11,2) DEFAULT NULL,
  `currship` float(11,2) DEFAULT NULL,
  `ponum` varchar(255) DEFAULT NULL,
  `ornum` varchar(255) DEFAULT NULL,
  `glarec` varchar(255) DEFAULT NULL,
  `commid` varchar(255) DEFAULT NULL,
  `salesmn` varchar(255) DEFAULT NULL,
  `terr` varchar(255) DEFAULT NULL,
  `maint` varchar(255) DEFAULT NULL,
  `prtid` varchar(255) DEFAULT NULL,
  `copyid` varchar(255) DEFAULT NULL,
  `tosw` varchar(255) DEFAULT NULL,
  `current` varchar(255) DEFAULT NULL,
  `sostat` varchar(255) DEFAULT NULL,
  `sotype` varchar(255) DEFAULT NULL,
  `taxdist` varchar(255) DEFAULT 'CAD',
  `userid` varchar(255) DEFAULT NULL,
  `signature` float DEFAULT NULL,
  `make` varchar(255) DEFAULT NULL,
  `locid` varchar(255) DEFAULT NULL,
  `lastmodified` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soship`
--

CREATE TABLE `soship` (
  `sono` varchar(8) DEFAULT NULL,
  `custno` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `descrip` varchar(255) DEFAULT NULL,
  `serialno` varchar(255) DEFAULT NULL,
  `shipdate` date DEFAULT NULL,
  `disc` float DEFAULT NULL,
  `taxrate` float DEFAULT NULL,
  `cost` float(11,2) DEFAULT NULL,
  `price` float(11,2) DEFAULT NULL,
  `qtyshp` float DEFAULT NULL,
  `extprice` float(11,2) DEFAULT NULL,
  `salesmn` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `terr` varchar(255) DEFAULT NULL,
  `seq` varchar(255) DEFAULT NULL,
  `glsale` varchar(255) DEFAULT NULL,
  `glasst` varchar(255) DEFAULT NULL,
  `userid` varchar(255) DEFAULT NULL,
  `invno` varchar(255) DEFAULT NULL,
  `locid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sotemp`
--

CREATE TABLE `sotemp` (
  `id` int(11) NOT NULL,
  `sono` int(255) NOT NULL,
  `custno` int(255) NOT NULL,
  `item` int(255) NOT NULL,
  `descrip` varchar(255) NOT NULL,
  `disc` varchar(255) DEFAULT NULL,
  `taxrate` varchar(255) DEFAULT NULL,
  `cost` float(11,2) DEFAULT NULL,
  `price` float(11,2) DEFAULT NULL,
  `qtyord` int(255) DEFAULT NULL,
  `qtyshp` int(255) DEFAULT NULL,
  `extprice` float(11,2) DEFAULT NULL,
  `ordate` date DEFAULT NULL,
  `rqdate` date DEFAULT NULL,
  `shipdate` date DEFAULT NULL,
  `shipqty` int(255) DEFAULT NULL,
  `terr` varchar(255) DEFAULT NULL,
  `salesmn` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `seq` varchar(255) DEFAULT NULL,
  `make` varchar(255) DEFAULT NULL,
  `aloc` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sotran`
--

CREATE TABLE `sotran` (
  `id` int(11) NOT NULL,
  `sono` varchar(8) DEFAULT NULL,
  `custno` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `descrip` varchar(255) DEFAULT NULL,
  `disc` float(11,2) DEFAULT NULL,
  `taxrate` float(11,2) DEFAULT NULL,
  `cost` float(11,2) DEFAULT NULL,
  `price` float(11,2) DEFAULT NULL,
  `qtyord` float DEFAULT NULL,
  `qtyshp` float DEFAULT NULL,
  `extprice` float DEFAULT NULL,
  `ordate` date DEFAULT NULL,
  `rqdate` date DEFAULT NULL,
  `shipdate` date DEFAULT NULL,
  `shipqty` float DEFAULT NULL,
  `terr` varchar(255) DEFAULT NULL,
  `salesmn` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `seq` varchar(255) DEFAULT NULL,
  `glsale` varchar(255) DEFAULT NULL,
  `glasst` varchar(255) DEFAULT NULL,
  `wono` varchar(255) DEFAULT NULL,
  `macode` varchar(255) DEFAULT NULL,
  `stkcode` varchar(255) DEFAULT NULL,
  `taxable` varchar(255) DEFAULT NULL,
  `current` varchar(255) DEFAULT NULL,
  `sostat` varchar(255) DEFAULT NULL,
  `sotype` varchar(255) DEFAULT NULL,
  `taxdist` varchar(255) DEFAULT NULL,
  `make` varchar(255) DEFAULT NULL,
  `locid` varchar(255) DEFAULT NULL,
  `aloc` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soymst`
--

CREATE TABLE `soymst` (
  `sono` int(11) NOT NULL,
  `custno` varchar(6) DEFAULT NULL,
  `sodate` date DEFAULT NULL,
  `ordate` date DEFAULT NULL,
  `shipvia` varchar(255) DEFAULT NULL,
  `fob` varchar(255) DEFAULT NULL,
  `pterms` varchar(255) DEFAULT NULL,
  `pdisc` float DEFAULT NULL,
  `pdays` float DEFAULT NULL,
  `pnet` float DEFAULT NULL,
  `disc` float DEFAULT NULL,
  `taxrate` float DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `ordamt` float(11,2) DEFAULT NULL,
  `shpamt` float(11,2) DEFAULT NULL,
  `currship` float(11,2) DEFAULT NULL,
  `ponum` varchar(255) DEFAULT NULL,
  `ornum` varchar(255) DEFAULT NULL,
  `glarec` varchar(255) DEFAULT NULL,
  `commid` varchar(255) DEFAULT NULL,
  `salesmn` varchar(255) DEFAULT NULL,
  `terr` varchar(255) DEFAULT NULL,
  `maint` varchar(255) DEFAULT NULL,
  `prtid` varchar(255) DEFAULT NULL,
  `copyid` varchar(255) DEFAULT NULL,
  `tosw` varchar(255) DEFAULT NULL,
  `current` varchar(255) DEFAULT NULL,
  `sostat` varchar(255) DEFAULT NULL,
  `sotype` varchar(255) DEFAULT NULL,
  `taxdist` varchar(255) DEFAULT NULL,
  `userid` varchar(255) DEFAULT NULL,
  `signature` float DEFAULT NULL,
  `make` varchar(255) NOT NULL,
  `lastmodified` varchar(255) NOT NULL,
  `locid` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tempdist`
--

CREATE TABLE `tempdist` (
  `vendno` varchar(255) DEFAULT NULL,
  `invno` varchar(255) DEFAULT NULL,
  `pstdate` varchar(255) DEFAULT NULL,
  `ref` varchar(255) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  `amount` float(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_container`
--

CREATE TABLE `temp_container` (
  `id` int(255) NOT NULL,
  `purno` varchar(255) DEFAULT NULL,
  `vendno` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `descrip` varchar(255) DEFAULT NULL,
  `qtyshp` int(255) DEFAULT NULL,
  `cost` float(11,2) DEFAULT NULL,
  `extcost` float(11,2) DEFAULT NULL,
  `reqno` varchar(255) DEFAULT NULL,
  `fobcost` varchar(255) DEFAULT NULL,
  `cuft` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userType` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendornotes`
--

CREATE TABLE `vendornotes` (
  `id` int(11) NOT NULL,
  `vendno` varchar(255) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendoropenpayable`
--

CREATE TABLE `vendoropenpayable` (
  `id` int(11) NOT NULL,
  `vendno` varchar(255) NOT NULL,
  `current` varchar(255) NOT NULL DEFAULT '0',
  `day30` varchar(255) NOT NULL DEFAULT '0',
  `day60` varchar(255) NOT NULL DEFAULT '0',
  `day90` varchar(255) NOT NULL DEFAULT '0',
  `day120` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendno` varchar(6) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `ctype` varchar(255) DEFAULT NULL,
  `buyer` varchar(255) DEFAULT NULL,
  `priority` varchar(1) DEFAULT NULL,
  `lpaydate` date DEFAULT NULL,
  `lrecdate` date DEFAULT NULL,
  `tax` float(11,2) DEFAULT NULL,
  `limit` float(11,2) DEFAULT NULL,
  `debit` float DEFAULT NULL,
  `balance` float(11,2) DEFAULT NULL,
  `ptdpur` float(11,2) DEFAULT NULL,
  `ytdpur` float(11,2) DEFAULT NULL,
  `ytdpay` float(11,2) DEFAULT NULL,
  `ytddis` float(11,2) DEFAULT NULL,
  `ytdadj` float DEFAULT NULL,
  `ytd1099` float DEFAULT NULL,
  `lpayamt` float(11,2) DEFAULT NULL,
  `aprdis` float DEFAULT NULL,
  `aprpay` float DEFAULT NULL,
  `openpo` float(11,2) DEFAULT NULL,
  `typ1099` varchar(255) DEFAULT NULL,
  `history` varchar(255) DEFAULT NULL,
  `taxcode` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `defacct` varchar(255) DEFAULT NULL,
  `ctrlacct` varchar(255) DEFAULT NULL,
  `taxpid` varchar(255) DEFAULT NULL,
  `pterms` varchar(255) DEFAULT NULL,
  `pdisc` float DEFAULT NULL,
  `pdays` float DEFAULT NULL,
  `pnet` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `faxno` varchar(255) DEFAULT NULL,
  `signature` float DEFAULT NULL,
  `taxdesc` varchar(255) DEFAULT NULL,
  `import` varchar(255) DEFAULT NULL,
  `shippo` float DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adjustinventory`
--
ALTER TABLE `adjustinventory`
  ADD PRIMARY KEY (`number`);

--
-- Indexes for table `arimak01`
--
ALTER TABLE `arimak01`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `cuptandduty`
--
ALTER TABLE `cuptandduty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customernotes`
--
ALTER TABLE `customernotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customeropenreceivable`
--
ALTER TABLE `customeropenreceivable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entiresoshortlists`
--
ALTER TABLE `entiresoshortlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fillupso`
--
ALTER TABLE `fillupso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gla_address`
--
ALTER TABLE `gla_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoiceshort`
--
ALTER TABLE `invoiceshort`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemnotes`
--
ALTER TABLE `itemnotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthlyHistories`
--
ALTER TABLE `monthlyHistories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poshipto`
--
ALTER TABLE `poshipto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poshortlists`
--
ALTER TABLE `poshortlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `potran`
--
ALTER TABLE `potran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shortlists`
--
ALTER TABLE `shortlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `somast`
--
ALTER TABLE `somast`
  ADD PRIMARY KEY (`sono`);

--
-- Indexes for table `sotemp`
--
ALTER TABLE `sotemp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sotran`
--
ALTER TABLE `sotran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soymst`
--
ALTER TABLE `soymst`
  ADD PRIMARY KEY (`sono`);

--
-- Indexes for table `temp_container`
--
ALTER TABLE `temp_container`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`username`);

--
-- Indexes for table `vendornotes`
--
ALTER TABLE `vendornotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendoropenpayable`
--
ALTER TABLE `vendoropenpayable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adjustinventory`
--
ALTER TABLE `adjustinventory`
  MODIFY `number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=416;

--
-- AUTO_INCREMENT for table `arimak01`
--
ALTER TABLE `arimak01`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9451;

--
-- AUTO_INCREMENT for table `cuptandduty`
--
ALTER TABLE `cuptandduty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `customernotes`
--
ALTER TABLE `customernotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `customeropenreceivable`
--
ALTER TABLE `customeropenreceivable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1849;

--
-- AUTO_INCREMENT for table `entiresoshortlists`
--
ALTER TABLE `entiresoshortlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `fillupso`
--
ALTER TABLE `fillupso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=459;

--
-- AUTO_INCREMENT for table `gla_address`
--
ALTER TABLE `gla_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoiceshort`
--
ALTER TABLE `invoiceshort`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `itemnotes`
--
ALTER TABLE `itemnotes`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `monthlyHistories`
--
ALTER TABLE `monthlyHistories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `poshipto`
--
ALTER TABLE `poshipto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `poshortlists`
--
ALTER TABLE `poshortlists`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10211;

--
-- AUTO_INCREMENT for table `potran`
--
ALTER TABLE `potran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22885;

--
-- AUTO_INCREMENT for table `shortlists`
--
ALTER TABLE `shortlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20023;

--
-- AUTO_INCREMENT for table `sotemp`
--
ALTER TABLE `sotemp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sotran`
--
ALTER TABLE `sotran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6826;

--
-- AUTO_INCREMENT for table `temp_container`
--
ALTER TABLE `temp_container`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2793;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `vendornotes`
--
ALTER TABLE `vendornotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `vendoropenpayable`
--
ALTER TABLE `vendoropenpayable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
