import { Component, OnInit } from '@angular/core';

import { FormBuilder } from '@angular/forms';
import { Router } from '@angular/router';

import { filter } from 'rxjs/operators';

@Component({
  selector: 'app-direccion',
  templateUrl: './direccion.component.html',
  styleUrls: ['./direccion.component.css']
})
export class DireccionComponent {

  formularioDireccion = this.formBuilder.group({
    name: '',
    lastname: '',
    address: '',
    cellphone: '',
    email: ''
  });

  constructor(
    private formBuilder: FormBuilder,
    private router: Router
  ) { }

  onSubmit(): void {
    // Process checkout data here
    console.warn('Your order has been submitted', this.formularioDireccion.value);
    this.formularioDireccion.reset();
    this.router.navigate(['/pago']);
  }
}
