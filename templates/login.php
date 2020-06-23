<form class="form-group mx-auto my-0 w-100" action="/login" method="post">
    <div class="container-fluid content-bg px-0 container-login">
        <h1 class="text-center mb-4">Bejelentkezés</h1>
        <div class="row w-100 mx-0">
            <div class="col-1 col-sm-3 col-md-3 col-lg-3 col-xl-4 px-0"></div>
            <div class="col-10 col-sm-6 col-md-6 col-lg-6 col-xl-4 login-box">
                <?php if ($emptyField) {
                    echo "
                    <div class='alert alert-danger'>
                         Minden mező kitöltése kötelező!
                    </div>
                         ";
                }
                if ($notValidUserOrPassword) {
                    echo "
                    <div class='alert alert-danger'>
                        A felhasználónév vagy jelszó nem megfelelő!
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

                <h5 class="label-h5"><label for="password">Jelszó</label></h5>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Jelszó" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                    <div class="input-group-append">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fas-icons fa-key"></i></span>
                    </div>
                </div>
                <button class="btn btn-success form-control mb-2" type="submit" name="loginBtn">Bejelentkezés</button>
                <div class="text-center">
                    <a href="/register" class="m-auto"><small>Még nem regisztráltál? Regisztrálj most!</small></a>
                </div>
            </div>
            <div class="col-1 col-sm-3 col-md-3 col-lg-3 col-xl-4 px-0"></div>
        </div>
    </div>
</form>