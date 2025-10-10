<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wold Cup Wiki</title>

  <link href="../public/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../public/css/all.min.css">
  <link rel="stylesheet" href="../public/css/swiper-bundle.min.css">
  <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
  <div class="background bg-dark">
    <img src="../public/resources/photo-1434648957308-5e6a859697e8.jpg" alt="Fondo">
  </div>

  <!-- Editar Publicación Formulario-->
  <div class="modal fade" id="modalPublicacion" tabindex="-1" aria-labelledby="modalPublicacionLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content shadow-lg">
        <div class="modal-header">
          <h5 class="modal-title" id="modalPublicacionLabel">Editar Publicación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <form>

            <div class="mb-3">
              <label for="categoria" class="form-label">Categoría</label>
              <select class="form-select" id="categoria" required>
                <option value="" selected disabled>Elija una categoría</option>
                <option value="historia">Historia</option>
                <option value="jugador">Jugador</option>
                <option value="partido">Partido</option>
                <option value="dato">Dato curioso</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="media" class="form-label">Imagen o Video</label>
              <input class="form-control" type="file" id="media" accept="image/*,video/*" required>
            </div>

            <div class="mb-3">
              <label for="mundial" class="form-label">Mundial</label>
              <select class="form-select" id="mundial" required>
                <option value="" selected disabled>Elija un mundial</option>
                <option value="2014">Brasil 2014</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="seleccion" class="form-label">Selección (opcional)</label>
              <select class="form-select" id="seleccion" required>
                <option value="" selected disabled>Elija una selección</option>
                <option value="Argentina">Argentina</option>
              </select>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-success">Editar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Navbar -->
  <?php include 'partials/navbar.view.php'; ?>

  <!-- Hero -->
  <h1 class="p-3 text-white display-1 fw-bold text-center pb-5 title">¡Bienvenido a World Cup Wiki!</h1>

  <!-- Swiper -->
  <div class="swiper-container">
    <div class="swiper-wrapper mt-6">
      <div class="swiper-slide" data-image="../public/resources/photo-1434648957308-5e6a859697e8.jpg" data-url="world_cup">
        <div class="card rounded">Copa Mundial 1930</div>
      </div>
      <div class="swiper-slide" data-image="../public/resources/photo-1434648957308-5e6a859697e8.jpg" data-url="world_cup">
        <div class="card rounded">Copa Mundial 1934</div>
      </div>
      <div class="swiper-slide" data-image="../public/resources/photo-1434648957308-5e6a859697e8.jpg" data-url="world_cup">
        <div class="card rounded">Copa Mundial 1934</div>
      </div>
      <div class="swiper-slide" data-image="../public/resources/photo-1434648957308-5e6a859697e8.jpg" data-url="world_cup">
        <div class="card rounded">Copa Mundial 1934</div>
      </div>
      <div class="swiper-slide" data-image="../public/resources/photo-1434648957308-5e6a859697e8.jpg" data-url="world_cup">
        <div class="card rounded">Copa Mundial 1934</div>
      </div>
      <div class="swiper-slide" data-image="../public/resources/photo-1434648957308-5e6a859697e8.jpg" data-url="world_cup">
        <div class="card rounded">Copa Mundial 1934</div>
      </div>
      <div class="swiper-slide" data-image="../public/resources/photo-1434648957308-5e6a859697e8.jpg" data-url="world_cup">
        <div class="card rounded">Copa Mundial 1934</div>
      </div>
    </div>

    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </div>

  <hr class="text-white">

  <!--  Contenido principal -->
  <div class="container-fluid   vh-100 w-100 p-xl-5 main-container">
    <div class="row">

      <div class="col-12 col-md-4  p-3">
        <!--  Filtros de busqueda -->
        <h1 class="text-white">Filtros</h1>
        <hr class="text-white">

        <div class="filter-group">
          <label for="categoria">Categoría</label><br>
          <input type="checkbox" id="categoriafilter" name="categoria" value="Deportes">
          <label for="categoria">Deportes</label>
        </div>

        <div class="filter-group">
          <label for="ano">Año Mundial</label><br>
          <input type="checkbox" id="ano" name="ano" value="2022">
          <label for="ano">2022</label>
        </div>

        <div class="filter-group">
          <label for="pais">País Sede</label><br>
          <input type="checkbox" id="pais" name="pais" value="Qatar">
          <label for="pais">Qatar</label>
        </div>

        <div class="filter-group">
          <button id="usuarioBtn" class="btn btn-filter">Filtrar por Usuario</button>
          <input type="text" id="usuarioInput" class="form-control" placeholder="Ingrese nombre de usuario">
        </div>

        <div id="publicaciones" class="text-white mb-3"></div>

        <hr class="text-white">

       <?php include 'partials/main_content.view.php'; ?>


    </div>
  </div>

  <!-- Scripts -->
  <script src="../public/js/swiper-bundle.min.js"></script>
  <script src="../public/js/bootstrap.bundle.min.js"></script>
  <script>
    const swiper = new Swiper('.swiper-container', {
      loop: true,
      slidesPerView: 3,
      spaceBetween: 20,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        type: 'progressbar',
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });

    document.querySelectorAll('.swiper-slide').forEach(slide => {
      const imageUrl = slide.getAttribute('data-image');
      if (imageUrl) {
        slide.style.backgroundImage = `url(${imageUrl})`;
        slide.style.backgroundSize = 'cover';
        slide.style.backgroundPosition = 'center';
      }
    });
    document.querySelectorAll('.swiper-slide').forEach(slide => {
      slide.addEventListener('click', () => {
        window.location.href = slide.dataset.url;
      });
    });
  </script>
  <script src="../public/js/controls.script.js"></script>
</body>

</html>