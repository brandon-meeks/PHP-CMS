-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2016 at 07:58 AM
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
(3, 3, '2016-07-05', 'Brandon Meeks', 'brandon.meeks@patronpath.com', 'This is a sample comment for this post', 'Approved'),
(4, 3, '2016-07-05', 'Brandon Meeks', 'brandon@sjconfections.com', 'This is a comment', 'Unapproved'),
(5, 3, '2016-07-05', 'John Smith', 'jsmith@example.com', 'This is a comment', 'Approved'),
(6, 1, '2016-07-05', 'Brandon Meeks', 'brandon@sjconfections.com', 'This is an amazing comment!', 'Approved'),
(7, 1, '2016-07-08', 'John Dow', 'john@example.com', 'I love this post so much!', 'Approved');

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
  `post_status` varchar(255) NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`) VALUES
(1, 1, 'Brandons PHP CMS Post', 'John Doe', '2016-06-21', 'logo-black-sm.png', 'Wow, I really like making this CMS.', 'CMS, Javascript, PHP', 2, 'Published'),
(2, 1, 'My PHP CMS', 'John Doe', '2016-06-21', '', 'I really like learning to program in PHP', 'PHP, CMS', 0, 'draft'),
(3, 1, 'This is my post', 'Brandon Meeks', '0000-00-00', 'about-bg.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec efficitur metus sit amet fringilla varius. In eu orci diam. Quisque laoreet tellus nec eros mattis, eget tincidunt justo laoreet. Pellentesque sit amet ornare ligula, suscipit placerat dui. Ut varius ex at neque mattis blandit eu non quam. Pellentesque egestas diam felis, a pharetra ipsum mollis eu. Curabitur quis efficitur neque. Nulla ultricies condimentum tincidunt. Nulla nec augue nec sapien feugiat congue. Pellentesque posuere congue leo, sed dictum dui hendrerit at. Fusce tincidunt tortor et arcu elementum, vitae cursus lacus interdum. Aliquam sit amet tempor ipsum. Morbi pellentesque leo magna, a finibus purus varius auctor. Etiam tempus nec dui a blandit. Proin pellentesque et arcu nec aliquet. Duis facilisis est non est porta, condimentum tempus massa vestibulum.', 'PHP, CMS, Testing', 4, 'Draft'),
(7, 1, 'Test Test', 'Brandon', '2007-01-16', '', 'testing date', 'PHP, Date', 4, 'Draft'),
(8, 2, 'Testing Post Creation', 'Webmaster', '2007-01-16', '', 'web web web', 'web', 4, 'Draft'),
(9, 3, 'Best PHP Course Ever', 'Brandon', '2007-05-16', '', 'Aenean id pharetra leo, non convallis nunc. Donec convallis, magna et hendrerit molestie, erat urna aliquet diam, pulvinar congue quam elit in erat. Sed vel ultrices ex, at mollis risus. Cras risus ligula, accumsan id mollis eu, maximus non magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse cursus rhoncus est non accumsan. Ut gravida a nulla sed tristique. Etiam mollis dui in accumsan lacinia. Pellentesque ultricies lectus quis turpis mollis ullamcorper. Quisque mattis feugiat consequat. Maecenas sit amet ex ac magna maximus volutpat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis non diam maximus, efficitur odio eget, tristique ex. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut facilisis metus nisl, in pretium nisl condimentum id. Donec accumsan dui urna, nec volutpat arcu gravida sed.', 'PHP, Learning', 4, 'Published');

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
  `randSalt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstName`, `user_lastName`, `user_email`, `user_image`, `user_role`, `user_status`, `randSalt`) VALUES
(1, 'brandon', 'admin123', 'Brandon', 'Meeks', 'brandon@sjconfections.com', '', 'Admin', 'Approved', '0');

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
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
