<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión </title>
  
    <link rel="stylesheet" href="../sources/css/login.css">
    <link rel="stylesheet" href="../sources/css/nav.css">
</head>
<body>
    <header class="main_header">
       
        <span id="NavArrow"></span>
        <div class="header_login" data-messages="Dashboard">
            <a href="../dashboard.php">Dashboard</a>
        </div>
    </header>
    
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="#">
                <h1>Crear tu cuenta</h1>

                <span>o usa tu email para registrarte</span>
                <div class="infield">
                    <input type="text" placeholder="Nombre" />
                    <label></label>
                </div>
                <div class="infield">
                    <input type="email" placeholder="Email" name="email"/>
                    <label></label>
                </div>
                <div class="infield">
                    <input type="password" placeholder="Contraseña" />
                    <label></label>
                </div>
                <button>Registrarse</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="#">
                <h1>Iniciar Sesión</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span> Usa tu cuenta</span>
                <div class="infield">
                    <input type="email" placeholder="Email" name="email"/>
                    <label></label>
                </div>
                <div class="infield">
                    <input type="password" placeholder="Contraseña" />
                    <label></label>
                </div>
                <a href="#" class="forgot">¿Olvistaste tu contraseña?</a>
                <button>Iniciar Sesión</button>
            </form>
        </div>
        <div class="overlay-container" id="overlayCon">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>¡Bienvenid@!</h1>
                    <p>Inicia sesión con tus datos personales</p>
                    <button>Iniciar Sesión</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>¡Hola!</h1>
                    <p>Ingresa tus datos para una mejor experiencia en JEMAS</p>
                    <button>Registrarse</button>
                </div>
            </div>
            <button id="overlayBtn"></button>
        </div>
    </div>

  
    
    <!-- JS -->
    <script>
       const container = document.getElementById('container');
       const overlayCon = document.getElementById('overlayCon');
       const overlayBtn = document.getElementById('overlayBtn');

        overlayBtn.addEventListener('click', ()=> {
            container.classList.toggle('right-panel-active');

            overlayBtn.classList.remove('btnScaled');
            window.requestAnimationFrame(()=> {
                overlayBtn.classList.add('btnScaled');
            })
        });
    </script>

</body>
</html>
