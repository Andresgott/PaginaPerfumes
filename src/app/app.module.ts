import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouterModule } from '@angular/router';

import { AppComponent } from './app.component';
import { TopbarComponent } from './topbar/topbar.component';
import { BannerComponent } from './banner/banner.component';
import { FrasesComponent } from './frases/frases.component';
import { CarritoComponent } from './carrito/carrito.component';
import { InicioComponent } from './inicio/inicio.component';
import { HombreComponent } from './hombre/hombre.component';
import { MujerComponent } from './mujer/mujer.component';
import { NinoComponent } from './nino/nino.component';
import {ListaProductosComponent} from  './lista-productos/lista-productos.component';

import { HttpClientModule } from '@angular/common/http';
import { DetallesProductoComponent } from './detalles-producto/detalles-producto.component';
import { DireccionComponent } from './direccion/direccion.component';

@NgModule({
  declarations: [
    AppComponent,
    TopbarComponent,
    BannerComponent,
    FrasesComponent,
    CarritoComponent,
    InicioComponent,
    HombreComponent,
    MujerComponent,
    NinoComponent,
    ListaProductosComponent,
    DetallesProductoComponent,
    DireccionComponent,
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    RouterModule.forRoot([
      { path: '', component: InicioComponent },
      { path: 'carrito', component: CarritoComponent },
      { path: 'hombre', component: HombreComponent },
      { path: 'mujer', component: MujerComponent },
      { path: 'nino', component: NinoComponent },
      { path: 'producto/:idProducto', component: DetallesProductoComponent },
      { path: 'direccion', component: DireccionComponent },
    ])
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
