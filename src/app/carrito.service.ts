import { HttpClient } from '@angular/common/http';
import { Producto } from './producto';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class CarritoService {
  items: Producto[] = [];
  constructor(
    private http: HttpClient
  ) { }

  addCarrito(producto: Producto) {
    this.items.push(producto);
  }

  clearCarrito() {
    this.items = [];
    return this.items;
  }

  getItemsCarrito() {
    return this.items;
  }

  getProductData() {
    return this.http.get<{identificador: number, nombre: string, categoria: string, precio: number, descripcion: string}[]>('assets/perfumes.json');
  }
}