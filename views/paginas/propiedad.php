<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad->titulo; ?></h1>
    <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen;?>" alt="imagen de la Propiedad">

    
        
    <div class="resumen-propiedad">
        <p class="precio">Antes: $<?php echo $propiedad->precio;?> COP</p>
        <p class="precio-descuento">Ahora: $<?php echo $propiedad->precio_Descuento;?> COP</p>


        <p><?php echo $propiedad->descripcion; ?>
        </p>

    </div>

    <a href="/?>" class="boton-amarillo-block agregar-carrito" data-id="<?php echo $propiedad->id; ?>" 
  data-nombre="<?php echo $propiedad->titulo;?>" data-precio="<?php echo $propiedad->precio_Descuento; ?>" 
  data-imagen="/imagenes/<?php echo $propiedad->imagen; ?>" data-tipo="<?php echo $propiedad->tipo; ?>">Añadir al carrito</a>

</main>