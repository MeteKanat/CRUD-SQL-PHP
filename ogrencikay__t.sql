-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 23 Oca 2021, 12:10:50
-- Sunucu sürümü: 10.4.14-MariaDB
-- PHP Sürümü: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `dershaneson`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrencikayıt`
--

CREATE TABLE `ogrencikayıt` (
  `id` int(11) NOT NULL,
  `isim` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `seviye_sınıfı` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `ucret` int(10) NOT NULL,
  `odeme_tipi` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `odenmis_ucret` int(10) DEFAULT NULL,
  `kalan_ucret` int(10) DEFAULT NULL,
  `kurs_tarihi` date NOT NULL,
  `telefon` varchar(11) COLLATE utf8_turkish_ci NOT NULL,
  `adres` varchar(300) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ogrencikayıt`
--

INSERT INTO `ogrencikayıt` (`id`, `isim`, `seviye_sınıfı`, `ucret`, `odeme_tipi`, `odenmis_ucret`, `kalan_ucret`, `kurs_tarihi`, `telefon`, `adres`) VALUES
(7, 'METE KANAT', 'A1', 2000, 'NAKİT', 1000, 1000, '2020-10-10', '05452652502', 'ANTALYA/LARA'),
(8, 'AYSE KUTU', 'C1', 3000, 'TAKSİTLİ', 2000, 1000, '2010-10-20', '0545265250', 'ANTALYA/NILUFER.SK'),
(9, 'CEM BOLUK', 'A1', 3000, 'NAKİT', 2500, 500, '2020-01-23', '0545265250', 'ANTALYA/DOSEMEALTI'),
(10, 'METIN CAN', 'B1', 4000, 'TAKSİTLİ', 1000, 3000, '2020-01-23', '05452652502', 'ANTALYA/MURATPASA'),
(11, 'ALI GUL', 'A1', 3000, 'TAKSİTLİ', 2500, 500, '2020-10-10', '05452652502', 'ANTALYA/AKSU');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ogrencikayıt`
--
ALTER TABLE `ogrencikayıt`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ogrencikayıt`
--
ALTER TABLE `ogrencikayıt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
