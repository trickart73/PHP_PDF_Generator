<?php


//require 'includes/PHPMailer.php';
//require 'includes/SMTP.php';
//require 'includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require_once __DIR__ . '/vendor/autoload.php';

iconv_set_encoding("internal_encoding", "UTF-8");


 date_default_timezone_set('Europe/Paris');
 $today = date('d/m/Y');

//Grab variables
$prenom = $_POST["prenom"];
$nom = $_POST["nom"];
$somme = $_POST["somme"];

$mutuelle = $_POST["mutuelle"];
$numade = $_POST["numade"];
$secu = $_POST["secu"];

$nbconsult = $_POST["nbconsult"];

$dateconsult = $_POST["dateconsult"];
$finaldate =  date('d/m/Y', strtotime($dateconsult));

$email = $_POST["email"];


//Conditions
if($somme == '')
{
	$somme = 55;
}

if($nbconsult == '')
{
	$nbconsult = 1;
}

if($dateconsult == '')
{
	$finaldate = $today;
}



$mpdf = new \Mpdf\Mpdf();

//create pdf
$data = '';

$data .= "

<div style='width: 100%;'>
  <div align='left' style='width: 50%;float: left;'>
    <span><i>John DOE</i></span>
    <br />
    <span><i>Psychologue Clinicien</i></span>
    <br />
	<br />
	<span><i>École de Psychologues Praticiens</i></span>
	<br />
	<span><i>^Paris 15e</i></span>
	<br />
	<br />
	<span><i>N° SIREN : 123456789</i></span>
	<br />
	<span><i>Identifiant Psychologue répertoire ADELI : 987654321</i></span>
  </div>

  <div align='right' style='width: 50%;float: right;'>
    <span><i>7 rue d'Ivry</i></span>
    <br />
    <span><i>75015 PARIS</i></span>
    <br />
	<br />
	<span><i>06 00 00 00 00</i></span>
   </div>
</div>

<br />
	<p align='center'> ATTESTATION de PERCEPTION d'HONORAIRES </p>
	<p align='center'> Et de CONSULTATIONS </p>

	<p align='left'>Votre Mutuelle : " .$mutuelle .  " </p> 

	<p align='left'>Pour votre information :</p> 
	<p align='left'> - Votre n° d'adhérent :  " .$numade .  "</p> 
	<p align='left'> - Votre n° de sécurité sociale : " .$secu .  "</p>  
	<br />

	<p align='left'>Je, soussignée, John DOE, certifie avoir reçu la somme de  " .$somme .  " Euros</p>  
	<p align='left'>De la part de  " .$prenom ." " . $nom .  "</p> 
	<p align='left'>Pour " .$nbconsult .  " consultation effectuée le  " .$finaldate.  " </p> 
	<br />

	<p align='left'>Cette attestation est effectuée et délivrée à l’intéressé pour servir et faire valoir que de droit.</p> 

	<p align='right'> Fait à Paris (15eme arrondissement), </p> 

	<p align='right'> John DOE </p>

	<p align='right'> <img src='signature_doe.png' width='150' />  </p>

";




//Create
$mpdf->WriteHTML($data);

//Output
$pdf = $mpdf->Output('','S');



//Grab enquiry data
$enquirydata = [

	"Today" => $today,
	"Prenom" => $prenom,
	"Nom" => $nom,
	"Somme" => $somme,
	"Mutuelle" => $mutuelle,
	"Numade" => $numade,
	"Secu" => $secu,
	"Nbconsult" => $nbconsult,
	"Dateconsult" => $dateconsult,
	"Finaldate" => $finaldate,
	"Email" => $email,

];


sendEmail($pdf,$enquirydata);

function sendEmail($pdf,$enquirydata)
{

/*
$emailbody = '';

$emailbody .= '<h1> Email enquiry from ' .$enquirydata['Prenom'] . '</h1>';

foreach ($enquirydata as $title => $data) {
	
	$emailbody .= '<strong>' .$title. '</strong>:' . $data . '<br />';

}
*/


	// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = false;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'your-email@gmail.com';                     // SMTP username
    $mail->Password   = 'XXXXXX';                               // SMTP password
    $mail->SMTPSecure = "tls";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('your-email@gmail.com', utf8_decode('John Doe')); //ME
    $mail->addAddress($enquirydata['Email'], utf8_decode($enquirydata['Prenom']) . ' ' . utf8_decode($enquirydata['Nom']));     // Add a recipient

    // Attachments
    $mail->addStringAttachment($pdf, 'attestation.pdf');
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Attestation du '.$enquirydata['Finaldate'];

	//https://www.textfixer.com/html/html-character-encoding.php    
    $mail->Body    =  "Bonjour,
    <br /> 
    <br /> 
    Vous trouverez en pi&egrave;ce jointe l'attestation du ".$enquirydata['Finaldate'].". 
    <br />
    Cordialement, <br />
    <br />
    John Doe";
    
    //$mail->AltBody = strip_tags($emailbody);

    $mail->send();
    
    header('Location:thanks.php?nom=' . $enquirydata['Nom']);

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}