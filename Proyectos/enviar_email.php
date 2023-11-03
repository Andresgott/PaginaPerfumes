<?php


use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};


require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';



//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'gonzalogonzalezdelarosa44@gmail.com';                     //SMTP username
    $mail->Password   = 'inyp qipj lmst pzkk';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('gonzalogonzalezdelarosa44@gmail.com', 'Lefred perfumeria');
    $mail->addAddress('myangularprojects0505@gmail.com');     //Aqui debemos poner otro correo cuando pasemos a la version live
                  
    


    //Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = utf8_decode('Confirmación de pago');
    
    $mail->Body .= 'Estado: ' . $status . '<br>';
    $mail->Body .= 'Hola estimado/a ' . $nombre . ' tu pago ha sido confirmado y te adjuntamos tu factura. Atentamente: El equipo de lefred perfumes';

    $mail->addAttachment($nombreArchivoFactura, 'factura.pdf');

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

