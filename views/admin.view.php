<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Administrador</title>
  <link rel="stylesheet" href="../public/css/bootstrap.min.css">
  <link rel="stylesheet" href="../public/css/all.min.css">
  <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
  <div class="background bg-dark">
    <img src="../public/resources/photo-1434648957308-5e6a859697e8.jpg" alt="Fondo">
  </div>

  <!-- Navbar simplificada-->
  <?php include 'partials/navbar-simplified.view.php'; ?>

  <!-- Dashboard-->
  <div class="container">
    <div class="row">

      <!-- Administración de publicaciones -->
      <div class="col-md-8">
        <h2 class="mb-4 text-white">Administración de publicaciones</h2>


        <div class="card shadow-sm mb-4">
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <img src="../public/resources\64572.png" class="rounded-circle me-3" alt="Usuario" width="50" height="50">
              <div>
                <h6 class="mb-0">Juan Martínez</h6>
                <small class="text-muted">Publicado el 12/09/2025 a las 14:00</small><br>
                <span class="badge bg-primary">Mundial 2022</span>
                <span class="badge bg-secondary">Selección Argentina</span>
              </div>
            </div>
            <img src="../public/resources\66e956f061db0.png" class="img-fluid rounded mb-3" alt="Publicación">
            <button class="btn btn-success btn-sm mb-3 approve-publication"><i class="fas fa-check"></i> Aprobar
              publicación</button>


          </div>
        </div>

        <div class="card shadow-sm mb-4">
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <img src="../public/resources\64572.png" class="rounded-circle me-3" alt="Usuario" width="50" height="50">
              <div>
                <h6 class="mb-0">Pedro Sánchez</h6>
                <small class="text-muted">Publicado el 10/09/2025 a las 19:00</small><br>
                <span class="badge bg-primary">Mundial 2018</span>
                <span class="badge bg-secondary">Selección Francia</span>
              </div>
            </div>
            <div class="ratio ratio-16x9 mb-3">
              <iframe src="https://www.youtube.com/embed/VIDEO_ID" title="Video" allowfullscreen></iframe>
            </div>
            <button class="btn btn-success btn-sm mb-3 approve-publication"><i class="fas fa-check"></i> Aprobar
              publicación</button>
          </div>
        </div>
      </div>

      <!-- Formularios -->
      <div class="col-md-4">
        <!-- Añadir página -->
        <div class="card shadow-sm mb-4">
          <div class="card-body">
            <h5 class="mb-3">Añadir Página del Mundial</h5>

            <form class="form-action" enctype="multipart/form-data">

              <h6 class="text-primary mb-2">Información general</h6>
              <div class="mb-3">
                <label for="pageName" class="form-label">Nombre del Mundial</label>
                <input type="text" class="form-control" id="pageName" placeholder="Ej. Mundial 2022">
              </div>
              <div class="mb-3">
                <label for="pageYear" class="form-label">Año</label>
                <input type="number" class="form-control" id="pageYear" placeholder="2022">
              </div>
              <div class="mb-3">
                <label for="pageCountry" class="form-label">País anfitrión</label>
                <input type="text" class="form-control" id="pageCountry" placeholder="Ej. Catar">
              </div>

              <hr class="my-3">

              <h6 class="text-primary mb-3 d-flex justify-content-between align-items-center">
                Sedes
                <button type="button" id="addVenueBtn" class="btn btn-sm btn-outline-primary">+ Añadir sede</button>
              </h6>

              <div id="venueContainer">

                <div class="venue-item border rounded p-3 mb-3 position-relative">
                  <h6 class="fw-semibold">Sede 1</h6>
                  <div class="mb-3">
                    <label class="form-label">Estadio</label>
                    <input type="text" class="form-control" name="stadium[]" placeholder="Ej. Estadio Lusail" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Ciudad</label>
                    <input type="text" class="form-control" name="city[]" placeholder="Ej. Lusail" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-control" name="description[]" rows="2"
                      placeholder="Breve descripción de la sede"></textarea>
                  </div>

                  <button type="button" class="btn btn-danger btn-sm removeVenueBtn"
                    style="position:absolute; top:10px; right:10px; display:none;">Eliminar</button>
                </div>
              </div>

              <hr class="my-3">

              <h6 class="text-primary mb-2">Elementos visuales</h6>
              <div class="mb-3">
                <label for="pageImage" class="form-label">Imagen principal</label>
                <input type="file" class="form-control" id="pageImage" accept="image/*">
              </div>
              <div class="mb-3">
                <label for="pageLogo" class="form-label">Logotipo</label>
                <input type="file" class="form-control" id="pageLogo" accept="image/*">
              </div>
              <div class="mb-3">
                <label for="pageBall" class="form-label">Balón oficial</label>
                <input type="file" class="form-control" id="pageBall" accept="image/*">
              </div>
              <div class="mb-3">
                <label for="pagePoster" class="form-label">Póster oficial</label>
                <input type="file" class="form-control" id="pagePoster" accept="image/*">
              </div>

              <hr class="my-3">

              <h6 class="text-primary mb-2">Resultados</h6>
              <div class="mb-3">
                <label for="pageChampion" class="form-label">Campeón</label>
                <input type="text" class="form-control" id="pageChampion" placeholder="Ej. Argentina">
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="pageChampionGoals" class="form-label">Goles del Campeón</label>
                  <input type="number" class="form-control" id="pageChampionGoals" placeholder="3">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="pageChampionPenalties" class="form-label">Penales del Campeón</label>
                  <input type="number" class="form-control" id="pageChampionPenalties" placeholder="4">
                </div>
              </div>

              <div class="mb-3">
                <label for="pageRunnerUp" class="form-label">Subcampeón</label>
                <input type="text" class="form-control" id="pageRunnerUp" placeholder="Ej. Francia">
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="pageRunnerUpGoals" class="form-label">Goles del Subcampeón</label>
                  <input type="number" class="form-control" id="pageRunnerUpGoals" placeholder="3">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="pageRunnerUpPenalties" class="form-label">Penales del Subcampeón</label>
                  <input type="number" class="form-control" id="pageRunnerUpPenalties" placeholder="2">
                </div>
              </div>

              <hr class="my-3">
              <h6 class="text-primary mb-2">Reseña</h6>
              <div class="mb-3">
                <label for="pageReview" class="form-label">Breve reseña</label>
                <textarea class="form-control" id="pageReview" rows="3"
                  placeholder="Breve reseña del mundial"></textarea>
              </div>

              <button type="submit" class="btn btn-success w-100 form-btn mt-2">Añadir Página</button>
            </form>
          </div>
        </div>
      </div>



      <!-- Añadir categoría -->
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <h5>Añadir categoría</h5>
          <form class="form-action">
            <div class="mb-3">
              <label for="categoryName" class="form-label">Nombre de la categoría</label>
              <input type="text" class="form-control" id="categoryName" placeholder="Ej. Goles memorables">
            </div>
            <button type="submit" class="btn btn-success w-100 form-btn">Añadir Categoría</button>
          </form>
        </div>
      </div>

      <!-- Nueva publicación -->
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <h5>Nueva Publicación</h5>
          <form class="form-action">
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
                <option value="2018">Rusia 2018</option>
                <option value="2022">Qatar 2022</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="seleccion" class="form-label">Selección (opcional)</label>
              <select class="form-select" id="seleccion">
                <option value="" selected disabled>Elija una selección</option>
                <option value="Argentina">Argentina</option>
                <option value="Brasil">Brasil</option>
                <option value="Francia">Francia</option>
              </select>
            </div>
            <button type="submit" class="btn btn-success w-100 form-btn">Publicar</button>
          </form>
        </div>
      </div>

    </div>
  </div>
  </div>

  <script src="../public/js/bootstrap.bundle.min.js"></script>
  <script>
    document.querySelectorAll('.approve-publication').forEach(btn => {
      btn.addEventListener('click', () => {
        alert('¡Publicación aprobada correctamente!');
      });
    });

    document.querySelectorAll('.approve-comment').forEach(btn => {
      btn.addEventListener('click', () => {
        alert('¡Comentario aprobado correctamente!');
      });
    });

    document.querySelectorAll('.form-action').forEach(form => {
      form.addEventListener('submit', e => {
        e.preventDefault();
        alert('¡Acción realizada correctamente!');
      });
    });
  </script>
  <script>
    // DYNAMIC CONTROLL OF "SEDES"
    const venueContainer = document.getElementById('venueContainer');
    const addVenueBtn = document.getElementById('addVenueBtn');

    let venueCount = 1;

    addVenueBtn.addEventListener('click', () => {
      venueCount++;
      const venueDiv = document.createElement('div');
      venueDiv.classList.add('venue-item', 'border', 'rounded', 'p-3', 'mb-3', 'position-relative');
      venueDiv.innerHTML = `
      <h6 class="fw-semibold">Sede ${venueCount}</h6>
      <div class="mb-3">
        <label class="form-label">Estadio</label>
        <input type="text" class="form-control" name="stadium[]" placeholder="Ej. Estadio ${venueCount}" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Ciudad</label>
        <input type="text" class="form-control" name="city[]" placeholder="Ej. Ciudad ${venueCount}" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea class="form-control" name="description[]" rows="2" placeholder="Breve descripción de la sede"></textarea>
      </div>
      <button type="button" class="btn btn-danger btn-sm removeVenueBtn" style="position:absolute; top:10px; right:10px;">Eliminar</button>
    `;
      venueContainer.appendChild(venueDiv);

      venueDiv.querySelector('.removeVenueBtn').addEventListener('click', () => {
        venueDiv.remove();
        updateVenueTitles();
      });

      updateVenueTitles();
    });
    function updateVenueTitles() {
      const venues = document.querySelectorAll('.venue-item');
      venues.forEach((v, i) => {
        v.querySelector('h6').textContent = `Sede ${i + 1}`;
        const removeBtn = v.querySelector('.removeVenueBtn');
        removeBtn.style.display = i === 0 ? 'none' : 'block'; // la primera no se puede eliminar
      });
    }

    updateVenueTitles();
  </script>
</body>

</html>