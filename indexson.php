
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
                    // Include config file

                    require_once "configson.php";

                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM ogrencikayıt";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";



                                        echo "<th>#</th>";
                                        echo "<th>isim</th>";
                                        echo "<th>seviye_sınıfı</th>";
                                        echo "<th>ucret</th>";
                                        echo "<th>odeme_tipi</th>";
                                        echo "<th>odenmis_ucret</th>";
                                        echo "<th>kalan_ucret</th>";
                                        echo "<th>kurs_tarihi</th>";
                                        echo "<th>telefon</th>";
                                        echo "<th>adres</th>";
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

                                            echo "<a href='readson.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='updateson.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='deleteson.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>