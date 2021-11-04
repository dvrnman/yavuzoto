<?php
ob_start();
require_once 'baglan.php';

$markalar = [];

$sorgu = $db->prepare('select  urun.marka from urun');
$sorgu->execute();
$calıstır = $sorgu->fetchAll(PDO::FETCH_ASSOC);

foreach ($calıstır as $val) {
    $deneme = explode('-', $val['marka']);

    if (count($deneme) == 0) {
        array_push($markalar, $val['marka']);
    }

    foreach ($deneme as $values) {
        array_push($markalar, trim($values));
    }
}

if (isset($_GET['ara'])) {
    $aranandeger = $_GET['ara'];
    $aranankelime = strtoupper($aranandeger);
}

$markalar = array_unique($markalar);


if (isset($_GET['ara'])) {
    $Sayfa = @ceil($_GET['sayfa']); //5,2 girilirse eğer get o zaman onu tam sayı yapar yanı 5 yapıyoruz bu kod ile
    if ($Sayfa < 1) {
        $Sayfa = 1;
    } //eğer get değeri yerine girilen sayi 1 den küçükse sayfa değerini 1 yapıyoruz yani 1. sayfaya atıyoruz
    @$Say = $db->query(
        "SELECT * FROM urun WHERE Marka LIKE '%" .
            @$aranankelime .
            "%' OR KullanimAlani LIKE '%" .
            @$aranankelime .
            "%' OR id LIKE '%" .
            @$aranankelime .
            "%' OR kod LIKE '%" .
            @$aranankelime .
            "%' OR model LIKE '%" .
            @$aranankelime .
            "%' OR name LIKE '%" .
            @$aranankelime .
            "%'"
    ); //yukarda göstere attıgımız değer diyelim ki 3 o zaman 3.'id den başlayarak limit kadar veri ceker.

    $ToplamVeri = $Say->rowCount(); //makale sayısını saydırıyoruz

    $Limit = 20; //bir sayfada kaç içerik çıkacağını belirtiyoruz.

    $Sayfa_Sayisi = ceil($ToplamVeri / $Limit); //toplam veri ile limiti bölerek her toplam sayfa sayısını buluyoruz

    if ($Sayfa > $Sayfa_Sayisi) {
        $Sayfa = $Sayfa_Sayisi;
    } //eğer yazılan sayı büyükse eğer toplam sayfa sayısından en son sayfaya atıyoruz kullanıcıyı

    $Goster = $Sayfa * $Limit - $Limit; // sayfa= 2 olsun limit=3 olsun 2*3=6 6-3=3 buranın değeri 2. sayfada 3'dür 3-4-5-6... sayfalarda da aynı işlem yapılıp değer bulunur

    $GorunenSayfa = 3; //altta kaç tane sayfa sayısı görüneceğini belirtiyoruz.

    try {
        $aranan = $db->query(
            "SELECT * FROM urun WHERE Marka LIKE '%" .
                @$aranankelime .
                "%' OR KullanimAlani LIKE '%" .
                @$aranankelime .
                "%' OR kod LIKE '%" .
                @$aranankelime .
                "%' OR id LIKE '%" .
                @$aranankelime .
                "%' OR name LIKE '%" .
                @$aranankelime .
                "%' OR model LIKE '%" .
                @$aranankelime .
                "%'  limit $Goster,$Limit"
        ); //yukarda göstere attıgımız değer diyelim ki 3 o zaman 3.'id den başlayarak limit kadar veri ceker.
        $aranandeger = $aranan->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $Exception) {


?>
        <script>
            alert('Aranan Veri Yok');

            function yonlendir() {
                window.location.href = "index.php";
            }

            yonlendir();
        </script>

    <?php
    }
}

$Sayfa = @ceil($_GET['sayfa']); //5,2 girilirse eğer get o zaman onu tam sayı yapar yanı 5 yapıyoruz bu kod ile
if ($Sayfa < 1) {
    $Sayfa = 1;
} //eğer get değeri yerine girilen sayi 1 den küçükse sayfa değerini 1 yapıyoruz yani 1. sayfaya atıyoruz
$Say = $db->query(
    "SELECT * FROM urun WHERE Marka LIKE '%" .
        @$_GET['kategori'] .
        "%' AND model LIKE '%" .
        @$_GET['model'] .
        "%' ORDER BY ID ASC"
); //makale sayısını çekiyoruz

$ToplamVeri = $Say->rowCount(); //makale sayısını saydırıyoruz

$Limit = 20; //bir sayfada kaç içerik çıkacağını belirtiyoruz.

$Sayfa_Sayisi = ceil($ToplamVeri / $Limit); //toplam veri ile limiti bölerek her toplam sayfa sayısını buluyoruz

if ($Sayfa > $Sayfa_Sayisi) {
    $Sayfa = $Sayfa_Sayisi;
} //eğer yazılan sayı büyükse eğer toplam sayfa sayısından en son sayfaya atıyoruz kullanıcıyı

$Goster = $Sayfa * $Limit - $Limit; // sayfa= 2 olsun limit=3 olsun 2*3=6 6-3=3 buranın değeri 2. sayfada 3'dür 3-4-5-6... sayfalarda da aynı işlem yapılıp değer bulunur

$GorunenSayfa = 3; //altta kaç tane sayfa sayısı görüneceğini belirtiyoruz.

try {
    $Makale = $db->query(
        "SELECT * FROM urun WHERE Marka LIKE '%" .
            @$_GET['kategori'] .
            "%' AND model LIKE '%" .
            @$_GET['model'] .
            "%' ORDER BY ID ASC limit $Goster,$Limit"
    ); //yukarda göstere attıgımız değer diyelim ki 3 o zaman 3.'id den başlayarak limit kadar veri ceker.
    $MakaleAl = $Makale->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $Exception) {

    ?>
    <script>
        alert('Aranan Veri Yok');

        function yonlendir() {
            window.location.href = "index.php";
        }

        yonlendir();
    </script>

<?php
}
?>
<!doctype html>
<html lang="tr">

<head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


    <title>MEY OTOMOTİV</title>
</head>

<body>

    <?php include_once 'panel/navbar.php'; ?>

    <div class="container py-5">

        <div class="row">


            <div class="col-md-3 col-sm-12  text-dark  ">
                <div class="bg-white shadow-sm p-3 mb-5 rounded navbar">

                    <nav class=" navbar-expand-lg w-100  navbar-light">

                        <div class="text-center">
                            <div class="d-flex w-100 justify-content-between mb-2">
                                <h3 class="w-100 mt-2 sidebar-title" style="font-weight: bold; font-size: 20px;">Kategoriler
                                    <hr>
                                </h3>

                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                            </div>

                            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                <div class="navbar-nav">
                                    <div class=" collapse navbar-collapse accordion accordion-flush d-flex  flex-column align-items-start w-100" id="accordionFlushExample">
                                        <?php foreach ($markalar
                                            as $model) { ?>
                                            <div class="accordion-item w-100 ">
                                                <h2 class="" id="flush-heading<?= $model ?>">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $model ?>" aria-expanded="false" aria-controls="flush-collapse<?= $model ?>">
                                                        <img src="./admin/icon/<?= $model .
                                                                                    '.PNG'
                                                                                    ? $model .
                                                                                    '.PNG'
                                                                                    : 'araba.PNG' ?>" alt="" class="iconmodel">
                                                        <?= $model == null
                                                            ? 'DIGER '
                                                            : $model ?>
                                                    </button>
                                                </h2>

                                                <div id="flush-collapse<?= $model ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?= $model ?>" data-bs-parent="#accordionFlushExample">
                                                    <?php
                                                    $sorgu2 = $db->prepare(
                                                        "select distinct model from urun where marka like '%" .
                                                            $model .
                                                            "%'"
                                                    );
                                                    $sorgu2->execute();
                                                    $data = $sorgu2->fetchAll(
                                                        PDO::FETCH_ASSOC
                                                    );

                                                    foreach ($data
                                                        as $cat) { ?>
                                                        <div class="accordion-body text-start"><a href="index.php?kategori=<?= $model ?>&model=<?= $cat['model'] ?>" class="nav-link model-a "><?= $cat['model'] == null
                                                                                                                                                                                                    ? 'DIGER '
                                                                                                                                                                                                    : $cat['model'] ?></a>
                                                        </div>
                                                    <?php }
                                                    ?>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>


                </div>

            </div>


            <div class="col-md-8">

                <div class="row">
                    <?php if (isset($_GET['ara'])) { ?>

                        <?php foreach ($aranandeger as $item) : ?>
                            <div class="col-md-4 col-sm-12 mb-3 d-flex justify-content-center">

                                <div class="card w-100 border-0">
                                    <img src="admin/images/<?= $item['resim'] ?>" class="card-img-top w-100" alt="...">
                                    <p class="text-center"><b><?= $item["kod"] ?></b></p>
                                    <div class="card-body">
                                        <a href="urun.php?id=<?= $item['ID'] ?>" class="nav-link text-dark">
                                            <p class="card-text"> <?= $item['name'] ?></p>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        <?php endforeach; ?>


                    <?php } ?>

                    <?php foreach ($MakaleAl as $item) : ?>
                        <div class="col-md-4 col-sm-12 mb-3 d-flex justify-content-center">
                            <div class="card w-100  border-0 ">
                                <img src="admin/images/<?= $item['resim'] ?>" class="card-img-top rounded mx-auto d-block  img-thumbnail " alt="Resmi Mevcut Değil" title="Ürün Resmi">
                                <p class="text-center"><b><?= $item["kod"] ?></b></p>
                                <div class="card-body">
                                    <a href="urun.php?id=<?= $item['ID'] ?>" class="nav-link text-dark">
                                        <p class="card-text"> <?= $item['name'] ?></p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>


                </div>

                <div class="container mb-5 mt-5  d-flex justify-content-center">

                    <nav aria-label="Page navigation example ">
                        <ul class="pagination ">
                            <?php if ($Sayfa > 1) { ?>


                                <li class="page-item"><a class="page-link" href="index.php?sayfa=1">İlk</a></li>
                                <!--1. Sayfaya gider-->


                                <li class="page-item"><a class="page-link" href="index.php?sayfa=<?= $Sayfa -
                                                                                                        1 ?>">Önceki</a></li>
                                <!--Bir Önceki Sayfaya Gitmek İçin Sayfa Değerini 1 eksiltiyoruz-->

                            <?php } ?>

                            <?php for (
                                $i = $Sayfa - $GorunenSayfa;
                                $i < $Sayfa + $GorunenSayfa + 1;
                                $i++
                            ) {
                                // i kaç ise o sayıdan başlar 1-2-3-4-5 yazmaya. mesela sayfa 7deyiz 7 - 5 = 2'dir 2 sayfadan sonra sayfalamaya başlar yani 2-3-4-5-6-7 gibi bu aynı mantıkla devam eder.

                                if ($i > 0 and $i <= $Sayfa_Sayisi) {
                                    if ($i == $Sayfa) {
                                        echo '<li class="page-item "><a class="page-link active" href="" >' .
                                            $i .
                                            '</a></li>'; //eğer i ile sayfa değerleri aynıysa o zaman onu aktif css'si ekle
                                    } else {
                                        echo '<li class="page-item"><a class="page-link" href="index.php?sayfa=' .
                                            $i .
                                            '">' .
                                            $i .
                                            '</a></li>'; //eğer aynı değilse normal listele
                                    }
                                }
                            } ?>
                            <?php if ($Sayfa != $Sayfa_Sayisi) { ?>

                                <li class="page-item"><a class="page-link" href="index.php?sayfa=<?= $Sayfa +
                                                                                                        1 ?>">İleri</a>
                                </li>
                                <!--Bir Sonra ki Sayfaya Gitmek için sayfa değerini 1 artırıyoruz.-->

                                <li class="page-item"><a class="page-link" href="index.php?sayfa=<?= $Sayfa_Sayisi ?>">Son</a></li>
                                <!--Buldugumuz Toplam Sayfa Sayısını buraya cekiyoruz tıklandıgında en son sayfaya gider-->

                            <?php } ?>

                        </ul>
                    </nav>

                </div>
            </div>


        </div>


    </div>
    <?php include_once 'panel/footer.php'; ?>


    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://kit.fontawesome.com/3f6c0f9f4b.js" crossorigin="anonymous"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>


</body>

</html>