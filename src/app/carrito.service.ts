import { HttpClient } from '@angular/common/http';
import { Producto } from './producto';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class CarritoService {
  items: Producto[] = [];
  totalPrice: number = 0;
  constructor(
    private http: HttpClient
  ) { }

  addCarrito(producto: Producto) {
    this.items.push(producto);
    this.totalPrice = this.totalPrice + producto.precio;
  }

  clearCarrito() {
    this.items = [];
    this.totalPrice = 0;
    return this.items;
  }

  getItemsCarrito() {
    return this.items;
  }

  getProductData() {
    return this.http.get<{identificador: number, nombre: string, categoria: string, precio: number, descripcion: string}[]>('assets/perfumes.json');
  }

  getTotalPrice() {
    return this.totalPrice;
  }
}