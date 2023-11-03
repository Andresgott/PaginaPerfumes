import { Component } from '@angular/core';

import { CarritoService } from '../carrito.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-carrito',
  templateUrl: './carrito.component.html',
  styleUrls: ['./carrito.component.css']
})
export class CarritoComponent {

  items = this.carritoService.getItemsCarrito();

  constructor(
    private carritoService: CarritoService,
    private router: Router
  ) { }

  goToDirection(){
    this.router.navigate(['/direccion']);
  }  

}
