// carrito.js

function cargarCarrito() {
    return JSON.parse(localStorage.getItem("carrito")) || [];
}

function guardarCarrito(carrito) {
    localStorage.setItem("carrito", JSON.stringify(carrito));
}

function añadirAlCarrito(producto) {
    let carrito = cargarCarrito();

    const item = carrito.find(p => p.id === producto.id);

    const precio = (producto instanceof ProductoConDescuento)
        ? producto.precioFinal()
        : producto.precio;

    if (item) {
        item.cantidad++;
    } else {
        carrito.push({
            id: producto.id,
            nombre: producto.nombre,
            precio: precio,
            cantidad: 1
        });
    }

    guardarCarrito(carrito);
}

// ELIMINAR PRODUCTO
function eliminarProducto(id) {
    let carrito = cargarCarrito();
    carrito = carrito.filter(p => p.id !== id);
    guardarCarrito(carrito);
    actualizarCarritoVisual();
}

// CAMBIAR CANTIDAD
function cambiarCantidad(id, cantidad) {
    let carrito = cargarCarrito();
    const item = carrito.find(p => p.id === id);

    if (!item) return;

    const cant = Number(cantidad);

    if (cant <= 0) {
        eliminarProducto(id);
        return;
    }

    item.cantidad = cant;
    guardarCarrito(carrito);
    actualizarCarritoVisual();
}

// js/carrito.js (Añade esto al final)

function añadirDesdeTienda(id) {
    // 1. Buscamos los datos en el array global que inyectamos desde PHP
    // 'productosPHP' es el nombre que usamos en el script de tienda.php
    const datos = productosPHP[id]; 

    if (!datos) {
        console.error("Producto no encontrado");
        return;
    }

    // 2. Creamos un objeto compatible con la lógica del carrito
    const productoParaCarrito = {
        id: id,
        nombre: datos.nombre,
        precio: datos.precio
    };

    // 3. Llamamos a la función principal que ya tenemos
    añadirAlCarrito(productoParaCarrito);

    // 4. Feedback visual (opcional)
    alert("¡Fichaje completado! " + datos.nombre + " añadido.");
}

// CALCULAR TOTAL
function calcularTotal() {
    const carrito = cargarCarrito();
    return carrito.reduce((acc, item) => acc + item.precio * item.cantidad, 0);
}
