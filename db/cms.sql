-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2016 at 10:16 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Bootstrap'),
(2, 'Javascript'),
(3, 'PHP');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_date` date NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` varchar(255) NOT NULL,
  `comment_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_date`, `comment_author`, `comment_email`, `comment_content`, `comment_status`) VALUES
(6, 1, '2016-07-05', 'Brandon Meeks', 'brandon@sjconfections.com', 'This is an amazing comment!', 'Unapproved'),
(7, 1, '2016-07-08', 'John Dow', 'john@example.com', 'I love this post so much!', 'Approved'),
(8, 19, '2016-07-26', 'Brandon', 'brandon@test.com', 'This is an awesome post!', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `google_analytics`
--

CREATE TABLE `google_analytics` (
  `tracking_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_view_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_view_count`) VALUES
(1, 1, 'Brandons PHP CMS Post', 'John Doe', '2016-06-21', 'logo-black-sm.png', '<p><strong>Wow, I really like making this CMS.</strong></p>', 'CMS, Javascript, PHP', 2, 'Published', 0),
(7, 1, 'Test Test', 'Brandon', '2007-01-16', '', 'testing date', 'PHP, Date', 4, 'Published', 0),
(16, 1, 'This is my post', 'Brandon Meeks', '2016-07-21', 'about-bg.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec efficitur metus sit amet fringilla varius. In eu orci diam. Quisque laoreet tellus nec eros mattis, eget tincidunt justo laoreet. Pellentesque sit amet ornare ligula, suscipit placerat dui. Ut varius ex at neque mattis blandit eu non quam. Pellentesque egestas diam felis, a pharetra ipsum mollis eu. Curabitur quis efficitur neque. Nulla ultricies condimentum tincidunt. Nulla nec augue nec sapien feugiat congue. Pellentesque posuere congue leo, sed dictum dui hendrerit at. Fusce tincidunt tortor et arcu elementum, vitae cursus lacus interdum. Aliquam sit amet tempor ipsum. Morbi pellentesque leo magna, a finibus purus varius auctor. Etiam tempus nec dui a blandit. Proin pellentesque et arcu nec aliquet. Duis facilisis est non est porta, condimentum tempus massa vestibulum.', 'PHP, CMS, Testing', 0, 'Published', 4),
(18, 1, 'This is my post', 'Brandon Meeks', '2016-07-21', 'about-bg.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec efficitur metus sit amet fringilla varius. In eu orci diam. Quisque laoreet tellus nec eros mattis, eget tincidunt justo laoreet. Pellentesque sit amet ornare ligula, suscipit placerat dui. Ut varius ex at neque mattis blandit eu non quam. Pellentesque egestas diam felis, a pharetra ipsum mollis eu. Curabitur quis efficitur neque. Nulla ultricies condimentum tincidunt. Nulla nec augue nec sapien feugiat congue. Pellentesque posuere congue leo, sed dictum dui hendrerit at. Fusce tincidunt tortor et arcu elementum, vitae cursus lacus interdum. Aliquam sit amet tempor ipsum. Morbi pellentesque leo magna, a finibus purus varius auctor. Etiam tempus nec dui a blandit. Proin pellentesque et arcu nec aliquet. Duis facilisis est non est porta, condimentum tempus massa vestibulum.', 'PHP, CMS, Testing', 0, 'Published', 4),
(19, 3, 'PHP Programming', 'brandon', '2016-07-21', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer molestie sapien id elit faucibus facilisis ut et quam. Nulla dolor nibh, dictum vitae urna vitae, maximus elementum risus. Nulla a gravida arcu. Mauris luctus velit at dolor varius, ut dignissim risus tempus. Suspendisse libero nunc, consectetur vitae posuere ut, vehicula ac enim. Donec mattis lorem at lectus porta vulputate. Maecenas malesuada ullamcorper imperdiet.</p>\r\n<p>Nam nec viverra libero. Maecenas sit amet massa porttitor, porttitor risus et, vestibulum enim. Sed aliquam dolor luctus nisi mollis tempor. Vestibulum ac eros non dolor egestas consectetur a eget massa. Etiam fringilla velit a dignissim congue. Fusce feugiat sem odio, vel auctor dui aliquam et. Phasellus tristique lectus massa, id aliquet diam scelerisque ac. In dapibus eleifend congue. Fusce eget ligula egestas ligula molestie vestibulum quis quis ex. Vivamus facilisis tincidunt egestas. Maecenas euismod turpis quis odio facilisis eleifend ac mollis leo. Nulla elit tellus, vulputate non imperdiet eget, mollis ut turpis. Sed in varius nisi, a auctor enim. Aliquam vel orci ut eros viverra imperdiet.</p>\r\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis metus velit, tristique sed egestas at, sodales ac sem. Donec non nisl sed leo tempus interdum. Fusce ullamcorper lorem id justo porttitor, consequat accumsan nulla porta. Integer sodales odio neque, in porttitor odio aliquam sit amet. Aliquam vel mattis tortor, id fringilla enim. Maecenas eu purus pharetra, ultricies risus at, euismod est. Sed a risus nec augue egestas ultricies non sit amet odio. Nulla tincidunt, massa id posuere tincidunt, urna augue vehicula ligula, eget sodales velit ligula vel ipsum. Vestibulum sodales et neque eget ullamcorper.</p>', 'WebDev', 1, 'Published', 7),
(20, 3, 'PHP Programming', 'brandon', '2016-08-01', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer molestie sapien id elit faucibus facilisis ut et quam. Nulla dolor nibh, dictum vitae urna vitae, maximus elementum risus. Nulla a gravida arcu. Mauris luctus velit at dolor varius, ut dignissim risus tempus. Suspendisse libero nunc, consectetur vitae posuere ut, vehicula ac enim. Donec mattis lorem at lectus porta vulputate. Maecenas malesuada ullamcorper imperdiet.</p>\r\n<p>Nam nec viverra libero. Maecenas sit amet massa porttitor, porttitor risus et, vestibulum enim. Sed aliquam dolor luctus nisi mollis tempor. Vestibulum ac eros non dolor egestas consectetur a eget massa. Etiam fringilla velit a dignissim congue. Fusce feugiat sem odio, vel auctor dui aliquam et. Phasellus tristique lectus massa, id aliquet diam scelerisque ac. In dapibus eleifend congue. Fusce eget ligula egestas ligula molestie vestibulum quis quis ex. Vivamus facilisis tincidunt egestas. Maecenas euismod turpis quis odio facilisis eleifend ac mollis leo. Nulla elit tellus, vulputate non imperdiet eget, mollis ut turpis. Sed in varius nisi, a auctor enim. Aliquam vel orci ut eros viverra imperdiet.</p>\r\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis metus velit, tristique sed egestas at, sodales ac sem. Donec non nisl sed leo tempus interdum. Fusce ullamcorper lorem id justo porttitor, consequat accumsan nulla porta. Integer sodales odio neque, in porttitor odio aliquam sit amet. Aliquam vel mattis tortor, id fringilla enim. Maecenas eu purus pharetra, ultricies risus at, euismod est. Sed a risus nec augue egestas ultricies non sit amet odio. Nulla tincidunt, massa id posuere tincidunt, urna augue vehicula ligula, eget sodales velit ligula vel ipsum. Vestibulum sodales et neque eget ullamcorper.</p>', 'WebDev', 0, 'Published', 0),
(21, 1, 'This is my post', 'Brandon Meeks', '2016-08-01', 'about-bg.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec efficitur metus sit amet fringilla varius. In eu orci diam. Quisque laoreet tellus nec eros mattis, eget tincidunt justo laoreet. Pellentesque sit amet ornare ligula, suscipit placerat dui. Ut varius ex at neque mattis blandit eu non quam. Pellentesque egestas diam felis, a pharetra ipsum mollis eu. Curabitur quis efficitur neque. Nulla ultricies condimentum tincidunt. Nulla nec augue nec sapien feugiat congue. Pellentesque posuere congue leo, sed dictum dui hendrerit at. Fusce tincidunt tortor et arcu elementum, vitae cursus lacus interdum. Aliquam sit amet tempor ipsum. Morbi pellentesque leo magna, a finibus purus varius auctor. Etiam tempus nec dui a blandit. Proin pellentesque et arcu nec aliquet. Duis facilisis est non est porta, condimentum tempus massa vestibulum.', 'PHP, CMS, Testing', 0, 'Published', 0),
(22, 1, 'This is my post', 'Brandon Meeks', '2016-08-01', 'about-bg.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec efficitur metus sit amet fringilla varius. In eu orci diam. Quisque laoreet tellus nec eros mattis, eget tincidunt justo laoreet. Pellentesque sit amet ornare ligula, suscipit placerat dui. Ut varius ex at neque mattis blandit eu non quam. Pellentesque egestas diam felis, a pharetra ipsum mollis eu. Curabitur quis efficitur neque. Nulla ultricies condimentum tincidunt. Nulla nec augue nec sapien feugiat congue. Pellentesque posuere congue leo, sed dictum dui hendrerit at. Fusce tincidunt tortor et arcu elementum, vitae cursus lacus interdum. Aliquam sit amet tempor ipsum. Morbi pellentesque leo magna, a finibus purus varius auctor. Etiam tempus nec dui a blandit. Proin pellentesque et arcu nec aliquet. Duis facilisis est non est porta, condimentum tempus massa vestibulum.', 'PHP, CMS, Testing', 0, 'Published', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstName` varchar(255) NOT NULL,
  `user_lastName` varchar(255) NOT NULL,
  `user_email` varchar(244) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `user_status` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10iusesomecrazystrings22'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstName`, `user_lastName`, `user_email`, `user_image`, `user_role`, `user_status`, `randSalt`) VALUES
(1, 'brandon', 'admin123', 'Brandon', 'Meeks', 'brandon@sjconfections.com', '', 'Admin', 'Approved', '$2y$10iusesomecrazystrings22'),
(2, 'webmaster', 'webmaster', 'Web', 'Testery', 'webmaster@example.com', '', 'Basic User', 'Unapproved', '$2y$10iusesomecrazystrings22'),
(3, 'User1', 'user123', 'User', 'Test', 'user@example.com', '', 'Basic User', 'Approved', '$2y$10iusesomecrazystrings22'),
(9, 'demo', '$2na18.GA/zY.', '', '', 'demo@example.com', '', 'Basic User', 'Unapproved', '$2y$10iusesomecrazystrings22'),
(11, 'admin', '$25NMAEGsTy/U', '', '', 'admin@test.com', '', 'Basic User', 'Unapproved', '$2y$10iusesomecrazystrings22');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `session_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
