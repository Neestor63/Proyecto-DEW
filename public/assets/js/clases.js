// Clase base para cualquier producto de la tienda
class Producto {
    constructor(id, nombre, precio, imagen) {
        this.id = id;
        this.nombre = nombre;
        this.precio = precio;
        this.imagen = imagen;
    }
}

// Clase que hereda de Producto (Requisito: Herencia)
// Útil para productos en oferta que aparecen en el carrusel
class ProductoOferta extends Producto {
    constructor(id, nombre, precio, imagen, descuento) {
        super(id, nombre, precio, imagen);
        this.descuento = descuento;
    }

    get precioFinal() {
        return (this.precio - (this.precio * (this.descuento / 100))).toFixed(2);
    }
}