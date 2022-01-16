<?php
// önce id kontrol
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    
    // veritabanı 
    require_once "configson.php";
    
    //seçme 
    $sql = "SELECT * FROM ogrencikayıt WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        
        // bağlama
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // parametre ayarlama
        $param_id = trim($_GET["id"]);
        
        // uygulama
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                

                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // değerler
                $isim = $row["isim"];
                $seviye_sınıfı = $row["seviye_sınıfı"];
                $ucret = $row["ucret"];
                $odeme_tipi = $row["odeme_tipi"];
                $odenmis_ucret = $row["odenmis_ucret"];
                $kalan_ucret = $row["kalan_ucret"];
                $kurs_tarihi = $row["kurs_tarihi"];
                $telefon = $row["telefon"];
                $adres = $row["adres"];
            } else{
                // hata yönlendrime
                header("location: errorson.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    
    mysqli_stmt_close($stmt);
    
    
    mysqli_close($link);
} else{
    // hata yönlendrime
    header("location: errorson.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıtlar</title>
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
                        <h1>Kayıt Görüntüleme</h1>



                    </div>
                    <div class="form-group">
                        <label>isim</label>
                        <p class="form-control-static"><?php echo $row["isim"]; ?></p>
                    </div>



                    <div class="form-group">
                        <label>seviye sınıfı</label>
                        <p class="form-control-static"><?php echo $row["seviye_sınıfı"]; ?></p>
                    </div>


                    <div class="form-group">
                        <label>ucret</label>
                        <p class="form-control-static"><?php echo $row["ucret"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>odeme tipi</label>
                        <p class="form-control-static"><?php echo $row["odeme_tipi"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>odenmis ucret</label>
                        <p class="form-control-static"><?php echo $row["odenmis_ucret"]; ?></p>
                    </div>


                    <div class="form-group">
                        <label>kalan ucret</label>
                        <p class="form-control-static"><?php echo $row["kalan_ucret"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>kurs tarihi</label>
                        <p class="form-control-static"><?php echo $row["kurs_tarihi"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>telefon</label>
                        <p class="form-control-static"><?php echo $row["telefon"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>adres </label>
                        <p class="form-control-static"><?php echo $row["adres"]; ?></p>
                    </div>




                    <p><a href="welcome.php" class="btn btn-primary">Geri</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>