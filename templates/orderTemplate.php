<?php
actualLink();

if (preg_match("(order)", $link) && !empty($_SESSION["cart"])) {
    echo "
        <form action='/order' method='post' class='form-group w-100'>
            <div class='container-fluid px-0 container-order'>
                <div class='row w-100 mx-0'>
                    <div class='col-1 col-sm-3 col-md-3 col-lg-3 col-xl-3 px-0'></div>
                    <div class='col-10 col-sm-6 col-md-6 col-lg-6 col-xl-6'>
                    ";
    if ($successOrder) {
        unset($_SESSION["cart"]);
        echo "
            <div class='alert alert-success'>
                Sikeresen megrendelte a kiválasztott termékeket!
            </div>
            ";
    }
    if ($emptyField) {
        echo "
            <div class='alert alert-danger'>
                Minden mező kitöltése kötelező (kivéve megjegyzés)!
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
    if ($invalidPhoneNumber) {
        echo "
            <div class='alert alert-danger'>
                Helytelen telefonszám formátum!
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

    echo "
        <h5 class='label-h5'><label for='lastName'>Vezetéknév</label></h5>
        <div class='input-group mb-3'>
            <input type='text' id='lastName' class='form-control' name='orderLastName' placeholder='Vezetéknév' aria-label='Default' aria-describedby='inputGroup-sizing-default'>
            <div class='input-group-append'>
                <span class='input-group-text' id='inputGroup-sizing-default'><i class='fas fas-icons fa-signature'></i></span>
            </div>
        </div>

        <h5 class='label-h5'><label for='firstName'>Keresztnév</label></h5>
        <div class='input-group mb-3'>
            <input type='text' id='firstName' class='form-control' name='orderFirstName' placeholder='Keresztnév' aria-label='Default' aria-describedby='inputGroup-sizing-default'>
            <div class='input-group-append'>
                <span class='input-group-text' id='inputGroup-sizing-default'><i class='fas fas-icons fa-signature'></i></span>
            </div>
        </div>

        <h5 class='label-h5'><label for='email'>Email cím</label></h5>
        <div class='input-group mb-3'>
            <input type='email' id='email' class='form-control' name='orderEmail' placeholder='Email cím' aria-label='Default' aria-describedby='inputGroup-sizing-default'>
            <div class='input-group-append'>
                <span class='input-group-text' id='inputGroup-sizing-default'><i class='fas fas-icons fa-at'></i></span>
            </div>
            <small class='w-100'>Például: teszt@teszt.hu</small>
        </div>

        <h5 class='label-h5'><label for='address'>Cím</label></h5>
        <div class='input-group mb-3'>
            <input type='text' id='address' class='form-control' name='orderAddress' placeholder='Cím' aria-label='Default' aria-describedby='inputGroup-sizing-default'>
            <div class='input-group-append'>
                <span class='input-group-text' id='inputGroup-sizing-default'><i class='fas fas-icons fa-city'></i></span>
            </div>
        </div>

        <h5 class='label-h5'><label for='phoneNumber'>Telefonszám</label></h5>
        <div class='input-group mb-3'>
            <input type='text' id='phoneNumber' class='form-control' name='orderPhone' placeholder='Telefonszám' aria-label='Default' aria-describedby='inputGroup-sizing-default'>
            <div class='input-group-append'>
                <span class='input-group-text' id='inputGroup-sizing-default'><i class='fas fas-icons fa-mobile-alt'></i></span>
            </div>
            <small class='w-100'>Például: 06201234567</small>
        </div>

        <h5 class='label-h5'><label for='payMethod'>Fizetési mód</label></h5>
        <div class='input-group mb-3'>
            <select name='payMethod' class='form-control' id='payMethod'>
                <option value='options'>Válassz fizetési módot</option>
                <option value='cash'>Készpénz</option>
                <option value='creditCard'>Bankkártya</option>
                <option value='paypal'>Paypal</option>
                <option value='transfer'>Banki átutalás</option>
            </select>
            <div class='input-group-append'>
                <label class='input-group-text'><i class='far fas-icons fa-credit-card'></i></label>
            </div>
        </div>

        <h5 class='label-h5'><label for='receiving'>Átvétel módja</label></h5>
        <div class='input-group mb-3'>
            <select name='receiving' class='form-control' id='receiving'>
                <option value='options'>Válassz átvételi módot</option>
                <option value='personal'>Személyesen</option>
                <option value='courier'>Futár</option>
                <option value='postPoint'>Postapont</option>
            </select>
            <div class='input-group-append'>
                <label class='input-group-text'><i class='fas fas-icons fa-shuttle-van'></i></label>
            </div>
        </div>   

        <h5 class='label-h5'><label for='note'>Megjegyzés</label></h5> 
        <div>        
            <textarea class='form-control' id='note' name='orderNote' rows='5' col='100' placeholder='Megjegyzés'></textarea>
        </div>

        <div class='text-center'>
            <input type='checkbox' id='checkbox' name='orderCheck'>
            <label for='checkbox'><a href='/privacyStatement'>Elfogadom az adatvédelmi nyilatkozat!</a></label>
        </div>
            <button class='btn btn-success form-control' type='submit' name='orderBtn'>Megrendelem</button>
        </div>
        <div class='col-1 col-sm-3 col-md-3 col-lg-3 col-xl-3 px-0'></div>
        </div>
        </div>
        </form>
        ";
} else {
    if (empty($_SESSION["cart"])) {
        echo "
            <h3 class='text-center'>A Kosarad üres!</h3>
            ";
    }
}
