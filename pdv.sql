-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 02-Ago-2016 às 21:35
-- Versão do servidor: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdv`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tec_categories`
--

CREATE TABLE `tec_categories` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(55) NOT NULL,
  `image` varchar(100) DEFAULT 'no_image.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tec_categories`
--

INSERT INTO `tec_categories` (`id`, `code`, `name`, `image`) VALUES
(1, 'G01', 'Bebidas', 'fe71884b38b50fd00b18d3fb2305dc9f.jpg'),
(2, 'G02', 'Alimentos', '29170e7ecbb92b9a35bdfab60757617b.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tec_combo_items`
--

CREATE TABLE `tec_combo_items` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `item_code` varchar(20) NOT NULL,
  `quantity` decimal(12,4) NOT NULL,
  `price` decimal(25,2) DEFAULT NULL,
  `cost` decimal(25,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tec_combo_items`
--

INSERT INTO `tec_combo_items` (`id`, `product_id`, `item_code`, `quantity`, `price`, `cost`) VALUES
(5, 18, '03', '1.0000', NULL, NULL),
(6, 18, '02', '1.0000', NULL, NULL),
(7, 18, '0015', '1.0000', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tec_customers`
--

CREATE TABLE `tec_customers` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `cf1` varchar(255) NOT NULL,
  `cf2` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tec_customers`
--

INSERT INTO `tec_customers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`) VALUES
(1, 'Cliente Padr?o', '9999999999', '99999999', '012345678', 'cliente@pdvparatodos.com.br'),
(2, 'Mesa 01', '999999999', '999999999', '999999999', 'mesa@mesa.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tec_expenses`
--

CREATE TABLE `tec_expenses` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reference` varchar(50) NOT NULL,
  `amount` decimal(25,2) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `created_by` varchar(55) NOT NULL,
  `attachment` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tec_expenses`
--

INSERT INTO `tec_expenses` (`id`, `date`, `reference`, `amount`, `note`, `created_by`, `attachment`) VALUES
(1, '2015-11-02 13:52:00', 'Frete da Empada', '5.00', '', '1', NULL),
(2, '2016-01-25 23:22:00', 'batata', '2.00', '', '1', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tec_gift_cards`
--

CREATE TABLE `tec_gift_cards` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `card_no` varchar(20) NOT NULL,
  `value` decimal(25,2) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `balance` decimal(25,2) NOT NULL,
  `expiry` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tec_groups`
--

CREATE TABLE `tec_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tec_groups`
--

INSERT INTO `tec_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'staff', 'Staff');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tec_login_attempts`
--

CREATE TABLE `tec_login_attempts` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tec_mesas`
--

CREATE TABLE `tec_mesas` (
  `id` int(11) NOT NULL,
  `mesa` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tec_payments`
--

CREATE TABLE `tec_payments` (
  `id` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sale_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `transaction_id` varchar(50) DEFAULT NULL,
  `paid_by` varchar(20) NOT NULL,
  `cheque_no` varchar(20) DEFAULT NULL,
  `cc_no` varchar(20) DEFAULT NULL,
  `cc_holder` varchar(25) DEFAULT NULL,
  `cc_month` varchar(2) DEFAULT NULL,
  `cc_year` varchar(4) DEFAULT NULL,
  `cc_type` varchar(20) DEFAULT NULL,
  `amount` decimal(25,2) NOT NULL,
  `currency` varchar(3) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `attachment` varchar(55) DEFAULT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `pos_paid` decimal(25,2) DEFAULT '0.00',
  `pos_balance` decimal(25,2) DEFAULT '0.00',
  `gc_no` varchar(20) DEFAULT NULL,
  `reference` varchar(50) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tec_payments`
--

INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`) VALUES
(1, '2015-11-02 13:47:00', 1, 1, NULL, 'CC', '', '', '', '', '', 'Visa', '4.00', NULL, 1, NULL, '', '0.00', '0.00', '', '', NULL, NULL),
(2, '2015-11-03 12:43:13', 2, 1, NULL, 'cash', '', '', '', '', '', '', '16.00', NULL, 1, NULL, '', '20.00', '4.00', '', NULL, NULL, NULL),
(3, '2015-12-12 19:10:09', 4, 1, NULL, 'cash', '', '', '', '', '', '', '10.99', NULL, 2, NULL, '', '50.00', '39.01', '', NULL, NULL, NULL),
(4, '2015-12-12 19:13:40', 5, 1, NULL, 'cash', '', '', '', '', '', '', '32.97', NULL, 2, NULL, '', '70.00', '37.03', '', NULL, NULL, NULL),
(5, '2016-01-22 17:29:59', 6, 1, NULL, 'cash', '', '', '', '', '', '', '20.00', NULL, 1, NULL, '', '20.00', '0.00', '', NULL, NULL, NULL),
(6, '2016-01-25 23:15:47', 7, 1, NULL, 'cash', '', '', '', '', '', '', '4.00', NULL, 1, NULL, '', '10.00', '6.00', '', NULL, NULL, NULL),
(7, '2016-01-25 23:50:55', 8, 1, NULL, 'cash', '', '', '', '', '', '', '4.00', NULL, 1, NULL, '', '10.00', '6.00', '', NULL, NULL, NULL),
(8, '2016-01-25 23:54:16', 10, 1, NULL, 'cash', '', '', '', '', '', '', '6.00', NULL, 1, NULL, '', '50.00', '44.00', '', NULL, NULL, NULL),
(9, '2016-01-26 00:00:29', 11, 1, NULL, 'cash', '', '', '', '', '', '', '4.00', NULL, 1, NULL, '', '4.00', '6.00', '', NULL, NULL, NULL),
(10, '2016-01-26 00:02:46', 12, 1, NULL, 'cash', '', '', '', '', '', '', '7.00', NULL, 1, NULL, '', '10.00', '3.00', '', NULL, NULL, NULL),
(11, '2016-01-26 00:04:10', 13, 1, NULL, 'cash', '', '', '', '', '', '', '2.00', NULL, 1, NULL, '', '5.00', '3.00', '', NULL, NULL, NULL),
(12, '2016-01-26 00:04:47', 14, 1, NULL, 'cash', '', '', '', '', '', '', '8.00', NULL, 1, NULL, '', '10.00', '2.00', '', NULL, NULL, NULL),
(13, '2016-01-26 00:11:13', 15, 1, NULL, 'cash', '', '', '', '', '', '', '24.00', NULL, 1, NULL, '', '50.00', '26.00', '', NULL, NULL, NULL),
(14, '2016-02-01 05:03:58', 16, 1, NULL, 'cash', '', '', '', '', '', '', '6.00', NULL, 1, NULL, '', '50.00', '44.00', '', NULL, NULL, NULL),
(15, '2016-07-28 23:29:36', 18, 1, NULL, 'cash', '', '', '', '', '', '', '11.00', NULL, 4, NULL, '', '20.00', '9.00', '', NULL, NULL, NULL),
(16, '2016-07-29 00:57:49', 20, 2, NULL, 'cash', '', '', '', '', '', '', '4.00', NULL, 4, NULL, '', '10.00', '6.00', '', NULL, NULL, NULL),
(17, '2016-07-29 22:02:02', 21, 2, NULL, 'cash', '', '', '', '', '', '', '6.00', NULL, 4, NULL, '', '10.00', '4.00', '', NULL, NULL, NULL),
(18, '2016-07-29 22:02:25', 22, 1, NULL, 'cash', '', '', '', '', '', '', '3.00', NULL, 4, NULL, '', '5.00', '2.00', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tec_products`
--

CREATE TABLE `tec_products` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` char(255) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '1',
  `price` decimal(25,2) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.png',
  `tax` varchar(20) DEFAULT NULL,
  `cost` decimal(25,2) DEFAULT NULL,
  `tax_method` tinyint(1) DEFAULT '1',
  `quantity` decimal(15,2) DEFAULT '0.00',
  `barcode_symbology` varchar(20) NOT NULL DEFAULT 'code39',
  `type` varchar(20) NOT NULL DEFAULT 'standard',
  `details` text,
  `alert_quantity` decimal(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tec_products`
--

INSERT INTO `tec_products` (`id`, `code`, `name`, `category_id`, `price`, `image`, `tax`, `cost`, `tax_method`, `quantity`, `barcode_symbology`, `type`, `details`, `alert_quantity`) VALUES
(1, '0001', 'Hamburquer', 2, '2.00', '99ba81363ddbfe5a92c93023e1fd550a.jpg', '0', '4.00', 0, '4.00', 'code39', 'standard', 'Hamburguer com P?o de Hamburguer, queijo, carne, presunto e salada', '5.00'),
(2, '0002', 'Mixto Quente', 2, '1.00', '3ba18844e23b27e8224f8fa6b1752208.jpg', '0', '3.00', 0, '5.00', 'code39', 'standard', '', '5.00'),
(3, '0003', 'Cahorro Quente', 2, '2.00', '573bc5101fabefd864960416b1752899.jpg', '0', '3.00', 0, '6.00', 'code39', 'standard', '', '5.00'),
(4, '0004', 'Bolo de Chocolate', 2, '2.00', '8ad58758122f3a886e859def53da6a6a.jpg', '0', '3.00', 0, '9.00', 'code39', 'standard', '', '5.00'),
(5, '0005', 'Coxinha de Frango', 2, '2.00', 'd3115abf501ce492bdf449f72f185fb1.jpg', '0', '3.00', 0, '10.00', 'code39', 'standard', '', '5.00'),
(6, '0006', 'Empada', 2, '2.00', '76fed631b7861010869172aa83d78e0a.jpg', '0', '3.00', 0, '19.00', 'code39', 'standard', '', '5.00'),
(7, '0007', 'Monteiro Lopes', 2, '2.00', '3274477f5b7d3ef257c4562c56ef387e.jpg', '0', '3.00', 0, '10.00', 'code39', 'standard', '', '5.00'),
(8, '0008', 'Risole de Carne', 2, '2.00', '32a3ac97716a9dc68812aecbaf11840a.jpg', '0', '4.00', 0, '7.00', 'code39', 'standard', '', '5.00'),
(9, '0009', 'Coxinha de Caranguejo', 2, '4.00', '8bd5b89b645b1bc2d4d08816b5ad3d0b.jpg', '0', '6.00', 0, '7.00', 'code39', 'standard', '', '5.00'),
(10, '0010', 'Coxinha de Camar?o', 2, '4.00', '272825062f261b126f1996ed099b4b87.jpg', '0', '6.00', 0, '8.00', 'code39', 'standard', '', '5.00'),
(11, '0011', 'Sonho', 2, '2.00', '1f56837339171226e7e33eb0c5e8eae0.jpg', '0', '3.00', 0, '8.00', 'code39', 'standard', '', '5.00'),
(12, '0012', 'Lasanha', 2, '6.00', 'fd1c25461a5fbb0597c68bb78100c6ec.jpg', '0', '9.00', 0, '10.00', 'code39', 'standard', '', '5.00'),
(13, '0013', 'Torta de Chocolate', 2, '3.00', '11fcdf61a2d8c2d6b7c3e9c0a6996a54.jpg', '0', '6.00', 0, '10.00', 'code39', 'standard', '', '5.00'),
(14, '0014', 'Fanta Laranja Lata', 1, '2.00', 'f0ed23add960528f5da95d8fb2a8a106.jpg', '0', '4.00', 0, '11.00', 'code39', 'standard', '', '5.00'),
(15, '0015', 'Coca-Cola Lata', 1, '2.00', 'd1ae8344e2fdfc3fcd80a96bb1f00240.jpg', '0', '4.00', 0, '7.00', 'code39', 'standard', '', '5.00'),
(16, '0016', '?gua Mineral', 1, '2.00', '91b3bcff369f45e167c3544bad752912.jpg', '0', '3.00', 0, '9.00', 'code39', 'standard', '', '5.00'),
(17, '0017', 'Suco de Laranja', 1, '4.00', 'f4cab501731cb47389a6c1a9a54cf736.jpg', '0', '6.00', 0, '6.00', 'code39', 'standard', '', '5.00'),
(18, '01', 'Combo M', 2, '10.99', 'no_image.png', '5', '8.71', 0, '0.00', 'code39', 'combo', '', '0.00'),
(19, '02', 'Batata M', 2, '7.99', 'no_image.png', '0', '4.72', 0, '0.00', 'code39', 'standard', '', '0.00'),
(20, '03', 'Cobertura Cheddar', 2, '1.00', 'no_image.png', '0', '0.27', 0, '0.00', 'code39', 'standard', '', '0.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tec_purchases`
--

CREATE TABLE `tec_purchases` (
  `id` int(11) NOT NULL,
  `reference` varchar(55) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note` varchar(1000) NOT NULL,
  `total` decimal(25,2) NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `received` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tec_purchases`
--

INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `attachment`, `supplier_id`, `received`) VALUES
(1, '', '2015-11-02 13:51:00', '', '30.00', NULL, NULL, NULL),
(2, '', '2016-01-25 23:19:00', '', '40.00', NULL, NULL, NULL),
(3, '', '2016-01-26 00:09:00', '', '40.00', NULL, NULL, NULL),
(4, '', '2016-07-28 23:40:00', '', '40.00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tec_purchase_items`
--

CREATE TABLE `tec_purchase_items` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` decimal(15,2) NOT NULL,
  `cost` decimal(25,2) NOT NULL,
  `subtotal` decimal(25,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tec_purchase_items`
--

INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `subtotal`) VALUES
(1, 1, 6, '10.00', '3.00', '30.00'),
(2, 2, 14, '10.00', '4.00', '40.00'),
(3, 3, 1, '10.00', '4.00', '40.00'),
(4, 4, 1, '5.00', '4.00', '20.00'),
(5, 4, 15, '5.00', '4.00', '20.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tec_registers`
--

CREATE TABLE `tec_registers` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `cash_in_hand` decimal(25,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  `total_cash` decimal(25,2) DEFAULT NULL,
  `total_cheques` int(11) DEFAULT NULL,
  `total_cc_slips` int(11) DEFAULT NULL,
  `total_cash_submitted` decimal(25,2) DEFAULT NULL,
  `total_cheques_submitted` int(11) DEFAULT NULL,
  `total_cc_slips_submitted` int(11) DEFAULT NULL,
  `note` text,
  `closed_at` timestamp NULL DEFAULT NULL,
  `transfer_opened_bills` varchar(50) DEFAULT NULL,
  `closed_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tec_registers`
--

INSERT INTO `tec_registers` (`id`, `date`, `user_id`, `cash_in_hand`, `status`, `total_cash`, `total_cheques`, `total_cc_slips`, `total_cash_submitted`, `total_cheques_submitted`, `total_cc_slips_submitted`, `note`, `closed_at`, `transfer_opened_bills`, `closed_by`) VALUES
(1, '2015-11-02 12:39:22', 1, '0.00', 'close', '0.00', 0, 1, '0.00', 0, 1, '', '2015-11-02 13:49:29', NULL, 1),
(2, '2015-11-02 14:00:24', 1, '0.00', 'close', '36.00', 0, 0, '36.00', 0, 0, '', '2016-01-25 23:11:28', NULL, 1),
(3, '2015-12-12 18:59:48', 2, '50.00', 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '2016-01-25 23:12:25', 1, '0.00', 'close', '2.00', 0, 0, '2.00', 0, 0, '', '2016-01-25 23:28:28', '0', 1),
(5, '2016-01-25 23:46:53', 1, '0.00', 'close', '0.00', 0, 0, '0.00', 0, 0, '', '2016-01-25 23:48:44', NULL, 1),
(6, '2016-01-25 23:50:22', 1, '100.00', 'close', '110.00', 0, 0, '110.00', 0, 0, '', '2016-01-25 23:56:02', NULL, 1),
(7, '2016-01-25 23:59:31', 1, '100.00', 'close', '104.00', 0, 0, '104.00', 0, 0, '', '2016-01-26 00:01:16', NULL, 1),
(8, '2016-01-26 00:01:58', 1, '100.00', 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '2016-07-27 05:43:25', 4, '2000.00', 'close', '2000.00', 0, 0, '2000.00', 0, 0, '', '2016-07-27 15:02:30', NULL, 4),
(10, '2016-07-28 01:02:46', 4, '2000.00', 'close', '2011.00', 0, 0, '2011.00', 0, 5, '', '2016-07-28 23:46:15', NULL, 4),
(11, '2016-07-28 23:53:09', 4, '873.00', 'close', '877.00', 0, 0, '877.00', 0, 0, '', '2016-07-29 00:58:03', NULL, 4),
(12, '2016-07-29 21:56:50', 4, '800.00', 'close', '809.00', 0, 0, '809.00', 0, 0, '', '2016-07-29 22:02:39', NULL, 4),
(13, '2016-08-02 02:33:49', 4, '200.00', 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tec_sales`
--

CREATE TABLE `tec_sales` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(55) NOT NULL,
  `total` decimal(25,2) NOT NULL,
  `product_discount` decimal(25,2) DEFAULT NULL,
  `order_discount_id` varchar(20) DEFAULT NULL,
  `order_discount` decimal(25,2) DEFAULT NULL,
  `total_discount` decimal(25,2) DEFAULT NULL,
  `product_tax` decimal(25,2) DEFAULT NULL,
  `order_tax_id` varchar(20) DEFAULT NULL,
  `order_tax` decimal(25,2) DEFAULT NULL,
  `total_tax` decimal(25,2) DEFAULT NULL,
  `grand_total` decimal(25,2) NOT NULL,
  `total_items` int(11) DEFAULT NULL,
  `total_quantity` decimal(15,2) DEFAULT NULL,
  `paid` decimal(25,2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `rounding` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tec_sales`
--

INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`) VALUES
(1, '2015-11-02 11:42:47', 1, 'Cliente Padr?o', '4.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '4.00', 2, '2.00', '4.00', 1, 1, '2015-11-02 11:47:25', '', 'paid', '0.00'),
(2, '2015-11-03 10:43:13', 1, 'Cliente Padr?o', '16.00', '0.00', NULL, '0.00', '0.00', '0.00', '0%', '0.00', '0.00', '16.00', 5, '6.00', '16.00', 1, NULL, NULL, '', 'paid', '0.00'),
(3, '2015-12-12 17:08:16', 1, 'Cliente Padr?o', '10.47', '0.00', NULL, '0.00', '0.00', '0.52', '0%', '0.00', '0.52', '10.99', 1, '1.00', '0.00', 2, NULL, NULL, '', 'due', '0.00'),
(4, '2015-12-12 17:10:09', 1, 'Cliente Padr?o', '10.99', '0.00', NULL, '0.00', '0.00', '0.00', '0%', '0.00', '0.00', '10.99', 3, '3.00', '10.99', 2, NULL, NULL, '', 'paid', '0.00'),
(5, '2015-12-12 17:13:40', 1, 'Cliente Padr?o', '31.41', '0.00', NULL, '0.00', '0.00', '1.56', '0%', '0.00', '1.56', '32.97', 1, '3.00', '32.97', 2, NULL, NULL, '', 'paid', '0.00'),
(6, '2016-01-22 15:29:59', 1, 'Cliente Padr?o', '20.00', '0.00', NULL, '0.00', '0.00', '0.00', '0%', '0.00', '0.00', '20.00', 6, '8.00', '20.00', 1, NULL, NULL, '', 'paid', '0.00'),
(7, '2016-01-25 21:15:47', 1, 'Cliente Padr?o', '4.00', '0.00', NULL, '0.00', '0.00', '0.00', '0%', '0.00', '0.00', '4.00', 2, '2.00', '4.00', 1, NULL, NULL, '', 'paid', '0.00'),
(8, '2016-01-25 21:50:55', 1, 'Cliente Padr?o', '4.00', '0.00', NULL, '0.00', '0.00', '0.00', '0%', '0.00', '0.00', '4.00', 2, '2.00', '4.00', 1, NULL, NULL, '', 'paid', '0.00'),
(9, '2016-01-25 21:52:35', 1, 'Cliente Padr?o', '6.00', '0.00', NULL, '0.00', '0.00', '0.00', '0%', '0.00', '0.00', '6.00', 3, '3.00', '6.00', 1, NULL, NULL, '', 'paid', '0.00'),
(10, '2016-01-25 21:54:16', 1, 'Cliente Padr?o', '6.00', '0.00', NULL, '0.00', '0.00', '0.00', '0%', '0.00', '0.00', '6.00', 3, '3.00', '6.00', 1, NULL, NULL, '', 'paid', '0.00'),
(11, '2016-01-25 22:00:29', 1, 'Cliente Padr?o', '4.00', '0.00', NULL, '0.00', '0.00', '0.00', '0%', '0.00', '0.00', '4.00', 2, '2.00', '4.00', 1, NULL, NULL, '', 'paid', '0.00'),
(12, '2016-01-25 22:02:46', 1, 'Cliente Padr?o', '7.00', '0.00', NULL, '0.00', '0.00', '0.00', '0%', '0.00', '0.00', '7.00', 3, '3.00', '7.00', 1, NULL, NULL, '', 'paid', '0.00'),
(13, '2016-01-25 22:04:10', 1, 'Cliente Padr?o', '2.00', '0.00', NULL, '0.00', '0.00', '0.00', '0%', '0.00', '0.00', '2.00', 1, '1.00', '2.00', 1, NULL, NULL, '', 'paid', '0.00'),
(14, '2016-01-25 22:04:47', 1, 'Cliente Padr?o', '8.00', '0.00', NULL, '0.00', '0.00', '0.00', '0%', '0.00', '0.00', '8.00', 3, '3.00', '8.00', 1, NULL, NULL, '', 'paid', '0.00'),
(15, '2016-01-25 22:11:13', 1, 'Cliente Padr?o', '24.00', '0.00', NULL, '0.00', '0.00', '0.00', '0%', '0.00', '0.00', '24.00', 1, '12.00', '24.00', 1, NULL, NULL, '', 'paid', '0.00'),
(16, '2016-02-01 02:03:58', 1, 'Cliente Padr?o', '6.00', '0.00', NULL, '0.00', '0.00', '0.00', '0%', '0.00', '0.00', '6.00', 2, '2.00', '6.00', 1, NULL, NULL, '', 'paid', '0.00'),
(17, '2016-07-27 02:48:14', 1, 'Cliente Padr?o', '3.00', '0.00', NULL, '0.00', '0.00', '0.00', '0%', '0.00', '0.00', '3.00', 2, '2.00', '0.00', 4, NULL, NULL, '', 'due', '0.00'),
(18, '2016-07-28 20:29:36', 1, 'Cliente Padr?o', '11.00', '0.00', NULL, '0.00', '0.00', '0.00', '0%', '0.00', '0.00', '11.00', 3, '5.00', '11.00', 4, NULL, NULL, '', 'paid', '0.00'),
(19, '2016-07-28 20:37:34', 2, 'Mesa 01', '5.00', '0.00', NULL, '0.00', '0.00', '0.00', '0%', '0.00', '0.00', '5.00', 3, '3.00', '0.00', 4, NULL, NULL, '', 'due', '0.00'),
(20, '2016-07-28 21:57:49', 2, 'Mesa 01', '4.00', '0.00', NULL, '0.00', '0.00', '0.00', '0%', '0.00', '0.00', '4.00', 2, '2.00', '4.00', 4, NULL, NULL, '', 'paid', '0.00'),
(21, '2016-07-29 19:02:02', 2, 'Mesa 01', '6.00', '0.00', NULL, '0.00', '0.00', '0.00', '0%', '0.00', '0.00', '6.00', 2, '2.00', '6.00', 4, NULL, NULL, '', 'paid', '0.00'),
(22, '2016-07-29 19:02:25', 1, 'Cliente Padr?o', '3.00', '0.00', NULL, '0.00', '0.00', '0.00', '0%', '0.00', '0.00', '3.00', 2, '2.00', '3.00', 4, NULL, NULL, '', 'paid', '0.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tec_sale_items`
--

CREATE TABLE `tec_sale_items` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` decimal(15,2) NOT NULL,
  `unit_price` decimal(25,2) NOT NULL,
  `net_unit_price` decimal(25,2) NOT NULL,
  `discount` varchar(20) DEFAULT NULL,
  `item_discount` decimal(25,2) DEFAULT NULL,
  `tax` int(20) DEFAULT NULL,
  `item_tax` decimal(25,2) DEFAULT NULL,
  `subtotal` decimal(25,2) NOT NULL,
  `real_unit_price` decimal(25,2) DEFAULT NULL,
  `cost` decimal(25,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tec_sale_items`
--

INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`) VALUES
(3, 1, 1, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(4, 1, 15, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(5, 2, 1, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(6, 2, 3, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '3.00'),
(7, 2, 9, '2.00', '4.00', '4.00', '0', '0.00', 0, '0.00', '8.00', '4.00', '6.00'),
(8, 2, 14, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(9, 2, 15, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(10, 3, 18, '1.00', '10.99', '10.47', '0', '0.00', 5, '0.52', '10.99', '10.99', '8.71'),
(11, 4, 15, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(12, 4, 19, '1.00', '7.99', '7.99', '0', '0.00', 0, '0.00', '7.99', '7.99', '4.72'),
(13, 4, 20, '1.00', '1.00', '1.00', '0', '0.00', 0, '0.00', '1.00', '1.00', '0.27'),
(14, 5, 18, '3.00', '10.99', '10.47', '0', '0.00', 5, '1.56', '32.97', '10.99', '8.71'),
(15, 6, 6, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '3.00'),
(16, 6, 10, '1.00', '4.00', '4.00', '0', '0.00', 0, '0.00', '4.00', '4.00', '6.00'),
(17, 6, 11, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '3.00'),
(18, 6, 14, '2.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '4.00', '2.00', '4.00'),
(19, 6, 15, '2.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '4.00', '2.00', '4.00'),
(20, 6, 17, '1.00', '4.00', '4.00', '0', '0.00', 0, '0.00', '4.00', '4.00', '6.00'),
(21, 7, 1, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(22, 7, 14, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(23, 8, 1, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(24, 8, 14, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(25, 9, 4, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '3.00'),
(26, 9, 8, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(27, 9, 14, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(28, 10, 8, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(29, 10, 11, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '3.00'),
(30, 10, 14, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(31, 11, 3, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '3.00'),
(32, 11, 15, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(33, 12, 1, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(34, 12, 2, '1.00', '1.00', '1.00', '0', '0.00', 0, '0.00', '1.00', '1.00', '3.00'),
(35, 12, 17, '1.00', '4.00', '4.00', '0', '0.00', 0, '0.00', '4.00', '4.00', '6.00'),
(36, 13, 14, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(37, 14, 10, '1.00', '4.00', '4.00', '0', '0.00', 0, '0.00', '4.00', '4.00', '6.00'),
(38, 14, 14, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(39, 14, 15, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(40, 15, 1, '12.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '24.00', '2.00', '4.00'),
(41, 16, 16, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '3.00'),
(42, 16, 17, '1.00', '4.00', '4.00', '0', '0.00', 0, '0.00', '4.00', '4.00', '6.00'),
(43, 17, 2, '1.00', '1.00', '1.00', '0', '0.00', 0, '0.00', '1.00', '1.00', '3.00'),
(44, 17, 15, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(45, 18, 1, '3.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '6.00', '2.00', '4.00'),
(46, 18, 2, '1.00', '1.00', '1.00', '0', '0.00', 0, '0.00', '1.00', '1.00', '3.00'),
(47, 18, 17, '1.00', '4.00', '4.00', '0', '0.00', 0, '0.00', '4.00', '4.00', '6.00'),
(48, 19, 2, '1.00', '1.00', '1.00', '0', '0.00', 0, '0.00', '1.00', '1.00', '3.00'),
(49, 19, 3, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '3.00'),
(50, 19, 15, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(51, 20, 3, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '3.00'),
(52, 20, 15, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(53, 21, 8, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(54, 21, 9, '1.00', '4.00', '4.00', '0', '0.00', 0, '0.00', '4.00', '4.00', '6.00'),
(55, 22, 1, '1.00', '2.00', '2.00', '0', '0.00', 0, '0.00', '2.00', '2.00', '4.00'),
(56, 22, 2, '1.00', '1.00', '1.00', '0', '0.00', 0, '0.00', '1.00', '1.00', '3.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tec_sessions`
--

CREATE TABLE `tec_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tec_sessions`
--

INSERT INTO `tec_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('00f68d8b6f7151d9d406d867418a51d4ec2aa069', '187.114.90.84', 1449951378, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434393935313337383b),
('01b4a62755088fe5d973e7a803217a20cd0e6fcd', '::1', 1469742133, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393734323133333b),
('03c5e731cd4adc7fad63c68cf410b6894aca8ec0', '64.233.172.188', 1453461794, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333436313739343b),
('06afb26ff126da0a52fdb91e5483502cee356009', '177.172.16.222', 1453475153, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333437343835333b6572726f727c733a34363a223c703e4c6f67696e2066616c686f752c20706f72206661766f722074656e7465206e6f76616d656e74653c2f703e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226f6c64223b7d),
('0785a270fe3f48fcb23a4eb9281546caf7b51fd5', '189.89.250.194', 1453487527, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333438373337393b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343533343735313736223b6c6173745f69707c733a31343a223137372e3137322e31362e323232223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2232223b636173685f696e5f68616e647c733a343a22302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31312d30322031323a30303a3234223b),
('09019c8867420bbc7b6aedca34bb6099c4c8e16c', '::1', 1470081506, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303038313530363b),
('0af730637fc362e6119623d65ebed7ee63544d64', '192.168.1.104', 1470161596, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303136313533363b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343730313133373638223b6c6173745f69707c733a31333a223139322e3136382e312e313031223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223133223b636173685f696e5f68616e647c733a363a223230302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30382d30312032333a33333a3439223b),
('0d48d6bb486e3658e96999772acd1f6f1dc27046', '192.168.1.104', 1469753822, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393735313233303b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639363730313436223b6c6173745f69707c733a31333a223139322e3136382e312e313031223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223131223b636173685f696e5f68616e647c733a363a223837332e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32382032303a35333a3039223b),
('0da9d997fd33fc2fe5fbc0d457d5ae80db45dfb3', '177.172.16.222', 1453474471, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333437343437313b),
('0dd856afee15c64338efde7af842946a1030c769', '192.168.1.101', 1469667808, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393636373533343b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639363637343837223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223130223b636173685f696e5f68616e647c733a373a22323030302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32372032323a30323a3436223b),
('11994d284f2fb544a99ef7bcc1ce12c786323cc0', '179.100.136.77', 1453767695, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333736373430323b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343533373637303730223b6c6173745f69707c733a31343a223137392e3130302e3133362e3737223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2234223b636173685f696e5f68616e647c733a343a22302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30312d32352032313a31323a3235223b),
('12090d682be72ec3659b2d1db1edb3d1d0c79f92', '192.168.1.104', 1469747163, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393734363432313b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639363730313436223b6c6173745f69707c733a31333a223139322e3136382e312e313031223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223130223b636173685f696e5f68616e647c733a373a22323030302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32372032323a30323a3436223b),
('18c5ee35072654ed85d613b2249d1f334d75c4ee', '192.168.1.104', 1470165580, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303136343836353b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343730313133373638223b6c6173745f69707c733a31333a223139322e3136382e312e313031223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223133223b636173685f696e5f68616e647c733a363a223230302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30382d30312032333a33333a3439223b),
('18f8a7591c05712c502b1bcf8bee46eabd8b5ed0', '177.172.16.222', 1453503106, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333530323838373b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343533343837333833223b6c6173745f69707c733a31343a223138392e38392e3235302e313934223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2232223b636173685f696e5f68616e647c733a343a22302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31312d30322031323a30303a3234223b),
('1cbeb6c792a29c5b8f9330ebf2d830a41ba84a06', '66.249.88.64', 1453645181, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333634353138303b),
('1d8b214f94328dbd382fe52bd55c602f6c100c7a', '::1', 1469632968, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393633323734333b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639353938313838223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2239223b636173685f696e5f68616e647c733a373a22323030302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32372030323a34333a3235223b),
('22b13af289b2934fba02f946eeb4276349f7bce3', '::1', 1469596526, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393539363337303b6964656e746974797c733a33333a22706f6e746f6469676974616c70726f6772616d617340686f746d61696c2e636f6d223b757365726e616d657c733a383a2276656e6465646f72223b656d61696c7c733a33333a22706f6e746f6469676974616c70726f6772616d617340686f746d61696c2e636f6d223b757365725f69647c733a313a2232223b66697273745f6e616d657c733a383a2276656e6465646f72223b6c6173745f6e616d657c733a333a22706476223b637265617465645f6f6e7c733a32323a2231322f31322f323031352031323a33393a323720414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343534333032373334223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b6d6573736167657c733a34323a223c703e4c6f6761646f20636f6d207375636573736f212053656a612042656d2056696e646f213c2f703e223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d72656769737465725f69647c733a313a2233223b636173685f696e5f68616e647c733a353a2235302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31322d31322031363a35393a3438223b),
('2300f17093fc4f849750aa8bb1e4fbb64ef41a55', '::1', 1469667576, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393636373537363b),
('247a69a9317f4389f6f0a73ec79f5af4a7d7e14d', '177.172.143.116', 1447542692, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434373534323639313b),
('276040840daa2701e2ded19e41b1bd2fe9554ce5', '::1', 1469598557, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393539383439343b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639353938313635223b6c6173745f69707c4e3b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2232223b72656769737465725f69647c733a313a2239223b636173685f696e5f68616e647c733a373a22323030302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32372030323a34333a3235223b),
('28ba0813a82ed66cb240675bcb5429084143a4d4', '192.168.1.104', 1469749535, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393734393137303b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639363730313436223b6c6173745f69707c733a31333a223139322e3136382e312e313031223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223130223b636173685f696e5f68616e647c733a373a22323030302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32372032323a30323a3436223b),
('2923348fab8fec00bbc881224ab406910df074fa', '192.168.1.104', 1470084483, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303038343336323b),
('2a9ff54aaded7c212bfd44bf3f1aa72ca1b63287', '192.168.1.104', 1470112045, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303131323030353b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343730303837313831223b6c6173745f69707c733a31333a223139322e3136382e312e313034223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223133223b636173685f696e5f68616e647c733a363a223230302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30382d30312032333a33333a3439223b),
('2b23394bb307403651ff430ac2973ae515ce9fc6', '::1', 1470105140, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303130353134303b),
('2b24c2edf8d6cb72b56b723d78f8105002ab8a55', '191.207.159.177', 1446503609, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434363530333438303b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343436353033343336223b6c6173745f69707c733a31353a223139312e3230372e3135392e313737223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2232223b636173685f696e5f68616e647c733a343a22302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31312d30322031323a30303a3234223b),
('2b60e3b52c0bd05ff5190136b1e3dee2ad8f8bc8', '179.100.136.77', 1453770688, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333737303339363b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343533373639393538223b6c6173745f69707c733a31343a223137392e3130302e3133362e3737223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2238223b636173685f696e5f68616e647c733a363a223130302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30312d32352032323a30313a3538223b),
('2c1c8c7a3a36a5a00c257e4aae8b2eff2ed5ac90', '192.168.1.101', 1469670318, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393637303331383b),
('2cea8c26b8b16a0917b5c9a89c008ed527f72c1a', '192.168.1.106', 1469829777, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393832393737363b),
('334eb64fb62a8bfebab5c8bd3390c59af1b55493', '192.168.1.104', 1469748789, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393734383433353b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639363730313436223b6c6173745f69707c733a31333a223139322e3136382e312e313031223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223130223b636173685f696e5f68616e647c733a373a22323030302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32372032323a30323a3436223b),
('3639fdbbe73657d3d21c1ad1510385868c91bb91', '186.216.191.145', 1452090124, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435323038393836303b6572726f727c733a34363a223c703e4c6f67696e2066616c686f752c20706f72206661766f722074656e7465206e6f76616d656e74653c2f703e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226f6c64223b7d),
('3764cea7cd6a04538f6e4dd074e0d20a5a254bca', '::1', 1469599251, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393539393031363b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639353938313635223b6c6173745f69707c4e3b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2232223b72656769737465725f69647c733a313a2239223b636173685f696e5f68616e647c733a373a22323030302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32372030323a34333a3235223b),
('38c01bedfdef87cf0a5f177643de38bce733894c', '::1', 1469597297, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393539373239303b6964656e746974797c733a33333a22706f6e746f6469676974616c70726f6772616d617340686f746d61696c2e636f6d223b757365726e616d657c733a383a2276656e6465646f72223b656d61696c7c733a33333a22706f6e746f6469676974616c70726f6772616d617340686f746d61696c2e636f6d223b757365725f69647c733a313a2232223b66697273745f6e616d657c733a383a2276656e6465646f72223b6c6173745f6e616d657c733a333a22706476223b637265617465645f6f6e7c733a32323a2231322f31322f323031352031323a33393a323720414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639353936353235223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2233223b636173685f696e5f68616e647c733a353a2235302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31322d31322031363a35393a3438223b),
('3bb860a389d0ba5d8bacfc66f2a5f8354ca2b13e', '187.114.90.84', 1449953423, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434393935333239323b),
('41e263c4addf5ceb349e5ba2119182741c1239da', '::1', 1454302418, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435343330323231343b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343533373730303939223b6c6173745f69707c733a31343a223137392e3130302e3133362e3737223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2238223b636173685f696e5f68616e647c733a363a223130302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30312d32352032313a30313a3538223b),
('423dc3da67788653a8df85656cf862e914d588b8', '191.195.250.33', 1453763737, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333736333630393b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343533353033303732223b6c6173745f69707c733a31343a223137372e3137322e31362e323232223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b6d6573736167657c733a34323a223c703e4c6f6761646f20636f6d207375636573736f212053656a612042656d2056696e646f213c2f703e223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d72656769737465725f69647c733a313a2232223b636173685f696e5f68616e647c733a343a22302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31312d30322031323a30303a3234223b),
('439fa5ad5933e31d8542d96b715296c41b497593', '192.168.1.105', 1469596675, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393539363635363b),
('44adb057d306fc201e2cbca5af12174888a42ba3', '177.145.5.115', 1447274438, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434373237343236303b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343436353534303834223b6c6173745f69707c733a31343a223138392e38392e3235302e313934223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2232223b636173685f696e5f68616e647c733a343a22302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31312d30322031323a30303a3234223b),
('49ee8d0630b0dd49535a44aff34a6be6a3904020', '192.168.1.104', 1469750528, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393735303532373b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639363730313436223b6c6173745f69707c733a31333a223139322e3136382e312e313031223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223131223b636173685f696e5f68616e647c733a363a223837332e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32382032303a35333a3039223b6d6573736167657c733a34343a22c3937264656d2073616c766120636f6d207375636573736f207061726120636f6e7461732061626572746173223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d),
('4c610605667f9f238a262b71a8c1869f72861ee6', '::1', 1446488811, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434363438383831313b),
('4d0ac1f538e6b79acfd01071b7a2d4841dcd3be5', '192.168.1.104', 1470115312, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303131353032383b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343730303837313831223b6c6173745f69707c733a31333a223139322e3136382e312e313034223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223133223b636173685f696e5f68616e647c733a363a223230302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30382d30312032333a33333a3439223b),
('4f51916130c80bd53e09ef8695792f6e766dd10b', '192.168.1.104', 1469750510, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393734393838373b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639363730313436223b6c6173745f69707c733a31333a223139322e3136382e312e313031223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223131223b636173685f696e5f68616e647c733a363a223837332e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32382032303a35333a3039223b),
('4f942bdb42e03d57ce0481b2de4fdfc8c7af99aa', '179.100.136.77', 1453767388, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333736373039373b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343533373637303730223b6c6173745f69707c733a31343a223137392e3130302e3133362e3737223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2234223b636173685f696e5f68616e647c733a343a22302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30312d32352032313a31323a3235223b),
('52101e41d9de112ed198e69899beee6fbe089f4c', '179.100.136.77', 1453768109, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333736383030383b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343533373637303730223b6c6173745f69707c733a31343a223137392e3130302e3133362e3737223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2234223b636173685f696e5f68616e647c733a343a22302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30312d32352032313a31323a3235223b6d6573736167657c733a33303a2252656769737472652d7365206665636861646120636f6d20c3aa7869746f223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d),
('527f2089edf0bd9d7941a11b3b0b180120338b77', '189.89.250.194', 1446554154, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434363535333831353b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343436353033343832223b6c6173745f69707c733a31353a223139312e3230372e3135392e313737223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2232223b636173685f696e5f68616e647c733a343a22302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31312d30322031323a30303a3234223b),
('530e65a6830b13560758b5893f172fdd3be1569f', '179.100.136.77', 1453770373, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333737303038323b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343533373639393538223b6c6173745f69707c733a31343a223137392e3130302e3133362e3737223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2238223b636173685f696e5f68616e647c733a363a223130302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30312d32352032323a30313a3538223b),
('54647aa7c6cba6ab42c1827fe32d191574c7c63c', '189.89.250.194', 1452952576, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435323935323537353b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343439383931343733223b6c6173745f69707c733a31353a223138372e3131362e3233312e313231223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b6d6573736167657c733a34323a223c703e4c6f6761646f20636f6d207375636573736f212053656a612042656d2056696e646f213c2f703e223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d72656769737465725f69647c733a313a2232223b636173685f696e5f68616e647c733a343a22302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31312d30322031323a30303a3234223b),
('55362c0255086cc7ebc93b22bfc663c454de427e', '192.168.1.104', 1469753887, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393735333838373b),
('567eaa2b608ad65022318d709e017ac282cb6b30', '::1', 1469829369, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393832393231353b),
('583f794faca66abb467fd07b8a66e094394ec5c1', '200.222.21.138', 1448448325, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434383434383239363b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343437323734333236223b6c6173745f69707c733a31333a223137372e3134352e352e313135223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2232223b636173685f696e5f68616e647c733a343a22302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31312d30322031323a30303a3234223b),
('5a4346efd711084acc991cacd28597d321b43163', '177.172.16.222', 1453475228, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333437353137363b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343533343733383636223b6c6173745f69707c733a31343a223138392e38392e3235302e313934223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2232223b636173685f696e5f68616e647c733a343a22302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31312d30322031323a30303a3234223b),
('5adb818b92f1e029611928d0ecd9ad8ad71762ef', '192.168.1.104', 1470108635, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303130383633353b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343730303837313831223b6c6173745f69707c733a31333a223139322e3136382e312e313034223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223133223b636173685f696e5f68616e647c733a363a223230302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30382d30312032333a33333a3439223b),
('5b68cf26db41e25e832df2e04e3c36a57997a694', '192.168.1.104', 1470163414, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303136333038383b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343730313133373638223b6c6173745f69707c733a31333a223139322e3136382e312e313031223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223133223b636173685f696e5f68616e647c733a363a223230302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30382d30312032333a33333a3439223b),
('5c225682da29f68de124f7dad6e3db46c5be6b96', '179.100.136.77', 1453770069, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333736393736363b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343533373639333936223b6c6173745f69707c733a31343a223137392e3130302e3133362e3737223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2237223b636173685f696e5f68616e647c733a363a223130302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30312d32352032313a35393a3331223b),
('5f5a3da64878d36908ef7b140349eaa57cc5dfb0', '66.249.88.80', 1453719250, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333731393234393b),
('611a668a08243ae7ecb562877e044f22e4330503', '192.168.1.104', 1470111664, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303131313636323b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343730303837313831223b6c6173745f69707c733a31333a223139322e3136382e312e313034223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223133223b636173685f696e5f68616e647c733a363a223230302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30382d30312032333a33333a3439223b),
('615d9a51d46b1d42a772b51a838eee227559871e', '192.168.1.104', 1469745862, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393734353734313b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639363730313436223b6c6173745f69707c733a31333a223139322e3136382e312e313031223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223130223b636173685f696e5f68616e647c733a373a22323030302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32372032323a30323a3436223b),
('62d665e2785c968bd2cddb159d5173a7c7f44bbc', '186.216.191.145', 1452089860, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435323038393835393b),
('6829544b0c009def14fb30517fc39ca9e6310197', '192.168.1.104', 1469744987, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393734343937343b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639363730313436223b6c6173745f69707c733a31333a223139322e3136382e312e313031223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223130223b636173685f696e5f68616e647c733a373a22323030302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32372032323a30323a3436223b),
('6cf0f6bf80adccca6760a98e1ebfb50d7fe46991', '66.249.88.80', 1453491491, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333439313439313b),
('6d70abc2e06536eea2eb54ed175fe729123d1752', '192.168.1.104', 1470164311, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303136343331313b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343730313133373638223b6c6173745f69707c733a31333a223139322e3136382e312e313031223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223133223b636173685f696e5f68616e647c733a363a223230302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30382d30312032333a33333a3439223b),
('6debbdf5920ac12da60ed75954f2c72305fb5daf', '::1', 1469631798, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393633313539353b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639353938313838223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2239223b636173685f696e5f68616e647c733a373a22323030302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32372030323a34333a3235223b),
('700c9dcb5d11fd6623ae862cfb8b375f745f2d1f', '187.114.90.84', 1449950994, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434393935303634343b6964656e746974797c733a32333a227064764070647670617261746f646f732e636f6d2e6272223b757365726e616d657c733a383a2276656e6465646f72223b656d61696c7c733a32333a227064764070647670617261746f646f732e636f6d2e6272223b757365725f69647c733a313a2232223b66697273745f6e616d657c733a383a2276656e6465646f72223b6c6173745f6e616d657c733a333a22706476223b637265617465645f6f6e7c733a32323a2231322f31322f323031352031323a33393a323720414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343439383931353637223b6c6173745f69707c4e3b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2233223b636173685f696e5f68616e647c733a353a2235302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31322d31322031363a35393a3438223b),
('70cf62a7f7eaf7240a3c747f70cc0d2564fd5d95', '192.168.1.104', 1470107752, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303130373536323b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343730303837313831223b6c6173745f69707c733a31333a223139322e3136382e312e313034223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223133223b636173685f696e5f68616e647c733a363a223230302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30382d30312032333a33333a3439223b),
('75fea39fc6ff12f2b36ee20adb86b57f0adad3b6', '::1', 1470087175, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303038373137353b),
('7c8253d5adc86a9c6c339fe426fd4fdfb640c520', '192.168.1.104', 1470111295, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303131313234393b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343730303837313831223b6c6173745f69707c733a31333a223139322e3136382e312e313034223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223133223b636173685f696e5f68616e647c733a363a223230302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30382d30312032333a33333a3439223b),
('7f0bfe35b52aac98091c610d031c17a942f02c55', '192.168.1.104', 1470114599, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303131343531323b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343730303837313831223b6c6173745f69707c733a31333a223139322e3136382e312e313034223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223133223b636173685f696e5f68616e647c733a363a223230302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30382d30312032333a33333a3439223b),
('84bd298ac695682a2c448dc4b986ba345fbd3f49', '66.249.83.251', 1453461794, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333436313739343b),
('8c5aae0e4c69c2bd1454d9d8107e95ce72fd718c', '192.168.1.104', 1470115893, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303131353630383b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343730303837313831223b6c6173745f69707c733a31333a223139322e3136382e312e313034223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223133223b636173685f696e5f68616e647c733a363a223230302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30382d30312032333a33333a3439223b),
('8d3430d13b9f674130eefb6397457172104a5231', '189.89.250.194', 1453393336, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333339333332333b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343532393532353735223b6c6173745f69707c733a31343a223138392e38392e3235302e313934223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b6d6573736167657c733a34323a223c703e4c6f6761646f20636f6d207375636573736f212053656a612042656d2056696e646f213c2f703e223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d72656769737465725f69647c733a313a2232223b636173685f696e5f68616e647c733a343a22302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31312d30322031323a30303a3234223b),
('8ec8b4d9614978cf87ba70e893166906a4212bfa', '192.168.1.104', 1470081506, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303038313530363b),
('8fd31f62dcb3cdad78ce931c4ca63c5ba13f0c29', '189.89.250.194', 1446558403, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434363535383137383b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343436353033343832223b6c6173745f69707c733a31353a223139312e3230372e3135392e313737223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2232223b636173685f696e5f68616e647c733a343a22302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31312d30322031323a30303a3234223b);
INSERT INTO `tec_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('8ff6db0f5d4a4545cf0af41c48af41837e0fc908', '::1', 1469633126, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393633333132363b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639353938313838223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2239223b636173685f696e5f68616e647c733a373a22323030302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32372030323a34333a3235223b),
('94672a35c51a6cf3f98382aa8400c6d58c2b1db0', '::1', 1469597085, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393539363837353b6964656e746974797c733a33333a22706f6e746f6469676974616c70726f6772616d617340686f746d61696c2e636f6d223b757365726e616d657c733a383a2276656e6465646f72223b656d61696c7c733a33333a22706f6e746f6469676974616c70726f6772616d617340686f746d61696c2e636f6d223b757365725f69647c733a313a2232223b66697273745f6e616d657c733a383a2276656e6465646f72223b6c6173745f6e616d657c733a333a22706476223b637265617465645f6f6e7c733a32323a2231322f31322f323031352031323a33393a323720414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639353936353235223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2233223b636173685f696e5f68616e647c733a353a2235302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31322d31322031363a35393a3438223b),
('984977fecffad58393d5162f5747294a66ca890b', '192.168.1.101', 1469667935, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393636373933353b),
('9e6557d592bf93a695716fca1dc63d89796c6aa4', '179.100.136.77', 1453769685, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333736393338373b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343533373639333737223b6c6173745f69707c733a31343a223137392e3130302e3133362e3737223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2236223b636173685f696e5f68616e647c733a363a223130302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30312d32352032313a35303a3232223b),
('a2aaa9c663890a6209d52992cbb3a7ad609dfb65', '192.168.1.104', 1470105318, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303130353134313b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343730303837313831223b6c6173745f69707c733a31333a223139322e3136382e312e313034223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223133223b636173685f696e5f68616e647c733a363a223230302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30382d30312032333a33333a3439223b),
('a53981617cf38c31d70ffa13d898cdebfb13119e', '::1', 1454303129, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435343330323837343b6964656e746974797c733a33303a2274656d64657475646f70726f6772616d617340686f746d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a2274656d64657475646f70726f6772616d617340686f746d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a31313a2254656d206465205475646f223b6c6173745f6e616d657c733a393a2250726f6772616d6173223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343534333031353635223b6c6173745f69707c733a333a223a3a31223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2238223b636173685f696e5f68616e647c733a363a223130302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30312d32352032313a30313a3538223b726d73706f737c693a313b),
('a83f299dc4e174e212c32f1cb17fb1755fb77e21', '177.172.16.222', 1453503358, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333530333335383b),
('a949ff7a99d376bb2a10c9f1e5f4fd40e9d3d756', '187.116.231.121', 1449891567, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434393839313434363b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343438343438333035223b6c6173745f69707c733a31343a223230302e3232322e32312e313338223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2232223b636173685f696e5f68616e647c733a343a22302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31312d30322031323a30303a3234223b6d6573736167657c733a33313a223c703e436f6e74612063726961646120636f6d207375636573736f3c2f703e223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d),
('aba07d845e804c2db737814a26bc6f3606061607', '192.168.1.104', 1469744773, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393734343439393b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639363730313436223b6c6173745f69707c733a31333a223139322e3136382e312e313031223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223130223b636173685f696e5f68616e647c733a373a22323030302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32372032323a30323a3436223b),
('af682934af71ed0203fa566818595cde4b329dbc', '189.89.250.194', 1453403227, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333430333231313b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343533333933333336223b6c6173745f69707c733a31343a223138392e38392e3235302e313934223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2232223b636173685f696e5f68616e647c733a343a22302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31312d30322031323a30303a3234223b),
('b06b1120392a9bea857854ad2909de42863643d5', '192.168.1.104', 1469745580, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393734353433343b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639363730313436223b6c6173745f69707c733a31333a223139322e3136382e312e313031223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223130223b636173685f696e5f68616e647c733a373a22323030302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32372032323a30323a3436223b),
('b1665a936c178e59c716e33c87172e37c3eace69', '192.168.1.104', 1469742200, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393734323133333b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639363730313436223b6c6173745f69707c733a31333a223139322e3136382e312e313031223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b6d6573736167657c733a34323a223c703e4c6f6761646f20636f6d207375636573736f212053656a612042656d2056696e646f213c2f703e223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d72656769737465725f69647c733a323a223130223b636173685f696e5f68616e647c733a373a22323030302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32372032323a30323a3436223b),
('b6fc801e13b0f56dd0842066371a79cdbf8dbf98', '192.168.1.104', 1470085938, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303038353930363b6572726f727c733a34363a223c703e4c6f67696e2066616c686f752c20706f72206661766f722074656e7465206e6f76616d656e74653c2f703e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226f6c64223b7d),
('ba834e9d4e0ded9c6c52513da259b4a50f78d098', '189.89.250.194', 1452951252, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435323935313137303b6572726f727c733a37333a223c703e566f63c3aa2066657a20332074656e746174697661732073656d207375636573736f2e2054656e7465206e6f76616d656e746520636f6d203130206d696e75746f733c2f703e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226f6c64223b7d),
('bb511d22dae910a926dc2ae0567423c63685a91d', '192.168.1.104', 1470087192, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303038373139323b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639383239333736223b6c6173745f69707c733a31333a223139322e3136382e312e313036223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b),
('bb5a318351c4adfd5e134bb6c494716271350bcd', '::1', 1454303271, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435343330333231323b6572726f727c733a37333a223c703e566f63c3aa2066657a20332074656e746174697661732073656d207375636573736f2e2054656e7465206e6f76616d656e746520636f6d203130206d696e75746f733c2f703e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226f6c64223b7d),
('bd922b0433a47fa39de6a156912ff0e6a8d5856c', '192.168.1.101', 1470113830, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303131333735323b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343730313035313438223b6c6173745f69707c733a31333a223139322e3136382e312e313034223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223133223b636173685f696e5f68616e647c733a363a223230302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30382d30312032333a33333a3439223b),
('bff6a9798da8ccda075d4f25774ee06a49836346', '192.168.1.104', 1470087182, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303038363838373b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639383239333736223b6c6173745f69707c733a31333a223139322e3136382e312e313036223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226f6c64223b7d6572726f727c733a37373a224f204361697861206ec3a36f20657374c3a12061626572746f2c20706f72206661766f7220696e666f726d65206f2076616c6f7220646f20636169786120706172612061206162657274757261223b),
('c0cd90b8dd91e4ccfd527308c2534fd5c67467f3', '192.168.1.101', 1469668371, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393636383337313b),
('c6f3d4738aeef4e9b02b8110a24c51a322989ea0', '189.89.250.194', 1452952902, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435323935323930323b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343439383931343733223b6c6173745f69707c733a31353a223138372e3131362e3233312e313231223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2232223b636173685f696e5f68616e647c733a343a22302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31312d30322031323a30303a3234223b637372666b65797c733a383a22314756753639616d223b5f5f63695f766172737c613a323a7b733a373a22637372666b6579223b733a333a226e6577223b733a393a226373726676616c7565223b733a333a226e6577223b7d6373726676616c75657c733a32303a22447a67466f626e6d73764d5634413137714e7863223b),
('c786a2d11a2908db27283c76c65cd6826a591c36', '192.168.1.101', 1469760336, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393736303333363b),
('cabf851576cad676f7b19c1ba44ea550b57507c4', '191.207.159.177', 1446502835, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434363530323831383b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343436343733373239223b6c6173745f69707c733a333a223a3a31223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b6d6573736167657c733a34323a223c703e4c6f6761646f20636f6d207375636573736f212053656a612042656d2056696e646f213c2f703e223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d72656769737465725f69647c733a313a2232223b636173685f696e5f68616e647c733a343a22302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31312d30322031323a30303a3234223b),
('cee32b8bf68e4651f0e5e6daec7b67e274475365', '192.168.1.104', 1470086727, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303038363535323b),
('d0fb4cc37a72a1b34e076be99d2182fe6e16bf25', '::1', 1470161535, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303136313533353b),
('d23cc75fb6e85cb0e5317d53834cccf444342ae4', '192.168.1.104', 1470110785, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303131303737303b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343730303837313831223b6c6173745f69707c733a31333a223139322e3136382e312e313034223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223133223b636173685f696e5f68616e647c733a363a223230302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30382d30312032333a33333a3439223b),
('d42b4d82bc28428f87d88a989663da94f68e225a', '::1', 1469598337, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393539383137343b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639353938313635223b6c6173745f69707c4e3b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2232223b72656769737465725f69647c733a313a2239223b636173685f696e5f68616e647c733a373a22323030302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32372030323a34333a3235223b),
('d5b4132469f4fe756ce3dbde95be81b141362e56', '192.168.1.104', 1470113398, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303131333038353b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343730303837313831223b6c6173745f69707c733a31333a223139322e3136382e312e313034223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223133223b636173685f696e5f68616e647c733a363a223230302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30382d30312032333a33333a3439223b),
('d7aa4373c57db65cf426832ac23bcbdc9c47a16c', '192.168.1.105', 1469598013, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393539373939353b),
('d8c322bf9a8797fa67afbb1b9f1826902e311236', '192.168.1.104', 1470116227, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303131353939353b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343730303837313831223b6c6173745f69707c733a31333a223139322e3136382e312e313034223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223133223b636173685f696e5f68616e647c733a363a223230302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30382d30312032333a33333a3439223b),
('d9eb8e61c574fa2dfb4780e61591b12dab854d20', '::1', 1454302176, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435343330313839383b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343533373730303939223b6c6173745f69707c733a31343a223137392e3130302e3133362e3737223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2238223b636173685f696e5f68616e647c733a363a223130302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30312d32352032313a30313a3538223b637372666b65797c733a383a226e43685365447674223b5f5f63695f766172737c613a323a7b733a373a22637372666b6579223b733a333a226e6577223b733a393a226373726676616c7565223b733a333a226e6577223b7d6373726676616c75657c733a32303a22774a64704e56633873746a5a6f694f7954316e67223b),
('d9f3d95bceb2d5e9eb36e4d3a54f58ea349ae2c4', '192.168.1.104', 1469744110, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393734333932353b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639363730313436223b6c6173745f69707c733a31333a223139322e3136382e312e313031223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223130223b636173685f696e5f68616e647c733a373a22323030302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32372032323a30323a3436223b),
('daafd6e317b267b960a79327207487e67df5be6a', '66.249.88.75', 1453806071, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333830363037303b),
('dc5cb259bf0a7d61c4b007eb2d47d06c276ac9b7', '192.168.1.104', 1469749633, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393734393537353b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639363730313436223b6c6173745f69707c733a31333a223139322e3136382e312e313031223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223130223b636173685f696e5f68616e647c733a373a22323030302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32372032323a30323a3436223b),
('deec0cb66c2ebce1cc34e0e9cf0a43101623be14', '192.168.1.104', 1469746402, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393734363131303b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639363730313436223b6c6173745f69707c733a31333a223139322e3136382e312e313031223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223130223b636173685f696e5f68616e647c733a373a22323030302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32372032323a30323a3436223b),
('e0af9412bf45e251bfa425e2cf26e4e5aeee4171', '192.168.1.101', 1469750091, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393735303039313b),
('e2400cc6bbf43753ca20b2c1c36811f8f9815557', '::1', 1469599725, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393539393732353b),
('e467dada82208d21eb6af862aad871e3bf4edc27', '::1', 1454301808, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435343330313533393b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343533373730303939223b6c6173745f69707c733a31343a223137392e3130302e3133362e3737223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2238223b636173685f696e5f68616e647c733a363a223130302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30312d32352032313a30313a3538223b),
('e46fd546168f7350f5b18efb1df8e167c5db6723', '189.89.250.194', 1453473880, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333437333836333b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343533343033323136223b6c6173745f69707c733a31343a223138392e38392e3235302e313934223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2232223b636173685f696e5f68616e647c733a343a22302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31312d30322031323a30303a3234223b),
('ed6ba388c642192c74ead6e5ce5df7396440bd62', '::1', 1469631990, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393633313931353b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639353938313838223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2239223b636173685f696e5f68616e647c733a373a22323030302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32372030323a34333a3235223b),
('ee07fadc34d0feeb039ddb6bd674cc18b37b2c1a', '192.168.1.104', 1470113440, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303131333434303b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343730303837313831223b6c6173745f69707c733a31333a223139322e3136382e312e313034223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223133223b636173685f696e5f68616e647c733a363a223230302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30382d30312032333a33333a3439223b),
('f068b1742edfd157d0c1eead0a8fcf00841506b6', '189.89.250.194', 1446561304, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434363536313134343b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343436353033343832223b6c6173745f69707c733a31353a223139312e3230372e3135392e313737223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2232223b636173685f696e5f68616e647c733a343a22302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31312d30322031323a30303a3234223b),
('f283ef340f11eb396ed151654689b7c2ab49688e', '192.168.1.104', 1469748401, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393734383131393b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639363730313436223b6c6173745f69707c733a31333a223139322e3136382e312e313031223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223130223b636173685f696e5f68616e647c733a373a22323030302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32372032323a30323a3436223b),
('f2baea9b625414c970531dac5d7e7e306af0b5e3', '189.89.250.194', 1446555542, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434363535353531303b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343436353033343832223b6c6173745f69707c733a31353a223139312e3230372e3135392e313737223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2232223b636173685f696e5f68616e647c733a343a22302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31312d30322031323a30303a3234223b),
('f3930d74dc51f5ae36235e4fe2362e42d1c7e8a4', '192.168.1.104', 1469749113, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393734383831353b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639363730313436223b6c6173745f69707c733a31333a223139322e3136382e312e313031223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223130223b636173685f696e5f68616e647c733a373a22323030302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32372032323a30323a3436223b),
('f951ffa399344917fad2354aaaaf37cfc13148d5', '192.168.1.101', 1469736116, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393733363131363b),
('fac2866f2e91b7498a09fcdf195bad384924c406', '192.168.1.106', 1469829555, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436393832393235383b6964656e746974797c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343639373432323030223b6c6173745f69707c733a31333a223139322e3136382e312e313034223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223132223b636173685f696e5f68616e647c733a363a223830302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30372d32392031383a35363a3530223b6d6573736167657c733a34343a22c3937264656d2073616c766120636f6d207375636573736f207061726120636f6e7461732061626572746173223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d),
('fbc1b5d34b61b34fd0724994257179f14ddc55d0', '187.114.90.84', 1449950634, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434393935303333353b6964656e746974797c733a32333a227064764070647670617261746f646f732e636f6d2e6272223b757365726e616d657c733a383a2276656e6465646f72223b656d61696c7c733a32333a227064764070647670617261746f646f732e636f6d2e6272223b757365725f69647c733a313a2232223b66697273745f6e616d657c733a383a2276656e6465646f72223b6c6173745f6e616d657c733a333a22706476223b637265617465645f6f6e7c733a32323a2231322f31322f323031352031323a33393a323720414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343439383931353637223b6c6173745f69707c4e3b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2233223b636173685f696e5f68616e647c733a353a2235302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31322d31322031363a35393a3438223b),
('fc5882c62a2a40a1c3142ffd06be46d44106f9aa', '179.100.136.77', 1453767976, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435333736373730353b6964656e746974797c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a33303a22676572616c646f706174726963696f2e6d656c6f40676d61696c2e636f6d223b757365725f69647c733a313a2231223b66697273745f6e616d657c733a373a22476572616c646f223b6c6173745f6e616d657c733a343a224d656c6f223b637265617465645f6f6e7c733a32323a2232352f30362f323031352031323a35393a333420414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343533373637303730223b6c6173745f69707c733a31343a223137392e3130302e3133362e3737223b6176617461727c733a31313a22676572616c646f2e706e67223b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2234223b636173685f696e5f68616e647c733a343a22302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30312d32352032313a31323a3235223b),
('fd071a57990d2ce6b4bf7dc73f188558964a44a8', '192.168.1.104', 1470109634, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303130393339313b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343730303837313831223b6c6173745f69707c733a31333a223139322e3136382e312e313034223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223133223b636173685f696e5f68616e647c733a363a223230302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30382d30312032333a33333a3439223b),
('fd5ef189bd3c9766677b74a51f75ffa347af59be', '192.168.1.104', 1470112714, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303131323439393b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343730303837313831223b6c6173745f69707c733a31333a223139322e3136382e312e313034223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223133223b636173685f696e5f68616e647c733a363a223230302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30382d30312032333a33333a3439223b),
('fd78a81e80d95205e1689f69018f6a3966df7f83', '187.114.90.84', 1449951302, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434393935313030393b6964656e746974797c733a32333a227064764070647670617261746f646f732e636f6d2e6272223b757365726e616d657c733a383a2276656e6465646f72223b656d61696c7c733a32333a227064764070647670617261746f646f732e636f6d2e6272223b757365725f69647c733a313a2232223b66697273745f6e616d657c733a383a2276656e6465646f72223b6c6173745f6e616d657c733a333a22706476223b637265617465645f6f6e7c733a32323a2231322f31322f323031352031323a33393a323720414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343439383931353637223b6c6173745f69707c4e3b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a313a2233223b636173685f696e5f68616e647c733a353a2235302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031352d31322d31322031363a35393a3438223b),
('ff82144b312396d17dca2160864d9b762a82f76f', '192.168.1.104', 1470108106, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437303130373836333b6964656e746974797c733a363a226a756e696f72223b757365726e616d657c733a363a226a756e696f72223b656d61696c7c733a32323a226a756e696f724077656269737465722e636f6d2e6272223b757365725f69647c733a313a2234223b66697273745f6e616d657c733a363a226a756e696f72223b6c6173745f6e616d657c733a31303a226e617363696d656e746f223b637265617465645f6f6e7c733a32323a2232372f30372f323031362030323a34323a343520414d223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343730303837313831223b6c6173745f69707c733a31333a223139322e3136382e312e313034223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b72656769737465725f69647c733a323a223133223b636173685f696e5f68616e647c733a363a223230302e3030223b72656769737465725f6f70656e5f74696d657c733a31393a22323031362d30382d30312032333a33333a3439223b);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tec_settings`
--

CREATE TABLE `tec_settings` (
  `setting_id` int(1) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `site_name` varchar(55) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `dateformat` varchar(20) DEFAULT NULL,
  `timeformat` varchar(20) DEFAULT NULL,
  `default_email` varchar(100) NOT NULL,
  `language` varchar(20) NOT NULL,
  `version` varchar(5) NOT NULL DEFAULT '1.0',
  `theme` varchar(20) NOT NULL,
  `timezone` varchar(255) NOT NULL DEFAULT '0',
  `protocol` varchar(20) NOT NULL DEFAULT 'mail',
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_user` varchar(100) DEFAULT NULL,
  `smtp_pass` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(10) DEFAULT '25',
  `smtp_crypto` varchar(5) DEFAULT NULL,
  `mmode` tinyint(1) NOT NULL,
  `captcha` tinyint(1) NOT NULL DEFAULT '1',
  `mailpath` varchar(55) DEFAULT NULL,
  `currency_prefix` varchar(3) NOT NULL,
  `default_customer` int(11) NOT NULL,
  `default_tax_rate` varchar(20) NOT NULL,
  `rows_per_page` int(2) NOT NULL,
  `total_rows` int(2) NOT NULL,
  `header` varchar(1000) NOT NULL,
  `footer` varchar(1000) NOT NULL,
  `bsty` tinyint(4) NOT NULL,
  `display_kb` tinyint(4) NOT NULL,
  `default_category` int(11) NOT NULL,
  `default_discount` varchar(20) NOT NULL,
  `item_addition` tinyint(1) NOT NULL,
  `barcode_symbology` varchar(55) NOT NULL,
  `pro_limit` tinyint(4) NOT NULL,
  `decimals` tinyint(1) NOT NULL DEFAULT '2',
  `thousands_sep` varchar(2) NOT NULL DEFAULT ',',
  `decimals_sep` varchar(2) NOT NULL DEFAULT '.',
  `focus_add_item` varchar(55) DEFAULT NULL,
  `add_customer` varchar(55) DEFAULT NULL,
  `toggle_category_slider` varchar(55) DEFAULT NULL,
  `cancel_sale` varchar(55) DEFAULT NULL,
  `suspend_sale` varchar(55) DEFAULT NULL,
  `print_order` varchar(55) DEFAULT NULL,
  `print_bill` varchar(55) DEFAULT NULL,
  `finalize_sale` varchar(55) DEFAULT NULL,
  `today_sale` varchar(55) DEFAULT NULL,
  `open_hold_bills` varchar(55) DEFAULT NULL,
  `close_register` varchar(55) DEFAULT NULL,
  `java_applet` tinyint(1) NOT NULL,
  `receipt_printer` varchar(55) DEFAULT NULL,
  `pos_printers` varchar(255) DEFAULT NULL,
  `cash_drawer_codes` varchar(55) DEFAULT NULL,
  `char_per_line` tinyint(4) DEFAULT '42',
  `rounding` tinyint(1) DEFAULT '0',
  `pin_code` varchar(20) DEFAULT NULL,
  `stripe` tinyint(1) DEFAULT NULL,
  `stripe_secret_key` varchar(100) DEFAULT NULL,
  `stripe_publishable_key` varchar(100) DEFAULT NULL,
  `purchase_code` varchar(100) DEFAULT NULL,
  `envato_username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tec_settings`
--

INSERT INTO `tec_settings` (`setting_id`, `logo`, `site_name`, `tel`, `dateformat`, `timeformat`, `default_email`, `language`, `version`, `theme`, `timezone`, `protocol`, `smtp_host`, `smtp_user`, `smtp_pass`, `smtp_port`, `smtp_crypto`, `mmode`, `captcha`, `mailpath`, `currency_prefix`, `default_customer`, `default_tax_rate`, `rows_per_page`, `total_rows`, `header`, `footer`, `bsty`, `display_kb`, `default_category`, `default_discount`, `item_addition`, `barcode_symbology`, `pro_limit`, `decimals`, `thousands_sep`, `decimals_sep`, `focus_add_item`, `add_customer`, `toggle_category_slider`, `cancel_sale`, `suspend_sale`, `print_order`, `print_bill`, `finalize_sale`, `today_sale`, `open_hold_bills`, `close_register`, `java_applet`, `receipt_printer`, `pos_printers`, `cash_drawer_codes`, `char_per_line`, `rounding`, `pin_code`, `stripe`, `stripe_secret_key`, `stripe_publishable_key`, `purchase_code`, `envato_username`) VALUES
(1, 'logo1.png', 'Webister Food', '55 11 986352205', 'd/m/Y', 'h:i:s A', 'junior@webister.com.br', 'portugues', '4.0', 'default', 'Amercia/Belem', 'mail', 'pop.gmail.com', 'geraldopatricio.melo@gmail.com', '', '25', '', 0, 0, NULL, 'REA', 1, '0%', 10, 30, '<h2><strong>Batata Show Sorocaba</strong></h2>\r\n       Av. Teste, 123 - Bairro Teste,<br>\r\n                                                                                              CEP 99.999-999, Cidade-UF<br>', 'Volte Sempre!\r\n<br>', 3, 0, 2, '0', 1, '', 100, 2, ',', '.', 'ALT+F1', 'ALT+F2', 'ALT+F10', 'ALT+F5', 'ALT+F6', 'ALT+F11', 'ALT+F12', 'ALT+F8', 'Ctrl+F1', 'Ctrl+F2', 'ALT+F7', 0, '', '', '', 42, 0, '0709', 1, 'sk_test_jHf4cEzAYtgcXvgWPCsQAn50', 'pk_test_beat8SWPORb0OVdF2H77A7uG', 'ff2400d9-f3aa-4db5-9dc5-4eee236c6254', 'patriciomelo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tec_suppliers`
--

CREATE TABLE `tec_suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `cf1` varchar(255) NOT NULL,
  `cf2` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tec_suppliers`
--

INSERT INTO `tec_suppliers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`) VALUES
(1, 'Fornecedor Padr?o', '1', '2', '0123456789', 'fornecedor@pdvparatodos.com.br');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tec_suspended_items`
--

CREATE TABLE `tec_suspended_items` (
  `id` int(11) NOT NULL,
  `suspend_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` decimal(15,2) NOT NULL,
  `unit_price` decimal(25,2) NOT NULL,
  `net_unit_price` decimal(25,2) NOT NULL,
  `discount` varchar(20) DEFAULT NULL,
  `item_discount` decimal(25,2) DEFAULT NULL,
  `tax` int(20) DEFAULT NULL,
  `item_tax` decimal(25,2) DEFAULT NULL,
  `subtotal` decimal(25,2) NOT NULL,
  `real_unit_price` decimal(25,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tec_suspended_sales`
--

CREATE TABLE `tec_suspended_sales` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(55) NOT NULL,
  `total` decimal(25,2) NOT NULL,
  `product_discount` decimal(25,2) DEFAULT NULL,
  `order_discount_id` varchar(20) DEFAULT NULL,
  `order_discount` decimal(25,2) DEFAULT NULL,
  `total_discount` decimal(25,2) DEFAULT NULL,
  `product_tax` decimal(25,2) DEFAULT NULL,
  `order_tax_id` varchar(20) DEFAULT NULL,
  `order_tax` decimal(25,2) DEFAULT NULL,
  `total_tax` decimal(25,2) DEFAULT NULL,
  `grand_total` decimal(25,2) NOT NULL,
  `total_items` int(11) DEFAULT NULL,
  `total_quantity` decimal(15,2) DEFAULT NULL,
  `paid` decimal(25,2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `hold_ref` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tec_users`
--

CREATE TABLE `tec_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `last_ip_address` varbinary(45) DEFAULT NULL,
  `ip_address` varbinary(45) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `avatar` varchar(55) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tec_users`
--

INSERT INTO `tec_users` (`id`, `last_ip_address`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `avatar`, `gender`, `group_id`) VALUES
(1, 0x3a3a31, 0x3132372e302e302e31, 'admin', '0944ac2da688d44e978d579d44111909ea560c4d', NULL, 'temdetudoprogramas@hotmail.com', NULL, NULL, NULL, NULL, 1435204774, 1454302937, 0, 'Tem de Tudo', 'Programas', 'Tecdiary', '55  75 99189-4547', 'geraldo.png', 'male', 1),
(2, 0x3a3a31, 0x3138372e3131362e3233312e313231, 'vendedor', 'c9c7537a1fe1275298d2e2df08426ee51513bb9f', NULL, 'pontodigitalprogramas@hotmail.com', NULL, NULL, NULL, NULL, 1449891567, 1469631537, 0, 'vendedor', 'pdv', NULL, '999', NULL, 'male', 1),
(4, 0x3139322e3136382e312e313034, 0x3a3a31, 'junior', 'beab1fb0adade374792847a85f31d2361091ec6a', NULL, 'junior@webister.com.br', NULL, NULL, NULL, NULL, 1469598165, 1470161584, 1, 'junior', 'nascimento', NULL, '9000000000', NULL, 'male', 1),
(5, 0x3139322e3136382e312e313031, 0x3139322e3136382e312e313034, 'garcom', 'e8d3adee5b1ea100404b182cb184ef151072b0c3', NULL, 'garcom@garcom.com', NULL, NULL, NULL, NULL, 1469749965, 1469750008, 1, 'Garçom', 'Pedro', NULL, '99999999', NULL, 'male', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tec_user_logins`
--

CREATE TABLE `tec_user_logins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tec_user_logins`
--

INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES
(1, 1, NULL, 0x3a3a31, 'geraldopatricio.melo@gmail.com', '2015-11-02 12:33:39'),
(2, 1, NULL, 0x3a3a31, 'geraldopatricio.melo@gmail.com', '2015-11-02 12:53:18'),
(3, 1, NULL, 0x3a3a31, 'geraldopatricio.melo@gmail.com', '2015-11-02 13:15:21'),
(4, 1, NULL, 0x3a3a31, 'geraldopatricio.melo@gmail.com', '2015-11-02 13:15:30'),
(5, 1, NULL, 0x3139312e3230372e3135392e313737, 'geraldopatricio.melo@gmail.com', '2015-11-02 22:20:35'),
(6, 1, NULL, 0x3139312e3230372e3135392e313737, 'geraldopatricio.melo@gmail.com', '2015-11-02 22:30:36'),
(7, 1, NULL, 0x3139312e3230372e3135392e313737, 'geraldopatricio.melo@gmail.com', '2015-11-02 22:31:22'),
(8, 1, NULL, 0x3138392e38392e3235302e313934, 'geraldopatricio.melo@gmail.com', '2015-11-03 12:34:44'),
(9, 1, NULL, 0x3137372e3134352e352e313135, 'geraldopatricio.melo@gmail.com', '2015-11-11 20:38:46'),
(10, 1, NULL, 0x3230302e3232322e32312e313338, 'geraldopatricio.melo@gmail.com', '2015-11-25 10:45:05'),
(11, 1, NULL, 0x3138372e3131362e3233312e313231, 'geraldopatricio.melo@gmail.com', '2015-12-12 03:37:53'),
(12, 2, NULL, 0x3138372e3131342e39302e3834, 'pdv@pdvparatodos.com.br', '2015-12-12 19:59:25'),
(13, 1, NULL, 0x3138392e38392e3235302e313934, 'geraldopatricio.melo@gmail.com', '2016-01-16 13:56:15'),
(14, 1, NULL, 0x3138392e38392e3235302e313934, 'geraldopatricio.melo@gmail.com', '2016-01-21 16:22:16'),
(15, 1, NULL, 0x3138392e38392e3235302e313934, 'geraldopatricio.melo@gmail.com', '2016-01-21 19:06:56'),
(16, 1, NULL, 0x3138392e38392e3235302e313934, 'geraldopatricio.melo@gmail.com', '2016-01-22 14:44:26'),
(17, 1, NULL, 0x3137372e3137322e31362e323232, 'geraldopatricio.melo@gmail.com', '2016-01-22 15:06:16'),
(18, 1, NULL, 0x3138392e38392e3235302e313934, 'geraldopatricio.melo@gmail.com', '2016-01-22 18:29:43'),
(19, 1, NULL, 0x3137372e3137322e31362e323232, 'geraldopatricio.melo@gmail.com', '2016-01-22 22:51:12'),
(20, 1, NULL, 0x3139312e3139352e3235302e3333, 'geraldopatricio.melo@gmail.com', '2016-01-25 23:15:36'),
(21, 1, NULL, 0x3137392e3130302e3133362e3737, 'geraldopatricio.melo@gmail.com', '2016-01-26 00:11:10'),
(22, 1, NULL, 0x3137392e3130302e3133362e3737, 'geraldopatricio.melo@gmail.com', '2016-01-26 00:11:52'),
(23, 1, NULL, 0x3137392e3130302e3133362e3737, 'geraldopatricio.melo@gmail.com', '2016-01-26 00:49:37'),
(24, 1, NULL, 0x3137392e3130302e3133362e3737, 'geraldopatricio.melo@gmail.com', '2016-01-26 00:49:56'),
(25, 1, NULL, 0x3137392e3130302e3133362e3737, 'geraldopatricio.melo@gmail.com', '2016-01-26 00:59:18'),
(26, 1, NULL, 0x3137392e3130302e3133362e3737, 'geraldopatricio.melo@gmail.com', '2016-01-26 01:01:39'),
(27, 1, NULL, 0x3a3a31, 'geraldopatricio.melo@gmail.com', '2016-02-01 04:39:25'),
(28, 2, NULL, 0x3a3a31, 'pontodigitalprogramas@hotmail.com', '2016-02-01 04:58:54'),
(29, 1, NULL, 0x3a3a31, 'temdetudoprogramas@hotmail.com', '2016-02-01 05:02:17'),
(30, 2, NULL, 0x3a3a31, 'pontodigitalprogramas@hotmail.com', '2016-07-27 05:15:25'),
(31, 2, NULL, 0x3a3a31, 'pontodigitalprogramas@hotmail.com', '2016-07-27 05:23:53'),
(32, 2, NULL, 0x3a3a31, 'pontodigitalprogramas@hotmail.com', '2016-07-27 05:40:33'),
(33, 4, NULL, 0x3a3a31, 'junior@webister.com.br', '2016-07-27 05:43:08'),
(34, 2, NULL, 0x3a3a31, 'pontodigitalprogramas@hotmail.com', '2016-07-27 14:58:57'),
(35, 4, NULL, 0x3a3a31, 'junior@webister.com.br', '2016-07-27 15:00:04'),
(36, 4, NULL, 0x3a3a31, 'junior@webister.com.br', '2016-07-28 00:58:07'),
(37, 4, NULL, 0x3139322e3136382e312e313031, 'junior@webister.com.br', '2016-07-28 01:02:30'),
(38, 4, NULL, 0x3139322e3136382e312e313031, 'junior@webister.com.br', '2016-07-28 01:42:26'),
(39, 4, NULL, 0x3139322e3136382e312e313034, 'junior@webister.com.br', '2016-07-28 21:43:20'),
(40, 5, NULL, 0x3139322e3136382e312e313031, 'garcom@garcom.com', '2016-07-28 23:53:28'),
(41, 4, NULL, 0x3139322e3136382e312e313036, 'junior@webister.com.br', '2016-07-29 21:56:16'),
(42, 4, NULL, 0x3139322e3136382e312e313034, 'junior', '2016-08-01 21:33:02'),
(43, 4, NULL, 0x3139322e3136382e312e313034, 'junior', '2016-08-02 02:32:28'),
(44, 4, NULL, 0x3139322e3136382e312e313031, 'junior', '2016-08-02 04:56:08'),
(45, 4, NULL, 0x3139322e3136382e312e313034, 'junior', '2016-08-02 18:13:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tec_categories`
--
ALTER TABLE `tec_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_combo_items`
--
ALTER TABLE `tec_combo_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_customers`
--
ALTER TABLE `tec_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_expenses`
--
ALTER TABLE `tec_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_gift_cards`
--
ALTER TABLE `tec_gift_cards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `card_no` (`card_no`);

--
-- Indexes for table `tec_groups`
--
ALTER TABLE `tec_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_login_attempts`
--
ALTER TABLE `tec_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_mesas`
--
ALTER TABLE `tec_mesas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_payments`
--
ALTER TABLE `tec_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_products`
--
ALTER TABLE `tec_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `tec_purchases`
--
ALTER TABLE `tec_purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_purchase_items`
--
ALTER TABLE `tec_purchase_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_registers`
--
ALTER TABLE `tec_registers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_sales`
--
ALTER TABLE `tec_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_sale_items`
--
ALTER TABLE `tec_sale_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_sessions`
--
ALTER TABLE `tec_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `tec_settings`
--
ALTER TABLE `tec_settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `tec_suppliers`
--
ALTER TABLE `tec_suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_suspended_items`
--
ALTER TABLE `tec_suspended_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_suspended_sales`
--
ALTER TABLE `tec_suspended_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_users`
--
ALTER TABLE `tec_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `tec_user_logins`
--
ALTER TABLE `tec_user_logins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tec_categories`
--
ALTER TABLE `tec_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tec_combo_items`
--
ALTER TABLE `tec_combo_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tec_customers`
--
ALTER TABLE `tec_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tec_expenses`
--
ALTER TABLE `tec_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tec_gift_cards`
--
ALTER TABLE `tec_gift_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tec_groups`
--
ALTER TABLE `tec_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tec_login_attempts`
--
ALTER TABLE `tec_login_attempts`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tec_mesas`
--
ALTER TABLE `tec_mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tec_payments`
--
ALTER TABLE `tec_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tec_products`
--
ALTER TABLE `tec_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tec_purchases`
--
ALTER TABLE `tec_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tec_purchase_items`
--
ALTER TABLE `tec_purchase_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tec_registers`
--
ALTER TABLE `tec_registers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tec_sales`
--
ALTER TABLE `tec_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tec_sale_items`
--
ALTER TABLE `tec_sale_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `tec_suppliers`
--
ALTER TABLE `tec_suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tec_suspended_items`
--
ALTER TABLE `tec_suspended_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tec_suspended_sales`
--
ALTER TABLE `tec_suspended_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tec_users`
--
ALTER TABLE `tec_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tec_user_logins`
--
ALTER TABLE `tec_user_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
