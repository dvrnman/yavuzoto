<?php
ob_start();
    require_once "../baglan.php";
    include_once "session.php";
   
    

    

        if($_POST)
        {
        
          $matekey=isset($_POST["metaKey"]) ? $_POST['metaKey'] : null;
          $matedes=isset($_POST["metaDes"]) ? $_POST['metaDes'] : null;
          $icerik=isset($_POST["icerik"]) ? $_POST['icerik'] : null;
          $marka=isset($_POST["marka"]) ? $_POST['marka'] : null; 
          $model=isset($_POST["model"]) ? $_POST['model'] : null;
          $detay=isset($_POST["detay"]) ? $_POST['detay'] : null;
          $resim=$_FILES['dosya']['name'];

          $dosyadizin="images";

          if(isset($_FILES['dosya']))
         {

          $yol = "images/"; 
          $yuklemeYeri = __DIR__ . DIRECTORY_SEPARATOR . $yol . DIRECTORY_SEPARATOR . $_FILES["dosya"]["name"];

          $sonuc = move_uploaded_file($_FILES["dosya"]["tmp_name"], $yuklemeYeri);

          
                   
               $ekle = $db->prepare("insert into urun set  metaKeywords =? ,metaDescription =? ,  name =? ,   listeDetay =? ,Marka=? ,model =?,resim=?");
                 $ekle->execute([
                    htmlspecialchars($matekey),
                        htmlspecialchars($matedes),
                        htmlspecialchars($icerik),
                       htmlspecialchars ($detay),
                        htmlspecialchars($marka),
                        htmlspecialchars($model),
                        $resim ]);

           }

            header("Location:listele.php");
            exit();
            

        }


 ?>

<!doctype html>
<html lang="tr">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <meta charset="UTF-8">
    <title>Ekle</title>

    <!--styles-->
    <link rel="stylesheet" href="assets/styles/main.css">

    <!--scripts-->
    <script src="assets/scripts/jquery-1.12.2.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.5.7/basic/ckeditor.js"></script>
    <script src="assets/scripts/admin.js"></script>

</head>

<body>

    <?php require 'navbar.php'; ?>

    <!--content-->
    <div class="content">

        <div class="box-">
            <h1>
                Ürün Ekle
            </h1>
        </div>

        <div class="clear" style="height: 10px;"></div>

        <div class="box-">
            <form action="" class="form label" method="post" enctype="multipart/form-data">
                <ul>
                    <li>
                        <label for="title">Meta Keywords</label>
                        <div class="form-content">
                            <input type="text" id="title" name="metaKey" required="Lütfen Boş Bırakmayın!">
                        </div>
                    </li>
                    <li>
                        <label for="title">Meta Description</label>
                        <div class="form-content">
                            <input type="text" id="title" name="metaDes" required="Lütfen Boş Bırakmayın!">
                        </div>
                    </li>
                    <li>
                        <label for="title">İçerik İsmi</label>
                        <div class="form-content">
                            <input type="text" id="title" name="icerik" required="Lütfen Boş Bırakmayın!">
                        </div>
                    </li>
                    <li>
                        <label for="title">Marka</label>
                        <div class="form-content">
                            <input type="text" id="title" name="marka" required="Lütfen Boş Bırakmayın!">
                            <p>
                                İki Markada Kullanılıyorsa Araya Çizgi "-" İşaretini koyarak Ekleyiniz.
                            </p>
                        </div>
                    </li>
                    <li>
                        <label for="title">Model</label>
                        <div class="form-content">
                            <input type="text" name="model" id="title" required="Lütfen Boş Bırakmayın!">

                        </div>

                    </li>
                    <li>
                        <label for="myfile">Resmi Seçiniz:</label>
                        <input type="file" id="myfile" name="dosya"><br><br>
                    </li>

                    <li>
                        <label for="description">Liste Detay</label>
                        <div class="form-content">
                            <textarea name="detay" id="description" cols="30" rows="5"
                                required="Lütfen Boş Bırakmayın!"></textarea>

                        </div>
                    </li>


                    <li class="submit">
                        <button type="submit">Kaydet </button>
                    </li>
                </ul>
            </form>
        </div>

    </div>

</body>

</html>