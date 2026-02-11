<?php
// clases_inazuma.php

abstract class ArticuloBase {
    protected $nombre;
    protected $precio;

    public function __construct($nombre, $precio) {
        $this->nombre = $nombre;
        $this->precio = $precio;
    }

    public function get_nombre() { return $this->nombre; }
    public function get_precio() { return $this->precio; }
}

class VideojuegoInazuma extends ArticuloBase {
    protected $saga; 

    public function __construct($nombre, $precio, $saga) {
        parent::__construct($nombre, $precio);
        $this->saga = $saga;
    }
}

class LoteSagaOriginal {
    protected $videojuego; 
    protected $cantidad;
    protected $importe_total;

    public function __construct(VideojuegoInazuma $juego, $cantidad) {
        $this->videojuego = $juego;
        $this->cantidad = $cantidad;
        // El valor se asigna mediante la llamada a un método, sin lógica aquí
        $this->importe_total = $this->calcular_importe_lote();
    }

    private function calcular_importe_lote() {
        return $this->videojuego->get_precio() * $this->cantidad;
    }

    public function get_detalles() {
        return [
            'nombre'     => $this->videojuego->get_nombre(),
            'precio_uni' => $this->videojuego->get_precio(),
            'cantidad'   => $this->cantidad,
            'total'      => $this->importe_total
        ];
    }

    public function get_importe() { return $this->importe_total; }
}

class LoteSagaNueva {
    protected $videojuego;
    protected $cantidad;
    protected $importe_total;

    public function __construct(VideojuegoInazuma $juego, $cantidad) {
        $this->videojuego = $juego;
        $this->cantidad = $cantidad;
        // El valor se asigna mediante la llamada a un método, sin lógica aquí
        $this->importe_total = $this->calcular_importe_lote();
    }

    private function calcular_importe_lote() {
        return $this->videojuego->get_precio() * $this->cantidad;
    }

    public function get_detalles() {
        return [
            'nombre'     => $this->videojuego->get_nombre(),
            'precio_uni' => $this->videojuego->get_precio(),
            'cantidad'   => $this->cantidad,
            'total'      => $this->importe_total
        ];
    }

    public function get_importe() { return $this->importe_total; }
}