<?php
// veritabanı bağlantı
require_once "configson.php";
 
// değişkenler ve boş değerler
$isim = $seviye_sınıfı = $ucret = $odeme_tipi = $odenmis_ucret = $kalan_ucret = $kurs_tarihi = $telefon = $adres = "";

$isim_err = $seviye_sınıfı_err = $ucret_err = $odeme_tipi_err = $odenmis_ucret_err = $kalan_ucret_err = $kurs_tarihi_err = $telefon_err = $adres_err = "";


 
// form işleme
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // adı doğrula



    $input_isim = trim($_POST["isim"]);

    if(empty($input_isim)){
        $isim_err = "Lütfen isim giriniz.";
    } elseif(!filter_var($input_isim, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $isim_err = "Please enter a valid isim.";
    } else{
        $isim = $input_isim;
    }
    




    // sınıf doğrulama
    $input_seviye_sınıfı = trim($_POST["seviye_sınıfı"]);
    if(empty($input_seviye_sınıfı)){
        $seviye_sınıfı_err = "Lütfen sınıf giriniz.";     
    } else{
        $seviye_sınıfı = $input_seviye_sınıfı;
    }
    



    // ücret
    $input_ucret = trim($_POST["ucret"]);
    if(empty($input_ucret)){
        $ucret_err = "Lütfen ücret giriniz";     
    } elseif(!ctype_digit($input_ucret)){
        $ucret_err = "Please enter a positive integer value.";
    } else{
        $ucret = $input_ucret;
    }
    

    // ödeme tipi
    $input_odeme_tipi = trim($_POST["odeme_tipi"]);
    if(empty($input_odeme_tipi)){
        $odeme_tipi_err = "Lütfen ödeme tipi giriniz";     
    } else{
        $odeme_tipi = $input_odeme_tipi;
    }



     $input_odenmis_ucret = trim($_POST["odenmis_ucret"]);
    if(empty($input_odenmis_ucret)){
        $odenmis_ucret_err = "Lütfen varsa ödenen ücreti giriniz.";     
    } elseif(!ctype_digit($input_odenmis_ucret)){
        $odenmis_ucret_err = "Please enter a positive integer value.";
    } else{
        $odenmis_ucret = $input_odenmis_ucret;
    }


 $input_kalan_ucret = trim($_POST["kalan_ucret"]);
    if(empty($input_kalan_ucret)){
        $kalan_ucret_err = "Lütfen kalan ücreti giriniz.";     
    } elseif(!ctype_digit($input_kalan_ucret)){
        $kalan_ucret_err = "Please enter a positive integer value.";
    } else{
        $kalan_ucret = $input_kalan_ucret;
    }

    // tarih 
    $input_kurs_tarihi = trim($_POST["kurs_tarihi"]);
    if(empty($input_kurs_tarihi)){
        $kurs_tarihi_err = "Lütfen kurs tarihi giriniz.";     
    } else{
        $kurs_tarihi = $input_kurs_tarihi;
    }


    

 $input_telefon = trim($_POST["telefon"]);
    if(empty($input_telefon)){
        $telefon_err = "Lütfen telefon giriniz";     
    } elseif(!ctype_digit($input_telefon)){
        $telefon_err = "Please enter a positive integer value.";
    } else{
        $telefon = $input_telefon;
    }

    // Validate address
    $input_adres = trim($_POST["adres"]);
    if(empty($input_adres)){
        $adres_err = "Lütfen adres giriniz.";     
    } else{
        $adres = $input_adres;
    }



    // kayıttan önce girişleri kontrol
    if(empty($isim_err) && empty($seviye_sınıfı_err) && empty($ucret_err)&& empty($odeme_tipi_err)&& empty($odenmis_ucret_err)&& empty($kalan_ucret_err)&& empty($kurs_tarihi_err)&& empty($telefon_err)&& empty($adres_err)){
        


        
        $sql = "INSERT INTO ogrencikayıt (isim, seviye_sınıfı, ucret, odeme_tipi, odenmis_ucret, kalan_ucret,kurs_tarihi,telefon,adres) VALUES (?, ?, ?,?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            // değişkenleri parametreye bağla
            mysqli_stmt_bind_param($stmt, "sssssssss", $param_isim, $param_seviye_sınıfı, $param_ucret, $param_odeme_tipi, $param_odenmis_ucret, $param_kalan_ucret, $param_kurs_tarihi, $param_telefon, $param_adres);
            
            // parametreler
            $param_isim = $isim;
            $param_seviye_sınıfı = $seviye_sınıfı;
            $param_ucret = $ucret;
            $param_odeme_tipi = $odeme_tipi;
            $param_odenmis_ucret = $odenmis_ucret;
            $param_kalan_ucret = $kalan_ucret;
            $param_kurs_tarihi = $kurs_tarihi;
            $param_telefon = $telefon;
            $param_adres = $adres;
           
            
            // uygulama
            if(mysqli_stmt_execute($stmt)){
                // kayıt başarılıysa yönlendir
                header("location: welcome.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        
        mysqli_stmt_close($stmt);
    }
    
   
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Oluştur</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Kayıt Oluştur</h2>
                    </div>

                    <p>Öğrenci kaydını veritabanına eklemek için bu formu doldurun ve gönderin.</p>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


                        <div class="form-group <?php echo (!empty($isim_err)) ? 'has-error' : ''; ?>">
                            <label>isim</label>
                            <input type="text" name="isim" class="form-control" value="<?php echo $isim; ?>">
                            <span class="help-block"><?php echo $isim_err;?></span>
                        </div>


                        <div class="form-group <?php echo (!empty($seviye_sınıfı_err)) ? 'has-error' : ''; ?>">
                            <label>seviye sınıfı</label>
                            <input type="text" name="seviye_sınıfı" class="form-control" value="<?php echo $seviye_sınıfı; ?>">
                            <span class="help-block"><?php echo $seviye_sınıfı_err;?></span>
                        </div>


                        <div class="form-group <?php echo (!empty($ucret_err)) ? 'has-error' : ''; ?>">
                            <label>ücret</label>
                            <input type="text" name="ucret" class="form-control" value="<?php echo $ucret; ?>">
                            <span class="help-block"><?php echo $ucret_err;?></span>
                        </div>

                         <div class="form-group <?php echo (!empty($odeme_tipi_err)) ? 'has-error' : ''; ?>">
                            <label>odeme tipi</label>
                            <input type="text" name="odeme_tipi" class="form-control" value="<?php echo $odeme_tipi; ?>">
                            <span class="help-block"><?php echo $odeme_tipi_err;?></span>
                        </div>


                        <div class="form-group <?php echo (!empty($odenmis_ucret_err)) ? 'has-error' : ''; ?>">
                            <label>odenmis ucret</label>
                            <input type="text" name="odenmis_ucret" class="form-control" value="<?php echo $odenmis_ucret; ?>">
                            <span class="help-block"><?php echo $odenmis_ucret_err;?></span>
                        </div>


                        <div class="form-group <?php echo (!empty($kalan_ucret_err)) ? 'has-error' : ''; ?>">
                            <label>kalan ucret</label>
                            <input type="text" name="kalan_ucret" class="form-control" value="<?php echo $kalan_ucret; ?>">
                            <span class="help-block"><?php echo $kalan_ucret_err;?></span>
                        </div>


                        <div class="form-group <?php echo (!empty($kurs_tarihi_err)) ? 'has-error' : ''; ?>">
                            <label>kurs tarihi</label>
                            <input type="text" name="kurs_tarihi" class="form-control" value="<?php echo $kurs_tarihi; ?>">
                            <span class="help-block"><?php echo $kurs_tarihi_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($telefon_err)) ? 'has-error' : ''; ?>">
                            <label>telefon</label>
                            <input type="text" name="telefon" class="form-control" value="<?php echo $telefon; ?>">
                            <span class="help-block"><?php echo $telefon_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($adres_err)) ? 'has-error' : ''; ?>">
                            <label>adres</label>
                            <textarea name="adres" class="form-control"><?php echo $adres; ?></textarea>
                            <span class="help-block"><?php echo $adres_err;?></span>
                        </div>


                        <input type="submit" class="btn btn-primary" value="Kaydet">
                        <a href="welcome.php" class="btn btn-default">İptal
                        </a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>