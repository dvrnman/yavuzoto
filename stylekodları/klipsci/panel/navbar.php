<?php
    $sayfaurl =$_SERVER["REQUEST_URI"] ;
    $r = explode('/', $sayfaurl);

function isActive($path){
    $sayfaurl =$_SERVER["REQUEST_URI"] ;
    $r = explode('/', $sayfaurl);
    return $path == $r[2] ? "active" : "";
}


?>

<div class="container my-4">
    <form action="index.php?sayfa=" method="get">
        <div class="row  gy-3 gy-md-0">
            <div class="col-md-3 col-sm-12 d-flex justify-content-center   ">
                <!--<h4 class=" mb-3">YAVUZ OTOMOTİV</h4>-->
                <a href="index.php" class="nav-link text-dark">
                    <h3 class="">MEY OTOMOTİV</h3>
                </a>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="input-group d-flex align-items-center">
                    <input type="text" class="form-control" placeholder="Aranacak Model" name="ara"
                        aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-navbar my-2" type="submit" id="button-addon2">Ara</button>
                </div>
            </div>
    </form>
    <div class="col-3"></div>
</div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark ">
    <div class="container">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?=isActive('index.php')?>" aria-current="page" href="index.php"><i
                            class="fas fa-home"></i> Anasayfa</a>
                </li>
                <li class="nav-item <?php  ?>">
                    <a class="nav-link <?=isActive('urunler.php')?>" href="urunler.php"> <i
                            class="fas fa-shopping-basket"></i>     Outlet Ürünler</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link  <?=isActive('hakkimizda.php')?> " href="hakkimizda.php" aria-disabled="true"> <i
                            class="far fa-address-card"></i>
                        Hakkımızda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link 
                    <?=isActive('iletisim.php')?>  " href="iletisim.php" aria-disabled="true"> <i
                            class="fas fa-comment"></i> İletişim</a>
                </li>
            </ul>
            <div class="d-flex align-items-center text-white k">
                <a href="https://wa.me/905559955580?text=Ürünler%20Hakkında%20Bilgi%20Alabilirmiyim%20"
                    class="nav-link text-white">
                    <img src="img/whatsapp.png" alt="" width="25" height="25"> &nbsp; 05559955580
                </a>
            </div>
            
        </div>
    </div>
</nav>