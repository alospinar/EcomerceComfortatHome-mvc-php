<main class="contenedor">
    <h1>administrador de Confort at Home</h1>

    <?php 
        if($resultado){
            $mensaje=mostrarNotificacion(intval($resultado));
            if($mensaje){ ?>
            <p class="alerta exito"> <?php echo s($mensaje)?></p>
            <?php    }
        }
    ?>

    <a href="/propiedades/crear" class="boton boton-verde"> Nuevo producto</a>


    <h2>Productos</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Precio Descuento</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody><!-- mostrar los resultados -->
            <?php foreach($propiedades as $propiedad): ?>
            <tr>
                <td> <?php echo $propiedad->id; ?></td>
                <td><?php echo $propiedad->titulo; ?></td>
                <td><img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"></td>
                <td>$<?php echo $propiedad->precio; ?> COP</td>
                <td>$<?php echo $propiedad->precio_Descuento; ?> COP</td>
                <td>
                    <form method="POST" class="W-100" action="/propiedades/eliminar">
                        <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                        <input type="hidden" name="tipo" value="propiedad">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    
                    <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</main>