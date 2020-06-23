<div class="container px-0 container-cart">
    <?php
    actualLink();

    if (preg_match("(cart)", $link)) {
        echo "
                <h1 class='text-center mb-4'>Kosarad</h1>
                ";
    } else {
        echo "
                <h1 class='text-center mb-4'>Megrendelés véglegesítése</h1>
            ";
    }
    ?>
    <div class="row mx-0 table-responsive">
        <table class="table table-hover text-center mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Kép</th>
                    <th>Terméknév</th>
                    <th>Cikkszám</th>
                    <th>Bruttó ár</th>
                    <th>Darabszám</th>
                    <th>Érték</th>
                    <?php
                    if (preg_match("(cart)", $link)) {
                        echo "
                            <th><a class='empty-the-cart' href='cartAction?action=empty'>Kosár kiürítése</a></th>
                            ";
                    }

                    ?>
                </tr>
            </thead>
            <?php

            $vegosszeg = 0;
            $id = 0;

            if (isset($_SESSION["cart"])) {

                foreach ($_SESSION["cart"] as $itemNumber => $db) {

                    $con = mysqli_connect(host, user, pwd, dbname);
                    mysqli_query($con, "SET NAMES UTF8");

                    $sql = "SELECT * FROM motherboard WHERE cikkszam='$itemNumber' UNION
                            SELECT * FROM cpu WHERE cikkszam='$itemNumber' UNION
                            SELECT * FROM ram WHERE cikkszam='$itemNumber' UNION
                            SELECT * FROM ssd WHERE cikkszam='$itemNumber' UNION
                            SELECT * FROM vga WHERE cikkszam='$itemNumber' UNION
                            SELECT * FROM cooler WHERE cikkszam='$itemNumber' UNION
                            SELECT * FROM pccase WHERE cikkszam='$itemNumber' UNION
                            SELECT * FROM psu WHERE cikkszam='$itemNumber'
                            ";

                    $result = mysqli_query($con, $sql);


                    while ($row = mysqli_fetch_array($result)) {

                        $product_id = $row["id"];
                        $termeknev = $row["nev"];
                        $cikkszam = $row["cikkszam"];
                        $bruttoar = $row["ar"];
                        $kep = $row["kep"];
                        $ertek = $bruttoar * $db;
                        $id += 1;

                        echo "
                            <tbody>
                            <tr>
                                <td>" . $id . "</td>
                                <td><img class='img-cart' src=" . "'" . $kep . "'" . "></td>
                                <td>" . $termeknev . "</td>
                                <td>" . $cikkszam . "</td>
                                <td>" . number_format($bruttoar) . " Ft</td>
                                <td>" . $db . " db</td>
                                <td>" . number_format($ertek) . " Ft</td>"; ?>
                        <?php
                        if (preg_match("(cart)", $link)) {
                            echo "
                                    <td>
                                    <a href='/cartAction?itemnumber=" . $itemNumber . "&action=add'><i class='fas fa-plus mr-2'></i></a>

                                    <a href='/cartAction?itemnumber=" . $itemNumber . "&action=remove'><i class='fas fa-minus ml-2'></i></a>
                                </td>
                                    ";
                        }
                        ?>
            <?php
                        echo "
                            </tr>
                            </tbody>
                            ";
                        $vegosszeg += $ertek;
                    }
                }
                $_SESSION["sum"] = $vegosszeg;
            }
            ?>
            <tfoot>
                <tr>
                    <?php
                    actualLink();

                    if (preg_match("(cart)", $link) && !empty($_SESSION["cart"])) {
                        echo "
                                     <td class='text-right' colspan='8'>
                                        <div class='d-block m-3'><?php echo '<h5 class='d-inline'>Brutto végösszeg: </h5>" . number_format($vegosszeg) . " Ft</div>

                                        <hr class='mr-3 short-hr'>
                                        <a class='btn btn-success float-right my-3 mb-3' href='/order?itemnumber=" . $itemNumber . "'>Megrendelem</a>
                            ";
                    }
                    ?>
                    </td>
                </tr>
            </tfoot>
        </table>
        <?php require_once "orderTemplate.php"; ?>
    </div>
</div>