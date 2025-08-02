
<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad) { ?>
    <div class="anuncio">

        <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen;?>" alt="anuncio" class=".img-ajustada">  


        <div class="contenido-anuncio">
            <h3><?php echo $propiedad->titulo;?></h3>
            <p> <?php echo $propiedad->descripcion;?></p>
            <p class="precio">$ <?php echo $propiedad->precio;?> COP </p>
            <p class="precio-descuento">$ <?php echo $propiedad->precio_Descuento;?> COP </p>

            <a href="/propiedad?id=<?php echo $propiedad->id;?>" class="boton-amarillo-block">
                Ver Producto
            </a>
        </div><!-- contenido-anuncio -->
    </div><!-- anuncio -->
    <?php } ?>
</div><!-- contenedor-anuncio -->
