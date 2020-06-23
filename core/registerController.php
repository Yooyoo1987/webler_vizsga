<?php
function registerFormController()
{
    $emptyField = array_key_exists("emptyField", $_COOKIE);
    setcookie("emptyField", "", time() - 1);
    $passwordIsNotEqual = array_key_exists("passwordIsNotEqual", $_COOKIE);
    setcookie("passwordIsNotEqual", "", time() - 1);
    $usedUser = array_key_exists("usedUser", $_COOKIE);
    setcookie("usedUser", "", time() - 1);
    $usedEmail = array_key_exists("usedEmail", $_COOKIE);
    setcookie("usedEmail", "", time() - 1);
    $success = array_key_exists("success", $_COOKIE);
    setcookie("success", "", time() - 1);
    $passwordLength = array_key_exists("passwordLength", $_COOKIE);
    setcookie("passwordLength", "", time() - 1);
    $emailFormat = array_key_exists("emailFormat", $_COOKIE);
    setcookie("emailFormat", "", time() - 1);
    $passwordFormat = array_key_exists("passwordFormat", $_COOKIE);
    setcookie("passwordFormat", "", time() - 1);
    $invalidPhoneNumber = array_key_exists("invalidPhoneNumber", $_COOKIE);
    setcookie("invalidPhoneNumber", "", time() - 1);
    $emptyCheck = array_key_exists("emptyCheck", $_COOKIE);
    setcookie("emptyCheck", "", time() - 1);

    return [
        "register",
        [
            "title" => "Regisztráció",
            "emptyField" => $emptyField,
            "passwordIsNotEqual" => $passwordIsNotEqual,
            "usedUser" => $usedUser,
            "usedEmail" => $usedEmail,
            "success" => $success,
            "passwordLength" => $passwordLength,
            "emailFormat" => $emailFormat,
            "passwordFormat" => $passwordFormat,
            "invalidPhoneNumber" => $invalidPhoneNumber,
            "emptyCheck" => $emptyCheck
        ]
    ];
}

function registerSubmitFormController()
{
    $user = $_POST["user"];
    $email = $_POST["email"];
    $lastName = $_POST["lastName"];
    $firstName = $_POST["firstName"];
    $address = $_POST["address"];
    $phoneNumber = $_POST["phoneNumber"];
    $regCheck = $_POST["regCheck"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $rePassword = password_verify($_POST["repassword"], $password);
    $rePassword = $password;

    $con = mysqli_connect(host, user, pwd, dbname);
    mysqli_query($con, "SET NAMES UTF8");

    $sqlUser = "SELECT felhasznalonev FROM felhasznalo_adatok WHERE felhasznalonev='$user'";
    $resultUser = mysqli_query($con, $sqlUser);

    $sqlEmail = "SELECT email FROM felhasznalo_adatok WHERE email='$email'";
    $resultEmail = mysqli_query($con, $sqlEmail);

    if (empty($user) || empty($email) || empty($lastName) || empty($firstName) || empty($address) || empty($phoneNumber) || empty($password) || empty($rePassword)) {
        setcookie("emptyField", 1, time() + 1);
    } else {
        if (strlen($_POST["password"]) < 9 || strlen($_POST["password"]) > 17) {
            $passwordLength = setcookie("passwordLength", 1, time() + 1);
        }
        if (!preg_match("#[0-9]+#", $_POST["password"]) || !preg_match("#[a-z]+#", $_POST["password"]) || !preg_match("#[A-Z]+#", $_POST["password"]) || !preg_match("#\W+#", $_POST["password"])) {
            $passwordFormat = setcookie("passwordFormat", 1, time() + 1);
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailFormat = setcookie("emailFormat", 1, time() + 1);
        }
        if (preg_match("#[a-z]+#", $phoneNumber) || preg_match("#[A-Z]+#", $phoneNumber) || preg_match("#[\W]+#", $phoneNumber)) {
            $invalidPhoneNumber = setcookie("invalidPhoneNumber", 1, time() + 1);
        }
        if (empty($regCheck)) {
            $emptyCheck = setcookie("emptyCheck", 1, time() + 1);
        }
        if ($_POST['password'] != $_POST['repassword']) {
            $passwordIsNotEqual = setcookie("passwordIsNotEqual", 1, time() + 1);
        }
        if (mysqli_num_rows($resultUser) > 0) {
            $usedUser = true;
            setcookie("usedUser", 1, time() + 1);
        }
        if (mysqli_num_rows($resultEmail)) {
            $usedEmail = true;
            setcookie("usedEmail", 1, time() + 1);
        }
        if (isset($_POST["regBtn"])) {

            if (!$passwordIsNotEqual && !$usedUser && !$usedEmail && !$invalidPhoneNumber && !$emailFormat && !$passwordFormat && !$emptyCheck && !$passwordLength) {
                $sql = "INSERT INTO felhasznalo_adatok(felhasznalonev, email, vezeteknev, keresztnev, cim, telefon, jelszo, jelszo_ujra)
                        VALUES('$user', '$email', '$lastName', '$firstName', '$address', '$phoneNumber', '$password', '$rePassword')";
                mysqli_query($con, $sql);
                setcookie("success", 1, time() + 1);
            }
        }
    }
    $view = "redirect:/register";
    return [
        $view,
        [
            "title" => "Register"
        ]
    ];
}
