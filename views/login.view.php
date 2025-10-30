<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>World Cup Wiki - Inicio de Sesión</title>

    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/all.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
    <div class="background bg-dark">
        <img src="../public/resources/photo-1434648957308-5e6a859697e8.jpg" alt="Fondo">
    </div>

    <!-- Tarjeta -->
    <section class="p-3 p-md-4 p-xl-5 d-flex align-items-center min-vh-100 fade-in shadow-lg rounded">
        <div class="container">
            <div class="card shadow-sm">
                <div class="row g-0 rounded">

                    <!-- Información -->
                    <div class="col-12 col-md-6 bg-dark text-white shadow-lg">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div class="col-10 col-xl-8 py-3">

                                <img class="img-fluid rounded mb-4 logo-img" loading="lazy"
                                    src="../public/resources/WCW-Logo.svg" width="245" height="80" alt="Logo">

                                <hr class="mb-4">

                                <h2 class="h1 mb-4">En WC Wiki lo que nos une es nuestro amor por la pelota.</h2>

                                <p class="lead m-0">La mejor página web especializada en la recolección de contenido
                                    multimedia histórico de la Copa Mundial de Fútbol.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Lado derecho -->
                    <div class="col-12 col-md-6">
                        <div class="card-body p-3 p-md-4 p-xl-5 shadow-lg">

                            <div class="mb-5">
                                <h3>Inicia sesión ahora</h3>
                            </div>

                            <a href="/" class="position-absolute top-0 end-0 m-3 text-dark text-decoration-none">
                                <i class="fa-solid fa-x fa-lg" aria-hidden="true"></i>
                            </a>

                            <div id="statusMessage" class="alert d-none text-center" role="alert"></div>

                            <!-- Formulario -->
                            <form action="/login" method="POST" id="loginForm">
                                <div class="row gy-3 gy-md-4 overflow-hidden">

                                    <div class="col-12">
                                        <label for="correo" class="form-label">Correo Electrónico <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="correo" id="correo"
                                            placeholder="Ingrese su correo" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="password" class="form-label">Contraseña <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Ingrese contraseña" required>
                                    </div>

                                    <div class="col-12 position-relative">
                                        <div class="d-grid">
                                            <button id="loginButton" class="btn btn-dark btn-lg" type="submit">
                                                Iniciar Sesión
                                            </button>
                                            <!-- Spinner centrado -->
                                            <div id="spinner"
                                                class="spinner-border text-primary position-absolute top-50 start-50 translate-middle d-none"
                                                role="status" style="width: 2rem; height: 2rem;">
                                                <span class="visually-hidden">Cargando...</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <hr class="border-dark mb-4">
                                    <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                                        <a href="sign_up" class="link-dark text-decoration-none">Crear cuenta</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const correo = document.getElementById('correo').value.trim();
            const password = document.getElementById('password').value.trim();
            const statusBox = document.getElementById('statusMessage');
            const spinner = document.getElementById('spinner');
            const loginButton = document.getElementById('loginButton');

            statusBox.classList.add('d-none');

            try {
                // Mostrar spinner y desactivar botón
                spinner.classList.remove('d-none');
                loginButton.disabled = true;
                loginButton.textContent = "Cargando...";

                const res = await fetch('http://localhost:8000/api/v1/login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ correo, password })
                });

                const data = await res.json();

                statusBox.classList.remove('d-none');
                statusBox.classList.add('alert', 'text-center');

                if (data.success) {
                    statusBox.classList.remove('alert-danger');
                    statusBox.classList.add('alert-success');
                    statusBox.textContent = data.message || 'Inicio de sesión exitoso';
                    setTimeout(() => window.location.href = '/', 1500);
                } else {
                    statusBox.classList.remove('alert-success');
                    statusBox.classList.add('alert-danger');
                    statusBox.textContent = data.error || 'Credenciales inválidas';
                }

            } catch (err) {
                statusBox.classList.remove('d-none');
                statusBox.classList.add('alert', 'alert-danger', 'text-center');
                statusBox.textContent = 'Error de conexión con el servidor.';
            } finally {
                // Ocultar spinner y reactivar botón
                spinner.classList.add('d-none');
                loginButton.disabled = false;
                loginButton.textContent = "Iniciar Sesión";
            }
        });
    </script>

</body>
</html>
