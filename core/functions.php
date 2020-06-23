<?php

$routes = [];

function route($action, $callable, $method = "GET")
{
    global $routes;
    $pattern = "%^$action$%";
    $routes[strtoupper($method)][$pattern] = $callable;
}

function dispatch($action, $notFound)
{
    global $routes;
    $method = $_SERVER["REQUEST_METHOD"];
    if (array_key_exists($method, $routes)) {
        foreach ($routes[$method] as $pattern => $callable) {
            if (preg_match($pattern, $action, $matches)) {
                return $callable($matches);
            }
        }
    }
    return $notFound();
}

function createUser()
{
    $loggedIn = array_key_exists("user", $_SESSION);
    return [
        "loggedIn" => $loggedIn,
        "name" => $loggedIn ? $_SESSION["user"]["name"] : null
    ];
}

function esc($string)
{
    echo htmlspecialchars($string);
}

function actualLink(){
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if (preg_match("(motherboard)", $actual_link)) {
        $link = "motherboard";
    } elseif (preg_match("(cpu)", $actual_link)) {
        $link = "cpu";
    } elseif (preg_match("(ram)", $actual_link)) {
        $link = "ram";
    } elseif (preg_match("(ssd)", $actual_link)) {
        $link = "ssd";
    } elseif (preg_match("(vga)", $actual_link)) {
        $link = "vga";
    } elseif (preg_match("(cooler)", $actual_link)) {
        $link = "cooler";
    } elseif (preg_match("(pccase)", $actual_link)) {
        $link = "pccase";
    } elseif (preg_match("(psu)", $actual_link)) {
        $link = "psu";
    }elseif(preg_match("(cart)", $actual_link)){
        $link = "cart";
    }elseif(preg_match("(order)", $actual_link)){
        $link = "order";
    }else{
        $link = "";
    }
    return $link;
}