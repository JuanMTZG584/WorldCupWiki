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
  <div id="contenedorPublicaciones"></div>



</div>