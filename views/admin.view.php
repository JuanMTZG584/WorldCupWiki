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

      <div class="col-md-8">
        <h2 class="mb-4 text-white">Administración de publicaciones</h2>

        <?php if (!empty($publicaciones)): ?>
          <?php foreach ($publicaciones as $pub): ?>
            <div class="card shadow-sm mb-4">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <img
                    src="<?= !empty($pub['foto_usuario']) ? 'data:image/jpeg;base64,' . base64_encode($pub['foto_usuario']) : '../public/resources/64572.png' ?>"
                    class="rounded-circle me-3" alt="Usuario" width="50" height="50">
                  <div>
                    <h6 class="mb-0"><?= htmlspecialchars($pub['nombre_usuario'] ?? 'Usuario desconocido') ?></h6>
                    <small class="text-muted">
                      Creado el
                      <?= !empty($pub['fecha_publicacion']) ? date('d/m/Y H:i', strtotime($pub['fecha_publicacion'])) : 'Desconocida' ?>
                    </small><br>
                    <span class="badge bg-primary"><?= htmlspecialchars($pub['mundial'] ?? 'Sin mundial') ?></span>
                    <?php if (!empty($pub['seleccion'])): ?>
                      <span class="badge bg-secondary">Selección <?= htmlspecialchars($pub['seleccion']) ?></span>
                    <?php endif; ?>
                    <?php if (!empty($pub['categoria'])): ?>
                      <span class="badge bg-success"><?= htmlspecialchars($pub['categoria']) ?></span>
                    <?php endif; ?>
                  </div>
                </div>

                <?php if (!empty($pub['multimedia'])): ?>
                  <?php
                  $mimeType = mime_content_type_from_blob($pub['multimedia']);
                  ?>
                  <?php if (str_starts_with($mimeType, 'image/')): ?>
                    <img src="data:<?= $mimeType ?>;base64,<?= base64_encode($pub['multimedia']) ?>"
                      class="img-fluid rounded mb-3" alt="Publicación">
                  <?php elseif (str_starts_with($mimeType, 'video/')): ?>
                    <video class="img-fluid rounded mb-3" controls>
                      <source src="data:<?= $mimeType ?>;base64,<?= base64_encode($pub['multimedia']) ?>">
                      Tu navegador no soporta la reproducción de video.
                    </video>
                  <?php endif; ?>
                <?php endif; ?>

                <button class="btn btn-success btn-sm w-100 approve-publication"
                  data-id="<?= htmlspecialchars($pub['id_publicacion']) ?>">
                  <i class="fas fa-check"></i> Aprobar publicación
                </button>

              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p class="text-white">No hay publicaciones pendientes.</p>
        <?php endif; ?>
      </div>

      <?php
      function mime_content_type_from_blob($blob)
      {
        $f = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_buffer($f, $blob);
        finfo_close($f);
        return $mimeType ?: 'application/octet-stream';
      }
      ?>




      <!-- Formularios -->
      <div class="col-md-4">
        <!-- Añadir página -->
        <div class="card shadow-sm mb-4">
          <div class="card-body">
            <h5 class="mb-3">Añadir Página del Mundial</h5>

            <form id="formMundial" class="form-action" enctype="multipart/form-data">

              <h6 class="text-primary mb-2">Información general</h6>
              <!-- <div class="mb-3">
                <label for="pageName" class="form-label">Nombre del Mundial</label>
                <input type="text" class="form-control" id="pageName" placeholder="Ej. Mundial 2022">
              </div> -->
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
            <div id="responseMundial" class="mt-3"></div>
          </div>

        </div>


      </div>

      <!-- Añadir categoría -->
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <h5>Añadir categoría</h5>
          <form id="formCategoria" class="form-action">
            <div class="mb-3">
              <label for="categoryName" class="form-label">Nombre de la categoría</label>
              <input type="text" class="form-control" id="categoryName" name="nombre" placeholder="Ej. Goles memorables"
                required>
            </div>
            <button type="submit" class="btn btn-success w-100 form-btn">Añadir Categoría</button>
          </form>

          <!-- Mensaje de respuesta-->
          <div id="responseMessage" class="mt-3"></div>
        </div>
      </div>

      <!-- Nueva publicación -->
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <h5>Nueva Publicación</h5>
          <form id="publicacionForm" class="form-action">
            <div class="mb-3">
              <label for="categoria" class="form-label">Categoría</label>
              <select class="form-select" id="categoria" name="id_categoria" required>
                <option value="" selected disabled>Elija una categoría</option>
                <?php foreach ($categorias as $cat): ?>
                  <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nombre']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="media" class="form-label">Imagen o Video</label>
              <input class="form-control" type="file" id="media" name="multimedia" accept="image/*,video/*" required>
            </div>
            <div class="mb-3">
              <label for="mundial" class="form-label">Mundial</label>
              <select class="form-select" id="mundial" name="id_mundial" required>
                <option value="" selected disabled>Elija un mundial</option>
                <?php foreach ($mundiales as $m): ?>
                  <option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['ano'] . " - " . $m['pais']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="seleccion" class="form-label">Selección (opcional)</label>
              <input type="text" class="form-control" id="seleccion" name="seleccion" placeholder="Ej. Marruecos">
            </div>
            <button type="submit" class="btn btn-success w-100 form-btn">Publicar</button>
          </form>

          <div id="statusPost" class="mt-3"></div>
        </div>
      </div>

    </div>
  </div>
  </div>

  <script src="../public/js/bootstrap.bundle.min.js"></script>
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
  <script>
    // SEND REQUEST TO API TO ADD CATEGORY
    document.getElementById('formCategoria').addEventListener('submit', async (e) => {
      e.preventDefault();

      const form = e.target;
      const formData = new FormData(form);
      const responseMessage = document.getElementById('responseMessage');
      responseMessage.innerHTML = '';

      const spinner = `
      <div class="text-center my-3">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Cargando...</span>
        </div>
        <p class="mt-2 mb-0 text-muted">Enviando categoría...</p>
      </div>
    `;
      responseMessage.innerHTML = spinner;

      try {
        const res = await fetch('http://localhost:8000/api/v1/insert_category', {
          method: 'POST',
          body: formData
        });

        const data = await res.json();

        if (res.ok && data.success) {
          responseMessage.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
          form.reset();
        } else {
          responseMessage.innerHTML = `<div class="alert alert-danger">${data.error || 'Error al registrar categoría'}</div>`;
        }
      } catch (error) {
        responseMessage.innerHTML = `<div class="alert alert-danger">Error de conexión con el servidor.</div>`;
      }

      setTimeout(() => { responseMessage.innerHTML = ''; }, 4000);
    });
  </script>
  <script>
    // SEND REQUEST TO API TO ADD A WORLD CUP
    const form = document.getElementById('formMundial');
    const responseMundial = document.getElementById('responseMundial');
    const submitBtn = form.querySelector('.form-btn');

    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      submitBtn.disabled = true;
      submitBtn.innerHTML = `
      <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
      Registrando mundial...
    `;

      responseMundial.innerHTML = `
      <div class="d-flex align-items-center justify-content-center mt-3">
        <div class="spinner-border text-primary me-2" role="status"></div>
        <span>Procesando datos, por favor espere...</span>
      </div>
    `;

      const formData = new FormData();
      formData.append('ano', document.getElementById('pageYear').value);
      formData.append('pais', document.getElementById('pageCountry').value);
      formData.append('campeon', document.getElementById('pageChampion').value);
      formData.append('goles_campeon', document.getElementById('pageChampionGoals').value);
      formData.append('penales_campeon', document.getElementById('pageChampionPenalties').value);
      formData.append('subcampeon', document.getElementById('pageRunnerUp').value);
      formData.append('goles_subcampeon', document.getElementById('pageRunnerUpGoals').value);
      formData.append('penales_subcampeon', document.getElementById('pageRunnerUpPenalties').value);
      formData.append('descripcion', document.getElementById('pageReview').value);

      const logo = document.getElementById('pageLogo').files[0];
      const imagen = document.getElementById('pageImage').files[0];
      const balon = document.getElementById('pageBall').files[0];
      const poster = document.getElementById('pagePoster').files[0];

      if (logo) formData.append('logo', logo);
      if (imagen) formData.append('imagen', imagen);
      if (balon) formData.append('balon', balon);
      if (poster) formData.append('poster', poster);

      const sedes = [];
      document.querySelectorAll('.venue-item').forEach((venue) => {
        sedes.push({
          estadio: venue.querySelector('input[name="stadium[]"]').value,
          ciudad: venue.querySelector('input[name="city[]"]').value,
          descripcion: venue.querySelector('textarea[name="description[]"]').value
        });
      });
      formData.append('sedes', JSON.stringify(sedes));

      try {
        const res = await fetch('http://localhost:8000/api/v1/insert_worldcup', {
          method: 'POST',
          body: formData
        });

        const data = await res.json();

        if (res.ok && data.success) {
          responseMundial.innerHTML = `<div class="alert alert-success mt-3">${data.message}</div>`;
          form.reset();
          document.getElementById('venueContainer').innerHTML = `
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
              <textarea class="form-control" name="description[]" rows="2" placeholder="Breve descripción de la sede"></textarea>
            </div>
            <button type="button" class="btn btn-danger btn-sm removeVenueBtn"
              style="position:absolute; top:10px; right:10px; display:none;">Eliminar</button>
          </div>
        `;
        } else {
          responseMundial.innerHTML = `<div class="alert alert-danger mt-3">${data.error || 'Error al registrar el mundial'}</div>`;
        }
      } catch (error) {
        responseMundial.innerHTML = `<div class="alert alert-danger mt-3">Error de conexión con el servidor.</div>`;
      } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Añadir Página';
        setTimeout(() => { responseMundial.innerHTML = ''; }, 4000);
      }
    });
  </script>
  <script>

    document.getElementById('publicacionForm').addEventListener('submit', async (e) => {
      e.preventDefault();

      const form = e.target;
      const statusBox = document.getElementById('statusPost');
      statusBox.innerHTML = '';
      statusBox.className = '';

      const formData = new FormData(form);

      // Mostrar spinner mientras se envía la solicitud
      const spinner = `
    <div class="text-center my-3">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Cargando...</span>
      </div>
      <p class="mt-2 mb-0 text-muted">Enviando publicación...</p>
    </div>
  `;
      statusBox.innerHTML = spinner;

      try {
        const res = await fetch('http://localhost:8000/api/v1/insert_post', {
          method: 'POST',
          body: formData
        });

        const data = await res.json();

        if (res.ok && data.success) {
          statusBox.innerHTML = `<div class="alert alert-success">${data.message || 'Publicación enviada correctamente'}</div>`;
          form.reset();
        } else {
          statusBox.innerHTML = `<div class="alert alert-danger">${data.error || 'Ocurrió un error al enviar la publicación'}</div>`;
        }
      } catch (err) {
        statusBox.innerHTML = `<div class="alert alert-danger">Error de conexión con el servidor</div>`;
        console.error(err);
      }

      setTimeout(() => { statusBox.innerHTML = ''; }, 4000);
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.approve-publication').forEach(button => {
        button.addEventListener('click', async () => {
          const id = button.dataset.id;
          const container = button.closest('.card-body');

          if (!confirm('¿Deseas aprobar esta publicación?')) return;

          const spinner = `
        <div class="text-center my-3">
          <div class="spinner-border text-success" role="status">
            <span class="visually-hidden">Procesando...</span>
          </div>
          <p class="mt-2 mb-0 text-muted">Aprobando publicación...</p>
        </div>
      `;

          const messageDiv = document.createElement('div');
          container.appendChild(messageDiv);
          messageDiv.innerHTML = spinner;

          try {
            const formData = new FormData();
            formData.append('id', id);

            const res = await fetch('http://localhost:8000/api/v1/approve_post', {
              method: 'POST',
              body: formData
            });

            const data = await res.json();

            if (res.ok && data.success) {
              messageDiv.innerHTML = `<div class="alert alert-success mt-3">${data.message}</div>`;
              setTimeout(() => location.reload(), 1500);
            } else {
              messageDiv.innerHTML = `<div class="alert alert-danger mt-3">${data.error || 'Error al aprobar publicación'}</div>`;
            }
          } catch (error) {
            messageDiv.innerHTML = `<div class="alert alert-danger mt-3">Error de conexión con el servidor.</div>`;
          }

          setTimeout(() => messageDiv.remove(), 4000);
        });
      });
    });
  </script>




</body>

</html>