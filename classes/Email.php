<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;
    
    public function __construct($email, $nombre, $token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarEmail(){
        // crear object email
        
       
        $mail = new PHPMailer();
     
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'estrella161610@gmail.com';
        $mail->Password = 'oigsbqynlbbirkgz    ';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('admin@sro.com',);
        $mail->addAddress($this->nombre, $this->email);

        $mail->Subject = 'Confirmar cuenta';

        $mail->isHTML(true);   
        // $mail->CharSet = "UTF-8";    
        $msj = "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
          <meta charset='UTF-8'>
          <meta name='viewport' content='width=device-width, initial-scale=1.0'>
          <title>Confirmar Cuenta</title>
        
          <style>
            * {
              margin: 0;
              padding: 0;
              box-sizing: border-box;
            }
        
            .container {
              max-width: 1500px;
              width: 100%;
              margin: 0 auto;
            }
            .bg-dark {
              background: #ffffff;
              margin-top: 40px;
              padding: 20px 0;
            }
            .alert {
              font-size: 1.5em;
              position: relative;
              padding: .75rem 1.25rem;
              margin-bottom: 2rem;
              border: 1px solid transparent;
              border-radius: .25rem;
            }
            .alert-primary {
              color: #ff9101;
              background-color: #cce5ff;
              border-color: #b8daff;
            }
        
            .img-fluid {
              max-width: 100%;
              height: auto;
            }
        
            .mensaje {
              width: 80%;
              font-size: 15px;
              margin: 0 auto 40px;
              color: #eee;
            }
        
            .texto {
              margin-top: 20px;
            }
        
            .footer {
              width: 100%;
              background: #ff9101;
              text-align: center;
              color: #ffffff;
              padding: 10px;
              font-size: 14px;
            }
        
            .footer span {
              text-decoration: underline;
            }
            p{
                color:black;
            }
            img{
                width:80%;
            }
          </style>
        </head>
        <body>
          <div class='container'>
            <div class='bg-dark'>
              <div class='alert alert-primary'>Bienvenido:
                <strong> $this->email    </strong> 
              </div>
        
              <div class='mensaje'>
        
                <div class='texto'><p><strong> 
                Has creado una cuenta en SRO </strong>,
                solo debes confirmarla presionando en el siguiente enlace, 
                 <br> Presiona aqui: <p><a href='http://localhost:3000/confirmar?token=" . $this->token ."'>Confirmar cuenta</a></p>
                 
                </p>
                 </div>
              </div>
              <center>
              <img src = 'https://media.istockphoto.com/id/1459806180/es/vector/lindo-taco-feliz-y-tarjeta-de-burrito-dise%C3%B1o-vectorial-de-ilustraci%C3%B3n-de-personajes-de.jpg?s=612x612&w=0&k=20&c=8zePJbaT1MZbgOxoEuTCCwO4MxyRtbVGo3dnGnAUll4='>
              </center>
              <div class='footer'>
           <p>Si tu no solicitaste esta cuenta,  ignorar el mensaje</p>
              </div>
            </div>
          </div>
        </body>
        </html>
        ";

        $mail->Body = $msj;

        //enviar el email

        $mail->send();
        }
        public function enviarCodigo() {
          $mail = new PHPMailer();
     
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'estrella161610@gmail.com';
        $mail->Password = 'oigsbqynlbbirkgz    ';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom('admin@sro.com', 'Jorge');
        $mail->addAddress($this->nombre, $this->email);
  
          $mail->Subject = 'Restablecer Password';
  
          $mail->isHTML(true);   
          // $mail->CharSet = "UTF-8";    
          $msj = "
          <!DOCTYPE html>
          <html lang='es'>
          <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Restablecer Password</title>
          
            <style>
              * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
              }
          
              .container {
                max-width: 1500px;
                width: 100%;
                margin: 0 auto;
              }
              .bg-dark {
                background: #ffffff;
                margin-top: 40px;
                padding: 20px 0;
              }
              .alert {
                font-size: 1.5em;
                position: relative;
                padding: .75rem 1.25rem;
                margin-bottom: 2rem;
                border: 1px solid transparent;
                border-radius: .25rem;
              }
              .alert-primary {
                color: #ff9101;
                background-color: #cce5ff;
                border-color: #b8daff;
              }
          
              .img-fluid {
                max-width: 100%;
                height: auto;
              }
          
              .mensaje {
                width: 80%;
                font-size: 15px;
                margin: 0 auto 40px;
                color: #eee;
              }
          
              .texto {
                margin-top: 20px;
              }
              .footer {
                width: 100%;
                background: #ff9101;
                text-align: center;
                color: #ffffff;
                padding: 10px;
                font-size: 14px;
              }
          
              .footer span {
                text-decoration: underline;
              }
              p{
                  color:black;
              }
              img{
                  width:80%;
              }
            </style>
          </head>
          <body>
            <div class='container'>
              <div class='bg-dark'>
                <div class='alert alert-primary'>Hola:
                  <strong>  $this->email   </strong> 
                </div>
          
                <div class='mensaje'>
          
                  <div class='texto'><p><strong> 
                  Has solicitado reestablecer tu password en SRO </strong>,
                  para reestablecerla sigue el siguiente enlace
                   <br> Presiona aqui: <p><a href='http://localhost:3000/recuperar?token=" . $this->token ."'>Restablecer password</a></p>
                  </p>
                   </div>
                </div>
                <center>
                <img src = 'https://media.istockphoto.com/id/1459806180/es/vector/lindo-taco-feliz-y-tarjeta-de-burrito-dise%C3%B1o-vectorial-de-ilustraci%C3%B3n-de-personajes-de.jpg?s=612x612&w=0&k=20&c=8zePJbaT1MZbgOxoEuTCCwO4MxyRtbVGo3dnGnAUll4='>
                </center>
                <div class='footer'>
             <p>Si tu no solicitaste esta opcion,  ignorar el mensaje</p>
                </div>
              </div>
            </div>
          </body>
          </html>
          ";
  
          $mail->Body = $msj;
  
          //enviar el email
  
          $mail->send();
          header('Location: /olvide?msg=ok');


        }
}