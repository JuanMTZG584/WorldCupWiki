<?php

?><nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
  <div class="container-fluid justify-content-lg-center">
    <a class="navbar-brand ps-3 pe-3" href="/">
      <img src="../public/resources/WCW-Logo.svg" alt="Logo" id="logo-nav">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
      aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
      <form class="d-flex w-75 ms-auto align-items-center me-auto">
        <input class="form-control me-2" type="search" placeholder="Buscar…" aria-label="Buscar">
        <button id="searchButton" class="btn btn-dark" type="submit">Buscar</button>
      </form>

      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item"><a class="nav-link ps-3 pe-3" href="login">Iniciar sesión</a></li>
        <li class="nav-item"><a class="nav-link ps-3 pe-3" href="sign_up">Registrarse</a></li>

        <li class="nav-item dropdown">
          <a class="nav-link ps-3 pe-3 d-flex align-items-center" href="#" id="navbarProfile" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            <?php
            $userPhoto = $_SESSION['user_photo'] ?? null;
            ?>
            <?php if ($userPhoto): ?>
              <img src="data:image/jpeg;base64,<?= $userPhoto ?>" alt="Perfil" width="40" height="40"
                class="rounded-circle">
            <?php else: ?>
              <img src="../public/resources/64572.png" alt="Perfil" width="40" height="40" class="rounded-circle">
            <?php endif; ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarProfile">
            <li><a class="dropdown-item" href="profile">Ver perfil</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="logout">Cerrar sesión</a></li>
          </ul>
        </li>


      </ul>
    </div>
  </div>
</nav>