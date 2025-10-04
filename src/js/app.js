document.addEventListener('DOMContentLoaded',function(){
    redirigirAlCarrito();
    inicializarCarrito(); 
    eventListeners();
    darkMode();
    mostrarCarrito();
    carritoPedido();
    inicializarAcordeon();

    const botonesComprar = document.querySelectorAll(".btn-comprar");
    const modal = document.querySelector("#modalPago");
    const cerrar = document.querySelector("#cerrarModal");
    const formPago = document.querySelector("#formPago");
    const tamano = document.querySelector("#tamano");
    const opcionesGrandes = document.querySelector("#opcionesGrandes");
    const opcionesMedianos = document.querySelector("#opcionesMedianos");

    // Manejar cambios en el tamaño seleccionado
    if (tamano) {
        // Ocultar las opciones al inicio
        if (opcionesGrandes) opcionesGrandes.style.display = "none";
        if (opcionesMedianos) opcionesMedianos.style.display = "none";

        tamano.addEventListener("change", function() {
            // Ocultar ambas opciones primero
            if (opcionesGrandes) opcionesGrandes.style.display = "none";
            if (opcionesMedianos) opcionesMedianos.style.display = "none";
            
            // Mostrar las opciones según el tamaño seleccionado
            if (this.value === "grande") {
                opcionesGrandes.style.display = "block";
            } else if (this.value === "mediano") {
                opcionesMedianos.style.display = "block";
            }
        });
    }

    if (botonesComprar.length && modal && cerrar && formPago) {
        // 🚀 Abrir modal
        botonesComprar.forEach(boton => {
            boton.addEventListener("click", (e) => {
                e.preventDefault();
                modal.classList.remove("oculto");
                document.body.style.overflow = "hidden"; // Bloquear scroll del fondo
            });
        });

        // 🚀 Función para cerrar el modal
        function cerrarModal() {
            modal.classList.add("oculto");
            document.body.style.overflow = ""; // Restaurar scroll
            // Limpiar el formulario al cerrar
            formPago.reset();
            // Ocultar las opciones de tamaño
            if (opcionesGrandes) opcionesGrandes.style.display = "none";
            if (opcionesMedianos) opcionesMedianos.style.display = "none";
        }

        // 🚀 Cerrar modal con botón ❌
        cerrar.addEventListener("click", (e) => {
            e.preventDefault();
            cerrarModal();
        });

        // 🚀 Cerrar modal clicando en el fondo oscuro
        modal.addEventListener("click", (e) => {
            if (e.target === modal) {
                cerrarModal();
            }
        });

        
    }

    // Carousel initializer (manual, no autoplay)
    (function(){
        const carousels = document.querySelectorAll('.carousel');
        carousels.forEach(carousel => {
            const track = carousel.querySelector('.carousel-track');
            const slides = Array.from(carousel.querySelectorAll('.carousel-slide'));
            const prev = carousel.querySelector('.carousel-btn.prev');
            const next = carousel.querySelector('.carousel-btn.next');
            const dotsContainer = carousel.querySelector('.carousel-dots');
            if (!track || slides.length === 0) return;

            let current = 0;
            let startX = 0;
            let isDragging = false;

            slides.forEach((s, i) => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.setAttribute('aria-selected', i === 0 ? 'true' : 'false');
                btn.setAttribute('aria-label', `Ir a la diapositiva ${i+1}`);
                btn.addEventListener('click', () => goTo(i));
                dotsContainer.appendChild(btn);
            });

            function update(){
                const w = carousel.getBoundingClientRect().width;
                track.style.transform = `translateX(${ -current * w }px)`;
                const dots = Array.from(dotsContainer.children);
                dots.forEach((d, idx) => d.setAttribute('aria-selected', idx === current ? 'true' : 'false'));
            }

            function goTo(index){
                current = Math.max(0, Math.min(index, slides.length -1));
                update();
            }

            prev?.addEventListener('click', () => goTo(current - 1));
            next?.addEventListener('click', () => goTo(current + 1));

            carousel.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowRight') goTo(current + 1);
                if (e.key === 'ArrowLeft') goTo(current - 1);
            });

            track.addEventListener('touchstart', (e) => {
                isDragging = true;
                startX = e.touches[0].clientX;
            }, {passive:true});

            track.addEventListener('touchmove', (e) => {
                if (!isDragging) return;
                const dx = e.touches[0].clientX - startX;
                const w = carousel.getBoundingClientRect().width;
                track.style.transform = `translateX(${ -current * w + dx }px)`;
            }, {passive:true});

            track.addEventListener('touchend', (e) => {
                isDragging = false;
                const endX = e.changedTouches[0].clientX;
                const dx = endX - startX;
                const threshold = carousel.getBoundingClientRect().width * 0.18;
                if (dx > threshold) goTo(current - 1);
                else if (dx < -threshold) goTo(current + 1);
                else update();
            });

            window.addEventListener('resize', update);
            carousel.setAttribute('tabindex', '0');
            update();
        });
    })();
});


function darkMode(){
    // Verificar si estamos en la página de cuadros gobelinos
    if (document.body.classList.contains('pagina-cuadros')) {
        return; // Salir de la función sin aplicar el modo oscuro
    }
    
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    
    if(prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function() {
        if(prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });
    
    const botonDarkMode = document.querySelector('.dark-mode-boton');
    
    if (botonDarkMode) {
        botonDarkMode.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
        });
    }
}

function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu');
    
    // Verificar si el elemento existe antes de agregar el event listener
    if (mobileMenu) {
        mobileMenu.addEventListener('click', navegacionResponsive);
    }
    
    // Muestra campos condicionales - verificar si existen
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    if (metodoContacto.length > 0) {
        metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));
    }
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
            window.location.href = '/carrito';
        });
    }
}
function inicializarAcordeon() {
    const headers = document.querySelectorAll(".acordeon-header");

    if (!headers.length) return;

    headers.forEach((header) => {
        header.addEventListener("click", () => {
            const content = header.nextElementSibling;
            
            // Cerrar todos los demás acordeones
            document.querySelectorAll(".acordeon-content").forEach((c) => {
                if (c !== content) {
                    c.style.maxHeight = null;
                    c.previousElementSibling.classList.remove("active");
                }
            });

            // Alternar el actual
            header.classList.toggle("active");
            
            if (content.style.maxHeight) {
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
            }
        });
    });
}