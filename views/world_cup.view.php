<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wold Cup Wiki - Mundial seleccionado</title>

    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/all.min.css" />
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
    <div class="background bg-dark">
        <img src="../public/resources/photo-1434648957308-5e6a859697e8.jpg" alt="Fondo">
    </div>

    <!-- Editar Publicación Formulario-->
    <div class="modal fade" id="modalPublicacion" tabindex="-1" aria-labelledby="modalPublicacionLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
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
    <section class="hero-section text-white py-5"
        style="background: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)),  center center; background-size: cover;">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-12 col-md-6 text-center text-md-start mb-4 mb-md-0">
                    <img src="../public/resources/WCW-Logo.svg" alt="Logo Mundial" class="img-fluid mb-3"
                        style="max-height: 120px;">
                    <h1 class="display-3 fw-bold">FIFA World Cup 2026</h1>
                    <p class="lead">El 10 de enero de 2017 el Consejo de la FIFA aprobó por unanimidad, la propuesta del
                        presidente del organismo Gianni Infantino, de elevar el número de plazas para la Copa Mundial de
                        Fútbol de 32 a 48, a partir de la edición de 2026.</p>
                </div>

                <div class="col-12 col-md-6 text-center text-md-end">
                    <img src="../public/resources\66e956f061db0.png" alt="Imagen representativa"
                        class="img-fluid rounded shadow-lg">
                </div>

            </div>
        </div>
    </section>

    <hr class="text-white">

    <!-- Contenido principal -->
    <div class="container-fluid   vh-100 w-100 p-xl-5 main-container">
        <div class="row">
            <!--  Filtros de busqueda -->
            <div class="col-12 col-md-4  p-3">

                <h1 class="text-white">Filtros</h1>
                <hr class="text-white">

                <div class="filter-group">
                    <label for="categoria">Categoría</label><br>
                    <input type="checkbox" id="categoriafilter" name="categoria" value="Deportes">
                    <label for="categoria">Deportes</label>
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
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/controls.script.js"></script>
</body>

</html>