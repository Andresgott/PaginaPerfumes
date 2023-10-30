import { Component } from '@angular/core';

import { CarritoService } from '../carrito.service';


@Component({
  selector: 'app-carrito',
  templateUrl: './carrito.component.html',
  styleUrls: ['./carrito.component.css']
})
export class CarritoComponent {

  items = this.carritoService.getItemsCarrito();

  constructor(
    private carritoService: CarritoService
  ) { }

}
