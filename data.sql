-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 29, 2022 lúc 03:23 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `localhost`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `stk` varchar(255) NOT NULL,
  `min` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `bank`
--

INSERT INTO `bank` (`id`, `img`, `stk`, `min`, `name`, `content`) VALUES
(2, '<img src=\"https://subgiare.vn/assets/images/mbb.png\" >', '0131993099999', '10000', 'VUONG THANH TUNG', 'Nạp tốc độ 5s -&gt; 1p ổn định cực nhanh, ae nên nạp.'),
(3, '<img src=\"https://subgiare.vn/assets/images/momo.png\" >', '0355173805', '10000', 'VUONG THANH TUNG', 'Nạp tốc độ 5s -&gt; 30s ổn định cực nhanh, ae nên nạp.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cmt`
--

CREATE TABLE `cmt` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `content` varchar(255) NOT NULL,
  `post` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `cmt`
--

INSERT INTO `cmt` (`id`, `username`, `content`, `post`) VALUES
(4, 'admin', 'Hế nhô anh em test cmt đi', '9'),
(5, 'quancorona', 'Hello ', '9'),
(6, 'vhoa203', 'Yêu anh tùng', '9'),
(7, 'dungtool', 'nhất anh tùng', '9'),
(8, 'dungtool', 'nhất anh tùng', '9'),
(9, 'admin', 'Ơ like đi anh em xem chùa thế', '9'),
(11, 'tung0355', 'Thg nào đấy', '9'),
(12, 'suphumeo', 'Quân siêu cấp vip pro', '9'),
(13, 'dangduong', 'á đù', '9'),
(14, 'dangduong', 'á đù', '9'),
(15, 'admin', 'Đù gì', '9'),
(16, 'dangduong', 'Alo admin ơi', '9'),
(17, 'admin', 'Ơi', '9'),
(18, 'admin', 'Like đi đồ xem chùa', '9'),
(19, 'dangduong', 'Hello ', '9'),
(20, 'quancorona', 'quân đã có mặt', '9'),
(21, 'quancorona', 'quân đã có mặt', '9'),
(23, 'admin', 'Hú', '9'),
(25, '1thegioimoi', 'a quang đẹp trai', '9'),
(26, 'Tungvn', 'Hi', '9'),
(27, 'thanhvucoder', 'Kkk', '9'),
(28, 'thanhvucoder', 'Kkk', '9'),
(29, 'Ccccccccccc', 'Kkk', '9'),
(30, 'Ccccccccccc', 'Kkk', '9'),
(31, 'admin', ':))', '9'),
(32, 'admin', ':))', '9'),
(34, 'suphumeo', 'alert(XSS)', '9'),
(35, 'suphumeo', 'định làm hacker, mà khum đc rồi :)))', '9'),
(38, 'admin', '<font color=\"red\">*</font> test', '9');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `daily`
--

CREATE TABLE `daily` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `daily`
--

INSERT INTO `daily` (`id`, `username`, `domain`, `token`, `status`, `date`) VALUES
(2, 'admin', 'tungmmo23', 'EAAAeef4d56a6f6e5d1bbd2929a60d62f63a', '1', '22-05-2022 04:49:32'),
(5, 'admin', '45', 'EAAAeef4d56a6f6e5d1bbd2929a60d62f63a', '0', '22-05-2022 04:52:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dichvu`
--

CREATE TABLE `dichvu` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `img` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `loai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `dichvu`
--

INSERT INTO `dichvu` (`id`, `name`, `img`, `content`, `type`, `loai`) VALUES
(1, 'Tăng follow facebook', '<img src=\"/assets/img/item/5638699.png\" >', 'Tăng sub giá chỉ 1 coin', 'follow', 'facebook'),
(2, 'Tăng like bài viết facebook	', '<img src=\"/assets/img/item/5638848.png\" >', '1', 'like', 'facebook');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `uid` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `baohanh` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `money` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `loai` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `server` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `history`
--

INSERT INTO `history` (`id`, `username`, `uid`, `content`, `quantity`, `baohanh`, `money`, `loai`, `type`, `status`, `server`, `date`) VALUES
(4, 'vhoa203', '100006424725335', '1', '10000', '1', '10000', 'facebook', 'follow', '1', '2', '27-05-2022 03:57:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `like_post`
--

CREATE TABLE `like_post` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `post` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `like_post`
--

INSERT INTO `like_post` (`id`, `username`, `post`) VALUES
(203, 'tung0355', '9'),
(207, 'dangduong', '9'),
(208, 'vhoa203', '9'),
(209, 'hoadeptry', '9'),
(213, 'Tungvn', '9'),
(221, 'admin', '9'),
(224, 'admin', '12'),
(225, 'quancorona', '9');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `naptien`
--

CREATE TABLE `naptien` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `telco` varchar(255) NOT NULL,
  `pin` varchar(255) NOT NULL,
  `serial` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `request_id` varchar(255) NOT NULL,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `thucnhan` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `naptien`
--

INSERT INTO `naptien` (`id`, `username`, `telco`, `pin`, `serial`, `amount`, `request_id`, `content`, `thucnhan`, `status`, `date`) VALUES
(2, 'admin', 'VIETTEL', '5345345345345', '34534534534555', '10000', 'SWHIP2', 'Gửi thẻ thành công, chờ xử lý', '5000', '0', '23-05-2022 10:51:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `tranid` varchar(255) NOT NULL,
  `stk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `money` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `payment`
--

INSERT INTO `payment` (`id`, `username`, `tranid`, `stk`, `money`, `content`, `date`) VALUES
(97, 'quancorona', 'FT22150762508586B17', '0131993099999', '10000', 'quancorona nap', '29/05/2022 11:38:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `content` varchar(300) NOT NULL,
  `top` varchar(255) CHARACTER SET utf32 COLLATE utf32_vietnamese_ci NOT NULL,
  `date` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `post`
--

INSERT INTO `post` (`id`, `username`, `content`, `top`, `date`, `ip`) VALUES
(9, 'admin', 'Hiện tại web đã full chức năng còn mỗi thể loại kiếm tiền mình đg delay chút , nên mọi người cứ trải nghiệm sub trc nhé , nếu có vấn đề thì liên hệ qua <p>zalo : <a href=\"http://chat.zalo.me/0355173805\" target=\"_blank\" title=\"chat.zalo.me/0355173805\">0355173805</a></p>', '4', '27-05-2022 02:23:59', '14.255.48.211');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `server`
--

CREATE TABLE `server` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `rate2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `rate3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `loai` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `server`
--

INSERT INTO `server` (`id`, `name`, `rate`, `rate2`, `rate3`, `loai`, `type`) VALUES
(1, 'Tăng follow sale [5s - 1h, max không giới hạn, không chạy cho pro5]', '1', '1', '1', 'facebook', 'follow'),
(2, 'Follow VIP sale [ Lên ngay hoặc trong vài h - Max 250k1id] ', '3', '2.5', '2', 'facebook', 'follow'),
(3, 'Tăng follow clone[Clone nuôi, max 8m sub, sub khuyến mại]', '3.2', '3', '2.7', 'facebook', 'follow'),
(4, 'Tăng follow chạy bằng pages [lên sau 1-2p trưa tối có thể bị tắc nghẽn , Max 220k , pro5 chạy sẽ bị dừng đơn liên tục ]', '1.7', '1.5', '1.2', 'facebook', 'follow'),
(5, 'Tăng like clone [ Tốc độ nhanh 1kngày, mỗi ngày mua được 1k - max 3k like]', '4', '3.5', '3', 'facebook', 'like'),
(6, 'Tăng like chéo speed [Like người dùng chéo, tài khoản tên Việt, có Avatar,Tốc độ lên ổn, max 20k like]', '5.5', '5.3', '4', 'facebook', 'like'),
(7, 'Like siêu rẻ [ Sale Chậm - Max 10k 1 id ]', '2.5', '2.3', '2', 'facebook', 'like'),
(8, 'Like Sale [ Lên sau 10p - Tốc độ 3kDay ] ', ' 5', '4.5', '4.3', 'facebook', 'like'),
(9, 'Like rẻ nhanh ', ' 5.5', '5.3', '5', 'facebook', 'like'),
(10, 'Tăng Like Bài Viết  [Like Việt Lên từ từ (max 2K) ]', '2', '2', '1.9', 'facebook', 'like'),
(11, 'Like người thật [Bấm tay ,tốc độ chạy nhanh] [theo số lượng bài mua  1 ngày]', '2000', '1700', '1500', 'facebook', 'like');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `keyword` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `head` varchar(1000) NOT NULL,
  `footer` varchar(1000) NOT NULL,
  `partner_id` varchar(1000) NOT NULL,
  `partner_key` varchar(1000) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `setting`
--

INSERT INTO `setting` (`id`, `title`, `description`, `keyword`, `head`, `footer`, `partner_id`, `partner_key`, `status`) VALUES
(1, 'Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok', 'Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok', 'like, sub, share, vip like, buff mắt, tăng follow, mua like, mua sub, sub rẻ, hack like, hack sub, hack follow, tăng like, tăng follow, cách hack tăng like,share code auto like, xin code auto like, web auto like', '', '', '8816618094', '8c8870b635fb0166886ba12683fc2619', 'true');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `theloai`
--

CREATE TABLE `theloai` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `img` varchar(3000) NOT NULL,
  `loai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `theloai`
--

INSERT INTO `theloai` (`id`, `name`, `img`, `loai`) VALUES
(1, 'Dịch vụ facebook', '<img src=\"/assets/img/dichvu/a123956a0d5494bf9086147edbc1a445.png\" >', 'facebook');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `money` varchar(3000) NOT NULL,
  `referral` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `level` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `phone`, `money`, `referral`, `level`, `status`, `token`, `date`, `ip`) VALUES
(36, 'admin', '7715f74e22db3c0069760561d51078bd', '', '', '10000', 'admin', '4', 'true', 'EAAAeae1601cb45939bdabf2546b76e0a4ad', '23-05-2022 03:39:26', '14.255.48.211'),
(37, 'duong887', 'ed2b1f468c5f915f3f1cf75d7068baae', '', '', '0', '', '0', 'true', 'EAAA33f190dfc2261b03f8435b13a3165a0c', '23-05-2022 04:07:00', '171.252.154.193'),
(38, 'Ducmanh892007', 'b2077d02d805a5e08b9384d7befe2914', '', '', '0.005', 'admin', '0', 'true', 'EAAA2b2a4f388aca65cdfb8c407bfef9f5c3', '23-05-2022 04:07:10', '42.116.107.239'),
(39, 'phuongnhi111', '4297f44b13955235245b2497399d7a93', '', '', '0', '', '0', '1', 'EAAAccf66efbc02106cf5ca9172d0588951f', '23-05-2022 04:14:56', '2405:4803:d360:caa0:8445:afed:3c9c:2d36'),
(40, 'nhincaigi', 'e10adc3949ba59abbe56e057f20f883e', '', '', '0', '', '0', '1', 'EAAA46d67cc2e7403bf5da3ea32e44c84030', '23-05-2022 04:38:30', '2001:ee0:4c19:c810:6827:e96b:f863:e75e'),
(41, 'tuantulc567', 'e807f1fcf82d132f9bb018ca6738a19f', '', '', '0', '', '0', '1', 'EAAA434eeeacf46aba529a93b6b56c82f499', '23-05-2022 04:49:42', '2402:800:612d:d63d:e1d5:5128:cf7b:2de'),
(42, 'Mavancanh0011', '10b9ff3bf7d5a4a8d1ef4a6327d58531', '', '', '0', '', '0', '1', 'EAAA34b030b0047593d437af59ebd91c4aa4', '23-05-2022 04:50:08', '123.16.55.198'),
(43, 'haiha282006', '3701d96b04e9ccccf2effa24bd040692', '', '', '0', '', '0', '1', 'EAAA2f7dc5aafc41b69be5c4c062a6d5056d', '23-05-2022 04:50:20', '2402:800:63ae:f1c9:2d9a:bbac:c512:e38e'),
(44, 'a12121212', 'a27d656cf3650b4d0ab3feadaa4bf2a7', '', '', '0', '', '0', '1', 'EAAA27f9c1274f66fd3954c1f323727150c5', '23-05-2022 04:50:41', '116.98.141.19'),
(45, 'bcxvbcbv', 'd7c85f5c2f35307680e458abd9bd4b5c', '', '', '0', '', '0', '1', 'EAAA9bf7b79b16e31bf3b2332a8d011e33be', '23-05-2022 04:50:58', '116.104.212.196'),
(46, 'shahahaja', '86d93599e2faba126cb5b4052df80313', '', '', '0', '', '0', '1', 'EAAA3e34ef9919bf9641e1cdf3240591ec2c', '23-05-2022 04:50:59', '113.161.58.1'),
(47, 'Pmh241105', '2d978b36041c421f24dafd7f1be4acc5', '', '', '0', '', '0', '1', 'EAAAd2b1ad89c0eed4e52840543eb7450079', '23-05-2022 04:52:07', '14.166.117.124'),
(48, 'dinhdat810', '83d92327ea2127f1f876a69b8d249980', '', '', '0', '', '0', '1', 'EAAA45598f4736845951794da52ca1af4a1a', '23-05-2022 04:53:08', '2001:ee0:4c73:2b70:9940:3cdf:cff3:cf25'),
(49, 'Tungvn', 'ad032fe366f653b02808e9c89d032f1c', '', '', '0', '', '0', '1', 'EAAAf7c396e77d38f065ff4441d4f6b5c6c4', '23-05-2022 04:53:38', '14.241.90.40'),
(50, 'anhdayne', '038cdfd19425bb4123f6bc6dc2a11945', '', '', '0', '', '0', '1', 'EAAAb383e7c6438bfda89eb7239e25b272ed', '23-05-2022 04:53:57', '58.187.154.52'),
(51, 'Assitcute06', '2ae0e9d7edd159c945f3236b558e75ac', '', '', '0', '', '0', '1', 'EAAA56908e8fda4c5caabb5167130ffb4398', '23-05-2022 04:57:47', '2402:9d80:382:aab1::7ba5:21c6'),
(52, 'haycode', 'c8d3f0b6a79c95a17b04823db7384de3', '', '', '0', '', '0', '1', 'EAAAfa9cce8364b9e503932a9ae923a91326', '23-05-2022 05:13:10', '2405:4802:60eb:3240:1c57:32bc:2b38:c99a'),
(53, 'tantai', 'cabf3fc0bda745551fe4e93ef0565001', '', '', '0', '', '0', '1', 'EAAA16dc2658128876f458eed77fbf536888', '23-05-2022 05:18:45', '113.170.145.208'),
(54, 'Thoipro', 'b2a2255dffe426934a9b6c2c8f41b3dd', '', '', '0', '', '0', '1', 'EAAAcdab2a62a67a006ccba7f223b150b659', '23-05-2022 07:35:54', '2402:800:62db:430a:347e:60be:cfde:e6f1'),
(55, 'autosubre', 'bfd925fa86084bd0300fde7fd05ddd97', '', '', '0', '', '0', '1', 'EAAAfcd30dcd4b996ccfde43bc5944b216bd', '23-05-2022 09:01:16', '2405:4800:12ae:4cee:292f:65e5:4a3b:494b'),
(56, 'Hienth', '4fdc00f229242c1eba9a4bbe4bca5fdb', '', '', '0', '', '0', '1', 'EAAAab77beb9bbb7de23445ce33302d3fab2', '23-05-2022 11:13:55', '2001:ee0:524f:a90:bd93:2789:6c78:b06d'),
(57, 'vongxep', 'e6ac2eb74e856c81f3cbee538199d8a4', '', '', '0', '', '0', '1', 'EAAAc8e11aae6e992b7d1fec7fbbd8029d38', '23-05-2022 11:29:39', '2401:d800:5ee7:5a52:cd1:4245:9b9f:da0b'),
(58, '1thegioimoi', '5c4923c0f80967ecabf7eca056b24e8c', '', '', '0', 'tungdaubuoi', '0', 'false', 'EAAA3f26f58cc3da025ba67648ba1cd77377', '23-05-2022 11:38:36', '2402:800:63b7:f03a:a4e3:5ff0:ac59:cbaa'),
(59, 'aaaaaafdd', '9d6a74c80a9d5df7a7351603bfe6bd6d', '', '', '0', '', '0', '1', 'EAAA48b52f24080ae69c4ba761760c10559f', '23-05-2022 13:00:17', '2405:4802:8032:5480:7c78:ddaf:92:ce8e'),
(60, 'shatasy', '81dc9bdb52d04dc20036dbd8313ed055', '', '', '0', 'admin123', '0', 'true', 'EAAAc1dfd9115c7adf15ca1af5f848a31f9f', '23-05-2022 14:02:06', '113.185.79.51'),
(61, 'vinhgamer', 'e10adc3949ba59abbe56e057f20f883e', '', '', '0', '', '0', 'true', 'EAAA21752212333d12b78c4563cde2cd2adf', '23-05-2022 14:08:03', '113.20.99.169'),
(62, 'dungtool', '8d9780ff0c17613d96bb6c0468d4ea18', '', '', '0', '', '0', '1', 'EAAA39f7cf36a71f73101264aa010d584fdd', '23-05-2022 14:20:57', '2403:e200:16b:4408:f955:1f51:ee40:2af2'),
(63, 'taikhoan14', 'ed2b1f468c5f915f3f1cf75d7068baae', '', '', '0', '', '0', '1', 'EAAAc70e4d9936a5505457fee56a9023281c', '23-05-2022 18:31:49', '113.168.54.244'),
(64, '1234567890', 'e807f1fcf82d132f9bb018ca6738a19f', '', '', '0', '', '0', '1', 'EAAA420150e6d7d573d71541cf3f5e390262', '24-05-2022 02:21:23', '171.253.135.154'),
(65, 'dangduong666', 'truongdangduong', '', '', '0.005', 'admin', '0', 'true', 'EAAA1be325bb418a24b1d8d522e707e7601d', '24-05-2022 05:06:51', '14.248.162.116'),
(66, 'adminbinh', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', '', '', '0', '', '0', '1', 'EAAA3b8e7ac7a93f1c93dd10b10fffd96a6d', '24-05-2022 05:38:03', '171.251.236.64'),
(67, 'NghiaZUKA', '3189c1f2ecfdcb9a46efe016bdd10185', '', '', '0', '', '0', '1', 'EAAAfc8294ccc8f7aea786c91e0345467c44', '24-05-2022 05:38:23', '1.52.184.144'),
(68, 'baotricker28', 'd283fc618aaf39f64598c5e1b2cfdf8a', '', '', '0', '', '0', '1', 'EAAA2967660975e7576b7e37da7062dd445a', '24-05-2022 06:01:55', '2405:4803:d3f4:c720:40a0:6a9e:bed8:6052'),
(69, 'haiquang1109', '5a89a9832f501a54407f07a7dfe451c9', '', '', '0', '', '0', '1', 'EAAA7b5209d39141e28304e11e4601a1b0cf', '24-05-2022 12:11:43', '2401:d800:2400:c4a4:b05b:a1a7:e366:2a38'),
(70, 'khanhne', '638f4b52a33c91ed9aeca3a835fc077d', '', '', '0', 'khanhnee', '0', '1', 'EAAA48d46b6d6775dd2d67e08259324c1f19', '24-05-2022 12:41:22', '14.183.28.50'),
(71, 'hoangvulong', '8fed393b02e65559cf16d83b48b0175a', '', '', '0', '', '0', '1', 'EAAAf41aa446d164297d517e037f6757cca8', '24-05-2022 13:45:56', '14.191.173.220'),
(72, 'dsfdgdfg', '4a889d47718217b8050e7a2906c870d0', '', '', '0', '', '0', '1', 'EAAAcebd8c84181491b3e1635f63178d9429', '24-05-2022 15:11:48', '116.110.43.66'),
(73, 'eoewfwd', 'b1813deedea4e82d3b3728de53dbe27e', '', '', '0', '', '0', '1', 'EAAA7a33eba5234b0ee669101e932e2e5b8a', '26-05-2022 06:53:20', '2402:800:63a6:a049:fc8b:a4f:9620:e39e'),
(74, 'Duongshado', 'a7b6c2bd724ec2c1b12f3fc4a4f45e84', '', '', '0', '', '3', 'true', 'EAAAbdf61e2a05dff4c227847affd7647a03', '26-05-2022 09:04:26', '2402:9d80:273:2152:a070:906e:1e10:867c'),
(75, 'quancorona', 'f5bb0c8de146c67b44babbf4e6584cc0', '', '', '860000', '', '0', '1', 'EAAAc757ae2e0683a9d6ac593a86844ae386', '27-05-2022 02:31:17', '14.238.57.230'),
(77, 'tung0355', '301dcd98b72234299ae73462d3d2cd0b', '', '', '0', '', '0', '1', 'EAAA2e324170b707438a1bc24156d27b396b', '27-05-2022 03:06:13', '14.255.48.211'),
(78, 'suphumeo', 'e10adc3949ba59abbe56e057f20f883e', '', '', '0', '', '0', 'false', 'EAAAcc1ef0e9c5c62b830666b420b26f985a', '27-05-2022 03:06:36', '14.255.133.220'),
(79, 'dangduong', '4eef9dd0e39443a1b61b30b080fe32e6', '', '', '0.005', 'admin', '0', '1', 'EAAA80a20ad3e0410c4571d639df067dfea0', '27-05-2022 03:41:04', '14.248.162.116'),
(80, 'Nhandzok', 'd0993287d312d817bd10efdf0af93f76', '', '', '0', '', '0', '1', 'EAAA460790da2de643e5b3d3b7a7f931aacf', '27-05-2022 04:34:41', '14.255.154.57'),
(81, 'hoadeptry', '342f3a47ae3b471f421abf7be86e4285', '', '', '10000', 'hoadeptrys1vn', '0', '1', 'EAAA2a27a3ea4b315a49cfd1070324e92e3d', '27-05-2022 04:38:52', '103.180.149.203'),
(82, 'admin999', '00ba7ceab606427071d5d755ea99e976', '', '', '0', '', '0', '1', 'EAAAa743b4ce4e4683e4409071e46a451191', '27-05-2022 05:27:33', '27.71.85.174'),
(83, 'manhmkey', '4297f44b13955235245b2497399d7a93', '', '', '0', '', '0', '1', 'EAAAef7b799cf6bc11e733f0ced31d7e6c1b', '27-05-2022 07:30:40', '2001:ee0:566c:3ba0:e0c7:2c8b:f5d7:2f0c'),
(84, 'ffffffadw', 'bfa10eae75865a07528041fe566743b3', '', '', '0', '', '0', '1', 'EAAA42bdc522d67ea4c78d3afc5b41c8a2e6', '27-05-2022 10:14:11', '58.187.174.14'),
(85, 'phangiathuyen', '9fe3425004997d24d4e2c5a59d11f880', '', '', '0', '', '0', '1', 'EAAA681d9a07a3e5520bbb7b75fd671e9f55', '27-05-2022 12:07:41', '2402:800:629f:167e:791a:b5f4:461:957b'),
(86, 'Nguyentuantu2311', '5e6432740ebb41c4fe6951af4caad843', '', '', '0', '', '0', '1', 'EAAA29a775df36141a2a71692a09a7d1e4e2', '27-05-2022 12:34:09', '2402:800:6210:db02:e0c9:13f6:9a76:e0f5'),
(87, 'thanhvucoder', 'f47e92bb3d6e252246cd414aca556a3d', '', '', '0', '', '0', '1', 'EAAA993389689f4b643450af0123403f2174', '27-05-2022 12:39:17', '113.183.228.101'),
(88, 'Ccccccccccc', '9853cec42f86b6572cfca14bc17affd5', '', '', '0', '', '0', '1', 'EAAA65861b7982c4d759e868503745a160bb', '27-05-2022 12:46:19', '2402:800:612d:cfa4:907:ed41:98cd:5393'),
(89, 'afffea', 'c08afdf93fbc1b91f6e53ffc766ebd66', '', '', '0', '', '0', '1', 'EAAA4be18106bb8fdb514e64552946bfbf23', '28-05-2022 09:06:13', '2402:800:63eb:b6eb:74b5:eb7f:7169:652f');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cmt`
--
ALTER TABLE `cmt`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `daily`
--
ALTER TABLE `daily`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `dichvu`
--
ALTER TABLE `dichvu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `like_post`
--
ALTER TABLE `like_post`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `naptien`
--
ALTER TABLE `naptien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `server`
--
ALTER TABLE `server`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `cmt`
--
ALTER TABLE `cmt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `daily`
--
ALTER TABLE `daily`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `dichvu`
--
ALTER TABLE `dichvu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `like_post`
--
ALTER TABLE `like_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT cho bảng `naptien`
--
ALTER TABLE `naptien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT cho bảng `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `server`
--
ALTER TABLE `server`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `theloai`
--
ALTER TABLE `theloai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
