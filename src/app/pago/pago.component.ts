import { Component, OnInit } from '@angular/core';
import { IPayPalConfig, ICreateOrderRequest, IOrderDetails } from 'ngx-paypal';
import { HttpClient } from '@angular/common/http';

import { CarritoService } from '../carrito.service';

@Component({
    selector: 'app-pago',
    templateUrl: './pago.component.html',
    styleUrls: ['./pago.component.css']
})


export class PagoComponent implements OnInit {

    public payPalConfig?: IPayPalConfig;
    private showSuccess: Boolean = false;
    private price: number = 0;

    constructor(
        private http: HttpClient,
        private carrito: CarritoService
    ) { }

    ngOnInit(): void {
        const tmp_price = this.carrito.getTotalPrice();
        this.price = Math.round((tmp_price + Number.EPSILON) * 100) / 100;
        console.log(this.price);
        this.initConfig(this.price.toString());
    }

    private initConfig(precio: string): void {
        this.payPalConfig = {
            currency: 'USD',
            clientId: 'sb',
            createOrderOnClient: (data) => <ICreateOrderRequest>{
                intent: 'CAPTURE',
                purchase_units: [
                    {
                        amount: {
                            currency_code: 'USD',
                            value: precio,
                            breakdown: {
                                item_total: {
                                    currency_code: 'USD',
                                    value: precio
                                }
                            }
                        },
                        items: [
                            {
                                name: 'Enterprise Subscription',
                                quantity: '1',
                                category: 'DIGITAL_GOODS',
                                unit_amount: {
                                    currency_code: 'USD',
                                    value: precio,
                                },
                            }
                        ]
                    }
                ]
            },
            advanced: {
                commit: 'true'
            },
            style: {
                label: 'paypal',
                layout: 'vertical'
            },
            onApprove: (data, actions) => {
                console.log('onApprove - transaction was approved, but not authorized', data, actions);
                actions.order.get().then((details: IOrderDetails ) => {
                    console.log('onApprove - you can get full order details inside onApprove: ', details);
                });
            },
            onClientAuthorization: (data) => {
                console.log('onClientAuthorization - you should probably inform your server about completed transaction at this point', data);
                this.showSuccess = true;
                this.sendShowSuccessToServer(this.price);
            },
            onCancel: (data, actions) => {
                console.log('OnCancel', data, actions);
            },
            onError: err => {
                console.log('OnError', err);
            },
            onClick: (data, actions) => {
                console.log('onClick', data, actions);
            },

        };
    }

    private sendShowSuccessToServer(price: number) {
        return this.http.post('http://localhost/Proyectos/factura.php/', { totalprice: price },{responseType: 'text'})
            .subscribe(
                (response: any) => {
                    console.log('Enviado con exito al servidor PHP', response);
                },
                (error: any) => {
                    console.error('Error al enviar al servidor PHP', error);
                }
            );
    }

}