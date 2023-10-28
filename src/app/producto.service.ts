import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { map } from 'rxjs/operators';
import { productos } from './producto';
import { MiProducto } from './producto';

@Injectable({
    providedIn: 'root'
})
export class ProductoService {
    constructor(private http: HttpClient) { }

    obtenerDatosDesdeJSON() {
        return this.http.get<{ identificador: number, nombre: string, categoria: string, precio: number, descripcion: string }[]>('assets/productos.json')
            .subscribe(product => {
                productos.push(new MiProducto(product));
            });
    }
}
