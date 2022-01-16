<?php
// silme  
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // veritabanı
    require_once "configson.php";
    
    // silme 
    $sql = "DELETE FROM ogrencikayıt WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // parametrelre
        $param_id = trim($_POST["id"]);
        
        // uygulama
        if(mysqli_stmt_execute($stmt)){
            // silme başarılı yönlendirme
            header("location: welcome.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
   
    mysqli_stmt_close($stmt);
    
    
    mysqli_close($link);


} else{
    // parametre kontrol
    if(empty(trim($_GET["id"]))){
        // hata
        header("location: errorson.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Sil</title>
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
                        <h1>Kayıt Sil</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Bu kaydı silmek istediğinizden emin misiniz?</p><br>
                            <p>
                                <input type="submit" value="Evet" class="btn btn-danger">
                                <a href="welcome.php" class="btn btn-default">Hayır</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>