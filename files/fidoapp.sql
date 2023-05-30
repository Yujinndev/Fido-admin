-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2023 at 10:35 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fidoapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `name`) VALUES
(1, 'ADOPTION'),
(2, 'DONATION'),
(3, 'EDUCATION');

-- --------------------------------------------------------

--
-- Table structure for table `donationtransac`
--

CREATE TABLE `donationtransac` (
  `transacId` varchar(255) NOT NULL,
  `userId` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `dateTransac` datetime NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `totalAmount` int(11) NOT NULL,
  `remarks` enum('Donated','Withdrawn') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donationtransac`
--

INSERT INTO `donationtransac` (`transacId`, `userId`, `itemId`, `dateTransac`, `quantity`, `totalAmount`, `remarks`) VALUES
('6470d238e3f10', 2, 1, '2023-05-24 04:01:50', 5, 3000, 'Donated'),
('6470d238e3f3b', 2, 2, '2023-05-26 17:01:21', 2, 998, 'Donated'),
('6470d238e3t32', 3, 3, '2023-05-29 09:06:10', 2, 998, 'Donated'),
('647457772d446', 1, 3, '2023-05-29 09:42:47', NULL, 998, 'Withdrawn'),
('647457c56dc6f', 1, 2, '2023-05-29 09:44:05', NULL, 998, 'Withdrawn');

-- --------------------------------------------------------

--
-- Table structure for table `educmat`
--

CREATE TABLE `educmat` (
  `matId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(2500) NOT NULL,
  `author` int(11) NOT NULL,
  `datePosted` datetime NOT NULL,
  `reference` varchar(255) NOT NULL,
  `status` enum('Published','Unpublished') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `educmat`
--

INSERT INTO `educmat` (`matId`, `title`, `content`, `author`, `datePosted`, `reference`, `status`) VALUES
(1, 'How to Stay Healthy Around Pets and Other Animalsss', 'There are many health benefits of owning a pet. They can increase opportunities to exercise, get outside, and socialize. Regular walking or playing with pets can decrease blood pressure, cholesterol levels, and triglyceride levels.  Pets can help manage.', 1, '2023-05-24 13:52:25', 'https://www.cdc.gov/healthypets/keeping-pets-and-people-healthy/how.ht', 'Published'),
(2, 'All About Dogs', 'Dogs can have many positive effects on the lives of their owners. They influence social, emotional, and cognitive development in children, promote an active lifestyle, provide companionship, and have even been able to detect oncoming epileptic seizures or', 2, '2023-05-24 03:52:25', 'https://www.cdc.gov/healthypets/pets/dogs.html', 'Unpublished');

-- --------------------------------------------------------

--
-- Table structure for table `itemdonations`
--

CREATE TABLE `itemdonations` (
  `itemId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `description` varchar(2500) NOT NULL,
  `price` int(11) NOT NULL,
  `currentStocks` int(11) DEFAULT NULL,
  `quarterlyStocks` int(11) NOT NULL,
  `lastWithdrawn` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `itemdonations`
--

INSERT INTO `itemdonations` (`itemId`, `name`, `photo`, `description`, `price`, `currentStocks`, `quarterlyStocks`, `lastWithdrawn`) VALUES
(1, 'Vitamins', NULL, 'Pet\'s vitamins provide essential nutrients and supplements to support the overall health and well-being of your beloved pets, ensuring they receive the necessary vitamins and minerals for optimal vitality.', 600, 5, 15, '2023-05-24 03:59:01'),
(2, 'Foods', NULL, 'High-quality dog and cat food offers a balanced and nutritious diet, promoting proper growth, strong immune systems, and healthy digestion for your furry companions.', 499, 0, 15, '2023-05-24 03:59:01'),
(3, 'Grooming', NULL, 'Grooming products help maintain the hygiene and appearance of your pets, keeping their coats clean, shiny, and free from tangles, while also providing soothing care for their skin.', 499, 0, 15, '2023-05-24 04:00:33');

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `petId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('Cat','Dog') NOT NULL,
  `age` varchar(255) NOT NULL,
  `status` enum('Unvaccinated','Vaccinated') NOT NULL,
  `availability` enum('Available','Not Available') NOT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`petId`, `name`, `type`, `age`, `status`, `availability`, `photo`) VALUES
(1001, 'Wabi Doo', 'Cat', '10 months old', 'Vaccinated', 'Available', 'https://images.unsplash.com/photo-1593483316242-efb5420596ca?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80'),
(1002, 'Winter Bell', 'Cat', '3 years old', 'Unvaccinated', 'Available', 'https://images.unsplash.com/photo-1624065935863-bf91d00e2c76?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1171&q=80'),
(1003, 'Peanut', 'Cat', '3 years old', 'Vaccinated', 'Not Available', 'https://images.unsplash.com/photo-1609779361684-8196b3a0abf1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80'),
(1004, 'Blackie', 'Dog', '5 years old', 'Vaccinated', 'Not Available', 'https://plus.unsplash.com/premium_photo-1676389282268-68e11d91d8a4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=686&q=80'),
(1006, 'Chi Chi', 'Cat', '3 months old', 'Unvaccinated', 'Available', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `requestId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `petId` int(11) NOT NULL,
  `dateRequested` datetime NOT NULL,
  `requestStatus` enum('Accepted','Denied','Waiting') NOT NULL,
  `reason` varchar(2500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`requestId`, `userId`, `petId`, `dateRequested`, `requestStatus`, `reason`) VALUES
(1, 2, 1003, '2023-05-28 16:19:06', 'Denied', 'I am interested in adopting a cat from Animal Welfare because I believe in giving a loving and forever home to a deserving feline companion. I value the opportunity to provide a second chance to a cat in need, offering them a safe and caring environment where they will be cherished as a member of my family. I am committed to providing the necessary care, love, and attention that a cat deserves, and I am excited about the prospect of creating a lifelong bond with a wonderful feline friend.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `phoneNum` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `role` enum('Admin','User') NOT NULL,
  `adoptedPets` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `email`, `password`, `firstname`, `lastname`, `age`, `phoneNum`, `address`, `province`, `photo`, `role`, `adoptedPets`) VALUES
(1, 'markeugene@gmail.com', 'admin123', 'Mark Eugene', 'Laysa', 19, '+639567953354', 'Borono, Tagudin 2714', 'Ilocos Sur', 'https://mdbcdn.b-cdn.net/img/new/avatars/8.webp', 'Admin', 0),
(2, 'altheajazel@gmail.com', 'qwerty123', 'Althea Jazel', 'Rito', 20, '+639308375686', 'Lingsat, San Fernando 2500', 'La Union', 'https://mdbcdn.b-cdn.net/img/new/avatars/5.webp', 'User', 2),
(3, 'johndoe@gmail.com', 'john123', 'John', 'Doe', 22, '+632354654747', 'Lingsat, San Fernando', 'La Union', NULL, 'User', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `donationtransac`
--
ALTER TABLE `donationtransac`
  ADD PRIMARY KEY (`transacId`),
  ADD KEY `fk_donationTransac_userId` (`userId`) USING BTREE,
  ADD KEY `fk_donationTransac_itemId` (`itemId`);

--
-- Indexes for table `educmat`
--
ALTER TABLE `educmat`
  ADD PRIMARY KEY (`matId`),
  ADD KEY `fk_educmat_author` (`author`);

--
-- Indexes for table `itemdonations`
--
ALTER TABLE `itemdonations`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`petId`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`requestId`),
  ADD KEY `fk_requests_petId` (`petId`),
  ADD KEY `fk_requests_userId` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `uc_users_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `educmat`
--
ALTER TABLE `educmat`
  MODIFY `matId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `itemdonations`
--
ALTER TABLE `itemdonations`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `petId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1007;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `requestId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donationtransac`
--
ALTER TABLE `donationtransac`
  ADD CONSTRAINT `fk_donationTransac_itemId` FOREIGN KEY (`itemId`) REFERENCES `itemdonations` (`itemId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_donationTransac_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `educmat`
--
ALTER TABLE `educmat`
  ADD CONSTRAINT `fk_educmat_author` FOREIGN KEY (`author`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `fk_requests_petId` FOREIGN KEY (`petId`) REFERENCES `pets` (`petId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_requests_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
