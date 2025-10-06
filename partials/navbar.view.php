  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
    <div class="container-fluid justify-content-lg-center">
      <a class="navbar-brand ps-3 pe-3" href="index.view.php">
        <img src="resources/WCW-Logo.svg" alt="Logo" id="logo-nav">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
        aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
        <form class="d-flex w-75  ms-auto align-items-center me-auto">
          <input class="form-control me-2" type="search" placeholder="Buscar…" aria-label="Buscar">
          <button id="searchButton" class="btn btn-dark" type="submit">Buscar</button>
        </form>

        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item"><a class="nav-link ps-3 pe-3" href="login.view.php">Iniciar sesión</a></li>
          <li class="nav-item"><a class="nav-link ps-3 pe-3" href="sign_up.view.php">Registrarse</a></li>
          <li class="nav-item">
            <a class="nav-link ps-3 pe-3" href="profile.view.php">
              <img src="resources/64572.png" alt="Perfil" width="40" height="40" class="rounded-circle">
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>