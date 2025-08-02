<?php
    if(!isset($_SESSION)){
        session_start();
    }
    $auth = $_SESSION['login'] ?? false;
    if(!isset($inicio)){
        $inicio=false;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confort at Home</title>
    <link rel="stylesheet" href="../build/css/app.css">

</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">

            <div class="barra">

                <a href="/">
                    <img src="/build/img/logo CH.png" alt="logotipo de Bienes Raices">
                </a>
            
               <div class="mobile-menu">
                    <img  src="/build/img/barras.svg" alt="icono menu responsive">

                </div>
                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg">
                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros </a>
                        <a href="/propiedades">Productos</a>             
                        <a href="/contacto">Contacto</a>

                                                 
                        <?php if($auth): ?>
                            <a href="/logout">Cerrar Sesion</a>
                        <?php endif ; ?>
                    </nav>
                    <div class="carrito-contenedor">
                        <img class="carrito-boton" src="https://cdn-icons-png.flaticon.com/512/107/107831.png" alt="Carrito">
                        <span id="cantidad-carrito">0</span>
                    </div>

                </div>

            </div> <!-- barra -->

        </div>

            
            
        
    </header>
    <?php if($inicio) { ?> <h1>Productos de lujo exclusivos para tu hogar</h1> <?php } ?>
    <?php echo $contenido; ?>
    <a href="https://wa.me/573002071357?text=Hola%2C%20estoy%20interesado%20en%20uno%20de%20sus%20productos" 
    class="whatsapp-float" 
    target="_blank" 
    title="Escríbenos por WhatsApp">
    <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/whatsapp.svg" alt="WhatsApp" />
    </a>
    <footer class="footer seccion">
    <div class="contenedor contenedor-footer">
        <nav class="navegacion ">
            <a href="/nosotros">Nosotros </a>
            <a href="/propiedades">Productos</a>           
            <a href="/contacto">Contacto</a>
        </nav>
    </div>

    <p class="copyright">Todos los derechos reservados <?php echo date('Y');?> &copy;</p>
    </footer>
    <script src="../build/js/bundle.min.js"></script>

    
</body>
</html>