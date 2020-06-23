<?php

ob_start();
$uri = $_SERVER["REQUEST_URI"];
$cleanedUri = explode("?", $uri)[0];

$link = actualLink();
route("/", "homeController");
route("/", "homeController", "POST");
route("/contact", "contactController");
route("/contact", "contactFormController", "POST");
route("/privacyStatement", "privacyController");
route("/search", "searchController");
route("/search", "searchSubmitController", "POST");
route("/category/$link", "categoryController");
route("/category/$link/product", "productController");
route("/login", "loginFormController");
route("/register", "registerFormController");
route("/register", "registerSubmitFormController", "POST");
route("/login", "loginSubmitFormController", "POST");
route("/logout", "logoutSubmitFormController");
route("/cart", "cartController");
route("/cartAction", "cartActionController");
route("/order", "orderController");
route("/order", "orderActionController", "POST");
list($view, $data) = dispatch($cleanedUri, "notFoundController");
if (preg_match("%^redirect\:%", $view)) {
    $redirectTarget = substr($view, 9);
    header("location:" . $redirectTarget);
    die;
}
extract($data);

$user = createUser();

ob_clean();
require_once "templates/layout.php";
