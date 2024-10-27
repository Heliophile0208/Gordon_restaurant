-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 27, 2024 lúc 05:13 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `gordon_restaurant`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menu`
--

INSERT INTO `menu` (`id`, `category`, `title`, `price`, `description`, `image`) VALUES
(1, 'Starters', 'Davy\'s classic prawn cocktail', 7.85, 'A selection of prawns, marie rose sauce with a hint of Manzanilla', 'PNG/davys-classic-prawn-cocktail.jpg'),
(2, 'Starters', 'Warm grilled goat\'s cheese crostini', 5.55, 'Warm goat\'s cheese served with roast Mediterranean vegetables and pesto on a toasted ciabatta', 'PNG/warm-grilled-goats-cheese-crostini.jpg'),
(3, 'Starters', 'Plate of Scottish smoked salmon', 7.95, 'Scottish smoked salmon with lambs leaf dressed with balsamic syrup and pink peppercorns', 'PNG/plate-of-scottish-smoked-salmon.jpg'),
(4, 'Salads', 'Gordon\'s Salad', 9.95, 'Chicory, gorgonzola cheese, pear and dandelion salad with a whole grain mustard dressing', 'PNG/gordons-salad.jpg'),
(5, 'Salads', 'Grilled Salmon Salad', 23.95, '', 'PNG/grilled-salmon-salad.jpg'),
(6, 'Salads', 'Cobb Salad', 21.15, 'Our take on the classic Cobb salad with grilled chicken, hickory-smoked bacon, Stilton cheese, tomato, boiled egg, black olive', 'PNG/cobb-salad.jpg'),
(7, 'Sandwiches', 'Grilled goat\'s cheese', 7.95, 'Warm goat\'s cheese served with roast Mediterranean vegetables and pesto on a toasted ciabatta', 'PNG/grilled-goats-cheese.jpg'),
(8, 'Sandwiches', 'Cumberland sausage', 7.25, '6oz Cumberland sausage ring served with red onions, in toasted sourdough bloomer', 'PNG/cumberland-sausage.jpg'),
(9, 'Main courses', 'Kings Wings', 15.95, 'A dozen spiced chicken wings tossed in our special Guinness Hoisin BBQ sauce, with sesame seeds and green onion', 'PNG/kings-wings.jpg'),
(10, 'Main courses', 'Sausage Rolls', 18.35, 'Banger sausage wrapped in pastry served with our house BBQ and Scotch eggs', 'PNG/sausage-rolls.jpg'),
(11, 'Main courses', 'Bangers and mash', 10.95, 'Cumberland sausages with traditional mashed potatoes and onion gravy', 'PNG/bangers-and-mash.jpg'),
(12, 'Main courses', 'Fish and chips', 12.95, 'Line caught haddock in beer batter served with chipped potatoes and minted pea puree', 'PNG/fish-n-chips.jpg'),
(13, 'Main courses', 'New season lamb cutlets', 16.25, 'Roasted vegetables, sweet potato and chive mash', 'PNG/new-season-lamb-cutlets.jpg'),
(14, 'Beef', 'T-Bone steak', 28.95, '400g served on the bone. Made up of both sirloin and fillet offering you both tenderness of the fillet and ribeye steak', 'PNG/flat-bone-steak.jpg'),
(15, 'Beef', 'Sirloin steak', 23.55, 'A juicy, tasty and tender cut of 240g fully trimmed and aged for 21 days', 'PNG/sirloin-steak.jpg'),
(16, 'Beef', 'Ribeye steak', 20.15, 'Rich marbling is the secret to this succulent and tasty cut of 220g, aged for 28 days', 'PNG/ribeye-steak.jpg'),
(17, 'Desserts', 'English cheese board', 9.75, 'A selection of four British cheeses served with biscuits and green tomato and apple chutney', 'PNG/english-cheese-board.jpg'),
(18, 'Desserts', 'Chocolate tart', 5.85, 'Delicious tart with clotted cream and raspberry coulis', 'PNG/chocolate-tart.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `rating` int(5) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `votes`
--

INSERT INTO `votes` (`id`, `menu_id`, `rating`, `user_id`) VALUES
(1, 16, 5, 1),
(2, 1, 2, 0),
(3, 6, 5, 0),
(4, 11, 5, 0),
(5, 6, 5, 0),
(6, 11, 5, 0),
(7, 2, 4, 0),
(8, 11, 5, 0),
(9, 2, 4, 0),
(10, 11, 5, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
