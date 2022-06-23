<?php

  mb_internal_encoding('UTF-8');

  // Esto le dice a PHP que generaremos cadenas UTF-8
  mb_http_output('UTF-8');

  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
  header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');


function response($msg, $status, $code, $error){
  $res=[
    "msg" => $msg,
    "status" => $status,
    "code" => $code,
    "error" => $error
  ];
  print_r(json_encode($res));
}


$to = "contacto@geotica.com.mx";

$name = $_POST['name'];
// $surname = "username";
$phone = "0000";
$email = $_POST['email'];
$msg = $_POST['message'];

if(!empty($name) || !empty($surname) || !empty($phone) || !empty($email) || !empty($msg)){
  $email_saliente_nombre = $name;
  $email_saliente = $email;
  $subject = "Formulario de Contacto Geotica";
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  $headers .= "From: {$email_saliente_nombre} <{$email_saliente}>\r\n";
//dirección de respuesta, si queremos que sea distinta que la del remitente
  $headers .= "Reply-To: {$email}\r\n";
  $message = "
    <html>
    <head>
    <title>HTML</title>
    </head>
    <body>
    Correo enviado desde geotica.com.mx<br><br>
    Nombre: <b>{$name}</b> <br><br>
    Email: <b>{$email}</b> <br><br>
    Mensaje: <b>{$msg}</b> <br><br>
    </body>
    </html>";

  if (mail($to, $subject, $message, $headers)) {
    response('Form sent successfully. We will contact you shortly', "ok", 200, null);
  } else {
    response('An error occurred. Please try again late', "error", 400, true);
  };
}else {
  response('Incomplete data. Please check and try again', "error", 400, true);
}



?>
