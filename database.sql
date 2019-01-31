-- Adminer 4.2.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `clinics`;
CREATE TABLE `clinics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `clinics` (`id`, `name`, `address`, `phone`) VALUES
(1,	'Oren Medinax',	'Et est autem et qui a et neque quod rerum aut earum porro deleniti omnis tenetur eum velit',	'+164-28-1762688');

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `customers` (`id`, `name`, `address`, `phone`) VALUES
(1,	'Noelani Ortega',	'Impedit placeat deserunt ut sed ut ullam co',	'+322-41-4695050'),
(2,	'Lee Sawyer',	'Alias fugiat commodi incidunt aut cupiditate',	'+452-48-9969637'),
(3,	'Colin Joyner',	'Consequatur ipsum quas quae ea qui ea ut id o',	'+882-86-5436520'),
(4,	'Ethan Mays',	'Quia magni pariatur Aliquid exercitation und',	'+293-79-1555741'),
(5,	'Leila Duran',	'Aute sequi in rerum nihil eligendi molestiae ',	'+347-99-9048316');

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `sale_id` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invoices_sales1` (`sale_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `invoice_items`;
CREATE TABLE `invoice_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `price` float(10,2) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sales_has_products_products1` (`product_id`),
  KEY `fk_sale_items_copy1_invoices1` (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `unit` varchar(45) NOT NULL,
  `reorder_level` int(11) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `products` (`id`, `name`, `unit`, `reorder_level`, `price`) VALUES
(1,	'Melanie Sutton',	'Ut ad ratione nostrum dolorem officia sequi e',	85,	'22000'),
(2,	'Dana Lucas',	'Aliquip sapiente nesciunt dolores nobis eius',	4,	'939'),
(3,	'Ria Hampton',	'Asperiores omnis a sint excepturi eum et',	13,	'631'),
(4,	'Ria Hampton',	'Asperiores omnis a sint excepturi eum et',	13,	'631'),
(5,	'Frances Miles',	'Expedita officiis aut incidunt excepteur sae',	92,	'138'),
(6,	'Cora Rice',	'Temporibus dolore sit quae fuga Quo ut exerc',	86,	'493'),
(7,	'Arsenio Pope',	'Ea laborum Qui ut error quas aut cum blandit',	35,	'938'),
(8,	'Xavier Duke',	'Dolores voluptate ut perferendis nulla pariat',	51,	'854'),
(9,	'Karyn Lawson',	'Qui et molestiae accusamus velit non tempori',	23,	'228'),
(10,	'Norman Lang',	'Porro ut laboris minus laboriosam dolor',	88,	'325'),
(11,	'Walker Mercado',	'Quibusdam debitis in dignissimos amet volupt',	12,	'390');

DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clinic_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `total_amount` float(10,2) DEFAULT NULL,
  `discount` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_clinics_has_customers_customers1` (`customer_id`),
  KEY `fk_clinics_has_customers_clinics` (`clinic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sales` (`id`, `clinic_id`, `customer_id`, `date`, `total_amount`, `discount`) VALUES
(1,	1,	5,	'2010-08-09 20:16:00',	37.00,	18.00),
(2,	1,	4,	'2002-06-12 12:25:00',	71.00,	96.00);

DROP TABLE IF EXISTS `sale_items`;
CREATE TABLE `sale_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` varchar(45) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` float(10,2) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sales_has_products_products1` (`product_id`),
  KEY `fk_sales_has_products_sales1` (`sale_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sale_items` (`id`, `sale_id`, `product_id`, `price`, `qty`) VALUES
(1,	'1',	2,	802.00,	480),
(2,	'1',	2,	548.00,	196),
(3,	'2',	2,	956.00,	356);

-- 2018-07-01 14:12:05
