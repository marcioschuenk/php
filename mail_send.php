<?php
 
function pegaValor($valor) {
    return isset($_POST[$valor]) ? $_POST[$valor] : '';
}
 
function validaEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
 
function enviaEmail($de, $assunto, $mensagem, $para, $email_servidor) {
    $headers = "From: $email_servidor\r\n" .
               "Reply-To: $de\r\n" .
               "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
  	mail($para, $assunto, nl2br($mensagem), $headers);
}
 
$email_servidor = "mail@panelist.com.br";
$para = "";
$id = pegaValor("id");
include "modelo/banco.php";
$query = mysqli_query($con, "select * from participar where idevento = $id");
	while($p = mysqli_fetch_array($query)){
		$m = $p['emailp'];
		$para = $m . ", " . $para;
	}
 
// $para = "abcraphael@gmail.com";
$de = pegaValor("email");
$mensagem = pegaValor("mensagem");
$titulo = pegaValor("titulo");
$assunto = "Evento: $titulo";
 

if (validaEmail($de) && $mensagem) {
    enviaEmail($de, $assunto, $mensagem, $para, $email_servidor);
    $pagina = "mail_ok.php";
} else {
    $pagina = "mail_error.php";
}
 
header("location:$pagina");


?>
