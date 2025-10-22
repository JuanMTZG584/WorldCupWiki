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
        <img src="../public/resources/image.jpg" alt="Fondo">
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
        style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), center center; background-size: cover;">
        <div class="container">

            <!-- Encabezado principal -->
            <div class="row align-items-center mb-5">
                <div class="col-12 col-md-6 text-center text-md-start mb-4 mb-md-0">
                    <img src="../public/resources/WCW-Logo.svg" alt="Logo Mundial" class="img-fluid mb-3"
                        style="max-height: 100px;">
                    <h1 class="display-3 fw-bold text-uppercase">FIFA World Cup 2026</h1>
                    <p class="lead">
                        El 10 de enero de 2017 el Consejo de la FIFA aprobó por unanimidad la propuesta del presidente
                        del organismo
                        Gianni Infantino de elevar el número de plazas para la Copa Mundial de Fútbol de 32 a 48, a
                        partir de la
                        edición de 2026.
                    </p>
                </div>
                <div class="col-12 col-md-6 text-center text-md-end">
                    <img src="../public/resources/66e956f061db0.png" alt="Imagen representativa"
                        class="img-fluid rounded shadow-lg" style="max-height: 320px;">
                </div>
            </div>

            <!-- Tarjeta informativa -->
            <div class="bg-light text-dark rounded shadow-lg p-4 mb-5">
                <div class="row">
                    <div class="col-12 col-md-4 mb-4 mb-md-0 text-center d-flex flex-column justify-content-center">
                        <h5 class="fw-bold text-uppercase text-primary mb-3">País sede</h5>
                        <p class="fs-5 fw-semibold">México, Estados Unidos y Canadá</p>
                        <p><strong>Año:</strong> 2026</p>
                        <hr>
                        <h6 class="fw-bold text-secondary mb-2">Balón oficial</h6>
                        <img src="../public/resources/jabulani.jpg" alt="Balón oficial"
                            class="img-fluid rounded shadow-sm mx-auto" style="max-height: 180px;">
                    </div>

                    <!-- Campeón -->
                    <div class="col-12 col-md-4 text-center border-start border-end">
                        <h5 class="fw-bold text-uppercase text-success mb-3">Campeón</h5>
                        <p class="fs-5 fw-semibold mb-1">Argentina</p>
                        <p><strong>Goles:</strong> 18</p>
                        <p><strong>Penales:</strong> 4</p>
                    </div>

                    <!-- Subcampeón -->
                    <div class="col-12 col-md-4 text-center">
                        <h5 class="fw-bold text-uppercase text-danger mb-3">Subcampeón</h5>
                        <p class="fs-5 fw-semibold mb-1">Francia</p>
                        <p><strong>Goles:</strong> 16</p>
                        <p><strong>Penales:</strong> 3</p>
                    </div>
                </div>
            </div>

            <!-- Sedes -->
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h4 class="fw-bold text-uppercase text-white">Sedes del Mundial</h4>
                    <hr class="mx-auto opacity-50" style="width: 200px;">
                </div>

                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100 shadow border-0 rounded-4">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold">🏟️ Estadio Azteca</h5>
                            <p class="mb-1"><strong>Ciudad:</strong> Ciudad de México</p>
                            <p class="text-muted small">
                                Uno de los estadios más emblemáticos del mundo, sede de dos finales de la Copa Mundial
                                de la FIFA.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100 shadow border-0 rounded-4">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold">🏟️ MetLife Stadium</h5>
                            <p class="mb-1"><strong>Ciudad:</strong> Nueva Jersey, EE. UU.</p>
                            <p class="text-muted small">
                                Moderna sede con capacidad para más de 80,000 espectadores, elegida para albergar
                                partidos clave.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100 shadow border-0 rounded-4">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold">🏟️ BMO Field</h5>
                            <p class="mb-1"><strong>Ciudad:</strong> Toronto, Canadá</p>
                            <p class="text-muted small">
                                Ubicado junto al lago Ontario, representa la expansión del torneo a todo el continente
                                norteamericano.
                            </p>
                        </div>
                    </div>
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