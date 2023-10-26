import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { map } from 'rxjs/operators';
import { MiProducto, productos } from './producto';

@Injectable({
    providedIn: 'root'
})
export class ProductoService {
    constructor(private http: HttpClient) { }

    obtenerDatosDesdeJSON() {
        return this.http.get<{ identificador: number, nombre: string, categoria: string, precio: number, descripcion: string }[]>('assets/productos.json')
            .subscribe(product => {
                MiProducto = {
                    identificador: product.values(),
                    nombre: product.values(),
                    categoria: product.values(),
                    precio: product.values(),
                    descripcion: product.values(),
                };
            });
    }
}
