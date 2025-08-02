<main class="contenedor seccion">
    <h1>Carrito de Compras</h1>

    <table class="propiedades">
        <thead>
            <tr>
                
                <th>Imagen</th>
                <th>Producto</th>
                <th>Precio Unitario</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Descuento</th>
                <th>Eliminar</th>
                
            </tr>
        </thead>
        <tbody id="lista-carrito">

        <!-- Productos se cargarán con JavaScript -->
        </tbody>
    </table>
    <p id="total" style="text-align: right; font-weight: bold;"></p>
    <button id="vaciar-carrito" class="boton-rojo-block">Vaciar carrito</button>
    <a href="/envio"  class="boton boton-verde-block pedido">Confirmar compra</a>
     
</main>