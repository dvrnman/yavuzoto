<?php
ob_start();
require_once "../baglan.php";
include_once "session.php";





$Sayfa   = @ceil($_GET['sayfa']); //5,2 girilirse eğer get o zaman onu tam sayı yapar yanı 5 yapıyoruz bu kod ile
if ($Sayfa < 1) { $Sayfa = 1;} //eğer get değeri yerine girilen sayi 1 den küçükse sayfa değerini 1 yapıyoruz yani 1. sayfaya atıyoruz
$Say   = $db->query("select * from urun order by id ASC"); //makale sayısını çekiyoruz

$ToplamVeri   = $Say->rowCount(); //makale sayısını saydırıyoruz

$Limit	= 10; //bir sayfada kaç içerik çıkacağını belirtiyoruz.

$Sayfa_Sayisi	= ceil($ToplamVeri/$Limit); //toplam veri ile limiti bölerek her toplam sayfa sayısını buluyoruz

if($Sayfa > $Sayfa_Sayisi){$Sayfa = $Sayfa_Sayisi;} //eğer yazılan sayı büyükse eğer toplam sayfa sayısından en son sayfaya atıyoruz kullanıcıyı

$Goster   = $Sayfa * $Limit - $Limit; // sayfa= 2 olsun limit=3 olsun 2*3=6 6-3=3 buranın değeri 2. sayfada 3'dür 3-4-5-6... sayfalarda da aynı işlem yapılıp değer bulunur

$GorunenSayfa   = 3; //altta kaç tane sayfa sayısı görüneceğini belirtiyoruz.


$Makale	= $db->query("select * from urun order by id DESC limit $Goster,$Limit"); //yukarda göstere attıgımız değer diyelim ki 3 o zaman 3.'id den başlayarak limit kadar veri ceker.

$MakaleAl = $Makale->fetchAll(PDO::FETCH_ASSOC);


if(isset($_GET["ara"]))
{
    $aranandeger=$_GET["ara"];
    $aranankelime= strtoupper($aranandeger);
    
    $aranankelime=isset($_GET["ara"]) ? $_GET["ara"] :null;
        
    $Sayfa   = @ceil($_GET['sayfa']); //5,2 girilirse eğer get o zaman onu tam sayı yapar yanı 5 yapıyoruz bu kod ile
    if ($Sayfa < 1) { $Sayfa = 1;} //eğer get değeri yerine girilen sayi 1 den küçükse sayfa değerini 1 yapıyoruz yani 1. sayfaya atıyoruz
    @$Say	= $db->query("SELECT * FROM urun WHERE Marka LIKE '%".@$aranankelime."%' OR model LIKE '%".@$aranankelime."%' OR kod LIKE '%".@$aranankelime."%' OR id LIKE '%".@$aranankelime."%' OR name LIKE '%".@$aranankelime."%'"); //yukarda göstere attıgımız değer diyelim ki 3 o zaman 3.'id den başlayarak limit kadar veri ceker.

    $ToplamVeri   = $Say->rowCount(); //makale sayısını saydırıyoruz

    $Limit	= 20; //bir sayfada kaç içerik çıkacağını belirtiyoruz. 

    $Sayfa_Sayisi	= ceil($ToplamVeri/$Limit); //toplam veri ile limiti bölerek her toplam sayfa sayısını buluyoruz

    if($Sayfa > $Sayfa_Sayisi){$Sayfa = $Sayfa_Sayisi;} //eğer yazılan sayı büyükse eğer toplam sayfa sayısından en son sayfaya atıyoruz kullanıcıyı

    $Goster   = $Sayfa * $Limit - $Limit; // sayfa= 2 olsun limit=3 olsun 2*3=6 6-3=3 buranın değeri 2. sayfada 3'dür 3-4-5-6... sayfalarda da aynı işlem yapılıp değer bulunur

    $GorunenSayfa   = 3; //altta kaç tane sayfa sayısı görüneceğini belirtiyoruz.

    try {
       $aranan	= $db->query("SELECT * FROM urun WHERE Marka LIKE '%".@$aranankelime."%' OR model LIKE '%".@$aranankelime."%' OR id LIKE '%".@$aranankelime."%' OR kod LIKE '%".@$aranankelime."%' OR name LIKE '%".@$aranankelime."%'  limit $Goster,$Limit"); //yukarda göstere attıgımız değer diyelim ki 3 o zaman 3.'id den başlayarak limit kadar veri ceker.

        $aranandeger = $aranan->fetchAll(PDO::FETCH_ASSOC);
    }
    catch( PDOException $Exception ) { ?>
<script>
alert('Aranan Veri Yok');

function yonlendir() {
    window.location.href = "listele.php";
}
yonlendir();
</script>





<?php }

    

    

   
}




?>


<!doctype html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <meta charset="UTF-8">
    <title>Listele</title>

    <!--styles-->
    <link rel="stylesheet" href="assets/styles/main.css">

    <!--scripts-->
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script src="assets/scripts/jquery-1.12.2.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.5.7/basic/ckeditor.js"></script>
    <script src="assets/scripts/admin.js"></script>
    <!-- JavaScript Bundle with Popper -->


</head>

<body>

    <?php include 'navbar.php'; ?>

    <!--content-->
    <div class="content">

        <div class="box-">
            <h1>
                All Posts
                <a href="ekle.php">Ürün Ekle</a>
            </h1>
            <div class="topnav">
                <form action="" method="get">

                    <input type="text" name="ara" placeholder="Ara..">
                    <br><br>
                    <!-- Button trigger modal -->
                    <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        ARA
                    </button>


                </form>
            </div>


        </div>

        <div class="clear" style="height: 10px;"></div>

        <?php
        if(isset($_GET["ara"])) {?>


        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>Ürün İsmi</th>
                        <th class="hide">Marka</th>
                        <th class="hide">Model</th>


                        <th>Kod</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($aranandeger as $item) : ?>

                    <tr>
                        <td>
                            <a href="../urun.php?id=<?=$item["ID"]?>" class="title">
                                <?=$item["name"]?>
                            </a>
                            <div class="magic-links">
                                <a href="duzenle.php?id=<?=$item["ID"]?>">Düzenle</a> |
                                <a href="sil.php?id=<?=$item["ID"]?>" class="trash">Sil</a>|
                                <a href="../urun.php?id=<?=$item["ID"]?>">Göster</a>
                            </div>
                        </td>
                        <td class="hide">
                            <a href="#"><?=$item["Marka"]?></a>
                        </td>
                        <td class="hide">
                            <a href="#"><?=$item["model"]?></a>
                        </td>


                        <td>
                            <span class="date"><?=$item["kod"]?></span>
                        </td>
                    </tr>

                    <?php endforeach;?>
                </tbody>
            </table>
        </div>


        <?php }  ?>




        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>Ürün İsmi</th>
                        <th class="hide">Marka</th>
                        <th class="hide">Model</th>

                        <th>Kod</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($MakaleAl as $item) : ?>
                    <tr>
                        <td>
                            <a href="../urun.php?id=<?=$item["ID"]?>" class="title">
                                <?=$item["name"]?>
                            </a>
                            <div class="magic-links">
                                <a href="duzenle.php?id=<?=$item["ID"]?>">Düzenle</a> | <a
                                    href="sil.php?id=<?=$item["ID"]?>" class="trash">Sil</a> |
                                <a href="../urun.php?id=<?=$item["ID"]?>">Göster</a>
                            </div>
                        </td>
                        <td class="hide">
                            <a href="#"><?=$item["Marka"]?></a>
                        </td>
                        <td class="hide">
                            <a href="#"><?=$item["model"]?></a>
                        </td>

                        <td>
                            <span class="date"><?=$item["kod"]?></span>
                        </td>
                    </tr>

                    <?php endforeach;?>
                </tbody>
            </table>
        </div>


        <div class="pagination">
            <ul>



                <?php if($Sayfa > 1){?>

                <li class=""><a href="listele.php?sayfa=1">İlk</a></li>
                <!--1. Sayfaya gider-->

                <li class=""><a href="listele.php?sayfa=<?=$Sayfa - 1?>">Önceki</a></li>
                <!--Bir Önceki Sayfaya Gitmek İçin Sayfa Değerini 1 eksiltiyoruz-->

                <?php } ?>

                <?php

                for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){ // i kaç ise o sayıdan başlar 1-2-3-4-5 yazmaya. mesela sayfa 7deyiz 7 - 5 = 2'dir 2 sayfadan sonra sayfalamaya başlar yani 2-3-4-5-6-7 gibi bu aynı mantıkla devam eder.


                    if($i > 0 and $i <= $Sayfa_Sayisi){

                        if($i == $Sayfa){

                            echo '<li'.$i.'</li>'; //eğer i ile sayfa değerleri aynıysa o zaman onu aktif css'si ekle

                        }else{

                            echo '<li><a  href="listele.php?sayfa='.$i.'">'.$i.'</a></li>'; //eğer aynı değilse normal listele

                        }

                    }

                }
                ?>
                <?php if($Sayfa != $Sayfa_Sayisi) :?>

                <li class=""><a href="listele.php?sayfa=<?=$Sayfa + 1?>">Sonraki</a></li>
                <!--Bir Sonra ki Sayfaya Gitmek için sayfa değerini 1 artırıyoruz.-->

                <li class=""><a href="listele.php?sayfa=<?=$Sayfa_Sayisi?>">Son</a></li>
                <!--Buldugumuz Toplam Sayfa Sayısını buraya cekiyoruz tıklandıgında en son sayfaya gider-->

                <?php endif; ?>
            </ul>
        </div>

    </div>

</body>

</html>