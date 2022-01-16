<?php
// oturum başlatma
session_start();
 
// oturum açma kontrol
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
header("location: login.php");
    exit;
 }
 
// veritabanı
require_once "configson.php";
 
// değişken tanımlama kontrol
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// form işaretmeleme
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // yen işifre
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // girişten önce kontrol
    if(empty($new_password_err) && empty($confirm_password_err)){
        // bildirim
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // parametre bağlama
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // parametrelere
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // uygulama
            if(mysqli_stmt_execute($stmt)){
                // başarılı giriş yönlendirmesi
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }
    
    
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Şifreni Yenile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ margin-right: auto;
  margin-left:  auto;
  margin-top: 50px;
  max-width: 360px;
  padding-right: 50px;
  padding-left:  10px; 
  
}
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Şifreni Yenile</h2>
        <p>Şifrenizi sıfırlamak için lütfen bu formu doldurun.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>Yeni Şifre</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Şifreyi Onayla</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="submit">
                <a class="btn btn-link" href="welcome.php">İptal Et</a>
            </div>
        </form>
    </div>    
</body>
</html>