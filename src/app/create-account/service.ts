import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { catchError, map } from 'rxjs/operators';
import { throwError } from 'rxjs';
import { enviroment } from './enviroments/environments';

@Injectable({
  providedIn: 'root'
})
export class DataService {

  constructor(private http: HttpClient) { }

  createUser(nombre: string, apellido: string, email: string, telefono: string, password: string, confirm_password: string) {
    return this.http.post(enviroment.API_URL + 'create-account.php', {
      nombre,
      apellido,
      email,
      telefono,
      password,
      confirm_password
    }, { responseType: 'text' }).pipe(
      map(data => {
        console.log(JSON.stringify(data));
      }),
      catchError(error => {
        return throwError("Something went wrong" + JSON.stringify(error));
      })
    );
  }
}
