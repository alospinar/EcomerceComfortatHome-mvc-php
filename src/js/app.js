document.addEventListener('DOMContentLoaded',function(){
    redirigirAlCarrito();
    inicializarCarrito();
    eventListeners();
    darkMode();
    mostrarCarrito();
    carritoPedido();
    
    

});

function darkMode(){
    
    const prefiereDarkMode= window.matchMedia('(prefers-color-scheme: dark)');
    /* console.log(prefiereDarkMode.matches); */

    if(prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change',function() {
        if(prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });
    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click',function() {
        document.body.classList.toggle('dark-mode');
    });
}

function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click',navegacionResponsive);
    
    //Muestra campos conditionales
    const metodoContacto =document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input=>input.addEventListener('click',mostrarMetodosContacto))
}

function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');

    if(navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');
    }
}
function mostrarMetodosContacto(e){
    const contactoDiv = document.querySelector('#contacto');

    if(e.target.value==='telefono'){
        contactoDiv.innerHTML=`
            <label for="telefono">Numero telefono</label>
            <input type="tel" placeholder="Tu Telefono" id="telefono" name="contacto[telefono] required">


            <p>Elija la fecha y la hora para la llamada</p>

            <label for="fecha">Fecha</label>
            <input type="date"  id="fecha" name="contacto[fecha]" required>

            <label for="hora">Hora</label>
            <input type="time"  id="hora" min="09:00" max="18:00" name="contacto[hora]" required>
                
        `;
    }else{
        contactoDiv.innerHTML=`
            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu Email" id="email" name="contacto[email]" required >
        `;
    };
};

function inicializarCarrito() {
    const spanCantidad = document.getElementById("cantidad-carrito");
    let productos = [];

    try {
        const data = JSON.parse(localStorage.getItem("carrito"));
        if (Array.isArray(data)) {
            productos = data;
        }
    } catch (error) {
        console.warn("Carrito corrupto, reiniciando");
        localStorage.removeItem("carrito");
    }

    // Actualiza contador al cargar
    if (spanCantidad) {
        spanCantidad.textContent = productos.length;
    }

    const botonesAgregar = document.querySelectorAll("a.agregar-carrito");
    botonesAgregar.forEach(function (enlace) {
        enlace.addEventListener("click", function (evento) {
            evento.preventDefault();
            
            const id = this.dataset.id;
            const nombre = this.dataset.nombre;
            const precio = this.dataset.precio;
            const imagen = this.dataset.imagen;
            const tipo = this.dataset.tipo;
            const cantidad = 1;
            

            // Validación: id y nombre deben existir
            if (!id || !nombre) {
                console.warn("Faltan datos del producto");
                return;
            }

            // Evitar agregar duplicados
            const existe = productos.some(p => p.id === id);
            if (!existe) {
                productos.push({ id, nombre,precio,imagen,tipo,cantidad });
                localStorage.setItem("carrito", JSON.stringify(productos));
            }

            // Actualizar contador
            if (spanCantidad) {
                spanCantidad.textContent = productos.length;
            }

            // Redirigir a la página principal
            window.location.href = "/";
        });
    });
};

function mostrarCarrito() {
    const contenedor = document.getElementById("lista-carrito");
    const totalEl = document.getElementById("total");
    const btnVaciar = document.getElementById("vaciar-carrito");

    if (!contenedor || !totalEl) return;

    let carrito = JSON.parse(localStorage.getItem("carrito")) || [];

    const calcularDescuento = (cantidad,tipo) =>{
        if (tipo === "cuadro" || tipo === "No Aplica") {
            return 0; // No aplicar descuento
        }
        return cantidad >= 6 ? 0.15 : 
               cantidad >= 3 ? 0.10 : 
               cantidad >= 2 ? 0.05 : 0;
        };

    const agruparPorTipo = () => {
        const agrupado = {};
        carrito.forEach(p => {  
            if (p.tipo !== "cuadro" && p.tipo !== "No Aplica") {
                agrupado[p.tipo] = (agrupado[p.tipo] || 0) + p.cantidad;
            }
        });
        return agrupado;
    };

    const actualizarTotal = () => {
        const porTipo = agruparPorTipo();
        let total = 0, descuentoTotal = 0;

        carrito.forEach(p => {
            
            const desc = calcularDescuento(porTipo[p.tipo]||0,p.tipo);
            total += p.precio * p.cantidad;
            descuentoTotal += p.precio * p.cantidad * desc;
        });

        const totalFinal = total - descuentoTotal;
        totalEl.textContent = `Total: $${totalFinal.toLocaleString()} COP`;

        localStorage.setItem("carrito", JSON.stringify(carrito));
        localStorage.setItem("totalConDescuento", totalFinal.toFixed(0));
        localStorage.setItem("descuentoAplicado", descuentoTotal.toFixed(0));
    };

    const renderCarrito = () => {
        contenedor.innerHTML = "";

        if (carrito.length === 0) {
            contenedor.innerHTML = "<tr><td colspan='7'>El carrito está vacío.</td></tr>";
            totalEl.textContent = "";
            return;
        }

        const porTipo = agruparPorTipo();

        carrito.forEach((p, i) => {
            const desc = calcularDescuento(porTipo[p.tipo]||0,p.tipo);
            const subtotal = p.precio * p.cantidad;
            const descuento = subtotal * desc;
            const total = subtotal - descuento;

            const fila = document.createElement("tr");
            fila.innerHTML = `
                <td><img src="${p.imagen}" alt="${p.nombre}" style="width: 80px;"></td>
                <td>${p.nombre}</td>
                <td>$${p.precio.toLocaleString()}</td>
                <td><input type="number" value="${p.cantidad}" min="1" data-index="${i}" class="input-cantidad" style="width: 60px;"></td>
                <td class="celda-total">$${total.toLocaleString()}</td>
                <td>${desc ? `-${desc * 100}% ($${descuento.toLocaleString()})` : "-"}</td>
                <td><button data-index="${i}" class="boton-rojo-block eliminar">X</button></td>
            `;
            contenedor.appendChild(fila);
        });

        actualizarTotal();
    };

    contenedor.addEventListener("change", e => {
        if (e.target.classList.contains("input-cantidad")) {
            const i = e.target.dataset.index;
            const cantidad = parseInt(e.target.value);
            if (cantidad > 0) {
                carrito[i].cantidad = cantidad;
                localStorage.setItem("carrito", JSON.stringify(carrito));
                renderCarrito();
            }
        }
    });

    contenedor.addEventListener("click", e => {
        if (e.target.classList.contains("eliminar")) {
            carrito.splice(e.target.dataset.index, 1);
            localStorage.setItem("carrito", JSON.stringify(carrito));
            renderCarrito();
        }
    });

    btnVaciar?.addEventListener("click", () => {
        localStorage.removeItem("carrito");
        carrito = [];
        renderCarrito();
        location.reload()
    });

    
    renderCarrito();
};

function carritoPedido() {
    const contenedor = document.getElementById('productos-confirmacion');
    const inputCarrito = document.getElementById('productos-carrito');
    const totalFinal = localStorage.getItem("totalConDescuento");
    const descuento = localStorage.getItem("descuentoAplicado");

    if (!inputCarrito || !contenedor || !totalFinal || !descuento) return;
    
    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    if (carrito.length === 0) {
        contenedor.innerHTML = '<p>No hay productos en el carrito.</p>';
        return;
    }

    let tabla = `
        <table class="propiedades">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
    `;

    let subtotal = 0;

    carrito.forEach(producto => {
        const total = producto.precio * producto.cantidad;
        subtotal += total;
        tabla += `
            <tr>
                <td><img src="${producto.imagen}" style="width: 80px;"></td>
                <td>${producto.nombre}</td>
                <td>${producto.cantidad}</td>
                <td>$${total.toLocaleString()}</td>
            </tr>
        `;
    });

    tabla += `
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text-align:right;"><strong>Subtotal:</strong></td>
                <td>$${subtotal.toLocaleString()}</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:right;"><strong>Descuento aplicado:</strong></td>
                <td>-$${parseInt(descuento).toLocaleString()}</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:right;"><strong>Total a pagar:</strong></td>
                <td><strong>$${parseInt(totalFinal).toLocaleString()}</strong></td>
            </tr>
        </tfoot>
        </table>
    `;

    contenedor.innerHTML = tabla;

    // Guardar datos en inputs ocultos del formulario
    inputCarrito.value = JSON.stringify(carrito);
    const inputTotal = document.getElementById('input-total');
    const inputDescuento = document.getElementById('input-descuento');

    if (inputTotal) inputTotal.value = totalFinal;
    if (inputDescuento) inputDescuento.value = descuento;
};
function redirigirAlCarrito() {
    const iconoCarrito = document.querySelector('.carrito-boton');
    if (iconoCarrito) {
        iconoCarrito.addEventListener('click', function (e) {
            e.preventDefault();
            window.location.href = '/carrito'; // Cambia la ruta si tu carpeta es diferente
        });
    }
};

