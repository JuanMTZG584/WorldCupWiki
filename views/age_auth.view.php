<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>World Cup Wiki - Verificación de edad</title>
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
                    <div class="card-body p-4 p-md-5 shadow-lg position-relative">

                        <div class="mb-5 text-center">
                            <h3>Verificación de Edad</h3>
                            <p class="text-muted">Por favor, ingresa tu fecha de nacimiento para continuar</p>
                        </div>


                        <div id="error-msg" class="alert alert-danger <?= !empty($error) ? '' : 'd-none' ?>"
                            role="alert">
                            <?= htmlspecialchars($error ?? '') ?>
                        </div>

                        <form id="age-form" method="POST" action="">
                            <div class="mb-4">
                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control form-control-sm" id="fecha_nacimiento"
                                    name="fecha_nacimiento" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark btn-sm w-100">
                                    Continuar
                                </button>
                            </div>
                        </form>

                        <div class="mt-5">
                            <hr class="border-dark mb-4">
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a class="navbar-brand ps-3 pe-3" href="/">
                                <img src="../public/resources/WCW-Logo.svg" alt="Logo" id="logo-nav"
                                    style="height: 40px;">
                            </a>
                            <div>
                                <a href="/login" class="link-dark text-decoration-none me-3">Iniciar Sesión</a>
                                <a href="/sign_up" class="link-dark text-decoration-none">Registrarse</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        document.getElementById("age-form").addEventListener("submit", function (event) {
            const fechaInput = document.getElementById("fecha_nacimiento");
            const errorMsg = document.getElementById("error-msg");
            const fechaNacimiento = new Date(fechaInput.value);
            const hoy = new Date();

            if (isNaN(fechaNacimiento)) {
                errorMsg.textContent = "Por favor, ingresa una fecha válida.";
                errorMsg.classList.remove("d-none");
                event.preventDefault();
                return;
            }

            let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
            const mes = hoy.getMonth() - fechaNacimiento.getMonth();
            if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
                edad--;
            }

            if (edad < 12) {
                errorMsg.textContent = "Debes tener al menos 12 años para continuar.";
                errorMsg.classList.remove("d-none");
                event.preventDefault();
            } else {
                errorMsg.classList.add("d-none");
            }
        });
    </script>

    <script src="../public/js/bootstrap.bundle.min.js"></script>
</body>

</html>