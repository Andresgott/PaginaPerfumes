import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { Producto, productos } from '../producto';
import { CarritoService } from '../carrito.service';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-detalles-producto',
  templateUrl: './detalles-producto.component.html',
  styleUrls: ['./detalles-producto.component.css']
})
export class DetallesProductoComponent {

  producto: Producto | undefined;

  constructor(
    private route: ActivatedRoute,
    private carritoService: CarritoService
  ) { };

  ngOnInit() {
    const routeParams = this.route.snapshot.paramMap;
    const productIdFromRoute = Number(routeParams.get('idProducto'));

    this.producto = productos.find(producto => producto.identificador === productIdFromRoute);
  }

  addToCart(producto: Producto) {
    this.carritoService.addCarrito(producto);
    window.alert('El producto fue añadido al carrito!');
  }

}
