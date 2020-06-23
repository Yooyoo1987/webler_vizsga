<header class="fixed-top">
  <nav class="navbar navbar px-0 py-1">

    <div class="container-fluid w-100 px-0">
      <div class="row w-100 mx-auto">

        <div class="col-3 px-0">
          <a class="navbar-brand ml-2 btn btn-secondary" id="homeBtn" href="/"><i class="fas fa-home"></i></a>
        </div>

        <div class="col-9 px-0">
          <div class="float-right">
            <?php if ($user["loggedIn"]) {
              echo "
          <a href='/logout' class='btn btn-danger'>
            <i class='fas fa-sign-out-alt'></i>
          </a>
             ";
            } else {

              echo "
                    <a href='/login' id='nav-user-btn' class='btn btn-success'><i class='fas fa-user'></i></a>
                  ";
            }
            ?>

            <a id="nav-search-btn" class="btn btn-info">
              <i class="fas fa-search"></i>
            </a>

            <a href="/../cart" class="btn btn-primary">
              <i class="fas fa-shopping-cart"></i>
            </a>

            <a id='nav-bars-btn' class="btn btn-light mr-2">
              <i class="fas fa-bars"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid d-block">
      <div class="row">

        <div id="bars-items" class="col-12 p-0 text-center">
          <a class="d-block text-center nav-link" href="/login"><span>Bejelentkezés</span></a>
          <a class="d-block text-center nav-link" href="/register"><span>Regisztráció</span></a>
          <a class="d-block text-center nav-link" href="/contact"><span>Kapcsolat</span></a>
          <a class="d-block text-center nav-link" href="/privacyStatement"><span>Adatvédelmi nyilatkozat</span></a>
        </div>

      </div>
    </div>

    <div class="container-fluid d-block">
      <div class="row">
        <div class="col-1 col-sm-1 col-md-3 col-lg-4 col-xl-4"></div>
        <div id="search-input" class="col-10 col-sm-10 col-md-6 col-lg-4 col-xl-4 p-0 text-center">
          <form action="/../search" method="post">
            <div class="input-group mt-3 mb-3">
              <input id="search" type="text" class="form-control" name="search">
              <div class="input-group-append">
                <button class="input-group-text btn btn-success" type="submit" name="search-btn" id="search-btn"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-1 col-sm-1 col-md-3 col-lg-4 col-xl-4"></div>
      </div>
    </div>
  </nav>

  <?php
  if ($user['loggedIn']) {
    echo "<div class='bg-dark w-100 text-right user-div'><small class='text-light pr-4'>Bejelentkezve: " . $user['name'] . "</small></div>";
  }
  ?>

</header>