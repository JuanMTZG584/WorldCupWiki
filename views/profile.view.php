<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>World Cup Wiki - Perfil de usuario</title>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/all.min.css">
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
                        <!-- Categoría -->
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

                        <!-- Imagen o video -->
                        <div class="mb-3">
                            <label for="media" class="form-label">Imagen o Video</label>
                            <input class="form-control" type="file" id="media" accept="image/*,video/*" required>
                        </div>

                        <!-- Mundial -->
                        <div class="mb-3">
                            <label for="mundial" class="form-label">Mundial</label>
                            <select class="form-select" id="mundial" required>
                                <option value="" selected disabled>Elija un mundial</option>
                                <option value="2014">Brasil 2014</option>
                            </select>
                        </div>

                        <!-- Selección (opcional) -->
                        <div class="mb-3">
                            <label for="seleccion" class="form-label">Selección (opcional)</label>
                            <select class="form-select" id="seleccion" required>
                                <option value="" selected disabled>Elija una selección</option>
                                <option value="Argentina">Argentina</option>
                            </select>
                        </div>

                        <!-- Botón enviar -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Editar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Editar Perfil Formulario-->
    <div class="modal fade" id="modalEditarPerfil" tabindex="-1" aria-labelledby="modalEditarPerfilLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarPerfilLabel">Editar Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div id="password-errors" class="alert alert-danger mt-3 d-none" role="alert">
                    </div>
                    <form id="formEditarPerfil">
                        <!-- Vista previa de imagen -->
                        <div class="mb-3 text-center">
                            <img id="image-preview" src="" alt="Vista previa de la imagen" class="img-fluid"
                                style="max-height:150px;">
                        </div>

                        <!-- Imagen de perfil -->
                        <div class="mb-3">
                            <label for="profile-image" class="form-label">Imagen de perfil</label>
                            <input type="file" class="form-control form-control-sm" id="profile-image" accept="image/*"
                                onchange="previewImage(event)" required>
                        </div>

                        <!-- Nombre-->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control form-control-sm" id="nombre"
                                placeholder="Nombre Completo" required>
                        </div>

                        <!-- Fecha de nacimiento y País -->
                        <div class="row gx-2 mb-3">
                            <div class="col-md-6">
                                <label for="fecha" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control form-control-sm" id="fecha" required>
                            </div>
                            <div class="col-md-6">
                                <label for="pais" class="form-label">País</label>
                                <select class="form-select form-select-sm" id="pais" name="pais" required>
                                    <option value="" disabled selected>Seleccione un país</option>
                                    <?php foreach ($countries as $country): ?>
                                        <option value="<?= htmlspecialchars($country['cca2']) ?>">
                                            <?= htmlspecialchars($country['name']['common']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Nacionalidad y Género -->
                        <div class="row gx-2 mb-3">
                            <div class="col-md-6">
                                <label for="nacionalidad" class="form-label">Nacionalidad</label>
                                <div id="nacionalidades-container">
                                    <select class="form-select form-select-sm mb-2" name="nacionalidad[]">
                                        <option value="" disabled selected>Seleccione un país</option>
                                        <?php foreach ($countries as $country): ?>
                                            <option value="<?= htmlspecialchars($country['cca2']) ?>">
                                                <?= htmlspecialchars($country['name']['common']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <button type="button" id="addNacionalidad" class="btn btn-dark btn-sm w-100">
                                            Agregar
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" id="removeNacionalidad"
                                            class="btn btn-danger btn-sm w-100">
                                            Quitar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="genero" class="form-label">Género</label>
                                <select class="form-select form-select-sm" id="genero">
                                    <option value="" selected disabled>Seleccione género</option>
                                    <option value="m">Masculino</option>
                                    <option value="f">Femenino</option>
                                    <option value="o">Otro</option>
                                </select>
                            </div>
                        </div>

                        <!-- Contraseña y Repetir contraseña -->
                        <div class="row gx-2 mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control form-control-sm" id="password"
                                    placeholder="Contraseña" required>
                            </div>
                            <div class="col-md-6">
                                <label for="password2" class="form-label">Repetir Contraseña</label>
                                <input type="password" class="form-control form-control-sm" id="password2"
                                    placeholder="Repetir Contraseña" required>
                            </div>
                        </div>

                        <!-- Botón actualizar -->
                        <div class="d-grid">
                            <button id="updateButton" type="submit"
                                class="btn btn-dark btn-sm w-100">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <?php include 'partials/navbar-simplified.view.php'; ?>
    <!-- Hero Perfil -->
    <section class="profile-hero">
        <div class="container">
            <div class="profile-pic mb-3">
                <img src="../public/resources\64572.png" alt="Perfil">
            </div>
            <h1 class="display-4">Juan Martínez</h1>
            <p class="lead">
                <i class="fas fa-calendar-alt me-2"></i>12/12/1990
                <i class="fas fa-map-marker-alt ms-4 me-2"></i>México
                <i class="fas fa-flag ms-4 me-2"></i>Mexicano
            </p>
            <button class="btn btn-success btn-lg btn-edit-profile" type="button" data-bs-toggle="modal"
                data-bs-target="#modalEditarPerfil">
                Editar Perfil
            </button>

        </div>
    </section>

    <!-- Info y Estadísticas -->
    <div class="container my-5 user-info">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card p-4 shadow-sm profile-card">
                    <h5>Información de contacto</h5>
                    <p id="contact-correo"><strong>Correo:</strong> --</p>
                    <p id="contact-genero"><strong>Género:</strong> --</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-4 shadow-sm profile-card">
                    <h5>Estadísticas</h5>
                    <p id="stat-publicaciones"><strong>Publicaciones:</strong> </p>
                    <p id="stat-likes"><strong>Me gusta:</strong> </p>
                    <p id="stat-vistas"><strong>Vistas totales:</strong> </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Publicaciones e Interacciones -->
    <div class="container my-5 profile-content">
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="post-card-wrapper rounded ">
                    <div class="card post-card shadow-lg p-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <div class="d-flex align-items-center">
                                    <img src="../public/resources/64572.png" alt="Perfil" class="profile-img">
                                    <div>
                                        <h6 class="mb-0">Juan Martínez</h6>
                                        <small class="text-muted">Publicado el 12/12/2025 a las 13:00</small>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button id="dropdownButton" class="btn btn-dark border-0" type="button"
                                        data-bs-toggle="dropdown">
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

                            <img src="../public/resources\66e956f061db0.png" alt="Imagen publicación"
                                class="post-image shadow-sm">

                            <div class="d-flex mb-2 gap-2 align-items-center">

                                <button id="btnMeGusta" class="btn btn-outline-primary d-flex align-items-center"
                                    type="button">
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
                                        <!-- Contenedor del usuario -->
                                        <div class="comment-user d-flex align-items-center">
                                            <img src="../public/resources/64572.png" alt="Avatar" class="rounded-circle"
                                                width="40" height="40">
                                            <div class="ms-2">
                                                <strong>Ana López</strong><br>
                                                <small class="text-muted">Publicado el 12/12/2025 a las 13:00</small>
                                            </div>
                                        </div>
                                        <!-- Botón de regresar -->
                                        <div class="dropdown">
                                            <button id="dropdownButtonComment" class="btn btn-dark border-0"
                                                type="button" data-bs-toggle="dropdown">
                                                <i id="dropdownIcon" class="fas fa-ellipsis-h text-white"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="#" id="editItemComment">Editar</a>
                                                </li>
                                                <li><a class="dropdown-item" href="#"
                                                        id="deleteItemComment">Eliminar</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <p class="p-3">¡Qué publicación más interesante!</p>
                                    <div class="comment-footer d-flex gap-2 align-items-center mt-2">
                                        <input type="text" class="form-control new-comment-input"
                                            placeholder="Escribe un comentario...">
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

            <div class="col-lg-4">
                <h5 class="mb-3 text-white">Interacciones recientes</h5>
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img src="../public/resources\64572.png" class="rounded-circle me-3" width="50"
                                    height="50">
                                <div>
                                    <strong>Ana López</strong><br>
                                    <small class="text-muted"><i class="fas fa-comment text-success me-1"></i>Comentó el
                                        12/12/2025 a las 13:00</small>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-outline-success" data-bs-toggle="collapse"
                                data-bs-target="#post1">Ver publicación</button>
                        </div>
                        <div class="collapse mt-2" id="post1">
                            <div class="card card-body bg-light">
                                <p><strong>Juan Martínez</strong></p>
                                <img src="../public/resources\66e956f061db0.png" class="img-fluid rounded"
                                    alt="Publicación">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/controls.script.js"></script>
    <script>
        async function loadUserProfile() {
            try {
                const res = await fetch('http://localhost:8000/api/v1/profile');
                const data = await res.json();

                if (!data.success) {
                    alert(data.error);
                    return;
                }

                const user = data.data;

                document.querySelector('.profile-pic img').src = user.FOTO || '../public/resources/64572.png';
                document.querySelector('.profile-hero h1').textContent = user.NOMBRE || '';
                document.querySelector('.profile-hero .lead').innerHTML = `
            <i class="fas fa-calendar-alt me-2"></i>${user.FECHA_NACIMIENTO || ''}
            <i class="fas fa-map-marker-alt ms-4 me-2"></i>${user.PAIS || ''}
            <i class="fas fa-flag ms-4 me-2"></i>${user.NACIONALIDAD || ''}
        `;

                document.getElementById('stat-publicaciones').innerHTML = `<strong>Publicaciones:</strong> ${user.PUBLICACIONESCUENTA || 0}`;
                document.getElementById('stat-likes').innerHTML = `<strong>Me gusta:</strong> ${user.LIKESCUENTA || 0}`;
                document.getElementById('stat-vistas').innerHTML = `<strong>Vistas totales:</strong> ${user.VISTASCUENTA || 0}`;

                document.getElementById('contact-correo').innerHTML = `<strong>Correo:</strong> ${user.CORREO || '--'}`;
                document.getElementById('contact-genero').innerHTML = `<strong>Género:</strong> ${user.GENERO || '--'}`;

                document.getElementById('image-preview').src = user.FOTO || '../public/resources/64572.png';
                document.getElementById('nombre').value = user.NOMBRE || '';
                document.getElementById('fecha').value = user.FECHA_NACIMIENTO || '';
                document.getElementById('pais').value = user.PAIS || '';
                document.getElementById('genero').value = user.GENERO || '';
                document.getElementById('password').value = '';
                document.getElementById('password2').value = '';


                const nacionalidades = (user.NACIONALIDAD || '').split(','); // ["MEX","USA",...]
                const container = document.getElementById("nacionalidades-container");

                container.querySelectorAll("select").forEach((s, i) => { if (i > 0) s.remove(); });

                nacionalidades.forEach((nac, index) => {
                    let select;
                    if (index === 0) {
                        select = container.querySelector("select[name='nacionalidad[]']");
                    } else {
                        select = container.querySelector("select[name='nacionalidad[]']").cloneNode(true);
                        container.appendChild(select);
                    }
                    select.value = nac;
                });



            } catch (err) {
                console.error('Error cargando el perfil:', err);
            }
        }

        loadUserProfile();

    </script>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                const preview = document.getElementById('image-preview');
                preview.src = reader.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        //ADD A NATIONALITY
        document.getElementById("addNacionalidad").addEventListener("click", function () {
            const container = document.getElementById("nacionalidades-container");
            const firstSelect = container.querySelector("select");
            const newSelect = firstSelect.cloneNode(true);
            newSelect.selectedIndex = 0;
            container.appendChild(newSelect);
        });
        //DELETE A NATIONALITY
        document.getElementById("removeNacionalidad").addEventListener("click", function () {
            const container = document.getElementById("nacionalidades-container");
            const selects = container.querySelectorAll("select[name='nacionalidad[]']");
            if (selects.length > 1) {
                selects[selects.length - 1].remove();
            } else {
                alert("Debe quedar al menos una nacionalidad.");
            }
        });



        //Validate password
        document.getElementById("updateButton").addEventListener("click", function (e) {
            e.preventDefault();

            const password = document.getElementById("password").value;
            const password2 = document.getElementById("password2").value;
            const errorDiv = document.getElementById("password-errors");

            const minLength = /.{8,}/;
            const upper = /[A-Z]/;
            const lower = /[a-z]/;
            const number = /[0-9]/;
            const special = /[!@#$%^&*(),.?":{}|<>]/;

            let errors = [];

            if (!minLength.test(password)) errors.push("La contraseña debe tener al menos 8 caracteres.");
            if (!upper.test(password)) errors.push("La contraseña debe contener al menos una mayúscula.");
            if (!lower.test(password)) errors.push("La contraseña debe contener al menos una minúscula.");
            if (!number.test(password)) errors.push("La contraseña debe contener al menos un número.");
            if (!special.test(password)) errors.push("La contraseña debe contener al menos un carácter especial.");
            if (password !== password2) errors.push("Las contraseñas no coinciden.");

            if (errors.length > 0) {
                errorDiv.innerHTML = errors.join("<br>");
                errorDiv.classList.remove("d-none");
                return;
            } else {
                errorDiv.classList.add("d-none");
            }

            this.textContent = "Registro de usuario exitoso";
            this.disabled = true;

            setTimeout(() => {
                this.textContent = "Registrarse";
                this.disabled = false;
                // e.target.form.submit();
            }, 2000);
        });


    </script>
</body>

</html>