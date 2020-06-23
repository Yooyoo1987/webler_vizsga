<?php
        $con = mysqli_connect(host, user, pwd, dbname);
        mysqli_query($con, "SET NAMES UTF8");

        $sql1 = "SELECT katnev FROM kategoriak inner join $link on kategoriak.katsorrend=$link.kategoria";
        $result1 = mysqli_query($con, $sql1);

        if ($link == "motherboard") {
            $categoryId = 1;
            $categoryName = "motherboard";
        } elseif ($link == "cpu") {
            $categoryId = 2;
            $categoryName = "cpu";
        } elseif ($link == "ram") {
            $categoryId = 3;
            $categoryName = "ram";
        } elseif ($link == "ssd") {
            $categoryId = 4;
            $categoryName = "ssd";
        } elseif ($link == "vga") {
            $categoryId = 5;
            $categoryName = "vga";
        } elseif ($link == "cooler") {
            $categoryId = 6;
            $categoryName = "cooler";
        } elseif ($link == "pccase") {
            $categoryId = 7;
            $categoryName = "pccase";
        } elseif ($link == "psu") {
            $categoryId = 8;
            $categoryName = "psu";
        }

        while ($row = mysqli_fetch_array($result1)) {
            $tcim = $row['katnev'];
        }

        echo "
        <div class='container px-0 container-category'>
        <h1 class='text-center mb-4'>$tcim</h1>
        <div class='row w-100 mx-0'>

        <div class='col-12 text-center' id='sort'>
            <small><a class='btn btn-outline-dark btn-sm' title='Ár szerint növekvő' href='?sort=price_asc'><i class='fas fa-dollar-sign'></i><i class='fas fa-arrow-up'></i></a></small>
            <small><a class='btn btn-outline-dark btn-sm' title='Ár szerint csökkenő' href='?sort=price_desc'><i class='fas fa-dollar-sign'></i><i class='fas fa-arrow-down'></i></a></small>
            <small><a class='btn btn-outline-dark btn-sm' title='Legújabb elöl' href='?sort=newest'><i class='far fa-newspaper'></i></a></small>
            <small><a class='btn btn-outline-dark btn-sm' title='Leggyakrabban vásárolt' href='?sort=best'><i class='far fa-star'></i></a></small>
        </div>
        ";

        if (isset($_GET["$categoryId"])) {

            $sort = $_GET["$categoryId"];

            $sql = "SELECT * FROM $categoryName WHERE kategoria='$categoryId'";
        } else if (isset($_GET["sort"])) {

            $sort = $_GET["sort"];

            switch ($sort) {

                case "price_asc":
                    $sql = "SELECT * FROM $categoryName ORDER BY ar ASC";
                    break;

                case "price_desc":
                    $sql = "SELECT * FROM $categoryName ORDER BY ar DESC";
                    break;

                case "newest":
                    $sql = "SELECT * FROM $categoryName ORDER BY id DESC";
                    break;

                case "best":
                    $sql = "SELECT * FROM $categoryName INNER JOIN order_product ON $categoryName.cikkszam=order_product.termekid GROUP BY nev ORDER BY SUM(db) DESC";
                    break;
            }
        } else {

            $sql = "SELECT * FROM $categoryName ORDER BY id DESC";
        }

        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_array($result)) {

            $id = $row["id"];
            $nev = $row["nev"];
            $ar = $row["ar"];
            $cikkszam = $row["cikkszam"];
            $kep = $row["kep"];
            $keszlet = $row["keszlet"];
            $aktiv = $row["aktiv"];

            echo "

                <div class='col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3 px-0 text-center mx-auto mt-3 product'>
                    <h5>" . $nev . "</h5>
                    <img src='$kep' class='category-image d-block mx-auto mb-1 mt-2' alt='$nev' title='$nev'>
                    <div>
                        <ul class='motherboard-ul'>
                            <li>Cikkszám: " . $cikkszam . "</li>
                            <li>Készlet: " . $keszlet . " db</li>
                            <li>Brutto: " . number_format($ar) . " Ft</li>
                        </ul>
                    </div>
                    <div class='mb-3'>
                    <a class='btn btn-outline-info btn-watch mb-5 d-inline' href='$link/product?id=" . $id . "'>Megtekintés</a>
                    <a class='btn btn-primary btn-to-cart' href='/cartAction?itemnumber=" . $cikkszam . "&action=add'>Kosárba</a>
                    </div>
                </div>
                 ";
        }
?>

