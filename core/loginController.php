<?php

function loginFormController()
{
    $emptyField = array_key_exists("emptyField", $_COOKIE);
    $notValidUserOrPassword = array_key_exists("notValidUserOrPassword", $_COOKIE);
    setcookie("emptyField", "", time() - 1);
    setcookie("notValidUserOrPassword", "", time() - 1);
    return [
        "login",
        [
            "title" => "Login",
            "emptyField" => $emptyField,
            "notValidUserOrPassword" => $notValidUserOrPassword
        ]
    ];
}

function loginSubmitFormController()
{
    if (isset($_POST["loginBtn"])) {
        $user = $_POST["user"];
        $password = $_POST["password"];

        $con = mysqli_connect(host, user, pwd, dbname);
        mysqli_query($con, "SET NAMES UTF8");

        $sql = "SELECT jelszo FROM felhasznalo_adatok";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_array($result)) {
            $pass = $row['jelszo'];
            if (password_verify($_POST["password"], $pass)) {
                $password = $pass;
            }
        }

        if (empty($user) || empty($password)) {
            setcookie("emptyField", 1, time() + 1);
            $view = "redirect:/login";
        } else {
            $con = mysqli_connect(host, user, pwd, dbname);
            mysqli_query($con, "SET NAMES UTF8");

            $sql = "SELECT felhasznalonev, jelszo FROM felhasznalo_adatok WHERE felhasznalonev='$user' AND jelszo='$password'";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) == 1) {
                $_SESSION["user"] = [
                    "name" => $user
                ];
                $view = "redirect:/";
            } else {
                setcookie("notValidUserOrPassword", 1, time() + 1);
                $view = "redirect:/login";
            }
        }
    }

    return [
        $view, [
            "title" => "Login"
        ]
    ];
}

function logoutSubmitFormController()
{
    unset($_SESSION["user"]);
    return [
        "redirect:/", []
    ];
}