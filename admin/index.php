<?php require_once "../baglan.php";
session_start();
if (!isset($_SESSION)) {
    header("Location:index.php");
    exit();
}



if ($_POST) {
    $kullanici_adi = isset($_POST["kullanici_adi"]) ? $_POST["kullanici_adi"] : null;
    $sifre = isset($_POST["sifre"]) ? $_POST["sifre"] : null;

    $login = $db->prepare("SELECT * FROM giris  where kullanici_adi = ? && sifre =?");
    $login->execute(
        [
            htmlspecialchars($kullanici_adi),
            htmlspecialchars($sifre)
        ]
    );
    $yanıt = $login->fetchAll();




    if ($yanıt) {
        $_SESSION["kullanici_adi"] = $yanıt[0]["kullanici_adi"];
        if (isset($_SESSION["kullanici_adi"])) {
            header("Location:listele.php");
            exit();
        }
    } else {
        $hata = "Hatalı şifre  Girdiniz !";
    }
}

$db = null;









?>

<!doctype html>
<html lang="en">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>

    <!--styles-->
    <link rel="stylesheet" href="assets/styles/main.css">


    <!--scripts-->
    <script src="assets/scripts/jquery-1.12.2.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.5.7/basic/ckeditor.js"></script>
    <script src="assets/scripts/admin.js"></script>

</head>

<body>

    <!--login screen-->
    <div class="login-screen">

        <!--login logo-->
        <div class="login-logo">
            <a href="#">
                <img src="logo.png" alt="">
            </a>
        </div>

        <form action="" method="post">

            <ul>
                <li>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="kullanici_adi">
                </li>
                <li>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="sifre">
                </li>

                <li>
                    <button type="submit">Login</button>

                </li>
            </ul>
        </form>

        <div class="login-links">

            <a href="#">
                <span class="fa"></span> &nbsp; &nbsp; &nbsp; &nbsp; <?= @$hata ?>
            </a>
        </div>

    </div>

</body>

</html>