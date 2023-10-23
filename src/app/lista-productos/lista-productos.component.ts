import { Component, OnInit, Input } from '@angular/core';

import { CarritoService } from '../carrito.service';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-lista-productos',
  templateUrl: './lista-productos.component.html',
  styleUrls: ['./lista-productos.component.css']
})
export class ListaProductosComponent implements OnInit {
  
  @Input()
  category: string = "";

  constructor(private carritoService: CarritoService) { }
  infoProductos!: Observable<{identificador: number, nombre: string, categoria: string, precio: number, descripcion: string}[]>;

  ngOnInit(): void {
    this.infoProductos = this.carritoService.getProductData();
  }
}
