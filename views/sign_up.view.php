<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wold Cup Wiki - Registro</title>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/all.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
    <div class="background bg-dark">
        <img src="../public/resources/photo-1434648957308-5e6a859697e8.jpg" alt="Fondo">
    </div>
    <section class="p-3 p-md-4 p-xl-5 d-flex align-items-center min-vh-100 fade-in shadow-lg">
        <div class="container">
            <div class="card shadow-sm">
                <div class="row g-0">
                    <!-- Formulario Registro -->
                    <div class="card-body p-3 p-md-4 p-xl-5 shadow-lg">
                        <div class="mb-5">
                            <h3>Registrate</h3>
                        </div>

                        <a href="/" class="position-absolute top-0 end-0 m-3 text-dark text-decoration-none">
                            <i class="fa-solid fa-x fa-lg" aria-hidden="true"></i>
                        </a>

                        <form action="#!">

                            <div class="mb-3 text-center">
                                <img id="image-preview" src="" alt="Vista previa de la imagen" class="img-fluid"
                                    style="max-height:150px;">
                            </div>

                            <div class="mb-3">
                                <label for="profile-image" class="form-label">Imagen de perfil</label>
                                <input type="file" class="form-control form-control-sm" id="profile-image"
                                    accept="image/*" onchange="previewImage(event)" required>
                            </div>

                            <div class="row gx-2 mb-3">
                                <div class="col-md-6">
                                    <label for="nombre" class="form-label">Nombre Completo</label>
                                    <input type="text" class="form-control form-control-sm" id="nombre"
                                        placeholder="Nombre Completo" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="correo" class="form-label">Correo Electrónico</label>
                                    <input type="email" class="form-control form-control-sm" id="correo"
                                        placeholder="Correo Electrónico" required>
                                </div>
                            </div>

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
                                    <button type="button" id="addNacionalidad"
                                        class="btn btn-dark btn-sm mt-1">
                                        Agregar otra nacionalidad
                                    </button>
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

                            <!-- Botón registrar -->
                            <div class="d-grid">
                                <button id="registerButton" type="submit"
                                    class="btn btn-dark btn-sm w-100">Registrarse</button>
                            </div>
                        </form>



                        <div class="row mt-4 align-items-center">

                            <hr class="border-dark mb-4">

                            <div class="col-6 col-md-6">
                                <a class="navbar-brand ps-3 pe-3" href="#">
                                    <img src="../public/resources/WCW-Logo.svg" alt="Logo" id="logo-nav">
                                </a>
                            </div>

                            <div class="col-6 col-md-6 d-flex justify-content-end">
                                <a href="login" class="link-dark text-decoration-none">Iniciar Sesión</a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <script src="../public/js/bootstrap.bundle.min.js"></script>
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

        document.getElementById("registerButton").addEventListener("click", function () {

            this.textContent = "Registro de usuario exitoso";
            this.disabled = true;

            setTimeout(() => {
                this.textContent = "Registrarse";
                this.disabled = false;
            }, 2000);
        });

        //Dynamically add combobox to select nationality
        document.getElementById("addNacionalidad").addEventListener("click", function () {
            const container = document.getElementById("nacionalidades-container");

            const firstSelect = container.querySelector("select");
            const newSelect = firstSelect.cloneNode(true);
            newSelect.selectedIndex = 0;

            container.appendChild(newSelect);
        });


    </script>
</body>

</html>