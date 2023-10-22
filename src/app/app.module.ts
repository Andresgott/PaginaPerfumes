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
import { LoginComponent } from './login/login.component';
import { ListaProductosComponent } from './lista-productos/lista-productos.component';
import { CreateAccountComponent } from './create-account/create-account.component';

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
    LoginComponent,
    ListaProductosComponent,
    CreateAccountComponent
  ],
  imports: [
    BrowserModule,
    RouterModule.forRoot([
      { path: '', component: InicioComponent },
      { path: 'carrito', component: CarritoComponent },
      { path: 'hombre', component: HombreComponent },
      { path: 'mujer', component: MujerComponent },
      { path: 'nino', component: NinoComponent },
      { path: 'login', component: LoginComponent },
      { path: 'createAccount', component: CreateAccountComponent },
    ])
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
