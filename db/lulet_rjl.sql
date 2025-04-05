-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2025 at 12:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lulet_rjl`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `address`, `email`, `order_date`) VALUES
(24, 'test', 'test', 'test@mail.com', '2025-04-05'),
(25, 'inf', 'infinite', 'try@mail.com', '2025-04-05'),
(26, 'Fabest Sharra', 'Test', 'fabestsharra@gmail.com', '2025-04-05'),
(27, 'tesg', 'test', '1234@mail.com', '2025-04-05'),
(28, '123', 'test', 't1@mail.com', '2025-04-05'),
(29, 'teest', 'teeeest', 'teeeeeeest@mail.com', '2025-04-05'),
(30, 'Test', 'test', 'test@mail.com', '2025-04-05'),
(31, 'test', 'test', 'test@mail.com', '2025-04-05'),
(32, 'test', 'test per heren e 10909090-0', 'test@mail.com', '2025-04-05');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_name`, `quantity`, `price`) VALUES
(1, 28, 'Item 1', 2, 15.99),
(2, 30, 'Pink Lily Bouquet', 1, 39.00),
(3, 30, 'Mixed Tulip Bouquet', 1, 49.00),
(4, 30, 'Mixed Tulip Bouquet', 1, 49.00),
(5, 30, 'Red Tulip Bouquet', 1, 24.00),
(6, 31, 'Red Tulip Bouquet', 1, 24.00),
(7, 32, 'Red Tulip Bouquet', 1, 24.00),
(8, 32, 'White Lily Arragement', 1, 64.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `description` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `description`, `stock`, `photo`) VALUES
(1, 'Pink Lily Bouquet', 39, 'A vibrant arrangement of pink lilies in a clear vase. Elegant and fresh!', 11, 'flower1.jpg'),
(2, 'Pink Lily Bouquet', 39, 'A vibrant arrangement of pink lilies in a clear vase. Elegant and fresh!', 11, 'flower2.jpg'),
(3, 'Red Tulip Bouquet', 24, 'A classic red tulip arrangement in a glass vase, perfect for romantic occasions', 15, 'flower3.jpg'),
(4, 'Mixed Tulip Bouquet', 49, 'A blend of red and yellow tulips, adding a lively and colorful touch.', 7, 'flower4.jpg'),
(5, 'White and Pink Tulip Bouqet', 59, ' A soft elegant combination of pink and white tulips in a ceramic vase.', 3, 'flower5.png'),
(6, 'White Lily Arragement', 64, ' A delicate and graceful display of white lilies in a minimalist vase.', 14, 'flower6.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
