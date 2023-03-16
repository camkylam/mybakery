create database banh character set='utf8';
use banh;

CREATE TABLE `admin` (
  `id` int(100) NOT NULL primary key AUTO_INCREMENT,
  `ten` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
);
INSERT INTO `admin` (`id`, `ten`,`email`, `password`) VALUES
(1, 'admin','admin@gmail.com', 'admin123');
CREATE TABLE `khachhang` (
  `id_khach` int(100) NOT NULL primary key AUTO_INCREMENT,
  `ten_khach` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
);
INSERT INTO `khachhang` (`id_khach`, `ten_khach`,`email`, `password`) VALUES
(1, 'camky','camkylam@gmail.com', '123456789');

CREATE TABLE `loinhan` (
  `id_loinhan` int(100) NOT NULL primary key AUTO_INCREMENT,
  `id_khach` int(100) NOT NULL,
  `ten_khach` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sodienthoai` varchar(12) NOT NULL,
  `diachi`  varchar(100) NOT NULL,
  `loi_nhan` varchar(500) NOT NULL,
  foreign key (id_khach) references khachhang(id_khach)
);

CREATE TABLE `dathang` (
  `id_dathang` int(100) NOT NULL primary key AUTO_INCREMENT,
  `id_khach` int(100) NOT NULL,
  `ten_khach` varchar(20) NOT NULL,
  `sodienthoai` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phuongthuc` varchar(50) NOT NULL,
  `diachi` varchar(500) NOT NULL,
  `tong_sp` varchar(1000) NOT NULL,
  `tong_chiphi` int(100) NOT NULL,
  `trangthai_TT` varchar(20) NOT NULL DEFAULT 'đang chờ duyệt',
  `gio_dat` date NOT NULL DEFAULT current_timestamp(),
  foreign key (id_khach) references khachhang(id_khach)
);

CREATE TABLE `sanpham` (
  `id_sp` int(100) NOT NULL primary key AUTO_INCREMENT,
  `ten_sp` varchar(100) NOT NULL,
  `loai_sp` varchar(500) NOT NULL,
  `gia_sp` int(10) NOT NULL,
  `anh_sp` varchar(100) NOT NULL,
  `trangthai_sp`  varchar(100) NOT NULL
);
INSERT INTO sanpham (id_sp, ten_sp, loai_sp, gia_sp, anh_sp, trangthai_sp) VALUES 
('01', 'Bánh kem Chocolate dâu ', 'bánh sinh nhật', '380', 'bsn1.jpg','bình thường'),
('02', 'Bánh kem viền tím ', 'bánh sinh nhật', '350', 'bsn3.webp','được yêu thích nhất'),
('03', 'Bánh kem set makeup ', 'bánh sinh nhật', '390', 'bsn4.jpg','được bán chạy nhất'),
('04', 'Bánh kem chúc thọ ', 'bánh sinh nhật', '330', 'bsn14.jpg','được bán chạy nhất'),
('05', 'Bánh kem hoa hồng tím ', 'bánh sinh nhật', '360', 'bsn10.jpg','được yêu thích nhất'),
('06', 'Bánh kem hoa đào ', 'bánh sinh nhật', '350', 'bsn6.jpg','bình thường'),
('08', 'Bánh kem hình trái tim ', 'bánh sinh nhật', '395', 'bsn8.jpg','bình thường'),
('09', 'Bánh kem nhân ngày của mẹ ', 'bánh sinh nhật', '390', 'bsn15.jpg','bình thường'),
('10', 'Bánh kem nhân ngày của cha ', 'bánh sinh nhật', '390', 'bsn19.jpg','bình thường'),
('11', 'Bánh bao chay tím ', 'bánh bao', '10', 'bbct.webp','bình thường'),
('12', 'Bánh bao chay nâu ', 'bánh bao', '10', 'bb9.jpg','bình thường'),
('13', 'Bánh bao mừng khai trương ', 'bánh bao', '350', 'bb14.jpg','được bán chạy nhất'),
('14', 'Bánh bao sầu riêng ', 'bánh bao', '20', 'bb24.jpg','bình thường'),
('15', 'Bánh bao than tre ', 'bánh bao', '15', 'bb22.jpg','được yêu thích nhất'),
('16', 'Bánh bao trứng chảy ', 'bánh bao', '25', 'bb19.jpg','bình thường'),
('17', 'Bánh bao bí ngô ', 'bánh bao', '10', 'bbbn.jpg','bình thường'),
('18', 'Bánh bao nhân môn ', 'bánh bao', '15', 'bb6.jpg','bình thường'),
('19', 'Bánh bao tạo hình mini ', 'bánh bao', '35', 'bb11.jpg','bình thường'),
('20', 'Bông lan cuộn cam', 'bánh bông lan', '50', 'bbl6.jpg','bình thường'),
('21', 'Bông lan cuộn dâu ', 'bánh bông lan', '45', 'bbl20.jpg','bình thường'),
('22', 'Bông lan kem ', 'bánh bông lan', '20', 'bbl15.jpg','bình thường'),
('23', 'Bông lan nho khô ', 'bánh bông lan', '65', 'bbl14.jpg','bình thường'),
('24', 'Bông lan chocolate ', 'bánh bông lan', '30', 'bbl16.jpg','bình thường'),
('25', 'Bông lan chà bông', 'bánh bông lan', '60', 'bbl25.jpg','bình thường'),
('26', 'Bông lan trứng muối', 'bánh bông lan', '350', 'bbl5.jpg','được bán chạy nhất'),
('27', 'Bông lan phô mai ', 'bánh bông lan', '50', 'bbl22.webp','được yêu thích nhất'),
('28', 'Bông lan phủ dừa ', 'bánh bông lan', '300', 'bbl17.jpg','bình thường'),
('29', 'Cupcake Chocolate ', 'Bánh cupcake', '16', 'bck9.jpg','bình thường'),
('30', 'Cupcake xương rồng', 'Bánh cupcake', '15', 'bck18.jpg','được yêu thích nhất'),
('31', 'Cupcake đuôi cá ', 'Bánh cupcake', '20', 'bck12.jpg','bình thường'),
('32', 'Cupcake cam', 'Bánh cupcake', '15', 'bck24.jpg','bình thường'),
('33', 'Cupcake hoa hồng', 'Bánh cupcake', '18', 'bck4.jpg','bình thường'),
('34', 'Cupcake mật ong', 'Bánh cupcake', '18', 'bck6.jpg','bình thường'),
('35', 'Cupcake chà bông', 'Bánh cupcake', '20', 'bck25.jpg','được bán chạy nhất'),
('36', 'Cupcake dâu', 'Bánh cupcake', '15', 'bck2.jpg','bình thường'),
('37', 'Cupcake oreo ', 'Bánh cupcake', '15', 'bck22.jpg','bình thường'),
('38', 'Bánh mì hình hoa ', 'Bánh mì', '65', 'bm3.jpg','bình thường'),
('39', 'Bánh mì sừng bò', 'Bánh mì', '15', 'bm5.jpg','bình thường'),
('40', 'Bánh mì sữa Hokkaido ', 'Bánh mì', '35', 'bm7.jpg','bình thường'),
('41', 'Bánh mì chuối ', 'Bánh mì', '30', 'bm11.jpg','bình thường'),
('42', 'Bánh mì không', 'Bánh mì', '5', 'bm13.jpg','bình thường'),
('43', 'Bánh mì hoa cúc', 'Bánh mì', '35', 'bm24.webp','được bán chạy nhất'),
('44', 'Bánh mì tròn', 'Bánh mì', '10', 'bm19.jpg','bình thường'),
('45', 'Bánh mì xúc xích ', 'Bánh mì', '25', 'bm9.jpg','được yêu thích nhất'),
('46', 'Bánh mì lá dứa ', 'Bánh mì', '30', 'bm20.jpg','bình thường');

CREATE TABLE `giohang` (
  `id_gio` int(100) NOT NULL primary key  AUTO_INCREMENT,
  `id_khach` int(100) NOT NULL,
  `id_sp` int(100) NOT NULL,
  `ten_sp` varchar(100) NOT NULL,
  `gia_sp` int(10) NOT NULL,
  `soluong_sp` int(10) NOT NULL,
  `anh_sp` varchar(100) NOT NULL,
  foreign key (id_khach) references khachhang(id_khach),
  foreign key (id_sp) references sanpham(id_sp)
);





