<?php

function homeController()
{
    return [
        "home",
        [
            "title" => "Home"
        ]
    ];
}

function searchController()
{
    return [
        "search",
        [
            "title" => "Search"
        ]
    ];
}

function searchSubmitController()
{

    return [
        "search",
        [
            "title" => "Search"
        ]
    ];
}

function categoryController()
{
    $link = actualLink();
    return [
        "category",
        [
            "title" => $link
        ]
    ];
}

function productController()
{
    return [
        "product",
        [
            "title" => "Product"
        ]
    ];
}

function notFoundController()
{
    return [
        "404",
        [
            "title" => "404: Az oldal nem található"
        ]
    ];
}

function privacyController()
{
    return [
        "privacyStatement",
        [
            "title" => "Privacy statement"
        ]
    ];
}

