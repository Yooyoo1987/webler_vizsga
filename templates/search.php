<div class='container px-0 container-search'>
    <h1 class="text-center mb-4">Találatok</h1>
    <div class='row w-100 mx-0'>

        <?php

        $con = mysqli_connect(host, user, pwd, dbname);
        mysqli_query($con, "SET NAMES utf8");

        if (isset($_POST["search-btn"])) {

            $productName = $_POST["search"];

            if (empty($productName)) {
                $view = "redirect:/";
            } else {

                $sql = "SELECT * FROM motherboard WHERE rleiras LIKE '%$productName%' UNION
                SELECT * FROM cpu WHERE rleiras LIKE '%$productName%' UNION
                SELECT * FROM ram WHERE rleiras LIKE '%$productName%' UNION
                SELECT * FROM ssd WHERE rleiras LIKE '%$productName%' UNION
                SELECT * FROM vga WHERE rleiras LIKE '%$productName%' UNION
                SELECT * FROM cooler WHERE rleiras LIKE '%$productName%' UNION
                SELECT * FROM pccase WHERE rleiras LIKE '%$productName%' UNION
                SELECT * FROM psu WHERE rleiras LIKE '%$productName%'
                ";

                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_array($result)) {

                        $id = $row["id"];
                        $nev = $row["nev"];
                        $ar = $row["ar"];
                        $kategoria = $row["kategoria"];
                        $cikkszam = $row["cikkszam"];
                        $kep = $row["kep"];
                        $keszlet = $row["keszlet"];

                        if($kategoria == 1){
                            $link = "motherboard";
                        }elseif($kategoria == 2){
                            $link = "cpu";
                        }elseif($kategoria == 3){
                            $link = "ram";
                        }elseif($kategoria == 4){
                            $link = "ssd";
                        }elseif($kategoria == 5){
                            $link = "vga";
                        }elseif($kategoria == 6){
                            $link = "cooler";
                        }elseif($kategoria == 7){
                            $link = "pccase";
                        }elseif($kategoria == 8){
                            $link = "psu";
                        }else{
                            $link = "";
                        }

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
                <a class='btn btn-outline-info mb-5' href='category/$link/product?id=" . $id . "'><div>Megtekintés</div></a>
                <a class='btn btn-outline-primary mb-5' href='/login'><div>Kosárba</div></a>

            </div>
            ";
                    }
                } else {

                    echo "<h3>Nincs ilyen termék az adatbázisban!</h3>";
                }
            }
        }
        ?>
    </div>
</div>