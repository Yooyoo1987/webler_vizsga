<?php
function cartController()
{
    return [
        "cart",
        [
            "title" => "Cart"
        ]
    ];
}

function cartActionController()
{
    $action = $_GET["action"];
    $itemNumber = $_GET["itemnumber"];

    $con = mysqli_connect(host, user, pwd, dbname);
    mysqli_query($con, "SET NAMES UTF8");

    $sql = "SELECT keszlet FROM motherboard WHERE cikkszam='$itemNumber' UNION
            SELECT keszlet FROM cpu WHERE cikkszam='$itemNumber' UNION
            SELECT keszlet FROM ram WHERE cikkszam='$itemNumber' UNION
            SELECT keszlet FROM ssd WHERE cikkszam='$itemNumber' UNION
            SELECT keszlet FROM vga WHERE cikkszam='$itemNumber' UNION
            SELECT keszlet FROM cooler WHERE cikkszam='$itemNumber' UNION
            SELECT keszlet FROM pccase WHERE cikkszam='$itemNumber' UNION
            SELECT keszlet FROM psu WHERE cikkszam='$itemNumber'
            ";
    $result = mysqli_query($con, $sql);
    while($row = mysqli_fetch_array($result)){
        $keszlet = $row["keszlet"];
    } 
        

    switch ($action) {

        case "add":
            if($keszlet > 0) {
                $_SESSION["cart"][$itemNumber]++;
                $url = "cart";
                echo "<META HTTP-EQUIV=Refresh Content='0; URL=" . $url . "'/>";
                header("location: /cart");
            }

            break;

        case "remove":
            $_SESSION["cart"][$itemNumber]--;
            if ($_SESSION["cart"][$itemNumber] == 0) {
                unset($_SESSION["cart"][$itemNumber]);
                if (empty($_SESSION["cart"])) {
                    unset($_SESSION["cart"]);
                }
            }
            $url = "cart";
            echo "<META HTTP-EQUIV=Refresh Content='0; URL=" . $url . "'/>";
            header("location: /cart");
            break;

        case "empty":
            unset($_SESSION["cart"]);
            $url = "cart";
            echo "<META HTTP-EQUIV=Refresh Content='0; URL=" . $url . "'/>";
            header("location: /cart");
            break;
    }


    return [
        "cart",
        [
            "title" => "Cart"
        ]
    ];
}