CREATE TABLE tb_kendaraan (
  id_kendaraan INT PRIMARY KEY AUTO_INCREMENT,
  plat_nomor VARCHAR(15),
  jenis_kendaraan VARCHAR(20),
  warna VARCHAR(20),
  pemilik VARCHAR(20),
  id_user INT
);
