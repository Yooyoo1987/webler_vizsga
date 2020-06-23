<?php
function orderController()
{
    $successOrder = array_key_exists("successOrder", $_COOKIE);
    setcookie("successOrder", "", time() - 1);
    $emptyField = array_key_exists("emptyField", $_COOKIE);
    setcookie("emptyField", "", time() - 1);
    $emailFormat = array_key_exists("emailFormat", $_COOKIE);
    setcookie("emailFormat", "", time() - 1);
    $invalidPhoneNumber = array_key_exists("invalidPhoneNumber", $_COOKIE);
    setcookie("invalidPhoneNumber", "", time() - 1);
    $emptyCheck = array_key_exists("emptyCheck", $_COOKIE);
    setcookie("emptyCheck", "", time() - 1);

    return [
        "order",
        [
            "title" => "Order",
            "successOrder" => $successOrder,
            "emptyField" => $emptyField,
            "invalidPhoneNumber" => $invalidPhoneNumber,
            "emailFormat" => $emailFormat,
            "emptyCheck" => $emptyCheck
        ]
    ];
}

function orderActionController()
{
    $firstName = $_POST["orderFirstName"];
    $lastName = $_POST["orderLastName"];
    $email = $_POST["orderEmail"];
    $address = $_POST["orderAddress"];
    $phone = $_POST["orderPhone"];
    $note = $_POST["orderNote"];
    $check = $_POST["orderCheck"];
    $payMethod = $_POST["payMethod"];
    $receiving = $_POST["receiving"];

    $con = mysqli_connect(host, user, pwd, dbname);
    mysqli_query($con, "SET NAMES UTF8");

    if (empty($firstName) || empty($lastName) || empty($email) || empty($address) || empty($phone) || $payMethod == "options" || $receiving == "options") {
        setcookie("emptyField", 1, time() + 1);
    } else {
        if (preg_match("#[a-z]+#", $phone) || preg_match("#[A-Z]+#", $phone) || preg_match("#[\W]+#", $phone)) {
            $invalidPhoneNumber = setcookie("invalidPhoneNumber", 1, time() + 1);
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailFormat = setcookie("emailFormat", 1, time() + 1);
        }
        if (empty($check)) {
            $emptyCheck = setcookie("emptyCheck", 1, time() + 1);
        }
        if (!$invalidPhoneNumber && !$emailFormat && !$emptyCheck) {
            if (isset($_POST["orderBtn"])) {

                $sql1 = "INSERT INTO costumers(vezeteknev, keresztnev, szcim, telefon, email, uzenet)
                        VALUES('$lastName','$firstName', '$address', '$phone', '$email', '$note')";
                mysqli_query($con, $sql1);

                $lastBuyerId = "SELECT id FROM costumers ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($con, $lastBuyerId);
                $getBuyerId = mysqli_fetch_array($result);
                $buyerId = $getBuyerId[0];
                $sumPrice = $_SESSION["sum"];

                $sql2 = "INSERT INTO orders(vevoid,szallitas,fizmod,datum,statusz,ar) VALUES('$buyerId', '$receiving', '$payMethod', NOW(), 'függőben', '$sumPrice')";
                mysqli_query($con, $sql2);

                $lastOrderId = "SELECT id FROM orders ORDER BY id DESC LIMIT 1";
                $result2 = mysqli_query($con, $lastOrderId);

                $getOrderId = mysqli_fetch_array($result2);
                $orderId = $getOrderId[0];

                foreach ($_SESSION["cart"] as $product_id => $db) {

                    $sql3 = "INSERT INTO order_product(rendelesid,termekid,db) VALUES('$orderId', '$product_id', '$db')";
                    mysqli_query($con, $sql3);

                    $sql4 = "UPDATE cpu SET keszlet = keszlet - '$db' WHERE cikkszam LIKE '$product_id'";
                    mysqli_query($con, $sql4);
                    $sql5 = "UPDATE ram SET keszlet = keszlet - '$db' WHERE cikkszam LIKE '$product_id'";
                    mysqli_query($con, $sql5);
                    $sql6 = "UPDATE ssd SET keszlet = keszlet - '$db' WHERE cikkszam LIKE '$product_id'";
                    mysqli_query($con, $sql6);
                    $sql7 = "UPDATE motherboard SET keszlet = keszlet - '$db' WHERE cikkszam LIKE '$product_id'";
                    mysqli_query($con, $sql7);
                    $sql8 = "UPDATE pccase SET keszlet = keszlet - '$db' WHERE cikkszam LIKE '$product_id'";
                    mysqli_query($con, $sql8);
                    $sql9 = "UPDATE cooler SET keszlet = keszlet - '$db' WHERE cikkszam LIKE '$product_id'";
                    mysqli_query($con, $sql9);
                    $sql10 = "UPDATE vga SET keszlet = keszlet - '$db' WHERE cikkszam LIKE '$product_id'";
                    mysqli_query($con, $sql10);
                    $sql11 = "UPDATE psu SET keszlet = keszlet - '$db' WHERE cikkszam LIKE '$product_id'";
                    mysqli_query($con, $sql11);

                    $sql21 = "SELECT keszlet FROM motherboard WHERE cikkszam LIKE '$product_id'";
                    $result1 = mysqli_query($con, $sql21);
                    $sql22 = "SELECT keszlet FROM cpu WHERE cikkszam LIKE '$product_id'";
                    $result2 = mysqli_query($con, $sql22);
                    $sql23 = "SELECT keszlet FROM ram WHERE cikkszam LIKE '$product_id'";
                    $result3 = mysqli_query($con, $sql23);
                    $sql24 = "SELECT keszlet FROM ssd WHERE cikkszam LIKE '$product_id'";
                    $result4 = mysqli_query($con, $sql24);
                    $sql25 = "SELECT keszlet FROM vga WHERE cikkszam LIKE '$product_id'";
                    $result5 = mysqli_query($con, $sql25);
                    $sql26 = "SELECT keszlet FROM pccase WHERE cikkszam LIKE '$product_id'";
                    $result6 = mysqli_query($con, $sql26);
                    $sql27 = "SELECT keszlet FROM cooler WHERE cikkszam LIKE '$product_id'";
                    $result7 = mysqli_query($con, $sql27);
                    $sql28 = "SELECT keszlet FROM psu WHERE cikkszam LIKE '$product_id'";
                    $result8 = mysqli_query($con, $sql28);

                    while($row = mysqli_fetch_array($result1)){
                        $keszlet1 = $row["keszlet"];
                    }
                    if($keszlet1 < 1){
                    $sql13 = "UPDATE motherboard SET aktiv = 0 WHERE cikkszam LIKE '$product_id'";
                    mysqli_query($con, $sql13);
                    }

                    while($row = mysqli_fetch_array($result2)){
                        $keszlet2 = $row["keszlet"];
                    }
                    if($keszlet2 < 1){
                        $sql14 = "UPDATE cpu SET aktiv = 0 WHERE cikkszam LIKE '$product_id'";
                        mysqli_query($con, $sql14);
                    }

                    while($row = mysqli_fetch_array($result3)){
                        $keszlet3 = $row["keszlet"];
                    }
                    if($keszlet3 < 1){
                        $sql15 = "UPDATE ram SET aktiv = 0 WHERE cikkszam LIKE '$product_id'";
                        mysqli_query($con, $sql15);
                    }

                    while($row = mysqli_fetch_array($result4)){
                        $keszlet4 = $row["keszlet"];
                    }
                    if($keszlet4 < 1){
                        $sql16 = "UPDATE ssd SET aktiv = 0 WHERE cikkszam LIKE '$product_id'";
                        mysqli_query($con, $sql16);
                    }

                    while($row = mysqli_fetch_array($result5)){
                        $keszlet5 = $row["keszlet"];
                    }
                    if($keszlet5 < 1){
                        $sql17 = "UPDATE vga SET aktiv = 0 WHERE cikkszam LIKE '$product_id'";
                        mysqli_query($con, $sql17);
                    }

                    while($row = mysqli_fetch_array($result6)){
                        $keszlet6 = $row["keszlet"];
                    }
                    if($keszlet6 < 1){
                        $sql18 = "UPDATE pccase SET aktiv = 0 WHERE cikkszam LIKE '$product_id'";
                        mysqli_query($con, $sql18);
                    }

                    while($row = mysqli_fetch_array($result7)){
                        $keszlet7 = $row["keszlet"];
                    }
                    if($keszlet7 < 1){
                        $sql19 = "UPDATE cooler SET aktiv = 0 WHERE cikkszam LIKE '$product_id'";
                        mysqli_query($con, $sql19);
                    }

                    while($row = mysqli_fetch_array($result8)){
                        $keszlet8 = $row["keszlet"];
                    }
                    if($keszlet8 < 1){
                        $sql20 = "UPDATE psu SET aktiv = 0 WHERE cikkszam LIKE '$product_id'";
                        mysqli_query($con, $sql20);
                    }
            }
            setcookie("successOrder", 1, time() + 1);
        }
    }
}
    $view = "redirect:/order";
    return [
        $view,
        [
            "title" => "Order"
        ]
    ];
}
