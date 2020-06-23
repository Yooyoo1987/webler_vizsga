<?php

$con = mysqli_connect(host, user, pwd, dbname);
mysqli_query($con, "SET NAMES UTF8");

if (isset($_GET["id"])) {
    $product_id = $_GET["id"];
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if (preg_match("(motherboard)", $actual_link)) {
        $sql = "SELECT * FROM motherboard WHERE id='$product_id'";
    }
    if (preg_match("(cpu)", $actual_link)) {
        $sql = "SELECT * FROM cpu WHERE id='$product_id'";
    }
    if (preg_match("(ram)", $actual_link)) {
        $sql = "SELECT * FROM ram WHERE id='$product_id'";
    }
    if (preg_match("(ssd)", $actual_link)) {
        $sql = "SELECT * FROM ssd WHERE id='$product_id'";
    }
    if (preg_match("(vga)", $actual_link)) {
        $sql = "SELECT * FROM vga WHERE id='$product_id'";
    }
    if (preg_match("(cooler)", $actual_link)) {
        $sql = "SELECT * FROM cooler WHERE id='$product_id'";
    }
    if (preg_match("(pccase)", $actual_link)) {
        $sql = "SELECT * FROM pccase WHERE id='$product_id'";
    }
    if (preg_match("(psu)", $actual_link)) {
        $sql = "SELECT * FROM psu WHERE id='$product_id'";
    }

    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_array($result)) {

        $id = $row["id"];
        $ar = $row["ar"];
        $cikkszam = $row["cikkszam"];
        $nev = $row["nev"];
        $kep = $row["kep"];
        $keszlet = $row["keszlet"];
        $kategoria = $row["kategoria"];
        $rleiras = $row["rleiras"];
        $hleiras = $row["hleiras"];
        $aktiv = $row["aktiv"];
    }

    echo "

    <div class='container container-product'>
        <div class='row w-100 m-0'>
            <div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 py-2 px-0 product-img-div m-auto'>
                <img class='product-img' src='$kep' alt='$nev' title='$nev'>
            </div>

            <div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 text-center py-2 ml-auto'>

                    <h3>" . $nev . "</h3>
                    <hr>
                    <p>" . $rleiras . "</p>
                    <hr>
                    <p><strong>Cikkszám: </strong>" . $cikkszam . "</p>
                    <p><strong>Készlet: </strong>" . $keszlet . " db</p>
                    <hr>
                    <h4>Ár: " . number_format($ar) . " Ft</h4>
                    <a class='btn btn-primary btn-to-cart' href='/cartAction?itemnumber=" . $cikkszam . "&action=add'>Kosárba</a>

                    <div class='col-12 p-5' id='termekhosszu'>
                        <h3>Termék részletes leírása:</h3>
                        <hr>
                        <p>" . $hleiras . "</p>
                </div>
            </div>
        </div>
    </div>

    ";
}
