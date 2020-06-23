<form action="/register" method="post" class="form-group w-100">
    <div class="container-fluid content-bg px-0 container-register">
        <h1 class="text-center mb-4">Regisztráció</h1>
        <div class="row w-100 mx-0">
            <div class="col-1 col-sm-3 col-md-3 col-lg-3 col-xl-4 px-0"></div>

            <div class="col-10 col-sm-6 col-md-6 col-lg-6 col-xl-4 reg-box">

                <?php

                if ($emptyField) {
                    echo "
                    <div class='alert alert-danger'>
                        Minden mező kitöltése kötelező!
                    </div>
                     ";
                }
                if ($usedUser) {
                    echo "
                    <div class='alert alert-danger'>
                        A felhasználónév már foglalt!
                    </div>
                     ";
                }
                if ($usedEmail) {
                    echo "
                    <div class='alert alert-danger'>
                        Ezzel az email címmel már regisztráltak!
                    </div>
                    ";
                }
                if ($emailFormat) {
                    echo "
                    <div class='alert alert-danger'>
                        Nem megfelelő email formátum!
                    </div>
                    ";
                }
                if ($passwordIsNotEqual) {
                    echo "
                    <div class='alert alert-danger'>
                        A megadott jelszavak nem egyeznek!
                    </div>
                    ";
                }
                if ($passwordLength) {
                    echo "
                    <div class='alert alert-danger'>
                        A jelszónak 8 és 16 karakter köztinek kell lennie!
                    </div>
                    ";
                }
                if ($passwordFormat) {
                    echo "
                    <div class='alert alert-danger'>
                        A jelszónak tartalmaznia kell kis és nagybetűt, számot és speciális karaktert!
                    </div>
                    ";
                }
                if ($invalidPhoneNumber) {
                    echo "
                    <div class='alert alert-danger'>
                        Helytelen telefonszám formátum!
                    </div>
                    ";
                }
                if ($emptyCheck) {
                    echo "
                        <div class='alert alert-danger'>
                            Az adatvédelmi szabályzatot el kell fogadnia!
                        </div>
                        ";
                }
                if ($success) {
                    echo "
                    <div class='alert alert-success'>
                        Sikeres regisztráció!
                    </div>
                    ";
                }
                ?>

                <h5 class="label-h5"><label for="user">Felhasználónév</label></h5>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="user" placeholder="Felhasználónév" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                    <div class="input-group-append">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fas-icons fa-user"></i></span>
                    </div>
                </div>

                <h5 class="label-h5"><label for="lastName">Vezetéknév</label></h5>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="lastName" placeholder="Vezetéknév" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                    <div class="input-group-append">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fas-icons fa-signature"></i></span>
                    </div>
                </div>

                <h5 class="label-h5"><label for="firstName">Keresztnév</label></h5>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="firstName" placeholder="Keresztnév" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                    <div class="input-group-append">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fas-icons fa-signature"></i></span>
                    </div>
                </div>

                <h5 class="label-h5"><label for="email">Email cím</label></h5>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="email" placeholder="Email cím" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                    <div class="input-group-append">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fas-icons fa-at"></i></span>
                    </div>
                    <small class="w-100">Például: teszt@teszt.hu</small>
                </div>

                <h5 class="label-h5"><label for="address">Cím</label></h5>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="address" placeholder="Cím" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                    <div class="input-group-append">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fas-icons fa-city"></i></span>
                    </div>
                </div>

                <h5 class="label-h5"><label for="phoneNumber">Telefonszám</label></h5>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="phoneNumber" placeholder="Telefonszám" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                    <div class="input-group-append">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fas-icons fa-mobile-alt"></i></span>
                    </div>
                    <small class="w-100">Például: 06201234567</small>
                </div>

                <h5 class="label-h5"><label for="password">Jelszó</label></h5>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Jelszó" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                    <div class="input-group-append">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fas-icons fa-key"></i></span>
                    </div>
                    <small class="w-100">A jelszónak 8-16 között kell lennie és tartalmaznia kell kis- és nagybetűt, számot, speciális karaktert!</small>
                </div>

                <h5 class="label-h5"><label for="repassword">Jelszó újra</label></h5>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="repassword" placeholder="Jelszó újra" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                    <div class="input-group-append">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fas-icons fa-key"></i></span>
                    </div>
                    <small class="w-100">A jelszónak 8-16 között kell lennie és tartalmaznia kell kis- és nagybetűt, számot, speciális karaktert!</small>
                </div>
                <div class='text-center'>
                    <input type='checkbox' id='checkbox' name='regCheck'>
                    <label for='checkbox'><a href='/privacyStatement'>Elfogadom az datvédelmi nyilatkozatot!</a></label>
                </div>
                <button class="form-control btn btn-success" type="submit" name="regBtn">Regisztráció</button>
            </div>
            <div class="col-1 col-sm-3 col-md-3 col-lg-3 col-xl-4 px-0"></div>
        </div>
    </div>
</form>