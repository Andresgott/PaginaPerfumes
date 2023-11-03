<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página Web</title>
    <script src="https://www.paypal.com/sdk/js?client-id=AcdKyNfD_bAeBCfP34Rz31JzbFCmpod9GYZAIUqi-mqwJkqkFN1sj5GIMY04oE1Uqh_Ilz-ElFrNAw0D"></script>
</head>
<body>
    <div id="paypal-button-container">
        <div style="border-radius: 50px; overflow: hidden;">
            <script>
                paypal.Buttons({
                    style:{
                        color: 'blue',
                        shape: 'pill'
                    },
                    createOrder: function(data, actions){
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    <!-- Aqui se establece el valor a pagar -->
                                    value: 500
				    
                                }
                            }] 
                        });
                    },
                    
                    onApprove: function(data, actions){
                        
                        actions.order.capture().then(function (detalles){
                            console.log(detalles)

                            
                            let url = '/Proyectos/captura.php'

                        
			            
                            return fetch(url, {
                                method: 'post',
                                headers: {
                                    'content-type': 'application/json'
                                },
                                body: JSON.stringify({
                                    detalles: detalles
                                })
                            })
                        
                        });
                        
                    },
                    
                    onCancel: function(data){
                        alert("Pago cancelado")
                        console.log(data)
                    }
                }).render('#paypal-button-container');
            </script>
        </div>
    </div>
</body>
</html>