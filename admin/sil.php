<?php
ob_start();
require_once  "../baglan.php";
include_once "session.php";


if(isset($_POST["sil"]))
{
 
 $sil=$db->prepare("DELETE FROM urun WHERE urun.ID = ?");
 $sil->execute([$_GET["id"]] );
 
 if($sil)
 {
     
     header("Location:listele.php");
     exit();
     
 }

}
if(isset($_POST["vazgec"]))
{
    header("Location:listele.php");
    exit();
}




?>
<!doctype html>
<html lang="en">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <meta charset="UTF-8">
    <title>Sil</title>

    <!--styles-->

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!--scripts-->
    <script src="assets/scripts/jquery-1.12.2.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.5.7/basic/ckeditor.js"></script>
    <script src="assets/scripts/admin.js"></script>

</head>

<body>


    <!--content-->
    <div class="row">
        <div class="col">

            <div class="container mt-5">

                <div class="ratio ratio-1x1">
                    <iframe class="embed-responsive-item" src="../urun.php?id=<?=$_GET["id"]?>"></iframe>
                </div>

            </div>

        </div>
        <div class="col d-flex align-items-center">
            <div class="container mt-5  ">
                <div class="card" style="width: 20rem;">

                    <div class="card-body ">
                        <form action="" method="post">

                            <div class="d-flex justify-content-center">

                                <button type="submit" class="btn btn-danger " name="sil"> Veriyi Sil</button>

                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-warning" name="vazgec">Vazgeç</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>


    </div>




</body>

</html>