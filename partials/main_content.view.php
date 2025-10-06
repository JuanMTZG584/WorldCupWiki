 <button id="PublicarBtn" class="btn btn-filter btn-lg w-100 p-3 fs-1" type="button" data-bs-toggle="collapse"
          data-bs-target="#formPublicacion" aria-expanded="false" aria-controls="formPublicacion">
          +
        </button>

        <!-- Formulario desplegable -->
        <div class="collapse mt-3" id="formPublicacion">
          <div class="card card-body shadow-lg">
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
                <select class="form-select" id="seleccion">
                  <option value="" selected disabled>Elija una selección</option>
                  <option value="Argentina">Argentina</option>
                </select>
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-success" id="btnPublicar">
                  <span id="btnText">Publicar</span>
                  <span id="btnIcon" class="ms-2"></span>
                </button>
              </div>
              <div id="mensajePublicacion" class="mt-3 text-center text-success fw-bold" style="display:none;">
                <i class="fas fa-check-circle me-2"></i> Publicación exitosa
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-8">

        <!-- Orden -->
        <div class="d-flex justify-content-between align-items-center mb-3 p-3">
          <h1 class="text-white">Publicaciones</h1>
          <div class="dropdown">
            <button class="btn btn-success dropdown-toggle ps-5 pe-5 pt-3 pb-3" type="button" id="filtroDropdown"
              data-bs-toggle="dropdown" aria-expanded="false">
              Ordenar por:
            </button>
            <ul class="dropdown-menu" aria-labelledby="filtroDropdown">
              <li><a class="dropdown-item order-by" href="#">Orden cronológico</a></li>
              <li><a class="dropdown-item order-by" href="#">País</a></li>
              <li><a class="dropdown-item order-by" href="#">Likes</a></li>
              <li><a class="dropdown-item order-by" href="#">Comentarios</a></li>
            </ul>
          </div>
        </div>


        <!-- Publicaciones -->
        <div class="post-card-wrapper rounded ">
          <div class="card post-card shadow-lg p-3">
            <div class="card-body">
              <div class="d-flex justify-content-between mb-2">
                <div class="d-flex align-items-center">
                  <img src="resources/64572.png" alt="Perfil" class="profile-img">
                  <div>
                    <h6 class="mb-0">Juan Martínez</h6>
                    <small class="text-muted">Publicado el 12/12/2025 a las 13:00</small>
                  </div>
                </div>
                <div class="dropdown">
                  <button id="dropdownButton" class="btn btn-dark border-0" type="button" data-bs-toggle="dropdown">
                    <i id="dropdownIcon" class="fas fa-ellipsis-h text-white"></i>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#" id="editarBtn">Editar</a>
                    <li><a class="dropdown-item" href="#" id="deleteItem">Eliminar</a></li>
                  </ul>
                </div>

              </div>

              <div class="mb-2 pt-3">
                <span class="badge bg-black me-1 pt-1 pb-1 ps-3 pe-3">Categoría</span>
                <span class="badge bg-success  pt-1 pb-1 ps-3 pe-3">Selección</span>
              </div>

              <img src="resources\66e956f061db0.png" alt="Imagen publicación" class="post-image shadow-sm">

              <div class="d-flex mb-2 gap-2 align-items-center">

                <button id="btnMeGusta" class="btn btn-outline-primary d-flex align-items-center" type="button">
                  <i class="fas fa-thumbs-up me-1"></i> Me gusta
                </button>

                <button class="btn btn-outline-success d-flex align-items-center" type="button"
                  data-bs-toggle="collapse" data-bs-target="#comentarios1" aria-expanded="false"
                  aria-controls="comentarios1">
                  <i class="fas fa-comment me-1"></i> Comentar
                </button>
              </div>

              <div class="collapse mt-2" id="comentarios1">
                <div class="comment bg-light rounded">
                  <div class="comment-header d-flex justify-content-between align-items-center p-3">

                    <div class="comment-user d-flex align-items-center">
                      <img src="resources/64572.png" alt="Avatar" class="rounded-circle" width="40" height="40">
                      <div class="ms-2">
                        <strong>Ana López</strong><br>
                        <small class="text-muted">Publicado el 12/12/2025 a las 13:00</small>
                      </div>
                    </div>

                    <div class="dropdown">
                      <button id="dropdownButtonComment" class="btn btn-dark border-0" type="button"
                        data-bs-toggle="dropdown">
                        <i id="dropdownIcon" class="fas fa-ellipsis-h text-white"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#" id="editItemComment">Editar</a></li>
                        <li><a class="dropdown-item" href="#" id="deleteItemComment">Eliminar</a></li>
                      </ul>
                    </div>
                  </div>

                  <p class="p-3">¡Qué publicación más interesante!</p>
                  <div class="comment-footer d-flex gap-2 align-items-center mt-2">
                    <input type="text" class="form-control new-comment-input" placeholder="Escribe un comentario...">
                    <button class="btn btn-black submit-comment" type="button">
                      <i class="fas fa-paper-plane fa-lg icon-send"></i>
                    </button>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>