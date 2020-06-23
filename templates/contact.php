<div class="container content-bg px-0 container-category">
    <h1 class="text-center mb-4">Kapcsolat</h1>
    <div class="row w-100 mx-0">
        <div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 py-2 px-0 text-center m-auto'>
            <p>Láda Imre</p>
            <p>4220, Hajdúböszörmény</p>
            <p>Deák Ferenc utca 3. A1/4</p>
            <p><a href="tel:+360202423193">+36202423193</a></p>
            <p><a href="mailto:ladaimike1987@gmail.com">ladaimike1987@gmail.com</a></p>
        </div>

        <div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 text-center py-2 ml-auto'>
            <div id="iframe">
                <iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=hajd%C3%BAb%C3%B6sz%C3%B6rm%C3%A9ny%20de%C3%A1k%20ferenc%20utca%203%20a1%2F4&t=&z=17&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 py-2 ml-auto user-messgae mx-auto">
            <?php
            if ($emailFormat) {
                echo "
                    <div class='alert alert-danger'>
                        Nem megfelelő email formátum!
                    </div>
                    ";
            }
            if ($emptyField) {
                echo "
                    <div class='alert alert-danger'>
                        Minden mező kitöltése kötelező!
                    </div>
                     ";
            }                
            if ($success) {
                    echo "
                    <div class='alert alert-success'>
                        Sikeres elküldte az üzenetét!
                    </div>
                    ";
            }

            ?>

            <form method="post" class="formgroup">
                <h5 class='label-h5'><label for='userLastName'>Vezetéknév</label></h5>
                <div class='input-group mb-3'>
                    <input type='text' id='userLastName' class='form-control' name='userLastName' placeholder='Vezetéknév' aria-label='Default' aria-describedby='inputGroup-sizing-default'>
                    <div class='input-group-append'>
                        <span class='input-group-text' id='inputGroup-sizing-default'><i class='fas fas-icons fa-signature'></i></span>
                    </div>
                </div>

                <h5 class='label-h5'><label for='userFirstName'>Keresztnév</label></h5>
                <div class='input-group mb-3'>
                    <input type='text' id='userFirstName' class='form-control' name='userFirstName' placeholder='Keresztnév' aria-label='Default' aria-describedby='inputGroup-sizing-default'>
                    <div class='input-group-append'>
                        <span class='input-group-text' id='inputGroup-sizing-default'><i class='fas fas-icons fa-signature'></i></span>
                    </div>
                </div>

                <h5 class='label-h5'><label for='userEmail'>Email cím</label></h5>
                <div class='input-group mb-3'>
                    <input type='text' id='userEmail' class='form-control' name='userEmail' placeholder='Email cím' aria-label='Default' aria-describedby='inputGroup-sizing-default'>
                    <div class='input-group-append'>
                        <span class='input-group-text' id='inputGroup-sizing-default'><i class='fas fas-icons fa-at'></i></span>
                    </div>
                    <small class="w-100">Például: teszt@teszt.hu</small>
                </div>

                <h5 class='label-h5'><label for='userMessage'>Üzenet</label></h5>
                <div>
                    <textarea class='form-control mb-3' id='userMessage' name='userMessage' rows='5' col='100' placeholder='Írj nekünk...'></textarea>
                </div>
                <button class="btn btn-info form-control" name="userMessageBtn" type="submit">Elküld</button>
            </form>
        </div>


    </div>
</div>