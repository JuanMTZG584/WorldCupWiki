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
      <?php if (!empty($mundiales)): ?>
        <?php foreach ($mundiales as $m): ?>
          <div class="swiper-slide" data-url="world_cup?id=<?= htmlspecialchars($m['id']) ?>">
            <?php
            $imagenSrc = 'data:image/jpeg;base64,' . base64_encode($m['imagen']);
            ?>
            <div class="card rounded text-center" style="overflow: hidden;">
              <img src="<?= $imagenSrc ?>" alt="<?= htmlspecialchars($m['nombre']) ?>"
                style="width: 100%; height: 250px; object-fit: cover; border-radius: 8px;">
              <div class="p-2 fw-bold">
                <?= htmlspecialchars($m['nombre']) ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-center">No hay mundiales disponibles.</p>
      <?php endif; ?>
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
          <label class="text-white">Categoría</label><br>
          <?php
          $categorias = array_unique(array_column(array_filter($filtros, fn($f) => !empty($f['categoria'])), 'categoria'));
          if (!empty($categorias)) {
            foreach ($categorias as $cat): ?>
              <div class="form-check">
                <input type="checkbox" id="categoria_<?= htmlspecialchars($cat) ?>" name="categoria"
                  value="<?= htmlspecialchars($cat) ?>" class="form-check-input">
                <label class="form-check-label text-white"
                  for="categoria_<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($cat) ?></label>
              </div>
            <?php endforeach;
          } else {
            echo '<p class="text-muted">No hay categorías disponibles.</p>';
          }
          ?>
        </div>

        <div class="filter-group mt-3">
          <label class="text-white">Año Mundial</label><br>
          <?php
          $anos = array_unique(array_column(array_filter($filtros, fn($f) => !empty($f['ano_mundial'])), 'ano_mundial'));
          if (!empty($anos)) {
            foreach ($anos as $ano): ?>
              <div class="form-check">
                <input type="checkbox" id="ano_<?= htmlspecialchars($ano) ?>" name="ano"
                  value="<?= htmlspecialchars($ano) ?>" class="form-check-input">
                <label class="form-check-label text-white"
                  for="ano_<?= htmlspecialchars($ano) ?>"><?= htmlspecialchars($ano) ?></label>
              </div>
            <?php endforeach;
          } else {
            echo '<p class="text-muted">No hay años disponibles.</p>';
          }
          ?>
        </div>

        <div class="filter-group mt-3">
          <label class="text-white">País Sede</label><br>
          <?php
          $paises = array_unique(array_column(array_filter($filtros, fn($f) => !empty($f['pais_sede'])), 'pais_sede'));
          if (!empty($paises)) {
            foreach ($paises as $pais): ?>
              <div class="form-check">
                <input type="checkbox" id="pais_<?= htmlspecialchars($pais) ?>" name="pais"
                  value="<?= htmlspecialchars($pais) ?>" class="form-check-input">
                <label class="form-check-label text-white"
                  for="pais_<?= htmlspecialchars($pais) ?>"><?= htmlspecialchars($pais) ?></label>
              </div>
            <?php endforeach;
          } else {
            echo '<p class="text-muted">No hay países disponibles.</p>';
          }
          ?>
        </div>

        <div class="filter-group mt-4">
          <button id="usuarioBtn" class="btn btn-filter w-100">Filtrar por Usuario</button>
          <input type="text" id="usuarioInput" class="form-control mt-2" placeholder="Ingrese nombre de usuario"
            style="display: block !important; visibility: visible !important;">
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
        slidesPerView: 4,
        spaceBetween: 2,
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
      document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.swiper-slide').forEach(slide => {
          slide.addEventListener('click', () => {
            const url = slide.getAttribute('data-url');
            if (url) {
              window.location.href = url;
            }
          });
        });
      });
    </script>

    <script>
      document.addEventListener("DOMContentLoaded", () => {
        const filtros = {
          paises: [],
          anos: [],
          categorias: [],
          usuarios: "",
          orden: "fecha"
        };


        const idUsuario = <?= $_SESSION['user_id'] ?? 'null' ?>;
        const isAdmin = <?= !empty($_SESSION['is_admin']) && $_SESSION['is_admin'] ? 'true' : 'false' ?>;

        async function enviarComentario(idPublicacion, contenido) {
          if (!contenido.trim()) return;


          try {
            const res = await fetch('/api/v1/insert_comment', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
              body: JSON.stringify({ id_usuario: idUsuario, id_publicacion: idPublicacion, contenido })
            });
            const data = await res.json();

            if (data.status === 'success') {
              fetchComentariosPost(idPublicacion); // refrescar comentarios
            } else {
              alert('Error: ' + data.message);
            }
          } catch (err) {
            console.error(err);
            alert('Error de conexión al servidor.');
          }
        }

        async function fetchComentariosPost(idPublicacion) {
          try {
            const res = await fetch('/api/v1/get_comments', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({ id_publicacion: idPublicacion })
            });

            const data = await res.json();
            if (data.status !== 'success') return;

            const collapseDiv = document.querySelector(`#comentarios${idPublicacion}`);
            const comentariosHtml = (data.data || []).map(c => {
              const commentButtons = (isAdmin) ? `
        <div class="dropdown">
          <button class="btn btn-dark border-0" type="button" data-bs-toggle="dropdown">
            <i class="fas fa-ellipsis-h text-white"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item delete-comment" href="#" data-id="${c.comentario_id}">Eliminar</a></li>
          </ul>
        </div>
      ` : '';

              return `
        <div class="comment bg-light rounded mb-2">
          <div class="comment-header d-flex justify-content-between align-items-center p-2">
            <div class="comment-user d-flex align-items-center">
              <img src="data:${c.mime_foto};base64,${c.usuario_foto}" alt="Avatar" class="rounded-circle" width="40" height="40">
              <div class="ms-2">
                <strong>${c.usuario_nombre}</strong><br>
                <small class="text-muted">Publicado el ${new Date(c.fecha_creacion).toLocaleString()}</small>
              </div>
            </div>
            ${commentButtons}
          </div>
          <p class="p-2">${c.contenido}</p>
        </div>
      `;
            }).join('');

            collapseDiv.innerHTML = comentariosHtml + `
      <div class="comment-footer d-flex gap-2 align-items-center mt-2">
        <input type="text" class="form-control new-comment-input" placeholder="Escribe un comentario..." data-post-id="${idPublicacion}">
        <button class="btn btn-black submit-comment" type="button" data-post-id="${idPublicacion}">
          <i class="fas fa-paper-plane fa-lg icon-send"></i>
        </button>
      </div>
    `;

            attachCommentEvents();
          } catch (err) {
            console.error(err);
          }
        }


        function attachCommentEvents() {
          document.querySelectorAll('.submit-comment').forEach(btn => {
            btn.removeEventListener('click', handleCommentClick);
            btn.addEventListener('click', handleCommentClick);
          });

          document.querySelectorAll('.collapse').forEach(collapseEl => {
            collapseEl.removeEventListener('show.bs.collapse', handleCollapseShow);
            collapseEl.addEventListener('show.bs.collapse', handleCollapseShow);
          });

          document.querySelectorAll('.delete-comment').forEach(btn => {
            btn.removeEventListener('click', handleDeleteComment);
            btn.addEventListener('click', handleDeleteComment);
          });
        }

        function handleCommentClick(e) {
          const idPublicacion = e.currentTarget.dataset.postId;
          const input = document.querySelector(`.new-comment-input[data-post-id="${idPublicacion}"]`);
          const contenido = input.value;

          if (!idUsuario) {
            window.location.href = '/login';
            return;
          }

          enviarComentario(idPublicacion, contenido);
          input.value = '';
        }

        function handleCollapseShow(e) {
          const idPublicacion = e.currentTarget.id.replace('comentarios', '');
          fetchComentariosPost(idPublicacion);
        }

        async function handleDeleteComment(e) {
          e.preventDefault();
          const idComentario = e.currentTarget.dataset.id;
          const idPublicacion = e.currentTarget.closest('.collapse').id.replace('comentarios', '');

          if (!idUsuario) {
            window.location.href = '/login';
            return;
          }

          if (!confirm('¿Estás seguro de que deseas eliminar este comentario?')) return;

          try {
            const res = await fetch('/api/v1/delete_comment', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({ id_comentario: idComentario })
            });

            const data = await res.json();

            if (data.status === 'success') {
              fetchComentariosPost(idPublicacion);
            } else {
              alert('Error: ' + data.message);
            }
          } catch (err) {
            console.error(err);
            alert('Error de conexión al servidor.');
          }
        }

        document.querySelectorAll('input[name="pais"]').forEach(chk => {
          chk.addEventListener("change", () => {
            filtros.paises = getCheckedValues('pais');
            fetchPublicaciones();
          });
        });

        document.querySelectorAll('input[name="ano"]').forEach(chk => {
          chk.addEventListener("change", () => {
            filtros.anos = getCheckedValues('ano');
            fetchPublicaciones();
          });
        });

        document.querySelectorAll('input[name="categoria"]').forEach(chk => {
          chk.addEventListener("change", () => {
            filtros.categorias = getCheckedValues('categoria');
            fetchPublicaciones();
          });
        });

        const usuarioBtn = document.getElementById('usuarioBtn');
        const usuarioInput = document.getElementById('usuarioInput');

        usuarioBtn.addEventListener('click', () => {
          const val = usuarioInput.value.trim();
          filtros.usuarios = val;
          fetchPublicaciones();
        });

        usuarioInput.addEventListener('keypress', (e) => {
          if (e.key === 'Enter') {
            const val = usuarioInput.value.trim();
            filtros.usuarios = val;
            fetchPublicaciones();
          }
        });

        document.querySelectorAll('.order-by').forEach(item => {
          item.addEventListener('click', (e) => {
            e.preventDefault();
            const texto = e.target.textContent.trim();
            switch (texto) {
              case 'País': filtros.orden = 'pais'; break;
              case 'Likes': filtros.orden = 'likes'; break;
              case 'Comentarios': filtros.orden = 'comentarios'; break;
              default: filtros.orden = 'fecha';
            }
            fetchPublicaciones();
          });
        });



        function getCheckedValues(name) {
          return Array.from(document.querySelectorAll(`input[name="${name}"]:checked`)).map(el => el.value);
        }

        async function fetchPublicaciones() {
          const contenedor = document.getElementById('contenedorPublicaciones');
          contenedor.innerHTML = '<p class="text-white">Cargando publicaciones...</p>';

          try {
            const formData = new FormData();
            formData.append('p_paises', filtros.paises);
            formData.append('p_anos', filtros.anos);
            formData.append('p_categorias', filtros.categorias);
            formData.append('p_usuarios', filtros.usuarios);
            formData.append('p_orden', filtros.orden);

            const res = await fetch('/api/v1/get_posts', { method: 'POST', body: formData });
            const data = await res.json();

            if (data.status === 'success') {
              contenedor.innerHTML = renderPublicaciones(data.data);
              attachCommentEvents();
            } else {
              contenedor.innerHTML = '<p class="text-danger">Error al cargar publicaciones.</p>';
            }
          } catch (err) {
            contenedor.innerHTML = '<p class="text-danger">Error de conexión con el servidor.</p>';
          }
        }

        function renderPublicaciones(publicaciones) {
          if (!publicaciones.length) return '<p class="text-white">No hay publicaciones que coincidan.</p>';

          return publicaciones.map(pub => {
            const mime = pub.mime_multimedia || 'application/octet-stream';
            let mediaHtml = '';

            if (mime.startsWith('image/')) {
              mediaHtml = `<img src="data:${mime};base64,${pub.multimedia}" class="post-image shadow-sm mb-3" alt="imagen">`;
            } else if (mime.startsWith('video/')) {
              mediaHtml = `<video class="post-image shadow-sm mb-3" controls>
            <source src="data:${mime};base64,${pub.multimedia}" type="${mime}">
            Tu navegador no soporta el formato de video.
        </video>`;
            }





            return `
      <div class="post-card-wrapper rounded">
        <div class="card post-card shadow-lg p-3">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
              <div class="d-flex align-items-center">
                <img src="data:image/jpeg;base64,${pub.foto}" alt="Perfil" class="profile-img">
                <div class="ms-2">
                  <h6 class="mb-0">${pub.usuario}</h6>
                  <small class="text-muted">Publicado el ${new Date(pub.fecha).toLocaleString()}</small>
                </div>
              </div>
            </div>

            <div class="mb-2 pt-3">
              <span class="badge bg-primary">${pub.mundial}</span>
              <span class="badge bg-secondary">${pub.seleccion}</span>
              <span class="badge bg-success">${pub.categoria}</span>
            </div>

            ${mediaHtml}

            <div class="d-flex mb-2 gap-2 align-items-center">
              <button class="btn btn-outline-primary d-flex align-items-center" type="button">
                <i class="fas fa-thumbs-up me-1"></i> Me gusta (${pub.likes})
              </button>
              <button class="btn btn-outline-success d-flex align-items-center" type="button"
                data-bs-toggle="collapse" data-bs-target="#comentarios${pub.id}" aria-expanded="false">
                <i class="fas fa-comment me-1"></i> Comentar (${pub.comentarios})
              </button>
            </div>

            <div class="collapse mt-2" id="comentarios${pub.id}"></div>
          </div>
        </div>
      </div>
    `;
          }).join('');
        }

        //NAVBAR SEARCH
        const searchButton = document.getElementById("searchButton");
        const searchInput = document.querySelector('input[type="search"]');

        searchButton.addEventListener("click", (e) => {
          e.preventDefault();
          const term = searchInput.value.trim();
          if (!term) return;

          let found = false;

          document.querySelectorAll('input[name="categoria"]').forEach(cb => {
            if (cb.value.toLowerCase() === term.toLowerCase()) {
              cb.checked = true;
              found = true;
            }
          });

          document.querySelectorAll('input[name="ano"]').forEach(cb => {
            if (cb.value.toLowerCase() === term.toLowerCase()) {
              cb.checked = true;
              found = true;
            }
          });

          document.querySelectorAll('input[name="pais"]').forEach(cb => {
            if (cb.value.toLowerCase() === term.toLowerCase()) {
              cb.checked = true;
              found = true;
            }
          });

          filtros.categorias = getCheckedValues('categoria');
          filtros.anos = getCheckedValues('ano');
          filtros.paises = getCheckedValues('pais');
          
          searchInput.value = "";

          if (typeof fetchPublicaciones === "function") {
            fetchPublicaciones();
          }
        });

        fetchPublicaciones();
      });

    </script>

    <script src="../public/js/controls.script.js"></script>
</body>

</html>