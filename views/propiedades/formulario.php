<fieldset>
    <legend>Informacion general </legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo propiedad" value="<?php echo s($propiedad->titulo); ?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio propiedad" value="<?php echo s($propiedad->precio); ?>">

    <label for="precio_Descuento">Precio Descuento:</label>
    <input type="number" id="precio_Descuento" name="propiedad[precio_Descuento]" placeholder="Precio Descuento" value="<?php echo s($propiedad->precio_Descuento); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen"  accept="image/jpeg, image/png" name="propiedad[imagen]">
    <?php if($propiedad->imagen){ ?>
        <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small">
    <?php     }?>
    <label for="descripcion">Descripcion</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion); ?></textarea>
    
    <label for='tipo'>Tipo de producto</label>
    <select name="propiedad[tipo]" id='tipo'>
        <option value="">--Seleccione--</option>
        <?php foreach(['sabana','colcha','cuadro','No aplica'] as $vendedor) { ?>
            <option 
                value="<?php echo s($vendedor); ?>"
                <?php echo ($propiedad->tipo === $vendedor) ? 'selected' : ''; ?>>
                <?php echo s($vendedor); ?>
            </option>
        <?php } ?>
    </select>

</fieldset>




</fieldset>