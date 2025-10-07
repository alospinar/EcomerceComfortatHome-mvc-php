<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuadros Gobelinos</title>
    <link rel="stylesheet" href="../build/css/app.css">
    <link rel="icon" type="image/png" href="/build/img/logo%20CH.png">
    <!-- Meta Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1135729121854307');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1135729121854307&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Meta Pixel Code -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Eventos personalizados del sitio -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // 🎯 2️⃣ Evento: cuando se abre el modal de pago
        const modalPago = document.querySelector('#modalPago');
        const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (!modalPago.classList.contains('oculto')) {
            fbq('track', 'AddPaymentInfo');
            }
        });
        });
        if (modalPago) {
        observer.observe(modalPago, { attributes: true, attributeFilter: ['class'] });
        }

        // 🎯 3️⃣ Evento: cuando el usuario envía el formulario de pago
        const formPago = document.querySelector('#formPago');
        if (formPago) {
        formPago.addEventListener('submit', function() {

            // Obtiene los datos seleccionados para enviar a Meta
            const tamano = document.querySelector('#tamano')?.value || '';
            const cuadro = document.querySelector('input[name="contacto[cuadro]"]:checked')?.value || '';

            fbq('track', 'Purchase', {
            content_name: cuadro || 'Cuadro Gobelino',
            content_category: tamano || 'Sin especificar',
            value: 279900, // 💰 puedes cambiar dinámicamente este valor si tienes varias opciones
            currency: 'COP'
            });
        });
        }

    });
    </script>
</head>
<body class="pagina-cuadros">
    <header>
        <img src="/build/img/logo CH.png" alt="logotipo de Bienes Raices" class="logo">
        <div class="header-tagline">
            <div class="tagline-black">importada, original y al mejor precio</div>
            <div class="tagline-yellow">cuadros 100% originales contraentrega a todo el pais</div>
        </div>
        <a href="https://wa.me/573002071357?text=Hola%2C%20estoy%20interesado%20en%20uno%20de%20sus%20productos" 
        class="whatsapp-float" 
        target="_blank" 
        title="Escríbenos por WhatsApp">
        <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/whatsapp.svg" alt="WhatsApp" />
        </a>
    </header>
    
    <main>
        <?php if (isset($mensaje) && $mensaje): ?>
            <script>
                Swal.fire({
                    icon: '<?= strpos($mensaje, "correctamente") !== false ? "success" : "error" ?>',
                    title: 'Resultado del Pedido',
                    text: '<?= $mensaje ?>',
                    confirmButtonText: 'OK'
                });
            </script>
        <?php endif; ?>
        <!-- Sección 1 -->
        <section class="seccion1">
            <div class="container">
                
                <div class="imagen carousel" aria-roledescription="carousel">
                    <div class="carousel-track">
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro11.webp" alt="Cuadro Gobelino 1" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro10.webp" alt="Cuadro Gobelino 2" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro9.webp" alt="Cuadro Gobelino 3" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro12.webp" alt="Cuadro Gobelino 4" class="logo">
                        </div>
                    </div>
                    <button class="carousel-btn prev" aria-label="Anterior">‹</button>
                    <button class="carousel-btn next" aria-label="Siguiente">›</button>
                    <div class="carousel-dots" role="tablist" aria-label="Paginación"></div>
                </div>
                
                <div class="columna contenido">
                    <div class="calificacion-cliente">
                        <div class="estrellas">
                            <img src="/build/img/star.svg" alt="Estrella" class="estrella">
                            <img src="/build/img/star.svg" alt="Estrella" class="estrella">
                            <img src="/build/img/star.svg" alt="Estrella" class="estrella">
                            <img src="/build/img/star.svg" alt="Estrella" class="estrella">
                            <img src="/build/img/star.svg" alt="Estrella" class="estrella">
                        </div>
                        <span class="texto-clientes">+200 clientes satisfechos</span>
                    </div>
                    <h2>Cuadros Gobelinos en tapiz Grandes</h2>
                    <p>Medidas: 1,20 cm alto x 70cm ancho </p>
                    <ul>
                        <li>Arcángel san Miguel</li>
                        <li>Virgen de Guadalupe</li>
                        <li>El Señor de la misericordia</li>
                        <li>La última cena</li>
                    </ul>

                    <!-- Contenedor de Descuentos -->
                    <div class="descuento-llamativo">
                        <span class="descuento-titulo">¡Descuento especial!</span>
                        <p class="descuento-texto">Aprovecha un <strong>13% de descuento</strong> en tu primer cuadro gobelino. Solo por tiempo limitado.</p>
                    </div>

                    <!-- Contenedor Antes y Después -->
                    <div class="antes-despues-llamativo">
                        <span class="ad-titulo">Precio en Oferta!!</span>
                        <div class="ad-contenido">
                            <div class="ad-col ad-antes">
                                <span class="ad-labAel">Antes</span>
                                <span class="precio-antes-grande">
                                    349.000 COP
                                </span>
                                <svg class="tachado-grande" viewBox="0 0 60 60" width="60" height="60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <line x1="10" y1="10" x2="50" y2="50" stroke="#ff0000" stroke-width="8" stroke-linecap="round"/>
                                    <line x1="50" y1="10" x2="10" y2="50" stroke="#ff0000" stroke-width="8" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <div class="ad-col ad-despues">
                                <span class="ad-label">Ahora</span>
                                <span class="precio-ahora-grande">279.900 COP</span>
                            </div>
                        </div>
                    </div>
                    <div class="icono-pequeño">
                        <img src="/build/img/imagengaratizada.png" alt="Garantia" class="icono-img">
                    </div>
                    <a  class="btn btn-comprar">Comprar Ahora!</a>
                </div>
            </div>
        </section>
        
        <!-- Sección 2 -->
        <section>
            <div class="container">
                <div class="columna contenido">
                    <h2>Cuadros Gobelinos en tapiz MEDIANOS</h2>
                    <p>Medidas: 100cm alto x 58 cm de ancho.</p>
                    <ul>
                        <li> Sagrado corazón de Jesús</li>
                        <li> La última cena</li>
                        <li>El Señor de la misericordia</li>
                        <li>virgen del Carmen</li>
                        <li>El divino niño</li>
                        <li>El buen pastor </li>
                        <li>Virgen de la Milagrosa</li>
                        <li>Virgen de la Carmen </li>
                    </ul>
                    <div class="antes-despues-llamativo">
                        <span class="ad-titulo">Precio en Oferta!!</span>
                        <div class="ad-contenido">
                            <div class="ad-col ad-antes">
                                <span class="ad-label">Antes</span>
                                <span class="precio-antes-grande">
                                    299.900 COP
                                </span>
                                <svg class="tachado-grande" viewBox="0 0 60 60" width="60" height="60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <line x1="10" y1="10" x2="50" y2="50" stroke="#ff0000" stroke-width="8" stroke-linecap="round"/>
                                    <line x1="50" y1="10" x2="10" y2="50" stroke="#ff0000" stroke-width="8" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <div class="ad-col ad-despues">
                                <span class="ad-label">Ahora</span>
                                <span class="precio-ahora-grande">259.900 COP</span>
                            </div>
                        </div>
                    </div>
                    <a  class="btn btn-comprar">Comprar Ahora con envios nacionales!</a>
                </div>
                
                <div class="imagen carousel" aria-roledescription="carousel">
                    <div class="carousel-track">
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro13.webp" alt="Cuadro Gobelino 1" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro14.webp" alt="Cuadro Gobelino 2" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro15.webp" alt="Cuadro Gobelino 3" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro16.webp" alt="Cuadro Gobelino 4" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro17.webp" alt="Cuadro Gobelino 5" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro18.webp" alt="Cuadro Gobelino 6" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro19.webp" alt="Cuadro Gobelino 7" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro20.webp" alt="Cuadro Gobelino 8" class="logo">
                        </div>
                    </div>
                    <button class="carousel-btn prev" aria-label="Anterior">‹</button>
                    <button class="carousel-btn next" aria-label="Siguiente">›</button>
                    <div class="carousel-dots" role="tablist" aria-label="Paginación"></div>
                </div>
                
            </div>
        </section>
        
        <!-- Sección 3 -->
        <section class="seccion1">
            <div class="container">
                <div class="imagen carousel" aria-roledescription="carousel">
                    <div class="carousel-track">
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro1.webp" alt="Cuadro Gobelino 1" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro2.webp" alt="Cuadro Gobelino 2" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro3.webp" alt="Cuadro Gobelino 3" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro4.webp" alt="Cuadro Gobelino 4" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro5.webp" alt="Cuadro Gobelino 5" class="logo">
                        </div>
                    </div>
                    <button class="carousel-btn prev" aria-label="Anterior">‹</button>
                    <button class="carousel-btn next" aria-label="Siguiente">›</button>
                    <div class="carousel-dots" role="tablist" aria-label="Paginación"></div>
                </div>
                <div class="columna contenido">
                    <h2 class="tituloc">Caracteristicas</h2>
                    
                    <title>Acordeón funcional</title>
                    <div class="acordeon">
                        <div class="acordeon-item">
                            <button class="acordeon-header">¿Cuál es el Material?</button>
                            <div class="acordeon-content">
                                <p>100% poliéster</p>
                            </div>
                        </div>
                        <div class="acordeon-item">
                            <button class="acordeon-header">¿Cuál es el Diseño?</button>
                            <div class="acordeon-content">
                                <p>Impresión digital de alta calidad</p>
                            </div>
                        </div>
                        <div class="acordeon-item">
                            <button class="acordeon-header">¿como es el acabado?</button>
                            <div class="acordeon-content">
                                <p>Bordado a mano</p>
                            </div>
                        </div>
                        <div class="acordeon-item">
                            <button class="acordeon-header">Uso</button>
                            <div class="acordeon-content">
                                <p>Decoración de interiores</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        
        <section>
            <div class="container">
                <div class="columna contenido">
                    <h2>Nuestros Clientes</h2>
                    <div class="clientes-lista">
                        <div class="cliente-item">
                            <img src="build/img/clientes.jpg" alt="Cliente 1" loading="lazy">
                            
                        
                    </div>
                    <div class="icono-certificado">
                        <img src="/build/img/logsic.png" alt="logsic" >
                        <img src="/build/img/camaraC.png" alt="camaraC" >
                    </div>
                </div>
            </div>
        </section>
    <!-- Modal -->
<div id="modalPago" class="modal oculto">
  <div class="modal-contenido">
    <button type="button" id="cerrarModal" class="cerrar">❌</button>

    <img src="/build/img/logo CH.png" alt="logotipo de Bienes Raices" class="logo">
    <h2>Formulario de pago</h2>
    <form id="formPago" class="formulario" action="/cuadrosgobelinos" method="POST">
        <fieldset>
            <legend> informacion Personal</legend>

            <label for="nombre">Nombre Completo</label>
            <input type="text" placeholder="Tu Nombre completo" id="nombre" name="contacto[nombre]" required >
            <label for="cedula">Cedula</label>
            <input type="text" placeholder="Tu C.C." id="cedula" name="contacto[cedula]"required >            
            <label for="celular">Telefono</label>
            <input type="tel" placeholder="Tu telefono" id="celular" name="contacto[celular]" required>            
            <label for="ciudad">Ciudad</label>
            <input type="text"  id="ciudad" name="contacto[ciudad]" required>    

            <label for="departamento">Departamento</label>
            <input type="text"  id="departamento" name="contacto[departamento]"    required>            

            <label for="direccion">Dirección:</label>
            <textarea id="direccion" name="contacto[direccion]" required></textarea>

            <!-- Selección de tamaño -->
            <label for="tamano">Tamaño del cuadro:</label>
            <select id="tamano" name="contacto[tamano]" required>
                <option value="">Selecciona...</option>
                <option value="grande">Grande</option>
                <option value="mediano">Mediano</option>
            </select>

            <!-- Opciones de cuadros -->
            <div id="opcionesGrandes" class="opciones oculto" >

                <label for="cuadro1">Arcángel San Miguel</label><input type="radio" id="cuadro1" name="contacto[cuadro]" value="Arcángel San Miguel">
                <label for="cuadro2">Virgen de Guadalupe</label><input type="radio" id="cuadro2" name="contacto[cuadro]" value="Virgen de Guadalupe">
                <label for="cuadro3">El Señor de la misericordia</label><input type="radio" id="cuadro3" name="contacto[cuadro]" value="El Señor de la misericordia">
                <label for="cuadro4">La última cena</label><input type="radio" id="cuadro4" name="contacto[cuadro]" value="La última cena">

                <div class="imagen carousel" aria-roledescription="carousel">
                    <div class="carousel-track">
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro11.webp" alt="Cuadro Gobelino 1" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro10.webp" alt="Cuadro Gobelino 2" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro9.webp" alt="Cuadro Gobelino 3" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro12.webp" alt="Cuadro Gobelino 4" class="logo">
                        </div>
                    </div>
                    <button type="button" class="carousel-btn prev" aria-label="Anterior">‹</button>
                    <button type="button" class="carousel-btn next" aria-label="Siguiente">›</button>
                    <div class="carousel-dots" role="tablist" aria-label="Paginación"></div>
                </div>
            </div>

            <div id="opcionesMedianos" class="opciones oculto" >

                <label for="cuadro5">Sagrado corazón de Jesús</label><input type="radio" id="cuadro5" name="contacto[cuadro]" value="Sagrado corazón de Jesús">
                <label for="cuadro6">La última cena</label><input type="radio" id="cuadro6" name="contacto[cuadro]" value="La última cena"> 
                <label for="cuadro7">Señor de la misericordia</label><input type="radio" id="cuadro7" name="contacto[cuadro]" value="Señor de la misericordia">
                <label for="cuadro8">Virgen del Carmen</label><input type="radio" id="cuadro8" name="contacto[cuadro]" value="Virgen del Carmen">
                <label for="cuadro9">Virgen de Guadalupe </label><input type="radio" id="cuadro9" name="contacto[cuadro]" value="Virgen de Guadalupe">
                <label for="cuadro10">Virgen de la Milagrosa</label><input type="radio" id="cuadro10" name="contacto[cuadro]" value="Virgen de la Milagrosa">
                <label for="cuadro11">El buen pastor </label><input type="radio" id="cuadro11" name="contacto[cuadro]" value="El buen pastor">
                <label for="cuadro12">El divino niño</label><input type="radio" id="cuadro12" name="contacto[cuadro]" value="El divino niño">


                <div class="imagen carousel" aria-roledescription="carousel">
                    <div class="carousel-track">
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro13.webp" alt="Cuadro Gobelino 1" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro14.webp" alt="Cuadro Gobelino 2" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro15.webp" alt="Cuadro Gobelino 3" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro16.webp" alt="Cuadro Gobelino 4" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro17.webp" alt="Cuadro Gobelino 5" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro18.webp" alt="Cuadro Gobelino 6" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro19.webp" alt="Cuadro Gobelino 7" class="logo">
                        </div>
                        <div class="carousel-slide">
                            <img src="/build/img/cuadro20.webp" alt="Cuadro Gobelino 8" class="logo">
                        </div>
                    </div>
                    <button type="button" class="carousel-btn prev" aria-label="Anterior">‹</button>
                    <button type="button" class="carousel-btn next" aria-label="Siguiente">›</button>
                    <div class="carousel-dots" role="tablist" aria-label="Paginación"></div>
                </div>
            </div>
        </fieldset>
    <button type="submit">Confirmar pago</button>
    </form>
  </div>
</div>
    </main>
<script src="../build/js/bundle.min.js"></script>

</body>


</html>