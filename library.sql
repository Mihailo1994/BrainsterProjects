-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2023 at 11:21 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `surname` varchar(64) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `is_deleted` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `surname`, `biography`, `is_deleted`) VALUES
(1, 'Jordan', 'Peterson Three', 'Jordan Bernt Peterson (born 12 June 1962) is a Canadian psychologist, author, and media commentator.[4][5] He began to receive widespread attention in the late 2010s for his views on cultural and political issues, often described as conservative.[6][7][8][9] Peterson has described himself as a classic British liberal[10][11][12] and a traditionalist.[13]', b'0'),
(2, 'Stephen', 'King', 'Stephen Edwin King is an American author of horror, supernatural fiction, suspense, crime, science-fiction, and fantasy novels. Described as the \"King of Horror\", his books have sold more than 350 million copies as of 2006, and many have been adapted into films, television series, miniseries, and comic books.', b'0'),
(5, 'Nelle', ' Harper Lee', 'Nelle Harper Lee (April 28, 1926 – February 19, 2016) was an American novelist who wrote the 1960 novel To Kill a Mockingbird that won the 1961 Pulitzer Prize and became a classic of modern American literature. She assisted her close friend Truman Capote in his research for the book In Cold Blood (1966).[1] Her second novel, Go Set a Watchman, has been confirmed to be an earlier draft of Mockingbird but was published in July 2015 as a sequel', b'0'),
(6, 'John Ronald', 'Reuel Tolkien', 'John Ronald Reuel Tolkien CBE FRSL (/ˈruːl ˈtɒlkiːn/, ROOL TOL-keen;[a] 3 January 1892 – 2 September 1973) was an English writer and philologist. He was the author of the high fantasy works The Hobbit and The Lord of the Rings.', b'0'),
(7, 'Francis Scott Key ', 'Fitzgerald', 'Francis Scott Key Fitzgerald (September 24, 1896 – December 21, 1940) was an American novelist, essayist, and short story writer. He is best known for his novels depicting the flamboyance and excess of the Jazz Age—a term he popularized in his short story collection Tales of the Jazz Age. During his lifetime, he published four novels, four story collections, and 164 short stories. Although he achieved temporary popular success and fortune in the 1920s, Fitzgerald received critical acclaim only after his death and is now widely regarded as one of the greatest American writers of the 20th century.', b'0'),
(8, 'Miguel de Cervantes', 'Saavedra', 'Miguel de Cervantes Saavedra (Spanish: [miˈɣel de θeɾˈβantes saaˈβeðɾa]; 29 September 1547 (assumed) – 22 April 1616 NS)[5] was an Early Modern Spanish writer widely regarded as the greatest writer in the Spanish language and one of the world\'s pre-eminent novelists. He is best known for his novel Don Quixote, a work often cited as both the first modern novel[6][7] and \"the first great novel of world literature\".[8] A 2002 poll of around 100 well-known authors[b] voted it the \"most meaningful book of all time\",[9] from among the \"best and most central works in world literature\".[8]', b'0'),
(9, 'Mark', 'Twain', 'Samuel Langhorne Clemens (November 30, 1835 – April 21, 1910),[1] best known by his pen name Mark Twain, was an American writer, humorist, entrepreneur, publisher, and lecturer. He was praised as the \"greatest humorist the United States has produced\",[2] and William Faulkner called him \"the father of American literature\".[3] His novels include The Adventures of Tom Sawyer (1876) and its sequel, Adventures of Huckleberry Finn (1884),[4] the latter of which has often been called the \"Great American Novel\". Twain also wrote A Connecticut Yankee in King Arthur\'s Court (1889) and Pudd\'nhead Wilson (1894), and co-wrote The Gilded Age: A Tale of Today (1873) with Charles Dudley Warner.', b'0'),
(10, 'Daniellee', ' Steel', 'Danielle Fernandes Dominique Schuelein-Steel is an American writer, best known for her romance novels. She is the bestselling living author and one of the best-selling fiction authors of all time, with over 800 million copies sold', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(256) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `release_year` int(11) DEFAULT NULL,
  `number_of_pages` int(11) DEFAULT NULL,
  `picture` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author_id`, `release_year`, `number_of_pages`, `picture`, `category_id`) VALUES
(3, 'To Kill a Mockingbird', 5, 1960, 281, 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/To_Kill_a_Mockingbird_%28first_edition_cover%29.jpg/330px-To_Kill_a_Mockingbird_%28first_edition_cover%29.jpg', 1),
(4, 'The Lord of the Rings', 6, 1954, 250, 'https://upload.wikimedia.org/wikipedia/en/e/e9/First_Single_Volume_Edition_of_The_Lord_of_the_Rings.gif', 8),
(5, 'The Great Gatsby', 7, 1925, 250, 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7a/The_Great_Gatsby_Cover_1925_Retouched.jpg/330px-The_Great_Gatsby_Cover_1925_Retouched.jpg', 1),
(6, 'The Hobbit', 6, 1937, 345, 'https://upload.wikimedia.org/wikipedia/en/4/4a/TheHobbit_FirstEdition.jpg', 8),
(7, 'Don Quixote', 8, 1620, 458, 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Title_page_first_edition_Don_Quijote.jpg/375px-Title_page_first_edition_Don_Quijote.jpg', 1),
(8, 'Adventures of Huckleberry Finn', 9, 1885, 362, 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/61/Huckleberry_Finn_book.JPG/330px-Huckleberry_Finn_book.JPG', 9);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `is_deleted` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `is_deleted`) VALUES
(1, 'Drama', b'0'),
(2, 'Romance', b'1'),
(5, 'Thriller', b'0'),
(6, 'Comedy', b'1'),
(7, 'Comedy', b'0'),
(8, 'Adventure', b'0'),
(9, 'Horror', b'0'),
(10, 'Mystery', b'0'),
(11, 'Crime', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `is_approved` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `book_id`, `user_id`, `comment`, `is_approved`) VALUES
(7, 5, 9, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi reprehenderit voluptates, nesciunt eos optio blanditiis quam possimus amet quidem nulla magnam iusto veniam illum impedit commodi corporis quod omnis iure quae harum repellat corrupti necessitatibus? Nisi quos, vero sequi accusamus adipisci ea quas repellendus! ', b'1'),
(9, 4, 2, 'This is my comment\r\n', NULL),
(10, 6, 2, 'New comment', NULL),
(11, 3, 2, 'this is my comment', b'1'),
(12, 5, 2, 'This is my comment', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `note`, `book_id`, `user_id`) VALUES
(4, 'note4', 5, 2),
(5, 'my note', 4, 2),
(6, 'my new note', 4, 2),
(7, 'Proba', 5, 2),
(11, 'my new note 2\n', 5, 2),
(13, 'asd', 5, 2),
(14, 'proba', 5, 2),
(15, 'tuka sme', 5, 2),
(17, 'asd', 3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(64) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `admin` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `admin`) VALUES
(1, 'admin', '$2y$10$eH1seBmn5PhU3mRx0cw.cuKBZDozEykudmu8WLv496/L6THiN/npm', b'1'),
(2, 'mihailo', '$2y$10$dKcDHmp5sTtfWOvFxJsjOOPfRi7QLLuE7C4fpIBAZuCbR4rBl32tG', b'0'),
(4, 'jack', '$2y$10$t7RWfKKVz4YNc0zoniuTfusGIpOgvu3zaXpVkJTVUN7H4CWRXmbGi', b'0'),
(5, 'james', '$2y$10$h2o9jxDpPSn6.4v0Zc9Svu2VMOpjE/kyhJFlmyjJnFpyQ9LdDpSF6', b'0'),
(6, 'tomas', '$2y$10$g8QSQF44P5.2vYBIcBrMKuNlAkjEoXify7/suf7egvfn9NJsbUi26', b'0'),
(9, 'nikola', '$2y$10$I6MeHJZPtbHn7E/Rem2AfO42bLXOajcoCcGMQvV4HTKAxeS28jhqG', b'0'),
(10, 'test', '$2y$10$Kg6BH6Dr20EV4B0bImp/bOuIbj2ejubeJN/UOfCYI0KQxOKbfBFBm', b'0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
