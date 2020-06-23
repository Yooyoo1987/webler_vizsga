
<?php 

setcookie("cookie", 1);

if(empty($_COOKIE["cookie"])){
    echo '
    <form method="post">
    <div id="cookie" class="container-fluid pt-5 bg-dark text-light">
        <div class="row w-100 m-0 p-0">
            <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>

            <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10 px-0 pb-3 text-center">
                <p>Az oldal megfelelő működése érdekében kapcsold be a sütiket a böngésződben! Ellenkező esetben lehetséges, hogy részlegesen vagy teljesen működésképtelen lesz az oldal!</p>
                <button class="btn btn-success" name="cookieBtn" id="cookieBtn">Értettem</button>
            </div>

            <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>
        </div>
    </div>
</form>
    ';
}

?>

<div class="container px-0 container-category">
    <h1 class="text-center mb-4">Termékek</h1>
    <div class="row w-100 mx-0">

        <?php
        $con = mysqli_connect(host, user, pwd, dbname);
        mysqli_query($con, "SET NAMES UTF8");

        $sql = "SELECT * FROM kategoriak";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_array($result)) {

            $katKep = $row['katkep'];
            $katNev = $row['katnev'];
            $url = $row['url'];

            echo "

                <div class='col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3 px-0 text-center mx-auto mt-3'>
                        <img src='$katKep' class='category-image d-block mx-auto mb-1 mt-2' alt='$katNev' title='$katNev'>
                        <a class='btn btn-outline-primary mb-5' href='category" . $url . "?sort=newest'><div>" . $katNev . "</div></a>
                </div>

                ";
        }


        ?>

    </div>
</div>

