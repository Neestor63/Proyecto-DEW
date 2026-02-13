// productos.js

class Producto {
    constructor(id, nombre, precio) {
        this.id = id;
        this.nombre = nombre;
        this.precio = precio;
    }
}

class ProductoConDescuento extends Producto {
    constructor(id, nombre, precio, descuento) {
        super(id, nombre, precio);
        this.descuento = descuento; // porcentaje
    }

    precioFinal() {
        return this.precio - (this.precio * (this.descuento / 100));
    }
}
