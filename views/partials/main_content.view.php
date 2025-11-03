<button id="PublicarBtn" class="btn btn-filter btn-lg w-100 p-3 fs-1" type="button" data-bs-toggle="collapse"
  data-bs-target="#formPublicacion" aria-expanded="false" aria-controls="formPublicacion">
  +
</button>

<!-- Formulario desplegable -->
<div class="collapse mt-3" id="formPublicacion">
  <div class="card card-body shadow-lg">
    <form id="publicacionForm" class="form-action">
      <div class="mb-3">
        <label for="categoria" class="form-label">Categoría</label>
        <select class="form-select" id="categoria" name="id_categoria" required>
          <option value="" selected disabled>Elija una categoría</option>
          <?php foreach ($categorias_list as $cat): ?>
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
          <?php foreach ($mundiales_list as $m): ?>
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
<div id="paginacion" class="mt-4 mb-3"></div>
  <div id="contenedorPublicaciones"></div>





</div>