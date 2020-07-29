-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2020 at 03:05 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imageapp_0710`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` mediumint(9) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Portraits'),
(2, 'Landscapes'),
(3, 'Pet Photos'),
(4, 'Black and White'),
(5, 'Wedding Photography'),
(6, 'Macro Photos'),
(7, 'Cars');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `comment_id` mediumint(9) NOT NULL,
  `body` varchar(300) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `date` datetime NOT NULL,
  `post_id` mediumint(9) NOT NULL,
  `is_approved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `body`, `user_id`, `date`, `post_id`, `is_approved`) VALUES
(1, 'This is a comment from second user on the first post', 2, '2020-07-17 08:42:08', 1, 1),
(2, 'This is a comment from the first user on the second post', 1, '2020-07-17 08:42:08', 2, 1),
(4, 'eye contact!', 1, '2020-07-22 09:41:29', 1, 1),
(5, 'fjfsdyjsrkr', 1, '2020-07-22 09:53:42', 1, 1),
(6, 'testing anchor\r\n', 1, '2020-07-22 09:55:23', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE `likes` (
  `like_id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `post_id` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `post_id` mediumint(9) NOT NULL,
  `image` varchar(100) NOT NULL,
  `body` varchar(2200) NOT NULL,
  `date` datetime NOT NULL,
  `title` varchar(50) NOT NULL,
  `category_id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `allow_comments` tinyint(1) NOT NULL,
  `is_published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `image`, `body`, `date`, `title`, `category_id`, `user_id`, `allow_comments`, `is_published`) VALUES
(1, 'https://picsum.photos/id/237/600', 'It\'s a puppy', '2020-07-17 08:39:10', 'Black lab pup', 1, 1, 1, 1),
(2, 'https://picsum.photos/id/1023/600', 'apparently you can climb trees on a mountainbike', '2020-07-17 08:39:10', 'climbing trees', 2, 2, 1, 1),
(3, 'https://picsum.photos/id/1018/600', 'you can almost smell the rain in this image', '2020-07-18 09:18:13', 'mountain road', 2, 16, 1, 1),
(4, 'https://picsum.photos/id/1015/600', 'super saturated colors in this one', '2020-07-19 08:39:10', 'River landscape', 2, 1, 1, 1),
(5, 'https://picsum.photos/id/1011/600', 'I think it\'s a canoe', '2020-07-20 08:39:10', 'woman in a canoe', 1, 2, 0, 1),
(6, 'https://picsum.photos/id/1003/600', 'It\'s a little deer fawn', '2020-07-20 09:18:13', 'Quiet morning', 3, 14, 1, 1),
(7, 'https://picsum.photos/id/0/600', 'makes you think of getting work done', '2020-07-21 08:39:10', 'laptop on a desk with coffee', 6, 1, 1, 1),
(8, 'https://picsum.photos/id/1025/600', 'so cozy', '2020-07-22 08:39:10', 'Pug in a blanket', 3, 2, 1, 1),
(9, 'https://picsum.photos/id/1012/600', 'It\'s a guy and his pup', '2020-07-22 09:18:13', 'Happy Monday', 3, 15, 1, 1),
(10, 'https://picsum.photos/id/100/600', 'sort of spooky', '2020-07-23 08:39:10', 'washed out beach', 2, 3, 0, 1),
(11, 'https://picsum.photos/id/10/600', 'so cozy', '2020-07-23 08:39:10', 'Forest view', 2, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `tag_id` mediumint(9) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` mediumint(9) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(40) NOT NULL,
  `profile_pic` varchar(100) NOT NULL,
  `bio` varchar(400) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `join_date` datetime NOT NULL,
  `salt` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `profile_pic`, `bio`, `is_admin`, `join_date`, `salt`) VALUES
(1, 'Administrator', 'admin@imageapp.com', 'ae1a133e16d23fc0c8c55d964e1bc5b21748cadb', 'https://randomuser.me/api/portraits/lego/9.jpg', 'I like food, bye', 1, '2020-07-17 08:23:27', '103547f50eca783e808f'),
(2, 'Felix Graham', 'random@email.com', '982f163c47eda80cc1063cbf9ed94831456c55fc', 'https://randomuser.me/api/portraits/men/66.jpg', 'just a made up non-admin user', 0, '2020-07-17 08:27:28', '502b91c21b448b8e9b16'),
(3, 'Marilyn Lowe', 'breakfast@gmail.com', '53b866d6ba09d3931ffc5b1898a546d20d943e59', 'https://randomuser.me/api/portraits/women/46.jpg', 'I am an egg', 0, '2020-07-22 08:25:34', '38c355b22fe384b7c3e4'),
(14, 'Stephanie Olson', 'random877@mail.com', 'f4e65eff5ea57f49b850cb0139df981b1076eb8b', 'https://randomuser.me/api/portraits/women/26.jpg', '', 0, '2020-07-29 08:14:59', '8e653e348334db3b1195'),
(15, 'Vernon Howard ', 'random2354@mail.com', '1933d6a59e0129dd29442fd6e30a39368a3afea9', 'https://randomuser.me/api/portraits/men/55.jpg', '', 0, '2020-07-29 08:16:28', 'd1dc7bf830cf1a8cf6be'),
(16, 'AntoniaHarris', 'avocado@mail.com', '417daffa8366350887ee120999276caefe7c66dd', 'https://randomuser.me/api/portraits/women/70.jpg', '', 0, '2020-07-29 09:36:32', '0ab0f8f4daac36e74595');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
