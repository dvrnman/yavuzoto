<?php 
ob_start();
require_once "baglan.php";


$listeleme= $db->prepare("SELECT * FROM urun WHERE ID =?");
$listeleme->execute([
    $_GET["id"]
]);
$goster =$listeleme->fetch(PDO::FETCH_ASSOC);


?>


<!doctype html>
<html lang="tr">

<head>

    <!-- Required meta tags -->

    <meta charset="UTF-8">
    <meta name="description" content="<?=$goster["metaDescription"]?>">
    <meta name="keywords" content="<?=$goster["metaKeywords"]?>">
    <meta name="author" content="Mey Otomotiv">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


    <title>MEY OTOMOTİV</title>

</head>

<body>

    <?php include_once "panel/navbar.php"  ?>

    <div class="container py-5">

        <div class="row listelediv">
            <div class="col-md-6 col-sm-12">
                <div><img src="admin/images/<?=$goster  ["resim"]?>" class="rounded mx-auto d-block  img-thumbnail"
                        alt="Resmi Mevcut Değil" title="Ürün Resmi">
                </div>
            </div>
            <div class=" col-md-6 col-sm-12 ">

                <h4 class=" mb-5 mt-5 fw-bold ">
                    <?=$goster["name"] ?>
                </h4>
                <h5 class=" mb-4 fs-4 "><b>Marka:</b><?=$goster["Marka"] ?></h5>
                <h5 class=" mb-4 fs-4"><b>Model:</b> <?=$goster["model"] ?></h5>
                <h5 class="mb-5 fs-4"><b>Ürün Kodu:</b><?=$goster["kod"]?></h5>
                <h5 class="mb-5 fs-4"><b>Detay:</b> <br><br><?=$goster["listeDetay"]?></h5>


                <a 
                    href="https://wa.me/905559955580?text=<?="Marka:".$goster["Marka"]."%20"."Model:".$goster["model"]."%20"."Ürün Kodu :".$goster["kod"]?>"><button
                        type="button" class="btn btn-lg btn-dangerr"> &nbsp; Fiyat Al &nbsp; </button>
                </a>





            </div>

        </div>
    </div>







    <?php include_once "panel/footer.php" ?>







    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://kit.fontawesome.com/3f6c0f9f4b.js" crossorigin="anonymous"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>


</body>

</html>