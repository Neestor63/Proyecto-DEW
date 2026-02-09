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

// CALCULAR TOTAL
function calcularTotal() {
    const carrito = cargarCarrito();
    return carrito.reduce((acc, item) => acc + item.precio * item.cantidad, 0);
}
