/*
 Navicat Premium Data Transfer

 Source Server         : ionix
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : pos_kitty

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 19/08/2020 09:18:20
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `menu_id` int(4) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NULL DEFAULT NULL,
  `menu_title` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menu_link` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menu_icon` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menu_type` int(4) NULL DEFAULT NULL,
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, 1, 'dashboard', 'dashboard', 'bx bx-home-circle', 0);
INSERT INTO `menu` VALUES (2, 2, 'administration', '#', 'bx bx-cog', 0);
INSERT INTO `menu` VALUES (3, 1, 'manage menu', 'menu', 'bx bxs-food-menu', 2);
INSERT INTO `menu` VALUES (6, 2, 'manage group', 'group', 'bx bxs-cube', 2);
INSERT INTO `menu` VALUES (7, 2, 'manage user', 'user', 'bx bx-male', 2);
INSERT INTO `menu` VALUES (9, 2, 'manage role', 'role', 'bx bx-log-in-circle', 2);
INSERT INTO `menu` VALUES (11, 1, 'barang', 'barang', 'bx bx-basket', 12);
INSERT INTO `menu` VALUES (12, 2, 'Produk', '#', 'bx bx-box', 0);
INSERT INTO `menu` VALUES (13, 11, 'pembelian', 'pembelian', 'bx bx-transfer', 0);
INSERT INTO `menu` VALUES (14, 11, 'penjualan', 'penjualan', 'bx bx-cart-alt', 0);
INSERT INTO `menu` VALUES (15, 12, 'laporan penjualan', 'report', 'bx bxs-report', 0);
INSERT INTO `menu` VALUES (16, 2, 'supplier', 'supplier', 'bx bxs-truck', 0);
INSERT INTO `menu` VALUES (17, 2, 'jenis', 'satuan', 'bx bx-purchase-tag-alt', 12);
INSERT INTO `menu` VALUES (18, 2, 'merk', 'kategori', 'bx bx-fridge', 12);

-- ----------------------------
-- Table structure for menu_access
-- ----------------------------
DROP TABLE IF EXISTS `menu_access`;
CREATE TABLE `menu_access`  (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `role_id` int(4) NOT NULL,
  `group_id` int(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu_access
-- ----------------------------
INSERT INTO `menu_access` VALUES (2, 1, 2);
INSERT INTO `menu_access` VALUES (6, 1, 1);
INSERT INTO `menu_access` VALUES (7, 1, 11);
INSERT INTO `menu_access` VALUES (8, 1, 12);

-- ----------------------------
-- Table structure for menu_group
-- ----------------------------
DROP TABLE IF EXISTS `menu_group`;
CREATE TABLE `menu_group`  (
  `group_id` int(4) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`group_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu_group
-- ----------------------------
INSERT INTO `menu_group` VALUES (1, 'Menu Utama');
INSERT INTO `menu_group` VALUES (2, 'Master Data ');
INSERT INTO `menu_group` VALUES (11, 'transaksi');
INSERT INTO `menu_group` VALUES (12, 'report');

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role`  (
  `role_id` int(4) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES (1, 'Administrator');
INSERT INTO `role` VALUES (2, 'Kasir');
INSERT INTO `role` VALUES (3, 'Manager');
INSERT INTO `role` VALUES (4, 'Owner');
INSERT INTO `role` VALUES (5, 'Waiters');

-- ----------------------------
-- Table structure for suplier
-- ----------------------------
DROP TABLE IF EXISTS `suplier`;
CREATE TABLE `suplier`  (
  `suplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `suplier_nama` varchar(35) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `suplier_alamat` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `suplier_notelp` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`suplier_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of suplier
-- ----------------------------
INSERT INTO `suplier` VALUES (3, 'PT Sejahtera', 'serang', '087710540095');

-- ----------------------------
-- Table structure for tb_barang
-- ----------------------------
DROP TABLE IF EXISTS `tb_barang`;
CREATE TABLE `tb_barang`  (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `kd_barang` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `satuan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kategori` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_update` datetime(6) NULL DEFAULT current_timestamp(6),
  PRIMARY KEY (`id_barang`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_barang
-- ----------------------------
INSERT INTO `tb_barang` VALUES (1, 'br0001', 'rk001', 'bn001', 'firhan', '2020-07-02 00:24:47.000000');
INSERT INTO `tb_barang` VALUES (5, 'br0002', 'on001', 'ac001', 'firhan', '2020-08-03 00:31:31.117562');
INSERT INTO `tb_barang` VALUES (6, 'br0003', 'be001', 'bn001', 'firhan', '2020-08-12 17:48:37.892908');

-- ----------------------------
-- Table structure for tb_beli
-- ----------------------------
DROP TABLE IF EXISTS `tb_beli`;
CREATE TABLE `tb_beli`  (
  `invoice` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_beli` date NOT NULL,
  `supplier` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`invoice`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_beli
-- ----------------------------
INSERT INTO `tb_beli` VALUES ('BL190820000001', '2020-08-19', 1, 'firhan');

-- ----------------------------
-- Table structure for tb_detail_beli
-- ----------------------------
DROP TABLE IF EXISTS `tb_detail_beli`;
CREATE TABLE `tb_detail_beli`  (
  `id_detail_beli` int(11) NOT NULL AUTO_INCREMENT,
  `invoice` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_barang` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nabar` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kategori` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `ukuran` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `warna` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_detail_beli`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 50 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_detail_beli
-- ----------------------------
INSERT INTO `tb_detail_beli` VALUES (49, 'BL190820000001', 'br0001', 'rok', 'bronze', 30000, 3, 90000, 'M', 'merah');

-- ----------------------------
-- Table structure for tb_detail_order
-- ----------------------------
DROP TABLE IF EXISTS `tb_detail_order`;
CREATE TABLE `tb_detail_order`  (
  `id_detail_order` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_order` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_barang` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ukuran` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `warna` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harjul` double NULL DEFAULT NULL,
  `qty` int(11) NULL DEFAULT NULL,
  `total` double NULL DEFAULT NULL,
  `nabar` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kategori` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_detail_order`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_detail_order
-- ----------------------------
INSERT INTO `tb_detail_order` VALUES (10, 'PU190820000001', 'br0001', 'M', 'merah', 40000, 7, 280000, 'rok', 'bronze');

-- ----------------------------
-- Table structure for tb_kategori
-- ----------------------------
DROP TABLE IF EXISTS `tb_kategori`;
CREATE TABLE `tb_kategori`  (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kategori` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_kategori` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_kategori`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_kategori
-- ----------------------------
INSERT INTO `tb_kategori` VALUES (1, 'at001', 'atesa');
INSERT INTO `tb_kategori` VALUES (2, 'sc001', 'secondhand');
INSERT INTO `tb_kategori` VALUES (3, 'bn001', 'bronze');
INSERT INTO `tb_kategori` VALUES (5, 'ac001', 'achilles');
INSERT INTO `tb_kategori` VALUES (12, 'b001', 'keranjang');
INSERT INTO `tb_kategori` VALUES (13, 'b002', 'kaos');
INSERT INTO `tb_kategori` VALUES (14, 'b003', 'sempak');
INSERT INTO `tb_kategori` VALUES (15, 'b004', 'ayam');
INSERT INTO `tb_kategori` VALUES (16, 'b005', 'bebek');

-- ----------------------------
-- Table structure for tb_menu
-- ----------------------------
DROP TABLE IF EXISTS `tb_menu`;
CREATE TABLE `tb_menu`  (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  PRIMARY KEY (`id_menu`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_order
-- ----------------------------
DROP TABLE IF EXISTS `tb_order`;
CREATE TABLE `tb_order`  (
  `invoice` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal` timestamp(0) NULL DEFAULT current_timestamp(0),
  `total` double NULL DEFAULT NULL,
  `jml_uang` double NULL DEFAULT NULL,
  `kembalian` double NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `keterangan` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`invoice`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_order
-- ----------------------------
INSERT INTO `tb_order` VALUES ('PU190820000001', '2020-08-19 09:12:32', 280000, 300000, 20000, 'firhan', 'offline');

-- ----------------------------
-- Table structure for tb_pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `tb_pelanggan`;
CREATE TABLE `tb_pelanggan`  (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `no_tlp` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` int(255) NOT NULL,
  PRIMARY KEY (`id_pelanggan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_satuan
-- ----------------------------
DROP TABLE IF EXISTS `tb_satuan`;
CREATE TABLE `tb_satuan`  (
  `id_satuan` int(11) NOT NULL AUTO_INCREMENT,
  `kode_satuan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_satuan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_satuan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_satuan
-- ----------------------------
INSERT INTO `tb_satuan` VALUES (1, 'rk001', 'rok');
INSERT INTO `tb_satuan` VALUES (2, 'on001', 'one set');
INSERT INTO `tb_satuan` VALUES (3, 'be001', 'belt');
INSERT INTO `tb_satuan` VALUES (5, 'k002', 'dress');

-- ----------------------------
-- Table structure for tb_supplier
-- ----------------------------
DROP TABLE IF EXISTS `tb_supplier`;
CREATE TABLE `tb_supplier`  (
  `id_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tlp` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_supplier`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_supplier
-- ----------------------------
INSERT INTO `tb_supplier` VALUES (1, 'PT BETON FOODTRUCK', 'JL. Sumadinata Gg Manjur No 90                                                    \r\n                                                ', '087654321543');
INSERT INTO `tb_supplier` VALUES (2, 'CV Amanah Barokah', 'JL. Mama Suka Ds Mekar Sari No.90                                                     \r\n                                                ', '089777656443');

-- ----------------------------
-- Table structure for tb_ukuran
-- ----------------------------
DROP TABLE IF EXISTS `tb_ukuran`;
CREATE TABLE `tb_ukuran`  (
  `id_ukuran` int(11) NOT NULL AUTO_INCREMENT,
  `kd_barang` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ukuran` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `warna` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `qty` int(11) NULL DEFAULT NULL,
  `harga_beli` int(11) NULL DEFAULT NULL,
  `harga_jual` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_ukuran`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_ukuran
-- ----------------------------
INSERT INTO `tb_ukuran` VALUES (2, 'br0001', 'M', 'hitam', 1, 30000, 40000);
INSERT INTO `tb_ukuran` VALUES (4, 'br0002', 'S', 'merah', 58, 40000, 80000);
INSERT INTO `tb_ukuran` VALUES (5, 'br0001', 'S', 'hijau', 3, 30000, 40000);
INSERT INTO `tb_ukuran` VALUES (6, 'br0001', 'L', 'merah', 45, 30000, 40000);
INSERT INTO `tb_ukuran` VALUES (7, 'br0001', 'L', 'coklat', 45, 30000, 40000);
INSERT INTO `tb_ukuran` VALUES (8, 'br0001', 'L', 'hijau', 47, 30000, 40000);
INSERT INTO `tb_ukuran` VALUES (9, 'br0001', 'M', 'merah', 32, 30000, 40000);
INSERT INTO `tb_ukuran` VALUES (10, 'br0003', 'L', 'hijau', 29, 30000, 40000);
INSERT INTO `tb_ukuran` VALUES (14, 'br0001', 'ALL SIZE', 'kuning', 33, 50000, 60000);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_lengkap` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_active` int(2) NULL DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `role_id` int(2) NULL DEFAULT NULL,
  `log` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `keterangan` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'firhan', '$2y$10$sbWkPBJ6raF1jwQu7OAF6eCxoyBfEBGPN3lUh.d536mio0xyUNvZ2', 'Firhan Adnan', 1, NULL, 1, '2020-08-19 09:13:19', 'offline');

SET FOREIGN_KEY_CHECKS = 1;
