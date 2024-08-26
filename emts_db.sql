-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 08:35 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emts_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_log`
--

CREATE TABLE `audit_log` (
  `action_id` int(11) NOT NULL,
  `memo_id` int(11) DEFAULT NULL,
  `action_type` varchar(50) DEFAULT NULL,
  `action_date` date DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audit_log`
--

INSERT INTO `audit_log` (`action_id`, `memo_id`, `action_type`, `action_date`, `user_email`) VALUES
(1, 4, 'Created', '2024-07-26', 'flower@gmail.com'),
(2, 5, 'Created', '2024-07-26', 'john@gmail.com'),
(3, 6, 'Created', '2024-08-16', 'maria@gmail.com'),
(4, 9, 'Created', '2024-08-16', 'crystal@gmail.com'),
(5, 10, 'Created', '2024-08-17', 'crystal@gmail.com'),
(6, 11, 'Created', '2024-08-17', 'crystal@gmail.com'),
(7, 4, 'Received', '2024-08-19', 'john@gmail.com'),
(8, 4, 'Received', '2024-08-19', 'john@gmail.com'),
(12, 4, 'Received', '2024-08-19', 'john@gmail.com'),
(13, 11, 'Received', '2024-08-19', 'john@gmail.com'),
(14, 10, 'Received', '2024-08-19', 'john@gmail.com'),
(15, 5, 'Received', '2024-08-20', 'john@gmail.com'),
(16, 1, 'Received', '2024-08-20', 'kenniezion@gmail.com'),
(17, 10, 'Forwarded', '2024-08-20', 'crystal@gmail.com'),
(18, 3, 'Forwarded', '2024-08-20', 'flower@gmail.com'),
(19, 2, 'Forwarded', '2024-08-20', 'john@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `dept_name`) VALUES
(3, 'Audit'),
(1, 'E-services'),
(4, 'Office of PS'),
(2, 'Procurement'),
(5, 'Research and Development');

-- --------------------------------------------------------

--
-- Table structure for table `memos`
--

CREATE TABLE `memos` (
  `memo_id` int(11) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `Author` varchar(50) NOT NULL,
  `To_Department` varchar(50) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `memos`
--

INSERT INTO `memos` (`memo_id`, `subject`, `Author`, `To_Department`, `Status`, `date_created`) VALUES
(1, 'meeting', 'flower@gmail.com', '2', 'Received', '2024-07-07'),
(2, 'Party', 'john@gmail.com', '5', 'Forwarded', '2024-05-08'),
(3, 'Orientation', 'flower@gmail.com', '1', 'Forwarded', '2024-05-08'),
(4, 'surprise party', 'flower@gmail.com', '', '', '2024-05-02'),
(5, 'Payment for lunch', 'john@gmail.com', '3', 'Forwarded', '2024-07-05'),
(6, 'Repair computers', 'maria@gmail.com', '2', 'Pending', '2024-06-13'),
(9, 'payment for water bills', 'crystal@gmail.com', '4', 'Pending', '2024-08-06'),
(10, 'money for cables', 'crystal@gmail.com', '4', 'Forwarded', '2024-07-28'),
(11, 'Meeting with guests', 'crystal@gmail.com', '3', 'Received', '2024-08-07');

--
-- Triggers `memos`
--
DELIMITER $$
CREATE TRIGGER `after_memo_forwarded` AFTER UPDATE ON `memos` FOR EACH ROW BEGIN
    IF NEW.Status = 'Forwarded' THEN
        -- Insert into audit_log with user email retrieved from users table
        INSERT INTO audit_log (memo_id, action_type, action_date, user_email)
        VALUES (
            NEW.memo_id,
            'Forwarded',
            NOW(),
            (SELECT email FROM users WHERE users.email = NEW.Author) -- Assuming NEW.Author holds the user reference
        );
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_memo_insert` AFTER INSERT ON `memos` FOR EACH ROW BEGIN
    INSERT INTO audit_log (memo_id, action_type, action_date, user_email)
    VALUES (NEW.memo_id, 'Created', NOW(), NEW.author);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `receipients`
--

CREATE TABLE `receipients` (
  `id` int(11) NOT NULL,
  `memo_id` int(11) DEFAULT NULL,
  `user_email` varchar(50) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `date_received` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receipients`
--

INSERT INTO `receipients` (`id`, `memo_id`, `user_email`, `status`, `date_received`) VALUES
(1, 4, 'john@gmail.com', 'Received', '2024-08-19 22:27:12'),
(7, 11, 'john@gmail.com', 'Received', '2024-08-19 23:45:09'),
(9, 10, 'john@gmail.com', 'Received', '2024-08-19 23:49:55'),
(10, 5, 'john@gmail.com', 'Received', '2024-08-20 19:46:09'),
(11, 1, 'kenniezion@gmail.com', 'Received', '2024-08-20 20:30:25');

--
-- Triggers `receipients`
--
DELIMITER $$
CREATE TRIGGER `after_receiving_memo` AFTER INSERT ON `receipients` FOR EACH ROW BEGIN
  UPDATE memos
  SET status = 'Received'
  WHERE memo_id = NEW.memo_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_recipient_insert` AFTER INSERT ON `receipients` FOR EACH ROW BEGIN
    INSERT INTO audit_log (memo_id, action_type, action_date, user_email)
    VALUES (NEW.memo_id,'Received', NOW(), NEW.user_email);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `roles` enum('admin','user') NOT NULL,
  `dept_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `roles`, `dept_id`) VALUES
(1, 'Akampurira', 'Precious', 'precious@gmail.com', '123', 'admin', NULL),
(2, 'precious', 'Flower', 'flower@gmail.com', 'hello', 'user', 1),
(3, 'John', 'Paul', 'john@gmail.com', '123', 'user', 3),
(7, 'Namugula', 'Kulthum', 'kulthum@gmail.com', 'hello123', 'user', 4),
(8, 'Precious', 'Maria', 'maria@gmail.com', 'precious', 'user', 4),
(9, 'Bwoye', 'Kenneth', 'kenniezion@gmail.com', 'ken', 'user', 2),
(10, 'Flower', 'Crystal', 'crystal@gmail.com', '1234', 'user', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`action_id`),
  ADD KEY `memo_id` (`memo_id`),
  ADD KEY `user_email` (`user_email`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`),
  ADD UNIQUE KEY `dept_name` (`dept_name`);

--
-- Indexes for table `memos`
--
ALTER TABLE `memos`
  ADD PRIMARY KEY (`memo_id`),
  ADD KEY `Author` (`Author`);

--
-- Indexes for table `receipients`
--
ALTER TABLE `receipients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `memo_id_2` (`memo_id`),
  ADD KEY `user_email` (`user_email`),
  ADD KEY `memo_id` (`memo_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `dept_id` (`dept_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `memos`
--
ALTER TABLE `memos`
  MODIFY `memo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `receipients`
--
ALTER TABLE `receipients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD CONSTRAINT `audit_log_ibfk_1` FOREIGN KEY (`memo_id`) REFERENCES `memos` (`memo_id`),
  ADD CONSTRAINT `audit_log_ibfk_2` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`);

--
-- Constraints for table `memos`
--
ALTER TABLE `memos`
  ADD CONSTRAINT `memos_ibfk_1` FOREIGN KEY (`Author`) REFERENCES `users` (`email`);

--
-- Constraints for table `receipients`
--
ALTER TABLE `receipients`
  ADD CONSTRAINT `receipients_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`),
  ADD CONSTRAINT `receipients_ibfk_2` FOREIGN KEY (`memo_id`) REFERENCES `memos` (`memo_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`dept_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
