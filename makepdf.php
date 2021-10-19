<?php

require_once __DIR__ . '/vendor/autoload.php';


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
	<span><i>Paris 15e</i></span>
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
$mpdf->Output('attestation_'.$nom.'_'.$finaldate.'','D');