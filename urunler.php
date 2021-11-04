<?php
    ob_start();
    require_once "baglan.php";


    $listeleme = $db->prepare("SELECT * FROM urun WHERE  oncelik   ORDER BY oncelik DESC LIMIT 12 ");
    $listeleme->execute();
    $goster = $listeleme->fetchAll(PDO::FETCH_ASSOC);


    //sql baglan ,tablodaki markalerı çek ,markalaı forench dön herbir markayı explode - yap gelen markaları forech yap markalar dizisi tanımla
    /*
    $string="|1611|||1608|1611|0||1599|1598|1599|||0|";
    $deneme =explode('|', $string, -1);
    $deneme1=array_filter($deneme);

    foreach($deneme1 as $val)
    {
        echo "<br>".$val;
    }
    */

    //modelleri dizi halinden normal çekme


?>
<!doctype html>
<html lang="tr">

<head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="style/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


    <title>YAVUZ OTOMOTİV</title>
</head>

<body>
<?php include_once "panel/navbar.php"; ?>


<div class="container mt-5 mb-5">

    <div class="mb-5 text-sm-center">
        <h3>Outlet Ürünler</h3>
        <hr>
    </div>

    <div class="row ">
        <?php foreach ($goster as $item) : ?>
            <div class="col-md-3 col-sm-12 mb-3 d-flex justify-content-center">
                <div class="card w-100 border-0">
                    <img src="admin/images/<?= $item["resim"] ?>"
                         class="card-img-top rounded mx-auto d-block  img-thumbnail" alt="...">
                    <a href="urun.php?id=<?= $item["ID"] ?>" class="nav-link text-dark active">
                        <div class="card-body">
                            <p class="card-text"><?= $item["name"] ?></p>
                        </div>
                    </a>
                </div>
            </div>

        <?php endforeach ?>


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