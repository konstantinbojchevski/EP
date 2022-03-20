drop database if exists lapshop;
create database lapshop;
use lapshop;

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `cart`
(
    `cart_id` int(10) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `user_id` int(10)                            NOT NULL,
    `item_id` int(10)                            NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users`
(
    `usersId`    int(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `usersName`  varchar(128)                       NOT NULL,
    `usersSurname`  varchar(128)                       NOT NULL,
    `usersEmail` varchar(128) UNIQUE                NOT NULL,
    `usersUid`   varchar(128) UNIQUE                NOT NULL,
    `usersPwd`   varchar(128)                       NOT NULL,
    `userStatus` int(1)                            NOT NULL DEFAULT 1, /*0-innactive, 1-active*/
    `userRole`   int(1)                            NOT NULL, /*0-admin, 1-prodajalec, 2-stranka, 3-guest*/
    `street`     varchar(255)                       NOT NULL,
    `houseNo`    int(10)                            NOT NULL,
    `post`       varchar(255)                       NOT NULL,
    `postNo`    int(10)                            NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* administrator */
INSERT INTO `users` (`usersId`, `usersName`, `usersSurname`, `usersEmail`, `usersUid`, `usersPwd`, `userStatus`, `userRole`, street, houseNo, post, postNo) VALUES
(1, 'Admin', 'Admin', 'admin@gmail.com', 'admin', '$2y$10$rjOaypIQknnY0oePKVHtC.lJtjGHbg7lqt1XNYbp8grJkrpC8UCZS', 1, 0, '', '', '', '');

INSERT INTO `users` (`usersId`, `usersName`, `usersSurname`, `usersEmail`, `usersUid`, `usersPwd`, `userStatus`, `userRole`, street, houseNo, post, postNo) VALUES
(2, 'Seller', 'Seller', 'seller@gmail.com', 'seller', '$2y$10$G.bD/RFCjX/LRronmZCZnOZ73G9DUjZzqhmMH/H4kW.pkDteib4cm', 1, 1, '', '', '', '');

INSERT INTO `users` (`usersId`, `usersName`, `usersSurname`, `usersEmail`, `usersUid`, `usersPwd`, `userStatus`, `userRole`, street, houseNo, post, postNo) VALUES
(3, 'Customer', 'Customer', 'customer@gmail.com', 'customer', '$2y$10$obIhVhlQuGlF4T2X6RP2CeIZpJpCKmhcOVINOP6humqjVx1qfuNle', 1, 2, 'Slovenska cesta', 1, 'Ljubljana', 1000);

INSERT INTO `users` (`usersId`, `usersName`, `usersSurname`, `usersEmail`, `usersUid`, `usersPwd`, `userStatus`, `userRole`, street, houseNo, post, postNo) VALUES
(4, 'Guest', 'Guest', 'guest@gmail.com', 'guest', 'guest', 1, 3, 'Slovenska cesta', 2, 'Ljubljana', 1000);


CREATE TABLE `product` (
    `item_id` int(10) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `item_brand` varchar(200) NOT NULL,
    `item_name` varchar(255) NOT NULL,
    `item_price` double(10,2) NOT NULL,
    `item_rating` int(10) NOT NULL DEFAULT 0,
    `item_image` varchar(255) NOT NULL,
    `item_desc` varchar(255) NOT NULL,
    `item_status` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `product` (`item_id`, `item_brand`, `item_name`, `item_price`, `item_rating`, `item_image`, `item_desc`, `item_status`) VALUES
(1, 'Lenovo', 'IdeaPad S540', 987.89, 5, './images/1.jpg', '15.6" (1TB SSD, Intel Core i7 8th Gen., 4.60 GHz, 8GB) Laptop - Mineral Grey - 81SW000DUK', 1),
(2, 'Lenovo', 'IdeaPad 1 11ADA05', 238.15, 5, './images/2.jpg', '11.6" (64GB eMMC, AMD Athlon Silver 3050e, 1.20GHz, 4GB RAM) Laptop - Platinum Grey (82GV000MUK)', 1),
(3, 'Lenovo', 'IdeaPad Slim 1-14AST-05', 261.99, 3, './images/3.jpg', '14" (AMD A4-9120e, 1.50GHz, 4GB RAM, 64GB eMMC) Laptop - Platinum Grey (81VS001CUK)', 1),
(4, 'Apple', 'MacBook Air 13.3', 277.00, 5, './images/4.jpg', '13.3" (128GB SSD, Intel Core i5 8th Gen., 1.60 GHz, 8GB) Laptop - Space Gray - MRE82LL/A (October, 2018)', 1),
(5, 'HUAWEI', 'MateBook E 2022', 943.00, 2, './images/5.jpg', '2-in-1 Tablet Notebook PC 12.6 inch OLED Windows 11', 1),
(6, 'Apple', 'MacBook Pro', 1197.00, 5, './images/6.jpg', '15.4" (512GB SSD, Intel Core i9 9th Gen., 2.30 GHz, 16GB) Laptop - Space Gray - MV912LL/A (May, 2019)', 1),
(7, 'Lenovo', 'ThinkPad X390', 661.61, 3, './images/7.jpg', '13.3" (512GB SSD, Intel Core i7-8565U, 1.80GHz, 16GB RAM) Notebook - Black (20Q0003VUK)', 1),
(8, 'DELL', 'Latitude 5510', 689.63, 5, './images/8.jpg', '15.6 inch (256GB, Intel Core i5 10th Gen., 1.60GHz, 8GB) Notebook/Laptop - Grey - 1CMDD', 1),
(9, 'Lenovo', 'ThinkPad E15 G2', 925.00, 5, './images/9.jpg', '15.6 Notebook 1920 x 1080 Laptop Black - 20TD001NUS', 1),
(10, 'HP', 'Elite X2 1013 G3', 860.05, 5, './images/10.jpg', '2-in-1, Full HD Touchscreen, i5-8350U, 16GB RAM, 512GB SSD', 1);

CREATE TABLE `orders` (
                        `order_id` int(10) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                        `item_name` varchar(255) NOT NULL,
                        `user_id` int(10) NOT NULL,
                        `accepted` int(1) NOT NULL DEFAULT 0,
                        `cancelled` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;