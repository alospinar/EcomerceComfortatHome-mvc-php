<main class="contenedor">
    <h1>Confirmar Comprar</h1>
    
    <?php if($mensaje){ ?>
                <p class="alerta exito"> <?php echo $mensaje; ?></p>
    <?php } ?>
    

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada2.jpg" alt="imagen contacto">
    </picture>

    
    <h2>Productos seleccionados</h2>
    <div id="productos-confirmacion">
    
    
    </div>
    

    

    <h2>Llene el formulario de Contacto</h2>
    <form class="formulario" action="/envio" method="POST">
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
        </fieldset>
        <!-- ✅ Nuevos inputs ocultos para el total y descuento -->
        <input type="hidden" name="contacto[total_final]" id="input-total">
        <input type="hidden" name="contacto[descuento_aplicado]" id="input-descuento">
        <input type="hidden" name="contacto[productos]" id="productos-carrito">
        <input type="submit" value="Enviar" class="boton-verde">
    </form>
    <script>
        document.querySelector('.formulario').addEventListener('submit', function(e) {
            // Limpia el carrito del localStorage
            localStorage.removeItem('carrito');
        });
    </script>
</main>