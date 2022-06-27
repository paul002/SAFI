-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2022 at 05:49 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `safimw45_webdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `companyName` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `town` varchar(100) NOT NULL,
  `postalCode` int(11) NOT NULL,
  `physicalAddress` varchar(255) NOT NULL,
  `latitude` longtext NOT NULL,
  `longitude` longtext NOT NULL,
  `fax` varchar(200) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `altPhone` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `email2` varchar(200) NOT NULL,
  `principles` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `companyName`, `description`, `address`, `address2`, `town`, `postalCode`, `physicalAddress`, `latitude`, `longitude`, `fax`, `mobile`, `phone`, `altPhone`, `email`, `email2`, `principles`) VALUES
(1, 'School of Agriculture for Family Independence', 'Sample Data', '', '', '', 0, '', '-25.344', '131.031', '', '', '', '', '', '', '{\"mission\":\"Sample Mission\", \"vision\":\"Sample Vision\", \"values\":\"Sample Values\"}');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `district` varchar(50) NOT NULL,
  `region` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `district`, `region`, `timestamp`) VALUES
(1, 'Chitipa', 1, '2022-05-31 09:00:07'),
(2, 'Karonga', 1, '2022-05-31 09:00:07'),
(3, 'Likoma', 1, '2022-05-31 09:00:07'),
(4, 'Mzimba', 1, '2022-05-31 09:00:07'),
(5, 'Nkhata Bay', 1, '2022-05-31 09:00:07'),
(6, 'Rumphi', 1, '2022-05-31 09:00:07'),
(7, 'Dedza', 2, '2022-05-31 09:00:07'),
(8, 'Dowa', 2, '2022-05-31 09:00:07'),
(9, 'Kasungu', 2, '2022-05-31 09:00:07'),
(10, 'Lilongwe', 2, '2022-05-31 09:00:07'),
(11, 'Mchinji', 2, '2022-05-31 09:00:07'),
(12, 'Nkhotakota', 2, '2022-05-31 09:00:07'),
(13, 'Ntcheu', 2, '2022-05-31 09:00:07'),
(14, 'Ntchisi', 2, '2022-05-31 09:00:08'),
(15, 'Salima', 2, '2022-05-31 09:00:08'),
(16, 'Balaka', 3, '2022-05-31 09:00:08'),
(17, 'Blantyre', 3, '2022-05-31 09:00:08'),
(18, 'Chikwawa', 3, '2022-05-31 09:00:08'),
(19, 'Chiradzulu', 3, '2022-05-31 09:00:08'),
(20, 'Machinga', 3, '2022-05-31 09:00:08'),
(21, 'Mangochi', 3, '2022-05-31 09:00:08'),
(22, 'Mulanje', 3, '2022-05-31 09:00:08'),
(23, 'Mwanza', 3, '2022-05-31 09:00:08'),
(24, 'Nsanje', 3, '2022-05-31 09:00:08'),
(25, 'Thyolo', 3, '2022-05-31 09:00:08'),
(26, 'Phalombe', 3, '2022-05-31 09:00:08'),
(27, 'Zomba', 3, '2022-05-31 09:00:08'),
(28, 'Neno', 3, '2022-05-31 09:00:08');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `project` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `fulfilled` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `name`, `description`, `project`, `amount`, `fulfilled`, `timestamp`) VALUES
(1, 'Donor 1', '<p>Test Desc</p>\r\n', 'Tilinanu', 110000, 1, '2022-06-21 05:43:28'),
(2, 'Moses', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris commodo hendrerit nibh vel faucibus. In maximus, felis a ultricies ullamcorper, purus ante consequat lectus, cursus porta ex nibh eget ex. Phasellus nec pharetra turpis. Donec turpis odio, volutpat non leo in, varius venenatis dolor. Nam non dictum mi. Phasellus molestie efficitur consectetur. In hac habitasse platea dictumst. Mauris nec euismod purus. Ut fermentum dapibus maximus. Sed a enim hendrerit, mollis ligula sit amet, tincidunt elit. Proin porttitor ipsum et lectus ultricies, sit amet vulputate purus finibus. Nullam mattis tincidunt ipsum quis dapibus. Duis efficitur magna sed velit rhoncus finibus. Donec at rhoncus dolor. Quisque id venenatis dui, et venenatis erat.</p>\r\n', 'Habakuku', 10000, 0, '2022-06-21 08:11:18');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `location` varchar(50) NOT NULL,
  `featured_image` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `start_date`, `end_date`, `location`, `featured_image`, `timestamp`) VALUES
(3, 'Environmental Awareness', '<p>If you want to know more about this event, kindly send us mail</p>', '2022-06-19 00:00:00', '2022-06-30 00:00:00', 'Ryalls Hotel', 'safimw_jck_7904.jpg', '2022-06-19 20:25:15');

-- --------------------------------------------------------

--
-- Table structure for table `impact_areas`
--

CREATE TABLE `impact_areas` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `region` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `traditional_authority` varchar(50) NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `featured_image` text NOT NULL,
  `content_description` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `impact_areas`
--

INSERT INTO `impact_areas` (`id`, `name`, `region`, `district`, `traditional_authority`, `lat`, `lng`, `featured_image`, `content_description`, `timestamp`) VALUES
(28, 'Area 47, Sec 4', 2, 10, 'Njewa', -13.9457, 33.7624, 'safimw_img_6104.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris commodo hendrerit nibh vel faucibus. In maximus, felis a ultricies ullamcorper, purus ante consequat lectus, cursus porta ex nibh eget ex. Phasellus nec pharetra turpis. Donec turpis odio, volutpat non leo in, varius venenatis dolor. Nam non dictum mi. Phasellus molestie efficitur consectetur. In hac habitasse platea dictumst. Mauris nec euismod purus. Ut fermentum dapibus maximus. Sed a enim hendrerit, mollis ligula sit amet, tincidunt elit. Proin porttitor ipsum et lectus ultricies, sit amet vulputate purus finibus. Nullam mattis tincidunt ipsum quis dapibus. Duis efficitur magna sed velit rhoncus finibus. Donec at rhoncus dolor. Quisque id venenatis dui, et venenatis erat.</p>', '2022-06-21 07:58:20'),
(29, 'Simlemba', 2, 9, 'Simlemba', -12.7417, 33.6762, 'safimw_img_6168.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris commodo hendrerit nibh vel faucibus. In maximus, felis a ultricies ullamcorper, purus ante consequat lectus, cursus porta ex nibh eget ex. Phasellus nec pharetra turpis. Donec turpis odio, volutpat non leo in, varius venenatis dolor. Nam non dictum mi. Phasellus molestie efficitur consectetur. In hac habitasse platea dictumst. Mauris nec euismod purus. Ut fermentum dapibus maximus. Sed a enim hendrerit, mollis ligula sit amet, tincidunt elit. Proin porttitor ipsum et lectus ultricies, sit amet vulputate purus finibus. Nullam mattis tincidunt ipsum quis dapibus. Duis efficitur magna sed velit rhoncus finibus. Donec at rhoncus dolor. Quisque id venenatis dui, et venenatis erat.</p>', '2022-06-21 08:02:03');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `label` varchar(20) NOT NULL,
  `level` int(11) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `isActive` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `modifiedBy` int(11) NOT NULL,
  `dateModified` datetime NOT NULL,
  `hasSub` tinyint(4) NOT NULL,
  `parent` int(11) NOT NULL,
  `pageId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `label`, `level`, `icon`, `isActive`, `createdBy`, `dateCreated`, `modifiedBy`, `dateModified`, `hasSub`, `parent`, `pageId`) VALUES
(2, 'main', 1, '', 0, 1, '2022-04-05 06:48:09', 1, '2022-04-05 06:48:09', 0, 0, 1),
(3, 'sub 1', 2, '', 0, 1, '2022-04-05 06:49:00', 1, '2022-04-05 06:49:00', 0, 1, 2),
(5, 'about', 1, '', 0, 1, '2022-04-05 17:45:54', 1, '2022-04-05 17:45:54', 0, 0, 1),
(6, 'Sub 2', 3, '', 0, 1, '2022-04-05 17:53:51', 1, '2022-04-05 17:53:51', 0, 3, 0),
(7, 'Sub 2 label', 3, '', 0, 1, '2022-04-05 17:57:16', 1, '2022-04-05 17:57:16', 0, 3, 1),
(8, 'Services', 1, '', 1, 1, '2022-04-06 07:21:23', 1, '2022-04-06 07:21:23', 0, 0, 2),
(9, 'Blog', 1, '', 0, 1, '2022-04-06 07:24:50', 1, '2022-04-06 07:24:50', 0, 0, 2),
(10, 'test', 1, '', 1, 1, '2022-04-08 09:54:47', 1, '2022-04-08 09:54:47', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu_level`
--

CREATE TABLE `menu_level` (
  `id` int(11) NOT NULL,
  `level` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_level`
--

INSERT INTO `menu_level` (`id`, `level`, `description`, `timestamp`) VALUES
(2, '1', 'Main Menu', '2022-04-03 04:17:22'),
(3, '2', 'Sub Menu 1', '2022-04-03 04:17:22'),
(4, '3', 'Sub Menu 2', '2022-04-03 04:17:22');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `roleId` int(11) NOT NULL,
  `nCreate` int(1) NOT NULL,
  `nRead` int(1) NOT NULL,
  `nUpdate` int(1) NOT NULL,
  `nDelete` int(1) NOT NULL,
  `nExecute` int(1) NOT NULL,
  `nMenu` int(1) NOT NULL,
  `nHome` int(1) NOT NULL,
  `nPosts` int(1) NOT NULL,
  `nPages` int(1) NOT NULL,
  `nUsers` int(1) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `dateCreated` int(11) NOT NULL,
  `modifiedBy` int(11) NOT NULL,
  `dateModified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `postcategory`
--

CREATE TABLE `postcategory` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `modifiedBy` int(11) NOT NULL,
  `dateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `postDescription` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `imagePath` varchar(1000) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `widgets` longtext NOT NULL,
  `isPublished` int(1) NOT NULL DEFAULT 0,
  `meta_key` varchar(50) NOT NULL DEFAULT 'None',
  `meta_value` longtext NOT NULL,
  `side_bar` char(1) NOT NULL DEFAULT 'N',
  `parent` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `modifiedBy` int(11) NOT NULL,
  `dateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `postDescription`, `content`, `imagePath`, `categoryId`, `post_type`, `widgets`, `isPublished`, `meta_key`, `meta_value`, `side_bar`, `parent`, `createdBy`, `dateCreated`, `modifiedBy`, `dateModified`) VALUES
(43, 'about', 'About Safi', '<section class=\"bg-page-header\">\n    <div class=\"page-header-overlay\">\n        <div class=\"container\">\n            <div class=\"row\">\n                <div class=\"page-header\">\n                    <div class=\"page-title\">\n                        <h2>ABOUT US</h2>\n                    </div>\n                    <!-- .page-title -->\n                    <div class=\"page-header-content\">\n                        <ol class=\"breadcrumb\">\n                            <li><a href=\"index.php\">Home</a></li>\n                            <li>ABOUT US</li>\n                        </ol>\n                    </div>\n                    <!-- .page-header-content -->\n                </div>\n                <!-- .page-header -->\n            </div>\n            <!-- .row -->\n        </div>\n        <!-- .container -->\n    </div>\n    <!-- .page-header-overlay -->\n</section>\n<section class=\"bg-single-project\">\n    <div class=\"container\">\n        <div class=\"row\">\n            <div class=\"content-spacing\">\n                <div class=\"row\">\n                    <div class=\"col-lg-12\">\n                        <div class=\"single-pro-main-content\">\n                            <div class=\"row\">\n                                <div class=\"col-lg-3\">\n                                    <h4>Impact Areas</h4>\n                                    <ul class=\"single-left-content\">\n                                        <li>\n                                            <a href=\"#\">\n                                                <h4>T/A Simlemba</h4>\n                                                Kasungu\n                                            </a>\n                                        </li>\n                                        <li>\n                                            <a href=\"#\">\n                                                <h4>T/A Vuso Jere</h4>\n                                                Ntchisi\n                                            </a>\n                                        </li>\n                                        <li>\n                                            <a href=\"#\">\n                                                <h4>T/A Chilikumwendo</h4>\n                                                Dedza\n                                            </a>\n                                        </li>\n                                    </ul>\n                                    <div class=\"social-option\">\n                                        <h4>Downloads</h4>\n                                        <ul class=\"single-left-content\">\n                                            <li>\n                                                <a href=\"#\"><i class=\"fa fa-file-pdf-o\" aria-hidden=\"true\">&nbsp;&nbsp;</i>strategic plan 2022 <span><i class=\"fa fa-download\" aria-hidden=\"true\">&nbsp;&nbsp;&nbsp;</i></span></a>\n                                            </li>\n                                            <li>\n                                                <a href=\"#\"><i class=\"fa fa-file-pdf-o\" aria-hidden=\"true\">&nbsp;&nbsp;</i>strategic plan 2022 <span><i class=\"fa fa-download\" aria-hidden=\"true\">&nbsp;&nbsp;&nbsp;</i></span></a>\n                                            </li>\n                                            <li>\n                                                <a href=\"#\"><i class=\"fa fa-file-pdf-o\" aria-hidden=\"true\">&nbsp;&nbsp;</i>strategic plan 2022 <span><i class=\"fa fa-download\" aria-hidden=\"true\">&nbsp;&nbsp;&nbsp;</i></span></a>\n                                            </li>\n                                            <li>\n                                                <a href=\"#\"><i class=\"fa fa-file-pdf-o\" aria-hidden=\"true\">&nbsp;&nbsp;</i>strategic plan 2022 <span><i class=\"fa fa-download\" aria-hidden=\"true\">&nbsp;&nbsp;&nbsp;</i></span></a>\n                                            </li>\n                                            <li>\n                                                <a href=\"#\"><i class=\"fa fa-file-pdf-o\" aria-hidden=\"true\">&nbsp;&nbsp;</i>strategic plan 2022 <span><i class=\"fa fa-download\" aria-hidden=\"true\">&nbsp;&nbsp;&nbsp;</i></span></a>\n                                            </li>\n                                            <li>\n                                                <a href=\"#\"><i class=\"fa fa-file-pdf-o\" aria-hidden=\"true\">&nbsp;&nbsp;</i>strategic plan 2022 <span><i class=\"fa fa-download\" aria-hidden=\"true\">&nbsp;&nbsp;&nbsp;</i></span></a>\n                                            </li>\n                                            <li>\n                                                <a href=\"#\"><i class=\"fa fa-file-pdf-o\" aria-hidden=\"true\">&nbsp;&nbsp;</i>strategic plan 2022 <span><i class=\"fa fa-download\" aria-hidden=\"true\">&nbsp;&nbsp;&nbsp;</i></span></a>\n                                            </li>\n                                            <li>\n                                                <a href=\"#\"><i class=\"fa fa-file-pdf-o\" aria-hidden=\"true\">&nbsp;&nbsp;</i>strategic plan 2022 <span><i class=\"fa fa-download\" aria-hidden=\"true\">&nbsp;&nbsp;&nbsp;</i></span></a>\n                                            </li>\n                                            <li>\n                                                <a href=\"#\"><i class=\"fa fa-file-pdf-o\" aria-hidden=\"true\">&nbsp;&nbsp;</i>strategic plan 2022 <span><i class=\"fa fa-download\" aria-hidden=\"true\">&nbsp;&nbsp;&nbsp;</i></span></a>\n                                            </li>\n                                            <li>\n                                                <a href=\"#\"><i class=\"fa fa-file-pdf-o\" aria-hidden=\"true\">&nbsp;&nbsp;</i>strategic plan 2022 <span><i class=\"fa fa-download\" aria-hidden=\"true\">&nbsp;&nbsp;&nbsp;</i></span></a>\n                                            </li>\n                                        </ul>\n                                    </div>\n                                    <div class=\"social-option\">\n                                        <h4>Social Links</h4>\n                                        <ul class=\"social-icon-rounded\">\n                                            <li><a href=\"#\"><i class=\"fa fa-facebook\" aria-hidden=\"true\"></i></a></li>\n                                            <li><a href=\"#\"><i class=\"fa fa-twitter\" aria-hidden=\"true\"></i></a></li>\n                                        </ul>\n                                    </div>\n                                    <!-- .social-option -->\n                                </div>\n                                <!-- .col-md-4 -->\n                                <div class=\"col-lg-9\">\n                                    <div class=\"row\">\n                                        <div class=\"col-lg-4 col-sm-6 col-12\">\n                                            <div class=\"our-services-box\" style=\"border:none\">\n                                                <div class=\"our-services-items\">\n                                                    <img src=\"assets/images/about/target.png\" alt=\"target\" style=\"width:100px\" />\n                                                    <div class=\"our-services-content\">\n                                                        <h4><a href=\"service_single.html\">Mission</a></h4>\n                                                        <p>Empower rural families with knowledge, skills and resources that improve their living standards</p>\n                                                        <!-- <a href=\"service_single.html\">read more<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i></a> -->\n                                                    </div>\n                                                    <!-- .our-services-content -->\n                                                </div>\n                                                <!-- .our-services-items -->\n                                            </div>\n                                            <!-- .our-services-box -->\n                                        </div>\n                                        <!-- .col-md-4 -->\n                                        <div class=\"col-lg-4 col-sm-6 col-12\">\n                                            <div class=\"our-services-box\" style=\"border:none\">\n                                                <div class=\"our-services-items\">\n                                                    <img src=\"assets/images/about/binoculars.png\" alt=\"binoculars\" style=\"width:100px\" />\n                                                    <div class=\"our-services-content\">\n                                                        <h4><a href=\"service_single.html\">Vision</a></h4>\n                                                        <p>Self-reliant families</p>\n                                                        <!-- <a href=\"service_single.html\">read more<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i></a> -->\n                                                    </div>\n                                                    <!-- .our-services-content -->\n                                                </div>\n                                                <!-- .our-services-items -->\n                                            </div>\n                                            <!-- .our-services-box -->\n                                        </div>\n                                        <!-- .col-md-4 -->\n                                        <div class=\"col-lg-4 col-sm-6 col-12\">\n                                            <div class=\"our-services-box\" style=\"border:none\">\n                                                <div class=\"our-services-items\">\n                                                    <img src=\"assets/images/about/diamond.png\" alt=\"diamond\" style=\"width:100px\" />\n                                                    <div class=\"our-services-content\">\n                                                        <h4><a href=\"service_single.html\">Values</a></h4>\n                                                        <p>Family, Community empowerment, Partnership, Excellence and Integrity</p>\n                                                        <!-- <a href=\"service_single.html\">read more<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i></a> -->\n                                                    </div>\n                                                    <!-- .our-services-content -->\n                                                </div>\n                                                <!-- .our-services-items -->\n                                            </div>\n                                            <!-- .our-services-box -->\n                                        </div>\n                                        <!-- .col-md-4 -->\n                                    </div>\n                                    <!-- .row -->\n                                    <div class=\"single-project-content\">\n                                        <h3>BACKGROUND AND INTRODUCTION</h3>\n                                        <p>SAFI began in 2002 as community-based organization that was set up to coordinate the food relief assistance in response to the severe famine that hit Malawi in that year. As time went by, the founders realized that provision of food relief items was not sustainable in the long-term. It was felt that a sustainable solution to food insecurity was to capacitate households so that they can produce all the food they need hence SAFI was established and commenced its operations in 2007 with its first cohort of 30 families. Today, SAFI has trained over 300 families on its campus in Madisi, Dowa district.</p><br>\n                                        <p>Over the years, demand for SAFI programs grew exponentially. Most farmers expressed interest to be admitted into the program but it was not possible to increase intake beyond 40 families per year because of space limitations on the campus. However, in trying to respond to this demand, another organization was set up in 2013 called Brighter Future Initiative which later changed to Children’s Brighter Future (CBF). The aim of CBF was to provide a compressed version of the SAFI training program to families who cannot come to SAFI due to space limitations. The CBF program is delivered in modular approach with three modules namely; backyard gardening, chicken farming and field crops. To date, CBF has managed to reach out to 8759 farm families from Lilongwe, Kasungu, Ntchisi, Dowa and Mchinji. In 2017, CBF was rebranded to become SAFI Extension Program. </p><br>\n                                        <p>Educate the Children (ETC) is another sister program to the two programs. Its mandate is to provide scholarships to secondary and college going students. To date, ETC many students have completed secondary school and several other students have graduated from both public and private colleges with scholarship assistance from this program.</p><br>\n                                    </div>\n                                    <!-- .single-left-content -->\n                                </div>\n                                <!-- .col-md-8 -->\n                            </div>\n                        </div>\n                        <!-- .single-proj-main-content -->\n                    </div>\n                </div>\n                <!-- .row -->\n            </div>\n            <!-- .single-project -->\n        </div>\n        <!-- .row -->\n    </div>\n    <!-- .container -->\n</section>', '', 0, 'page', '{\"data\":[{\"about\":0,\"events\":0,\"services\":0,\"video\":0}]}', 1, 'about', 'safi, about safi, School of Agriculture for Family Independence', '1', 0, 1, '2022-05-09 06:57:11', 1, '2022-05-09 06:57:11'),
(51, 'Projects', 'projects', '<!-- Start Page Header Section -->\r\n<section class=\"bg-page-header\">\r\n    <div class=\"page-header-overlay\">\r\n        <div class=\"container\">\r\n            <div class=\"row\">\r\n                <div class=\"page-header\">\r\n                    <div class=\"page-title\">\r\n                        <h2>our project</h2>\r\n                    </div>\r\n                    <!-- .page-title -->\r\n                    <div class=\"page-header-content\">\r\n                        <ol class=\"breadcrumb\">\r\n                            <li><a href=\"index.html\">Home</a></li>\r\n                            <li>project</li>\r\n                        </ol>\r\n                    </div>\r\n                    <!-- .page-header-content -->\r\n                </div>\r\n                <!-- .page-header -->\r\n            </div>\r\n            <!-- .row -->\r\n        </div>\r\n        <!-- .container -->\r\n    </div>\r\n    <!-- .page-header-overlay -->\r\n</section>\r\n<!-- End Page Header Section -->\r\n\r\n\r\n<!-- Start Recent Project Section -->\r\n<section class=\"bg-single-recent-project\">\r\n    <div class=\"container\">\r\n        <div class=\"row\">\r\n            <div class=\"recent-project\">\r\n                <div id=\"filters\" class=\"button-group \">\r\n                    <button class=\"button is-checked\" data-filter=\"*\">show all</button>\r\n                    <button class=\"button\" data-filter=\".cat-1\">environment</button>\r\n                    <button class=\"button\" data-filter=\".cat-2\">recycling</button>\r\n                    <button class=\"button\" data-filter=\".cat-3\">ecology</button>\r\n                    <button class=\"button\" data-filter=\".cat-4\">climate</button>\r\n                </div>\r\n                <div class=\"portfolio-items\">\r\n                    <div class=\"item cat-1\" data-category=\"transition\">\r\n                        <div class=\"item-inner\">\r\n                            <div class=\"portfolio-img\">\r\n                                <div class=\"overlay-project\"></div>\r\n                                <!-- .overlay-project -->\r\n                                <img src=\"assets/images/home02/recent-project-img-1.jpg\" alt=\"recent-project-img-1\">\r\n                                <ul class=\"project-link-option\">\r\n                                    <li class=\"project-link\"><a href=\"project_single.html\"><i class=\"fa fa-link\" aria-hidden=\"true\"></i></a></li>\r\n                                    <li class=\"project-search\"><a href=\"assets/images/home02/recent-project-img-1.jpg\" data-rel=\"lightcase:myCollection\"><i class=\"fa fa-search-plus\" aria-hidden=\"true\"></i></a></li>\r\n                                </ul>\r\n                            </div>\r\n                            <!-- /.portfolio-img -->\r\n                            <div class=\"recent-project-content\">\r\n                                <h4><a href=\"project_single.html\">Sustainable Agriculture</a></h4>\r\n                                <p>By : <span><a href=\"#\">Green Forest</a></span></p>\r\n                            </div>\r\n                            <!-- .latest-port-content -->\r\n                        </div>\r\n                        <!-- .item-inner -->\r\n                    </div>\r\n                    <!-- .items -->\r\n\r\n                    <div class=\"item cat-2 \" data-category=\"metalloid\">\r\n                        <div class=\"item-inner\">\r\n                            <div class=\"portfolio-img\">\r\n                                <div class=\"overlay-project\"></div>\r\n                                <!-- .overlay-project -->\r\n                                <img src=\"assets/images/home02/recent-project-img-2.jpg\" alt=\"recent-project-img-2\">\r\n                                <ul class=\"project-link-option\">\r\n                                    <li class=\"project-link\"><a href=\"project_single.html\"><i class=\"fa fa-link\" aria-hidden=\"true\"></i></a></li>\r\n                                    <li class=\"project-search\"><a href=\"assets/images/home02/recent-project-img-2.jpg\" data-rel=\"lightcase:myCollection\"><i class=\"fa fa-search-plus\" aria-hidden=\"true\"></i></a></li>\r\n                                </ul>\r\n                            </div>\r\n                            <!-- /.portfolio-img -->\r\n                            <div class=\"recent-project-content\">\r\n                                <h4><a href=\"project_single.html\">Helping Young Planting</a></h4>\r\n                                <p>By : <span><a href=\"#\">Green Forest</a></span></p>\r\n                            </div>\r\n                            <!-- .latest-port-content -->\r\n                        </div>\r\n                        <!-- .item-inner -->\r\n                    </div>\r\n                    <!-- .items -->\r\n\r\n                    <div class=\"item cat-3 \" data-category=\"post-transition\">\r\n                        <div class=\"item-inner\">\r\n                            <div class=\"portfolio-img\">\r\n                                <div class=\"overlay-project\"></div>\r\n                                <!-- .overlay-project -->\r\n                                <img src=\"assets/images/home02/recent-project-img-3.jpg\" alt=\"recent-project-img-3\">\r\n                                <ul class=\"project-link-option\">\r\n                                    <li class=\"project-link\"><a href=\"project_single.html\"><i class=\"fa fa-link\" aria-hidden=\"true\"></i></a></li>\r\n                                    <li class=\"project-search\"><a href=\"assets/images/home02/recent-project-img-3.jpg\" data-rel=\"lightcase:myCollection\"><i class=\"fa fa-search-plus\" aria-hidden=\"true\"></i></a></li>\r\n                                </ul>\r\n                            </div>\r\n                            <!-- /.portfolio-img -->\r\n                            <div class=\"recent-project-content\">\r\n                                <h4><a href=\"project_single.html\">Need Solar Panels</a></h4>\r\n                                <p>By : <span><a href=\"#\">Green Forest</a></span></p>\r\n                            </div>\r\n                            <!-- .latest-port-content -->\r\n                        </div>\r\n                        <!-- .item-inner -->\r\n                    </div>\r\n                    <!-- .items -->\r\n\r\n                    <div class=\"item cat-2\" data-category=\"post-transition\">\r\n                        <div class=\"item-inner\">\r\n                            <div class=\"portfolio-img\">\r\n                                <div class=\"overlay-project\"></div>\r\n                                <!-- .overlay-project -->\r\n                                <img src=\"assets/images/home02/recent-project-img-4.jpg\" alt=\"recent-project-img-4\">\r\n                                <ul class=\"project-link-option\">\r\n                                    <li class=\"project-link\"><a href=\"project_single.html\"><i class=\"fa fa-link\" aria-hidden=\"true\"></i></a></li>\r\n                                    <li class=\"project-search\"><a href=\"assets/images/home02/recent-project-img-4.jpg\" data-rel=\"lightcase:myCollection\"><i class=\"fa fa-search-plus\" aria-hidden=\"true\"></i></a></li>\r\n                                </ul>\r\n                            </div>\r\n                            <!-- /.portfolio-img -->\r\n                            <div class=\"recent-project-content\">\r\n                                <h4><a href=\"project_single.html\">Save The Ozone Layer</a></h4>\r\n                                <p>By : <span><a href=\"#\">Green Forest</a></span></p>\r\n                            </div>\r\n                            <!-- .latest-port-content -->\r\n                        </div>\r\n                        <!-- .item-inner -->\r\n                    </div>\r\n                    <!-- .items -->\r\n                    <div class=\"item cat-4\" data-category=\"transition\">\r\n                        <div class=\"item-inner\">\r\n                            <div class=\"portfolio-img\">\r\n                                <div class=\"overlay-project\"></div>\r\n                                <!-- .overlay-project -->\r\n                                <img src=\"assets/images/home02/recent-project-img-5.jpg\" alt=\"recent-project-img-5\">\r\n                                <ul class=\"project-link-option\">\r\n                                    <li class=\"project-link\"><a href=\"project_single.html\"><i class=\"fa fa-link\" aria-hidden=\"true\"></i></a></li>\r\n                                    <li class=\"project-search\"><a href=\"assets/images/home02/recent-project-img-5.jpg\" data-rel=\"lightcase:myCollection\"><i class=\"fa fa-search-plus\" aria-hidden=\"true\"></i></a></li>\r\n                                </ul>\r\n                            </div>\r\n                            <!-- /.portfolio-img -->\r\n                            <div class=\"recent-project-content\">\r\n                                <h4><a href=\"project_single.html\">Save Water From Polution</a></h4>\r\n                                <p>By : <span><a href=\"#\">Green Forest</a></span></p>\r\n                            </div>\r\n                            <!-- .latest-port-content -->\r\n                        </div>\r\n                        <!-- .item-inner -->\r\n                    </div>\r\n                    <!-- .items -->\r\n                    <div class=\"item cat-1\" data-category=\"alkali\">\r\n                        <div class=\"item-inner\">\r\n                            <div class=\"portfolio-img\">\r\n                                <div class=\"overlay-project\"></div>\r\n                                <!-- .overlay-project -->\r\n                                <img src=\"assets/images/home02/recent-project-img-6.jpg\" alt=\"recent-project-img-6\">\r\n                                <ul class=\"project-link-option\">\r\n                                    <li class=\"project-link\"><a href=\"project_single.html\"><i class=\"fa fa-link\" aria-hidden=\"true\"></i></a></li>\r\n                                    <li class=\"project-search\"><a href=\"assets/images/home02/recent-project-img-6.jpg\" data-rel=\"lightcase:myCollection\"><i class=\"fa fa-search-plus\" aria-hidden=\"true\"></i></a></li>\r\n                                </ul>\r\n                            </div>\r\n                            <!-- /.portfolio-img -->\r\n                            <div class=\"recent-project-content\">\r\n                                <h4><a href=\"project_single.html\">Make Plants Alive</a></h4>\r\n                                <p>By : <span><a href=\"#\">Green Forest</a></span></p>\r\n                            </div>\r\n                            <!-- .latest-port-content -->\r\n                        </div>\r\n                        <!-- .item-inner -->\r\n                    </div>\r\n                    <!-- .items -->\r\n                </div>\r\n                <!-- .isotope-items -->\r\n                <div class=\"load-more-option\">\r\n                    <a href=\"#\" class=\"btn btn-default\">load more</a>\r\n                </div>\r\n                <!-- .load-more-option -->\r\n            </div>\r\n            <!-- .recent-project -->\r\n        </div>\r\n        <!-- .row -->\r\n    </div>\r\n    <!-- .container -->\r\n</section>\r\n<!-- End Recent Project Section -->', '', 0, 'page', '{\"data\":[{\"about\":0,\"events\":0,\"services\":0,\"video\":0}]}', 1, 'projects', 'projects, safi projects, our projects', '0', 0, 1, '2022-05-09 07:23:45', 1, '2022-05-09 07:23:45'),
(52, 'Impact Areas', 'Impact Ares', '<!-- Start Page Header Section -->\r\n<section class=\"bg-page-header\">\r\n    <div class=\"page-header-overlay\">\r\n        <div class=\"container\">\r\n            <div class=\"row\">\r\n                <div class=\"page-header\">\r\n                    <div class=\"page-title\">\r\n                        <h2>our services</h2>\r\n                    </div>\r\n                    <!-- .page-title -->\r\n                    <div class=\"page-header-content\">\r\n                        <ol class=\"breadcrumb\">\r\n                            <li><a href=\"index.html\">Home</a></li>\r\n                            <li>services</li>\r\n                        </ol>\r\n                    </div>\r\n                    <!-- .page-header-content -->\r\n                </div>\r\n                <!-- .page-header -->\r\n            </div>\r\n            <!-- .row -->\r\n        </div>\r\n        <!-- .container -->\r\n    </div>\r\n    <!-- .page-header-overlay -->\r\n</section>\r\n<!-- End Page Header Section -->\r\n\r\n\r\n<!-- Start Service Style2 Section -->\r\n<section class=\"bg-servicesstyle2-section\">\r\n    <div class=\"container\">\r\n        <div class=\"row\">\r\n            <div class=\"our-services-option\">\r\n                <div class=\"section-header\">\r\n                    <h2>what we do</h2>\r\n                    <p>Professionally mesh enterprise wide imperatives without world class paradigms.Dynamically deliver ubiquitous leadership awesome skills.</p>\r\n                </div>\r\n                <!-- .section-header -->\r\n                <div class=\"row\">\r\n                    <div class=\"col-lg-4 col-sm-6 col-12\">\r\n                        <div class=\"our-services-box\">\r\n                            <div class=\"our-services-items\">\r\n                                <i class=\"flaticon-greenhouse\"></i>\r\n                                <div class=\"our-services-content\">\r\n                                    <h4><a href=\"service_single.html\">Young Planting</a></h4>\r\n                                    <p>Credibly utcost efective an expertise and web enabled proces that improvements Completely seamless channels </p>\r\n                                    <a href=\"service_single.html\">read more<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i></a>\r\n                                </div>\r\n                                <!-- .our-services-content -->\r\n                            </div>\r\n                            <!-- .our-services-items -->\r\n                        </div>\r\n                        <!-- .our-services-box -->\r\n                    </div>\r\n                    <!-- .col-md-4 -->\r\n                    <div class=\"col-lg-4 col-sm-6 col-12\">\r\n                        <div class=\"our-services-box\">\r\n                            <div class=\"our-services-items\">\r\n                                <i class=\"flaticon-technology\"></i>\r\n                                <div class=\"our-services-content\">\r\n                                    <h4><a href=\"service_single.html\">Solar Panels</a></h4>\r\n                                    <p>Credibly utcost efective an expertise and web enabled proces that improvements Completely seamless channels </p>\r\n                                    <a href=\"service_single.html\">read more<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i></a>\r\n                                </div>\r\n                                <!-- .our-services-content -->\r\n                            </div>\r\n                            <!-- .our-services-items -->\r\n                        </div>\r\n                        <!-- .our-services-box -->\r\n                    </div>\r\n                    <!-- .col-md-4 -->\r\n                    <div class=\"col-lg-4 col-sm-6 col-12\">\r\n                        <div class=\"our-services-box\">\r\n                            <div class=\"our-services-items\">\r\n                                <i class=\"flaticon-light-bulb\"></i>\r\n                                <div class=\"our-services-content\">\r\n                                    <h4><a href=\"service_single.html\">Wind Energy</a></h4>\r\n                                    <p>Credibly utcost efective an expertise and web enabled proces that improvements Completely seamless channels </p>\r\n                                    <a href=\"service_single.html\">read more<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i></a>\r\n                                </div>\r\n                                <!-- .our-services-content -->\r\n                            </div>\r\n                            <!-- .our-services-items -->\r\n                        </div>\r\n                        <!-- .our-services-box -->\r\n                    </div>\r\n                    <!-- .col-md-4 -->\r\n                    <div class=\"col-lg-4 col-sm-6 col-12\">\r\n                        <div class=\"our-services-box\">\r\n                            <div class=\"our-services-items\">\r\n                                <i class=\"flaticon-recycling-symbol\"></i>\r\n                                <div class=\"our-services-content\">\r\n                                    <h4><a href=\"service_single.html\">Recycling</a></h4>\r\n                                    <p>Credibly utcost efective an expertise and web enabled proces that improvements Completely seamless channels </p>\r\n                                    <a href=\"service_single.html\">read more<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i></a>\r\n                                </div>\r\n                                <!-- .our-services-content -->\r\n                            </div>\r\n                            <!-- .our-services-items -->\r\n                        </div>\r\n                        <!-- .our-services-box -->\r\n                    </div>\r\n                    <!-- .col-md-4 -->\r\n                    <div class=\"col-lg-4 col-sm-6 col-12\">\r\n                        <div class=\"our-services-box\">\r\n                            <div class=\"our-services-items\">\r\n                                <i class=\"flaticon-sprout\"></i>\r\n                                <div class=\"our-services-content\">\r\n                                    <h4><a href=\"service_single.html\">Saving Forests</a></h4>\r\n                                    <p>Credibly utcost efective an expertise and web enabled proces that improvements Completely seamless channels </p>\r\n                                    <a href=\"service_single.html\">read more<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i></a>\r\n                                </div>\r\n                                <!-- .our-services-content -->\r\n                            </div>\r\n                            <!-- .our-services-items -->\r\n                        </div>\r\n                        <!-- .our-services-box -->\r\n                    </div>\r\n                    <!-- .col-md-4 -->\r\n                    <div class=\"col-lg-4 col-sm-6 col-12\">\r\n                        <div class=\"our-services-box\">\r\n                            <div class=\"our-services-items\">\r\n                                <i class=\"flaticon-droplet\"></i>\r\n                                <div class=\"our-services-content\">\r\n                                    <h4><a href=\"service_single.html\">Water Refining</a></h4>\r\n                                    <p>Credibly utcost efective an expertise and web enabled proces that improvements Completely seamless channels </p>\r\n                                    <a href=\"service_single.html\">read more<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i></a>\r\n                                </div>\r\n                                <!-- .our-services-content -->\r\n                            </div>\r\n                            <!-- .our-services-items -->\r\n                        </div>\r\n                        <!-- .our-services-box -->\r\n                    </div>\r\n                    <!-- .col-md-4 -->\r\n                </div>\r\n                <!-- .row -->\r\n            </div>\r\n            <!-- .our-services-option -->\r\n        </div>\r\n        <!-- .row -->\r\n    </div>\r\n    <!-- .container -->\r\n</section>\r\n<!-- End Service Style2 Section -->\r\n\r\n\r\n\r\n<!-- Start campaian video Section -->\r\n<section class=\"bg-compaian-video\">\r\n    <div class=\"compaian-video-overlay\">\r\n        <div class=\"container\">\r\n            <div class=\"row\">\r\n                <div class=\"compaian-video services-video\">\r\n                    <a href=\"https://www.youtube.com/embed/imVlGxbHxEo\" data-rel=\"lightcase:myCollection\"><img src=\"assets/images/services/video-icon.png\" alt=\"video-icon\" /></a>\r\n                    <h3>WATCH OUR LATEST CAMPAIGN VIDEO</h3>\r\n                </div>\r\n                <!-- .compaian-video -->\r\n            </div>\r\n            <!-- .row -->\r\n        </div>\r\n        <!-- .container -->\r\n    </div>\r\n    <!-- .compaian-video-overlay -->\r\n</section>\r\n<!-- End campaian video Section -->\r\n\r\n\r\n<!-- Start Recent Project Section -->\r\n<section class=\"bg-recent-project\">\r\n    <div class=\"container\">\r\n        <div class=\"row\">\r\n            <div class=\"recent-project\">\r\n                <div class=\"section-header\">\r\n                    <h2>recent project</h2>\r\n                    <p>Professionally mesh enterprise wide imperatives without world class paradigms.Dynamically deliver ubiquitous leadership awesome skills.</p>\r\n                </div>\r\n                <!-- .section-header -->\r\n\r\n                <div id=\"filters\" class=\"button-group \">\r\n                    <button class=\"button is-checked\" data-filter=\"*\">show all</button>\r\n                    <button class=\"button\" data-filter=\".cat-1\">environment</button>\r\n                    <button class=\"button\" data-filter=\".cat-2\">recycling</button>\r\n                    <button class=\"button\" data-filter=\".cat-3\">ecology</button>\r\n                    <button class=\"button\" data-filter=\".cat-4\">climate</button>\r\n                </div>\r\n                <div class=\"portfolio-items\">\r\n                    <div class=\"item cat-1\" data-category=\"transition\">\r\n                        <div class=\"item-inner\">\r\n                            <div class=\"portfolio-img\">\r\n                                <div class=\"overlay-project\"></div>\r\n                                <!-- .overlay-project -->\r\n                                <img src=\"assets/images/home02/recent-project-img-1.jpg\" alt=\"recent-project-img-1\">\r\n                                <ul class=\"project-link-option\">\r\n                                    <li class=\"project-link\"><a href=\"project_single.html\"><i class=\"fa fa-link\" aria-hidden=\"true\"></i></a></li>\r\n                                    <li class=\"project-search\"><a href=\"assets/images/home02/recent-project-img-1.jpg\" data-rel=\"lightcase:myCollection\"><i class=\"fa fa-search-plus\" aria-hidden=\"true\"></i></a></li>\r\n                                </ul>\r\n                            </div>\r\n                            <!-- /.portfolio-img -->\r\n                            <div class=\"recent-project-content\">\r\n                                <h4><a href=\"project_single.html\">Sustainable Agriculture</a></h4>\r\n                                <p>By : <span><a href=\"#\">Green Forest</a></span></p>\r\n                            </div>\r\n                            <!-- .latest-port-content -->\r\n                        </div>\r\n                        <!-- .item-inner -->\r\n                    </div>\r\n                    <!-- .items -->\r\n\r\n                    <div class=\"item cat-2 \" data-category=\"metalloid\">\r\n                        <div class=\"item-inner\">\r\n                            <div class=\"portfolio-img\">\r\n                                <div class=\"overlay-project\"></div>\r\n                                <!-- .overlay-project -->\r\n                                <img src=\"assets/images/home02/recent-project-img-2.jpg\" alt=\"recent-project-img-2\">\r\n                                <ul class=\"project-link-option\">\r\n                                    <li class=\"project-link\"><a href=\"project_single.html\"><i class=\"fa fa-link\" aria-hidden=\"true\"></i></a></li>\r\n                                    <li class=\"project-search\"><a href=\"assets/images/home02/recent-project-img-2.jpg\" data-rel=\"lightcase:myCollection\"><i class=\"fa fa-search-plus\" aria-hidden=\"true\"></i></a></li>\r\n                                </ul>\r\n                            </div>\r\n                            <!-- /.portfolio-img -->\r\n                            <div class=\"recent-project-content\">\r\n                                <h4><a href=\"project_single.html\">Helping Young Planting</a></h4>\r\n                                <p>By : <span><a href=\"#\">Green Forest</a></span></p>\r\n                            </div>\r\n                            <!-- .latest-port-content -->\r\n                        </div>\r\n                        <!-- .item-inner -->\r\n                    </div>\r\n                    <!-- .items -->\r\n\r\n                    <div class=\"item cat-3 \" data-category=\"post-transition\">\r\n                        <div class=\"item-inner\">\r\n                            <div class=\"portfolio-img\">\r\n                                <div class=\"overlay-project\"></div>\r\n                                <!-- .overlay-project -->\r\n                                <img src=\"assets/images/home02/recent-project-img-3.jpg\" alt=\"recent-project-img-3\">\r\n                                <ul class=\"project-link-option\">\r\n                                    <li class=\"project-link\"><a href=\"project_single.html\"><i class=\"fa fa-link\" aria-hidden=\"true\"></i></a></li>\r\n                                    <li class=\"project-search\"><a href=\"assets/images/home02/recent-project-img-3.jpg\" data-rel=\"lightcase:myCollection\"><i class=\"fa fa-search-plus\" aria-hidden=\"true\"></i></a></li>\r\n                                </ul>\r\n                            </div>\r\n                            <!-- /.portfolio-img -->\r\n                            <div class=\"recent-project-content\">\r\n                                <h4><a href=\"project_single.html\">Need Solar Panels</a></h4>\r\n                                <p>By : <span><a href=\"#\">Green Forest</a></span></p>\r\n                            </div>\r\n                            <!-- .latest-port-content -->\r\n                        </div>\r\n                        <!-- .item-inner -->\r\n                    </div>\r\n                    <!-- .items -->\r\n\r\n                    <div class=\"item cat-2\" data-category=\"post-transition\">\r\n                        <div class=\"item-inner\">\r\n                            <div class=\"portfolio-img\">\r\n                                <div class=\"overlay-project\"></div>\r\n                                <!-- .overlay-project -->\r\n                                <img src=\"assets/images/home02/recent-project-img-4.jpg\" alt=\"recent-project-img-4\">\r\n                                <ul class=\"project-link-option\">\r\n                                    <li class=\"project-link\"><a href=\"project_single.html\"><i class=\"fa fa-link\" aria-hidden=\"true\"></i></a></li>\r\n                                    <li class=\"project-search\"><a href=\"assets/images/home02/recent-project-img-4.jpg\" data-rel=\"lightcase:myCollection\"><i class=\"fa fa-search-plus\" aria-hidden=\"true\"></i></a></li>\r\n                                </ul>\r\n                            </div>\r\n                            <!-- /.portfolio-img -->\r\n                            <div class=\"recent-project-content\">\r\n                                <h4><a href=\"project_single.html\">Save The Ozone Layer</a></h4>\r\n                                <p>By : <span><a href=\"#\">Green Forest</a></span></p>\r\n                            </div>\r\n                            <!-- .latest-port-content -->\r\n                        </div>\r\n                        <!-- .item-inner -->\r\n                    </div>\r\n                    <!-- .items -->\r\n                    <div class=\"item cat-4\" data-category=\"transition\">\r\n                        <div class=\"item-inner\">\r\n                            <div class=\"portfolio-img\">\r\n                                <div class=\"overlay-project\"></div>\r\n                                <!-- .overlay-project -->\r\n                                <img src=\"assets/images/home02/recent-project-img-5.jpg\" alt=\"recent-project-img-5\">\r\n                                <ul class=\"project-link-option\">\r\n                                    <li class=\"project-link\"><a href=\"project_single.html\"><i class=\"fa fa-link\" aria-hidden=\"true\"></i></a></li>\r\n                                    <li class=\"project-search\"><a href=\"assets/images/home02/recent-project-img-5.jpg\" data-rel=\"lightcase:myCollection\"><i class=\"fa fa-search-plus\" aria-hidden=\"true\"></i></a></li>\r\n                                </ul>\r\n                            </div>\r\n                            <!-- /.portfolio-img -->\r\n                            <div class=\"recent-project-content\">\r\n                                <h4><a href=\"project_single.html\">Save Water From Polution</a></h4>\r\n                                <p>By : <span><a href=\"#\">Green Forest</a></span></p>\r\n                            </div>\r\n                            <!-- .latest-port-content -->\r\n                        </div>\r\n                        <!-- .item-inner -->\r\n                    </div>\r\n                    <!-- .items -->\r\n                    <div class=\"item cat-1\" data-category=\"alkali\">\r\n                        <div class=\"item-inner\">\r\n                            <div class=\"portfolio-img\">\r\n                                <div class=\"overlay-project\"></div>\r\n                                <!-- .overlay-project -->\r\n                                <img src=\"assets/images/home02/recent-project-img-6.jpg\" alt=\"recent-project-img-6\">\r\n                                <ul class=\"project-link-option\">\r\n                                    <li class=\"project-link\"><a href=\"project_single.html\"><i class=\"fa fa-link\" aria-hidden=\"true\"></i></a></li>\r\n                                    <li class=\"project-search\"><a href=\"assets/images/home02/recent-project-img-6.jpg\" data-rel=\"lightcase:myCollection\"><i class=\"fa fa-search-plus\" aria-hidden=\"true\"></i></a></li>\r\n                                </ul>\r\n                            </div>\r\n                            <!-- /.portfolio-img -->\r\n                            <div class=\"recent-project-content\">\r\n                                <h4><a href=\"project_single.html\">Make Plants Alive</a></h4>\r\n                                <p>By : <span><a href=\"#\">Green Forest</a></span></p>\r\n                            </div>\r\n                            <!-- .latest-port-content -->\r\n                        </div>\r\n                        <!-- .item-inner -->\r\n                    </div>\r\n                    <!-- .items -->\r\n                </div>\r\n                <!-- .isotope-items -->\r\n            </div>\r\n            <!-- .recent-project -->\r\n        </div>\r\n        <!-- .row -->\r\n    </div>\r\n    <!-- .container -->\r\n</section>\r\n<!-- End Recent Project Section -->', '', 0, 'page', '{\"data\":[{\"about\":0,\"events\":0,\"services\":0,\"video\":0}]}', 1, 'ImpactAreas', 'Impact Areas, Where we work', '0', 0, 1, '2022-05-09 07:22:06', 1, '2022-05-09 07:22:06');
INSERT INTO `posts` (`id`, `title`, `postDescription`, `content`, `imagePath`, `categoryId`, `post_type`, `widgets`, `isPublished`, `meta_key`, `meta_value`, `side_bar`, `parent`, `createdBy`, `dateCreated`, `modifiedBy`, `dateModified`) VALUES
(53, 'Work with Us', 'Work with us', '<!-- Start Page Header Section -->\r\n<section class=\"bg-page-header\">\r\n    <div class=\"page-header-overlay\">\r\n        <div class=\"container\">\r\n            <div class=\"row\">\r\n                <div class=\"page-header\">\r\n                    <div class=\"page-title\">\r\n                        <h2>Work with us</h2>\r\n                    </div>\r\n                    <!-- .page-title -->\r\n                    <div class=\"page-header-content\">\r\n                        <ol class=\"breadcrumb\">\r\n                            <li><a href=\"index.html\">Home</a></li>\r\n                            <li>Work with us</li>\r\n                        </ol>\r\n                    </div>\r\n                    <!-- .page-header-content -->\r\n                </div>\r\n                <!-- .page-header -->\r\n            </div>\r\n            <!-- .row -->\r\n        </div>\r\n        <!-- .container -->\r\n    </div>\r\n    <!-- .page-header-overlay -->\r\n</section>\r\n<!-- End Page Header Section -->\r\n\r\n\r\n\r\n<!-- Start Single Events Section -->\r\n<section class=\"bg-blog-style-2\">\r\n    <div class=\"container\">\r\n        <div class=\"row\">\r\n            <div class=\"blog-style-2\">\r\n                <div class=\"row\">\r\n                    <div class=\"col-lg-8\">\r\n                        <div class=\"blog-items\">\r\n                            <div class=\"blog-content-box\">\r\n                                <div class=\"blog-content\">\r\n                                    <h4><a href=\"blog_single.html\">Extension Worker</a></h4>\r\n                                    <ul class=\"meta-post\">\r\n                                        <li><i class=\"fa fa-calendar\" aria-hidden=\"true\"></i> Closing Date: 22.04.2017</li>\r\n                                        <li><a href=\"#\"><i class=\"fa fa-puzzle-piece \" aria-hidden=\"true\"></i> Category: Agriculture</a></li>\r\n                                        <li><a href=\"#\"><i class=\"fa fa-map-marker\"></i> location: Madisi, Dowa</a></li>\r\n                                    </ul>\r\n                                    <p>Completely actuaze cent centric coloration anCompletely actuaze cent centric coloration an-sharing without ainstalled and base awesome Completely actuaze cent centric an coloration event PSD Template.Completely actuaze cent centric aweosme coloration.</p>\r\n                                    <a href=\"job_single.php\">read more <i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i></a>\r\n                                </div>\r\n                                <!-- .blog-content -->\r\n                            </div>\r\n                            <!-- .blog-content-box -->\r\n                        </div>\r\n                        <!-- .blog-items -->\r\n                        <div class=\"pagination-option\">\r\n                            <nav aria-label=\"Page navigation\">\r\n                                <ul class=\"pagination\">\r\n                                    <li>\r\n                                        <a href=\"#\" aria-label=\"Previous\">\r\n                                            <i class=\"fa fa-angle-double-left\" aria-hidden=\"true\"></i>\r\n                                        </a>\r\n                                    </li>\r\n                                    <li><a href=\"#\">1</a></li>\r\n                                    <li class=\"active\"><a href=\"#\">2</a></li>\r\n                                    <li><a href=\"#\">3</a></li>\r\n                                    <li><a href=\"#\">...</a></li>\r\n                                    <li><a href=\"#\">5</a></li>\r\n                                    <li>\r\n                                        <a href=\"#\" aria-label=\"Next\">\r\n                                            <i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i>\r\n                                        </a>\r\n                                    </li>\r\n                                </ul>\r\n                            </nav>\r\n                        </div>\r\n                        <!-- .pagination_option -->\r\n                    </div>\r\n                    <div class=\"col-lg-4\">\r\n                        <div class=\"sidebar\">\r\n                            <div class=\"widget\">\r\n                                <div class=\"widget-content\">\r\n                                    <form action=\"#\" method=\"POST\" class=\"sidebar-form\">\r\n                                        <div class=\"form-group\">\r\n                                            <input type=\"text\" class=\"form-control\" id=\"searchId\" name=\"search\" placeholder=\"Search...\">\r\n                                            <i class=\"fa fa-search\" aria-hidden=\"true\"></i>\r\n                                        </div>\r\n                                    </form>\r\n                                </div>\r\n                                <!-- .widget-content -->\r\n                            </div>\r\n                            <!-- .widget -->\r\n\r\n\r\n                            <div class=\"widget\">\r\n                                <h4 class=\"sidebar-widget-title\">All Categores</h4>\r\n                                <div class=\"widget-content\">\r\n                                    <ul class=\"catagories\">\r\n                                        <li><a href=\"#\"><i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i> Brand Creation <span>05</span></a></li>\r\n                                        <li><a href=\"#\"><i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i> Company Analysis <span>06</span></a></li>\r\n                                        <li><a href=\"#\"><i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i> Corporate Identity<span>07</span></a></li>\r\n                                        <li><a href=\"#\"><i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i> Funding<span>08</span></a></li>\r\n                                        <li><a href=\"#\"><i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i> Medical<span>15</span></a></li>\r\n                                        <li><a href=\"#\"><i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i> Strategy Planning<span>20</span></a></li>\r\n                                        <li><a href=\"#\"><i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i> Uncategorized<span>25</span></a></li>\r\n                                        <li><a href=\"#\"><i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i> Video Production<span>30</span></a></li>\r\n\r\n                                    </ul>\r\n                                </div>\r\n                                <!-- .widget-content -->\r\n                            </div>\r\n                            <!-- .widget -->\r\n                            <div class=\"widget\">\r\n                                <h4 class=\"sidebar-widget-title\">Popular News</h4>\r\n                                <div class=\"widget-content\">\r\n                                    <ul class=\"popular-news-option\">\r\n                                        <li>\r\n                                            <div class=\"popular-news-img\">\r\n                                                <a href=\"#\"><img src=\"assets/images/event/popular-news-img-1.jpg\" alt=\"popular-news-img-1\" /></a>\r\n                                            </div>\r\n                                            <!-- .popular-news-img -->\r\n                                            <div class=\"popular-news-contant\">\r\n                                                <h5><a href=\"#\">Foulate revlunry a mihare awesome the theme.</a></h5>\r\n                                                <p>04 February 2016</p>\r\n                                            </div>\r\n                                            <!-- .popular-news-img -->\r\n                                        </li>\r\n                                        <li>\r\n                                            <div class=\"popular-news-img\">\r\n                                                <a href=\"#\"><img src=\"assets/images/event/popular-news-img-2.jpg\" alt=\"popular-news-img-2\" /></a>\r\n                                            </div>\r\n                                            <!-- .popular-news-img -->\r\n                                            <div class=\"popular-news-contant\">\r\n                                                <h5><a href=\"#\">Foulate revlunry a mihare awesome the theme.</a></h5>\r\n                                                <p>04 February 2016</p>\r\n                                            </div>\r\n                                            <!-- .popular-news-img -->\r\n                                        </li>\r\n                                        <li>\r\n                                            <div class=\"popular-news-img\">\r\n                                                <a href=\"#\"><img src=\"assets/images/event/popular-news-img-3.jpg\" alt=\"popular-news-img-3\" /></a>\r\n                                            </div>\r\n                                            <!-- .popular-news-img -->\r\n                                            <div class=\"popular-news-contant\">\r\n                                                <h5><a href=\"#\">Foulate revlunry a mihare awesome the theme.</a></h5>\r\n                                                <p>04 February 2016</p>\r\n                                            </div>\r\n                                            <!-- .popular-news-img -->\r\n                                        </li>\r\n                                    </ul>\r\n\r\n                                </div>\r\n                                <!-- .widget-content -->\r\n                            </div>\r\n                            <!-- .widget -->\r\n                            <div class=\"widget\">\r\n                                <h4 class=\"sidebar-widget-title\">photo gallery</h4>\r\n                                <div class=\"widget-content\">\r\n                                    <div class=\"gallery-instagram\">\r\n                                        <a href=\"#\"><img src=\"assets/images/event/photo-gallery-small-img-1.jpg\" alt=\"photo-gallery-small-img-1\"></a>\r\n                                        <a href=\"#\"><img src=\"assets/images/event/photo-gallery-small-img-2.jpg\" alt=\"footer-instagram-img-2\"></a>\r\n                                        <a href=\"#\"><img src=\"assets/images/event/photo-gallery-small-img-3.jpg\" alt=\"footer-instagram-img-3\"></a>\r\n                                        <a href=\"#\"><img src=\"assets/images/event/photo-gallery-small-img-4.jpg\" alt=\"footer-instagram-img-4\"></a>\r\n                                        <a href=\"#\"><img src=\"assets/images/event/photo-gallery-small-img-5.jpg\" alt=\"footer-instagram-img-5\"></a>\r\n                                        <a href=\"#\"><img src=\"assets/images/event/photo-gallery-small-img-6.jpg\" alt=\"footer-instagram-img-6\"></a>\r\n                                        <a href=\"#\"><img src=\"assets/images/event/photo-gallery-small-img-7.jpg\" alt=\"footer-instagram-img-7\"></a>\r\n                                        <a href=\"#\"><img src=\"assets/images/event/photo-gallery-small-img-8.jpg\" alt=\"footer-instagram-img-8\"></a>\r\n                                        <a href=\"#\"><img src=\"assets/images/event/photo-gallery-small-img-9.jpg\" alt=\"footer-instagram-img-9\"></a>\r\n\r\n                                    </div>\r\n                                    <!-- .gallery-instagram -->\r\n                                </div>\r\n                                <!-- .widget-content -->\r\n                            </div>\r\n                            <!-- .widget -->\r\n                            <div class=\"widget\">\r\n                                <h4 class=\"sidebar-widget-title\">Popular Tags</h4>\r\n                                <div class=\"widget-content\">\r\n                                    <div class=\"tag-cloud\">\r\n                                        <a href=\"#\" class=\"btn\">children</a>\r\n                                        <a href=\"#\" class=\"btn\">school</a>\r\n                                        <a href=\"#\" class=\"btn\">shop</a>\r\n                                        <a href=\"#\" class=\"btn\">water</a>\r\n                                        <a href=\"#\" class=\"btn\">charity</a>\r\n                                        <a href=\"#\" class=\"btn\">heaven</a>\r\n                                        <a href=\"#\" class=\"btn\">Blog</a>\r\n                                        <a href=\"#\" class=\"btn\">Contant</a>\r\n                                        <a href=\"#\" class=\"btn\">Design</a>\r\n                                    </div>\r\n                                    <!-- .tag-cloud -->\r\n                                </div>\r\n                                <!-- .widget-content -->\r\n                            </div>\r\n                            <!-- .widget -->\r\n                        </div>\r\n                        <!-- .sidebar -->\r\n                    </div>\r\n                </div>\r\n                <!-- .row -->\r\n            </div>\r\n            <!-- .blog-style-2 -->\r\n        </div>\r\n        <!-- .row -->\r\n    </div>\r\n    <!-- .container -->\r\n</section>\r\n<!-- End Single Events Section -->', '', 0, 'page', '{\"data\":[{\"about\":0,\"events\":0,\"services\":0,\"video\":0}]}', 1, 'vacancy', 'work with us, vacancy', '1', 0, 1, '2022-05-09 07:27:22', 1, '2022-05-09 07:27:22');

-- --------------------------------------------------------

--
-- Table structure for table `posts_meta`
--

CREATE TABLE `posts_meta` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `meta_key` varchar(255) NOT NULL,
  `meta_value` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `sponsor` varchar(50) NOT NULL,
  `featured_image` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `start_date`, `end_date`, `category`, `sponsor`, `featured_image`, `timestamp`) VALUES
(11, 'Ryalls Hotel', '<p>Test data</p>', '2022-06-16', '2022-06-30', '6', 'Paul Chifukwa', 'safimw_products_steve_silver_color_adrian - 1172854226_ad600b+t-b1.jpg', '2022-06-15 11:38:23'),
(13, 'E-VISA', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eu augue aliquam, blandit ipsum molestie, mattis nisl. Curabitur venenatis rutrum elit eu posuere. Aenean ut justo nec tellus ornare ultrices sed non mauris. Donec vel felis id nisl mattis ultrices ut at purus. Proin vestibulum scelerisque condimentum. Nam sit amet lectus viverra, semper eros sed, suscipit magna. Nunc ullamcorper elit ac nisi tempus scelerisque. Donec egestas, ligula ac scelerisque tempus, risus est congue tellus, nec dapibus odio felis nec velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam nec lobortis ipsum, at rhoncus mauris.</p>\r\n\r\n<p>Nulla porttitor nunc magna, ac vestibulum lacus mollis non. Nunc euismod metus eget neque mollis, vitae ultricies metus mollis. Cras convallis et sapien at vulputate. Suspendisse sit amet tellus ac neque dictum tempus vel in urna. Duis imperdiet ac quam ut tristique. Duis at euismod risus. Integer non lorem tempor, vehicula ex id, malesuada erat. Praesent sagittis sed nibh maximus porttitor. Donec a posuere mauris. Aenean ligula ante, tincidunt eu consequat vel, interdum ac risus. Nullam eget arcu sed metus pellentesque mollis. Maecenas placerat nunc in fringilla iaculis. Cras eu ultrices nibh. Donec viverra nunc eu pretium varius. Mauris molestie quis orci at ultrices.</p>', '2022-03-01', '2023-12-31', '7', 'Lughano', 'safimw_jck_7904.jpg', '2022-06-15 19:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `project_category`
--

CREATE TABLE `project_category` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_category`
--

INSERT INTO `project_category` (`id`, `category`, `description`, `timestamp`) VALUES
(6, 'Environmental', 'environmental category', '2022-06-15 08:31:18'),
(7, 'Ecology', 'More on testing', '2022-06-15 18:49:44');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id` int(11) NOT NULL,
  `region` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `region`, `timestamp`) VALUES
(1, 'Northern', '2022-05-31 06:45:01'),
(2, 'Central', '2022-05-31 06:45:01'),
(3, 'Southern', '2022-05-31 06:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `isActive` int(1) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `modifiedBy` int(11) NOT NULL,
  `dateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `site_options`
--

CREATE TABLE `site_options` (
  `id` int(11) NOT NULL,
  `option_name` varchar(200) NOT NULL,
  `option_value` longtext NOT NULL,
  `active` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site_options`
--

INSERT INTO `site_options` (`id`, `option_name`, `option_value`, `active`) VALUES
(1, 'side_bar_left', '1', 'yes'),
(2, 'side_bar_right', '0', 'yes'),
(3, 'social_links_on_side_bar', '1', 'yes'),
(4, 'downloads_on_side_bar', '1', 'yes'),
(5, 'searbox_on_side_bar', '1', 'yes'),
(6, 'categories_on_side_bar', '1', 'yes'),
(7, 'popular_news_on_side_bar', '1', 'yes'),
(8, 'gallery_on_side_bar', '1', 'yes'),
(9, 'tags_on_side_bar', '1', 'yes'),
(10, 'blog_image', '1', 'yes'),
(11, 'google_maps_position', '{\"top\":1;\"bottom\":0}', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phoneNo` varchar(20) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `roleId` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `imagePath` varchar(255) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `modifiedBy` int(11) NOT NULL,
  `dateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `phoneNo`, `firstName`, `middleName`, `lastName`, `roleId`, `status`, `imagePath`, `createdBy`, `dateCreated`, `modifiedBy`, `dateModified`) VALUES
(1, 'admin', 'fcea920f7412b5da7be0cf42b8c93759', 'chfkpaul@gmail.com', '0999040364', 'Paul', '', 'Chifukwa', 1, 1, '', 1, '2022-04-02 14:12:13', 1, '2022-04-02 14:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `vacancy`
--

CREATE TABLE `vacancy` (
  `id` int(11) NOT NULL,
  `position` varchar(50) NOT NULL,
  `closing_date` datetime NOT NULL,
  `location` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `category` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vacancy_category`
--

CREATE TABLE `vacancy_category` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vacancy_category`
--

INSERT INTO `vacancy_category` (`id`, `category`, `description`, `timestamp`) VALUES
(2, 'Test', 'Testing my Category', '2022-06-25 08:44:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `impact_areas`
--
ALTER TABLE `impact_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_level`
--
ALTER TABLE `menu_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts_meta`
--
ALTER TABLE `posts_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_category`
--
ALTER TABLE `project_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_options`
--
ALTER TABLE `site_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vacancy`
--
ALTER TABLE `vacancy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vacancy_category`
--
ALTER TABLE `vacancy_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `impact_areas`
--
ALTER TABLE `impact_areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menu_level`
--
ALTER TABLE `menu_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `posts_meta`
--
ALTER TABLE `posts_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `project_category`
--
ALTER TABLE `project_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `site_options`
--
ALTER TABLE `site_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vacancy`
--
ALTER TABLE `vacancy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vacancy_category`
--
ALTER TABLE `vacancy_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
