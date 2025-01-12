-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 11, 2025 at 04:30 AM
-- Server version: 5.7.43-log
-- PHP Version: 8.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cleansrc`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` varchar(15) NOT NULL,
  `title` text,
  `posted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text NOT NULL,
  `author` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `posted`, `content`, `author`) VALUES
('10PmVWYhgAg', 'EpikTube Return.', '2024-10-05 05:48:13', '<p>I\'ve brought this site back now that I actually know PHP and can maintain it.\nSome new features have been added, such as channels (<a href=\"http://www.epiktube.xyz/channels.php?c=1\">http://www.epiktube.xyz/channels.php?c=1</a>) and Channel 0.5 (<a href=\"http://www.epiktube.xyz/profile.php?user=copy\">http://www.epiktube.xyz/profile.php?user=copy</a>), and the site has undergone a major overhaul.</p>', 'copy'),
('7tgEy3LLzgc', 'Webbing site', '2024-10-25 12:23:57', '<p>website cool</p>', 'copy'),
('itlL2YhWsBQ', 'epiktube 2006', '2024-11-02 06:09:05', '<p>o yeah if u didnt notice its 2006 now lol!!!!!!\n^ i am cool\n^ i am awesome</p>', 'copy'),
('QFxhfU9NTvM', 'New Event!', '2024-12-05 15:02:36', '<p>Want your video thumbnail on a PNG of a Christmas tree from 12-5-2024 to 12-23-2024?, Choose \"EpikTube\'s Christmas Tree\" on next upload!</p>\n<ul>\n<li>Disclaimer: The videos there will move to Event &amp; Weddings after 12-24-2024 and posted on our Discord and will end on 12-25-2024.</li>\n</ul>', 'Mii'),
('QOpYZPDLXkg', 'fdfsdfsfd', '2024-11-01 17:48:46', '<p>sfdfsdsfdfsdfsdsfd</p>', 'copy'),
('S2GQJNg0LbE', 'sfgrerg', '2024-10-30 07:39:49', '<p>rggreg</p>', 'copy'),
('XRoZu3XwbVk', 'EpikTube is back for Christmas!', '2024-12-03 09:52:19', '<p>I\'ve brought back EpikTube for Christmas, because why not</p>', 'copy');

-- --------------------------------------------------------

--
-- Table structure for table `bulletins`
--

CREATE TABLE `bulletins` (
  `id` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` varchar(255) NOT NULL,
  `posted` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `vid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bulletins`
--

INSERT INTO `bulletins` (`id`, `uid`, `title`, `body`, `posted`, `vid`) VALUES
('4QfWeXfNM2Q', 'hW1eBlwjaKo', 'horse', 'chat', '2024-12-14 17:17:38', 'NVGJvGAlbJE'),
('8gJKWfHsMRs', 'XVJ20P_zxzE', 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'zzzzzzzzzzzzzzzzzzzzzzzzz', '2024-12-13 14:19:44', ''),
('CZyNeOruKbM', 'pjDXW3v5jCQ', 'hi', 'bulletin test', '2024-12-17 05:43:39', ''),
('ErdzAVHuxWk', 'fpe08ExiUhM', 'coo awlesome', 'My bullet teen', '2024-11-09 18:10:59', ''),
('JOCzSBPSodY', 'XVJ20P_zxzE', 'dsaa', 'sasdadas', '2024-11-09 16:54:46', ''),
('jrohJOcQBOU', 'hW1eBlwjaKo', 'not now, not ever, not now, not ever', 'for miles - venturing', '2024-11-09 21:21:03', ''),
('nAdUJQjQ_S8', 'XVJ20P_zxzE', 'ok', 'ok', '2024-11-09 17:40:33', '1rClLaglABs'),
('PsLp0uC0iOY', 'bdDmS8ydHo0', 'HEHEHEHEEHEHHEEHEHHEEHEEHEHHEEHEEEEEHEEEHEEHEHWHWEEEHWWWEEEEHEEHHEEHEAH!', 'AAAAEAEAEAAEEAAAAAAA', '2024-12-03 17:42:21', ''),
('TiRrKXYPQmM', 'XVJ20P_zxzE', 'Body', 'Retro', '2024-12-02 17:53:07', ''),
('yTl6QKol-34', 'XVJ20P_zxzE', 'efesd', 'osaka', '2024-12-13 14:25:39', 'x50eA6LqUDw'),
('Z7_HpekG8AY', 'XVJ20P_zxzE', 'df', 'fff', '2024-11-09 16:23:38', 'J0gAdcJJFn8'),
('zgCDJG7qfno', 'XVJ20P_zxzE', 'Christmas, just a week away. Christmas is in a week! Woohoo! I am so happy about this information. Christmas! Just a week away, oh wow. Can you believe it? Christmas! Just in a week! It got here so fast! Christmas! Just a week away!', 'Can you believe it guys?', '2024-12-02 17:49:48', '');

-- --------------------------------------------------------

--
-- Table structure for table `channelcomments`
--

CREATE TABLE `channelcomments` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `vidatt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

CREATE TABLE `channels` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `orderid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `channels`
--

INSERT INTO `channels` (`id`, `name`, `description`, `orderid`) VALUES
(1, 'Arts & Animation', 'Artistic, Computer Graphics, Anime...', 1),
(2, 'Autos & Vehicles', 'Cars, Boats, Airplanes...', 4),
(3, 'Education & Instructional', 'Tutorials, Software Demos, Cooking Techniques...', 7),
(4, 'Events & Weddings', 'Parties, Birthdays, Graduations...', 10),
(5, 'Entertainment', 'Trailers, Commercials...', 13),
(6, 'Family', 'Babies, Holidays, Memories...', 16),
(7, 'For Sale & Auctions', 'eBay, Craigslist...', 20),
(8, 'Hobbies & Interests', 'Haunted Dolls, Cooking, RC Planes...', 2),
(9, 'Humor', 'Funny, Bloopers, Pranks...', 5),
(10, 'Music', 'Dancing, Singing, Guitars...', 8),
(11, 'News & Politics', 'Breaking News, Weather, Speeches...', 11),
(12, 'Odd & Outrageous', 'Flips, Jumps, Unexplainable...', 14),
(13, 'People', 'Celebrities, Hot Girls, Cool Guys...', 17),
(14, 'Personals & Dating', 'Video Profiles, Interesting People...', 21),
(15, 'Pets & Animals', 'Cats, Dogs, Fish, Zoo...', 3),
(16, 'Science & Technology', 'Gadgets, Reviews, Space Shuttle...', 6),
(17, 'Sports', 'Games, Stadiums, Tailgating...', 9),
(18, 'Short Movies', 'Self Produced, Indie Films...', 12),
(19, 'Travel & Places', 'Vacations, International, Nature...', 15),
(20, 'Video Games', 'Demos, Previews...', 18),
(21, 'Videoblogging', 'Blogs, Opinions, Diaries...', 22),
(22, 'EpikTube\'s Christmas Tree', 'Christmas, Tree, EpikTube Event...', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `cid` varchar(14) NOT NULL COMMENT 'comment id',
  `post_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vidon` varchar(14) NOT NULL COMMENT 'Vid it was commented on',
  `vid` varchar(14) DEFAULT NULL COMMENT 'Vid attached to it',
  `body` varchar(100) NOT NULL COMMENT 'body of comment',
  `uid` varchar(20) NOT NULL COMMENT 'user who posted it',
  `is_reply` int(11) NOT NULL,
  `reply_to` varchar(14) NOT NULL,
  `master_comment` varchar(14) NOT NULL,
  `removed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `fid` varchar(12) NOT NULL COMMENT 'favorite id',
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `uid` varchar(12) NOT NULL,
  `vid` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='lol the whole table is ids';

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `gid` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `tags` varchar(255) DEFAULT NULL,
  `public` tinyint(1) DEFAULT NULL,
  `when` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `channel` varchar(255) DEFAULT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `featured` tinyint(1) DEFAULT '0',
  `groupicon` int(11) DEFAULT '0',
  `uploads` int(11) DEFAULT '0',
  `ch1` int(11) DEFAULT NULL,
  `ch2` int(11) DEFAULT NULL,
  `ch3` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `gid` int(11) DEFAULT NULL,
  `when` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `invite` tinyint(1) DEFAULT NULL,
  `pending` int(11) DEFAULT '1',
  `joined` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `group_topics`
--

CREATE TABLE `group_topics` (
  `id` int(11) NOT NULL,
  `forumtitle` varchar(255) DEFAULT NULL,
  `topic` text,
  `when` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `uid` int(11) DEFAULT NULL,
  `gid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `group_videos`
--

CREATE TABLE `group_videos` (
  `id` int(11) NOT NULL,
  `vid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `when` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `gid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ip_bans`
--

CREATE TABLE `ip_bans` (
  `id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `banned` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `sender` varchar(12) NOT NULL COMMENT 'uid of whom is sending the message',
  `receiver` varchar(12) NOT NULL COMMENT 'uid of the recipient',
  `subject` text NOT NULL COMMENT '(up to 75 characters) the title of the message, encrypted',
  `attached` varchar(15) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `body` text NOT NULL COMMENT '(up to 50,000 characters) the text of the message encrypted',
  `pmid` varchar(12) NOT NULL COMMENT 'id of the private message',
  `isRead` int(11) NOT NULL COMMENT 'If receiver saw it, mark 1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='private messages';

-- --------------------------------------------------------

--
-- Table structure for table `picks`
--

CREATE TABLE `picks` (
  `video` varchar(12) NOT NULL,
  `featured` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `special` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `vid` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `pid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profile_views`
--

CREATE TABLE `profile_views` (
  `view_id` varchar(35) NOT NULL,
  `viewed` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'when it got viewed',
  `location` varchar(5) DEFAULT 'US',
  `ip` varchar(45) NOT NULL DEFAULT 'generic',
  `vid` varchar(12) NOT NULL COMMENT 'the video that was viewed',
  `uid` varchar(12) DEFAULT NULL COMMENT 'user who viewed the video',
  `referer` text NOT NULL COMMENT 'HTTP referer',
  `sid` text NOT NULL COMMENT 'session id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` varchar(15) NOT NULL,
  `rating` int(11) NOT NULL,
  `user` varchar(16) NOT NULL,
  `video` varchar(16) NOT NULL,
  `done` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `relationships`
--

CREATE TABLE `relationships` (
  `relationship` varchar(16) NOT NULL COMMENT 'id of the relationship',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1 equals normal friend 2 equals familia',
  `sender` varchar(18) NOT NULL,
  `respondent` varchar(18) NOT NULL,
  `accepted` int(11) NOT NULL,
  `sent` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `who` varchar(20) NOT NULL,
  `what` text NOT NULL,
  `where` varchar(3) NOT NULL DEFAULT 'I',
  `when` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `logo` varchar(100) NOT NULL DEFAULT 'logo_sm.gif',
  `slogan` varchar(100) NOT NULL DEFAULT 'Upload, tag and share your videos worldwide!',
  `notice` mediumtext NOT NULL,
  `maintenance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Website configuration';

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo`, `slogan`, `notice`, `maintenance`) VALUES
(1, 'logo_rm2.png', 'Broadcast Yourself.', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `subscription_id` varchar(256) NOT NULL,
  `subscriber` text NOT NULL,
  `subscribed_to` text NOT NULL,
  `subscribed_type` varchar(1000) NOT NULL DEFAULT 'user_uploads',
  `subscribed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket` int(11) NOT NULL,
  `sender` text NOT NULL,
  `subject` int(11) NOT NULL,
  `message` text NOT NULL,
  `submitted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `resolved` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` longtext NOT NULL,
  `old_pass` longtext,
  `email` varchar(100) NOT NULL,
  `confirm_id` text NOT NULL,
  `confirm_expire` datetime DEFAULT NULL,
  `joined` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `em_confirmation` varchar(1000) NOT NULL DEFAULT 'false',
  `emailprefs_vdocomments` int(11) NOT NULL DEFAULT '1',
  `emailprefs_wklytape` int(11) NOT NULL,
  `emailprefs_privatem` int(11) NOT NULL DEFAULT '1',
  `lastlogin` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_act` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `failed_login` datetime DEFAULT NULL,
  `termination` int(11) NOT NULL COMMENT 'if equals 1 then theyre terminated',
  `birthday` date DEFAULT NULL,
  `name` varchar(500) NOT NULL,
  `relationship` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `about` varchar(2500) NOT NULL,
  `website` varchar(255) NOT NULL,
  `hometown` varchar(500) NOT NULL,
  `city` varchar(500) NOT NULL,
  `country` varchar(500) NOT NULL,
  `occupations` varchar(500) NOT NULL,
  `companies` varchar(500) NOT NULL,
  `schools` varchar(500) NOT NULL,
  `hobbies` varchar(500) NOT NULL,
  `fav_media` varchar(500) NOT NULL,
  `playlists` int(11) NOT NULL,
  `subscriptions` int(11) NOT NULL,
  `subscribers` int(11) NOT NULL,
  `profile_views` int(11) NOT NULL,
  `fav_count` int(11) NOT NULL,
  `pub_vids` int(11) NOT NULL,
  `priv_vids` int(11) NOT NULL,
  `friends_count` int(11) NOT NULL,
  `vids_watched` int(11) NOT NULL,
  `music` varchar(500) NOT NULL,
  `books` varchar(500) NOT NULL,
  `staff` int(11) NOT NULL,
  `sysadmin` int(11) NOT NULL,
  `ip` varchar(500) DEFAULT NULL,
  `priv_id` varchar(35) DEFAULT NULL COMMENT 'non-public version of the user id used for things like email verif',
  `blazing` int(11) NOT NULL COMMENT '1 sets the cooldown limit to just 1',
  `retelimit` varchar(255) DEFAULT NULL,
  `profileColor` varchar(255) DEFAULT 'classic',
  `profilePictureSetting` int(11) DEFAULT '0',
  `profilePicture` varchar(255) DEFAULT NULL,
  `closure` int(11) DEFAULT NULL,
  `branding` int(1) NOT NULL DEFAULT '0',
  `forcevidquality` varchar(4) NOT NULL DEFAULT '360p'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `uid` varchar(20) NOT NULL COMMENT 'id of video poster',
  `vid` varchar(20) NOT NULL COMMENT 'video id',
  `cdn` varchar(255) NOT NULL,
  `hq` int(1) NOT NULL DEFAULT '0',
  `uploaded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tags` varchar(900) NOT NULL,
  `ch1` int(11) NOT NULL DEFAULT '5',
  `ch2` int(11) DEFAULT NULL,
  `ch3` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `file` text NOT NULL,
  `time` int(11) NOT NULL DEFAULT '0',
  `converted` int(11) NOT NULL DEFAULT '0',
  `privacy` int(11) NOT NULL DEFAULT '1',
  `priva_group` int(11) DEFAULT NULL,
  `recorddate` varchar(255) DEFAULT NULL,
  `address` text,
  `addrcountry` text,
  `comms_allow` int(11) NOT NULL DEFAULT '1',
  `allow_votes` int(11) NOT NULL DEFAULT '1',
  `age_restrict` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `comm_count` int(11) NOT NULL DEFAULT '0',
  `fav_count` int(11) NOT NULL DEFAULT '0',
  `ratings` int(11) NOT NULL DEFAULT '0',
  `rejected` int(11) NOT NULL DEFAULT '0',
  `reason` int(11) NOT NULL DEFAULT '0',
  `copyright_holder` varchar(65) DEFAULT NULL,
  `agerestrict` int(11) DEFAULT '0',
  `startedProcessing` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `video_rejection_log`
--

CREATE TABLE `video_rejection_log` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `why` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `view_id` varchar(35) NOT NULL,
  `viewed` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'when it got viewed',
  `location` varchar(5) DEFAULT 'US',
  `ip` varchar(45) NOT NULL DEFAULT 'generic',
  `vid` varchar(12) NOT NULL COMMENT 'the video that was viewed',
  `uid` varchar(12) DEFAULT NULL COMMENT 'user who viewed the video',
  `referer` text NOT NULL COMMENT 'HTTP referer',
  `sid` text NOT NULL COMMENT 'session id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bulletins`
--
ALTER TABLE `bulletins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `channelcomments`
--
ALTER TABLE `channelcomments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_topics`
--
ALTER TABLE `group_topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_videos`
--
ALTER TABLE `group_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ip_bans`
--
ALTER TABLE `ip_bans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`pmid`);

--
-- Indexes for table `picks`
--
ALTER TABLE `picks`
  ADD PRIMARY KEY (`video`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_views`
--
ALTER TABLE `profile_views`
  ADD PRIMARY KEY (`view_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `relationships`
--
ALTER TABLE `relationships`
  ADD PRIMARY KEY (`relationship`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD UNIQUE KEY `subscription_id` (`subscription_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`vid`);

--
-- Indexes for table `video_rejection_log`
--
ALTER TABLE `video_rejection_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`view_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `channelcomments`
--
ALTER TABLE `channelcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_topics`
--
ALTER TABLE `group_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_videos`
--
ALTER TABLE `group_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ip_bans`
--
ALTER TABLE `ip_bans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_rejection_log`
--
ALTER TABLE `video_rejection_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
