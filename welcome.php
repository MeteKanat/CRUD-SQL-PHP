<?php
// oturum başlatma
session_start();
 
// kontrol
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ana Ekran</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Merhaba, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Sitenize hoşgeldiniz...</h1>

        <!DOCTYPE html>
<html lang="tr">
<head>
    <meta http-equiv="refresh" content="url=indexson.php">
    <meta charset="UTF-8">
    <title>Kayıt</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: -500px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right:10px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Öğrenci Kayıtları</h2>
                        <a href="createson.php" class="btn btn-success pull-right">Yeni Öğrenci Ekle</a>
                    </div>
                    <?php
                    // veritabanı bağlantısı

                    require_once "configson.php";

                    
                    // sorgular
                    $sql = "SELECT * FROM ogrencikayıt";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";



                                        echo "<th>#</th>";
                                        echo "<th>İsim</th>";
                                        echo "<th>Seviye Sınıfı</th>";
                                        echo "<th>Ücret</th>";
                                        echo "<th>Ödeme Tipi</th>";
                                        echo "<th>Ödenmis Ücret</th>";
                                        echo "<th>Kalan Ücret</th>";
                                        echo "<th>Kurs Tarihi</th>";
                                        echo "<th>Telefon</th>";
                                        echo "<th>Adres</th>";
                                        echo "<th>Action</th>";
                                        


                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['isim'] . "</td>";
                                        echo "<td>" . $row['seviye_sınıfı'] ."</td>";
                                        echo "<td>" . $row['ucret'] . "</td>";
                                        echo "<td>" . $row['odeme_tipi'] ."</td>";
                                        echo "<td>" . $row['odenmis_ucret'] . "</td>";
                                        echo "<td>" . $row['kalan_ucret'] ."</td>";
                                        echo "<td>" . $row['kurs_tarihi'] . "</td>";
                                        echo "<td>" . $row['telefon'] . "</td>";
                                        echo "<td>" . $row['adres'] . "</td>";
                                        
                

                                        echo "<td>";

                                            echo "<a href='readson.php?id=". $row['id'] ."' title='Kayıt Gör' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='updateson.php?id=". $row['id'] ."' title='Kayıt Güncelle' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='deleteson.php?id=". $row['id'] ."' title='Kayıt Sil' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    
                    mysqli_close($link);
                    ?>
                </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Şifreni Yenile</a>
        <a href="logout.php" class="btn btn-danger">Hesabından Çıkış Yap</a>
    </p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
    
</body>
</html>